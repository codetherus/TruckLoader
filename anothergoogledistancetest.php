<?php
$s = file_get_contents("http://maps.google.com/maps?q=from+boise+id+to+seattle+wa&output=kml");
echo $s;
file_put_contents("googlekmloutput.txt", $s);

?>