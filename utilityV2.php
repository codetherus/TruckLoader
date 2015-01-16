<?php
/*
	Truck loader utility functions - Version 2 for the 
  fancy new site...
	Commons between the editor and the new 
	record pages.
  Anything used in more than one place should
  be placed in this file...

  7/10: Version 2 for the new site flavor.

*/
$alert_caption = ''; //Global for xajaxAlert() function


//Make the truck type dropdown
//selecting the passed type.
function GenerateTruckType($ttype=''){
  global $db;
  $sql = "select opt_value from options where opt_name = 'ttype' order by opt_value";
  $res = $db->get_results($sql);
  $s = "<select style='width:100px' id='ttype' name='ttype' tabindex='10'>\n";
  $s .= "<option value=''></option>\n";
  foreach($res as $rw)
  {
    $s .= "<option value='$rw->opt_value' ";
    if (strtoupper($rw->opt_value) == strtoupper($ttype))
      $s .= " selected";
    $s .= ">$rw->opt_value</option>\n";
  }
  $s .= "</select>\n";
  return $s;
}

//Generate the truck length dropdown 
//selecting the one matching the passed value.
function GenerateTruckLength($tlen=''){
  global $db;
  $sql = "select opt_value from options where opt_name = 'tlength' order by opt_value";
  $res = $db->get_results($sql);
  $s = "<select id='tlength' name='tlength' tabindex='9'>\n";
  $s .= "<option value=''></option>\n";
  foreach($res as $rw)
  {
    $s .= "<option value='$rw->opt_value' ";
    $optlen = $rw->opt_value;
    if ($optlen == $tlen)
      $s .= "selected";
    $s .= ">$rw->opt_value</option>\n";
  }
  $s .= "</select>\n";
  return $s;
}
//Read the last referenced load record.
//No longer used.
function readLastLoad(){
  return;
	global $db;
	$id = $_SESSION['lastid'];
	$sql = "select * from truck_loader where id = $id";
	return $db->get_row($sql);
}	
//Read truck_loader by primary key
//No longer used.
function readLoad($id){
  return;
	global $db;
	$sql = "select * from truck_loader where id = $id";
	return $db->get_row($sql);
}
//------------- Driver and load Read Functions --------------
//Load table fetch	
function GetLoad($id){
	global $db;
	$sql = "select * from loads where id = $id";
	return $db->get_row($sql);
}
//Load table fetch by the load number value
function GetLoadByNumber($load_number){
	global $db;
	$sql = "select * from loads where load_number = $load_number";
	return $db->get_row($sql);
}

//Driver table fetch
function GetDriver($id){
	global $db;
	$sql = "select * from drivers where id = $id";
	return $db->get_row($sql);
}
//Driver by name returns the first driver with the name passed.
function GetDriverByName($driver_name){
	global $db;
  $target = trim($driver_name);
	$sql = "select * from drivers where name = '$target'";
  return $db->get_row($sql,ARRAY_A);  
  //return $db->get_row($sql);
}
//Driver by name returns the first driver with the name passed.
//Returns an object instead of an assoc array.
//Makes for -> notation
function GetDriverByNameOBJ($driver_name){
	global $db;
  $target = trim($driver_name);
	$sql = "select * from drivers where name = '$target'";
  return $db->get_row($sql);  
  //return $db->get_row($sql);
}
//-------------------- End of Driver and Load Functions -----------------
//General row fetch
//$table = table name
//$id = row id value
function GetRow($table, $id)
{
  global $db;
  $sql = "select * from $table where id = $id";
  return $db->get_row($sql);
}
//Load history table read by primary key
function readHistory($id){
	global $db;
	$sql = "select * from load_history where id = $id";
	return $db->get_row($sql);
}
//Load history read by corporate id FK
function readHistoryByCorpId($cid){
	global $db;
	$sql = "select * from load_history where corp_id = $cid";
	return $db->get_row($sql);
}

