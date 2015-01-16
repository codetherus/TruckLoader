{*   Copyright(c) 2009 by RSI. All rights reserved. *}
{include file="pageheader.tpl"}
<link rel="stylesheet" type="text/css" href="styles/truckloader.css">
</head>
<body onload="xajax.$('btngo').focus();">
<div id="mainhead">
<span style="font-size:larger; font-weight: bold;">Nationwide Freight</span><br><br>
We move flatbed freight in all fifty states and Canada.
</div>
<div id="wrapper" style="margin-top: 100px;">
{include file="content_header.tpl"}
<center>
<div id="content" style="border: none;">
<br>
<input id="btngo" type="submit" value="Login" onclick="xajax_go(); return false;"/>
<br><br>
</div>
</div>
<br><br><br>
{include file="footer.tpl"}