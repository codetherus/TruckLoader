<?php
/*
  10/16/11 Sample page for johnjohn
  johnjohn.php
*/

//Setup the xajax framework.
include_once("xajax/xajax_core/xajax.inc.php");
$xajax = new xajax();
$xajax->configure('javascript URI', 'xajax/');

function validate($data){
  $s = '';
  if ($data['name'] == '')
    $s .= "Missing Name\n";
  if ($data['address'] == '')
    $s .= "Missing Address\n";
  
  if ($s != '')
    $s = "Please fix the following:\n" .$s;
  return $s;
}

function processform($data){
  $resp = new xajaxResponse();
  $s = validate($data);
  if ($s != ''){
    $resp->alert($s);
  }
  else{
    $resp->script("xajax.$('form1').submit();");
  }
  return $resp;
}

$xajax->register(XAJAX_FUNCTION,'processform');
$xajax->processRequest();
?>
<!DOCTYPE html>
<html>
<head>
<?php $xajax->printJavascript() ?>
</head>
<body>
<form id="form1" action="t2.php" method="get">
<label>Name</label><input id="name" name="name"/><br/>
<label>Address</label><input id="address" name="address"/><br/>
<input type="button" value="Submit" onclick="xajax_processform(xajax.getFormValues('form1'))"/>
</form>
</body>
</html>

