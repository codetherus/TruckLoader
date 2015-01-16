<?php
/*
  Load history management page
*/
require_once("commons.php");
require_once("utility.php");
$smarty->assign("pgtitle", "Load History Management"); 
$smarty->assign("domenu", 1);

//Display all available PDFs
function MakePDFList($dta)
{
  $resp = new xajaxResponse();
  $flist = scandir("./inbound_pdf_files");
  $s ="<table border=1>\n";
  foreach($flist as $fname)
  {
    if(is_file("./inbound_pdf_files/$fname"))
      $s .= "<tr><td><a onclick='xajax_usepdf(\"$fname\")'>$fname</a></td></tr>\n";
  }
  $s .= "</table>\n";
  $resp->assign("selectedpdf","innerHTML",$s);
  $resp->script("xajax.$('selectedpdf').style.display = 'inline-block'");
  return $resp;
}
//Setup the PDF for this load history
function usepdf($fname)
{
  $_SESSION['selected_pdf'] = $fname; //Save for insert.
  $resp = new xajaxResponse();
  //File names are formatted corpID driver name
  //We get the corpid and add it to the screen
  $i = strpos($fname,' ');
  $s = substr($fname,0,$i);
  $s = strtoupper($s);
  $resp->assign("corp_id", "value", $s);
  $resp->assign("contract_pdf","value", $fname);
  $resp->script("xajax.$('selectedpdf').style.display = 'none'");
  return $resp;
}
//Create a new load history record
function InsertHistory($dta)
{
  global $db;
  extract($dta);
  $driver_id = $_SESSION['lastid']; //Loads FK
  //Read the PDF file into a string
	$pdfname = $_SESSION['selected_pdf'];
  $sql = "insert into load_history (driverid,pickup_date,unload_date, ";
  $sql .= "source,destination,corp_id,contract_pdf,notes) ";
  $sql .= "values($driver_id,'$pickup_date','$unload_date','$source','$destination', ";
  $sql .= "'$corp_id','$pdfname','$notes')";
  $res = @$db->query($sql);
  
  $resp = new xajaxResponse();
  if (!$res)
  {
  	$resp->alert("Insert failed... $sql");
  }
  else
  {
  	$_SESSION['last_history'] = $db->insert_id;
    $old_name = "./inbound_pdf_files/".$pdfname;
		$new_name = "./linked_pdf_files/".$pdfname;
		//Remove a pdf of the same name in linked files
		if(file_exists($new_name))
		  if(!file_exists($oldName))
			  unlink($new_name);
		if(file_exists($oldname))
		  rename($old_name, $new_name);
		$resp->assign("contract_pdf","value", $pdfname);
		$resp->alert("Load history inserted.");
  }
  return $resp;
}
//User has changed the PDF assigned to the 
//load. This requires some shuff'ling
function SetupNewPDF($newpdf,$oldpdf)
{
  //See if this pdf has already been assigned.
  $i = strpos($newpdf,' '); 
  $s = strtoupper(substr($fname,0,$i)); //Get the corp id #
  $linkedload = readHistoryByCorpId($s);
  if($linkedload !== false)
  {
    $load = readLoad($linkedload->driverid);
    return "This PDF has already been assigned to $linkedload->driver";
  }
  
  //New pdf must be in inbound files
  $newpath = "./inbound_pdf_files/".$newpdf;
  if (!file_exists($newpath))
    return "$newpdf not found in new PDFs.";
}
function UpdateRecord($dta)
{
  global $db;
	$resp = new xajaxResponse();
	if ($_SESSION['last_history'] == '')
	{
    $resp->alert("Must read or insert before updating.");
    return $resp;
  }
  $id = $_SESSION['last_history'];
  $lh = readHistory($id);
  if (!$lh)
  {
    $resp->alert("Cannot find record to update.");
    return $resp;
  }
  
  foreach($dta as $vlu)
    $vlu = quote_smart($vlu);
  extract($dta);
  //Did the user change the pdf?
/*
  if ($contract_pdf != $lh->contract_pdf)
  {
    $x = SetupNewPDF($contract_pdf,$lh->contract_pdf);
    if ($x !== true)
    {
      $resp->alert($x);
      return $resp;
    }
  }
*/

  $sql  = "update load_history set ";
  $sql .= "pickup_date = '$pickup_date', unload_date='$unload_date', source='$source', ";
  $sql .= "destination='$destination',corp_id='$corp_id',contract_pdf='$contract_pdf',notes='$notes' ";
  $sql .= "where id= $id";
  $db->query($sql);
  if ($db->rows_affected > 0)
    $resp->alert("Record Updated.");
  else
    $resp->alert("Update failed. SQL= $sql");
  return $resp;  
}

