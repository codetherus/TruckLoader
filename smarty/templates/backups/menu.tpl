{*   Copyright(c) 2009 by RSI. All rights reserved. *}
{* System Menu
	 See content_header for display control.
*}
<div class="chromestyle" id="chromemenu" >
<ul>
<li><a href="index.php">Main</a></li>
<li><a href="login.php">Login</a></li>
<li><a href="new_load.php">New Driver</a></li>
<li><a href="search.php">New Search</a></li>
<li><a href="todays_loads.php">Todays Drivers</a></li>
<li><a href="http://www.truckstop.com">Truck Stop</a></li>
<li><a href="pdf_inbound_report_loader.php">PDF Uploads</a></li>
{if $admin}
<li><a href="#" rel="dropmenu1">Admin</a></li>
{/if}
</ul>
</div>
<!-- Dropdown for the editor calls -->
<div id="dropmenu1" class="dropmenudiv">
<ul>
<li><a href="editors/options.php">Options</a></li>
<li><a href="editors/users.php">Users</a></li>
<li><a href="editors/truck_loader.php">Truck Loader</a></li>
<li><a href="editors/truck_inbound.php">Inbound Data</a></li>
<li><a href="inbound_report_loader.php">Daily Upload</a></li>

</ul>
</div>
<script type="text/javascript">
cssdropdown.startchrome("chromemenu")
</script>
