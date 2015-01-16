<?php
/*
  Drivers management page
  

*/
require_once("commons.php");
require_once("utilityV2.php");
$smarty->assign("pgtitle", "Driver Management"); 
$smarty->assign("domenu", 1);
$set = ''; //kv pairs for update query
function DriverList($id=-1)
{
  global $db;
  $sql = 'select id, driver from truck_loader order by driver';
  $res = $db->get_results($sql);
  $s="<select id='driverid' name='driverid'>\n";
  $s .= "<option value=''></option>\n";
  foreach($res as $rw)
  {
    $driver = $rw->driver;
    $rwid = $rw->id;
    if ($driver == '') continue;
    if (substr($driver,0,1) == '(') continue;
    if ($rwid == $id)
      $s .= "<option value='$id' selected>$driver</option>\n";
    else
      $s .= "<option value='$id'>$driver</option>\n";
  }
  $s .= "</select>\n";
  return $s;
}
//Generate select for twic, canada, etc
// $target is the field name
// $vlu is its current value.
function YesNoList($target, $vlu='')
{
  $s = "<select id='$target' name='$target'>\n";
  $s .= "<option value=''";
  if ($vlu == '') $s .= " selected";
  $s .=">Unknown</option>\n";
  $s .= "<option value='Yes'";
  if ($vlu == 'Yes') $s .= " selected";
  $s .=">Yes</option>\n";
  $s .= "<option value='No'";
  if ($vlu == 'No') $s .= " selected";
  $s .=">No</option>\n";
  $s .= "</select>\n";
  return $s;
}
//Generate the select for the users.
function AgentList($id=0)
{
  global $db;
  $sql = "select id, user_name from users order by user_name";
  $res = $db->get_results($sql);
  $s = "<select id='agentid' name='agentid' onchange='xajax_GetAgentInfo(this.value)'>\n";
  $s .= "<option value=''>&nbsp;</option>\n";
  foreach($res as $rw)
  {
    $rid = $rw->id;
    $user = $rw->user_name;
    if ($user == '') continue; //Not all have names assigned.
    $s .= "<option value='$rid' ";
    if ($rid == $id)
      $s .= "selected";
    $s .= ">$user</option>\n";
  }
  $s .= "</select>\n";
  return $s;
}
//Eval a checkbox value
function CheckChecked($s)
{
  if ($s == 1)
    return "1";
  else
    return "0";
}

function GetLoadElements(&$resp, $loadid){
  $load = GetLoad($loadid);
  if (!$load) return;
  $resp->assign("load_number", "value", $load->load_number);
  $resp->assign("pickup_date", "value", $load->pickup_date);
  $resp->assign("delivery_date","value",$load->delivery_date);
  $resp->assign("pickup_location","value",$load->pickup_location);
  $resp->assign("delivery_location","value", $load->delivery_location);
}  

