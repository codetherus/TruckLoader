<?php
ob_start();
//MySQL classes for database access
include_once('ezsql/mysql/ez_sql_core.php');
include_once('ezsql/mysql/ez_sql_mysql.php');
$db = new ezSQL_mysql('root', 'rootwdp', 'jake', 'localhost');
$corp_id = $_GET['cid'];
$sql = "select * from load_history where corp_id = '$corp_id'";
$rw = $db->get_row($sql);
$fname = $rw->contract_pdf;
$fname = "./linked_pdf_files/".$fname;
header("Content-type: application/pdf");
header('Content-disposition: attachment; filename="thing.pdf"');
readfile($fname);
?>