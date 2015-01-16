<?php
/*
	Development testing page
*/

session_start();
$_SESSION['access_token'] = @file_get_contents('currentToken.tok');

//Load Libraries
set_include_path("google-api-php-client/src/" . PATH_SEPARATOR . get_include_path()); 
require_once 'Google/Client.php';
require_once 'Google/Auth/OAuth2.php';
require_once 'Google/Service/MapsEngine.php';

$client = '';
$mengine = '';
$refreshToken = file_get_contents('refreshtoken.txt');
//Create a Google Client instance and
//set it up
function setupClient()
{
	global $client,$mengine;
	$client = new Google_Client();

	//Credentials
	$client->setApplicationName('700318837628-29bc38gesa2qk5jacq0s8kh36dso2sqo@developer.gserviceaccount.com');
	$client->setClientId('700318837628-29bc38gesa2qk5jacq0s8kh36dso2sqo.apps.googleusercontent.com');
	$client->setClientSecret('MSvchLGwaI8p93uEHESxLw3K');
	$client->setRedirectUri('http://localhost/TruckLoader/GoogleMapsInterface/tester.php');
	$client->setScopes('https://www.googleapis.com/auth/mapsengine');
	$client->setDeveloperKey('AIzaSyC10co4w836tGCev1KISYnp-_ZykPyL-IU');
	$client->setAccessType('offline');
	$mengine = new Google_Service_MapsEngine($client);

}

setupClient();
checkGet();
checkExpiredToken();
makeApiCall();

//The GET['code'] wll be set on return from the
//auth servers and we will obtain a token by
//authenticating with it.
function checkGet()
{
	global $client;
	if (isset($_GET['code'])) {
	  $client->authenticate($_GET['code']);
	  $_SESSION['access_token'] = $client->getAccessToken();
	  //Save the token to disk
	  file_put_contents('currentToken.tok', $_SESSION['access_token']);
	  //Redirect back to ourselves
	  $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
	  header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
	}
}	

//When we find that the token is expired
//this function creates the URL to authorization
//and calls it.
function GetNewToken()
{
  global $client;
  $authUrl = $client->createAuthUrl();
  $ch = curl_init($authUrl);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  $data = curl_exec($ch);
  echo '<br>CURL authorize return<br>';
  var_dump($data);
  if(curl_errno($ch))
    echo 'Curl error: '.curl_errno($ch).'  ' . curl_error($ch);
  $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);
  echo '<br>New Token Fetch HTTP Status: '.$http_status.'<br>';
}

//We have a token. If it is expired, reauthorize 
//else procede with an api call.
function checkExpiredToken()
{
	global $client,$refreshToken;
	$_SESSION['access_token'] = @file_get_contents('currentToken.tok');
	$client->setAccessToken($_SESSION['access_token']);
	if($client->isAccessTokenExpired())
	{
		getNewToken();
	}
}

//Test making a particular api call
function MakeApiCall()
{
	global $client,$mengine;
/*	
	//Table creation
	$tbl = new Google_Service_MapsEngine_Table();
	$tbl->setFiles('MapTrucks.csv');
	$tbl->setProjectId('13112725006252346903');
	$tbl->setName("MapTrucks");

*/

/* 
	//Map creation
	$map = new Google_Service_MapsEngine_Map();
	$map->setName('LBJ Map');
	$map->setDescription('Loads by Jake Main Map');
	$map->setProjectId('13112725006252346903');
	$map->setBbox(array(126.4, 25.5, -59.07, 49.78)); 
	$res = $mengine->maps->create($map);
*/
	$layer = new Google_Service_MapsEngine_Layer();
	$layer->setId('13112725006252346903-12921502713420913455');
	$layer->setLayerType('vector');
	$res = $mengine->layers->patch('13112725006252346903-12921502713420913455',$layer);
	//File upload to table
//	$res = $mengine->tables->upload('13112725006252346903-14495543923251622067',
										 //'MapTrucks.csv');
	var_dump($res);
	echo '<br><br>';
	print_r($res);
}
/*
	$curl = curl_init($url);
	$token = json_decode($client->getAccessToken());
	curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl,CURLOPT_HTTPHEADER,array('Authorization: Bearer ' . $token->access_token));
	$fh = fopen('MapTrucks.csv', 'r');
	if(!$fh)
	 die ('Cannot open input file.');
	curl_setopt($curl,CURLOPT_PUT, true);
	curl_setopt($curl,CURLOPT_INFILE,$fh);
	curl_setopt($curl,CURLOPT_HTTPGET,false);
	$filesize = filesize('MapTrucks.csv');
	curl_setopt($curl,CURLOPT_INFILESIZE,$filesize);
	$data = curl_exec($curl);
	var_dump(json_decode($data));
	if(curl_errno($curl))
    echo 'Curl error: '.curl_errno($curl).'  ' . curl_error($ch);
	$http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	curl_close($curl);
	echo '<br>HTTP Status = '.$http_status.'<br>';
*/


	//$content = file_get_contents('MapTrucks.csv');
	//CURLPost('MapTrucks.php',$client,$url,$content);
	
	
	/*	
	$url = 'https://www.googleapis.com/mapsengine/v1/maps';//?projectId=700318837628';//&key=AIzaSyC10co4w836tGCev1KISYnp-_ZykPyL-IU';

	$res = GetAsJson($client,$url);
	echo '<br>Query Response:<br>';
	var_dump($res);
	$response = $res[1];
	echo '<br><br>';
	
	echo '<br/>Response Dump<br/>';
	foreach($response['tables'] as $item)
	{
	   echo '<br>Item:-------------------------<br>';
	   foreach($item as $key => $val)
        if(!is_array($val))
		  echo $key.' = '.$val.'<br/>';
		else
		{
		  echo 'array: '.$key.'<br>';
		  foreach($val as $elem)
			echo $elem.'<br>';
		}
    }		
*/
//Given a client object and a url make an api call
function GetAsJson($client, $url) {
  $token = json_decode($client->getAccessToken());
    echo '<br>API URL: '.$url.'<br>';
    
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: Bearer ' . $token->access_token
  ));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_HTTPGET, true);
  curl_setopt($ch, CURLOPT_VERBOSE, true);
  $data = curl_exec($ch);
  if(curl_errno($ch))
    echo 'Curl error: '.curl_errno($ch).'  ' . curl_error($ch);
  $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);

  return array($http_status, json_decode($data));
}

//Function used to post to a table asset
function CURLPost($filename,$client,$url,$content)
{
	$token = json_decode($client->getAccessToken());
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: Bearer ' . $token->access_token
    ));
	
	
	curl_setopt($ch, CURLOPT_POST,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	$res = curl_exec($ch);
	if(curl_errno($ch))
      echo 'Curl error: '.curl_errno($ch).'  ' . curl_error($ch);
	$http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);
	return array($http_status, $res);
}