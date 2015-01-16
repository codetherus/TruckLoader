<?php
//Caller to the server sample to authenticate

session_start();

//Call the authenticator if necessary
if(!isset($_SESSION['token'])
{
	if($_SESSION['authcalled'] ===true)
		die('Authentication failed.');
	$_SESSION['authcalled'] = true;
	header('Location: webServerSample.php?callback=serversample.php');
}