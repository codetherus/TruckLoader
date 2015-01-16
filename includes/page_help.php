<?php
/*
	8/14/09
	System standard help display
  The parameter is the base page name with no extension.
  i.e. login.php's help name is login.
*/
function page_help($pg)
{
	$resp = new xajaxResponse();
	@$s = file_get_contents('./help_files/'.$pg.'_help.html');
	if (!$s)
	{
		$resp->alert("Sorry. The help page could not be located.");
		return $resp;
	}	
	else
	{
	  $s1 = "<br/><center><input type='button' value='Close' onclick='fb.end();' /><br/><br/></center>";
		$s1 .= '<div style="margin-left: 250px; text-align:left">';
		$s1 .= $s;
		$s1 .= "</div>";
		$s1 .= "<br/><center><input type='button' value='Close' onclick='fb.end();' /><br/><br/></center>";
	}
	$resp->assign("floatboxcontent","innerHTML", $s1);
	$resp->script("fb.loadAnchor('#floatboxcontent')");
	return $resp; 		
}
$xajax->register(XAJAX_FUNCTION,'page_help');
?>