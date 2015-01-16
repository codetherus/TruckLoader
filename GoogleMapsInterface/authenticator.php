<?php
/*
	LBJ Maps IF authentication module derived from
	the google-api-php-client example file service-account.php
	
	When the class is instantiated it reads the credentials from 
	the database.
	
	The caller then calls the authenticate method which returns
	true if a token is set in $_SESSION['service_token'] or false 
	if there was a problem.
	
 */
set_include_path("google-api-php-client/src/" . PATH_SEPARATOR . get_include_path()); 
require_once 'Google/Client.php';
require_once 'Google/Service/MapsEngine.php';

class lbj_authenticator{
	public $client_id = '700318837628-29bc38gesa2qk5jacq0s8kh36dso2sqo.apps.googleusercontent.com'; //Client ID
	public $service_account_name = '700318837628-29bc38gesa2qk5jacq0s8kh36dso2sqo@developer.gserviceaccount.com'; //Email - accounts email not yours
	public $key_file_location = 'privatekey.p12'; //key file name
	public $db;
	public $client;
	public $service;
	public $token;
	public $refresh_token;
	
	public function __construct($database)
	{
	  $this->db = $database; //Read and write credentials and token
	  $this->client = new Google_Client();
	  $this->client->setApplicationName("Loads by Jake Maps Interface");
	  $this->service = new Google_Service_MapsEngine($this->client);
	  $this->load_credentials();
	  $this->refresh_token = file_get_contents('refreshtoken.txt');
	}
	
	//Given an item_name return the item_value
	public function read_one_cred($key)
	{
	  $sql = "select item_value from google_maps_items where item_name = '$key'";
	  $val = $this->db->get_var($sql);
	  var_dump($key .'='.$val);
	  return $val;
	}
		
	public function load_credentials()
	{
	  $this->clientid = $this->read_one_cred('clientid');
	  $this->service_account_name = $this->read_one_cred('emailAddress');
	  $this->key_file_location = $this->read_one_cred('key_file_name');
	  
	  if($this->client_id === false or 
	     $this->service_account_name === false or
		 $this->key_file_location === false)
		 throw new Exception('Failed to load one or more credentials.');
	}
	
	
	/************************************************
	  If we have an access token, we can carry on.
	  Otherwise, we'll get one with the help of an
	  assertion credential. In other examples the list
	  of scopes was managed by the Client, but here
	  we have to list them manually. We also supply
	  the service account
	 ************************************************/
	public function authenticate()
	{
	  $result = false;
	  if (isset($_SESSION['service_token'])) {
	    $this->client->setAccessToken($_SESSION['service_token']);
	  }
	  else
	  {
	  $key = file_get_contents($this->key_file_location);
	  $cred = new Google_Auth_AssertionCredentials(
		$this->service_account_name,
		array('https://www.googleapis.com/auth/mapsengine.offline'),
		$key
	    );*/
	  //$this->client->setAssertionCredentials($cred);
	  //if($this->client->getAuth()->isAccessTokenExpired()) {
	    //$this->client->getAuth()->refreshTokenWithAssertion($cred);
		$this->client->refreshToken($this->refresh_token);
	  }
	  
	  $_SESSION['service_token'] = $this->client->getAccessToken();
	  var_dump($_SESSION);
	  
	  $this->token = $this->client->getAccessToken();
	  $this->save_token();
	  $result = true;
	  return $result;
    }
	
	public function save_token()
	{
	  $sql = "update googls_maps_items, set 'item_value' = '$this->token'";
	  if (! $this->db->query($sql))
	    throw new Exception('Failed to store the authorization token.');
	}
}	


