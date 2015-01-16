<?php
/*
  Copyright(c) 2009 by RSI. All rights reserved.
	This file contains all of the things common to 
	the Truck Loader application.
	Should be included at the top of all pages...
*/
ob_start();
//Session timeout controls
ini_set('session.save_path', 'sessions');
ini_set('session.gc_maxlifetime',43200);
ini_set('session.gc_probability',1);
ini_set('session.gc_divisor',1);
session_start();
//Setup the xajax framework.
include_once("xajax/xajax_core/xajax.inc.php");
$xajax = new xajax();
$xajax->configure('javascript URI', 'xajax/');
//MySQL classes for database access
include_once('ezsql/mysql/ez_sql_core.php');
include_once('ezsql/mysql/ez_sql_mysql.php');
//$db = new ezSQL_mysql('root', 'rootwdp', 'jake', 'localhost');
$db = new ezSQL_mysql('root', '', 'jake', 'localhost');
//Standard page help display procedures
require_once('page_help.php');
//Smarty templating setup
include_once("smarty_setup.php"); 
require_once("GenerateSmartyPage.php");
//Setup for administrative access.
if (isset($_SESSION['level']) && $_SESSION['level'] == 'admin')
	$smarty->assign('admin', 1);
else
	$smarty->assign('admin', 0);
$smarty->assign('foot', $smarty->fetch('footer.tpl'));  

//Login check - reditrec to login page if not logged in.
$path_parts = pathinfo($_SERVER['SCRIPT_FILENAME']);
$pg = $path_parts['basename'];
if ($pg != 'onepager.php' &&  $_SESSION['loggedin'] != true)
{
	header("Location: login.php");
}
	
?>