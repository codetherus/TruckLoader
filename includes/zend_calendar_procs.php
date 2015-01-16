<?php
/*
  2/2011
  This file handles access to the Zend Gdata Calendar API
  It is included in the Zend reminders overlay php code file.
  Most of the code was lifted from the Zend how to pages.
*/
//Alter the PHP include path for the Zend API calls
$zendpath = './Zend';
set_include_path(get_include_path() . PATH_SEPARATOR . $zendpath);

//Global vars - see their use in the Authenticate function
$service = null;
$client = null;
$tzoffset = date('P'); //Users timezone offset...
//------------------------------------- Zend Sample Code Begin ----------------------
//Load the loader tool class
require_once($zendpath.'/Loader.php');
//Load the other requisite API classes
Zend_Loader::loadClass('Zend_Gdata');
Zend_Loader::loadClass('Zend_Gdata_AuthSub');
Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
Zend_Loader::loadClass('Zend_Gdata_Calendar');

//Authentication - Logs the user and obtains a calendar object.
//Gmail credentials are in the user table.
function Authenticate(){
  global $service, $client;
  $userrec = ReadUserRec(); //Get the logged user
  $user = $userrec->google_id;
  $pass = $userrec->google_password;
  $serviceName = Zend_Gdata_Calendar::AUTH_SERVICE_NAME;
  try{
    $client = Zend_Gdata_ClientLogin::getHttpClient($user,$pass,$serviceName);
  }
  catch (Zend_Gdata_App_Exception $e) {
     return 'Error: '.$e->getMessage();
  }
  //Global calendar instance.
  $service = new Zend_Gdata_Calendar($client); 
}

//Central calendar object creation.
//No longer used 2/10/11
function MakeCalendar(){
  global $client;
  return new Zend_Gdata_Calendar($client);
}
//Given an ISO date/time return a yyyy-mm-dd hh:mm date/time
function MakeNormalDate($s){
  $dt = new DateTime($s);
  return $dt->format('Y-m-d H:i');
}
//Using the passed event feed, generate a table of the events.
//Standardizes the event list displays...
function MakeEventTable($eventFeed){
  ob_start();
  echo "<table border='1' style='border-collapse: collapse;color: black;'>\n";
  foreach ($eventFeed as $event) {
    $readlink = "<a href='#' onclick=\"readEvent('$event->id')\">Display</a>\n"; 
    $deletelink = "<a href='#' onclick=\"deleteEvent('$event->id')\">Delete</a>"; 
    echo "<tr><td>$readlink</td><td>$deletelink</td><td>$event->title</td>\n";
    foreach ($event->when as $when) {
      $nd = MakeNormalDate($when->startTime);
      echo "<td>$nd</td>\n";
      echo "</tr>\n";
    }
  }
  echo "</table>\n";
  $s = ob_get_clean();
  return $s;
}  
//Output all events with no regard for the dates.
function outputCalendar($cid='default'){
  global $service;
  $query = $service->newEventQuery();
  $query->setUser($cid);
  $query->setVisibility('private');
  $query->setProjection('full');
  try{
    $eventFeed = $service->getCalendarEventFeed($query);
  }
  catch (Zend_Gdata_App_Exception $e) {
     return 'Error: '.$e->getMessage();
  }
  return MakeEventTable($eventFeed);
}
//List the events in a date range
//Note the start date is inclusive and the end date is exclusive.
function outputCalendarByDateRange($startDate,$endDate,$cid='default'){
  global $service;
  $query = $service->newEventQuery();
  $query->setUser($cid);
  $query->setVisibility('private');
  $query->setProjection('full');
  $query->setOrderby('starttime');
  $query->setStartMin($startDate);
  $query->setStartMax($endDate);
  try{
    $eventFeed = $service->getCalendarEventFeed($query);
  }
  catch (Zend_Gdata_App_Exception $e) {
     return 'Error: '.$e->getMessage();
  }
  return MakeEventTable($eventFeed);
}

//Make a new event
function createEvent ($title,$desc,$where,$startDate,$startTime,$endDate,$endTime,$calid='default'){
  global $service,$tzoffset;
  $newEvent = $service->newEventEntry();
  
  $newEvent->title = $service->newTitle($title);
  $newEvent->where = array($service->newWhere($where));
  $newEvent->content = $service->newContent("$desc");
  $when = $service->newWhen();
  $when->startTime = "{$startDate}T{$startTime}:00.000{$tzoffset}";
  $when->endTime = "{$endDate}T{$endTime}:00.000{$tzoffset}";
  //Setup a reminder email 10 minutesahead of time;
  $reminder = $service->newReminder();
  $reminder->method = "email";
  $reminder->minutes = "10";
  $when->reminders = array($reminder);
  $newEvent->when = array($when);
  $feeduri = $service->CALENDAR_EVENT_FEED_URI;
  $feeduri = str_replace('default',$calid,$feeduri);
  // Upload the event to the calendar server
  // A copy of the event as it is recorded on the server is returned
  try{
    $createdEvent = $service->insertEvent($newEvent, $feeduri);
    return $createdEvent->id->text;
  }
  catch (Zend_Gdata_App_Exception $e) {
     return 'Error: '.$e->getMessage();
  }

}
