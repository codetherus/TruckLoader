<?php
include_once("xajax/xajax_core/xajax.inc.php");
$xajax = new xajax();
$xajax->configure('javascript URI', 'xajax/');

function test(){
  $resp = new xajaxResponse();
  $resp->assign('thediv','innerHTML','Radio CD');
  return $resp;
}
$xajax->configure('debug',true);
$xajax->register(XAJAX_FUNCTION,'test');
$xajax->processRequest();
?>
<html>
<head>
<?php $xajax->printJavascript() ?>
</head>
<body>
<input type="button" value="Test" onclick="xajax_test()"/><br/>
<div id="thediv"></div>
</body>
</html>
