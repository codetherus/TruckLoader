<?php
/*
  This page is to be included on pages that handle
  the tickler overlay. 
  It contains the code to do the edit operations
  Zend/Google Calendar interface version.
*/
include("includes/zend_calendar_procs.php");
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
//2/4/11 - Use the Google calendar full text search
function GetReminders($did = '', $lid=''){
  global $service;
  Authenticate();
  $driver = GetDriver($did);
  $drivername = $driver->name;
  $gdataCal = MakeCalendar();
  $query = $gdataCal->newEventQuery();
  $query->setUser('default');
  $query->setVisibility('private');
  $query->setProjection('full');
  $query->setQuery($drivername);
  try{
    $eventFeed = $gdataCal->getCalendarEventFeed($query);
  }
  catch (Zend_Gdata_App_Exception $e) {
     return 'Error: '.$e->getMessage();
  }
  $s = '';
  foreach ($eventFeed as $event) {
    $title = $event->title;
    $title = str_ireplace($drivername,'',$title);
    $title=trim($title);
    foreach ($event->when as $when){
      $starttime = $when->startTime;
    }
    //Civilize the time and date
    $i = strpos($starttime,'T');
    $starttime = substr($starttime,0,$i) .' '.substr($starttime,$i+1,8);
    $s .= $title.' '.$starttime."\r";
  }
  return $s;
}


// ---------------------------- Zend interface procedures ----------------------------
function EventCreate($dta){
  Authenticate();
  $resp = new xajaxResponse();
  extract($dta);
  $eventtitle = $tdriver.' '.$eventtitle; //Add driver name for searches later.
  //break out the startdate/time string
  if ($startdate != ''){
    $i = strpos($startdate,' ');
    $starttime = substr($startdate,$i+1);
    $startdate = substr($startdate,0,$i);
  }
  else{
    $starttime='00:00';
    $startdate = date('Y-m-d');
  }
  //Same for the end date/time
  if ($enddate != ''){
    $i = strpos($enddate,' ');
    $endtime = substr($enddate,$i=1);
    $enddate = substr($enddate,0,$i);
  }
  else{
    $enddate = date('Y-m-d');
    $endtime = '23:59';
  }
  $eventid = createEvent($eventtitle,$desc,$where,$startdate,$starttime,$enddate,$endtime,$calendarid);
  if (strpos($eventid,'Error:'))
    $resp->alert($eventid);
  else{
    $resp->assign("eventid","value",$eventid);
    $resp->alert('Event created...');
    return $resp;
  }
}

//Generate and display a table of events
//All or in a date range
function EventList($dta){
  Authenticate();
  $resp = new xajaxResponse();
  extract($dta);
  if (!isset($usedates)) $usedates = 'no';
  if ($usedates != 'yes')
    $s = outputCalendar($calendarid);
  else
    $s = outputCalendarByDateRange($startdate,$enddate,$calendarid);
  if (strpos($s,'Error:'))
    $resp->alert($s);
  else
    return GenFloatbox($s);
  return $resp;
}
//Display an event using the id from the client.
function EventDisplay($dta){
  Authenticate();
  extract($dta);
  $resp = new xajaxResponse();
  global $service;
  try{
    $event = $service->getCalendarEventEntry($eventid);
  }
  catch (Zend_Gdata_App_Exception $e) {
    $resp->alert('Error: '.$e);
    return $resp;
  }
  //Successful get...
  $resp->assign("eventtitle","value", $event->title->text);
  $resp->assign("remessage","innerHTML", $event->content->text);
  $where = $event->where[0]->valueString;
  $resp->assign("where","value",$where);
  foreach($event->when as $when){
  $resp->assign("startdate","value",$when->startTime);
  $resp->assign("enddate","value",$when->endTime);
  }
  return $resp;
}
//Remove an event record.
function EventDelete($dta){
  Authenticate();
  extract($dta);
  $resp = new xajaxResponse();
  //$eventid = str_replace('http','https',$eventid);
  global $service;
  try{ 
  $event = $service->getCalendarEventEntry($eventid);
  $event->delete();
  }
  catch (Zend_Gdata_App_Exception $e) {
    $resp->alert('Error: '.$e);
    return $resp;
  }
  $resp->alert('Event Deleted...');
  return $resp;
}
//Update an event record.
function EventUpdate($dta){
  global $service;
  Authenticate();
  extract($dta);
  $resp = new xajaxResponse();
  $newEvent = $service->getCalendarEventEntry($eventid);
  $newEvent->title = $gdataCal->newTitle($eventtitle);
  $newEvent->where = array($gdataCal->newWhere($where));
  $newEvent->content = $gdataCal->newContent("$desc");
  $when = $gdataCal->newWhen();
  $when->startTime = "{$startdate}T{$starttime}:00.000-07:00";
  $when->endTime = "{$endDate}T{$endTime}:00.000-07:00";
  $newEvent->when = array($when);
  try{
    $newEvent->save();
  }
  catch (Zend_Gdata_App_Exception $e) {
    $resp->alert('Error: '.$e);
    return $resp;
  }
  $resp->alert('Event updated...');
  return $resp;
}
//Construct and insert a list of the user's calendars.
function GetCalendarList(){
  global $service;
  Authenticate();
  $resp = new xajaxResponse();
  try {
      $listFeed = $service->getCalendarListFeed();
  } catch (Zend_Gdata_App_Exception $e) {
    $resp->alert("Error: " . $e->getMessage());
    return $resp;
  }
  $s = "<select id='calendarid' name='calendarid'>\n"; 
  $s .= "<option value='default'>Default</option>\n";
  foreach ($listFeed as $calendar) {
    $id = $calendar->id->text;
    $i = strrpos($id,'/');
    $id = substr($id,$i+1);
    $s .= "<option value='$id'>$calendar->title</option\n";
  }
  $s .= "</select>\n";
  $resp->assign("calendarlistspan","innerHTML", $s);
  return $resp;
}
//Query for events on the user entered title text
function FullTextQuery($dta){
  global $service;
  Authenticate();
  $resp = new xajaxResponse();
  Extract($dta);
  $gdataCal = MakeCalendar();
  $query = $gdataCal->newEventQuery();
  $query->setUser($calendarid);
  $query->setVisibility('private');
  $query->setProjection('full');
  $query->setQuery($eventtitle);
  try{
    $eventFeed = $gdataCal->getCalendarEventFeed($query);
  }
  catch (Zend_Gdata_App_Exception $e) {
     $resp->alert('Error: '.$e->getMessage());
     return $resp;
  }
  $s =  MakeEventTable($eventFeed);
  $resp->assign("eventlist","innerHTML",$s);
  return $resp;
}
//Dispatcher
function ProcessReminder($op, $dta){
  if ($op == 'update')
  	return UpdateReminder($dta);
  else if ($op == 'delete')
  	return DeleteReminder($dta);
  else if ($op == 'insert')
  	return EventCreate($dta);
  else if ($op == 'list')
    return EventList($dta);
  else if ($op == 'read')
    return DisplayReminder($dta);
  else
  	return xajaxAlert("Invalid edit operation code: $op","Edit Request Failure");
}

$xajax->register(XAJAX_FUNCTION,'EventCreate');
$xajax->register(XAJAX_FUNCTION,'EventList');
$xajax->register(XAJAX_FUNCTION,'EventDisplay');
$xajax->register(XAJAX_FUNCTION,'EventDelete');
$xajax->register(XAJAX_FUNCTION,'GetCalendarList');
$xajax->register(XAJAX_FUNCTION,'FullTextQuery');
$xajax->register(XAJAX_FUNCTION,'ProcessReminder');