<?php
/*
	This file contains the LBJ maps engine
	authentication functionallity.
	It should be included just after the commons inclusions 
	on a page that uses it...
*/

/*
	Read the token out of the database.
	Its key is 'auth_token'
	Returns false or array of token parts.
*/
function readStoredToken()
{
	global $db;
	$row = $db->get_row("select item_value from google_maps_items where item_name = 'auth_token'");
	if (!$row)
	{
		return false;
	}
	$token_parts = (array)json_decode($row->item_value);
	return $token_parts;
}
//Write the token to the database
function saveToken($token)
{
	global $db;
	//Remove if stored
	if(readStoredToken())
	  $db->query("delete from google_maps_items where item_name = 'auth_token'");
	
	$db->query("insert into google_maps_items('item_name','item_value')
               values('auth_token','$token')");	
}
/*
	See if we have already authenticated.
	If not, do it now.
*/

function checkAuthentication($callbackUrl)
{
	//Check for an auth token and go to the calback url if present.
	if (readStoredToken())
	{
		header('Location: '.$callbackUrl);
	}
	require_once 'Google/Client.php'; //Load the Google client code
	require_once 'gapc/app_keys.php'; //Load our app. keys

	$client = new Google_Client();
	$client->setApplicationName('API Project');

	// Visit https://code.google.com/apis/console?api=plus to generate your
	// client id, client secret, and to register your redirect uri.
	$client->setClientId($clientId);
	$client->setClientSecret($clientSecret);
	$client->setRedirectUri('http://localhost/Truck%20Loader/sample_oauth.php');
	$client->setScopes('https://www.googleapis.com/auth/mapsengine');

	/*
		If $_GET['code'] is set then we have been called 
		back by the authentication call.
		
		Authenticate using the code returned.
		Save the token.
		
	*/



	if (isset($_GET['code'])) {
	  $client->authenticate($_GET['code']);
	  $_SESSION['token'] = $client->getAccessToken();
	  $redirect = 'http://' . $_SERVER['HTTP_HOST'] .'/Truck$20Loader/'. $_SERVER['PHP_SELF'];
	  header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
	}

	if (isset($_SESSION['token'])) {
	  $client->setAccessToken($_SESSION['token']);
	}

	if ($client->getAccessToken()) {
	  // Example using only CURL (no client libraries).
	  list ($http_code, $response) = GetAsJson($client, "https://www.googleapis.com/mapsengine/v1/tables/YOUR_TABLE_ID/features");
	  
	  if ($http_code != 200) {
		print 'Error: ' . $response->error->errors[0]->location;
	  } else {
		foreach ($response->features as $feature) {
		  print "<b>Name: </b>" . $feature->properties->name . "<br>";
		}
	  }

	  // We're not done yet. Remember to update the cached access token.
	  $_SESSION['token'] = $client->getAccessToken();
	} else {
	  $authUrl = $client->createAuthUrl();
	  print "<a href='$authUrl'>Authorize this application</a>";
	}
}
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
?>