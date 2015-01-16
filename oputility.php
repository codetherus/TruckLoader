<?php
/*
	Truck loader utility functions
	Commons between the editor and the new 
	record pages.
*/
//Make the truck type dropdown
//selecting the passed type.
function GenerateTruckType($ttype)
{
  global $db;
  $sql = "select opt_value from options where opt_name = 'ttype'";
  $res = $db->get_results($sql);
  $s = "<select style='width:75px' id='ttype' name='ttype'>\n";
  $s .= "<option value=''></option>\n";
  foreach($res as $rw)
  {
    $s .= "<option value='$rw->opt_value' ";
    if ($rw->opt_value == $ttype)
      $s .= "selected";
    $s .= ">$rw->opt_value</option>\n";
  }
  $s .= "</select>\n";
  return $s;
}

//Generate the truck length dropdown 
//selecting the one matching the passed value.
function GenerateTruckLength($tlen)
{
  global $db;
  $sql = "select opt_value from options where opt_name = 'tlength'";
  $res = $db->get_results($sql);
  $s = "<select id='tlength' name='tlength'>\n";
  $s .= "<option value=''></option>\n";
  foreach($res as $rw)
  {
    $s .= "<option value='$rw->opt_value' ";
    if ($rw->opt_value == $tlen)
      $s .= "selected";
    $s .= ">$rw->opt_value</option>\n";
  }
  $s .= "</select>\n";
  return $s;
}
//Read the last referenced load record.
function readLastLoad()
{
	global $db;
	$id = $_SESSION['lastid'];
	$sql = "select * from truck_loader where id = $id";
	return $db->get_row($sql);
}	
function readLoad($id)
{
	global $db;
	$sql = "select * from truck_loader where id = $id";
	return $db->get_row($sql);
}	

function readHistory($id)
{
	global $db;
	$sql = "select * from load_history where id = $id";
	return $db->get_row($sql);
}

function readHistoryByCorpId($cid)
{
	global $db;
	$sql = "select * from load_history where corp_id = $cid";
	return $db->get_row($sql);
}
//Handle SQL injection attacks.
function quote_smart(&$value)
{
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
function UpdateDriverAccess($driver)
{
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
function ReadUser($uid)
{
 	global $db;
  	$sql = "select * from users where id=$uid";
  	$rw = $db->get_row($sql);
  	if (!$rw)
  		return '';
  	else
  	return $rw->user;
}

function ReadUserRec($uid)
{
 	global $db;
  	$sql = "select * from users where id=$uid";
  	return $db->get_row($sql);
}

//Standardized driver list
//Param $callback is the xajax call i.e. "xajax_xxx"
//This becomes the onclick event.
function BuildDriverList($class,$callback)
{
  $usr = ReadUserRec($_SESSION['userid']);
  $level = $usr->list_level;
  $uname = $usr->user;
  
  global $db;
  $sql = "select * from truck_loader order by driver";
  $res = $db->get_results($sql);
  $s  = "<table border='1' style='color: black'>\n";
  $s .= "<tr><th>Driver</th><th>Location</th><th>UnloadDate</th><th>User</tr>\n";
  foreach($res as $rw)
  {
    $id = $rw->id;
    $uid = $rw->userid;
    $user = ReadUser($uid);
    if (($level != 'admin' && $user != $uname)&& $user != '') continue; //1/22/10 - list view control
    $driver = $rw->driver;
    $location = $rw->location;
    $unload_date = $rw->unload_date;
    if ($driver == '') continue;
    $cb = "xajax_callUser('$class','$callback','$class', '$id')";
    $s .= "<tr><td align='left'><a href=\"#\" onclick=\"$cb\">$driver</a></td>";
    $s .= "<td>$location</td><td>$unload_date</td>";
    $s .= "<td>$user</td></tr>\n";
  }
  $s .= "</table>";
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
function MonthDayCompare($md1, $md2)
{
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
function UpdateUnloadDateValues($id)
{
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

?>