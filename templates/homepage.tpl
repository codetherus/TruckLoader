<!DOCTYPE html>
<html>
  <head>
    {$xajaxjs}
    <title>Loads by Jake</title>
    <link rel="stylesheet" type="text/css" href="styles/main.css" />
    <script type="text/javascript" src="JQueryUI/js/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="scripts/jquery.alerts.js"></script>
    <link rel="stylesheet" type="text/css" href="styles/jquery.alerts.css">
    <script type="text/javascript" src="scripts/homepage.js"></script>
  </head>
  <body>
    <div id="wrapper">
      <div id="header2">
      </div>
      <div id="header">
        <img src="images/droppedImage.gif" width="600" onclick="toggleLogin()"  />
      </div>
      <div id="navigation">
        <a href="#" onclick="xajax_LoadPage(0)">Home</a> | 
        <a href="#" onclick="xajax_LoadPage(1)">Available Trucks</a> | 
        <a href="#" onclick="xajax_LoadPage(2)">Available Loads</a> | 
        <a href="#" onclick="xajax_LoadPage(5)">Get a Quote</a> | 
        <a href="#" onclick="xajax_LoadPage(3)">About Us</a> | 
        <a href="#" onclick="xajax_LoadPage(4)">Contact Us</a> 
      </div>
      <div id="leftcolumn">
        <br/><br/>
        <p><b>User Sign In</b></p><br/>
        <form id="form1">
          <p>User Id:<br/>
            <input id="user" name="user"/><br/>
          </p>
          <p>Password:<br/>
            <input type="password" id="password" name="password"/><br/><br/>
            <input type="submit" value="Sign In" onclick="xajax_login(xajax.getFormValues('form1'));return false;"/> 
          </p>     
        </form>
      </div>
      <div id="rightcolumn">
      </div>
      <div id="footer">
			       Copyright &copy; {$footeryear} {$footertext}
      </div>
    </div><!-- End Wrapper -->
  </body>
</html>
