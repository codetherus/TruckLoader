<?php
/*
  7/21/10
  Query tool
  Enables the users to query the database without knowing SQL.
*/
require_once("commons.php");
require_once("utilityV2.php");
$smarty->assign("pgtitle", "Database Query Tool");
$smarty->assign("domenu", 1);
$set = ''; //Update query set clause
//---------------------- Select list generation procedures ---------------
//Generate a select of all of the tables we want the users
//to be able to work with.
function BuildTableList(){
  $s = "<select id='tablelist' name='tablelist' onchange=\"sendPage('fields')\">\n";
  $s .= "<option value=''>&nbsp;</option>\n";
  $s .= "<option value='drivers'>Drivers</option>\n";
  $s .= "<option value='loads'>Loads</option>\n";
  $s .= "<option value='brokers'>Brokers</option>\n";
  $s .= "<option value='offices'>Offices</option>\n";
  $s .= "<option value='users'>Users</option>\n";
  $s .= "</select>\n";
  return $s;
  
}

//Generate a select listing all of
//the fields in the passed table.
function BuildFieldList($dta)
{
  global $db;
  $resp = new xajaxResponse();
  $table =  $dta['tablelist'];
  if ($table == '')
    return $resp;
  $sql = "show columns from $table";
  $res = $db->get_results($sql);
  $s = "<select id='fields' name='fields'>\n";
  foreach($res as $rw)
  {
    $fieldname = $rw->Field;
    if ($fieldname == 'password') continue;
    $s .= "<option value='$fieldname'>$fieldname</option>\n";
  }
  $s .= "</select\n";
  $resp->assign("fieldlist","innerHTML", $s);
  return $resp;
}
/*
  Edit operations dispatcher
  Params:
  $dta - Form data
  $op  - Operation code
*/
function Process($dta,$op)
{
  switch($op){
  case "find":
    return LookupBrokers($dta);
    break;
  case "fields":
    return BuildFieldList($dta);
    break;
  default:
    return xajaxAlert("Invalid operation code submitted: $op", "Query Tool");
  }
}

//$xajax->configure('debug',true);
$xajax->register(XAJAX_FUNCTION,"Process");
$xajax->processRequest();
$smarty->assign("tablelist", BuildTableList());
GenerateSmartyPage();
?>