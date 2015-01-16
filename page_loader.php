<?php
/*
	Xajax powered page loader
*/
ini_set('allow_url_fopen',1);
require_once("xajax/xajax_core/xajax.inc.php"); 
$xajax = new xajax();                           
$xajax->configure('javascript URI', 'xajax/');	
$xajax->configure('debug',true);
$xajax->register(XAJAX_FUNCTION,"PageMaster");  
$xajax->processRequest();                       

function PageMaster($pagename)
{
    $resp=new xajaxResponse();
    $pg = $pagename.'.php'; 
    ob_start();
    include($pg);                 
    $content = ob_get_contents();
    ob_end_clean();
//    $resp->alert($content);
//    return $resp;
    $resp->assign("content", "innerHTML", $content);
    return $resp;                               
}
?>
<html>
<head>
<?php $xajax->printJavascript(); ?>
<title>Page Load Test</title>
</head>
<body>
<div id="nav">
<a href="#" onclick="xajax_PageMaster('news')">News</a>
<a href="#" onclick="xajax_PageMaster('weather')">Weather</a>
<a href="#" onclick="xajax_PageMaster('sports')">Sports</a>
<a href="#" onclick="xajax_PageMaster('business')">Business</a>
</div>
<div id="content"></div>
</body>
</html>
