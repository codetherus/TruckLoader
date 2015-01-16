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
<body>
<div style="position:absolute; top: 150px; left: 10px;width: 100%;">
<div id="leftcontent">Left</div>
<div id="centercontent">Center</div>
<div id="rightcontent">Right</div>
</div>
<br/><br/>
<div id="wrapper">
<center>
<a style="color:white; font-weight: bold;" href="http://loadsbyjake.com/getquote.php">Click Here to Get a Load Quote From Loads By Jake</a><br/>
<a style="color:white; font-weight: bold;" href="http://localhost/Truck Loader/brokerlistv2.php">Click Here  to See a List of Available Drivers at Loads By Jake</a><br/>
<br/>
<a style="color:white; font-weight: bold;" href="http://localhost/Truck Loader/login.php">Login</a> 
</center><br/>
</div>
{include file="footer.tpl"}