<?php
/*
  This is an attempt to combine the
  the drivers and loads management on a
  single page using the jQuery UI tabs widget.
*/
//Smarty templating setup
include_once("smarty_setup.php"); 
//$smarty->debugging = true;
$smarty->display('driver_loads.tpl');
?>