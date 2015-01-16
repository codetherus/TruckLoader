<?php
/*
	8/14/09
	System standard help display
  The param is the page name without extension.
  i.e. login.php's help name is just "login".
  The actual help files are named <page>_help.html.
*/
function page_help($pg='')
{
	$resp = new xajaxResponse();
	//The help file name is optional.
	//Use the base of the current file if not given.
	if ($pg == '')
	{
		$path_parts = pathinfo($_SERVER['SCRIPT_FILENAME']);
		$pg = $path_parts['filename'];
	}
	
	@$s = file_get_contents('./help_files/'.$pg.'_help.html');
	if (!$s)
	{
		$resp->alert("Sorry. The help page could not be located. $pg");
		return $resp;
	}	
	else
	{
	  $s1 = "<br/><center><input type='button' value='Close' onclick='fb.end();' /></center>";
		$s1 .= '<div style="margin-left: 50px; text-align:left">';
		$s1 .= $s;
		$s1 .= "</div>";
		$s1 .= "<br/><center><input type='button' value='Close' onclick='fb.end();' /><br/></center>";
	}
	$resp->assign("floatboxcontent","innerHTML", $s1);
	$resp->script("fb.loadAnchor('#floatboxcontent')");
	return $resp; 		
}
$xajax->register(XAJAX_FUNCTION,'page_help');
?>