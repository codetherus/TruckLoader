<?php
//Sample to decode the client secrets JSON
$json = file_get_contents('client_secrets .json');

$secrets = json_decode($json,true);
var_dump($secrets);