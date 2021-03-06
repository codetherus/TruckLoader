<?php
/*
  05/2011
  Classes generated by easywsdl for the InternetTruckstop.com
  truck posting web service.
  See the Truckstop TruckstopPostingApi.pdf file for 
  some documentation.
  
  Do not regenerate using the same file name 
  as local modifications will be overwritten.
  
*/
class ArrayOfstring{
var $string;//string
}
class ArrayOfint{
var $int;//int
}
class ArrayOfTrailerOptionType{
var $TrailerOptionType;//TrailerOptionType
}
class ArrayOfError{
var $Error;//Error
}
class Error{
var $ErrorMessage;//string
var $Suggestions;//ArrayOfstring
}
class RequestBase{
  public $IntegrationId = 282324;//2655;//int
  public $Password = 'aie5Ty89';//string
  public $UserName = 'Ami@nana';//string
}
class ListRequest extends RequestBase{
}
class ReturnBase{
var $Errors;//ArrayOfError
}
class ArrayOfTruck{
var $Truck;//Truck
}
class Truck{
var $DateAvailable;//dateTime
var $DestinationCity;//string
var $DestinationCountry;//string
var $DestinationState;//string
var $EquipmentOptions;//ArrayOfTrailerOptionType
var $EquipmentType;//string
var $IsLoadFull;//boolean
var $Length;//string
var $MinDistance;//string
var $OriginCity;//string
var $OriginCountry;//string
var $OriginRadius;//int
var $OriginState;//string
var $Quantity;//int
var $RatePerMile;//string
var $SpecInfo;//string
var $TimeAvailable;//string
var $TruckID;//int
var $TruckMultiDest;//string
var $Weight;//string
var $Width;//string
}
class TruckPostingReturn{
var $TruckIds;//ArrayOfint
}
class TruckDetailRequest extends RequestBase{
var $TruckId;//int
}
class TruckDetailReturn{
var $TruckDetail;//TruckDetailResult
}
class TruckDetailResult{
var $CarrierRating;//string
var $DOTNumber;//string
var $DateTruckAvailable;//string
var $DestinationCity;//string
var $DestinationState;//string
var $DispatchName;//string
var $DispatchPhone;//string
var $Entered;//dateTime
var $Equipment;//string
var $EquipmentOptions;//ArrayOfTrailerOptionType
var $HasFileCheck;//boolean
var $ID;//int
var $IsFullTruck;//boolean
var $Length;//string
var $MCNumber;//string
var $MinMiles;//string
var $OriginCity;//string
var $OriginState;//string
var $PerMile;//double
var $PercentFull;//string
var $PointOfContact;//string
var $PointOfContactPhone;//string
var $Quantity;//string
var $SpecInfo;//string
var $TCAMember;//boolean
var $TMCNumber;//string
var $TimeTruckAvailable;//string
var $TruckCompanyCity;//string
var $TruckCompanyEmail;//string
var $TruckCompanyFax;//string
var $TruckCompanyName;//string
var $TruckCompanyPhone;//string
var $TruckCompanyState;//string
var $TruckDesiredDirection;//string
var $Weight;//string
var $Width;//string
}
class TruckDeleteReturn{
}
class TruckListReturn{
var $PostedTrucks;//ArrayOfTruckPost
}
class ArrayOfTruckPost{
var $TruckPost;//TruckPost
}
class TruckPost{
var $DateAvailable;//dateTime
var $DestinationCity;//string
var $DestinationCountry;//string
var $DestinationState;//string
var $Equipment;//string
var $Handle;//string
var $Id;//int
var $IsDaily;//boolean
var $IsFull;//boolean
var $OriginCity;//string
var $OriginCountry;//string
var $OriginState;//string
}
class TruckPostingRequest{
var $Trucks;//ArrayOfTruck
}
class TruckDeleteRequest{
var $Trucks;//ArrayOfint
}
class TruckListRequest{
}
class trucks extends RequestBase{
 var $Trucks;
}  
class PostTrucks{
var $trucks;//TruckPostingRequest
}
class PostTrucksResponse{
var $PostTrucksResult;//TruckPostingReturn
}
class GetTruckDetailResults{
var $detailRequest;//TruckDetailRequest
}
class GetTruckDetailResultsResponse{
var $GetTruckDetailResultsResult;//TruckDetailReturn
}
class DeleteTrucks{
var $trucks;//TruckDeleteRequest
}
class DeleteTrucksResponse{
var $DeleteTrucksResult;//TruckDeleteReturn
}
class GetTrucks{
  var $listRequest;
}
class GetTrucksResponse{
var $GetTrucksResult;//TruckListReturn
}
class truckstop 
 {
 var $soapClient;
 
private static $classmap = array('ArrayOfstring'=>'ArrayOfstring'
,'ArrayOfint'=>'ArrayOfint'
,'ArrayOfTrailerOptionType'=>'ArrayOfTrailerOptionType'
,'ArrayOfError'=>'ArrayOfError'
,'Error'=>'Error'
,'RequestBase'=>'RequestBase'
,'ReturnBase'=>'ReturnBase'
,'ArrayOfTruck'=>'ArrayOfTruck'
,'Truck'=>'Truck'
,'TruckPostingReturn'=>'TruckPostingReturn'
,'TruckDetailRequest'=>'TruckDetailRequest'
,'TruckDetailReturn'=>'TruckDetailReturn'
,'TruckDetailResult'=>'TruckDetailResult'
,'TruckDeleteReturn'=>'TruckDeleteReturn'
,'TruckListReturn'=>'TruckListReturn'
,'ArrayOfTruckPost'=>'ArrayOfTruckPost'
,'TruckPost'=>'TruckPost'
,'TruckPostingRequest'=>'TruckPostingRequest'
,'TruckDeleteRequest'=>'TruckDeleteRequest'
,'TruckListRequest'=>'TruckListRequest'
,'PostTrucks'=>'PostTrucks'
,'PostTrucksResponse'=>'PostTrucksResponse'
,'GetTruckDetailResults'=>'GetTruckDetailResults'
,'GetTruckDetailResultsResponse'=>'GetTruckDetailResultsResponse'
,'DeleteTrucks'=>'DeleteTrucks'
,'DeleteTrucksResponse'=>'DeleteTrucksResponse'
,'GetTrucks'=>'GetTrucks'
,'GetTrucksResponse'=>'GetTrucksResponse'

);

 //function __construct($url='http://testws.truckstop.com:8080/v4/Posting/TruckPosting.svc?wsdl')
 function __construct($url='http://webservices.truckstop.com/v4/Posting/TruckPosting.svc?wsdl')
 {
  $params = array("classmap"=>self::$classmap,
                 "trace" => true,
                 "exceptions" => true);
//                 "login" => 'Ami@nana',
//                 "password" => 'aie5Ty89');
  try{
  $this->soapClient = new SoapClient($url,$params);
  }catch(Exception $e){
    var_dump($e);
  }
 
 }
 
function PostTrucks($PostTrucks)
{

$PostTrucksResponse = $this->soapClient->PostTrucks($PostTrucks);
return $PostTrucksResponse;

}
function GetTruckDetailResults($GetTruckDetailResults)
{

$GetTruckDetailResultsResponse = $this->soapClient->GetTruckDetailResults($GetTruckDetailResults);
return $GetTruckDetailResultsResponse;

}
function DeleteTrucks($DeleteTrucks)
{

$DeleteTrucksResponse = $this->soapClient->DeleteTrucks($DeleteTrucks);
return $DeleteTrucksResponse;

}
function GetTrucks($GetTrucks)
{
$GetTrucksResponse = $this->soapClient->GetTrucks($GetTrucks);
return $GetTrucksResponse;

}}


?>