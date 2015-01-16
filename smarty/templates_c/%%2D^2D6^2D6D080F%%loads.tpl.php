<?php /* Smarty version 2.6.21, created on 2014-02-12 22:49:26
         compiled from loads.tpl */ ?>
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
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "zend_reminders_overlay.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "broker_agent_overlay.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "broker_editor_overlay.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script language="javascript" src="scripts/loads.js?v=1"></script>
<script language="javascript" src="rainforest/datetimepicker_css.js"></script>
<?php echo '
<style>
  label{
    text-align: left;
    font-size: 12px;
  }
</style>
'; ?>

<link rel="stylesheet" type="text/css" href="styles/jNice.css">
</head>
<body>
<div id="floatboxcontent"></div>
<div id="wrapper" style="margin-top: 40px;">
<div id="search_results"></div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "content_header_v2.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<center>
<div style="clear:both; margin-top:5px;">
<input type=button value="Update" onclick="sendPage('update')"/>
<input type=button value="Help" onclick="xajax_page_help()"/>
<input type=button value="Delete" onclick="confirmDelete()"/>
<input type=button value="Add Load" onclick="sendPage('insert')"/>
</div>
</center>

<form id="form1" name='form1'>
<input type="hidden" id="dprd", name="dprd"/> <input type="hidden" id="ldid", name="ldid"/> <input type="hidden" id="drid", name="drid"/> <input type="hidden" id="unloading" name="unloading" value=""/> <input type="hidden" id="rowhash" name="rowhash" value="<?php echo $this->_tpl_vars['rowhash']; ?>
"/> <div style="padding: 10px; display:inline-block;width:100%;">

<div id='leftcolumn' style='width:49%; Float:left;'>
<label onclick="sendPage('displaybyname')" style="width: 143px;">Load #<br/>
<input id='load_number' name='load_number' value='<?php echo $this->_tpl_vars['load_number']; ?>
'/>
</label>
<label style="width: 150px;">Driver<br/>
<input id="driver_name" name="driver_name"/>
</label><br/>


<label style="width: 195px;">Phone Number List
<textarea class="rztext" style="display: inline-block;"id="phone_numbers", name="phone_numbers" rows="1" cols="25" ><?php echo $this->_tpl_vars['phone_numbers']; ?>
</textarea>
</label><br/>

<label style="width:400px;">Booking Date<br/>
<input id='booking_date' name='booking_date' value='<?php echo $this->_tpl_vars['booking_date']; ?>
'/>
<img src='images/cal.gif' align='absmiddle' onmouseover="fnInitCalendar(this, 'booking_date', 'style=calendar_green.css,close=true')"> 
<br/>
<input type='checkbox' id='dispatched' name='dispatched' value="1" <?php echo $this->_tpl_vars['dispatched']; ?>
/>&nbsp;
<span style='font-size: 12px; font-weight: bold; color: grey;'>Dispatched</span>&nbsp;
<input type='checkbox' id='delivered' name='delivered' value="1" <?php echo $this->_tpl_vars['delivered']; ?>
/>&nbsp;
<span style='font-size: 12px; font-weight: bold; color: grey;'>Delivered</span>
</label>
<br/>
<label style='width: 148px'>Pickup Date<br/>
<input size="10" id='pickup_date' name='pickup_date' value='<?php echo $this->_tpl_vars['pickup_date']; ?>
'/>
<img src='images/cal.gif' align='absmiddle' onmouseover="fnInitCalendar(this, 'pickup_date', 'style=calendar_green.css,close=true')"> 
</label>
<label style="width: 168px;">Delivery Date<br/>
<input size="10" id='delivery_date' name='delivery_date' value='<?php echo $this->_tpl_vars['delivery_date']; ?>
'/>
<img src='images/cal.gif' align='absmiddle' onmouseover="fnInitCalendar(this, 'delivery_date', 'style=calendar_green.css,close=true')"> 
</label>
<br/>
<label style='width: 148px'>Pickup Location<br/>
<input id='pickup_location' name='pickup_location' value='<?php echo $this->_tpl_vars['pickup_location']; ?>
'/>
</label>
<label>Delivery Location<br/>
<input id='delivery_location' name='delivery_location' value'<?php echo $this->_tpl_vars['delivery_location']; ?>
'/>
</label>
<br/>
<label style="width: 125px;" >ATI Agent<br/>
<span id="latiagent"><?php echo $this->_tpl_vars['atiagent']; ?>
</span>
</label><br/>

<label style='width: 82px'>Line Haul<br><input size='10' id='line_haul' name='line_haul' value='<?php echo $this->_tpl_vars['line_haul']; ?>
'/></label>
<label style='width: 82px;'>Accessorable<br/>
<input size='10' id='accessorial' name='accessorial' value='<?php echo $this->_tpl_vars['accessorial']; ?>
' onblur='compute_gross();'/></label>
<label>Gross<br/><input size='10' id='gross' name='gross' value='<?php echo $this->_tpl_vars['gross']; ?>
'/>
</label>
<br/>
<label>Check Calls</label><br/>
<textarea class="rztext" readonly id='check_calls' name='check_calls' cols='40' rows='8'><?php echo $this->_tpl_vars['check_calls']; ?>
</textarea>
</div>


<div id='rightcolumn' style='display:inline-block;width:49%; Float: right;'>
<label style='width: 145px' onclick="handleBrokerOverlay('show');">
<img style="height: 10px; width:10px;" src="images/add.gif"/>Brokerage Co.</label>
<label style = "width: 150px; margin-left: 5px;" onclick="showAgentOverlay();">
<img style="height: 10px; width:10px;" src="images/add.gif" />Broker Agent</label><br/>
<div style="display:inline-block">

<input onblur="sendPage('brokerinfo');" id="brokerageid" name="brokerageid" value="<?php echo $this->_tpl_vars['brokerageid']; ?>
"/>
<input onblur="getAgentInfo();" id="broker_agent" name="broker_agent"/>
</div>


<br/>  
<label style="width: 150px;">Broker Phone<br/>
<input id='broker_phone' name='broker_phone' value='<?php echo $this->_tpl_vars['broker_phone']; ?>
'/>
</label>
<label style="width: 165px;">Agent Phone<br/>
<input id="agent_phone" name="agent_phone" value='<?php echo $this->_tpl_vars['agent_phone']; ?>
'/>
</label><br/>
<label>Load Experience<br/>
<input id='load_experience' name='load_experience' value='<?php echo $this->_tpl_vars['load_experience']; ?>
'/>
</label>
<input style="margin-left: 40px;"type='checkbox' id='addtocontracts' name='addtocontracts' value="1" <?php echo $this->_tpl_vars['addtocontracts']; ?>
/>
<span style='font-size: 12px; font-weight: bold; color: gray;'>Add to Contracts</span>
<br/>
<label>Broker Notes</label<br/>
<textarea class="rztext" id='broker_notes' name='broker_notes' cols='50' rows='6'><?php echo $this->_tpl_vars['broker_notes']; ?>
</textarea>

<label>Load Notes</label><br/>
<textarea class="rztext" id='load_notes' name='load_notes' cols='50' rows='6'><?php echo $this->_tpl_vars['load_notes']; ?>
</textarea>
<label onclick="showReminders()"><img style="height: 10px; width:10px;" src="images/add.gif" />Reminders</label><br/>
<textarea class="rztext" readonly id="reminderta" name="reminderta" rows="2" cols="50"><?php echo $this->_tpl_vars['reminder']; ?>
</textarea>
</div>
</form>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>