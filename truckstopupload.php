<?php
/*
  This module implements the InternetTruckstop.com's
  web service for posting trucks on their site from
  loadsbyjake.com.
  
  It uses the same selection logic as the corporate spreadsheet
  generator. Drivers/loads to deliver in -2 to +5 from today.
  
  For each qualified load it generates a soap request an sends it
  to the truckstop service. 
  
  It outputs each posting to the browser and updates the truckstop_id
  field in the drivers table. It sends the id if available.
  
  03-21-2012: Sending loads with the dummy load numbers. Filter them
  out.
  11/19/14: Changing to Aetna. Change creds and notes

*/
//System commons/configuration
require_once("commons.php");
ob_end_flush();
//System utilities
require_once("utilityV2.php");
//easywsdl generated classes for the truckstop posting api.
require_once('includes/easytruck.class.php');
//Date range objects
$fromdate = new DateTime();
$todate = new DateTime();
//A list of our truck ids currently on the Truckstop site.
//See GetOurTrucks();
$ourtrucks = array();
//Pieces to go in the SpecInfo field of the soap messages
define("CONTACT","(208) 888-4822"); //The office number
define("LOADMSG","Do not call with less then 800 miles. NO CHEAP FREIGHT!");

//Do the date range only once...
//Called from the end of this page before the main function
function SetDateRange()
{
  global $fromdate, $todate;
  $fromdate->modify("-2 day"); //2 days ago.
  $fromdate->SetTime(0,0,0);
  $todate->modify("+5 day");
  $todate->SetTime(23,0,0);
}
/*
  Handle the unload date formatting.
  Our dates are in YYYY-MM-DD format.
  The soap api wants YYYY-MM-DDTHH:MM:SS
  The Bluenote site currently uses PHP 5.2
  so we have to format it ourselves...
*/
function ConvertDate($uld)
{
  global $fromdate, $todate;
  $today = new DateTime();
  $today->setTime(0,0,0);
	$dt = new DateTime($uld);
	if ($dt < $today){
		return $today->format('Y-m-d').'T'.$today->format('H:i:s');
  }
	else{
    return $dt->format('Y-m-d').'T'.$dt->format('H:i:s');
  }
}
/*
    Get a list of our truck ids
    Using the GetTrucks API, we call for
    a list of trucks we currently 
    list on Truckstop.
    From this, we extract the id numbers into the
    array $ourtrucks.
    
    Used in main function to determine if we
    want to send an update or new request.
*/
function GetOurTrucks(){
  global $ourtrucks;
  $truckstop = new truckstop();
  $rb = new GetTrucks();
  $rb->listRequest = new ListRequest();
  try{
  $ro = new GetTrucksResponse();
  $ro = $truckstop->GetTrucks($rb);
  }catch(Exception $e){
    echo "<br>GetOurTrucks() failed";
    return false;
  }
  if (is_array($ro->GetTrucksResult->PostedTrucks->TruckPost)){
    for ($i=0;$i<count($ro->GetTrucksResult->PostedTrucks->TruckPost);$i++){
      $tid = $ro->GetTrucksResult->PostedTrucks->TruckPost[$i]->Id;
      $ourtrucks[] = $tid;
      
    }
//    echo 'Our posted truck numbers:<br/>';
//    print_r($ourtrucks,true);
  }
  return true;
}

