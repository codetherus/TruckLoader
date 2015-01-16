<?php 
/*
	Copyright(c) 2009 by RSI. All rights reserved.
	This page is used to upload a csv of the main truck_load table
	and import it into the main table in the database.
	Should be a one shot before production...
*/
//--------------------------- Page Setup Stuff -----------------------------------------
require_once("commons.php");
define("INBOUND_FILES_DIRECTORY", "./inbound_files/");
$smarty->assign("pgtitle", "Truck Loader Upload and Import"); 
$smarty->assign("domenu", 1);
$hdl = '';	//Input file handle
$buf = '';	//Input file line buffer
//--------------------- Loads table updat functions -----------------------
//-----------------------------------Uploaded File Handlers -----------------------------------------
/*
	Make the filemaker date into a mmm dd
*/
function ConvertDate($dt)
{
	if ($dt == '0') return ' '; //If no date just bail.
	// File maker format is like: Jul 9, 2009
	$i = strpos($dt,',');
	if ($i === false) return 'no comma';
	$s = substr($dt,0,$i);
	if(strlen($s) < 6)
		$s = substr($s,0,4).'0'.substr($s,4,1);
	return $s;
}
//Main function. Called from the browser.
//Loads the uuploaded file into the database.
function LoadInbound()
{
	global $db, $hdl, $buf;
	
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
	$s = fgets($hdl); //header line
	//Empty the inbound data table
	$sql = "delete from truck_loader";
	$db->query($sql);
	
	$recCt = 0; //Reset the record counter
	//Process the records
	while (($flds = fgetcsv($hdl, 4096))!== false)
	{
		$recCt++;
		for($i=0;$i<count($flds);$i++)
		{
			$flds[$i] = str_replace('_x000A_',' ',$flds[$i]);
			$flds[$i] = addslashes($flds[$i]);
		}	
		$driver = $flds[2];
		$driver = strtoupper($driver);
		$unloaddate = ConvertDate($flds[3]);
		$location = $flds[4];
		$equipment = $flds[5];
		$equipment = strtoupper($equipment);
		$hometown = $flds[6];
		$preferences = $flds[7];
		$truckno = $flds[8];
		$telephone = $flds[9];
		$comments = $flds[10];
		$loadoptions = $flds[11];
		$loadscompleted = $flds[12];
		$homeoffice = $flds[13];
		$officenumbers = $flds[14];
		$messagevoicemail = $flds[15];
		$canada = $flds[16];
		$nocanada = $flds[17];
		$twic = $flds[18];
		$notwic = $flds[19];
		$f4tarps = $flds[20];
		$f6tarps = $flds[21];
		$f8tarps = $flds[22];
		$notarps = $flds[23];
		$pipestakes = $flds[24];
		$nopipestakes = $flds[25];
		$drivinglimitations = $flds[26];
		$loadlevelers = $flds[27];
		$noloadlevelers = $flds[28];
		
		
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
    $ttype = ''; 
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
    else
      $ttype = "Unknown";

    $equipment = addslashes($flds[5]);	//Retrieve the original for user reference.

		$sql  = "insert into truck_loader(driver,unload_date,equipment,tlength,ttype,home_town,preferences,";
		$sql .= "truck_no,telephone,comments,home_office,office_numbers,message_voice_mail,canada,no_canada,";
		$sql .= "twic,no_twic,f4ft_tarps,f6ft_tarps,f8ft_tarps,pipe_stakes,no_pipe_stakes,driving_limitations,";
		$sql .= "load_levelers,no_load_levelers,load_options,loads_completed)";
		$sql .= " values('$driver','$unloaddate','$equipment','$tlength','$ttype','$hometown','$preferences',";
		$sql .= "'$truckno','$telephone',";
		$sql .= "'$comments','$homeoffice','$officenumbers','$messagevoicemail','$canada','$nocanada','$twic','$notwic',";
		$sql .= "'f4tarps','$f6tarps','$f8tarps','$pipestakes','$nopipestakes','$drivinglimitations',";
		$sql .= "'$loadlevelers','$$noloadlevelers','$loadoptions',";
		$sql .="'$loadscompleted')";	
		$db->query($sql);
	}
	fclose($hdl);
	//All done. Let the user know what happened.
	$resp->alert("$fname has been loaded. Loaded $recCt records.");
	return $resp;
}		
//$xajax->configure('debug',true);
$xajax->register(XAJAX_FUNCTION,'LoadInbound');
$xajax->processRequest();
GenerateSmartyPage();
?>
