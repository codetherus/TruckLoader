<?php

$key = "&key=AIzaSyBn0clXv-GMWVqLYORBybTYeXjP-xKGsr0";
$address = urlencode("BOISE, ID");
 
//If you want an extended data set, change the output to "xml" instead of csv
/*https://maps.googleapis.com/maps/api/geocode/json?address=1600+Amphitheatre+Parkway,+Mountain+View,+CA&key=API_KEY
*/
$url = "https://maps.googleapis.com/maps/api/geocode/json?address=".$address."&output=csv".$key;//
echo "Location of Boise, Id:<br>";
$data = file_get_contents($url);
$parts = json_decode($data,true);


echo 'Latitude:   '. $parts['results'][0]['geometry']['location']['lat'].'<br/>';
echo 'Longitude:  '. $parts['results'][0]['geometry']['location']['lng'].'<br/>';


?>