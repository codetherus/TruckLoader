<?php
include 'xajax/xajax_core/xajax.inc.php';
$xajax = new xajax();
$xajax->configure('javascript URI','xajax/');
//$xajax->configure('debug',true);
function process_form($data)
{
  $resp = new xajaxResponse();
  $resp->alert(print_r($data,true));
  return $resp;
}
$xajax->register(XAJAX_FUNCTION,'process_form');
$xajax->processRequest();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Test Form</title>
	
  <link rel="stylesheet" type="text/css" href="jqeasyui/themes/black/easyui.css">
	<link rel="stylesheet" type="text/css" href="jqeasyui/themes/icon.css">
	<script type="text/javascript" src="jqeasyui/jquery.min.js"></script>
	<script type="text/javascript" src="jqeasyui/jquery.easyui.min.js"></script>
  <?php $xajax->printJavascript(); ?>
  <style>
    label{
      display: inline-block;
      width: 45px; /* May need to be set on a per page basis...*/
     /* border: 1px solid white;*/
      text-align: right;
      margin-right: 2px;
      font-weight: bold;
    }	
    input{
      -moz-border-radius: 5px 5px 5px 5px;
      -webkit-border-radius: 5px 5px 5px 5px;
      border-radius: 5px 5px 5px 5px;
      color: white;
    }
    .pp{
      display: inline-block;
      margin-top: 5px;
      margin-left:auto;
      margin-right: auto;
    }
    /*.easyui-panel{
      display: inline-block;
            -moz-border-radius: 5px 5px 5px 5px;
      -webkit-border-radius: 5px 5px 5px 5px;
      border-radius: 5px 5px 5px 5px;

    }*/
  </style>
</head>
<body>
	
 <div id="tt" class="easyui-tabs" style="width:1100px;height:800px;margin: 0 auto;"data-options="fit:true,tabPosition:'top',
 tools:'#tab-tools',collapsible: true">
    <div title="Drivers" style="padding:20px;">
        <iframe src="drivers.php"></iframe>
    </div>
    <div title="Driver Search" data-options="closable:true" style="overflow:auto;padding:20px;">
        Driver Search Panel
    </div>
    <div title="Search" data-options="iconCls:'icon-reload',closable:true" style="padding:20px;">
        Search Panel
    </div>
    <div title="Radius Search" data-options="iconCls:'icon-reload',closable:true" style="padding:20px;">
        Radius Search Panel
    </div>
 </div>

<div id="tab-tools">
	<a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-add"></a>
	<a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-save"></a>
  <a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-edit"></a>
  <a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-remove"></a>
  <a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-undo"></a>
  <a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-redo"></a>
  <a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-cancel"></a>
</div>
</html>
<div class="easyui-panel" title="Form Test" style="width:380px;" >
  <div class="pp" style="padding:10px 0 10px 60px;">
	    <form id="ff">
        <label for="name">Name:</label>
        <input class="easyui-validatebox" type="text" id="name" name="name" ></br>
        <label for="address">Address:</label>
        <input class="easyui-validatebox" type="text" id="address" name="address" ></br>
        <label for="city">City:</label>
        <input class="easyui-validatebox" type="text" id="city" name="city" ></br>
        <label for="state">State:</label>
        <input class="easyui-validatebox" size="2" type="text" id="state" name="state" ></br>
        <label for="zip">Zip:</label>
        <input class="easyui-validatebox" size="2" type="text" id="zip" name="zip" ></br>
        <label for="phone">Phone:</label>
        <input class="easyui-validatebox" type="text" id="phone" name="phone" ></br>
        <label for="cell">Cell:</label>
        <input class="easyui-validatebox" type="text" id="cell" name="cell" ></br>
        <label for="email">Email:</label>
        <input class="easyui-validatebox" type="text" id="email" name="email" 
               data-options="validType:'email'"/></br>
        <input type="button" value="submit" onclick="xajax_process_form(xajax.getFormValues('ff'))",style="margin: 0 auto"/>
        </form>
    </div>
 </div>
