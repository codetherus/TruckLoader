<?php
/*
  One shot to update the VTIGER_ACCOUNT_NO on the CLFACT table
  in the QUE intranet database.
  
  1. Read the record in CLFACT.
  2. Use its VTIGERID to read the VTIGER_503 account table.
  3. Update the CLFACT from the vtiger accounts
*/  
include_once('ezsql/mysql/ez_sql_core.php');
include_once('ezsql/mysql/ez_sql_mysql.php');
include('dbsettings.php');
$clfact = new ezSQL_mysql('hradmin', 'psycho', 'intranet', '192.168.1.82');
$vtiger = new ezSQL_mysql('root','','vtigercrm503','192.168.1.90:3307');
$sql = 'select recnum, VTIGERID, Name from CLFACT order by NAME';
if (!@$cfact = $clfact->get_results($sql)){
  echo 'Cannot connect to the intranet server.';
  die;
}
  
foreach($cfact as $rw){
  $recnum = $rw->recnum;
  $vtigerid = $rw->VTIGERID;
  $name = $rw->NAME;
  $sql = "select account_no from vtiger_account where accountid = $vtigerid";
  echo 'Selecting Account no from vtiger'.'  ',$sql.'<br>';
  if (!$res = $vtiger->get_row($sql)){
    echo 'Cannot connect to the VTIGER database.';
    //die;
  } 
  $acno = $res->account_no;
  echo $recnum.'  '.$vtigerid.'  '.$name.'  '.$acno.'<br>'.$sql.'<br>';
  $sql = "update CLFACT set VTIGER_ACCOUNT_NO = '$acno' where recnum = $recnum";
  echo $sql.'<br>';
  $clfact->query($sql);
  //die;
}
?>