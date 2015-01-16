<?php
/*
  5/18/11
  easywsdl generated classes for the
  Truckstop.com load searching web service.
*/
class ArrayOfstring{
var $string;//string
}
class ArrayOfError{
var $Error;//Error
}
class Error{
var $ErrorMessage;//string
var $Suggestions;//ArrayOfstring
}
class RequestBase{
var $IntegrationId = 2655;//int
var $Password = 'aie5Ty89';//string
var $UserName = 'Ami@nana';//string
}
class ReturnBase{
var $Errors;//ArrayOfError
}
class LoadSearchRequest extends RequestBase{
  var $Criteria;//LoadSearchCriteria
  function __construct(){
    $this->Criteria = new LoadSearchCriteria();
  }
}

class LoadSearchCriteria{
var $DestinationCity;//string
var $DestinationCountry;//string
var $DestinationRange;//int
var $DestinationState;//string
var $EquipmentType;//string
var $HoursOld;//int
var $LoadType;//LoadType
var $OriginCity;//string
var $OriginCountry;//string
var $OriginLatitude;//int
var $OriginLongitude;//int
var $OriginRange;//int
var $OriginState;//string
var $PickupDate;//dateTime
}
class LoadDetailRequest{
var $LoadId;//int
}
class LoadSearchReturn{
var $SearchResults;//ArrayOfLoadSearchItem
}
class ArrayOfLoadSearchItem{
var $LoadSearchItem;//LoadSearchItem
}
class LoadSearchItem{
var $Age;//string
var $Bond;//int
var $BondEnabled;//boolean
var $BondTypeID;//int
var $CompanyName;//string
var $Days2Pay;//string
var $DestinationCity;//string
var $DestinationCountry;//string
var $DestinationDistance;//int
var $DestinationState;//string
var $Equipment;//string
var $ExperienceFactor;//string
var $FuelCost;//string
var $ID;//int
var $IsFriend;//boolean
var $Length;//string
var $LoadType;//LoadType
var $Miles;//string
var $OriginCity;//string
var $OriginCountry;//string
var $OriginDistance;//int
var $OriginState;//string
var $Payment;//string
var $PickUpDate;//string
var $PointOfContactPhone;//string
var $PricePerGall;//decimal
var $Weight;//string
}
class LoadDetailReturn{
var $LoadDetail;//LoadDetailResult
}
class LoadDetailResult{
var $Bond;//int
var $BondTypeID;//int
var $Credit;//string
var $DOTNumber;//string
var $DeliveryDate;//string
var $DeliveryTime;//string
var $DestinationCity;//string
var $DestinationState;//string
var $DestinationZip;//string
var $Distance;//string
var $Entered;//dateTime
var $Equipment;//string
var $FuelCost;//string
var $HasBonding;//boolean
var $ID;//int
var $Length;//string
var $LoadType;//LoadType
var $MCNumber;//string
var $Mileage;//string
var $OriginCity;//string
var $OriginState;//string
var $OriginZip;//string
var $PaymentAmount;//string
var $PickupDate;//string
var $PickupTime;//string
var $PointOfContact;//string
var $PointOfContactPhone;//string
var $Quantity;//string
var $SpecInfo;//string
var $Stops;//string
var $TMCNumber;//string
var $TruckCompanyCity;//string
var $TruckCompanyEmail;//string
var $TruckCompanyFax;//string
var $TruckCompanyName;//string
var $TruckCompanyPhone;//string
var $TruckCompanyState;//string
var $Weight;//string
var $Width;//string
}
class GetLoadSearchResults extends RequestBase{
var $searchRequest;//LoadSearchRequest
}
class GetLoadSearchResultsResponse{
var $GetLoadSearchResultsResult;//LoadSearchReturn
}
class GetLoadSearchDetailResult{
var $detailRequest;//LoadDetailRequest
}
class GetLoadSearchDetailResultResponse{
var $GetLoadSearchDetailResultResult;//LoadDetailReturn
}
class TruckStopLoadSearch 
 {
 var $soapClient;
 
private static $classmap = array('ArrayOfstring'=>'ArrayOfstring'
,'ArrayOfError'=>'ArrayOfError'
,'Error'=>'Error'
,'RequestBase'=>'RequestBase'
,'ReturnBase'=>'ReturnBase'
,'LoadSearchRequest'=>'LoadSearchRequest'
,'LoadSearchCriteria'=>'LoadSearchCriteria'
,'LoadDetailRequest'=>'LoadDetailRequest'
,'LoadSearchReturn'=>'LoadSearchReturn'
,'ArrayOfLoadSearchItem'=>'ArrayOfLoadSearchItem'
,'LoadSearchItem'=>'LoadSearchItem'
,'LoadDetailReturn'=>'LoadDetailReturn'
,'LoadDetailResult'=>'LoadDetailResult'
,'GetLoadSearchResults'=>'GetLoadSearchResults'
,'GetLoadSearchResultsResponse'=>'GetLoadSearchResultsResponse'
,'GetLoadSearchDetailResult'=>'GetLoadSearchDetailResult'
,'GetLoadSearchDetailResultResponse'=>'GetLoadSearchDetailResultResponse'

);

 function __construct($url='http://testws.truckstop.com:8080/v7/Searching/LoadSearch.svc?wsdl')
 {
  $this->soapClient = new SoapClient($url,array("classmap"=>self::$classmap,"trace" => true,"exceptions" => true));
 }
 
function GetLoadSearchResults($GetLoadSearchResults)
{

$GetLoadSearchResultsResponse = $this->soapClient->GetLoadSearchResults($GetLoadSearchResults);
return $GetLoadSearchResultsResponse;

}
function GetLoadSearchDetailResult($GetLoadSearchDetailResult)
{

$GetLoadSearchDetailResultResponse = $this->soapClient->GetLoadSearchDetailResult($GetLoadSearchDetailResult);
return $GetLoadSearchDetailResultResponse;

}}


?>