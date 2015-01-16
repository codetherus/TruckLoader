<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Transport Investments Logistics Tool</title>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" /> 
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="CSS/all.css" rel="stylesheet" type="text/css" />
<link href="TIISkin/TabStrip.TIISkin.css" rel="stylesheet" type="text/css" />
<link href="TIISkin/Grid.TIISkin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="Scripts/ScriptLibrary.js">
<script type="text/javascript">
function showHide(elementid){
if (document.getElementById(elementid).style.display != 'none'){
document.getElementById(elementid).style.display = 'none';
} else {
document.getElementById(elementid).style.display = '';
}
} 
</script>
<style type="text/css">
    body {
 margin: 0;
 font-family: Verdana, Arial, Helvetica, sans-serif;
 font-size: 9pt;
 background: #ffffff url(bg_orderentry.jpg) no-repeat top center;
 }
</style>
 
 
</head>
<body>
<form name="aspnetForm" method="post" action="OrderSearch.aspx" id="aspnetForm">
<div>
<input type="hidden" name="ctl00_RadScriptManager1_HiddenField" id="ctl00_RadScriptManager1_HiddenField" value="" />
<input type="hidden" name="__EVENTTARGET" id="__EVENTTARGET" value="" />
<input type="hidden" name="__EVENTARGUMENT" id="__EVENTARGUMENT" value="" />
<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="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D1JlbmRlckludmlzaWJsZWcFA0VSU2gFC1NwZWNpYWxEYXlzDwWTAVRlbGVyaWsuV2ViLlVJLkNhbGVuZGFyLkNvbGxlY3Rpb25zLkNhbGVuZGFyRGF5Q29sbGVjdGlvbiwgVGVsZXJpay5XZWIuVUksIFZlcnNpb249MjAwOC4zLjEzMTQuMzUsIEN1bHR1cmU9bmV1dHJhbCwgUHVibGljS2V5VG9rZW49MTIxZmFlNzgxNjViYTNkNBQrAAAFDVNlbGVjdGVkRGF0ZXMPBZABVGVsZXJpay5XZWIuVUkuQ2FsZW5kYXIuQ29sbGVjdGlvbnMuRGF0ZVRpbWVDb2xsZWN0aW9uLCBUZWxlcmlrLldlYi5VSSwgVmVyc2lvbj0yMDA4LjMuMTMxNC4zNSwgQ3VsdHVyZT1uZXV0cmFsLCBQdWJsaWNLZXlUb2tlbj0xMjFmYWU3ODE2NWJhM2Q0FCsAAAURRW5hYmxlTXVsdGlTZWxlY3RoDxYEHwcFBEdyYXkfAmhkZBYEHwUFC3JjTWFpblRhYmxlHwYCAhYEHwUFDHJjT3RoZXJNb250aB8GAgJkFgQfBQUKcmNTZWxlY3RlZB8GAgJkFgQfBQUKcmNEaXNhYmxlZB8GAgIWBB8FBQxyY091dE9mUmFuZ2UfBgICFgQfBQUJcmNXZWVrZW5kHwYCAhYEHwUFB3JjSG92ZXIfBgICFgQfBQUZUmFkQ2FsZW5kYXJNb250aFZpZXdfR3JheR8GAgIWBB8FBQlyY1ZpZXdTZWwfBgICZAIEDxQrAAIPFgQfBwUER3JheR8CaGQWBB8FBQdyY0hvdmVyHwYCAhYCZg8UKwAJDxYEHghEYXRhS2V5cxYAHgtfIUl0ZW1Db3VudAIYZBYEHwVlHwYCAmQWBB8FZR8GAgJkZBYEHwUFCHJjSGVhZGVyHwYCAhYEHwUFCHJjRm9vdGVyHwYCAhYEHwUFGFJhZENhbGVuZGFyVGltZVZpZXdfR3JheR8GAgIWMAIBD2QWAmYPFgIeCWlubmVyaHRtbAUIMTI6MDAgQU1kAgIPZBYCZg8WAh8NBQcxOjAwIEFNZAIDD2QWAmYPFgIfDQUHMjowMCBBTWQCBA9kFgJmDxYCHw0FBzM6MDAgQU1kAgUPZBYCZg8WAh8NBQc0OjAwIEFNZAIGD2QWAmYPFgIfDQUHNTow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bkNvbnRlbnQkcmNiU2VhcmNoQmlsbFRvQ29kZQUkY3RsMDAkY3BoTWFpbkNvbnRlbnQkcmNiU2VhcmNoT3JpZ2luBSJjdGwwMCRjcGhNYWluQ29udGVudCRyY2JTZWFyY2hEZXN0BSVjdGwwMCRjcGhNYWluQ29udGVudCRyY2JTZWFyY2hTaGlwcGVyBSdjdGwwMCRjcGhNYWluQ29udGVudCRyY2JTZWFyY2hDb25zaWduZWUFJGN0bDAwJGNwaE1haW5Db250ZW50JHJjYlNlYXJjaERyaXZlcgUlY3RsMDAkY3BoTWFpbkNvbnRlbnQkcmNiU2VhcmNoVHJhY3RvcgUlY3RsMDAkY3BoTWFpbkNvbnRlbnQkcmNiU2VhcmNoQ2FycmllcgUmY3RsMDAkY3BoTWFpbkNvbnRlbnQkdGJ4U2VhcmNoRGF0ZUZyb20FL2N0bDAwJGNwaE1haW5Db250ZW50JHRieFNlYXJjaERhdGVGcm9tJGNhbGVuZGFyBS9jdGwwMCRjcGhNYWluQ29udGVudCR0YnhTZWFyY2hEYXRlRnJvbSRjYWxlbmRhcgUvY3RsMDAkY3BoTWFpbkNvbnRlbnQkdGJ4U2VhcmNoRGF0ZUZyb20kdGltZVZpZXcFJGN0bDAwJGNwaE1haW5Db250ZW50JHRieFNlYXJjaERhdGVUbwUtY3RsMDAkY3BoTWFpbkNvbnRlbnQkdGJ4U2VhcmNoRGF0ZVRvJGNhbGVuZGFyBS1jdGwwMCRjcGhNYWluQ29udGVudCR0YnhTZWFyY2hEYXRlVG8kY2FsZW5kYXIFLWN0bDAwJGNwaE1haW5Db250ZW50JHRieFNlYXJjaERhdGVUbyR0aW1lVmlldwUeY3RsMDAkY3BoTWFpbkNvbnRlbnQkYnRuU2VhcmNoBSBjdGwwMCRjcGhNYWluQ29udGVudCRidG5BZGRPcmRlcgUlY3RsMDAkY3BoTWFpbkNvbnRlbnQkcmNiU2VhcmNoQ2Fycmllcg8UKwACZWVkBSJjdGwwMCRjcGhNYWluQ29udGVudCRyY2JTZWFyY2hEZXN0DxQrAAJlZWQFJ2N0bDAwJGNwaE1haW5Db250ZW50JHJjYlNlYXJjaENvbnNpZ25lZQ8UKwACZWVkBSVjdGwwMCRjcGhNYWluQ29udGVudCRyY2JTZWFyY2hTaGlwcGVyDxQrAAJlZWQFJGN0bDAwJGNwaE1haW5Db250ZW50JHJjYlNlYXJjaE9yaWdpbg8UKwACZWVkBSRjdGwwMCRjcGhNYWluQ29udGVudCRyY2JTZWFyY2hEcml2ZXIPFCsAAmVlZOBtwAnj539IJM4TAdA2luoLfgco" />
</div>
<script type="text/javascript">
//<![CDATA[
var theForm = document.forms['aspnetForm'];
if (!theForm) {
    theForm = document.aspnetForm;
}
function __doPostBack(eventTarget, eventArgument) {
    if (!theForm.onsubmit || (theForm.onsubmit() != false)) {
        theForm.__EVENTTARGET.value = eventTarget;
        theForm.__EVENTARGUMENT.value = eventArgument;
        theForm.submit();
    }
}
//]]>
</script>
<script src="/WebResource.axd?d=UjJeiKwOK2Q-b0nxO7LxVw2&amp;t=634050896073162769" type="text/javascript"></script>
<link class='Telerik_stylesheet' type='text/css' rel='stylesheet' href='/WebResource.axd?d=kjCuBYUaUasbxHnK_qEA7AH-seNl8jhyPHdzHB85YKZ4DfkeDN2G3Jv4HoMT5j8CeI7FYHiAk3sjLg29Ri_FkA2&amp;t=633674324160000000'></link><link class='Telerik_stylesheet' type='text/css' rel='stylesheet' href='/WebResource.axd?d=kjCuBYUaUasbxHnK_qEA7AH-seNl8jhyPHdzHB85YKbzweikXegmQIfHc8l4-lPnnWuxw10BQWw7mmg_OUy3dXRSPECGUBqNnOh-fp7c7-w1&amp;t=633674324160000000'></link><link class='Telerik_stylesheet' type='text/css' rel='stylesheet' href='/WebResource.axd?d=kjCuBYUaUasbxHnK_qEA7AH-seNl8jhyPHdzHB85YKYl5_gzgEQ3OQmLCDf4P-wF3nGEYRXge2FeJAQ12k_TFIVSfsowt2reQiU1JP8SZxQ1&amp;t=633674324160000000'></link><link class='Telerik_stylesheet' type='text/css' rel='stylesheet' href='/WebResource.axd?d=kjCuBYUaUasbxHnK_qEA7AH-seNl8jhyPHdzHB85YKZu-d7bQxdzTl-4GcYIQBOCG1DKiZOEHmOyQyDXgQf3EA2&amp;t=633674324160000000'></link><link class='Telerik_stylesheet' type='text/css' rel='stylesheet' href='/WebResource.axd?d=kjCuBYUaUasbxHnK_qEA7AH-seNl8jhyPHdzHB85YKaMsjdPjRiyd0gNDlf_yRYjN4F70mX4MNPd0iO0TXRs3g2&amp;t=633674324160000000'></link>
<script src="/Telerik.Web.UI.WebResource.axd?_TSM_HiddenField_=ctl00_RadScriptManager1_HiddenField&amp;compress=1&amp;_TSM_CombinedScripts_=%3b%3bSystem.Web.Extensions%2c+Version%3d3.5.0.0%2c+Culture%3dneutral%2c+PublicKeyToken%3d31bf3856ad364e35%3aen-US%3a0d787d5c-3903-4814-ad72-296cea810318%3aea597d4b%3ab25378d2%3bTelerik.Web.UI%2c+Version%3d2008.3.1314.35%2c+Culture%3dneutral%2c+PublicKeyToken%3d121fae78165ba3d4%3aen-US%3aef502ffb-86f7-4d96-ad3a-fbb934d602ab%3a16e4e7cd%3ae330518b%3a1e771326%3a8e6f0d33%3aed16cbdc%3a19620875%3aaa288e2d%3a8674cba1%3aef347303%3ab7778d6c%3ac08e9f8a%3aa51ee93e%3a59462f1" type="text/javascript"></script>
<div>
<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="/wEWCAKHt4vJAwK+nYa6CgK4+eWICAKuyfnBBQLC1e/zDALrxsfSDgL9wOy2AQK21NLrDwQ3eLo5hACpG3d+jUJRBiYDpfIt" />
</div>
<script type="text/javascript">
//<![CDATA[
Sys.WebForms.PageRequestManager._initialize('ctl00$RadScriptManager1', document.getElementById('aspnetForm'));
Sys.WebForms.PageRequestManager.getInstance()._updateControls(['tctl00$cphMainContent$ctl00$cphMainContent$Panel2Panel','tctl00$cphMainContent$RadAjaxManager1SU'], [], [], 90);
//]]>
</script>
       
