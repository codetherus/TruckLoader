<?php
/*
	This page is derived from the php library example (examples/serviceaccount.php)
	of using a service account

	We are going to use this page for authentication in the LBJ maps interface. It will
	be included early on in any interface page
*/
//Load all of the library classes we sill need for any interface processing.
set_include_path("google-api-php-client/src/" . PATH_SEPARATOR . get_include_path()); 
require_once 'Google/Client.php';
require_once 'Google/Auth/OAuth2.php';
require_once 'Google/Auth/AssertionCredentials.php';


//Our Credentials
const SERVICE_ACCOUNT_EMAIL = '700318837628-29bc38gesa2qk5jacq0s8kh36dso2sqo@developer.gserviceaccount.com';
const KEY_FILE = '6b7572153895d9460162fe748e09e1bb8029118c-privatekey.p12';
const CLIENT_ID = '700318837628-29bc38gesa2qk5jacq0s8kh36dso2sqo.apps.googleusercontent.com';
const API_KEY = 'AIzaSyCJlBL5qE8WT0xJsEjYp2OfRNlVjaEkN04';
const CLIENT_SECRET = 'MSvchLGwaI8p93uEHESxLw3K';				
$client = new Google_Client();
$client->setApplicationName('Loads By Jake Maps');
$client->setClientId(CLIENT_ID);
$oauthClient = new Google_Auth_OAuth2($client);

//Auth server callback handler
function handleAuthCallback()
{
	echo 'AuthCallback entered.<br/>';
}

function doCallback($callback)
{
	if (function_exists($callback)){
		call_user_func($callback);
      }else{
		die('Invalid auth callback function '.$callback);;
	}	
}	

function authorizeUs($callback)
{
	global $client, $oauthClient;
	
	//Do we already have an acess token?
	//If so use it else refresh it
	if (isset($_SESSION['token'])) {
	  $oauthClient->setAccessToken($_SESSION['token']);
	  doCallback($callback);
	} else {
	  $key = file_get_contents(KEY_FILE);
	  $oauthClient->refreshTokenWithAssertion(new Google_Auth_AssertionCredentials(
		SERVICE_ACCOUNT_EMAIL,
		array('https://www.googleapis.com/auth/mapsengine'), //basic maps r/w endpoint
		$key));
	}

	//If we have a token, save it and call the callback function
	if ($oauthClient->getAccessToken()) {
	  $_SESSION['token'] = $oauthClient->getAccessToken();
	  doCallBack($callback);
	}  
}
/*
  // Example using only CURL (no client libraries).
  list ($http_code, $response) = GetAsJson($oauthClient, "https://www.googleapis.com/mapsengine/v1/tables/13112725006252346903/listTables");
  echo 'HTTPCode: '.$http_code;
  if ($http_code != 200)
  {
	 if(isset($response) && $response)
	 {
       echo 'Error: ' . $response->error->errors[0]->location;
	   die;
	 }
	 $authUrl = $client->createAuthUrl('https://www.googleapis.com/mapsengine/');
		print "<a href='$authUrl'>Authorize this application</a>";
 
  }
  else {
    echo 'Authorized<br/>';
    doCallback($callback);
}
*/
//Make calls using CURL. //We may use this for all calls...
function GetAsJson($client, $url) {
  global $oauthClient;	
  $token = json_decode($oauthClient->getAccessToken());
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: Bearer ' . $token->access_token
  ));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $data = curl_exec($ch);
  $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  if(curl_error($ch))
   echo 'Error String: ' . curl_error($ch);
  curl_close($ch);
  print_r($data);
  echo '<br>';	
  return array($http_status, json_decode($data));
}
?>