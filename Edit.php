<?php
/*
  Editor page for Jakes Loads
  4/21/2010 - Add driver search from the driver input tag via
  the label onclick.
  4/28/2010 - Delete private notes when deleting driver.  
  5/21/2010 - Add upload file display.
  6/7/2010  - Add several requirements to the update function:
              1. Require driver name
              2. Only update changed elements
              3. Update target record must exist.
*/
require_once("commons.php");
require_once("utility.php");
$smarty->assign("pgtitle", "Driver Editor"); 
$smarty->assign("domenu", 1);
$set=''; //Update field list.
//Troubleshooting query logger
function LogQuery($s)
{
  $hdl = fopen("querylog.txt", "a");
  if ($hdl)
  {
    $txt = date('r')."  $s\n\r";
    fwrite($hdl,$txt);
    fclose($hdl);
  }
}
    
//This function is used to clean up problem fields
//That contain things like single quotes...
function Cleanup($s)
{
  if (strpos("'", $s))
  {
    $tmp = str_replace("'","ft",$s);
    return $tmp;
  }
  else
    return $s;
}

//evaluate at a logical for a checkbox.
function CheckChecked($s)
{
  if ($s == 1)
    return " checked";
  else
    return '';
}

function CheckEmpty($s)
{
	if ($s == '0')
		return '';
	else
	{
	  return  str_replace("_x000A_","\n",$s);
	}
}

function RadioCheck(&$rb1, &$rb2)
{
	global $smarty;
	
}
 
