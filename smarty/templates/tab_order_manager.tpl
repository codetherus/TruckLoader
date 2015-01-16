{*   Copyright(c) 2009 by RSI. All rights reserved.
		 This is the screen tab order customization page template.
*}
{include file="pageheader.tpl"}
{literal}
<script>
 function sendPage(op)
 {
   xajax_Dispatch(op, xajax.getFormValues('form1'));
 }
</script>
{/literal}
</head>
<body>
<div id="floatboxcontent"></div>
<div id="wrapper">
{include file="content_header.tpl"}
<form id="form1" name='form1'>
<fieldlist>
<center>
<br>
{$pagelist}<input type=button value="Read Definitions" onclick="sendPage('read')"/>
<br>


<center>
<div style="clear:both">
<br/>

<input type=button value="Update" onclick="sendPage('update')"/>
<input type=button value="Delete" onclick="sendPage('delete')"/>
<input type=button value="Help" onclick="xajax_page_help()"/>
<br/><br/>
<div id="tabset" name="tabset"></div>
</div>
</form>
</center>
</div>
{include file="footer.tpl"}
