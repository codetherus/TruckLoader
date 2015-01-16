{*   Copyright(c) 2009 by RSI. All rights reserved. *}
{include file="pageheader.tpl"}
<link rel="stylesheet" type="text/css" href="styles/drugman.css">
<script type="text/javascript" src="./jquery/development-bundle/jquery-1.3.2.js"></script>
{literal}
<style>
	textarea{
		border: 1px solid blue;
		height: 250px;
		font-size: 12px;
		margin-left: 100px;
	}
</style>
<script>
	function addDate()
	{
		$('#notetext').append(Date());
	}
</script>	
{/literal}

</head>
<body onload="xajax_readNotes()">
<div id="wrapper">
<div id="header">
{$client}<br>
{$pgtitle}<br>
{if $domenu eq true}
	{include file="staff_menu.tpl"}
{/if}

</div>
<form id="form1">
<input type="hidden" id="barcode" name="barcode">
<div id="notecontent"></div>
<center>
<input type=button value="Timestamp" onclick="xajax_addTimeStamp();">
<input type="button" value="Save" onclick="xajax_writeNotes(xajax.getFormValues('form1')); return false;"/>
<br><br>
</center>
</form>
{include file="footer.tpl"}
