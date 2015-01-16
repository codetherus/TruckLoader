<?php
/* test the svc_auth class */

require 'svc_auth.php'; //Constructor handles obj creation and authorization.

$sa = new svc_auth(); //Instancing does complete authorization
/*
//Attempt map creation
$mea = new Google_Service_MapsEngine_Map();
$mea->setName('LBJ Main Map');
$mea->setProjectId(PROJECT_ID);
$sa->service->maps->create($mea);
*/

//Create a table
//Make a tablecolumn
$col = new Google_Service_MapsEngine_TableColumn();
$col->setName('geometry');
$col->setType('points');
//Add to a columns array
$cols = array($col);

//Create a schema
$schema = new Google_Service_MapsEngine_Schema();
$schema->setPrimaryKey('drverId');
$schema->setPrimaryGeometry('geometry');
$schema->setColumns($cols);

//Define the table object using the schema created above
$table = new Google_Service_MapsEngine_Table();
$table->setProjectId(PROJECT_ID);
$table->setName('driversTable');
$table->setSchema($schema);
//Run the table create method
$res = $sa->service->tables->create($table);

echo 'Back from auth module...<br>';
var_dump($res);