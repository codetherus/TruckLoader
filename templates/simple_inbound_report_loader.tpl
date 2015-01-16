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
	#wrapper{
		margin-top: 75px;
	}
	#content{
		width: 80%;
		padding:20px;"
		border: 3px solid black;
	}
</style>
<script>
	function checkMessage()
	{
		m = document.getElementById('msg');
		if (m.value != '')
			alert("Message: " + m.value);
	}
</script>
{/literal}
</head>
<body onload="checkMessage()">
<div id="wrapper">
{include file="content_header.tpl"}
<div id="content" >
<form enctype="multipart/form-data" id="upload_form" name="upload_form"  method="POST" >
<fieldset>
<input type="hidden" name="MAX_FILE_SIZE" value="30000" />
<legend><b>Please choose the file to load then press Submit.</b></legend>
<label>File Name:</label>
<input type="file" id="inbound_upload" name="inbound_upload"/>
<input type="hidden" id="msg" name="msg"/>
</fieldset>
<center>
<br>
<input type="submit" value="Submit"/>
<br/><br/>
</center>
<input type="hidden" id="issubmitted" name="issubmitted" value="yes"/>
<input type="hidden" id="msg" name="msg" value="Message"/>
</form>
<div id="results" name="results">
</div>
{include file="footer.tpl"}
