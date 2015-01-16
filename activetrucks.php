<?php ?>
<!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="JQueryUI/js/jquery-1.4.2.min.js"></script>
<script>
  var rollinterval = 1000;      //ms between display scrolls.
  var updateDelay = 60000;  //ms between database reads.
  /*
    The ready function invoked the display update
    and table roll functions.
  */
  jQuery(document).ready(function()
	{
    updateDisplay();
    //rollTable();
  });
  /*
    updateDisplay uses the jQuery post function
    to do a query for the active drivers and their
    current truck loads by calling autotrucks.php.
    It returns a table of the active drivers.
    The ajax call is made every updateDelay milliseconds.
  */
  function updateDisplay()
  {
    jQuery.post("autotrucks.php",
                        function(data)
                        {
                          if (data.length > 0)
                          { 
                            jQuery("#content").html(data);
                            updateDateUpdated()
                          }
                        }
                )
    
    setTimeout('updateDisplay()',updateDelay); 
  }
  function updateDateUpdated()
  {
    var d = new Date();
    var hour = d.getHours();
    if (hour < 10)
      hour = '0' + hour;
    var min = d.getMinutes();
    if (min < 10)
      min = '0' + min;
    var sec = d.getSeconds();
    if (sec < 10)
      sec = '0' + sec;
    var thetime = hour + ':' + min + ':' + sec;
    jQuery("#info").html('Last update: ' + thetime );
  }
    
  /*
    rollTable appends the first row in the table to
    the end of the table causing it to be removed 
    from the top. The table scrolls itself.
    It repeats every rollinterval miliseconds.
  */
  function rollTable()
  {
    
    $('tbody').append($('tr:first'));
    setTimeout('rollTable()', rollinterval);
  }       
</script>
<style>
  body{
    background-color: black;
    color: white;
    font-size: smaller;
  }
  table{
    border-collapse: collapse;
    border: 1px solid green;
  }
  td, th{
    border: 1px solid green;
  }
  #content{
    margin: 0 auto;
  }
  #listing, #info{
    width: 800px; 
    margin: 0 auto;
  }
</style>
</head>
<body>
<div id="info" style="text-align:center;"></div>
<div id="listing">
<div id="content"></div>
</div>

</body>
</html>