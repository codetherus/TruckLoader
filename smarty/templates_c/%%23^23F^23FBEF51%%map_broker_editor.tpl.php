<?php /* Smarty version 2.6.21, created on 2014-11-12 03:39:17
         compiled from map_broker_editor.tpl */ ?>
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
<script language="javascript" src="scripts/broker_editor.js?v=1"></script>
<script language="javascript" src="scripts/standard_hot_keys.js?v=1"></script>
<?php echo '
<style>
  select, input {
   margin-bottom: 3px;
   }
  
	fieldset{
		width: 300px;;
    padding: 10px;
    margin-left: 300px;
    margin-bottom: 20px; 
	}

	label{
	 width: 220px;
	}

	#content{
		width: 80%;
		padding:20px;"
	}

	body{ 
    padding-top: 40px;
  }
</style>
<script>
  //Send the form and op code to the server.
	function sendPage(op)
	{
		fb.end();
		xajax_Process(xajax.getFormValues(\'form1\'),op);
		return false;
	}
  
  function resetDisplay()
  {
    xajax.$(\'user\').value=\'\';
    xajax.$(\'password\').value = \'\';
    xajax.$(\'level\').selectedIndex = 0; 
    xajax.$(\'list_level\').selectedIndex = 0;    
		xajax.$(\'user_name\').value = \'\';
  }
</script>	
'; ?>

</head>
<body>
<div id="floatboxcontent"></div> <div id="wrapper">
<div id="search_results"></div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "content_header_v2.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<form id="form1">
<input type="hidden", id="recid" name="recid" value=""/> <br/>
<fieldset style="display: inline-block;">
<label>Group:
<span id="grouptype"><?php echo $this->_tpl_vars['groupselect']; ?>
</span>
</label><br/>
<label>Company:<input id='name' name='name'/></label><br/>
<label>Address:<input id='address' name='address'/></label><br/>
<label>City:<input id='city' name='city'/></label><br/>
<label>State:<input id='state' name='state'/></label><br/>
<label>Zip:<input id='zipcode' name='zipcode'/></label><br/>
<label>Phone:<input id='phone' name='phone'/></label><br/>
<label>Website:<input id='website' name='website'/></label><br/>
<label>Email:<input id='email' name='email'/></label><br/>
</fieldset>
</form>
<center>
<input type="button" value="Find" onclick="sendPage('find');return false;"/>
<input type="button" value="Insert" onclick="sendPage('insert');return false;"/>
<input type="button" value="Update" onclick="sendPage('update');return false;"/>
<input type="button" value="Delete" onclick="sendPage('delete');return false;"/>
<input type="button" value="Reset" onclick="resetDisplay()"/>
<input type="button" value="Help" onclick="xajax_page_help()"/>
<br/><br/>
</center>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div> 