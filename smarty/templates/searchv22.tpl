{*   Copyright(c) 2009 by RSI. All rights reserved.
		 This is the screen lookup/search page template.
*}
{include file="pageheaderv2.tpl"}
{include file="common_scripts.tpl"}
{literal}
<style>
	fieldset{
		width: 75%; 
    margin-left: auto;    
    margin-right: auto;
	}
	label{
		width: 250px;
	}
	#content{
		width: 80%;
		padding:20px;"
		border: 3px solid black;
	}
	
</style>
<script>
	function sendPage()
	{
		fb.end();
		xajax_FindLoads(xajax.getFormValues('form1'));
		return false;
	}
	
</script>	
{/literal}
</head>
<body>
<div id="wrapper" style="margin-top: 150px;">
{* global search results display *}
{include file="content_header_v2.tpl"}
<div id="searchresults" name="searchresults">
<?php echo FindLoads(); ?>
</div>
</div>

{include file="footer.tpl"}
