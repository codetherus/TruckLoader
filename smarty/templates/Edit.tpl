{*   Copyright(c) 2009 by RSI. All rights reserved.
		 This is the screen Edit page template.
*}
{include file="pageheader.tpl"}
<link rel='stylesheet' href='calendar/calendar.css' title='calendar'>
<script language="javascript" src="calendar/setDateFormat.js"></script>
<script language="javascript" src="calendar/calendar.js"></script>
<script language="javascript" src="scripts/fleegix.js"></script>
<script language="javascript" src="scripts/fleegix.form.diff.js"></script>
<script language="javascript" src="scripts/edit.js"></script>
<link rel="stylesheet" href="styles/edit.css">
</head>
<body>
<div id="floatboxcontent"></div>
<div id="wrapper">
{include file="content_header.tpl"}
<center>
<div style="clear:both; margin-top:5px;">
{* Buttons are at the top so users do not have to scroll a lot. *}
<input type=button value="Update" onclick="sendPage('update')"/>
<input type=button value="Private Notes" onclick="xajax_OpenPrivateNotes(xajax.getFormValues('form1'))"/>
<input type=button value="Load History" onclick="show_load_history()"/>
<input type=button value="Driver List" onclick="sendPage('listdrivers')"/>
<input type=button value="Help" onclick="xajax_page_help()"/>
<input type=button value="Delete" onclick="confirmDelete()"/>
<input type=button value="Display Upload Info" onclick="xajax_DisplayUploadRecords(xajax.getFormValues('form1'))"/>
</div>
</center>

<form id="form1" name='form1'>
<input type="hidden" id="dprd", name="dprd"/><br/> {* Carries the delete password to the server *}
<input type="hidden" id="unloading" name="unloading" value=""/><br/> {* Carries the unload flag to the server *}

<div style="padding: 10px;">

<div id='leftcolumn' style='width:29%; Float:left;'>
<label style="font-weight: 900; font-size: 18px;" onclick="xajax_DriverSearch(xajax.getFormValues('form1'));"
 title="Click to search on the entered name (all or partial).">Driver:</label>
 <input id='driver' name='driver' value='{$driver}'/ tabindex='1'><br/>
<label>Location:</label> <input id='location' name='location' value='{$location}' tabindex='2'/><br/>
<label>Home Town:</label> <input id='home_town' name='home_town' value='{$home_town}' tabindex='3'/><br/>
<label>Telephone:</label> <input id='telephone' name='telephone' value='{$telephone}' tabindex='4'/><br/>
<label style="margin-right: 6px">Driver Email:</label><input id="email" name="email" value='{$email}' tabindex='5'/><br/>
<label>Home Office:</label> <input id='home_office' name='home_office' value='{$home_office}' tabindex='6'/><br/>
<label>Rec #:</label>&nbsp;<input size="6" readonly id="driverid" name="driverid" value="{$driverid}"/><br/><br/>
<label style="margin-top:5px">Comments:</label><br/>
<textarea style='margin-left: 30px;' rows='5' cols='20' id='comments' name='comments'  tabindex='100'>{$comments}</textarea><br/>
<label  style="width: 150px;">Upload Comments:</label><br/>
<textarea style='margin-left: 30px;' rows='5' cols='20' id='upload_comment' name='upload_comment' tabindex='101' >{$upload_comment}</textarea><br/>
<br/><label onclick="xajax_SearchAll(xajax.$('searchall').value)" title="Click to search">Search All:</label>
<input id="searchall" name="searchall" size="12" onblur="xajax_SearchAll(this.value)"/>
</div>

