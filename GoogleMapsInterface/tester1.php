<?php
//Caller to the server sample to authenticate
set_include_path("google-api-php-client/src/" . PATH_SEPARATOR . get_include_path()); 
require_once 'Google/Client.php';
include 'authentication.inc.php';

session_start();
$url = 'https://www.googleapis.com/mapsengine/v1/tables';
if(isset($_SESSION['token']))
    makeAnAPICall($url);

//Call the authenticator if necessary
if(!isset($_SESSION['token']))
{
	//Been there already?
	//Not yet. Set the session var and go to the auth page	
	echo '<br>Calling webServerSample<br/>';
	header('Location: webServerSample.php?callbackURI=authcaller.php');
}

//If we get here, assume we are authenticated...
if(!isset($_SESSION['token']))
	die('Auth really failed...');

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

	
//Handler when we return authenticated
function makeAnAPICall($url)
{
	
	global $client;
	$token = json_decode($_SESSION['token']);
	
	//?key=AIzaSyC10co4w836tGCev1KISYnp-_ZykPyL-IU';
	list($http_status, $response)=GetAsJson($client, $url);
    if ($http_status != 200 and $http_status != 302) {

      if(isset($response) && $response)
	   print 'Error: ' . $response->error->errors[0]->location;
  } else {
	dumpVar($response,'API Call Response');
  }
}	


