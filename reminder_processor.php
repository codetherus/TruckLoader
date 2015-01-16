<?php
/*
  8/16/10
  This page will process the reminders table and
  send emails to the users at the appointed times.
  The user will have to start it in a browser and leave it running.
  The browser code does a setinterval call and we get called
  once a minute.
*/
require_once("commons.php");
require_once("utilityV2.php");
$smarty->assign("pgtitle", "Tickler File Processing"); 
$messageblock = '';
$msgcount = 0;
//Logging function - remove the return to enable it.
function LogIt($s){
  //return;
  global $messageblock;
  $messageblock .= $s."<br/>";
}

function RemoveReminder($id){
  global $db;
  $sql = "delete from reminders where id = $id";
  $db->query($sql);
  LogIt("Removed row $id");
}

//Do it...
function SendReminder($row){
  global $db, $msgcount;
  $msgcount = 0;
  //Get the user's email.
  $uid = $row->userid;
  $sql = "select * from users where id = $uid";
  $user = $db->get_row($sql);
  $email = $user->email;
  $usrname = $user->user;
  if ($email == '')
  {
    Logit("ERROR: No email address for $username");
   return;
  }
  $email .= "\r\n";
  LogIt("Sending Reminder to $email");
  $subject = $row->subject;
  $message = $row->message."\r\n";
  
  $header = 'From: webmaster@loadsbyjake.com'."\r\n";
  $header .= "To: User $email\n\r";
  $res = mail($email,$subject,$message,$header);
  LogIt("Send Mail result $res");
  if ($res)
    $msgcount++;
  return $res;
}
function ScanReminders(){
  global $db;
  $res = $db->get_row("select now() as 'thetime'");
  $timestamp = $res->thetime;
  Logit("Reminder scan started at $timestamp");
//  LogIt("Current Timestamp = $timestamp");
  $sql = "select * from reminders";
  $res = $db->get_results($sql);
  $numrows = $db->num_rows;
//  LogIt("Found $numrows records...");
  if (!$res) return;
  
  foreach($res as $row)
  {
    $id = $row->id;
    $frequency = $row->frequency;
    $lastdate  = $row->lastdate;
    $nextdate  = $row->nextdate;
    $startdate = $row->startdate;
    $enddate   = $row->enddate;
    if ($nextdate == '0000-00-00 00:00:00')
      $nextdate = $startdate;
    //LogIt("Nextdate  $nextdate");
    //Remove the event if expired.
    if ($enddate != '' && $timestamp > $enddate)
    {
      
      RemoveReminder($row->id);
      continue;
    }
     
    //Not time?
    if ($timestamp < $nextdate)
    {
      continue;
    }
    $mailresult = SendReminder($row);
    if (!$mailresult) 
    {
      LogIt("Send Failed for row $id");
      continue;
    }
    //Setup the next timestamp
    switch ($frequency){
      case 'Once':
        RemoveReminder($row->id);
        break;
      case 'Half Hr':
        $add = "timestampadd(Minute,30,'$timestamp')";
      case 'Hourly':
        $add = "timestampadd(HOUR,1,'$timestamp')";
        break;
      case 'Daily':
        $add = "timestampadd(DAY,1,'$timestamp')";
        break;
      case 'Weekly':
        $add = "timestampadd(WEEK,1,'$timestamp')";
        break;
      case 'Monthly':
        $add = "timestampadd(MONTH,1,'$timestamp')";
        break;
      case 'Annually':
        $add = "timestampadd(YEAR,1,'$timestamp'";
        break;
      default:
        $add = "timestampadd(DAY,1,'$$timestamp')";
        break;
      } //end switch
      $tsares = $db->get_row("select $add as 'addtime'");
      $tsa = $tsares->addtime;
//      LogIt("Next Time: $tsa");
      //Update with next timestamp.
      $sql = "update reminders set lastdate = '$timestamp', nextdate = '$tsa' where id = $id";
      $db->query($sql);
      
  } //end foreach
} //end scanreminders

function CheckReminders(){
  global $messageblock,$msgcount;
  $resp = new xajaxResponse();
  ScanReminders();
  Logit("Sent $msgcount reminders...");
  $resp->append("processinfo","innerHTML",$messageblock);
  return $resp;
  
}
//$xajax->configure('debug',true);
$xajax->register(XAJAX_FUNCTION,'CheckReminders');
$xajax->processRequest();
GenerateSmartyPage();
?>