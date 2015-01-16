<center>
<div style="clear:both; margin-top:5px;">
{* Buttons are at the top so users do not have to scroll a lot. *}
<input type=button value="Update" onclick="sendPage('update')"/>
<input type=button value="Delete" onclick="confirmDelete()"/>
<input type=button value="Driver Display" onclick="ShowLoadOverlay(2)"/>
<label style="width: 100px; text-align: right;" onclick="showGrid(2)">Search:</label>
<img src="images/search.gif" onclick="showGrid()"/>

</div>
</center>

<form id="load1" name='load1'>
<input type="hidden" id="dprd", name="dprd"/><br/> {* Carries the delete password to the server *}
<input type="hidden" id="unloading" name="unloading" value=""/><br/> {* Carries the unload flag to the server *}
<input type="hidden" id="rowhash" name="rowhash" value="{$rowhash}"/> {* Carries the md 5 of the table ros *}
<div style="padding: 10px;">

<div id='leftcolumn' style='width:49%; Float:left;'>
<label style="width: 225px;">Load #</label>
<label>Driver</label>
<br/>
<input id='load_number' name='load_number' value='{$load_number}'/>
{$drivers}
<br>
<label style="width: 185px; text-align:left;">Phone Number List</label><br/>
{$phone_numbers}
<br>
<label style="width: 165px">ATI Agent</label>
<label>Booking Date</label><br/>
<input id='atiagent' name='atiagent' value='{$atiagent}'/>
<input style='margin-left: 20px;' id='booking_date' name='booking_date value='{$booking_date}'/>
<img src='images/cal.gif' align='absmiddle' onmouseover="fnInitCalendar(this, 'booking_date', 'style=calendar_green.css,close=true')"> 
&nbsp;<input type='checkbox' id='dispatched' name='dispatched' {$dispatched}/>&nbsp;
<span style='font-size: 12px; font-weight: bold; color: silver;'>Dispatched</span>
<br/>
<label style='width: 175px'>Pickup Date</label>
<label>Delivery Date</label>
<br/>
<input id='pickup_date' name='pickup_date' value='{$pickup_date}'/>
<img src='images/cal.gif' align='absmiddle' onmouseover="fnInitCalendar(this, 'pickup_date', 'style=calendar_green.css,close=true')"> 
&nbsp;
<input id='delivery_date' name='delivery_date' value='{$delivery_date}'/>
<img src='images/cal.gif' align='absmiddle' onmouseover="fnInitCalendar(this, 'delivery_date', 'style=calendar_green.css,close=true')"> 
<br>
<label style='width: 175px'>Pickup Location</label>
<label>Delivery Location</label>
<br>
<input id='pickup_location' name='pickup_location' value='{$pickup_location}'/>
<input style='margin-left: 25px;' id='delivery_location' name='delivery_location' value'{$delivery_location}'/>
<br/>
<label style='width: 83px'>Line Haul</label>
<label style='width: 83px;'>Accessorable</label>
<label>Gross</label>
<br>
<input size='10' id='line_haul' name='line_haul' value='{$line_haul}'/>
<input size='10' id='accessorial' name='accessorial' value='{$accessorial}' onblur='compute_gross();'/>
<input size='10' id='gross' name='gross' value='{$gross}'/>
<br/>
<label>Check Calls</label><br/>
<textarea id='check_calls' name='check_calls' cols='40' rows='8'>{$check_calls}</textarea>
</div>


<div id='rightcolumn' style='display:inline-block;width:49%; Float: right;'>
<label style='width: 145px'>Brokerage Company</label>
<label>Broker Agent</label>
<br/>
<input id='brokerageid' name='brokerageid' value='{$brokerageid}'/>
<input id='broker_agent' name='broker_agent' value='{$broker_agent}'/>
<br/>
<label style='width: 145px'>Broker Phone Number</label>
<label>Load Experience</label>
<br/>
<input id='broker_phone' name='broker_phone' value='{$broker_phone}'/>
<input id='load_experience' name='load_experience' value='{$load_experience}'/>
<input type='checkbox' id='addtocontracts' name='addtocontracts' {$addtocontracts}/>
<span style='font-size: 12px; font-weight: bold; color: silver;'>Add to Contracts</span>
<br/>
<label>Broker Notes</label><br/>
<textarea id='broker_notes' name='broker_notes' cols='50' rows='5'>{$broker_notes}</textarea>
<br/>
<label>Load Notes</label><br/>
<textarea id='load_notes' name='load_notes' cols='50' rows='5'>{$load_notes}</textarea>
</div>
</form>
