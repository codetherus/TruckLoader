{*   Copyright(c) 2009 by RSI. All rights reserved.
		 This is the screen lookup/search page template.
*}
{include file="pageheaderv2.tpl"}
{include file="common_scripts.tpl"}
{literal}
<style>
	fieldset{
		width: 75%; 
    margin-left: auto;    
    margin-right: auto;
	}
	label{
		width: 250px;
	}
	#content{
		width: 80%;
		padding:20px;"
		border: 3px solid black;
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
<body onload="xajax_PageSetup();xajax.$('searchvalue').focus()">
<div id="floatboxcontent"></div> {* div for floatbox displays *}

<div id="wrapper" style="margin-top: 150px;">
{* global search results display *}
<div id="search_results"></div>

{include file="content_header_v2.tpl"}

<form id="form1">
<br>
<fieldset>
<br>
<br>
<label>Driver Status:</label>
&nbsp;Active<input type='radio' id='ds_active' name='driver_status' value="Active" checked/>
&nbsp;Inactive<input type='radio' id='ds_inactive' name='driver_status' value="Inactive"/>
&nbsp;Both<input type='radio' id='ds_both' name='driver_status' value=""/><br/><br/>
<label>Search Order:</label>
&nbsp<input type='radio' id='ds_bydriver' name='search_order' value="name" checked/>
&nbsp;By Driver&nbsp;
&nbsp;<input type='radio' id='ds_bytruck' name='search_order' value="truck_no"/>
&nbsp;By Truck #<br/><br/>
<div id="agentdiv", name="agentdiv" style="display: none;"> 
<label>Agent:</label>{$agentlist}<br/><br/>
</div>
</fieldset>
<center>
<br>
<input type="submit" value="Submit" onclick="sendPage();return false;"/>
<input type="button" value="Help" onclick="xajax_page_help()"/>
</center>
</form>
<div id="searchresults" name="searchresults">
</div>
</div>

{include file="footer.tpl"}
