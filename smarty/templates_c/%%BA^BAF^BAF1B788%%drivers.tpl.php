<?php /* Smarty version 2.6.21, created on 2014-10-25 18:02:22
         compiled from drivers.tpl */ ?>
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
$this->_smarty_include(array('smarty_include_tpl_file' => "reminders_overlay.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script language="javascript" src="scripts/drivers.js?v=1"></script>
<script language="javascript" src="rainforest/datetimepicker_css.js"></script>

<?php echo '
<style>
  label{
    text-align: left;
    font-size: 12px;
  }  

  .hidden{ display: none}   
	.flexigrid div.fbutton .add
		{
			background: url(css/images/add.png) no-repeat center left;
		}	

	.flexigrid div.fbutton .delete
		{
			background: url(css/images/close.png) no-repeat center left;
		}
</style>

'; ?>

</head>
<body>

<div id="floatboxcontent"></div>
<div id="wrapper" class="rc" style="margin-top: 20px;width: 1000px;">
<div id="search_results"></div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "driver_contacts.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "driver_email.overlay.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "content_header_v2.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<center>
<div style="clear:both; margin-top:5px;">
<input type="button" value="Update" onclick="CheckLoadStatus()"/>
<input type="button" value="Add New Driver" onclick="sendPage('insert')"/>
<input type="button" value="Display Upload Info" onclick="xajax_DisplayUploadRecords(xajax.getFormValues('form1'))"/>
<input type="button" value="Help" onclick="xajax_page_help()"/>

</div>

</center>


<form id="form1" name='form1'>
<input type="hidden" id="dprd" name="dprd"/> <input type="hidden" id="unloading" name="unloading" value=""/> <input type="hidden" id="rowhash" name="rowhash" value=""/> <input type="hidden" id="current_driver_id" name="current_driver_id" value=""/>
<input type="hidden" id="current_load_id" name="current_load_id" value=""/>
<input type="hidden" id="load_number" name="load_number" value="<?php echo $this->_tpl_vars['load_number']; ?>
"/>
<input type="hidden" id="h_load_number" name="h_load_number" value=""/>
<input type="hidden" id="h_pickup_date" name="h_pickup_date" value=""/>
<input type="hidden" id="h_delivery_date" name="h_delivery_date" value=""/>
<input type="hidden" id="h_pickup_location" name="h_pickup_location" value=""/>
<input type="hidden" id="h_delivery_location" name="h_delivery_location" value=""/>
<input type="hidden" id="h_driverphone" name="h_driverphone"/>
<input type="hidden" id="h_drivercell" name="h_drivercell"/>
<input type="hidden" id="h_driverfax" name="h_driverfax"/>
<input type="hidden" id="h_driveremail" name="h_driveremail"/>
<input type="hidden" id="load_status" name="load_status" value="nochange"/>
<div style="display: inline-block;">

<div id='leftcolumn' style='width:310px; Float:left;'>
<label style='width: 300px;'>Driver
<br/>
<input type="text" style="width: 225px;" id="name" name="name" value="<?php echo $this->_tpl_vars['name']; ?>
" />
</label>
<br/>
<!-- 
<label style='width: 145px;'>Pickup Date<br/>
<input style="width: 100px;" id='pickup_date' name='pickup_date' value='<?php echo $this->_tpl_vars['pickup_date']; ?>
'/>
<img src='images/cal.gif' align='absmiddle' onmouseover="fnInitCalendar(this, 'pickup_date', 'style=calendar_green.css,close=true')"> 
</label>
-->
<label style='width: 150px;'>Delivery Date<br/>
<input style='width: 100px;'id='delivery_date' name='delivery_date' value='<?php echo $this->_tpl_vars['delivery_date']; ?>
'/>
<img src='images/cal.gif' align='absmiddle' onmouseover="fnInitCalendar(this, 'delivery_date', 'style=calendar_green.css,close=true')"> 
</label>
<br/>
<!--
<label style='width: 145px'>Pickup Location<input id="pickup_location" name="pickup_location"/></label>
-->
<label style="width: 150px;">Delivery Location<br/>
<input id="delivery_location" name="delivery_location"/></label>
<br/>
<label style="width: 230px; text-align:left;" onclick="showContacts();" title="Click to show phone editor.">
<img style="height: 10px; width:10px;" src="images/add.gif"/>Contact Numbers<br/>

<textarea class="rztext" readonly id="phone_numbers" name="phone_numbers" rows="2" 
style="width: 225px;"><?php echo $this->_tpl_vars['phone_numbers']; ?>
</textarea></label>
<br/>
<label style="width: 165px">Driver Comments</label><br/>
<textarea class="rztext" style="width: 225px;" id='comments' name='comments' rows='5'><?php echo $this->_tpl_vars['comments']; ?>
</textarea>
<br/>
<label style="width: 82px;">Canada<br/><span id="lcanada" name="lcanada"><?php echo $this->_tpl_vars['canadalist']; ?>
</span></label>
<label>TWIC<br/><span id="ltwiclist"><?php echo $this->_tpl_vars['twiclist']; ?>
</span></label>
<br/>
<label style='width:150px;' >Canada Limitations</label><br/>
<textarea class="rztext" rows="2" style="width: 225px;"
          id='canada_limitations' name='canada_limitations'> <?php echo $this->_tpl_vars['canada_limitationss']; ?>
</textarea>          
<br/>
<label style="width: 175px">Tarps</label><br/>
<input type="checkbox" name="no_tarps" value="1">
<span class="spantext" >None</span>
<input id="f4ft_tarps" style='margin-left: 5px' type="checkbox" name="f4ft_tarps" value="1">
<span class="spantext">4ft</span>
<input id="f6ft_tarps" style='margin-left: 5px' type="checkbox" name="f6ft_tarps" value="1">
<span class="spantext">6ft</span>
<input id="f8ft_tarps" style='margin-left: 5px' type="checkbox" name="f8ft_tarps" value="1">
<span class="spantext">8ft</span>
<br/>
<label style="width: 80px;">Pipe Stakes<br/><span id="lpipestakes" name="lpipestakes"><?php echo $this->_tpl_vars['pipestakes']; ?>
</span></label>
<label style="width: 90px;">Load Levelers<br/><span id="lloadlevelers" name="lloadlevelers"><?php echo $this->_tpl_vars['loadlevelers']; ?>
</span></label>
<label style="width: 90px">Pole Bunks<br/><span id="lpolebunks" name="lpolebunks"><?php echo $this->_tpl_vars['polebunks']; ?>
</span></label>
</div>

<div id='centercolumn' style='padding-left: 4px; display:inline-block;width:300px; Float: left;'>
<label style='width: 143px;' >Truck #<br/><input id='truck_no' name='truck_no' value='<?php echo $this->_tpl_vars['truck_no']; ?>
'/></label><br/>
<!-- <label>Load #<br/><input id="load_number" name="load_number" value="<?php echo $this->_tpl_vars['load_number']; ?>
"/></label><br/> -->
<label style="width: 144px;">Home Office<br/><input id="home_office" name="home_office"/></label>
<label>Rating<br/><input size="5" id="rating" name="rating" value="<?php echo $this->_tpl_vars['rating']; ?>
"/></label><br/>
<label style='width: 75px;'>Length<br/>
<span id="ltlength"><?php echo $this->_tpl_vars['tlength']; ?>
</span>
</label>
<label style="width: 75px;">Width<br/>
<span id="ltwidth"><?php echo $this->_tpl_vars['twidth']; ?>
</span>
</label>
<label style='width: 135px;'>Trailer<br/><span id="lttype" ><?php echo $this->_tpl_vars['ttype']; ?>
</span></label>
<br/>
<label style="width:145px;">Home Town<br/><input id="home_town" name="home_town"/></label>
<label>Status<br/><span id="lstatus" ><?php echo $this->_tpl_vars['status']; ?>
</span></label><br/>
<label>Driver Limitations</label><br/>
<textarea class="rztext" id='driving_limitations' name='driving_limitations' rows='4' cols='32'><?php echo $this->_tpl_vars['driving_limitations']; ?>
</textarea>
<br/>
<!--
<label>Check Call</label><br/>
<textarea class="rztext" id='check_call' name='check_call' rows='2' cols='32'><?php echo $this->_tpl_vars['check_call']; ?>
</textarea>
<br/>
<label>Load Options</label><br/>
<textarea class="rztext" id='load_options' name='load_options' rows='5' cols='32'><?php echo $this->_tpl_vars['load_options']; ?>
</textarea>
-->
<label onclick="addTimestamp()"><img style="height: 10px; width:10px;" src="images/add.gif"/>Notes</label><br/>
<textarea class="rztext" style="color: white;" id="notes" name="notes" cols="32" rows="5"></textarea>
<label style="width: 175px;">Desired Destination</label><br/>
<textarea class="rztext" style="color:white;" id="zones" name="zones" cols="32" rows="5"></textarea>

</div>

<div id='rightcolumn' style='padding-left: 4px; display:inline-block; width:310px; Float: right;'>
<label>Driver Agent<br/><span id="lagent_list" ><?php echo $this->_tpl_vars['agent_list']; ?>
</span></label><br/>
<label>Agent Info</label><br/>
<textarea class="rztext" id='agent_info' name='agent_info' rows='2' cols='32'><?php echo $this->_tpl_vars['agent_info']; ?>
</textarea><br/><br/>
<label style="width: 175px;">Co or Broker Truck<br/><span id="lcobroker_list" ><?php echo $this->_tpl_vars['cobroker_list']; ?>
</span></label><br/>
<div style="background-color: white;">
<script src="http://www.gmodules.com/ig/ifr?url=http://www.google.com/ig/modules/calendar3.xml&amp;up_calendarFeeds=&amp;up_calendarColors=&amp;up_firstDay=0&amp;up_dateFormat=0&amp;up_timeFormat=1%3A00pm&amp;up_showDatepicker=1&amp;up_hideAgenda=0&amp;up_showEmptyDays=1&amp;up_showExpiredEvents=1&amp;synd=open&amp;w=300&amp;h=447&amp;title=Loads+By+Jake+Calendar&amp;lang=en&amp;country=ALL&amp;border=%23ffffff%7C3px%2C1px+solid+%23999999&amp;output=js"></script>
</div>
</div>
</div>
</form>

</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


