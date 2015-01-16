<?php
/*
  Handle quote requests from the outside.
*/
require_once("commons.php");
require_once("utility.php");
$smarty->assign("pgtitle", "Request a Load Quote"); 
$smarty->assign("domenu", 0);
//Check the required inputs.
function validateInputs($dta)
{
  $s = '';
  extract($dta);
  if ($contactname == '')
    $s .= "Contact Name\r";
  if ($phone == '')
    $s .= "Phone\r";
  if ($company == '')
    $s .= "Company\r";
  if ($commodity == '')
    $s .= "Commodity\r";
  if ($weight == '')
    $s .= "Weight\r";
  if ($origin == '')
    $s .= "Origin\r";
  if ($destination == '')
    $s .= "Destination\r";
  if ($loadtype == '')
  	$s .= "Type\r";
  if ($s != '')
    $s = "Please provide the following:\r" .$s;
  return $s;
}
//Main functionallity.
//Validate the input and do the email
function sendQuoteRequest($dta)
{
  $resp = new xajaxResponse();
  //Validate the required inputs.
	$s = validateInputs($dta);
  if ($s != '')
  {
    $resp->alert($s);
    return $resp;
  }
	extract($dta);
	//$to="edrobinsonjr@gmail.com"; //Testing
	$to = "jake@loadsbyjake.com"; //Recipient address
	$subject = "Load Quote Request";
	$s  = "Contact Name: $contactname\n";
	$s .= "Phone: $phone\n";
	$s .= "Email: $email\n";
	$s .= "Company: $company\n";
	$s .= "Commodity: $commodity\n";
	$s .= "Weight: $weight\n";
	$s .= "Origin: $origin\n";
	$s .= "Destination: $destination\n";
	$s .= "Load Type: $loadtype\n";
	if (is_array($lengths))
	{
		$s .= "Lengths: ";
		foreach($lengths as $len)
			$s .= $len.', ';
		$s .= "\n";
	}
	if ($comments != '')
	 $s .= "Comments: $comments\n";  
	$res = mail($to,$subject,$s);
	if (!$res)
		$resp->alert("Problem sending the email. Please call us.");
	else
		$resp->alert("Your request has been sent\nThanks  you for your inquiry");
	return $resp;


}
//Build the self loader dropdown
//Wants checkboxes...
function buildSelfLoaderList()
{
/*
  $s = "<select id='selfloadertruck' name='selfloadertruck'>\n";
  $s .= "<option value=''>--- Choose Length ---</option>\n";
  $s .= "<option value='0-50'>0-50 feet</option>\n";
  $s .= "<option value='55-65'>55-65 feet</option>\n";
  $s .= "<option value='70-75'>70-75 feet</option>\n";
  $s .= "<option value='80-85'>80-85 feet</option>\n";
  $s .= "<option value='90-95'>90-95 feet</option>\n";
  $s .= "<option value='100'>100 feet</option>\n";
  $s .= "<option value='105'>105 feet</option>\n";
  $s .= "<option value='110-115'>110-115 feet</option>\n";
  $s .= "<option value='120'>120 feet</option>\n";
  $s .= "</select>\n";
*/
	$s = '';
	$s .= "<input type='checkbox' id='l1' name=lengths[] value='0-50'/>0-50&nbsp";
	$s .= "<input type='checkbox' id='l2'  name=lengths[] value='55-65'/>55-65&nbsp";
	$s .= "<input type='checkbox' id='l3'  name=lengths[] value='70-75'/>70-75&nbsp";
	$s .= "<input type='checkbox' id='l4'  name=lengths[] value='80-85'/>80-85&nbsp";
	$s .= "<input type='checkbox' id='l5'  name=lengths[] value='90-95'/>90-95&nbsp";
	$s .= "<input type='checkbox' id='l6'  name=lengths[] value='100'/>100&nbsp";
	$s .= "<input type='checkbox' id='l7'  name=lengths[] value='105'/>105&nbsp";
	$s .= "<input type='checkbox' id='l8'  name=lengths[] value='110-115'/>110-115&nbsp";
	$s .= "<input type='checkbox' id='l9'  name=lengths[] value='120'/>120&nbsp";
	$s .= "<input type='checkbox' id='l9'  name=lengths[] value='Other'/>Other";
  return $s;
}  
$smarty->assign("selfloadertruck", buildSelfLoaderList());  
//$xajax->configure('debug',true);
$xajax->register(XAJAX_FUNCTION, "sendQuoteRequest");
$xajax->processRequest();
GenerateSmartyPage();
?>
