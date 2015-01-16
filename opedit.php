<?php
/*
  Editor page for Jakes Loads - single page site version.
*/
class opedit{
  /*
    "Standard" page initialization procedure.
    1. Do all of the Smarty assigns
    2. Fetch the template content
    3. Assign it to the onepagecontent div.
    4. Assign the page caption
    5. Optionally include any scripts needed.
       This must be done here as we cannot load them
       in any downloaded stream.
    6. Return the response object. 
  */
  public function initialize()
  {
    global $smarty;
    $r = new xajaxResponse();
    $smarty->assign("domenu", 1);
    //Get the display data.
    $smarty->assign("editdata",$this->DisplayLoad());
    $content = $smarty->fetch("opedit.tpl");
    $r->assign("onepagecontent", "innerHTML", $content);
    $r->assign("header", "innerHTML","Driver Editor");
    $r->includeScript("calendar/setDateFormat.js");
    $r->includeScript("calendar/calendar.js");
    $r->includeScript("scripts/opedit.js");
    return $r;
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
  if(!isset($_SESSION['lastid'])) return '';
	$id = $_SESSION['lastid']; //The target record
	$searchlist = "truck_loader";
	$sql = "select * from $searchlist where id = $id";
	$res = $db->get_row($sql);
	//return print_r($res,true);
	if (!$res)
	{
		return "Selected record was not found.";
	}
	foreach($res as $x)
		$x = stripslashes($x);
	
	

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
		
	$smarty->assign('telephone',$this->CheckEmpty($res->telephone));	
	$smarty->assign('message_voice_mail',$this->CheckEmpty($res->message_voice_mail));
	if ($res->pipe_stakes == 1)
		$smarty->assign('pipe_stakes','checked');
	else if ($res->pipe_stakes == 2)
		$smarty->assign('no_pipe_stakes','checked');
	else
		$smarty->assign('dk_pipe_stakes', 'checked');
	$smarty->assign('home_office',$this->CheckEmpty($res->home_office));
	$smarty->assign('office_numbers',$this->CheckEmpty($res->office_numbers));
	$smarty->assign('f4ft_tarps',$this->CheckChecked($res->f4ft_tarps));
	$smarty->assign('f6ft_tarps',$this->CheckChecked($res->f6ft_tarps));
	$smarty->assign('f8ft_tarps',$this->CheckChecked($res->f8ft_tarps));
	$smarty->assign('comments',str_replace("_x000A_","\n",$res->comments));
	$smarty->assign('preferences',$this->CheckEmpty($res->preferences));
	$smarty->assign('load_options',$this->CheckEmpty($res->load_options));
	$smarty->assign('driving_limitations',$this->CheckEmpty($res->driving_limitations));
	$smarty->assign('upload_comment',$this->CheckEmpty($res->upload_comment));

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
	UpdateDriverAccess($res->driver);	//Rread recent users	
	
	
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
  $id = $_SESSION['lastid'];
  foreach($dta as &$x)
    $x = quote_smart($x); 
  extract($dta);
  //Set the checkbox control values
	AdjustCheckBox($f4ft_tarps);
  AdjustCheckBox($f6ft_tarps);
  AdjustCheckBox($f8ft_tarps);
  if (!isset($load_levelers)) $load_levelers = 3;
  if (!isset($canada)) $canada = 3;
  if (!isset($twic)) $twic = 3;
  if (!isset($pipe_stakes)) $pipe_stakes = 3;
  if(!isset($load_status)) $load_status = 0;
  //Setup the update query
  $sql  = "update truck_loader set ";
  $sql .= "driver='$driver',unload_date='$unload_date',location='$location',home_town='$home_town',";
  $sql .= "preferences ='$preferences',truck_no='$truck_no',";
  $sql .= "telephone='$telephone',comments='$comments',home_office='$home_office',office_numbers='$office_numbers',";
  $sql .= "twic=$twic,f4ft_tarps='$f4ft_tarps',";
  $sql .= "f6ft_tarps='$f6ft_tarps',";
  $sql .= "f8ft_tarps='$f8ft_tarps',pipe_stakes=$pipe_stakes,driving_limitations='$driving_limitations',";
  $sql .= "load_levelers=$load_levelers,load_options='$load_options',";
  $sql .= "load_status = '$load_status', canada=$canada,";
  $sql .= "tlength='$tlength',ttype='$ttype',driver_alias='$driver_alias',upload_comment='$upload_comment',userid=$uid, ";
  $sql .= "email='$email' ";
  $sql .= "where id=$id";
  $db->query($sql);
 	$resp->alert("Record Updated.");
  return $resp;	
}
	

//Remove the current record
function DeleteRecord($dta)
{
	global $db;
	$resp = new xajaxResponse();
	$id = $_SESSION['lastid'];
	$sql = "delete from truck_loader where id = $id";
	if (!$db->query($sql))
	   $resp->alert('Failed to delete the record.');
	else
	   $resp->alert('Record Deleted');
	return $resp;
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
	$res = @$db->get_row($sql);
	//return print_r($res,true);
	if (!$res)
	{
		$resp->alert("Selected record was not found.");
		return $resp;
	}
	foreach($res as $x)
		$x = stripslashes($x);

	$resp->assign('driver','value',$res->driver);
	$resp->assign('driver_alias','value', $res->driver_alias);
	$resp->assign('unload_date','value',$res->unload_date);
	
	if ($res->canada == 1)
		$resp->assign('canada','checked', true);
	else if ($res->canada == 2)
  	$resp->assign('no_canada','checked', true);
  else
  	$resp->assign('dk_canada','checked', true);
	
	$resp->assign('location','value',$res->location);
	$resp->assign('truck_length','value',$this->GenerateTruckLength($res->tlength));
	$resp->assign('truck_type','value',$this->GenerateTruckType($res->ttype));
	
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

public function processEdit($op, $dta)
{
  $resp = new xajaxResponse();
  if ($op == 'update')
  	return $this->UpdateRecord($dta);
  else if ($op == 'delete')
  	return $this->DeleteRecord($dta);
  else if ($op == 'listdrivers')
    return $this->DriverList();
  else
  {
  	$resp->alert("Invalid edit operation code: $op");
    return $resp;
  }
}

//This just redirects to the new load create page.
function CreateNew()
{
  $resp = new xajaxResponse();
  $resp->redirect("new_load.php");
  return $resp;
}
}
?>
