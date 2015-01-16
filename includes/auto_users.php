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
  $sql = "SELECT * FROM users Where officeid = $office and userid like '".mysql_real_escape_string($q)."%'";
  $rsd = mysql_query($sql);
  while($rs = mysql_fetch_array($rsd)) {
  	$cname = $rs['userid'];
    if ($cname !== '' && substr($cname,0,1) != '(')
  	 echo "$cname\n";
  }
?>
