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
<form name="aspnetForm" method="post" action="Order.aspx" id="aspnetForm">
<div>
<input type="hidden" name="__LASTFOCUS" id="__LASTFOCUS" value="" />
<input type="hidden" name="ctl00_RadScriptManager1_HiddenField" id="ctl00_RadScriptManager1_HiddenField" value="" />
<input type="hidden" name="__EVENTTARGET" id="__EVENTTARGET" value="" />
<input type="hidden" name="__EVENTARGUMENT" id="__EVENTARGUMENT" value="" />
<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="/wEPDwUKLTIzNTY0NTM5NA8WDB4GdXNlcklEAoINHgpvcmRfbnVtYmVyZB4Nb3JkX2hkcm51bWJlcmQeB0FjY0RhdGFkHgpSZWZlcmVuY2VzMp0MAAEAAAD/////AQAAAAAAAAAMAgAAAE5TeXN0ZW0uRGF0YSwgVmVyc2lvbj0yLjAuMC4wLCBDdWx0dXJlPW5ldXRyYWwsIFB1YmxpY0tleVRva2VuPWI3N2E1YzU2MTkzNGUwODkFAQAAABVTeXN0ZW0uRGF0YS5EYXRhVGFibGUDAAAAGURhdGFUYWJsZS5SZW1vdGluZ1ZlcnNpb24JWG1sU2NoZW1hC1htbERpZmZHcmFtAwEBDlN5c3RlbS5WZXJzaW9uAgAAAAkDAAAABgQAAADwCDw/eG1sIHZlcnNpb249IjEuMCIgZW5jb2Rpbmc9InV0Zi0xNiI/Pg0KPHhzOnNjaGVtYSB4bWxucz0iIiB4bWxuczp4cz0iaHR0cDovL3d3dy53My5vcmcvMjAwMS9YTUxTY2hlbWEiIHhtbG5zOm1zZGF0YT0idXJuOnNjaGVtYXMtbWljcm9zb2Z0LWNvbTp4bWwtbXNkYXRhIj4NCiAgPHhzOmVsZW1lbnQgbmFtZT0iVGFibGUxIj4NCiAgICA8eHM6Y29tcGxleFR5cGU+DQogICAgICA8eHM6c2VxdWVuY2U+DQogICAgICAgIDx4czplbGVtZW50IG5hbWU9InJlZlNlcXVlbmNlIiB0eXBlPSJ4czppbnQiIG1zZGF0YTp0YXJnZXROYW1lc3BhY2U9IiIgbWluT2NjdXJzPSIwIiAvPg0KICAgICAgICA8eHM6ZWxlbWVudCBuYW1lPSJyZWZUeXBlIiB0eXBlPSJ4czpzdHJpbmciIG1zZGF0YTp0YXJnZXROYW1lc3BhY2U9IiIgbWluT2NjdXJzPSIwIiAvPg0KICAgICAgICA8eHM6ZWxlbWVudCBuYW1lPSJyZWZUeXBlQ29kZSIgdHlwZT0ieHM6c3RyaW5nIiBtc2RhdGE6dGFyZ2V0TmFtZXNwYWNlPSIiIG1pbk9jY3Vycz0iMCIgLz4NCiAgICAgICAgPHhzOmVsZW1lbnQgbmFtZT0icmVmTnVtYmVyIiB0eXBlPSJ4czpzdHJpbmciIG1zZGF0YTp0YXJnZXROYW1lc3BhY2U9IiIgbWluT2NjdXJzPSIwIiAvPg0KICAgICAgICA8eHM6ZWxlbWVudCBuYW1lPSJvcmRfaGRybnVtYmVyIiB0eXBlPSJ4czppbnQiIG1zZGF0YTp0YXJnZXROYW1lc3BhY2U9IiIgbWluT2NjdXJzPSIwIiAvPg0KICAgICAgICA8eHM6ZWxlbWVudCBuYW1lPSJsYXN0X3VwZGF0ZWJ5IiB0eXBlPSJ4czpzdHJpbmciIG1zZGF0YTp0YXJnZXROYW1lc3BhY2U9IiIgbWluT2NjdXJzPSIwIiAvPg0KICAgICAgPC94czpzZXF1ZW5jZT4NCiAgICA8L3hzOmNvbXBsZXhUeXBlPg0KICA8L3hzOmVsZW1lbnQ+DQogIDx4czplbGVtZW50IG5hbWU9InRtcERhdGFTZXQiIG1zZGF0YTpJc0RhdGFTZXQ9InRydWUiIG1zZGF0YTpNYWluRGF0YVRhYmxlPSJUYWJsZTEiIG1zZGF0YTpVc2VDdXJyZW50TG9jYWxlPSJ0cnVlIj4NCiAgICA8eHM6Y29tcGxleFR5cGU+DQogICAgICA8eHM6Y2hvaWNlIG1pbk9jY3Vycz0iMCIgbWF4T2NjdXJzPSJ1bmJvdW5kZWQiIC8+DQogICAgPC94czpjb21wbGV4VHlwZT4NCiAgPC94czplbGVtZW50Pg0KPC94czpzY2hlbWE+BgUAAACAATxkaWZmZ3I6ZGlmZmdyYW0geG1sbnM6bXNkYXRhPSJ1cm46c2NoZW1hcy1taWNyb3NvZnQtY29tOnhtbC1tc2RhdGEiIHhtbG5zOmRpZmZncj0idXJuOnNjaGVtYXMtbWljcm9zb2Z0LWNvbTp4bWwtZGlmZmdyYW0tdjEiIC8+BAMAAAAOU3lzdGVtLlZlcnNpb24EAAAABl9NYWpvcgZfTWlub3IGX0J1aWxkCV9SZXZpc2lvbgAAAAAICAgIAgAAAAAAAAD//////////wseBVN0b3BzZBYCZg9kFgICAw9kFgoCBQ8PFgIeBFRleHQFEVdlbGNvbWUgSmFrZSBUZXN0ZGQCBw8PFgIfBgUeV2VkbmVzZGF5LCBTZXB0ZW1iZXIgMjksIDIwMTAgZGQCCw8UKwACFCsAAg8WBB4NU2VsZWN0ZWRJbmRleAIDHhdFbmFibGVBamF4U2tpblJlbmRlcmlu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ZXh0Qm94IHJpRW1wdHkfDwKCAhYGHw0bAAAAAAAAWUAHAAAAHw4FEHJpVGV4dEJveCByaVJlYWQfDwKCAmQCAg8UKwANDxYKBQtTcGVjaWFsRGF5cw8FkwFUZWxlcmlrLldlYi5VSS5DYWxlbmRhci5Db2xsZWN0aW9ucy5DYWxlbmRhckRheUNvbGxlY3Rpb24sIFRlbGVyaWsuV2ViLlVJLCBWZXJzaW9uPTIwMDguMy4xMzE0LjM1LCBDdWx0dXJlPW5ldXRyYWwsIFB1YmxpY0tleVRva2VuPTEyMWZhZTc4MTY1YmEzZDQUKwAABQ9SZW5kZXJJbnZpc2libGVnBQNFUlNoBRFFbmFibGVNdWx0aVNlbGVjdGgFDVNlbGVjdGVkRGF0ZXMPBZABVGVsZXJpay5XZWIuVUkuQ2FsZW5kYXIuQ29sbGVjdGlvbnMuRGF0ZVRpbWVDb2xsZWN0aW9uLCBUZWxlcmlrLldlYi5VSSwgVmVyc2lvbj0yMDA4LjMuMTMxNC4zNSwgQ3VsdHVyZT1uZXV0cmFsLCBQdWJsaWNLZXlUb2tlbj0xMjFmYWU3ODE2NWJhM2Q0FCsAAA8WBB8XBQRHcmF5HwhoZGQWBB8OBQtyY01haW5UYWJsZR8PAgIWBB8OBQxyY090aGVyTW9udGgfDwICZBYEHw4FCnJjU2VsZWN0ZWQfDwICZBYEHw4FCnJjRGlzYWJsZWQfDwICFgQfDgUMcmNPdXRPZlJhbmdlHw8CAhYEHw4FCXJjV2Vla2VuZB8PAgIWBB8OBQdyY0hvdmVyHw8CAhYEHw4FGVJhZENhbGVuZGFyTW9udGhWaWV3X0dyYXkfDwICFgQfDgUJcmNWaWV3U2VsHw8CAmQCBA8UKwACDxYEHxcFBEdyYXkfCGhkFgQfDgUHcmNIb3Zlch8PAgIWAmYPFCsACQ8WBB4IRGF0YUtleXMWAB4LXyFJdGVtQ291bnQCGGQWBB8OZR8PAgJkFgQfDmUfDwICZGQWBB8OBQhyY0hlYWRlch8PAgIWBB8OBQhyY0Zvb3Rlch8PAgIWBB8OBRhSYWRDYWxlbmRhclRpbWVWaWV3X0dyYXkfDwICFjACAQ9kFgJmDxYCHglpbm5lcmh0bWwFBTAwOjAwZAICD2QWAmYPFgIfGwUFMDE6MDBkAgMPZBYCZg8WAh8bBQUwMjowMGQCBA9kFgJmDxYCHxsFBTAzOjAwZAIFD2QWAmYPFgIfGwUFMDQ6MDBkAgYPZBYCZg8WAh8bBQUwNTowMGQCBw9kFgJmDxYCHxsFBTA2OjAwZAIID2QWAmYPFgIfGwUFMDc6MDBkAgkPZBYCZg8WAh8bBQUwODowMGQCCg9kFgJmDxYCHxsFBTA5OjAwZAILD2QWAmYPFgIfGwUFMTA6MDBkAgwPZBYCZg8WAh8bBQUxMTowMGQCDQ9kFgJmDxYCHxsFBTEyOjAwZAIOD2QWAmYPFgIfGwUFMTM6MDBkAg8PZBYCZg8WAh8bBQUxNDowMGQCEA9kFgJmDxYCHxsFBTE1OjAwZAIRD2QWAmYPFgIfGwUFMTY6MDBkAhIPZBYCZg8WAh8bBQUxNzowMGQCEw9kFgJmDxYCHxsFBTE4OjAwZAIUD2QWAmYPFgIfGwUFMTk6MDBkAhUPZBYCZg8WAh8bBQUyMDowMGQCFg9kFgJmDxYCHxsFBTIxOjAwZAIXD2QWAmYPFgIfGwUFMjI6MDBkAhgPZBYCZg8WAh8bBQUyMzowMGQCLw8PFgIfFgYA2Cx0kC/NiGQWBmYPFCsACA8WCh8GBRMyMDEwLTEwLTAxLTA4LTAwLTAwHxcFBEdyYXkfGAUUMTAvMS8yMDEwIDg6MDA6MDAgQU0fCGgfCwUHcmlMYWJlbGQWBh8NGwAAAAAAAFlABwAAAB8OBRFyaVRleHRCb3ggcmlIb3Zlch8PAoICFgYfDRsAAAAAAABZQAcAAAAfDgURcmlUZXh0Qm94IHJpRXJyb3IfDwKCAhYGHw0bAAAAAAAAWUAHAAAAHw4FE3JpVGV4dEJveCByaUZvY3VzZWQfDwKCAhYGHw0bAAAAAAAAWUAHAAAAHw4FE3JpVGV4dEJveCByaUVuYWJsZWQfDwKCAhYGHw0bAAAAAAAAWUAHAAAAHw4FFHJpVGV4dEJveCByaURpc2FibGVkHw8CggIWBh8NGwAAAAAAAFlABwAAAB8OBRFyaVRleHRCb3ggcmlFbXB0eR8PAoICFgYfDRsAAAAAAABZQAcAAAAfDgUQcmlUZXh0Qm94IHJpUmVhZB8PAoICZAICDxQrAA0PFgoFC1NwZWNpYWxEYXlzDwWTAVRlbGVyaWsuV2ViLlVJLkNhbGVuZGFyLkNvbGxlY3Rpb25zLkNhbGVuZGFyRGF5Q29sbGVjdGlvbiwgVGVsZXJpay5XZWIuVUksIFZlcnNpb249MjAwOC4zLjEzMTQuMzUsIEN1bHR1cmU9bmV1dHJhbCwgUHVibGljS2V5VG9rZW49MTIxZmFlNzgxNjViYTNkNBQrAAAFD1JlbmRlckludmlzaWJsZWcFA0VSU2gFEUVuYWJsZU11bHRpU2VsZWN0aAUNU2VsZWN0ZWREYXRlcw8FkAFUZWxlcmlrLldlYi5VSS5DYWxlbmRhci5Db2xsZWN0aW9ucy5EYXRlVGltZUNvbGxlY3Rpb24sIFRlbGVyaWsuV2ViLlVJLCBWZXJzaW9uPTIwMDguMy4xMzE0LjM1LCBDdWx0dXJlPW5ldXRyYWwsIFB1YmxpY0tleVRva2VuPTEyMWZhZTc4MTY1YmEzZDQUKwAADxYEHxcFBEdyYXkfCGhkZBYEHw4FC3JjTWFpblRhYmxlHw8CAhYEHw4FDHJjT3RoZXJNb250aB8PAgJkFgQfDgUKcmNTZWxlY3RlZB8PAgJkFgQfDgUKcmNEaXNhYmxlZB8PAgIWBB8OBQxyY091dE9mUmFuZ2UfDwICFgQfDgUJcmNXZWVrZW5kHw8CAhYEHw4FB3JjSG92ZXIfDwICFgQfDgUZUmFkQ2FsZW5kYXJNb250aFZpZXdfR3JheR8PAgIWBB8OBQlyY1ZpZXdTZWwfDwICZAIEDxQrAAIPFgQfFwUER3JheR8IaGQWBB8OBQdyY0hvdmVyHw8CAhYCZg8UKwAJDxYEHxkWAB8aAhhkFgQfDmUfDwICZBYEHw5lHw8CAmRkFgQfDgUIcmNIZWFkZXIfDwICFgQfDgUIcmNGb290ZXIfDwICFgQfDgUYUmFkQ2FsZW5kYXJUaW1lVmlld19HcmF5Hw8CAhYwAgEPZBYCZg8WAh8bBQUwMDowMGQCAg9kFgJmDxYCHxsFBTAxOjAwZAIDD2QWAmYPFgIfGwUFMDI6MDBkAgQPZBYCZg8WAh8bBQUwMzowMGQCBQ9kFgJmDxYCHxsFBTA0OjAwZAIGD2QWAmYPFgIfGwUFMDU6MDBkAgcPZBYCZg8WAh8bBQUwNjowMGQCCA9kFgJmDxYCHxsFBTA3OjAwZAIJD2QWAmYPFgIfGwUFMDg6MDBkAgoPZBYCZg8WAh8bBQUwOTowMGQCCw9kFgJmDxYCHxsFBTEwOjAwZAIMD2QWAmYPFgIfGwUFMTE6MDBkAg0PZBYCZg8WAh8bBQUxMjowMGQCDg9kFgJmDxYCHxsFBTEzOjAwZAIPD2QWAmYPFgIfGwUFMTQ6MDBkAhAPZBYCZg8WAh8bBQUxNTowMGQCEQ9kFgJmDxYCHxsFBTE2OjAwZAISD2QWAmYPFgIfGwUFMTc6MDBkAhMPZBYCZg8WAh8bBQUxODowMGQCFA9kFgJmDxYCHxsFBTE5OjAwZAIVD2QWAmYPFgIfGwUFMjA6MDBkAhYPZBYCZg8WAh8bBQUyMTowMGQCFw9kFgJmDxYCHxsFBTIyOjAwZAIYD2QWAmYPFgIfGwUFMjM6MDBkAjcPFCsAAmRkZAI5DxQrAAIPFgIfCGhkZBYEZg8PFgQfDgUJcmNiSGVhZGVyHw8CAmRkAgEPDxYEHw4FCXJjYkZvb3Rlch8PAgJkZAI9DxQrAAIPFgIfCGhkZBYEZg8PFgQfDgUJcmNiSGVhZGVyHw8CAmRkAgEPDxYEHw4FCXJjYkZvb3Rlch8PAgJkZAJBDw8WAh8GBQItMWRkAkUPFCsAAhQrAAgPFggfBgUBMB8IaB8LBQdyaUxhYmVsHxgHAAAAAAAAAABkFgYfDRsAAAAAAABJQAEAAAAfDgURcmlUZXh0Qm94IHJpSG92ZXIfDwKCAhYGHw0bAAAAAAAASUABAAAAHw4FEXJpVGV4dEJveCByaUVycm9yHw8CggIWBh8NGwAAAAAAAElAAQAAAB8OBRNyaVRleHRCb3ggcmlGb2N1c2VkHw8CggIWBh8NGwAAAAAAAElAAQAAAB8OBRNyaVRleHRCb3ggcmlFbmFibGVkHw8CggIWBh8NGwAAAAAAAElAAQAAAB8OBRRyaVRleHRCb3ggcmlEaXNhYmxlZB8PAoICFgYfDRsAAAAAAABJQAEAAAAfDgURcmlUZXh0Qm94IHJpRW1wdHkfDwKCAhYGHw0bAAAAAAAASUABAAAAHw4FEHJpVGV4dEJveCByaVJlYWQfDwKCAhYGHw0bAAAAAAAASUABAAAAHw4FFHJpVGV4dEJveCByaU5lZ2F0aXZlHw8CggJkAkcPFCsAAg8WBh8GBQNGTFQfCGgeE2NhY2hlZFNlbGVjdGVkVmFsdWVkZBAWBmYCAQICAgMCBAIFFgYUKwACDxYGHwYFA0NXVB8QBRRDV1QtJC8xMDAgbGJzfFJhdGVCeR4IU2VsZWN0ZWRoFgIfEQUNQ1dULSQvMTAwIGxic2QUKwACDxYGHwYFA0ZMVB8QBQ9GTFQtRmxhdHxSYXRlQnkfHWcWAh8RBQhGTFQtRmxhdGQUKwACDxYGHwYFAkhSHxAFEEhSLSQvSG91cnxSYXRlQnkfHWgWAh8RBQlIUi0kL0hvdXJkFCsAAg8WBh8GBQNMQlMfEAUSTEJTLSQvUG91bmR8UmF0ZUJ5Hx1oFgIfEQULTEJTLSQvUG91bmRkFCsAAg8WBh8GBQNNSUwfEAURTUlMLSQvTWlsZXxSYXRlQnkfHWgWAh8RBQpNSUwtJC9NaWxlZBQrAAIPFgYfBgUDUENTHxAFElBDUy0kL1BpZWNlfFJhdGVCeR8daBYCHxEFC1BDUy0kL1BpZWNlZA8WBmZmZmZmZhYBBXhUZWxlcmlrLldlYi5VSS5SYWRDb21ib0JveEl0ZW0sIFRlbGVyaWsuV2ViLlVJLCBWZXJzaW9uPTIwMDguMy4xMzE0LjM1LCBDdWx0dXJlPW5ldXRyYWwsIFB1YmxpY0tleVRva2VuPTEyMWZhZTc4MTY1YmEzZDQWEGYPDxYEHw4FCXJjYkhlYWRlch8PAgJkZAIBDw8WBB8OBQlyY2JGb290ZXIfDwICZGQCAg8PFgYfBgUDQ1dUHxAFFENXVC0kLzEwMCBsYnN8UmF0ZUJ5Hx1oFgIfEQUNQ1dULSQvMTAwIGxicxYCZg8VAgNDV1QNQ1dULSQvMTAwIGxic2QCAw8PFgYfBgUDRkxUHxAFD0ZMVC1GbGF0fFJhdGVCeR8dZxYCHxEFCEZMVC1GbGF0FgJmDxUCA0ZMVAhGTFQtRmxhdGQCBA8PFgYfBgUCSFIfEAUQSFItJC9Ib3VyfFJhdGVCeR8daBYCHxEFCUhSLSQvSG91chYCZg8VAgJIUglIUi0kL0hvdXJkAgUPDxYGHwYFA0xCUx8QBRJMQlMtJC9Qb3VuZHxSYXRlQnkfHWgWAh8RBQtMQlMtJC9Qb3VuZBYCZg8VAgNMQlMLTEJTLSQvUG91bmRkAgYPDxYGHwYFA01JTB8QBRFNSUwtJC9NaWxlfFJhdGVCeR8daBYCHxEFCk1JTC0kL01pbGUWAmYPFQIDTUlMCk1JTC0kL01pbGVkAgcPDxYGHwYFA1BDUx8QBRJQQ1MtJC9QaWVjZXxSYXRlQnkfHWgWAh8RBQtQQ1MtJC9QaWVjZRYCZg8VAgNQQ1MLUENTLSQvUGllY2VkAkkPFCsAAg8WCB8IaB4aU2hvd0Ryb3BEb3duT25UZXh0Ym94Q2xpY2tnHwYFDkZSRUlHSFQgKEZMQVQpHxxkZBAWBWYCAQICAgMCBBYFFCsAAg8WBh8GBQ9GUkVJR0hUIChDT1VOVCkfEAURJC9QaWVjZXxQQ1N8MHxMSEMfHWgWBh4EQ29kZQUDTEhDHgRVbml0BQckL1BpZWNlHghRdWFudGl0eQUBMGQUKwACDxYGHwYFEkZSRUlHSFQgKERJU1RBTkNFKR8QBRAkL01pbGV8TUlMfDB8TEhEHx1oFgYfHwUDTEhEHyAFBiQvTWlsZR8hBQEwZBQrAAIPFgYfBgUORlJFSUdIVCAoRkxBVCkfEAUORmxhdHxGTFR8MXxMSEYfHWcWBh8fBQNMSEYfIAUERmxhdB8hBQExZBQrAAIPFgYfBgUORlJFSUdIVCAoVElNRSkfEAUPJC9Ib3VyfEhSfDB8TEhUHx1oFgYfHwUDTEhUHyAFBiQvSG91ch8hBQEwZBQrAAIPFgYfBgUQRlJFSUdIVCAoV0VJR0hUKR8QBRMkLzEwMCBsYnN8Q1dUfDB8TEhXHx1oFgYfHwUDTEhXHyAFCSQvMTAwIGxicx8hBQEwZA8WBWZmZmZmFgEFeFRlbGVyaWsuV2ViLlVJLlJhZENvbWJvQm94SXRlbSwgVGVsZXJpay5XZWIuVUksIFZlcnNpb249MjAwOC4zLjEzMTQuMzUsIEN1bHR1cmU9bmV1dHJhbCwgUHVibGljS2V5VG9rZW49MTIxZmFlNzgxNjViYTNkNBYOZg8PFgQfDgUJcmNiSGVhZGVyHw8CAmRkAgEPDxYEHw4FCXJjYkZvb3Rlch8PAgJkZAICDw8WBh8GBQ9GUkVJR0hUIChDT1VOVCkfEAURJC9QaWVjZXxQQ1N8MHxMSEMfHWgWBh8fBQNMSEMfIAUHJC9QaWVjZR8hBQEwFgJmDxUED0ZSRUlHSFQgKENPVU5UKQNMSEMHJC9QaWVjZQEwZAIDDw8WBh8GBRJGUkVJR0hUIChESVNUQU5DRSkfEAUQJC9NaWxlfE1JTHwwfExIRB8daBYGHx8FA0xIRB8gBQYkL01pbGUfIQUBMBYCZg8VBBJGUkVJR0hUIChESVNUQU5DRSkDTEhEBiQvTWlsZQEwZAIEDw8WBh8GBQ5GUkVJR0hUIChGTEFUKR8QBQ5GbGF0fEZMVHwxfExIRh8dZxYGHx8FA0xIRh8gBQRGbGF0HyEFATEWAmYPFQQORlJFSUdIVCAoRkxBVCkDTEhGBEZsYXQBMWQCBQ8PFgYfBgUORlJFSUdIVCAoVElNRSkfEAUPJC9Ib3VyfEhSfDB8TEhUHx1oFgYfHwUDTEhUHyAFBiQvSG91ch8hBQEwFgJmDxUEDkZSRUlHSFQgKFRJTUUpA0xIVAYkL0hvdXIBMGQCBg8PFgYfBgUQRlJFSUdIVCAoV0VJR0hUKR8QBRMkLzEwMCBsYnN8Q1dUfDB8TEhXHx1oFgYfHwUDTEhXHyAFCSQvMTAwIGxicx8hBQEwFgJmDxUEEEZSRUlHSFQgKFdFSUdIVCkDTEhXCSQvMTAwIGxicwEwZAJLDxQrAAIUKwAIDxYIHwYFATEfCwUHcmlMYWJlbB8IaB8YBwAAAAAAAPA/ZBYGHw0bAAAAAAAASUABAAAAHw4FEXJpVGV4dEJveCByaUhvdmVyHw8CggIWBh8NGwAAAAAAAElAAQAAAB8OBRFyaVRleHRCb3ggcmlFcnJvch8PAoICFgYfDRsAAAAAAABJQAEAAAAfDgUTcmlUZXh0Qm94IHJpRm9jdXNlZB8PAoICFgYfDRsAAAAAAABJQAEAAAAfDgUTcmlUZXh0Qm94IHJpRW5hYmxlZB8PAoICFgYfDRsAAAAAAABJQAEAAAAfDgUUcmlUZXh0Qm94IHJpRGlzYWJsZWQfDwKCAhYGHw0bAAAAAAAASUABAAAAHw4FEXJpVGV4dEJveCByaUVtcHR5Hw8CggIWBh8NGwAAAAAAAElAAQAAAB8OBRByaVRleHRCb3ggcmlSZWFkHw8CggIWBh8NGwAAAAAAAElAAQAAAB8OBRRyaVRleHRCb3ggcmlOZWdhdGl2ZR8PAoICZAJNDw8WAh8GBQRGbGF0ZGQCTw8UKwACFCsACA8WCB8GBQEwHwsFB3JpTGFiZWwfCGgfGAcAAAAAAAAAAGQWBh8NGwAAAAAAwFJAAQAAAB8OBRFyaVRleHRCb3ggcmlIb3Zlch8PAoICFgYfDRsAAAAAAMBSQAEAAAAfDgURcmlUZXh0Qm94IHJpRXJyb3IfDwKCAhYGHw0bAAAAAADAUkABAAAAHw4FE3JpVGV4dEJveCByaUZvY3VzZWQfDwKCAhYGHw0bAAAAAADAUkABAAAAHw4FE3JpVGV4dEJveCByaUVuYWJsZWQfDwKCAhYGHw0bAAAAAADAUkABAAAAHw4FFHJpVGV4dEJveCByaURpc2FibGVkHw8CggIWBh8NGwAAAAAAwFJAAQAAAB8OBRFyaVRleHRCb3ggcmlFbXB0eR8PAoICFgYfDRsAAAAAAMBSQAEAAAAfDgUQcmlUZXh0Qm94IHJpUmVhZB8PAoICFgYfDRsAAAAAAMBSQAEAAAAfDgUUcmlUZXh0Qm94IHJpTmVnYXRpdmUfDwKCAmQCFQ8UKwAIDxYGHwZlHwhoHwsFB3JpTGFiZWxkFgYfDRsAAAAAACBsQAEAAAAfDgURcmlUZXh0Qm94IHJpSG92ZXIfDwKCAhYGHw0bAAAAAAAgbEABAAAAHw4FEXJpVGV4dEJveCByaUVycm9yHw8CggIWBh8NGwAAAAAAIGxAAQAAAB8OBRNyaVRleHRCb3ggcmlGb2N1c2VkHw8CggIWBh8NGwAAAAAAIGxAAQAAAB8OBRNyaVRleHRCb3ggcmlFbmFibGVkHw8CggIWBh8NGwAAAAAAIGxAAQAAAB8OBRRyaVRleHRCb3ggcmlEaXNhYmxlZB8PAoICFgYfDRsAAAAAACBsQAEAAAAfDgURcmlUZXh0Qm94IHJpRW1wdHkfDwKCAhYGHw0bAAAAAAAgbEABAAAAHw4FEHJpVGV4dEJveCByaVJlYWQfDwKCAmQCHw9kFgJmD2QWAgIBDzwrAA0CABQrAAIPFggfGgIBHxVnHwhoHgtFZGl0SW5kZXhlcxYAZBcBBQ9TZWxlY3RlZEluZGV4ZXMWAAEWAhYKDwIEFCsABDwrAAUBBAUHY29sVHlwZRQrAAUWAh4IRGF0YVR5cGUZKwJkZGQFBmNvbFJlZjwrAAUBABYCHwlnFCsABRYCHwlnZGRkBQljb2xEZWxldGVkZRQrAAALKXpUZWxlcmlrLldlYi5VSS5HcmlkQ2hpbGRMb2FkTW9kZSwgVGVsZXJpay5XZWIuVUksIFZlcnNpb249MjAwOC4zLjEzMTQuMzUsIEN1bHR1cmU9bmV1dHJhbCwgUHVibGljS2V5VG9rZW49MTIxZmFlNzgxNjViYTNkNAE8KwAHAAspdVRlbGVyaWsuV2ViLlVJLkdyaWRFZGl0TW9kZSwgVGVsZXJpay5XZWIuVUksIFZlcnNpb249MjAwOC4zLjEzMTQuMzUsIEN1bHR1cmU9bmV1dHJhbCwgUHVibGljS2V5VG9rZW49MTIxZmFlNzgxNjViYTNkNAAWAh4EX2VmcxYCHgRfZWNjPCsABQEEBRJFZGl0Q29tbWFuZENvbHVtbjFkFgoeBV9nY2lkCyl/VGVsZXJpay5XZWIuVUkuR3JpZENvbW1hbmRJdGVtRGlzcGxheSwgVGVsZXJpay5XZWIuVUksIFZlcnNpb249MjAwOC4zLjEzMTQuMzUsIEN1bHR1cmU9bmV1dHJhbCwgUHVibGljS2V5VG9rZW49MTIxZmFlNzgxNjViYTNkNAIfFWcfGRYAHgVfIUNJUxcAHxpmZhYEZg8UKwADZGRkZAIBDxYEFCsAAg8WCh8mCysGAh8VZx8ZFgAfJxcAHxpmZBcDBQZfIURTSUNmBQtfIUl0ZW1Db3VudGYFCF8hUENvdW50ZBYCHgNfc2UWAh4CX2NmZBYEZGRkZBYCZg9kFgZmD2QWAmYPZBYMZg8PFgQfBgUGJm5ic3A7HwloZGQCAQ8PFgQfBgUGJm5ic3A7HwloZGQCAg8PFgIfBgUEVHlwZWRkAgMPDxYCHwYFC1JlZmVyZW5jZSAjZGQCBA8PFgIfBgUGJm5ic3A7ZGQCBQ8PFgIfBgUGJm5ic3A7ZGQCAQ9kFgZmD2QWDGYPDxYCHwYFBiZuYnNwO2RkAgEPDxYCHwYFBiZuYnNwO2RkAgIPDxYCHwYFBiZuYnNwO2RkAgMPDxYCHwYFBiZuYnNwO2RkAgQPDxYCHwYFBiZuYnNwO2RkAgUPDxYCHwYFBiZuYnNwO2RkAgEPZBYCZg8PFgIfBmVkZAICDw8WAh8JaGQWAmYPDxYIHgpDb2x1bW5TcGFuAgQeDVZlcnRpY2FsQWxpZ24LKidTeXN0ZW0uV2ViLlVJLldlYkNvbnRyb2xzLlZlcnRpY2FsQWxpZ24BHg9Ib3Jpem9udGFsQWxpZ24LKilTeXN0ZW0uV2ViLlVJLldlYkNvbnRyb2xzLkhvcml6b250YWxBbGlnbgEfDwKAgAxkZAICD2QWBmYPDxYCHwloZGQCAQ8PFgIfCWhkZAICDw8WAh8qAgQWAh4Fc3R5bGUFEHRleHQtYWxpZ246bGVmdDtkAjUPZBYCZg8WAh8JaGQCNw8PFgIfCWhkZBgMBSBjdGwwMCRjcGhNYWluQ29udGVudCRyY2JPcmRBZ2VudA8UKwACBQVBVDU0MWVkBSVjdGwwMCRjcGhNYWluQ29udGVudCRyY2JPcmRDaGFyZ2VJdGVtDxQrAAIFDkZSRUlHSFQgKEZMQVQpBQ5GbGF0fEZMVHwxfExIRmQFJmN0bDAwJGNwaE1haW5Db250ZW50JHJjYk9yZFNoaXBwZXJDb2RlDxQrAAJlZWQFKGN0bDAwJGNwaE1haW5Db250ZW50JHJjYk9yZENvbnNpZ25lZUNpdHkPFCsAAmVlZAUmY3RsMDAkY3BoTWFpbkNvbnRlbnQkcmNiT3JkVHJhaWxlclR5cGUPFCsAAmVlZAUmY3RsMDAkY3BoTWFpbkNvbnRlbnQkcmNiT3JkQWN0dWFsVW5pdHMPFCsAAgUDRkxUBQ9GTFQtRmxhdHxSYXRlQnlkBSVjdGwwMCRjcGhNYWluQ29udGVudCRyY2JPcmRCaWxsVG9Db2RlDxQrAAJlZWQFKGN0bDAwJGNwaE1haW5Db250ZW50JHJjYk9yZENvbnNpZ25lZUNvZGUPFCsAAmVlZAUmY3RsMDAkY3BoTWFpbkNvbnRlbnQkcmNiT3JkU2hpcHBlckNpdHkPFCsAAmVlZAUeX19Db250cm9sc1JlcXVpcmVQb3N0QmFja0tleV9fFhUFDWN0bDAwJHJhZFRhYnMFHmN0bDAwJGNwaENoaWxkTmF2JHJhZE9yZGVyVGFicwUgY3RsMDAkY3BoTWFpbkNvbnRlbnQkcmNiT3JkQWdlbnQFJWN0bDAwJGNwaE1haW5Db250ZW50JHJjYk9yZEJpbGxUb0NvZGUFJmN0bDAwJGNwaE1haW5Db250ZW50JHJjYk9yZFNoaXBwZXJDb2RlBSZjdGwwMCRjcGhNYWluQ29udGVudCRyY2JPcmRTaGlwcGVyQ2l0eQUoY3RsMDAkY3BoTWFpbkNvbnRlbnQkcmNiT3JkQ29uc2lnbmVlQ29kZQUoY3RsMDAkY3BoTWFpbkNvbnRlbnQkcmNiT3JkQ29uc2lnbmVlQ2l0eQUlY3RsMDAkY3BoTWFpbkNvbnRlbnQkcmR0T3JkUFVEYXRlVGltZQUuY3RsMDAkY3BoTWFpbkNvbnRlbnQkcmR0T3JkUFVEYXRlVGltZSRjYWxlbmRhcgUuY3RsMDAkY3BoTWFpbkNvbnRlbnQkcmR0T3JkUFVEYXRlVGltZSRjYWxlbmRhcgUuY3RsMDAkY3BoTWFpbkNvbnRlbnQkcmR0T3JkUFVEYXRlVGltZSR0aW1lVmlldwUrY3RsMDAkY3BoTWFpbkNvbnRlbnQkcmR0T3JkRGVsaXZlcnlEYXRlVGltZQU0Y3RsMDAkY3BoTWFpbkNvbnRlbnQkcmR0T3JkRGVsaXZlcnlEYXRlVGltZSRjYWxlbmRhcgU0Y3RsMDAkY3BoTWFpbkNvbnRlbnQkcmR0T3JkRGVsaXZlcnlEYXRlVGltZSRjYWxlbmRhcgU0Y3RsMDAkY3BoTWFpbkNvbnRlbnQkcmR0T3JkRGVsaXZlcnlEYXRlVGltZSR0aW1lVmlldwUmY3RsMDAkY3BoTWFpbkNvbnRlbnQkcmNiT3JkVHJhaWxlclR5cGUFJGN0bDAwJGNwaE1haW5Db250ZW50JHJjYk9yZENvbW1vZGl0eQUmY3RsMDAkY3BoTWFpbkNvbnRlbnQkcmNiT3JkQWN0dWFsVW5pdHMFJWN0bDAwJGNwaE1haW5Db250ZW50JHJjYk9yZENoYXJnZUl0ZW0FI2N0bDAwJGNwaE1haW5Db250ZW50JHJnT3JkUmVmZXJlbmNlBR5jdGwwMCRjcGhNYWluQ29udGVudCRyY2JPcmRWYW4PFCsAAmVlZAUkY3RsMDAkY3BoTWFpbkNvbnRlbnQkcmNiT3JkQ29tbW9kaXR5DxQrAAJlZWTwPXg9gkiQRpjV3Dr3FCHIhiyaXQ==" />
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

