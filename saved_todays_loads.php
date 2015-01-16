<?php
/*
  Show loads being unloaded today
  or on a selected day.
*/
require_once("commons.php");
require_once("utility.php");
$smarty->assign("pgtitle", "Todays Loads");
$smarty->assign("unload_date",Date('Y-m-d'));//Initial date is today 
$smarty->assign("domenu", 1);
/*
  FindLoads uses the user's search criteria
  to find loads that match.
  The results display in a floatbox window.
  The user selects one and the display procedure is
  called.
  
  12/2/09 - Alter to display today and the lasat week.
*/
function FindLoads($dta)
{
  global $db;
  $usr = ReadUserRec($_SESSION['userid']);
  $level = $usr->list_level;
  $uname = $usr->user;
  
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
  
  $_SESSION['searchlist'] = "truck_loader";
  $resp = new xajaxResponse();
  extract($dta);
  $days = array();//Array of mmm dd dates
  $unload_date = $dta['unload_date'];;//date('yyyy-mm-dd') from the browser
  $date = new DateTime($unload_date);
  $days[0] = $date->format('M d');
  for($i=1;$i<=6;$i++)
  {
  	$date->modify('-1 day');
		$days[$i] = $date->format('M d');
	}
	$sql = "select * from truck_loader where ";
	$uld = '';
	for($i=0;$i<=6;$i++)
	{
		if ($uld == '')
			$uld = "unload_date = '$days[$i]' ";
		else
			$uld .= "or unload_date = '$days[$i]' ";
	} 
  
  $sql = "select * from truck_loader where $uld order by unload_date";//and (userid=$userid or userid = 0) order by unload_date";
  $res = $db->get_results($sql);
  if (!$res)
  {
    $resp->alert("No matching records were located.");
    return $resp;
  }
  $s  = "<table border='1' style='color:black;'>\n";
  $s .= "<tr><th>Driver</th><th>Truck#</th><th>Location</th><th>UnloadDate</th><th>Equipment</th><th>Phone</th><th>User</th></tr>\n";
  foreach($res as $rw)
  {
    $id = $rw->id;
    $uid = $rw->userid;
    $user = ReadUser($uid);
    if (($level != 'admin' && $user != $uname)&& $user != '') continue; //1/22/10 - list view control
    
    $driver = $rw->driver;
    $location = $rw->location;
    $unload_date = $rw->unload_date;
    $equipment = $rw->equipment;
    $truck_no = $rw->truck_no;
    $phone = $rw->telephone;
    $userid = GetUser($rw->userid);
    $s .= "<tr><td><a href=\"#\" onclick=\"xajax_CallEditor($id)\">$driver</a></td>";
    $s .= "<td>$truck_no</td><td>$location</td><td>$unload_date</td>";
    $s .= "<td nowrap>$equipment</td><td nowrap>$phone</td><td>$userid</td></tr>";
  }
  $s .= "</table>";
  $display = $s;
  $s = "<br/><center><input type='button' value='Close' onclick='fb.end();' /><br/><br/>";
	//$s .= '<div style="margin-left: 100px; text-align:left">';
	$s .= $display;
	//$s .= "</div>";
	$s .= "<br/><center><input type='button' value='Close' onclick='fb.end();' /><br/></center";
	//Setup to dosplay the floatbox window.
	$resp->assign("floatboxcontent","innerHTML", $s);
	$resp->script("fb.loadAnchor('#floatboxcontent')");
	return $resp;
}

//Redirect the user to the editor page.
function CallEditor($dta)
{
  $resp = new xajaxResponse();
  $_SESSION['lastid'] = $dta; //Save the id for edit page.
  $resp->redirect("Edit.php");
  return $resp;
}  

