<?php
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
  $sql = "SELECT company FROM brokers Where company like '".mysql_real_escape_string($q)."%'";
  $rsd = mysql_query($sql);
  while($rs = mysql_fetch_array($rsd)) {
  	$cname = $rs['company'];
    //if ($cname !== '')
  	 echo "$cname\n";
  }
?>
