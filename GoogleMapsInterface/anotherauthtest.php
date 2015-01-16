<?php
/*
	12/7/14
	Workable oAuth2 authorization module
*/
session_start();

//Load the Google API libraries
set_include_path("google-api-php-client/src/" . PATH_SEPARATOR . get_include_path()); 
require_once 'Google/Client.php';
require_once 'Google/Service/MapsEngine.php';

//Our redirect URI - back to us...
$scriptUri = "http://".$_SERVER["HTTP_HOST"].$_SERVER['PHP_SELF'];

//Create and configure a Google Client instance
$client = new Google_Client();
$client->setAccessType('offline'); // default: offline
$client->setApplicationName('Maps for Loads by Jake');
$client->setClientId('700318837628-29bc38gesa2qk5jacq0s8kh36dso2sqo.apps.googleusercontent.com');
$client->setClientSecret('ZcARk-P8g8nrztOBtwSXhybF');
$client->setRedirectUri($scriptUri);
$client->setDeveloperKey('AIzaSyA-f4cS5vaVVRFtcTNSf3lGZRE1_3O-6Mo');

//Scopes for the maps engine api
$readwrite_scope = 'https://www.googleapis.com/auth/mapsengine';
$readonly_scope  = 'https://www.googleapis.com/auth/mapsengine.readonly';
$client->setScopes(array($readwrite_scope));

// $service implements the client interface, has to be set before auth call
$service = new Google_Service_MapsEngine($client);
// See if we have a refresh token
$refresh_token = @file_get_contents('refreshtoken.txt');
if(strlen($refresh_token) > 0)
	$refresh_token = json_decode($refresh_token['refresh_token']);
else
    $refresh_token = '';

// The following if will execute when we are called back from the auth
// request as indicated by the $_GET['code'] value being set. 
// We simply authenticate with the code and store the token in session.
if (isset($_GET['code'])) { 
	var_dump($_GET);
	$client->authenticate($_GET['code']);
    $_SESSION['token'] = $client->getAccessToken();
}

// If we have a token, extract it from session and configure client
if (isset($_SESSION['token'])) { 
    $token = $_SESSION['token'];
    $client->setAccessToken($token);
	if($client->isAccessTokenExpired()) //If the token is expired, authenticate
	{
	   //If we have a refresh token use it 
	   //else reauthorize
	   if($refresh_token != '')
	   {
			echo 'Doing a refresh token auth.<br?>';
			$client->refreshToken($refresh_token);
			$_SESSION['token'] = $client->getAccessToken();
			header("Location: ".$_SESSION['callback']);
	   }
	   else
	   {
			$authUrl = $client->createAuthUrl();
			echo 'Auth url: '.$authUrl.'<br>';
			header("Location: ".$authUrl);
	   }
	}
	else if(isset($_SESSION['callback']))//Else return to the calling page
	{
		echo 'Good token. No action taken. Going to callback<br/>';
		sleep(3);
		header("Location: ".$_SESSION['callback']); //Return to the calling page
	}
	else
	{
		echo 'Auth module called without a callback specified.';
		die();
	}
}

if (!$client->getAccessToken()) { // auth call to google if needed
    echo 'Fell through to page end. Reauthorizing<br>';
	sleep(3);
	$authUrl = $client->createAuthUrl();
    header("Location: ".$authUrl);
    die;
}

