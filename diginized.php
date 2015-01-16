<?php 
session_start(); 
ob_start();
require_once("xajax/xajax_core/xajax.inc.php");

$myAjaxObj = new xajax();
  $myAjaxObj->configure('javascript URI', 'xajax/');
  $myAjaxObj->registerFunction("printForm");
//  $myAjaxObj->processRequest(); //This works
function printForm($firstname){
  $response = new xajaxResponse();
  $response->assign("answer","innerHTML",$firstname);
  return $response ;
}
$myAjaxObj->configure('debug',true);
//$myAjaxObj->processRequest(); //This works
?>
<?php
$myAjaxObj->processRequest(); //This works. Nothing has been output yet...
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<?php
$myAjaxObj->processRequest(); //This does not work The doctype was output. See the debug info
?>
<html>
<head>
<title>Page title</title>
<?php $myAjaxObj->printJavascript();  ?>
</head>
<body>

<form action="#" onsubmit="return false;" method="post">
  <input type="text" size="30" name="firstname" id="firstname" />
  <a href="#" onclick="xajax_printForm(xajax.$('firstname').value);">Submit Changes</a> 
  <input type="button" onclick="xajax_printForm(10);" id="btnReset" value="the answer" />
</form>

<div id="answer" style="width:300; border:1px solid green;"><br /><br /></div>

</body>
</html>

  