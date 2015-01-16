<?php 
/*
	Copyright(c) 2009 by RSI. All rights reserved.
	This page loads the inbound truck daily report.
	Goes into table "truck_inbound."
	
	Note: commons not used here so we can setup the
	SWFUpload requirements
	Note: This page is not used. See inbound_report_loader.php.
*/
//--------------------------- Page Setup Stuff -----------------------------------------
//ob_start();
session_start();
define("INBOUND_FILES_DIRECTORY", "./inbound_files/");
//Setup the xajax framework.
include_once("xajax/xajax_core/xajax.inc.php");
$xajax = new xajax();
require_once 'xajax/xajax_plugins/request/swfupload/swfupload.inc.php';
$xajax->configure('javascript URI', 'xajax/');
$xajax->autoCompressJavaScript("xajax/xajax_plugins/request/swfupload/swfupload.js",true);
$xajax->autoCompressJavaScript("xajax/xajax_plugins/request/swfupload/swfupload.xajax.js",true);
$xajax->autoCompressJavaScript("xajax/xajax_plugins/request/swfupload/swfupload.queue.js",true);

//MySQL classes for database access
include_once('ezsql/mysql/ez_sql_core.php');
include_once('ezsql/mysql/ez_sql_mysql.php');
$db = new ezSQL_mysql('root', '', 'jake', 'localhost');
//Standard page help display procedures
include_once('includes/page_help.php');
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

//Read up to the first line beginning with "Agent."
//That marks the start of the info we want.
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

//Main function. Called from the upload routine.
//The parameter is the path of the uploaded file.
function LoadInbound($fname)
{
	global $db, $hdl, $buf;
	
	//Instance the XAJAX response object
	$resp = new xajaxResponse();
  $resp->alert("Processing $fname");
  return $resp;
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
	//All done. Let the user know what happened.
	$resp->alert("$fpath has been loaded. Loaded $recCt records.");
	return $resp;
}	

//The upload handler
function uploader($aFormValues) {
  $resp = new xajaxResponse();

	//Isolate the uploaded file info.
  $upload = $_FILES['inbound_upload'];

	//Report an error
  if ($upload->error != 0)
  {
		$resp->alert("Upload failed with error code $upload->error");
    return $resp;
  }
	
	//Move the file to the inbound folder.
	//Fail if an error occurs.
  $srcFile = $upload->tmp_name;
  $uploadedFile = INBOUND_FILES_DIRECTORY . $upload->name;
  if (!move_uploaded_file($srcFile, $uploadedFile))
  {
		$resp->alert('Unable to move '.$srcFile.' to '.$uploadedFile);
    return $resp;
  }
  $resp->loadCommands(LoadInbound($uploadedFile));
	return $resp;
}
	
$xajax->configure('debug',true);	
$xajax->register(XAJAX_FUNCTION,"uploader",array("mode" => "'SWFupload'","SWFform" => "'upload_form'"));
$xajax->register(XAJAX_FUNCTION,"transform");
$xajax->processRequest();
//--------------------------------- SWF Upload Handlers -----------------------------	
//Setup the SWF upload stuff...
function transform() {
	if (isset($_POST['PHPSESSID'])) {
		session_id($_POST['PHPSESSID']);
	}

	$resp = new xajaxResponse();
	$resp->clsSwfUpload->transForm('upload_form'
																				,array(
																					"file_types" => "*.txt;"
																					,"file_types_description" => "Text Files"
																					,"file_size_limit" => "5 MB"
																					,"upload_complete_handler" => "function () {
																																					}"
																					,"post_params" => array(
																						"PHPSESSID" => session_id()
																					)																				
																				)
																				, false
																				);
	return $resp;
}

GenerateSmartyPage();
?>
