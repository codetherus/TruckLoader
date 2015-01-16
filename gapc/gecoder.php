<?php
/*
	Testing the google gecoder
	wSend a city and state and get back their map coordinents longitude and latitude
*/
include "../xajax/xajax_core/xajax.inc.php";
$xajax = new xajax();
$xajax->configure('javascript URI', '../xajax/');

function getLocation($data)
{
	$resp = new xajaxResponse();
	$urlbase = 'https://maps.googleapis.com/maps/api/geocode/json?address=';//Basic gecoder url
	$keyseg = '&key=AIzaSyDD2H3431YT6FWrzWv0-UDp1PTBa4Kal8I';//My api key
	
	extract($data); //get the form city and state
	
	$url = $urlbase.$city.'+'.$state.$keyseg; //construct the entire url
	
	//Use curl to fetch the result
	$cu = curl_init();
	curl_setopt($cu,CURLOPT_URL,$url);
	curl_setopt($cu,CURLOPT_RETURNTRANSFER,true);   //Return the response rather than echo it
	curl_setopt($cu,CURLOPT_SSL_VERIFYPEER, FALSE); //Do not mess with ssl certificates
	$loc = curl_exec($cu); //Run the curl session receiving a json thing
	if(!$loc)
	{
		$resp->alert('Curl error: ' . curl_error($cu));
		curl_close($cu);
		return $resp;
	}
	curl_close($cu);
	$resp->alert($loc);
	$loc = json_decode($loc,true);
	$lat = $loc['results'][0]['geometry']['location']['lat'];
	$lng = $loc['results'][0]['geometry']['location']['lng'];
	$resp->alert('Lat: '.$lat. ' Lng: '.$lng);
	return $resp;
}
$xajax->register(XAJAX_FUNCTION,'getLocation');
$xajax->processRequest();
?>
<doctype html>
<html>
<head>
<title> Google Geocode Testing </title>
<?php $xajax->printJavascript() ?>
</head>
<body>
<form id="form1">
City: <input name="city" id="city"/><br/>
State: <input name="state" id="state"/>

<input type="button" value="Submit" onclick="xajax_getLocation(xajax.getFormValues('form1'))"/>
</form>
<div id="results"></div>
</body>
</html>