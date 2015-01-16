<?php
include_once("xajax/xajax_core/xajax.inc.php");
$logString = '';
//This class does the XAJAX setup.
//It gets called every time the page loads
//including IPL and calls to testMethod().
class C_RUN {
    public $AJAX;
    function __construct() {
      $this->AJAX = new xajax();
      $this->AJAX->configure('javascript URI', 'xajax/');
     // $this->AJAX->configure('debug',true);
      $this->runinit();
      global $logString;
      $logString .= "In C_RUN constructor\n\r";
    }
    function runinit() {
      global $logString;
      $logString .= "In C_RUN runit()\n\r";
      $this->AJAX->processRequest();
    }
}

class C_HTML_SITE extends C_RUN {
    function run() {
    global $logString;
    $logstring .= "In C_HTML_SITE run()\n\r";
    echo '<html xmlns = "http://www.w3.org/1999/xhtml" xml:lang = "en" lang = "en">';
    echo '<head>';
    $this->AJAX->printJavascript();
    echo '</head>';
    echo '<body>';
    
    echo '<button onclick="xajax_testMethod()" >CLICK ME</button>';
    echo '<div id = "submittedDiv"></div>';
    echo 'In C_HTML_SITE run()<br>';
    }
    
    function __destruct()
    {
      echo '</body>';
      echo '</html >';
    }
}
class CAJAX extends C_HTML_SITE {
    //XAJAX Registered function
    function testMethod()
    {
        global $logString;
        $logString .= "In CAJAX testMethod()\n\r";
        $objResponse=new xajaxResponse();
        $objResponse->assign( "submittedDiv", "innerHTML", date("H:i:s"));
        $objResponse->alert($logString);
        return $objResponse;
    }
    
    function runinit() {
        global $logString;
        $logString .= "In CAJAX runinit()\n\r";
        $this->AJAX->registerFunction(array(&$this,"testMethod"));
        parent::runinit();
    }
    function run() {
      parent::run();
    }
}
$a = new CAJAX;
$a->run();
?>