<?php
/*
	This is the server side module for implimenting 
	the Google Coordinate API.
*/
//Load xajax ans easysql libs
require 'simple_commons.php';
//$xajax->configure('debug',true);

//Put the token in permanent storage
function storeToken($token)
{
	file_put_contents('token.txt',json_encode($token));
	$resp = new xajaxResponse();
	//$resp->alert('Token Saved');
	return $resp;
}

//Return the token to the js 
function getToken()
{
	$token = file_get_contents('token.txt');
	$resp = new xajaxResponse();
	$resp->call('getToken',$token);
	return $resp;
}

$xajax->register(XAJAX_FUNCTION, 'storeToken');
$xajax->register(XAJAX_FUNCTION, 'getToken');	
$xajax->processRequest();
?>
<!doctype html>
<html>
<head>
<title>Loads by Jake Coordinate Interface</title>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<meta charset="utf-8">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<?php $xajax->printJavascript(); ?>
	
</head>
<body>
<input type="button" onclick="authorizeUs()" value="Authorize"/>
<input type="button" onclick="getToken()" value="Retrieve Token"/>
<input type="button" onclick="jobsList()" value="List Jobs"/>
<script src="https://apis.google.com/js/client.js"></script>
<script type="text/javascript" src="coordinate_driver.js"></script>
 
</body>
</html>