<table align="center" width="986" cellpadding="0" cellspacing="0">
<tr>
<td>
<table width="100%" border="0">
<tr>
<td width="166"><img src="images/topLogo.jpg" /></td>
<td width="820" align="right"><p class="header">
<span id="ctl00_labelWelcomeMessage" style="display:inline-block;color:Black;font-size:X-Small;height:16px;">Welcome Jake Test</span><br />     
                                              
<span id="ctl00_labelDate" style="display:inline-block;color:Black;font-size:X-Small;height:16px;">Wednesday, September 29, 2010</span><br />
                    
<a id="ctl00_btnLogout" href="javascript:__doPostBack('ctl00$btnLogout','')" style="font-size:X-Small;">[ Logout ]</a>
</p></td>
</tr>
</table>
</td>
</tr>
<tr>
<td width="100%" bgcolor="#FFFFFF" align="center"><div id="ctl00_radTabs" class="RadTabStrip RadTabStrip_WebBlue RadTabStripTop_WebBlue " style="width:700px;">
<!-- 2008.3.1314.35 --><div class="rtsLevel rtsLevel1">
<ul class="rtsUL"><li class="rtsLI rtsFirst"><a class="rtsLink" href="Default2.aspx"><span class="rtsOut"><span class="rtsIn"><span class="rtsTxt">Home</span></span></span></a></li><li class="rtsLI"><a class="rtsLink" href="#"><span class="rtsOut"><span class="rtsIn"><span class="rtsTxt">Load Board</span></span></span></a></li><li class="rtsLI"><a class="rtsLink rtsBefore" href="#"><span class="rtsOut"><span class="rtsIn"><span class="rtsTxt">Truck Board</span></span></span></a></li><li class="rtsLI"><a class="rtsLink rtsSelected" href="#"><span class="rtsOut"><span class="rtsIn"><span class="rtsTxt">Order Entry</span></span></span></a></li><li class="rtsLI rtsLast"><a class="rtsLink rtsAfter" href="#"><span class="rtsOut"><span class="rtsIn"><span class="rtsTxt">Contact Us</span></span></span></a></li></ul>
</div><input id="ctl00_radTabs_ClientState" name="ctl00_radTabs_ClientState" type="hidden" />
</div></td>
</tr>
<tr>
<td>
<table cellpadding="0" cellspacing="0" width="100%" border="0" class="container">
<tr><td width="100%" class="tableCrumb">&nbsp;
<a href="Default2.aspx" class="crumb">Home</a> &gt;<a href="Order.aspx" class="crumbCurrent">Order Entry</a>
</td></tr>
<tr><td width="100%"><div style="padding-left:1px;padding-bottom:2px;">
<div id="ctl00_cphChildNav_radOrderTabs" class="RadTabStrip RadTabStrip_TIISkin RadTabStripTop_TIISkin ">
<div class="rtsLevel rtsLevel1">
<ul class="rtsUL"><li class="rtsLI rtsFirst"><a class="rtsLink rtsSelected" href="OrderSearch.aspx"><span class="rtsOut"><span class="rtsIn"><span class="rtsTxt">Search</span></span></span></a></li><li class="rtsLI"><a class="rtsLink rtsAfter" href="Order_Available.aspx"><span class="rtsOut"><span class="rtsIn"><span class="rtsTxt">My Available Loads</span></span></span></a></li><li class="rtsLI"><a class="rtsLink" href="Order_MyTruckBoard.aspx"><span class="rtsOut"><span class="rtsIn"><span class="rtsTxt">My Trucks</span></span></span></a></li><li class="rtsLI"><a class="rtsLink" href="Order_Credit.aspx"><span class="rtsOut"><span class="rtsIn"><span class="rtsTxt">Credit</span></span></span></a></li><li class="rtsLI"><a class="rtsLink" href="Order_Compliance.aspx"><span class="rtsOut"><span class="rtsIn"><span class="rtsTxt">Compliance</span></span></span></a></li><li class="rtsLI"><a class="rtsLink rtsDisabled" href="Order.aspx?PageViewID=rpvOrder"><span class="rtsOut"><span class="rtsIn"><span class="rtsTxt">Order</span></span></span></a></li><li class="rtsLI"><a class="rtsLink rtsDisabled" href="Order.aspx?PageViewID=rpvAccessorials"><span class="rtsOut"><span class="rtsIn"><span class="rtsTxt">Accessorials</span></span></span></a></li><li class="rtsLI"><a class="rtsLink rtsDisabled" href="Order.aspx?PageViewID=rpvStops"><span class="rtsOut"><span class="rtsIn"><span class="rtsTxt">Stops</span></span></span></a></li><li class="rtsLI"><a class="rtsLink rtsDisabled" href="Order.aspx?PageViewID=rpvAssignments"><span class="rtsOut"><span class="rtsIn"><span class="rtsTxt">Assignments</span></span></span></a></li><li class="rtsLI"><a class="rtsLink rtsDisabled" href="Order_Notes.aspx?PageViewID=rpvNotes"><span class="rtsOut"><span class="rtsIn"><span class="rtsTxt">Notes</span></span></span></a></li><li class="rtsLI rtsLast"><a class="rtsLink rtsDisabled" href="OrderSummary.aspx"><span class="rtsOut"><span class="rtsIn"><span class="rtsTxt">Summary</span></span></span></a></li></ul>
</div><input id="ctl00_cphChildNav_radOrderTabs_ClientState" name="ctl00_cphChildNav_radOrderTabs_ClientState" type="hidden" />
</div>
</div></td></tr>
</table>
        
<div id="ctl00_cphMainContent_RadAjaxManager1SU">
<span id="ctl00_cphMainContent_RadAjaxManager1" style="display:none;"></span>
</div>
<script type="text/javascript">
    function RowMouseOver(sender, eventArgs)
 {
  $get(eventArgs.get_id()).className = "RowMouseOver";
 }
 
 function RowMouseOut(sender, eventArgs)
 {
  $get(eventArgs.get_id()).className = "RowMouseOut";
 }
 
 function PostOrder(orderID, postedTo)
 {
     window.open("Order_Post.aspx?orderID=" + orderID + "&postedTo=" + postedTo, "PostOrder","location=no,status=no,scrollbars=yes,width=800,height=600"); 
 }
</script>
<div id="ctl00_cphMainContent_ctl00_cphMainContent_Panel2Panel">
<div id="ctl00_cphMainContent_Panel2" onkeypress="javascript:return WebForm_FireDefaultButton(event, 'ctl00_cphMainContent_btnSearch')">
  
