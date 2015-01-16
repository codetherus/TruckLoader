{*   Copyright(c) 2009 by RSI. All rights reserved.
		 This is the screen Edit page template.
*}
{include file="pageheader.tpl"}
<link rel='stylesheet' href='calendar/calendar.css' title='calendar'>
<script language="javascript" src="calendar/calendar.js"></script>
<script language="javascript" src="calendar/setDateFormat.js"></script>
{literal}
<style>
	fieldset{
		width: 94%; 
		margin-left: 12px;
	}
	label{
		width: 130px;
		font-weight: bold;
	}
	.label2{
	  width: 150px;
	}
	#content{
		width: 90%;
		padding:20px;"
		border: 3px solid black;
	}
	#wrapper{ 
    
    width:90%;
  }
</style>
<script>
	var ischanged=false;
	function sendPage(opcode)
	{
    xajax_processEdit(opcode,xajax.getFormValues('form1'));
    return false;
	}
	//Monitor unsaved changes.
	window.onbeforeunload=function(evt)
	{
		if (!evt) evt = window.event;
		if (ischanged)
			evt.returnValue="There are unsaved changes...";
	}
	window.onkeydown=function(evt)
	{
		ischanged=true;
	}
	
</script>	
{/literal}
</head>
<body onload="xajax.$('driver').focus()">
<div id="floatboxcontent"></div>
<div id="wrapper">
{include file="content_header.tpl"}
<form id="form1" name="form1">
<div id="wrapper2" style="display:inline-block;padding: 10px;">
<div id='leftcolumn' style='display: inline-block;width:32%; float:left;'>
<label>Driver:</label> <input id='driver' name='driver' tabindex='1' /><br/>
<label>Location:</label> <input id='location' name='location' tabindex='2' /><br/>
<label>Home Town:</label> <input id='home_town' name='home_town' tabindex='3' /><br/>
<label>Telephone:</label> <input id='telephone' name='telephone' tabindex='4' /><br/>
<label style="margin-right: 6px">Driver Email:</label><input id="email" name="email" value='{$email}' tabindex='5'/><br/>
<label>Home Office:</label> <input id='home_office' name='home_office' tabindex='6' /><br/>

<label>Comments:</label><br/>
<textarea style='margin-left: 30px;' rows='5' cols='20' id='comments' name='comments' tabindex='100' ></textarea>
</div>
<div id='centercolumn' style='display:inline-block;width:35%; Float:left;'>
<label>Driver Alias</label> <input id='driver_alias' name='driver_alias' tabindex='7' /><br/>
<label>Unload Date:</label> <input id='unload_date' name='unload_date' tabindex='8'/>
{* Calendar control for unload date *}
<img src='images/cal.gif' align='absmiddle' onmouseover="fnInitCalendar(this, 'unload_date', 'style=calendar_green.css,close=true')"><br/> 
<label>Equipment:</label>
{$truck_length}
{$truck_type}<br/>
<label>Truck Number:</label> <input id='truck_no' name='truck_no' tabindex='11'/><br/>
<label>Office Numbers:</label> <input id='office_numbers' name='office_numbers' tabindex='12'/><br/>
<label>Preferences:</label><br/>
<textarea style='margin-left: 30px;' rows='5' cols='20' id='preferences' name='preferences' tabindex='101' ></textarea><br/>
<label style="margin-left: 40px">Driving Limitations:</label><br/>
<textarea style='margin-left: 30px;' rows='5' cols='20' id='driving_limitations' name='driving_limitations' tabindex='102' ></textarea>		
</div>
<div id='rightcolumn' style='display:inline-block;width:32%; float:right;'>
<label>Canada: Y/N</label>
<input type='radio' id='canada' name='canada' value="1" tabindex='13'/>
<input type='radio' id='no_canada' name='canada' value="2" tabindex='14'/>
<input type='radio' id='dk_canada' name='canada' value="3" tabindex='15' checked/><br/>
<label>TWIC:Y/N</label> 
<input type='radio' id='twic' name='twic' value="1" tabindex='16'/>
<input type='radio' id='no_twic' name='twic' value="2" tabindex='17'/>
<input type='radio' id='dk_twic' name='twic' checked value"3" tabindex='18'/><br/>
<label>Load Levelers:Y/N</label> 		
<input type='radio' id='load_levelers' name='load_levelers' value="1" tabindex='19'/>
<input type='radio' id='no_load_levelers' name='load_levelers' value="2" tabindex='20'/>
<input type='radio' id='dk_load_levelers' name='load_levelers' value="3" tabindex='21' checked/><br/>
<label>Pipe Stakes:Y/N</label> 
<input type='radio' id='pipe_stakes' name='pipe_stakes' value="1" tabindex='22'/> 
<input type='radio' id='no_pipe_stakes' name='pipe_stakes' value="2" tabindex='23'/>
<input type='radio' id='dk_pipe_stakes' name='pipe_stakes' checked value="3"/ tabindex='24'><br/>
<label class='short'>Tarps:</label>&nbsp;4ft:
<input type='checkbox' id='f4ft_tarps' name='f4ft_tarps' tabindex='25' />&nbsp;6ft:
<input type='checkbox' id='f6ft_tarps' name='f6ft_tarps' tabindex='26' />&nbsp;8ft:
<input type='checkbox' id='f8ft_tarps' name='f8ft_tarps' tabindex='27' />
<label>Load Options:</label><br/>
<textarea style='margin-left: 30px;' rows='5' cols='20' id='load_options' name='load_options' tabindex='103' ></textarea><br/>
</div>
</div> <!-- wrapper2 -->
</form>
<div style="clear:both">
<br>
<center>
<input type="button" value="Save" onclick="sendPage('update');"/>
<input type="button" value="Help" onclick="xajax_page_help('new_load_creation')"/>
</center>
<br>
</div>
</div><!-- wrapper -->
<center>
</div>
</center>

{include file="footer.tpl"}
