<?php
/*
  Drivers management page
  

*/
require_once("commons.php");
require_once("utilityV2.php");
$smarty->assign("pgtitle", "Driver Management"); //Displayed page title.
$smarty->assign("domenu", 1); //Menu control
$smarty->assign("dosearch",1); //Global search tool control
$set = ''; //kv pairs for update query
//Setup for jQuery custom alerts
SetAlertCaption("Driver Management");
//Code to process the reminders
include("tickler_overlay.php");

//Generate select for twic, canada, etc
// $target is the field name
// $vlu is its current value.
function YesNoList($target, $vlu=''){
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

//Generate the driver status dropdown
function StatusList($status='')
{
  $s = "<select id='status' name='status'>\n";
  $s .= "<option value='Active' ";
  if ($status == 'Active')
    $s .= "selected";
  $s .= ">Active</option>\n";
  $s .= "<option value='Inactive' ";
  if ($status == 'Inactive')
    $s .= "selected";
  $s .= ">Inactive</option>\n";
  $s .= "</select>\n";
  return $s;
}  
  
  
//Generate the users dropdown
function AgentList($id=0){
  global $db;
  $oid = $_SESSION['officeid'];
  $sql = "select id, user_name from users where officeid = $oid order by user_name";
  $res = $db->get_results($sql);
  $s = "<select id='agentid' name='agentid' onchange='xajax_GetAgentInfo(this.value)'>\n";
  $s .= "<option value='0'>&nbsp;</option>\n";
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

//Evaluate a checkbox value
function CheckChecked($s){
  if ($s == 1)
    return "1";
  else
    return "0";
}

//For the page display. Fetch the load level elements
function GetLoadElements(&$resp, $loadid){
  $load = GetLoad($loadid);
  if (!$load) return;
  $resp->assign("load_number", "value", $load->load_number);
  $resp->assign("pickup_date", "value", $load->pickup_date);
  $resp->assign("delivery_date","value",$load->delivery_date);
  $resp->assign("pickup_location","value",$load->pickup_location);
  $resp->assign("delivery_location","value", $load->delivery_location);
  //Load change detection hidden values.
  $resp->assign("h_load_number", "value", $load->load_number);
  $resp->assign("h_pickup_date", "value", $load->pickup_date);
  $resp->assign("h_delivery_date","value",$load->delivery_date);
  $resp->assign("h_pickup_location","value",$load->pickup_location);
  $resp->assign("h_delivery_location","value", $load->delivery_location);
  $resp->assign("load_status","value","");
}  


/*
  Main driver display function.
  
  This function is called from the browser to 
  display a driver record. It reads everything 
  about the driver and xajax assigns the values to the 
  screen. Use the driver name to key the table.
  
  Also populates the load elements on the page. 
  
  This can also be called from the swap check  
  in which case the data is not an array but  
  only the drivers name.
*/
function DisplayDriver($dta){
  global $db;
  $resp = new xajaxResponse();  
  //Get the driver name from the array or the single param
  if (is_array($dta))
    $s=$dta['name'];    
  else  
    $s = $dta;
  $rw = GetDriverByNameOBJ($s);
  //return ShowData($rw);  
  if (!$rw)
    return xajaxAlert("Driver Record Not Found for $s", "Display Driver");
   
  $name = $rw->name; 
  $id = $db->get_var("select id from drivers where name = '$name'");
  $resp->assign("rowhash",          "value",     RowHash('drivers',$id)); //for concurrancy checks.
  $resp->assign("current_driver_id","value",     $id); //for updates.  
  $resp->assign("current_load_id",  "value",     $rw->loadid); //for page swaps
  $resp->assign("lcanada",          "innerHTML", YesNoList('canada',$rw->canada));
  $resp->assign("ltwiclist",        "innerHTML", YesNoList('twic',$rw->twic));
  $resp->assign("ltlength",         "innerHTML", GenerateTruckLength($rw->tlength));
  $resp->assign("lttype",           "innerHTML", GenerateTruckType($rw->ttype));
  $resp->assign("lpipestakes",      "innerHTML", YesNoList("pipe_stakes",$rw->pipe_stakes));
  $resp->assign("lloadlevelers",    "innerHTML", YesNoList("load_levelers",$rw->load_levelers));
  $resp->assign("lpolebunks",       "innerHTML", YesNoList("pole_bunks",$rw->pole_bunks));
	$resp->assign("lagent_list",      "innerHTML", AgentList($rw->agentid));
  $resp->assign('no_tarps',         'checked',   CheckChecked($rw->no_tarps));
  $resp->assign('f4ft_tarps',       'checked',   CheckChecked($rw->f4ft_tarps));
	$resp->assign('f6ft_tarps',       'checked',  CheckChecked($rw->f6ft_tarps));
	$resp->assign('f8ft_tarps',       'checked',  CheckChecked($rw->f8ft_tarps));
  $resp->assign('rating',           'value',    $rw->rating);
  $resp->assign("driving_limitations", "value", $rw->driving_limitations);
  $resp->assign("comments",         "value",    $rw->comments);
  $resp->assign("load_options",     "value",    $rw->load_options);
  $resp->assign("phone_numbers",    "value",    GetPhones($id,'Driver'));
  $resp->assign("truck_no",         "value",    $rw->truck_no);
  $resp->assign("canada_limitations","value",   $rw->canada_limitations);
  $resp->assign("check_call",        "value",   '');
  $resp->assign("agent_info",        "value",   GetPhones($rw->agentid,'Agent'));
  $resp->assign("name",              "value",   $rw->name);
  $resp->assign("lstatus",           "innerHTML", StatusList($rw->status));
  $resp->assign("lagent_list",       "innerHTML", AgentList($rw->agentid));  
  $resp->assign("home_office",       "value",   $rw->home_office);  
  $resp->assign("home_town",         "value",   $rw->home_town);
  $resp->assign("reminderta",        "value",   GetReminders($id,$rw->id));
  if ($rw->dldeliverydate == '0000-00-00')
    $resp->assign("dldeliverydate",    "value",   '');
  else
    $resp->assign("dldeliverydate",    "value",   $rw->dldeliverydate);
  $resp->assign("dldeliverylocation","value",   $rw->dldeliverylocation);
  if ($rw->loadid > 0)
    GetLoadElements($resp, $rw->loadid);
  return $resp;
}
//------------------------------------------------------------------------------
//Make a call record. From the update proc.
function CreateCheckCallRecord($dta){
  global $db;
  $uid = $_SESSION['userid'];
  $driver = $dta['name'];
  $driverid = $dta['current_driver_id'];  
  $loadid = $dta['current_load_id'];
  $msg = $dta['check_call'];
  $msg = quote_smart($msg);
  $timestamp = date('Y-m-d H:i:s');
  $sql = "insert into call_checks (loadid, driverid, agentid, time_stamp, notes) ";
  $sql .= "values($loadid, $driverid, $uid, '$timestamp', '$msg')";
  QueryLog($uid."-".$driver."-".$sql);
  $db->query($sql);
}

//Create a new load using the load values from the 
//driver page. Called in response to an update
//call where the user changed the load number.
function SetupNewLoad($dta){
  //return ShowData($dta);
  global $db;
  $oid = $_SESSION['officeid'];
  $uid = $_SESSION['userid'];	
  $load_number = $dta['load_number'];
  $pickup_date = $dta['pickup_date'];
  $delivery_date = $dta['delivery_date'];
  $pickup_location = $dta['pickup_location'];
  $delivery_location = $dta['delivery_location'];
  $driverrec = $dta['current_driver_id'];
  $driver = GetDriver($driverrec);
  $driverid = $dta['current_driver_id'];
 
  $driver_name = $driver->name;
  //9/16/10 - Check for the 'dummy' load number.
  //If found then setup the dummy load.
  if ($load_number == 'NA'){
    $dummyLoad = true;
    $load_number = 'NA'.$driverid.date('njyGi');
  }
  else
    $dummyLoad = false;
  //Disallow duplicate load numbers
  $sql = "select * from loads where load_number = '$load_number'";
  $rw = $db->get_row($sql);
  if ($rw)
    return false;

  $sql = "insert into loads (load_number,driverid,pickup_date,
                             delivery_date,pickup_location,delivery_location, driver_name,officeid) ";
  $sql .= "values('$load_number',$driverid,'$pickup_date','$delivery_date',";
  $sql .= "'$pickup_location','$delivery_location','$driver_name',$oid)";
  QueryLog($uid."-".$driver_name."-".$sql);
  $db->query($sql);
  $_SESSION['swapid'] = $db->insert_id; //Force load display

  //Update the driver to reflect the new load iif not a dummy
  $loadid = $db->insert_id;
  if (!$dummyLoad)
  {
  $sql = "update drivers set loadid=$loadid where id = $driverid";
  QueryLog($uid."-".$driver_name."-".$sql);
  $db->query($sql);
  }
  else
  {
    $sql = "update loads set load_notes = 'Non Office Load' where id = $loadid";
    QueryLog($uid."-".$driver_name."-".$sql);
    $db->query($sql);
  }
  return true;  
}


/*
  UpdateLoadElements maintains the elements of
  the driver's current load record that we allow to
  be messed with on the driver page.
  Part of the driver page update process...
*/
function UpdateLoadElements($dta){
  //return ShowData($dta);
  global $db, $set;
  $uid = $_SESSION['userid'];	
  extract($dta);
  $loadid = $current_load_id;
  $load = GetLoad($loadid);
  $set = '';
  compare('load_number',       $load_number,       $load->load_number);
  compare('pickup_date',       $pickup_date,       $load->pickup_date);
  compare('delivery_date',     $delivery_date,     $load->delivery_date);
  compare('pickup_location',   $pickup_location,   $load->pickup_location);
  compare('delivery_location', $delivery_location, $load->delivery_location);
  if ($set == '') return 1;
  $sql = "update loads set $set where id = $loadid";
  QueryLog($uid."-".$driver."-".$sql);
  $db->query($sql);
  return 1;
}

/*
  UpdateRecord is called from the browser to update the driver record.
  
  The row in the table is checked for changes using the hash entered 
  at read time. The update is rejected if the table has changed.
  
  The data is passed to UpdateLoadElements() to take care of the load
  items the user can change on the driver page. This grates but it what 
  the customer wants... 
  
  Only changed elements are updated.
*/
function UpdateDriver($dta){
  //return ShowData($dta);
  global $db, $set;
  $resp = new xajaxResponse();  
  $uid = $_SESSION['userid'];	  
  //Concurrent write check
  //9/24/10 - Placed this chech here as there seems to have been
  //changes after the quote smart call.
  if (true === RowHasChanged($rowhash, 'drivers', $current_driver_id))
    return xajaxAlert("Record changed since your read it. Please reread.");
  extract($dta); //Unpack the form values.
  //5/17/11 - See if this si a good driver first...
  $driver = GetDriverByName($name);
  if (!$driver)
    return xajaxAlert('Driver not found to update. Please try again.');
  //Require the driver name
  if ($name == '')
  {
      if ($unloading == '')
        return xajaxAlert('Driver name must be provided. Please try again.');
      else
        exit;
  }
  
  //Take care of any load level elements..
  $res = 'x';
  $loadid = $current_load_id; 
  if ($load_status == 'makenew'|| $load_number == 'NA')
    $res = SetupNewLoad($dta);
  else if ($loadid)
    $res = UpdateLoadElements($dta);
  if (false === $res){
    if ($unloading == '')
      return xajaxAlert("Load Update failed. Load Number in use or Current load not found.");
    else
      exit;
  }  
  //Unset the new record flag
  $resp->assign("load_status", "value", "nochange");
  
  //return showdata($driver['id']);
  if ($check_call != '')
    CreateCheckCallRecord($dta);    
  $f4ft_tarps = CheckCheck($f4ft_tarps);  
  $f6ft_tarps = CheckCheck($f6ft_tarps);    
  $f8ft_tarps = CheckCheck($f8ft_tarps);  
  $no_tarps = CheckCheck($no_tarps);
  $set = '';
  compare('name',$name,$driver['name']);
  compare('home_town',$home_town,$driver['home_town']);
  compare('truck_no',$truck_no,$driver['truck_no']);
  compare('comments',$comments,$driver['comments']);
  compare('home_office',$home_office,$driver['home_office']);
  compare('twic',$twic,$driver['twic']); 
  compare('f4ft_tarps',$f4ft_tarps, $driver['f4ft_tarps'], 1);
  compare('f6ft_tarps',$f6ft_tarps, $driver['f6ft_tarps'], 1);
  compare('f8ft_tarps',$f8ft_tarps, $driver['f8ft_tarps'], 1);    
  compare('no_tarps',$no_tarps, $driver['no_tarps'], 1);  
  compare('pipe_stakes',$pipe_stakes,$driver['pipe_stakes']);
  compare('driving_limitations',$driving_limitations, $driver['driving_limitations']);
  compare('load_levelers',$load_levelers,$driver['load_levelers']);
  compare('load_options',$load_options,$driver['load_options']);
  compare('canada',$canada,$driver['canada']);
  compare('tlength',$tlength,$driver['tlength']);
  compare('ttype',$ttype,$driver['ttype']);
  compare('rating',$rating,$driver['rating']);
  compare('agentid',$agentid,$driver['agentid'],1);
  compare('status',$status,$driver['status']);
  compare('dldeliverydate', $dldeliverydate, $driver['dldeliverydate']);
  compare('dldeliverylocation',$dldeliverylocation, $driver['dldeliverylocation']);
  
  //compare('phone_numbers',$phone_numbers,$driver->phone_numbers);  
  //compare('load_status',$load_status,$driver->load_status);
  //return ShowData($set);
  if ($set == '')
  {
    if ($_SESSION['swapid'] != '')
    {
      $resp->script("jAlert(\"No changes detected.\",\"Update Request\")");
      $resp->redirect("loads.php");
      return $resp;
    }
    if ($unloading == '')
      return xajaxAlert('No changes detected. Update not done.','Update Request');
    else
      exit;
  }
  //return showdata($set);  
  $did = $driver['id'];
  $sql = "update drivers set $set where id = $did";    
  QueryLog($uid."-".$name."-".$sql); //Troubleshoot the queries
  $db->query($sql);
  if ($unloading == '')
  {
    $resp->script("jAlert(\"Record Updated\",\"Update Request\")");
    $resp->assign("rowhash", "value", RowHash("drivers", $current_driver_id));
    
    if ($_SESSION['swapid'] != '')
      $resp->redirect("loads.php");
    return $resp;
  }
}
//--------------------------------------------------------------------------
  //Building the field and value list for the insert query
  function addField($fld,$vlu,&$flds,&$vals)
  {
    if ($vlu == '') return;
    if ($flds == '') 
      $flds = $fld;
    else
      $flds .= ",$fld";
    if ($vals == '')
      $vals = "'$vlu'";
    else
      $vals .= ",'$vlu'";
  }

/*
  This function creates a load record if the user entered a
  load number value.
*/
function AddLoad($dta, $driverid)
{
  global $db;
  extract ($dta);
  if  ($load_number == '') return true; //No nnumber, no load...
  $oid = $_SESSION['officeid'];
  $flds = '';
  $vals = '';
  //Add the page load fields to the query fields and strings  
  addField('pickup_date',$pickup_date,$flds,$vals);
  addField('delivery_date',$delivery_date,$flds,$vals);
  addField('pickup_location',$pickup_location,$flds,$vals);
  addField('delivery_location',$delivery_location,$flds,$vals);
  if ($flds == '')
  {
    $sql = "insert into loads ($flds) values ($vals)";
    QueryLog($sql);   
    return false;
  }
  //Add the fixed fields
  $flds .= ',driverid,load_number,officeid';
  $vals .= ",$driverid,'$load_number',$oid";
  $sql = "insert into loads ($flds) values ($vals)";
  QueryLog($sql);
  $db->query($sql);
  $lid = $db->insert_id;
  if (!$lid) return false;
  //Update the driver with the load id value.
  $sql = "update drivers set loadid = $lid where id = $driverid";
  $db->query($sql);
  return true;
}
/*
  AddRecord is used to insert a new driver into the system
*/
function AddDriver($dta){

/*
  $resp = new xajaxResponse();
  $resp->alert(print_r($dta,true));
  return $resp;
*/
  global $db;
  $oid = $_SESSION['officeid'];
  foreach($dta as $x )
    $x = quote_smart($x);
  extract($dta);
  
  
  $user = $_SESSION['userid'];
  if ($name == '')
    return xajaxAlert("The driver name is required. Please retry.");
  $driverrec = GetDriverByName($name);
  if ($driverrec['name'] == $name)
    return xajaxAlert("Driver names are unique. Please retry.");
  $f4ft_tarps = CheckCheck($f4Ft_tarps);
  $f6ft_tarps = CheckCheck($f6Ft_tarps);
  $f8ft_tarps = CheckCheck($f8Ft_tarps);
  $no_tarps   = CheckCheck($no_tarps);
    
  $sql  = "insert into drivers (agentid, name,tlength,ttype,home_town,preferences,home_office,";
  $sql .= "canada,twic,f4ft_tarps,f6ft_tarps,f8ft_tarps,no_tarps,driving_limitations,load_levelers,";
  $sql .= "load_options,status,rating,pole_bunks,canada_limitations,phone_numbers,officeid,truck_no, ";
  $sql .= "dldeliverydate,dldeliverylocation,comments) ";
  
  $sql .= "values($agentid,'$name','$tlength','$ttype','$home_town','$preferences','$home_office',";
  $sql .= "'$canada','$twic',$f4ft_tarps,$f6ft_tarps,$f8ft_tarps,$no_tarps,'$driving_limitations',";
  $sql .= "'$load_levelers','$load_options','$status','$rating','$pole_bunks',";
  $sql .= "'$canada_limitations','$phone_numbers',$oid,'$truck_no','$dldeliverydate','$dldeliverylocation','$comments')";
  QueryLog($user."-".$sql);
  $db->query($sql);
  $did = $db->insert_id;
  $ctx=array("driverphone"=>$h_driverphone,
             "drivercell"=>$h_drivercell,
             "driverfax"=>$h_driverfax,
             "driveremail"=>$h_driveremail);
  ProcessContacts('update',$did,$ctx);
  $s = "New Driver Id: $did";
  QueryLog($s);
  if ($did > 0)
  {
    if (!AddLoad($dta,$did))
      return xajaxAlert("Driver added. Load insert failed.");
    else
      return xajaxAlert("Driver added.");
  }
  else
    return xajaxAlert("Driver insert failed.");
}
//-----------------------------------------------------------------------------
function DeleteDriver($dta){
  global $db;
  extract($dta);  
  $sql = "delete from drivers where id = $current_driver_id";  
  $db->query($sql);  
  if ($db->rows_affected == 1)
  {  
    //Delete from loads    
    $sql = "delete from loads where driverid = $current_driver_id";    
    $db->query($sql);
    //Delete load hostory
    $sql = "delete from load_history where driverid = $current_driver_id";
    $db->query($sql);    
    //Delete phones    
    $sql = "delete from phones where entity_type = 'Driver' and entityid = $current record_id";    
    $db->query($sql);    
    return xajaxAlert("Driver has been deleted.");            
  }
  else  
    return xajaxAlert("Failed to delete driver. $sql");
}
//------------------------------------------------------------------------
//Service a change of agent
function GetAgentInfo($dta)
{
  $resp = new xajaxResponse();
  $resp->assign("agent_info","value",BuildAgentInfo($dta));
  return $resp;
}
function ReadContacts($id)
{
  global $db;
  $resp = new xajaxResponse();
  $resp->assign('driverphone','value','');
  $resp->assign('drivercell','value','');
  $resp->assign('driverfax','value','');
  $resp->assign('driveremail','value','');
  $sql = "select * from phones where entityid = $id";
  $res = $db->get_results($sql);
  if (!$res) return $resp;
  foreach($res as $row)
  {
    switch($row->contact_type)
    {
      case 'Home':
        $resp->assign('driverphone','value',$row->entity);
        break;
      case 'Cell':
        $resp->assign('drivercell','value',$row->entity);
        break;
      case 'Fax':
        $resp->assign('driverfax','value',$row->entity);
        break;
      case 'Email':
        $resp->assign('driveremail','value',$row->entity);
        break;
    }
  }
  return $resp;
}
function CheckContact($id,$ctype,$vlu){
  global $db;
  if ($vlu == '') return;
  $pr = ReadPhoneRec($id,'Driver',$ctype);
  if (!$pr) //insert if not there
  {
    $driver = GetDriver($id);
    $driver_name = $driver->name;
    $sql = "insert into phones(contact_type,entityid,entity,entity_name,entity_type)
           values('$ctype',$id,'$vlu','$driver_name','Driver')";
    $db->query($sql);
    }
    else
    {
      $pid = $pr->id;
      $sql = "update phones set entity = '$vlu' where id = $pid";
      $db->query($sql);
    }
  }
      
  
/*
  On page driver contact processing
  $op - Add, Update - ignored
  $id - driver id value
  $dta - form values
    $driverphone
    $drivercell
    $driverfax
    $driveremail
*/
function ProcessContacts($op,$id,$dta){
  global $db;
  if ($op =='read')
    return ReadContacts($id);
  
  $resp = new xajaxResponse();
  if ($id == '') return $resp;
  $driver = GetDriver($id);
  $driver_name = $driver->name;
  extract($dta);
  CheckContact($id,'Home',$driverphone);
  CheckContact($id,'Cell',$drivercell);
  CheckContact($id,'Fax',$driverfax);
  CheckContact($id,'Email',$driveremail);
  $s = GetPhones($id);
  $resp->assign('phone_numbers','value',$s);
  return $resp;
}

function DisplayUploadRecords($dta)
{
	//return ShowData($dta);
  global $db;
	$resp = new xajaxResponse();
	$driver = $dta['name'];
	$truck_no =$dta['truck_no'];
	$sql = "select * from truck_inbound where truck_number = '$truck_no'";
	$res = $db->get_results($sql);
	if (!$res)
	{ 
		$sql = "select * from truck_inbound where driver = '$driver'";
		$res = $db->get_results($sql);
		if (!$res)
			return xajaxAlert("No Upload Records for this Driver", "Upload Display Request");
	}
	$s = "<table border='1' style='color:black;'>\n";
	$s .= "<tr><th>Agent<th>Unit<th>Truck #<th>Equipment<th>Driver<th>Cell<th>Origin<th>";
	$s .= "Destination<th>Delivery Date<th>Comments<th>Report Date</tr>";
	foreach($res as $rw)
	{
		$origin = "$rw->origin_city, $rw->origin_state";
		$destination = "$rw->dest_city, $rw->dest_state";
		$ddate = "$rw->delivery_month/$rw->delivery_day";
		$s .= "<td>$rw->agent<td>$rw->unit<td>$rw->truck_number<td>$rw->equipment<td>$rw->driver";
		$s .= "<td>$rw->cell<td>$origin<td>$destination<td>$rw->delivery_date<td>$rw->comments<td>$rw->report_date</tr>";
	}
	$s .= "</table>";
	$s = "<br><br><center><input type=button value='Close' onclick='fb.end()'><br><br>$s</center>";
	$resp->assign("floatboxcontent","innerHTML",$s);
	$resp->script("fb.loadAnchor('#floatboxcontent')");
	return $resp;
}
//------------------------------ Email Functions ---------------------------------
function SetupEmail(){
  global $db;
  $did = $_SESSION['current_driver_id'];
  $driver = GetDriver($did);
  if (!$driver)
    return xajaxAlert("Unable to find the driver record...");
  $resp = new xajaxResponse();
  $resp->assign("driverid","value",$did);
  $resp->assign("mailto","value",$driver->name);
  $email = GetPhoneValue($did,'Driver','Email');
  if ($email)
    $resp->assign("demail","value",$email);
  else
    $resp->assign("demail","value","No Email Defined");
    
  return $resp;
}
function ValidateEmailInputs($dta){
  $s = '';
  extract($dta);
  if ($demail == ''|| $demail == 'No Email Defined')
    $s .= "Email Address, ";
  if ($esubject == '')
    $s .= "Subject, ";
  if ($emailtext == '')
    $s .= "Message Body";
  if ($s != '')
    $s = "Please fix the following: $s";
  return $s;  
}

function SendEmail($dta){
  //return ShowData($dta);
  $s = ValidateEmailInputs($dta);
  if ($s != '')
    return xajaxAlert($s);
  extract($dta);
  $emailtext = str_replace('<br>',"\n",$emailtext);
  $emailtext = wordwrap($emailtext, 70);
  
  $uid = $_SESSION['userid'];
  $user = ReadUserRec($uid);
  $uemail = $user->email;
  if ($uemail == '')
    return xajaxAlert("No email defined for this user...");
  $headers = "From: $uemail\r\n";
  $headers.= "Reply_To: $uemail\r\n";
  $res = mail($demail, $esubject, $emailtext, $headers);
  if ($res === true)
    return xajaxAlert("Email Sent...");
  else
    return xajaxAlert("Failed to send email");
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
    $rw = GetDriver($id);
    return DisplayDriver($rw->name);
  }
  else  
    return $resp;
}

