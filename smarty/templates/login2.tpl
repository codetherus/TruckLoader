{*   Copyright(c) 2009 by RSI. All rights reserved. *}
{include file="pageheader.tpl"}
<link rel="stylesheet" type="text/css" href="styles/truckloader.css">
</head>
<body onload="xajax.$('user').focus();">
<div id="floatboxcontent"></div> {* div for floatbox displays *}
<div id="wrapper">
{include file="content_header.tpl"}
<form id="form1">
<div id="content">
<fieldset style="padding-top: 15px;border:none;">
<label style="width:150px;">User Id:</label>
<input id="user" name="user" size="10"><br/><br/>
<label style="width:150px;">Password:</label>
<input type="password" id="password" name="password" size="10">
<br><br>
</div>
<center>
<input type="submit" value="Login" onclick="xajax_login(xajax.getFormValues('form1')); return false;"/>
<input type="button" value="help" onclick="xajax_page_help()">
<br><br>
</center>
</form>
</div>
{include file='footer.tpl}