<?php 
 $rd=dirname($_SERVER['SCRIPT_FILENAME']);
 echo $rd.'<br>'; 
 while (!is_file($rd ."/index.php")) 
 { 
  $rd=dirname($rd);
  echo $rd.'<br/>';  
 }
 if (strpos($rd,'Application Form')==true) 
 { $incf="app.inc.php"; 
 } 
 else 
 { 
  $incf="main.inc.php"; 
 } 
 $rootdir=$rd;
 echo $incf; 
 //require_once($rd ."/" .$incf); ?>
<!DOCTYPE HTML>