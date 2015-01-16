{*   Copyright(c) 2009 by RSI. All rights reserved.
		 Screen for the daily inbound truck report handler
*}
{include file="pageheader.tpl"}

{literal}
<style>
	fieldset{
		width: 65%; 
		margin-left:100px;
	}
	label{
		width: 150px;
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
		xajax_uploader(xajax.getFormValues('upload_form'));
		return false;
	}
</script>	
{/literal}
</head>
<body>
<div id="wrapper">
{include file="content_header.tpl"}
<div id="content" >
<form enctype="multipart/form-data" id="upload_form" name="upload_form" action="inbound_report_loader.php" method="POST">
<fieldset>
<legend><b>Please choose the file to load then press Submit.</b></legend>
<label>File Name:</label>
<input type="file" id="inbound_upload" name="inbound_upload" value=""/>
</fieldset>
<center>
<br>
<input type="submit" value="Submit"/>
<input type="button" value="Help" onclick="xajax_help()"/>
<input id="issubmitted" name="issubmitted" type="hidden" value="yes"/>
<br/><br/>
</center>
</form>
<div id="results" name="results">
</div>
{include file="footer.tpl"}
