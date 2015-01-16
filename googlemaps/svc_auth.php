<?php
/*
 * 12/18/14
 * Service account authorization module
 * Derived from google-api-php-client/samples/service-account.php
 * Making an authenticated API using service account MYLBJMaps.php
 * No methods. Just using the service object to make calls.
 */
	session_start();

	//Load the requisite Google objects
	set_include_path("google-api-php-client/src". PATH_SEPARATOR . get_include_path());
	require_once 'Google/Client.php';
	require_once 'Google/Service/MapsEngine.php';
	
	require_once 'edsdevcreds.php'; 		//Our credentials
	
	class svc_auth{
	  public $client;						//Class's client instance
	  public $client_id = CLIENT_ID;		//Service account CID
	  public $service_account_name = EMAIL; //Service account Email
	  public $key_file_location = KEY_FILE; //Key file path
	  public $key;							//Key file contents
	  public $service;						//Maps Engine instance
	  public $cred;							//Assertion Credentiale
	  
	  function __construct()
	  {
		//Instance the client and maps engine objects
		$this->client  = new Google_Client();
		//$this->client->setDeveloperKey(API_KEY);
		//If the access token is available, load it
		$this->service = new Google_Service_MapsEngine($this->client);
		if (isset($_SESSION['service_token'])) {
			$this->client->setAccessToken($_SESSION['service_token']);
		}
					
		
		$this->key = file_get_contents($this->key_file_location);
		$this->cred = new Google_Auth_AssertionCredentials(
			$this->service_account_name,
			array('https://www.googleapis.com/auth/mapsengine'),
			$this->key
		);
		$this->client->setAssertionCredentials($this->cred);
		if($this->client->getAuth()->isAccessTokenExpired()) {
			$this->client->getAuth()->refreshTokenWithAssertion($this->cred);
		}
		$_SESSION['service_token'] = $this->client->getAccessToken();
	  }
	}  
