<?php
/*
  6/23/11
  We want to send emails of our available trucks by
  region to Menlo Worldwide transport.
  This page, derived from the corporate spreadsheet
  page handles the task.
  
  1. Query as usual for available trucks.
  2. Create a text for each truck by region.
  3. Email each list.
  
  The regions will have to be established by state.
  Users will provide the list.
*/
require_once("commons.php");
require_once("utilityV2.php");
//Date range objects
$fromdate = new DateTime();
$todate = new DateTime();

//Defines for the messages and addresses
//Regional email addresses
define('souteasthaddress',    'DTCISouthEastRegion@menloworldwide.com');
define('centraladdress',      'Dtcicentralregion@menloworldwide.com');
define('westernaddress',      'dtciwestregion@menloworldwide.com');
define('northeastaddress',    'DTCInortheastregion@menloworldwide.com');
//Message body header
/*
  Generate the emails...
  $addr = region email address
  $trucks = list of trucks for the region
*/
function DoMail($addr,$trucks){
$headers = 'From: jake@loadsbyjake.com' . "\r\n" .
    'Reply-To: jake@loadsbyjake.com' . "\r\n" ;

$messagehead =
"This is Jake with American Transport Group.
 We have available trucks in your region today. 
 Here is a list of trucks at this time.
 Others are available so please never rule us out.\r";
//Message subject line
$subject ="Available trucks list\r";

  if ($trucks == ''){ 
    echo '<b>No trucks for '.$addr.'<br/><br/></b>';
    return;
  }
  $message = $messagehead."\r".$trucks;
  $res = @mail($addr, $subject, $message, $headers);
  $displaymessage = nl2br($message);
  if (!$res)
    echo '<b>Failed to mail to '.$addr.'<br/><br/></b>'.$displaymessage.'<br/>';
  else
    echo '<b>Sent email to '.$addr.'<br/><br/></b>'.$displaymessage.'<br/>'; 
}

//Make the delivery date range between for the SQL query.
function MakeDayList()
{
  
  $date = new DateTime();  //today
  $date->modify('-2 day'); //2 days ago
  $from = "'".$date->format('Y-m-d')."'";
  $date->modify('4 day'); //2 days hence
  $to = "'".$date->format('Y-m-d')."'";
  $uld = "delivery_date between $from and $to";  
  return $uld;
}

//Lookup the state in the state to region map
//and return the region code.
//Return empty string id not found...
function DestinationToRegion($destination){
  include('regionmap.php'); //array of state to region
  if ($destination == '') return false;
  $i = strpos($destination,','); //find comma between city and state...
  if (!$i) return false;
  $state = trim(substr($destination,$i+1));
  if ($state == '') return false;
  foreach($regionmap as $k => $v){
    if ($k == $state)
      return $v;
  }
  return '';
}
//Main
function Generate()
{
  echo '<center><h2>Menlo WorldWide Email Generator</h2></center>';
  $today = date('Y-m-d');

	global $db, $fromdate, $todate, $res, $qry; 

  $sql = "select loads.*, drivers.* from loads,drivers where loads.driverid = drivers.id and loads.id = drivers.loadid ";
  $sql .= "and ".MakeDayList()." and drivers.status='Active' order by delivery_date";
  $res = $db->get_results($sql);
  $nrows = $db->num_rows;
  echo "<b>Selected $nrows active drivers.</b><br/><br/>"; 
  if ($nrows < 1) die;   
  //Generate the contents.
  //The regions trucks...
  $western   = '';
  $central   = '';
  $southern  = '';
  $northeast = '';
  //Construct the message bodies by region.
  foreach ($res as $rw)
  {
      $ttype = $rw->ttype;
      if ($ttype == '' || $ttype == 'Dont Know') continue;
      $tlength = $rw->tlength;
      if($tlength == '') continue;
      $destination = $rw->delivery_location;
      $delivery_date = $rw->delivery_date;
      if ($delivery_date <= $today)
        $delivery_date = $today;
      $region = DestinationToRegion($destination);
      $destination = ucwords(strtolower($destination)); //Proper case destination...
      if(!$region) continue;
      $msg = "$tlength' $ttype available on $delivery_date in $destination\r";
      //Add to the appropriate region string.
      switch($region){
        case 'w':
          $western .= $msg ;
          break;
        case 'c':
          $central .= $msg;
          break;
        case 's':
          $southern .= $msg;
          break;
        case 'n':
          $northeast .= $msg;
      }
  }
  //Now generate the emails.
  DoMail(souteasthaddress, $southern);
  DoMail(centraladdress,   $central);
  DoMail(westernaddress,   $western);
  DoMail(northeastaddress, $northeast);
  echo '<h2>Menlo Worldwide processing completed.</h2>';   
}
Generate();
?>
