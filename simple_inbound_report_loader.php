<?php 
/*
	Copyright(c) 2009 by RSI. All rights reserved.
	This page loads the inbound truck daily report.
	Goes into table "truck_inbound."
	
	Note: commons not used here so we can setup the
	SWFUpload requirements
*/
//--------------------------- Page Setup Stuff -----------------------------------------
ob_start();
session_start();
define("INBOUND_FILES_DIRECTORY", "./inbound_files/");
//Setup the xajax framework.
//MySQL classes for database access
include_once('ezsql/mysql/ez_sql_core.php');
include_once('ezsql/mysql/ez_sql_mysql.php');
$db = new ezSQL_mysql('root', 'rootwdp', 'jake', 'localhost');
//Smarty templating setup
include_once("smarty_setup.php"); 
require_once("GenerateSmartyPage.php");
$smarty->assign("pgtitle", "Daily Inbound Truck File Upload"); 	//Do per page.
$hdl = '';	//Input file handle
$buf = '';	//Input file line buffer
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
	return false;
}

//Read up to the first line beginning with "Agent"
function SynchOnPage()
{
	global $hdl, $buf;
	while (!feof($hdl))
	{
		$buf = fgets($hdl);
		if (strpos($buf, 'Agent') !== false)
			return true;
	}
	return false;
}

//Main function. Called from the browser.
function LoadInbound($fname)
{
	global $db, $hdl, $buf;
	$_POST['msg'] = "Starting inbound table load";
	//Access the import text file or puke.
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
	
	$recCt = 0; //Reset the record counter
	//Process the records
	while (GetNextLine())
	{
		$recCt++;
		
		$buf = trim($buf);

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
		
		//Combine the delivery month and day
		$del_date = $flds[10].'/'.$flds[12];
		
		
		//Construct the insert query
		$sql = "insert into truck_inbound(agent,unit,truck_number,equipment,driver,cell,";
		$sql .= "origin_city,origin_state,dest_city,dest_state,";
		$sql .= "delivery_month,delivery_day,comments, delivery_date)";
		$sql .= " values('$flds[0]','$flds[1]','$flds[2]','$flds[3]','$flds[4]','$flds[5]',";
		$sql .= "'$flds[6]','$flds[7]','$flds[8]','$flds[9]','$flds[10]',";
		$sql .= "'$flds[12]','$flds[13]','$del_date')";

		$db->query($sql);
	}
}		
//The upload handler
function uploader() {
  $upload = $_FILES['inbound_upload'];
  $srcFile = $upload['tmp_name'];
  $uploadedFile = INBOUND_FILES_DIRECTORY . $upload['name'];
  if (move_uploaded_file($srcFile, $uploadedFile))
	LoadInbound($uploadedFile);
}
if($_FILES['inbound_upload'])
	uploader();
GenerateSmartyPage();
?>
