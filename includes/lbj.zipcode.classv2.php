<?php
/*
  4/23/2010
  Define an extension to Mica Carrick's zip code class to
  fit the needs of the Loads by Jake site application.
  
  We need to be able to find a zip code for a city, state.
  To this end a field has been added to the zip code table
  that concatonates the city and state postal code with an
  index. This allows us to query on the location in the drivers table.
  
  Then we can use the original class distance and range calculations 
  to find zips in the range.
  
  We will be using the ez_sql database of the application
*/
include("zipcode.class.php");

class loads_by_jake_zip_code_class extends zipcode_class
{
  var $base_location = '';        //The center point of the search.
  var $base_zip = '';             //The zip of the center point.
  var $radius = '';               //The miles away to look in.
  var $aLocations = array();      //Array of locations in range
  var $aDistances = array();      //Array of distances to each location from the base.
  var $aZips = array();           //Array of zips - one per location in range.
  var $aDrivers = array();        //Array of drivers unloading in the locations array  
	var $aIdList = array();					//List of driver record ids
  var $errorMsg = '';             //An error description
  
  //Common error routine.
  function setError($msg)
  {
    $this->errorMsg = $msg;
    return false;
  }
  
  //Format the base location as CITY, ST.
  //Input must have an embedded comma or this fails.
  function standardizeLocation()
  {
    $loc = $this->base_location;
    $i = strpos($loc,',');
    if ($i === false) //Look for an emedded space if no comma found.
      $i = strpos(' ', $loc);
    if ($i === false) return false;
    $city = substr($loc,0,$i);
    $st = trim(substr($loc,$i+1,10));
    $loc = $city.', '.$st;
    $loc = strtoupper($loc);
    $this->base_location = $loc;
    return true;
  }
    
  /*
      Setup and perform a radius search.
      This is the "public" function of the class.
      Params:
      $location is the city, state string of the starting point.
      $search_radius is the miles away to go looking for cities.
      Returns true is all is well or false if any problem.
  */
  function radiusSearch($location, $search_radius)
  {
    global $db;
    $this->base_location = $location;
    if (!$this->standardizeLocation()) 
      return setError("Location must be city and state code seperated by a comma.");
    $this->radius = $search_radius;
    if($search_radius < 1)
      return setError("Radius must a positive integer number.");
    if (!$this->GetBaseZip()) return false;
    if(!$this->RunTheSearch()) return false;
    $this->driverSearch();
    return true;
  }
  //Using the location array, search the driver table.
  //7/2/10 - New approach using the loads table
  function driverSearch()
  {
    global $db;
    $oid = $_SESSION['officeid'];
    $inclause = '';
    $this->aDrivers = array();
    $this->aIdList = array();
    for ($i=0;$i<sizeof($this->aLocations);$i++)
    {
      $loc = $this->aLocations[$i];
      $loc = addslashes($loc);
      $loc = "'$loc'";
      if ($inclause == '')
        $inclause = $loc;
      else
        $inclause .= ','.$loc;
    }
    $inclause = '('.$inclause.')';
    $sql =  "select L.id, L.delivery_location, L.delivery_date, L.officeid, D.name ";
    $sql .= "from loads L, drivers D ";
    $sql .= "where L.delivery_location in $inclause ";
    $sql .= "and L.id = D.id and L.officeid = $oid";
    $res = $db->get_results($sql);
    if (!$res) return;
    foreach($res as $rw)
    {
      $driver = $rw->id.','.$rw->name.','.$rw->delivery_location.','.$rw->delivery_date;      
			$id = $rw->id;
      array_push($this->aDrivers,$driver);      
			array_push($this->aIdList,$id);
    }
  }
    
  //Get the zip code of the center point.
  //Note: uses the first one in the table.
  function GetBaseZip()
  {
    global $db;
    $sql = "select zip_code from zip_code where location = '$this->base_location'";
    $rw = $db->get_row($sql);
    if (!$rw) return $this->setError("No zip code for the specified location");
    $this->base_zip = $rw->zip_code;
    return true;
  }  

	//Read for a zip code on a passed location
	function GetAZip($loc)
	{
    global $db;
    $sql = "select zip_code from zip_code where location = '$loc'";
    $rw = $db->get_row($sql);
    if (!$rw) 
			return $this->base_zip;    
		else
			return $rw->zip_code;
  }  
  
  //Do the range search in the parent class
  //and populate the data arrays.
  function RunTheSearch()
  {
    $res = $this->get_zips_in_range($this->base_zip, $this->radius, 1,true);
    if ($res === false) return setError("No location within the specified radius.");
    //Clear the data arrays.
    $this->aLocations = array();
    $this->aDistances = array();
    $this->aZips = array();
    //array($dist,$zip,$city,$state,$loc);
    foreach($res as $rw)
    {
      //print_r($rw,false);echo "<br/>";
      $loc = trim($rw[4]);
      if ($loc == $this->base_location) continue;                   //Do not include the base.
      //Try and eliminate duplicates.
      if (sizeof($this->aLocations) > 0)
        if(in_array($loc,$this->aLocations)) continue;
      $dist = $rw[0];
      $zip = $rw[1];
      array_push($this->aLocations,$loc);
      array_push($this->aDistances,$dist);
      array_push($this->aZips,$zip);
    }
    return true;
  }
}
?>