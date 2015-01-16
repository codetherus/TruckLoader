<?php
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
  $sql = "SELECT user_name FROM users Where user_name like '".mysql_real_escape_string($q)."%'";
  $rsd = mysql_query($sql);
  while($rs = mysql_fetch_array($rsd)) {
  	$cname = $rs['user_name'];
    if ($cname !== '' && substr($cname,0,1) != '(')
  	 echo "$cname\n";
  }
?>
