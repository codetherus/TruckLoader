<?php
/*
  Drivers management page
  

*/
require_once("commons.php");
require_once("utilityV2.php");
$smarty->assign("pgtitle", "Driver Management"); //Displayed page title.
$smarty->assign("domenu", 1); //Menu control
$smarty->assign("dosearch",1); //Global search tool control
$smarty->assign("username",$_SESSION['user']); //For note timestamp

GenerateSmartyPage();
?>