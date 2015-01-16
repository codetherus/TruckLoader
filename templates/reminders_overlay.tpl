{*   Copyright(c) 2009 by RSI. All rights reserved.
		 This is the template for the reminders / tickler 
     overlay.
*}
<div id="remindersoverlay" name="remindersoverlay" style="width: 550px">
<h3>Tickler Management</h3>
<form id="formreminders" name='formreminders'>
<input type="hidden" id="rmsgtext" name="rmsgtext"/>
<input type="hidden" id="current_record_id" name="current_record_id"/>
<div id='leftcolumn' style='width:90%; margin-left: 5%;'>
<br/>
<fieldset style="padding-left: 25px;">
<label style="float:left;margin-left: 24px;">Subject</label><br/>
<input style="width: 90%"  id="subject" name="subject"/><br/>
<label style="float:left;margin-left: 24px;">Message</label><br/>
<textarea style="margin-left: 0px;" id="remessage" name="remessage" rows="10" cols="55"></textarea>
<label style="float:left;margin-left: 15px;width: 80px;">Frequency</label>
<label style="width:160px;">Begin Date/Time</label>
<label style="width: 100px">End Date/Time  </label><br/>
<span id="sfrequency" name="sfrequency">{$freqlist}</span>
<input id="begindate" name="begindate" size="20"/>
<a href="javascript:NewCssCal('begindate','yyyymmdd','arrow',true)"><img src='images/cal.gif' align='absmiddle'/></a>
<input id="enddate" name="enddate" size="20"/>
<a href="javascript:NewCssCal('enddate','yyyymmdd','arrow',true)"><img src='images/cal.gif' align='absmiddle'/></a>
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
{* Buttons are at the top so users do not have to scroll a lot. *}
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

