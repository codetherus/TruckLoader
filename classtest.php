<?php
include 'xajax/xajax_core/xajax.inc.php';
$xajax = new xajax();
$xajax->configure('javascript URI', 'xajax/');
//$xajax->configure('debug', true);
include 'calcul.php';

function calc($data)
{
   
   $calcul = new calcul();
   $resp = new xajaxResponse();
   extract($data);
   switch($data['op'])
   {
       case 'add':
          $res =  $calcul->addition((int) $a, (int) $b,(int) $c);
          break;
       case 'sub':
           $res =  $calcul->substraction((int) $a, (int) $b,(int) $c);
           break;
       case 'mul':
            $res =  $calcul->multiplication((int) $a, (int) $b,(int) $c);
             break;
       default:
            $res =  $calcul->addition((int) $a, (int) $b,(int) $c);
     }
   $resp->alert($res);
   return $resp;
} 

$xajax->register(XAJAX_FUNCTION,'calc');
$xajax->processRequest();
?>
<!doctype html>
<html>
<head>
<?php $xajax->printJavascript(); ?>
</head>
<body>
<form id='form1'>
<label>A</label>
<input id='a' name='a'/><br/>
<label>B</label>
<input id='b' name='b'/><br/>
<label>C</label>
<input id='c' name='c'/><br/>
<select id='op' name='op'>
<option value='add'>Addition</option>
<option value='sub'>Subtraction</option>
<option value='mul'>Multiplicatin</option
</select><br/>
<input type='button' value='Submit' onclick="xajax_calc(xajax.getFormValues('form1'))";/>
</form>
</body>
</html>