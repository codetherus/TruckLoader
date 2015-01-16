<?php
/*
  PHP soap services test
*/
//ini_set('display_errors', 0);

//Truckstop.com web service endpoint
$wsdl = 'http://testws.truckstop.com:8080/V4/Posting/TruckPosting.svc?wsdl';

//Instance a client object
$client = new SoapClient($wsdl);
/*//Check for construction errors
$err = $client->getError();
if ($err) {
	echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
	echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->getDebug(), ENT_QUOTES) . '</pre>';
	exit();
}
//A couple of settings to do utf-8
$client->soap_defencoding = 'UTF-8'; 
$client->decode_utf8 = true;
*/
//Dummy array of trucks
$trucks[]=array(  'OriginCity' => 'Nome',
                  'OriginState' => 'AK',
                  'DestinationCity' => 'Yellowknife',
                  'DestinationState' => 'NT',
                  'SpecialInformation' => 'TEST LOAD - PLEASE DO NOT CALL');
//Parameter array for calling truckstop
$params = array(
  'IntegrationId' => '2655',
  'UserName' => 'Ami@nana',
  'Password' => 'aie5Ty89',
  'Trucks' =>   $trucks);

echo '<h2>Calling Truck Stop</h2>';
$op ='PostTrucks';
//Do the call.
try{
  $result = $client->PostTrucks($params);
}
catch(Exception $e){
  echo $e->getMessage();
}  
//    'http://testws.truckstop.com:8080/V4/Posting/PostTrucks',
//    'http://testws.truckstop.com:8080/V4/Posting/PostTrucks');
echo 'Result:<br/>';
print_r($result);
/*// Display the request and response
echo '<h2>Request</h2>';
echo '<pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
echo '<h2>Response</h2>';
echo '<pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
*/
?>