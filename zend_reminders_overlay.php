<?php
/*
  This page is to be included on pages that handle
  the tickler overlay. 
  This contains the Google calendar interface processing
*/
include("includes/zend_calendar_procs.php");

//---------------------------- Local functions - not zend --------------------------
//Gen a floatbox list of the users reminders 
function ReminderList($dta){
  extract($dta);
  Authenticate();
  $s = OutputCalendar();
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

function FormatDateTime($rawdate){
  $dt = new DateTime($rawformat);
  return $dt->format('c');
}
//Update an existing event
function UpdateReminder($dta){
  global $service;
  Authenticate();
  extract($dta);
  $resp = new xajaxResponse();
  //$eventid = str_replace('http','https',$eventid);
  global $service;
  $newEvent = $service->getCalendarEventEntry($eventid);
  $newEvent->title = $service->newTitle($eventtitle);
  $newEvent->where = array($service->newWhere($where));
  $newEvent->content = $service->newContent("$desc");
  $when = $service->newWhen();
  $startdate = FormatDateTime($startdate); //date
  $resp->alert($startdate);
  $when->startTime = $startdate;
  $enddate = FormatDateTime($enddate);
  $when->endTime = $enddate;
  $newEvent->when = array($when);
  try{
    $newEvent->save();
  }
  catch (Zend_Gdata_App_Exception $e) {
     $resp->alert('Error: '.$e->getMessage());
     return $resp;
  }
  $resp->alert('Event updated...');
  return $resp;

}
function GetDriverAndLoadNumbers($res,&$dname,&$loadnum){
  $dname='';
  $loadnum='';
  $driver= GetDriver($res->driverid);
  if($driver) $dname = $driver->name;
  $load = GetLoad($res->loadid);
  if($load) $loadnum = $load->load_number;
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
function GetReminders($dname, $calid='default'){
  global $service;
  Authenticate();
  $query = $service->newEventQuery();
  $query->setUser($calid);
  $query->setVisibility('private');
  $query->setProjection('full');
  $query->setQuery($dname);
  try{
    $eventFeed = $service->getCalendarEventFeed($query);
  }
  catch (Zend_Gdata_App_Exception $e) {
     return 'Get Reminders Error: '.$e->getMessage().$dname.' '.$calid;
  }
  $s = '';
  foreach ($eventFeed as $event){
    $tmp = trim($event->title);
    if ($tmp == '')
      $tmp = 'No Title';
    $tmp = str_ireplace($dname,'',$tmp);
    foreach ($event->when as $when)
      $nd = MakeNormalDate($when->startTime);
    $tmp .= ' '.$nd;
    if ($s == '')
      $s = $tmp;
    else
      $s .= "\r".$tmp;
  }
  return $s;
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
  $resp->assign("remessage","value", $event->content->text);
  $where = $event->where[0]->valueString;
  $resp->assign("where","value",$where);
  foreach($event->when as $when){
  $nd = MakeNormalDate($when->startTime);
  $resp->assign("startdate","value",$nd);
  $nd = MakeNormalDate($when->EndTime);
  $resp->assign("enddate","value",$nd);
  }
  return $resp;
}
function EventCreate($dta){
  Authenticate();
  $resp = new xajaxResponse();
  extract($dta);
  $i = strpos($startdate,' ');
  $starttime = $starttime = substr($startdate,$i+1);
  $startdate = substr($startdate,0,$i);
  $i = strpos($enddate,' ');
  $endtime = substr($enddate,$i+1);
  $enddate = substr($enddate,0,$i);
  $title = $tdriver.' '.$eventtitle;
  $eventid = createEvent($title,$desc,$where,$startdate,$starttime,$enddate,$endtime);
  $resp->assign("eventid","value",$eventid);
  $resp->alert('Event created...');
  return $resp;
}

function EventDelete($dta){
  Authenticate();
  extract($dta);
  $resp = new xajaxResponse();
  //$eventid = str_replace('http','https',$eventid);
  global $service;
  $event = $service->getCalendarEventEntry($eventid);
  $event->delete(); 
  $resp->alert('Event Deleted...');
  return $resp;
}
//Get the user's calendar html and add it to the assigns.
function GetUserCalendars(){
  $userrec = ReadUserRec();
  $resp = new xajaxResponse();
  $resp->alert(print_r($userrec,true));
  $resp = new xajaxResponse();
  $s = "<center>
        <input type='button' onclick='toggleCalendar();' value='close'/>
        </center><br/>".$userrec->calendar_html;

  $resp->assign("usercalendar","innerHTML", $s);
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
  $s .= "<option value='default'>---Select Calendar---</option>\n";
  foreach ($listFeed as $calendar) {
    $id = $calendar->id->text;
    $i = strrpos($id,'/');
    $id = substr($id,$i+1);
    $s .= "<option value='$id'>$calendar->title</option\n";
  }
  $s .= "</select>\n";
  $resp->assign("calendarlistspan","innerHTML", $s);
  $resp->loadCommands(GetUserCalendars());
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
  	return EventDelete($dta);
  else if ($op == 'insert')
  	return EventCreate($dta);
  else if ($op == 'list')
    return ReminderList($dta);
  else if ($op == 'read')
    return EventDisplay($dta);
  else
  	return xajaxAlert("Invalid edit operation code: $op","Edit Request Failure");
}
$xajax->register(XAJAX_FUNCTION,'ProcessReminder');
$xajax->register(XAJAX_FUNCTION,'EventDisplay');
$xajax->register(XAJAX_FUNCTION,'EventDelete');
$xajax->register(XAJAX_FUNCTION,'EventCreate');
$xajax->register(XAJAX_FUNCTION,'GetCalendarList');
$xajax->register(XAJAX_FUNCTION,'FullTextQuery');