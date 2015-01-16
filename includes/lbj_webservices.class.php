
<?php

class Truck{
var $EqType;//string
var $Location;//string
var $UnloadDate;//date
}
class loadsbyjake_ws 
 {
 var $soapClient;
 
private static $classmap = array('Truck'=>'Truck'

);

 function __construct($url='http://loadsbyjake.com/ws.trucklist.php?wsdl')
 {
  $this->soapClient = new SoapClient($url,array("classmap"=>self::$classmap,"trace" => true,"exceptions" => true));
 }
 
function GetTrucks()
{

$Trucks = $this->soapClient->GetTrucks();
return $Trucks;

}
function GetTrucksForADate($dt)
{

$Trucks = $this->soapClient->GetTrucksForADate($dt);
return $Trucks;

}}


?>