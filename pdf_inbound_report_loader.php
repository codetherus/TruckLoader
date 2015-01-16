<?php 
/*
	Copyright(c) 2009 by RSI. All rights reserved.
	This page loads the inbound truck daily report.
	Goes into table "truck_inbound."
	1/10/10 - Use the later unload date input or stored.
*/
//--------------------------- Page Setup Stuff -----------------------------------------
require_once("commons.php");
define("INBOUND_FILES_DIRECTORY", "./inbound_pdf_files/");
$smarty->assign("pgtitle", "PDF File Upload"); 	//Do per page.
$smarty->assign("domenu", 1);
$hdl = '';	//Input file handle
$buf = '';	//Input file line buffer
//--------------------- Loads table update functions -----------------------
//$xajax->configure('debug',true);
$xajax->register(XAJAX_FUNCTION,'LoadInbound');
$xajax->processRequest();

GenerateSmartyPage();
?>
