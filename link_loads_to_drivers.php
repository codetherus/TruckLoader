<?php
/*
  One shot to create the initial load records from the truck_loader table.
*/
require_once("commons.php");
require_once("utilityV2.php");

function link_loads()
{
  global $db;
  $numdone = 0;  
  $sql = "select id, driver_name, load_number from loads";  
  $loads = $db->get_results($sql);  
  foreach($loads as $row)  
  {  
    $id = $row->id;    
    $driver_name = $row->driver_name;
    $load_number = $row->load_number;   

    $sql = "select id from drivers where name = '$driver_name'";    
    $did = $db->get_row($sql);    
    if ($did)
    {    
      $numdone++;
      $drid = $did->id;          
      $sql = "update loads set driverid = $drid, where id = $id";      
      $db->query($sql);
      $sql = "update drivers set loadid = $id where id=$drid";
      $db->query($sql);      
    }    
  } 
  echo "Finished. Updated $numdone"; 
}

link_loads();
    

?>