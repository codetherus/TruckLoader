<?php
/*
  Truck load page.
  Each driver has none or more loads linked to them.
*/
require_once("commons.php");
require_once("utilityV2.php");
$smarty->assign("pgtitle", "Load Management"); 
$smarty->assign("domenu", 1);
$smarty->assign("dosearch",1);
$set = '';
SetAlertCaption("Load Management");
include("includes/zend_reminders_overlay.php");
function GetCheckCalls($id)
{
  global $db;
  $sql = "select * from call_checks where loadid = $id";
  $res = $db->get_results($sql);
  if (!$res) return "No Call Checks. id=$id\n";
  $s = '';
  foreach($res as $row)
  {
    $agent = ReadAgent($row->agentid);
    $s .= $row->time_stamp;
    $s .= "  $agent->user\n";
    $s .= $row->notes."\n";
  }
  return $s;
}

/*
  DisplayLoad can be called 2 ways:
  1. From the browser - the ldid field contains the load record if $local is zero.
  2. From within - $dta is the load row id and $local is non-zero;
*/
function DisplayLoad($dta, $local=0)
{
  global $db;
  $resp = new xajaxResponse();
  if ($local == 0)
    $id = $dta['ldid'];
  else
    $id = $dta;
  $row = GetLoad($id);
  //$resp->alert(print_r($row,true));
  $driver = GetDriver($row->driverid);
  //$resp->alert(print_r($driver, true));
  $agent = readAgent($row->agentid);
 
  $resp->assign("load_number", "value", $row->load_number);
  $resp->assign("ldid","value", $row->id); //Hide for updates.  
  $resp->assign("drid","value", $row->driverid);//Hidden for page swaps
  $resp->assign("driver_name", "value", $driver->name);
  $resp->assign("latiagent","innerHTML",AgentSelectGenerate($row->agentid));
  $resp->assign("booking_date", "value", $row->booking_date);
  $resp->assign("pickup_date", "value", $row->pickup_date);
  $resp->assign("delivery_date", "value", $row->delivery_date);
  $resp->assign("pickup_location","value",$row->pickup_location);
  $resp->assign("delivery_location", "value", $row->delivery_location);
  $resp->assign("line_haul","value",$row->line_haul);
  $resp->assign("accessorial","value",$row->accessorial);
  $resp->assign("gross","value",$row->gross);
  $resp->assign("brokerageid","value",$row->brokerageid);
  $resp->assign("broker_agent","value",$row->broker_agent);
  $resp->assign("broker_phone","value",$row->broker_phone);
  $resp->assign("broker_notes","value",$row->broker_notes);
  $resp->assign("load_experience","value",$row->load_experience);
  $resp->assign("load_notes","value",$row->load_notes);
  $resp->assign("agent_phone","value",$row->agent_phone);
  $resp->assign("phone_numbers","value", GetPhones($driver->id));
  $resp->assign("reminderta","value", GetReminders($row->driverid,$row->id));
  if ($row->dispatched == 1)
    $resp->assign("dispatched","checked",true);
  else
    $resp->assign("dispatched","checked",false);
  if ($row->addtocontracts == 1)
    $resp->assign("addtocontracts","checked",true);
  else
    $resp->assign("addtocontracts","checked",false);
  $resp->assign("check_calls","value", GetCheckCalls($id));
  return $resp;
}