/*
  PageSwap is called in response to a browser hot key
  and is used to display the current load associated with
  the driver. It writes the load id to the session
  variable "sqapid" and redirects to the loads management
  page.
*/
function PageSwap($dta){
  $resp = new xajaxResponse();
  $_SESSION['swapid'] = $dta['current_load_id']; //Setup so the loads page knows about the swap;  
  $resp->redirect("loads.php");  
  return $resp;
}

//Edit procedure dispatcher.
function processEdit($op, $dta){
  if ($op == 'update')
  	return UpdateDriver($dta);
  else if ($op == 'delete')
  	return DeleteDriver($dta);
  else if ($op == 'insert')
  	return AddDriver($dta);
  else if ($op == 'readdriver')
    return DisplayDriver($dta);
  else if ($op == 'swappages')
    return PageSwap($dta);
  else if ($op == 'deletedriver')
    return DeleteDriver($dta);  
  else
  	return xajaxAlert("Invalid edit operation code: $op","Edit Request Failure");
}
$xajax->register(XAJAX_FUNCTION,'CheckPageSwap');
$xajax->register(XAJAX_FUNCTION,'PageSwap');


//$xajax->configure('debug',true); //xajax debugger on/off control. Uncomment to turn on...
$xajax->register(XAJAX_FUNCTION,'processEdit');
$xajax->register(XAJAX_FUNCTION,'GetAgentInfo');
$xajax->register(XAJAX_FUNCTION,'ProcessContacts');
$xajax->register(XAJAX_FUNCTION,'SetupEmail');
$xajax->register(XAJAX_FUNCTION,'SendEmail');
$xajax->register(XAJAX_FUNCTION,'DisplayUploadRecords');
$xajax->processRequest();
//Initial display values.
$smarty->assign("tlength", GenerateTruckLength());
$smarty->assign("ttype", GenerateTruckType());
$smarty->assign("canadalist", YesNoList("canada"));
$smarty->assign("twiclist", YesNoList("twic"));
$smarty->assign("agent_list", AgentList());
$smarty->assign("status",StatusList());
$smarty->assign("pipestakes",YesNoList("pipestakes"));
$smarty->assign("loadlevelers", YesNoList("loadlevelers"));
$smarty->assign("polebunks",YesNoList("polebunks"));
$smarty->assign("freqlist",ReminderFrequencyList());

GenerateSmartyPage();
?>