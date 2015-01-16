<?php 
/*
	Copyright(c) 2009 by RSI. All rights reserved.
	This page loads the inbound truck daily report.
	Goes into table "truck_inbound."
  The truck_inbound is used to update the truck_loader table.
  8/17/2010:
  Version 2 loads the driver and loads table from the truck_inbound table.
  7/6/2011
  Version 3 loads from a spreadsheet
*/
//--------------------------- Page Setup Stuff -----------------------------------------
require_once("commons.php");
require_once("utilityV2.php");
define("INBOUND_FILES_DIRECTORY", "./inbound_files/");
$smarty->assign("pgtitle", "Daily Inbound Truck File Upload V3"); 	//Do per page.
$smarty->assign("domenu", 1);
//$smarty->assign("dosearch",1); //Global search tool control
$hdl = '';	//Input file handle
$buf = '';	//Input file line buffer
$firstrow=0; //biff parser enters first data row number
$loadseq = 1; //Global load sequence number
require_once 'biff-reader/CompoundDocument.inc.php';
require_once 'biff-reader/BiffWorkbook.inc.php';

//--------------------- Loads table update functions -----------------------
function LogIt($s){
  @$hdl = fopen('log.txt','a'); //log file
  if ($hdl)
   fwrite($hdl,"$s\n");   
   fclose($hdl); 
}


/*
	There may be ocassions where the same truck # 
	is present on more than 1 record.
	We are to use the one with the oldest delivery date.
*/
function FindLatestDelivery($load_recs)
{
	global $db;
	$oldestid = 0;
	$oldestdate = '';
	//                   1         2         3 
	//         012345678901234567890123456789012345
	$months = "JanFebMarAprMayJunJulAugSepOctNovDec";
	$mo='';
	$ddate= '';
	foreach($load_recs as $rw)
	{
		$ddate = $rw->unload_date;
		$mo = substr($ddate,0,3);
		$monthnum = (strpos($months, $mo)/3) +1;
		$daynum = substr($ddate,4,2);
		$ndate = ($monthnum * 100) + $daynum;
		
		if ($ndate > $oldestdate)
		{
			$oldestid = $rw->id;
			$oldestdate = $ndate;
		}
	}
	$sql = "select * from truck_loader where id = $oldestid";
	$res = $db->get_row($sql);
	return $res;
}
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

//Users want all drivers in the corp. list available
//on the site. This adds a driver.
//Much code is repeated but...
function InsertThisDriver($rw)
{
  global $db,$loadseq;
  $loadnumberroot = date('Mdy');
  $unload_location = $rw->dest_city .", ". $rw->dest_state;
  $unload_date = $rw->delivery_date;
  $comments = $rw->comments;
  //Check for twic notice in the comments
  $twic = '';
  if(stripos($comments,'twic') >=0)
    $twic = 'Yes';
	//Break out the equipment field.
	//It should come in as nn' ...
	//where nn is the length in feet of the trailer.
	$equipment = addslashes($rw->equipment);
	$equipment = strtoupper($equipment);
	$i = strpos($equipment,"'");
	//Trailer length
  if ($i === false)
	  $tlength = '';
	else
	{
	  $tlength = substr($equipment,0,2);
	  $equipment = substr($equipment,$i+1);
	}
	//Trailer type
  $ttype = InterpretEquipment($equipment); 
  //Break out the rest of the input record.    
  $comment = addslashes($rw->comments); 
  $equipment = addslashes($rw->equipment);
  $telephone = $rw->telephone; 
  $dmonth = $rw->delivery_month;
  $dday = $rw->delivery_day;
  $ocity = $rw->origin_city;
  $ostate = $rw->origin_state;
  $dcity = $rw->dest_city;
  $dstate = $rw->dest_state;
  $driver = $rw->driver;
  $truck_number = $rw->truck_number;
  
  $pickup_location = $ocity.', '.$ostate;
  $delivery_location = $dcity.', '.$dstate;
  $yr = date('Y');
  $delivery_date = $yr-$dmonth.'-'.$dday;
  $load_number = $loadnumberroot.$loadseq;
  $loadseq++;
  
  $sql = "insert into drivers (name,tlength,ttype,truck_no,telephone,comments,twic,officeid)
          values('$driver','$tlength','$ttype','$truck_number','$telephone','$comment','$twic',1)";
  QueryLog($sql);
  $db->query($sql);
  $did = $db->insert_id;
  if ($did < 1)
  {
    QueryLog("uploader driver insert failed $driver");
    continue;
  }
  
  $sql = "insert into loads (driverid,pickup_location,delivery_location,delivery_date,driver_name,officeid,load_number)
          values($did,'$pickup_location','$delivery_location','$delivery_date','$driver',1,'$load_number')";
  QueryLog($sql);
  $db->query($sql);
  $lid = $db->insert_id;
  if ($lid <1)
  {
    QueryLog("uploader load insert failed $driver");
    continue;
  }
  //Update the driver to reflect the load info
  $sql = "update drivers set loadid = $lid where id = $did";
  $db->query($sql);
}

