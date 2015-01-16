<?php
include 'Snoopy.class.php';
$snoopy = new Snoopy();

	$snoopy->fetch("http://www.google.com/");
	print $snoopy->results;
