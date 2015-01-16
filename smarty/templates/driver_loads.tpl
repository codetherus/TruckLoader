{* This is the template for the combined
   driver/loads page
*}
<!DOCTYPE HTML>
<html>
<head>
<title>Combined driver and load management</title>
<script type="text/javascript" src="JQueryUI/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="JQueryUI/js/jquery-ui-1.8.5.custom.min.js"></script>
<link rel="stylesheet" type="text/css" href="JQueryUI/css/redmond/jquery-ui-1.8.5.custom.css">
{literal}
<script type="text/javascript">
 jQuery(document).ready(function()
	{ 
    jQuery("#tabdiv").tabs({selected: 0});  
  });
</script>
{/literal}
</head>
<body>
<div id="tabdiv" style="font-size: 10px;padding: 0px; width: 100%;">
<ul>
<li><a href="#drivers" title="Manage Drivers">Drivers</a></li>
<li><a href="#loads" title="Manage Loads">Loads</a></li>
</ul>
<div id="drivers" style="height: 700px; width: 100%; margin: none; overflow: none; padding: 0px">
<iframe src="drivers.php" style="width: 95%; height: 100%;"></iframe>
</div>

<div id="loads" style="height: 600px; width: 100%; margin: 0; ">
<iframe src="loads.php" style="width: 99%; height: 100%;"></iframe>
</div>
</div>
</body>
</html>