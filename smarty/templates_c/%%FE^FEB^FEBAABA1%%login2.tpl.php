<?php /* Smarty version 2.6.21, created on 2013-05-15 20:01:22
         compiled from login2.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pageheader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<link rel="stylesheet" type="text/css" href="styles/truckloader.css">
</head>
<body onload="xajax.$('user').focus();">
<div id="floatboxcontent"></div> <div id="wrapper">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "content_header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<form id="form1">
<div id="content">
<fieldset style="padding-top: 15px;border:none;">
<label style="width:150px;">User Id:</label>
<input id="user" name="user" size="10"><br/><br/>
<label style="width:150px;">Password:</label>
<input type="password" id="password" name="password" size="10">
<br><br>
</div>
<center>
<input type="submit" value="Login" onclick="xajax_login(xajax.getFormValues('form1')); return false;"/>
<input type="button" value="help" onclick="xajax_page_help()">
<br><br>
</center>
</form>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>