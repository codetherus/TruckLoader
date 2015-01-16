<?php
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
	"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel='stylesheet' href='scripts/JQueryUI/css/redmond/jquery-ui-1.8.6.custom.css'/>
<link rel='stylesheet' href='styles/queedi.global.css'/>
<script src="scripts/JQueryUI/js/jquery-1.4.2.min.js" type="text/javascript"></script>
<script src="scripts/JQueryUI/js/jquery-ui-1.8.6.custom.min.js" type="text/javascript"></script>
<script src="scripts/jquery.blockUI.js" type="text/javascript"></script>
<script>
  //jQuery ready setup function
  jQuery(document).ready(function(){
    //Setup the tabs     
    jQuery('#tabdiv').tabs(); 
   })
</script>
</head>
<body>
<div id="tabdiv">
    <ul>
      <li><a href="#tab1">Drivers</a></li>
      <li><a href="#tab2">Loads</a></li>
      <li><a href="#tab3">Todays Loads</a></li>
      <li><a href="#tab4">Calendar</a></li>
    </ul>
  <div id="tab1" class="tabstop">Drivers</div>
  <div id="tab2" class="tabstop">Loads</div>
  <div id="tab3" class="tabstop">Todays Loads</div>
  <div id="tab4" class="tabstop">
  <div style="border: 1px solid gray;">
  <script src="http://www.gmodules.com/ig/ifr?url=http://www.google.com/ig/modules/calendar3.xml&amp;up_calendarFeeds=1&amp;up_calendarColors=&amp;up_firstDay=0&amp;up_dateFormat=0&amp;up_timeFormat=1%3A00pm&amp;up_showDatepicker=1&amp;up_hideAgenda=0&amp;up_showEmptyDays=1&amp;up_showExpiredEvents=1&amp;synd=open&amp;w=300&amp;h=447&amp;title=Loads+by+Jake+Shared+Calendar&amp;lang=en&amp;country=ALL&amp;border=%23ffffff%7C3px%2C1px+solid+%23999999&amp;output=js"></script>
  </div>
  </div>
</div>

</body>
</html>