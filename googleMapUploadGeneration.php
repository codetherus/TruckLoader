<?php
/*
	9/7/2014
	This is a test exercise to create a CSV file
	for upload to a Google Map.
	
	It was derived from the corporate spreadsheet generator.
*/

require_once("commons.php");
require_once("utilityV2.php");
ob_end_clean();
//Given a string, quote it if it contains a comma
function CheckDelimiter(&$s)
{
	if(strpos($s,','))
	{
		if (strpos($s,'"'))
		  $s = str_replace('"','', $s);
		$s = '"'.$s.'"';
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
	3. Create the CSV to upload
*/
function Generate()
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
	die( 'No drivers selected...');
	
  }
  $fname = 'MapTrucks.csv'; //Target File
  $fh = fopen($fname,'w');
  fwrite($fh,$heads);
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
	  $csv = $geometry.','.$driver.','.$location.','.$unload_date.','.$ttype."\n";
	  //$s = $location.','.$ddate.','.$driver.','.$ttype."\n";
	  //Save it
	  fwrite($fh,$csv);
    } 
	fclose($fh);
	OutputCSVFile($fname);
}

  function OutputCSVFile($fname)
  {
    $cdisp = "Content-Disposition: attachment; filename=\"$fname\"";
    header("Content-type: text/csv"); 
    header($cdisp);
    header("Pragma: no-cache"); 
    header("Expires: 0"); 
    $data = file_get_contents($fname);
	print $data; //Write it...
  }

//ob_end_clean();


Generate();
?>
