<?php
echo '<h1>Authorizing</h1>';
set_include_path("google-api-php-client/src/" . PATH_SEPARATOR . get_include_path()); 
require_once 'google-api-php-client/src/Google/Client.php';
require_once 'google-api-php-client/src/Google/Auth/OAuth2.php';
require_once 'google-api-php-client/src/Google/Auth/AssertionCredentials.php';

const SERVICE_ACCOUNT_EMAIL = '449323857047-722nmjaiom91e2bk6e55r9earebal8qm@developer.gserviceaccount.com';
const CLIENT_ID = '449323857047-722nmjaiom91e2bk6e55r9earebal8qm.apps.googleusercontent.com';
const KEY_FILE = 'key.p12';


$client = new Google_Client();
$client->setApplicationName('Loads By Jake Maps');
$client->setClientId(CLIENT_ID);
$oauthClient = new Google_Auth_OAuth2($client);

session_start();
unset($_SESSION['token']);//Remove for actual use...
if (isset($_SESSION['token'])) {
  $oauthClient->setAccessToken($_SESSION['token']);
} else {
  $key = file_get_contents(KEY_FILE);
  $oauthClient->refreshTokenWithAssertion(new Google_Auth_AssertionCredentials(
    SERVICE_ACCOUNT_EMAIL,
    array('https://www.googleapis.com/auth/mapsengine'),
    $key));
}

if ($oauthClient->getAccessToken()) {
	echo "Authorized<br>";
	//var_dump($oauthClient->getAccessToken());
	//die();
  // Example using only CURL (no client libraries).
  list ($http_code, $response) = GetAsJson($oauthClient, "https://www.googleapis.com/mapsengine/v1/projects?key=AIzaSyA-f4cS5vaVVRFtcTNSf3lGZRE1_3O-6Mo");
  //var_dump($response);
  
  //var_dump($http_code);
  die();
  if ($http_code != 200) {
    print 'Error: ' . $response->error->errors[0]->location;
  } else {
    foreach ($response->features as $feature) {
      print "<b>Name: </b>" . $feature->properties->name . "<br>";
    }
  }

  // We're not done yet. Remember to update the cached access token.
  $_SESSION['token'] = $oauthClient->getAccessToken();
} else {
  $authUrl = $client->createAuthUrl();
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
  var_dump($http_status);
  curl_close($ch);

  return array($http_status, json_decode($data));
}
?>