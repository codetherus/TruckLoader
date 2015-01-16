{*   Copyright(c) 2009 by RSI. All rights reserved. *}
{include file="pageheader.tpl"}
<link rel="stylesheet" type="text/css" href="styles/truckloader.css">
{literal}
<style>
body{
	background-image: url("./images/droppedImage.gif") ;
	background-position: top center;
	background-repeat: no-repeat;
}
</style>
{/literal}
</head>
<body onload="document.getElementById('user').focus()">
<div id="floatboxcontent"></div> {* div for floatbox displays *}
<div id="wrapper" style="margin-top: 150px">
{include file="content_header.tpl"}
<form id="form1">
<div id="content" style="margin-top: 10px">
<fieldset style="padding-top: 15px;border:none;">
<label style="width:150px;">User Id:</label>
<input id="user" name="user" size="10"><br/><br/>
<label style="width:150px;">Password:</label>
<input type="password" id="password" name="password" size="10"><br/><br/>
<label style="width:150px;">Start Page:</label>
<input type="radio" name="startpage" value="search" checked>Search&nbsp;
<input type="radio" name="startpage" value="drivers">Drivers
<br><br>
</div>
<center>
<input type="submit" value="Login" onclick="xajax_login(xajax.getFormValues('form1')); return false;"/>
<input type="button" value="help" onclick="xajax_page_help()">
<br><br>
</center>
</form>
</div>
<br/><br/>
<center>
<a style="color:white; font-weight: bold;" href="http://loadsbyjake.com/getquote.php">Click Here to Get a Load Quote From Loads By Jake</a><br/>
<a style="color:white; font-weight: bold;" href="brokerlistv2.php">Click Here  to See a List of Available Drivers at Loads By Jake</a>
</center><br/>
{include file="footer.tpl"}