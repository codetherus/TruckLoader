<?php
  include("search_commons.php");
  $office = $_SESSION['officeid'];
  include("../dbsettings.php");  
  $con=mysql_connect($dbhost,$dbuser,$dbpassword);
  if($con){
  	mysql_select_db($dbdatabase,$con);
  }
  else{
  	die("Could not connect to database");
  }
  $q = strtolower($_GET["q"]);
  if ($q == '') return;
  $sql = "SELECT load_number FROM loads Where officeid = $office and load_number like '".mysql_real_escape_string($q)."%'";
  $rsd = mysql_query($sql);
  while($rs = mysql_fetch_array($rsd)) {
  	$cname = $rs['load_number'];
    if ($cname !== '' && substr($cname,0,1) != '(')
  	 echo "$cname\n";
  }
?>