function UpdateRecord($dta){
  global $db, $set;
  $uid = $_SESSION['userid'];	
  extract($dta);
  //Adjust the checkbox values
  $dispatched = CheckCheck($dispatched);
  $addtocontracts = CheckCheck($addtocontracts);
  
  $load = GetLoad($ldid);
  if (!$load)
    return xajaxAlert("Update failed. Unable to read the load record.");
  if ($load_number == '')
    return xajaxAlert("Update failed. Load number may not be blank.");
  $set = '';
  compare('load_number',$load_number,$load->load_number);
  compare('booking_date',$booking_date,$load->booking_date);
  compare('pickup_date',$pickup_date,$load->pickup_date);
  compare('delivery_date',$delivery_date, $load->delivery_date);
  compare('pickup_location',$pickup_location,$load->pickup_location);
  compare('delivery_location',$delivery_location,$load->delivery_location);
  compare('line_haul',$line_haul,$load->line_haul);
  compare('accessorial',$accessorial,$load->accessorial);
  compare('gross',$gross,$load->gross);
  compare('brokerageid',$brokerageid,$load->brokerageid);
  compare('broker_agent',$broker_agent,$load->broker_agent);
  compare('broker_phone',$broker_phone,$load->broker_phone);
  compare('load_experience',$load_experience,$load->load_experience);
  compare('load_notes', $load_notes,$load->load_notes);
  compare('dispatched',$dispatched,$load->dispatched);
  compare('addtocontracts',$addtocontracts,$load->addtocontracts);
  compare('broker_notes',$broker_notes,$load->broker_notes);
  compare('agent_phone',$agent_phone,$load->agent_phone);
  compare('agentid', $agents, $load->agentid);
  if ($set == '')
    return xajaxAlert("Not Updated. No changes detected.");
    
  $sql = "update loads set $set where id = $ldid";
  QueryLog($uid."-".$sql); //Troubleshoot the queries
  $db->query($sql);
  return xajaxAlert("Load record updated.");
}
//Get a load by number and pass its id to the main display routine.
function DisplayLoadByName($dta)
{
  global $db;
  $load_number = $dta['load_number'];
  $sql = "select * from loads where load_number = '$load_number'";
  $row = $db->get_row($sql);
  $dta['ldld'] = $row->id;
  return DisplayLoad($row->id, 1);
}
//Add a new load to the db.
function NewLoad($dta){
  global $db;
  $oid = $_SESSION['officeid'];
  $resp = new xajaxResponse();
  foreach($dta as $x)
    $x = quote_smart($x);
  extract($dta);
  if ($load_number == '')
    return xajaxAlert("Load Number is required.");  
  $load = GetLoadByNumber($load_number);
  if ($load['load_number'] == $load_number)
    return xajaxAlert("This load Number is already in use.");

  $driver_rec = GetDriverByName($driver_name);
  if (!$driver_rec)
    return xajaxAlert("A valid driver name is required.");
  $driverid = $driver_rec['id'];
  $dispatched = CheckCheck($dispatched);
  $addtocontracts = CheckCheck($addtocontracts);
  //Make sure there is an agent id. Default to the driver's agent
  if ($agents == '')
    $agents = $driver_rec['agentid'];
  if ($agents == '')
    $agents = 0;
  //Make sure the floats have values.
  if ($line_haul == '')
    $line_haul = 0;
  if ($accessorial == '')
    $accessorial = 0;
  if ($gross == '')
    $gross = 0;
  $sql  = "insert into loads (load_number,driverid,agentid,booking_date,dispatched,pickup_date,delivery_date, ";
  $sql .= "pickup_location,delivery_location,line_haul,accessorial,gross,brokerageid,broker_agent,broker_phone, ";
  $sql .= "addtocontracts,broker_notes,load_notes,load_experience,load_options,driver_name,officeid,agent_phone) ";
  
  $sql  .= "values ('$load_number',$driverid,$agents,'$booking_date',$dispatched,'$pickup_date','$delivery_date', ";
  $sql .= "'$pickup_location','$delivery_location',$line_haul,$accessorial,$gross,'$brokerageid','$broker_agent','$broker_phone', ";
  $sql .= "$addtocontracts,'$broker_notes','$load_notes','$load_experience','$load_options','$driver_name',$oid,'$agent_phone')";
  $uid = $_SESSION['userid'];
  QueryLog($uid."-".$sql);
  $db->query($sql);
  $ldid = $db->insert_id;
  
  if ($ldid < 1)
    return xajaxAlert("Load Insert Failed");
  //Update the driver
  $sql = "update drivers set loadid = $ldid where id = $driverid";
  $db->query($sql);
  $resp->loadCommands(xajaxAlert("Load Added"));
  $resp->assign("ldid","value",$ldid);
  $resp->assign("drid","value",$driverid);
  return $resp;
}

