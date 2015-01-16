<?php /* Smarty version 2.6.21, created on 2014-07-10 21:19:46
         compiled from todays_loads.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pageheader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<link rel='stylesheet' href='calendar/calendar.css' title='calendar'>
<script language="javascript" src="calendar/setLongDateFormat.js"></script>
<script language="javascript" src="calendar/calendar.js"></script>

<?php echo '
<style>
	fieldset{
		width: 45%;
    padding: 10px; 
	}
	label{
		width: 90px;
	}
	#content{
		width: 80%;
		padding:20px;"
		border: 3px solid black;
	}
	body{ padding-top: 40px;}
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
<div id="floatboxcontent"></div> <div id="wrapper">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "content_header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="content" >
<form id="form1">
<center>
<br/><br/>
<fieldset>

<label>Unload Date:</label> <input readonly size="10" id='unload_date' name='unload_date' value='<?php echo $this->_tpl_vars['unload_date']; ?>
'/>
<img src='images/cal.gif' align='absmiddle' onmouseover="fnInitCalendar(this, 'unload_date', 'style=calendar_green.css,close=true')"> 
<br/>
<div id="agentdiv", name="agentdiv" style="display: none;"> 
<label style="width: 80px;">Agent:</label><?php echo $this->_tpl_vars['agentlist']; ?>
<br/>
</div>
<label>Driver Status:</label>
&nbsp;Active<input type='radio' id='ds_active' name='driver_status' value="1" checked/>
&nbsp;Inactive<input type='radio' id='ds_inactive' name='driver_status' value="0"/>
&nbsp;Both<input type='radio' id='ds_both' name='driver_status' value="2"/><br/>
</fieldset>
</center>
<center>
<br>
<input type="button" value="Submit" onclick="sendPage();return false;"/>
<input type="button" value="Help" onclick="xajax_page_help()"/>
<br/><br/>
</center>
</form>
<div id="searchresults" name="searchresults">
</div>
</div>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>