//Build the record for editing
//This probably should be in the template file...
function DisplayLoad()
{
  global $db, $smarty;
  //See if we're called from the radius search.
  if (isset($_SESSION['radiusid']) && $_SESSION['radiusid'] != '')
  {
    $_SESSION['lastid'] = $_SESSION['radiusid'];
    $_SESSION['radiusid'] = '';
  }
	$id = $_SESSION['lastid']; //The target record
        if ($id == '') return '';
	$searchlist = "truck_loader";
	$sql = "select * from $searchlist where id = $id";
	$res = $db->get_row($sql);
	//return print_r($res,true);
	if (!$res)
	{
		return "Selected record was not found.";
	}
  $_SESSION['lastdriverloaded'] = $res->driver; //4/20/2010 - save for driver search replacement.
	foreach($res as $x)
		$x = stripslashes($x);
	
	$smarty->assign("rating",$res->rating); //4/27/10 - new field for rating the drivers.
  $smarty->assign("driverid", $res->id); //4/26/10 - save for update and delete.
	$smarty->assign('driver',$res->driver);
	$smarty->assign('driver_alias', $res->driver_alias);
	$smarty->assign('unload_date',$res->unload_date);
	
	if ($res->canada == 1)
		$smarty->assign('canada', 'checked');
	else if ($res->canada == 2)
  	$smarty->assign('no_canada','checked');
  else
  	$smarty->assign('dk_canada','checked');
	
	$smarty->assign('location',$res->location);
	$smarty->assign('truck_length',GenerateTruckLength($res->tlength));
	$smarty->assign('truck_type',GenerateTruckType($res->ttype));
	
	if ($res->twic == 1)
		$smarty->assign('twic', 'checked');
	else if ($res->twic == 2)
		$smarty->assign('no_twic','checked');
	else
		$smarty->assign('dk_twic', 'checked');
	
	$smarty->assign('home_town',$res->home_town);
	$smarty->assign('truck_no', $res->truck_no);
	$smarty->assign('email',$res->email);
	if ($res->load_levelers == 1)
		$smarty->assign('load_levelers','checked');
	else if ($res->load_levelers == 2)
	 	$smarty->assign('no_load_levelers','checked');
	else
		$smarty->assign('dk_load_levelers', 'checked');			
	if($res->load_status == 1)
		$smarty->assign('ls_planned', 'checked');
	else if($res->load_status == 2)
		$smarty->assign('ls_loaded', 'checked');
	else if ($res->load_status == 3)
		$smarty->assign('ls_unloaded', 'checked');
		
	$smarty->assign('telephone',CheckEmpty($res->telephone));	
	$smarty->assign('message_voice_mail',CheckEmpty($res->message_voice_mail));
	if ($res->pipe_stakes == 1)
		$smarty->assign('pipe_stakes','checked');
	else if ($res->pipe_stakes == 2)
		$smarty->assign('no_pipe_stakes','checked');
	else
		$smarty->assign('dk_pipe_stakes', 'checked');
	$smarty->assign('home_office',CheckEmpty($res->home_office));
	$smarty->assign('office_numbers',CheckEmpty($res->office_numbers));
	$smarty->assign('f4ft_tarps',CheckChecked($res->f4ft_tarps));
	$smarty->assign('f6ft_tarps',CheckChecked($res->f6ft_tarps));
	$smarty->assign('f8ft_tarps',CheckChecked($res->f8ft_tarps));
  $smarty->assign('driver_status',CheckChecked($res->driver_status));
	$smarty->assign('comments',str_replace("_x000A_","\n",$res->comments));
	$smarty->assign('preferences',CheckEmpty($res->preferences));
	$smarty->assign('load_options',CheckEmpty($res->load_options));
	$smarty->assign('driving_limitations',CheckEmpty($res->driving_limitations));
	$smarty->assign('upload_comment',CheckEmpty($res->upload_comment));
  $smarty->assign("uploadequipment", $res->equipment);
  //5/7/10 - replace the recent users with the agent userid
  $uid = $res->userid;
  $userid = ReadUser($uid);
  $smarty->assign("agent",$userid);
//	UpdateDriverAccess($res->driver);	//Rread recent users
/*
	$sql = "select * from user_history where driver = '$res->driver'";
	$res = $db->get_row($sql);
	if ($res)
	{
		$s = "<select>";
		$s .= "<option>$res->user1</option>";
		$s .= "<option>$res->user2</option>";
		$s .= "<option>$res->user3</option>";
		$s .= "</select>";
		$smarty->assign('user_list', $s);
	}
	else
		$smarty->assign('user_list', 'No Users');
*/
	
	
	
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

//Update the current record
function UpdateRecord($dta)
{
	function AdjustCheckBox(&$cb)
	{
	 if ($cb == 'on')
	   $cb = '1';
	 else $cb = 0;
	}
	$uid = $_SESSION['userid'];	
  global $db;
  $resp = new xajaxResponse();  
  extract($dta);
  // 6/7/2010 - require the driver name
  if ($driver == '')
  {
      if ($unloading == '')
        return xajaxAlert('Driver name must be provided. Please try again.','Update Request');
      else
        exit;
  }
  
  $id = $driverid; //Table record number
  //Set the checkbox control values
	AdjustCheckBox($f4ft_tarps);
  AdjustCheckBox($f6ft_tarps);
  AdjustCheckBox($f8ft_tarps);
  AdjustCheckBox($driver_status);
  if (!isset($load_levelers)) $load_levelers = 3;
  if (!isset($canada)) $canada = 3;
  if (!isset($twic)) $twic = 3;
  if (!isset($pipe_stakes)) $pipe_stakes = 3;
  if(!isset($load_status)) $load_status = 0;
  //6/7/10 - Only update the changed elements
  //Read the existing record and complain if not there.
  $load = readLoad($id);
  if (!$load)
  {
      LogQuery($uid."Update Error: Driver record not found to update Rec#: $id");
      if ($unloading == '')
        return xajaxAlert("Error: Driver record not found to update Rec#: $id","Update Request");
      else
        exit;
  }
  global $set;
  $set = '';
  compare('driver',$driver,$load->driver);
  compare('unload_date',$unload_date, $load->unload_date);
  compare('location',$location,$load->location);
  compare('home_town',$home_town,$load->home_town);
  compare('preferences',$preferences,$load->preferences);
  compare('truck_no',$truck_no,$load->truck_no);
  compare('telephone',$telephone,$load->telephone);
  compare('comments',$comments,$load->comments);
  compare('home_office',$home_office,$load->home_office);
  compare('office_numbers',$office_numbers,$load->office_numbers);
  compare('twic',$twic,$load->twic,1); 
  compare('f4ft_tarps',$f4ft_tarps, $load->f4ft_tarps, 1);
  compare('f6ft_tarps',$f6ft_tarps, $load->f6ft_tarps, 1);
  compare('f8ft_tarps',$f8ft_tarps, $load->f8ft_tarps, 1);
  compare('pipe_stakes',$pipe_stakes,$load->pipe_stakes,1);
  compare('driving_limitations',$driving_limitations, $load->driving_limitations);
  compare('load_levelers',$load_levelers,$load->load_levelers,1);
  compare('load_options',$load_options,$load->load_options);
  compare('load_status',$load_status,$load->load_status,1);
  compare('canada',$canada,$load->canada,1);
  compare('tlength',$tlength,$load->tlength);
  compare('ttype',$ttype,$load->ttype);
  compare('driver_alias',$driver_alias,$load->driver_alias);
  compare('upload_comment',$upload_comment,$load->upload_comment);  
  compare('email',$email,$load->email);
  compare('rating',$rating,$load->rating);
  compare('driver_status',$driver_status,$load->driver_status,1);
  if ($set == '')
  {
    if ($unloading == '')
      return xajaxAlert('No changes detected. Update not done.','Update Request');
    else
      exit;
  }
  $sql = "update truck_loader set $set where id=$id";    
  LogQuery($uid."-".$driver."-".$sql); //Troubleshoot the queries
  $db->query($sql);
  UpdateUnloadDateValues($id);
  //4/22/2010 - Automatic update on unload. Do not alert if unloading the page. 
  if ($unloading == '')
  {
 	  $resp->loadCommands(xajaxAlert('Record Updated...','Update Request'));
    return $resp;	
  }
}	

//Remove the current record
//4/22/10 - add password requirement
function DeleteRecord($dta)
{
	global $db;
  
	$resp = new xajaxResponse();
  $delpwd = '147734'; //Password to delete a driver
  $sentpwd = $dta['dprd'];
  $resp->assign("dprd","value",""); //Don't leave the password in the browser...
  if ($delpwd != $sentpwd)
    return xajaxAlert('Record NOT deleted. Incorrect password...','Driver Delete Request');
  extract($dta);
	$id = $driverid; //$_SESSION['lastid']; 4/26/10 - use hidden id value
	$sql = "delete from truck_loader where id = $id";
	if (!$db->query($sql))
	   return xajaxAlert('Failed to delete the record.','Driver Delete Request');
	else
  {
     $sql = "delete from private_notes where id = $id";
     //4/28/2010 - remove other table data
     $db->query($sql); 
     $sql = "delete from load_history where driverid = $id";
     $db->query($sql);
	   return xajaxAlert('Record Deleted','Driver Delete Request');
  }
}
  function GetUser($uid)
  {
  	global $db;
  	$sql = "select * from users where id=$uid";
  	$rw = $db->get_row($sql);
  	if (!$rw)
  		return '';
  	else
  	return $rw->user;
  }

function DriverList()
{
	$resp = new xajaxResponse();
  $s = BuildDriverList("ShowLoad");
	$resp->assign("floatboxcontent","innerHTML", $s);
	$resp->script("fb.loadAnchor('#floatboxcontent')");
	return $resp;
}
function ShowLoad($id)
{
	$_SESSION['lastid'] = $id;
  global $db, $smarty;
  $resp = new xajaxResponse();
	$sql = "select * from truck_loader where id = $id";
	$res = $db->get_row($sql);
	//return print_r($res,true);
	if (!$res)
		return xajaxAlert('Selected record was not found','Display Request');
	foreach($res as $x)
		$x = stripslashes($x);
	$resp->assign('driverid','value',$res->id);//The hidden value for further editing.
	$resp->assign('driver','value',$res->driver);
	$resp->assign('driver_alias','value', $res->driver_alias);
	$resp->assign('unload_date','value',$res->unload_date);
	$resp->assign("uploadequipment","value", $res->equipment);
	if ($res->canada == 1)
		$resp->assign('canada','checked', true);
	else if ($res->canada == 2)
  	$resp->assign('no_canada','checked', true);
  else
  	$resp->assign('dk_canada','checked', true);
	
	$resp->assign('location','value',$res->location);
	$resp->assign('truck_length','innerHTML',GenerateTruckLength($res->tlength));
	$resp->assign('truck_type','innerHTML',GenerateTruckType($res->ttype));
	
	if ($res->twic == 1)
		$resp->assign('twic', 'checked',true);
	else if ($res->twic == 2)
		$resp->assign('no_twic','checked',true);
	else
		$resp->assign('dk_twic','checked',true);
	
	$resp->assign('home_town','value',$res->home_town);
	$resp->assign('truck_no','value', $res->truck_no);
	$resp->assign('email','value',$res->email);
	if ($res->load_levelers == 1)
		$resp->assign('load_levelers','checked',true);
	else if ($res->load_levelers == 2)
	 	$resp->assign('no_load_levelers','checked',true);
	else
		$resp->assign('dk_load_levelers','checked',true);			
	if($res->load_status == 1)
		$resp->assign('ls_planned', 'checked',true);
	else if($res->load_status == 2)
		$resp->assign('ls_loaded',  'checked',true);
	else if ($res->load_status == 3)
		$resp->assign('ls_unloaded', 'checked',true);
		
	$resp->assign('telephone','value',CheckEmpty($res->telephone));	
	$resp->assign('message_voice_mail','value',CheckEmpty($res->message_voice_mail));
	if ($res->pipe_stakes == 1)
		$resp->assign('pipe_stakes', 'checked',true);
	else if ($res->pipe_stakes == 2)
		$resp->assign('no_pipe_stakes', 'checked',true);
	else
		$resp->assign('dk_pipe_stakes', 'checked',true);
	$resp->assign('home_office','value',CheckEmpty($res->home_office));
	$resp->assign('office_numbers','value',CheckEmpty($res->office_numbers));
	$resp->assign('f4ft_tarps','value',CheckChecked($res->f4ft_tarps));
	$resp->assign('f6ft_tarps','value',CheckChecked($res->f6ft_tarps));
	$resp->assign('f8ft_tarps','value',CheckChecked($res->f8ft_tarps));
	$resp->assign('comments','value',str_replace("_x000A_","\n",$res->comments));
	$resp->assign('preferences','value',CheckEmpty($res->preferences));
	$resp->assign('load_options','value',CheckEmpty($res->load_options));
	$resp->assign('driving_limitations','value',CheckEmpty($res->driving_limitations));
	$resp->assign('upload_comment','value',CheckEmpty($res->upload_comment));
	UpdateDriverAccess($res->driver);	//Rread recent users
	$sql = "select * from user_history where driver = '$res->driver'";
	$res = $db->get_row($sql);
	if ($res)
	{
		$s = "<select>";
		$s .= "<option>$res->user1</option>";
		$s .= "<option>$res->user2</option>";
		$s .= "<option>$res->user3</option>";
		$s .= "</select>";
		$resp->assign('user_list','value', $s);
	}
	else
		$resp->assign('user_list','value', 'No Users');
	$resp->script("fb.end()");
	return $resp;
}


//This just redirects to the new load create page.
function CreateNew()
{
  $resp = new xajaxResponse();
  $resp->redirect("new_load.php");
  return $resp;
}

//4/21/10 - Search drivers on partial name
//Called by the driver label on the page.
function DriverSearch($dta)
{
  $resp = new xajaxResponse();
  //Restore the driver field
  if (isset($_SESSION['lastdriverloaded']) && $_SESSION['lastdriverloaded'] != '')
    $resp->assign("driver","value",$_SESSION['lastdriverloaded']);
  //In prep for the office branding mods.
  if(isset($_SESSION['office']))
    $office = $_SESSION['office'];
  else
    $office = '';
  $driver = $dta['driver'];
  if ($driver == '')
    return xajaxAlert("Please enter all or part of a driver name and try again.","Search Request");
  $sql = "select * from truck_loader where driver like '%$driver%'";
  if ($office != '')
    $sql .= " and office='$office'";
  $s = BuildDriverList("ShowLoad",1,'','',$sql);
	$resp->assign("floatboxcontent","innerHTML", $s);
	$resp->script("fb.loadAnchor('#floatboxcontent')");
	return $resp;
}

function SearchAll($dta)
{
  $resp = new xajaxResponse();
  if($dta == '')
    return xajaxAlert("Please enter a search term.","Search All Request");
  //In prep for the office branding mods.
  if(isset($_SESSION['office']))
    $office = $_SESSION['office'];
  else
    $office = '';
  $sql  = "select * from truck_loader where ";
  $sql .= "driver like '%$dta%' ";
  $sql .= "or location like '%$dta%' ";
  $sql .= "or home_town like '%$dta%' ";
  $sql .= "or telephone like '%$dta%' ";
  $sql .= "or email like '%$dta%' ";
  $sql .= "or home_office like '%$dta%' ";
  $sql .= "or comments like '%$dta%' ";
  $sql .= "or upload_comment like '%$dta%' ";
  $sql .= "or driver_alias like '%$dta%' ";
  $sql .= "or unload_date like '%$dta%' ";
  $sql .= "or truck_no like '%$dta%' ";
  $sql .= "or preferences like '%$dta%' ";
  $sql .= "or driving_limitations like '%$dta%' ";
  $sql .= "or load_options like '%$dta%' ";
  $sql .= "or ttype like '%$dta%' "; 
  $sql .= "or tlength like '%$dta%' ";
  if ($office != '')
    $sql .= "and office = '$office'";
  $s = BuildDriverList("ShowLoad",1,'','',$sql);
	$resp->assign("floatboxcontent","innerHTML", $s);
	$resp->script("fb.loadAnchor('#floatboxcontent')");
	return $resp;
}

//5/8/10 - Setup and open the private notes page.
function OpenPrivateNotes($dta)
{
	$_SESSION['notesuser'] = $_SESSION['userid'];
	$_SESSION['notesdriver'] = $dta['driverid'];
	$resp = new xajaxResponse();
	$resp->redirect("private_notes.php");
	return $resp;
}

function DisplayUploadRecords($dta)
{
	global $db;
	$resp = new xajaxResponse();
	$driver = $dta['driver'];
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

//Edit procedure dispatcher.
function processEdit($op, $dta)
{
  $resp = new xajaxResponse();
  if ($op == 'update')
  	return UpdateRecord($dta);
  else if ($op == 'delete')
  	return DeleteRecord($dta);
  else if ($op == 'listdrivers')
    return DriverList();
  else
  	return xajaxAlert("Invalid edit operation code: $op","Edit Request Failure");
}

//Get the display data.
$smarty->assign("editdata",DisplayLoad());
//$xajax->configure('debug',true); //xajax debugger on/off control. Uncomment to turn on...
$xajax->register(XAJAX_FUNCTION,'processEdit');
$xajax->register(XAJAX_FUNCTION,'CreateNew');
$xajax->register(XAJAX_FUNCTION,'DriverList');
$xajax->register(XAJAX_FUNCTION,'DriverSearch');
$xajax->register(XAJAX_FUNCTION,'SearchAll');
$xajax->register(XAJAX_FUNCTION,'ShowLoad');
$xajax->register(XAJAX_FUNCTION,'OpenPrivateNotes');
$xajax->register(XAJAX_FUNCTION,'DisplayUploadRecords');
$xajax->processRequest();
GenerateSmartyPage();
?>