function LoadHistory($dta)
{
  global $db;
  $driverid = $dta['drid'];    
  $sql = "select * from loads where driverid = $driverid";  
  $res = $db->get_results($sql);  
  if (!$res)  
    return xajaxAlert("No loads found for this driver.");    
  $s = "<table border='1' style='color: black;'>\n";  
  $s .= "<tr><th>Load Number<th>Pickup Date<th>Source<th>Delivery Date<th>Destination<th></tr>\n";  
  foreach($res as $rw)  
  {  
    $id = $rw->id;
    $link = "<a href='#' onclick='fb.end();xajax_DisplayLoad($id, 1);'>$rw->load_number</a>\n";    
    $s .= "<tr><td>$link<td>$rw->pickup_date<td>$rw->pickup_location<td>$rw->delivery_date<td>$rw->delivery_location</tr>\n";    
  }  
  $s .= "</table>\n";  
  return GenFloatbox($s);  
}
//Build a select list of the brokerage's agents
function BrokersAgentList($co){
  global $db;
  $sql = "select id, agent_name from broker_agents where brokerid = $co";
  $res = $db->get_results($sql);
  if (!$res) return '&nbsp;';
  $s = "<select id='broker_agent' name='broker_agent' onchange='xajax_AgentBrokerInfo(this.value)'>\n";
  $s .= "<option value=''>&nbsp</option>\n";
  foreach ($res as $rw){
    $id = $rw->id;
    $nm = $rw->agent_name;
    $s .= "<option value='$id'>$nm</option>\n";
  }
  $s .= "</select>\n";
  return $s;
}
//Get the brokerage information and
//The brokerage agent list
function BrokerInfo($dta){
  global $db;    
  $resp = new xajaxResponse(); 
  $_SESSION['brokerid'] = ''; //For the agent lookups 
  $co = $dta['brokerageid'];
  if ($co == '')  
    return $resp;
       
  $sql = "select * from brokers where company = '$co'"; 
  $res = $db->get_row($sql); 
  if ($res === false)  
    return xajaxAlert("Broker not foud.","Get Broker Info"); 
  $resp->assign("broker_phone","value",$res->phone);
  $resp->assign("broker_notes","value",$res->notes);
  $_SESSION['brokerid'] = $res->id;
  //$resp->assign("lbroker_agent","innerHTML",BrokersAgentList($res->id));  
  return $resp;    
}
//Populate the broker agent info on screen.
function AgentBrokerInfo($id){
  global $db;
  $resp = new xajaxResponse();
  $sql = "select * from broker_agents where id = $id";
  $rw = $db->get_row($sql);
  if (!$rw)
    $resp->assign("agent_phone","value","");
  else
    $resp->assign("agent_phone","value",$rw->agent_phone);
  return $resp;
  
}
//Service the onblur of the broker agent name
function BrokerAgentInfo($agentname,$brokername){
  global $db;
  $resp = new xajaxResponse(); 
  $sql = "select * from brokers where company = '$brokername'";
  $rw = $db->get_row($sql);
  $bid = $rw->id; 
  $sql = "select * from broker_agents where agent_name = '$agentname' and brokerid = $bid";  
  QueryLog($sql);
  //return ShowData($sql);
  $rw = $db->get_row($sql);
  if (!$rw)  
    $resp->assign("agent_phone","value","");    
  else
    $resp->assign("agent_phone","value",$rw->agent_phone);
  return $resp;
}
function BrokerList($bid=''){
  global $db;
  $sql = "select company, id from brokers order by company";
  $res = $db->get_results($sql);
  if (!$res) return '';
  $s = "<select name='brokerlist' id='brokerlist'>\n";
  $s .=  "<option value=''>&nbsp;</option>\n";
  foreach($res as $rw){
    $co = $rw->company;
    $id = $rw->id;
    $s .= "<option value='$id' ";
    if ($id == $bid)
      $s .= "selected";
    $s .= ">$co</option>\n";
  }
  $s .= "</select>";
  return $s;
}

