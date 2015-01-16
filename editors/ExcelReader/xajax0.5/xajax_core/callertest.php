<?php
require_once("commons.php");
require_once("myxajaxcaler.php");
$ajxCall = new myxajaxCaller();
$xajax->registerFunction(Array('callUser',$ajxCall,'callUser'));
$xajax->processRequest();
?>
<html>
<head>
<? $xajax->printJavascript(); ?>
</head>
<body>
<input type="button" value="Click" onclick="xajax_callUser('testClass','testit','testing','It Worked');"/>
</body>
</html>