{*   Copyright(c) 2009 by RSI. All rights reserved.
		 This is the template for the reminders / tickler page.
*}
{include file="pageheaderv2.tpl"}
{include file="common_scripts.tpl"}
<link rel='stylesheet' href='styles/jquery.autocomplete.css'>
<link rel='stylesheet' href='styles/jquery-ui-1.7.3.custom.css'>
<link rel='stylesheet' href='styles/flexigrid.css?v=1'>
<link rel='stylesheet' href='rainforest/rfnet.css?v=1'>
<script language="javascript" src="rainforest/datetimepicker_css.js"></script>
<script language="javascript" src="scripts/fleegix.js"></script>
<script language="javascript" src="scripts/fleegix.form.diff.js"></script>
<script language="javascript" src="scripts/jquery.autocomplete.js"></script>
<script language="javascript" src="scripts/flexigrid.js"></script>
<script language="javascript" src="scripts/shortcut.js"></script>
<script language="javascript" src="scripts/reminders.js?v=1"></script>

{literal}
<style>
  label{
    text-align: left;
    font-size: 12px;
    
  }  

  .hidden{ display: none}   
	.flexigrid div.fbutton .add
		{
			background: url(css/images/add.png) no-repeat center left;
		}	

	.flexigrid div.fbutton .delete
		{
			background: url(css/images/close.png) no-repeat center left;
		}	

   
    
</style>

{/literal}
</head>
<body style="background-color: black;">


<div id="floatboxcontent"></div>
<div id="wrapper" style="margin-top:50px;">
{include file="content_header_v2.tpl"}
<center>
<div style="clear:both; margin-top:5px;">
{* Buttons are at the top so users do not have to scroll a lot. *}
<input type=button value="List" onclick="sendPage('list')"/>
<input type=button value="Update" onclick="sendPage('update')"/>
<input type=button value="Add" onclick="sendPage('insert')"/>

<input type=button value="Help" onclick="xajax_page_help()"/>
<input type=button value="Delete" onclick="sendPage('delete')"/>
</div>
</center>
<div>
<form id="form1" name='form1'>
<input type="hidden" id="unloading" name="unloading" value=""/> {* Carries the unload flag to the server *}
<input type="hidden" id="rowhash" name="rowhash" value=""/> {* Carries the md 5 of the table ros *}
<input type="hidden" id="current_record_id" name="current_record_id" value=""/>
<div style="padding: 10px;">

<div id='leftcolumn' style='width:90%; margin-left: 5%;'>
<br/><br/>
<fieldset style="padding-left: 25px;">
<label>Subject</label><br/>
<input style="width: 90%"  id="subject" name="subject"/><br/>
<label>Message</label><br/>
<textarea id="message" name="message" rows="6" style="width: 90%"></textarea><br/>
<label style="width: 85px;">Frequency</label><label style="width:145px">Begin Date/Time</label><label>End Date/Time  </label><br/>
<span id="sfrequency" name="sfrequency">{$freqlist}</span>
<input id="begindate" name="begindate" size="20"/>
<a href="javascript:NewCssCal('begindate','yyyymmdd','arrow',true)"><img src='images/cal.gif' align='absmiddle'/></a>
<input id="enddate" name="enddate" size="20"/>
<a href="javascript:NewCssCal('enddate','yyyymmdd','arrow',true)"><img src='images/cal.gif' align='absmiddle'/></a>
</fieldset>
</div>

{include file="footer.tpl"}

