<?php
/*
  Spreadsheet generation for corporate upload
  7/01/10 - New version for new site
*/
require_once("commons.php");
require_once("utilityV2.php");
require_once('includes/class_excel_writer.php'); //Excel generator
require_once('includes/lbj.zipcode.classv2.php');//Zipcode handler

//Date range objects and establish the date range
$fromdate = new DateTime();
$fromdate->modify("-2 day"); //2 days ago.
$todate = new DateTime();
$todate->modify("+5 day");   //5 days hence.

//Handle the unload date format.
//If unload date < today, use today.
function ConvertDate(&$uld)
{
  global $fromdate, $todate;
  $today = new DateTime();
  $uld = str_replace('-','/',$uld);
	$dt = new DateTime($uld);
  if ($dt < $today)
		return trim($today->format('m/d/Y'));
	else
    return trim($dt->format('m/d/Y'));
}

//Given 'city, st', return them in separate variables.
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
/*
Main function

Uses the Excel class instanced at the top of the page.
Uses the zip code class declared within.

1. Setup the date range. -2 to +5 days
2. Open the log file.
3. Instance the zip code class for obtaining zip codes from locations.
4. Generate and output the Excel header row
5. Query the database for loads and their drivers.
6. Process each row returned.
    a. Qualify it
    b. Add it to the Excel object
7.  Generate the Excel file.

The sheet can be displayed or saved using the resulting dialog.
*/
function Generate()
{
	global $db, $fromdate, $todate; 
  global $res,$db,$excel, $qry;    
  $oid = $_SESSION['officeid'];
  define("CONTACT","(208) 888-4822"); //The office number
  define("LOADMSG","DNC with less then 800 miles. NO CHEAP FREIGHT!");
	
  //SetDateRange();

  //Setup the log file
  $hdl = fopen('DATLog.txt', 'w'); //reject log 
  $dt = date('M d,Y H:i');  
  fwrite($hdl, "DAT Generation Rejects Log for $dt\n\n");

  $from = $fromdate->format('Y/m/d');
  $to = $todate->format('Y/m/d');
  fwrite($hdl,"Processing unload dates from $from to $to.\n\n");
  
  //Instance the zip code class
	$zipper = new loads_by_jake_zip_code_class();
	$zipper->base_zip = '0'; //Dummy zip for get a zip.

  //Construct the heading line and add it to the excel object.    
  $heads  = array("Avail","Truck","Origin-City","Or-St",
									"Or-Zip","Dest-City","De-St","De-Zip","F/P","Ft.",
									"KLbs","Stops","Commodity","Cube","Units","#Trucks",
									"Post For","Ref#","Contact","Comment 1","Comment 2");
  $excel->AddHeaderRow($heads);
  
  //DB query want all loads for active drivers from this office
  //with loads in the date range
  $lowdate = $fromdate->format('Y/m/d');
  $highdate = $todate->format('Y/m/d');
  
  $sql  = "select loads.*, drivers.* ";
  $sql .= "from loads, drivers ";
  $sql .= "where drivers.status = 'Active' and drivers.officeid = $oid";
  $sql .= " and loads.driverid = drivers.id";
  $sql .= " and delivery_date >= '$lowdate' and delivery_date <= '$highdate'";

  fwrite($hdl,$sql."\n\n");

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
			$location = $rw->delivery_location;
      $driver = $rw->name;
     
      //Check out of office loads
      $load = $rw->load_number;
      $prefix = strtoupper(substr($load,0,2));
      if ($prefix == 'NA')
      {
        fwrite($hdl,"$driver rejected. Out of office load $load\n");  
        continue;
      }

			//Setup the destination city and state
      //Reject for bad location
      if (false === SetupLocation($location,$dcity, $dstate))
      {
        fwrite($hdl,"$driver rejected. Bad Location: $location\n");
        continue;
      }
			
			//Convert the unload date to m/d/y form	
      //And reject if out of range.
      $unload_date = $rw->delivery_date;        
			$avail = ConvertDate($unload_date);
			if ($avail === false)
      {
        fwrite($hdl,"$driver rejected. $unload_date is out of range.\n");
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
			
      //Reject missing or invalid zip
      if ($zip == '0' || $zip == '')
      {
        fwrite($hdl,"$driver rejected. No Zip Code\n");
        continue; //Required field
      }
			
      //Driver trailer details
      $feet = $rw->tlength;
			$ttype = $rw->ttype;
			if ($ttype == '')
      {
        fwrite ($hdl,"$driver rejected. No Truck Type.\n");
        continue;
      }
      
      //Map the trailer type to DAT standards
			if (strtoupper($ttype) == 'STEP')
				$ttype = 'Step Deck';
			if (strtoupper($ttype) == 'RGN')
				$ttype = 'RG: Removeable Gooseneck';
			//Get the office agent name
      $user = $rw->agentid;
			$user_rec = ReadUserRec($user);
			$username = $user_rec->user_name;
      //Create a row and add it to the excel sheet
      Array_push($s,$avail);        //Unload date
      Array_push($s,$ttype);        //Truck Type          
			Array_push($s,$dcity);        //city
			Array_push($s,$dstate);       //state
      Array_push($s,$zip);          //Unload Zip          
      Array_push($s,"");            //Dest city - blank 
			Array_push($s,"");            //Dest St - blank         
			Array_push($s,"");            //Dest zip - blank
			Array_push($s,'Full');        //Full/partial - always full
			Array_push($s,$feet);         //Truck length
			Array_push($s,"");            //KLBS always blank
			Array_push($s,'1');           //Stops
			Array_push($s,"");            //Commodity
			Array_push($s,"");            //Cube
			Array_push($s,"");            //Units
			Array_push($s,'1');           //#trucks
			Array_push($s,"");            //Post for
			Array_push($s,$truck);        //Ref # = truck #
			Array_push($s,CONTACT);       //Office phone
			Array_push($s,LOADMSG);       //5/13/10 - No cheap freight message
			Array_push($s,$username);	    //User name for phone contact
      $excel->AddRow($s);
      fwrite($hdl,"$driver added to the list for $unload_date. Load: $load Truck: $truck\n");
      
    } 
    fclose($hdl);   
		$fname = 'Trucks.xls';
    $excel->Generate('',$fname); //Generate the sheet
}
Generate();
?>
