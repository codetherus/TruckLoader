<?php

//lets other scripts know that this file has been included
define('CONFIG_LOADED', true);

//application root
define('ROOT', dirname(__FILE__).DIRECTORY_SEPARATOR);

//output errors to brower
ini_set('display_errors', true);

//level of errors to log/display
ini_set('error_reporting', E_ALL);

//log errors
ini_set('log_errors', true);

//file for error logging
ini_set('error_log', ROOT.'logs/error_log');

//load Module class for magic class loading
require_once ROOT.'libraries/Module.php';

//specify directories that contain classes
Module::addRepository('ROOT', ROOT);
Module::import('ROOT:models');
Module::import('ROOT:models:base');
Module::import('ROOT:libraries:dabl');
Module::import('ROOT:libraries:dabl:query');
Module::import('ROOT:libraries');
Module::import('ROOT:libraries:dabl:adapter');
if(!class_exists('PDO')) Module::import('ROOT:libraries:PDO');

$db_connections['my_connection_name'] = array(
	'driver' => 'mysql',
	'host' => 'localhost',
	'dbname' => 'jake',
	'user' => 'root',
	'password' => ''
);

//connect to database(s)
foreach($db_connections as $connection_name => $db_params){
	Module::import('ROOT:libraries:dabl:adapter:'.$db_params['driver']);
	try{
		DBManager::addConnection($connection_name, $db_params);
	}
	catch(Exception $e){
		throw new Exception($e->getMessage());
	}
}

function stripslashes_array($array) {
	return is_array($array) ? array_map('stripslashes_array', $array) : stripslashes($array);
}

function strip_request_slashes(){
    $_COOKIE = stripslashes_array($_COOKIE);
    $_GET = stripslashes_array($_GET);
    $_POST = stripslashes_array($_POST);
    $_REQUEST = stripslashes_array($_REQUEST);
}

//Strip added slashes if needed
if (get_magic_quotes_gpc()) strip_request_slashes();