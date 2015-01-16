<?php
/*
  6/25/2010
  Broker management page.
  Derived from the user editor page
*/
require_once("commons.php");
require_once("utilityV2.php");
$smarty->assign("pgtitle", "Broker Management");
$smarty->assign("domenu", 1);
$smarty->assign("dosearch",1);
$set = ''; //Update query set clause
//---------------------- Select list generation procedures ---------------
/*
this does a lookup and displays a floatbox list of matches.
A single match just does a read.
  
*/
function LookupBrokers($dta)
{
  global $db;
  $resp= new xajaxResponse();
  extract($dta);
    $sql = "select * from brokers order by company";
  $res = $db->get_results($sql);
  //Check for 0 or 1 results
  if ($db->num_rows < 1)
  {
    $resp->alert("No matching records located.");
    return $resp;
  }
  if ($db->num_rows == 1)
  {
    $id = $res[0]->id;
    return ReadAbroker($id);
  }

  // n> 1 users. Build a floatbox table
  $s = "<center><br/><br/><table border='1' style='color: black'>\n";
  $s .= "<tr><th>Company<th>Address<th>City<th>State<th>Phone</tr>";
  foreach($res as $rw)
  {
    $s .= "<tr><td><a href='#' onclick=\"fb.end();xajax_Process($rw->id,'read')\">$rw->company</a></td>";
    $s .= "<td>$rw->address1<td>$rw->city<td>$rw->state<td>$rw->phone</tr>\n";
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
  global $db;
  $resp= new xajaxResponse();
  if (is_array($dta))
  {
    extract($dta);
    $sql = "select * from brokers where name = '$name'";
  }
  else
    $sql = "select * from brokers where id = $dta";
  $res = $db->get_row($sql);
  if ($db->num_rows == 0)
  {
    $resp->alert("No matching broker found. SQL: $sql");
    return $resp;
  }
  $_SESSION['last_broker_id'] = $res->id;
  $resp->assign("recid","value",$res->id);
  //$resp->assign("name", "value", $res->name);
  $resp->assign("company","value", $res->company);
  $resp->assign("address1", "value", $res->address1);
  $resp->assign("address2", "value", $res->address2);
  $resp->assign("city", "value", $res->city);
  $resp->assign("state", "value", $res->state);
  $resp->assign("zip", "value", $res->zip);
  $resp->assign("phone", "value", $res->phone);
  $resp->assign("cell", "value", $res->cell);
  $resp->assign("fax", "value", $res->fax);
  $resp->assign("notes","value", $res->notes);
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
  if ($company == '')
    $s .= "Company\n";
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
  $sql = "insert into brokers (address1,address2,city,state,zip,phone,cell,fax,company,notes) ";
  $sql .= "values('$address1','$address2','$city','$state','$zip','$phone','$cell','$fax','$company','$notes')";
  $db->query($sql);
  if ($db->rows_affected == 0)
    return xajaxAlert("Record insert failed $sql", "Broker Insert");
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
//  compare('name',$name,$current->name);
  compare('address1',$address1,$current->address1);
  compare('address2',$address2,$current->address2);
  compare('city',$city,$current->city);
  compare('state',$state,$current->state);
  compare('zip',$zip,$current->zip);
  compare('company',$company,$current->company);
  compare('phone',$phone,$current->phone);
  compare('cell',$cell,$current->cell);
  compare('fax',$fax,$current->fax);
  compare('notes',$notes,$current->notes);
  if ($set == '')
    return xajaxAlert("Nothing to update...", "Broker Edit");
  $sql = "update brokers set $set where id = $recid";
  $db->query($sql);
  $db->query($sql);
  if($db->rows_affected == -1)
    return xajaxAlert("Failed to update the broker record. SQL: $sql", "Broker Edit");
  else
    return xajaxAlert("Record Updated...", "Broker Edit");
}
function DeleteBroker($dta)
{
  global $db;
  $resp= new xajaxResponse();
  $id = $recid;
  if ($id == '')
    return xajaxAlert("No record id value available. Must read before delete.", "Broker Delete");
  $sql = "delete from brokers where id = $id";
  $db->query($sql);
  if ($db->rows_affected == 0)
    return xajaxAlert("Failed to delete the broker record.", "Broker Delete");
  else
    return xajaxAlert("Record Deleted.", "Broker Delete");
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
GenerateSmartyPage();
?>