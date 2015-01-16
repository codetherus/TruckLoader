<?php
/*
	Smarty setup file.
	Include it to use the Smarty template engine.
*/
	require('smarty/libs/Smarty.class.php');
	$smarty = new Smarty();
	$smarty->template_dir = './smarty/templates';
	$smarty->compile_dir  = './smarty/templates_c';
	$smarty->cache_dir    = './smarty/cache';
	$smarty->config_dir   = './smarty/configs';
	$smarty->caching = false;												//No cache use until production
	$smarty->force_compile = 1;									//ALways compile until production
?>