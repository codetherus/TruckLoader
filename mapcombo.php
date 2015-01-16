<?php
/*
	11/24/14
	Combine the drivers and tracking
	into one page using JQ UI Tabs.
*/
?>
<!doctype html>
<html>
<head>
	<title>Loads by Jake Driver Track Map</title>
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
	<link rel='stylesheet' href='JQueryUI/css/mint-choc/jquery-ui-1.8.6.custom.css'/>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="JQueryUI/js/jquery-ui-1.8.5.custom.min.js" type="text/javascript"></script>
	<script>
		$(document).ready(function(){
			$("#tabs").tabs();
		});
	</script>
	<style>
		body{ 
			background: black;
			scrolling: no;
		}
		.frame{
			margin: 0;
			padding: 0;
			border: none;
			overflow: none;
			width: 100%;
			height: 850px;
		}
		#tabs{
			height: 95%;
			overflow: hidden;
			border: none;
		}
	</style>
			
</head>
<body>

<div id="tabs" style="width: 100%;margin-top: 15px;">
	<ul>
	<li><a href="#tab1">Drivers</a></li>
	<li><a href="#tab2">Routes</a></li>
	</ul>
<div id="tab1" class="ttab" height="95%" width="100%">
	<iframe scrolling="no" class="frame" width="100%" height="100%" src="GMI2.php"></iframe>
</div>
<div id="tab2" class="ttab" height="95%" width="100%">
	<iframe scrolling="no" class="frame" width="100%" height="100%" src="tracker1.php"></iframe>
</div>
</div>
</body>
</html>