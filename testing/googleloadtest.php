<?php
/*
 Sample page loading jQuery from the Google servers
*/
?>
<!DOCTYPE HTML>
<html>
<head>
<title>jQuery from Google servers</title>
<!-- Get the jquery ui css we want to use -->
<link rel="stylesheet" 
      href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/redmond/jquery-ui.css" 
      type="text/css" />
<!-- Get the google loader -->
<script src="http://www.google.com/jsapi"></script>
<script>
  google.load("jquery", "1.6.1");     //Load jQuery
  google.load("jqueryui", "1.8.13");  //Load jQuery UI
</script>
<script>
  jQuery(document).ready(function(){
    $("#tabs").tabs();  //Setup the tabs
    $(".btn").button(); //Setup the buttons
    $("label").append(":"); //Add a colon to each label on the page.
  }
  );
</script>
</head>
<body>
<h2>Testing jQuery lib load from Google servers</h2>
<div id="tabs">

<ul>
<li><a href="t1">Members</a></li>
<li><a href="t2">Join</a></li>
</ul>

<div id="t1">
<input type="button" class="btn" value="Click Me"/>
<label>Sample Label</label>
</div>

<div id="t2"></div>

</div> <!-- tabs -->
</body>
</html>