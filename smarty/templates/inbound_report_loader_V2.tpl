{*   Copyright(c) 2009 by RSI. All rights reserved.
		 Screen for the daily inbound truck report handler
		 Note: This page does not use XAJAX...
*}
{include file="pageheaderv2.tpl"}
{include file="common_scripts.tpl"}
{* Upload styling *}
<link href="./styles/style.css" rel="stylesheet" type="text/css" />
{literal}
<style>
	#content{
		width: 80%;
		padding:20px;"
		border: 3px solid black;
	}
</style>
<script language="javascript" type="text/javascript">
<!--
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
         alert(result);
      }
      document.getElementById('f1_upload_process').style.visibility = 'hidden';
      document.getElementById('f1_upload_form').style.visibility = 'visible';      
      
      //Do the xajax file load process if OK.
      if (success == 1)
        xajax_LoadInbound();
      return true;   
}
//-->
</script>   

{/literal}
</head>
<body onload="xajax_transform();">
<div id="floatboxcontent"></div>
<div id="wrapper" style="margin-top: 50px;">
{include file="content_header_v2.tpl"}
<div id="content" >
<form action="upload.php" method="post" enctype="multipart/form-data" target="upload_target" onsubmit="startUpload();" >
<p id="f1_upload_process">Loading...<br/><img src="./images/loader.gif" /><br/></p>
<p id="f1_upload_form" align="center"><br/>
<label style="text-align: left; width: 350px;">File:&nbsp;
<input name="myfile" type="file" size="30" /></label> 
<center><input type="submit" name="submitBtn" class="sbtn" value="Upload" /></center>
</p>
<br/> 
 <iframe id="upload_target" name="upload_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>
 </form>

<div id="results" name="results"></div>
</div>
</div>
{include file="footer.tpl"}
