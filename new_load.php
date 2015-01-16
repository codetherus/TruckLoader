<?php
/*
  New Load entry page for Jakes Loads
  Actually it's a new driver...
  Originally copied from edit.php - may be a lot of deadwood...
  4/28/10 Add check for already existing driver record - suppress duplicates.
*/
require_once("commons.php");
require_once("utility.php");
$smarty->assign("pgtitle", "New Load Creation"); 
$smarty->assign("domenu", 1);
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
    return " checked>\n";
  else
    return ">\n";
}

function CheckEmpty($s)
{
	if ($s == '0')
		return '';
	else
	{
	  $tmp = $s;
	  $tmp = str_replace("_x000A_","\n",$tmp);
		return $tmp;	
	}
}

//4/28/10 - Check for already existing driver record.
//Based on truck number.
function DriverAlreadyExists($dta)
{
  global $db;
  $truck_no = $dta->truck_no;
  if ($truck_no == '') return false;
  $sql = "select * from truck_loader where truck_no='$truck_no";
  $res = $db->query($sql);
  if (!$res)
    return false;
  else
    return true;
}
//Create the new load record
function CreateRecord($dta)
{
	
	function AdjustCheckBox(&$cb)
	{
	 if ($cb == 'on')
	   $cb = '1';
	 else $cb = 0;
	}
		
  global $db;
  foreach($dta as &$x) $x = quote_smart($x);//SQL injection protection.

  $resp = new xajaxResponse();
//  $resp->alert(print_r($dta,true));
//  return $resp;
  extract($dta);
  if (DriverAlreadyExists($dta))
    return xajaxAlert('This driver is already defined.','New Driver Entry');
  $userid = $_SESSION['userid']; //For branding the record.
  //Fix the checkbox controls
  AdjustCheckBox($f4ft_tarps);
  AdjustCheckBox($f6ft_tarps);
  AdjustCheckBox($f8ft_tarps);
  
  //Setup the insert query
  $sql  = "insert into truck_loader(driver,unload_date,location,home_town,preferences,truck_no,";
  $sql .= "telephone,comments,home_office,office_numbers,canada,twic,f4ft_tarps,f6ft_tarps,";
  $sql .= "f8ft_tarps,pipe_stakes,driving_limitations,load_levelers,load_options,";
  $sql .= "tlength,ttype,userid,driver_status,email) ";
 
 
  $sql .= "values('$driver','$unload_date','$location','$home_town','$preferences','$truck_no',";
  $sql .= "'$telephone','$comments','$home_office','$office_numbers','$canada','$twic','$f4ft_tarps','$f6ft_tarps',";
  $sql .= "'$f8ft_tarps','$pipe_stakes','$driving_limitations','$load_levelers','$load_options', ";
  $sql .= "'$tlength', '$ttype',$userid, 1,'$email')";
//  $resp->alert(print_r($sql,true));
//  return $resp;
  LogQuery($userid."-".$sql); //Troubleshoot the queries
  @$db->query($sql);
  if ($db->rows_affected < 1)
  {
    $resp->alert("Database insert failed.");
  }
  else
  {
    $id = $db->insert_id;
    $_SESSION['lastid'] = $id; //4/28/10 
    LogQuery($userid.'- New Record Id='.$id);
    UpdateUnloadDateValues($id); //2/4/10 - maintain the numeric date fields.
    $resp->alert("The new load record has been saved.");
  }
  return $resp;	
}
function processEdit($op, $dta)
{
  $resp = new xajaxResponse();
  if ($op == 'update')
  	return CreateRecord($dta);
  else
  {
  	$resp->alert("Invalid edit operation code: $op");
    return $resp;
  }
}
function DisplayLoad()
{
  global $db, $smarty;
	$smarty->assign('truck_length',GenerateTruckLength(''));
	$smarty->assign('truck_type',GenerateTruckType(''));
}
$smarty->assign('editdata',DisplayLoad());
//$xajax->configure('debug',true);
$xajax->register(XAJAX_FUNCTION,'processEdit');
$xajax->processRequest();
GenerateSmartyPage();
?>