<table cellpadding="0" cellspacing="0" width="100%" border="0" class="container">
<tr>
<td>
<table class="bodyContainer" align="center" border="0" width="98%">
<tr><td width="100%"><h2>Order Search</h2><hr class="dashed" /></td></tr>
</table>
</td>
</tr>
<tr>
<td>
<table id="ctl00_cphMainContent_tblSearch" class="bodyContainer" align="center" border="0" width="98%" cellpadding="0" cellspacing="0">
<tr>
<td>
<table border="0" width="70%">
<tr>
<td bgcolor="#FFFFFF" valign="middle" align="right"><font class="fields">Order #:</font></td>
<td bgcolor="#FFFFFF" valign="middle"><input name="ctl00$cphMainContent$tbxSearchOrderNumber" type="text" id="ctl00_cphMainContent_tbxSearchOrderNumber" style="width:200px;" /></td>
<td bgcolor="#FFFFFF" valign="middle" size="50">&nbsp;</td>
<td bgcolor="#FFFFFF" valign="middle" align="right"><font class="fields">Bill To Name:</font></td>
<td bgcolor="#FFFFFF" valign="middle">
<div id="ctl00_cphMainContent_rcbSearchBillToCode" class="RadComboBox RadComboBox_Default " style="width:200px;display:inline;zoom:1;">
<table cellpadding="0" cellspacing="0" summary="combobox" border="0" style="border-width:0;table-layout:fixed;border-collapse:collapse;width:100%">
<tr>
<td class="rcbInputCell rcbInputCellLeft" style="margin-top:-1px;margin-bottom:-1px;width:100%;"><input class="rcbInput" type="text" id="ctl00_cphMainContent_rcbSearchBillToCode_Input" name="ctl00$cphMainContent$rcbSearchBillToCode" value="" style="display:block;text-decoration:;"></input></td><td class="rcbArrowCell rcbArrowCellRight rcbArrowCellHidden" style="margin-top:-1px;margin-bottom:-1px;"><a id="ctl00_cphMainContent_rcbSearchBillToCode_Arrow" style="overflow: hidden;display: block;position: relative;outline: none;">select</a></td>
</tr>
</table><div class="rcbSlide" style="z-index:6000;"><div id="ctl00_cphMainContent_rcbSearchBillToCode_DropDown" class="RadComboBoxDropDown RadComboBoxDropDown_Default" style="float:left;display:none;width:450px;"><div id="ctl00_cphMainContent_rcbSearchBillToCode_Header" class="rcbHeader">
<table style="width: 450px" cellspacing="0" cellpadding="0">
<tr>
<td style="width: 325px">
                                             Name</td>
<td style="width: 125px"> 
                                            City State</td>
</tr>
</table>
</div><div class="rcbScroll rcbWidth" style="height:100px;float:left;width:100%;"></div></div></div><input id="ctl00_cphMainContent_rcbSearchBillToCode_ClientState" name="ctl00_cphMainContent_rcbSearchBillToCode_ClientState" type="hidden" />
</div>
</td>
</tr>
<tr>
<td bgcolor="#FFFFFF" valign="middle" align="right"><font class="fields">Origin:</font></td>
<td bgcolor="#FFFFFF" valign="middle">
<div id="ctl00_cphMainContent_rcbSearchOrigin" class="RadComboBox RadComboBox_Default " style="width:200px;display:inline;zoom:1;">
<table cellpadding="0" cellspacing="0" summary="combobox" border="0" style="border-width:0;table-layout:fixed;border-collapse:collapse;width:100%">
<tr>
<td class="rcbInputCell rcbInputCellLeft" style="margin-top:-1px;margin-bottom:-1px;width:100%;"><input class="rcbInput" type="text" id="ctl00_cphMainContent_rcbSearchOrigin_Input" name="ctl00$cphMainContent$rcbSearchOrigin" value="" style="display:block;text-decoration:;"></input></td><td class="rcbArrowCell rcbArrowCellRight rcbArrowCellHidden" style="margin-top:-1px;margin-bottom:-1px;"><a id="ctl00_cphMainContent_rcbSearchOrigin_Arrow" style="overflow: hidden;display: block;position: relative;outline: none;">select</a></td>
</tr>
</table><div class="rcbSlide" style="z-index:6000;"><div id="ctl00_cphMainContent_rcbSearchOrigin_DropDown" class="RadComboBoxDropDown RadComboBoxDropDown_Default" style="float:left;display:none;width:350px;"><div class="rcbScroll rcbWidth" style="height:100px;float:left;width:100%;"></div></div></div><input id="ctl00_cphMainContent_rcbSearchOrigin_ClientState" name="ctl00_cphMainContent_rcbSearchOrigin_ClientState" type="hidden" />
</div>
</td>
<td bgcolor="#FFFFFF" valign="middle">&nbsp;</td>
<td bgcolor="#FFFFFF" valign="middle" align="right"><font class="fields">Destination:</font></td>
<td bgcolor="#FFFFFF" valign="middle">
<div id="ctl00_cphMainContent_rcbSearchDest" class="RadComboBox RadComboBox_Default " style="width:200px;display:inline;zoom:1;">
<table cellpadding="0" cellspacing="0" summary="combobox" border="0" style="border-width:0;table-layout:fixed;border-collapse:collapse;width:100%">
<tr>
<td class="rcbInputCell rcbInputCellLeft" style="margin-top:-1px;margin-bottom:-1px;width:100%;"><input class="rcbInput" type="text" id="ctl00_cphMainContent_rcbSearchDest_Input" name="ctl00$cphMainContent$rcbSearchDest" value="" style="display:block;text-decoration:;"></input></td><td class="rcbArrowCell rcbArrowCellRight rcbArrowCellHidden" style="margin-top:-1px;margin-bottom:-1px;"><a id="ctl00_cphMainContent_rcbSearchDest_Arrow" style="overflow: hidden;display: block;position: relative;outline: none;">select</a></td>
</tr>
</table><div class="rcbSlide" style="z-index:6000;"><div id="ctl00_cphMainContent_rcbSearchDest_DropDown" class="RadComboBoxDropDown RadComboBoxDropDown_Default" style="float:left;display:none;width:350px;"><div class="rcbScroll rcbWidth" style="height:100px;float:left;width:100%;"></div></div></div><input id="ctl00_cphMainContent_rcbSearchDest_ClientState" name="ctl00_cphMainContent_rcbSearchDest_ClientState" type="hidden" />
</div>
</td>
</tr>
<tr>
<td bgcolor="#FFFFFF" valign="middle" align="right"><font class="fields">Shipper Name:</font></td>
<td bgcolor="#FFFFFF" valign="middle">
<div id="ctl00_cphMainContent_rcbSearchShipper" class="RadComboBox RadComboBox_Default " style="width:200px;display:inline;zoom:1;">
<table cellpadding="0" cellspacing="0" summary="combobox" border="0" style="border-width:0;table-layout:fixed;border-collapse:collapse;width:100%">
<tr>
<td class="rcbInputCell rcbInputCellLeft" style="margin-top:-1px;margin-bottom:-1px;width:100%;"><input class="rcbInput" type="text" id="ctl00_cphMainContent_rcbSearchShipper_Input" name="ctl00$cphMainContent$rcbSearchShipper" value="" style="display:block;text-decoration:;"></input></td><td class="rcbArrowCell rcbArrowCellRight rcbArrowCellHidden" style="margin-top:-1px;margin-bottom:-1px;"><a id="ctl00_cphMainContent_rcbSearchShipper_Arrow" style="overflow: hidden;display: block;position: relative;outline: none;">select</a></td>
</tr>
</table><div class="rcbSlide" style="z-index:6000;"><div id="ctl00_cphMainContent_rcbSearchShipper_DropDown" class="RadComboBoxDropDown RadComboBoxDropDown_Default" style="float:left;display:none;width:450px;"><div id="ctl00_cphMainContent_rcbSearchShipper_Header" class="rcbHeader">
<table style="width: 450px" cellspacing="0" cellpadding="0">
<tr>
                                       
<td style="width: 325px">
                                            Name</td>
<td style="width: 125px">
                                            City State</td>
</tr>
</table>
</div><div class="rcbScroll rcbWidth" style="height:100px;float:left;width:100%;"></div></div></div><input id="ctl00_cphMainContent_rcbSearchShipper_ClientState" name="ctl00_cphMainContent_rcbSearchShipper_ClientState" type="hidden" />
</div>
</td>
<td bgcolor="#FFFFFF" valign="middle" size="50">&nbsp;</td>
<td bgcolor="#FFFFFF" valign="middle" align="right"><font class="fields">Consignee Name:</font></td>
<td bgcolor="#FFFFFF" valign="middle">
<div id="ctl00_cphMainContent_rcbSearchConsignee" class="RadComboBox RadComboBox_Default " style="width:200px;display:inline;zoom:1;">
<table cellpadding="0" cellspacing="0" summary="combobox" border="0" style="border-width:0;table-layout:fixed;border-collapse:collapse;width:100%">
<tr>
<td class="rcbInputCell rcbInputCellLeft" style="margin-top:-1px;margin-bottom:-1px;width:100%;"><input class="rcbInput" type="text" id="ctl00_cphMainContent_rcbSearchConsignee_Input" name="ctl00$cphMainContent$rcbSearchConsignee" value="" style="display:block;text-decoration:;"></input></td><td class="rcbArrowCell rcbArrowCellRight rcbArrowCellHidden" style="margin-top:-1px;margin-bottom:-1px;"><a id="ctl00_cphMainContent_rcbSearchConsignee_Arrow" style="overflow: hidden;display: block;position: relative;outline: none;">select</a></td>
</tr>
</table><div class="rcbSlide" style="z-index:6000;"><div id="ctl00_cphMainContent_rcbSearchConsignee_DropDown" class="RadComboBoxDropDown RadComboBoxDropDown_Default" style="float:left;display:none;width:450px;"><div id="ctl00_cphMainContent_rcbSearchConsignee_Header" class="rcbHeader">
<table style="width: 450px" cellspacing="0" cellpadding="0">
<tr>
                                        
<td style="width: 255px">
                                            Name</td>
<td style="width: 195px">
                                            City State</td>
