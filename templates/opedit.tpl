{*   Copyright(c) 2009 by RSI. All rights reserved.
		 This is the screen Edit page template.
*}
<link rel='stylesheet' href='calendar/calendar.css' title='calendar'>
<link rel="stylesheet" href="styles/edit.css">
</head>
<form id="form1" name='form1'>

<div style="padding: 10px;">

<div id='leftcolumn' style='width:29%; Float:left;'>
<label>Driver:</label> <input id='driver' name='driver' value='{$driver}'/><br/>
<label>Location:</label> <input id='location' name='location' value='{$location}'/><br/>
<label>Home Town:</label> <input id='home_town' name='home_town' value='{$home_town}'/><br/>
<label>Telephone:</label> <input id='telephone' name='telephone' value='{$telephone}'/><br/>
<label style="margin-right: 6px">Driver Email:</label><input id="email" name="email" value='{$email}'/><br/>
<label>Home Office:</label> <input id='home_office' name='home_office' value='{$home_office}'/><br/>
<label>Comments:</label><br/>
<textarea style='margin-left: 30px;' rows='5' cols='20' id='comments' name='comments' >{$comments}</textarea><br/>
<label  style="width: 150px;">Upload Comments:</label><br/>
<textarea style='margin-left: 30px;' rows='5' cols='20' id='upload_comment' name='upload_comment' >{$upload_comment}</textarea><br/>
</div>

<div id='centercolumn' style='display:inline-block;width:31%; Float:left;'>
<label>Driver Alias</label> <input id='driver_alias' name='driver_alias' value='{$driver_alias}'/><br/>
<label>Unload Date:</label> <input id='unload_date' name='unload_date' value='{$unload_date}'/>
{* Calendar control for unload date *}
<img src='images/cal.gif' align='absmiddle' onmouseover="fnInitCalendar(this, 'unload_date', 'style=calendar_green.css,close=true')"> 
<br/>
<label>Equipment:</label>
{$truck_length}
{$truck_type}<br/>
<label>Truck Number:</label> <input id='truck_no' name='truck_no' value='{$truck_no}'/><br/>
<label>Office Numbers:</label> <input id='office_numbers' name='office_numbers' value='{$office_numbers}'/><br/><br/>
<label>Preferences:</label><br/>
<textarea style='margin-left: 30px;' rows='5' cols='20' id='preferences' name='preferences' >{$preferences}</textarea><br/>
<label style="width: 150px;">Driving Limitations:</label><br/>
<textarea style='margin-left: 30px;' rows='5' cols='20' id='driving_limitations' name='driving_limitations' >{$driving_limitations}</textarea><br/>		
</div>

<div id='rightcolumn' style='display:inline-block;width:39%; Float:left;'>
<label style="width: 150px;">Status: U/P/L</label>
<input type='radio' id='ls_unloaded' name='load_status' value="3" {$ls_unloaded}/>
<input type='radio' id='ls_planned' name='load_status' value="1" {$ls_planned}/>
<input type='radio' id='ls_loaded' name='load_status' value="2" {$ls_loaded}/><br/>
<label style="width: 150px;">Canada: Y/N/?</label>
<input type='radio' id='canada' name='canada' value="1"{$canada}/>
<input type='radio' id='no_canada' name='canada' value="2" {$no_canada}/>
<input type='radio' id='dk_canada' name='canada' value="3" {$dk_canada}/><br/>
<label style="width: 150px;">TWIC:Y/N/?</label> 
<input type='radio' id='twic' name='twic' value="1"{$twic}/>
<input type='radio' id='no_twic' name='twic' value="2" {$no_twic}/>
<input type='radio' id='dk_twic' name='twic' value="3" {$no_twic}/><br/>
<label style="width: 150px;">Load Levelers:Y/N/?</label> 		
<input type='radio' id='load_levelers' name='load_levelers' value="1" {$load_levelers}/>
<input type='radio' id='no_load_levelers' name='load_levelers' value="2" {$no_load_levelers}/>
<input type='radio' id='dk_load_levelers' name='load_levelers' value="3" {$dk_load_levelers}/><br/>
<label style="width: 150px;">Pipe Stakes:Y/N/?</label> 
<input type='radio' id='pipe_stakes' name='pipe_stakes' value="1" {$pipe_stakes}/> 
<input type='radio' id='no_pipe_stakes' name='pipe_stakes' value="2" {$no_pipe_stakes}/>
<input type='radio' id='dk_pipe_stakes' name='pipe_stakes' value="3" {$dk_pipe_stakes}/><br/>
<label class='short' style="width: 150px;">Tarps:</label>&nbsp;4ft:
<input type='checkbox' id='f4ft_tarps' name='f4ft_tarps' {$f4ft_tarps}/>&nbsp;6ft:
<input type='checkbox' id='f6ft_tarps' name='f6ft_tarps' {$f6ft_tarps}/>&nbsp;8ft:
<input type='checkbox' id='f8ft_tarps' name='f8ft_tarps' {$f8ft_tarps}/><br/>
<label style="width: 150px;">Recent Viewers:</label>
{$user_list}

<label style="width: 150px;">Load Options:</label><br/>
<textarea rows='15' cols='40' id='load_options' name='load_options' >{$load_options}</textarea><br/>
</div>
</div>
</form>
<center>

<div style="clear:both">
<br/>
<input type=button value="Update" onclick="sendPage('update')"/>
<input type=button value="Delete" onclick="sendPage('delete')"/>
<input type=button value="Private Notes" onclick="show_notes()"/>
<input type=button value="Load History" onclick="show_load_history()"/>
<input type=button value="Driver List" onclick="sendPage('listdrivers')"/>
<input type=button value="Help" onclick="xajax_page_help()"/>
<br/><br/>
</div>

</center>

{include file="footer.tpl"}
