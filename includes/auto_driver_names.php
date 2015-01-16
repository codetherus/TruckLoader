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
  $sql = "select id,name from drivers where name LIKE '%$q%' and officeid like $office";
  $rsd = mysql_query($sql);
  while($rs = mysql_fetch_array($rsd)) {
  	$cname = $rs['name'];
    $id = $rs['id'];
    if ($cname !== '' && substr($cname,0,1) != '(')
      echo "$cname\n";
  }
?>