<?php /* Smarty version 2.6.21, created on 2014-02-12 22:49:26
         compiled from broker_editor_overlay.tpl */ ?>
<div class="loadoverlay" id="brokereditoroverlay">
<center><h3>Broker Maintenance</h3></center>
<form id="formbrokeroverlay">
<input type="hidden", id="recid" name="recid" value=""/> <label style="color:black;text-align:left;">Company:<br/>
<input id='company' name='company'/></label><br/>
<label style="color:black;">Address:<br/>
<input id='address1' name='address1'/></label><br/>
<label style="color:black;">
<input id='address2' name='address2'/></label><br/>
<label style="color:black;">City:<br/>
<input id='city' name='city'/></label><br/>
<label style="color:black;">State:<br/>
<input id='state' name='state'/></label><br/>
<label style="color:black;">Zip:<br/>
<input id='zip' name='zip'/></label><br/>
<label style="color:black;">Phone:<br/>
<input id='phone' name='phone'/></label><br/>
<label style="color:black;">Cell:<br/>
<input id='cell' name='cell'/></label><br/>
<label style="color:black;">Fax:<br/>
<input id='fax' name='fax'/></label><br/>
<label>Notes:<br/>
<textarea id="notes" name="notes" rows="3" cols="30"></textarea></label><br/>
<center>
<input type="button" value="Read" onclick="handleBrokerOverlay('read');"/>
<input type="button" value="Process" onclick="handleBrokerOverlay('process');"/>
<input type="button" value="Close" onclick="handleBrokerOverlay('hide');"/>
</form>
</div>