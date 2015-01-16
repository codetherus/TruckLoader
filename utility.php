<?php
/*
	Truck loader utility functions
	Commons between the editor and the new 
	record pages.
*/
//Make the truck type dropdown
//selecting the passed type.
function GenerateTruckType($ttype){
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
function GenerateTruckLength($tlen){
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
function readLastLoad(){
	global $db;
	$id = $_SESSION['lastid'];
	$sql = "select * from truck_loader where id = $id";
	return $db->get_row($sql);
}	
function readLoad($id){
	global $db;
	$sql = "select * from truck_loader where id = $id";
	return $db->get_row($sql);
}	
function GetLoad($id){
	global $db;
	$sql = "select * from loads where id = $id";
	return $db->get_row($sql);
}
//Alias for readLoad.
function GetDriver($driverid){
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
}
//General row fetch
//$table = table name
//$id = row id value
function GetRow($table, $id)
{
  global $db;
  $sql = "select * from $table where id = $id";
  return $db->get_row($sql);
}

function readHistory($id){
	global $db;
	$sql = "select * from load_history where id = $id";
	return $db->get_row($sql);
}

function readHistoryByCorpId($cid){
	global $db;
	$sql = "select * from load_history where corp_id = $cid";
	return $db->get_row($sql);
}

//Read the current/latesd load assigned to a driver.
//Param is the driver record id.
function GetLatestLoad($driverid)
{
  global $db;
  $sql = "select max(id) from loads where driverid = $driverid";
  $maxid = $db->get_var($sql);
  if (!$maxid) return false; //No  loads?
  $sql = "$slect * from loads where id = $maxid";
  return $db->get_row($sql);
}

//Handle SQL injection attacks.
function quote_smart(&$value){
    global $db;
//    return $db->escape($value);// Stripslashes
    if (get_magic_quotes_gpc()) {
        $value = stripslashes($value);
    }

    // Quote if not a number or a numeric string
    if (!is_numeric($value)) {
        $value =  mysql_real_escape_string($value);
    }

    return $value;
}
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

function ReadUserRec($uid=''){
 	global $db;
  if ($uid == '')
    $uid = $_SESSION['userid'];
	$sql = "select * from users where id=$uid";
	return $db->get_row($sql);
}
//Alias for read user
function readAgent($agentid){
  return 	ReadUserRec($agentid);
}

function GetPhones($id)
{
  global $db;
  $sql = "select * from phones where entityid = $id";
  $res = $db->get_results($sql);
  if (!$res) return'';
  $s = '';
  foreach($res as $row)
  {
    $s .= "$row->contact_type: $row->contact_value\n";
  }
  return $s;
}
//Standardized driver list
//Param $callback is the xajax call i.e. "xajax_xxx"
//Param $driver_status is the load record status
//1 = active, 0 = inactive else all
//Param $sort_on - subsort field
//Param $qry - optional sql query from the caller to replace the usual.
//             Added for the driver page search option.
//This becomes the onclick event.
function BuildDriverList($callback,$driver_status=1,$sort_on='',$agent='',$qry=''){
  $usr = ReadUserRec($_SESSION['userid']);
  $level = $usr->level;
  $uname = $usr->user;
  //Check for a specific office
  if (isset($_SESSION['office']))
    $office = $_SESSION['office'];
  else
    $office = '';
  
  global $db;
  if($qry != '')
    $sql = $qry;
  else
  {
    $where = '';
    $sql = "select * from truck_loader ";
    if ($office != '')
      $where = " where office = '$office'";
    if ($agent != '' && $level == 'admin')
      if ($where == '')
        $where = " where userid = $agent ";
      else
        $where .= " and userid = '$agent";
    if ($where != '')
      $sql .= $where;

    if ($sort_on != '')
      $sql .= "order by $sort_on, driver";
    else
      $sql .= "order by driver";
  }
  $res = $db->get_results($sql);
  if ($db->num_rows < 1)
    $s = "<h3><span style='color: black'>No matching driver records were found.</span></h3>";
  else
  {
    $s  = "<table border='1' style='color: black'>\n";
    $s .= "<tr><th>Driver<th>Truck #</th><th>Status</th><th>Origin<th>Location</th><th>UnloadDate</th><th>User</tr>\n";
    foreach($res as $rw)
    {
      $id = $rw->id;
      $uid = $rw->userid;
      $user = ReadUser($uid);
      $dstatus = $rw->driver_status;      
			$truck_no = $rw->truck_no;
      $origin = $rw->origin_city.', '.$rw->origin_state;
      //5/7/10 - turn off list view control
      //if (($level != 'admin' && $user != $uname)&& $user != '') continue; //1/22/10 - list view control
      if ($driver_status != 2 && $dstatus != $driver_status) continue; //2/9/10 - Status select 
      $driver = $rw->driver;
      $location = $rw->location;
      $unload_date = $rw->unload_date;
      if ($dstatus == 1)
        $dstatus = 'Active';
      else if ($dstatus == 0)
        $dstatus = 'Inactive';
      if ($driver == '') continue;
      $s .= "<tr><td align='left'><a href=\"#\" onclick=\"xajax_$callback($id)\">$driver</a></td>";
      $s .= "<td>$truck_no<td>$dstatus</td>";
      if($rw->origin_city != '')
        $s .= "<td>$origin</td>";
      else
        $s .= "<td>&nbsp;</td>";
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
//Simple alert for xajax'ed functions.
function xajaxAlert($msg,$title=''){
  $resp = new xajaxResponse();
  $resp->script("jAlert(\"$msg\",\"$title\")");
  return $resp;
}
//Generate a select of the agents.
function AgentSelectGenerate(){
  global $db;
  $sql = "select id, user from users order by user";
  $res = $db->get_results($sql);
  $s = "<select id='agents' name='agents'>\n";
  $s .= "<option value=''></option>\n";
  foreach($res as $rw)
  {
    $s .= "<option value='$rw->id'>$rw->user</option>\n";
  }
  $s .= "</select>\n";
  return $s;
}

//Troubleshooting query logger
function QueryLog($s){
  $hdl = fopen("querylog.txt", "a");
  if ($hdl)
  {
    $txt = date('r')."  $s\n\r";
    fwrite($hdl,$txt);
    fclose($hdl);
  }
}
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
?>