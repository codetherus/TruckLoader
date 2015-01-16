<?php
/*
  This page uses the Internet Truckstop's
  web service gettrucks to retrieve the 
  detail about a single truck.
*/

//Load and instance the truck stop class
require ('includes/easytruck.class.php');
$truckstop = new truckstop();
$request = new GetTruckDetailResults();
$request->detailRequest = new TruckDetailRequest;
$request->detailRequest->TruckId = 33262763;
try{
$response = new GetTrucksResponse();
$response = $truckstop->GetTruckDetailResults($request);
//print_r($response);
}catch(Exception $e){
  echo $e->getMessage();
  echo '<br/><br/>Request Headers:<br/>';
  echo '<pre>'.$truckstop->soapClient->__getLastRequestHeaders().'</pre>';
  echo '<br/><br/>Request:<br/>';
  echo '<pre>'.$truckstop->soapClient->__getLastRequest().'</pre>';
  echo '<br/>Response Headers:<br/>';
  echo '<pre>'.$truckstop->soapClient->__getLastResponseHeaders().'</pre>';
  echo '<br/>Response:<br/>';
  echo '<pre>'.$truckstop->soapClient->__getLastResponse().'</pre>';

}
print_r($response);
/*
foreach($response->GetTrucksResult->Errors as $er)
  echo '<br/>Error Message: '.$er->ErrorMessage.'<br/>';
*/

?>