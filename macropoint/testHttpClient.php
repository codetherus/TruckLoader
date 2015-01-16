<?php
require 'HttpClient.class.php';

$client = new HttpClient('Google.com');

$client->post('Google.com',array('v1'=>'Hello'));

echo $client->getContent();
