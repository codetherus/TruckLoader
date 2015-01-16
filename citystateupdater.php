<?php
/*
  One shot to set the unload city and state fields
  in the truck loader table
*/
require_once("commons.php");
require_once("utility.php");
function UpdateUnloadFields()
{
  global $db;
  $sql = "select id, location from truck_loader order by location";
  $res = $db->get_results($sql);
  foreach($res as $rw)
  {
    $id = $rw->id;
    $location = trim($rw->location);
    $i = strpos($location,','); //SB city, st
    if($i === false) continue;
    $dcity = strtoupper(trim(substr($location,0,$i)));
    $dstate = strtoupper(trim(substr($location,$i+1,3)));
    if ($dstate == '') continue;
    $sql = "update truck_loader set destination_city='$dcity', destination_state='$dstate' where id = $id";
    echo $i.'  '.$dcity.'--'.$location.'  '.$sql."<br>";
    $db->query($sql);
  }
}
UpdateUnloadFields();    
  
?>