<?php
/*
  Copyright(c) 2009 by RSI. All rights reserved.
	This is the front end page for the Jakes Loads website.
*/
require_once("commons.php");
//$smarty->assign("pgtitle", "Main"); 	//Do per page.
$smarty->assign("domenu", 0);
function go()
{
	$resp = new xajaxResponse();
	$resp->redirect("login.php");
	return $resp;
}
//$xajax->configure('debug',true);
$xajax->register(XAJAX_FUNCTION,"go");
$xajax->processRequest();
GenerateSmartyPage();
?>