<?php
/*
  This page is invoked by the loads posting 
  spreadsheet upload page to parse the
  loads spreadsheet, upload the loads to
  Truckstop.com and DAT loadboards.
 
  V2 - get a list of currently uploaded loads from Truckstop
  and use it to decide wether to add or update the load. 

*/
require_once("commons.php"); //System config/commons
require_once 'biff-reader/CompoundDocument.inc.php';
require_once 'biff-reader/BiffWorkbook.inc.php';
//require_once 'ExcelReader/reader.php';
error_reporting(E_ALL);
//Convert excel date float
function date_convert($days){
  $ts = mktime(0,0,0,1,$days-1,1900);
  return date('Y-m-d',$ts); //MySql wants YYYY-mm-dd...
}
//-----------------------------------------------------------------------------
//Echo a message string...
function Msg($s){
  echo $s.'<br>';
}
//-----------------------------------------------------------------------------
//Extract the spreadsheet values into
//an array of arrays.
function biff_parser($filename){
$doc = new CompoundDocument ('utf-8');
$doc->parse (file_get_contents ($filename));
$wb = new BiffWorkbook ($doc);
$wb->parse ();
foreach ($wb->sheets as $sheetName => $sheet)  
  $colname=array();  
  //Construct the column names list
  for ($i=0;$i<$sheet->cols();$i++){
    $cell = $sheet->cells[0][$i];
    $colname[] = $cell->value;
  }
  //Construct the data rows
 	for ($row = 1; $row < $sheet->rows(); $row ++){
   for ($col = 0; $col < $sheet->cols(); $col ++){
    if (!isset ($sheet->cells [$row][$col]))
      $val = '';
    else{    
      $cell = $sheet->cells[$row][$col];
      $val = $cell->value;
    }
      @$product[$row-1][$colname[$col]] = $val;
   }
  }
  return $product;
}
//-----------------------------------------------------------------------------
//Parse and store the input spreadsheet.
function ExtractLoadSheet(){
  echo '<h3>Extracting the spreadsheet...</h3>';
  global $db;
  $filename = $_SESSION['uploaded_file'];
  echo 'Processing file: '.$filename.'<br>';
  $prods=biff_parser($filename); //Extract the spreadsheet
  //Convert the dates.
  for($i=1;$i< count($prods);$i++){
    if(count($prods[$i]) <2) continue;
    if ($prods[$i]['OFFER NUMBER'] == '') continue; //Skip trailing blank rows...
    $prods[$i]['PickUpStartCDT'] = date_convert($prods[$i]['PickUpStartCDT']);
    $prods[$i]['PickUpEndCDT'] = date_convert($prods[$i]['PickUpEndCDT']);
    $prods[$i]['DeliveryStartCDT'] = date_convert($prods[$i]['DeliveryStartCDT']);
    $prods[$i]['DeliveryEndCDT'] = date_convert($prods[$i]['DeliveryEndCDT']);
  }
  //Parse into the database
  $sql = "truncate uploaded_loads";
  $db->query($sql);
  $loadcount = 0;
  $ttype = '';
  foreach($prods as $rw){
    if (count($rw) < 2) continue;
    extract($rw);
    
    $offer_number = $rw['OFFER NUMBER'];
    if ($offer_number == '') continue; //Skip empty rows
    if($ORIGIN == '') continue;
    $loadcount++;
    $ORIGIN = addslashes($ORIGIN);
    $DESTINATION = addslashes($DESTINATION);
    if ($VOLUME == '') $VOLUME = 0;
    if ($LEN == '') $LEN=0;
    if ($WID == '') $WID = 0;
    if ($HGT == '') $HGT = 0;
     
    $sql = "insert into uploaded_loads values(NULL,'$offer_number','$OCITY','$OST','$OZIP','$DCITY','$DST','$DZip',
            '$PickUpStartCDT','$PickUpEndCDT','$DeliveryStartCDT','$DeliveryEndCDT','$STATE',$WEIGHT,
            $VOLUME,'$HAZMAT','$OverDim',$LEN,$WID,$HGT,'$EQPT','$ORIGIN','$DESTINATION','')";
    //echo $sql.'<br>';
    $db->query($sql);        
  }
  if ($loadcount == 0){
    Msg("No loads found in this spreadsheet...");
    die;
  } 
  Msg("Found $loadcount load records in the spreadsheet...");

  TruckstopUpload(); //Call the truckstop upload.
}
//-----------------------------------------------------------------------------
//
function ReadLoads(){
  global $db;
  $sql = 'select * from uploaded_loads';
  return $db->get_results($sql);
}
include ('./includes/loadsupload.class.php'); //Truckstop.com API classes  
$uploader = new loaduploader(); //Instance the soap client class