<link class='Telerik_stylesheet' type='text/css' rel='stylesheet' href='/WebResource.axd?d=kjCuBYUaUasbxHnK_qEA7AH-seNl8jhyPHdzHB85YKZ4DfkeDN2G3Jv4HoMT5j8CeI7FYHiAk3sjLg29Ri_FkA2&amp;t=633674324160000000'></link><link class='Telerik_stylesheet' type='text/css' rel='stylesheet' href='/WebResource.axd?d=kjCuBYUaUasbxHnK_qEA7AH-seNl8jhyPHdzHB85YKbzweikXegmQIfHc8l4-lPnnWuxw10BQWw7mmg_OUy3dXRSPECGUBqNnOh-fp7c7-w1&amp;t=633674324160000000'></link><link class='Telerik_stylesheet' type='text/css' rel='stylesheet' href='/WebResource.axd?d=kjCuBYUaUasbxHnK_qEA7AH-seNl8jhyPHdzHB85YKZrD9R8BAkWqLDGKSxzrD358ZnVuxht8YGe1f8pEzIUQw2&amp;t=633674324160000000'></link><link class='Telerik_stylesheet' type='text/css' rel='stylesheet' href='/WebResource.axd?d=kjCuBYUaUasbxHnK_qEA7AH-seNl8jhyPHdzHB85YKYl5_gzgEQ3OQmLCDf4P-wF3nGEYRXge2FeJAQ12k_TFIVSfsowt2reQiU1JP8SZxQ1&amp;t=633674324160000000'></link><link class='Telerik_stylesheet' type='text/css' rel='stylesheet' href='/WebResource.axd?d=kjCuBYUaUasbxHnK_qEA7AH-seNl8jhyPHdzHB85YKZu-d7bQxdzTl-4GcYIQBOCG1DKiZOEHmOyQyDXgQf3EA2&amp;t=633674324160000000'></link><link class='Telerik_stylesheet' type='text/css' rel='stylesheet' href='/WebResource.axd?d=kjCuBYUaUasbxHnK_qEA7AH-seNl8jhyPHdzHB85YKaMsjdPjRiyd0gNDlf_yRYjN4F70mX4MNPd0iO0TXRs3g2&amp;t=633674324160000000'></link>
<script src="/Telerik.Web.UI.WebResource.axd?_TSM_HiddenField_=ctl00_RadScriptManager1_HiddenField&amp;compress=1&amp;_TSM_CombinedScripts_=%3b%3bSystem.Web.Extensions%2c+Version%3d3.5.0.0%2c+Culture%3dneutral%2c+PublicKeyToken%3d31bf3856ad364e35%3aen-US%3a0d787d5c-3903-4814-ad72-296cea810318%3aea597d4b%3ab25378d2%3bTelerik.Web.UI%2c+Version%3d2008.3.1314.35%2c+Culture%3dneutral%2c+PublicKeyToken%3d121fae78165ba3d4%3aen-US%3aef502ffb-86f7-4d96-ad3a-fbb934d602ab%3a16e4e7cd%3ae330518b%3a1e771326%3a8e6f0d33%3ab7778d6c%3a19620875%3aaa288e2d%3a8674cba1%3aef347303%3ac08e9f8a%3aa51ee93e%3a59462f1%3ae085fe68%3a58366029%3aed16cbdc" type="text/javascript"></script>
<script type="text/javascript">
//<![CDATA[
var PageMethods = function() {
PageMethods.initializeBase(this);
this._timeout = 0;
this._userContext = null;
this._succeeded = null;
this._failed = null;
}
PageMethods.prototype = {
_get_path:function() {
 var p = this.get_path();
 if (p) return p;
 else return PageMethods._staticInstance.get_path();},
GetMileage:function(orign,dest,succeededCallback, failedCallback, userContext) {
return this._invoke(this._get_path(), 'GetMileage',false,{orign:orign,dest:dest},succeededCallback,failedCallback,userContext); }}
PageMethods.registerClass('PageMethods',Sys.Net.WebServiceProxy);
PageMethods._staticInstance = new PageMethods();
PageMethods.set_path = function(value) { PageMethods._staticInstance.set_path(value); }
PageMethods.get_path = function() { return PageMethods._staticInstance.get_path(); }
PageMethods.set_timeout = function(value) { PageMethods._staticInstance.set_timeout(value); }
PageMethods.get_timeout = function() { return PageMethods._staticInstance.get_timeout(); }
PageMethods.set_defaultUserContext = function(value) { PageMethods._staticInstance.set_defaultUserContext(value); }
PageMethods.get_defaultUserContext = function() { return PageMethods._staticInstance.get_defaultUserContext(); }
PageMethods.set_defaultSucceededCallback = function(value) { PageMethods._staticInstance.set_defaultSucceededCallback(value); }
PageMethods.get_defaultSucceededCallback = function() { return PageMethods._staticInstance.get_defaultSucceededCallback(); }
PageMethods.set_defaultFailedCallback = function(value) { PageMethods._staticInstance.set_defaultFailedCallback(value); }
PageMethods.get_defaultFailedCallback = function() { return PageMethods._staticInstance.get_defaultFailedCallback(); }
PageMethods.set_path("/Order.aspx");
PageMethods.GetMileage= function(orign,dest,onSuccess,onFailed,userContext) {PageMethods._staticInstance.GetMileage(orign,dest,onSuccess,onFailed,userContext); }
//]]>
</script>

