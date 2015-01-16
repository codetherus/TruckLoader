<?php 
/*
	Copyright(c) 2009 by RSI. All rights reserved.
	This page loads the inbound truck daily report.
	Goes into table "truck_inbound."
*/
//--------------------------- Page Setup Stuff -----------------------------------------
require_once("commons.php");
require_once("utility.php");
define("INBOUND_FILES_DIRECTORY", "./inbound_files/");
$smarty->assign("pgtitle", "Daily Inbound Truck File Upload"); 	//Do per page.
$smarty->assign("domenu", 1);
$hdl = '';	//Input file handle
$buf = '';	//Input file line buffer
//--------------------- Loads table update functions -----------------------
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
  global $db;
  $unload_location = $rw->dest_city .", ". $rw->dest_state;
  $unload_date = $rw->delivery_date;
  $comments = $rw->comments;
  //Check for twic notice in the comments
  $twic = 0;
  if(stripos($comments,'twic') >=0)
    $twic = 1;
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
  
  $sql  = "insert into truck_loader (driver,unload_date,location,equipment,tlength,ttype,truck_no,";
  $sql .= "telephone,comments,unload_month,unload_day,driver_status,origin_city,";
  $sql .= "origin_state,destination_city,destination_state,twic) values(";
  $sql .= "'$driver','$unload_date','$unload_location','$equipment','$tlength','$ttype','$truck_number',";
  $sql .= "'$telephone','$comment',$dmonth,$dday,0,'$ocity','$ostate','$dcity','$dstate',$twic)";
  $db->query($sql);
  QueryLog("uploader-insert driver-$sql");
}
//This sets the load origin fields in the driver
//records and any others the users want updates.
//It is used when other driver updates are not invoked.
function ShortUpdate($rw, $load_rec)
{
  global $db;
  $id = $load_rec->id;
  $ocity = $rw->origin_city;
  $ostate = $rw->origin_state;
  $ucomment = addslashes($rw->comments); 
  $sql = "update truck_loader set origin_city='$ocity', origin_state='$ostate', upload_comment='$ucomment' where id=$id";
  $db->query($sql);
  QueryLog("uploader-short update-$sql");
}
//This function uses the just uploaded table information to update
//the main loads table
function UpdateTruckloads()
{
  global $db;
  @$hdl = fopen('log.txt','w'); //log file
  $resp = new xajaxResponse();
  $ct = 0;
  //Query all of the inbound contents.
  $sql = "select * from truck_inbound";
  $inbound = $db->get_results($sql); //Read the inbound table
  if(!is_array($inbound))
  {
  	$resp->alert("Failed to read the inbound table.\nLoad table not updated.");
  	return $resp;
  }
	foreach($inbound as $rw)
  {
    $truck_number = $rw->truck_number;
    $driver = strtoupper($rw->driver);
    //Read by truck number.
    $sql = "select * from truck_loader where truck_no = '$truck_number'";
    $load_recs = $db->get_results($sql);
    //12/02/09 - Per JR add look by name
		if (!$load_recs)
		{
			$sql = "select * from truck_loader where UCASE(driver) = '$driver'";
			$load_recs = $db->get_results($sql);
		}
		//Pass if not found
    //2/11/10 - Add the load/driver inactive.
    if (!$load_recs)
    {
     if ($hdl)
      fwrite($hdl,"Added Driver: $rw->driver");
     InsertThisDriver($rw);
     continue;
    }
    //More than 1 record?
		if ($db->num_rows > 1)
		{
			$load_rec = FindLatestDelivery($load_recs);
		}
		else
		{
			$load_rec = $db->get_row($sql);
		}
		//5/3/2010 - Do not update active drivers.
		if ($load_rec->driver_status == 1)
		{
      if ($hdl)
        fwrite($hdl, ">>>Active $driver - skipped\n");
			continue;
		}
		//1/27/10 - per jr - do not alter existing record if 
		//inbound delivery date > existing unload date.
    if(1 == MonthDayCompare($load_rec->unload_date, $rw->delivery_date))
		{
      ShortUpdate($rw, $load_rec);
      $sCdate = $load_rec->unload_date;
      $sIdate = $rw->delivery_date;
      if ($hdl)
        fwrite($hdl, ">>>Skipped $driver: $sCdate >= $sIdate\n");
      continue;
    }
		   
    $id = $load_rec->id;
    $unload_location = $rw->dest_city .", ". $rw->dest_state;
    $unload_date = $rw->delivery_date;
    
    $comments = $rw->comments;
    //Check for twic notice in the comments
    $twic = 0;
    if(stripos($comments,'twic') >=0)
      $twic = 1;
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
      
    $comment = addslashes($rw->comments); 
    $equipment = addslashes($rw->equipment);
    $telephone = $rw->telephone; 
    $dmonth = $rw->delivery_month;
    $dday = $rw->delivery_day;
    $ocity = $rw->origin_city;
    $ostate = $rw->origin_state;
    $dcity = $rw->dest_city;
    $dstate = $rw->dest_state;
    $sql = "update truck_loader set location='$unload_location', unload_date='$unload_date', ";
    $sql .= "upload_comment='$comment',equipment='$equipment',unload_month=$dmonth,unload_day=$dday,  ";
    $sql .= "destination_city='$dcity',destination_state='$dstate',origin_city='$ocity', origin_state='$ostate' ";
    $sql .= "where id = $id";
    $db->query($sql);
    QueryLog("uploader-normal update-$sql");
    if ($twic = 1)
    {
      $sql="update truck_loader set twic = '1' where id = $id";
      $db->query($sql);
    }
    $ct++;
    if ($hdl)
      fwrite($hdl, "$id, $driver, $equipment, $ttype, $tlength, $dmonth, $dday\n");
  }
  fclose($hdl);
  $resp->alert("Load table update updated $ct records.");
  return $resp;
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

//Main function. Called from the browser.
function LoadInbound()
{
	global $db, $hdl, $buf;
	ini_set("auto_detect_line_endings", true);
	//Instance the XAJAX response object
	$resp = new xajaxResponse();
	//Access the import text file or puke.
	$fname = $_SESSION['uploaded_file'];
	@$hdl = fopen($fname,'r');
	if (!$hdl)
	{
		$resp->alert("Unable to open ".$fname);
		return $resp;	
	}
	/*
		Get lined up on the first Agent line.
		The data records follow the lines that 
		begin with "Agent."
		This reads the file until it finds the
		first one
	*/
	if (!SynchOnPage())
	{
		fclose($hdl);
		$resp->alert("Unable to position in the file.");
		return $resp;
	}
	
	//Empty the inbound data table
	$sql = "delete from truck_inbound";
	$db->query($sql);
	$lg = fopen('inboundlog.txt','w');
	$recCt = 0; //Reset the record counter
	//Process the records
	while (GetNextLine())
	{
		$recCt++;
		
		$buf = trim($buf); //Rid of leading tab and trailing spaces.
		if ($lg)
			fwrite($lg,$buf."\n\r");
		//Break the record into an array on the tab characters
		$flds = explode("\t",$buf);

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
		
		//They omit the space for the cell # if they don't have it.
		//This messes things up. Try to fix it by shiftine
		//everything right one position.
		if (strpos($flds[5],"(") === false && $flds[5] != '')
		{
			for ($i=13;$i>=5;$i--)
				$flds[$i] = $flds[$i-1];
			$flds[5] = '';
		}
		
    //Setup delivery date as mmm dd
    //The input only provides month and day
    $months = "JanFebMarAprMayJunJulAugSepOctNovDec";
		$mo = $flds[10];
		$ofs = ($mo * 3) - 3; //Offset into the months string
    $da = $flds[12];
    if ($da < 10)
      $da = '0'.$da;
		$del_date = substr($months,$ofs,3).' '.$da;
		$phone = $flds[5];
		
		
		
		//Construct the insert query
		$sql = "insert into truck_inbound(agent,unit,truck_number,equipment,driver,cell,";
		$sql .= "origin_city,origin_state,dest_city,dest_state,";
		$sql .= "delivery_month,delivery_day,comments, delivery_date,telephone)";
		$sql .= " values('$flds[0]','$flds[1]','$flds[2]','$flds[3]','$flds[4]','$flds[5]',";
		$sql .= "'$flds[6]','$flds[7]','$flds[8]','$flds[9]','$flds[10]',";
		$sql .= "'$flds[12]','$flds[13]','$del_date','$phone')";

		$db->query($sql);
    //QueryLog("uploader-inbound load-$sql");
	}
	//Remove any coded returns
	$sql = "update truck_inbound set comments=replace(comments,'_x000A_','\n')";
	$db->query($sql);
	if ($lg)
		fclose($lg);
	//All done. Let the user know what happened.
	$resp->alert("$fname has been loaded. Loaded $recCt records.");
	$resp->loadCommands(UpdateTruckLoads());
	return $resp;
}		
//$xajax->configure('debug',true);
$xajax->register(XAJAX_FUNCTION,'LoadInbound');
$xajax->processRequest();

GenerateSmartyPage();
?>
