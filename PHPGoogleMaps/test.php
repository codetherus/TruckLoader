<?php
/*
	Testing Bradwell.com's php
	maps interface
*/
include 'GoogleMap.php';
include 'JSMin.php';
$dir_container_id = "map_directions";
$mobj = new GoogleMapAPI(); 
$mobj->_minify_js = isset($_REQUEST["min"])?FALSE:TRUE;
$mobj->setDSN("mysql://user:password@localhost/db_name");
$mobj->disableSidebar();
$mobj->addDirections("Littleton, CO", "Englewood, CO", $dir_container_id, $display_markers=true);
?>
<!doctype html>
<html>
<head>
<?php $mobj->getHeaderJS();?>
<?php $mobj->getMapJS();?>
</head>
<body>
<?php $mobj->printOnLoad();?> 
<?php $mobj->printMap();?>
<div id="<?=$dir_container_id?>"></div>
</body>
</html>