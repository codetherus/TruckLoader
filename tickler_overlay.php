<?php
/*
  This page is to be included on pages that handle
  the tickler overlay. 
  It contains the code to do the edit operations
*/
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
//Using the submitted data, read the driver and load and 
//return their id values.
function GetDriverAndLoadId($dta,&$did,&$lid){
  $did = -1; //Assume not found...
  $lid = -1;
  extract($dta);
  if ($tdriver != ''){
    $driver = GetDriverByName($tdriver);
    if($driver) $did = $driver['id'];
  }
  if ($tload != ''){
  $load = GetLoadByNumber($tload);
  if($load) $lid = $load->id;
  }
}

//New reminder insert
function AddReminder($dta)
{
  global $db, $resp;
  $id = $_SESSION['userid'];
  $lid='';
  $did='';
  GetDriverAndLoadId($dta,$did,$lid);
  extract($dta);
  $sql  = "insert into reminders(userid, subject,message,frequency,startdate,enddate,driverid,loadid) ";
  $sql .= "values($id,'$subject','$rmsgtext','$frequency','$begindate','$enddate',$did,$lid)"; 
  QueryLog("Reminder"."-".$sql);  
  $db->query($sql);  
  if ($db->rows_affected > 0)  
    return xajaxAlert("Reminder Created", "Reminders Management");    
  else  
    return xajaxAlert("Reminder Creation Failed", "Reminders Management");    
}

function UpdateReminder($dta)
{
  global $db, $set;

  extract($dta);
  $lid='';
  $did='';
  GetDriverAndLoadId($dta,$did,$lid);
      
  $sql = "select * from reminders where id = $current_record_id";  
  $rec = $db->get_row($sql);  
  if (!$rec)
    return xajaxAlert("Reminder Update Failed. Record not located.", "Reminders Management");                
  $set = '';  
  //function compare($fld,$newval,$oldval,$num=0){
  compare('subject',$subject,$rec->subject);  
  compare('message',$rmsgtext,$rec->message);  
  compare('frequency',$frequency,$rec->frequency);  
  compare('startdate',$begindate,$rec->startdate);  
  compare('enddate',$enddate,$rec->enddate);
  compare('driverid',$driverid,$did,1);
  compare ('loadid',$loadid,$lid,1);  
  if ($set == '')  
    return xajaxAlert("Record not updated. Nothing changed.", "Reminders Management");                
  
  
  $sql  = "update reminders set subject='$subject',message='$remessage',frequency='$frequency',";  
  $sql .= "startdate='$begindate',enddate='$enddate' where id = $current_record_id";  
  QueryLog("ReminderUpdate: "."-".$sql);
  $db->query($sql);
  if ($db->rows_affected < 1)
    return xajaxAlert("Reminder Update Failed", "Reminders Management");              
  else
    return xajaxAlert("Reminder Updated", "Reminders Management");    

}
function GetDriverAndLoadNumbers($res,&$dname,&$loadnum){
  $dname='';
  $loadnum='';
  $driver= GetDriver($res->driverid);
  if($driver) $dname = $driver->name;
  $load = GetLoad($res->loadid);
  if($load) $loadnum = $load->load_number;
}
function DisplayReminder($dta)
{
  global $db;
  $resp=new xajaxResponse();
  $id = $dta['current_record_id'];  
  $sql = "select * from reminders where id = $id";  
  $res = $db->get_row($sql);  
  if (!$res)  
      return xajaxAlert("Reminder Record Not Found", "Reminders Management");
  $dname='';
  $loadnum='';
  GetDriverAndLoadNumbers($res,$dname,$loadnum);
  
  $resp->assign("sfrequency","innerHTML", ReminderFrequencyList($res->frequency));  
  $resp->assign("subject","value",$res->subject);  
  $resp->assign("remessage","value",$res->message);  
  $resp->assign("begindate","value",$res->startdate);  
  $resp->assign("enddate","value", $res->enddate); 
  $resp->assign("tdriver","value",$dname);
  $resp->assign("tload","value",$loadnum); 
  return $resp;
}

function DeleteReminder($dta)
{
  global $db;
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

//Fill out the reminders box for displays
//10/22/10 - Filter on the driver id
//Called by drivers and loads pages.
function GetReminders($did = '', $lid=''){
  global $db;
  $uid = $_SESSION['userid'];
  $sql = "select * from reminders";
  $where = " where userid = $uid ";
  if ($did != '' || $lid !=''){
     $where .= " and (";
     if ($did != '')
      $where .= "driverid = $did ";
     if ($lid != '' && $did != '')
        $where .= " or loadid = $lid";
     else
        $where .= " and loadid = $lid";
  $where .= ")";
  }
  $sql .= $where;

  $res = $db->get_results($sql);
  if (!$res) return 'No Reminders';
  $s = '';
  foreach($res as $rw){
    $nextdate = $rw->nextdate;
    if ($nextdate == '')
     $nextdate = $rw->startdate;
    $subject = $rw->subject;
    $frequency = $rw->frequency;
    $s .= "$nextdate $frequency\n $subject\n"; 
  }
  return $s;
}


//Dispatcher
function ProcessReminder($op, $dta){
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
$xajax->register(XAJAX_FUNCTION,'ProcessReminder');