<?php
/*
  Copyright(c) 2009 by RSI. All rights reserved.
	This is the login page for the Jakes Loads website.
*/
require_once("commons.php");
//$smarty->debugging = true;					//Use the Smarty debug display.
$smarty->assign("pgtitle", "Login"); 	//Do per page.
$smarty->assign("domenu", 0);
function login($dta)
{
	global $db;
	$resp = new xajaxResponse();
	extract($dta);
	if ($user == '' || $password == '')
	{
		$resp->alert("Invalid user id and/or password.\nPlease try again.");
		return $resp;
	}
	$sql = "select * from users where user = '$user' and password = '$password'";
	$res = $db->get_row($sql);
	if (!$res)
	{
		$resp->alert("Invalid user id and/or password.\nPlease try again.");
		return $resp;
	}
	
	//Setup the session vars and go to the search page.
	$_SESSION['loggedin'] = true;
	$_SESSION['user'] = $user;
	$_SESSION['userid'] = $res->id;
	$_SESSION['level'] = $res->level;
	$resp->redirect("search.php");
	return $resp;
}
//$xajax->configure('debug',true);
$xajax->register(XAJAX_FUNCTION,"login");
$xajax->processRequest();
GenerateSmartyPage();
?>