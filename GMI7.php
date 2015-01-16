<?php
/*
	11/12/14
	File: GMI7.php (Google Maps Interface V2)
	
	This version introduces JUI tabs.
	Two tabs; The original for drivers,
	brokers and customers and the second
	to be used to track drivers...
	This page runs the LBJ Google Map
	to track the drivers, customers
	and brokers.
	
	It implements the Google Maps API.
	
	The javascript file scripts/GMI7_php.js contains
	the client side logic.
*/
include 'simple_commons.php'; //Commons without the login check and service functions
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
/*Get the drivers informtion
	1. Query the database for active drivers
	2. Scan them for good map candidates
	3. Create a structure we can use to
	   create the marker output to the page
	Originally used to send CSV to the map...
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
  $sql .= " order by drivers.name";
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
	  
	  if(!geocoded) continue; //Must have a valid destination.
	  
	  $lat = $geocoded['lat'];
	  $lon = $geocoded['lng'];
	  
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

//Retrieve the brokers/customers
//for the refresh function
function getMapBrokers()
{
	global $db;
	$sql = "select * from map_brokers order by 'name'";

	$res = $db->get_results($sql,ARRAY_A);
	$brokers = array();
	foreach($res as $rw)
	{
		//Geocode this row
		$dest = $rw['city'].', '.$rw['state'];
		$loc = geocodeDestination($dest);
		
		$arr = array();
		foreach($rw as $key => $val)
		{
			$arr[$key] = $val;
		}
		$arr['lat'] = $loc['lat'];
		$arr['lng'] = $loc['lng'];
		$brokers[] = $arr;
	}
	return json_encode($brokers);
}
	
//--------------------- End Data Aquisition ----------------------------------------

//Main map processing handler - registered XAJAX function
//Constructs an array of drivers and another of brokers and customers
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
	$drivers = json_encode($res);
	$brokers = getMapBrokers();
	$script= "setupMap($drivers, $brokers)";
	$resp->script($script);
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
	<link href="styles/jquery.splitter.css" rel="stylesheet"/>
	<script type="text/javascript" src="scripts/jquery.splitter.js"></script>
	<script type='text/javascript' src='https://maps.googleapis.com/maps/api/js?v=3.exp'</script>
	<?php $xajax->printJavascript(); ?>
 
 <style>
      html, body{
        height: 99%;
        margin:  0px;
        padding: 0px;
		background: white;
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
		height: 98%;
		width: 100%
	  }
	  #track-controls, #drivers-controls{
		height 20px;
		color: white;
	  }
	  
    </style>
  </head>
  <body>
   <div class="thesplitter">
	<div id=mapdiv style="background: blue;">
	<div id="drivers-controls">
	  <input type="button" class="btn" value="Refresh" onclick="xajax_mapRefreshRequest()"/>
	  <div id="driversdropdowndiv" class="groupstyle" ></div>
	  <div id="customersdropdowndiv" class="groupstyle"></div>  
	  <div id="brokersdropdowndiv" class="groupstyle"></div>
	</div>  
	<div id="map-canvas" class="mapcontainer"></div>
	</div>
	<div id="tracking" style="background: green;">
	  <div id="track-controls" style="background: red;">Track controls</div>
	  <div id="track-map-canvas" class="mapcontainer" style="border-top: solid 3px black;"></div>
   </div>	
	
   </div>
  </body>
  <script type="text/javascript" src = "scripts/GMI7_php.js"></script>		
</html>