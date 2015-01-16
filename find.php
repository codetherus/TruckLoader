<?php
/*
  Server side of the "as you type" search tool.
  1. Connect to the database
  2. Extract the search term
  3. Query drivers and loads
  4. Query users
  5. Query brokers.
  5. Query broker agents
  
  The scans query their table/s using a like %...% on all
  fields of interest and generate an html table of the
  qualifying data.  
  8/28/10 - Modify to use the JQuery tablesorter plugin
  
*/
include ("search_commons.php");
$office = $_SESSION['officeid']; //Only the users office for drivers, loads and users.
$level = $_SESSION['level'];
include("dbsettings.php");
$rowcount = 0;
$string = ''; //The returned content
$tbl = '';    //Current table name for addTH
$oddeven = 1; //Row shading control
$fldindex= 0; //column sorting index.
$bodyid = ''; //table sort body id - see addTH()
$oddeven = 0; //Table shading control.
//Database setup
$connect = mysql_connect($svr,$usr,$pwd)
or die('Could not connect to mysql server.' );
mysql_select_db($dbs, $connect)
or die('Could not select database.');

//----------------- Table Setup Functions ---------------------
//Setup a new table
function table($tblid,$end='')
{
  global $string;
  if($end =='')  
    $string .= "<table class='tablesorter' border = '1'>";
  else
    $string .= '</table>';    
}
function thead($end='')
{
  global $string;
  if ($end == '')
    $string .= '<thead>';        
  else
    $string .= '</thead>';
}
function tbody($end=''){
  global $string;  
  if ($end == '')  
    $string .= '<tbody>';    
  else  
    $string .= '</tbody>';    
}
//Add a cell to a table header row.
//Setup table sort link.
function addTH($lbl)
{
  global $string;
  $string .= "<th>$lbl</th>";    
}
//Add a row tag
//May want to customize here
function addTR($end = '')
{
  global $string, $oddeven;
  if ($end == ''){
    if ($oddeven != 0)
    {
      $oddeven = 0;
      $string .= "<tr class='odd'>";
    }
    else
    {
      $oddeven = 1;
      $string .= '<tr>'; 
    }  
  }  
  else  
    $string .= '</tr>';
}
function addCaption($caption)
{
  global $string;  
  $string .= "<caption><b>$caption</b></caption>";  
}
//------------------ End Table Setup Functions ---------------------
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
  $term='AL';
  //exit;
}

//Search the drivers and their current loads.
function DriverScan(){
  
  global $rowcount, $string,$term,$tbl,$fldindex,$bodyid, $office;    
  $tbl = 'drivers';
  $bodyid = 'driverbody';
  $fldindex  = 0; //column for table sort
  $driver_sort = cleanupInput($_POST['driver_sort']);  
  $driver_dir = $_POST['driver_d'];
  $sql = "select drivers.id,drivers.officeid,drivers.status,name,tlength,ttype,canada,twic,truck_no,pole_bunks,pipe_stakes,loadid,loads.load_number,
  loads.delivery_date, loads.delivery_location
  from drivers, loads
  where (name like '%$term%'
  or canada like '%$term%'
  or twic like '%$term%'
  or pipe_stakes like '%$term%'
  or pole_bunks like '%$term%'
  or ttype like '%$term%'
  or tlength like '%$term%'
  or truck_no like '%$term%'
  or loadid like '%$term%'
  or delivery_date like '%$term%'
  or delivery_location like '%$term%')
  and (loads.id = loadid and drivers.officeid = $office)
  order by $driver_sort $driver_dir";
  $result = mysql_query($sql);
  if (mysql_num_rows($result) < 1) return;
  table('driversrch');  
  addCaption("Drivers");
  //Headerrow setup
  thead();  
  addtr();
  addTH('Name');  
  addTH('Truck<br>Number');
  addTH('Truck<br>Length');
  addTH('Truck<br>Type'); 
  addTH('Status');  
  addTH('Canada');  
  addTH('TWIC');  
  addTH('Pole<br>Bunks');  
  addTH('Pipe<br>Stakes');  
  addTH('Load<br>Id');  
  addTH('Delivery<br>Date');  
  addTH('Delivery<br>Location'); 
  addtr('end');
  thead('end');
  tbody();  

  //Process the data
  while($row = mysql_fetch_object($result)){
    //Construct anchors to the drivers and loads tables.
    $link = "<a href='#' onclick=\"sendSearchPage('drivers',$row->id)\">$row->name</a>";
    $loadlink = "<a href='#' onclick=\"sendSearchPage('loads',$row->loadid)\">$row->load_number</a>";
    addTR();
    $string .= "<td>$link<td>$row->truck_no<td>$row->tlength<td>$row->ttype<td>$row->status<td>$row->canada</td>
    <td>$row->twic<td>$row->pole_bunks<td>$row->pipe_stakes<td>$loadlink<td>$row->delivery_date
    <td nowrap>$row->delivery_location</tr>";
    $rowcount++;
  }
  tbody('end');  
  table('x','end');
}

