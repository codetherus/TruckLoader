<?php 
/*
	Copyright(c) 2009 by RSI. All rights reserved.
  This page provides the users with a table view
  of the current inbound data table.
*/
//--------------------------- Page Setup Stuff -----------------------------------------
require_once("commons.php");
require_once("utility.php");
$smarty->assign("pgtitle", "Daily Inbound Truck File Table Viewer"); 	//Do per page.
$smarty->assign("domenu", 1);
function BuildDisplay()
{
  global $db;
  $sql = "select * from truck_inbound order by origin_state, origin_city, ";
  $sql .= "dest_state, dest_city";
  $res = $db->get_results($sql);
  if (!$res)
    return "No upload records found.";
  $s = "<table border='2'style='font-size: smaller'>\n";
  $s .= "<tr><th>Id<th>Agent<th>Truck #<th>Equipment<th>Driver<th>Cell";
  $s .= "<th>Origin City<th>State<th>Dest. City<th>State<th>Deliv. Month";
  $s .= "<th>Day<th>Deliv Date<th>Comments<th>Telephone</tr>";
  foreach($res as $rw)
  {
    if($rw->driver != '')
    {
      $s .= "<tr><td>$rw->id<td>$rw->agent<td>$rw->truck_number<td>$rw->equipment<td>$rw->driver<td>$rw->cell<td>$rw->origin_city";
      $s .= "<td>$rw->origin_state<td>$rw->dest_city<td>$rw->dest_state<th>$rw->delivery_month<td>$rw->delivery_day<td>$rw->delivery_date";
      $s .= "<td>$rw->comments<td>$rw->telephone</tr>\n";
    }
  }
  $s .= "</table>\n";
  return $s;
}

$smarty->assign("tableDisplay", BuildDisplay());
//$xajax->configure('debug',true);
$xajax->register(XAJAX_FUNCTION,'DisplayInbound');
$xajax->processRequest();


GenerateSmartyPage();
?>
