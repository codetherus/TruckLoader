{*   Copyright(c) 2009 by RSI. All rights reserved.
		 This is the DAT upload spreadsheet parameters page.
*}
{include file="pageheader.tpl"}
<link rel='stylesheet' href='calendar/calendar.css' title='calendar'>
<script language="javascript" src="calendar/setLongDateFormat.js"></script>
<script language="javascript" src="calendar/calendar.js"></script>
<script language="javascript" src="scripts/edit.js"></script>
<link rel="stylesheet" href="styles/edit.css">
</head>
<body>
<div id="floatboxcontent"></div>
<div id="wrapper">
{include file="content_header.tpl"}
<form id="form1" name="form1">
<fieldset style="width: 40%; margin-left:30%;">
<label>From:</label>
<input size='12' id='fromdate' name='fromdate' value='{$fromdate}'/>
<img src='images/cal.gif' align='absmiddle' onmouseover="fnInitCalendar(this, 'fromdate', 'style=calendar_green.css,close=true')"> 
<br/>
<label>To:</label>
<input size='12' id='todate' name='todate' value='{$todate}'/>
<img src='images/cal.gif' align='absmiddle' onmouseover="fnInitCalendar(this, 'todate', 'style=calendar_green.css,close=true')"> 
<br/>
<center>
<input type="button" value="Go" onclick="xajax_RunTheSpreadsheet(xajax.getFormValues('form1'))"/>
</center>
</form>
</div> {* wrapper *}
{include file="footer.tpl"}
