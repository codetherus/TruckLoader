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
  return;
	$sql = "SELECT count($fname) FROM $tname ";
	$result = runSQL($sql);
	while ($row = mysql_fetch_array($result)) {
		return $row[0];
	}	
}

$page = @$_POST['page'];
$rp = @$_POST['rp'];
$sortname = @$_POST['sortname'];
$sortorder = @$_POST['sortorder'];

if (!$sortname) $sortname = 'name';
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
$s = $query;
$sql = "select * from drivers 
where name like '%$s%' 
||tlength like '%$s%' 
||ttype like '%$s%' 
||home_town like '%$s%' 
||preferences like '%$s%' 
||truck_no like '%$s%'
||comments like '%$s%' 
||home_office like '%$s%'
||canada like '%$s%' 
||twic like '%$s%' 
||pipe_stakes like '%$s%' 
||driving_limitations like '%$s%'
||load_levelers like '%$s%' 
||load_options like '%$s%' 
||email like '%$s%' 
||pole_bunks like '%$s%'
||canada_limitations like '%$s%' ";
$sql .= "$sort $limit";



$result = runSQL($sql);
$where = '';
$total = countRec("userid","users $where");

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
  $name = $row['name'];
  $id = $row['id'];  
  $link = "<a href='#' onclick=\"doDriverDisplay('$id')\">$name</a>"  ;
  $rows[] = array("id" => $id,  
                  "cell" => array($id,
                                  $link,
                                  $row['name'],
                                  $row['email']
                                  ) 
            );

}
$data['rows'] = $rows;
$data['params'] = $_POST;
echo json_encode($data);
?>