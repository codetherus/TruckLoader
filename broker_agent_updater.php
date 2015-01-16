<?php
/*
  One shot to populate the broker agent table from the loads table.
*/
require_once("commons.php");

$sql = "select * from loads where broker_agent <> '' and brokerageid <>''";
$res = $db->get_results($sql);
if (!$res){
  echo 'No loads qualify...';
  exit;
}
$numrecs = $db->num_rows;
echo "Processing $numrecs records<br/>";

foreach ($res as $rw){
  $brokerageid = $rw->brokerageid;
  $broker_agent = $rw->broker_agent;
  $agent_phone = $rw->agent_phone;
  $sql = "select id from brokers where company = '$brokerageid'";
  $bres = $db->get_row($sql);
  if (!$bres) continue;
  $bid = $bres->id;
  $sql = "insert into broker_agents (brokerid,agent_name,agent_phone)
          values($bid,'$broker_agent','$agent_phone')";
  $db->query($sql);
}  
  
  