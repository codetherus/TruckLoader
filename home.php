<?php
/*
  Copyright(c) 2009 by RSI. All rights reserved.
	This is the index/login page for the Jakes Loads website.
*/
require_once("commons.php");
//Clear the session variables
$_SESSION = array();									//Clear the session array.
$_SESSION['loggedin'] = false;				//Set the common variables.
//$smarty->debugging = true;					//Use the Smarty debug display.
$smarty->assign("pgtitle", "Home"); 	//Do per page.
$smarty->assign("domenu", 0);
GenerateSmartyPage();
?>