{*   Copyright(c) 2009 by RSI. All rights reserved.
		 This is the screen lookup/search page template.
*}
{include file="pageheader.tpl"}

{literal}
<style>
	fieldset{
		width: 65%; 
		border: none;
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
<body onload="xajax.$('searchvalue').focus()">
<div id="floatboxcontent"></div> {* div for floatbox displays *}

<div id="wrapper" style="margin-top: 150px;" >
{include file="content_header.tpl"}

<form id="form1">
<br>
<fieldset style="margin-left: 200px;">
<br>
<br>
<label>Search Element:</label>
<div style="display: inline" id="selements" name="selements">{$searchelements}</div>
<br/><br/>
<label>Search Value:</label>
<input id="searchvalue" name="searchvalue"/> Leave blank for all loads by name.
<br/><br/>
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