//Read the current/latesd load assigned to a driver.
//Param is the driver record id.
//Returns the load with the highest primary key value.
function GetLatestLoad($driverid)
{
  global $db;
  $sql = "select max(id) from loads where driverid = $driverid";
  $maxid = $db->get_var($sql);
  if (!$maxid) return false; //No  loads?
  $sql = "$slect * from loads where id = $maxid";
  return $db->get_row($sql);
}
//-------------------- Sanitize Routines --------------------
//Handle SQL injection attacks.
function quote_smart(&$value){
    include("dbsettings.php");    
    $con=mysql_connect($dbhost,$dbuser,$dbpassword);
    if (get_magic_quotes_gpc()) {
        $value = stripslashes($value);
    }

    // Quote if not a number or a numeric string
    if (!is_numeric($value)) {
        $value =  mysql_real_escape_string($value);
    }

    return $value;
}
//Handle SQL injection on an array of values
function quote_smart_array(&$dta){
  include("dbsettings.php");    
  $con=mysql_connect($dbhost,$dbuser,$dbpassword);
  foreach($dta as $value)
  {
    if (get_magic_quotes_gpc()) {
        $value = stripslashes($value);
    }

    // Quote if not a number or a numeric string
    if (!is_numeric($value)) {
        $value =  mysql_real_escape_string($value);
    }
  
  }
}  
// -------------------- End Sanitize Routines ---------------------
//Maintain the user history table
function UpdateDriverAccess($driver){
	global $db;
	if (!isset($_SESSION['userid'])) return; //in case there is no logged user.
	$userid = $_SESSION['userid'];
	$sql = "select user from users where id=$userid";
	$uid = $db->get_row($sql);
	$userid = $uid->user;
	$sql = "select * from user_history where driver = '$driver'";
	$rw = $db->get_row($sql);
	if ($rw)
	{
		$hid = $rw->id;
		$u1 = $rw->user1;
		$u2 = $rw->user2;
		$sql = "update user_history set user1='$userid', user2 = '$u1', user3='$u2' where id = $hid";
		$db->query($sql);
	}
	else
	{
		$sql = "insert into user_history (driver, user1) values('$driver', '$userid')";
		$db->query($sql);
	}
}
// ------------------ User Access Routines --------------------
//Get a user name
function ReadUser($uid){
 	global $db;
  	if ($uid == '') return '';
    $sql = "select * from users where id=$uid";
  	$rw = $db->get_row($sql);
  	if (!$rw)
  		return '';
  	else
  	return $rw->user;
}
//Read a user record by primary key.
//If no param passed, use the session 
//user id.
function ReadUserRec($uid=''){
 	global $db;
  if ($uid == '')
    $uid = $_SESSION['userid'];
	$sql = "select * from users where id=$uid";
	return $db->get_row($sql);
}
//--------------------- End User Routines -----------------
//Agent information for display 
function BuildAgentInfo($id)
{
  $s = GetPhones($id,'Agent');
/*
  $row = ReadUserRec($id);
  if (!$row) return 'Agent not located.';
  $phone = $row->phone;
  $fax = $row->fax;
  $email = $row->email;
  $s  = "Phone: $phone\n";
  $s .= "Fax: $fax\n";
  $s .= "Email: $email";
*/
  return $s;
}

