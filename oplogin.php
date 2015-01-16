<?php
/*
  Copyright(c) 2009 by RSI. All rights reserved.
	This is the login page for the Jakes Loads website.
	Single page site version.
*/
class oplogin {
  //Standard function that does the initial page load.
  public function initialize()
  {
    global $smarty;
    $r = new xajaxResponse();
    //Clear the session variables
    $_SESSION = array();									//Clear the session array.
    $_SESSION['loggedon'] = false;				//Set the common variables.
    //$smarty->debugging = true;					//Use the Smarty debug display.
    $smarty->assign("domenu", 0);
    $content = $smarty->fetch("oplogin.tpl");
    $r->assign("onepagecontent", "innerHTML", $content);
    $r->assign("header", "innerHTML","Login");
    $r->script("xajax.$('user').focus()");
    return $r;
  }
  function login($dta)
  {
  	global $db;
  	$resp = new xajaxResponse();
  	extract($dta);
  	if ($user == '' || $password == '')
  	{
  		$resp->alert("Invalid user id and/or password.\nPlease try again.");
  		return $resp;
  	}
  	$sql = "select * from users where user = '$user' and password = '$password'";
  	$res = $db->get_row($sql);
  	if (!$res)
  	{
  		$resp->alert("Invalid user id and/or password.\nPlease try again.");
  		return $resp;
  	}
  	
  	//Setup the session vars and go to the search page.
  	$_SESSION['loggedin'] = true;
  	$_SESSION['user'] = $user;
  	$_SESSION['userid'] = $res->id;
  	$_SESSION['level'] = $res->level;
  	$resp->script("xajax_callUser('opsearch','initialize','opsearch')");
  	return $resp;
  }
}
?>