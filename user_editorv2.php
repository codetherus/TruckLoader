<?php
/*
  4/7/2010
  User management page.
*/
require_once("commons.php");
require_once("utilityV2.php");
$smarty->assign("pgtitle", "User / Agent Management");
$smarty->assign("domenu", 1);
$smarty->assign("dosearch",1);
//---------------------- Select list generation procedures ---------------
function AddOption(&$lst,$val, $sel)
{
  if ($val == $sel && $sel != '')
   $lst .= "<option selected value='$val'>$val</option>\n";
  else
   $lst .= "<option value='$val'>$val</option>\n";
  return $s;
}  
function MakeLevelSelect($level='')
{
  $s = "<select id='level' name='level'>\n";
  AddOption($s,"",$level);  
  AddOption($s,"user",$level);
  AddOption($s,"admin",$level);
  AddOption($s,"broker",$level);
  $s .= "</select>";
  return $s;
}
function MakeListSelect($list='')
{
  $s = "<select id='list_level' name='list_level'>\n";
  AddOption($s,"",$level);
  AddOption($s,"user",$list);
  AddOption($s,"admin",$list);
  $s .= "</select>";
  return $s;
}
function MakeOfficeSelect($officeid='')
{
  global $db;
  $sql = "select id, shortname from offices order by shortname";
  $res = $db->get_results($sql);
  if (!$res)
    return '';
  $s = "<select id='officeid' name='officeid'>\n";
  $s .= "<option value=''>&nbsp;</option>\n";
  foreach ($res as $rw)
  {
    $s .= "<option value='$rw->id' ";
    if ($officeid != '' && $rw->id == $officeid)
      $s .= "selected ";
    $s .= ">$rw->shortname</option>\n";
  }
  $s .= "</select>\n";
  return $s;
}
//------------------------ End Select List Procedures --------------------
function ReadOfficeName($id)
{
  global $db;
  $sql = "select shortname from offices where id = $id";
  $rw = $db->get_row($sql);
  if (!$rw)
    return '';
  else
    return $rw->shortname;
}
/*
this does a lookup and displays a floatbox list of matches.
A single match just does a read.
  
*/
function LookupUsers($dta)
{
  global $db;
  $oid = $_SESSION['officeid'];
  $resp= new xajaxResponse();
  extract($dta);
  $sql = "select * from users where officeid = $oid order by user";
  $res = $db->get_results($sql);
  //Check for 0 or 1 results
  if (!$res)
  {
    return xajaxAlert("No matching records located.");
  }
  if ($db->num_rows == 1)
  {
    $id = $res[0]->id;
    return ReadAUser($id);
  }

  // n> 1 users. Build a floatbox table
  $s = "<center><br/><br/><table border='1' style='color: black'>\n";
  $s .= "<tr><th>User Id<th>Access Level<th>List Level<th>User Name<th>Office</tr>";
  foreach($res as $rw)
  {
    $officename = ReadOfficeName($rw->officeid);
    $s .= "<tr><td><a href='#' onclick=\"fb.end();xajax_Process($rw->id,'read')\">$rw->user</a></td>";
    $s .= "<td>$rw->level<td>$rw->list_level<td>$rw->user_name<td>$officename</tr>\n";
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
  Read users by id or user name.
  $dta will be either the form data 
  or an id column value.
*/
function ReadAUser($dta)
{
  global $db;
  $resp= new xajaxResponse();
  if (is_array($dta))
  {
    extract($dta);
    $sql = "select * from users where user = '$user'";
  }
  else
    $sql = "select * from users where id = $dta";
  $res = $db->get_row($sql);
  if ($db->num_rows == 0)
    return xajaxAlert("No matching user found. SQL: $sql");
  $_SESSION['last_user_id'] = $res->id;
  $resp->assign("current_record_id","value",$res->id);
  $resp->assign("user", "value", $res->user);
  $resp->assign("password", "value", $res->password);
  $resp->assign("leveldiv", "innerHTML", MakeLevelSelect($res->level));
  $resp->assign("listleveldiv", "innerHTML", MakeListSelect($res->list_level)); 
  $resp->assign("officediv", "innerHTML", MakeOfficeSelect($res->officeid)); 
	$resp->assign("user_name", "value", $res->user_name);
  $rid = $res->id;
  $resp->assign("phone", "value", GetPhoneValue($rid,'Agent','Home'));
  $resp->assign("fax", "value", GetPhoneValue($rid,'Agent','Fax'));
  $resp->assign("email", "value", GetPhoneValue($rid,'Agent','Email'));
  $resp->assign("google_id","value",$res->google_id);
  $resp->assign("google_password","value",$res->google_password);
  $resp->assign("calendar_html","value",$res->calendar_html);
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
  if ($user == '')
    $s .= "User Id\n";
  if ($password == '')
    $s .= "Password\n";
  if ($level == '')
    $s .= "Level\n";
  if ($officeid == '')
    $s .= "Office\n";
  if ($s != '') 
    $s = "Please provide the following field/s:\n".$s;
  return $s;
}

function InsertUser($dta)
{
  global $db;
  $oid = $_SESSION['officeid'];
  $resp= new xajaxResponse();
  $s = ValidateInputs($dta);
  if ($s != '')
  {
    $resp->alert($s);
    return $resp;
  }
  extract($dta);
  //Check for a duplicate user 
  $sql = "select * from users where user = '$user' and password='$password' and officeid = $oid";
  $db->query($sql);
  if ($db->num_rows > 0)
  {
    $resp->alert("User id and password combination is already in use. Please try again.");
    return $resp;
  }
  
  $sql = "insert into users (user,password,level,list_level, user_name, officeid,google_id,google_password,calendar_html)";
  $sql .= " values('$user','$password','$level','$list_level','$user_name', $oid,'$google_id','$google_password','$calendar_html')";
//  QueryLog($sql);
  $db->query($sql);
  if ($db->rows_affected == 0)
  {  
    $resp->assign("current_record_id","value", "");
    $resp->alert("Record insert failed $sql");
  }
  else
  {
    $uid = $db->insert_id;
    SetPhoneValue($uid,'Agent','Home',$phone);
    SetPhoneValue($uid,'Agent','Fax',$fax);
    SetPhoneValue($uid,'Agent','Email',$email);
    $resp->assign("current_record_id","value", $uid);
    $resp->alert("User inserted.");
  }
  return $resp;
}
function UpdateUser($dta)
{
  global $db;  
  $resp= new xajaxResponse();
  $id = $dta['current_record_id'];  
  if ($id == '')
    return xajaxAlert("No record id value available. Must read before update.");
  $s = ValidateInputs($dta);
  if ($s != '')
    return xajaxAlert($s);
  extract($dta);
  
  $sql = "update users set user='$user',password='$password',level='$level',list_level='$list_level' ";
  $sql .= ",user_name='$user_name',google_id='$google_id',google_password='$google_password' ";
  $sql .= ",calendar_html='$calendar_html' where id = $id";
  QueryLog($sql);
  $db->query($sql);
  if($db->rows_affected == -1)
    $resp->loadCommands(xajaxAlert("Failed to update the user record. SQL: $sql"));
  else
  {
    SetPhoneValue($id,'Agent','Home',$phone);
    SetPhoneValue($id,'Agent','Fax',$fax);
    SetPhoneValue($id,'Agent','Email',$email);
    $resp->loadCommands(xajaxAlert("Record Updated."));
  }
  return $resp;
}
function DeleteUser($dta)
{
  global $db;
  $resp= new xajaxResponse();
  $id = $_SESSION['last_user_id'];
  if ($id == '')
    return xajaxAlert("No record id value available. Must read befpre delete.");
  $sql = "delete from users where id = $id";
  $db->query($sql);
  if ($db->rows_affected == 0)
    return xajaxAlert("Failed to delete the user record.");
  else
    return xajaxAlert("Record Deleted.");
  return $resp;
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
    return ReadAUser($id);
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
    return LookupUsers($dta);
    break;
  case "read":
    return ReadAUser($dta);
    break;
  case "insert":
    return InsertUser($dta);
    break;
  case "update":
    return UpdateUser($dta);
    break;
  case "delete":
    return DeleteUser($dta);
  default:
    $resp = new xajaxResponse();
    $resp->alert("Invalid operation code submitted: $op");
    return $resp;
  }
}

//$xajax->configure('debug',true);
$xajax->register(XAJAX_FUNCTION,"Process");
$xajax->processRequest();
$smarty->assign("levellist", MakeLevelSelect());
$smarty->assign("listlevellist", MakeListSelect());
$smarty->assign("officelist",MakeOfficeSelect());

GenerateSmartyPage();
?>