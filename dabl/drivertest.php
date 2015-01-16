<?php
/*
  Testing the dabl classes
*/
require_once('config.php');
include("models/Drivers.php");
$d = new Drivers();
$res = $d->getAll('where status = \'Active\' and agentid=1 order by name');
echo '<table border="1" style="border-collapse:collapse">';
echo '<caption><b>Active Drivers Agent 1</b></caption>';
echo '<tr><th>Name<th>Rating</tr>';
foreach ($res as $dr)
{
  echo '<tr>';
  echo '<td>'.$dr->name.'<td>'.$dr->rating.'</tr>';
}
echo '</table>';