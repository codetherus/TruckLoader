<?php
/*
  Copyright(c) 2009 by RSI. All rights reserved.
	This file contains all of the things common to 
	the Truck Loader application.
	Must be included at the top of all batch style
  pages
*/
//ob_start();
//Session timeout controls
//This path MUST be the full path on the Windows box.
ini_set('session.save_path', 'C:\\wamp\\www\\Truck Loader\\sessions');
//On the linux server on the host it is this:
//ini_set('session.save_path', 'sessions');
ini_set('session.gc_maxlifetime',43200);
ini_set('session.gc_probability',1);
ini_set('session.gc_divisor',1);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();

//MySQL classes for database access
include_once('ezsql/mysql/ez_sql_core.php');
include_once('ezsql/mysql/ez_sql_mysql.php');
include('dbsettings.php');
//Global database class instance
$db = new ezSQL_mysql($dbuser, $dbpassword, $dbdatabase, $dbhost);
?>