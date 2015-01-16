{*   Copyright(c) 2011 by RSI. All rights reserved.
		 Tabbed interface to loads by jake drivers and loads.
     Combines the 2 pages into one.
*}
{include file="pageheaderv2.tpl"}
<link type="text/css" src="JQueryUI/css/redmond/jquery-ui-1.8.5.custom.css>
<script language="javascript" src="JQueryUI/js/jquery-1.4.2.min.js"></script>
<script language="javascript" src="JQueryUI/js/jquery-ui-1.8.5.min.js"></script>
<script language="javascript" src="scripts/driversV3.js?v=1"></script>

{literal}
<style>
  label{
    text-align: left;
    font-size: 12px;
  }  

  .hidden{ display: none}   
	.flexigrid div.fbutton .add
		{
			background: url(css/images/add.png) no-repeat center left;
		}	

	.flexigrid div.fbutton .delete
		{
			background: url(css/images/close.png) no-repeat center left;
		}
</style>

{/literal}
</head>
<body>

<div id="floatboxcontent"></div>
<div id="wrapper" class="rc" style="margin-top: 20px;">
<div id="tabs">
  <ul>
  <li><a href="#driver_tab">Drivers</a></li>
  <li><a href="#load_tab">Loads</a></li>
  </ul
  <div id="driver_tab">Drivers here</div>
  <div id="loads_tab">Loads here</div>
</div>

{include file="footer.tpl"}