//Given the selected id value, display the record.
function DisplayLoad($dta)
{
  global $db;
	$resp = new xajaxResponse();
	$_SESSION['lastid'] = $dta; //Save for edit page
	$searchlist = $_SESSION['searchlist'];	//The target table.
	$sql = "select * from $searchlist where id = $dta";
	$res = $db->get_row($sql);
	if (!$res)
	{
		$resp->alert("Selected record was not found.");
		return $resp;
	}
	$s = "";
	if ($searchlist == "truck_loader")
	{
		$s .= "<b>Driver:</b> $res->driver<br/>";
		$s .= "<b>Unload Date:</b> $res->unload_date<br/>";
		$s .= "<b>Location:</b> $res->location<br/>";
		$s .= "<b>Equipment:</b> $res->equipment<br/>";
		$s .= "<b>Home Town:</b> $res->home_town<br/>";
		$s .= "<b>Preferences:</b> $res->preferences<br/>";
		$s .= "<b>Truck Number:</b> $res->truck_no<br/>";
		$s .= "<b>Telephone:</b> $res->telephone<br/>";
		$s .= "<b>Comments:</b> $res->comments<br/>";
		$s .= "<b>Home Office:</b> $res->home_office<br/>";
		$s .= "<b>Office Numbers:</b> $res->office_numbers<br/>";
		//$s .= "<b>Message / Vopicemail:</b> $res->message_voice_mail<br/>";
		$s .= "<b>Canada:</b> $res->canada<br/>";
		$s .= "<b>No Canada:</b> $res->no_canada<br/>";
		$s .= "<b>TWIC:</b> $res->twic<br/>";
		$s .= "<b>No TWIC:</b> $res->no_twic<br/>";
		$s .= "<b>4 foot Tarps:</b> $res->f4ft_tarps<br/>";
		$s .= "<b>6 foot Tarps:</b> $res->f6ft_tarps<br/>";
		$s .= "<b>8 foot Tarps:</b> $res->f8ft_tarps<br/>";
		$s .= "<b>No Tarps:</b> $res->no_tarps<br/>";
		$s .= "<b>Pipe Stakes:</b> $res->pipe_stakes<br/>";
		$s .= "<b>No Pipe Stakes:</b> $res->no_pipe_stakes<br/>";
		$s .= "<b>Load Levelers:</b> $res->load_levelers<br/>";
		$s .= "<b>No Load Levelers:</b> $res->no_load_levelers<br/>";
	}
	else
	{
	 //TO DO Code the inbound fields.
	}
	
	
	

	$display = $s;
  $s = "<br/><center><input type='button' value='Close' onclick='fb.end();' /><br/><br/></center";
	$s .= '<div style="margin-left: 350px; text-align:left">';
	$s .= $display;
	$s .= "</div>";
	$s .= "<br/><center><input type='button' value='Close' onclick='fb.end();' /><br/></center";
	//Setup to dosplay the floatbox window.
	$resp->assign("floatboxcontent","innerHTML", $s);
	$resp->script("fb.loadAnchor('#floatboxcontent')");
	return $resp;
}
//Search keys for the inbound table
function GenerateSearchElementList()
{
  $s  = '';
  $s  = '<select id="searchkey" name="searchkey">';
  $s .= '<option value="driver" selected>Driver</option>';
  $s .= '<option value="equipment">Equipment</option>';
  $s .= '<option value="agent">Agent</option>';
  $s .= '<option value="unit">Unit</option>';
  $s .= '<option value="truck_number">Truck Number</option>';
  $s .= '<option value="origin_city">City of Origin</option>';
  $s .= '<option value="origin_state">State of Origin</option>';
  $s .= '<option value="origin">Origin (City,State)</option>';
  $s .= '<option value="dest_city">Destination City</option>';
  $s .= '<option value="dest_state">Destination State</option>';
  $s .= '<option value="destination">Destination (City, State)</option>';
  $s .= '<option value="delivery_date">Delivery Date (mm/dd)</option>';
  $s .= '<option value="cell">Cell Number</option>';
  $s .= '</select>';
  return $s;
}
//Searc keys for the truck loader table
function GenerateTruckLoaderSearchList()
{
  $s  = '';
  $s  = '<select id="searchkey" name="searchkey">';
  $s .= '<option value="driver" selected>Driver</option>';
  $s .= '<option value="equipment">Equipment</option>';
  $s .= '<option value="unload_date">Unload Date</option>';
  $s .= '<option value="location">Location</option>';
  $s .= '<option value="home_town">Home Town</option>';
  $s .= '</select>';
  return $s;
}  
//Which ltable to search
function GenerateListSelect()
{
  $s  = '<select id="searchlist" name="searchlist" onchange="xajax_GetSearchList(xajax.getFormValues(\'form1\'))">';
  $s .= '<option value="truck_loader">Truck Loader</option>';
  $s .= '<option value="truck_inbound">Inbound</option>';
  $s .= '</select>';
  return $s;
}

//Gen the search list per the searchlist value
function GetSearchList($dta)
{
  $resp = new xajaxResponse();
  extract($dta);
  if ($searchlist == 'inprocess')
    $s = GenerateTruckLoaderSearchList();
  else
    $s = GenerateSearchElementList();
  $resp->assign("selements", "innerHTML", $s);
  return $resp;
}
//This just redirects to the new load create page.
function CreateNew()
{
  $resp = new xajaxResponse();
  $resp->redirect("new_load.php");
  return $resp;
}
//$xajax->configure('debug',true);
$xajax->register(XAJAX_FUNCTION,"FindLoads");
$xajax->register(XAJAX_FUNCTION,"CallEditor");
$xajax->processRequest();
GenerateSmartyPage();


?>