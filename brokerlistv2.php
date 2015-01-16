<?php
/*
  Driver list for brokers 
  called if user.level is "broker"
  Displays driver name, location and unload date for
  active drivers so brokers can come in and see and
  maybe contact LBJ with a load.
  3/31/10 - filter records with unload dates of today-1, today, today+1, today+2  
  10/6/10 - Retrofit for version 2 loads oriented site.
*/
require_once("commons.php");
$smarty->assign("pgtitle", "Brokers List"); 
$smarty->assign("domenu", 0);
//make a between clause for a 5 day range centered on today
function MakeMonthList()
{
  $date = new DateTime();
  $thismonth = $date->format('m');
  $lastmonth = $thismonth - 1;
  if ($lastmonth == 0) $lastmonth = 12;
  $nextmonth = $thismonth + 1;
  if ($nextmonth > 12) $nextmonth = 1;
  return "($lastmonth, $thismonth, $nextmonth)";
}
//3/31/10 - Build the list of dates to search
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
  
function ListDrivers()
{
  global $db, $smarty;
  $sql = "select loads.*, drivers.* from loads,drivers where loads.driverid = drivers.id and loads.id = drivers.loadid ";
  $sql .= "and ".MakeDayList()." order by delivery_date";
  //$sql .= " order by unload_date";
  //return ShowData($sql);  
  //print_r($sql,false); die;
  $res = $db->get_results($sql);
  if (!$res)
  {
    $s = "No drivers found at this time...";
  }
  else    
  {  
    $s  = "<table id='flex' border='2'cellpadding='5'>\n";
    $s .= "<Caption><b>Driver Availability List<br>For more information contact us at (208) 845-0853</b></caption>\n";
    $s .= "<tr><th>Email<th align='left'>Driver<th align='left'>Equipment<th align='left'>Unload Location<th>Unload Date</tr>\n";
    $email = "<a href='mailto:jake@loadsbyjake.com'>Email Us</a>";
    foreach($res as $rw)
    {
      $driver=strtoupper($rw->name);
      if ($driver == '') continue;
      $loadnum = $rw->load_number;
      //filter out old loads by id      
      if (substr($loadnum,0,3) == 'Sep' || substr($loadnum,0,3) == 'Oct') continue;
      
      $location=strtoupper($rw->delivery_location);
      if ($location == '') continue;
      $unloaddate = $rw->delivery_date;
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
               
      $subject = "Inquiry about $equip driven by $driver arriving in $location on $unloaddate (Your Load #: $loadnum)";      
      $email = "<a href='mailto:jake@loadsbyjake.com?subject=$subject'>Email Us</a>";
          
      $s .= "<tr><td>$email<td align='left'>$driver<td align='left'>$equip<td align='left'>$location<td align='left'>$unloaddate</tr>\n";
    }
    $s .= "</table>\n";    
  }
  $smarty->assign("drivers",$s);
}
ListDrivers();
GenerateSmartyPage();
?>
