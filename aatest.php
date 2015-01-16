<?php
/*
  Drivers management page
  09-13-2012 Add code for the co/broker truck type

*/
require_once("commons.php");
$smarty->assign("pgtitle", "Driver Management"); //Displayed page title.
GenerateSmartyPage("driversx.tpl");
$xajax->processRequest();
?>