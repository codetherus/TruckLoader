<?php
/*
  One shot to create the initial load and driver 
  records from the truck_loader table.
*/
require_once("commons.php");
require_once("utilityV2.php");
//New record id's so loads can populate driver id and 
//populate the load  
$newdriverid = '';
$newloadid = '';
//mmm dd date to yyyy/mm/dd date
function ConvertShortDate($dt)
{
  $oDate = new DateTime($dt);
  return $oDate->format('Y/m/d');
}

function EarlierDate($dt, $ndays)
{
  $oDate = new DateTime($dt);
  $ofs = "$ndays days";
  $oDate->modify($ofs);
  return $oDate->format('Y/m/d');
}

function TranslateRadio($n)
{
  if ($n == 1)
    return 'Yes';
  else if ($n == 2)
    return 'No';
  else
    return '';
}
function TranslateCheckbox($n)
{
  if ($n == 1)
    return 1;
  else
    return 0;
}
//Create the drivers table record from this loader record
function CreateDriver($dta)
{
  global $db,$newdriverid;
  foreach($dta as $x)
    $x = addslashes($x);
  extract($dta);
  $name = $driver;
  $twic = TranslateRadio($twic);
  $canada = TranslateRadio($canada);
  $pipe_stakes = TranslateRadio($pipe_stakes);
  $load_levelers = TranslateRadio($load_levelers);
  $phone_numbers = "Cell: $telephone";
  $f4ft_tarps = TranslateCheckBox($f4ft_tarps);
  $f6ft_tarps = TranslateCheckBox($f6ft_tarps);
  $f8ft_tarps = TranslateCheckBox($f8ft_tarps);
  $no_tarps = TranslateCheckBox($no_tarps);
  $comments = addslashes($comments);
  $sql  = "insert into drivers (name,tlength,ttype,home_town,preferences,truck_no,comments,canada,twic,";
  $sql .= "f4ft_tarps,f6ft_tarps,f8ft_tarps,no_tarps,pipe_stakes,load_levelers,load_options,driver_status,phone_numbers) ";
  
  $sql .= "values('$name','$tlength','$ttype','$home_town','$preferences','$truck_no','$comments','$canada','$twic',";
  $sql .= "$f4ft_tarps,$f6ft_tarps,$f8ft_tarps,$no_tarps,'$pipe_stakes','$load_levelers','$load_options',";
  $sql .= "$driver_status,'$phone_numbers')";
  echo "$sql<br/><br/>";
  $db->query($sql);
  if ($db->rows_affected > 0)
    $newdriverid = $db->insert_id; //Save for the new load
  else
    $newdriverid = '';
  echo "Driver ID: $newdriverid<br/><br/>";
}  
function CreateLoads()
{
  
  global $db, $newdriverid;
  $sql = "TRUNCATE TABLE loads";
  $db->query($sql);
  $lnum = 1;
  $sql = "select * from truck_loader";
  $oldstuff = $db->get_results($sql,ARRAY_A );
  foreach ($oldstuff as $row)
  {
    foreach($row as $x)
      $x = addslashes($x);
    extract($row);
    if ($driver == '') continue;
    if (substr($driver,0,1) == '(') continue;
    $load_number = date('Mdy').$lnum;
    $lnum++;
    $delivery_date = ConvertShortDate($unload_date);
    $pickup_date = EarlierDate($unload_date, '-3');
    $pickup_location = "$origin_city, $origin_state";
    if (trim($pickup_location) == ',')
      $pickup_location = 'Unknown';
    $delivery_location = $location;
    $driverid = $id;
    $agentid = $userid;
    if ($agentid == '')
      $agentid = 0;
    $booking_date = $pickup_date;
    $dispatched = 1;
    $sql = "insert into loads (driverid,agentid,booking_date,dispatched,
            pickup_date,delivery_date,pickup_location,delivery_location, load_number,driver_name)";
    $sql .= " values($driverid,$agentid,'$booking_date',$dispatched,
                     '$pickup_date','$delivery_date','$pickup_location','$delivery_location','$load_number','$driver')";
    echo "$sql<br/><br/>";
    $db->query($sql);
    if ($db->rows_affected > 0)
    {
      $lid = $db->insert_id;
      echo "Load ID: $lid<br/><br/>";
    }
    
  }
  
}  

CreateLoads();
?>