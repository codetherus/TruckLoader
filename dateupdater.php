<?php
/*
  One shot to set the unload day and month numeric fields
  in the truck loader table
*/
require_once("commons.php");
require_once("utility.php");
function UpdateDateFields()
{
  global $db;
//                   1         2         3 
//         012345678901234567890123456789012345 
//         1  2  3  4  5  6  7  8  9  0  1  2
  $months="janfebmaraprmayjunjulaugsepoctnovdec";
  $sql = "select id, unload_date from truck_loader";
  $res = $db->get_results($sql);
  foreach($res as $rw)
  {
    $id = $rw->id;
    $unload_date = $rw->unload_date;
    if($unload_date == '0') continue;
    $mon = strtolower(substr($unload_date,0,3));
    $da = substr($unload_date,4,2);
    if (substr($da,1,1) == ',')
      $da = '0'.substr($da,0,1); //Rid of commas...
    $monum = @strpos($months,$mon);
    if ($monum === false ) continue;
    $monum = ($monum / 3) + 1;
    $sql = "update truck_loader set unload_day=$da, unload_month = $monum where id = $id";
    $db->query($sql);
    if ($db->rows_affected == 0)
     echo $sql."<br/>";
  }
}
UpdateDateFields();    
  
?>