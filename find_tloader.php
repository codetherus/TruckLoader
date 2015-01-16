<?php
/*
  This version scans the truck_loader table.
  Will try to use the jq table sorter instead of the embedded onclicks
  Server side of the "as you type" search tool.
  1. Connect to the database
  2. Extract the search term
  3. Query truck_loader
  
  The scans query their table/s using a like %...% on all
  fields of interest and generate an html table of the
  qualifying data.
  
*/
include("dbsettings.php");
$rowcount = 0;
$string = ''; //The returned content
$tbl = '';    //Current table name for addTH
$oddeven = 1; //Row shading control
//Database setup
$connect = mysql_connect($svr,$usr,$pwd)
or die('Could not connect to mysql server.' );
mysql_select_db($dbs, $connect)
or die('Could not select database.');

//Add a cell to a table header row.
function addTH($lbl)
{
  global $string,$tbl;  
  $string .= "<th>$lbl</th>";  
}
//Add a row tag
//May want to customize here
function addTR()
{
  global $string;
  $string .= '<tr>'; 
}
//Sanitize the inputs
function cleanupInput($s)
{
  $res = strip_tags($s);
  $res = mysql_escape_string($s);
  return $res;
}  
$term = cleanupInput($_POST['search_term']);
if ($term == '')
{
  $term = 'a';
}

//Checkbox values are stored as 0 or 1.
//Translate to Yes or blank.
function TranslateCheckbox($n)
{
  if ($n == 1)
    return 'Yes';
  else
    return ' ';
}
function SetupTarps($row)
{
  $s = '';
  if ($row->f4ft_tarps == 1)
    $s = '4 ';
  if ($row->f6ft_tarps == 1){
    if ($s == '')
      $s = '6 ';
    else 
      $s .= '6 ';
  }
  if ($row->f8ft_tarps == 1){
    if ($s == '')
      $s = '8';
    else 
      $s .= '8';
  }
  return $s;
}
  
  
//Search the drivers and their current loads.
function TruckLoaderScan(){
  
  global $rowcount, $string,$term,$tbl;    
  $tbl = 'truck_loader';
  $driver_sort = cleanupInput($_POST['driver_sort']);
  if ($driver_sort == '')
   $driver_sort = 'driver';  
  $driver_dir = $_POST['driver_d'];
  if ($driver_dir == '')
    $driver_dir = 'asc';
  $sql = "select truck_loader.*,users.*
  from truck_loader, users
  where (driver like '%$term%'
  or driver_alias like '%$term%'
  or unload_date like '%$term%'
  or location like '%$term%'
  or tlength like '%$term%'
  or truck_no like '%$term%'
  or home_town like '%$term%'
  or preferences like '%$term%'
  or comments like '%$term%'
  or home_office like '%$term%'
  or office_numbers like '%$term%'
  or driving_limitations like '%$term%'
  or truck_loader.email like '%$term%'
  or rating like '%$term%'
  or telephone like '%$term%')
  and (users.id = truck_loader.userid)
  order by $driver_sort $driver_dir";
  $result = mysql_query($sql);
  if (mysql_num_rows($result) < 1) return;
  
  //Header row setup
  $string .= '<table id="searchtable" border="1" style="border-collapse: collapse;">';
  $string .= '<thead>';
  $string .= '<tr>';
  addTH('Driver Name');
  addTH('Alias');
  addTH('Status');
  addTH('Rating');
  addTH('Unload<br>Date');
  addTH('Location');
  addTH('Length');
  addTH('Type');
  addTH('Home Town');
  addTH('Truck<br>Number');
  addTH('Canada');
  addTH('TWIC');
  addTH('Pipe<br>Stakes');
  addTH('Load<br>Levelers');
  addTH('Tarps');
  
  $string .= '</tr>';
  $string .= '</thead>';
  $string .= '<tbody>';

  //Process the data
  while($row = mysql_fetch_object($result)){
    $canada = TranslateCheckbox($row->canada);
    $twic = TranslateCheckbox($row->twic);
    $pipe_stakes = TranslateCheckbox($row->pipe_stakes);
    $load_levelers = TranslateCheckbox($row->load_levelers);
    $tarps = SetupTarps($row);
    if ($row->driver_status == 1)
      $dstatus = 'Active';
    else
      $dstatus = 'Inactive';
    //Construct anchors to the drivers and loads tables.
    $link = "<a href='#' onclick=\"xajax_ShowLoad($row->id)\">$row->driver</a>";
    addTR();
    $string .= "<td>$link<td>$row->driver_alias<td>$dstatus<td>$row->rating<td>$row->unload_date
    <td>$row->location<td>$row->tlength<td>$row->ttype<td>$row->home_town<td>$row->truck_no
    <td>$canada<td>$twic<td>$pipe_stakes<td>$load_levelers<td>$tarps</tr>";
    $rowcount++;
  }
  $string .= '</tbody></table>';
}

//Run the queries
TruckLoaderScan();

//If anything was found, complete the table and add the close button.
if ($rowcount > 0)
{

  $string  = "<center><br/><input type='button' value='close' onclick=\"$('#search_results').hide();\"/><center>$string";  
  $string .= "<center><br/><input type='button' value='close' onclick=\"$('#search_results').hide();\"/><center>";
  echo $string;
}
else
  echo ''; //Nothing found...
?>
