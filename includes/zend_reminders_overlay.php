<?php
/*
  This page is to be included on pages that handle
  the tickler overlay. 
  This contains the Google calendar interface processing.
  It was copied from the original reminders php and moded to
  use the Google calendar api via the Zend framework.

*/
//Zend Gdata procs
include("includes/zend_calendar_procs.php");

//---------------------------- Local functions - not zend --------------------------
//Get the user's calendar html and add it to the response assigns.
//Used to refresh after modifications.
//This is used for the Google formatted calendar display.
//Users must set the html up using their Google calendar setup pages.
//You may need to do it for them.
//Look in the users table...
function GetUserCalendars(){
  $userrec = ReadUserRec();
  $resp = new xajaxResponse();
  $resp->alert(print_r($userrec,true));
  $resp = new xajaxResponse();
  $s = "<center><br/>
        <input type='button' onclick='toggleCalendar();' value='Close'/>
        <input type='button' onclick='xajaxGetUserCalendars();' value='Refresh'/>
        </center><br/>".$userrec->calendar_html;
  $resp->assign("usercalendar","innerHTML", $s);
  return $resp;
}

//Gen a floatbox list of the users reminders 
function ReminderList($dta){
  extract($dta);
  Authenticate();
  $s = OutputCalendar();
  return GenFloatbox($s);
}

//Convert a yyyy-mm-dd hh:mm to an ISO d/t
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
     return xajaxAlert('Error: '.$e->getMessage());
  }
  $resp->loadCommands(xajaxAlert('Event updated...'));
  $resp->loadCommands(GetUserCalendars());
  return $resp;

}

//Fill out the reminders box for displays
//10/22/10 - Filter on the driver id
//Called by drivers and loads pages.
//2/6/11 - Using google calendars feed
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

//Create an event using the client form values.
function EventCreate($dta){
  Authenticate();
  $resp = new xajaxResponse();
  extract($dta);
  $i = strpos($startdate,' ');
  $starttime = substr($startdate,$i+1);
  $startdate = substr($startdate,0,$i);
  $i = strpos($enddate,' ');
  $endtime = substr($enddate,$i+1);
  $enddate = substr($enddate,0,$i);
  $title = $tdriver.' '.$eventtitle;
  $eventid = createEvent($title,$desc,$where,$startdate,$starttime,$enddate,$endtime);
  $resp->assign("eventid","value",$eventid);
  $resp->loadCommands(xajaxAlert('Event created...'));
  $resp->loadCommands(GetUserCalendars());
  return $resp;
}

//Remove an event. It's is in the $eventid variable
//from the client.
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
     return xajaxAlert('Error: '.$e->getMessage());
  }
  $resp->loadCommands(xajaxAlert('Event Deleted...'));
  //Refresh the calendar display.
  $resp->loadCommands(GetUserCalendars());
  return $resp;
}

//Construct and insert a list of the user's calendars
//using the Google calendar list feed.
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
  //Build the calendar select 
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
//
function FullTextQuery($dta){
  global $service;
  Authenticate();
  $resp = new xajaxResponse();
  Extract($dta);
  //$gdataCal = MakeCalendar();
  $query = $service->newEventQuery();
  $query->setUser($calendarid);
  $query->setVisibility('private');
  $query->setProjection('full');
  $query->setQuery($eventtitle);
  try{
    $eventFeed = $service->getCalendarEventFeed($query);
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
$xajax->register(XAJAX_FUNCTION,'GetUserCalendars');
$xajax->register(XAJAX_FUNCTION,'FullTextQuery');