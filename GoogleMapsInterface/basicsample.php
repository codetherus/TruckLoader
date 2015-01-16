<?php
  set_include_path("google-api-php-client/src/" . PATH_SEPARATOR . get_include_path());
  require_once 'Google/Client.php';
  require_once 'Google/Service/MapsEngine.php';
  $client = new Google_Client();
  $client->setApplicationName("Client_Library_Examples");
  $client->setDeveloperKey("AIzaSyBL5nmdAh7bBajELSUnwstkcXhKZ6U1kNk");
  $service = new Google_Service_MapsEngine($client);
  $results = $service->maps->listMaps('700318837628');
	var_dump($results);
  