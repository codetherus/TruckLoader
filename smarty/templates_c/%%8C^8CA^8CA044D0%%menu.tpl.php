<?php /* Smarty version 2.6.21, created on 2014-07-10 21:19:46
         compiled from menu.tpl */ ?>
<div class="chromestyle" id="chromemenu" style="margin-top: 5px">
<ul>
<li><a href="xindex.php">Login</a></li>
<li><a href="radius_search.php">Radius Search</a></li>
<li><a href="new_load.php">New Driver</a></li>
<li><a href="search.php">New Search</a></li>
<li><a href="todays_loads.php">Todays Drivers</a></li>
<li><a href="http://www.truckstop.com">Truck Stop</a></li>
<?php if ($this->_tpl_vars['admin']): ?>
<li><a href="#" rel="dropmenu1">Admin</a></li>
<?php endif; ?>
</ul>
</div>
<!-- Dropdown for the editor calls -->
<div id="dropmenu1" class="dropmenudiv">
<ul>
<li><a href="editors/options.php">Options</a></li>
<li><a href="user_editor.php">Users</a></li>
<li><a href="editors/truck_loader.php">Truck Loader</a></li>
<li><a href="editors/truck_inbound.php">Inbound Data</a></li>
<li><a href="editors/user_history.php">User History</a></li>
<li><a href="inbound_report_loader.php">Daily Upload</a></li>
<li><a href="upload_log_viewer.php">Upload Log Viewer</a></li>
<li><a href="dateupdater.php">Fix Numeric Date Fields</a></li>
<li><a href="query_log_viewer.php">View Query Logs</a></li>
<li><a href="dateupdater.php">Fix Numeric Date Fields</a></li>
<li><a href="drivers.php">New Drivers Page</a></li>
<li><a href="loads.php">New Loads Page</a></li>
<li><a href="reminders.php">Reminders</a></li>
<li><a href="todays_loadsV2.php">New Todays loads</a></li>
<li><a href="corporate_spreadsheetv2.php">New DAT Spreadsheet</a></li>
<li><a href="broker_editor.php">Broker Management</a></li>
</ul>
</div>
<script type="text/javascript">
cssdropdown.startchrome("chromemenu")
</script>