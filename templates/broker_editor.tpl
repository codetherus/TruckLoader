{*   Copyright(c) 2009 by RSI. All rights reserved.
		 This is the broker management page template
*}
{include file="pageheaderv2.tpl"}
{include file="common_scripts.tpl"}
<script language="javascript" src="scripts/broker_editor.js?v=1"></script>
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
<label>Company:<input id='company' name='company'/></label><br/>
<label>Address:<input id='address1' name='address1'/></label><br/>
<label>&nbsp;<input id='address2' name='address2'/></label><br/>
<label>City:<input id='city' name='city'/></label><br/>
<label>State:<input id='state' name='state'/></label><br/>
<label>Zip:<input id='zip' name='zip'/></label><br/>
<label>Phone:<input id='phone' name='phone'/></label><br/>
<label>Cell:<input id='cell' name='cell'/></label><br/>
<label>Fax:<input id='fax' name='fax'/></label><br/>
<label style="text-align:left;margin-left: 20px;">Notes:<br/><textarea class="rztext" id="notes" name="notes" rows="3" cols="30"></textarea></label><br/>
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