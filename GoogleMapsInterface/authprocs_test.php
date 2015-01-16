<?php
//Test the authprocs.php functionallity
set_include_path("google-api-php-client/src/" . PATH_SEPARATOR . get_include_path()); 
require_once 'Google/Service.php';
require_once 'Google/Service/Resource.php';
require_once 'Google/Service/MapsEngine.php';
//start with an empty session
include 'authprocs.php';

authorizeUs('returnfunct'); //Run the authorization

//Utility variable display
//$var - the variable to dump
//$label - Optional var description
function dumpVar($var, $label='')
{
	echo'<pre>';
	echo $label.'<br/>';
	var_dump($var);
	echo '<br/>';
	echo '</pre>';
}

function returnfunct() //Callback function
{
	dumpVar($_SESSION, 'Session after authorize');
	$tok = json_decode($_SESSION['token']);
	dumpVar($tok, 'Decoded token');
	$dt = date('m/d/y h:i:sa e P',$tok->created);
	dumpVar($dt,'Token Expires');
	global $client;
	$url = 'https://www.googleapis.com/mapsengine/v1/projects';//tables?projectId=lbjmapsproject1?key='.API_KEY;
	list($http_status, $response)=GetAsJson($client, $url);
	echo 'Get as JSON call result<br/>';
	echo 'HTTP Status: ';
	echo $http_status;
	echo '<br/>Response<br/>';
	var_dump($response);
}

