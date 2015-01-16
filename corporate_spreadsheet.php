<?php
/*
  Spreadsheet generation for corporate upload
  5/27/10 - Use +4 days on Fridays.
*/
require_once("commons.php");
require_once("utility.php");
require_once('includes/class_excel_writer.php');
require_once('includes/lbj.zipcode.class.php');
//$smarty->assign("pgtitle", "DAT Spreadsheet Generator"); 
//$smarty->assign("domenu", 1);
//Date range objects
$fromdate = new DateTime();
$todate = new DateTime();
//Handle the unload date format and range checking
function ConvertDate($uld)
{
  global $fromdate, $todate;
  $today = new DateTime();
	$dt = new DateTime($uld);
  if ($dt < $fromdate || $dt > $todate) return false;
	if ($dt < $today)
		return trim($today->format('m/d/Y'));
	else
    return trim($dt->format('m/d/Y'));
}
//Do the date range only once...
function SetDateRange()
{
  global $fromdate, $todate;
  $fromdate->modify("-2 day"); //2 days ago.
  $todate->modify("+5 day");
}
function SetupLocation($location,&$dcity, &$dstate)
{
	if ($location == '') return false;
	$location = strtolower($location);
	$i = strpos($location,','); //Normally city, state
	if ($i === false)
		$i = strripos($location, ' '); //Find the first space from the end.
	if ($i === false) return false; //Bad location
	$dcity = substr($location,0,$i);
	$dcity = ucfirst($dcity);
	$dstate = trim(substr($location,$i+1, 3));
	$dstate = strtoupper($dstate);
	return true;
}

function Generate()
{
	define("CONTACT","(208) 888-4822"); //The office number
  define("LOADMSG","DNC with less then 800 miles. NO CHEAP FREIGHT!");
	global $db, $fromdate, $todate; 
  SetDateRange();
  $hdl = fopen('DATLog.txt', 'w'); //reject log 
  $dt = date('M d,Y H:i');  
  fwrite($hdl, "DAT Generation Rejects Log for $dt\n\n");
  $from = $fromdate->format('M d');
  $to = $todate->format('M d');
  fwrite($hdl,"Processing unload dates from $from to $to.\n\n");
  
  global $res,$db,$excel, $qry;    
	$zipper = new loads_by_jake_zip_code_class();
	$zipper->base_zip = '0'; //Dummy zip for get a zip.
  //Construct the heading line.    
	
  $heads  = array("Avail","Truck","Origin-City","Or-St",
									"Or-Zip","Dest-City","De-St","De-Zip","F/P","Ft.",
									"KLbs","Stops","Commodity","Cube","Units","#Trucks",
									"Post For","Ref#","Contact","Comment 1","Comment 2");
  $excel->AddHeaderRow($heads);
  $sql = "select * from truck_loader where driver_status = 1";//All active drivers
  $res = $db->get_results($sql);
  $nrows = $db->num_rows;
  fwrite($hdl,"Selected $nrows active drivers.\n\n");    
  //Generate the contents.
  foreach ($res as $rw)
  {
      $s = array();
      //The truck # will go in the reference # column.
      $truck = trim($rw->truck_no);
      if ($truck == '0')
        $truck = ' ';

      //Extract the city and state from the location      
			//If no proper destinaton, skip the truck.
			$dcity= '';
			$dstate = '';
			$location = $rw->location;
      $driver = $rw->driver;
			if (false === SetupLocation($location,$dcity, $dstate))
      {
        fwrite($hdl,"$driver rejected. Bad Location: $location\n");
        continue; //Bad location.
      }
			
			//Convert the unload date to m/d/y form	
      $unload_date = trim($rw->unload_date_full);        
			$avail = ConvertDate($unload_date);
			if ($avail === false)
      {
        fwrite($hdl,"$driver rejected. $unload_date_full is out of range.\n");
       continue; //Bad dates Indy!
      }

			//Get the first zip code for the location.
      $zip = $rw->unload_zip;
      if ($zip == '')
      {
      $zipper->base_location = $location;
      $zipper->standardizeLocation();
      $location = $zipper->base_location;
			$zip = $zipper->GetAZip($location);
      }
			if ($zip == '0' || $zip == '')
      {
        fwrite($hdl,"$driver rejected. No Zip Code\n");
        continue; //Required field
      }
			$feet = $rw->tlength;
			$ttype = $rw->ttype;
			if ($ttype == '')
      {
        fwrite ($hdl,"$driver rejected. No Truck Type.\n");
        continue;
      }
			if (strtoupper($ttype) == 'STEP')
				$ttype = 'Step Deck';
			if (strtoupper($ttype) == 'RGN')
				$ttype = 'RG: Removeable Gooseneck';
			$user = $rw->userid;
			$user_rec = ReadUserRec($user);
			$username = $user_rec->user_name;
      //Create a row to add to the excel sheet
			if (true) //$zip != '00000')
      {
        Array_push($s,$avail); //Unload date
        //Array_push($s,$driver); //driver for testing only
        Array_push($s,$ttype); //Truck Type          
				Array_push($s,$dcity); //city
				Array_push($s,$dstate);
        Array_push($s,$zip);  //Unload Zip          
        Array_push($s,""); //Dest city - blank 
				Array_push($s,""); //Dest St - blank         
				Array_push($s,""); //Dest zip - blank
				Array_push($s,'Full'); //Full/partial - always full
				Array_push($s,$feet);//Truck length
				Array_push($s,""); //KLBS always blank
				Array_push($s,'1'); //Stops
				Array_push($s,""); //Commodity
				Array_push($s,""); //Cube
				Array_push($s,""); //Units
				Array_push($s,'1'); //#trucks
				Array_push($s,""); //Post for
				Array_push($s,$truck); //Ref # = truck #
				Array_push($s,CONTACT); //Office phone
				Array_push($s,LOADMSG);//5/13/10 - No cheap freight message
				Array_push($s,$username);	//User name for phone contact
        $excel->AddRow($s);
        fwrite($hdl,"$driver added to the list for $unload_date.\n");
      }
    } 
    fclose($hdl);   
		$fname = 'Trucks.xls';
    $excel->Generate('',$fname); //Generate the sheet
}
Generate();
  
//$xajax->configure('debug',true); //xajax debugger on/off control. Uncomment to turn on...
/*
$xajax->register(XAJAX_FUNCTION,'RunTheSpreadsheet');
$xajax->processRequest();
$dt = new DateTime();
$dt->modify("-2 day");
$smarty->assign("fromdate", $dt->format('Y/m/d'));
$dt->modify("+4 day");
$smarty->assign("todate", $dt->format('Y/m/d'));
GenerateSmartyPage();
*/
?>
