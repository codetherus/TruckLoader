{*   Copyright(c) 2009 by RSI. All rights reserved.
		 This is the screen Edit page template.
*}
{include file="pageheader.tpl"}
</head>
<body >
<div id="wrapper">
{include file="content_header.tpl"}
<div style="color:white; border-bottom:  1px solid green;">
<label>Archives:</label>
{$archivelist}
<input type="button" value="Select Archived Log File" 
onclick="xajax_DisplayArchivedLog(xajax.$('filelist').value)"/>
</div>
<div id="logdata" name="logdata" style="color: white">
{$editdata} 
</div>
{include file="footer.tpl"}
