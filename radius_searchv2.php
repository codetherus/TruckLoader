<?php
/*
  4/23/2010
  Implement radius search against the drivers table.
  
  Users will specify a city and state where a load 
  is ready to be shipped and a radius in miles around that city.
  We use our zip code database to locate cities within the
  specified radius using our custom class.
  
  The class returns a list if id numbers in the driver table and
  we do a list for the users. 
  7/2/10 - Version 2 working from the new loads and drivers tables

*/
ob_start();
require_once("commons.php");
require_once("utilityV2.php");
require_once("includes/lbj.zipcode.classv2.php");
require_once("includes/state_list.php");
$smarty->assign("pgtitle", "Radius Search for Drivers"); 
$smarty->assign("domenu", 1);
$smarty->assign("dosearch",1);
//Using Google maps and extracting the driving
//distance from the returned page.
function GetDrivingDistance($strt, $dest)
{
	$strt = urlencode($strt);
	$dest = urlencode($dest);
	$url="http://maps.google.com/maps/nav?q=from+$strt+to+$dest&om=0";

//	$s = file_get_contents($url);
  $ch = curl_init();  
  curl_setopt($ch,CURLOPT_URL, $url);  
  curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);  
  curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 10);  
  $s = curl_exec($ch);
  curl_close($ch);

	$i = strpos($s,'\u0026nbsp;mi');
	$j = $i;//Position after the space 
	while ($i > 0 && substr($s,$i,1) != '"') $i--;
	$dist = substr($s,$i+1,$j-$i-1);
	
	return $dist;
}
function RadiusSearch($dta)
{
  global $db;
  $resp = new xajaxResponse();
  extract($dta);  
	if ($city == '')
		return xajaxAlert("Missing city value","Missing Information");
	if (strpos($city,','))
		$loc = strtoupper($city);
  else  
    $loc = strtoupper("$city, $state");
  $zipHandler = new loads_by_jake_zip_code_class();
  if (!$zipHandler->radiusSearch($loc, $radius))
    return xajaxAlert($zipHandler->errorMsg,"General Failure");
  if ($zipHandler->errorMsg != '')
    return xajaxAlert($zipHandler->errorMsg,"Radius Search");
  else
  {
    $cutoffdate = date('Y-m-d'); //Pivot date is today
    $cutofftime = strtotime($cutoffdate);
    $numfound = 0;
    $base_zip = $zipHandler->base_zip;
		$apoints= array();
    $fivedays = 60 * 60 * 24 * 5; //seconds in 5 days - makes a +- 5 day window.
    $s  ="<center><table border=1 style='color: black'>";
    $s .= "<tr><th>Driver<th>Location<th>Distance<br>Line/Driving<th>Unload Date<th>Truck Len.<th>Truck Type<th>Map</tr>";    
    for ($i=0;$i<sizeof($zipHandler->aIdList);$i++)
    {
			$id =  $zipHandler->aIdList[$i];
      $sql =  "select L.*, D.* ";
      $sql .= "from loads L, drivers D ";
      $sql .= "where L.id = $id ";
      $sql .= "and L.id = D.id";
      $rw = $db->get_row($sql);
      if($rw !== false)
      {
        //This load within our 5 day window?
        $delivery_date = $rw->delivery_date;
        $diff = abs($cutofftime - (strtotime($delivery_date))); //Difference in seconds
        if ($diff > $fivedays) continue;
        $numfound++; //Got one...
        $driver_loc = $rw->delivery_location;
				$far_zip = $zipHandler->GetAZip($driver_loc);        
				$dist = $zipHandler->get_distance($base_zip, $far_zip);
				if ($dist <= 0) continue;
				$gdist = GetDrivingDistance($loc,$driver_loc);
			  $gdist = round($gdist,0);
				$cmbdist = "$dist/$gdist";
				$lnk = "<a href=\"#\" onclick=\"xajax_SendRadiusId($id)\">$rw->name</a>";
				$maplink="<a target='_blank' href='http://maps.google.com/maps?saddr=$loc&daddr=$rw->delivery_location'>Map</a>";

				$s .= "<tr><td>$lnk<td>$rw->delivery_location<td>$cmbdist<td>$rw->delivery_date<td>$rw->tlength<td>$rw->ttype<td>$maplink</tr>";
      }
    }
    $s .= "</table></center><br><br>";  
  }
  if ($numfound > 0)  
    return GenFloatbox($s);
  else
    return xajaxAlert('No qualified drivers found...');
}
//Callback from the client with the load record id
//Redirects to edit.php
function SendRadiusId($id)
{
	$_SESSION['swapid'] = $id;
  $resp = new xajaxResponse();
	$resp->redirect('drivers.php');
	return $resp;
}


//$xajax->configure('debug',true);  
$xajax->register(XAJAX_FUNCTION,"RadiusSearch");
$xajax->register(XAJAX_FUNCTION,"SendRadiusId");
$xajax->processRequest();
$smarty->assign("statelist", GenerateStateList("state"));

GenerateSmartyPage();
?>