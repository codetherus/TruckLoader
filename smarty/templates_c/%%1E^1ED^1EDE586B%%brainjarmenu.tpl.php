<?php /* Smarty version 2.6.21, created on 2014-11-12 03:39:17
         compiled from brainjarmenu.tpl */ ?>
<!-- Menu bar. -->
<center>
    <div class="menuBar" style="width:60%; margin-top: 3px;">
        <a class="menuButton" href="index.php">Logoff</a>
        <a class="menuButton" href="searchv2.php">Search</a>
        <a class="menuButton" href="radius_searchv2.php">Radius Search</a>
        <a class="menuButton" href="drivers.php">Drivers</a>
        <a class="menuButton" href="loads.php">Loads</a>
        <a class="menuButton" href="todays_loadsV2.php">Todays Loads</a>
        <a class="menuButton" href="#" onclick="xajax_page_help('application')">Help</a>
        <a class="menuButton" href=""
           onclick="return buttonClick(event, 'miscMenu');"
           onmouseover="buttonMouseover(event, 'miscMenu');">Misc...</a>

        <a class="menuButton" href=""
           onclick="return buttonClick(event, 'adminMenu');"
           onmouseover="buttonMouseover(event, 'adminMenu');">Admin...</a>
    </div>
</center>
<!-- Main menus. -->

<div id="miscMenu" class="menu"
     onmouseover="menuMouseover(event)">
    <a class="menuItem" href="broker_editor.php">Brokers</a>
    <a class="menuItem" href="broker_agent_editor.php">Broker Agents</a>
    <a class="menuItem" href="phone_editor.php">Contacts</a>
    <a class="menuItem" href="reminders.php">Reminders</a>
	<a class="menuItem" href="map_broker_editor.php">Map Brokers/Customers</a>
    <a class="menuItem" href=""
       onclick="return false;"
       onmouseover="menuItemMouseover(event, 'miscMenu2');"
       ><span class="menuItemText">Themes</span><span class="menuItemArrow">&#9654;</span></a>
</div>

<div id="miscMenu2" class="menu">
    <a class="menuItem" href="" onclick="xajax_theme('truckloaderv2')">Default</a>
    <a class="menuItem" href="" onclick="xajax_theme('blue')">Blue</a>
    <a class="menuItem" href="" onclick="xajax_theme('rust')">Rust</a>
</div>

<div id="adminMenu" class="menu"
     onmouseover="menuMouseover(event)">
    <a class="menuItem" href="#" onclick="xajax_page_help('administration')">Admin.   Help</a>     
    <a class="menuItem" href="editors/options.php">Options</a>
    <a class="menuItem" href="user_editorv2.php">Users</a>
    <a class="menuItem" href="inbound_report_loader_V2.php">Daily Upload</a>
    <a class="menuItem" href="upload_log_viewer_v2.php">Upload Log Viewer</a>
    <a class="menuItem" href="corporate_spreadsheetv2.php">DAT Spreadsheet</a>
    <a class="menuItem" href="truckstopupload.php">Truckstop.com Upload</a>
    <a class="menuItem" href="loaduploader.php">Military Loads Processing</a>
    <a class="menuItem" href="menlo_worldwide_emails.php">Menlo Worldwide Emails</a>
    <a class="menuItem" href="reminder_processor.php">Start Tickler Processing</a>
</div>

