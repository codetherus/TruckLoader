<?php
/*
	8/9/2014
	This module implements the Google Maps Engine interface 
	for LBJ.
	
	The initial version will generate and upload a CSV of the drivers and trucks
	in the trucks display.
*/
//Add the source directory of the gapi to the include path
set_include_path("gapc/src/" . PATH_SEPARATOR . get_include_path());
//Get the Truck Loader common and utility files
require_once("commons.php");
require_once("utilityV2.php");

//Google api files
require_once("Google/Client.php");
require_once("Google/Service/MapsEngine.php");

//Our Google credentials
require_once("gapc/app_keys.php");

$driver_id_list = ''; //Our active drivers
$mapped_drivers = ''; //The drivers on the map

//Create a list of all active drivers
function loadActiveDrivers()
{
	global $db,$driver_id_list;
	$sql = "select id from drivers where status = 'Active'"
	$driver_id_list = $db->get_reslts($sql);
}

//Get a list of drivers on the map
function retrieveMappedDrivers()
{
}

//Update an existing driver's layer feature
//Param: Driver primary key from our database
function updateDriverFeature($id)
{
}
?>