</tr>
</table>
</div><div class="rcbScroll rcbWidth" style="height:100px;float:left;width:100%;"></div></div></div><input id="ctl00_cphMainContent_rcbSearchConsignee_ClientState" name="ctl00_cphMainContent_rcbSearchConsignee_ClientState" type="hidden" />
</div>    
</td>
</tr>
<tr>
<td bgcolor="#FFFFFF" valign="middle" align="right"><font class="fields">Driver Last Name:</font></td>
<td bgcolor="#FFFFFF" valign="middle">
<div id="ctl00_cphMainContent_rcbSearchDriver" class="RadComboBox RadComboBox_Default " style="width:200px;display:inline;zoom:1;">
<table cellpadding="0" cellspacing="0" summary="combobox" border="0" style="border-width:0;table-layout:fixed;border-collapse:collapse;width:100%">
<tr>
<td class="rcbInputCell rcbInputCellLeft" style="margin-top:-1px;margin-bottom:-1px;width:100%;"><input class="rcbInput" type="text" id="ctl00_cphMainContent_rcbSearchDriver_Input" name="ctl00$cphMainContent$rcbSearchDriver" value="" style="display:block;text-decoration:;"></input></td><td class="rcbArrowCell rcbArrowCellRight rcbArrowCellHidden" style="margin-top:-1px;margin-bottom:-1px;"><a id="ctl00_cphMainContent_rcbSearchDriver_Arrow" style="overflow: hidden;display: block;position: relative;outline: none;">select</a></td>
</tr>
</table><div class="rcbSlide" style="z-index:6000;"><div id="ctl00_cphMainContent_rcbSearchDriver_DropDown" class="RadComboBoxDropDown RadComboBoxDropDown_Default" style="float:left;display:none;"><div class="rcbScroll rcbWidth" style="height:100px;float:left;width:100%;"></div></div></div><input id="ctl00_cphMainContent_rcbSearchDriver_ClientState" name="ctl00_cphMainContent_rcbSearchDriver_ClientState" type="hidden" />
</div>
</td>
<td bgcolor="#FFFFFF" valign="middle" size="50">&nbsp;</td>
<td bgcolor="#FFFFFF" valign="middle" align="right"><font class="fields">Tractor #:</font></td>
<td bgcolor="#FFFFFF" valign="middle">
<div id="ctl00_cphMainContent_rcbSearchTractor" class="RadComboBox RadComboBox_Default " style="width:200px;display:inline;zoom:1;">
<table cellpadding="0" cellspacing="0" summary="combobox" border="0" style="border-width:0;table-layout:fixed;border-collapse:collapse;width:100%">
<tr>
<td class="rcbInputCell rcbInputCellLeft" style="margin-top:-1px;margin-bottom:-1px;width:100%;"><input class="rcbInput" type="text" id="ctl00_cphMainContent_rcbSearchTractor_Input" name="ctl00$cphMainContent$rcbSearchTractor" value="" style="display:block;text-decoration:;"></input></td><td class="rcbArrowCell rcbArrowCellRight rcbArrowCellHidden" style="margin-top:-1px;margin-bottom:-1px;"><a id="ctl00_cphMainContent_rcbSearchTractor_Arrow" style="overflow: hidden;display: block;position: relative;outline: none;">select</a></td>
</tr>
</table><div class="rcbSlide" style="z-index:6000;"><div id="ctl00_cphMainContent_rcbSearchTractor_DropDown" class="RadComboBoxDropDown RadComboBoxDropDown_Default" style="float:left;display:none;width:300px;"><div class="rcbScroll rcbWidth" style="height:100px;float:left;width:100%;"></div></div></div><input id="ctl00_cphMainContent_rcbSearchTractor_ClientState" name="ctl00_cphMainContent_rcbSearchTractor_ClientState" type="hidden" />
</div>
</td>
</tr>
<tr>
<td bgcolor="#FFFFFF" valign="middle" align="right"><font class="fields">Carrier Name:</font></td>
<td bgcolor="#FFFFFF" valign="middle">
<div id="ctl00_cphMainContent_rcbSearchCarrier" class="RadComboBox RadComboBox_Default " style="width:200px;display:inline;zoom:1;">
<table cellpadding="0" cellspacing="0" summary="combobox" border="0" style="border-width:0;table-layout:fixed;border-collapse:collapse;width:100%">
<tr>
<td class="rcbInputCell rcbInputCellLeft" style="margin-top:-1px;margin-bottom:-1px;width:100%;"><input class="rcbInput" type="text" id="ctl00_cphMainContent_rcbSearchCarrier_Input" name="ctl00$cphMainContent$rcbSearchCarrier" value="" style="display:block;text-decoration:;"></input></td><td class="rcbArrowCell rcbArrowCellRight rcbArrowCellHidden" style="margin-top:-1px;margin-bottom:-1px;"><a id="ctl00_cphMainContent_rcbSearchCarrier_Arrow" style="overflow: hidden;display: block;position: relative;outline: none;">select</a></td>
</tr>
</table><div class="rcbSlide" style="z-index:6000;"><div id="ctl00_cphMainContent_rcbSearchCarrier_DropDown" class="RadComboBoxDropDown RadComboBoxDropDown_Default" style="float:left;display:none;width:200px;"><div class="rcbScroll rcbWidth" style="height:100px;float:left;width:100%;"></div></div></div><input id="ctl00_cphMainContent_rcbSearchCarrier_ClientState" name="ctl00_cphMainContent_rcbSearchCarrier_ClientState" type="hidden" />
</div>
</td>
<td bgcolor="#FFFFFF" valign="middle" size="50">&nbsp;</td>
<td bgcolor="#FFFFFF" valign="middle" align="right"><font class="fields">Reference#:</font></td>
<td bgcolor="#FFFFFF" valign="middle"><input name="ctl00$cphMainContent$txtSearchRefNum" type="text" id="ctl00_cphMainContent_txtSearchRefNum" style="width:200px;" /></td>
</tr>
<tr>
<td bgcolor="#FFFFFF" valign="middle" align="right"><font class="fields">Date From:</font></td>
<td bgcolor="#FFFFFF" valign="middle">
<div id="ctl00_cphMainContent_tbxSearchDateFrom_wrapper" class="RadPicker_Gray " style="display:inline;zoom:1;width:200px;">
<input style="visibility:hidden;display:block;float:right;margin:0 0 -1px;width:1px;height:1px;overflow:hidden;border:0;padding:0;" id="ctl00_cphMainContent_tbxSearchDateFrom" name="ctl00$cphMainContent$tbxSearchDateFrom" type="text" class="rdfd_" value="" /><table cellspacing="0" style="width:100%;">
<tr>
<td class="rcInputCell" style="width:100%;"><span id="ctl00_cphMainContent_tbxSearchDateFrom_dateInput_wrapper" class="RadInput_Gray" style="display:block;"><input type="text" id="ctl00_cphMainContent_tbxSearchDateFrom_dateInput_text" name="ctl00_cphMainContent_tbxSearchDateFrom_dateInput_text" class="riTextBox riEnabled" style="width:100%;" /><input style="visibility:hidden;float:right;margin:-18px 0 0 0;width:1px;height:1px;overflow:hidden;border:0;padding:0;" id="ctl00_cphMainContent_tbxSearchDateFrom_dateInput" name="ctl00$cphMainContent$tbxSearchDateFrom$dateInput" type="text" class="rdfd_" value="" /><input id="ctl00_cphMainContent_tbxSearchDateFrom_dateInput_ClientState" name="ctl00_cphMainContent_tbxSearchDateFrom_dateInput_ClientState" type="hidden" /></span></td><td><a title="Open the calendar popup." href="#" id="ctl00_cphMainContent_tbxSearchDateFrom_popupButton"><img id="ctl00_cphMainContent_tbxSearchDateFrom_CalendarPopupButton" src="Images/iconCalendar2.gif" alt="Open the calendar popup." style="border-width:0px;" /></a><div id="ctl00_cphMainContent_tbxSearchDateFrom_calendar_wrapper" style="display: none" ><table id="ctl00_cphMainContent_tbxSearchDateFrom_calendar" summary="Calendar" cellspacing="0" class="RadCalendar_Gray" border="0">
<thead>
<tr>
<td class="rcTitlebar"><table cellspacing="0" summary="title and navigation" border="0">
<tr>
<td><a id="ctl00_cphMainContent_tbxSearchDateFrom_calendar_FNP" class="rcFastPrev" title="&lt;&lt;" href="#">&lt;&lt;</a></td><td><a id="ctl00_cphMainContent_tbxSearchDateFrom_calendar_NP" class="rcPrev" title="&lt;" href="#">&lt;</a></td><td id="ctl00_cphMainContent_tbxSearchDateFrom_calendar_Title" class="rcTitle">September 2010</td><td><a id="ctl00_cphMainContent_tbxSearchDateFrom_calendar_NN" class="rcNext" title=">" href="#">&gt;</a></td><td><a id="ctl00_cphMainContent_tbxSearchDateFrom_calendar_FNN" class="rcFastNext" title=">>" href="#">&gt;&gt;</a></td>
</tr>
</table></td>
</tr>
</thead><tbody>
<tr>
<td class="rcMain"><table id="ctl00_cphMainContent_tbxSearchDateFrom_calendar_Top" class="rcMainTable" cellspacing="0" summary="September 2010" border="0">
<thead>
<tr class="rcWeek">
<th id="ctl00_cphMainContent_tbxSearchDateFrom_calendar_Top_cs_0" title="Sunday" abbr="Sun" scope="col" style="background-color:White;">S</th><th id="ctl00_cphMainContent_tbxSearchDateFrom_calendar_Top_cs_1" title="Monday" abbr="Mon" scope="col" style="background-color:White;">M</th><th id="ctl00_cphMainContent_tbxSearchDateFrom_calendar_Top_cs_2" title="Tuesday" abbr="Tue" scope="col" style="background-color:White;">T</th><th id="ctl00_cphMainContent_tbxSearchDateFrom_calendar_Top_cs_3" title="Wednesday" abbr="Wed" scope="col" style="background-color:White;">W</th><th id="ctl00_cphMainContent_tbxSearchDateFrom_calendar_Top_cs_4" title="Thursday" abbr="Thu" scope="col" style="background-color:White;">T</th><th id="ctl00_cphMainContent_tbxSearchDateFrom_calendar_Top_cs_5" title="Friday" abbr="Fri" scope="col" style="background-color:White;">F</th><th id="ctl00_cphMainContent_tbxSearchDateFrom_calendar_Top_cs_6" title="Saturday" abbr="Sat" scope="col" style="background-color:White;">S</th>
</tr>
</thead><tbody>
<tr class="rcRow">
<td class="rcOtherMonth" title="Sunday, August 29, 2010"><a href="#">29</a></td><td class="rcOtherMonth" title="Monday, August 30, 2010"><a href="#">30</a></td><td class="rcOtherMonth" title="Tuesday, August 31, 2010"><a href="#">31</a></td><td title="Wednesday, September 01, 2010"><a href="#">1</a></td><td title="Thursday, September 02, 2010"><a href="#">2</a></td><td title="Friday, September 03, 2010"><a href="#">3</a></td><td class="rcWeekend" title="Saturday, September 04, 2010"><a href="#">4</a></td>
</tr><tr class="rcRow">
<td class="rcWeekend" title="Sunday, September 05, 2010"><a href="#">5</a></td><td title="Monday, September 06, 2010"><a href="#">6</a></td><td title="Tuesday, September 07, 2010"><a href="#">7</a></td><td title="Wednesday, September 08, 2010"><a href="#">8</a></td><td title="Thursday, September 09, 2010"><a href="#">9</a></td><td title="Friday, September 10, 2010"><a href="#">10</a></td><td class="rcWeekend" title="Saturday, September 11, 2010"><a href="#">11</a></td>
</tr><tr class="rcRow">
<td class="rcWeekend" title="Sunday, September 12, 2010"><a href="#">12</a></td><td title="Monday, September 13, 2010"><a href="#">13</a></td><td title="Tuesday, September 14, 2010"><a href="#">14</a></td><td title="Wednesday, September 15, 2010"><a href="#">15</a></td><td title="Thursday, September 16, 2010"><a href="#">16</a></td><td title="Friday, September 17, 2010"><a href="#">17</a></td><td class="rcWeekend" title="Saturday, September 18, 2010"><a href="#">18</a></td>
</tr><tr class="rcRow">
<td class="rcWeekend" title="Sunday, September 19, 2010"><a href="#">19</a></td><td title="Monday, September 20, 2010"><a href="#">20</a></td><td title="Tuesday, September 21, 2010"><a href="#">21</a></td><td title="Wednesday, September 22, 2010"><a href="#">22</a></td><td title="Thursday, September 23, 2010"><a href="#">23</a></td><td title="Friday, September 24, 2010"><a href="#">24</a></td><td class="rcWeekend" title="Saturday, September 25, 2010"><a href="#">25</a></td>
</tr><tr class="rcRow">
<td class="rcWeekend" title="Sunday, September 26, 2010"><a href="#">26</a></td><td title="Monday, September 27, 2010"><a href="#">27</a></td><td title="Tuesday, September 28, 2010"><a href="#">28</a></td><td title="Wednesday, September 29, 2010"><a href="#">29</a></td><td title="Thursday, September 30, 2010"><a href="#">30</a></td><td class="rcOtherMonth" title="Friday, October 01, 2010"><a href="#">1</a></td><td class="rcOtherMonth" title="Saturday, October 02, 2010"><a href="#">2</a></td>
</tr><tr class="rcRow">
<td class="rcOtherMonth" title="Sunday, October 03, 2010"><a href="#">3</a></td><td class="rcOtherMonth" title="Monday, October 04, 2010"><a href="#">4</a></td><td class="rcOtherMonth" title="Tuesday, October 05, 2010"><a href="#">5</a></td><td class="rcOtherMonth" title="Wednesday, October 06, 2010"><a href="#">6</a></td><td class="rcOtherMonth" title="Thursday, October 07, 2010"><a href="#">7</a></td><td class="rcOtherMonth" title="Friday, October 08, 2010"><a href="#">8</a></td><td class="rcOtherMonth" title="Saturday, October 09, 2010"><a href="#">9</a></td>
</tr>
</tbody>
</table></td>
</tr>
</tbody>
</table><input type="hidden" name="ctl00_cphMainContent_tbxSearchDateFrom_calendar_SD" id="ctl00_cphMainContent_tbxSearchDateFrom_calendar_SD" value="[]" /><input type="hidden" name="ctl00_cphMainContent_tbxSearchDateFrom_calendar_AD" id="ctl00_cphMainContent_tbxSearchDateFrom_calendar_AD" value="[[1980,1,1],[2099,12,30],[2010,9,29]]" /></div></td><td><div id="ctl00_cphMainContent_tbxSearchDateFrom_timeView_wrapper" style="display: none;" ><div id="ctl00_cphMainContent_tbxSearchDateFrom_timeView">
<table id="ctl00_cphMainContent_tbxSearchDateFrom_timeView_tdl" class="RadCalendarTimeView_Gray" cellspacing="0" border="0">
<tr>
<th colspan="3" scope="col" class="rcHeader">Time Picker</th>
</tr><tr>
<td><a href="#">12:00 AM</a></td><td><a href="#">1:00 AM</a></td><td><a href="#">2:00 AM</a></td>
</tr><tr>
<td><a href="#">3:00 AM</a></td><td><a href="#">4:00 AM</a></td><td><a href="#">5:00 AM</a></td>
</tr><tr>
<td><a href="#">6:00 AM</a></td><td><a href="#">7:00 AM</a></td><td><a href="#">8:00 AM</a></td>
</tr><tr>
<td><a href="#">9:00 AM</a></td><td><a href="#">10:00 AM</a></td><td><a href="#">11:00 AM</a></td>
</tr><tr>
<td><a href="#">12:00 PM</a></td><td><a href="#">1:00 PM</a></td><td><a href="#">2:00 PM</a></td>
</tr><tr>
<td><a href="#">3:00 PM</a></td><td><a href="#">4:00 PM</a></td><td><a href="#">5:00 PM</a></td>
</tr><tr>
<td><a href="#">6:00 PM</a></td><td><a href="#">7:00 PM</a></td><td><a href="#">8:00 PM</a></td>
</tr><tr>
<td><a href="#">9:00 PM</a></td><td><a href="#">10:00 PM</a></td><td><a href="#">11:00 PM</a></td>
</tr>
</table><input id="ctl00_cphMainContent_tbxSearchDateFrom_timeView_ClientState" name="ctl00_cphMainContent_tbxSearchDateFrom_timeView_ClientState" type="hidden" />
</div></div></td>
</tr>
</table><input id="ctl00_cphMainContent_tbxSearchDateFrom_ClientState" name="ctl00_cphMainContent_tbxSearchDateFrom_ClientState" type="hidden" />
</div>
</td>
<td bgcolor="#FFFFFF" valign="middle" size="50">&nbsp;</td>
<td bgcolor="#FFFFFF" valign="middle" align="right"><font class="fields">Date To:</font></td>
<td bgcolor="#FFFFFF" valign="middle">
<div id="ctl00_cphMainContent_tbxSearchDateTo_wrapper" class="RadPicker_Gray " style="display:inline;zoom:1;width:200px;">
<input style="visibility:hidden;display:block;float:right;margin:0 0 -1px;width:1px;height:1px;overflow:hidden;border:0;padding:0;" id="ctl00_cphMainContent_tbxSearchDateTo" name="ctl00$cphMainContent$tbxSearchDateTo" type="text" class="rdfd_" value="" /><table cellspacing="0" style="width:100%;">
<tr>
<td class="rcInputCell" style="width:100%;"><span id="ctl00_cphMainContent_tbxSearchDateTo_dateInput_wrapper" class="RadInput_Gray" style="display:block;"><input type="text" id="ctl00_cphMainContent_tbxSearchDateTo_dateInput_text" name="ctl00_cphMainContent_tbxSearchDateTo_dateInput_text" class="riTextBox riEnabled" style="width:100%;" /><input style="visibility:hidden;float:right;margin:-18px 0 0 0;width:1px;height:1px;overflow:hidden;border:0;padding:0;" id="ctl00_cphMainContent_tbxSearchDateTo_dateInput" name="ctl00$cphMainContent$tbxSearchDateTo$dateInput" type="text" class="rdfd_" value="" /><input id="ctl00_cphMainContent_tbxSearchDateTo_dateInput_ClientState" name="ctl00_cphMainContent_tbxSearchDateTo_dateInput_ClientState" type="hidden" /></span></td><td><a title="Open the calendar popup." href="#" id="ctl00_cphMainContent_tbxSearchDateTo_popupButton"><img id="ctl00_cphMainContent_tbxSearchDateTo_CalendarPopupButton" src="Images/iconCalendar2.gif" alt="Open the calendar popup." style="border-width:0px;" /></a><div id="ctl00_cphMainContent_tbxSearchDateTo_calendar_wrapper" style="display: none" ><table id="ctl00_cphMainContent_tbxSearchDateTo_calendar" summary="Calendar" cellspacing="0" class="RadCalendar_Gray" border="0">
<thead>
<tr>
<td class="rcTitlebar"><table cellspacing="0" summary="title and navigation" border="0">
<tr>
<td><a id="ctl00_cphMainContent_tbxSearchDateTo_calendar_FNP" class="rcFastPrev" title="&lt;&lt;" href="#">&lt;&lt;</a></td><td><a id="ctl00_cphMainContent_tbxSearchDateTo_calendar_NP" class="rcPrev" title="&lt;" href="#">&lt;</a></td><td id="ctl00_cphMainContent_tbxSearchDateTo_calendar_Title" class="rcTitle">September 2010</td><td><a id="ctl00_cphMainContent_tbxSearchDateTo_calendar_NN" class="rcNext" title=">" href="#">&gt;</a></td><td><a id="ctl00_cphMainContent_tbxSearchDateTo_calendar_FNN" class="rcFastNext" title=">>" href="#">&gt;&gt;</a></td>
</tr>
</table></td>
</tr>
</thead><tbody>
<tr>
<td class="rcMain"><table id="ctl00_cphMainContent_tbxSearchDateTo_calendar_Top" class="rcMainTable" cellspacing="0" summary="September 2010" border="0">
<thead>
<tr class="rcWeek">
<th id="ctl00_cphMainContent_tbxSearchDateTo_calendar_Top_cs_0" title="Sunday" abbr="Sun" scope="col" style="background-color:White;">S</th><th id="ctl00_cphMainContent_tbxSearchDateTo_calendar_Top_cs_1" title="Monday" abbr="Mon" scope="col" style="background-color:White;">M</th><th id="ctl00_cphMainContent_tbxSearchDateTo_calendar_Top_cs_2" title="Tuesday" abbr="Tue" scope="col" style="background-color:White;">T</th><th id="ctl00_cphMainContent_tbxSearchDateTo_calendar_Top_cs_3" title="Wednesday" abbr="Wed" scope="col" style="background-color:White;">W</th><th id="ctl00_cphMainContent_tbxSearchDateTo_calendar_Top_cs_4" title="Thursday" abbr="Thu" scope="col" style="background-color:White;">T</th><th id="ctl00_cphMainContent_tbxSearchDateTo_calendar_Top_cs_5" title="Friday" abbr="Fri" scope="col" style="background-color:White;">F</th><th id="ctl00_cphMainContent_tbxSearchDateTo_calendar_Top_cs_6" title="Saturday" abbr="Sat" scope="col" style="background-color:White;">S</th>
</tr>
</thead><tbody>
<tr class="rcRow">
<td class="rcOtherMonth" title="Sunday, August 29, 2010"><a href="#">29</a></td><td class="rcOtherMonth" title="Monday, August 30, 2010"><a href="#">30</a></td><td class="rcOtherMonth" title="Tuesday, August 31, 2010"><a href="#">31</a></td><td title="Wednesday, September 01, 2010"><a href="#">1</a></td><td title="Thursday, September 02, 2010"><a href="#">2</a></td><td title="Friday, September 03, 2010"><a href="#">3</a></td><td class="rcWeekend" title="Saturday, September 04, 2010"><a href="#">4</a></td>
</tr><tr class="rcRow">
<td class="rcWeekend" title="Sunday, September 05, 2010"><a href="#">5</a></td><td title="Monday, September 06, 2010"><a href="#">6</a></td><td title="Tuesday, September 07, 2010"><a href="#">7</a></td><td title="Wednesday, September 08, 2010"><a href="#">8</a></td><td title="Thursday, September 09, 2010"><a href="#">9</a></td><td title="Friday, September 10, 2010"><a href="#">10</a></td><td class="rcWeekend" title="Saturday, September 11, 2010"><a href="#">11</a></td>
</tr><tr class="rcRow">
<td class="rcWeekend" title="Sunday, September 12, 2010"><a href="#">12</a></td><td title="Monday, September 13, 2010"><a href="#">13</a></td><td title="Tuesday, September 14, 2010"><a href="#">14</a></td><td title="Wednesday, September 15, 2010"><a href="#">15</a></td><td title="Thursday, September 16, 2010"><a href="#">16</a></td><td title="Friday, September 17, 2010"><a href="#">17</a></td><td class="rcWeekend" title="Saturday, September 18, 2010"><a href="#">18</a></td>
</tr><tr class="rcRow">
<td class="rcWeekend" title="Sunday, September 19, 2010"><a href="#">19</a></td><td title="Monday, September 20, 2010"><a href="#">20</a></td><td title="Tuesday, September 21, 2010"><a href="#">21</a></td><td title="Wednesday, September 22, 2010"><a href="#">22</a></td><td title="Thursday, September 23, 2010"><a href="#">23</a></td><td title="Friday, September 24, 2010"><a href="#">24</a></td><td class="rcWeekend" title="Saturday, September 25, 2010"><a href="#">25</a></td>
</tr><tr class="rcRow">
<td class="rcWeekend" title="Sunday, September 26, 2010"><a href="#">26</a></td><td title="Monday, September 27, 2010"><a href="#">27</a></td><td title="Tuesday, September 28, 2010"><a href="#">28</a></td><td title="Wednesday, September 29, 2010"><a href="#">29</a></td><td title="Thursday, September 30, 2010"><a href="#">30</a></td><td class="rcOtherMonth" title="Friday, October 01, 2010"><a href="#">1</a></td><td class="rcOtherMonth" title="Saturday, October 02, 2010"><a href="#">2</a></td>
</tr><tr class="rcRow">
<td class="rcOtherMonth" title="Sunday, October 03, 2010"><a href="#">3</a></td><td class="rcOtherMonth" title="Monday, October 04, 2010"><a href="#">4</a></td><td class="rcOtherMonth" title="Tuesday, October 05, 2010"><a href="#">5</a></td><td class="rcOtherMonth" title="Wednesday, October 06, 2010"><a href="#">6</a></td><td class="rcOtherMonth" title="Thursday, October 07, 2010"><a href="#">7</a></td><td class="rcOtherMonth" title="Friday, October 08, 2010"><a href="#">8</a></td><td class="rcOtherMonth" title="Saturday, October 09, 2010"><a href="#">9</a></td>
</tr>
</tbody>
</table></td>
</tr>
</tbody>
</table><input type="hidden" name="ctl00_cphMainContent_tbxSearchDateTo_calendar_SD" id="ctl00_cphMainContent_tbxSearchDateTo_calendar_SD" value="[]" /><input type="hidden" name="ctl00_cphMainContent_tbxSearchDateTo_calendar_AD" id="ctl00_cphMainContent_tbxSearchDateTo_calendar_AD" value="[[1980,1,1],[2099,12,30],[2010,9,29]]" /></div></td><td><div id="ctl00_cphMainContent_tbxSearchDateTo_timeView_wrapper" style="display: none;" ><div id="ctl00_cphMainContent_tbxSearchDateTo_timeView">
<table id="ctl00_cphMainContent_tbxSearchDateTo_timeView_tdl" class="RadCalendarTimeView_Gray" cellspacing="0" border="0">
<tr>
<th colspan="3" scope="col" class="rcHeader">Time Picker</th>
</tr><tr>
<td><a href="#">12:00 AM</a></td><td><a href="#">1:00 AM</a></td><td><a href="#">2:00 AM</a></td>
</tr><tr>
<td><a href="#">3:00 AM</a></td><td><a href="#">4:00 AM</a></td><td><a href="#">5:00 AM</a></td>
</tr><tr>
<td><a href="#">6:00 AM</a></td><td><a href="#">7:00 AM</a></td><td><a href="#">8:00 AM</a></td>
</tr><tr>
<td><a href="#">9:00 AM</a></td><td><a href="#">10:00 AM</a></td><td><a href="#">11:00 AM</a></td>
</tr><tr>
<td><a href="#">12:00 PM</a></td><td><a href="#">1:00 PM</a></td><td><a href="#">2:00 PM</a></td>
</tr><tr>
<td><a href="#">3:00 PM</a></td><td><a href="#">4:00 PM</a></td><td><a href="#">5:00 PM</a></td>
</tr><tr>
<td><a href="#">6:00 PM</a></td><td><a href="#">7:00 PM</a></td><td><a href="#">8:00 PM</a></td>
</tr><tr>
<td><a href="#">9:00 PM</a></td><td><a href="#">10:00 PM</a></td><td><a href="#">11:00 PM</a></td>
</tr>
</table><input id="ctl00_cphMainContent_tbxSearchDateTo_timeView_ClientState" name="ctl00_cphMainContent_tbxSearchDateTo_timeView_ClientState" type="hidden" />
</div></div></td>
</tr>
</table><input id="ctl00_cphMainContent_tbxSearchDateTo_ClientState" name="ctl00_cphMainContent_tbxSearchDateTo_ClientState" type="hidden" />
</div>
</td>
</tr>
<tr>
<td bgcolor="#FFFFFF" valign="middle">&nbsp;</td>
<td colspan="10" width="500" bgcolor="#FFFFFF" valign="top">
<input type="image" name="ctl00$cphMainContent$btnSearch" id="ctl00_cphMainContent_btnSearch" src="Images/buttonSearch.png" style="border-width:0px;" />
<input type="image" name="ctl00$cphMainContent$btnAddOrder" id="ctl00_cphMainContent_btnAddOrder" src="Images/buttonAddOrder.png" style="border-width:0px;" />
</td>
</tr>
</table>
</td>
</tr>
</table>
  