<div id='centercolumn' style='display:inline-block;width:31%; Float:left;'>
<label>Driver Alias</label> <input id='driver_alias' name='driver_alias' value='{$driver_alias}' tabindex='7'/><br/>
<label>Unload Date:</label> <input id='unload_date' name='unload_date' value='{$unload_date}' tabindex='8'/>
{* Calendar control for unload date *}
<img src='images/cal.gif' align='absmiddle' onmouseover="fnInitCalendar(this, 'unload_date', 'style=calendar_green.css,close=true')"> 
<br/>
<label>Equipment:</label>
<span id="truck_length">{$truck_length}</span>
<span id="truck_type">{$truck_type}</span><br/>
<label>From Upload:</label>
{$uploadequipment}<br/>
<label>Truck Number:</label> <input id='truck_no' name='truck_no' value='{$truck_no}' tabindex='11'/><br/>
<label>Office Number:</label> <input id='office_numbers' name='office_numbers' value='{$office_numbers}' tabindex='12'/><br/>
<label style="margin-right: 5px">Rating:</label><input size="3" id="rating" name="rating" value="{$rating}"/><br/><br/>
<label style="margin-top:5px;">Preferences:</label><br/>
<textarea style='margin-left: 30px;' rows='5' cols='20' id='preferences' name='preferences' tabindex='102' >{$preferences}</textarea><br/>
<label style="width: 150px;">Driving Limitations:</label><br/>
<textarea style='margin-left: 30px;' rows='5' cols='20' id='driving_limitations' name='driving_limitations' tabindex='103' >{$driving_limitations}</textarea><br/>		
</div>

<div id='rightcolumn' style='display:inline-block;width:39%; Float:left;'>
<label style="width: 150px;">Load Status: U/P/L</label>
<input type='radio' id='ls_unloaded' name='load_status' value="3" {$ls_unloaded} tabindex='13'/>
<input type='radio' id='ls_planned' name='load_status' value="1" {$ls_planned} tabindex='14'/>
<input type='radio' id='ls_loaded' name='load_status' value="2" {$ls_loaded} tabindex='15'/><br/>
<label style="width: 150px;">Canada: Y/N/?</label>
<input type='radio' id='canada' name='canada' value="1"{$canada} tabindex='16'/>
<input type='radio' id='no_canada' name='canada' value="2" {$no_canada} tabindex='17'/>
<input type='radio' id='dk_canada' name='canada' value="3" {$dk_canada} tabindex=18'/><br/>
<label style="width: 150px;">TWIC:Y/N/?</label> 
<input type='radio' id='twic' name='twic' value="1"{$twic} tabindex='19'/>
<input type='radio' id='no_twic' name='twic' value="2" {$no_twic} tabindex='20'/>
<input type='radio' id='dk_twic' name='twic' value="3" {$dk_twic} tabindex='21'/><br/>
<label style="width: 150px;">Load Levelers:Y/N/?</label> 		
<input type='radio' id='load_levelers' name='load_levelers' value="1" {$load_levelers} tabindex='22'/>
<input type='radio' id='no_load_levelers' name='load_levelers' value="2" {$no_load_levelers} tabindex='23'/>
<input type='radio' id='dk_load_levelers' name='load_levelers' value="3" {$dk_load_levelers} tabindex='24'/><br/>
<label style="width: 150px;">Pipe Stakes:Y/N/?</label> 
<input type='radio' id='pipe_stakes' name='pipe_stakes' value="1" {$pipe_stakes} tabindex='25'/> 
<input type='radio' id='no_pipe_stakes' name='pipe_stakes' value="2" {$no_pipe_stakes} tabindex='26'/>
<input type='radio' id='dk_pipe_stakes' name='pipe_stakes' value="3" {$dk_pipe_stakes} tabindex='27'/><br/>
<label class='short' style="width: 150px;">Tarps:</label>&nbsp;4ft:
<input type='checkbox' id='f4ft_tarps' name='f4ft_tarps' {$f4ft_tarps} tabindex='28'/>&nbsp;6ft:
<input type='checkbox' id='f6ft_tarps' name='f6ft_tarps' {$f6ft_tarps} tabindex='29'/>&nbsp;8ft:
<input type='checkbox' id='f8ft_tarps' name='f8ft_tarps' {$f8ft_tarps} tabindex='30'/><br/>
<label class='short' style="width: 150px;">Driver Status:</label>
<input type='checkbox' id='driver_status' name='driver_status' {$driver_status} tabindex='31'/><br/>
<label style="width: 150px;">Agent:</label>
<input readonly size="10" id="agent", name="agent" value='{$agent}'/>
<br/>
<label style="width: 150px;">Load Options:</label><br/>
<textarea rows='20' cols='40' id='load_options' name='load_options' tabindex='104' >{$load_options}</textarea><br/>
</div>
</div>
</form>
</div>
{include file="footer.tpl"}
