<?php
/*
	10/17/2014
	GMI.php
	This page is going to be the main page for our Google Maps Interface
*/
include 'commons.php';
//--------------------- Begin Data Aquisition ----------------------------------------
//Given a string, quote it if it contains a comma
function CheckDelimiter(&$s)
{
	if(strpos($s,','))
	{
		//if (strpos($s,'"'))
		//  $s = str_replace('"','', $s);
		//$s = '"'.$s.'"';
	}
}

//Given a city, state string, geocode it
//Returns the latitude and longitude of the location
function geocodeDestination($dest)
{
  $key = "&key=AIzaSyC10co4w836tGCev1KISYnp-_ZykPyL-IU"; //My API Key
  $dest = urlencode($dest);
  //Form the geocoder request url
  $url = "https://maps.googleapis.com/maps/api/geocode/json?address=".$dest."&output=csv".$key;
  //Get its response
  $data = file_get_contents($url);
  $parts = json_decode($data,true);
  $lat = $parts['results'][0]['geometry']['location']['lat'];
  $lng = $parts['results'][0]['geometry']['location']['lng'];
  //echo $lat.'  '.$lng.'<br>';
  return array('lat' => $lat, 'lng' => $lng);
}

/*Main function
	1. Query the database for active drivers
	2. Scan them for good map candidates
	3. Create a structure we can use to
	   create the marker output to the page
*/
function GetDrivers()
{
  //echo '<h5>Generating upload file</h5>';
  global $db, $fromdate, $todate; 
  global $res,$db,$excel, $qry;    
  $heads  = "geometry,Driver Name,Delivery Location,Delivery Date,Equipment\n";
  
  $sql  = "select loads.*, drivers.* ";
  $sql .= " from loads, drivers ";
  $sql .= "where drivers.status = 'Active'"; //and drivers.officeid = $oid";
  $sql .= " and loads.driverid = drivers.id";
  
  //fwrite($hdl,$sql."\n\n");

  $res = $db->get_results($sql);
  $nrows = $db->num_rows;
  if($nrows < 1)
  {
	return false;
	
  }
  $output = array(); 	
  //Generate the contents.
  
  foreach ($res as $rw)
  {
      $s = '';
	  //Driver's destination - Delivery Location in the api table
      $location = $rw->delivery_location;
	  $geo = $location; //For Geocoding
	  CheckDelimiter($location);
	  $geocoded = geocodeDestination($geo);
	  //echo $geocoded;
	  $geometry = $geocoded['lng'].' '.$geocoded['lat'];
	  //CheckDelimiter($geocoded);
      //The driver's name - Driver Name in the api table
	  $driver = $rw->name;
	  CheckDelimiter($driver);
      
	  //Delivery date - Delivery Date in the api table
	  $unload_date = $rw->delivery_date;        
      CheckDelimiter($unload_date);
	  //Truck type - Equipment in the api table
	  $ttype = $rw->ttype;
	  if($ttype == 'Dont Know') continue;
	  CheckDelimiter($ttype);
	  
	  
	  //Be sure we have a valid delivery date
	  $ddate = $rw->delivery_date;
	  if($ddate == '0000-00-00') continue;
	  
	  //Construct the CSV row
	  $csv = $geometry.'|'.$driver.'|'.$location.'|'.$unload_date.'|'.$ttype."\n";
	  //Add it to the result array
	  $output[] = $csv;
    } 
	return $output;
}
//--------------------- End Data Aquisition ----------------------------------------
//Main map processing handler
function mapRefreshRequest()
{
	$resp = new xajaxResponse();
	$results = getDrivers();
	if(!$results)
	{
		$resp->alert('Failed to get driver info....');
		return $resp;
	}
	$res = array();
	foreach($results as $item)
	{
	    
		$parts = explode('|',$item);
		$arr = array('geo'=>$parts[0],'driver'=>$parts[1],'loc'=>$parts[2],'unload'=>$parts[3],'ttype'=>$parts[4]);
		$res[] = $arr;
	}
	$results = json_encode($res);
	$resp->script('buildMarkers('.$results.')');
	return $resp;
}
$xajax->register(XAJAX_FUNCTION,'mapRefreshRequest');
$xajax->processRequest();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Loads by Jake Google Maps</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<?php $xajax->printJavascript(); ?>
    <style>
      html, body, #map-canvas {
        height: 100%;
        margin:  0px;
        padding: 0px
      }
    </style>
    <script>
    jQuery(document).ready(function(){
		xajax_mapRefreshRequest();
	});
function initialize() {
  
  var mapOptions = {
    zoom: 5,
    center: new google.maps.LatLng(41.22, -101.5)
  };

  var map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);
  ll = new google.maps.LatLng(44.489639, -115.668873);
  //pr = new map.Data.setProperty('Driver','Dave Brooks')
  //p1 = new google.maps.Data.Feature();//google.maps.Data.Geometry(ll),pr);
  //p1.setProperty('Driver', 'Dave Brooks');  
  var marker = new google.maps.Marker({
      position: ll,
      map: map,
	  cursor: 'default',
      title: 'Driver: Dave Dean\rDestination: Dallas Texas\rEquipment: Flat Bed\nDelivery Date: 10/20/2014',
	  icon: 'images/truck-2.png'
  });
}

//Function to handle the xajax call to get the driver data.
//markerdata is an array of comma delimited strings of the form:
//$csv = $geometry.','.$driver.','.$location.','.$unload_date.','.$ttype."\n";
//The geometry is in the form lng lat
//driver is the drivers name
//location is the destination of the driver
//unload_date is astring as YYYY/MM/DD
//ttype is the truck type
function buildMarkers(markerdata)
{
 alert('in buildMarkers');
 markerd = JSON.parse(markerdata);
 alert(markerd.length);
 jQuery.each(markerd),function(i,md){
	alert(md.driver);
	return;
  }	
}
  
 //drivers = JSON.parse(markerdata); 
 //alert(drivers);

function loadScript() {
  var script = document.createElement('script');
  script.type = 'text/javascript';
  script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&' +
      'callback=initialize';
  document.body.appendChild(script);
}

window.onload = loadScript;

    </script>
  </head>
  <body>
    <div id="map-canvas"></div>
  </body>
</html>