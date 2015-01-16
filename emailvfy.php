<?php
/*
  Simple test of the Internet Truckstop web services
  for posting trucke to their boards.
*/
// Pull in the NuSOAP code
require_once('NuSoap/lib/nusoap.php');
$debug = 1;
$endp = 'http://ws.cdyne.com/emailverify/Emailvernotestemail.asmx?wsdl';
// Create the client instance
$client = new nusoap_client($endp); 
$err = $client->getError();
if ($err) {
    // Display the error
    echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
    // At this point, you know the call that follows will fail
}

//May not work due to the dummy integration id...
$params = array(
  'email' => 'edrobinsinjr@gmail.com');
$result = $client->call('VerifyEmail', $params);
print_r($result);
?>
