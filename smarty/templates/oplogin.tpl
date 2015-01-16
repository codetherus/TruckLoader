{*   Copyright(c) 2009 by RSI. All rights reserved. 
     Truck Loader one page site login template. 
*}
<form id="form1">
<fieldset style="padding-top: 15px;border:none;">
<center>
<label style="width:100px;">User Id:</label>
<input id="user" name="user" size="10"><br/><br/>
<label style="width:100px;">Password:</label>
<input type="password" id="password" name="password" size="10">
<br><br>
<center>
<input type="submit" value="Login" onclick="xajax_callUser('oplogin','login','oplogin',xajax.getFormValues('form1'));return false;"
<input type="button" value="help" onclick="xajax_page_help()">
<br><br>
</center>
</form>

