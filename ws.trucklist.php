<?php
/*
  Loadsbyjake.com webservice to provide
  customers with a st of available trucks
  in the range of today to today+4 days.
  
*/
$namespace = 'http://www.loadsbyjake.com/wsdl';
//Load the NuSoap classes
include 'NuSoap/lib/nusoap.php';
//MySQL classes for database access
include_once('ezsql/mysql/ez_sql_core.php');
include_once('ezsql/mysql/ez_sql_mysql.php');
include('dbsettings.php');
//Global database class instance
$db = new ezSQL_mysql($dbuser, $dbpassword, $dbdatabase, $dbhost);
//Setup the server object
$server = new nusoap_server();
$server->debug_flag = false;
$server->wsdl->schemaTargetNamespace = $namespace;
$server->configureWSDL("LBJWsdl", $namespace);

//Define the base output type describing the truck.
$server->wsdl->addComplexType(
  'Truck',
  'complexType',
  'struct',
  'all',
  '',
  array(
    'EqType' => array('name' => 'EqType', 'type' => 'xsd:string'),
    'Location' => array('name' => 'Location', 'type' => 'xsd:string'),
    'UnloadDate' => array('name' => 'UnloadDate',
        'type' => 'xsd:date')
  )
);
//Add the array of trucks type.
$server->wsdl->addComplexType(
  'Trucks',
  'complexType',
  'array',
  '',
  'SOAP-ENC:Array',
  array(),
  array(
    array('ref' => 'SOAP-ENC:arrayType',
         'wsdl:arrayType' => 'tns:Truck[]')
  ),
  'tns:Truck'
);

//Register the service functions
$server->register('GetTrucks',        // method name
  array(),                            // no input param
  array('return' => 'tns:Trucks'),    // output parameters
  $namespace,                         // namespace
  $namespace . '#GetTrucks',          // soapaction
  'rpc',                              // style
  'encoded',                          // use
  'Get a list of trucks.'        // documentation
);

$server->register('GetTrucksForADate',// method name
  array('DateAvailable' => 'tns:date'), //Date caller needs a truck
  array('return' => 'tns:Trucks'),    // output parameters
  $namespace,                         // namespace
  $namespace . '#GetTrucksForADate',  // soapaction
  'rpc',                              // style
  'encoded',                          // use
  'Get a list of trucks for a specific date.' // documentation
);

//3/31/10 - Build the list of dates to search
function MakeDayList()
{
  
  $date = new DateTime();  //today
  $date->modify('-2 day'); //2 days ago
  $from = "'".$date->format('Y-m-d')."'";
  $date->modify('4 day'); //2 days hence
  $to = "'".$date->format('Y-m-d')."'";
  $uld = "delivery_date between $from and $to";  
  return $uld;
}


function GetTrucks($unloaddate=''){
  global $db; 
  //Query for trucks in range.
  $sql = "select loads.*, drivers.* from loads,drivers where loads.driverid = drivers.id and loads.id = drivers.loadid ";
  $sql .= "and ".MakeDayList()." order by delivery_date";
  $res = $db->get_results($sql);
  $trucks = array();
  if ($res){
    foreach($res as $rw){
      $location=strtoupper($rw->delivery_location);
      if ($location == '') continue;
      $unloaddate = $rw->delivery_date;
      $tlength=$rw->tlength;
      $ttype=$rw->ttype;
      $equip = '';
      if ($ttype != 'Dont Know')
      {
        if ($tlength != '')
          $equip = $tlength."ft ";
        $equip .= $ttype;
      }
      else
        $equip = "Unknown"; 
      $truck = array('EqType' => $equip,'Location' => $location, 'UnloadDate' => $unloaddate);
      $trucks[] = $truck;
    }      
  }
  return $trucks;
}
//Same list but for a specific date
function GetTrucksForADate($unloaddate){
  global $db; 
  //Query for trucks in range.
  $sql = "select loads.*, drivers.* from loads,drivers where loads.driverid = drivers.id and loads.id = drivers.loadid ";
  $sql .= "and delivery_date = '$unloaddate' order by delivery_date";
  $res = $db->get_results($sql);
  $trucks = array();
  if ($res){
    foreach($res as $rw){
      $location=strtoupper($rw->delivery_location);
      if ($location == '') continue;
      $unloaddate = $rw->delivery_date;
      $tlength=$rw->tlength;
      $ttype=$rw->ttype;
      $equip = '';
      if ($ttype != 'Dont Know')
      {
        if ($tlength != '')
          $equip = $tlength."ft ";
        $equip .= $ttype;
      }
      else
        $equip = "Unknown"; 
      $truck = array('EqType' => $equip,'Location' => $location, 'UnloadDate' => $unloaddate);
      $trucks[] = $truck;
    }      
  }
  return $trucks;
}

//Go for it...
$HTTP_RAW_POST_DATA = isset($GLOBALS['HTTP_RAW_POST_DATA'])
  ? $GLOBALS['HTTP_RAW_POST_DATA'] : '';
$server->service($HTTP_RAW_POST_DATA);
exit();
?> 