<?php /* Smarty version 2.6.21, created on 2014-10-25 18:02:22
         compiled from driver_contacts.tpl */ ?>
<div id="drivercontacts" name = "drivercontacts">
<center>
<h3>Driver Contacts</h3>
</center>
<form id="form2" name="form2">
<label>Home:<input type="text" id="driverphone" name="driverphone"/></label><br/>
<label>Cell:<input type="text" id="drivercell" name="drivercell"/></label><br/>
<label>Fax:<input type="text" id="driverfax" name="driverfax"/></label><br/>
<label>Email:<input type="text" id="driveremail" name="driveremail"/></label><br/><br/>
<center>
<input type="button" value="Process" onclick="process_contacts('update')"/>
<input type="button" value="Close" onclick="hideContacts()"/> 
</center>
</form>
</div>