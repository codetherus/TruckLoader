<?php
/*
  03-09-2012
  Active trucks list for big screen tv display
  
  Query for active trucks, order by state and agent id.
  Called by client using jQuery.post(...);
*/

//MySQL classes for database access
include_once('ezsql/mysql/ez_sql_core.php');
include_once('ezsql/mysql/ez_sql_mysql.php');
include('dbsettings.php');
$db = new ezSQL_mysql($dbuser, $dbpassword, $dbdatabase, $dbhost);
function FindLoads()
{
  global $db;
  $sql = "SELECT d.* , l.*,u.*, substring(l.delivery_location,-2) as state
  from drivers d, loads l, users u
   WHERE d.status = 'active' and
  l.id = d.loadid
  and u.officeid = 1
  and u.id = d.agentid
  order by state,d.agentid";
  $res = $db->get_results($sql);
  $s  = "<table style='font-size: 2em;font-weight: bold;'>";
  $s .= "<thead><th>Destination</th><th>User</th><th>Driver</th><th>Delivery<br/> Date</thead>";
  $s .= "<tbody>"; 
  foreach($res as $rw)
  {
    $dd = new DateTime($rw->delivery_date);
    $deldate = $dd->format('m/d');
    //09-14-2012 Alternate color for broker trucks.
    if ($rw->cobroker == 'Broker')
      $s .= "<tr style = 'color: red;'>";
    else 
      $s .= '<tr>';
    $s .= "<td nowrap='nowrap'>$rw->delivery_location</td><td nowrap='nowrap'>$rw->user_name</td><td nowrap='nowrap'>$rw->name</td><td nowrap='nowrap'>$deldate</td></tr>";
  }
  $s .= "</tbody></table>";
  echo $s;
}
FindLoads();