<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Transport Investments Logistics Tool</title>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<link href="CSS/all.css" rel="stylesheet" type="text/css" />
	<link href="style.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript">
	var tickspeed=6000 //ticker speed in miliseconds (2000=2 seconds)
var enablesubject=1 //enable scroller subject? Set to 0 to hide

if (document.getElementById){
document.write('<style type="text/css">\n')
document.write('.dropcontent{display:none;}\n')
document.write('</style>\n')
}

var selectedDiv=0
var totalDivs=0

function contractall(){
var inc=0
while (document.getElementById("dropmsg"+inc)){
document.getElementById("dropmsg"+inc).style.display="none"
inc++
}
}


function expandone(){
var selectedDivObj=document.getElementById("dropmsg"+selectedDiv)
contractall()
document.getElementById("dropcontentsubject").innerHTML=selectedDivObj.getAttribute("subject")
selectedDivObj.style.display="block"
selectedDiv=(selectedDiv<totalDivs-1)? selectedDiv+1 : 0
setTimeout("expandone()",tickspeed)
}

function startscroller(){
while (document.getElementById("dropmsg"+totalDivs)!=null)
totalDivs++
expandone()
if (!enablesubject)
document.getElementById("dropcontentsubject").style.display="none"
}

if (window.addEventListener)
window.addEventListener("load", startscroller, false)
else if (window.attachEvent)
window.attachEvent("onload", startscroller)

<!--
function showHide(elementid){
if (document.getElementById(elementid).style.display != 'none'){
document.getElementById(elementid).style.display = 'none';
} else {
document.getElementById(elementid).style.display = '';
}
}
function popWin(mypage, myname, w, h, scroll) {
    var winl = (screen.width - w) / 2;
    var wint = (screen.height - h) / 2;
    winprops = 'height=' + h + ',width=' + w + ',top=' + wint + ',left=' + winl + ',scrollbars=no,resizable=no';
    win = window.open(mypage, myname, winprops);
}
function popWin1(mypage, myname, w, h, scroll) {
    var winl = (screen.width - w) / 2;
    var wint = (screen.height - h) / 2;
    winprops = 'height=' + h + ',width=' + w + ',top=' + wint + ',left=' + winl + ',scrollbars=yes,resizable=yes';
    win = window.open(mypage, myname, winprops);
} 

function popWin2(mypage, myname, w, h, scroll) {
    var winl = (screen.width - w) / 2;
    var wint = (screen.height - h) / 2;
    winprops = 'height=' + h + ',width=' + w + ',top=' + wint + ',left=' + winl + ',scrollbars=yes,resizable=yes';
    win = window.open(mypage, myname, winprops);
} 

//-->
</script>

