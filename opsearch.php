<?php
/*
  Search page for Jakes Loads - one page site version
*/
class opsearch{
  //Stantard function that does the initial page load.
  public function initialize()
  {
    global $smarty;
    $r = new xajaxResponse();
    $smarty->assign("domenu", 1);
    $smarty->assign("searchelements",$this->GenerateTruckLoaderSearchList());
    $smarty->assign("searchlist", $this->GenerateListSelect());
    $content = $smarty->fetch("opsearch.tpl");
    $r->assign("onepagecontent", "innerHTML", $content);
    $r->assign("header", "innerHTML","Driver Search");
    $r->includeScript("./scripts/opsearch.js");
    return $r;
  }
  //Searc keys for the truck loader table
  private function GenerateTruckLoaderSearchList()
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
  private function GenerateListSelect()
  {
    $s  = '<select id="searchlist" name="searchlist" onchange="xajax_GetSearchList(xajax.getFormValues(\'form1\'))">';
    $s .= '<option value="truck_loader">Truck Loader</option>';
    $s .= '<option value="truck_inbound">Inbound</option>';
    $s .= '</select>';
    return $s;
  }
  /*
    FindLoads uses the user's search criteria
    to find loads that match.
    The results display in a floatbox window.
    The user selects one and the display procedure is
    called.
  */
  public function FindLoads($dta)
  {
  	$resp = new xajaxResponse();
//  	$resp->alert(print_r($dta,true));
//  	return $resp;
    $s = BuildDriverList("opsearch","CallEditor");
  	$resp->assign("floatboxcontent","innerHTML", $s);
  	$resp->script("fb.loadAnchor('#floatboxcontent')");
  	return $resp;
  }  


  //Redirect the user to the editor page.
  public function CallEditor($dta)
  {
    $resp = new xajaxResponse();
    $_SESSION['lastid'] = $dta; //Save the id for edit page.
    $resp->script("fb.end()");
    $resp->script("xajax_callUser('opedit','initialize','opedit')");
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
}//class end
?>
