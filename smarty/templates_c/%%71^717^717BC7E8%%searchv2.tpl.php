<?php /* Smarty version 2.6.21, created on 2014-10-25 18:01:41
         compiled from searchv2.tpl */ ?>
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
<?php echo '
<style>
	fieldset{
		width: 75%; 
    margin-left: auto;    
    margin-right: auto;
	}
	label{
		width: 250px;
	}
	#content{
		width: 80%;
		padding:20px;"
		border: 3px solid black;
	}
	
</style>
<script>
	function sendPage()
	{
		fb.end();
		xajax_FindLoads(xajax.getFormValues(\'form1\'));
		return false;
	}
	
</script>	
'; ?>

</head>
<body onload="xajax_PageSetup();sendPage();">
<div id="floatboxcontent"></div> 
<div id="wrapper" style="margin-top: 150px;">
<div id="search_results"></div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "content_header_v2.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<form id="form1">
<br>
<fieldset>
<br>
<br>
<label>Driver Status:</label>
&nbsp;Active<input type='radio' id='ds_active' name='driver_status' value="Active" checked/>
&nbsp;Inactive<input type='radio' id='ds_inactive' name='driver_status' value="Inactive"/>
&nbsp;Both<input type='radio' id='ds_both' name='driver_status' value=""/><br/><br/>
<label>Search Order:</label>
&nbsp<input type='radio' id='ds_bydriver' name='search_order' value="name" checked/>
&nbsp;By Driver&nbsp;
&nbsp;<input type='radio' id='ds_bytruck' name='search_order' value="truck_no"/>
&nbsp;By Truck #<br/><br/>
<div id="agentdiv", name="agentdiv" style="display: none;"> 
<label>Agent:</label><?php echo $this->_tpl_vars['agentlist']; ?>
<br/><br/>
</div>
</fieldset>
<center>
<br>
<input type="submit" value="Submit" onclick="sendPage();return false;"/>
<input type="button" value="Help" onclick="xajax_page_help()"/>
</center>
</form>
<div id="searchresults" name="searchresults">
</div>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>