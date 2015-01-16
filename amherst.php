<?php
include_once("xajax/xajax_core/xajax.inc.php");
$xajax = new xajax();
$xajax->configure('javascript URI','xajax/');//http://www.ats.amherst.edu/xajax_0.5/');

function test()
{
  $resp = new xajaxResponse();
  $resp->alert('It Works...');
  return $resp;
}

$xajax->register(XAJAX_FUNCTION,'test');
$xajax->processRequest();
?>
<!DOCTYPE html>
<html>
<head>
<?php $xajax->printJavascript(); ?>
</head>
<body>
<input type="button" value="Click Me" onclick="xajax_test()"/>
</body>
</html>