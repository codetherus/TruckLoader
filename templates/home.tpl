{*   Copyright(c) 2009 by RSI. All rights reserved. *}
{include file="pageheaderv2.tpl"}
{include file="common_scripts.tpl"}
<link rel="stylesheet" type="text/css" href="styles/truckloaderv2.css">
{literal}
<style>
body{
  /*background-color: black;*/
  background: -moz-linear-gradient(top,  #000,  #606066);    
}
#header{
  height: 145px;
	background-image: url("./images/droppedImage.gif") ;
	background-position: top center;
	background-repeat: no-repeat;
}
#wrapper{
  margin-top: 10px;
  border: none;
  background: -moz-linear-gradient(top,  #000,  #606066);
  height: 100%;    
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
a {
  text-decoration: none;
  color: yellow;
  }
a:hover{
  text-decoration: underline;
  color: #B5EDF0;
}
</style>
{/literal}
</head>
<body>
<div id="header">
</div>
<div id="wrapper">
{* "menu" div *}
<div style="float: left;font-size: 10px; text-align: left;margin: 5px; margin-left:10px;">
<a href="http://loadsbyjake.com/getquote.php">Get a Load Quote</a> |
<a href="http://loadsbyjake.com/brokerlistv2.php">See a List of Available Drivers</a> |
<a href="http://localhost/Truck Loader/login.php">Login</a>
</div><br/>
{* text columns *}
<div style="margin-top: 10px; margin-left: 10px;width: 100%; text-align: left; border: none;">
<div id="leftcontent">Services<br/>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ut diam tellus. Suspendisse pellentesque, orci vel tristique volutpat, nibh eros interdum purus, vel egestas ligula ligula eget odio. Praesent eget venenatis lacus. Vivamus consectetur porttitor arcu, ut ullamcorper metus aliquam eu. Vivamus congue leo posuere augue malesuada euismod consectetur justo fermentum. Nam at enim egestas nisl bibendum eleifend. Nam semper, lorem at sagittis malesuada, justo urna porttitor nibh, sit amet sagittis nisl erat vel tellus. Vivamus convallis risus justo, vitae interdum enim. Nullam ac magna id mauris tincidunt malesuada mattis nec eros. Quisque non nibh eget risus venenatis faucibus. </div>
<div id="centercontent">About Us<br/>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ut diam tellus. Suspendisse pellentesque, orci vel tristique volutpat, nibh eros interdum purus, vel egestas ligula ligula eget odio. Praesent eget venenatis lacus. Vivamus consectetur porttitor arcu, ut ullamcorper metus aliquam eu. Vivamus congue leo posuere augue malesuada euismod consectetur justo fermentum. Nam at enim egestas nisl bibendum eleifend. Nam semper, lorem at sagittis malesuada, justo urna porttitor nibh, sit amet sagittis nisl erat vel tellus. Vivamus convallis risus justo, vitae interdum enim. Nullam ac magna id mauris tincidunt malesuada mattis nec eros. Quisque non nibh eget risus venenatis faucibus. </div>
<div id="rightcontent">Products<br/>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ut diam tellus. Suspendisse pellentesque, orci vel tristique volutpat, nibh eros interdum purus, vel egestas ligula ligula eget odio. Praesent eget venenatis lacus. Vivamus consectetur porttitor arcu, ut ullamcorper metus aliquam eu. Vivamus congue leo posuere augue malesuada euismod consectetur justo fermentum. Nam at enim egestas nisl bibendum eleifend. Nam semper, lorem at sagittis malesuada, justo urna porttitor nibh, sit amet sagittis nisl erat vel tellus. Vivamus convallis risus justo, vitae interdum enim. Nullam ac magna id mauris tincidunt malesuada mattis nec eros. Quisque non nibh eget risus venenatis faucibus. </div>
</div>
{include file="footer.tpl"}
