  {*  Copyright(c) 2010 by RSI. All rights reserved.
		 This is the template for the load maintenance page.
*}
{include file="pageheaderv2.tpl"}
{include file="common_scripts.tpl"}
{include file="zend_reminders_overlay.tpl"}
{include file="broker_agent_overlay.tpl"}
{include file="broker_editor_overlay.tpl"}
<script language="javascript" src="scripts/loads.js?v=1"></script>
<script language="javascript" src="rainforest/datetimepicker_css.js"></script>
{literal}
<style>
  label{
    text-align: left;
    font-size: 12px;
  }
</style>
{/literal}
<link rel="stylesheet" type="text/css" href="styles/jNice.css">
</head>
<body>
<div id="floatboxcontent"></div>
<div id="wrapper" style="margin-top: 40px;">
{* global search results display *}
<div id="search_results"></div>
{include file="content_header_v2.tpl"}
<center>
<div style="clear:both; margin-top:5px;">
{* Buttons are at the top so users do not have to scroll to get to them. *}
<input type=button value="Update" onclick="sendPage('update')"/>
<input type=button value="Help" onclick="xajax_page_help()"/>
<input type=button value="Delete" onclick="confirmDelete()"/>
<input type=button value="Add Load" onclick="sendPage('insert')"/>
</div>
</center>

<form id="form1" name='form1'>
<input type="hidden" id="dprd", name="dprd"/> {* Carries the delete password to the server *}
<input type="hidden" id="ldid", name="ldid"/> {* Carries the id of the load to be displayed *}
<input type="hidden" id="drid", name="drid"/> {* Carries the id of the driver of this load *}
<input type="hidden" id="unloading" name="unloading" value=""/> {* Carries the unload flag to the server *}
<input type="hidden" id="rowhash" name="rowhash" value="{$rowhash}"/> {* Carries the md 5 of the table ros *}
<div style="padding: 10px; display:inline-block;width:100%;">

<div id='leftcolumn' style='width:49%; Float:left;'>
<label onclick="sendPage('displaybyname')" style="width: 143px;">Load #<br/>
<input id='load_number' name='load_number' value='{$load_number}'/>
</label>
<label style="width: 150px;">Driver<br/>
<input id="driver_name" name="driver_name"/>
</label><br/>


<label style="width: 195px;">Phone Number List
<textarea class="rztext" style="display: inline-block;"id="phone_numbers", name="phone_numbers" rows="1" cols="25" >{$phone_numbers}</textarea>
</label><br/>

<label style="width:400px;">Booking Date<br/>
<input id='booking_date' name='booking_date' value='{$booking_date}'/>
<img src='images/cal.gif' align='absmiddle' onmouseover="fnInitCalendar(this, 'booking_date', 'style=calendar_green.css,close=true')"> 
<br/>
<input type='checkbox' id='dispatched' name='dispatched' value="1" {$dispatched}/>&nbsp;
<span style='font-size: 12px; font-weight: bold; color: grey;'>Dispatched</span>&nbsp;
<input type='checkbox' id='delivered' name='delivered' value="1" {$delivered}/>&nbsp;
<span style='font-size: 12px; font-weight: bold; color: grey;'>Delivered</span>
</label>
<br/>
<label style='width: 148px'>Pickup Date<br/>
<input size="10" id='pickup_date' name='pickup_date' value='{$pickup_date}'/>
<img src='images/cal.gif' align='absmiddle' onmouseover="fnInitCalendar(this, 'pickup_date', 'style=calendar_green.css,close=true')"> 
</label>
<label style="width: 168px;">Delivery Date<br/>
<input size="10" id='delivery_date' name='delivery_date' value='{$delivery_date}'/>
<img src='images/cal.gif' align='absmiddle' onmouseover="fnInitCalendar(this, 'delivery_date', 'style=calendar_green.css,close=true')"> 
</label>
<br/>
<label style='width: 148px'>Pickup Location<br/>
<input id='pickup_location' name='pickup_location' value='{$pickup_location}'/>
</label>
<label>Delivery Location<br/>
<input id='delivery_location' name='delivery_location' value'{$delivery_location}'/>
</label>
<br/>
<label style="width: 125px;" >ATI Agent<br/>
<span id="latiagent">{$atiagent}</span>
</label><br/>

<label style='width: 82px'>Line Haul<br><input size='10' id='line_haul' name='line_haul' value='{$line_haul}'/></label>
<label style='width: 82px;'>Accessorable<br/>
<input size='10' id='accessorial' name='accessorial' value='{$accessorial}' onblur='compute_gross();'/></label>
<label>Gross<br/><input size='10' id='gross' name='gross' value='{$gross}'/>
</label>
<br/>
<label>Check Calls</label><br/>
<textarea class="rztext" readonly id='check_calls' name='check_calls' cols='40' rows='8'>{$check_calls}</textarea>
</div>


<div id='rightcolumn' style='display:inline-block;width:49%; Float: right;'>
<label style='width: 145px' onclick="handleBrokerOverlay('show');">
<img style="height: 10px; width:10px;" src="images/add.gif"/>Brokerage Co.</label>
<label style = "width: 150px; margin-left: 5px;" onclick="showAgentOverlay();">
<img style="height: 10px; width:10px;" src="images/add.gif" />Broker Agent</label><br/>
<div style="display:inline-block">

<input onblur="sendPage('brokerinfo');" id="brokerageid" name="brokerageid" value="{$brokerageid}"/>
<input onblur="getAgentInfo();" id="broker_agent" name="broker_agent"/>
</div>


<br/>  
<label style="width: 150px;">Broker Phone<br/>
<input id='broker_phone' name='broker_phone' value='{$broker_phone}'/>
</label>
<label style="width: 165px;">Agent Phone<br/>
<input id="agent_phone" name="agent_phone" value='{$agent_phone}'/>
</label><br/>
<label>Load Experience<br/>
<input id='load_experience' name='load_experience' value='{$load_experience}'/>
</label>
<input style="margin-left: 40px;"type='checkbox' id='addtocontracts' name='addtocontracts' value="1" {$addtocontracts}/>
<span style='font-size: 12px; font-weight: bold; color: gray;'>Add to Contracts</span>
<br/>
<label>Broker Notes</label<br/>
<textarea class="rztext" id='broker_notes' name='broker_notes' cols='50' rows='6'>{$broker_notes}</textarea>

<label>Load Notes</label><br/>
<textarea class="rztext" id='load_notes' name='load_notes' cols='50' rows='6'>{$load_notes}</textarea>
<label onclick="showReminders()"><img style="height: 10px; width:10px;" src="images/add.gif" />Reminders</label><br/>
<textarea class="rztext" readonly id="reminderta" name="reminderta" rows="2" cols="50">{$reminder}</textarea>
</div>
</form>
{include file="footer.tpl"}
