<?php
set_include_path("google-api-php-client/src/" . PATH_SEPARATOR . get_include_path()); 
require_once 'Google/Client.php';

// Set your cached access token. Remember to replace $_SESSION with a
// real database or memcached.
session_start();
dumpVar($_SESSION,'Session at page start');

$client = new Google_Client();
$client->setApplicationName('Loads By Jake Maps');

$client->setClientId('700318837628-29bc38gesa2qk5jacq0s8kh36dso2sqo.apps.googleusercontent.com');
$client->setClientSecret('MSvchLGwaI8p93uEHESxLw3K');
$client->setRedirectUri('http://localhost/TruckLoader/GoogleMapsInterface/webServerSample.php/callbackFunction');
$client->setScopes('https://www.googleapis.com/auth/mapsengine');

//Have a token? Have the client set its access token from the session
if (isset($_SESSION['token'])) {
  $client->setAccessToken($_SESSION['token']);
}

//If we have an access token, make a call
if ($client->getAccessToken()) {
  echo 'Have access token. Returning...<br/>';
  returnfunct();
}
  
dumpVar($_GET,'Get before callback function');
function callbackFunction()
{
	echo '<br>In callbackFunction<br>';
	//Back from the auth server? 
	if (isset($_GET['code'])) {
	  $client->authenticate($_GET['code']);
	  $_SESSION['token'] = $client->getAccessToken();
	  $redirect = 'http://localhost/TruckLoader/GoogleMapsInterface/webServerSample.php';
	  header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
	}
}


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
	echo '<br/>In returnfunct...<br/>';
	dumpVar($_SESSION, 'Session after authorize');
	$tok = json_decode($_SESSION['token']);
	dumpVar($tok, 'Decoded token');
	$dt = date('m/d/y H:i:sa e P',$tok->created);
	dumpVar($dt,'Token Expires');
	global $client;
	$url = 'https://www.googleapis.com/mapsengine/v1/tables';
	//?key=AIzaSyC10co4w836tGCev1KISYnp-_ZykPyL-IU';
	list($http_status, $response)=GetAsJson($client, $url);
  
  if ($http_status != 200 and $http_status != 302) {

    if(isset($response) && $response)
	 print 'Error: ' . $response->error->errors[0]->location;
  } else {
	dumpVar($response,'Response ');
  }

  // We're not done yet. Remember to update the cached access token.
  $_SESSION['token'] = $client->getAccessToken();

  $authUrl = $client->createAuthUrl();
  dumpVar($authUrl,'Auth Url: ');
  print "<a href='$authUrl'>Authorize this application</a>";
}

//Given a client object and a url
function GetAsJson($client, $url) {
  echo '<br>In getasjson<br/>';	
  $token = json_decode($client->getAccessToken());
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: Bearer ' . $token->access_token
  ));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $data = curl_exec($ch);
  $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);

  return array($http_status, json_decode($data));
}
?>