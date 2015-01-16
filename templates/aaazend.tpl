{*   Copyright(c) 2009 by RSI. All rights reserved.
		 This is the broker management page template
*}
{include file="pageheaderv2.tpl"}
{include file="common_scripts.tpl"}
<script language="javascript" src="rainforest/datetimepicker_css.js"></script>
{literal}
<style>
  label{
    display:inline-block;
    width: 100px;
    text-align: right;
    margin-right: 5px;
  }
</style>
<script>
  function sendforedit(id){
    jQuery('#eventid').val(id);
    xajax_EventEdit(xajax.getFormValues('form1'));
  }
  function sendfordelete(id){
    jQuery('#eventid').val(id);
    xajax_EventDelete(xajax.getFormValues('form1'));
  
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
<input type="hidden" id="eventid" name="eventid"/>
<fieldset style="width:50%;margin: 0 auto;">
<center>
<p><b>Create / Edit an Event</b></p>
</center>
<label>Event Title</label>
<input size="60" id="eventtitle" name="eventtitle"/><br/>
<label>Event Location</label>
<input size="60" id="where" name="where"/><br/>
<label>Description</label><br/>
<textarea style="margin-left: 110px;" id="desc" name="desc" cols="38" rows="5"></textarea><br/>
<label>Event Date/Time</label>
<input id="startdate" name="startdate"/>
<a href="javascript:NewCssCal('startdate','yyyymmdd','arrow',true)"><img src='images/cal.gif' align='absmiddle' width='16' height='16' border='none'/></a>
<br/>
<div id="eventlist" name="eventlist"></div>
<br/>
<center>
<!-- <input type="button" value="List Calendars" onclick="xajax_ListCalendars(xajax.getFormValues('form1'));"/> -->
<input type="button" value="List Events"    onclick="xajax_EventList(xajax.getFormValues('form1'));"/>
<input type="button" value="Create Event"   onclick="xajax_EventCreate(xajax.getFormValues('form1'))"/>
<br/>
</center>
</fieldset>
</form>
{include file="footer.tpl"}
</div> {* wrapper *}
