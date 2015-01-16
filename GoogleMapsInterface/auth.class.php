<?php
/*
	12/7/14
	Workable oAuth2 authorization class
*/
session_start();

//Load the Google API libraries
set_include_path("google-api-php-client/src/" . PATH_SEPARATOR . get_include_path()); 
require_once 'Google/Client.php';
require_once 'Google/Service/MapsEngine.php';
class google_auth
{
//Our redirect URI
$scriptUri = "http://".$_SERVER["HTTP_HOST"].$_SERVER['PHP_SELF'];

//Create and configure a Google Client instance
$client = new Google_Client();
$client->setAccessType('offline'); // default: offline
$client->setApplicationName('LBJ Maps');
$client->setClientId('700318837628-29bc38gesa2qk5jacq0s8kh36dso2sqo.apps.googleusercontent.com');
$client->setClientSecret('ZcARk-P8g8nrztOBtwSXhybF');
$client->setRedirectUri($scriptUri);
$client->setDeveloperKey('AIzaSyA-f4cS5vaVVRFtcTNSf3lGZRE1_3O-6Mo');
//Scopes for the maps engine api
$readwrite_scope = 'https://www.googleapis.com/auth/mapsengine';
$readonly_scope  = 'https://www.googleapis.com/auth/mapsengine.readonly';
$client->setScopes(array($readwrite_scope));

// $service implements the client interface, has to be set before auth call
$service = new Google_Service_MapsEngine($this->client);

// See if we have a refresh token
$refresh_token = @file_get_contents('refreshtoken.txt');
function __construct()
{
	if(strlen($refresh_token) > 0)
		$refresh_token = json_decode($refresh_token['refresh_token']);
	else
		$refresh_token = '';
	check_auth_code(); //See if we just returned from authentication
}

// The following if will execute when we are called back from the auth
// request as indicated by the $_GET['code'] value being set. 
// We simply authenticate with the code and store the token in session.
function check_auth_code()
{
	if (isset($_GET['code'])) { 
		$this->client->authenticate($_GET['code']);
		$_SESSION['token'] = $this->client->getAccessToken();
	}
}

function 
// If we have a token, extract it from session and configure client
if (isset($_SESSION['token'])) { 
    $token = $_SESSION['token'];
    $this->client->setAccessToken($token);
	if($this->client->isAccessTokenExpired()) //If the token is expired, authenticate
	{
	   //If we have a refresh token use it 
	   //else reauthorize
	   if($this->refresh_token)
	   {
			echo 'Doing a refresh token auth.<br/>';
			$this->client->refreshToken($this->refresh_token);
			$_SESSION['token'] = $this->client->getAccessToken();
			return true;
	   }
	   else
	   {
			$authUrl = $this->client->createAuthUrl();
			header("Location: ".$authUrl);
	   }
	}
	else 
	{
		return true;
	}
}

if (!$this->client->getAccessToken()) { // auth call to google if needed
    echo 'Fell through to page end. Reauthorizing<br>';
	sleep(3);
	$authUrl = $this->client->createAuthUrl();
    header("Location: ".$authUrl);
    die;
}

