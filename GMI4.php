<?php
/*
	10/19/2014
	GMI3.php
	This page is going to be the main page for our Google Maps Interface.
	This is V3 in which we will add an auto refresh and info windows 
	
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
	$div = '<div style="height:75px">';
	foreach($results as $item)
	{
	    
		$parts = explode('|',$item);
		$arr = array('driver'=>$parts[0],
					 'loc'   =>$parts[1],
					 'unload'=>$parts[2],
					 'ttype' =>$parts[3],
					 'did'   =>$parts[4],
					 'lat'   =>$parts[5],
					 'lng'   =>$parts[6],
					 'description' => "$div Driver: <b>$parts[0]</b><br>Destination: $parts[1]<br>Unload Date: $parts[2]<br>Equipment: $parts[3]</div>"); 
					 
					 
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
	<!-- The next meta line causes auto refresh after contents seconds -->
	<!-- It will needto be to an aggread interval and uncommented.-->
	
	<!--<meta http-equiv="refresh" content="15" ><meta http-equiv="refresh" content="15" >-->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type='text/javascript' src='https://maps.googleapis.com/maps/api/js?v=3.exp'</script>
	<?php $xajax->printJavascript(); ?>
    <style>
      html, body, #map-canvas {
        height: 100%;
        margin:  0px;
        padding: 0px
      }
	  .idiv{
	    width: 100%; 
		height:95%;
		-moz-border-radius: 15px;
		border: 2px solid gray;
	  }
    </style>
	<script type="text/javascript" src="scripts/gmi.js"></script>
  </head>
  <body>
    <div class="idiv" id="map-canvas"></div>
  </body>
</html>