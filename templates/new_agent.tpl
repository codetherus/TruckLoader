{*   Copyright(c) 2009 by RSI. All rights reserved.
		 This is the template for the new agent input form.
*}
{include file="pageheader.tpl"}
{literal}
<style>
  label{
    /*text-align: left;*/
    font-size: 12px;
    color: silver;
  p{
    margin:0;
    padding:0;
  }
</style>
{/literal}
</head>
<body>
<div style="margin: 100px; margin-top: 10px;">
<div id="wrapper" style="margin-bottom: 15px;">
{include file="content_header.tpl"}
<center>
<form id="form2" name='form1' onsubmit="return false;">
<fieldset style="margin: 15px; margin-bottom: 15px;">
<p>
<label>Name:</label>
<input id="user_name" name="user_name"/>
</p>
<p>
<label>Login Id:</label>
<input id="user" name="user"/>
</p>
<p>
<label>Login Password:</label>
<input type="password" id="password" name="password"/>
</p>
<p>
<label>Access Level:</label>
<input id="level", name="level"/>
</p>
<label>List Level:</label>
<input id="list_level" name="list_level"/>
</p>
<p>
<label>Phone:</label>
<input id="user_phone" name="user_phone"/>
</p>
<p>
<label>Fax:</label>
<input id="user_fax" name="user_fax"/>
</p>
<p>
<label>Email:</label>
<input id="user_email" name="user_email"/>
</p>

</fieldset>
<br/>
<input type="submit" value="Submit" onclick="xajax_AddNewAgent(xajax.getFormValues('form2'))";
</form>
</div>
</div>
{include file="footer.tpl"}
