<?php
/*
  One shot to correct the truck type field
  in the truck loader table
*/
require_once("commons.php");
require_once("utility.php");

//Figure out what equipment the driver has.
function InterpretEquipment($equipment)
{
    $ttype = '';
    $equipment = StrToUpper($equipment);
		if (strpos($equipment,"FLAT"))
		  $ttype = "Flatbed";
		else if (strpos($equipment, "TRAILER POOL"))
		  $ttype = "Trailer Pool";
		else if (strpos($equipment,"SD"))
		  $ttype = "Step Deck";
		else if (strpos($equipment,"STEP"))
		  $ttype = "Step Deck";
		else if (strpos($equipment, "REEFER"))
		  $ttype = "Refer";
    else if (strpos($equipment, "VAN"))		  
      $ttype = "Van";
    else if (strpos($equipment, "DD RGN"))      
      $ttype = "DD RGN";
    else if (strpos($equipment, "RGN"))      
      $ttype = "RGN";
    else if (strpos($equipment, "LOW"))      
      $ttype = "Lowboy";
    else
      $ttype = "Dont Know";
    return $ttype;
}

function UpdateTruckTypeFields()
{
  global $db;
  $sql = "select * from truck_loader";
  $res = $db->get_results($sql);
  foreach($res as $rw)
  {
    $id = $rw->id;
    $equipment = $rw->equipment;
    $ttype = InterpretEquipment($equipment); 
    $sql = "update truck_loader set ttype='$ttype' where id = $id";
    $db->query($sql);
    if ($db->rows_affected == 0)
     echo $equipment.' -> '.$sql."<br/>";
  }
}
UpdateTruckTypeFields();    
  
?>