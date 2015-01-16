<?php
/*
  These functions and variables constitute the
  LBJ Google calendar inderface using the
  Zend gData librarys.
*/
//Alter the PHP include path for the Zend API calls
//Must be altered for the site location.
$mypath = "./Zend";
set_include_path(get_include_path() . PATH_SEPARATOR . $mypath);
//Global vars - see their use in the Authenticate function
$service = null;
$client = null;
$tzoffset = date('P'); //Users timezone offset...
// --------------------------- Zend Gdata Interface Routines ------------------------------
//Load the loader tool class
require_once($mypath.'\Loader.php');
//Load the other requisite API classes
Zend_Loader::loadClass('Zend_Gdata');
Zend_Loader::loadClass('Zend_Gdata_AuthSub');
Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
Zend_Loader::loadClass('Zend_Gdata_Calendar');

//Authentication - Logs the user and obtains a calendar object.
function Authenticate(){
  global $service, $client,$db;
  $userrec = ReadUserRec();    
  $user = $userrec->google_id;
  $pass = $userrec->google_password;
  $serviceName = Zend_Gdata_Calendar::AUTH_SERVICE_NAME; // predefined service name for calendar
  $client = Zend_Gdata_ClientLogin::getHttpClient($user,$pass,$serviceName);
  $service = new Zend_Gdata_Calendar($client); 
}
//Central calendar object creation
function MakeCalendar(){
  global $client;
  return new Zend_Gdata_Calendar($client);
}
//Using the passed event feed, generate a table of the events.
//Standardizes the event list displays...
function MakeEventTable($eventFeed){
  ob_start();
  echo "<table border='1' style='border-collapse: collapse; color: black;'>\n";
  foreach ($eventFeed as $event) {
    $link = "<a href='#' onclick=\"readEvent('$event->id')\">Read</a>\n"; 
    $link2 = "<a href='#' onclick=\"deleteEvent('$event->id')\">Delete</a>"; 
    echo "<tr><td>$link</td><td>$link2</td><td>$event->title</td>\n";
    foreach ($event->when as $when) {
      echo "<td>$when->startTime</td>\n";
      echo "</tr>\n";
    }
  }
  echo "</table>\n";
  $s = ob_get_clean();
  return $s;
}  
//Output all evants with no regard for the dates.
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
  global $service;
  $newEvent = $service->newEventEntry();
  global $service,$tzoffset;
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
?>