//Search the users table
function UserScan(){
  global $rowcount, $string,$term,$tbl,$fldindex,$bodyid,$office,$level;  
  if ($level != 'admin') return;
  $tbl = 'users'; 
  $bodyid = 'userbody';
  $fldindex = 0; 
  $user_sort = cleanupInput($_POST['user_sort']);
  $user_dir = $_POST['user_d'];
  $sql = "select * from users
  where (user like '%$term%'
  or level like '%$term%'
  or user_name like '%$term%'
  or phone like '%$term%'
  or fax like '%$term%'
  or email like '%$term%')
  and (officeid = $office)
  order by $user_sort $user_dir";
  $result = mysql_query($sql);
  if (mysql_num_rows($result) < 1) return;  
  table('usersrch');    
  addCaption('Users');
  thead();
  addTR();
  addTH('Name');  
  addTH('User ID');  
  addTH('Level');  
  addTH('Phone');  
  addTH('Fax');  
  addTH('Email');    
  addTr('end'); 
  thead('end');  
  tbody();
  while($row = mysql_fetch_object($result)){  
    //Some of the user names are blank - brokers, etc    
    //Catch and populate them
    $user_name = $row->user_name;    
    if ($user_name == '')     
      $user_name = 'None';
    $link = "<a href='#' onclick=\"sendSearchPage('users',$row->id)\">$user_name</a>";    
    addTR();
    $string .= "<td>$link<td>$row->user<td>$row->level<td>$row->phone<td>$row->fax<td>$row->email</tr>";
    $rowcount++;
  }
  tbody('end');  
  table('x','end');
}
//Add a cell to a table header row.
//Setup for the inplace table sort.
//<th><a href="" onclick="this.blur(); return sortTable('offTblBdy',  4, true);" title="Yards Per Game"        >Yds/G</a></th>
function addBrokerTH($fld,$lbl)
{
  global $string,$tbl,$fldindex; 
  $th = "<th <a href='#' onclick=\"return sortTable('brokerbody',$fldindex,false);\">$lbl</a></th>";
  $fldindex++;
  $string .= $th;
}

function BrokerScan(){
  global $rowcount, $string,$term,$tbl,$fldindex,$bodyid;
  $tbl = 'brokers';
  $bodyid = 'brokerbody'; 
  $fldindex = 0; 
  $broker_sort = cleanupInput($_POST['broker_sort']);  
  $broker_dir = $_POST['broker_d'];
  $sql = "select * from brokers
  where name like '%$term%'
  or company like '%$term%'
  or address1 like '%$term%'
  or address2 like '%$term%'
  or city like '%$term%'
  or state like '%$term%'
  or zip like '%$term%'
  or phone like '%$term%'
  or fax like '%$term%'
  or notes like '%$term%'
  order by $broker_sort $broker_dir";
  $result = mysql_query($sql);
  if (mysql_num_rows($result) < 1) return;
  //Construct the heading row
  table('x');
  addCaption('Brokers'); 
  thead(); 
  addTR();
  addTH('company','Brokers: Company');  
  addTH('address1','Address');  
  addTH('city','City');  
  addTH('state','State');  
  addTH('zip','Zip');  
  addTH('phone','Phone');  
  addTH('cell','Cell');  
  addTH('fax','Fax');  
  addTH('notes','Notes');
  addTR('end');
  $string .= "</thead>";
  $string .= "<tbody>";

  while($row = mysql_fetch_object($result)){
    $link = "<a href='#' onclick=\"sendSearchPage('brokers',$row->id)\">$row->company</a>";
    addTR();
    $string .= "<td>$link<td>$row->address1<td>$row->city<td>$row->state<td>$row->zip
                <td>$row->phone<td nowrap>$row->cell<td nowrap>$row->fax<td>$row->notes<td><td></tr>";
    $rowcount++;
  }
  $string .= "</tbody></table>"; 
}

