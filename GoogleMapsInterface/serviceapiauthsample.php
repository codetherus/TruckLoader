<?php
/*
	This page is derived from the php library example (examples/serviceaccount.php)
	of using a service account

	We are going to use this page for authentication in the LBJ maps interface. It will
	be included early on in any interface page
*/
session_start();
//Load all of the library classes we sill need for any interface processing.
set_include_path("google-api-php-client/src/" . PATH_SEPARATOR . get_include_path()); 
require_once 'Google/Client.php';
require_once 'Google/Auth/OAuth2.php';
require_once 'Google/Auth/AssertionCredentials.php';
require_once 'Google/Service/MapsEngine.php';

//Required Credentials
const SERVICE_ACCOUNT_EMAIL = '449323857047-722nmjaiom91e2bk6e55r9earebal8qm@developer.gserviceaccount.com';
const KEY_FILE = '6b7572153895d9460162fe748e09e1bb8029118c-privatekey.p12';


$client = new Google_Client();
$client->setApplicationName('Loads By Jake Maps');
$client->setClientId('449323857047-722nmjaiom91e2bk6e55r9earebal8qm.apps.googleusercontent.com');
//var_dump($client);
$oauthClient = new Google_Auth_OAuth2($client);

//Do we already have an acess token?
//If so use it else refresh it
if (isset($_SESSION['token'])) {
  $oauthClient->setAccessToken($_SESSION['token']);
} else {
  $key = file_get_contents(KEY_FILE);
  $oauthClient->refreshTokenWithAssertion(new Google_Auth_AssertionCredentials(
    SERVICE_ACCOUNT_EMAIL,
    array('https://www.googleapis.com/auth/mapsengine'), //basic maps endpoint
    $key));
}

//If we have a token, save it and call the callback function
if ($oauthClient->getAccessToken()) {
  $_SESSION['token'] = $oauthClient->getAccessToken();
  if (isset($_SESSION['auth_callback'])){
	$func = $_SESSION['auth_callback'];
	if (function_exists($func)){
    $func();
	}else{
		die ('Invalid auth callback function '.$func);
	}
  }	
}  

/*
  // Example using only CURL (no client libraries).
  list ($http_code, $response) = GetAsJson($oauthClient, "https://www.googleapis.com/mapsengine/v1/tables/13112725006252346903/listTables");

    //var_dump($http_code,$response);
//  die();
  if ($http_code != 200)
  {
	 if(isset($response and $response)
	 {
       echo 'Error: ' . $response->error->errors[0]->location;
	   die;
	 }
  }
  
  
  
} else {
    $authUrl = $client->createAuthUrl();
    print "<a href='$authUrl'>Authorize this application</a>";
}

//Make calls using CURL. //We may use this forall calls...
function GetAsJson($client, $url) {
  $token = json_decode($client->getAccessToken());
  //var_dump($token);
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: Bearer ' . $token->access_token
  ));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $data = curl_exec($ch);
  
  $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);

  return array($http_status, json_decode($data));
}*/
?>