</td>
</tr>
<tr>
<td align="center">
        
</td>
</tr>
</table>         
</div>
</div>
<div id="ctl00_cphMainContent_RadAjaxLoadingPanel1" style="display:none;height:75px;width:75px;">
 
<table style="width:100%;height:100%;">
<tr style="height:100%"><td align="center" valign="middle" style="width:100%"> 
<div style="background-color:White; width:150px; height:50px; border-style:none; border-color:blue; border-width:1px">
<h2>Loading ...</h2>
<br /><img src="Images/loader.gif" style="margin-top:10px;" alt="&nbsp;" /><br />
</div>
</td>
</tr>
</table>
    
</div>
</td>
</tr>
<tr>
<td><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p></td>
</tr>
</table>    
<script type="text/javascript">
//<![CDATA[
Sys.Application.initialize();
Sys.Application.add_init(function() {
    $create(Telerik.Web.UI.RadTabStrip, {"_postBackReference":"__doPostBack(\u0027ctl00$radTabs\u0027,\u0027{0}\u0027)","_selectedIndex":3,"_skin":"WebBlue","causesValidation":false,"clientStateFieldID":"ctl00_radTabs_ClientState","selectedIndexes":["3"],"tabData":[{},{},{},{},{}]}, null, null, $get("ctl00_radTabs"));
});
Sys.Application.add_init(function() {
    $create(Telerik.Web.UI.RadTabStrip, {"_selectedIndex":0,"_skin":"TIISkin","causesValidation":false,"clientStateFieldID":"ctl00_cphChildNav_radOrderTabs_ClientState","selectedIndexes":["0"],"tabData":[{},{},{},{},{},{"enabled":false},{"enabled":false},{"enabled":false},{"enabled":false},{"enabled":false},{"enabled":false}]}, null, null, $get("ctl00_cphChildNav_radOrderTabs"));
});
Sys.Application.add_init(function() {
    $create(Telerik.Web.UI.RadAjaxManager, {"_updatePanels":"","ajaxSettings":[{InitControlID : "",UpdatedControls : [{ControlID:"",PanelID:"ctl00_cphMainContent_RadAjaxLoadingPanel1"}]},{InitControlID : "ctl00_cphMainContent_Panel2",UpdatedControls : [{ControlID:"ctl00_cphMainContent_Panel2",PanelID:"ctl00_cphMainContent_RadAjaxLoadingPanel1"}]},{InitControlID : "",UpdatedControls : [{ControlID:"",PanelID:"ctl00_cphMainContent_RadAjaxLoadingPanel1"}]},{InitControlID : "",UpdatedControls : [{ControlID:"",PanelID:"ctl00_cphMainContent_RadAjaxLoadingPanel1"}]},{InitControlID : "",UpdatedControls : [{ControlID:"",PanelID:"ctl00_cphMainContent_RadAjaxLoadingPanel1"}]}],"clientEvents":{OnRequestStart:"",OnResponseEnd:""},"defaultLoadingPanelID":"","enableAJAX":true,"enableHistory":false,"links":[],"styles":[],"uniqueID":"ctl00$cphMainContent$RadAjaxManager1","updatePanelsRenderMode":0}, null, null, $get("ctl00_cphMainContent_RadAjaxManager1"));
});
WebForm_InitCallback();Sys.Application.add_init(function() {
    $create(Telerik.Web.UI.RadComboBox, {"_dropDownWidth":450,"_height":100,"_isTemplated":true,"_showDropDownOnTextboxClick":false,"_skin":"Default","_text":"","_uniqueId":"ctl00$cphMainContent$rcbSearchBillToCode","_value":"","_virtualScroll":false,"clientStateFieldID":"ctl00_cphMainContent_rcbSearchBillToCode_ClientState","collapseAnimation":"{\"type\":12,\"duration\":200}","enableLoadOnDemand":true,"highlightTemplatedItems":true,"itemData":[]}, null, null, $get("ctl00_cphMainContent_rcbSearchBillToCode"));
});
Sys.Application.add_init(function() {
    $create(Telerik.Web.UI.RadComboBox, {"_dropDownWidth":350,"_height":100,"_showDropDownOnTextboxClick":false,"_skin":"Default","_text":"","_uniqueId":"ctl00$cphMainContent$rcbSearchOrigin","_value":"","_virtualScroll":false,"clientStateFieldID":"ctl00_cphMainContent_rcbSearchOrigin_ClientState","collapseAnimation":"{\"type\":12,\"duration\":200}","enableLoadOnDemand":true,"highlightTemplatedItems":true,"itemData":[]}, null, null, $get("ctl00_cphMainContent_rcbSearchOrigin"));
});
Sys.Application.add_init(function() {
    $create(Telerik.Web.UI.RadComboBox, {"_dropDownWidth":350,"_height":100,"_showDropDownOnTextboxClick":false,"_skin":"Default","_text":"","_uniqueId":"ctl00$cphMainContent$rcbSearchDest","_value":"","_virtualScroll":false,"clientStateFieldID":"ctl00_cphMainContent_rcbSearchDest_ClientState","collapseAnimation":"{\"type\":12,\"duration\":200}","enableLoadOnDemand":true,"highlightTemplatedItems":true,"itemData":[]}, null, null, $get("ctl00_cphMainContent_rcbSearchDest"));
});
Sys.Application.add_init(function() {
    $create(Telerik.Web.UI.RadComboBox, {"_dropDownWidth":450,"_height":100,"_isTemplated":true,"_showDropDownOnTextboxClick":false,"_skin":"Default","_text":"","_uniqueId":"ctl00$cphMainContent$rcbSearchShipper","_value":"","_virtualScroll":false,"clientStateFieldID":"ctl00_cphMainContent_rcbSearchShipper_ClientState","collapseAnimation":"{\"type\":12,\"duration\":200}","enableLoadOnDemand":true,"highlightTemplatedItems":true,"itemData":[]}, null, null, $get("ctl00_cphMainContent_rcbSearchShipper"));
});
Sys.Application.add_init(function() {
    $create(Telerik.Web.UI.RadComboBox, {"_dropDownWidth":450,"_height":100,"_isTemplated":true,"_showDropDownOnTextboxClick":false,"_skin":"Default","_text":"","_uniqueId":"ctl00$cphMainContent$rcbSearchConsignee","_value":"","_virtualScroll":false,"clientStateFieldID":"ctl00_cphMainContent_rcbSearchConsignee_ClientState","collapseAnimation":"{\"type\":12,\"duration\":200}","enableLoadOnDemand":true,"highlightTemplatedItems":true,"itemData":[]}, null, null, $get("ctl00_cphMainContent_rcbSearchConsignee"));
});
Sys.Application.add_init(function() {
    $create(Telerik.Web.UI.RadComboBox, {"_dropDownWidth":0,"_height":100,"_showDropDownOnTextboxClick":false,"_skin":"Default","_text":"","_uniqueId":"ctl00$cphMainContent$rcbSearchDriver","_value":"","_virtualScroll":false,"clientStateFieldID":"ctl00_cphMainContent_rcbSearchDriver_ClientState","collapseAnimation":"{\"type\":12,\"duration\":200}","enableLoadOnDemand":true,"highlightTemplatedItems":true,"itemData":[]}, null, null, $get("ctl00_cphMainContent_rcbSearchDriver"));
});
Sys.Application.add_init(function() {
    $create(Telerik.Web.UI.RadComboBox, {"_dropDownWidth":300,"_height":100,"_showDropDownOnTextboxClick":false,"_skin":"Default","_text":"","_uniqueId":"ctl00$cphMainContent$rcbSearchTractor","_value":"","_virtualScroll":false,"clientStateFieldID":"ctl00_cphMainContent_rcbSearchTractor_ClientState","collapseAnimation":"{\"type\":12,\"duration\":200}","enableLoadOnDemand":true,"highlightTemplatedItems":true,"itemData":[]}, null, null, $get("ctl00_cphMainContent_rcbSearchTractor"));
});
Sys.Application.add_init(function() {
    $create(Telerik.Web.UI.RadComboBox, {"_dropDownWidth":200,"_height":100,"_showDropDownOnTextboxClick":false,"_skin":"Default","_text":"","_uniqueId":"ctl00$cphMainContent$rcbSearchCarrier","_value":"","_virtualScroll":false,"clientStateFieldID":"ctl00_cphMainContent_rcbSearchCarrier_ClientState","collapseAnimation":"{\"type\":12,\"duration\":200}","enableLoadOnDemand":true,"highlightTemplatedItems":true,"itemData":[]}, null, null, $get("ctl00_cphMainContent_rcbSearchCarrier"));
});
Sys.Application.add_init(function() {
    $create(Telerik.Web.UI.RadDateInput, {"_focused":false,"_originalValue":"","_postBackEventReferenceScript":"__doPostBack(\u0027ctl00$cphMainContent$tbxSearchDateFrom\u0027,\u0027\u0027)","clientStateFieldID":"ctl00_cphMainContent_tbxSearchDateFrom_dateInput_ClientState","dateFormat":"MM/dd/yyyy","dateFormatInfo":{"DayNames":["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],"MonthNames":["January","February","March","April","May","June","July","August","September","October","November","December",""],"AbbreviatedDayNames":["Sun","Mon","Tue","Wed","Thu","Fri","Sat"],"AbbreviatedMonthNames":["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec",""],"AMDesignator":"AM","PMDesignator":"PM","DateSeparator":"/","TimeSeparator":":","FirstDayOfWeek":0,"DateSlots":{"Month":0,"Year":2,"Day":1},"ShortYearCenturyEnd":2029,"TimeInputOnly":false},"displayDateFormat":"MM/dd/yyyy","enabled":true,"incrementSettings":{InterceptArrowKeys:true,InterceptMouseWheel:true,Step:1},"styles":{HoveredStyle: ["width:100%;", "riTextBox riHover"],InvalidStyle: ["width:100%;", "riTextBox riError"],DisabledStyle: ["width:100%;", "riTextBox riDisabled"],FocusedStyle: ["width:100%;", "riTextBox riFocused"],EmptyMessageStyle: ["width:100%;", "riTextBox riEmpty"],ReadOnlyStyle: ["width:100%;", "riTextBox riRead"],EnabledStyle: ["width:100%;", "riTextBox riEnabled"]}}, null, null, $get("ctl00_cphMainContent_tbxSearchDateFrom_dateInput"));
});
Sys.Application.add_init(function() {
    $create(Telerik.Web.UI.RadCalendar, {"_DayRenderChangedDays":{},"_FormatInfoArray":[["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],["Sun","Mon","Tue","Wed","Thu","Fri","Sat"],["January","February","March","April","May","June","July","August","September","October","November","December",],["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec",],"dddd, MMMM dd, yyyy h:mm:ss tt","dddd, MMMM dd, yyyy","h:mm:ss tt","MMMM dd","ddd, dd MMM yyyy HH\':\'mm\':\'ss \'GMT\'","M/d/yyyy","h:mm tt","yyyy\'-\'MM\'-\'dd\'T\'HH\':\'mm\':\'ss","yyyy\'-\'MM\'-\'dd HH\':\'mm\':\'ss\'Z\'","MMMM, yyyy","AM","PM","/",":",0],"_ViewRepeatableDays":{},"_ViewsHash":{ctl00_cphMainContent_tbxSearchDateFrom_calendar_Top : [[2010,9,1], 1]},"_calendarWeekRule":0,"_firstDayOfWeek":7,"_postBackCall":"__doPostBack(\u0027ctl00$cphMainContent$tbxSearchDateFrom$calendar\u0027,\u0027@@\u0027)","clientStateFieldID":"ctl00_cphMainContent_tbxSearchDateFrom_calendar_ClientState","enabled":true,"monthYearNavigationSettings":["Today","OK","Cancel","Date is out of range.","False"],"skin":"Gray","specialDaysArray":[],"stylesHash":{DayStyle: ["", ""],CalendarTableStyle: ["", "rcMainTable"],OtherMonthDayStyle: ["", "rcOtherMonth"],TitleStyle: ["", ""],SelectedDayStyle: ["", "rcSelected"],SelectorStyle: ["background-color:White;", ""],DisabledDayStyle: ["", "rcDisabled"],OutOfRangeDayStyle: ["", "rcOutOfRange"],WeekendDayStyle: ["", "rcWeekend"],DayOverStyle: ["", "rcHover"],FastNavigationStyle: ["", "RadCalendarMonthView_Gray"],ViewSelectorStyle: ["", "rcViewSel"]},"useColumnHeadersAsSelectors":false,"useRowHeadersAsSelectors":false}, null, null, $get("ctl00_cphMainContent_tbxSearchDateFrom_calendar"));
});
Sys.Application.add_init(function() {
    $create(Telerik.Web.UI.RadTimeView, {"_ItemsCount":24,"_OwnerDatePickerID":"ctl00_cphMainContent_tbxSearchDateFrom","_TimeOverStyleCss":"rcHover","clientStateFieldID":"ctl00_cphMainContent_tbxSearchDateFrom_timeView_ClientState","itemStyles":{TimeStyle: ["", ""],AlternatingTimeStyle: ["", ""],HeaderStyle: ["", "rcHeader"],FooterStyle: ["", "rcFooter"],TimeOverStyle: ["", "rcHover"]}}, null, null, $get("ctl00_cphMainContent_tbxSearchDateFrom_timeView"));
});
Sys.Application.add_init(function() {
    $create(Telerik.Web.UI.RadDateTimePicker, {"_PopupButtonSettings":{  ResolvedImageUrl : "/Images/iconCalendar2.gif", ResolvedHoverImageUrl : "/Images/iconCalendar2Hover.gif"},"_TimePopupButtonSettings":{  ResolvedImageUrl : "", ResolvedHoverImageUrl : ""},"_popupControlID":"ctl00_cphMainContent_tbxSearchDateFrom_popupButton","_timePopupControlID":"ctl00_cphMainContent_tbxSearchDateFrom_timePopupLink","clientStateFieldID":"ctl00_cphMainContent_tbxSearchDateFrom_ClientState","focusedDate":"2010-09-29-00-00-00"}, null, {"calendar":"ctl00_cphMainContent_tbxSearchDateFrom_calendar","dateInput":"ctl00_cphMainContent_tbxSearchDateFrom_dateInput","timeView":"ctl00_cphMainContent_tbxSearchDateFrom_timeView"}, $get("ctl00_cphMainContent_tbxSearchDateFrom"));
});
Sys.Application.add_init(function() {
    $create(Telerik.Web.UI.RadDateInput, {"_focused":false,"_originalValue":"","_postBackEventReferenceScript":"__doPostBack(\u0027ctl00$cphMainContent$tbxSearchDateTo\u0027,\u0027\u0027)","clientStateFieldID":"ctl00_cphMainContent_tbxSearchDateTo_dateInput_ClientState","dateFormat":"MM/dd/yyyy","dateFormatInfo":{"DayNames":["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],"MonthNames":["January","February","March","April","May","June","July","August","September","October","November","December",""],"AbbreviatedDayNames":["Sun","Mon","Tue","Wed","Thu","Fri","Sat"],"AbbreviatedMonthNames":["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec",""],"AMDesignator":"AM","PMDesignator":"PM","DateSeparator":"/","TimeSeparator":":","FirstDayOfWeek":0,"DateSlots":{"Month":0,"Year":2,"Day":1},"ShortYearCenturyEnd":2029,"TimeInputOnly":false},"displayDateFormat":"MM/dd/yyyy","enabled":true,"incrementSettings":{InterceptArrowKeys:true,InterceptMouseWheel:true,Step:1},"styles":{HoveredStyle: ["width:100%;", "riTextBox riHover"],InvalidStyle: ["width:100%;", "riTextBox riError"],DisabledStyle: ["width:100%;", "riTextBox riDisabled"],FocusedStyle: ["width:100%;", "riTextBox riFocused"],EmptyMessageStyle: ["width:100%;", "riTextBox riEmpty"],ReadOnlyStyle: ["width:100%;", "riTextBox riRead"],EnabledStyle: ["width:100%;", "riTextBox riEnabled"]}}, null, null, $get("ctl00_cphMainContent_tbxSearchDateTo_dateInput"));
});
Sys.Application.add_init(function() {
    $create(Telerik.Web.UI.RadCalendar, {"_DayRenderChangedDays":{},"_FormatInfoArray":[["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],["Sun","Mon","Tue","Wed","Thu","Fri","Sat"],["January","February","March","April","May","June","July","August","September","October","November","December",],["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec",],"dddd, MMMM dd, yyyy h:mm:ss tt","dddd, MMMM dd, yyyy","h:mm:ss tt","MMMM dd","ddd, dd MMM yyyy HH\':\'mm\':\'ss \'GMT\'","M/d/yyyy","h:mm tt","yyyy\'-\'MM\'-\'dd\'T\'HH\':\'mm\':\'ss","yyyy\'-\'MM\'-\'dd HH\':\'mm\':\'ss\'Z\'","MMMM, yyyy","AM","PM","/",":",0],"_ViewRepeatableDays":{},"_ViewsHash":{ctl00_cphMainContent_tbxSearchDateTo_calendar_Top : [[2010,9,1], 1]},"_calendarWeekRule":0,"_firstDayOfWeek":7,"_postBackCall":"__doPostBack(\u0027ctl00$cphMainContent$tbxSearchDateTo$calendar\u0027,\u0027@@\u0027)","clientStateFieldID":"ctl00_cphMainContent_tbxSearchDateTo_calendar_ClientState","enabled":true,"monthYearNavigationSettings":["Today","OK","Cancel","Date is out of range.","False"],"skin":"Gray","specialDaysArray":[],"stylesHash":{DayStyle: ["", ""],CalendarTableStyle: ["", "rcMainTable"],OtherMonthDayStyle: ["", "rcOtherMonth"],TitleStyle: ["", ""],SelectedDayStyle: ["", "rcSelected"],SelectorStyle: ["background-color:White;", ""],DisabledDayStyle: ["", "rcDisabled"],OutOfRangeDayStyle: ["", "rcOutOfRange"],WeekendDayStyle: ["", "rcWeekend"],DayOverStyle: ["", "rcHover"],FastNavigationStyle: ["", "RadCalendarMonthView_Gray"],ViewSelectorStyle: ["", "rcViewSel"]},"useColumnHeadersAsSelectors":false,"useRowHeadersAsSelectors":false}, null, null, $get("ctl00_cphMainContent_tbxSearchDateTo_calendar"));
});
Sys.Application.add_init(function() {
    $create(Telerik.Web.UI.RadTimeView, {"_ItemsCount":24,"_OwnerDatePickerID":"ctl00_cphMainContent_tbxSearchDateTo","_TimeOverStyleCss":"rcHover","clientStateFieldID":"ctl00_cphMainContent_tbxSearchDateTo_timeView_ClientState","itemStyles":{TimeStyle: ["", ""],AlternatingTimeStyle: ["", ""],HeaderStyle: ["", "rcHeader"],FooterStyle: ["", "rcFooter"],TimeOverStyle: ["", "rcHover"]}}, null, null, $get("ctl00_cphMainContent_tbxSearchDateTo_timeView"));
});
Sys.Application.add_init(function() {
    $create(Telerik.Web.UI.RadDateTimePicker, {"_PopupButtonSettings":{  ResolvedImageUrl : "/Images/iconCalendar2.gif", ResolvedHoverImageUrl : "/Images/iconCalendar2Hover.gif"},"_TimePopupButtonSettings":{  ResolvedImageUrl : "", ResolvedHoverImageUrl : ""},"_popupControlID":"ctl00_cphMainContent_tbxSearchDateTo_popupButton","_timePopupControlID":"ctl00_cphMainContent_tbxSearchDateTo_timePopupLink","clientStateFieldID":"ctl00_cphMainContent_tbxSearchDateTo_ClientState","focusedDate":"2010-09-29-00-00-00"}, null, {"calendar":"ctl00_cphMainContent_tbxSearchDateTo_calendar","dateInput":"ctl00_cphMainContent_tbxSearchDateTo_dateInput","timeView":"ctl00_cphMainContent_tbxSearchDateTo_timeView"}, $get("ctl00_cphMainContent_tbxSearchDateTo"));
});
Sys.Application.add_init(function() {
    $create(Telerik.Web.UI.RadAjaxLoadingPanel, {"initialDelayTime":0,"isSticky":false,"minDisplayTime":20,"transparency":0,"uniqueID":"ctl00$cphMainContent$RadAjaxLoadingPanel1","zIndex":90000}, null, null, $get("ctl00_cphMainContent_RadAjaxLoadingPanel1"));
});
//]]>
</script>
</form>
</body>
</html>