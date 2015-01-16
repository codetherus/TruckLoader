{*   Copyright(c) 2009 by RSI. All rights reserved.
		 This is the radius searching page template
*}
{include file="pageheader.tpl"}
<link rel='stylesheet' href='calendar/calendar.css' title='calendar'>
<script language="javascript" src="calendar/setDateFormat.js"></script>
<script language="javascript" src="calendar/calendar.js"></script>
{literal}
<style>
label{
  width: 100px;
}
#content{
  padding-left:150px;
</style>
{/literal}
</head>
<body onload="xajax.$('city').focus();">
<div id="floatboxcontent"></div>
<div id="wrapper">
{include file="content_header.tpl"}
<div id="content" style="width: 70%;">
<form id="form1">
<fieldset style="border: 2px solid lime; width: 50%; padding: 1em; margin: 1em;">
<label>City:</label>
<input id="city" name="city"/><br/>
<label>State</label>
{$statelist}
<br/>
<label>Radius:</label>
<input id="radius" name="radius" size="3" value="50"/><br/>
<center>
<br/>
<input type="submit" value="Search" onclick="xajax_RadiusSearch(xajax.getFormValues('form1')); return false;"/>

</form>
</fieldset>
</center>
</div> {* content *}
</div>
{include file="footer.tpl"}