<?php
/*
  Drivers  Email management page
*/
require_once("commons.php");
require_once("utilityV2.php");
$smarty->assign("pgtitle", "Send Email to Drivers"); 
$smarty->assign("domenu", 1); //Menu control
$smarty->assign("dosearch",0); //Global search tool control
$set = ''; //kv pairs for update query
SetAlertCaption("Send Email to Drivers");

function SetupEmail(){
  global $db;
  $did = $_SESSION['current_driver_id'];
  $driver = GetDriver($did);
  if (!$driver)
    return xajaxAlert("Unable to find the driver record...");
  $resp = new xajaxResponse();
  $resp->assign("driverid","value",$did);
  $resp->assign("mailto","value",$driver->name);
  $email = GetPhoneValue($did,'Driver','Email');
  if ($email)
    $resp->assign("demail","value",$email);
  else
    $resp->assign("demail","value","No Email Defined");
    
  return $resp;
}
function ValidateEmailInputs($dta){
  $s = '';
  extract($dta);
  if ($demail == ''|| $demail == 'No Email Defined')
    $s .= "Email Address, ";
  if ($esubject == '')
    $s .= "Subject, ";
  if ($emessage == '')
    $s .= "Message Body";
  if ($s != '')
    $s = "Please fix the following: $s";
  return $s;  
}

function SendEmail($dta){
  //return ShowData($dta);
  $s = ValidateEmailInputs($dta);
  if ($s != '')
    return xajaxAlert($s);
  extract($dta);
  $emessage = wordwrap($emessage, 70);
  
  $uid = $_SESSION['userid'];
  $user = ReadUserRec($uid);
  $uemail = $user->email;
  if ($uemail == '')
    return xajaxAlert("No email defined for this user...");
  $headers = "From: $uemail\r\n";
  $headers.= "Reply_To: $uemail\r\n";
  $res = mail($demail, $esubject, $emessage, $headers);
  if ($res === true)
    return xajaxAlert("Email Sent...");
  else
    return xajaxAlert("Failed to send email");
}


//$xajax->configure('debug',true); //xajax debugger on/off control. Uncomment to turn on...
$xajax->register(XAJAX_FUNCTION,'SendEmail');
$xajax->register(XAJAX_FUNCTION,'SetupEmail');
$xajax->processRequest();
//Initial display values.
GenerateSmartyPage();
?>