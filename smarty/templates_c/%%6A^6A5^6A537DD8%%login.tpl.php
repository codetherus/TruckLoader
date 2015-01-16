<?php /* Smarty version 2.6.21, created on 2014-10-25 18:01:28
         compiled from login.tpl */ ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pageheaderv2.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php echo '
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
'; ?>

</head>
<body onload="document.getElementById('user').focus()">
<div id="wrapper">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "content_headerv2.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
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
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>