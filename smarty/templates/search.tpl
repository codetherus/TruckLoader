{*   Copyright(c) 2009 by RSI. All rights reserved.
		 This is the screen lookup/search page template.
*}
{include file="pageheader.tpl"}

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

<div id="wrapper">
{include file="content_header.tpl"}

<form id="form1">
<br>
<fieldset>
<br>
<br>
<label>Search Element:</label>
<div style="display: inline" id="selements" name="selements">{$searchelements}</div>
<br/><br/>
<label>Search Value:</label>
<input id="searchvalue" name="searchvalue"/> Leave blank for all drivers.
<br/><br/>
<label>Driver Status:</label>
&nbsp;Active<input type='radio' id='ds_active' name='driver_status' value="1" checked/>
&nbsp;Inactive<input type='radio' id='ds_inactive' name='driver_status' value="0"/>
&nbsp;Both<input type='radio' id='ds_both' name='driver_status' value="2"/><br/><br/>
<label>Search Order:</label>
&nbsp<input type='radio' id='ds_bydriver' name='search_order' value="driver" checked/>
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
<input type="button" value="Help" onclick="xajax_page_help('search')"/>
</center>
</form>
<div id="searchresults" name="searchresults">
</div>
</div>

{include file="footer.tpl"}
