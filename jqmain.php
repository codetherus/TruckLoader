<!doctype html>
<html lang="en">
  <head>
    <title>JQ Truck Loader</title>
    <meta charset="utf-8">
  <link rel="stylesheet" src="styles/basestyle.css"/>
  <link rel="stylesheet" src="styles/truckloader.css"/>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/dark-hive/jquery-ui.css">
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  <style>
   .ui-widget{
    font-size: 0.9em;
    }
   .ui-widget-content{
    background: #000000;
    border: none;
    font-size: 0.9em;
    }
    .ui-tabs{
      padding:0;
    }
  </style>
  <script>
 $(function() {
    $( "#tabs" ).tabs();
      
    })
    
  </script>  
  </head>
  <body style="background: black;">
    <div id="tabs">
      <ul>
        <li><a href="../Truck Loader/login.php">Login</a></li>
        <li><a href="../Truck Loader/search.php">Search</a></li>
        <li><a href="../Truck Loader/radius_search.php">Radius Search</a></li>
        <li><a href="../Truck Loader/drivers.php">Drivers</a></li>
        <li><a href="../Truck Loader/todays_loads.php">Todays Loads</a></li>
        <li><a href="#tmisc">Misc...</a></li>
        <li><a href="#tadmin">Admin...</a></li>
      </ul>
    <div id="tab1"><spaan style="font-weight: bold">Welcome to LoadsByJake.<br>Click a tab to continue.</span></Div>  
    </div>
