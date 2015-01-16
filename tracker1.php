<?php
/*
	11/13/14
	File: tracker1.php (Driver tracking V1)
	This page implements the Google Maps API
	reverse geocoding for use in driver tracking
	
	The api is accessed using the wrapper class by
	Justin Stayton at https://github.com/jstayton/GoogleMapsGeocoder.
	It makes things simpler...
*/

 //Commons without the login check and service functions
include 'simple_commons.php';

include 'GoogleMapsGeocoder/src/GoogleMapsGeocoder.php';
$gmg = new GoogleMapsGeocoder();

function reverseGeocodePoint($loc)
{
	global $gmg;
	$gmg->setLatitude($loc['lat']);
	$gmg->setLongitude($loc['lng']);
	$res = $gmg->geocode();
	if($res['status'] == 'OK')
		return $res['results'][2]['formatted_address'];
	else
		return 'No Address '.$res['status'];
}

//Given a driver identifier, return
//the drivers route points for plotting
function readDriverTrack($driver)
{
	global $db;
	$resp = new xajaxResponse();
	$sql = "select longitude, latitude, gpsTime from gpslocations where userName = '$driver'";
	$res = $db->get_results($sql);
	$arr = array();
	foreach($res as $rw)
	{
		$loc['lat'] = $rw->latitude;
		$loc['lng'] = $rw->longitude;
		$loc['addr'] = reverseGeocodePoint($loc);
		$loc['driver'] = $driver;
		$loc['gtime'] = $rw->gpsTime;
		$arr[] = $loc;
	}
	$locs = json_encode($arr);
	$resp->script("plotRoute($locs)");
	return $resp;
		
}
//Load the route list
function getAllRoutes()
{
	global $db;
	$resp = new xajaxResponse();
	$sql = 'select userName from gpslocations order by userName';
	$res = $db->get_results($sql);
	$s  = '<select id="routes" onchange="getRoute(this.value)">';
	$s .= '<option value="">Drivers</option>';
	$lastuser = '';
	foreach($res as $rw)
	{
		$user = $rw->userName;
		if($user != $lastuser)
		{
			$lastuser = $user;
			$s .= "<option value='$user'>$user</option>";
		}
	}
	$s .= '</select>';
	$resp->assign('routediv','innerHTML',$s);
	return $resp;
}
$xajax->register(XAJAX_FUNCTION,'readDriverTrack');
$xajax->register(XAJAX_FUNCTION,'getAllRoutes');

$xajax->processRequest();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Loads by Jake Driver Track Map</title>
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type='text/javascript' src='https://maps.googleapis.com/maps/api/js?v=3.exp?key="AIzaSyBL5nmdAh7bBajELSUnwstkcXhKZ6U1kNk"'></script>
	<?php $xajax->printJavascript(); ?>
 
 <style>
      html, body{
        height: 99%;
        margin:  0px;
        padding: 0px;
		background: black;
      }

	  /* Style the dropdowns */
	  .groupstyle{
		width: 200px;
		margin-bottom: 10px;
		margin-top: 5px;
		display: inline;
		
		margin-left: 20px;
	  }

	  /*  Info window style */
	  .iwdiv{
		 width: 205px;
	  }
	  /* Refresh button style */
	  .btn{
		margin-left: 15px;
		margin-right: 200px;
	  }
	  .mapcontainer{
		height: 99%;
		width: 100%
		margin:  0px;
        padding: 0px;

	  }
	  #track-controls, #drivers-controls{
		height 20px;
		color: white;
	  }
	  .thesplitter{
		height: 100%;
		width: 100%;
	  }
    </style>
  </head>
  <body>
	<div id="routediv">Routes</div>
	<div id="map-canvas" class="mapcontainer" ></div>
  </body>
  <script type="text/javascript" src = "scripts/tracker1.js"></script>		
</html>