<script src="/WebResource.axd?d=bN8BJlm_9tn_yyR0LxBldA2&amp;t=634050896073162769" type="text/javascript"></script>
<div>

	<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="/wEWJwLoyeOZAgK+nYa6CgK3o+LvAwLq8t7zCAL014eHBAK7xpWICAL3lIKiBALx1ZOLBgLosPDWCQLQi+jJCQLClPaiBAKgnMOjCwKlnJuiCwLbx4zOBgKXxtTjBgKrorvlCQLZ8LPgBgK8o9fyCgLT6bWZBgLW7vWXAwKm2tXuCQKw+8nBCgL1q4msBgLw/93bDgLpusPWDwK4+8neDgKq+/GSBwKY+7mSBwKF3MrYCgLsxfBcAvXlkPMMAtWXzcIBAvaGhN8HAsPL5ekPApSG5K0GArml6b4OAs7Si9YHAry8h50EAury9ooMERt5EV8ZjtEVYOUspSk2Wkoq8lY=" />
</div>
	<script type="text/javascript">
//<![CDATA[
Sys.WebForms.PageRequestManager._initialize('ctl00$RadScriptManager1', document.getElementById('aspnetForm'));
Sys.WebForms.PageRequestManager.getInstance()._updateControls(['tctl00$cphMainContent$UpdatePanel1','tctl00$cphMainContent$UpdatePanel2'], [], [], 90);
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
                                              
            <span id="ctl00_labelDate" style="display:inline-block;color:Black;font-size:X-Small;height:16px;">Wednesday, September 29, 2010 </span><br />
                    
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
    <a href="Default2.aspx" class="crumb">Home</a> &gt; <a href="Order.aspx" class="crumbCurrent">
    Order Entry</a>

</td></tr>
		    <tr><td width="100%"><div style="padding-left:1px;padding-bottom:2px;">
    <div id="ctl00_cphChildNav_radOrderTabs" class="RadTabStrip RadTabStrip_TIISkin RadTabStripTop_TIISkin ">
	<div class="rtsLevel rtsLevel1">
		<ul class="rtsUL"><li class="rtsLI rtsFirst"><a class="rtsLink" href="#"><span class="rtsOut"><span class="rtsIn"><span class="rtsTxt">Search</span></span></span></a></li><li class="rtsLI"><a class="rtsLink" href="#"><span class="rtsOut"><span class="rtsIn"><span class="rtsTxt">My Available Loads</span></span></span></a></li><li class="rtsLI"><a class="rtsLink" href="Order_MyTruckBoard.aspx"><span class="rtsOut"><span class="rtsIn"><span class="rtsTxt">My Trucks</span></span></span></a></li><li class="rtsLI"><a class="rtsLink" href="#"><span class="rtsOut"><span class="rtsIn"><span class="rtsTxt">Credit</span></span></span></a></li><li class="rtsLI"><a class="rtsLink rtsBefore" href="#"><span class="rtsOut"><span class="rtsIn"><span class="rtsTxt">Compliance</span></span></span></a></li><li class="rtsLI"><a class="rtsLink rtsSelected" href="#"><span class="rtsOut"><span class="rtsIn"><span class="rtsTxt">Order</span></span></span></a></li><li class="rtsLI"><a class="rtsLink rtsAfter rtsDisabled" href="#"><span class="rtsOut"><span class="rtsIn"><span class="rtsTxt">Accessorials</span></span></span></a></li><li class="rtsLI"><a class="rtsLink rtsDisabled" href="#"><span class="rtsOut"><span class="rtsIn"><span class="rtsTxt">Stops</span></span></span></a></li><li class="rtsLI"><a class="rtsLink rtsDisabled" href="#"><span class="rtsOut"><span class="rtsIn"><span class="rtsTxt">Assignments</span></span></span></a></li><li class="rtsLI"><a class="rtsLink rtsDisabled" href="#"><span class="rtsOut"><span class="rtsIn"><span class="rtsTxt">Notes</span></span></span></a></li><li class="rtsLI rtsLast"><a class="rtsLink rtsDisabled" href="#"><span class="rtsOut"><span class="rtsIn"><span class="rtsTxt">Summary</span></span></span></a></li></ul>

	</div><input id="ctl00_cphChildNav_radOrderTabs_ClientState" name="ctl00_cphChildNav_radOrderTabs_ClientState" type="hidden" />
</div>
</div></td></tr>
        </table>
        

<div id="ctl00_cphMainContent_UpdatePanel1">
	
 <div id="ctl00_cphMainContent_pnl1">
		
<table cellpadding="0" cellspacing="0" border="0" class="container" width="100%">
<tr>
	<td>
		<table class="bodyContainer" align="center" border="0" width="98%">

		<tr>
			<td width="100%" bgcolor="#EDEDED">
				<table border="0">
				<tr>
					<td width="150px"><a id="ctl00_cphMainContent_hfSaveNew" href="javascript:__doPostBack('ctl00$cphMainContent$hfSaveNew','')"><img src="images/buttonSaveNew.png" id="ctl00_cphMainContent_btnSaveNew" border="0" /></a></td>
					<td width="100px"><a href="#" id="ctl00_cphMainContent_hfCopy" onclick="CopyOrderOption(); return false;"></a></td>
					<td valign="middle" width="100px">
					</td>
					<td width="100px">&nbsp;

					&nbsp;
					</td>
					<td width="100%" align="right"><a id="ctl00_cphMainContent_hfSave2" href="javascript:__doPostBack('ctl00$cphMainContent$hfSave2','')"><img src="images/buttonAcc.png" id="ctl00_cphMainContent_btnSave2" border="0" /></a>
					<a href="#" id="ctl00_cphMainContent_hfCanel2" onclick="ConfirmCancel();"><img src="images/buttonExit.png" border="0" alt="" /></a></td>
				</tr>
				</table>
			</td>
		</tr>
		</table>

	</td>
</tr>

<tr>
	<td>
		<table class="bodyContainer" align="center" border="0" width="98%">
		<tr><td width="100%"><h2>Current Order Information</h2>
		    <hr class="dashed" />
		    </td>
		</tr>

		</table>
	</td>
