<?php
class LoadImportFullService{
var $myImport;//ImportFullLoadsRequest
}
class ImportFullLoadsRequest{
var $UserName;//string
var $Password;//string
var $Imports;//ArrayOfLoadImportFull
}
class ArrayOfLoadImportFull{
var $LoadImportFull;//LoadImportFull
}
class LoadImportFull{
var $IntegrationID;//int
var $Loads;//ArrayOfImportLoad
}
class ArrayOfImportLoad{
var $ImportLoad;//ImportLoad
}
class ImportLoad{
var $OriginCity;//string
var $OriginState;//string
var $OriginZip;//string
var $DestinationCity;//string
var $DestinationState;//string
var $DestinationZip;//string
var $Distance;//int
var $Weight;//int
var $Length;//int
var $Stops;//int
var $PaymentAmount;//double
var $PickupDate;//dateTime
var $PickUpTime;//string
var $DeliveryDate;//dateTime
var $DeliveryTime;//string
var $EquipmentType;//string
var $EquipmentOptions;//ArrayOfString
var $SpecialInformation;//string
var $IsFullLoad;//boolean
var $PointOfContact;//string
var $Quantity;//int
var $LoadNumber;//string
}
class ArrayOfString{
var $string;//string
}
class LoadImportFullServiceResponse{
var $LoadImportFullServiceResult;//ImportLoadsResponse
}
class ImportLoadsResponse{
var $RequestErrors;//ArrayOfError
var $RequestReport;//ArrayOfImportReport
}
class ArrayOfError{
var $Error;//Error
}
class Error{
var $ErrorMessage;//string
}
class ArrayOfImportReport{
var $ImportReport;//ImportReport
}
class ImportReport{
var $IntegrationID;//int
var $Success;//boolean
var $ImportErrors;//ArrayOfError
var $UpdateLoadsReports;//ArrayOfLoadReport
var $AddLoadReports;//ArrayOfLoadReport
var $DeleteLoadReports;//ArrayOfLoadReport
}
class ArrayOfLoadReport{
var $LoadReport;//LoadReport
}
class LoadReport{
var $Success;//boolean
var $LoadErrors;//ArrayOfError
var $LoadID;//string
}
class LoadImportPartialService{
var $myImport;//ImportLoadsRequest
}
class ImportLoadsRequest{
var $UserName;//string
var $Password;//string
var $Imports;//ArrayOfLoadImportPartial
}
class ArrayOfLoadImportPartial{
var $LoadImportPartial;//LoadImportPartial
}
class LoadImportPartial{
var $IntegrationID;//int
var $UpdateLoads;//ArrayOfImportLoad
var $AddLoads;//ArrayOfImportLoad
var $DeleteLoads;//ArrayOfString
}
class LoadImportPartialServiceResponse{
var $LoadImportPartialServiceResult;//ImportLoadsResponse
}
class GetImportedLoadsService{
var $myLoadsRequest;//ImportedLoadsRequest
}
class ImportedLoadsRequest{
var $IntegrationIDs;//ArrayOfInt
var $UserName;//string
var $Password;//string
}
class ArrayOfInt{
var $int;//int
}
class GetImportedLoadsServiceResponse{
var $GetImportedLoadsServiceResult;//ImportedLoadsResponse
}
class ImportedLoadsResponse{
var $RequestErrors;//ArrayOfError
var $ImportedLoads;//ArrayOfImportedLoads
}
class ArrayOfImportedLoads{
var $ImportedLoads;//ImportedLoads
}
class ImportedLoads{
var $Errors;//ArrayOfError
}
class truckupload 
 {
 var $soapClient;
 
private static $classmap = array('LoadImportFullService'=>'LoadImportFullService'
,'ImportFullLoadsRequest'=>'ImportFullLoadsRequest'
,'ArrayOfLoadImportFull'=>'ArrayOfLoadImportFull'
,'LoadImportFull'=>'LoadImportFull'
,'ArrayOfImportLoad'=>'ArrayOfImportLoad'
,'ImportLoad'=>'ImportLoad'
,'ArrayOfString'=>'ArrayOfString'
,'LoadImportFullServiceResponse'=>'LoadImportFullServiceResponse'
,'ImportLoadsResponse'=>'ImportLoadsResponse'
,'ArrayOfError'=>'ArrayOfError'
,'Error'=>'Error'
,'ArrayOfImportReport'=>'ArrayOfImportReport'
,'ImportReport'=>'ImportReport'
,'ArrayOfLoadReport'=>'ArrayOfLoadReport'
,'LoadReport'=>'LoadReport'
,'LoadImportPartialService'=>'LoadImportPartialService'
,'ImportLoadsRequest'=>'ImportLoadsRequest'
,'ArrayOfLoadImportPartial'=>'ArrayOfLoadImportPartial'
,'LoadImportPartial'=>'LoadImportPartial'
,'LoadImportPartialServiceResponse'=>'LoadImportPartialServiceResponse'
,'GetImportedLoadsService'=>'GetImportedLoadsService'
,'ImportedLoadsRequest'=>'ImportedLoadsRequest'
,'ArrayOfInt'=>'ArrayOfInt'
,'GetImportedLoadsServiceResponse'=>'GetImportedLoadsServiceResponse'
,'ImportedLoadsResponse'=>'ImportedLoadsResponse'
,'ArrayOfImportedLoads'=>'ArrayOfImportedLoads'
,'ImportedLoads'=>'ImportedLoads'

);

 function __construct($url='http://ImportsWS.Truckstop.com/LoadsImportsWS.asmx?wsdl')
 {
  $this->soapClient = new SoapClient($url,array("classmap"=>self::$classmap,"trace" => true,"exceptions" => true));
 }
 
function LoadImportFullService($LoadImportFullService)
{

$LoadImportFullServiceResponse = $this->soapClient->LoadImportFullService($LoadImportFullService);
return $LoadImportFullServiceResponse;

}
function LoadImportPartialService($LoadImportPartialService)
{

$LoadImportPartialServiceResponse = $this->soapClient->LoadImportPartialService($LoadImportPartialService);
return $LoadImportPartialServiceResponse;

}
function GetImportedLoadsService($GetImportedLoadsService)
{

$GetImportedLoadsServiceResponse = $this->soapClient->GetImportedLoadsService($GetImportedLoadsService);
return $GetImportedLoadsServiceResponse;

}
function LoadImportFullService($LoadImportFullService)
{

$LoadImportFullServiceResponse = $this->soapClient->LoadImportFullService($LoadImportFullService);
return $LoadImportFullServiceResponse;

}
function LoadImportPartialService($LoadImportPartialService)
{

$LoadImportPartialServiceResponse = $this->soapClient->LoadImportPartialService($LoadImportPartialService);
return $LoadImportPartialServiceResponse;

}
function GetImportedLoadsService($GetImportedLoadsService)
{

$GetImportedLoadsServiceResponse = $this->soapClient->GetImportedLoadsService($GetImportedLoadsService);
return $GetImportedLoadsServiceResponse;

}}


?>