<?php
/*
  Driver list for brokers 
  Services brokerlist.html using jqGrid
*/
include_once('../ezsql/mysql/ez_sql_core.php');
include_once('../ezsql/mysql/ez_sql_mysql.php');
include('../dbsettings.php');
$db = new ezSQL_mysql($dbuser, $dbpassword, $dbdatabase, $dbhost);
//$q = strtolower($_GET["q"]);
//if ($q == '') return;  

//Construct the sql between phrase
function MakeDayList(){
  $date = new DateTime();  //today
  $date->modify('-2 day'); //2 days ago
  $from = "'".$date->format('Y-m-d')."'";
  $date->modify('4 day'); //2 days hence
  $to = "'".$date->format('Y-m-d')."'";
  $uld = "delivery_date between $from and $to";  
  return $uld;
}
  
function ListDrivers()
{
  global $db;
  $sql = "select loads.*, drivers.* from loads,drivers where loads.driverid = drivers.id and loads.id = drivers.loadid ";
  $sql .= "and ".MakeDayList()." and name <> '' and delivery_location <> ''  order by delivery_date";
  $res = $db->get_results($sql);
  if (!$res){
    echo 'No Drivers Found';
    die;
  }
  $page = $_GET['page']; // get the requested page 
  $limit = $_GET['rows']; // get how many rows we want to have into the grid 
  $sidx = $_GET['sidx']; // get index row - i.e. user click to sort 
  $sord = $_GET['sord']; // get the direction   
  $response->page = 1;
  $response->total = 1;  
  $response->records = count($res);
  $i = 0;  
  foreach($res as $rw)
  {
    $driver=ucwords(strtolower($rw->name));    
    $loadnum = $rw->load_number;
    //filter out old loads by id      
    if (substr($loadnum,0,3) == 'Sep' || substr($loadnum,0,3) == 'Oct') continue;
    $location=strtoupper($rw->delivery_location);
    
    $unloaddate = $rw->delivery_date;
    
    //Setup the equipment
    $tlength=$rw->tlength;
    $ttype=$rw->ttype;
    $equip = '';
    if ($ttype != 'Dont Know')
    {
      if ($tlength != '')
        $equip = $tlength."ft ";
      $equip .= $ttype;
    }
    else
      $equip = "Unknown"; 
    //Setup the email subject and the email link         
    $subject = "Inquiry about $equip driven by $driver arriving in $location on $unloaddate Your Load #: $loadnum";      
    $email = "<a href=\"mailto:jake@loadsbyjake.com?subject=$subject\">Email Us</a>";
    $response->rows[$i]['id']='$i'; 
    $response->rows[$i]['cell']=array($email,$driver,$equip,$location,$unloaddate);
    $i++;
  }
  //print_r($response,false); die;
  echo json_encode($response);         
}
ListDrivers();
?>
