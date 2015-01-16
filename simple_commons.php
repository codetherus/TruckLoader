<?php
/*
	11/6/14
	Simple commons for pages without user intervention.
	Only contains session, xajax and ez_sql database.
	LOCAL VERSION
*/
ob_start();
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

?>