//We have an inactive driver. 
//This updates the driver and the load.
function UpdateInactiveDriver($rw, $drow){
  global $db;
  $unload_location = $rw->dest_city .", ". $rw->dest_state;
  $unload_date = $rw->delivery_date;
  $comments = $rw->comments;
  //Check for twic notice in the comments
  $twic = '';
  if(stripos($comments,'twic') >=0)
    $twic = 'Yes';
	//Break out the equipment field.
	//It should come in as nn' ...
	//where nn is the length in feet of the trailer.
	$equipment = addslashes($rw->equipment);
	$equipment = strtoupper($equipment);
	$i = strpos($equipment,"'");
	//Trailer length
  if ($i === false)
	  $tlength = '';
	else
	{
	  $tlength = substr($equipment,0,2);
	  $equipment = substr($equipment,$i+1);
	}
	//Trailer type
  $ttype = InterpretEquipment($equipment); 
  //Break out the rest of the input record.    
  $comment = addslashes($rw->comments); 
  $equipment = addslashes($rw->equipment);
  $telephone = $rw->telephone; 
  $dmonth = $rw->delivery_month;
  $dday = $rw->delivery_day;
  $ocity = $rw->origin_city;
  $ostate = $rw->origin_state;
  $dcity = $rw->dest_city;
  $dstate = $rw->dest_state;
  $driver = $rw->driver;
  $truck_number = $rw->truck_number;
  $pickup_location = $ocity.', '.$ostate;
  $delivery_location = $dcity.', '.$dstate;
  $yr = date('Y');
  $delivery_date = $yr.'-'.$dmonth.'-'.$dday;
  $ldid = $drow['loadid'];  
  $did = $drow['id'];  
  //1. Update the driver record  
  $sql = "update drivers set tlength='$tlength',ttype='$ttype',truck_no='$truck_number',
          telephone='$telephone',comments='$comment',twic='$twic' where id= $did";
  QueryLog($sql);
  $dname = $drow['name'];  
  LogIt("Updated driver $dname");
  $db->query($sql);  
  //2. Update the load record
  $sql = "update loads set pickup_location='$pickup_location',delivery_location='$delivery_location',
          delivery_date='$delivery_date' where id = $ldid";
  QueryLog($sql);  
  $db->query($sql);
}

/*
//This function uses the just uploaded table information to update
//the driver and loads table.
*/
function UpdateDriversAndLoads()
{
  global $db;
  @$hdl = fopen('log.txt','w'); //log file
  $resp = new xajaxResponse();
  $ct = 0;
  $updatecount = 0;
  $skipcount=0;
  $pcount=0;
  //Query all of the inbound contents.
  $sql = "select * from truck_inbound";
  $inbound = $db->get_results($sql); //Read the inbound table
  if(!is_array($inbound))
  {
  	return xajaxAlert("Failed to read the inbound table.\nLoad table not updated.");
  }
	foreach($inbound as $rw)
  {
    $pcount++;
    $truck_number = $rw->truck_number;
    $driver = strtoupper($rw->driver);
    //Check to see if we have this driver already.
    $drow = GetDriverByName($driver);
    //Do not attempt to update active drivers.
    if ($drow){    
      if($drow['status'] == 'Active'){
        $skipcount++;      
        continue;
      }
      else{ 
        $updatecount++;     
        UpdateInactiveDriver($rw, $drow);        
        continue;                
      }
    }    
    LogIt("Added Driver: $rw->driver");
    InsertThisDriver($rw);
    $ct++;
  }
  fclose($hdl);
  SetAlertCaption("Daily Upload Statistics");
  return xajaxAlert("Processed $pcount records.<br>Added $ct drivers as inactive.<br>Updated $updatecount inactive drivers.<br>Skipped $skipcount Active drivers.");
}
//-----------------------------------Uploaded File Handlers -----------------------------------------
//Read up to the next truck record.
//Skips over all of the extraneous lines.
function GetNextLine()
{
	global $hdl, $buf;
	while (!feof($hdl))
	{
		$buf =  fgets($hdl);
		if (strpos($buf, 'Page') !== false ||
		    strpos($buf, 'This report') !== false ||
		    strpos($buf, 'Agent') !== false )
			continue;
	  return true;
	}
	return false;}

