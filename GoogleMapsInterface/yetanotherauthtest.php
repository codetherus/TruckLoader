<?php
/*
	12/7/14
	Testing the authentication module in anotherauthtest.php
*/	
session_start();
//unset($_SESSION['callback']);
//Set us up as the callback and get authorized
//If we get here and the callback is already
//set then we are coming back from the auth module.
if(isset($_SESSION['callback']))
{
	echo 'Callback is set<br>';
}
else
{
	$_SESSION['callback'] = "http://".$_SERVER["HTTP_HOST"].$_SERVER['PHP_SELF'];
}

if(isset($_SESSION['callback']))
{
	echo('Calling the auth module.<br>');
	sleep(3);
	
	header("Location: anotherauthtest.php");
	die();
}
else
{
	echo 'Back from the authorization module...';
	var_dump($_SESSION);
}