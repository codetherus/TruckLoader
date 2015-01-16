<?php
/*
  8/16/10
  This page will process the reminders table and
  send emails to the users at the appointed times.
  We are going to try to run it as a cron job.
*/
//MySQL classes for database access
include_once('ezsql/mysql/ez_sql_core.php');
include_once('ezsql/mysql/ez_sql_mysql.php');
include('dbsettings.php');
$db = new ezSQL_mysql($dbuser, $dbpassword, $dbdatabase, $dbhost);

$msgcount = 0;

//Error and event logging
function ReminderLog($s){
  $hdl = fopen("reminderlog.txt", "a");
  if ($hdl)
  {
    $txt = date('r')."  $s\n";
    fwrite($hdl,$txt);
    fclose($hdl);
  }
}
//Delete an expired reminder
function RemoveReminder($id){
  global $db;
  $sql = "delete from reminders where id = $id";
  $db->query($sql);
}

//Do it...
function SendReminder($row){
  global $db,$msgcount;
  //Get the user's email.
  $uid = $row->userid;
  $sql = "select * from users where id = $uid";
  $user = $db->get_row($sql);
  $email = $user->email;
  $usrname = $user->user;
  if ($email == '')
  {
   return;
  }
  $email .= "\r\n";
  $subject = $row->subject;
  $message = $row->message."\r\n";
  $header = 'From: webmaster@loadsbyjake.com'."\r\n";
  $header .= "To: User $email\n\r";
  $res = mail($email,$subject,$message,$header);
  if ($res){
    ReminderLog("Sent to $user->email $subject");
    $msgcount++;
  }
  else
    ReminderLog("Failed to send email to $user->email $subject");
  return $res;
}
/*
  This is the main function.
  It reads the reminder file into a result set
  and evalueates each one.
  
  1. Expired messages are removed.
  2. Not due yet messages are skipped.
  3. Qualifiers are sent SendReminder().
  
  Logs things...
*/
function ScanReminders(){
  
  global $db;
  $res = $db->get_row("select now() as 'thetime'");
  $timestamp = $res->thetime;
  ReminderLog("Starting scan at $timestamp");
  $sql = "select * from reminders";
  $res = $db->get_results($sql);
  $numrows = $db->num_rows;
  if (!$res) return; //No records?
//  ReminderLog("Scanning $numrows records.");
  foreach($res as $row)
  {
    $id = $row->id;
    $frequency = $row->frequency;
    $lastdate  = $row->lastdate;
    $nextdate  = $row->nextdate;
    $startdate = $row->startdate;
    $enddate   = $row->enddate;
    if ($nextdate == '0000-00-00 00:00:00'|| 
        $nextdate == '' || 
        is_null($nextdate))
      $nextdate = $startdate;
    //ReminderLog("Candidate - Next Date: $nextdate $startdate Frequency: $frequency");
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
      continue;
     //Setup the next timestamp
    switch ($frequency){
      case 'Once':
        RemoveReminder($row->id);
        break;
      case 'Half Hr':
        $add = "timestampadd(Minute,30,'$timestamp')";
        break;
      case 'Hourly':
        $add = "timestampadd(HOUR,1,current_timestamp)";
        break;
      case 'Daily':
        $add = "timestampadd(DAY,1,current_timestamp)";
        break;
      case 'Weekly':
        $add = "timestampadd(WEEK,1,current_timestamp)";
        break;
      case 'Monthly':
        $add = "timestampadd(MONTH,1,current_timestamp)";
        break;
      case 'Annually':
        $add = "timestampadd(YEAR,1,current_timestamp)";
        break;
      default:
        $add = "timestampadd(DAY,1,current_timestamp)";
        break;
      } //end switch
      if ($add){
      $sql = "select $add";
      //ReminderLog("TimeADD: $sql as ta");
      $tsares = $db->get_row($sql);
      //ReminderLog("tsares: ".print_r($tsares,true));
      $tsa = $tsares->$add;
      //ReminderLog("Next time $tsa");
      //Update with next timestamp.
      $sql = "update reminders set lastdate = '$timestamp', nextdate = '$tsa' where id = $id";
      $db->query($sql);
      }
      
  } //end foreach
} //end scanreminders

//Run the scan
ScanReminders();
//ReminderLog("Sent $msgcount emails");
?>