</tr>
<tr>
	<td>
	 <div id="ctl00_cphMainContent_panel2">
			
		<table class="bodyContainer" align="center" border="0" width="98%" cellpadding="0" cellspacing="0">
		<tr>
		    <td width="50%" bgcolor="#FFFFFF" valign="top">
			   <table border="0" cellpadding="2" cellspacing="2" width="100%">

			   <tr>
				   <td class="tableBorder">
				   <font class="fields">Order</font>
                       &nbsp;
				   <span id="ctl00_cphMainContent_tbxOrdOrderNumber_wrapper" class="RadInput_Default" style="white-space:nowrap;"><input type="text" maxlength="12" size="20" id="ctl00_cphMainContent_tbxOrdOrderNumber_text" name="ctl00_cphMainContent_tbxOrdOrderNumber_text" class="riTextBox riEnabled" style="width:100px;" /><input id="ctl00_cphMainContent_tbxOrdOrderNumber" name="ctl00$cphMainContent$tbxOrdOrderNumber" class="rdfd_" style="visibility:hidden;margin:-18px 0 0 0;width:1px;height:1px;overflow:hidden;border:0;padding:0;" type="text" value="" /><input id="ctl00_cphMainContent_tbxOrdOrderNumber_ClientState" name="ctl00_cphMainContent_tbxOrdOrderNumber_ClientState" type="hidden" /></span>
					   &nbsp;&nbsp;&nbsp;&nbsp;<font class="fields">Agent</font>&nbsp;<span id="ctl00_cphMainContent_Label1" style="color:Red;font-size:X-Small;">*</span>
                       &nbsp;

                       &nbsp;&nbsp;
					<div id="ctl00_cphMainContent_rcbOrdAgent" class="RadComboBox RadComboBox_Default " style="width:100px;display:-moz-inline-stack;">
				<table cellpadding="0" cellspacing="0" summary="combobox" border="0" style="border-width:0;">
					<tr>
						<td class="rcbInputCell rcbInputCellLeft" style="width:100%;"><input class="rcbInput" type="text" id="ctl00_cphMainContent_rcbOrdAgent_Input" name="ctl00$cphMainContent$rcbOrdAgent" value="AT541" style="text-decoration:;"></input></td><td class="rcbArrowCell rcbArrowCellRight rcbArrowCellHidden"><a id="ctl00_cphMainContent_rcbOrdAgent_Arrow" style="overflow: hidden;display: block;position: relative;outline: none;">select</a></td>
					</tr>
				</table><div class="rcbSlide" style="z-index:6000;"><div id="ctl00_cphMainContent_rcbOrdAgent_DropDown" class="RadComboBoxDropDown RadComboBoxDropDown_Default" style="display:none;width:350px;"><div id="ctl00_cphMainContent_rcbOrdAgent_Header" class="rcbHeader">
                        <table style="width: 350px" cellspacing="0" cellpadding="0">

                        <tr>
                            <td style="width: 100px">Code</td>
                            <td style="width: 125px">Name</td>
                            <td style="width: 125px">City State</td>
                        </tr>
                        </table>
                        </div><div class="rcbScroll rcbWidth" style="height:100px;width:100%;"><ul class="rcbList" style="width:350px;list-style:none;margin:0;padding:0;zoom:1;"><li class="rcbItem ">

                        <table style="width: 350px" cellspacing="0" cellpadding="0">
                        <tr>
                            <td style="width: 100px">
                              AB541
                            </td>
                            <td style="width: 125px">
                              FW AGENCY BOISE
                            </td>
                            <td style="width: 125px">
                              EAGLE,ID/
                            </td>

                         </tr>
                         </table>
                        </li><li class="rcbItem ">
                        <table style="width: 350px" cellspacing="0" cellpadding="0">
                        <tr>
                            <td style="width: 100px">
                              AT541
                            </td>
                            <td style="width: 125px">

                              FW AGENCY BOISE
                            </td>
                            <td style="width: 125px">
                              EAGLE,ID/
                            </td>
                         </tr>
                         </table>
                        </li></ul></div></div></div><input id="ctl00_cphMainContent_rcbOrdAgent_ClientState" name="ctl00_cphMainContent_rcbOrdAgent_ClientState" type="hidden" />
			</div>&nbsp;&nbsp;&nbsp;&nbsp;
                   <br />

                   </td>
			  </tr>
    		  </table>
     	    </td>
		    <td width="50%" bgcolor="#FFFFFF" valign="top">
				<table border="0" cellpadding="0" cellspacing="0" width="100%" align="right">
				<tr>
					<td align="right"><font class="fields">Order Status</font>&nbsp;</td>

					<td width="10" class="tableBorder" align="right">
						<select name="ctl00$cphMainContent$ddlOrdOrderStatus" id="ctl00_cphMainContent_ddlOrdOrderStatus" disabled="disabled" style="width:100px;">
				<option selected="selected" value="AVL">Available</option>
				<option value="CAN">Cancelled</option>
				<option value="CMP">Completed</option>
				<option value="HST">Historical</option>
				<option value="ICO">Cancelled Billable</option>

				<option value="PLN">Planned</option>
				<option value="PND">Pending</option>
				<option value="STD">Started</option>

			</select>&nbsp;&nbsp;
					</td>
					<td width="40" align="right">
					<a href="#" id="ctl00_cphMainContent_hfCancelOrder" onclick="CancelOrder(); return false;"></a></td>

				</tr>
				</table>
			</td>
		</tr>
		</table>
		
		</div>
	</td>
	</tr>
	<tr>

		<td>
              <!-- START MIDDLE BORDER TABLE -->
            <div id="ctl00_cphMainContent_panel1">
			
            <table  bgcolor="#EDEDED" align="center" border="0" cellpadding="0" cellspacing="0" style="border: solid #43729f 2px;">
			<tr>
				<td>
					<table class="bodyContainer" align="center" border="0" width="98%" cellpadding="5" cellspacing="0">
		
					<tr>
						<td width="33%" bgcolor="#EDEDED" valign="top">

							<table border="0" cellpadding="5" cellspacing="0" width="100%">
							<tr><td colspan="3" class="tableBorder"><h2>BILL TO NAME&nbsp;<img id="ctl00_cphMainContent_imgBTRQ" title="If you are assigning a driver or carrier, you must enter the Bill To Name and Rate." src="Images/billto.PNG" style="height:15px;width:15px;border-width:0px;" /></h2>
							
							</td></tr>
							<tr><td colspan="3" class="tableBorder">
							<div id="ctl00_cphMainContent_rcbOrdBillToCode" class="RadComboBox RadComboBox_Default " style="width:240px;display:-moz-inline-stack;">
				<table cellpadding="0" cellspacing="0" summary="combobox" border="0" style="border-width:0;">
					<tr>
						<td class="rcbInputCell rcbInputCellLeft" style="width:100%;"><input class="rcbInput" type="text" id="ctl00_cphMainContent_rcbOrdBillToCode_Input" name="ctl00$cphMainContent$rcbOrdBillToCode" value="" style="text-decoration:;"></input></td><td class="rcbArrowCell rcbArrowCellRight rcbArrowCellHidden"><a id="ctl00_cphMainContent_rcbOrdBillToCode_Arrow" style="overflow: hidden;display: block;position: relative;outline: none;">select</a></td>

					</tr>
				</table><div class="rcbSlide" style="z-index:6000;"><div id="ctl00_cphMainContent_rcbOrdBillToCode_DropDown" class="RadComboBoxDropDown RadComboBoxDropDown_Default" style="display:none;width:550px;"><div id="ctl00_cphMainContent_rcbOrdBillToCode_Header" class="rcbHeader">
                                <table style="width: 550px" cellspacing="0" cellpadding="0">
                                    <tr>
                                         <td style="width: 325px">
                                             Name</td>
                                        <td style="width: 100px">
                                            Code</td>

                                        <td style="width: 125px"> 
                                            City State</td>
                                    </tr>
                                </table>
                            </div><div class="rcbScroll rcbWidth" style="height:100px;width:100%;"></div></div></div><input id="ctl00_cphMainContent_rcbOrdBillToCode_ClientState" name="ctl00_cphMainContent_rcbOrdBillToCode_ClientState" type="hidden" />
			</div>&nbsp;
                                </td>
                            </tr>
							<tr><td class="tableBorder"><h3>Credit Limit</h3></td>

							    <td class="tableBorder"><h3>Credit Available</h3></td></tr>
							<tr><td class="tableBorder">
							    <input name="ctl00$cphMainContent$txtCreditLimit" type="text" id="ctl00_cphMainContent_txtCreditLimit" disabled="disabled" class="shaded" style="width:80px;" />
							    <td class="tableBorder">
							    <input name="ctl00$cphMainContent$txtCreditAvailable" type="text" id="ctl00_cphMainContent_txtCreditAvailable" disabled="disabled" class="shaded" style="width:80px;" /></td></td></tr>
							</table>
						</td>
						<td width="33%" bgcolor="#EDEDED" valign="top">

							<table border="0" cellpadding="5" cellspacing="0" width="100%">
							<tr><td class="tableBorder"><h2>SHIPPER NAME&nbsp;</h2></td></tr>
							<tr><td class="tableBorder">
							    <div id="ctl00_cphMainContent_rcbOrdShipperCode" class="RadComboBox RadComboBox_Default " style="width:240px;display:-moz-inline-stack;">
				<table cellpadding="0" cellspacing="0" summary="combobox" border="0" style="border-width:0;">
					<tr>
						<td class="rcbInputCell rcbInputCellLeft" style="width:100%;"><input class="rcbInput" type="text" id="ctl00_cphMainContent_rcbOrdShipperCode_Input" name="ctl00$cphMainContent$rcbOrdShipperCode" value="" style="text-decoration:;"></input></td><td class="rcbArrowCell rcbArrowCellRight rcbArrowCellHidden"><a id="ctl00_cphMainContent_rcbOrdShipperCode_Arrow" style="overflow: hidden;display: block;position: relative;outline: none;">select</a></td>
					</tr>

				</table><div class="rcbSlide" style="z-index:6000;"><div id="ctl00_cphMainContent_rcbOrdShipperCode_DropDown" class="RadComboBoxDropDown RadComboBoxDropDown_Default" style="display:none;width:550px;"><div id="ctl00_cphMainContent_rcbOrdShipperCode_Header" class="rcbHeader">
                                <table style="width: 550px" cellspacing="0" cellpadding="0">
                                    <tr>
                                       
                                        <td style="width: 325px">
                                            Name</td>
                                         <td style="width: 100px">
                                             Code</td>
                                        <td style="width: 125px">

                                            City State</td>
                                    </tr>
                                </table>
                                </div><div class="rcbScroll rcbWidth" style="height:100px;width:100%;"></div></div></div><input id="ctl00_cphMainContent_rcbOrdShipperCode_ClientState" name="ctl00_cphMainContent_rcbOrdShipperCode_ClientState" type="hidden" />
			</div>
                                </td>
                            </tr>
							<tr><td class="tableBorder" valign="bottom"><h3>City, State</h3></td></tr>

							<tr><td class="tableBorder" valign="bottom">
							    <div id="ctl00_cphMainContent_rcbOrdShipperCity" class="RadComboBox RadComboBox_Default " style="width:180px;display:-moz-inline-stack;">
				<table cellpadding="0" cellspacing="0" summary="combobox" border="0" style="border-width:0;">
					<tr>
						<td class="rcbInputCell rcbInputCellLeft" style="width:100%;"><input class="rcbInput" type="text" id="ctl00_cphMainContent_rcbOrdShipperCity_Input" name="ctl00$cphMainContent$rcbOrdShipperCity" value="" style="text-decoration:;"></input></td><td class="rcbArrowCell rcbArrowCellRight rcbArrowCellHidden"><a id="ctl00_cphMainContent_rcbOrdShipperCity_Arrow" style="overflow: hidden;display: block;position: relative;outline: none;">select</a></td>
					</tr>
				</table><div class="rcbSlide" style="z-index:6000;"><div id="ctl00_cphMainContent_rcbOrdShipperCity_DropDown" class="RadComboBoxDropDown RadComboBoxDropDown_Default" style="display:none;width:250px;"><div class="rcbScroll rcbWidth" style="height:250px;width:100%;"></div></div></div><input id="ctl00_cphMainContent_rcbOrdShipperCity_ClientState" name="ctl00_cphMainContent_rcbOrdShipperCity_ClientState" type="hidden" />
			</div>&nbsp;

                                <span id="ctl00_cphMainContent_Label7" style="color:Red;font-size:X-Small;">*</span>
                                <br />
                                <input type="hidden" name="ctl00$cphMainContent$hdOrderHeaderID" id="ctl00_cphMainContent_hdOrderHeaderID" />
                                <input type="hidden" name="ctl00$cphMainContent$hdOrderIDNumber" id="ctl00_cphMainContent_hdOrderIDNumber" />
                                <input type="hidden" name="ctl00$cphMainContent$hdSaveOrder" id="ctl00_cphMainContent_hdSaveOrder" value="0" />
                                </td>
                            </tr>
							</table>

						</td>
						<td width="33%" bgcolor="#EDEDED" valign="top">
							<table border="0" cellpadding="5" cellspacing="0" width="100%">
							<tr><td class="tableBorder"><h2>CONSIGNEE NAME&nbsp;</h2></td></tr>
							<tr><td class="tableBorder">
							    <div id="ctl00_cphMainContent_rcbOrdConsigneeCode" class="RadComboBox RadComboBox_Default " style="width:240px;display:-moz-inline-stack;">
				<table cellpadding="0" cellspacing="0" summary="combobox" border="0" style="border-width:0;">
					<tr>

						<td class="rcbInputCell rcbInputCellLeft" style="width:100%;"><input class="rcbInput" type="text" id="ctl00_cphMainContent_rcbOrdConsigneeCode_Input" name="ctl00$cphMainContent$rcbOrdConsigneeCode" value="" style="text-decoration:;"></input></td><td class="rcbArrowCell rcbArrowCellRight rcbArrowCellHidden"><a id="ctl00_cphMainContent_rcbOrdConsigneeCode_Arrow" style="overflow: hidden;display: block;position: relative;outline: none;">select</a></td>
					</tr>
				</table><div class="rcbSlide" style="z-index:6000;"><div id="ctl00_cphMainContent_rcbOrdConsigneeCode_DropDown" class="RadComboBoxDropDown RadComboBoxDropDown_Default" style="display:none;width:450px;"><div id="ctl00_cphMainContent_rcbOrdConsigneeCode_Header" class="rcbHeader">
                                <table style="width: 450px" cellspacing="0" cellpadding="0">
                                    <tr>
                                        
                                        <td style="width: 175px">
                                            Name</td>
                                        <td style="width: 80px">

                                            Code</td>
                                        <td style="width: 195px">
                                            City State</td>
                                    </tr>
                                </table>
                                </div><div class="rcbScroll rcbWidth" style="height:100px;width:100%;"></div></div></div><input id="ctl00_cphMainContent_rcbOrdConsigneeCode_ClientState" name="ctl00_cphMainContent_rcbOrdConsigneeCode_ClientState" type="hidden" />
			</div>
                                </td>

                            </tr>
							<tr><td class="tableBorder"><h3>City, State</h3></td></tr>
							<tr><td class="tableBorder">
							    <div id="ctl00_cphMainContent_rcbOrdConsigneeCity" class="RadComboBox RadComboBox_Default " style="width:180px;display:-moz-inline-stack;">
				<table cellpadding="0" cellspacing="0" summary="combobox" border="0" style="border-width:0;">
					<tr>
						<td class="rcbInputCell rcbInputCellLeft" style="width:100%;"><input class="rcbInput" type="text" id="ctl00_cphMainContent_rcbOrdConsigneeCity_Input" name="ctl00$cphMainContent$rcbOrdConsigneeCity" value="" style="text-decoration:;"></input></td><td class="rcbArrowCell rcbArrowCellRight rcbArrowCellHidden"><a id="ctl00_cphMainContent_rcbOrdConsigneeCity_Arrow" style="overflow: hidden;display: block;position: relative;outline: none;">select</a></td>
					</tr>

				</table><div class="rcbSlide" style="z-index:6000;"><div id="ctl00_cphMainContent_rcbOrdConsigneeCity_DropDown" class="RadComboBoxDropDown RadComboBoxDropDown_Default" style="display:none;width:250px;"><div class="rcbScroll rcbWidth" style="height:250px;width:100%;"></div></div></div><input id="ctl00_cphMainContent_rcbOrdConsigneeCity_ClientState" name="ctl00_cphMainContent_rcbOrdConsigneeCity_ClientState" type="hidden" />
			</div>&nbsp;
                                <span id="ctl00_cphMainContent_Label2" style="color:Red;font-size:X-Small;">*</span>
                                <br />
                                <input type="hidden" name="ctl00$cphMainContent$hdOrdConsigneeCityCode" id="ctl00_cphMainContent_hdOrdConsigneeCityCode" />
                                </td>
                            </tr>
							</table>

						</td>
					</tr>
					</table>
				</td>
			</tr>
			<tr><td><hr class="white"></td></tr>
			<tr>
				<td>
					<table class="bodyContainer" align="center" border="0" width="98%" cellpadding="5" cellspacing="0">

					<tr>
						<td width="100%" bgcolor="#EDEDED" valign="middle">
							<table border="0" cellpadding="5" cellspacing="0" width="100%">
							<tr>
								<td><h3>PU Date/Time</h3></td>
								<td><h3>Delivery Date/Time</h3></td>
								<td class="tableBorder" style="border-left: solid #43729f 2px;"><h3><span id="ctl00_cphMainContent_lblTrailer">Trailer Type</span></h3></td>

								<td><h3>Commodity</h3></td>
								<td><h3>Miles</h3></td>
							</tr>
							<tr>
								<td><div id="ctl00_cphMainContent_rdtOrdPUDateTime_wrapper" class="RadPicker_Gray " style="display:-moz-inline-stack;height:20px;width:180px;">
				<input style="visibility:hidden;display:block;float:right;margin:0 0 -1px;width:1px;height:1px;overflow:hidden;border:0;padding:0;" id="ctl00_cphMainContent_rdtOrdPUDateTime" name="ctl00$cphMainContent$rdtOrdPUDateTime" type="text" class="rdfd_" value="2010-09-29-08-00-00" /><table cellspacing="0" style="width:180px;">
					<tr>
						<td class="rcInputCell" style="width:100%;"><span id="ctl00_cphMainContent_rdtOrdPUDateTime_dateInput_wrapper" class="RadInput_Gray" style="display:block;"><input type="text" value="09/29/2010 08:00" id="ctl00_cphMainContent_rdtOrdPUDateTime_dateInput_text" name="ctl00_cphMainContent_rdtOrdPUDateTime_dateInput_text" class="riTextBox riEnabled" style="width:100%;" /><input style="visibility:hidden;float:right;margin:-18px 0 0 0;width:1px;height:1px;overflow:hidden;border:0;padding:0;" id="ctl00_cphMainContent_rdtOrdPUDateTime_dateInput" name="ctl00$cphMainContent$rdtOrdPUDateTime$dateInput" type="text" class="rdfd_" value="2010-09-29-08-00-00" /><input id="ctl00_cphMainContent_rdtOrdPUDateTime_dateInput_ClientState" name="ctl00_cphMainContent_rdtOrdPUDateTime_dateInput_ClientState" type="hidden" /></span></td><td><a title="Open the calendar popup." href="#" id="ctl00_cphMainContent_rdtOrdPUDateTime_popupButton"><img id="ctl00_cphMainContent_rdtOrdPUDateTime_CalendarPopupButton" src="Images/iconCalendar2.gif" alt="Open the calendar popup." style="border-width:0px;" /></a><div id="ctl00_cphMainContent_rdtOrdPUDateTime_calendar_wrapper" style="display: none" ><table id="ctl00_cphMainContent_rdtOrdPUDateTime_calendar" summary="Calendar" cellspacing="0" class="RadCalendar_Gray" border="0">

							<thead>
								<tr>
									<td class="rcTitlebar"><table cellspacing="0" summary="title and navigation" border="0">
										<tr>
											<td><a id="ctl00_cphMainContent_rdtOrdPUDateTime_calendar_FNP" class="rcFastPrev" title="&lt;&lt;" href="#">&lt;&lt;</a></td><td><a id="ctl00_cphMainContent_rdtOrdPUDateTime_calendar_NP" class="rcPrev" title="&lt;" href="#">&lt;</a></td><td id="ctl00_cphMainContent_rdtOrdPUDateTime_calendar_Title" class="rcTitle">September 2010</td><td><a id="ctl00_cphMainContent_rdtOrdPUDateTime_calendar_NN" class="rcNext" title=">" href="#">&gt;</a></td><td><a id="ctl00_cphMainContent_rdtOrdPUDateTime_calendar_FNN" class="rcFastNext" title=">>" href="#">&gt;&gt;</a></td>
										</tr>
									</table></td>
								</tr>

							</thead><tbody>
	<tr>
		<td class="rcMain"><table id="ctl00_cphMainContent_rdtOrdPUDateTime_calendar_Top" class="rcMainTable" cellspacing="0" summary="September 2010" border="0">
	<thead>
		<tr class="rcWeek">
			<th id="ctl00_cphMainContent_rdtOrdPUDateTime_calendar_Top_cs_0" title="Sunday" abbr="Sun" scope="col" style="background-color:White;">S</th><th id="ctl00_cphMainContent_rdtOrdPUDateTime_calendar_Top_cs_1" title="Monday" abbr="Mon" scope="col" style="background-color:White;">M</th><th id="ctl00_cphMainContent_rdtOrdPUDateTime_calendar_Top_cs_2" title="Tuesday" abbr="Tue" scope="col" style="background-color:White;">T</th><th id="ctl00_cphMainContent_rdtOrdPUDateTime_calendar_Top_cs_3" title="Wednesday" abbr="Wed" scope="col" style="background-color:White;">W</th><th id="ctl00_cphMainContent_rdtOrdPUDateTime_calendar_Top_cs_4" title="Thursday" abbr="Thu" scope="col" style="background-color:White;">T</th><th id="ctl00_cphMainContent_rdtOrdPUDateTime_calendar_Top_cs_5" title="Friday" abbr="Fri" scope="col" style="background-color:White;">F</th><th id="ctl00_cphMainContent_rdtOrdPUDateTime_calendar_Top_cs_6" title="Saturday" abbr="Sat" scope="col" style="background-color:White;">S</th>

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
						</table><input type="hidden" name="ctl00_cphMainContent_rdtOrdPUDateTime_calendar_SD" id="ctl00_cphMainContent_rdtOrdPUDateTime_calendar_SD" value="[]" /><input type="hidden" name="ctl00_cphMainContent_rdtOrdPUDateTime_calendar_AD" id="ctl00_cphMainContent_rdtOrdPUDateTime_calendar_AD" value="[[1980,1,1],[2099,12,30],[2010,9,29]]" /></div></td><td><a title="Open the time view popup." href="#" id="ctl00_cphMainContent_rdtOrdPUDateTime_timePopupLink"><img id="ctl00_cphMainContent_rdtOrdPUDateTime_TimePopupButton" src="Images/iconClock.png" alt="Open the time view popup." style="border-width:0px;" /></a><div id="ctl00_cphMainContent_rdtOrdPUDateTime_timeView_wrapper" style="display: none;" ><div id="ctl00_cphMainContent_rdtOrdPUDateTime_timeView">
							<table id="ctl00_cphMainContent_rdtOrdPUDateTime_timeView_tdl" class="RadCalendarTimeView_Gray" cellspacing="0" border="0">
								<tr>
									<th colspan="3" scope="col" class="rcHeader">Time Picker</th>
								</tr><tr>
									<td><a href="#">00:00</a></td><td><a href="#">01:00</a></td><td><a href="#">02:00</a></td>

								</tr><tr>
									<td><a href="#">03:00</a></td><td><a href="#">04:00</a></td><td><a href="#">05:00</a></td>
								</tr><tr>
									<td><a href="#">06:00</a></td><td><a href="#">07:00</a></td><td><a href="#">08:00</a></td>
								</tr><tr>
									<td><a href="#">09:00</a></td><td><a href="#">10:00</a></td><td><a href="#">11:00</a></td>

								</tr><tr>
									<td><a href="#">12:00</a></td><td><a href="#">13:00</a></td><td><a href="#">14:00</a></td>
								</tr><tr>
									<td><a href="#">15:00</a></td><td><a href="#">16:00</a></td><td><a href="#">17:00</a></td>
								</tr><tr>
									<td><a href="#">18:00</a></td><td><a href="#">19:00</a></td><td><a href="#">20:00</a></td>

								</tr><tr>
									<td><a href="#">21:00</a></td><td><a href="#">22:00</a></td><td><a href="#">23:00</a></td>
								</tr>
							</table><input id="ctl00_cphMainContent_rdtOrdPUDateTime_timeView_ClientState" name="ctl00_cphMainContent_rdtOrdPUDateTime_timeView_ClientState" type="hidden" />
						</div></div></td>
					</tr>
				</table><input id="ctl00_cphMainContent_rdtOrdPUDateTime_ClientState" name="ctl00_cphMainContent_rdtOrdPUDateTime_ClientState" type="hidden" />

			</div>
                                    <span id="ctl00_cphMainContent_Label3" style="color:Red;font-size:X-Small;">*</span>
                                    &nbsp;
                                    </td>
								<td><div id="ctl00_cphMainContent_rdtOrdDeliveryDateTime_wrapper" class="RadPicker_Gray " style="display:-moz-inline-stack;height:20px;width:180px;">
				<input style="visibility:hidden;display:block;float:right;margin:0 0 -1px;width:1px;height:1px;overflow:hidden;border:0;padding:0;" id="ctl00_cphMainContent_rdtOrdDeliveryDateTime" name="ctl00$cphMainContent$rdtOrdDeliveryDateTime" type="text" class="rdfd_" value="2010-10-01-08-00-00" /><table cellspacing="0" style="width:180px;">
					<tr>
						<td class="rcInputCell" style="width:100%;"><span id="ctl00_cphMainContent_rdtOrdDeliveryDateTime_dateInput_wrapper" class="RadInput_Gray" style="display:block;"><input type="text" value="10/01/2010 08:00" id="ctl00_cphMainContent_rdtOrdDeliveryDateTime_dateInput_text" name="ctl00_cphMainContent_rdtOrdDeliveryDateTime_dateInput_text" class="riTextBox riEnabled" style="width:100%;" /><input style="visibility:hidden;float:right;margin:-18px 0 0 0;width:1px;height:1px;overflow:hidden;border:0;padding:0;" id="ctl00_cphMainContent_rdtOrdDeliveryDateTime_dateInput" name="ctl00$cphMainContent$rdtOrdDeliveryDateTime$dateInput" type="text" class="rdfd_" value="2010-10-01-08-00-00" /><input id="ctl00_cphMainContent_rdtOrdDeliveryDateTime_dateInput_ClientState" name="ctl00_cphMainContent_rdtOrdDeliveryDateTime_dateInput_ClientState" type="hidden" /></span></td><td><a title="Open the calendar popup." href="#" id="ctl00_cphMainContent_rdtOrdDeliveryDateTime_popupButton"><img id="ctl00_cphMainContent_rdtOrdDeliveryDateTime_CalendarPopupButton" src="Images/iconCalendar2.gif" alt="Open the calendar popup." style="border-width:0px;" /></a><div id="ctl00_cphMainContent_rdtOrdDeliveryDateTime_calendar_wrapper" style="display: none" ><table id="ctl00_cphMainContent_rdtOrdDeliveryDateTime_calendar" summary="Calendar" cellspacing="0" class="RadCalendar_Gray" border="0">

							<thead>
								<tr>
									<td class="rcTitlebar"><table cellspacing="0" summary="title and navigation" border="0">
										<tr>
											<td><a id="ctl00_cphMainContent_rdtOrdDeliveryDateTime_calendar_FNP" class="rcFastPrev" title="&lt;&lt;" href="#">&lt;&lt;</a></td><td><a id="ctl00_cphMainContent_rdtOrdDeliveryDateTime_calendar_NP" class="rcPrev" title="&lt;" href="#">&lt;</a></td><td id="ctl00_cphMainContent_rdtOrdDeliveryDateTime_calendar_Title" class="rcTitle">September 2010</td><td><a id="ctl00_cphMainContent_rdtOrdDeliveryDateTime_calendar_NN" class="rcNext" title=">" href="#">&gt;</a></td><td><a id="ctl00_cphMainContent_rdtOrdDeliveryDateTime_calendar_FNN" class="rcFastNext" title=">>" href="#">&gt;&gt;</a></td>
										</tr>
									</table></td>
								</tr>

							</thead><tbody>
	<tr>
		<td class="rcMain"><table id="ctl00_cphMainContent_rdtOrdDeliveryDateTime_calendar_Top" class="rcMainTable" cellspacing="0" summary="September 2010" border="0">
	<thead>
		<tr class="rcWeek">
			<th id="ctl00_cphMainContent_rdtOrdDeliveryDateTime_calendar_Top_cs_0" title="Sunday" abbr="Sun" scope="col" style="background-color:White;">S</th><th id="ctl00_cphMainContent_rdtOrdDeliveryDateTime_calendar_Top_cs_1" title="Monday" abbr="Mon" scope="col" style="background-color:White;">M</th><th id="ctl00_cphMainContent_rdtOrdDeliveryDateTime_calendar_Top_cs_2" title="Tuesday" abbr="Tue" scope="col" style="background-color:White;">T</th><th id="ctl00_cphMainContent_rdtOrdDeliveryDateTime_calendar_Top_cs_3" title="Wednesday" abbr="Wed" scope="col" style="background-color:White;">W</th><th id="ctl00_cphMainContent_rdtOrdDeliveryDateTime_calendar_Top_cs_4" title="Thursday" abbr="Thu" scope="col" style="background-color:White;">T</th><th id="ctl00_cphMainContent_rdtOrdDeliveryDateTime_calendar_Top_cs_5" title="Friday" abbr="Fri" scope="col" style="background-color:White;">F</th><th id="ctl00_cphMainContent_rdtOrdDeliveryDateTime_calendar_Top_cs_6" title="Saturday" abbr="Sat" scope="col" style="background-color:White;">S</th>

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
						</table><input type="hidden" name="ctl00_cphMainContent_rdtOrdDeliveryDateTime_calendar_SD" id="ctl00_cphMainContent_rdtOrdDeliveryDateTime_calendar_SD" value="[]" /><input type="hidden" name="ctl00_cphMainContent_rdtOrdDeliveryDateTime_calendar_AD" id="ctl00_cphMainContent_rdtOrdDeliveryDateTime_calendar_AD" value="[[1980,1,1],[2099,12,30],[2010,9,29]]" /></div></td><td><a title="Open the time view popup." href="#" id="ctl00_cphMainContent_rdtOrdDeliveryDateTime_timePopupLink"><img id="ctl00_cphMainContent_rdtOrdDeliveryDateTime_TimePopupButton" src="Images/iconClock.png" alt="Open the time view popup." style="border-width:0px;" /></a><div id="ctl00_cphMainContent_rdtOrdDeliveryDateTime_timeView_wrapper" style="display: none;" ><div id="ctl00_cphMainContent_rdtOrdDeliveryDateTime_timeView">
							<table id="ctl00_cphMainContent_rdtOrdDeliveryDateTime_timeView_tdl" class="RadCalendarTimeView_Gray" cellspacing="0" border="0">
								<tr>
									<th colspan="3" scope="col" class="rcHeader">Time Picker</th>
								</tr><tr>
									<td><a href="#">00:00</a></td><td><a href="#">01:00</a></td><td><a href="#">02:00</a></td>

								</tr><tr>
									<td><a href="#">03:00</a></td><td><a href="#">04:00</a></td><td><a href="#">05:00</a></td>
								</tr><tr>
									<td><a href="#">06:00</a></td><td><a href="#">07:00</a></td><td><a href="#">08:00</a></td>
								</tr><tr>
									<td><a href="#">09:00</a></td><td><a href="#">10:00</a></td><td><a href="#">11:00</a></td>

								</tr><tr>
									<td><a href="#">12:00</a></td><td><a href="#">13:00</a></td><td><a href="#">14:00</a></td>
								</tr><tr>
									<td><a href="#">15:00</a></td><td><a href="#">16:00</a></td><td><a href="#">17:00</a></td>
								</tr><tr>
									<td><a href="#">18:00</a></td><td><a href="#">19:00</a></td><td><a href="#">20:00</a></td>

								</tr><tr>
									<td><a href="#">21:00</a></td><td><a href="#">22:00</a></td><td><a href="#">23:00</a></td>
								</tr>
							</table><input id="ctl00_cphMainContent_rdtOrdDeliveryDateTime_timeView_ClientState" name="ctl00_cphMainContent_rdtOrdDeliveryDateTime_timeView_ClientState" type="hidden" />
						</div></div></td>
					</tr>
				</table><input id="ctl00_cphMainContent_rdtOrdDeliveryDateTime_ClientState" name="ctl00_cphMainContent_rdtOrdDeliveryDateTime_ClientState" type="hidden" />

			</div>
                                    <span id="ctl00_cphMainContent_Label4" style="color:Red;font-size:X-Small;">*</span>
                                    &nbsp;
                                    
                                    
                                </td>
								<td class="tableBorder" style="border-left: solid #43729f 2px;">
								    
								    <div id="ctl00_cphMainContent_rcbOrdTrailerType" class="RadComboBox RadComboBox_Default " style="width:100px;display:-moz-inline-stack;">
				<table cellpadding="0" cellspacing="0" summary="combobox" border="0" style="border-width:0;">
					<tr>

						<td class="rcbInputCell rcbInputCellLeft" style="width:100%;"><input class="rcbInput" type="text" id="ctl00_cphMainContent_rcbOrdTrailerType_Input" name="ctl00$cphMainContent$rcbOrdTrailerType" value="" style="text-decoration:;"></input></td><td class="rcbArrowCell rcbArrowCellRight rcbArrowCellHidden"><a id="ctl00_cphMainContent_rcbOrdTrailerType_Arrow" style="overflow: hidden;display: block;position: relative;outline: none;">select</a></td>
					</tr>
				</table><div class="rcbSlide" style="z-index:6000;"><div id="ctl00_cphMainContent_rcbOrdTrailerType_DropDown" class="RadComboBoxDropDown RadComboBoxDropDown_Default" style="display:none;width:200px;"><div class="rcbScroll rcbWidth" style="height:100px;width:100%;"></div></div></div><input id="ctl00_cphMainContent_rcbOrdTrailerType_ClientState" name="ctl00_cphMainContent_rcbOrdTrailerType_ClientState" type="hidden" />
			</div>&nbsp;<span id="ctl00_cphMainContent_lblValidTrailerType" class="Required"></span>
                                </td>
								<td><div id="ctl00_cphMainContent_rcbOrdCommodity" class="RadComboBox RadComboBox_Default " style="width:100px;display:-moz-inline-stack;">
				<table cellpadding="0" cellspacing="0" summary="combobox" border="0" style="border-width:0;">
					<tr>

						<td class="rcbInputCell rcbInputCellLeft" style="width:100%;"><input class="rcbInput" type="text" id="ctl00_cphMainContent_rcbOrdCommodity_Input" name="ctl00$cphMainContent$rcbOrdCommodity" value="" style="text-decoration:;"></input></td><td class="rcbArrowCell rcbArrowCellRight rcbArrowCellHidden"><a id="ctl00_cphMainContent_rcbOrdCommodity_Arrow" style="overflow: hidden;display: block;position: relative;outline: none;">select</a></td>
					</tr>
				</table><div class="rcbSlide" style="z-index:6000;"><div id="ctl00_cphMainContent_rcbOrdCommodity_DropDown" class="RadComboBoxDropDown RadComboBoxDropDown_Default" style="display:none;"><div class="rcbScroll rcbWidth" style="height:100px;width:100%;"></div></div></div><input id="ctl00_cphMainContent_rcbOrdCommodity_ClientState" name="ctl00_cphMainContent_rcbOrdCommodity_ClientState" type="hidden" />
			</div>&nbsp;
                                    <span id="ctl00_cphMainContent_lblValidCommodity" class="Required"></span>
								</td>
								<td> <input name="ctl00$cphMainContent$tbxOrdMiles" type="text" value="-1" id="ctl00_cphMainContent_tbxOrdMiles" disabled="disabled" class="shaded" style="width:50px;" />
								</td>

							</tr>
							</table>
						</td>
					</tr>
					</table>
				</td>
			</tr>
			<tr><td><hr class="white"></td></tr>
			<tr>

				<td>
					<table class="bodyContainer" align="center" border="0" width="98%" cellpadding="5" cellspacing="0">
					<tr>
						<td width="100%" bgcolor="#EDEDED" valign="middle">
							<table border="0" cellpadding="5" cellspacing="0" width="100%">
							<tr>
								<td><h3>Actual Qty</h3></td>
								<td><h3>Actual Units</h3></td>

								<td class="tableBorder" style="border-left: solid #43729f 2px;"><h3>Charge Item</h3></td>
								<td><h3>Charge Qty.</td>
								<td class="tableBorder" style="border-left: solid #43729f 2px;"><h3>Rate Unit</h3></td>
								<td><h3>Rate&nbsp;<img id="ctl00_cphMainContent_Image1" title="If you are assigning a driver or carrier, you must enter the Bill To Name and Rate." src="Images/billto.PNG" style="height:15px;width:15px;border-width:0px;" /></h3></td>
								<td class="tableBorder" style="border-left: solid #43729f 2px;"><h3>Currency</h3></td>
							</tr>

							<tr>
								<td><span id="ctl00_cphMainContent_tbxOrdActualQty_wrapper" class="RadInput_Default" style="white-space:nowrap;"><input type="text" value="0" id="ctl00_cphMainContent_tbxOrdActualQty_text" name="ctl00_cphMainContent_tbxOrdActualQty_text" class="riTextBox riEnabled" style="width:50px;" /><input style="visibility:hidden;margin:-18px 0 0 0;width:1px;height:1px;overflow:hidden;border:0;padding:0;" id="ctl00_cphMainContent_tbxOrdActualQty" class="rdfd_" value="0" type="text" /><input style="visibility:hidden;margin:-18px 0 0 0;width:1px;height:1px;overflow:hidden;border:0;padding:0;" id="ctl00_cphMainContent_tbxOrdActualQty_Value" class="rdfd_" name="ctl00$cphMainContent$tbxOrdActualQty" value="0" type="text" /><input id="ctl00_cphMainContent_tbxOrdActualQty_ClientState" name="ctl00_cphMainContent_tbxOrdActualQty_ClientState" type="hidden" /></span>
								</td>
								<td><div id="ctl00_cphMainContent_rcbOrdActualUnits" class="RadComboBox RadComboBox_Default " style="width:100px;display:-moz-inline-stack;">
				<table cellpadding="0" cellspacing="0" summary="combobox" border="0" style="border-width:0;">
					<tr>
						<td class="rcbInputCell rcbInputCellLeft" style="width:100%;"><input class="rcbInput" type="text" id="ctl00_cphMainContent_rcbOrdActualUnits_Input" name="ctl00$cphMainContent$rcbOrdActualUnits" value="FLT" style="text-decoration:;"></input></td><td class="rcbArrowCell rcbArrowCellRight rcbArrowCellHidden"><a id="ctl00_cphMainContent_rcbOrdActualUnits_Arrow" style="overflow: hidden;display: block;position: relative;outline: none;">select</a></td>
					</tr>

				</table><div class="rcbSlide" style="z-index:6000;"><div id="ctl00_cphMainContent_rcbOrdActualUnits_DropDown" class="RadComboBoxDropDown RadComboBoxDropDown_Default" style="display:none;width:150px;"><div id="ctl00_cphMainContent_rcbOrdActualUnits_Header" class="rcbHeader">
                                    <table style="width: 150px" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td style="width: 50px">
                                            Code</td>
                                        <td style="width: 100px">
                                            Name</td>
                                        
                                    </table>

                                    </div><div class="rcbScroll rcbWidth" style="height:100px;width:100%;"><ul class="rcbList" style="width:150px;list-style:none;margin:0;padding:0;zoom:1;"><li class="rcbItem ">
                                    <table style="width: 150px" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td style="width: 50px">
                                            CWT
                                        </td>
                                        <td style="width: 100px">
                                            CWT-$/100 lbs
                                        </td>
                                         
                                    </tr>

                                    </table>
                                    </li><li class="rcbItem ">
                                    <table style="width: 150px" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td style="width: 50px">
                                            FLT
                                        </td>
                                        <td style="width: 100px">
                                            FLT-Flat
                                        </td>

                                         
                                    </tr>
                                    </table>
                                    </li><li class="rcbItem ">
                                    <table style="width: 150px" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td style="width: 50px">
                                            HR
                                        </td>
                                        <td style="width: 100px">

                                            HR-$/Hour
                                        </td>
                                         
                                    </tr>
                                    </table>
                                    </li><li class="rcbItem ">
                                    <table style="width: 150px" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td style="width: 50px">
                                            LBS
                                        </td>

                                        <td style="width: 100px">
                                            LBS-$/Pound
                                        </td>
                                         
                                    </tr>
                                    </table>
                                    </li><li class="rcbItem ">
                                    <table style="width: 150px" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td style="width: 50px">

                                            MIL
                                        </td>
                                        <td style="width: 100px">
                                            MIL-$/Mile
                                        </td>
                                         
                                    </tr>
                                    </table>
                                    </li><li class="rcbItem ">
                                    <table style="width: 150px" cellspacing="0" cellpadding="0">
                                    <tr>

                                        <td style="width: 50px">
                                            PCS
                                        </td>
                                        <td style="width: 100px">
                                            PCS-$/Piece
                                        </td>
                                         
                                    </tr>
                                    </table>
                                    </li></ul></div></div></div><input id="ctl00_cphMainContent_rcbOrdActualUnits_ClientState" name="ctl00_cphMainContent_rcbOrdActualUnits_ClientState" type="hidden" />
			</div>

								</td>
								<td class="tableBorder" style="border-left: solid #43729f 2px;">
								    <div id="ctl00_cphMainContent_rcbOrdChargeItem" class="RadComboBox RadComboBox_Default " style="width:150px;display:-moz-inline-stack;">
				<table cellpadding="0" cellspacing="0" summary="combobox" border="0" style="border-width:0;">
					<tr>
						<td class="rcbInputCell rcbInputCellLeft" style="width:100%;"><input class="rcbInput" type="text" id="ctl00_cphMainContent_rcbOrdChargeItem_Input" name="ctl00$cphMainContent$rcbOrdChargeItem" value="FREIGHT (FLAT)" style="text-decoration:;"></input></td><td class="rcbArrowCell rcbArrowCellRight rcbArrowCellHidden"><a id="ctl00_cphMainContent_rcbOrdChargeItem_Arrow" style="overflow: hidden;display: block;position: relative;outline: none;">select</a></td>
					</tr>
				</table><div class="rcbSlide" style="z-index:6000;"><div id="ctl00_cphMainContent_rcbOrdChargeItem_DropDown" class="RadComboBoxDropDown RadComboBoxDropDown_Default" style="display:none;width:350px;"><div id="ctl00_cphMainContent_rcbOrdChargeItem_Header" class="rcbHeader">

                                    <table style="width: 350px" cellspacing="0" cellpadding="0">
                                    <tr>
                                        
                                        <td style="width: 100px">
                                            Name</td>
                                        <td style="width: 100px">
                                            Code</td>
                                        <td style="width: 100px">
                                            Unit</td>

                                        <td style="width: 50px">
                                            Quantity</td>
                                        
                                    </table>
                                    </div><div class="rcbScroll rcbWidth" style="height:100px;width:100%;"><ul class="rcbList" style="width:350px;list-style:none;margin:0;padding:0;zoom:1;"><li class="rcbItem ">
                                    <table style="width: 350px" cellspacing="0" cellpadding="0">
                                     <tr>
                                        <td style="width: 100px">
                                            FREIGHT (COUNT)
                                        </td>

                                        <td style="width: 100px">
                                            LHC
                                        </td>
                                        <td style="width: 100px">
                                            $/Piece
                                        </td>
                                        <td style="width: 50px">
                                            0
                                        </td>
                                         
                                    </tr>

                                    </table>
                                    </li><li class="rcbItem ">
                                    <table style="width: 350px" cellspacing="0" cellpadding="0">
                                     <tr>
                                        <td style="width: 100px">
                                            FREIGHT (DISTANCE)
                                        </td>
                                        <td style="width: 100px">
                                            LHD
                                        </td>

                                        <td style="width: 100px">
                                            $/Mile
                                        </td>
                                        <td style="width: 50px">
                                            0
                                        </td>
                                         
                                    </tr>
                                    </table>
                                    </li><li class="rcbItem ">
                                    <table style="width: 350px" cellspacing="0" cellpadding="0">

                                     <tr>
                                        <td style="width: 100px">
                                            FREIGHT (FLAT)
                                        </td>
                                        <td style="width: 100px">
                                            LHF
                                        </td>
                                        <td style="width: 100px">
                                            Flat
                                        </td>

                                        <td style="width: 50px">
                                            1
                                        </td>
                                         
                                    </tr>
                                    </table>
                                    </li><li class="rcbItem ">
                                    <table style="width: 350px" cellspacing="0" cellpadding="0">
                                     <tr>
                                        <td style="width: 100px">

                                            FREIGHT (TIME)
                                        </td>
                                        <td style="width: 100px">
                                            LHT
                                        </td>
                                        <td style="width: 100px">
                                            $/Hour
                                        </td>
                                        <td style="width: 50px">
                                            0
                                        </td>

                                         
                                    </tr>
                                    </table>
                                    </li><li class="rcbItem ">
                                    <table style="width: 350px" cellspacing="0" cellpadding="0">
                                     <tr>
                                        <td style="width: 100px">
                                            FREIGHT (WEIGHT)
                                        </td>
                                        <td style="width: 100px">

                                            LHW
                                        </td>
                                        <td style="width: 100px">
                                            $/100 lbs
                                        </td>
                                        <td style="width: 50px">
                                            0
                                        </td>
                                         
                                    </tr>
                                    </table>

                                    </li></ul></div></div></div><input id="ctl00_cphMainContent_rcbOrdChargeItem_ClientState" name="ctl00_cphMainContent_rcbOrdChargeItem_ClientState" type="hidden" />
			</div>
								</td>
								<td>
								    <span id="ctl00_cphMainContent_tbxOrdChargeQty_wrapper" class="RadInput_Default" style="white-space:nowrap;"><input type="text" value="1.00" id="ctl00_cphMainContent_tbxOrdChargeQty_text" name="ctl00_cphMainContent_tbxOrdChargeQty_text" class="riTextBox riEnabled" style="width:50px;" /><input style="visibility:hidden;margin:-18px 0 0 0;width:1px;height:1px;overflow:hidden;border:0;padding:0;" id="ctl00_cphMainContent_tbxOrdChargeQty" class="rdfd_" value="1" type="text" /><input style="visibility:hidden;margin:-18px 0 0 0;width:1px;height:1px;overflow:hidden;border:0;padding:0;" id="ctl00_cphMainContent_tbxOrdChargeQty_Value" class="rdfd_" name="ctl00$cphMainContent$tbxOrdChargeQty" value="1" type="text" /><input id="ctl00_cphMainContent_tbxOrdChargeQty_ClientState" name="ctl00_cphMainContent_tbxOrdChargeQty_ClientState" type="hidden" /></span>
								</td>
								<td class="tableBorder" style="border-left: solid #43729f 2px;">
								    <input name="ctl00$cphMainContent$tbxOrdRateUnit" type="text" value="Flat" id="ctl00_cphMainContent_tbxOrdRateUnit" disabled="disabled" class="shaded" style="width:80px;" />
								</td>

								<td>
								    <span id="ctl00_cphMainContent_tbxOrdRate_wrapper" class="RadInput_Default" style="white-space:nowrap;"><input type="text" value="0.00" id="ctl00_cphMainContent_tbxOrdRate_text" name="ctl00_cphMainContent_tbxOrdRate_text" class="riTextBox riEnabled" style="width:75px;" /><input style="visibility:hidden;margin:-18px 0 0 0;width:1px;height:1px;overflow:hidden;border:0;padding:0;" id="ctl00_cphMainContent_tbxOrdRate" class="rdfd_" value="0" type="text" /><input style="visibility:hidden;margin:-18px 0 0 0;width:1px;height:1px;overflow:hidden;border:0;padding:0;" id="ctl00_cphMainContent_tbxOrdRate_Value" class="rdfd_" name="ctl00$cphMainContent$tbxOrdRate" value="0" type="text" /><input id="ctl00_cphMainContent_tbxOrdRate_ClientState" name="ctl00_cphMainContent_tbxOrdRate_ClientState" type="hidden" /></span>
								</td>
								<td class="tableBorder" style="border-left: solid #43729f 2px;">
								    <select name="ctl00$cphMainContent$ddlCurrency" id="ctl00_cphMainContent_ddlCurrency">
				<option selected="selected" value="US$">US$</option>
				<option value="CA$">CA$</option>
				<option value="UNK">UNKNOWN</option>

			</select>
								    
								</td>
							</tr>
							</table>
						</td>
					</tr>
					</table>
				</td>

		    </tr>
            </table>
      
		</div>
		    <!-- END MIDDLE BORDER TABLE -->
		</td>
	</tr>
	<tr>
		<td>
			<table class="bodyContainer" align="center" border="0" cellpadding="5" 
                cellspacing="0" style="width: 90%">

			<tr>
				<td width="25%" bgcolor="#FFFFFF" valign="top">
					<table border="0" cellpadding="5" cellspacing="0" width="100%">
					<tr><td class="tableBorder"><h3>Order Remarks</h3></td></tr>
					<tr><td class="tableBorder">
					        <span id="ctl00_cphMainContent_tbxOrdRemarks_wrapper" class="RadInput_Default" style="white-space:nowrap;"><textarea rows="3" cols="100" id="ctl00_cphMainContent_tbxOrdRemarks_text" name="ctl00_cphMainContent_tbxOrdRemarks_text" class="riTextBox riEnabled" style="width:225px;"></textarea><textarea id="ctl00_cphMainContent_tbxOrdRemarks" name="ctl00$cphMainContent$tbxOrdRemarks" class="rdfd_" style="visibility:hidden;margin:-18px 0 0 0;width:1px;height:1px;overflow:hidden;border:0;padding:0;" cols="100" rows="3"></textarea><input id="ctl00_cphMainContent_tbxOrdRemarks_ClientState" name="ctl00_cphMainContent_tbxOrdRemarks_ClientState" type="hidden" /></span>
                            <span id="ctl00_cphMainContent_lblAcc" style="color:White;"></span>

                            <input type="hidden" name="ctl00$cphMainContent$hdShipperCode" id="ctl00_cphMainContent_hdShipperCode" />
                            <input type="hidden" name="ctl00$cphMainContent$hdConsigneeCode" id="ctl00_cphMainContent_hdConsigneeCode" />
                            <input type="hidden" name="ctl00$cphMainContent$hdBilltoCode" id="ctl00_cphMainContent_hdBilltoCode" />
					    </td>
					</tr>
					</table>
				</td>
				<td width="40%" bgcolor="#EDEDED" valign="top">
				    <div id="ctl00_cphMainContent_UpdatePanel2">

			
					<table border="0" cellpadding="5" cellspacing="0" style="width: 400px">
					<tr><td class="tableBorder"><h3>Reference Numbers</h3></td></tr>
					<tr><td class="tableBorder">
					    <div id="ctl00_cphMainContent_rgOrdReference" class="RadGrid RadGrid_TIISkin" style="width:390px;">

			<table class="MasterTable_TIISkin" cellspacing="0" border="0" id="ctl00_cphMainContent_rgOrdReference_ctl00" style="width:100%;border-collapse:collapse;table-layout:auto;empty-cells:show;">
	<colgroup>
		<col />
		<col />

		<col />
		<col />
	</colgroup>