//Translate military truck type codes
//Handles both 
function TranslateEquipment($eqpt, $isTruckstop=false){
  if ($isTruckstop){
    if ($eqpt == 'AF3') 
      return 'F';
    else if ($eqpt == 'AH2') 
      return 'SD';
    else if ($eqpt == 'A30') 
      return 'RGN';
    else
      return False;
  }else{ //DAT
    if ($eqpt == 'AF3') 
      return 'Flatbed';
    else if ($eqpt == 'AH2') 
      return 'Step Deck';
    else if ($eqpt == 'A30') 
      return 'RGN';
    else
      return False;
  }
}
$ourloads = '';
//Read for a list of our loads from Truckstop 
//and construct an array of ids for use in
//the current upload process.
function GetOurLoads(){
  global $ourloads, $uploader;
  $ourloads = array();
  $request = new GetImportedLoadsService();
  $response = $uploader->CallGetImportedLoadsService($request);
  
  $loads = $response->GetImportedLoadsServiceResult->ImportedLoads->ImportedLoads->Loads->ImportLoad;
  echo '<pre>';
  print_r($loads);
  if (is_array($loads)){
    for($i=0;$i<count($loads);$i++)
      $ourloads[] = $loads[$i]->LoadNumber;
  }
}
//Upload the loads to Truckstop.com
function TruckstopUpload(){
  global $ourloads,$uploader;
  GetOurLoads();
  Msg('<h3>Generating Truckstop uploads...</h3><br/><br>');
  //Setup the API classes  
  $debugging = false; //If true, we dump pertinant data and only process one record.
  global $db;
  $upcount = 0;
  //Fetch the data set
  $res = ReadLoads();
  $request = new LoadImportPartialService();
  $lds = new LoadImportPartial();

  //Process each row in the data set
  foreach ($res as $rw){
    //Users don't want equip type AV3...
    if ($rw->eqpt == 'AV3') continue;
    $rw->len = floor($rw->len/12); //Convert the length inches to feet.
    //Instance a Truckstop load object
    $imp = new ImportLoad();
    //Populate it
    $imp->OriginCity = $rw->ocity;
    $imp->OriginState = $rw->ost;
    $imp->OriginZip = $rw->ozip;
    $imp->DestinationCity = $rw->dcity;
    $imp->DestinationState = $rw->dst;
    $imp->DestinationZip = $rw->dzip;
    $imp->Distance = 0;
    $imp->Weight = $rw->weight;
    $imp->Length = $rw->len;
    $imp->Stops = 0;
    $imp->PaymentAmount = 0;
    $today = date('Y-m-d');
    if($rw->pickup_start < $today)
      $rw->pickup_start = $today;
    $imp->PickupDate = $rw->pickup_start;
    $imp->PickupTime = 0;
    $ddate = $rw->delivery_start;
    if ($ddate < $today)
      $rw->delivery_start = $today;
    $imp->DeliveryDate = $rw->delivery_start;
    $imp->SpecialInformation = '';
    $imp->IsFullLoad = 1;
    $imp->Quantity = 1;
    $imp->LoadNumber = $rw->offer_number;
    if ($rw->hazmat == 'Hazmat')
      $imp->EquipmentOptions = 'Z';
    else
      $imp->EquipmentOptions = '';
      

    //Handle the equipment type.
    $rw->eqpt = TranslateEquipment($rw->eqpt, true);
    if ($rw->eqpt != false)
      $imp->EquipmentType = $rw->eqpt;
    else{
     Msg("Invalid Equip. Type for offer number $rw->eqpt<br>");
     continue;
    }
    //Setup the objects to ship to truckstop
    //If the load is already posted then update it.
    if (in_array($rw->offer_number,$ourloads))
      $lds->UpdateLoads[] = $imp;
    else
      //Else add it...
      $lds->AddLoads[] = $imp;
    $upcount++;
    //if ($debugging)
    //  break;
  }
    $request->myImport->Imports[] = $lds;
    try{
      $result = $uploader->CallLoadImportPartialService($request);
    }catch(Exception $e){
      Msg('Error: '.$e->GetMessage());
    }
    if ($debugging){
      //Display($request);
      Display($result);
    }

  Msg("<h2>Uploaded $upcount loads to Truckstop.com</h2>");
  Msg('Truckstop loads upload complete...<br>');
  header("Location: DATLoadsSheetGenerator.php");
}
//-----------------------------------------------------------------------------  
function Display($dat){
  echo '<pre>';
  print_r($dat);
}

Msg('<h2>Starting Loads Processing</h2>');
ExtractLoadSheet(); //Kick off the processing