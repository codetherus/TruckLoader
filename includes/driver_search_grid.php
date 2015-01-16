<?php
include("../dbsettings.php");

function runSQL($rsql) {
  global $dbuser, $dbhost, $dbdatabase, $dbpassword;
	$connect = mysql_connect($dbhost,$dbuser,$dbpassword) or die ("Error: could not connect to database");
	$db = mysql_select_db($dbdatabase);
	$result = mysql_query($rsql) or die ("Died - $rsql");
	mysql_close($connect);
  return $result;
	
}

function countRec($fname,$tname) {
	$sql = "SELECT count($fname) FROM $tname ";
	$result = runSQL($sql);
	while ($row = mysql_fetch_array($result)) {
		return $row[0];
	}	
}

function SetupTarps($row)
{
  $tarps = '';
  if ($row['no_tarps'] == 1)
   return 'No';
  if ($row['f4ft_tarps'] == 1 )
    $tarps = '4';
  if ($row['f6ft_tarps'] == 1 )
    if ($tarps == '')
      $tarps = '6';
    else
      $tarps .= ', 6';
  if ($row['f8ft_tarps'] == 1 )
    if ($tarps == '')
      $tarps = '8';
    else
      $tarps .= ", 8";
  return $tarps;
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
$sql = "SELECT * FROM drivers $where $sort $limit";
$result = runSQL($sql);

$total = countRec("name","drivers");

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
  $nm = $row['name'];
  if ($nm == '') continue;  
  if (substr($nm,0,1) == "(") continue;
  $twic = $row['twic'];  
  $canada = $row['canada'];  
  $id = $row['id'];
  $loadid = $row['loadid'];
  if ($loadid > 0)
  {  
  $sql = "SELECT * FROM loads WHERE id = $loadid";
  $res = runSQL($sql);
  $load = mysql_fetch_array($res); 
  $delivery_location = $load['delivery_location'];
  $delivery_date = $load['delivery_date'];  
  } 
  else
  {
    $delivery_location = 'Not Given';
    $delivery_date = 'Not Given';    
  }  
  if ($delivery_location == '') $delivery_location = $loadid;
  $tarps = SetupTarps($row); 

  $driver = $row['name'];
  $link = "<a href='#' onclick=\"doDisplay('$driver')\">$driver</a>"  ;
  $rows[] = array("id" => $id,  
                  "cell" => array($row['id'],
                                  $link,
                                  $row['truck_no'],
                                  $delivery_location,
                                  $delivery_date,
                                  $twic,
                                  $canada,
                                  $row['pipe_stakes'],
                                  $row['pole_bunks'],
                                  $tarps,
                                  $row['status'],
                                  $row['rating']
                                  ) 
            );

}
$data['rows'] = $rows;
$data['params'] = $_POST;
echo json_encode($data);
?>