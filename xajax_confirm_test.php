<?php
/*
	xajax response confirm example.
*/
include_once("xajax/xajax_core/xajax.inc.php");
$xajax = new xajax();
$xajax->configure('javascript URI', 'xajax/');

//Called from the response to the confirm box
function continue_on($status)
{
	$resp = new xajaxResponse();
	
	if ($status==true)
		$resp->alert('You OK\'ed');
	elseif ($status==false)
		$resp->alert('You Cancelled');
	return $resp;
}

//Calls a js function that generates a confirm 
//dialog and sends the result to continue_on() above.
function ask()
{
	$resp = new xajaxResponse();	
	$resp->script("askUser('Continue?')");
	return $resp;
}

$xajax->register(XAJAX_FUNCTION, 'continue_on');
$xajax->register(XAJAX_FUNCTION, 'ask');
$xajax->processRequest();
?>
<!DOCTYPE html>
<html>
<head>
<title>Xajax Comfirm Test</title>
<?php $xajax->printJavascript(); ?>

<script>
//Do a confirm with the prompt 
//passed and send the result back to
//the server page.
function askUser(prompt)
{
	res = confirm(prompt);
	xajax_continue_on(res);
}
</script>

</head>
<body>
<input type="button" value="Call for Confirm" onclick="xajax_ask()"/><br>
</body>
</html>