<thead>
		<tr>
			<th scope="col" class="GridHeader_TIISkin">Type</th><th scope="col" class="GridHeader_TIISkin">Reference #</th><th scope="col" class="GridHeader_TIISkin">&nbsp;</th><th scope="col" class="GridHeader_TIISkin">&nbsp;</th>
		</tr>
	</thead><tfoot>

		<tr class="GridCommandRow_TIISkin">
			<td colspan="4">
                        <a id="ctl00_cphMainContent_rgOrdReference_ctl00_ctl03_ctl01_lnkAddRef" href="javascript:__doPostBack('ctl00$cphMainContent$rgOrdReference$ctl00$ctl03$ctl01$lnkAddRef','')">
                        <img alt="Add Reference" src="images/btnAdd.gif" style="border:0px;padding:2px;" /> 
                            Add Reference Number</a>
                        </td>
		</tr>
	</tfoot><tbody>
	<tr class="rgNoRecords">

		<td colspan="4" style="text-align:left;"><div style="width:;">No records to display.</div></td>
	</tr>
	</tbody>

</table><input id="ctl00_cphMainContent_rgOrdReference_ClientState" name="ctl00_cphMainContent_rgOrdReference_ClientState" type="hidden" />
				</div>
			
					</td></tr>
					</table>
					
		</div>

				</td>
				<td valign="top">
					<table border="0" cellpadding="2" cellspacing="2">
					<tr>
						<td bgcolor="#EDEDED" colspan="2" align="right" style="width: 80px" class="tableBorder"><font class="big">
                            Line Haul</font></td>
						<td bgcolor="#EDEDED" align="right" class="tableBorder">
						<span id="ctl00_cphMainContent_lblLineHaul" style="color:Green;">$0.00</span>

						</td>
					</tr>
					<tr>
						<td bgcolor="#EDEDED" colspan="2" align="right"  class="tableBorder"><font class="big">
                            Accessorials</font></td>
						<td bgcolor="#EDEDED" align="right" class="tableBorder">
						<span id="ctl00_cphMainContent_lblAccessorials" style="color:Green;">$0.00</span></td>
					</tr>

					<tr>
						<td bgcolor="#EDEDED" colspan="2" align="right" class="tableBorder">
						<div id="ctl00_cphMainContent_divFlag" style="Display:none"><img id="ctl00_cphMainContent_imgFlag" src="Images/redFlagIcon.gif" alt="Please contact the Credit Department at 412-788-8878 option 5 then option 2." style="border-width:0px;" />&nbsp;<font class="big">Total = </font></div>
					    <div id="ctl00_cphMainContent_divNoFlag" style="Display:block"><font class="big">Total = </font></div>
						</td>
						<td bgcolor="#EDEDED" align="right" class="tableBorder">
						<span id="ctl00_cphMainContent_lblTotal" style="color:Green;font-weight:bold;">$0.00</span></td>

					</tr>
					</table>
					<input type="hidden" name="ctl00$cphMainContent$hdLineHaul" id="ctl00_cphMainContent_hdLineHaul" />
					<input type="hidden" name="ctl00$cphMainContent$hdAcc" id="ctl00_cphMainContent_hdAcc" />
					<input type="hidden" name="ctl00$cphMainContent$hdTotal" id="ctl00_cphMainContent_hdTotal" />
				</td>
			</tr>
			</table>
		</td>

	</tr>



	<tr>
		<td>
			<table class="bodyContainer" align="center" border="0" width="98%">
			<tr>
				<td width="100%" bgcolor="#EDEDED">
					<table border="0">

					<tr>
						<td width="200"><a id="ctl00_cphMainContent_hfSaveNew2" href="javascript:__doPostBack('ctl00$cphMainContent$hfSaveNew2','')"><img src="images/buttonSaveNew.png" id="ctl00_cphMainContent_Button2" border="0" /></a></td>
						<td><a href="#" id="ctl00_cphMainContent_hfCopy2" onclick="CopyOrderOption(); return false;"></a></td>
						<td></td>
						<td width="100%" align="right"><a id="ctl00_cphMainContent_hfSave" href="javascript:__doPostBack('ctl00$cphMainContent$hfSave','')"><img src="images/buttonAcc.png" id="ctl00_cphMainContent_btnSave" border="0" /></a>
						<a href="#" id="ctl00_cphMainContent_hfCanel" onclick="ConfirmCancel();"><img src="images/buttonExit.png" id="ctl00_cphMainContent_btnCancel" border="0" /></a></td>
					</tr>
					</table>
				</td>

			</tr>
			</table>
		</td>
	</tr>
