<?php
/*
  4/24/2010
	This is a one-shot to add missing zip codes and
	setup the full unload dates after the corporate
	upload file was changed to include these items.
*/
ob_start();
require_once("commons.php");
require_once("utility.php");
require_once("includes/lbj.zipcode.class.php");
function MakeFullDate($rw)
{
	global $db;
	$id = $rw->id;
	$dt = $rw->unload_date;
	if($dt == '') return;
	try{
		$oDate = new DateTime($dt);
	}
	catch (Exception $e)
	{
		echo "Bad Date: $dt<br/>";
		return;
	}
	$full_date = $oDate->format('Y-m-d');
	$sql = "update truck_loader set full_unload_date = '$full_date' where id = $id";
	$db->query($sql);
}


function process()
{
	global $db;
	$zipper = new loads_by_jake_zip_code_class();
	$sql = "select * from truck_loader";
	$res = $db->get_results($sql); //Get the entire driver file
	$zipcount = 0;
	foreach ($res as $rw)
	{
		MakeFullDate($rw); //Handle the unload dates
		if($rw->location_zip_code != NULL) continue;
		$zip = '';
		$loc = strtoupper($rw->location);
		$zipper->base_location = $rw->location;
		if ($zipper->standardizeLocation()) 
			if($zipper->GetBaseZip())
				$zip = $zipper->base_zip;
		if ($zip == '')
		{
			echo "No zip for $loc<br/>";
		 	continue; //none available... 
		}
		$id = $rw->id;
		$sql = "update truck_loader set location_zip_code = '$zip' where id=$id";
		$db->query($sql);
		$zipcount++;
	}
	echo "<h1>Update Complete...</h1>";
	echo "Updated $zipcount zip codes";
}

process(); 
?>