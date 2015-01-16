{*   Copyright(c) 2009 by RSI. All rights reserved.
		 This is the uploadrecord display template
*}
<br/><br/>
<center>
<input type="button" value="Close" onclick="fb.end();"/><br/>
<span style="color:black"><h4>Last Upload File Record</h4></span>
</center>
<label style="color: black;">Agent:</label><input value="{$agent}"/>
<label style="color: black;">Unit:</label><input value="{$unit}"/><br/>
<label style="color: black;">Truck Num:</label> <input value="{$truck_number}"/> 
<label style="color: black;">Equipment:</label> <input value="{$equipment}"/><br/>
<label style="color: black;">Driver:</label> <input value="{$driver}"/> 
<label style="color: black;">Cell:</label> <input value="{$cell}"/><br/>
<label style="color: black;">Origin:</label> <input value="{$origin_city}, {$origin_state}"/> 
<label style="color: black;">Destination:</label> <input value="{$dest_city}, {$dest_state}"/><br/>
<label style="color: black;">Telephone:</label> <input value="{$telephone}"/>
<label style="color: black;">Delivery Date:</label> <input value="{$delivery_date}"/><br/>
<label style="color: black;">Comments:</label> <input size="50" value="{$comments}"/>