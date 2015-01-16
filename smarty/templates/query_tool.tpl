{*   Copyright(c) 2009 by RSI. All rights reserved.
		 This is the query tool template
*}
{include file="pageheaderv2.tpl"}
{literal}
<style>
  select, input {
   margin-bottom: 3px;
   }
  
	fieldset{
		width: 100%;;
    padding: 10px;
    border: none;
	}

	label{
	 width: 120px;
	}

	#content{
		width: 80%;
		padding:20px;"
	}

	body{ 
    padding-top: 40px;
  }
</style>
<script>
  //Send the form and op code to the server.
	function sendPage(op)
	{
		fb.end();
		xajax_Process(xajax.getFormValues('form1'),op);
		return false;
	}
  
</script>	
{/literal}
</head>
<body>
<div id="floatboxcontent"></div> {* div for floatbox displays *}
<div id="wrapper">
{include file="content_header_v2.tpl"}

<form id="form1">
<br/>
<fieldset>
<label>Table:</label>{$tablelist} <label>Fields:</label><span id="fieldlist"></span> <br/>

</fieldset>
</form>
<center>
<input type="button" value="Find" onclick="sendPage('find');return false;"/>
<input type="button" value="Read" onclick="sendPage('read');return false;"/>
<input type="button" value="Insert" onclick="sendPage('insert');return false;"/>
<input type="button" value="Update" onclick="sendPage('update');return false;"/>
<input type="button" value="Delete" onclick="sendPage('delete');return false;"/>
<input type="button" value="Reset" onclick="resetDisplay()"/>
<input type="button" value="Help" onclick="xajax_page_help()"/>
<br/><br/>
</center>
{include file="footer.tpl"}
</div> {* wrapper *}