<?php
/*
  This module implements the InternetTruckstop.com's
  web service for searching on their site from
  loadsbyjake.com.

*/
//System commons/configuration
//require_once("commons.php");
//ob_end_flush();
//System utilities
//require_once("utilityV2.php");
//easywsdl generated classes for the truckstop posting api.
require_once('includes/truckstoploadsearch.class.php');
//Main function
function LoadSearch()
{

  $debugging = false; //Controls debug output to the browser
  //Instance the truckstop api class
  $loadsearch = new TruckstopLoadSearch();
  $request = new GetLoadSearchResults();
  $request->searchRequest = new LoadSearchCriteria();
  
  $response = new LoadSearchReturn;
  $request->searchRequest->OriginCity = 'Seattle';
  $request->searchRequest->OriginState = 'Wa';
  $request->searchRequest->OriginRange = 200;
  $request->searchRequest->HoursOld = 0;
  $request->searchRequest->LoadType = 'All';
  $request->searchRequest->EquipmentType = 'F';
  
  
  try{
    $response = $loadsearch->GetLoadSearchResults($request);
  }catch(Exception $e){
    echo 'Error: '.$e->GetMessage().'<br/>';
    echo '<h2>Request:</h2>';
    var_dump($request);
    echo '<h2>Response</h2>';
    var_dump($response);

  }
  //var_dump($response);
}
LoadSearch();
?>
