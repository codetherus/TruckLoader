<?php
/*
  6/25/2010
  Broker agent management page.
  Derived from the broker editor page
*/
require_once("commons.php");
require_once("utilityV2.php");
$smarty->assign("pgtitle", "Broker Agent Management");
$smarty->assign("domenu", 1);
$smarty->assign("dosearch",1);
$set = ''; //Update query set clause
//---------------------- Select list generation procedures ---------------
//Generate the brokerage dropdown
//Param is optional broker record id to select it
function BrokerList($bid=''){
  global $db;
  $sql = "select company, id from brokers order by company";
  $res = $db->get_results($sql);
  if (!$res) return '';
  $s = "<select name='brokerlist' id='brokerlist'>\n";
  $s .=  "<option value=''>&nbsp;</option>\n";
  foreach($res as $rw){
    $co = $rw->company;
    $id = $rw->id;
    $s .= "<option value='$id' ";
    if ($id == $bid)
      $s .= "selected";
    $s .= ">$co</option>\n";
  }
  $s .= "</select>";
  return $s;
}
/*
this does a lookup and displays a floatbox list of matches.
A single match just does a read.
  
*/
function LookupBrokers($dta)
{
  global $db;
  $resp= new xajaxResponse();
  extract($dta);
  //$sql = "select * from broker_agents order by agent_name";
  $sql = "select broker_agents.*, brokers.company
          from broker_agents, brokers
          where brokers.id = broker_agents.brokerid
          order by company, agent_name";
  $res = $db->get_results($sql);
  //Check for 0 or 1 results
  if ($db->num_rows < 1)
    return xajaxAlert("No matching records located.");
  if ($db->num_rows == 1)
  {
    $id = $res[0]->id;
    return ReadAbroker($id);
  }

  // n> 1 users. Build a floatbox table
  $s = "<center><br/><br/><table border='1' style='color: black'>\n";
  $s .= "<tr><th>Name<th>Company<th>Phone<th>Fax</tr>";
  foreach($res as $rw)
  {
/*
    $cid = $rw->brokerid;
    $sql = "select * from brokers where id = $cid";
    $broker = $db->get_row($sql);
*/
    $coname=$rw->company;
    $s .= "<tr><td><a href='#' onclick=\"fb.end();xajax_Process($rw->id,'read')\">$rw->agent_name</a></td>";
    $s .= "<td>$coname<td>$rw->agent_phone<td>$rw->agent_fax</tr>\n";
  }
  $s .= "</table></center\n";
  $s1 = "<br/><center><input type='button' value='Close' onclick='fb.end();' /><br/></center>";
	$s1 .= '<div style="text-align:left">';
	$s1 .= $s;
	$s1 .= "</div>";
	$s1 .= "<br/><center><input type='button' value='Close' onclick='fb.end();' /><br/></center>";
  
  $resp->assign("floatboxcontent","innerHTML", $s1);
	$resp->script("fb.loadAnchor('#floatboxcontent')");
  return $resp;
}
/*
  Read brokers by id or broker name.
  $dta will be either the form data 
  or an id column value.
*/
function ReadABroker($dta)
{
  //return ShowData($dta);
  global $db;
  $resp= new xajaxResponse();
  if (is_array($dta))
  {
    extract($dta);
    $sql = "select * from broker_agents where agent_name = '$agent_name'";
  }
  else
    $sql = "select * from broker_agents where id = $dta";
  $res = $db->get_row($sql);
  if ($db->num_rows == 0)
  {
    $resp->alert("No matching broker agent found. SQL: $sql");
    return $resp;
  }
  $_SESSION['last_broker_agent_id'] = $res->id;
  $resp->assign("recid","value",$res->id);
  $resp->assign("agent_name", "value", $res->agent_name);
  $bid = $res->brokerid;
  $resp->assign("lbrokerage","innerHTML", BrokerList($bid));
  $resp->assign("agent_phone", "value", $res->agent_phone);
  $resp->assign("agent_fax", "value", $res->agent_fax);
  $resp->assign("agent_email","value",$res->agent_email);
  return $resp;
}

