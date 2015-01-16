<?php
if(!defined('CONFIG_LOADED')) require_once '../config.php';
?>
<h1>Welcome to DABL</h1>
<p>
	After specifying your database connection information, simple point your browser to the
	<a href="generator/">DABL generator</a> to create the php classes for your database tables.
</p>
<p>
	The following code snippet is all you need to give a script access to your DABL database models:
</p>
<pre>
	<strong>if(!defined('CONFIG_LOADED')) require_once '../config.php';</strong>
</pre>