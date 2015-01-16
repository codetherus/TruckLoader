<?php
/*
  Search page for Jakes Loads
  Version 2 using the drivers and loads pages.
*/
require_once("commons.php");
require_once("utilityV2.php");
$smarty->assign("pgtitle", "Driver Search"); 
$smarty->assign("domenu", 1);
$smarty->assign('dosearch',1);
/*
  5/11/2010
  
*/
function PageSetup()
{
  global $db;
  $resp = new xajaxResponse();
  $usr = ReadUserRec();
  if ($usr->list_level == 'admin')
    $resp->assign("agentdiv", "style.display", "inline");
  return $resp;
}

//Generate a select of the agents/users.
//duped from the utility page
function SearchAgentSelectGenerate($aid=1000){
  global $db;
  $sql = "select id, user from users order by user";
  $res = $db->get_results($sql);
  $s = "<select id='agents' name='agents'>\n";
  $s .= "<option value=''></option>\n";
  foreach($res as $rw)
  {
    //1/292014 - do not select a user
    //if ($rw->id == $aid)
    //  $s .= "<option value='$rw->id' selected>$rw->user</option>\n";
    //else
      $s .= "<option value='$rw->id'>$rw->user</option>\n";
  }
  $s .= "</select>\n";
  return $s;
}


/*
  FindLoads uses the user's search criteria
  to find loads that match.
  The results display in a floatbox window.
  The user selects one and the display procedure is
  called.
  5/11/2010 - Adding the agent to the admin search
  parameters.
*/
function FindLoads($dta)
{
	global $db;
  extract($dta);
  $resp = new xajaxResponse();
  if ($searchvalue == '')
  {
    $sql = "select d.*, l.delivery_date from drivers as d, loads as l where d.loadid = l.id order by l.delivery_date";
    $s = BuildDriverList("CallEditor",$driver_status,$search_order,$agents,$sql);
  	$resp->assign("floatboxcontent","innerHTML", $s);
  	$resp->script("fb.loadAnchor('#floatboxcontent')");
  	return $resp;
  }
  return $resp; //Go no further - there be dragons there...

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
  	

  $userid = $_SESSION['userid'];
  //Save the elements for the display procedure.
  $_SESSION['searchvalue'] = $searchvalue;

 	$tbl = "drivers";
  //Query for any matches.
  if ($searchvalue == '')
    $sql = "select * from $tbl order by name";
  else
  {
    $sql = "select * from $tbl where ($searchkey like '$searchvalue%')";
    //$sql .= " and ((userid = $userid) or (userid = 0))";
  }
  $res = $db->get_results($sql);
  if (!$res)
  {
    $resp->alert("No matching records were located.");
    return $resp;
  }
  //Construct the candidate display.
  $s  = "<table border='1' style='color: black'>\n";
  $s .= "<tr><th>Driver</th><th>Truck#</th><th>Location</th><th>UnloadDate</th><th>Length</th><th>Type</th><th>User</tr>\n";
  foreach($res as $rw)
  {
    $id = $rw->id;
    $uid = $rw->userid;
    $user = GetUser($uid);
    $driver = $rw->driver;
    $location = $rw->location;
    $unload_date = $rw->unload_date;
    $equipment = $rw->equipment;
    $truck_no = $rw->truck_no;
    $truck_length = $rw->tlength;
    $truck_type = $rw->ttype;
    if ($driver == '') continue;
    $s .= "<tr><td align='left'><a href=\"#\" onclick=\"xajax_CallEditor($id)\">$driver</a></td>";
    $s .= "<td>$truck_no</td><td>$location</td><td>$unload_date</td>";
    $s .= "<td>$truck_length</td><td>$truck_type</td><td>$user</td></tr>\n";
  }
  $s .= "</table>";
  $display = $s;
  $s = "<br/><center><input type='button' value='Close' onclick='fb.end();' /><br/><br/>";
	//$s .= '<div style="margin-left: 100px; text-align:left">';
	$s .= $display;
	//$s .= "</div>";
	$s .= "<br/><center><input type='button' value='Close' onclick='fb.end();' /><br/></center";
	//Setup to display the floatbox window.
	$resp->assign("floatboxcontent","innerHTML", $s);
	$resp->script("fb.loadAnchor('#floatboxcontent')");
	return $resp;
}

/*
  Setup the session swap id value and redirect
  to the drivers page.
*/
function CallEditor($dta)
{
  $resp = new xajaxResponse();
  $_SESSION['swapid'] = $dta; //Setup so the driver page knows about the swap;  
  $resp->redirect("drivers.php");  
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
  $s .= '<option value="" selected></option>';
 // $s .= '<option value="driver">Driver</option>';
 // $s .= '<option value="equipment">Equipment</option>';
  //$s .= '<option value="agent">Agent</option>';
  //$s .= '<option value="unit">Unit</option>';
 // $s .= '<option value="truck_no">Truck Number</option>';
  $s .= '<option value="origin_city">City of Origin</option>';
  $s .= '<option value="origin_state">State of Origin</option>';
 // $s .= '<option value="origin">Origin (City,State)</option>';
  $s .= '<option value="destination_city">Destination City</option>';
  $s .= '<option value="destination_state">Destination State</option>';
  $s .= '<option value="location">Destination (City, State)</option>';
  $s .= '<option value="unload_date">Delivery Date (mm/dd)</option>';
  //$s .= '<option value="cell">Cell Number</option>';
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
  $s .= '<option value="unload_date" selected>Unload Date</option>';
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
  $searchlist = 'inprocess';
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
$smarty->assign("searchelements",GenerateSearchElementList());
$smarty->assign("searchlist", GenerateListSelect());
$smarty->assign("agentlist",SearchAgentSelectGenerate($_SESSION['userid']));

//$xajax->configure('debug',true);
$xajax->register(XAJAX_FUNCTION, "GetSearchList");
$xajax->register(XAJAX_FUNCTION,"FindLoads");
$xajax->register(XAJAX_FUNCTION,"DisplayLoad");
$xajax->register(XAJAX_FUNCTION,"CallEditor");
$xajax->register(XAJAX_FUNCTION,"CreateNew");
$xajax->register(XAJAX_FUNCTION,"PageSetup");
$xajax->processRequest();
GenerateSmartyPage();


?>