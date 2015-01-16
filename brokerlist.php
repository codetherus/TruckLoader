<?php
/*
  Driver list for brokers 
  called if user.level is "broker"
  Displays driver name, location and unload date for
  active drivers so brokers can come in and see and
  maybe contact LBJ with a load.
  3/31/10 - filter records with unload dates of today-1, today, today+1, today+2
*/
require_once("commons.php");
$smarty->assign("pgtitle", "Brokers List"); 
$smarty->assign("domenu", 0);
//make an in clause with this, last and next month #s
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
  $days = array();//Array of mmm dd dates
  $unload_date = $dta['unload_date'];//date('yyyy-mm-dd') from the browser
  $date = new DateTime();  //today
  $date->modify('-1 day'); //yesterday
  $uld = "'".$date->format('M d')."', ";
  $date->modify('1 day'); //today
  $uld .= "'".$date->format('M d')."', ";
  $date->modify('1 day'); //tomorrow
  $uld .= "'".$date->format('M d')."', ";
  $date->modify('1 day'); //day after tomorrow
  $uld .= "'".$date->format('M d')."'";
  $uld = "unload_date in ($uld)";
  //echo $uld; die;
  return $uld;
}
  
function ListDrivers()
{
  global $db, $smarty;
  $sql = "select driver,location,unload_date,tlength,ttype from truck_loader where driver_status = 1 ";
  $sql .= "and ".MakeDayList()." order by unload_month, unload_day";
  //$sql .= " order by unload_date";
  
  $res = $db->get_results($sql);
  if (!$res)
  {
    $s = "No drivers found at this time...";
  }
  else    
  {  
    $s  = "<table border='2'cellpadding='5'>\n";
    $s .= "<Caption><b>Driver Availability List<br>For more information contact us at (208) 845-0853</b></caption>\n";
    $s .= "<tr><th align='left'>Driver<th align='left'>Equipment<th align='left'>Unload Location<th>Unload Date</tr>\n";
    
    foreach($res as $rw)
    {
      $driver=strtoupper($rw->driver);
      if ($driver == '') continue;
      $location=strtoupper($rw->location);
      if ($location == '0') continue;
      $unloaddate = $rw->unload_date;
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
          
      $s .= "<tr><td align='left'>$driver<td align='left'>$equip<td align='left'>$location<td align='left'>$unloaddate</tr>\n";
    }
    $s .= "</table>\n";
  }
  $smarty->assign("drivers",$s);
}
ListDrivers();
GenerateSmartyPage();
?>
