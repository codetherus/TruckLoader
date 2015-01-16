<?php
/*
  Query log viewer. 
  Default view is the current log file querylog.txt
  Provides an option to select from the old logs in the
  query logs folder.
*/
require_once("commons.php");
$smarty->assign("pgtitle", "Query Log Viewer"); 
$smarty->assign("domenu", 1);
define("QUERYFOLDER","./query logs/");

//Build the record for editing
function DisplayLog()
{
  if (!file_exists("querylog.txt"))
    return "No log file available.";
  $s = file_get_contents("querylog.txt")."<br/><hr style='color:green'>";
  
  $s = str_replace("\n","<br/>",$s);
  return $s;
}

function DisplayArchivedLog($log)
{
  $resp = new xajaxResponse();
  $target = QUERYFOLDER.$log;
  if (file_exists($target))
  {
    $s = file_get_contents($target);
    $s = str_replace("\n","<br/>",$s);
    $resp->assign("logdata", "innerHTML", $s);
  }
  else
    $resp->alert("Unable to load the requested log file.");
  return $resp;
}

function GenerateArchiveList()
{
  global $smarty;
  $d = dir(QUERYFOLDER);
  $s = "<select id='filelist', name='filelist'>\n";
  $s .= "<option value=''>&nbsp</option>\n";
  while (false !== ($entry = $d->read())) 
  {
    if (is_dir($entry)) continue;
    $fname = basename($entry);
    $s .= "<option value='$entry'>$fname</option>\n";
  }
  $s .= "</select>\n";
  $smarty->assign("archivelist",$s);  
}  
//$xajax->configure('debug',true);
$xajax->register(XAJAX_FUNCTION,'DisplayArchivedLog');
$xajax->processRequest();
GenerateArchiveList();
$smarty->assign("editdata",DisplayLog());
GenerateSmartyPage();
?>
