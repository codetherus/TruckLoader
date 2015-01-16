<?php /* Smarty version 2.6.21, created on 2014-11-11 23:25:25
         compiled from todays_loadsV2.tpl */ ?>
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
<link rel='stylesheet' href='calendar/calendar.css' title='calendar'>
<script language="javascript" src="calendar/setLongDateFormat.js"></script>
<script language="javascript" src="calendar/calendar.js"></script>
<script language="javascript" src="scripts/todays_loadsV2.js"></script>
<?php echo '
<style>
	label{
		width: 150px;
	}
  fieldset{
    margin: 0 auto;
    width: 45%; 
    padding: 10px;    
    color: blue;
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
<body onload="xajax_PageSetup();">
<div id="floatboxcontent"></div> <div id="wrapper" style="margin-top: 50px;"> <div id="search_results"></div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "content_header_v2.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<form id="form1">
<br/><br/>

<fieldset>
<label>Unload Date:</label> 
<input readonly size="10" id='unload_date' name='unload_date' value='<?php echo $this->_tpl_vars['unload_date']; ?>
'/>
<img src='images/cal.gif' align='absmiddle' onmouseover="fnInitCalendar(this, 'unload_date', 'style=calendar_green.css,close=true')"> 
<br/>
<div id="agentdiv", name="agentdiv" style="display: none;"> 
<label style="margin-right: 5px;">Agent:</label><?php echo $this->_tpl_vars['agentlist']; ?>
<br/>
</div>
<label>Driver Status:</label>
&nbsp;Active<input type='radio' id='ds_active' name='driver_status' value="Active" checked/>
&nbsp;Inactive<input type='radio' id='ds_inactive' name='driver_status' value="Inactive"/>
&nbsp;Both<input type='radio' id='ds_both' name='driver_status' value=""/><br/>
</fieldset>
 
<center>
<br>
<input type="button" value="Submit" onclick="sendPage();return false;"/>
<input type="button" value="Help" onclick="xajax_page_help()"/>
<br/><br/>
</center>
</form>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>