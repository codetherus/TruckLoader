{*   Copyright(c) 2009 by RSI. All rights reserved.
		 Broker driver list page template
*}

{include file="pageheader.tpl"}

{literal}
<style>
body{
	background-image: url("./images/droppedImage.gif") ;
	background-position: top center;
	background-repeat: no-repeat;
}
</style>
<script>
    jQuery(document).ready(function(){    
      jQuery("#flex").flexigrid();      
    });        
</script>
{/literal}                                   

</head>
<body>
<br><br><br><br><br><br><br>
<div id="wrapper" style="margin-top: 45px;">
<center>
{$drivers}
</center>
{include file="footer.tpl"}
