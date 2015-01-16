<?php
/*
  Common session control for the autosuggest and
  search routines.
*/
ob_start();
//Session timeout controls
//This path MUST be the full path on the Windows box.
//ini_set('session.save_path', 'sessions');
ini_set('session.save_path', 'C:\\wamp\\www\\Truck Loader\\sessions');
session_start();
?>