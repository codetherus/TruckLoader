<?php
/*
  One shot to populate the phones table from truck_loader
*/
require_once("commons.php");
require_once("utilityV2.php");

function populate_phones(){
  global $db;
  $sql = "select driver,telephone,email from truck_loader";
  $res = $db->get_results($sql);
  foreach($res as $rw)
  {
    $driver = $rw->driver;
    $telephone = $rw->telephone;
    $email = $rw->email;
    if($telephone == '' && $email == '') continue;
    $driverrec = GetDriverByName($driver);
    if(!$driverrec) continue;
    $driverid = $driverrec['id'];
    if ($telephone != '')
    {
      $sql  = "insert into phones (contact_type,entityid,entity,entity_type,entity_name) ";
      $sql .= "values('Cell',$driverid,'$telephone','Driver','$driver')";
      echo $sql."<br/>";
      $db->query($sql);
    }
    if ($email != '')
    {
      $sql  = "insert into phones (contact_type,entityid,entity,entity_type,entity_name) ";
      $sql .= "values('Email',$driverid,'$email','Driver','$driver')";
      echo $sql."<br/>";
      $db->query($sql);
    }    
  }

}

populate_phones();    

?>