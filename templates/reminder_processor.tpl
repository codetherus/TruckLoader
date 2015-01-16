{*  Copyright(c) 2010 by RSI. All rights reserved.
		 This is the template for the reminders processor.
*}
{include file="pageheaderv2.tpl"}
{include file="common_scripts.tpl"}
{literal}
<style>
  label{
    text-align: right;
    font-size: 12px;
  }
  #processinfo{
    width:90%;
    height: 300px;
    overflow: auto;
    background-color: white;
    color: black;
    margin: auto;
    padding: 10px;
    -moz-border-radius: 5px;
  }
</style>
<script>
  var t = 0; //Timer id.
  function Updatestatus(s)
  {
    $('#status').val(s);
  }
  function StartProcessing()
  {
    if (t == 0)
    {
      $('#processinfo').attr("innerHTML","");
      var numminutes = $('#interval').val();
      t = setInterval("xajax_CheckReminders()", 60000 * numminutes);
      Updatestatus("Running");
    }
    else
      Alert ("Reminder processihg is already running...");
  }
  function StopProcessing()
  {
    if (t)
    {
      clearInterval(t);
      t = 0;
      Updatestatus("Stopped");
    }
    else
      alert("Reminder processing is not running...");
  }
  function DisplayClear()
  {
    $('#processinfo').attr("innerHTML","");
  }  
</script>
{/literal}
</head>
<body onload="StartProcessing();">
<div id="floatboxcontent"></div>
<div id="wrapper" style="margin-top: 40px;">
{include file="content_header_v2.tpl"}
<center>
<div style="clear:both; margin-top:5px;">
{* Buttons are at the top so users do not have to scroll to get to them. *}
<input type=button value="Stop Processing" onclick="StopProcessing()"/>
<input type=button value="Restart Processing" onclick="StartProcessing()"/>
<input type=button value="Reset the Display" onclick="DisplayClear()"/>
<input type=button value="Help" onclick="xajax_page_help()"/>
</div> {* end button div *}
<label style="width: 150px;text-align: right;">Interval in Minutes:</label>
<input size="2" id="interval" value="5"/> 
<label style="width: 50px;">Status:</label>
<input id="status" size="10"/>
</center>
<div id="processinfo" name="processinfo"></div>
{include file="footer.tpl"}
</div> {* end wrapper *}
