{*   Copyright(c) 2009 by RSI. All rights reserved.
		 This is the broker agent management page template
*}
{include file="pageheaderv2.tpl"}
{include file="common_scripts.tpl"}
<script language="javascript" src="scripts/broker_agent_editor.js?v=1"></script>
<script language="javascript" src="scripts/standard_hot_keys.js?v=1"></script>
{literal}
<style>
  select, input {
   margin-bottom: 3px;
   }
  
	fieldset{
		width: 300px;;
    padding: 10px;
    margin-left: 300px;
    margin-bottom: 20px; 
	}

	label{
	 width: 220px;
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
  
  function resetDisplay()
  {
    xajax.$('user').value='';
    xajax.$('password').value = '';
    xajax.$('level').selectedIndex = 0; 
    xajax.$('list_level').selectedIndex = 0;    
		xajax.$('user_name').value = '';
  }
</script>	
{/literal}
</head>
<body>
<div id="floatboxcontent"></div> {* div for floatbox displays *}
<div id="wrapper">
{* global search results display *}
<div id="search_results"></div>
{include file="content_header_v2.tpl"}

<form id="form1">
<input type="hidden", id="recid" name="recid" value=""/> {* Current record id *}
<br/>
<fieldset style="display: inline-block;">
<label style="text-align: right; width: 73px;">Brokerage:</label>
<span id='lbrokerage' name='lbrokerage'>{$brokerlist}</span><br/>
<label>Name:<input id='agent_name' name='agent_name'/></label><br/>
<label>Phone:<input id='agent_phone' name='agent_phone'/></label><br/>
<label>Fax:<input id='agent_fax' name='agent_fax'/></label><br/>
<label>Email:<input id='agent_email' name='agent_email'/></label><br/>
</fieldset>
</form>
<center>
<input type="button" value="Find" onclick="sendPage('find');return false;"/>
<input type="button" value="Insert" onclick="sendPage('insert');return false;"/>
<input type="button" value="Update" onclick="sendPage('update');return false;"/>
<input type="button" value="Delete" onclick="sendPage('delete');return false;"/>
<input type="button" value="Reset" onclick="resetDisplay()"/>
<input type="button" value="Help" onclick="xajax_page_help()"/>
<br/><br/>
</center>
{include file="footer.tpl"}
</div> {* wrapper *}