<?php
/*
  Show loads being unloaded for today and previous 6 days.
  4/27/10 - add rating to the query sort.
  5/11/10 - Add agent list to admin user display.
*/
require_once("commons.php");
require_once("utility.php");
$smarty->assign("pgtitle", "Todays Loads");
$smarty->assign("unload_date",Date('Y-m-d'));//Initial date is today 
$smarty->assign("domenu", 1);
$smarty->assign("agentlist",AgentSelectGenerate());
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
  define("DOALL",2); //value driver_status from screen to do active and inactive.
  global $db;
  $usr = ReadUserRec($_SESSION['userid']);
  $level = $usr->level;
  $uname = $usr->user;
  extract($dta);
  function GetUser($uid)
  {
  	global $db;
  	if ($uid == '') return '';
  	$sql = "select * from users where id=$uid";
  	$rw = $db->get_row($sql);
  	if (!$rw)
  		return '';
  	else
  	return $rw->user;
  }
  
  $_SESSION['searchlist'] = "truck_loader";
  $resp = new xajaxResponse();
  $days = array();//Array of mmm dd dates
  $unload_date = $dta['unload_date'];//date('yyyy-mm-dd') from the browser
  $driver_status = $dta['driver_status']; //status selection from the browser.
  //Construct a list of the last week's short dates
  $date = new DateTime($unload_date);
  $days[0] = $date->format('M d');
  for($i=1;$i<=6;$i++)
  {
  	$date->modify('-1 day');
		$days[$i] = $date->format('M d');
	}
	$uld = '';
	for($i=0;$i<=6;$i++)
	{
		if ($uld == '')
			$uld = "unload_date = '$days[$i]' ";
		else
			$uld .= "or unload_date = '$days[$i]' ";
	}
  $uld = '('.$uld.')';
  
  
  //4/30/2010 - Query for rated drivers first.
  $sql = "select * from truck_loader where $uld  ";
  $sql .= " and rating <> ''";
  if ($driver_status != DOALL)
    $sql .= " and driver_status = $driver_status";
  if ($level == 'admin' && $agents != '')
    $sql .= " and userid = $agents ";
  $sql .= " order by rating desc, unload_month desc, unload_day desc";
//  $resp->alert("Rated Query: $sql");
  $rated = $db->get_results($sql);
  //Now unrated drivers
  $sql = "select * from truck_loader where $uld  ";
  if ($driver_status != DOALL)
   $sql .= " and driver_status = $driver_status";
  if ($level == 'admin' && $agents != '')
    $sql .= " and userid = $agents ";
  $sql .= " order by unload_month desc, unload_day desc";
  $not_rated = $db->get_results($sql);  
  //Remove any rated drivers from the unrated query
  //The query fails if rating is left in it ...
  if (is_array($not_rated))
  {
    $no_ratings = array();
    foreach ($not_rated as $nr)
      if ($nr->rating == '')
        array_push($no_ratings, $nr);
    if (is_array($no_ratings))
      $not_rated = $no_ratings;
    unset($no_ratings);
  }
  //Combine the two result sets  
	if (is_array($rated) && is_array($not_rated))
  	$res = array_merge($rated,$not_rated);  
	else if(is_array($rated))
		$res = $rated;
	else
		$res = $not_rated;
  
  if (!is_array($res))
  {
    $resp->alert("No qualifying drivers were located.");
    return $resp;
  }

  $s  = "<table border='1' style='color:black;'>\n";
  if ($driver_status == 2)
    $caption = "Active and Inactive Drivers";
  else if ($driver_status == 1)
    $caption = "Active Drivers";
  else
    $caption .= "Inactive Drivers";
  $s .= "<caption><b>$caption</b></caption>";
  $s .= "<tr><th>Driver</th><th>Truck#</th><th>Location</th><th>UnloadDate</th><th>Equipment</th>
        <th>Phone</th><th>User</th><th>Driver Status<th>Rating</tr>\n";
  foreach($res as $rw)
  {
    $id = $rw->id;
    $uid = $rw->userid;
    $user = ReadUser($uid);
    if ($user != '')
      if ($level != 'admin' && $user != $uname) continue; //1/22/10 - list view control
    //Check for match on the user's driver status selection
// 5/5/10 - filtered in the query.
    $dstat = $rw->driver_status;
//    if ($driver_status != 2 && $dstat != $driver_status) continue;
    $driver = $rw->driver;
    $location = $rw->location;
    $unload_date = $rw->unload_date;
    $equipment = $rw->equipment;
    $truck_no = $rw->truck_no;
    $phone = $rw->telephone;
    $userid = GetUser($rw->userid);
    $rating = $rw->rating;
    if ($dstat == 1)
      $dstat = 'Active';
    else if ($dstat == 0)
      $dstat = 'Inactive';
    $s .= "<tr><td><a href=\"#\" onclick=\"xajax_CallEditor($id)\">$driver</a></td>";
    $s .= "<td>$truck_no</td><td>$location</td><td>$unload_date</td>";
    $s .= "<td nowrap>$equipment</td><td nowrap>$phone</td><td>$userid</td><td>$dstat</td><td>$rating</td></tr>";
  }
  $s .= "</table>";
  $display = $s;
  $s = "<br/><center><input type='button' value='Close' onclick='fb.end();' /><br/><br/>";
	$s .= $display;
	$s .= "<br/><center><input type='button' value='Close' onclick='fb.end();' /><br/></center";
	//$resp->alert(print_r($uld,true));
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
$xajax->register(XAJAX_FUNCTION,"PageSetup");
$xajax->register(XAJAX_FUNCTION,"CallEditor");
$xajax->processRequest();
GenerateSmartyPage();
?>