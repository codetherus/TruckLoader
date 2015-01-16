<?php
/*
  Copyright(c) 2009 by RSI. All rights reserved.
	This file contains all of the things common to 
	the Truck Loader application.
	Must be included at the top of all PHP pages...
*/
ob_start();
//Session timeout controls
//This path MUST be the full path on the Windows box.
/*ini_set('session.save_path', 'C:\wamp\www\Truck Loader\sessions');
//On the linux server on the host it is this:
//ini_set('session.save_path', 'sessions');
ini_set('session.gc_maxlifetime',43200);
ini_set('session.gc_probability',1);
ini_set('session.gc_divisor',1);*/
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();
//Setup the xajax framework.
include_once("xajax/xajax_core/xajax.inc.php");
$xajax = new xajax();
$xajax->configure('javascript URI', 'xajax/');
//MySQL classes for database access
include_once('ezsql/mysql/ez_sql_core.php');
include_once('ezsql/mysql/ez_sql_mysql.php');
include('dbsettings.php');
$db = new ezSQL_mysql($dbuser, $dbpassword, $dbdatabase, $dbhost);
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
$smarty->assign("theme",$_SESSION['theme']);  
//Login check - redirect to login page if not logged in.
/*
$path_parts = pathinfo($_SERVER['SCRIPT_FILENAME']);
$pg = $path_parts['basename'];
if ($pg != 'index.php' &&
    $pg != 'login.php' && 
    $pg != 'brokerlistv2.php' && 
    $pg != 'getquote.php' && 
    $pg != 'activetrucks.php' &&
    $_SESSION['loggedin'] != true)
{
	header("Location: index.php");
}
*/
// Theme change.
function theme($theme)
{
  global $db;
  $resp = new xajaxResponse();  
  $current_theme = $_SESSION['theme'];  
  if ($current_theme == '')  
    $current_theme = 'truckloaderv2';
  $current_theme = 'styles/'.$current_theme.'.css';
  $resp->removeCSS($current_theme);  
  if ($theme == '')  
    $theme = 'truckloader';  
  $_SESSION['theme'] = $theme;  
  $sql = "update users set theme = '$theme' where id = " .$_SESSION['userid'];
  $db->query($sql);
  $theme = "styles/$theme.css";  
  $resp->includeCSS($theme);
  $resp->waitforCSS();
  return $resp;  
}

//Global search page handler function
//op is the table name and id is the record id.
function ProcessSearch($op,$id)
{
  $resp = new xajaxResponse();  
  $_SESSION['swapid'] = $id;
  if ($op == 'drivers')
    $resp->redirect("drivers.php");
  else if ($op == 'loads')
    $resp->redirect("loads.php");
  else if ($op == 'users')
    $resp->redirect("user_editorv2.php");
  else if ($op == 'brokers')
    $resp->redirect("broker_editor.php");

  return $resp;
}
$xajax->register(XAJAX_FUNCTION,'theme');
$xajax->register(XAJAX_FUNCTION,'ProcessSearch');
?>