function LoadScan(){
  global $rowcount, $string,$term,$tbl,$fldindex,$bodyid,$office;
  $tbl = 'loads'; 
  $bodyid = 'loadsbody';
  $fldindex = 0; 
  $load_sort = cleanupInput($_POST['load_sort']);  
  $load_dir = $_POST['load_d'];

  $sql = "select * from loads  
  where (load_number  like '%$term%'  
  or booking_date  like '%$term%'  
  or pickup_date  like '%$term%'  
  or delivery_date  like '%$term%'  
  or pickup_location  like '%$term%'  
  or delivery_location  like '%$term%'
  or brokerageid  like '%$term%'  
  or broker_agent  like '%$term%'  
  or broker_phone  like '%$term%'  
  or load_notes  like '%$term%'  
  or load_experience  like '%$term%'  
  or load_options  like '%$term%')
  and (officeid = $office)  
  order by $load_sort $load_dir";  
  $result = mysql_query($sql);
  if (mysql_num_rows($result) < 1) return;
  table('x'); 
  addCaption('Loads'); 
  thead();  
  addtr();
  addTH('Load<br>Number');  
  addTH('Booking<br>Date');  
  addTH('Pickup<br>Date');  
  addTH('Delivery<br>Date');  
  addTH('Pickup<br>Location');  
  addTH('Delivery<br>Location');  
  addTH('Broker Id');  
  addTH('Broker<br>Agent');  
  addTH('Broker<br>Phone');
  addTH('Load<br>Notes');  
  addTH('Load<br>Experience');  
  addTH('Load<br>Options');
  $string .= "</tr>";
  $string .= "</thead>";
  $string .= "<tbody>";  

  while($row = mysql_fetch_object($result)){  
    $link = "<a href='#' onclick=\"sendSearchPage('loads',$row->id)\">$row->load_number</a>";
    addTR();
    $string .= "<td>$link<td>$row->booking_date<td>$row->pickup_date<td>$row->delivery_date<td nowrap>$row->pickup_location
                <td nowrap>$row->delivery_location<td>$row->brokerageid<td>$row->broker_agent<td>$row->broker_phone
                <td>$row->load_notes<td>$row->load_experience<td>$row->load_options</tr>";
    $rowcount++;
  } 
  $string .= "</tbody></table>";
}
function FetchBrokerName($id){
  $sql = "select company from brokers where id = $id";
  $result = mysql_query($sql);
  while($row = mysql_fetch_object($result))
    return $row->company;
}
  
//This scans the broker_agent table
function AgentScan(){
  global $rowcount, $string,$term,$tbl,$fldindex,$bodyid;
  $tbl = 'broker_agents';
  $bodyid = 'brokeragentbody'; 
  $fldindex = 0; 
  $broker_sort = cleanupInput($_POST['agent_sort']);  
  $broker_dir = $_POST['agent_d'];
  $sql = "select * from broker_agents
  where agent_name like '%$term%'  
  or agent_phone  like '%$term%'  
  or agent_fax like '%$term%'  
  or agent_email like '%$term%'
  order by agent_name asc";
  //$string .= $sql."<br/>";
  $result = mysql_query($sql);
  //if (!$result) return;
  if (mysql_num_rows($result) < 1) return;
  table('x'); 
  addCaption('Broker Agents'); 
  thead();  
  addtr();
  addTH('Name');
  addTH('Phone');
  addTH('Fax');
  addTH('Email');
  addTH('Brokerage');    
  $string .= "</tr>";
  $string .= "</thead>";
  $string .= "<tbody>";  
  while($row = mysql_fetch_object($result)){
    $brokerage = FetchBrokerName($row->brokerid);
    $link = "<a href='#' onclick=\"sendSearchPage('broker_agent_editor',$row->id)\">$row->agent_name</a>";
    addTR();
    $string .= "<td>$link<td>$row->agent_phone<td>$row->agent_fax<td>$row->agent_email<td>$brokerage</tr>";
    $rowcount++;
  }
  $string .= "</tbody></table>";
}

/*
  Run the queries
  8/26/10
  The optional first character of the search term is used to indicate which table/s to search:
  ! = drivers
  @ = loads
  # = users
  $ = brokers
  ^ = Drives and loads
*/
$skey = substr($term,0,1);
if (strpos('!@#$^%',$skey) !== false)
{
  $term = substr($term,1,100);
  switch($skey){
    case "!":
      DriverScan();
      break;
    case "@":
      LoadScan();
      break;
    case "#":
      UserScan();
      break;
    case "$":
      BrokerScan();
      break;
    case "^":
      DriverScan();
      LoadScan();
      break;
    case "%":
      AgentScan();
      break;
  }  
}
else
{
      DriverScan();
      LoadScan();
      UserScan();
      BrokerScan();
      AgentScan();
}
//If anything was found, complete the table and add the close button.
if ($rowcount > 0)
{
  $string  = "<center><br/><input type='button' value='close' onclick='hideSearch();'/><center>$string";  
  $string .= "<center><br/><input type='button' value='close' onclick='hideSearch();'/></center>";
  echo $string;
}
else
  echo ''; //Nothing found...
?>
