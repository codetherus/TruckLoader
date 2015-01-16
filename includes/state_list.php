<?php
/*
	USPS State code list dropwown generator utility
*/

function GenerateStateList($lstid='',$sel='')
{
	$s = '';
	$states = file("state_codes.txt");
	if ($lstid == '')
		$s = "<select id='statecode' name='statecode'>\n";
	else
		$s .= "<select id='$lstid' name='$lstid'>\n";
	$s .= "<option value=''>State</option>\n";
	foreach($states as $st)
	{
		$sts = rtrim($st);
		$cd = substr($sts,-2);	//State code;
		$sn = substr($sts,0,-6);
		$sn = trim($sn);			//State name;
		$s .= "<option value='$cd'";
		if ($cd == $sel)
			$s .= " SELECTED";
		$s .= ">$cd</option>\n";
	}
	$s .= "</select>\n";
	return $s;
}
		