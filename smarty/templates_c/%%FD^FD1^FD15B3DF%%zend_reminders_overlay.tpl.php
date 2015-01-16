<?php /* Smarty version 2.6.21, created on 2014-02-12 22:49:26
         compiled from zend_reminders_overlay.tpl */ ?>
<div id="remindersoverlay" name="remindersoverlay" style="width: 550px">
<h3>Calendar Events Management</h3>
<form id="formreminders" name='formreminders'>
<input type="hidden" id="desc" name="desc"/>
<input type="hidden" id="eventid" name="eventid"/>
<input type="hidden" id="current_record_id" name="current_record_id"/>
<div id='leftcolumn' style='width:90%; margin-left: 5%;'>
<br/>
<fieldset style="padding-left: 25px;">
<label style="float:left;margin-left: 24px;width:55px;">Calendar</label>
<span style="float:left;" id="calendarlistspan"></span><br>

<label style="float:left;margin-left: 24px;">Title</label><br/>
<input style="width: 90%"  id="eventtitle" name="eventtitle"/><br/>
<label style="float:left;margin-left: 24px;">Location</label><br/>
<input style="width: 90%"  id="where" name="where"/><br/>

<label style="float:left;margin-left: 24px;">Description</label><br/>
<textarea style="margin-left: 0px;" id="remessage" name="remessage" rows="10" cols="55"></textarea>
<label style="float:left;margin-left: 15px;width: 80px;">Frequency</label>
<label style="width:160px;">Start Date/Time</label>
<label style="width: 100px">End Date/Time  </label><br/>
<span id="sfrequency" name="sfrequency"><?php echo $this->_tpl_vars['freqlist']; ?>
</span>
<input id="startdate" name="startdate" size="20"/>
<a href="javascript:NewCssCal('startdate','yyyymmdd','arrow',true)"><img src='images/cal.gif' align='absmiddle'border='none'/></a>
<input id="enddate" name="enddate" size="20"/>
<a href="javascript:NewCssCal('enddate','yyyymmdd','arrow',true)"><img src='images/cal.gif' align='absmiddle'border='none'/></a>
<br>
<label style="margin-left: 15px;float: left;width:150px;border:">Driver<br/>
<input id='tdriver' name='tdriver' style='float:left;'/>
</label>
<label style="margin-left: 15px;float:left;width:150px;">Load Id<br/>
<input id='tload' name='tload' style='float:left;'/>
</label><br/>
<br/>


</fieldset>
<br/><br/>
<div style="clear:both;">
<center>
<input type=button value="List" onclick="sendReminderPage('list')"/>
<input type=button value="Update" onclick="sendReminderPage('update')"/>
<input type=button value="Add" onclick="sendReminderPage('insert')"/>
<input type=button value="Delete" onclick="sendReminderPage('delete')"/>
<input type=button value="Close" onclick="hideReminders()"/>
</center>
</div>
</form>
</div>
</div>
<div id="usercalendar" 
style="display: none;position: absolute; top: 150px; left: 100px; z-index: 100;
background-color: white;border: 3px solid gray;"></div>