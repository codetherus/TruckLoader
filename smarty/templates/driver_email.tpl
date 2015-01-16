{*   Copyright(c) 2009 by RSI. All rights reserved.
		 This is the template for the load maintenance page.
*}
{include file="pageheaderv2.tpl"}
{include file="common_scripts.tpl"}
{literal}
<style>
  label{
    text-align: left;
    font-size: 12px;
  }  
</style>

{/literal}
</head>
<body onload="xajax_SetupEmail();">
<div id="floatboxcontent"></div>
<div id="wrapper" class="rc" style="margin-top: 20px;">
{include file="content_header_v2.tpl"}
<center>
<div style="clear:both; margin-top:5px;">
{* Buttons are at the top so users do not have to scroll a lot. *}
<input type=button value="Send Email" onclick="xajax_SendEmail(xajax.getFormValues('form1'));"/>
<input type=button value="Help" onclick="xajax_page_help()"/>
</div>

</center>


<form id="form1" name='form1'>
<input type="hidden" id="driverid" name="driverid"/>
<fieldset style="padding-left: 35px;width: 50%; margin: 0 auto;">
<label style="text-align: left">To:</label><br>
<input size="30" id="mailto" name="mailto" readonly/><br/>
<label style="text-align: left">Email:</label><br>
<input size="60" id="demail" name="demail"/><br/>
<label style="text-align: left;">Subject:</label><br/>
<input id="esubject" name="esubject" size="70"/><br/>
<label style="text-align: left;">Message:</label>
<textarea class="rztext"   id="emessage" name="emessage" cols ="60" rows="20"></textarea>
</fieldset>

{include file="footer.tpl"}

