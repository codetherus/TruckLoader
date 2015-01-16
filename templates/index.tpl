{*   Copyright(c) 2009 by RSI. All rights reserved. *}
{include file="pageheaderv2.tpl"}
{include file="common_scripts.tpl"}
<link rel="stylesheet" type="text/css" href="styles/truckloaderv2.css">
{literal}
<style>
body{
	background-image: url("./images/droppedImage.gif") ;
	background-position: top center;
	background-repeat: no-repeat;
  background-color: black;
  
}
#wrapper{
  margin: 200px auto 10px;  
  border: 1px solid gray;  
  background: -moz-linear-gradient(top,  #ccc,  #000);    
  width: 400px;
  padding-bottom: 10px;
}
#inputfieldset{
  padding-top:15px;  
  border: none;
}
label{
  width: 100px;      
}
#content{
  margin-top: 30px;  
  border: none;
  background-color: #494949;  
  width: 260px;  
}
</style>
{/literal}
</head>
<body onload="document.getElementById('user').focus()">
<div id="wrapper">
{include file="content_headerv2.tpl"}
<form id="form1">
<div id="content">
<fieldset id="inputfieldset">
<label>User Id:</label>
<input id="user" name="user" size="10"><br/>
<label>Password:</label>
<input type="password" id="password" name="password" size="10"><br/><br/>
</fieldset>
</div>
<center>
<input type="submit" value="Login" onclick="xajax_login(xajax.getFormValues('form1')); return false;"/>
<br><br>
</center>
</form>
</div>
<center>
<a style="color:white; font-weight: bold;" href="http://loadsbyjake.com/getquote.php">Click Here to Get a Load Quote From Loads By Jake</a><br/>
<a style="color:white; font-weight: bold;" href="http://localhost/Truck Loader/brokerlistv2.php">Click Here  to See a List of Available Drivers at Loads By Jake</a>
</center><br/>
{include file="footer.tpl"}