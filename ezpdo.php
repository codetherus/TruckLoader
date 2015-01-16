<?php
include('ezsql/shared/ez_sql_core.php');
include('ezsql/pdo/ez_sql_pdo.php');
$db = new ezSQL_pdo('mysql:host=localhost;dbname=jake','root','');
$res = $db->get_results("select * from drivers where name = 'allen shaw'");
$s = '';
foreach($res as $rw){
  foreach ($rw as $key => $val)
  $s .= $key . ' = ' . $val.'<br/>';
}

echo $s;