</table>

	</div>

</div> 

<!-----***************************************javascript*******************************************-->
   <script type="text/javascript">
    function conFunction()
    { 
      //return 'Are you sure you want to navigate away from this page?';
    }
    window.onbeforeunload = conFunction;
    //function to call the PCMiler and get the miles
    function GetMiles() 
    { 
        
        var ShipperCity=$find("ctl00_cphMainContent_rcbOrdShipperCity");
         var ConsigneeCity=$find("ctl00_cphMainContent_rcbOrdConsigneeCity");
         var hdSaveOrder = document.getElementById("ctl00_cphMainContent_hdSaveOrder");
        
        var startPoint=ShipperCity.get_text();
        var endPoint=ConsigneeCity.get_text();
        if(startPoint != "" && endPoint != "")
        {
            if(startPoint != "UNKNOWN" && endPoint != "UNKNOWN")
            {
                hdSaveOrder.value="1";
                PageMethods.GetMileage(startPoint, endPoint, CallSuccess, CallFailed);
                
            }
        }
    }
    
    function OpenCompInfo(compType)
    {
        var compCode="";
        var hdCompCode="";
        if(compType=="shipper")
        {
            hdCompCode=document.getElementById("ctl00_cphMainContent_hdShipperCode");
            compCode=hdCompCode.value;
        }else{
            hdCompCode=document.getElementById("ctl00_cphMainContent_hdConsigneeCode");
            compCode=hdCompCode.value;
        }
        var url='CompanyInfoPopup.aspx?CompID='+compCode
        if(compCode != "")
        {
            popWin(url,'win', '450','350','1');
        }else{
            if(compType=="shipper")
            {
            alert("Please select the shipper to view the company information.");
            }else{
            alert("Please select the consignee to view the company information.");
            }
        }
       
    }
    function popWin(mypage, myname, w, h, scroll) 
    { 
	var winl = (screen.width - w) / 2; 
	var wint = (screen.height - h) / 2; 
	winprops = 'height='+h+',width='+w+',top='+wint+',left='+winl+',scrollbars=no,resizable=no'; 
	win = window.open(mypage, myname, winprops);
    }
    
    // set the destination textbox value with the ContactName
    function CallSuccess(res)
    { 
       var tbxMiles = document.getElementById("ctl00_cphMainContent_tbxOrdMiles"); 
        if (tbxMiles != undefined && tbxMiles != null) 
        { 
            tbxMiles.value = res; 
        } 
        
        var days = ((res*1) / 500) + 1;
        var Pickup=$find("ctl00_cphMainContent_rdtOrdPUDateTime");
        var Delivery=$find("ctl00_cphMainContent_rdtOrdDeliveryDateTime");
                    
                
       var pickupDate= new Date(Pickup.get_selectedDate());
       pickupDate.setDate(pickupDate.getDate() +days);
       Delivery.set_selectedDate(pickupDate);
    }
    // alert message on some failure
    function CallFailed(res)
    {
        alert(res.get_message());
    }
    
     function PUDateChanged(sender, args)
        {
            
            
             if (args.get_newDate() != null) 
            {
                 var miles=0;
                 var tbxMiles = document.getElementById("ctl00_cphMainContent_tbxOrdMiles"); 
                 if (tbxMiles != undefined && tbxMiles != null) 
                 { 
                    miles=tbxMiles.value; 
                   
                 } 
                  var days = ((miles*1) / 500) + 1;
                  var deliveryObj=$find("ctl00_cphMainContent_rdtOrdDeliveryDateTime");
                  var tempDate=new Date(args.get_newDate());
                  tempDate.setDate(tempDate.getDate() +days);
                  if(deliveryObj != null)
                  {
                      deliveryObj.set_selectedDate(tempDate);
                  }                
            } 
        }
    
     function CalculateLineHaul()  
    {  
        var ChargeQty=document.getElementById("ctl00_cphMainContent_tbxOrdChargeQty");
        var Rate=document.getElementById("ctl00_cphMainContent_tbxOrdRate");
       
        var RateUnit=document.getElementById("ctl00_cphMainContent_tbxOrdRateUnit");
        var LHaulCharge=document.getElementById("ctl00_cphMainContent_lblLineHaul");
        var Acc=document.getElementById("ctl00_cphMainContent_lblAccessorials");
        var TotalCharge=document.getElementById("ctl00_cphMainContent_lblTotal");
        var AccCharge=document.getElementById("ctl00_cphMainContent_lblAcc");
        
        var hdLineHaul=document.getElementById("ctl00_cphMainContent_hdLineHaul");
        var hdAcc=document.getElementById("ctl00_cphMainContent_hdAcc");
        var hdTotal=document.getElementById("ctl00_cphMainContent_hdTotal");
       
        var valueAcc=AccCharge.innerHTML;
        var value1= ChargeQty.value;
        var value2= Rate.value;   
        var result = value1*value2;  
        if (RateUnit.value == "$/100 lbs")
        {
            result=result/100.00;
        }
       // LinehaulCharge.value=CurrencyFormatted(result);  
        
        //generate the linehaul acc string
         
        var accChrg=CurrencyFormatted(valueAcc);
        var ordTotal=0;
        ordTotal=result*1+accChrg*1;        
        LHaulCharge.innerHTML ="$"+CurrencyFormatted(result);
        Acc.innerHTML ="$"+CurrencyFormatted(accChrg);
        TotalCharge.innerHTML ="$"+CurrencyFormatted(ordTotal);
        var creditAvalailable=document.getElementById("ctl00_cphMainContent_txtCreditAvailable");
        var divFlag=document.getElementById("ctl00_cphMainContent_divFlag");
        var divNoFlag=document.getElementById("ctl00_cphMainContent_divNoFlag");
        TotalCharge.style.color="Green";
        var creditAvalailableValue=0
        divFlag.style.display = "none";
        divNoFlag.style.display = "none";
        hdLineHaul.value=LHaulCharge.innerHTML;
        hdAcc.value=Acc.innerHTML;
        hdTotal.value=TotalCharge.innerHTML;
        
        if(creditAvalailable.value != "")
        {
            creditAvalailableValue=creditAvalailable.value * 1.00;
            if(ordTotal > creditAvalailableValue)
            {
                 TotalCharge.style.color="Red";
                
                 divFlag.style.display = "block";
            }else{
                 divNoFlag.style.display = "block";
            }
        }else{
            if(ordTotal > 0)
            {
                TotalCharge.style.color="Red";
                divFlag.style.display = "block";
            }else{
                divNoFlag.style.display = "block";
            }
        }
        
       
    }
    
    function CurrencyFormatted(amount)
    {
	    var i = parseFloat(amount);
	    if(isNaN(i)) { i = 0.00; }
	    var minus = '';
	    if(i < 0) { minus = '-'; }
	    i = Math.abs(i);
	    i = parseInt((i + .005) * 100);
	    i = i / 100;
	    s = new String(i);
	    if(s.indexOf('.') < 0) { s += '.00'; }
	    if(s.indexOf('.') == (s.length - 2)) { s += '0'; }
	    s = minus + s;
	    return s;
    }
    // end of function CurrencyFormatted()

    function onAgentCodeSelectedIndexChanged(sender, eventArgs)
    {
       var item = eventArgs.get_item();
       var itemvalue=sender.get_value();
      
       var mySplit=itemvalue.split("|");
       var orderNumberPrefix=mySplit[1];
       var txtOrderNumber=$find("ctl00_cphMainContent_tbxOrdOrderNumber");
       var orderNumber=txtOrderNumber.get_value();
       if(orderNumber != "" && orderNumberPrefix != "")
       {
            var firstLetter=orderNumber.substring(0,1);
            if(isNaN(firstLetter))
            {
            
                orderNumber=orderNumber.replace(firstLetter, orderNumberPrefix);   
            }else{ 
                orderNumber=orderNumberPrefix+orderNumber.substring(0, 11);
            }
            txtOrderNumber.set_value(orderNumber);
       }
           
    }
    
    function onAgentCodeTextChanged(sender, eventArgs)
    {
       var agentCode=sender.get_text();
       agentCode=agentCode.toUpperCase();
       var AgentCodeObj=$find("ctl00_cphMainContent_rcbOrdAgent");
       var item=AgentCodeObj.findItemByText(agentCode);
       if(item != null)
       {
            
           item.select();
           AgentCodeObj.set_text(agentCode);
           var itemvalue=item.get_value();
           var mySplit=itemvalue.split("|");
           var orderNumberPrefix=mySplit[1];
           var txtOrderNumber=$find("ctl00_cphMainContent_tbxOrdOrderNumber");
           var orderNumber=txtOrderNumber.get_value();
            if(orderNumber != "" && orderNumberPrefix != "")
            {
                var firstLetter=orderNumber.substring(0,1);
                if(isNaN(firstLetter))
                {
            
                    orderNumber=orderNumber.replace(firstLetter, orderNumberPrefix);   
                }else{ 
                    orderNumber=orderNumberPrefix+orderNumber.substring(0, 11);
                }
                txtOrderNumber.set_value(orderNumber);
            }
       }
    }


    function onBillToSelectedIndexChanged(sender, eventArgs)
    {
           var item = eventArgs.get_item();
           var itemvalue=sender.get_value();
            var mySplit=itemvalue.split("|");
            var creditLimit=document.getElementById("ctl00_cphMainContent_txtCreditLimit");
            var creditAvalailable=document.getElementById("ctl00_cphMainContent_txtCreditAvailable");
            var hdBilltoCode=document.getElementById("ctl00_cphMainContent_hdBilltoCode");
            var ValidBillTo=document.getElementById("ctl00_cphMainContent_lblOrdBillToValid");
            if(ValidBillTo != null)
            {
                ValidBillTo.innerHTML="";
                ValidBillTo.visible=false;
            }
            creditLimit.value=  mySplit[1]; 
            creditAvalailable.value=  mySplit[2]; 
            hdBilltoCode.value=mySplit[0];
            
        CalculateLineHaul();
           
    }
    function onBillToTextChanged(sender, eventArgs)
    {
           var billto=sender.get_text();
           var itemvalue=sender.get_value();
            var mySplit=itemvalue.split("|");
             var creditLimit=document.getElementById("ctl00_cphMainContent_txtCreditLimit");
            var creditAvalailable=document.getElementById("ctl00_cphMainContent_txtCreditAvailable");
            var hdBilltoCode=document.getElementById("ctl00_cphMainContent_hdBilltoCode");
            var BillToCode=$find("ctl00_cphMainContent_rcbOrdBillToCode");
            var item=BillToCode.findItemByText(billto.toUpperCase());
            var ValidBillTo=document.getElementById("ctl00_cphMainContent_lblOrdBillToValid");
            if(ValidBillTo != null)
            {
                ValidBillTo.innerHTML="";
                ValidBillTo.visible=false;
            }
            if(item != null)
            {
                item.select();
                itemvalue=item.get_value();
                mySplit=itemvalue.split("|");
                creditLimit.value=  mySplit[1]; 
                creditAvalailable.value=  mySplit[2]; 
                hdBilltoCode.value=mySplit[0];
            }else{
                creditLimit.value= ""; 
                creditAvalailable.value= ""; 
                hdBilltoCode.value="UNKNOWN";
            }   
            CalculateLineHaul();    
    }
    
    function onShipperSelectedIndexChanged(sender, eventArgs)
    {

           var item = eventArgs.get_item();
           var itemvalue=sender.get_value();
            var mySplit=itemvalue.split("|");
           var hdShipperCode=document.getElementById("ctl00_cphMainContent_hdShipperCode");
           var ShipperCity=$find("ctl00_cphMainContent_rcbOrdShipperCity");
           var ShipperCityObj=document.getElementById("ctl00_cphMainContent_rcbOrdShipperCity");
           var ValidShipper=document.getElementById("ctl00_cphMainContent_lblOrdShipperValid");
           //var ShipperInfo=document.getElementById("ctl00_cphMainContent_btnShipperCompInfo");
            if(ValidShipper != null)
            {
                ValidShipper.innerHTML="";
                ValidShipper.visible=false;
            }
            //ShipperName.innerHTML=  mySplit[0];
            ShipperCity.set_text(mySplit[1]);
            hdShipperCode.value=mySplit[0];
            if(sender.get_text() == "UNKNOWN" || sender.get_text() =="")
            {
                ShipperCityObj.disabled=false;
                
            }else{
                
                ShipperCityObj.disabled=true;
                GetMiles();
                
            }
            
             
    }
    
    function onShipperBlur(sender, eventArgs)
    {
        var shipper=sender.get_text();
        shipper=shipper.toUpperCase();
        var hdShipperCode=document.getElementById("ctl00_cphMainContent_hdShipperCode");
         var ShipperCity=$find("ctl00_cphMainContent_rcbOrdShipperCity");
         var ShipperCityObj=document.getElementById("ctl00_cphMainContent_rcbOrdShipperCity");
         var ValidShipper=document.getElementById("ctl00_cphMainContent_lblOrdShipperValid");
         if(ValidShipper != null)
         {
            ValidShipper.innerHTML="";
            ValidShipper.visible=false;
         }
        if(shipper=="UNKNOWN" || shipper=="")
         {
            ShipperCityObj.disabled=false;
            ShipperCity.set_text("UNKNOWN");
         }
    }
    
    function onShipperTextChanged(sender, eventArgs)
    {
  
         var shipper=sender.get_text();
         shipper=shipper.toUpperCase();
         var hdShipperCode=document.getElementById("ctl00_cphMainContent_hdShipperCode");
         var ShipperCity=$find("ctl00_cphMainContent_rcbOrdShipperCity");
         var ShipperCityObj=document.getElementById("ctl00_cphMainContent_rcbOrdShipperCity");
         var ValidShipper=document.getElementById("ctl00_cphMainContent_lblOrdShipperValid");
         if(ValidShipper != null)
         {
            ValidShipper.innerHTML="";
            ValidShipper.visible=false;
         }
         
         if(shipper=="UNKNOWN" || shipper=="")
         {
            ShipperCityObj.disabled=false;
            ShipperCity.set_text("UNKNOWN");
         }else{
            var ShipperCode=$find("ctl00_cphMainContent_rcbOrdShipperCode");
            var item=ShipperCode.findItemByText(shipper);
            if(item != null)
            {
                item.select();
                ShipperCode.set_text(shipper);
                var itemvalue=item.get_value();
                var mySplit=itemvalue.split("|");
                
                hdShipperCode.value=mySplit[0];
                ShipperCity.set_text(mySplit[1]);
                if(shipper == "UNKNOWN" || shipper=="")
                {
                    ShipperCityObj.disabled=false;
                
                }else{
                    ShipperCityObj.disabled=true;
                    GetMiles();
                }
            }
        }
             
    }
    
    function onShipperCitySelectedIndexChanged(sender, eventArgs)
    {
           var item = eventArgs.get_item();
           var itemvalue=sender.get_text();
           var ValidShipper=document.getElementById("ctl00_cphMainContent_lblOrdShipperValid");
            if(ValidShipper != null)
            {
                ValidShipper.innerHTML="";
                ValidShipper.visible=false;
            }
            if(sender.get_text() != "UNKNOWN")
            {
                GetMiles(sender);
            }
             
    }
    
    function onShipperCityTextChanged(sender, eventArgs)
    {
         var itemvalue=sender.get_text();
         var ValidShipper=document.getElementById("ctl00_cphMainContent_lblOrdShipperValid");
         if(ValidShipper != null)
         {
            ValidShipper.innerHTML="";
            ValidShipper.visible=false;
         }

         if(sender.get_text() != "UNKNOWN")
         {
            GetMiles(sender);
         }
             
    }
    
    
    
     function onConsigneeCitySelectedIndexChanged(sender, eventArgs)
     {
        var item = eventArgs.get_item();
        var itemvalue=sender.get_text();
        var ValidConsignee=document.getElementById("ctl00_cphMainContent_lblOrdConsigneeValid");
        if(ValidConsignee != null)
        {
            ValidConsignee.innerHTML="";
            ValidConsignee.visible=false;
        }
        
        if(sender.get_text() != "UNKNOWN")
        {
           GetMiles();
        }
             
    }
    
     function onConsigneeCityTextChanged(sender, eventArgs)
     {
        var itemvalue=sender.get_text();
        var ValidConsignee=document.getElementById("ctl00_cphMainContent_lblOrdConsigneeValid");
        if(ValidConsignee != null)
        {
            ValidConsignee.innerHTML="";
            ValidConsignee.visible=false;
        }
        if(sender.get_text() != "UNKNOWN")
        {
            GetMiles();
        }
             
    }
     function onConsigneeSelectedIndexChanged(sender, eventArgs)
    {
           var item = eventArgs.get_item();
           var itemvalue=sender.get_value();
            var mySplit=itemvalue.split("|");
           var ConsigneeCity=$find("ctl00_cphMainContent_rcbOrdConsigneeCity");
           var hdConsigneeCode=document.getElementById("ctl00_cphMainContent_hdConsigneeCode");
           var ConsigneeCityObj=document.getElementById("ctl00_cphMainContent_rcbOrdConsigneeCity");
            var ValidConsignee=document.getElementById("ctl00_cphMainContent_lblOrdConsigneeValid");
            ConsigneeCity.set_text(mySplit[1]);
            hdConsigneeCode.value=mySplit[0];
            if(ValidConsignee != null)
            {
                ValidConsignee.innerHTML="";
                ValidConsignee.visible=false;
            }
            if(sender.get_text() == "UNKNOWN" || sender.get_text()=="")
            {
                ConsigneeCityObj.disabled=false;
               
            }else{
                ConsigneeCityObj.disabled=true;
                
                 GetMiles();
            }
    }
    
    function onConsigneeTextChanged(sender, eventArgs)
    {
        var consignee=sender.get_text();
        consignee=consignee.toUpperCase();
        var ConsigneeCode=$find("ctl00_cphMainContent_rcbOrdConsigneeCode");
        var item=ConsigneeCode.findItemByText(consignee);
        var ConsigneeCity=$find("ctl00_cphMainContent_rcbOrdConsigneeCity");
        var hdConsigneeCode=document.getElementById("ctl00_cphMainContent_hdConsigneeCode");
        var ConsigneeCityObj=document.getElementById("ctl00_cphMainContent_rcbOrdConsigneeCity");
        var ValidConsignee=document.getElementById("ctl00_cphMainContent_lblOrdConsigneeValid");
        if(ValidConsignee != null)
        {
            ValidConsignee.innerHTML="";
            ValidConsignee.visible=false;
        }
        if(consignee=="UNKNOWN" || consignee=="")
        {
             ConsigneeCityObj.disabled=false;
             ConsigneeCity.set_text("UNKNOWN");
        }else
        {
            if(item != null)
            {
                item.select();
                ConsigneeCode.set_text(consignee);
                var itemvalue=item.get_value();
                var mySplit=itemvalue.split("|");
          
                ConsigneeCity.set_text(mySplit[1]);
                hdConsigneeCode.value=mySplit[0];
                if(consignee == "UNKNOWN" || consignee=="")
                {
                    ConsigneeCityObj.disabled=false;
                
                }else{
                    ConsigneeCityObj.disabled=true;
                    GetMiles();
                }
            }
         }
    }
    
    function disableShipperCityState(sender, eventArgs)
    {
        var ShipperCityObj=document.getElementById("ctl00_cphMainContent_rcbOrdShipperCity");
        ShipperCityObj.disabled=true;
    }
    
     function disableConsigneeCityState(sender, eventArgs)
    {
        var ConsigneeCityObj=document.getElementById("ctl00_cphMainContent_rcbOrdConsigneeCity");
        ConsigneeCityObj.disabled=true;
    }
    
    function onChargeItemSelectedIndexChanged(sender, eventArgs)
    {
           var item = eventArgs.get_item();
           var itemvalue=sender.get_value();
           
            var mySplit=itemvalue.split("|");
            var ChargeQty=document.getElementById("ctl00_cphMainContent_tbxOrdChargeQty");
            var RateUnit=document.getElementById("ctl00_cphMainContent_tbxOrdRateUnit");
          
            RateUnit.value=mySplit[0];
    }
    
    function onChargeItemTextChanged(sender, eventArgs)
    {
          var chargeItem=sender.get_text();
             chargeItem=chargeItem.toUpperCase();
            var OrdChargeItem=$find("ctl00_cphMainContent_rcbOrdChargeItem");
            var item=OrdChargeItem.findItemByText(chargeItem);
            if(item != null)
            {
                item.select();
           var itemvalue=item.get_value();
           
            var mySplit=itemvalue.split("|");
            var ChargeQty=document.getElementById("ctl00_cphMainContent_tbxOrdChargeQty");
            var RateUnit=document.getElementById("ctl00_cphMainContent_tbxOrdRateUnit");
           
            RateUnit.value=mySplit[0];
            }
    }
    
    function CommodityTextChanged(sender, eventArgs)
    {
        var commodityText=sender.get_text();
        commodityText=commodityText.toUpperCase();
        if(commodityText != "" && commodityText != "UNKNOWN")
        {
         var OrdCommodityItem=$find("ctl00_cphMainContent_rcbOrdCommodity");
            var item=OrdCommodityItem.findItemByText(commodityText);
            var ValidCommodity=document.getElementById("ctl00_cphMainContent_lblValidCommodity");
            if(item != null)
            {
                item.select();
                ValidCommodity.innerHTML="";
            }else{
                ValidCommodity.innerHTML="Invalid Commodity.";
            }
         }
    }
    
    function CommoditySelectedIndexChanged(sender, eventArgs) 
    {
         var ValidCommodity=document.getElementById("ctl00_cphMainContent_lblValidCommodity");
        ValidCommodity.innerHTML="";
       
    }
    
    function TrailerTypeTextChanged(sender, eventArgs)
    {
        var TrailerTypeText=sender.get_text();
        TrailerTypeText=TrailerTypeText.toUpperCase();
        if(TrailerTypeText != "" && TrailerTypeText != "UNKNOWN")
        {
         var OrdTrailerType=$find("ctl00_cphMainContent_rcbOrdTrailerType");
            var item=OrdTrailerType.findItemByText(TrailerTypeText);
             var lblValid=$find("ctl00_cphMainContent_lblValidTrailerType");
              var ValidTrailerType=document.getElementById("ctl00_cphMainContent_lblValidTrailerType");
      
            if(item != null)
            {
                item.select();
               ValidTrailerType.innerHTML="";
                
            }else{
             ValidTrailerType.innerHTML="Invalid Trailer Type";
            }
         }
    }
    
    function TrailerTypeSelectedIndexChanged(sender, eventArgs) 
    {
        var ValidTrailerType=document.getElementById("ctl00_cphMainContent_lblValidTrailerType");
        ValidTrailerType.innerHTML="";
    }
    
    function HighLightComboText(sender, eventArgs) 
    { 
           sender.get_inputDomElement().select();
    }

   
    
    function StopRequesting(comboBox)
    {
        
        if(comboBox != null)
        {
            if(comboBox.get_text().length <3)
            {
                //return false if the number of the typed characters is less than 3
                return true;
            }
            else
            { 
              return false;
            }
        }else{
       
        return true;
        }
    }

    
    function ConfirmCancel()
    {
        var ans=confirm("Are you sure you want to Exit this page?");
        if(ans)
        {
           var OrderTabs =$find("ctl00_cphChildNav_radOrderTabs");
           var myTab = OrderTabs.findTabByText("My Available Loads");
           if(myTab != null)
           {
           window.location="order_Available.aspx";
           }else{
            window.location="ordersearch.aspx";
            }
        }
        
    }
    
    function PostOrder()
    {
        var hdOrderID = document.getElementById("ctl00_cphMainContent_hdOrderHeaderID");
        var orderID=hdOrderID.value;
        if(orderID != "")
        {
           window.open("Order_Post.aspx?orderID=" + orderID, "PostOrder","location=no,status=no,scrollbars=yes,width=800,height=600"); 
        }
    }
                
    function CopyOrderOption()
        {
             try{
                    var hdOrderID = document.getElementById("ctl00_cphMainContent_hdOrderHeaderID");
                   var orderID=hdOrderID.value;
                   if(orderID != "")
                   {
                   window.open("Order_Copy.aspx?orderID=" + orderID, "CopyOrder","location=no,status=no,scrollbars=yes,width=800,height=600"); 
                   }
                }
                catch(e)
                {
                    alert(e);
                }
                
         }
         
         function CancelOrder()
        {
             try{
                   var hdOrderID = document.getElementById("ctl00_cphMainContent_hdOrderIDNumber");
                   var orderID=hdOrderID.value;
                   if(orderID != "")
                   {
                   window.open("Order_Cancel.aspx?orderID=" + orderID, "OrderCancelLog","location=no,status=no,scrollbars=no,width=500,height=300");  
                   }
                }
                catch(e)
                {
                    alert(e);
                }
                
         } 
         function Confirm(sender, eventArgs)
         {
         
            var tab = eventArgs.get_tab(); 
            var hdOrderID = document.getElementById("ctl00_cphMainContent_hdOrderHeaderID");
            var orderID=hdOrderID.value;
            var tabName=tab.get_text();
            var hdSaveOrder = document.getElementById("ctl00_cphMainContent_hdSaveOrder");
            var saveOrder=hdSaveOrder.value;
           
            if(saveOrder=="1")
            {
               if (orderID=="")
               {
                var ans=confirm("Would you like to save this order before leave the page?");
            
                    if(!ans)
                    {
                    
                        tab.set_postBack(false); 
                        if(tabName=="Credit")
                        {
                            window.location="Order_Credit.aspx";
                        }else if(tabName=="Compliance")
                        {
                            window.location="Order_Compliance.aspx";
                        }else if(tabName=="Accessorials")
                        {
                            window.location="Order_Accessorials.aspx?ord_hdrnumber=" + orderID;
                        }else if(tabName=="Stops")
                        {
                            window.location="Order_Stops.aspx?ord_hdrnumber=" + orderID;
                        }else if(tabName=="Assignments")
                        {
                            window.location="Order_Assignment.aspx?ord_hdrnumber=" + orderID;
                        }else if(tabName=="Notes")
                        {
                            window.location="Order_Notes.aspx?ord_hdrnumber=" + orderID;
                        }else if(tabName=="Summary")
                        {
                            window.location="OrderSummary.aspx?ord_hdrnumber=" + orderID;
                        }else if(tabName=="My Available Loads")
                        {
                            window.location="Order_Available.aspx";
                        }else if(tabName=="My Trucks")
                        {
                            window.location="Order_MyTruckBoard.aspx";
                        }else if(tabName=="Search")
                        {
                            window.location="OrderSearch.aspx";
                        }
                    }
                 }
            }else{
                    tab.set_postBack(false); 
                    if(tabName=="Credit")
                    {
                        window.location="Order_Credit.aspx";
                    }else if(tabName=="Compliance")
                    {
                        window.location="Order_Compliance.aspx";
                    }else if(tabName=="Accessorials")
                    {
                        window.location="Order_Accessorials.aspx?ord_hdrnumber=" + orderID;
                    }else if(tabName=="Stops")
                    {
                        window.location="Order_Stops.aspx?ord_hdrnumber=" + orderID;
                    }else if(tabName=="Assignments")
                    {
                        window.location="Order_Assignment.aspx?ord_hdrnumber=" + orderID;
                    }else if(tabName=="Notes")
                    {
                        window.location="Order_Notes.aspx?ord_hdrnumber=" + orderID;
                    }else if(tabName=="Summary")
                    {
                        window.location="OrderSummary.aspx?ord_hdrnumber=" + orderID;
                    }else if(tabName=="My Available Loads")
                    {
                        window.location="Order_Available.aspx";
                    }else if(tabName=="My Trucks")
                    {
                        window.location="Order_MyTruckBoard.aspx";
                    }
                    else if(tabName=="Search")
                    {
                        window.location="OrderSearch.aspx";
                    }
                
            }
            

         }
        
