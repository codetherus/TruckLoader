{*   Copyright(c) 2009 by RSI. All rights reserved.
		 This is the screen lookup/search page template.
*}
{include file="pageheaderv2.tpl"}
{include file="common_scripts.tpl"}
<link rel='stylesheet' href='calendar/calendar.css' title='calendar'>
<script language="javascript" src="calendar/setLongDateFormat.js"></script>
<script language="javascript" src="calendar/calendar.js"></script>
<script language="javascript" src="scripts/todays_loadsV2.js"></script>
{literal}
<style>
	label{
		width: 150px;
	}
  fieldset{
    margin: 0 auto;
    width: 45%; 
    padding: 10px;    
    color: blue;
  }
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
<div id="wrapper" style="margin-top: 50px;"> {* Content container div *}
{* global search results display *}
<div id="search_results"></div>
{include file="content_header_v2.tpl"}
<form id="form1">
<br/><br/>

<fieldset>
<label>Unload Date:</label> 
<input readonly size="10" id='unload_date' name='unload_date' value='{$unload_date}'/>
{* Calendar control for unload date *}
<img src='images/cal.gif' align='absmiddle' onmouseover="fnInitCalendar(this, 'unload_date', 'style=calendar_green.css,close=true')"> 
<br/>
{* Div for the agent list. Hidden unless user is admin. *}
<div id="agentdiv", name="agentdiv" style="display: none;"> 
<label style="margin-right: 5px;">Agent:</label>{$agentlist}<br/>
</div>
<label>Driver Status:</label>
&nbsp;Active<input type='radio' id='ds_active' name='driver_status' value="Active" checked/>
&nbsp;Inactive<input type='radio' id='ds_inactive' name='driver_status' value="Inactive"/>
&nbsp;Both<input type='radio' id='ds_both' name='driver_status' value=""/><br/>
</fieldset>
 
<center>
<br>
<input type="button" value="Submit" onclick="sendPage();return false;"/>
<input type="button" value="Help" onclick="xajax_page_help()"/>
<br/><br/>
</center>
</form>


{include file="footer.tpl"}
</div>