{*   Copyright(c) 2009 by RSI. All rights reserved.
		 This is the load history page template.
*}
{include file="pageheader.tpl"}
<link rel='stylesheet' href='calendar/calendar.css' title='calendar'>
<script language="javascript" src="calendar/setLongDateFormat.js"></script>
<script language="javascript" src="calendar/calendar.js"></script>
<script language="javascript" src="scripts/edit.js"></script>
{* Upload styling *}
<link href="./styles/style.css" rel="stylesheet" type="text/css" />
<link href="./styles/truckloader.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript">
<!--
{literal}
function startUpload(){
      document.getElementById('f1_upload_process').style.visibility = 'visible';
      document.getElementById('f1_upload_form').style.visibility = 'hidden';
      return true;
}
function stopUpload(success){
     
      var result = '';
      if (success == 1){
         result = 'The file was uploaded successfully!';
      }
      else {
         result = 'There was an error during file upload!';
      }
      document.getElementById('f1_upload_process').style.visibility = 'hidden';
      document.getElementById('f1_upload_form').style.visibility = 'visible';      
      alert(result);
      return true;   
}
//-->
</script>   
{/literal}
{literal}
<style>
label{
  width: 110px;
  font-weight: bold;
}
fieldset{
  width: 70%;
  margin-left: 220px;
}
</style>
{/literal}

</head>
<body>
<div id="floatboxcontent"></div>
<div id="wrapper">
{include file="content_header.tpl"}
<div id="pdfbox" style="padding: 30px;width:90%;border: 2px solid green;display: none; z-index:9000;"
         onclick="this.style.display='none'"></div>
<form id="form1" name='form1'>
<fieldset style="width: 80%; margin-left: 110px;">
<legend><b>Load Details</b></legend>
<div style="float:left">
<label>Corp. Id:</label><input id="corp_id" name="corp_id" value="{$corp_id}"/><br/>
<label>Driver:</label><input id='driver' name='driver' value='{$driver}'/><br/>
<label>Pickup At:</label><input id="source" name="source" value="{$source}"/>
&nbsp;<b>On:</b>&nbsp;
<input size=12 id="pickup_date" name="pickup_date" value="{$pickup_date}"/>
<img src='images/cal.gif' align='absmiddle' 
     onmouseover="fnInitCalendar(this, 'pickup_date', 'style=calendar_green.css,close=true')"> 
<br/>
<label>Deliver To:</label><input id='destination' name='destination' value='{$destination}'/>
&nbsp;<b>On:</b>&nbsp;
<input size=12 id="unload_date" name="unload_date" value="{$unload_date}"/>
<img src='images/cal.gif' align='absmiddle' 
     onmouseover="fnInitCalendar(this, 'unload_date', 'style=calendar_green.css,close=true')">
<br/>
<label>PDF File:</label><input size="44" id="contract_pdf" name="contract_pdf" value="{$contract_pdf}"/>
</div>
<div style="float:right; padding-right: 50px;">
Notes:<br/>
<textarea class="rztext" id="notes" name="notes" cols="40" rows="4"></textarea>
</div>
</form>
</fieldset>
<br/>
<center>
<div id="selectedpdf" style="display: none; width: 25%; color: black; background-color: white;"></div>
<div style="clear:both">
<input type=button value="Insert" onclick="sendPage('insert')"/>
<input type=button value="Update" onclick="sendPage('update')"/>
<input type=button value="Delete" onclick="sendPage('delete')"/>
<input type=button value="List History" onclick="sendPage('list')"/>
<input type="button" value="Select PDF" onclick="sendPage('selectpdf')"/>
<input type=button value="View PDF" onclick="sendPage('viewpdf')"/>
<input type=button value="Help" onclick="xajax_page_help()"/>

</div>
<fieldset style="width: 80%; margin-left: 10px;">
<legend><b>Upload PDF Files</b></legend>
<form action="pdf_upload.php" method="post" enctype="multipart/form-data" target="upload_target" onsubmit="startUpload();" >
<p id="f1_upload_process" align="center">Loading...<br/><img src="./images/loader.gif" /><br/></p>
<p id="f1_upload_form" align="center">
<label>PDF File:</label> 
<input name="myfile" type="file" size="30" /><input type="submit" name="submitBtn" class="sbtn" value="Upload" />
<input type="hidden" name="MAX_FILE_SIZE" value="15000000" />
</p>
<br/> 
<iframe id="upload_target" name="upload_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>
</form>
</fieldset>
</center>
</div>
{include file="footer.tpl"}