</head>
<body class="home"> 
<form name="form2" method="post" action="Default2.aspx" id="form2">
<div>
<input type="hidden" name="RadScriptManager1_HiddenField" id="RadScriptManager1_HiddenField" value="" />
<input type="hidden" name="__EVENTTARGET" id="__EVENTTARGET" value="" />
<input type="hidden" name="__EVENTARGUMENT" id="__EVENTARGUMENT" value="" />
<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="/wEPDwULLTE5MjU1MTcwMDEPZBYCAgEPZBYSAgcPDxYCHgRUZXh0BRFXZWxjb21lIEpha2UgVGVzdGRkAgkPDxYCHwAFHFR1ZXNkYXksIFNlcHRlbWJlciAyOCwgMjAxMCBkZAIND2QWAgIBDxQrAAIUKwACDxYCHhdFbmFibGVBamF4U2tpblJlbmRlcmluZ2hkEBYHZgIBAgICAwIEAgUCBhYHFCsAAmRkFCsAAmRkFCsAAmRkFCsAAmRkFCsAAg8WAh4HVmlzaWJsZWhkZBQrAAJkZBQrAAIPFgIfAmhkZA8WB2ZmZmZmZmYWAQVvVGVsZXJpay5XZWIuVUkuUmFkVGFiLCBUZWxlcmlrLldlYi5VSSwgVmVyc2lvbj0yMDA4LjMuMTMxNC4zNSwgQ3VsdHVyZT1uZXV0cmFsLCBQdWJsaWNLZXlUb2tlbj0xMjFmYWU3ODE2NWJhM2Q0ZBYEAgQPDxYCHwJoZGQCBg8PFgIfAmhkZAIPD2QWBgIBDw8WAh8ABYEEPFAgc3R5bGU9Ik1BUkdJTjogMGluIDBpbiAwcHQiPjxGT05UIGZhY2U9QXJpYWw+PFNUUk9ORz48Rk9OVCBzdHlsZT0iRk9OVC1TSVpFOiAxNHB4IiBjb2xvcj0jZmY2NjY2PkFUVEVOVElPTiBBR0VOVFM6PC9GT05UPjwvU1RST05HPiZuYnNwOzxTVFJPTkc+IFdhbnQgdG8gcG9zdCB0byBUcmFuc0NvcmUgKERBVCksIEludGVybmV0IFRydWNrc3RvcCBhbmQgUG9zdCBFdmVyeXdoZXJlIHN0cmFpZ2h0IGZyb20gVElMVDwvU1RST05HPj8mbmJzcDs8QSBocmVmPSJodHRwOi8vd3d3LnRyYW5zcG9ydGludmVzdG1lbnRzLmNvbS9USUxUX0RPQ1MvQWdlbnRQb3N0aW5nSW5mb3JtYXRpb24ucGRmIiB0YXJnZXQ9X2JsYW5rPjxGT05UIGNvbG9yPSMzMzY2ZmY+PFU+PFNUUk9ORz5QbGVhc2UgY2xpY2sgaGVyZSBmb3IgaW5pdGlhbCBpbmZvcm1hdGlvbiEhPC9TVFJPTkc+PC9VPjwvRk9OVD48L0E+PEJSPjwvRk9OVD48L1A+PGJyIC8+PGJyIC8+PFAgYWxpZ249bGVmdD4mbmJzcDs8L1A+PGJyIC8+PGJyIC8+ZGQCBQ8WAh8CaGQCBw8WAh8CaGQCEQ8WAh8CaGQCEw8WAh8CaBYCAgMPPCsACQEADxYCHwJoZGQCFQ8WAh8CaGQCFw8WAh8CaGQCGQ9kFgICAQ88KwAJAQAPFgQeCERhdGFLZXlzFgAeC18hSXRlbUNvdW50ZmRkGAEFHl9fQ29udHJvbHNSZXF1aXJlUG9zdEJhY2tLZXlfXxYBBQdyYWRUYWJzSE+Pk9hvLYOZc32v2q4yyd9iLzk=" />
</div>

