<?php
/*
  5/6/2010
  Admin agent assignment page.
  The users want to be able to assign a driver to an agent.
  The userid in the truck_loader table indicates the "owner."
*/
require_once("commons.php");
require_once("utility.php");
$smarty->assign("pgtitle", "Assign Agents to Drivers"); 
$smarty->assign("domenu", 1);
function GenerateDriverList()
{
  global $db;
  $sql = "select driver,driver_status, id from truck_loader order by driver";
  $res = $db->get_results($sql);
  $s = "<select id='driver' name='driver'>\n";
  $s .= "<option value=''></option>\n"; 
  foreach($res as $rw)
  {
    $driver = $rw->driver;
    if ($driver == '') continue;
    if (substr($driver,0,1) == '(') continue;
    if ($rw->driver_status == 1)
      $driver .= " - Active";
    else
      $driver .= " - Inactive";
    $s .= "<option value='$rw->id'>$driver</option>\n";
  }
  $s .= "</select>\n";
  return  $s;
  
}
function GenerateAgentList()
{
  global $db;
  $sql = "select user, id from users where level = 'admin' or level = 'user' order by user";
  $res = $db->get_results($sql);
  $s = "<select id='agents' name='agents'>\n";
  $s .= "<option value=''></option>\n"; 
  foreach($res as $rw)
  {
    $s .= "<option value='$rw->id'>$rw->user</option>\n";
  }
  $s .= "</select>\n";
  return  $s;

}

function AssignAgent($dta)
{
  global $db;
  extract($dta);
  $sql = "select userid from truck_loader where id = $driver";
  $res = $db->get_row($sql);
  if ($res->userid == $agents)
    return xajaxAlert("Agent is already asigned to this driver.","Assign Agent");
  if ($agents == '' || $driver == '')
  {
    return xajaxAlert("Both driver and agent must be specified.","Assign Agent");
  }
  $sql = "update truck_loader set userid='$agents', driver_status = 1 where id=$driver";
  $res = $db->query($sql);
  if (!$res)
    return xajaxAlert("Assignment Operation Failed!","Assign Agent");
  else
    return xajaxAlert("Agent assigned.", "Assign Agent");
}
//$xajax->configure('debug',true); //xajax debugger on/off control. Uncomment to turn on...
$xajax->register(XAJAX_FUNCTION,'AssignAgent');
$xajax->processRequest();
$smarty->assign("driverlist", GenerateDriverList());
$smarty->assign("agentlist", GenerateAgentList());
GenerateSmartyPage();
?>