</script>

          <div id="ctl00_cphMainContent_RadAjaxLoadingPanel1" style="display:none;height:75px;width:75px;">
	
     <table style="width:100%;height:100%;">
        <tr style="height:100%"><td align="center" valign="middle" style="width:100%"> 
            <div style="background-color:White; width:150px; height:50px; border-style:none; border-color:blue; border-width:1px">
            <h2>Loading ...</h2>
              <br />  <img src="Images/loader.gif" style="margin-top:10px;" alt="&nbsp;" /><br />
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
WebForm_AutoFocus('ctl00_cphMainContent_rcbOrdAgent');Sys.Application.initialize();
Sys.Application.add_init(function() {
    $create(Telerik.Web.UI.RadTabStrip, {"_postBackReference":"__doPostBack(\u0027ctl00$radTabs\u0027,\u0027{0}\u0027)","_selectedIndex":3,"_skin":"WebBlue","causesValidation":false,"clientStateFieldID":"ctl00_radTabs_ClientState","selectedIndexes":["3"],"tabData":[{},{},{},{},{}]}, null, null, $get("ctl00_radTabs"));
});
Sys.Application.add_init(function() {
    $create(Telerik.Web.UI.RadTabStrip, {"_postBackReference":"__doPostBack(\u0027ctl00$cphChildNav$radOrderTabs\u0027,\u0027{0}\u0027)","_selectedIndex":5,"_skin":"TIISkin","causesValidation":false,"clientStateFieldID":"ctl00_cphChildNav_radOrderTabs_ClientState","selectedIndexes":["5"],"tabData":[{},{},{},{},{},{},{"enabled":false},{"enabled":false},{"enabled":false},{"enabled":false},{"enabled":false}]}, {"tabSelecting":Confirm}, null, $get("ctl00_cphChildNav_radOrderTabs"));
});
Sys.Application.add_init(function() {
    $create(Telerik.Web.UI.RadTextBox, {"_focused":false,"clientStateFieldID":"ctl00_cphMainContent_tbxOrdOrderNumber_ClientState","enabled":true,"styles":{HoveredStyle: ["background-color:#DBE0E6;width:100px;", "riTextBox riHover"],InvalidStyle: ["background-color:#DBE0E6;width:100px;", "riTextBox riError"],DisabledStyle: ["background-color:#DBE0E6;width:100px;", "riTextBox riDisabled"],FocusedStyle: ["background-color:#DBE0E6;width:100px;", "riTextBox riFocused"],EmptyMessageStyle: ["background-color:#DBE0E6;width:100px;", "riTextBox riEmpty"],ReadOnlyStyle: ["background-color:#DBE0E6;width:100px;", "riTextBox riRead"],EnabledStyle: ["background-color:#DBE0E6;width:100px;", "riTextBox riEnabled"]}}, null, null, $get("ctl00_cphMainContent_tbxOrdOrderNumber"));
});