<script type="text/javascript">
//<![CDATA[
var theForm = document.forms['form2'];
if (!theForm) {
    theForm = document.form2;
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

<link class='Telerik_stylesheet' type='text/css' rel='stylesheet' href='/WebResource.axd?d=kjCuBYUaUasbxHnK_qEA7AH-seNl8jhyPHdzHB85YKZ4DfkeDN2G3Jv4HoMT5j8CeI7FYHiAk3sjLg29Ri_FkA2&amp;t=633674324160000000'></link><link class='Telerik_stylesheet' type='text/css' rel='stylesheet' href='/WebResource.axd?d=kjCuBYUaUasbxHnK_qEA7AH-seNl8jhyPHdzHB85YKbzweikXegmQIfHc8l4-lPnnWuxw10BQWw7mmg_OUy3dXRSPECGUBqNnOh-fp7c7-w1&amp;t=633674324160000000'></link>
<script src="/Telerik.Web.UI.WebResource.axd?_TSM_HiddenField_=RadScriptManager1_HiddenField&amp;compress=1&amp;_TSM_CombinedScripts_=%3b%3bSystem.Web.Extensions%2c+Version%3d3.5.0.0%2c+Culture%3dneutral%2c+PublicKeyToken%3d31bf3856ad364e35%3aen-US%3a0d787d5c-3903-4814-ad72-296cea810318%3aea597d4b%3ab25378d2%3bTelerik.Web.UI%2c+Version%3d2008.3.1314.35%2c+Culture%3dneutral%2c+PublicKeyToken%3d121fae78165ba3d4%3aen-US%3aef502ffb-86f7-4d96-ad3a-fbb934d602ab%3a16e4e7cd%3aed16cbdc%3ae330518b%3a1e771326%3a8e6f0d33" type="text/javascript"></script>
<div>

	<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="/wEWAgLfocHfCgKm4M2dCd76Q5GVcd1sC1QjIMaHawdO9Rbf" />
</div>
<script type="text/javascript">
//<![CDATA[
Sys.WebForms.PageRequestManager._initialize('RadScriptManager1', document.getElementById('form2'));
Sys.WebForms.PageRequestManager.getInstance()._updateControls(['tPanel1Panel','tRadAjaxManager1SU'], [], [], 90);
//]]>
</script>

        <!-- 2008.3.1314.35 --><div id="RadAjaxManager1SU">
	<span id="RadAjaxManager1" style="display:none;"></span>
</div>

    
    
 <table align="center" width="986" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td>
			<table width="100%" border="0">
				<tr>
					<td width="166"><img src="images/topLogo.jpg" alt="Transport Investments Logistics Tool" /></td>
					<td width="820" align="right"><p class="header"><span id="labelWelcomeMessage" style="display:inline-block;color:Black;font-size:X-Small;height:16px;">Welcome Jake Test</span><br />     
                                              
            <span id="labelDate" style="display:inline-block;color:Black;font-size:X-Small;height:16px;">Tuesday, September 28, 2010 </span><br />

                    
        <a id="btnLogout" href="javascript:__doPostBack('btnLogout','')" style="font-size:X-Small;">[ 
        Logout ]</a></p></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr><td width="100%" bgcolor="#FFFFFF" align="center">
	<div id="Panel1Panel">
	<div id="Panel1">

		
	    

        <div class="radTabContainer">
        
        <div id="radTabs" class="RadTabStrip RadTabStrip_WebBlue RadTabStripTop_WebBlue " style="width:700px;">
			<div class="rtsLevel rtsLevel1">
				<ul class="rtsUL"><li class="rtsLI rtsFirst"><a class="rtsLink rtsSelected" href="Default2.aspx"><span class="rtsOut"><span class="rtsIn"><span class="rtsTxt">Home</span></span></span></a></li><li class="rtsLI"><a class="rtsLink rtsAfter" href="#"><span class="rtsOut"><span class="rtsIn"><span class="rtsTxt">Load Board</span></span></span></a></li><li class="rtsLI"><a class="rtsLink" href="TruckBoard_All.aspx"><span class="rtsOut"><span class="rtsIn"><span class="rtsTxt">Truck Board</span></span></span></a></li><li class="rtsLI"><a class="rtsLink" href="Order.aspx"><span class="rtsOut"><span class="rtsIn"><span class="rtsTxt">Order Entry</span></span></span></a></li><li class="rtsLI rtsLast"><a class="rtsLink" href="ContactUs.aspx"><span class="rtsOut"><span class="rtsIn"><span class="rtsTxt">Contact Us</span></span></span></a></li></ul>
			</div><input id="radTabs_ClientState" name="radTabs_ClientState" type="hidden" />
		</div></div>

       
	</div>
</div>
       </td></tr>

</table>
 <table align="center" width="986" style="padding-left:10px;padding-right:10px;" cellspacing="0" border="0">

				<tr>
					<td>
					<div style="padding-left:10px;padding-right:10px;">
						<table class="bodyContainer" align="center" border="0" width="98%" >

							<tr><td width="100%">&nbsp;</td></tr>
							<tr><td width="100%"><h2>Welcome to Transport Investments Logistics Tool</h2><hr class="dashed" /></td></tr>
						</table></div>
					</td>
				</tr>

				<tr>
					<td>
						<table class="bodyContainer" align="left" border="0" width="98%" cellpadding="0" cellspacing="0">

							<tr>
								<td width="155" valign="top">
									<table border="0" width="155" align="left" cellpadding="0" cellspacing="0">
										<tr>
											<td width="155">
												<!--MAIN NAVAGATION STARTS HERE -->
											
		<div id="left-column">
			<a href="javascript:showHide('nav')"><h3>Conditions</h3></a>

			<div id="nav" style="display:none">
			<ul class="nav">
				<li><a href="http://www.weather.com" target="_blank">Weather</a></li>
				<li><a href="http://aa.usno.navy.mil/data/docs/RS_OneYear.php" target="_blank">Sun 
                    and Moon Rise and Set</a></li>				
				<li><a href="http://www.noaa.gov" target="_blank">National Oceanic and Atmospheric 
                    Administration</a></li>
				<li><a href="http://www.fhwa.dot.gov/trafficinfo" target="_blank">National Traffic 
                    and Road Closure Information</a></li>
				<li><a href="http://maps.google.com/" target="_blank">Google Maps</a></li>	
				<li><a href="http://www.tirechainsrequired.com/laws.html" target="_blank">Tire 
                    Chains</a></li>

				<li><a href="http://tonto.eia.doe.gov/oog/info/wohdp/diesel.asp" target="_blank">
                    Department of Energy Diesel Rates</a></li>	
				<li class="last"><a href="http://ezinearticles.com/?Truckers-And-Chain-Law!&id=826698" target="_blank">
                    Chain Law Information</a></li>				
			</ul>
			</div>
			<br />
			<a href="javascript:showHide('Div1')"><h3>Truck Stops</h3></a>

			<div id="Div1" style="display:none">
			<ul class="nav">
				<li><a href="http://www.am-best.com/fuel/retail_fuel.cfm" target="_blank">AMBEST - 
                    Americas Best Truck Stops</a></li>
				<li><a href="http://www.nttsbreakdown.com/ntts/programs/main/home.php" target="_blank">
                    National Truck &amp; Trailer Services (NTTS) Breakdown Directory </a></li>
				<li><a href="http://www.loves.com" target="_blank">Loves</a></li>

				<li><a href="http://www.petrotruckstops.com" target="_blank">Petro</a></li>
				<li><a href="http://www.pilotcorp.com" target="_blank">Pilot</a></li>
				<li><a href="http://www.flyingj.com/flyingjPortalWebProject/appmanager/flyingj/home" target="_blank">
                    Flying J</a></li>
				<li class="last"><a href="http://www.tatravelcenters.com" target="_blank">T/A Travel 
                    Centers of America</a></li>
			</ul>
			</div>

			<br />
			<a href="javascript:showHide('Div2')"><h3>State Websites</h3></a>
			<div id="Div2" style="display:none">
			<ul class="nav">
				<li><a href="http://www.dot.gov" target="_blank">U.S. DOT</a></li>
				<li><a href="http://www.dot.state.al.us/" target="_blank">Alabama</a></li>
				<li><a href="http://www.dot.state.ak.us/" target="_blank">Alaska</a></li>

				<li><a href="http://www.dot.state.az.us/" target="_blank">Arizona</a></li>
				<li><a href="http://www.ahtd.state.ar.us/" target="_blank">Arkansas</a></li>
				<li><a href="http://www.dot.ca.gov/" target="_blank">California</a></li>
				<li><a href="http://www.dot.state.co.us/" target="_blank">Colorado</a></li>
				<li><a href="http://www.state.ct.us/dot/" target="_blank">Connecticut</a></li>
				<li><a href="http://www.state.de.us/deldot/index.html" target="_blank">Delaware</a></li>

				<li><a href="http://www.dot.state.fl.us/" target="_blank">Florida</a></li>
				<li><a href="http://www.dot.state.ga.us/" target="_blank">Georgia</a></li>
				<li><a href="http://www.state.id.us/itd/itdhmpg.htm" target="_blank">Idaho</a></li>
				<li><a href="http://www.state.ia.us/government/dot/" target="_blank">Iowa</a></li>
				<li><a href="http://dot.state.il.us/" target="_blank">Illinois</a></li>
				<li><a href="http://www.ai.org/dot/" target="_blank">Indiana</a></li>

				<li><a href="http://www.ink.org/public/kdot/" target="_blank">Kansas</a></li>
				<li><a href="http://www.kytc.state.ky.us/" target="_blank">Kentucky</a></li>
				<li><a href="http://www.dotd.state.la.us/" target="_blank">Louisana</a></li>
				<li><a href="http://www.state.me.us/mdot/" target="_blank">Maine</a></li>
				<li><a href="http://www.mdot.state.md.us/" target="_blank">Maryland</a></li>				
				<li><a href="http://www.magnet.state.ma.us/mhd/home.htm" target="_blank">
                    Massachusetts</a></li>

				<li><a href="http://www.mdot.state.mi.us/" target="_blank">Michigan</a></li>
				<li><a href="http://www.dot.state.mn.us/" target="_blank">Minnesota</a></li>
				<li><a href="http://www.mdot.state.ms.us/" target="_blank">Mississippi</a></li>
				<li><a href="http://www.modot.state.mo.us/" target="_blank">Missouri</a></li>
				<li><a href="http://www.mdt.state.mt.us/" target="_blank">Montana</a></li>
				<li><a href="http://www.dor.state.ne.us/" target="_blank">Nebraska</a></li>

				<li><a href="http://www.nevadadot.com/" target="_blank">Nevada</a></li>
				<li><a href="http://www.state.nh.us/dot/" target="_blank">New Hampshire</a></li>
				<li><a href="http://www.state.nj.us/" target="_blank">New Jersey</a></li>
				<li><a href="http://www.dot.state.ny.us/" target="_blank">New York</a></li>
				<li><a href="http://www.nmshtd.state.nm.us/" target="_blank">New Mexico</a></li>
				<li><a href="http://www.dot.state.nc.us/" target="_blank">North Carolina</a></li>

				<li><a href="http://www.state.nd.us/dot/" target="_blank">North Dakota</a></li>
				<li><a href="http://www.dot.state.oh.us/" target="_blank">Ohio</a></li>
				<li><a href="http://www.okladot.state.ok.us/" target="_blank">Oklahoma</a></li>
				<li><a href="http://www.odot.state.or.us/" target="_blank">Oregon</a></li>
				<li><a href="http://www.dot.state.pa.us/" target="_blank">Pennsylvania</a></li>
				<li><a href="http://www.dot.state.ri.us/" target="_blank">Rhode Island</a></li>

				<li><a href="http://www.dot.state.sc.us/" target="_blank">South Carolina</a></li>
				<li><a href="http://www.sddot.com/" target="_blank">South Dakota</a></li>
				<li><a href="http://www.state.tn.us/transport/" target="_blank">Tennessee</a></li>
				<li><a href="http://www.dot.state.tx.us/" target="_blank">Texas</a></li>
				<li><a href="http://www.sr.ex.state.ut.us/" target="_blank">Utah</a></li>
				<li><a href="http://www.aot.state.vt.us/" target="_blank">Vermont</a></li>

				<li><a href="http://www.vdot.state.va.us/" target="_blank">Virginia</a></li>
				<li><a href="http://198.238.212.10/" target="_blank">Washington</a></li>
				<li><a href="http://www.wvdot.com/" target="_blank">West Virginia</a></li>
				<li><a href="http://www.dot.state.wi.us/" target="_blank">Wisconsin</a></li>
				<li class="last"><a href="http://wydotweb.state.wy.us/" target="_blank">Wyoming</a></li>
			</ul>

			</div>
			<br />
			<a href="javascript:showHide('Div3')"><h3>Associations</h3></a>
			<div id="Div3" style="display:none">
			<ul class="nav">
				<li><a href="http://www.ooida.com/" target="_blank">O.O.I.D.A</a></li>
				<li><a href="https://www.efsts.com/FuelStar/acctonline.htm" target="_blank">EFS 
                    Online</a></li>

				<li><a href="http://www.comdata.com/comdata/index.jsp" target="_blank">Comdata</a></li>
				<li><a href="http://www.cvsa.org" target="_blank">Commercial Vehicle Safety Alliance</a></li>
				<li><a href="http://www.tsa.gov/twic" target="_blank">TSA - Transportation Worker 
                    Indentification Credential</a></li>
				<li class="last"><a href="http://www.sharetheroadsafely.org" target="_blank">Share 
                    the Road Safely Program</a></li>			
			</ul>
			</div>
			<br />

			<a href="javascript:showHide('Div4')"><h3>Newsletters</h3></a>
			<div id="Div4" style="display:none">
			<ul class="nav">
				<li><a href="http://www.transportinvestments.com/docs/Newsletter-ATI.pdf" target="_blank">
                    American Pride Newsletter</a></li>
				<li><a href="http://www.transportinvestments.com/docs/Newsletter-AetnaWeb.pdf" target="_blank">
                    The Peak Newsletter</a></li>

				<li><a href="http://www.transportinvestments.com/docs/Newsletter-GreentreeWeb.pdf" target="_blank">
                    On the Road Newsletter</a></li>				
			</ul>
			</div>
			<br /></div>
			
			
												
											</td>
										</tr>
										<tr><td>&nbsp;</td></tr>
										<tr><td><!--ADVERT STARTS HERE -->

										<div style="padding-left:10px;">
										<div id="dropcontentsubject"></div>

<div id="dropmsg0" class="dropcontent" subject="Fuel Discounts">
<a href="http://www.transportinvestments.com/fueldiscounts.php" target="_blank"><img src="Images/gas.gif" /></a>

</div>

<div id="dropmsg1" class="dropcontent" subject="Hotel Discounts">
<a href="http://www.transportinvestments.com/fueldiscounts.php" target="_blank"><img src="Images/hotels.gif" /></a>
</div>

<div id="dropmsg2" class="dropcontent" subject="Tire Discounts">
<a href="http://www.transportinvestments.com/fueldiscounts.php" target="_blank"><img src="Images/tires.gif" /></a>
</div>

										
							</div>			
										</td></tr>
									</table>
								</td>

								<td width="550" valign="top">
								<!-- MAIN CONTENT AREA -->
								<div id="panel2">
		
									<table width="550" border="0" align="left" cellpadding="0" cellspacing="0">

										<tr>
											<td>
												<!-- START TOP MIDDLE SECTION -->
												<p class="main">
                                                    TILT is a web-based unified service portal offering an innovative approach to 
                                                    transform
                                                    
                                                    freight shipping by leveraging technology to provide real-time, 
                                                    easily-accessible and flexible information.
                                               
                                                    </p>
                                                    <span id="lblPost" class="main"><P style="MARGIN: 0in 0in 0pt"><FONT face=Arial><STRONG><FONT style="FONT-SIZE: 14px" color=#ff6666>ATTENTION AGENTS:</FONT></STRONG>&nbsp;<STRONG> Want to post to TransCore (DAT), Internet Truckstop and Post Everywhere straight from TILT</STRONG>?&nbsp;<A href="http://www.transportinvestments.com/TILT_DOCS/AgentPostingInformation.pdf" target=_blank><FONT color=#3366ff><U><STRONG>Please click here for initial information!!</STRONG></U></FONT></A><BR></FONT></P><br /><br /><P align=left>&nbsp;</P><br /><br /></span>

                                                    		  
                                                <!-- END TOP MIDDLE SECTION -->
											</td>
										</tr>
										<tr><td><hr class="dashed"></td></tr>
										<tr>
											<td>
												<table>
													<tr>
														<td valign="top">

															<h4>Getting Started</h4>
												            <ul>
                                                                <li><a href="LoadBoard_Search.aspx">Load Board</a></li>
                                                                
                                                                <li><a href="ContactUs.aspx">Contact Us</a></li>
                                                                
                                                                <li><a href="javascript:popWin1('WhereAreMyTrucks.aspx','win', '550','700','1')">Where Is/Are My Truck(s)...</a><img src="Images/new.gif" alt="NEW" /></li>
                                                                <li><a href="javascript:popWin2('MileageInquiry_new.aspx','win', '800','700','1')">Mileage Inquiry</a><img src="Images/new.gif" alt="NEW" /></li>

                                                            </ul>
														</td>
														<td valign="top">
															<h4>Things You Can Do</h4>
															<ul>
															<li>Generate a Settlement Sheet Report</li>
                                                            <li>Find loads closest to you or in other areas</li>

                                                            <li>Generate Reports for driver detail</li>
                                                            <li>Contact company departments</li>
                                                            </ul>
														</td>
													</tr>
													<tr>
														<td valign="top">
															<h4>Miscellaneous</h4>

															<ul>
															<li>Critical Expiration dates</li>
															<li>Links to transportation websites</li>
															</ul>
														</td>
														<td>
														</td>
													</tr>

												</table>
											</td>
										</tr>
									</table>
</div>
									<!-- END MAIN CONTENT AREA -->
								</td>

								<td width="150" valign="top">
									<!--RIGHT COLUMN STARTS HERE-->

									<table width="150"  border="0" align="left" cellpadding="2" cellspacing="2" class="data">
										<tr>
										<th class="regular" colspan="4">
										</th>
										</tr>
										<tr>
										<td>
										
										</td>
										</tr>

										<tr>
										<td>
												
		</td>
		</tr>
		<tr>
			<td>
	        <table width="100%"  border="0" align="left" cellpadding="2" cellspacing="2" class="data">
		    <tr><th class="regular" colspan="4"></th></tr>
			<tr><td>

			 <div id="Fleet">
	         
	        </div>
			</td>
			</tr>
			</table>
           </td>
       </tr>
</table>
				        
									<!--RIGHT COLUMN ENDS HERE-->

								</td>



							</tr>
						</table>
					</td>
				</tr>



			</table>


        <div id="RadAjaxLoadingPanel1" style="display:none;height:75px;width:75px;">
	
     <table style="width:500px;height:500px;" align="center">
        <tr style="height:100%"><td align="center" valign="middle" style="width:100%"> 
            <div style="background-color:White; width:600px; height:300px; border-style:none; border-color:blue; border-width:1px">
             <br />
            <font color="navy" size="4pt" style="font-weight:bold">Loading ...</font>
              <br />  <img src="Images/loader.gif" style="margin-top:10px;" alt="&nbsp;" /><br />

              </div>
        </td>
        </tr>
        </table>
    
</div> 


<script type="text/javascript">
//<![CDATA[
Sys.Application.initialize();
Sys.Application.add_init(function() {
    $create(Telerik.Web.UI.RadAjaxManager, {"_updatePanels":"","ajaxSettings":[{InitControlID : "Panel1",UpdatedControls : [{ControlID:"Panel1",PanelID:"RadAjaxLoadingPanel1"}]}],"clientEvents":{OnRequestStart:"",OnResponseEnd:""},"defaultLoadingPanelID":"","enableAJAX":true,"enableHistory":false,"links":[],"styles":[],"uniqueID":"RadAjaxManager1","updatePanelsRenderMode":0}, null, null, $get("RadAjaxManager1"));
});
Sys.Application.add_init(function() {
    $create(Telerik.Web.UI.RadTabStrip, {"_postBackReference":"__doPostBack(\u0027radTabs\u0027,\u0027{0}\u0027)","_selectedIndex":0,"_skin":"WebBlue","clientStateFieldID":"radTabs_ClientState","selectedIndexes":["0"],"tabData":[{},{},{},{},{}]}, null, null, $get("radTabs"));
});
Sys.Application.add_init(function() {
    $create(Telerik.Web.UI.RadAjaxLoadingPanel, {"initialDelayTime":0,"isSticky":false,"minDisplayTime":20,"transparency":0,"uniqueID":"RadAjaxLoadingPanel1","zIndex":90000}, null, null, $get("RadAjaxLoadingPanel1"));
});
//]]>
</script>
</form>
</body>
</html>