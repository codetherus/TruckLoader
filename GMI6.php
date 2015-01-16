<?php
/*
	10/26/2014
	LBJ Maps using the jquerymapping plugin;
	* [Documentation](http://vigetlabs.github.com/jmapping/ "jMapping Documentation")
	* [Examples](http://vigetlabs.github.com/jmapping/examples/ "jMapping: Examples")
	* [Repository@GitHub](http://github.com/vigetlabs/jmapping)
	* [Downloads](http://wiki.github.com/vigetlabs/jmapping/downloads)
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
//We get the drivers and build an html with an item for each
//This html will be read into map html to refresh the markers
function mapRefreshRequest()
{
	//Template for the map items
	$template = '<div class="map-location" data-jmapping="[datamap]">
        <a href="#" class="map-link">[driver]</a>
        <div class="info-box">
          <p>[info]</p>
        </div>
      </div>';

	
	$resp = new xajaxResponse();
	//Create a file to accept the generated html
	$fh = fopen('map.data.html', 'w');
	if(! $fh)
	{
	 $resp->alert('Failed to open data file map.data.html');
	 return $resp;
	}
	//Get the drivers information
	$results = getDrivers();
	if(!$results)
	{
		$resp->alert('Failed to get driver info....');
		return $resp;
	}
	//Construct the htmlfor the mape side div
	foreach($results as $item)
	{
	    
		$tpl = $template;	//Map point info template
		$parts = explode('|',$item);
		
		$desc = "Driver: <b>$parts[0]</b><br>Destination: $parts[1]<br>Unload Date: $parts[2]<br>Equipment: $parts[3]";
		$djmapping = "{id: $parts[4], point: {lat: $parts[5], lng: $parts[6]}";
		
		$tpl = str_replace('[driver]',$parts[0],$tpl);
		$tpl = str_replace('[info]', $desc, $tpl);
		$tpl = str_replace('[datamap]', $djmapping, $tpl);
		fwrite($fh, $tpl);
	}
	fclose($fh);
	$resp->assign('map-side-bar','innerHTML',file_get_contents('map.data.html'));
	
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
	<?php $xajax->printJavascript(); ?>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<link type="text/css" rel="stylesheet" href="jquerymapping/style.css"/>
	<script type='text/javascript' src='https://maps.googleapis.com/maps/api/js?v=3.exp'</script>
    <script type="text/javascript" src="jquerymapping/vendor/markermanager.js"></script>
	<script type="text/javascript" src="jquerymapping/vendor/StyledMarker.js"></script>
	
	<script type="text/javascript" src="jquerymapping/vendor/jquery.metadata.js"></script>
    <script type="text/javascript" src="jquerymapping/jquery.jmapping.js"></script>
	
	
	
	<style>
      html, body, #map {
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
	  .info-box{
		display: none;
	  }
    </style>
  </head>
  <body>
    <div id="map"></div>
	<div id="map-side-bar"></div>
  </body>
  <script type="text/javascript" src="scripts/gmi2.js"></script>
</html>