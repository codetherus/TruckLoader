<?php
/*
 * Copyright 2013 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
session_start();
include_once "templates/base.php";
//var_dump($_SESSION);

/************************************************
  Make an API request authenticated with a service
  account.
 ************************************************/
set_include_path("../src/" . PATH_SEPARATOR . get_include_path());
require_once 'Google/Client.php';
require_once 'Google/Service/Books.php';
require_once 'Google/Service/MapsEngine.php';
/************************************************
  Credentials
 ************************************************/
$client_id = '666322057028-6te7vq8mgofnedfhnit375arp1chvg74.apps.googleusercontent.com'; //Client ID
$service_account_name = '666322057028-6te7vq8mgofnedfhnit375arp1chvg74@developer.gserviceaccount.com'; //Email Address 
$key_file_location = 'key.p12';

echo pageHeader("Service Account Access");
if ($client_id == '<YOUR_CLIENT_ID>'
    || !strlen($service_account_name)
    || !strlen($key_file_location)) {
  echo missingServiceAccountDetailsWarning();
}

$client = new Google_Client();
$service = new Google_Service_MapsEngine($client);

/************************************************
  If we have an access token, we can carry on.
  Otherwise, we'll get one with the help of an
  assertion credential. In other examples the list
  of scopes was managed by the Client, but here
  we have to list them manually. We also supply
  the service account
 ************************************************/
if (isset($_SESSION['service_token'])) {
  $client->setAccessToken($_SESSION['service_token']);
}
$key = file_get_contents($key_file_location);
$cred = new Google_Auth_AssertionCredentials(
    $service_account_name,
    array('https://www.googleapis.com/auth/mapsengine'),
    $key
);
$client->setAssertionCredentials($cred);
if($client->getAuth()->isAccessTokenExpired()) {
  $client->getAuth()->refreshTokenWithAssertion($cred);
}
$_SESSION['service_token'] = $client->getAccessToken();
//$optparams=array('APIkey'=>'AIzaSyBn0clXv-GMWVqLYORBybTYeXjP-xKGsr0');
$results = $service->assets->listAll();
//$results = $service->layers->getPublished('13112725006252346903-12798225287603138914');//,$optparams);
echo '<pre>';
var_dump($results);
echo '</pre>';

echo pageFooter(__FILE__);