//Read up to the first line beginning with "Agent"
function SynchOnPage()
{
	global $hdl, $buf;
	while (!feof($hdl))
	{
		$buf = fgets($hdl);
		if
 (strpos($buf, 'Agent') !== false)
			return true;
	}
	return false;
}
//Extract the spreadsheet values into
//an array of arrays for the main function.
function biff_parser($filename){
global $firstrow;
$doc = new CompoundDocument ('utf-8');
$doc->parse (file_get_contents ($filename));
$wb = new BiffWorkbook ($doc);
$wb->parse ();
foreach ($wb->sheets as $sheetName => $sheet)  
  $colname=array(); 
  //Position on the column headings row. Row 12 in the sample.
  for ($row = 1; $row < $sheet->rows(); $row ++){
    $cell = $sheet->cells[$row][0];
    $val = $cell->value;
    if ($val == 'CO.'){
      $firstrow = $row + 1; //first row of values is next row.
      break;
    }
  }  
  
  //Construct the column names list
  for ($i=0;$i<$sheet->cols();$i++){
    $cell = $sheet->cells[$firstrow-1][$i];
    if ($cell->value != ''){
      if ($cell->value == 'CO.') 
        $cell->value = 'CO';
      $cell->value = str_replace(' ','',$cell->value);
      $colname[] = $cell->value;
    }
    else 
      $colname[] = 'col-'.$i;
  }

  //Construct the data rows
 	for ($row = $firstrow; $row < $sheet->rows(); $row ++){
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
function LogThisRow($row, $lg){
  $s = '';
  foreach($row as $val)
    $s .= $val.'|';
  fwrite($lg,$s."\r\n");
}  
/*
//Main function. Called from the browser.
//Loads the upload file into the truck_inbound table
//then calls the db update function to update the
//loads and drivers.
*/
function LoadInbound()
{
  global $db, $hdl, $buf, $firstrow;
  //Load the spreadsheet
  $fname = $_SESSION['uploaded_file'];
  $data = biff_parser($fname); //Parse it into an array.
	
	//Instance the XAJAX response object
	$resp = new xajaxResponse();

	//Empty the inbound data table
	$sql = "truncate truck_inbound";
	$db->query($sql);
	$lg = fopen('inboundlog.txt','w');
	$recCt = 0; //Reset the record counter
	//Process the records
	foreach($data as $row){
    $recCt++;
			
		//Populate the existing fields array
    $flds = array();
    foreach($row as $val)
      if ($val != '')
        $flds[] = trim($val);
        
    LogThisRow($flds, $lg);
		//Fix the short field records
		while(count($flds) < 14)
		{
			$i = count($flds);
			$flds[$i] = ' ';
		}

		//Trim and slash the fields
		for ($i=0;$i<count($flds);$i++)
		{
			$flds[$i] = trim($flds[$i]);
			$flds[$i] = addslashes($flds[$i]);
		}
		
/*
		//They omit the space for the cell # if they don't have it.
		//This messes things up. Try to fix it by shiftine
		//everything right one position.
		if (strpos($flds[5],"(") === false && $flds[5] != '')
		{
			for ($i=13;$i>=5;$i--)
				$flds[$i] = $flds[$i-1];
			$flds[5] = '';
		}
*/
		
    //Setup delivery date as mmm dd
    //The input only provides month and day
    $dateparts = explode('/',$flds[9]);
    $months = "JanFebMarAprMayJunJulAugSepOctNovDec";
		$mo = $dateparts[0];
		$ofs = ($mo * 3) - 3; //Offset into the months string
    $da = $dateparts[1];
    if ($da < 10)
      $da = '0'.$da;
		$del_date = substr($months,$ofs,3).' '.$da;
		$phone = $flds[4];
		
		
		
		//Construct the insert query
		$sql = "insert into truck_inbound(agent,unit,truck_number,equipment,driver,cell,";
		$sql .= "origin_city,origin_state,dest_city,dest_state,";
		$sql .= "delivery_month,delivery_day,comments, delivery_date,telephone)";
		$sql .= " values('$flds[0]','$flds[1]','$flds[1]','$flds[2]','$flds[3]','$flds[4]',";
		$sql .= "'$flds[5]','$flds[6]','$flds[7]','$flds[8]','$dateparts[0]',";
		$sql .= "'$dateparts[1]','$flds[10]','$del_date','$phone')";

		$db->query($sql);
    QueryLog("uploader-inbound load-$sql");
	}
	//Remove any coded returns
	$sql = "update truck_inbound set comments=replace(comments,'_x000A_','\n')";
	$db->query($sql);
	if ($lg)
		fclose($lg);
	//All done. Let the user know what happened.
	//$resp->alert("$fname has been loaded. Loaded $recCt records.");
  //return $resp;
	return UpdateDriversAndLoads();
}		
//$xajax->configure('debug',true);
$xajax->register(XAJAX_FUNCTION,'LoadInbound');
$xajax->processRequest();

GenerateSmartyPage();
?>
