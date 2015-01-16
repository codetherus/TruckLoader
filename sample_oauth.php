<?php
require 'commons.php';
set_include_path("gapc/src/" . PATH_SEPARATOR . get_include_path());
require_once 'Google/Client.php';
require_once 'gapc/app_keys.php';
// Set your cached access token. Remember to replace $_SESSION with a
// real database or memcached.
session_start();

$client = new Google_Client();
$client->setApplicationName('API Project');

// Visit https://code.google.com/apis/console?api=plus to generate your
// client id, client secret, and to register your redirect uri.
$client->setClientId($clientId);
$client->setClientSecret($clientSecret);
$client->setRedirectUri('http://localhost/Truck%20Loader/sample_oauth.php');
$client->setScopes('https://www.googleapis.com/auth/mapsengine');
echo '$_SERVER:';
echo '<pre>';
var_dump($_SERVER);
echo '</pre>';

if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['token'] = $client->getAccessToken();
  $redirect = 'http://' . $_SERVER['HTTP_HOST'] .'/Truck$20Loader/'. $_SERVER['PHP_SELF'];
  echo '$redirect: '.$redirect.'<br/>';
  header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
}
echo '$_SESSION:';
echo '<pre>';
var_dump($_SESSION);
echo '</pre>';

echo '$_GET:';
echo '<pre>';
var_dump($_GET);
echo '</pre>';

if (isset($_SESSION['token'])) {
  $client->setAccessToken($_SESSION['token']);
}

if ($client->getAccessToken()) {
  // Example using only CURL (no client libraries).
  list ($http_code, $response) = GetAsJson($client, "https://www.googleapis.com/mapsengine/v1/tables/YOUR_TABLE_ID/features");
echo '<pre>';
echo '$http_code and $response:';

var_dump($http_code,$response);
echo '</pre>';
  
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
  echo 'Auth URL: '.$authUrl;
  print "<a href='$authUrl'>Authorize this application</a>";
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