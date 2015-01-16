<?php
/**
 * Some loosely hacked together PHP functions for the SLIP Future code samples.
 * 
 * Not intended for production use. Needs far better error handling and
 * more sensible function footprints. Also not to be PHP.
 */


/**
 * Function: init_oauth_client
 * 
 * Wrapper around the Google API Client Libraries to handle authentication
 * of Service Accounts. Handles authentication and storing of access tokens.
 * 
 * Returns:
 * 
 *   return Google_Client
 */
function init_oauth_client($app_name, $client_id, $service_account_email, $key_file, $scope) {
  $client = new Google_Client();
  $client->setApplicationName($app_name);
  $client->setClientId($client_id);
  $oauthClient = new Google_Auth_OAuth2($client);
  
  //if(isset($_SESSION['server_token']) and $_SESSION['server_token'] <> '')
    $token = @(array)json_decode($_SESSION["server_token"]);
  if(!empty($token) && time() <= ($token["created"] + $token["expires_in"])) {
    $oauthClient->setAccessToken($_SESSION['server_token']);
  } else {
    $oauthClient->refreshTokenWithAssertion(new Google_Auth_AssertionCredentials(
      $service_account_email,
      array($scope),
      file_get_contents($key_file)
    ));
  }

  if($oauthClient->getAccessToken()) {
    $_SESSION['server_token'] = $oauthClient->getAccessToken();
    return $oauthClient;
  }

  throw new Exception("Application needs to be authorised.");
}

/**
 * Function: curl_wrapper
 * 
 * Wrapper around cURL to abstract away all of the common guff.
 * Handles Google's requirements around POST requests and attaching
 * the OAuth access token if its in the session.
 * 
 * Returns:
 * 
 *   return array(response, curl info);
 */
function curl_wrapper($url, $options = array()) {
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt_array($ch, $options);

	$headers = array();
	// Google accepts POST data as JSON only - no form-encoded input
	if(isset($options[CURLOPT_POST]) && $options[CURLOPT_POST] == true) {
		$headers[] = "Content-Type: application/json";
	}
	if(isset($_SESSION["server_token"])) {
		$headers[] = 'Authorization: Bearer ' . json_decode($_SESSION["server_token"])->access_token;
	}
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$data = curl_exec($ch);
	$http_status = curl_getinfo($ch,CURLINFO_HTTP_CODE);
	if(!in_array(curl_getinfo($ch, CURLINFO_HTTP_CODE), array(200, 204))) {
		var_dump($data);
		throw new Exception("Received an invalid status code from server ($http_status)");
	}

	$response = array($data, curl_getinfo($ch));
	curl_close($ch);
	return $response;
}

/**
 * Function: curl_gme_with_paging
 * 
 * Wrapper around the previous cURL wrapper (it really is turtles all the way down) that handles
 * paging GME resultsets and smooths over the 1 query/second/project limit.
 * 
 * For any given GME call it will continue requesting pages
 * until the end of the resultset. Not intended for huge
 * resultssets.
 * 
 * Parameters:
 * 
 *   $base_url   - [type/description]
 *   $subelement - [type/description]
 * 
 * Returns:
 * 
 *   return A JSON string
 */
function curl_gme_with_paging($base_url, $subelement) {
	$merged_responses = array();

	do {
		$url = $base_url;
		if(isset($responseObj->nextPageToken)) {
			$url .= "&pageToken=" . $responseObj->nextPageToken;
		}

		list($response, $info) = curl_wrapper($url);
		$responseObj = json_decode($response);

		// Google imposes a max queries per second per project of 1 on most queries
		// /table/features queries are allowed higher limits as per https://developers.google.com/maps-engine/new
		// @TODO Make this smart enough to sniff for 'allowed_queries_per_second' in the response and adapt.
		if($info["total_time"] < 1) {
			usleep(1000000 - ($info["total_time"] * 1000000));
		}
		$merged_responses = array_merge($merged_responses, $responseObj->{$subelement});
	} while(isset($responseObj->nextPageToken));

	return json_encode($merged_responses);
}
?>