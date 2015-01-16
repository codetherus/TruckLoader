<?php
/*
  Daily upload log viewer v2
*/
require_once("commons.php");
$smarty->assign("pgtitle", "Upload Log Viewer"); 
$smarty->assign("domenu", 1);
//Build the record for editing
function DisplayLog()
{
  if (!file_exists("log.txt"))
    return "No log file available.";
  $t = ">>>Skipped - Skipped update because unload date on file is >= unload date in upload.<br/>";
  $t .= "Others are updated records: record number, driver, equipment field in upload and <br/>";
  $t .= "interpreted truck type and length.<br/><br/>";
  $s = $t . file_get_contents("log.txt")."<br/><hr style='color:green'>";
  
  $s = str_replace("\n","<br/>",$s);
  return $s;
}
$smarty->assign("editdata",DisplayLog());

//$xajax->configure('debug',true);
$xajax->processRequest();
GenerateSmartyPage();
?>
