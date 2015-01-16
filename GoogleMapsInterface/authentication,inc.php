<?php
/*
	This should do it for authentication
*/
set_include_path("google-api-php-client/src/" . PATH_SEPARATOR . get_include_path()); 
require_once 'Google/Client.php';

$client = new Google_Client();

//Credentials
$client->setApplicationName('Loads By Jake Maps');
$client->setClientId('700318837628-29bc38gesa2qk5jacq0s8kh36dso2sqo.apps.googleusercontent.com');
$client->setClientSecret('MSvchLGwaI8p93uEHESxLw3K');
$client->setRedirectUri('http://localhost/TruckLoader/GoogleMapsInterface/tester.php');
$client->setScopes('https://www.googleapis.com/auth/mapsengine');
  
	//Returning from the auth server? Authenticate
	if (isset($_GET['code'])) {
		$client->authenticate($_GET['code']);
	}

function apiCaller($url)
{
	global $client;
	
//	$url = 'https://www.googleapis.com/mapsengine/v1/tables';
	list($http_status, $response)=GetAsJson($client, $url);
    if ($http_status != 200 and $http_status != 302) {

      if(isset($response) && $response)
	   print 'Error: ' . $response->error->errors[0]->location;
  } else {
	  $_SESSION['token'] = $client->getAccessToken();
  }


//  $authUrl = $client->createAuthUrl();
//  dumpVar($authUrl,'Auth Url: ');
//  print "<a href='$authUrl'>Authorize this application</a>";
}

//Given a client object and a url make an api call
function GetAsJson($client, $url) {
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
