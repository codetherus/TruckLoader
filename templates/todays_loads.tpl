{*   Copyright(c) 2009 by RSI. All rights reserved.
		 This is the screen lookup/search page template.
*}
{include file="pageheader.tpl"}
<link rel='stylesheet' href='calendar/calendar.css' title='calendar'>
<script language="javascript" src="calendar/setLongDateFormat.js"></script>
<script language="javascript" src="calendar/calendar.js"></script>

{literal}
<style>
	fieldset{
		width: 45%;
    padding: 10px; 
	}
	label{
		width: 90px;
	}
	#content{
		width: 80%;
		padding:20px;"
		border: 3px solid black;
	}
	body{ padding-top: 40px;}
</style>
<script>
	function sendPage()
	{
		fb.end();
		xajax_FindLoads(xajax.getFormValues('form1'));
		return false;
	}
	
</script>	
{/literal}
</head>
<body onload="xajax_PageSetup();">
<div id="floatboxcontent"></div> {* div for floatbox displays *}
<div id="wrapper">
{include file="content_header.tpl"}
<div id="content" >
<form id="form1">
<center>
<br/><br/>
<fieldset>

<label>Unload Date:</label> <input readonly size="10" id='unload_date' name='unload_date' value='{$unload_date}'/>
{* Calendar control for unload date *}
<img src='images/cal.gif' align='absmiddle' onmouseover="fnInitCalendar(this, 'unload_date', 'style=calendar_green.css,close=true')"> 
<br/>
{* Div for the agent list. Hidden unless user is admin. *}
<div id="agentdiv", name="agentdiv" style="display: none;"> 
<label style="width: 80px;">Agent:</label>{$agentlist}<br/>
</div>
<label>Driver Status:</label>
&nbsp;Active<input type='radio' id='ds_active' name='driver_status' value="1" checked/>
&nbsp;Inactive<input type='radio' id='ds_inactive' name='driver_status' value="0"/>
&nbsp;Both<input type='radio' id='ds_both' name='driver_status' value="2"/><br/>
</fieldset>
</center>
<center>
<br>
<input type="button" value="Submit" onclick="sendPage();return false;"/>
<input type="button" value="Help" onclick="xajax_page_help()"/>
<br/><br/>
</center>
</form>
<div id="searchresults" name="searchresults">
</div>
</div>
</div>
{include file="footer.tpl"}