//Alias for read user
function readAgent($agentid){
  return 	ReadUserRec($agentid);
}
//--------------------------Phone/contact handlers--------------------------------
//Read a phone table for an entity
//id value.
function GetPhones($id,$type='Driver'){
  global $db;
  $sql = "select * from phones where entityid = $id and entity_type='$type'";
  $res = $db->get_results($sql);
  if (!$res) return 'No Phones';
  $s = '';
  foreach($res as $row)
  {
    $s .= "$row->contact_type: $row->entity\n";
  }
  return $s;
}
//Read a single row from the phone table.
function ReadPhoneRec($id, $etype, $ctype)
{
  global $db;
  $sql = "select * from phones where contact_type='$ctype' and entityid = $id and entity_type = '$etype'";
  QueryLog($sql);
  return $db->get_row($sql);
}
function  GetPhoneValue($id,$etype,$ctype)
{
  $rw = ReadPhoneRec($id,$etype,$ctype);
  if (!$rw) return '';
  return $rw->entity;
}
function SetPhoneValue($id,$etype,$ctype,$vlu,$uname='')
{
  global $db;
  $rw = ReadPhoneRec($id,$etype,$ctype);  
  
  if ($rw)
  {
    $rid = $rw->id;
    $sql = "update phones set entity = '$vlu' where id = $rid";    
    QueryLog($sql);
    $db->query($sql);
  }
  else
  {
    $sql = "insert into phones(contact_type,entityid,entity,entity_type,entity_name)
            values('$ctype',$id,'$vlu','$etype','$uname')";
    $db->query($sql);
  }
} 
//-----------------------End phone handlers------------------------ 
/*
//Standardized driver list
//Param $callback is the xajax call i.e. "xajax_xxx"
//Param $driver_status is the load record status
//1 = active, 0 = inactive else all
//Param $sort_on - subsort field
//Param $qry - optional sql query from the caller to replace the usual.
//             Added for the driver page search option.
//This becomes the onclick event.
*/
function BuildDriverList($callback,$driver_status='Active',$sort_on='',$agent='',$qry=''){
  $usr = ReadUserRec($_SESSION['userid']);
  $level = $usr->level;
  $uname = $usr->user;
  $uid = $usr->id;
  //Filter if not admin.
  if ($agent != $uid && $level != 'admin')
    $agent = $uid;
  //Check for a specific office
  $office = $_SESSION['officeid'];
  global $db;
  if($qry != '')
    $sql = $qry;
  else
  {
    $where = '';
    $sql = "select * from drivers ";
    if ($office != '')
      $where = " where officeid = $office";
    if ($agent != '')
      if ($where == '')
        $where = " where agentid = $agent ";
      else
        $where .= " and agentid = $agent";
    if ($where != '')
      $sql .= $where;

    if ($sort_on != '')
      $sql .= " order by $sort_on, name";
    else
      $sql .= " order by name";
  }
 // return "<span style='color:black;'>$sql</span>";
  $res = $db->get_results($sql);
  //$s .= $sql."<br/>";
  if ($db->num_rows < 1)
    $s = "<h3><span style='color: black'>No matching driver records were found.</span></h3>";
  else
  {
    $s .= "<table border='1' style='color: black'>\n";
    $s .= "<tr><th>Driver<th>Truck #</th><th>Status</th><th>Pickup<br/>Location<th>Delivery<br/>Location</th><th>UnloadDate</th><th>User</tr>\n";
    
    foreach($res as $rw)
    {
      $id = $rw->id;
      $uid = $rw->agentid;
      $user = ReadUser($uid);
      $loadid = $rw->loadid;
      $load = GetLoad($loadid);
      $dstatus = $rw->status;      
			$truck_no = $rw->truck_no;
      $origin = $load->pickup_location;
      //5/7/10 - turn off list view control
      //if (($level != 'admin' && $user != $uname)&& $user != '') continue; //1/22/10 - list view control
      if ($driver_status != '' && $dstatus != $driver_status) continue; //2/9/10 - Status select 
      $driver = $rw->name;
      $location = $load->delivery_location;
      $unload_date = $load->delivery_date;
      if ($driver == '') continue;
      $s .= "<tr><td align='left'><a href=\"#\" onclick=\"xajax_$callback($id)\">$driver</a></td>";
      $s .= "<td>$truck_no<td>$dstatus</td>";
      $s .= "<td>$origin</td>";
      $s .= "<td>$location</td><td>$unload_date</td>";
      $s .= "<td>$user</td></tr>\n";
    }
    $s .= "</table>";
  }
  $display = $s;
  $s = "<br/><center><input type='button' value='Close' onclick='fb.end();' /><br/><br/>";
	//$s .= '<div style="margin-left: 100px; text-align:left">';
	$s .= $display;
	//$s .= "</div>";
	$s .= "<br/><input type='button' value='Close' onclick='fb.end();' /><br/></center";
	return $s;
}
/*
  Working out how to compare dates when
  only the month and day are given.
  The only real issue is when the second
  date is < the first. Then it might be
  next year. Call it so iif January,
*/
function MonthDayCompare($md1, $md2){
$date  = new DateTime($md1);
$date2 = new DateTime($md2);
//Break out the month and day numbers
$m1 = $date->format("m");
$d1 = $date->format("d");
$m2 = $date2->format("m");
$d2 = $date2->format("d");
$res = 0;
//Do the compares...
//Same Months - compare the days
if ($m1 == $m2)
{
  //Compare the day numbers
  if ($d1 < $d2)
    $res = 2;
  else
    $res = 1;
}
//First month > second
//Call second > iif january and first > feb.
else if ($m1 > $m2)
{
  if($m1 > 2 && $m2 == 1)
    $res = 2;
  else
    $res = 1;
}
//First < second - always second >
else
{
  $res = 2;
}
return $res;
}
//Set the numeric unload month and day in the passed
//driver record.
//Used by edit and new driver pages.
function UpdateUnloadDateValues($id){
  global $db;
  $months="janfebmaraprmayjunjulaugsepoctnovdec";
  $sql = "select * from truck_loader where id = $id";
  $rw = $db->get_row($sql);
  if (!$rw) return;
  $unload_date = $rw->unload_date;
  if($unload_date == '0') return;
  $mon = strtolower(substr($unload_date,0,3));
  $da = substr($unload_date,4,2);
  if (substr($da,1,1) == ',')
    $da = '0'.substr($da,0,1); //Rid of commas...
  $monum = @strpos($months,$mon);
  if ($monum === false ) return;
  $monum = ($monum / 3) + 1;
  $sql = "update truck_loader set unload_day=$da, unload_month = $monum where id = $id";
  $db->query($sql);
}

