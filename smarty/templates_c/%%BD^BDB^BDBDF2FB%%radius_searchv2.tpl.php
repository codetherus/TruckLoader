<?php /* Smarty version 2.6.21, created on 2014-02-12 22:50:57
         compiled from radius_searchv2.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pageheaderv2.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common_scripts.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script language="javascript" src="calendar/setDateFormat.js"></script>
<script language="javascript" src="scripts/radius_searchv2.js"></script>
<?php echo '
<style>
label{
  width: 100px;
}
#content{
  padding-left:150px;
</style>
'; ?>

</head>
<body onload="xajax.$('city').focus();">
<div id="floatboxcontent"></div>
<div id="wrapper">
<div id="search_results"></div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "content_header_v2.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="content" style="width: 70%;">
<form id="form1">
<fieldset style="border: 2px solid lime; width: 50%; padding: 1em; margin: 1em;">
<label>City:</label>
<input id="city" name="city"/><br/>
<label>State</label>
<?php echo $this->_tpl_vars['statelist']; ?>

<br/>
<label>Radius:</label>
<input id="radius" name="radius" size="3" value="50"/><br/>
<center>
<br/>
<input type="submit" value="Search" onclick="xajax_RadiusSearch(xajax.getFormValues('form1')); return false;"/>

</form>

</fieldset>
</center>
</div> </div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>