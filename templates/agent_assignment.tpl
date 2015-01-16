{*   Copyright(c) 2009 by RSI. All rights reserved.
		 5/6/2010
     Template for admin agent assignment page.
*}
{include file="pageheader.tpl"}
<link rel="stylesheet" href="styles/edit.css">
{literal}
<style
  fieldset{
   border: 2px solid green;
   padding: 15px;
   }
</style>
{/literal}
</head>
<body>
<div id="floatboxcontent"></div>
<div id="wrapper">
{include file="content_header.tpl"}
<br/><br/><br/><br/>
<fieldset style="width: 70%; margin-left:15%">
<br/>
<form id="form1" name='form1'>
<label>Drivers:</label>
{$driverlist}
<label>Agents</label>
{$agentlist}
<br/><br/>
<center>
<input type=button value="Assign Agent" onclick="xajax_AssignAgent(xajax.getFormValues('form1'))"/>
<input type=button value="Help" onclick="xajax_page_help()"/>
<br/>
</fieldset>
<br/> 
</form>
{include file="footer.tpl"}