//Setup the broker agent overlay
function BrokerAgentInitialze($dta){
  $resp = new xajaxResponse();
  $resp->assign("lbrokerage","innerHTML", BrokerList());
  return $resp;
}
//Process the broker agent ovrlay
function BrokerAgentProcess($dta){
  global $db;
  extract($dta);
  //Lookup the agent
  $sql = "select * from broker_agents where agent_name = '$agent_name' and brokerid = $brokerlist";
  $rw = $db->get_row($sql);
  //Insert if not found
  if (!$rw){
    $sql = "insert into broker_agents(brokerid,agent_name,agent_phone,agent_fax,agent_email)
           values($brokerlist,'$agent_name','$oagent_phone','$agent_fax','$agent_email')";
   $db->query($sql);
   QueryLog($sql);
   if ($db->rows_affected > 0)
      return xajaxAlert("Broker agent added...");
   else
      return xajaxAlert("Failed to insert broker agent...");
  }
  else { //Update
    $sql = "update broker_agents set agent_phone = '$oagent_phone',
           agent_fax = '$agent_fax', agent_email= '$agent_email'
           where agent_name = '$agent_name' and brokerid = $brokerlist";
    QueryLog($sql);
    $db->query($sql);
    return xajaxAlert("Broker agent updated...");
  }
}
//Process the broker overlay.
function BrokerProcess($dta){
  //return ShowData($dta);
  global $db;
  extract($dta);
  $sql = "select * from brokers where company = '$company'";
  $rw = $db->get_row($sql);
  if (!$rw){
    $sql = "insert into brokers(company,address1,address2,city,state,zip,phone,cell,fax,notes) 
            values('$company','$address1','$address2','$city','$state','$zip','$phone','$cell','$fax','$notes')";
   $db->query($sql);
   QueryLog($sql);
   if ($db->rows_affected > 0)
      return xajaxAlert("Broker added...");
   else
      return xajaxAlert("Failed to insert broker...");
  }
  else{
    $id=$rw->id;
    $sql="update brokers set company='$company',address1='$address1',address2='$address2',city='$city',
                             state='$state',zip='$zip',phone='$phone',cell='$cell',fax='$fax',notes='$notes' 
                              where id=$id";        
    QueryLog($sql);
    $db->query($sql);
    return xajaxAlert("Broker updated...");
  }
}

function BrokerRead($dta){
  global $db;
  extract($dta);
  $sql = "select * from brokers where company = '$company'";
  $rw = $db->get_row($sql);
  if (!$rw)
    return xajaxAlert('Broker not found...');
  $resp = new xajaxResponse();
  $resp->assign('address1','value',$rw->address1);
  $resp->assign('address2','value',$rw->address2);
  $resp->assign('city','value',$rw->city);
  $resp->assign('state','value',$rw->state);
  $resp->assign('zip','value',$rw->zip);
  $resp->assign('phone','value',$rw->phone);
  $resp->assign('cell','value',$rw->cell);
  $resp->assign('fax','value',$rw->fax);
  $resp->assign('notes','value',$rw->notes);
  return $resp;
}
//Display the driver page of the current load.
function PageSwap($dta)
{
  $resp = new xajaxResponse();  
  $_SESSION['swapid'] = $dta['drid']; //Setup so the driver page knows about the swap;  
  $resp->redirect("drivers.php");  
  return $resp;
}

//See if the driver page called for a swap.
function CheckPageSwap()
{
  $resp = new xajaxResponse();
  if ($_SESSION['swapid'] != '')  
  {
    $id = $_SESSION['swapid'];    
    $_SESSION['swapid'] = '';    
    return DisplayLoad($id, 1);
  }
  else  
    return $resp;        
}


//Edit procedure dispatcher.
function processEdit($op, $dta)
{
  $resp = new xajaxResponse();
  if ($op == 'update')
  	return UpdateRecord($dta);
  else if ($op == 'delete')
  	return DeleteRecord($dta);
  else if ($op == 'display')
    return DisplayLoad($dta);
  else if ($op == 'displaybyname')
    return DisplayLoadByName($dta);
  else if ($op == 'swappages')
    return PageSwap($dta);
  else if ($op == 'insert')
    return NewLoad($dta);
  else if ($op == 'loadhistory')
    return LoadHistory($dta);
  else if ($op == 'brokerinfo')
    return BrokerInfo($dta);
  else if ($op == 'brokeragentinfo')
    return BrokerAgentInfo($dta);
  else if ($op == 'initbrokeragent')
    return BrokerAgentInitialze($dta);
  else if ($op == 'processagent')
    return BrokerAgentProcess($dta);
  else if ($op == 'processbroker')
    return BrokerProcess($dta);
  else if ($op == 'readbroker')
    return BrokerRead($dta);

  else
  	return xajaxAlert("Invalid edit operation code: $op");
}

//$xajax->configure('debug',true); //xajax debugger on/off control. Uncomment to turn on...
$xajax->register(XAJAX_FUNCTION,'processEdit');
$xajax->register(XAJAX_FUNCTION,'CheckPageSwap');
$xajax->register(XAJAX_FUNCTION,'DisplayLoad');
$xajax->register(XAJAX_FUNCTION,'AgentBrokerInfo');
$xajax->register(XAJAX_FUNCTION,'BrokerAgentInfo');
$xajax->processRequest();
$smarty->assign("atiagent",AgentSelectGenerate());
$smarty->assign("freqlist",ReminderFrequencyList());
GenerateSmartyPage();
?>