//Called from a page to setup the xajaxAlert
//caption.
function SetAlertCaption($s){
  global $alert_caption;
  $alert_caption = $s;
}  

//Simple alert for xajax'ed functions.
function xajaxAlert($msg,$title=''){
  global $alert_caption;
  if ($alert_caption != '');
    $title = $alert_caption;
  $resp = new xajaxResponse();
  $resp->script("jAlert(\"$msg\",\"$title\")");
  return $resp;
}
//Generate a select of the agents/users.
function AgentSelectGenerate($aid=1000){
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

//Troubleshooting query logger
function QueryLog($s){
  $hdl = @fopen("querylog.txt", "a");
  if ($hdl)
  {
    $txt = date('r')."  $s\n\r";
    fwrite($hdl,$txt);
    fclose($hdl);
  }
}
// --------------------- Concurrent Update Control Procedures ----------------------------
/*
  Produce the md5 digest of a query result.
  Expects a get_row query on the ezsql database.
*/
function row_md5($sql){
  global $db;
  $res = $db->get_row($sql,ARRAY_A);
  if (!$res) return '';
  return md5(implode(",",$res));
}

//Create an MD5 hash of a row in a table
//given the table name and row id.
function RowHash($table, $id)
{
  global $db;
  $sql = "select * from $table where id = $id";
  $res = $db->get_row($sql,ARRAY_A);
  if (!$res) return '';
  return md5(implode(",",$res));
}  
//See if the row has changed based on
//the hash at read time and now.
function RowHasChanged($oldhash, $table, $id)
{
  $newhash = RowHash($table, $id);
  if ($oldhash == $newhash)
    return false;
  else
    return true;
} 
// --------------------- End Concurrent Update Control Procedures ----------------------------
/*
  6/7/2010
  The compare function is used to construct the "set"
  clause of the update querys. It compares the new and 
  old field values and adds changed fields to the set 
  string.
  
  The global $set is where the clause is built.
   
  Params:
    $fld    The field name
    $newval The value from the browser
    $oldval The value from the table 
    $num    Non zero iif the field is numeric. Controls quoting.
    
  Global $set contains the set of field=value strings
  to be used in the query.
  Placed in the utilitys 6/29/10.
*/
function compare($fld,$newval,$oldval,$num=0){
  global $set;
  if ($newval == quote_smart($oldval)) return;
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
  Standardize the floatbox displays
  param $display - data to be displayed by Floatbox.
  Output - xajax reponse set to fire a floatbox display.
  
  Caller creates the display data and passes it in
  the param. This wraps it in a pair of close buttons
  and returns an xajax response.
*/
function GenFloatbox($display)
{
  $resp = new xajaxResponse();
  $s = "<br/><center><input type='button' value='Close' onclick='fb.end();' /><br/><br/>";
	$s .= $display;
	$s .= "<br/><input type='button' value='Close' onclick='fb.end();' /><br/></center";
  $resp->assign("floatboxcontent","innerHTML", $s);
	$resp->script("fb.loadAnchor('#floatboxcontent')");
  return $resp;
}  
//Debugging aid to alert a 
//variable using print_r().
function ShowData($dta)
{ 
  $resp = new xajaxResponse();  
  $resp->alert(print_r($dta,true));  
  return $resp;  
}
//Check the value of a pased checkbox element.
//Needed to maintain the integer value in the db.
function CheckCheck($n)
{
  if ($n != '')
   return $n;
  else
   return 0;
}
//Setup the frequency dropdown for the reminders overlay
function ReminderFrequencyList($freq='')
{
  $freqs=array('Once','Half Hr','Hourly','Daily','Weekly','Monthly','Annually');
  $s = "<select id='frequency' name='frequency'>\n";
  for($i=0;$i<count($freqs);$i++)
  {
    $f = $freqs[$i];
    if ($f == $freq)
     $s .= "<option value='$f' selected>$f</option>\n";
    else
     $s .= "<option value='$f'>$f</option>\n"; 
  }
  $s .= "</select>\n";
  return $s;  
}
//Do the page assigns from the page_attributes table
//Not used...
function SetupCommonSmartyAssigns(){
  global $db,$smarty;
  $pi = pathinfo($_SERVER['PHP_SELF']);
  $fnm = $pi['filename'];
  $sql = "select * from page_attributes where page_name = '$fnm'";
  $res = $db->get_row($sql);
  if (!$res){
    $smarty->assign("pgtitle", "Page Attributes Not Defined for $fnm");    
    return;
  }
  $smarty->assign("pgtitle", $res->page_title); //Displayed page title.
  $smarty->assign("domenu", $res->menu);        //Menu control
  $smarty->assign("dosearch",$res->search);     //Global search tool control
}
?>