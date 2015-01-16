<?php
/*
	11/25/14
	Test the GoogleMapGeocoder class by Justin Staytin
	https://github.com/jstayton/GoogleMapsGeocoder
*/

require './src/GoogleMapsGeocoder.php';
$gmg = new GoogleMapsGeocoder();
$gmg->setLatitude(47.577);
$gmg->setLongitude(-122.226);
$res = $gmg->geocode();
var_dump($res);
echo '<br/>'.$res['results'][2]['formatted_address'];