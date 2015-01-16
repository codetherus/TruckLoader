{*   Copyright(c) 2009 by RSI. All rights reserved.
		 This is the user management page template
*}
{include file="pageheaderv2.tpl"}
{include file="common_scripts.tpl"}
<script language="javascript" src="scripts/user_editorv2.js?v=1"></script>
{literal}
<style>
	fieldset{
		width: 90%;
    padding: 10px;
    margin-bottom: 20px; 
	}

	label{
	 width: 120px;
	}

	#content{
		width: 42%;
		padding:20px;"
	}

	body{ 
    padding-top: 40px;
  }
</style>
{/literal}
</head>
<body>
<div id="floatboxcontent"></div> {* div for floatbox displays *}
<div id="wrapper">
{include file="content_header_v2.tpl"}
<div id="content" >
<form id="form1">
<fieldset>
<input type="hidden" id="current_record_id" name="current_record_id"/>
<br/>
<label>User Id:</label>
<input id='user' name='user'/><br/>
<label>Password:</label>
<input id='password' name='password'/><br/>
<label>Access Level:</label>
<span id="leveldiv">
{$levellist}
</span><br/>
<label>List Level:</label>
<span id="listleveldiv">
{$listlevellist}
</span><br/>
<label>User Name:</label>
<input id="user_name", name="user_name"/><br/>
<label>Office:</label>
<span id="officediv" name="officediv">
{$officelist}
</span><br/>
<label>Phone:</label>
<input id="phone" name="phone"/><br/>
<label>Fax:</label>
<input id="fax" name="fax"/><br/>
<label>Email:</label>
<input id="email" name="email"/><br/>
<label>Google Email</label>
<input id="google_id" name="google_id"/><br/>
<label>Google Password</label>
<input id="google_password" name="google_password"/><br/>
<label>Calendar HTML</label><br/>
<textarea id="calendar_html" name="calendar_html" cols="50" rows="2"></textarea>
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
</div>
{* global search results display *}
<div id="search_results"></div>

</div>
</center>
</div>
{include file="footer.tpl"}
