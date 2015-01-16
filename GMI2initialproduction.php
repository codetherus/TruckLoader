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
  global $db;
  $dest = strtoupper($dest);
  $dest = str_replace('<',',',$dest);
  $sql = "select lat, lon from zip_code where location = '$dest'";
  $rw = $db->get_row($sql);
  if(!$rw)
  {
	return false;
  }
  return array('lat' => $rw->lat, 'lng' => $rw->lon);
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
  $sql .= "where drivers.status = 'Active'"; 
  $sql .= " and loads.id = drivers.loadid";
  
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
	  
	  if(!geocoded) continue;
	  
	  $lat = $geocoded['lat'];
	  $lon = $geocoded['lng'];
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
	  //Grab the driver id prime key
	  $id = $rw->driverid;
	  //Construct the CSV row
	  $csv = $driver.'|'.$location.'|'.$unload_date.'|'.$ttype.'|'.$id.'|'.$lat.'|'.$lon;
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
		$arr = array('driver'=>$parts[0],
					 'loc'=>$parts[1],
					 'unload'=>$parts[2],
					 'ttype'=>$parts[3],
					 'did'=>$parts[4],
					 'lat'=>$parts[5],
					 'lng'=>$parts[6]);
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
    <!--<meta http-equiv="refresh" content="300" >-->
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type='text/javascript' src='https://maps.googleapis.com/maps/api/js?v=3.exp'</script>
	<?php $xajax->printJavascript(); ?>
    <style>
      html, body, #map-canvas {
        height: 100%;
        margin:  0px;
        padding: 0px
      }
	  .iwdiv{
		height: 100px;
	  }
	  #refresh{
		position: absolute; 
		z-index: 60000;
		top: 0px; 
		left:0px;
		background: black;
	  }
    </style>
  </head>
  <body>
    <div id="map-canvas"></div>
  </body>
  <script>
		jQuery(document).ready(function(){
			initialize();
		})
			
	var map;	//Global map object
	var markers = []; //Marker array
	var infoWindow = new google.maps.InfoWindow(); //One info window for all markers
	var timerId;
	var refreshInterval = (60 * 1000) * 10; //10 minutes
	
	//Setup the map and call the xajax function to load the markers
	function initialize() {
	  $("#refresh").hide();
	  var mapOptions = {
		zoom: 5,
		center: new google.maps.LatLng(39.50, -98.35),
		disableDefaultUI: true
	  };

	   map = new google.maps.Map(document.getElementById('map-canvas'),
		  mapOptions);
		google.maps.event.addListener(map,"click", function(e){infoWindow.close();});
	   xajax_mapRefreshRequest(); //Setup the markers
	 }

	 //Run a timer to refresh the markers
	function setNextRefresh()
	{
		//alert('starting timer');
		timerId = setTimeout(function(){xajax_mapRefreshRequest();}, refreshInterval);	//refresh in x ms
	}

	//Callback for the xajax function.
	//markerdata is the array of driver/marker data.
	function buildMarkers(markerdata)
	{
	   $("#refresh").show();
	   //alert('in biuld markers');
	   deleteMarkers(); //Clear the markers
	   for(i=0;i<markerdata.length;i++)
		{
			var md = markerdata[i];
			driver = md.driver;
			pos = new google.maps.LatLng(md.lat, md.lng);
			dest = md.loc;
			ttype = md.ttype;
			unload = md.unload;
			id = md.did;
			var marker = new google.maps.Marker(
			{
				position: pos,
				//map: map,
				cursor: 'default',
				icon: 'images/red-dot.png',//truck-2.png',
				description: '<div class="iwdiv">Driver: '+ driver +'<br> Destination: ' + dest +'<br>Equipment: '+ttype+'<br>Delivery Date: '+unload+'<div>',
				did: id
			});
			//Closure function to insure each marker has it's own info window data
			(function(marker) {
			  // Attaching a click event to the current marker
				google.maps.event.addListener(marker, "click", function(e) {
				infoWindow.setContent(marker.description);
				infoWindow.open(map, marker);
			  });
			  
			})(marker);
			markers.push(marker); //save for refresh later	
		}
		setAllMap(map);
		$("#refresh").hide();
		setNextRefresh();
	}

	// Sets the map on all markers in the array.
	function setAllMap(map) {
	  for (var i = 0; i < markers.length; i++) {
		markers[i].setMap(map);
	  }
	}

	// Removes the markers from the map, but keeps them in the array.
	function clearMarkers() {
	  setAllMap(null); //Remove the map pointer
	}

	// Shows any markers currently in the array
	// by asigning them to the map.
	function showMarkers() {
	  setAllMap(map);
	}

	// Deletes all markers in the array by removing references to them.
	function deleteMarkers() {
	  clearMarkers(); //Null out the markers
	  markers = []; //Empty the array
	}
</script>

</html>