WebForm_InitCallback();Sys.Application.add_init(function() {
    $create(Telerik.Web.UI.RadComboBox, {"_dropDownWidth":350,"_height":100,"_isTemplated":true,"_showDropDownOnTextboxClick":false,"_skin":"Default","_text":"AT541","_uniqueId":"ctl00$cphMainContent$rcbOrdAgent","_value":"","_virtualScroll":false,"allowCustomText":true,"clientStateFieldID":"ctl00_cphMainContent_rcbOrdAgent_ClientState","collapseAnimation":"{\"type\":12,\"duration\":200}","enableLoadOnDemand":true,"highlightTemplatedItems":true,"itemData":[{"text":"AB541","value":"AB541","attributes":{"Name":"FW AGENCY BOISE","CityState":"EAGLE,ID/"}},{"text":"AT541","value":"AT541","attributes":{"Name":"FW AGENCY BOISE","CityState":"EAGLE,ID/"}}]}, {"load":HighLightComboText,"selectedIndexChanged":onAgentCodeSelectedIndexChanged,"textChange":onAgentCodeTextChanged}, null, $get("ctl00_cphMainContent_rcbOrdAgent"));
});
Sys.Application.add_init(function() {
    $create(Telerik.Web.UI.RadComboBox, {"_dropDownWidth":550,"_height":100,"_isTemplated":true,"_showDropDownOnTextboxClick":false,"_skin":"Default","_text":"","_uniqueId":"ctl00$cphMainContent$rcbOrdBillToCode","_value":"","_virtualScroll":false,"clientStateFieldID":"ctl00_cphMainContent_rcbOrdBillToCode_ClientState","collapseAnimation":"{\"type\":12,\"duration\":200}","enableLoadOnDemand":true,"highlightTemplatedItems":true,"itemData":[]}, {"selectedIndexChanged":onBillToSelectedIndexChanged,"textChange":onBillToTextChanged}, null, $get("ctl00_cphMainContent_rcbOrdBillToCode"));
});
Sys.Application.add_init(function() {
    $create(Telerik.Web.UI.RadComboBox, {"_dropDownWidth":550,"_height":100,"_isTemplated":true,"_skin":"Default","_text":"","_uniqueId":"ctl00$cphMainContent$rcbOrdShipperCode","_value":"","_virtualScroll":false,"clientStateFieldID":"ctl00_cphMainContent_rcbOrdShipperCode_ClientState","collapseAnimation":"{\"type\":12,\"duration\":200}","enableLoadOnDemand":true,"highlightTemplatedItems":true,"itemData":[]}, {"selectedIndexChanged":onShipperSelectedIndexChanged,"textChange":onShipperTextChanged}, null, $get("ctl00_cphMainContent_rcbOrdShipperCode"));
});
Sys.Application.add_init(function() {
    $create(Telerik.Web.UI.RadComboBox, {"_dropDownWidth":250,"_height":250,"_showDropDownOnTextboxClick":false,"_skin":"Default","_text":"","_uniqueId":"ctl00$cphMainContent$rcbOrdShipperCity","_value":"","_virtualScroll":false,"clientStateFieldID":"ctl00_cphMainContent_rcbOrdShipperCity_ClientState","collapseAnimation":"{\"type\":12,\"duration\":200}","enableLoadOnDemand":true,"itemData":[]}, {"selectedIndexChanged":onShipperCitySelectedIndexChanged,"textChange":onShipperCityTextChanged}, null, $get("ctl00_cphMainContent_rcbOrdShipperCity"));
});
Sys.Application.add_init(function() {
    $create(Telerik.Web.UI.RadComboBox, {"_dropDownWidth":450,"_height":100,"_isTemplated":true,"_showDropDownOnTextboxClick":false,"_skin":"Default","_text":"","_uniqueId":"ctl00$cphMainContent$rcbOrdConsigneeCode","_value":"","_virtualScroll":false,"clientStateFieldID":"ctl00_cphMainContent_rcbOrdConsigneeCode_ClientState","collapseAnimation":"{\"type\":12,\"duration\":200}","enableLoadOnDemand":true,"highlightTemplatedItems":true,"itemData":[]}, {"itemsRequesting":StopRequesting,"selectedIndexChanged":onConsigneeSelectedIndexChanged,"textChange":onConsigneeTextChanged}, null, $get("ctl00_cphMainContent_rcbOrdConsigneeCode"));
});
Sys.Application.add_init(function() {
    $create(Telerik.Web.UI.RadComboBox, {"_dropDownWidth":250,"_height":250,"_showDropDownOnTextboxClick":false,"_skin":"Default","_text":"","_uniqueId":"ctl00$cphMainContent$rcbOrdConsigneeCity","_value":"","_virtualScroll":false,"clientStateFieldID":"ctl00_cphMainContent_rcbOrdConsigneeCity_ClientState","collapseAnimation":"{\"type\":12,\"duration\":200}","enableLoadOnDemand":true,"highlightTemplatedItems":true,"itemData":[]}, {"selectedIndexChanged":onConsigneeCitySelectedIndexChanged,"textChange":onConsigneeCityTextChanged}, null, $get("ctl00_cphMainContent_rcbOrdConsigneeCity"));
});
Sys.Application.add_init(function() {
    $create(Telerik.Web.UI.RadDateInput, {"_focused":false,"_originalValue":"9/29/2010 8:00:00 AM","_postBackEventReferenceScript":"__doPostBack(\u0027ctl00$cphMainContent$rdtOrdPUDateTime\u0027,\u0027\u0027)","clientStateFieldID":"ctl00_cphMainContent_rdtOrdPUDateTime_dateInput_ClientState","dateFormat":"MM/dd/yyyy HH:mm","dateFormatInfo":{"DayNames":["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],"MonthNames":["January","February","March","April","May","June","July","August","September","October","November","December",""],"AbbreviatedDayNames":["Sun","Mon","Tue","Wed","Thu","Fri","Sat"],"AbbreviatedMonthNames":["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec",""],"AMDesignator":"AM","PMDesignator":"PM","DateSeparator":"/","TimeSeparator":":","FirstDayOfWeek":0,"DateSlots":{"Month":0,"Year":2,"Day":1},"ShortYearCenturyEnd":2029,"TimeInputOnly":false},"displayDateFormat":"MM/dd/yyyy HH:mm","enabled":true,"incrementSettings":{InterceptArrowKeys:true,InterceptMouseWheel:true,Step:1},"styles":{HoveredStyle: ["width:100%;", "riTextBox riHover"],InvalidStyle: ["width:100%;", "riTextBox riError"],DisabledStyle: ["width:100%;", "riTextBox riDisabled"],FocusedStyle: ["width:100%;", "riTextBox riFocused"],EmptyMessageStyle: ["width:100%;", "riTextBox riEmpty"],ReadOnlyStyle: ["width:100%;", "riTextBox riRead"],EnabledStyle: ["width:100%;", "riTextBox riEnabled"]}}, {"valueChanged":PUDateChanged}, null, $get("ctl00_cphMainContent_rdtOrdPUDateTime_dateInput"));
});
Sys.Application.add_init(function() {
    $create(Telerik.Web.UI.RadCalendar, {"_DayRenderChangedDays":{},"_FormatInfoArray":[["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],["Sun","Mon","Tue","Wed","Thu","Fri","Sat"],["January","February","March","April","May","June","July","August","September","October","November","December",],["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec",],"dddd, MMMM dd, yyyy h:mm:ss tt","dddd, MMMM dd, yyyy","h:mm:ss tt","MMMM dd","ddd, dd MMM yyyy HH\':\'mm\':\'ss \'GMT\'","M/d/yyyy","h:mm tt","yyyy\'-\'MM\'-\'dd\'T\'HH\':\'mm\':\'ss","yyyy\'-\'MM\'-\'dd HH\':\'mm\':\'ss\'Z\'","MMMM, yyyy","AM","PM","/",":",0],"_ViewRepeatableDays":{},"_ViewsHash":{ctl00_cphMainContent_rdtOrdPUDateTime_calendar_Top : [[2010,9,1], 1]},"_calendarWeekRule":0,"_firstDayOfWeek":7,"_postBackCall":"__doPostBack(\u0027ctl00$cphMainContent$rdtOrdPUDateTime$calendar\u0027,\u0027@@\u0027)","clientStateFieldID":"ctl00_cphMainContent_rdtOrdPUDateTime_calendar_ClientState","enabled":true,"monthYearNavigationSettings":["Today","OK","Cancel","Date is out of range.","False"],"skin":"Gray","specialDaysArray":[],"stylesHash":{DayStyle: ["", ""],CalendarTableStyle: ["", "rcMainTable"],OtherMonthDayStyle: ["", "rcOtherMonth"],TitleStyle: ["", ""],SelectedDayStyle: ["", "rcSelected"],SelectorStyle: ["background-color:White;", ""],DisabledDayStyle: ["", "rcDisabled"],OutOfRangeDayStyle: ["", "rcOutOfRange"],WeekendDayStyle: ["", "rcWeekend"],DayOverStyle: ["", "rcHover"],FastNavigationStyle: ["", "RadCalendarMonthView_Gray"],ViewSelectorStyle: ["", "rcViewSel"]},"useColumnHeadersAsSelectors":false,"useRowHeadersAsSelectors":false}, null, null, $get("ctl00_cphMainContent_rdtOrdPUDateTime_calendar"));
});
Sys.Application.add_init(function() {
    $create(Telerik.Web.UI.RadTimeView, {"_ItemsCount":24,"_OwnerDatePickerID":"ctl00_cphMainContent_rdtOrdPUDateTime","_TimeOverStyleCss":"rcHover","clientStateFieldID":"ctl00_cphMainContent_rdtOrdPUDateTime_timeView_ClientState","itemStyles":{TimeStyle: ["", ""],AlternatingTimeStyle: ["", ""],HeaderStyle: ["", "rcHeader"],FooterStyle: ["", "rcFooter"],TimeOverStyle: ["", "rcHover"]}}, null, null, $get("ctl00_cphMainContent_rdtOrdPUDateTime_timeView"));
});
Sys.Application.add_init(function() {
    $create(Telerik.Web.UI.RadDateTimePicker, {"_PopupButtonSettings":{  ResolvedImageUrl : "/Images/iconCalendar2.gif", ResolvedHoverImageUrl : "/Images/iconCalendar2Hover.gif"},"_TimePopupButtonSettings":{  ResolvedImageUrl : "/Images/iconClock.png", ResolvedHoverImageUrl : "/Images/iconClock.png"},"_popupControlID":"ctl00_cphMainContent_rdtOrdPUDateTime_popupButton","_timePopupControlID":"ctl00_cphMainContent_rdtOrdPUDateTime_timePopupLink","clientStateFieldID":"ctl00_cphMainContent_rdtOrdPUDateTime_ClientState","focusedDate":"2010-09-29-00-00-00"}, null, {"calendar":"ctl00_cphMainContent_rdtOrdPUDateTime_calendar","dateInput":"ctl00_cphMainContent_rdtOrdPUDateTime_dateInput","timeView":"ctl00_cphMainContent_rdtOrdPUDateTime_timeView"}, $get("ctl00_cphMainContent_rdtOrdPUDateTime"));
});
Sys.Application.add_init(function() {
    $create(Telerik.Web.UI.RadDateInput, {"_focused":false,"_originalValue":"10/1/2010 8:00:00 AM","_postBackEventReferenceScript":"__doPostBack(\u0027ctl00$cphMainContent$rdtOrdDeliveryDateTime\u0027,\u0027\u0027)","clientStateFieldID":"ctl00_cphMainContent_rdtOrdDeliveryDateTime_dateInput_ClientState","dateFormat":"MM/dd/yyyy HH:mm","dateFormatInfo":{"DayNames":["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],"MonthNames":["January","February","March","April","May","June","July","August","September","October","November","December",""],"AbbreviatedDayNames":["Sun","Mon","Tue","Wed","Thu","Fri","Sat"],"AbbreviatedMonthNames":["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec",""],"AMDesignator":"AM","PMDesignator":"PM","DateSeparator":"/","TimeSeparator":":","FirstDayOfWeek":0,"DateSlots":{"Month":0,"Year":2,"Day":1},"ShortYearCenturyEnd":2029,"TimeInputOnly":false},"displayDateFormat":"MM/dd/yyyy HH:mm","enabled":true,"incrementSettings":{InterceptArrowKeys:true,InterceptMouseWheel:true,Step:1},"styles":{HoveredStyle: ["width:100%;", "riTextBox riHover"],InvalidStyle: ["width:100%;", "riTextBox riError"],DisabledStyle: ["width:100%;", "riTextBox riDisabled"],FocusedStyle: ["width:100%;", "riTextBox riFocused"],EmptyMessageStyle: ["width:100%;", "riTextBox riEmpty"],ReadOnlyStyle: ["width:100%;", "riTextBox riRead"],EnabledStyle: ["width:100%;", "riTextBox riEnabled"]}}, null, null, $get("ctl00_cphMainContent_rdtOrdDeliveryDateTime_dateInput"));
});
Sys.Application.add_init(function() {
    $create(Telerik.Web.UI.RadCalendar, {"_DayRenderChangedDays":{},"_FormatInfoArray":[["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],["Sun","Mon","Tue","Wed","Thu","Fri","Sat"],["January","February","March","April","May","June","July","August","September","October","November","December",],["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec",],"dddd, MMMM dd, yyyy h:mm:ss tt","dddd, MMMM dd, yyyy","h:mm:ss tt","MMMM dd","ddd, dd MMM yyyy HH\':\'mm\':\'ss \'GMT\'","M/d/yyyy","h:mm tt","yyyy\'-\'MM\'-\'dd\'T\'HH\':\'mm\':\'ss","yyyy\'-\'MM\'-\'dd HH\':\'mm\':\'ss\'Z\'","MMMM, yyyy","AM","PM","/",":",0],"_ViewRepeatableDays":{},"_ViewsHash":{ctl00_cphMainContent_rdtOrdDeliveryDateTime_calendar_Top : [[2010,9,1], 1]},"_calendarWeekRule":0,"_firstDayOfWeek":7,"_postBackCall":"__doPostBack(\u0027ctl00$cphMainContent$rdtOrdDeliveryDateTime$calendar\u0027,\u0027@@\u0027)","clientStateFieldID":"ctl00_cphMainContent_rdtOrdDeliveryDateTime_calendar_ClientState","enabled":true,"monthYearNavigationSettings":["Today","OK","Cancel","Date is out of range.","False"],"skin":"Gray","specialDaysArray":[],"stylesHash":{DayStyle: ["", ""],CalendarTableStyle: ["", "rcMainTable"],OtherMonthDayStyle: ["", "rcOtherMonth"],TitleStyle: ["", ""],SelectedDayStyle: ["", "rcSelected"],SelectorStyle: ["background-color:White;", ""],DisabledDayStyle: ["", "rcDisabled"],OutOfRangeDayStyle: ["", "rcOutOfRange"],WeekendDayStyle: ["", "rcWeekend"],DayOverStyle: ["", "rcHover"],FastNavigationStyle: ["", "RadCalendarMonthView_Gray"],ViewSelectorStyle: ["", "rcViewSel"]},"useColumnHeadersAsSelectors":false,"useRowHeadersAsSelectors":false}, null, null, $get("ctl00_cphMainContent_rdtOrdDeliveryDateTime_calendar"));
});
Sys.Application.add_init(function() {
    $create(Telerik.Web.UI.RadTimeView, {"_ItemsCount":24,"_OwnerDatePickerID":"ctl00_cphMainContent_rdtOrdDeliveryDateTime","_TimeOverStyleCss":"rcHover","clientStateFieldID":"ctl00_cphMainContent_rdtOrdDeliveryDateTime_timeView_ClientState","itemStyles":{TimeStyle: ["", ""],AlternatingTimeStyle: ["", ""],HeaderStyle: ["", "rcHeader"],FooterStyle: ["", "rcFooter"],TimeOverStyle: ["", "rcHover"]}}, null, null, $get("ctl00_cphMainContent_rdtOrdDeliveryDateTime_timeView"));
});
Sys.Application.add_init(function() {
    $create(Telerik.Web.UI.RadDateTimePicker, {"_PopupButtonSettings":{  ResolvedImageUrl : "/Images/iconCalendar2.gif", ResolvedHoverImageUrl : "/Images/iconCalendar2Hover.gif"},"_TimePopupButtonSettings":{  ResolvedImageUrl : "/Images/iconClock.png", ResolvedHoverImageUrl : "/Images/iconClock.png"},"_popupControlID":"ctl00_cphMainContent_rdtOrdDeliveryDateTime_popupButton","_timePopupControlID":"ctl00_cphMainContent_rdtOrdDeliveryDateTime_timePopupLink","clientStateFieldID":"ctl00_cphMainContent_rdtOrdDeliveryDateTime_ClientState","focusedDate":"2010-09-29-00-00-00"}, null, {"calendar":"ctl00_cphMainContent_rdtOrdDeliveryDateTime_calendar","dateInput":"ctl00_cphMainContent_rdtOrdDeliveryDateTime_dateInput","timeView":"ctl00_cphMainContent_rdtOrdDeliveryDateTime_timeView"}, $get("ctl00_cphMainContent_rdtOrdDeliveryDateTime"));
});
Sys.Application.add_init(function() {
    $create(Telerik.Web.UI.RadComboBox, {"_dropDownWidth":200,"_height":100,"_showDropDownOnTextboxClick":false,"_skin":"Default","_text":"","_uniqueId":"ctl00$cphMainContent$rcbOrdTrailerType","_value":"","_virtualScroll":false,"clientStateFieldID":"ctl00_cphMainContent_rcbOrdTrailerType_ClientState","collapseAnimation":"{\"type\":12,\"duration\":200}","enableLoadOnDemand":true,"highlightTemplatedItems":true,"itemData":[]}, {"selectedIndexChanged":TrailerTypeSelectedIndexChanged,"textChange":TrailerTypeTextChanged}, null, $get("ctl00_cphMainContent_rcbOrdTrailerType"));
});
Sys.Application.add_init(function() {
    $create(Telerik.Web.UI.RadComboBox, {"_dropDownWidth":0,"_height":100,"_showDropDownOnTextboxClick":false,"_skin":"Default","_text":"","_uniqueId":"ctl00$cphMainContent$rcbOrdCommodity","_value":"","_virtualScroll":false,"clientStateFieldID":"ctl00_cphMainContent_rcbOrdCommodity_ClientState","collapseAnimation":"{\"type\":12,\"duration\":200}","enableLoadOnDemand":true,"highlightTemplatedItems":true,"itemData":[]}, {"selectedIndexChanged":CommoditySelectedIndexChanged,"textChange":CommodityTextChanged}, null, $get("ctl00_cphMainContent_rcbOrdCommodity"));
});
Sys.Application.add_init(function() {
    $create(Telerik.Web.UI.RadNumericTextBox, {"_focused":false,"_originalValue":0,"clientStateFieldID":"ctl00_cphMainContent_tbxOrdActualQty_ClientState","enabled":true,"incrementSettings":{InterceptArrowKeys:true,InterceptMouseWheel:true,Step:1},"maxValue":2147483647,"minValue":0,"numberFormat":{"DecimalDigits":0,"DecimalSeparator":".","GroupSeparator":"","GroupSizes":3,"NegativePattern":"-n","NegativeSign":"-","PositivePattern":"n","AllowRounding":true,"KeepNotRoundedValue":true},"styles":{HoveredStyle: ["width:50px;", "riTextBox riHover"],InvalidStyle: ["width:50px;", "riTextBox riError"],DisabledStyle: ["width:50px;", "riTextBox riDisabled"],FocusedStyle: ["width:50px;", "riTextBox riFocused"],EmptyMessageStyle: ["width:50px;", "riTextBox riEmpty"],ReadOnlyStyle: ["width:50px;", "riTextBox riRead"],EnabledStyle: ["width:50px;", "riTextBox riEnabled"],NegativeStyle: ["width:50px;", "riTextBox riNegative"]}}, null, null, $get("ctl00_cphMainContent_tbxOrdActualQty"));
});
Sys.Application.add_init(function() {
    $create(Telerik.Web.UI.RadComboBox, {"_dropDownWidth":150,"_height":100,"_isTemplated":true,"_skin":"Default","_text":"FLT","_uniqueId":"ctl00$cphMainContent$rcbOrdActualUnits","_value":"FLT-Flat|RateBy","_virtualScroll":false,"clientStateFieldID":"ctl00_cphMainContent_rcbOrdActualUnits_ClientState","collapseAnimation":"{\"type\":12,\"duration\":200}","enableLoadOnDemand":true,"highlightTemplatedItems":true,"itemData":[{"text":"CWT","value":"CWT-$/100 lbs|RateBy","attributes":{"Name":"CWT-$/100 lbs"}},{"text":"FLT","value":"FLT-Flat|RateBy","selected":true,"attributes":{"Name":"FLT-Flat"}},{"text":"HR","value":"HR-$/Hour|RateBy","attributes":{"Name":"HR-$/Hour"}},{"text":"LBS","value":"LBS-$/Pound|RateBy","attributes":{"Name":"LBS-$/Pound"}},{"text":"MIL","value":"MIL-$/Mile|RateBy","attributes":{"Name":"MIL-$/Mile"}},{"text":"PCS","value":"PCS-$/Piece|RateBy","attributes":{"Name":"PCS-$/Piece"}}],"selectedIndex":1}, null, null, $get("ctl00_cphMainContent_rcbOrdActualUnits"));
});
Sys.Application.add_init(function() {
    $create(Telerik.Web.UI.RadComboBox, {"_dropDownWidth":350,"_height":100,"_isTemplated":true,"_skin":"Default","_text":"FREIGHT (FLAT)","_uniqueId":"ctl00$cphMainContent$rcbOrdChargeItem","_value":"Flat|FLT|1|LHF","_virtualScroll":false,"clientStateFieldID":"ctl00_cphMainContent_rcbOrdChargeItem_ClientState","collapseAnimation":"{\"type\":12,\"duration\":200}","enableLoadOnDemand":true,"highlightTemplatedItems":true,"itemData":[{"text":"FREIGHT (COUNT)","value":"$/Piece|PCS|0|LHC","attributes":{"Code":"LHC","Unit":"$/Piece","Quantity":"0"}},{"text":"FREIGHT (DISTANCE)","value":"$/Mile|MIL|0|LHD","attributes":{"Code":"LHD","Unit":"$/Mile","Quantity":"0"}},{"text":"FREIGHT (FLAT)","value":"Flat|FLT|1|LHF","selected":true,"attributes":{"Code":"LHF","Unit":"Flat","Quantity":"1"}},{"text":"FREIGHT (TIME)","value":"$/Hour|HR|0|LHT","attributes":{"Code":"LHT","Unit":"$/Hour","Quantity":"0"}},{"text":"FREIGHT (WEIGHT)","value":"$/100 lbs|CWT|0|LHW","attributes":{"Code":"LHW","Unit":"$/100 lbs","Quantity":"0"}}],"selectedIndex":2}, {"selectedIndexChanged":onChargeItemSelectedIndexChanged,"textChange":onChargeItemTextChanged}, null, $get("ctl00_cphMainContent_rcbOrdChargeItem"));
});
Sys.Application.add_init(function() {
    $create(Telerik.Web.UI.RadNumericTextBox, {"_focused":false,"_originalValue":1,"clientStateFieldID":"ctl00_cphMainContent_tbxOrdChargeQty_ClientState","enabled":true,"incrementSettings":{InterceptArrowKeys:true,InterceptMouseWheel:true,Step:1},"maxValue":2147483647,"minValue":0,"numberFormat":{"DecimalDigits":2,"DecimalSeparator":".","GroupSeparator":",","GroupSizes":3,"NegativePattern":"-n","NegativeSign":"-","PositivePattern":"n","AllowRounding":true,"KeepNotRoundedValue":true},"styles":{HoveredStyle: ["width:50px;", "riTextBox riHover"],InvalidStyle: ["width:50px;", "riTextBox riError"],DisabledStyle: ["width:50px;", "riTextBox riDisabled"],FocusedStyle: ["width:50px;", "riTextBox riFocused"],EmptyMessageStyle: ["width:50px;", "riTextBox riEmpty"],ReadOnlyStyle: ["width:50px;", "riTextBox riRead"],EnabledStyle: ["width:50px;", "riTextBox riEnabled"],NegativeStyle: ["width:50px;", "riTextBox riNegative"]}}, {"valueChanged":CalculateLineHaul}, null, $get("ctl00_cphMainContent_tbxOrdChargeQty"));
});
Sys.Application.add_init(function() {
    $create(Telerik.Web.UI.RadNumericTextBox, {"_focused":false,"_originalValue":0,"clientStateFieldID":"ctl00_cphMainContent_tbxOrdRate_ClientState","enabled":true,"incrementSettings":{InterceptArrowKeys:true,InterceptMouseWheel:true,Step:1},"maxValue":2147483647,"minValue":0,"numberFormat":{"DecimalDigits":2,"DecimalSeparator":".","GroupSeparator":",","GroupSizes":3,"NegativePattern":"-n","NegativeSign":"-","PositivePattern":"n","AllowRounding":true,"KeepNotRoundedValue":false},"styles":{HoveredStyle: ["width:75px;", "riTextBox riHover"],InvalidStyle: ["width:75px;", "riTextBox riError"],DisabledStyle: ["width:75px;", "riTextBox riDisabled"],FocusedStyle: ["width:75px;", "riTextBox riFocused"],EmptyMessageStyle: ["width:75px;", "riTextBox riEmpty"],ReadOnlyStyle: ["width:75px;", "riTextBox riRead"],EnabledStyle: ["width:75px;", "riTextBox riEnabled"],NegativeStyle: ["width:75px;", "riTextBox riNegative"]}}, {"valueChanged":CalculateLineHaul}, null, $get("ctl00_cphMainContent_tbxOrdRate"));
});
Sys.Application.add_init(function() {
    $create(Telerik.Web.UI.RadTextBox, {"_focused":false,"clientStateFieldID":"ctl00_cphMainContent_tbxOrdRemarks_ClientState","enabled":true,"maxLength":254,"styles":{HoveredStyle: ["width:225px;", "riTextBox riHover"],InvalidStyle: ["width:225px;", "riTextBox riError"],DisabledStyle: ["width:225px;", "riTextBox riDisabled"],FocusedStyle: ["width:225px;", "riTextBox riFocused"],EmptyMessageStyle: ["width:225px;", "riTextBox riEmpty"],ReadOnlyStyle: ["width:225px;", "riTextBox riRead"],EnabledStyle: ["width:225px;", "riTextBox riEnabled"]}}, null, null, $get("ctl00_cphMainContent_tbxOrdRemarks"));
});
Sys.Application.add_init(function() {
    $create(Telerik.Web.UI.RadGrid, {"ClientID":"ctl00_cphMainContent_rgOrdReference","ClientSettings":{"ShouldCreateRows":true,"DataBinding":{},"Selecting":{},"Scrolling":{},"Resizing":{},"ClientMessages":{}},"Skin":"TIISkin","UniqueID":"ctl00$cphMainContent$rgOrdReference","_activeRowIndex":"","_controlToFocus":"","_currentPageIndex":0,"_editIndexes":"[]","_embeddedSkin":false,"_gridTableViewsData":"[{\"ClientID\":\"ctl00_cphMainContent_rgOrdReference_ctl00\",\"UniqueID\":\"ctl00$cphMainContent$rgOrdReference$ctl00\",\"PageSize\":10,\"PageCount\":1,\"EditMode\":\"InPlace\",\"CurrentPageIndex\":0,\"VirtualItemCount\":0,\"AllowMultiColumnSorting\":false,\"IsItemInserted\":false,\"clientDataKeyNames\":[],\"_dataBindTemplates\":false,\"_selectedItemStyle\":\"\",\"_selectedItemStyleClass\":\"SelectedRow_TIISkin\",\"_columnsData\":[{\"UniqueName\":\"colType\",\"Resizable\":true,\"Reorderable\":true,\"Groupable\":true,\"ColumnType\":\"GridTemplateColumn\",\"Display\":true},{\"UniqueName\":\"colRef\",\"Resizable\":true,\"Reorderable\":true,\"Groupable\":true,\"ColumnType\":\"GridBoundColumn\",\"Display\":true},{\"UniqueName\":\"EditCommandColumn\",\"Resizable\":true,\"Reorderable\":true,\"Groupable\":false,\"ColumnType\":\"GridEditCommandColumn\",\"Display\":true},{\"UniqueName\":\"colDelete\",\"Resizable\":true,\"Reorderable\":true,\"Groupable\":false,\"ColumnType\":\"GridButtonColumn\",\"Display\":true}]}]","_masterClientID":"ctl00_cphMainContent_rgOrdReference_ctl00","allowMultiRowSelection":false,"clientStateFieldID":"ctl00_cphMainContent_rgOrdReference_ClientState"}, null, null, $get("ctl00_cphMainContent_rgOrdReference"));
});
Sys.Application.add_init(function() {
    $create(Telerik.Web.UI.RadAjaxLoadingPanel, {"initialDelayTime":0,"isSticky":false,"minDisplayTime":20,"transparency":0,"uniqueID":"ctl00$cphMainContent$RadAjaxLoadingPanel1","zIndex":90000}, null, null, $get("ctl00_cphMainContent_RadAjaxLoadingPanel1"));
});
//]]>
</script>

</form>
</body>
</html>