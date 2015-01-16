<?php
ob_start();
include_once("xajax6beta2/xajax_core/xajax.inc.php");
$xajax = new xajax();
$xajax->configure('responseType','XML'); //For xajax 0.6
$xajax->configure('javascript URI', 'xajax6beta2/');

function DisplayDriver($dta){
  $resp = new xajaxResponse();
  $resp->alert($dta);
  return $resp;
}

//Function dispatcher.
function processEdit($op, $dta){
  
/*
  $resp = new xajaxResponse();
  $resp->alert(print_r($op,true));
  $resp->alert(print_r($dta,true));
  return $resp;
*/
  if ($op == 'update')
  	return UpdateDriver($dta);
  else if ($op == 'delete')
  	return DeleteDriver($dta);
  else if ($op == 'insert')
  	return AddDriver($dta);
  else if ($op == 'readdriver')
    return DisplayDriver($dta);
  else if ($op == 'swappages')
    return PageSwap($dta);
  else
  {
    $resp = new xajaxResponse();
    $resp->alert("Invalid edit operation code: $op");
    return $resp;
  }
}
$xajax->configure('debug',true);
$xajax->register(XAJAX_FUNCTION,'processEdit');
$xajax->processRequest();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<?php $xajax->printJavascript(); ?>
</head>
<body>
<center>
<input type="button" value="Go" onclick="xajax_processEdit('readdriver','Test Message');"/>
</center>
</body>
</html>