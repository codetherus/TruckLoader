<?php
/*
  This page Generates the load spreadsheet to DAT.
  It is redirected to from ProcessLoads.php.
*/
require_once("commons.php"); //System config/commons
error_reporting(E_ALL);
//-----------------------------------------------------------------------------
//Echo a message string...
function Msg($s){
  echo $s.'<br>';
}
//-----------------------------------------------------------------------------
//
function ReadLoads(){
  global $db;
  $sql = 'select * from uploaded_loads';
  return $db->get_results($sql);
}
//Translate military truck type codes
function TranslateEquipment($eqpt){
  global $db;
  $sql = "select * from uploads_equipment_map where spreadsheet_code = '$eqpt'";
  $res = $db->get_row($sql);
  if (!$res)
     return false;  
  else
     return $res->dat_code;
}
//-----------------------------------------------------------------------------  
//Generate the spreadsheet for DAT
function GenerateDATSheet(){
  define("CONTACT","(208) 888-4822 Ext: 622");
  //Load and instance the excel spreadsheet writer.
  require_once('includes/class_excel_writer.php');
  //Spreadsheet header row. See sample worksheet.
  $headers = array('Pickup',	'Truck',	'Origin-City',	'Or-St',	'Or-Zip',	
            'Dest-City','De-St',	'De-Zip',	'F/P',	'Ft.',	'kLbs',
            'Stops',	'Commodity',	'Cube',	'Units',	'# Loads',
            'Post For',	'Ref #',	'Contact',	'Comment 1',	'Comment 2');
  //$excel->AddHeaderRow($headers);

  //Read the dataset
  $res = ReadLoads();
  $today = date('Y-m-d');
  //Create an array for each roe and 
  //add it to the spreadsheet.
  foreach ($res as $rw){
    $rw->eqpt = TranslateEquipment($rw->eqpt);
    if (!$rw->eqpt) continue; //Bad truck type.
    if($rw->pickup_end < $today)
      $rw->pickup_end = $today;
    $s = array(); //Excel class takes an array for each load
    $s[] = $rw->pickup_end;
    $s[] = $rw->eqpt;
    $s[] = $rw->ocity;
    $s[] = $rw->ost;
    $s[] = $rw->ozip;
    $s[] = $rw->dcity;
    $s[] = $rw->dst;
    $s[] = $rw->dzip;
    $s[] = 'Full';
    $s[] = ceil($rw->len/12); //Length in feet
    $s[] = ceil($rw->weight/1000); //Weight in K pounds.
    $s[] = 0; //Stops
    $s[] = ''; //Commodity
    $s[] = ''; //Cube
    $s[] = '';//Units
    $s[] = '1';//#loads
    $s[] = ''; //Post for
    $s[] = $rw->offer_number; 
    $s[] = CONTACT;
    if ($rw->over_dim != '')
      $s[] = $rw->over_dim;
    else
      $s[] = ''; //comment 1
    $s[] = ''; //comment 2
    $excel->AddRow($s);
  }    
	$fname = 'Loads.xls';
  $excel->Generate('',$fname); //Generate the sheet
  unset($excel);  
}
GenerateDATSheet();