/*
  This function is called from the browser to 
  display a driver record. It reads everything 
  about the driver and xajax assigns the values to the 
  screen. Use the driver name to key the table.
*/
function DisplayDriver($dta){
  global $db;
  $resp = new xajaxResponse();
/*
  $resp->alert(print_r($dta,true));
  return $resp;
*/
  $s=$dta['name'];
  $rw = GetDriverByName($s);
  if (!$rw)
    return xajaxAlert("Driver Record Not Found for $s", "Display Driver");
  extract($rw);
  $resp->assign("rowhash", "value", RowHash('drivers',$id)); //for concurrancy checks.
  $resp->assign("current_record_id","value", $id); //for updates.
  $resp->assign("lcanada","innerHTML",YesNoList('canada',$canada));
  $resp->assign("ltwiclist","innerHTML",YesNoList('twic',$twic));
  $resp->assign("ltlength", "innerHTML", GenerateTruckLength($tlength));
  $resp->assign("lttype", "innerHTML", GenerateTruckType($ttype));
  $resp->assign("lpipestakes", "innerHTML", YesNoList("pipe_stakes",$pipe_stakes));
  $resp->assign("lloadlevelers", "innerHTML", YesNoList("load_levelers",$load_levelers));
  $resp->assign("lpolebunks", "innerHTML", YesNoList("pole_bunks",$pole_bunks));
	$resp->assign("lagent_list", "innerHTML", AgentList($agentid));
  $resp->assign('no_tarps',   'checked',CheckChecked($no_tarps));
  $resp->assign('f4ft_tarps', 'checked',CheckChecked($f4ft_tarps));
	$resp->assign('f6ft_tarps', 'checked',CheckChecked($f6ft_tarps));
	$resp->assign('f8ft_tarps', 'checked',CheckChecked($f8ft_tarps));
  $resp->assign('rating', 'value', $rating);
  $resp->assign("driving_limitations", "value", $driving_limitations);
  $resp->assign("comments", "value", $comments);
  $resp->assign("load_options", "value", $load_options);
  $resp->assign("phone_numbers", "value", $phone_numbers);
  $resp->assign("truck_no", "value", $truck_no);
  $resp->assign("canada_limitations","value", $canada_limitations);
  $resp->assign("check_call", "value", '');
  $resp->assign("agent_info","value",BuildAgentInfo($agentid));
  $resp->assign("name","value", $name);
  $resp->assign("phone_numbers", "value", $phone_numbers);
  if ($loadid > 0)
    GetLoadElements($resp, $loadid);
    
  return $resp;
}
//Make a call record for the update
function CreateCheckCallRecord($dta, $loadid)
{
  global $db;
  $uid = $_SESSION['userid'];
  $driver = $dta['driver'];
  $driverid = $dta['current_driver_id'];
  $msg = $dta['check_call'];
  $msg = quote_smart($msg);
  $timestamp = date('Y-m-d H:i:s');
  $sql = "insert into call_checks (loadid, driverid, agentid, time_stamp, notes) ";
  $sql .= "values($loadid, $driverid, $uid, '$timestamp', '$msg'";
  QueryLog($uid."-".$driver."-".$sql);
  $db->query($sql);
}

/*
  6/7/2010
  The compare function is used to construct the "set"
  clause of the update query. It compares the new and 
  old field values and adds changed fields to the set 
  string.
  
  The global $set is where the clause is built.
   
  Params:
    $fld    The field name
    $newval The value from the browser
    $oldval The value from the table 
    $num    Non zero iif the field is numeric. Controls quoting.
*/
function compare($fld,$newval,$oldval,$num=0)
{
  global $set;
  if ($newval == $oldval) return;
  $tmp = quote_smart($newval);
  if ($num == 0)
    $s = "$fld='$tmp'";
  else
    $s = "$fld=$tmp";
  if ($set == '')
    $set = $s;
  else
    $set .= ','.$s;
}
/*
  UpdateLoadElements maintains the elements of
  the driver's current load record that we allow to
  be messed with on the driver page.
  $resp->assign("load_number", "value", $load_load_numbar);
  $resp->assign("pickup_date", "value", $pickup_date);
  $resp->assign("delivery_date","value",$dlivery_date);
  $resp->assign("pickup_location","value",$pickup_location);
  $resp->assign("delivery_location","value", $delivery_location);
  
*/
function UpdateLoadElements($dta, $loadid)
{
  global $db, $set;
  $uid = $_SESSION['userid'];	
  extract($dta);
  $load = GetLoad($loadid);
  if (!$load) return false; //Oops!
  $set = '';
  compare('load_number',       $load_number,       $load->load_number);
  compare('pickup_date',       $pickup_date,       $load->pickup_date);
  compare('delivery_date',     $delivery_date,     $load->delivery_date);
  compare('pickup_location',   $pickup_location,   $load->pickup_location);
  compare('delivery_location', $delivery_location, $load->delivery_location);
  if ($set == '') return true;
  $sql = "update loads set $set where id = $loadid";
  QueryLog($uid."-".$driver."-".$sql);
  $db->query($sql);
  if ($check_call != '')
    CreateCheckCallRecord($dta, $loadid);
  return true;
}

