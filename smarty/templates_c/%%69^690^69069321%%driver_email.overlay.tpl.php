<?php /* Smarty version 2.6.21, created on 2014-10-25 18:02:22
         compiled from driver_email.overlay.tpl */ ?>
<div id="drivermail" name="drivermail">
<center>
<h3>Send Email to Driver</h3>
</center>
<form id="form3" name='form3'>
<input type="hidden" id="emaildriverid" name="emaildriverid"/>
<input type="hidden" id="emailtext" name="emailtext"/>
<label style="text-align: left">To:</label><br>
<input size="70" id="mailto" name="mailto" readonly/><br/>
<label style="text-align: left">Email:</label><br>
<input size="70" id="demail" name="demail"/><br/>
<label style="text-align: left;">Subject:</label><br/>
<input id="esubject" name="esubject" size="70"/><br/>
<label style="text-align: left;">Message:</label><br/>

<div contenteditable="true" id="emessage" name="emessage"/></div><br/>
<br/>
<center>
<input type="button" value="Send" onclick="send_email()"/>
<input type="button" value="Close" onclick="hideEmail()"/>
</center>
<br/>
</form>
</div>
