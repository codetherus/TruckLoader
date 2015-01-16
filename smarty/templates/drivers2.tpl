{*   Copyright(c) 2009 by RSI. All rights reserved.
		 This is the template for the load maintenance page.
*}
{include file="pageheader.tpl"}
<link rel='stylesheet' href='calendar/calendar.css' title='calendar'>
<link rel='stylesheet' href='styles/jquery.autocomplete.css'>
<link rel='stylesheet' href='styles/jquery-ui-1.7.3.custom.css'>
<link rel='stylesheet' href='styles/flexigrid.css?v=1'>
<script language="javascript" src="calendar/setLongDateFormat.js"></script>
<script language="javascript" src="calendar/calendar.js"></script>
<script language="javascript" src="scripts/fleegix.js"></script>
<script language="javascript" src="scripts/fleegix.form.diff.js"></script>
<script language="javascript" src="scripts/jquery.autocomplete.js"></script>
<script language="javascript" src="scripts/flexigrid.js"></script>
<script language="javascript" src="scripts/drivers.js?v=1"></script>

{literal}
<style>
  label{
    text-align: left;
    font-size: 12px;
    color: silver;
    
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

{/literal}
</head>
<body>


<div id="floatboxcontent"></div>
<div id="wrapper">


{include file="content_header_v2.tpl"}
<center>
<div style="clear:both; margin-top:5px;">
{* Buttons are at the top so users do not have to scroll a lot. *}
<input type=button value="Update" onclick="sendPage('update')"/>
<input type=button value="Add New Driver" onclick="sendPage('insert')"/>
<input type=button value="Help" onclick="xajax_page_help()"/>
<label style="width: 200px; text-align: right; color: lime;" onclick="showGrid(1)">Search:</label>
<img src="images/search.gif" onclick="showGrid(1)"/>
</div>
</center>
<div>
<form id="form1" name='form1'>
<input type="hidden" id="dprd", name="dprd"/> {* Carries the delete password to the server *}
<input type="hidden" id="unloading" name="unloading" value=""/> {* Carries the unload flag to the server *}
<input type="hidden" id="rowhash" name="rowhash" value=""/> {* Carries the md 5 of the table ros *}
<input type="hidden" id="current_record_id" name="current_record_id" value=""/>
<div style="padding: 10px;">

<div id='leftcolumn' style='width:32%; Float:left;'>
<label onclick="readDriver();">Driver</label>
<br/>
<input type="text" style="width: 225px;" 
       id="name" name="name" value="{$name}"
       />
<br>
<label style='width: 150px'>Pickup Date</label>
<label>Delivery Date</label>
<br/>
<input style="width: 70px;" id='pickup_date' name='pickup_date' value='{$pickup_date}'/>
<img src='images/cal.gif' align='absmiddle' onmouseover="fnInitCalendar(this, 'pickup_date', 'style=calendar_green.css,close=true')"> 
&nbsp;
<input style='width: 70px; margin-left: 40px;' id='delivery_date' name='delivery_date' value='{$delivery_date}'/>
<img src='images/cal.gif' align='absmiddle' onmouseover="fnInitCalendar(this, 'delivery_date', 'style=calendar_green.css,close=true')"> 
<br>
<label style='width: 150px'>Origin City</label>
<label>Destination</label>
<br>
<input id="pickup_location" name="pickup_location"/>
<input id="delivery_location" name="delivery_location"/>
<br/>
<label style="width: 185px; text-align:left;">Phone Number List</label><br/>
<textarea id="phone_numbers" name="phone_numbers" rows="1" style="width: 225px;">{$phone_numbers}</textarea>
<br>
<label style="width: 165px">Driver Comments</label><br/>
<textarea style="width: 225px;" id='comments' name='comments' rows='5'>{$comments}</textarea>
<br/>
<label>Canada</label><label>TWIC</label>
<br>
<span id="lcanada">{$canadalist}</span>
<span id="ltwiclist">{$twiclist}</span>
<br/>
<label style='width:150px;' >Canada Limitations</label><br/>
<textarea rows="2" style="width: 225px;" 
          id='canada_limitations' name='canada_limitations'> {$canada_limitationss}</textarea>
<br/>
<label>Tarps</label><br>
<input type="checkbox" name="no_tarps" name="no_tarps"  value="No">
<span style='font-size: 12px; font-weight: bold; color: silver;'>None</span>
<input id="f4ft_tarps" style='margin-left: 10px' type="checkbox" name="4ft_tarps" value="4ft">
<span style='font-size: 12px; font-weight: bold; color: silver;'>4ft</span>
<input id="f6ft_tarps" style='margin-left: 10px' type="checkbox" name="6ft_tarps" value="6ft">
<span style='font-size: 12px; font-weight: bold; color: silver;'>6ft</span>
<input id="f8ft_tarps" style='margin-left: 10px' type="checkbox" name="8ft_tarps" value="8ft">
<span style='font-size: 12px; font-weight: bold; color: silver;'>8ft</span>
<br/>
<label style="width: 70px;">Pipe Stakes</label><label>Load Levelers</label><label>Pole Bunks</label>
<br>
<span id="lpipestakes">{$pipestakes}</span>
<span id="lloadlevelers">{$loadlevelers}</span>
<span id="lpolebunks">{$polebunks}</span>
</div>

<div id='centercolumn' style='padding-left: 4px; display:inline-block;width:32%; Float: left;'>
<label style='width: 123px;' >Truck #</label><label>Load #</label><br/>
<input id='truck_no' name='truck_no' value='{$truck_no}'/>
<input id="load_number" name="load_number" value="{$load_number}"/><br/>
<label>Home Office</label>
<br/>
<input id="home_office" name="home_office"/>
<br/>
<label style='width: 65px;'>Length</label><label style='width: 135px;'>Trailer</label>
<br/>
<span id="ltlength">{$tlength}</span><span id="lttype" style='margin-left: 25px;'>{$ttype}</span><br/>
<label>Home Town</label><br/>
<input id="home_town" name="home_town"/>
<br/>
<label>Driver Limitations</label><br/>
<textarea id='driving_limitations' name='driving_limitations' rows='4' cols='32'>{$driving_limitations}</textarea>
<br/>
<label>Check Call</label><br/>
<textarea id='check_call' name='check_call' rows='2' cols='32'>{$check_call}</textarea>
<br>
<label>Load Options</label><br/>
<textarea id='load_options' name='load_options' rows='5' cols='32'>{$load_options}</textarea>
</div>

<div id='rightcolumn' style='padding-left: 4px; display:inline-block;width:32%; Float: left;'>
<label>Driver Agent</label>
<br/>
<span id="lagent_list">{$agent_list}</span>
<br/>
<label>Agent Info</label>
<br/>
<textarea readonly id='agent_info' name='agent_info' rows='2' cols='32'>{$agent_info}</textarea>
<br/><br/>
<label>Rating</label>
<br/>
<input size="5" id="rating" name="rating" value="{$rating}"/>
</div>
</form>
{* flexigrid search grid containers *}
<div id="driver_search_div">
<br/><br/>
<center>
<input type="button" value="Close" onclick="hideGrid(1)"/>
</center>
<table id="flex1" style="display:none;"></table>
</div>
</div>

{include file="footer.tpl"}

