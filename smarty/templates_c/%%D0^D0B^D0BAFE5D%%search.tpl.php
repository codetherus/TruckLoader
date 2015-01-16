<?php /* Smarty version 2.6.21, created on 2014-07-10 21:19:21
         compiled from search.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pageheader.tpl", 'smarty_include_vars' => array()));
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
<body onload="xajax_PageSetup();xajax.$('searchvalue').focus()">
<div id="floatboxcontent"></div> 
<div id="wrapper">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "content_header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<form id="form1">
<br>
<fieldset>
<br>
<br>
<label>Search Element:</label>
<div style="display: inline" id="selements" name="selements"><?php echo $this->_tpl_vars['searchelements']; ?>
</div>
<br/><br/>
<label>Search Value:</label>
<input id="searchvalue" name="searchvalue"/> Leave blank for all drivers.
<br/><br/>
<label>Driver Status:</label>
&nbsp;Active<input type='radio' id='ds_active' name='driver_status' value="1" checked/>
&nbsp;Inactive<input type='radio' id='ds_inactive' name='driver_status' value="0"/>
&nbsp;Both<input type='radio' id='ds_both' name='driver_status' value="2"/><br/><br/>
<label>Search Order:</label>
&nbsp<input type='radio' id='ds_bydriver' name='search_order' value="driver" checked/>
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
<input type="button" value="Help" onclick="xajax_page_help('search')"/>
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