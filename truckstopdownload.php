<?php
/*
  This page uses thw Internet Truckstop's
  web service gettrucks to retrieve a list of our 
  posted trucks.
*/
//ini_set("soap.wsdl_cache_enabled", 0); //Don't cache anything...

//Load and instance the truck stop class
require ('includes/easytruck.class.php');
$truckstop = new truckstop();
$rb = new GetTrucks();
$rb->listRequest = new ListRequest();
try{
$ro = new GetTrucksResponse();
$ro = $truckstop->GetTrucks($rb);
//print_r($ro);
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
print_r($ro);
/*
foreach($ro->GetTrucksResult->Errors as $er)
  echo '<br/>Error Message: '.$er->ErrorMessage.'<br/>';
*/

?>