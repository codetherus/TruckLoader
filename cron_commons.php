<?php
/*
  Copyright(c) 2009 by RSI. All rights reserved.
	This file contains all of the things needed to 
	run a page as a cron job on the site.
*/
//MySQL classes for database access
include_once('ezsql/mysql/ez_sql_core.php');
include_once('ezsql/mysql/ez_sql_mysql.php');
include('dbsettings.php');
$db = new ezSQL_mysql($dbuser, $dbpassword, $dbdatabase, $dbhost);
?>