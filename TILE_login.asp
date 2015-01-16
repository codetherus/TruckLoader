<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head2"><title>
	TILT Login
</title>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<link href="CSS/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<form name="form2" method="post" action="Login.aspx" onsubmit="javascript:return WebForm_OnSubmit();" id="form2">
<div>
<input type="hidden" name="__LASTFOCUS" id="__LASTFOCUS" value="" />
<input type="hidden" name="__EVENTTARGET" id="__EVENTTARGET" value="" />
<input type="hidden" name="__EVENTARGUMENT" id="__EVENTARGUMENT" value="" />
<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="/wEPDwUINDU1MTQ3MzBkGAEFHl9fQ29udHJvbHNSZXF1aXJlUG9zdEJhY2tLZXlfXxYBBQtidXR0b25Mb2dpbrJybifBNbl6NVTIVNJyvzXZxAsM" />
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


<script src="/WebResource.axd?d=20j_ZqqJ_Vmax-3R1YJBjNLWmLolAhwVkZdKzQbcgi01&amp;t=634050896073162769" type="text/javascript"></script>
<script src="/WebResource.axd?d=bN8BJlm_9tn_yyR0LxBldA2&amp;t=634050896073162769" type="text/javascript"></script>
<script type="text/javascript">
//<![CDATA[
function WebForm_OnSubmit() {
if (typeof(ValidatorOnSubmit) == "function" && ValidatorOnSubmit() == false) return false;
return true;
}
//]]>
</script>

<div>

	<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="/wEWBQKywf3tDQKtq4C2AQLpiNL0DQL2q56PDwLJ2YScA61UGsmn9D+KP4DJrzh59++V3D3Y" />

</div>
<p align="center"><img src="Images/TILT2.gif" </p> 
<br/>
<p align="center">          
   <div id="pnlLogin" style="text-align:center;">
	
   <table cellpadding="2" cellspacing="2">
   <tr><td>&nbsp;</td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
   </tr>
   <tr><td>&nbsp;</td>

       <td align="left">Email:</td>
       <td align="left">
            <input name="textboxUsername" type="text" id="textboxUsername" class="standardText" style="height:20px;width:190px;" />
            <span id="RequiredFieldValidator1" style="color:Red;visibility:hidden;">Required!</span>
       </td>
   </tr>
   <tr><td>&nbsp;</td>
       <td align="left">Password:</td>

       <td align="left">
           <input name="textboxPassword" type="password" id="textboxPassword" class="standardText" style="height:20px;width:189px;" />
           <span id="RequiredFieldValidator2" style="color:Red;visibility:hidden;">Required!</span>
       </td>
   </tr>
   <tr><td>&nbsp;</td>
       <td>&nbsp;</td>
       <td align="left">

           <input type="image" name="buttonLogin" id="buttonLogin" src="Images/buttonLogin.png" onclick="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;buttonLogin&quot;, &quot;&quot;, true, &quot;&quot;, &quot;&quot;, false, false))" style="border-width:0px;" />
       </td>
   </tr>
   <tr><td>&nbsp;</td>
       <td>&nbsp;</td>
       <td align="left">
           <span id="labelMessage" style="color:Red;"></span>  <br />
           <a id="linkbuttonForgotPassword" href="javascript:__doPostBack('linkbuttonForgotPassword','')" style="color:#0033CC;text-decoration:underline;">Forgot Password</a>

       </td>
   </tr>
   
   </table>

</div>
</p>     
    
<script type="text/javascript">
//<![CDATA[
var Page_Validators =  new Array(document.getElementById("RequiredFieldValidator1"), document.getElementById("RequiredFieldValidator2"));
//]]>
</script>

<script type="text/javascript">
//<![CDATA[
var RequiredFieldValidator1 = document.all ? document.all["RequiredFieldValidator1"] : document.getElementById("RequiredFieldValidator1");
RequiredFieldValidator1.controltovalidate = "textboxUsername";
RequiredFieldValidator1.errormessage = "Required!";
RequiredFieldValidator1.evaluationfunction = "RequiredFieldValidatorEvaluateIsValid";
RequiredFieldValidator1.initialvalue = "";
var RequiredFieldValidator2 = document.all ? document.all["RequiredFieldValidator2"] : document.getElementById("RequiredFieldValidator2");
RequiredFieldValidator2.controltovalidate = "textboxPassword";
RequiredFieldValidator2.errormessage = "Required!";
RequiredFieldValidator2.evaluationfunction = "RequiredFieldValidatorEvaluateIsValid";
RequiredFieldValidator2.initialvalue = "";
//]]>
</script>


<script type="text/javascript">
//<![CDATA[

var Page_ValidationActive = false;
if (typeof(ValidatorOnLoad) == "function") {
    ValidatorOnLoad();
}

function ValidatorOnSubmit() {
    if (Page_ValidationActive) {
        return ValidatorCommonOnSubmit();
    }
    else {
        return true;
    }
}
        WebForm_AutoFocus('textboxUsername');//]]>

</script>
</form>
</body>
</html>
