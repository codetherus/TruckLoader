<?php
/*
  Reminder / tickler manager
*/
require_once("commons.php");
require_once("utilityV2.php");
$smarty->assign("pgtitle", "Reminders Management"); 
$smarty->assign("domenu", 1);
$resp='';
$set = '';
function FrequencyList($freq='')
{
  $freqs=array('Once','Half Hr','Hourly','Daily','Weekly','Monthly','Annually');
  $s = "<select id='frequency' name='frequency'>\n";
  for($i=0;$i<count($freqs);$i++)
  {
    $f = $freqs[$i];
    if ($f == $freq)
     $s .= "<option value='$f' selected>$f</option>\n";
    else
     $s .= "<option value='$f'>$f</option>\n"; 
  }
  $s .= "</select>\n";
  return $s;  
}
//Gen a floatbox list of the users reminders 
function ReminderList()
{
  global $db, $resp;
  $id = $_SESSION['userid'];
  $sql = "select * from reminders where userid = $id";
  $res = $db->get_results($sql);  
//  $resp->alert(print_r($res,true));
//  return $resp;
  if (!$res)
    return xajaxAlert("No reminders on file.","Reminder List");
  $s  = "<table border='1' style='color: black;'>\n";
  $s .= "<tr><th>Subject<th>Frequency<th>Start Date<th>End Date<th>Last Time</tr>\n";
  foreach($res as $rw)
  {
    $link = "<a href='#' onclick='SetupPageRead($rw->id)'>$rw->subject</a>";
    $s .= "<tr><td>$link<td>$rw->frequency<td>$rw->startdate<td>$rw->enddate<td>$rw->lastdate</tr>\n";
  }
  $s .= "</table>\n";  
  return GenFloatbox($s);
}
//New reminder insert
function AddReminder($dta)
{
  global $db, $resp;
  $id = $_SESSION['userid'];
  extract($dta);
  $sql  = "insert into reminders(userid, subject,message,frequency,startdate,enddate) ";
  $sql .= "values($id,'$subject','$message','$frequency','$begindate','$enddate')"; 
  QueryLog("Reminder"."-".$sql);  
  $db->query($sql);  
  if ($db->rows_affected > 0)  
    return xajaxAlert("Reminder Created", "Reminders Management");    
  else  
    return xajaxAlert("Reminder Creation Failed", "Reminders Management");    
}

function UpdateReminder($dta)
{
  global $db, $resp, $set;

  extract($dta);
      
  $sql = "select * from reminders where id = $current_record_id";  
  $rec = $db->get_row($sql);  
  if (!$rec)
    return xajaxAlert("Reminder Update Failed. Record not located.", "Reminders Management");                
  $set = '';  
  //function compare($fld,$newval,$oldval,$num=0){
  compare('subject',$subject,$rec->subject);  
  compare('message',$message,$rec->message);  
  compare('frequency',$frequency,$rec->frequency);  
  compare('startdate',$begindate,$rec->startdate);  
  compare('enddate',$enddate,$rec->enddate);  
  if ($set == '')  
    return xajaxAlert("Record not update. Nothing changed.", "Reminders Management");                
  
  
  $sql  = "update reminders set subject='$subject',message='$message',frequency='$frequency',";  
  $sql .= "startdate='$begindate',enddate='$enddate' where id = $current_record_id";  
  QueryLog("ReminderUpdate: "."-".$sql);
  $db->query($sql);
  if ($db->rows_affected < 1)
    return xajaxAlert("Reminder Update Failed", "Reminders Management");              
  else
    return xajaxAlert("Reminder Updated", "Reminders Management");    

}

function DisplayReminder($dta)
{
  global $db, $resp;
  $id = $dta['current_record_id'];  
  $sql = "select * from reminders where id = $id";  
  $res = $db->get_row($sql);  
  if (!$res)  
      return xajaxAlert("Reminder Record Not Found", "Reminders Management");
  $resp->assign("sfrequency","innerHTML", FrequencyList($res->frequency));  
  $resp->assign("subject","value",$res->subject);  
  $resp->assign("message","value",$res->message);  
  $resp->assign("begindate","value",$res->startdate);  
  $resp->assign("enddate","value", $res->enddate);  
  return $resp;
}

function DeleteReminder($dta)
{
  global $db, $resp;
  extract($dta);
  $id = $current_record_id;  
  $sql = "select * from reminders where id = $id"; 
  $res = $db->get_row($sql);  
  if (!$res)  
    return xajaxAlert("Record Not Found to Delete", "Reminders Management");    
  $sql = "delete from reminders where id = $id";  
  QueryLog("Reminder Delete: - ".$sql);
  $db->query($sql);
  if ($db->rows_affected > 0)
    return xajaxAlert("Record Deleted", "Reminders Management");        
  else  
    return xajaxAlert("Delete Failed", "Reminders Management");    

}
//Edit procedure dispatcher.
function processEdit($op, $dta)
{
  global $resp;
  $resp = new xajaxResponse();
  if ($op == 'update')
  	return UpdateReminder($dta);
  else if ($op == 'delete')
  	return DeleteReminder($dta);
  else if ($op == 'insert')
  	return AddReminder($dta);
  else if ($op == 'list')
    return ReminderList();
  else if ($op == 'read')
    return DisplayReminder($dta);
  else
  	return xajaxAlert("Invalid edit operation code: $op","Edit Request Failure");
}


//$xajax->configure('debug',true); //xajax debugger on/off control. Uncomment to turn on...
$xajax->register(XAJAX_FUNCTION,'processEdit');
$xajax->register(XAJAX_FUNCTION,'DisplayReminder');
$xajax->processRequest();
$smarty->assign("freqlist", FrequencyList());
GenerateSmartyPage();
?>