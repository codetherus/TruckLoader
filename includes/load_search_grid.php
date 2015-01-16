<?php
include("../dbsettings.php");

function runSQL($rsql) {
  global $usr, $svr, $dbs, $pwd;
	$connect = mysql_connect($svr,$usr,$pwd) or die ("Error: could not connect to database");
	$db = mysql_select_db($dbs);
	$result = mysql_query($rsql) or die ("Run SQL Query: $rsql");
	return $result;
	mysql_close($connect);
}

function countRec($fname,$tname) {
	$sql = "SELECT count($fname) FROM $tname ";
	$result = runSQL($sql);
	while ($row = mysql_fetch_array($result)) {
		return $row[0];
	}	
}

function readDriver($driverid)
{
  $sql = "select name from drivers where id = $driverid";
  $result = runSQL($sql);
	while ($row = mysql_fetch_array($result)) 
		return $row[0];
}
$page = @$_POST['page'];
$rp = @$_POST['rp'];
$sortname = @$_POST['sortname'];
$sortorder = @$_POST['sortorder'];

if (!$sortname) $sortname = 'load_number';
if (!$sortorder) $sortorder = 'desc';

$sort = "ORDER BY $sortname $sortorder";

if (!$page) $page = 1;
if (!$rp) $rp = 25;

$start = (($page-1) * $rp);

$limit = "LIMIT $start, $rp";

$query = @$_POST['query'];
$qtype = @$_POST['qtype'];

$where = "";
if ($query) $where = " WHERE $qtype LIKE '%$query%' ";
if ($where == '')
  $where = " where l.driverid = d.id";
else
  $where .= " and l.driverid = d.id";
//$sql = "SELECT * FROM loads $where $sort $limit";
$sql = "select l.*, d.name from loads l, drivers d $where $sort $limit";

$result = runSQL($sql);
$where = '';
$total = countRec("load_number","loads $where");

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" ); 
header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" ); 
header("Cache-Control: no-cache, must-revalidate" ); 
header("Pragma: no-cache" );
header("Content-type: text/x-json");
//Begin json array construction
$data['page'] = $page;
$data['total'] = $total;

//Construct each row of results
while ($row = mysql_fetch_array($result)) {
  $id = $row['id'];  
  $driver = $row['name']; //readDriver($row['driverid']);
  $load_number = $row['load_number'];
  $link = "<a href='#' onclick=\"doLoadDisplay('$id')\">$load_number</a>"  ;
  $rows[] = array("id" => $id,  
                  "cell" => array($id,
                                  $link,
                                  $driver,
                                  $row['pickup_location'],
                                  $row['pickup_date'],
                                  $row['delivery_location'],
                                  $row['delivery_date']
                                  ) 
            );

}
$data['rows'] = $rows;
$data['params'] = $_POST;
echo json_encode($data);
?>