/*
  Utility to make certain we have the
  requisite info for update or insert.
*/
function ValidateInputs($dta)
{
  extract($dta);
  $s = '';
  if ($agent_name == '')
    $s .= "Agent Name\n";
  if ($brokerlist == '')
    $s .= "Brokerage\n";
  if ($s != '') 
    $s = "Please provide the following field/s:\n".$s;
  return $s;
}

function InsertBroker($dta)
{
  global $db;
  $resp= new xajaxResponse();
  $s = ValidateInputs($dta);
  if ($s != '')
  {
    $resp->alert($s);
    return $resp;
  }
  foreach($dta as $x)
   $x = quote_smart($x);
   
  extract($dta);
  
  $_SESSION['last_broker_id'] = ''; // In case of failure...
  $sql = "insert into broker_agents (brokerid,agent_name,agent_phone,agent_fax,agent_email) ";
  $sql .= "values($brokerlist,'$agent_name','$agent_phone','$agent_fax','$agent_email')";
  $db->query($sql);
  if ($db->rows_affected == 0)
    return xajaxAlert("Record insert failed $sql", "Broker Agent Insert");
  else
  {
    $_SESSION['last_broker_id'] = $db->insert_id;
    $resp->assign("recid","value", $db->insert_id);
    $resp->script("jAlert(\"Broker Inserted\",\"Broker Insert\")");
  }
  return $resp;
}

function UpdateBroker($dta)
{
  global $db, $set;
  $s = ValidateInputs($dta);
  if ($s != '')
    return xajaxAlert($s,"Broker Edit");
  $current = GetRow("brokers", $dta['recid']);
  foreach($current as $x)
    $x = quote_smart($x);
  foreach($dta as $x)
   $x = quote_smart($x);
  extract($dta);
  $set = '';
  compare('brokerid',$brokerlist,$current->brokerid,1);
  compare('agent_name',$agent_name,$current_agent_name);
  compare('agent_phone',$agent_phone,$current->agent_phone);
  compare('agent_fax',$agent_fax,$current->agent_fax);
  compare('agent_email',$agent_email,$current->agent_email);
  if ($set == '')
    return xajaxAlert("Nothing to update...", "Broker Edit");
  $sql = "update broker_agents set $set where id = $recid";
  $db->query($sql);
  if($db->rows_affected == -1)
    return xajaxAlert("Failed to update the broker record. SQL: $sql", "Broker Agent Edit");
  else
    return xajaxAlert("Record Updated...", "Broker Agent Edit");
}
function DeleteBroker($dta)
{
  global $db;
  $resp= new xajaxResponse();
  $id = $dta['recid'];
  if ($id == '')
    return xajaxAlert("No record id value available. Must read before delete.", "Broker Agent Delete");
  $sql = "delete from broker_agents where id = $id";
  $db->query($sql);
  if ($db->rows_affected == 0)
    return xajaxAlert("Failed to delete the broker agent record.", "Broker Agent Delete");
  else
    return xajaxAlert("Record Deleted.", "Broker Agent Delete");
}
// -------------------- Page swapping utility routines ---------------------
/*
  CheckPageSwap is called from the onload processing.
  It evaluates the session variable "swapid." If it
  is populated it contains a driver table id and we
  display the specified driver. If not, we just return
  a response object.
*/
function CheckPageSwap(){
  $resp = new xajaxResponse();
  if ($_SESSION['swapid'] != '')  
  {
    $id = $_SESSION['swapid'];    
    $_SESSION['swapid'] = '';    
    return ReadABroker($id);
  }
  else  
    return $resp;
}

$xajax->register(XAJAX_FUNCTION,'CheckPageSwap');


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
  case "read":
    return ReadAbroker($dta);
    break;
  case "insert":
    return InsertBroker($dta);
    break;
  case "update":
    return UpdateBroker($dta);
    break;
  case "delete":
    return DeleteBroker($dta);    
    break;
  default:
    return xajaxAlert("Invalid operation code submitted: $op", "Broker Editor");
  }
}

//$xajax->configure('debug',true);
$xajax->register(XAJAX_FUNCTION,"Process");
$xajax->processRequest();
$smarty->assign("brokerlist",BrokerList());
GenerateSmartyPage();
?>