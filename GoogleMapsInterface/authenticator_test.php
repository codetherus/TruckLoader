<?php
require '../commons.php';
ob_end_clean();
require 'authenticator.php';
$auth = new lbj_authenticator($db);
echo '<pre>';
echo 'Startup session value:';
var_dump($_SESSION);
echo '</pre>';
$res = $auth->authenticate();

var_dump($res);
