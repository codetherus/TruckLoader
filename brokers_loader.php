<?php
/*
  Load the brokers table provided by J. Musser
*/
//DB Access...
include_once('ezsql/mysql/ez_sql_core.php');
include_once('ezsql/mysql/ez_sql_mysql.php');
include('dbsettings.php');
$db = new ezSQL_mysql($dbuser, $dbpassword, $dbdatabase, $dbhost);

require_once("ExcelReader/reader.php");
$excel = new Spreadsheet_Excel_reader();
$excel->setOutputEncoding('CP1251');
//Load the spreadsheet
$excel->read('brokers.xls');
for ($i=2;$i<=$excel->sheets[0]['numRows']; $i++){
   $bcode = addslashes($excel->sheets[0]['cells'][$i][1]);
   if ($bcode == '') continue;
   $bcompany=addslashes($excel->sheets[0]['cells'][$i][2]);
   $baddress = addslashes($excel->sheets[0]['cells'][$i][3]);
   $bcity = addslashes($excel->sheets[0]['cells'][$i][4]);
   $bstate = addslashes($excel->sheets[0]['cells'][$i][5]);
   $bzip = addslashes($excel->sheets[0]['cells'][$i][6]);
   $bphone = addslashes($excel->sheets[0]['cells'][$i][7]);
   $bcomment = addslashes($excel->sheets[0]['cells'][$i][10]);
   $sql = "insert into brokers(name, company,address1,city,state,zip,phone,notes)
          values('$bcode','$bcompany','$baddress','$bcity','$bstate','$bzip','$bphone',
                 '$bcomment')";
   $db->query($sql); 
}
?>
