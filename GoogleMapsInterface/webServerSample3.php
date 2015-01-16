<?php
set_include_path("google-api-php-client/src/" . PATH_SEPARATOR . get_include_path()); 
require_once 'Google/Client.php';
echo'<h5>In webServerSample<br></h5>';
session_start();

$client = new Google_Client();
//Credentials
$client->setApplicationName('Loads By Jake Maps');
$client->setClientId('700318837628-29bc38gesa2qk5jacq0s8kh36dso2sqo.apps.googleusercontent.com');
$client->setClientSecret('MSvchLGwaI8p93uEHESxLw3K');
$client->setRedirectUri('http://localhost/TruckLoader/GoogleMapsInterface/webServerSample.php');
$client->setScopes('https://www.googleapis.com/auth/mapsengine');

//Call back to the page that invoked us
function phoneHome()
{
  echo '<h5>In phoneHome</h5';
  $qs = $_SERVER['QUERY_STRING'];
  $qs = explode('=',$qs);
  $callback = $qs[1];
  global $client;
  $_SESSION['token'] = $client->getAccessToken();
  $_SESSION['client'] = serialize($client);
  header('Location: '.$callback);
}

//Have a token? 
if (isset($_SESSION['token'])) {
  phoneHome();
}
  
//Returning from the auth server? Authenticate and callback
if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  if (isset($_SESSION['token']))
	phoneHome();
}
//Just go home as a last resort...
phoneHome();

function returnfunct() //Callback function
{
	$tok = json_decode($_SESSION['token']);
	dumpVar($tok, 'Decoded token');
	$client = new Gogle_Client();
	$client = $_SESSION['client'];
	$url = 'https://www.googleapis.com/mapsengine/v1/tables';
	//?key=AIzaSyC10co4w836tGCev1KISYnp-_ZykPyL-IU';
	list($http_status, $response)=GetAsJson($client, $url);
    if ($http_status != 200 and $http_status != 302) {

      if(isset($response) && $response)
	   print 'Error: ' . $response->error->errors[0]->location;
  } else {
	  $_SESSION['token'] = $client->getAccessToken();
	  header('Location '.$_GET['callback']);
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