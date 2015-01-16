<?php
require_once ("xajax/xajax_core/xajax.inc.php");
$xajax = new xajax();
function Testing($dta)
{
$newContent = $dta['contact'][0];
  $objResponse = new xajaxResponse();
  $objResponse->assign("testDiv","innerHTML", $newContent);
  $objResponse->alert(print_r($dta,true));
  return $objResponse;
}
//$xajax->setFlag('debug', true);
$xajax->registerFunction("Testing");  //Register the function
$xajax->processRequest(); //Call the XAJAX engine 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php $xajax->printJavaScript('xajax/'); ?>
</head>
<body>
<form id="form1">
<input type="text" name="contact[]" value="" size="8" maxlength="10"/><br/>
<input type="text" name="contact[]" value="" size="25" maxlength="60"/>
<input type=button value="Send Form" onclick="xajax_Testing(xajax.getFormValues('form1'));"/>
</form>
<div id="testDiv"></div>
</body>
</html>