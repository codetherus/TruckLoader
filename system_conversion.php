<?php
/*
  This page is used to convert from the current truck_loader to
  the new drivers and loads stuff. It should be run
  immediately before turning the site over to the users.
  It puts drivers, loads and phones in synch with truck_loader.
*/
require_once("commons.php");
require_once("utilityV2.php");

$res = '';    //Global truck_loader table contents.
$drid=0;      //Insert id for the drivers
$ldid = 0;    //insert id for the loads.
$numdrivers = 0;
$loadseq = 1;  
//Grab all of the current info.
function ReadTruckLoader(){
  global $db,$res;
  $sql = "select * from truck_loader order by driver";
  $res = $db->get_results($sql);
} 
//Empty the target tables
function cleanTable($tbl){
  global $db;
  $sql = "truncate table $tbl";
  $db->query($sql);
}

function shortToLongDate($d)
{
  $dt = new DateTime  ($d);  
  return $dt->format('Y-m-d');  
}

//Make a new load record from the current load.
function MakeLoad($rw){
  global $db,$drid,$ldid,$loadseq;
  $row = $rw;
  foreach($row as $x)
    $x = quote_smart($x);
  $load_number = date('Mdy').$loadseq;  
  $loadseq++; 
  $delivery_date = shortToLongDate($row->unload_date);
  $pu_location = "$row->origin_city, $row->origin_state"; 
  if ($row->userid == '')
   $row->userid = 'null'; 
  $loadopt = str_replace('\'','ft',$row->load_options);
  $loadnote = str_replace('\'','ft',$row->load_notes);
  $sql = "insert into loads (load_number,driverid,agentid,delivery_date,
          pickup_location,delivery_location,load_notes,load_options,driver_name,officeid)          
          values('$load_number',$drid,$row->userid,'$delivery_date','$pu_location',          
          '$row->location','$loadnote','$loadopt','$row->driver',1)";
  echo $sql."<br><br>";
  QueryLog($sql);          
  $db->query($sql);
  //Set the load id in the driver table.  
  if ($db->rows_affected > 0)
  {
    $ldid = $db->insert_id;
    
    $sql = "update drivers set loadid=$ldid where id = $drid";    
    echo $sql."<br><br>";
    $db->query($sql);    
  }
}
//Make a new phone record from the current row
function MakePhone($row){
  global $db,$drid;  
  if ($row->telephone == '') return;
  $contact_type='Cell';  
  $entityid = $drid;  
  $entity = $row->telephone;  
  $entity_type = 'Driver';  
  $entity_name = $row->driver;  
  $sql = "insert into phones(contact_type,entityid,entity,entity_type,entity_name)  
         values('$contact_type',$entityid,'$entity','$entity_type','$entity_name')";
  QueryLog($sql);         
  $db->query($sql);  
}

function ConvertCanada($row)
{
  if ($row->canada == 1)
    return 'Yes';
  else if ($row->no_canada == 1)
    return 'No';
  else
    return '';
}

function convertTwic($row)
{
  if ($row->twic == 1)
    return 'Yes';
  else if ($row->no_twic == 1)
    return 'No';
  else
    return '';
} 

function convertPipeStakes($row)
{
  if ($row->pipe_stakes == 1)
    return 'Yes';
  else if ($row->no_pipe_stakes == 1)
    return 'No';
  else
    return '';
}

function convertLoadLevelers($row)
{
  if ($row->load_levelers == 1)
    return 'Yes';
  else if ($row->no_load_levelers == 1)
    return 'No';
  else
    return '';
}
function fixcb($cb)
{
  if ($cb == '')
    return 0;
  else 
    return $cb;
}
  
//Use the current row to makke a new driver record.
function MakeDriver($rw){
  global $db,$drid,$numdrivers;
  $row = $rw;
  if ($row->driver == '') return;
  if (substr($row->driver,0,1) == '(') return;
  foreach($row as $x)
  {
    $x = quote_smart($x);
    
  }
  //Convert all of the radio values and such.
  $row->comments = str_replace('\'','ft',$row->comments);
  $canada = convertCanada($row);
  $twic = convertTwic($row);
  $pipe_stakes = convertPipeStakes($row);
  $load_levelers = convertLoadLevelers($row);
  if ($row->driver_status == 1)
    $status = 'Active';
  else
    $status = 'Inactive';
  $f4 = fixcb($row->f4ft_tarps);  
  $f6 = fixcb($row->f6ft_tarps);  
  $f8 = fixcb($row->f8ft_tarps);  
  $no = fixcb($row->no_tarps);
  if ($row->userid == '')
    $row->userid = 'null';  
  $sql = "insert into drivers(agentid,name,tlength,ttype,home_town,preferences,truck_no,comments,home_office,
          office_numbers,message_voice_mail,canada,twic,f4ft_tarps,f6ft_tarps,f8ft_tarps,no_tarps,pipe_stakes,
          load_levelers,status,rating,officeid)
          values($row->userid,'$row->driver','$row->tlength','$row->ttype','$row->home_town','$row->preferences',
          '$row->truck_no','$row->comments','$row->home_office','$row->office_numbers','$row->message_voice_mail',
          '$canada','$twic',$f4,$f6,$f8,$no,'$pipe_stakes',
          '$load_levelers','$status','$row->rating',1)";          
  //echo $sql."<br/><br/>";
  QueryLog($sql);
  $db->query($sql);
  if ($db->rows_affected > 0)
  {
    $numdrivers++;     
    $drid = $db->insert_id;
    MakeLoad($row);
    MakePhone($row);
  }
  
}
  echo "Starting Conversion...<br/><br/>";
  //Empty the tables
  cleanTable('drivers');
  cleanTable('loads');
  cleanTable('phones');
  
  //Get all of the truck loader rows
  ReadTruckLoader();
  $numdrivers = 0;
  //Process
  foreach($res as $row){
    foreach($row as $x)
      Addslashes($x);
    MakeDriver($row);
  }  
  echo "Conversion complete. Convert $numdrivers records";
?>