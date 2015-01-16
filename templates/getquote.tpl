{*   Copyright(c) 2009 by RSI. All rights reserved.
		 This is the quote request page template
*}
{include file="pageheader.tpl"}
{literal}
<style>
	fieldset{
		width: 65%; 
		border: none;
	}
	label{
		width: 150px;
    font-weight: bold;
	}
	#content{
		width: 80%;
		padding:20px;"
		border: 3px solid black;
	}
  input{
    margin-bottom: 6px;
    }
body{
	background-image: url("./images/droppedImage.gif") ;
	background-position: top center;
	background-repeat: no-repeat;
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
<body onload="xajax.$('searchvalue').focus()">
<div id="floatboxcontent"></div> {* div for floatbox displays *}

<div id="wrapper" style="margin-top: 150px">
{include file="content_header.tpl"}

<form id="form1">
<fieldset style="margin-left: 200px;">
<label><b><em>*Required</em></b></label><br/>
<label>Contact Name:<em>*</em></label>
<input id="contactname" name="contactname"/><br/>
<label>Phone Number:<em>*</em></label>
<input id="phone" name="phone"/><br/>

<label>Email:<em>*</em></label>
<input id="email" name="email"/><br/>
<label>Company<em>*</em>:</label>
<input id="company" name="company"/><br/>
<label>Commodity:<em>*</em></label>
<input id="commodity" name="commodity"/><br/>
<label>Weight:<em>*</em></label>
<input id="weight" name="weight"/><br/>
<label>Origin:<em>*</em></label>
<input id="origin" name="origin"/><br/>
<label>Destination:<em>*</em></label>
<input id="destination" name="destination"/><br/>
<label>Self Loader Truck:</label>&nbsp;{$selfloadertruck}<br/>
<div style="margin-left: 160px">
</div>
<label>Comments:</label>
<center>
<textarea id="comments" name="comments" rows="5" cols="65"></textarea><br/>

<input type="button" value="Submit" onclick="xajax_sendQuoteRequest(xajax.getFormValues('form1'));"/>
<input type="reset" value="Reset Form"/>
</center>

</fieldset>
</form>
</div>
{include file="footer.tpl"}