//Extract the city and state from the location
//Extract city, state to city and state.
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
//Map our truck type to truckstop type
//See acceptable type codes in their api doc.
//Forgive me this hack!
function MapTruckType($ttype){
  if ($ttype == 'Step')
    return 'SD';
  else if ($ttype == 'Flatbed')
    return 'F';
  else if ($ttype == 'Refer')
    return 'R';
  else if ($ttype == 'Lowboy')
    return 'LB';
  else if ($ttype == 'Van')
    return 'V';
  else if ($ttype == 'RGN')
    return 'RGN';
  else if ($ttype == 'DD RGN')
    return 'DD';
  else if ($ttype == 'Step Deck')
    return 'SD';
  else 
    return '';
}
//Main function
function PostOurTrucks()
{
  global $ourtrucks;
  //Load a list of our trucks currently posted.
  if(!GetOurTrucks()){
    echo 'Get trucks Failed...';
    die;
  }

  $debugging = false; //Controls debug output to the browser
  //Instance the truckstop api class
  $truckstop = new truckstop();
	
  $oid = $_SESSION['officeid']; //Will filter by office
	
  global $db,$res, $fromdate, $todate; 
  echo '<h2>Truckstop.com Upload Processing</h2>';
  $hdl = fopen('TruckstopLog.txt', 'w'); //Upload log 
  $dt = date('M d,Y H:i');  
  fwrite($hdl, "Truckstop Generation Rejects Log for $dt\n\n");
  $from = $fromdate->format('M d');
  $to = $todate->format('M d');
  fwrite($hdl,"Processing unload dates from $from to $to.\n\n");
  
  $fd = $fromdate->format('Y-m-d');
  $to = $todate->format('Y-m-d');
  $td = $todate->format('Y-m-d');	
  echo '<h5>For loads delivering from '.$fd.' To '.$td.'</h5><br/>';

  //Query our local drivers and loads from this office
  //where the drivers are active and delivery date is in
  //the date range.
  $sql  = "select drivers.*, loads.* ";
  $sql .= "from drivers,loads ";
  $sql .= "where drivers.status = 'Active' and drivers.officeid = $oid";
  $sql .= " and drivers.loadid = loads.id";
  $sql .= " and loads.delivery_date >= '$fd'";
  $sql .= " and loads.delivery_date <= '$td'";
  fwrite($hdl,$sql."\n\n");
  
  $res = $db->get_results($sql);
  if (!$res){
    echo '<h2>No Trucks Qualify at This Time...</h2>';
    exit;
  }
  $nrows = $db->num_rows;
  fwrite($hdl,"Selected $nrows active drivers.\n\n");    
  
  //Generate the contents.
  $response = new PostTrucksResponse();
  $numtrucks = 0;
  $dumpdone = false;
  foreach ($res as $rw)
  {
      if ($debugging){
        if (!$dumpdone){
          print_r($rw);
          $dumpdone = true;
        }
      }
      //03-21-2012 - dummy load number fix
      //Assumtion: if over 8 chars. long, bag it.
	  //8/13/13 - not used remove load number check.
      // $loadnum = $rw->load_number;
      // if (strlen($loadnum) > 8)
      // { 
        // fwrite($hdl,"$driver rejected. Invalid load number: $loadnum\n");
        // //echo "$driver rejected. Invalid load number: $loadnum<br/>";
        // continue;
      // }
      //Extract the city and state from the location      
			//If no proper destinaton, skip the truck.
			$dcity= '';
			$dstate = '';
			$location = $rw->delivery_location;
      $driver = $rw->name;
			if (false === SetupLocation($location,$dcity, $dstate))
      {
        fwrite($hdl,"$driver rejected. Bad Location: $location\n");
        echo "$driver rejected. Bad Location: $location.<br/>";
        continue; //Bad location.
      }
			
			//Convert the unload date to the soap format
      $unload_date = $rw->delivery_date;        
			$avail = ConvertDate($unload_date);
			if (gettype($avail) != 'string')
      {
        fwrite($hdl,"$driver rejected. $unload_date is out of range or invalid.\n");
        continue; //Bad dates Indy!
      }
			$feet = $rw->tlength;
			$ttype = $rw->ttype;
			if ($ttype == '')
      {
        fwrite ($hdl,"$driver rejected. No Truck Type.\n");
        echo "$driver rejected. No truck type.<br/>";
        continue;
      }
      $ttype = MapTruckType($ttype);
      if ($ttype == '')
      {
        fwrite($hdl,"$driver rejected. Truck type $ttype is not valid.\n");
        echo "$driver rejected. Truck type $ttype is not valid.<br/>";
        continue; //Bad dates Indy!
      }
			$driverrec = GetDriverByName($driver);
      $user = $driverrec['agentid'];
      //echo $user;
      //Read this driver's assigned user.
      //$user = $rw->agentid;
	  $user_rec = ReadUserRec($user);
	  $username = $user_rec->user_name;
      //$username = $username ."\n".LOADMSG; //Message removed 11/19/14
      
      $ourtruckid = $rw->truckstop_id;

      //Instance the output classes.
      $request = new PostTrucks();
      $request->trucks = new trucks();
      //Instance and Populate a Truck object
      $tr = new Truck();
      $tr->DateAvailable = $avail;
      $tr->OriginCity = $dcity;
      $tr->OriginState = $dstate;
      $tr->OriginCountry = 'USA';
      $tr->EquipmentType = $ttype;
      $tr->IsLoadFull = 1;
      $tr->OriginRadius = 200;
      $tr->MinDistance = 800;
      $tr->Quantity = 1;
      $tr->TruckID = 0;
      //Include the stored id if still on truckstop site.
      if (in_array($ourtruckid,$ourtrucks))
          $tr->TruckID = $ourtruckid;
      $tlength = $rw->tlength;
      
      if($tlength != '')
        $tr->Length = $tlength;
      //04-30-2012 use "Notes"
      $tr->SpecInfo = $username;
      //Add the truck to the posting object
      $request->trucks->Trucks[] = $tr;
      if ($debugging){
        print_r($request); 
        echo '<br>-----<br><br>';
      }
      //Ship the request, read the response
      try{
        $response = $truckstop->PostTrucks($request);
        if ($debugging){
          print_r($response);
          echo '<br>-----<br><br>';
        }
      }catch(Exception $e){
        echo "<h2>Error. $driver not posted. Interface Error.</h2>";
        echo "<h2>Please copy and email this to the developer...</h2>"; 
        echo $e->getMessage();
        echo '<br/><br/>Request Headers:<br/>';
        echo '<pre>'.$truckstop->soapClient->__getLastRequestHeaders().'</pre>';
        echo '<br/><br/>Request:<br/>';
        echo '<pre>'.$truckstop->soapClient->__getLastRequest().'</pre>';
        echo '<br/>Response Headers:<br/>';
        echo '<pre>'.$truckstop->soapClient->__getLastResponseHeaders().'</pre>';
        echo '<br/>Response:<br/>';
        echo '<pre>'.$truckstop->soapClient->__getLastResponse().'</pre>';
        continue;
      }
      $numtrucks++;
      fwrite($hdl,"$driver added to the list for $unload_date.\n");
      
      
      echo "<br/>$driver posted to Truckstop for load $loadnum.<br/>";
      //Dump any returned errors
      if (is_array($response->PostTrucksResult->Errors)){
        foreach($response->PostTrucksResult->Errors as $er)
          echo '<br/><br/>Error Message: '.$er->ErrorMessage.'<br/>';
      }
      else{
        //Get the truckstop assigned id number
        //if (is_array($response->PostTrucksResult->TruckIds)){
          foreach($response->PostTrucksResult->TruckIds as $v){
            $truckid = $v;
            if($debugging)
              print_r($truckid);
        }
        //}//
        //Update the load record if  received id != stored value
        if ($rw->truckstop_id != $truckid){
          $lid = $rw->load_number;
          $sql = "update loads set truckstop_id = $truckid where load_number = '$lid'";
          $db->query($sql);
        }
      }
    //if ($debugging) break; //Just one when debugging  
    } 
    //Close the log file...
    fclose($hdl);
    if (!$numtrucks){
      echo '<h2>No Trucks Uploaded</h2>';
      exit;
    } 
    else
      echo "<h2>$numtrucks posted...</h2>";
}
SetDateRange(); //Setup the to and from dates -2 to + 5 days from today
PostOurTrucks();     //Do it...
?>
