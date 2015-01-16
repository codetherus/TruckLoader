<?php
function do1()
  {
  //sample
  }
function do2()
  {
  //sample
  }
class sample_class1
{
	function foo(){}
}
class sample_class2
{
	function foo2(){}
}  
function xajaxRegister($array_functions, $array_classes, $error_reporting)
    {
    require_once('xajax/xajax_core/xajax.inc.php');
    $xajax = new xajax();
    $xajax->configure('javascript URI', 'xajax/');
    $xajax->configure('debug', $error_reporting);
    //Funktionen initialisieren
    foreach($array_functions as $function)
        {
        $xajax->register(XAJAX_FUNCTION, $function);
        }

    //Klassen initialisieren
    foreach($array_classes as $class)
        {
        ${$class} = new $class();
        $xajax->register(XAJAX_CALLABLE_OBJECT, $class);
        $GLOBALS[$class] = ${$class};
        }
      
   
    $xajax->processRequest();
    $GLOBALS['xajax'] = $xajax;
    }
 
xajaxRegister(array('do1', 'do2'), array('sample_class1', 'sample_class2'), true);
?>
<html>
<head>
<?php $xajax->printJavascript()?>
</head>
<body>
Boo
</body>
</html>