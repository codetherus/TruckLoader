<?php
/*
  12/7/10
  Load table maintenance class.
  Trying to do some centralization
*/

class load_maintenance{

  function load_maintenance(){} //Constructor
  
  //Driver page level load insert.
  function SetupNewLoadDriver($dta){
  //return ShowData($dta);
  global $db;
  $oid = $_SESSION['officeid'];
  $uid = $_SESSION['userid'];	
  $load_number = $dta['load_number'];
  $pickup_date = $dta['pickup_date'];
  $delivery_date = $dta['delivery_date'];
  $pickup_location = $dta['pickup_location'];
  $delivery_location = $dta['delivery_location'];
  $driverrec = $dta['current_driver_id'];
  $driver = GetDriver($driverrec);
  $driverid = $dta['current_driver_id'];
 
  $driver_name = $driver->name;
  //9/16/10 - Check for the 'dummy' load number.
  //If found then setup the dummy load.
  if ($load_number == 'NA'){
    $dummyLoad = true;
    $load_number = 'NA'.$driverid.date('njyGi');
  }
  else
    $dummyLoad = false;
  //Disallow duplicate load numbers
  $sql = "select * from loads where load_number = '$load_number'";
  $rw = $db->get_row($sql);
  if ($rw)
    return false;

  $sql = "insert into loads (load_number,driverid,pickup_date,
                             delivery_date,pickup_location,delivery_location, driver_name,officeid) ";
  $sql .= "values('$load_number',$driverid,'$pickup_date','$delivery_date',";
  $sql .= "'$pickup_location','$delivery_location','$driver_name',$oid)";
  QueryLog($uid."-".$driver_name."-".$sql);
  $db->query($sql);
  $_SESSION['swapid'] = $db->insert_id; //Force load display

  //Update the driver to reflect the new load iif not a dummy
  $loadid = $db->insert_id;
  if (!$dummyLoad)
  {
  $sql = "update drivers set loadid=$loadid where id = $driverid";
  QueryLog($uid."-".$driver_name."-".$sql);
  $db->query($sql);
  }
  else
  {
    $sql = "update loads set load_notes = 'Non Office Load' where id = $loadid";
    QueryLog($uid."-".$driver_name."-".$sql);
    $db->query($sql);
  }
  return true;  
}

/*
  UpdateLoadElements maintains the elements of
  the driver's current load record that we allow to
  be messed with on the driver page.
  Part of the driver page update process...
*/
function UpdateLoadElementsDriver($dta){
  //return ShowData($dta);
  global $db, $set;
  $uid = $_SESSION['userid'];	
  extract($dta);
  $loadid = $current_load_id;
  $load = GetLoad($loadid);
  $set = '';
  compare('load_number',       $load_number,       $load->load_number);
  compare('pickup_date',       $pickup_date,       $load->pickup_date);
  compare('delivery_date',     $delivery_date,     $load->delivery_date);
  compare('pickup_location',   $pickup_location,   $load->pickup_location);
  compare('delivery_location', $delivery_location, $load->delivery_location);
  if ($set == '') return 1;
  $sql = "update loads set $set where id = $loadid";
  QueryLog($uid."-".$driver."-".$sql);
  $db->query($sql);
  return 1;
}

//For the page display, fetch the load table elements
function GetLoadElementsDriver(&$resp, $loadid){
  $load = GetLoad($loadid);
  if (!$load) return;
  $resp->assign("load_number", "value", $load->load_number);
  $resp->assign("pickup_date", "value", $load->pickup_date);
  $resp->assign("delivery_date","value",$load->delivery_date);
  $resp->assign("pickup_location","value",$load->pickup_location);
  $resp->assign("delivery_location","value", $load->delivery_location);
  //Load change detection hidden values.
  $resp->assign("h_load_number", "value", $load->load_number);
  $resp->assign("h_pickup_date", "value", $load->pickup_date);
  $resp->assign("h_delivery_date","value",$load->delivery_date);
  $resp->assign("h_pickup_location","value",$load->pickup_location);
  $resp->assign("h_delivery_location","value", $load->delivery_location);
  $resp->assign("load_status","value","");
}  
function AddLoadDriver($dta, $driverid)
{
  global $db;
  extract ($dta);
  if  ($load_number == '') return true; //No nnumber, no load...
  $oid = $_SESSION['officeid'];
  $flds = '';
  $vals = '';
  //Add the page load fields to the query fields and strings  
  addField('pickup_date',$pickup_date,$flds,$vals);
  addField('delivery_date',$delivery_date,$flds,$vals);
  addField('pickup_location',$pickup_location,$flds,$vals);
  addField('delivery_location',$delivery_location,$flds,$vals);
  if ($flds == '')
  {
    $sql = "insert into loads ($flds) values ($vals)";
    QueryLog($sql);   
    return false;
  }
  //Add the fixed fields
  $flds .= ',driverid,load_number,officeid';
  $vals .= ",$driverid,'$load_number',$oid";
  $sql = "insert into loads ($flds) values ($vals)";
  QueryLog($sql);
  $db->query($sql);
  $lid = $db->insert_id;
  if (!$lid) return false;
  //Update the driver with the load id value.
  $sql = "update drivers set loadid = $lid where id = $driverid";
  $db->query($sql);
  return true;
}


};