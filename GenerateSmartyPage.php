<?php
/*
  Copyright(c) 2009 by RSI. All rights reserved.
	Standard Smarty page generation.
	Generates the "common" smarty
	variables and displays the passed template.
  
  05-15-2013 Added the compress.php timestamp so
  we can include the compressed js and css files.
  See compress.php in the compress folder
*/

/*
	Function: GenerateSmartyPage()
	Parameter $templatename - optional template name.
	
	The standard is to name the template the same name as the php page.
	Thus the template for login.php id login.tpl
*/
function GenerateSmartyPage($templatename='')
{
	require 'compress/compress_timestamp.php';
  global $smarty, $xajax;
	$smarty->assign("xajaxjs",$xajax->getJavascript()); 							          //Setup the xajax JS
	$smarty->assign("footeryear", Date("Y"));													          //Footer Copyright Year
	$smarty->assign("footertext", " by Loads By Jake. All Rights Reserved."); 	//Footer copyright text
  $smarty->assign("compress_timestamp", $compress_stamp); //compression timestamp
	//Setup the template name.
  if ($templatename != '')
		$fnm = $tmplatename;
	else
	{
		$fnm = $_SERVER['PHP_SELF'];
		$fnm = basename($fnm);
		$fnm = str_replace('php','tpl',$fnm);
	}
	$smarty->display($fnm);
}