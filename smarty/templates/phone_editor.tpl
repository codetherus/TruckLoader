{*   Copyright(c) 2009 by RSI. All rights reserved.
		 This is the user management page template
*}
{include file="pageheaderv2.tpl"}
{include file="common_scripts.tpl"}
<script language="javascript" src="scripts/standard_hot_keys.js?v=1"></script>
{literal}
<style>
  select, input {
   margin-bottom: 3px;
   }
  
	fieldset{
		width: 45%;
    padding: 10px;
    margin-left: 185px; 
    margin-bottom: 20px; 
	}

	label{
	 width: 120px;
   font-size: 12px;
   color: silver;
	}

	#content{
		width: 80%;
		padding:20px;"
	}

	body{ 
    padding-top: 40px;
  }
/*  
  input[type=button], input[type=reset]{
    background-color: white;
    color: black;
  }
*/  
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
<body onload="xajax.$('entity').focus()">
<div id="floatboxcontent"></div> {* div for floatbox displays *}
<div id="wrapper">
{* global search results display *}
<div id="search_results"></div>
{include file="content_header_v2.tpl"}
<div id="content" >
<form id="form1">
<input type="hidden" id="current_record_id", name="current_record_id" value=""/>
<br/>
<fieldset>
<label>Contact Type:</label>
<span id='lcontact_type' name=lcontact_type'>{$contact_type}</span><br/>
<label>Entity Type:</label>
<span id='lentity_type' name=lentity_type'>{$entity_type}</span><br/>
<label>Entity:</label>
<span id='lentity' name=lentity'>{$entityid}</span><br/>
<label>Number:</label>
<input id='entity' name='entity'/>
</fieldset>
</form>
<center>
<input type="button" value="Find" onclick="sendPage('find');return false;"/>
<input type="button" value="Insert" onclick="sendPage('insert');return false;"/>
<input type="button" value="Update" onclick="sendPage('update');return false;"/>
<input type="button" value="Delete" onclick="sendPage('delete');return false;"/>
<input type="button" value="Help" onclick="xajax_page_help()"/>
<br/><br/>
</center>
</div>
</div>
</div>
{include file="footer.tpl"}
