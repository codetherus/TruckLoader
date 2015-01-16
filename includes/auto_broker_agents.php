<?php
  include("search_commons.php");
  $bid = $_SESSION['brokerid'];
  include("../dbsettings.php");
  $con=mysql_connect($svr,$usr,$dbpassword);
  if($con){
  	mysql_select_db($dbs,$con);
  }
  else{
  	die("Could not connect to database");
  }
  $q = strtolower($_GET["q"]);
  if ($q == '') return;
  //Filter on the broker if id is given
  if ($bid)
    $sql = "SELECT agent_name FROM broker_agents where agent_name like '".mysql_real_escape_string($q)."%' and brokerid = $bid";
  else
    $sql = "SELECT agent_name FROM broker_agents where agent_name like '".mysql_real_escape_string($q)."%'";
  $rsd = mysql_query($sql);
  while($rs = mysql_fetch_array($rsd)) {
  	$ba = $rs['agent_name'];
    if ($ba !== '')
  	 echo "$ba\n";
  }
?>
