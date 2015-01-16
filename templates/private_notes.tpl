{*   Copyright(c) 2009 by RSI. All rights reserved.
		 This is the screen Edit page template.
*}
{include file="pageheader.tpl"}
{literal}
<style>
	fieldset{
		width: 80%; 
		margin-left: 70px;
	}
	label{
		width: 145px;
		font-weight: bold;
	}
	#content{
		width: 80%;
		padding:20px;"
		border: 3px solid black;
	}
	#wrapper{ margin-top: 15px;}
</style>
<script>
	function sendPage(opcode)
	{
    xajax_processEdit(opcode,xajax.getFormValues('form1'));
    return false;
	}
</script>	
{/literal}
</head>
<body >
<div id="wrapper"  style="margin-top: 200px;">
{include file="content_header.tpl"}

<form id="form1" name='form1'>
<fieldset style="margin-top: 15px;">

{$editdata} 
</fieldset>
</form>
<center>
<br>
<input type="button" value="Save" onclick="sendPage('update');"/>
<input type="button" value="Delete" onclick="sendPage('delete');"/>
<input type="button" value="Help" onclick="xajax_page_help('private_notes')"/>
<input type="button" value="Back" onclick="history.back()"/>
<br/><br/>
</center>

{include file="footer.tpl"}