function DeleteRecord()
{
  global $db;
	$resp = new xajaxResponse();
	if ($_SESSION['last_history'] == '')
	{
    $resp->alert("Cannot delete. No record id available.");
    return $resp;
  }
  $id = $_SESSION['last_history'];
  $sql = "delete from load_history where id = $id";
  $db->query($sql);
  if ($db->rows_affected > 0)
    $resp->alert("Reord Deleted.");
  else
    $resp->alert("Failed to delete record.");
  return $resp;
  
}
//Show the pdf for this record.
//Read by the corp id #
function ShowPdf($dta)
{
  global $db;
	$resp = new xajaxResponse();
	extract($dta);
	//Use the pdf file name from the screen.
	//Allows to view before inserting...
	if ($contract_pdf == '')
	{
		$resp->alert("No PDF name was provided.");
		return $resp;
	}
	$fname = "./linked_pdf_files/".$contract_pdf;
	if (!file_exists($fname))
	{
		$fname="./inbound_pdf_files/".$contract_pdf;
		if (!file_exists($fname))
		{
			$resp->alert("Unable to locate the PDF file.");
			return $resp;
		}
	}
	
	$s = "<embed width='98%' height='900px' type='application/pdf' src='$fname'/>";
	$resp->assign("pdfbox","innerHTML",$s);
	$resp->script("xajax.$('pdfbox').style.display='inline-block'");
  return $resp;
}
//List all for the driver with links to show on screen
function listHistorys()
{
  global $db;
	$resp = new xajaxResponse();
	$driver_id = $_SESSION['lastid']; //Loads FK
	$sql = "select * from load_history where driverid = $driver_id";
	$res = $db->get_results($sql);
	if (!$res)
	{
		$resp->alert("No records found for this driver.");
		return $resp;
	}
	$s = "<table border='1' style='color:black'>\n";
	$s .= "<tr><th>&nbsp;<th>Source<th>Pickup Date<th>Destination<th>Unload Date<th>Corp #</tr>\n";
	foreach($res as $rw)
	{
    $id = $rw->id;
    $link = "<a href='#' onclick='xajax_displayHistory($id)'>View</a>";
    $s .= "<tr><td>$link</td><td>$rw->source</td><td>$rw->pickup_date</td>";
    $s .= "<td>$rw->destination</td><td>$rw->unload_date</td><td>$rw->corp_id</td></tr>\n";
  }
  $s .= "</table>";
  $display = $s;
  $s = "<br/><center><input type='button' value='Close' onclick='fb.end();' /><br/><br/></center";
	$s .= '<div style="margin-left: 100px; text-align:left">';
	$s .= $display;
	$s .= "</div>";
	$s .= "<br/><center><input type='button' value='Close' onclick='fb.end();' /><br/></center";
	//Setup to display the floatbox window.
	$resp->assign("floatboxcontent","innerHTML", $s);
	$resp->script("fb.loadAnchor('#floatboxcontent')");
	return $resp;
}
function displayHistory($id)
{
  global $db;
	$resp = new xajaxResponse();
	$resp->script("fb.end()");
  //1. Get the load history record
  $sql = "select * from load_history where id = $id";
  $rw = $db->get_row($sql);
  if (!$rw)
  {
    $resp->alert("Record not found.");
    return $resp;
  }
  $_SESSION['last_history'] = $id;
  //2. Get the driver record.
  $drv = readLoad($rw->driverid);
  $resp->assign("corp_id", "value", $rw->corp_id);
  $resp->assign("driver","value", $drv->driver);
  $resp->assign("source", "value", $rw->source);
  $resp->assign("destination","value",$rw->destination);
  $resp->assign("pickup_date","value",$rw->pickup_date);
  $resp->assign("unload_date","value",$rw->unload_date);
  $resp->assign("contract_pdf","value",$rw->contract_pdf);
  $resp->assign("notes","text",$rw->notes);
  return $resp;
}
function processEdit($op, $dta)
{
  $resp = new xajaxResponse();
  if ($op == 'update')
  	return UpdateRecord($dta);
  else if ($op == 'delete')
  	return DeleteRecord($dta);
  else if ($op == 'selectpdf')
    return MakePDFList($dta);
  else if ($op == 'insert')
    return InsertHistory($dta);
  else if ($op == 'viewpdf')
    return ShowPdf($dta);
  else if ($op == 'list')
    return listHistorys();
  else
  {
  	$resp->alert("Invalid edit operation code: $op");
    return $resp;
  }
}
$xajax->configure('debug',true);
$xajax->register(XAJAX_FUNCTION,'processEdit');
$xajax->register(XAJAX_FUNCTION,'usepdf');
$xajax->register(XAJAX_FUNCTION,'displayHistory');
$xajax->processRequest();
//Setup the page on entry
function InitialPageLoad()
{
  global $db, $smarty;
  $_SESSION['last_history'] = ''; //Id of the last history inserted or read.
  $driver_id = $_SESSION['lastid']; //Loads FK
  $sql = "select * from truck_loader where id = $driver_id";
  $rw = $db->get_row($sql);
  $smarty->assign('driver', $rw->driver);
  $smarty->assign('destination', $rw->location);
}

InitialPageLoad();
GenerateSmartyPage();
?>
