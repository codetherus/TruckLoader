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
<body>
<div id="mainhead">
<span style="font-size:larger; font-weight: bold;">Nationwide Freight</span><br><br>
We move flatbed freight in all fifty states and Canada.
</div>
<div id="wrapper" style="margin-top: 100px;">
{include file="content_header.tpl"}
<center>
<div id="content" style="border: none;">
<br>
<input type="button" value="Login" onclick="xajax_go()"/>
<br><br>
</div>
</div>
<br><br><br>
{include file="footer.tpl"}