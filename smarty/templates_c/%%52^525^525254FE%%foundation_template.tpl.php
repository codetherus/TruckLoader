<?php /* Smarty version 2.6.21, created on 2012-09-13 17:55:56
         compiled from foundation_template.tpl */ ?>
<!DOCTYPE html>
<html>

<head>
<title><?php echo $this->_tpl_vars['title']; ?>
</title>
<?php echo $this->_tpl_vars['xajaxjs']; ?>
 <link rel="stylesheet" type="text/css" href="styles/truckloader.css">
<link type="text/css" rel="stylesheet" href="./floatbox/floatbox.css" />
<script type="text/javascript" src="./floatbox/floatbox.js"></script>	
<script type="text/javascript" src="JQueryUI/js/jquery-1.4.2.min.js"></script>
<script language="javascript" src="scripts/jquery.alerts.js"></script>
<link rel="stylesheet" type="text/css" href="styles/jquery.alerts.css" />
</head>

<body>

<div id="floatboxcontent"></div>

<div id="wrapper">

<div id="headerv2">
<?php echo $this->_tpl_vars['pgtitle']; ?>

<?php if ($this->_tpl_vars['dosearch']): ?>
<div style="display: inline-block; padding-right: 2px; float: right;">
<img src="images/search.gif" border="none"/>
<input id="search_term"/>
</div>
<?php endif; ?>
<?php if ($this->_tpl_vars['domenu']): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "brainjarmenu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?>
</div>

<div id="content">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['content'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<center>
<div id="footer">
<font class="notice">
Copyright &copy; <?php echo $this->_tpl_vars['footeryear']; ?>
 <?php echo $this->_tpl_vars['footertext']; ?>

</font>
</div>
</center>

</div> </body>
</html>