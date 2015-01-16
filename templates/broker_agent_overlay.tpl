{*   Copyright(c) 2009 by RSI. All rights reserved.
		 This is the broker agent management overlay
     for the loads page
*}
<div class="loadoverlay" id="brokeragentoverlay" name="brokeragentoverlay">
<form id="form4">
<center><h3>Broker Agent Maintenance</h3></center>
<label >Brokerage:</label><br/>
<span id='lbrokerage' name='lbrokerage'>{$brokerlist}</span><br/>
<label>Name:<br/>
<input type="text" id='agent_name' name='agent_name'/></label><br/>
<label>Phone:<br/>
<input type="text" id='oagent_phone' name='oagent_phone'/></label><br/>
<label>Fax:<br/>
<input type="text" id='agent_fax' name='agent_fax'/></label><br/>
<label>Email:<br/>
<input type="text" id='agent_email' name='agent_email'/></label><br/><br/>
</form>
<center>
<input type="button" value="Process" onclick="processAgent();"/>
<input type="button" value="Close" onclick="hideAgentOverlay()"/>
</center>
<br/><br/>
</div>