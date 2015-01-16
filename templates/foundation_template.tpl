{*
  8:22 PM 12/4/2011
  
  Loads By Jake Application Page Base Template
*}
<!DOCTYPE html>
<html>

<head>
<title>{$title}</title>
{$xajaxjs} {* The XAJAX generated javascript *}
<link rel="stylesheet" type="text/css" href="styles/truckloader.css">
{* Floatbox *}
<link type="text/css" rel="stylesheet" href="./floatbox/floatbox.css" />
<script type="text/javascript" src="./floatbox/floatbox.js"></script>	
{* Jquery *}
<script type="text/javascript" src="JQueryUI/js/jquery-1.4.2.min.js"></script>
{* Custom Jquery alerts, confirms and prompts *}
<script language="javascript" src="scripts/jquery.alerts.js"></script>
<link rel="stylesheet" type="text/css" href="styles/jquery.alerts.css" />
</head>

<body>

<div id="floatboxcontent"></div>

<div id="wrapper">

<div id="headerv2">
{$pgtitle}
{* Global search input control *}
{if $dosearch}
<div style="display: inline-block; padding-right: 2px; float: right;">
<img src="images/search.gif" border="none"/>
<input id="search_term"/>
</div>
{/if}
{* menu display control *}
{if $domenu}{include file="brainjarmenu.tpl"}{/if}
</div>

<div id="content">
{include file=$content}
</div>
<center>
<div id="footer">
<font class="notice">
Copyright &copy; {$footeryear} {$footertext}
</font>
</div>
</center>

</div> {* wrapper *}
</body>
</html>