/*
  UpdateRecord is called from the browser to update the driver record.
  
  The row in the table is checked for changes using the hash entered 
  at read. The update is rejected if the table has changed.
  
  The data is passed to UpdateLoadElements() to take care of the load
  items the user can change on the driver page. This grates but it what 
  the customer wants... 
  
  Only changed elements are updated.
*/
function UpdateDriver($dta)
{
/*
  $resp = new xajaxResponse();
  $resp->alert(print_r($dta,true));
  return $resp;
*/
  
  global $db, $set;
  $uid = $_SESSION['userid'];	
  extract($dta); //Unpack the form values.
  //Concurrent write check
  if (true === RowHasChanged($rowhash, 'drivers', $current_record_id))
    return xajaxAlert("Record changed since your read it. Please reread.", "Update Request");
  //Require the driver name
  if ($name == '')
  {
      if ($unloading == '')
        return xajaxAlert('Driver name must be provided. Please try again.','Update Request');
      else
        exit;
  }
  $load = GetDriver($current_record_id);
  //Take care of any load level elements..
  if ($load->loadid != '')
  {
    if (!UpdateLoadElements($dta, $load->loadid))
    {
      if ($unloading == '')
        return xajaxAlert("Update failed. Current load not found.", "Update Request");
      else
        exit;
    }  
  }   
    
  $set = '';
  compare('name',$name,$load->name);
  compare('home_town',$home_town,$load->home_town);
  compare('truck_no',$truck_no,$load->truck_no);
  compare('comments',$comments,$load->comments);
  compare('home_office',$home_office,$load->home_office);
  compare('twic',$twic,$load->twic); 
  compare('f4ft_tarps',$f4ft_tarps, $load->f4ft_tarps, 1);
  compare('f6ft_tarps',$f6ft_tarps, $load->f6ft_tarps, 1);
  compare('f8ft_tarps',$f8ft_tarps, $load->f8ft_tarps, 1);
  compare('pipe_stakes',$pipe_stakes,$load->pipe_stakes,1);
  compare('driving_limitations',$driving_limitations, $load->driving_limitations);
  compare('load_levelers',$load_levelers,$load->load_levelers);
  compare('load_options',$load_options,$load->load_options);
  compare('canada',$canada,$load->canada);
  compare('tlength',$tlength,$load->tlength);
  compare('ttype',$ttype,$load->ttype);
  compare('rating',$rating,$load->rating);
  compare('agentid',$agentid,$load->agentid);
  compare('phone_numbers',$phone_numbers,$load->phone_numbers);
  
  if ($set == '')
  {
    if ($unloading == '')
      return xajaxAlert('No changes detected. Update not done.','Update Request');
    else
      exit;
  }
  $sql = "update drivers set $set where id=$current_record_id";    
  QueryLog($uid."-".$name."-".$sql); //Troubleshoot the queries
  $db->query($sql);
  if ($unloading == '')
  {
    $resp = new xajaxResponse();
    $resp->script("jAlert(\"Record Updated\",\"Update Request\")");
    $sql = "select * from drivers where id = $current_row_id";
    $resp->assign("rowhash", "value", row_md5($sql));
    return $resp;
  }
}
/*
  AddRecord is used to insert a new driver into the system
*/
function AddRecord($dta)
{
  global $db;
  extract($dta);
  if ($driver == '')
    return xajaxAlert("The driver name is required. Please retry.","New Driver Request");
  $driverrec = GetDriverByName($driver);
  if ($driverrec['driver'] == $driver)
    return xajaxAlert("Driver names are unique. Please retry.", "New Driver Request");
}
//Edit procedure dispatcher.
function processEdit($op, $dta)
{
  if ($op == 'update')
  	return UpdateDriver($dta);
  else if ($op == 'delete')
  	return DeleteRecord($dta);
  else if ($op == 'insert')
  	return AddRecord($dta);
  else if ($op == 'listdrivers')
    return DriverList();
  else if ($op == 'readdriver')
    return DisplayDriver($dta);
  else
  	return xajaxAlert("Invalid edit operation code: $op","Edit Request Failure");
}

//Service a change of agent
function GetAgentInfo($dta)
{
  $resp = new xajaxResponse();
  $resp->assign("agent_info","value",BuildAgentInfo($dta));
  return $resp;
}

$xajax->configure('debug',true); //xajax debugger on/off control. Uncomment to turn on...
$xajax->register(XAJAX_FUNCTION,'processEdit');
$xajax->register(XAJAX_FUNCTION,'GetAgentInfo');
$xajax->processRequest();
//$smarty->assign("drivers",DriverList());
$smarty->assign("canadalist", YesNoList('canada'));
$smarty->assign("twiclist", YesNoList('twic'));
$smarty->assign("pipestakes", YesNoList('pipe_stakes'));
$smarty->assign("loadlevelers", YesNoList('load_levelers'));
$smarty->assign("polebunks", YesNoList('pole_bunks'));
$smarty->assign("tlength", GenerateTruckLength(''));
$smarty->assign("ttype", GenerateTruckType(''));
$smarty->assign("agent_list", AgentList());
GenerateSmartyPage();
?>