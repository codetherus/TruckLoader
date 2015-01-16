<?php
/*
  8/18/14
  First pass at Google Maps Engine interface:
  
  Updating the Google maps by uploading a csv created from
  the selected trucks

  1. We download the current map/layer features first.
  2. Then we get the active drivers within a delivery-date range from our database.
  3. Each driver from the db is sought in the features info.
  4. If not found, it is added to the barch list as a new feature.
  5. If it is found it is updated iif the delivery location and/or date has changed.
  6. If any output is created we upload it to the map

  
  This page is derived from the truckstop interface basic methods. 
*/

//System commons/configuration
require_once("commons.php");
ob_end_flush(); //Undo setting in commons

//Load our authentication procedures
require 'gme_authentication.php';

//Add the source directory of the gapi to the include path
set_include_path("gapc/src/" . PATH_SEPARATOR . get_include_path());
require_once 'Google/client.php';


//Authentication
require_once 'gapc/app_keys.php';
$client = new Google_Client();
$client->setApplicationName('API Project');

$client->setClientId($clientId);
$client->setClientSecret($clientSecret);
$client->setRedirectUri('http://localhost/Truck%20Loader/maps_engine_interface.php');
$client->setScopes('https://www.googleapis.com/auth/mapsengine');


//Have we been called by the auth callback?
if (isset($_GET['code'])) {
  $client->authenticate();
  $_SESSION['token'] = $client->getAccessToken();
  echo 'Token: '.$_SESSION['token'].'</br>';
  $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
  header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
  echo 'Redirected from authentication call...';
}
else
{
	echo 'No code in GET...';
}	

if (isset($_SESSION['token'])) {
  $client->setAccessToken($_SESSION['token']);
}

//End of Authentication

//System utilities
require_once("utilityV2.php");

//Date range objects
$fromdate = new DateTime();
$todate   = new DateTime();

$delay = 600; //Delay between cycles (Seconds) Should be in a config or db

//A list of our truck ids currently on the maps
//See GetOurTrucks();
$ourtrucks = array();
$output = array(); //Upload data
//Do the date range at the start of each cycle.
//We want delivery dates from 2 days prior to 5 days after the current date
//Called from the main loop at the end of the page.
function SetDateRange()
{
  global $fromdate, $todate;
  $fromdate->modify("-2 day"); //2 days ago.
  $fromdate->SetTime(0,0,0);
  $todate->modify("+5 day");
  $todate->SetTime(23,0,0);
}

/*
	Will use to read the current drivers on the map.
*/
function GetOurTrucks(){
  global $ourtrucks;
  return true;
}
//Main function
//1. Download the features
//2. Select the active trucks
//3. Upload any updates - change in location or delivery date
function UpdateTheMap()
{
  echo 'Starting map update<br/>';
  global $ourtrucks, $output;
  global $db,$res, $fromdate, $todate; 
  
  //Load a list of our trucks currently on the map.
  if(!GetOurTrucks()){
    echo 'Failed to download drivers from map...';
    return;
  }

  $debugging = false; //Controls debug output to the browser
  $oid = 1;//$_SESSION['officeid']; //Will filter by office
  $output = array(); //Cleanup the output array	
  
  $fd = $fromdate->format('Y-m-d');
  $to = $todate->format('Y-m-d');
  $td = $todate->format('Y-m-d');	

  //Query our local drivers and loads from this office
  //where the drivers are active and delivery date is in
  //the date range.
  $sql  = "select drivers.*, loads.* ";
  $sql .= "from drivers,loads ";
  $sql .= "where drivers.status = 'Active' and drivers.officeid = $oid";
  $sql .= " and drivers.loadid = loads.id";
  $sql .= " and loads.delivery_date >= '$fd'";
  $sql .= " and loads.delivery_date <= '$td'";
  echo $sql;
  $res = $db->get_results($sql);
  if (!$res){
    echo '<h2>No Trucks Qualify at This Time...</h2>';
    return;
  }
  $s = "gx_location,Driver Name,Destination,Unload Date,Equipment,ID\n";
  $output[] = $s;
  foreach ($res as $rw)
  {
      if ($rw->ttype == '')							//No equipment, no go...
      {
        continue;
      }
	  //Grab the pieces we need	
      $id 			= 	$rw->driverid;			//Driver table id from the load record
	  $unload_dest  =   $rw->delivery_location; //Text location
	  $location 	= 	$rw->delivery_location; //geocoded location
	  if(strpos($location,','))
		$location = '\"'.$location.'\"';		//Must quote if a comma is embedded
      $driver 		= 	$rw->name;				//Driver name from the driver record
	  $unload_date  = 	$rw->delivery_date;		//Delivery date from te load record        
      $ttype 		= 	$rw->ttype;				//Equipment from the driver record
	  
	  $s = $location.','.$driver.','.$unload_dest.','.$unload_date.','.$ttype.','.$id."\n";
	  $output[] = $s;
  }	 
  //Anything to upload?
  if(count($output))
  {
	SendUpdates();
  }
}

//Perform the upload to the map
function SendUpdates()
{
	$fh = fopen('map.csv','w');
	if(!$fh)
	{
	  echo 'Unable to open csv file!';
	  return;
	}
	foreach($output as $rec)
	{
		$s = $rec."\n";
		fwrite($fh, $s);
	}
	fclose($fh);
}

//Control loop. Cycles then sleeps then does it again... 	
while (true)
{
  SetDateRange();
  UpdateTheMap();
  echo "Pass complete...";
  die;
} 	

