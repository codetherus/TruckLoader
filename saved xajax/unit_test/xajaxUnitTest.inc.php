<?php
/*
	File: xajaxUnitTest.inc.php
	
	Construct a test page and instantiate the TestCase declared in the calling
	script file.
*/
	
define('XAJAX_HTML_CONTROL_DOCTYPE_FORMAT', 'HTML');
define('XAJAX_HTML_CONTROL_DOCTYPE_VERSION', '4.01');
define('XAJAX_HTML_CONTROL_DOCTYPE_VALIDATION', 'TRANSITIONAL');

require("../xajax_core/xajax.inc.php");

$objXajax = new xajax();
$objResponse = new xajaxResponse();

$objXajax->configure('javascript URI', '../');

$sRoot = dirname(dirname(__FILE__));
$sCoreFolder = $sRoot . '/xajax_core';
$sControlsFolder = $sRoot . '/xajax_controls';

require_once $sControlsFolder . '/validate_HTML401TRANSITIONAL.inc.php';	
require_once $sCoreFolder . '/xajaxControl.inc.php';

foreach (array(
	'/document.inc.php',
	'/content.inc.php',
	'/form.inc.php',
	'/group.inc.php',
	'/misc.inc.php',
	'/structure.inc.php') as $sFile)
	require $sControlsFolder . $sFile;

$objBody = new clsBody();

$test = new TestCase($objXajax, $objResponse, $objBody);

$objXajax->processRequest();

$objTitle = new clsTitle(array(
	'children' => array(new clsLiteral('xajax Unit Test System'))
	));

ob_start();

?>

<?php

$objStyle = new clsStyle(array(
	'attributes' => array(
		'type' => 'text/css'
		),
	'child' => new clsLiteral(ob_get_clean())
	));

ob_start();

?>

<?php

$objScript = new clsScript(array(
	'attributes' => array(
		'type' => 'text/javascript'
		),
	'child' => new clsLiteral(ob_get_clean())
	));

$objHead = new clsHead(array(
	'xajax' => $objXajax,
	'children' => array(
		$objTitle,
		$objStyle,
		$objScript
		)
	));

$document = new clsDocument(array(
	'children' => array(
		new clsDoctype(),
		new clsHtml(array(
			'children' => array(
				$objHead,
				$objBody
				)
			))
		)
	));

$document->printHTML();

