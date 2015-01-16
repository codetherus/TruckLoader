/*
  This is the javascript for the homepage template
*/ 
  //On ready, call for the home page template
  //and hide the login div.
  $(document).ready(function(){
      xajax_LoadPage(0);
      hideLogin();
  });
  
  //Show the login div 
  //and reset the right col width
  function showLogin(){
    $("#rightcolumn").width(728);
    $("#leftcolumn").show();
    $("#user").focus();
  }
  //Hide the login div 
  //and adjust the right col width.
  function hideLogin(){
    $("#rightcolumn").width(900);
    $("#leftcolumn").hide();
  }
  //Toggle the login div visibility.
  function toggleLogin(){
    var isVis = $("#leftcolumn").is(":visible");
    if (isVis)
     hideLogin();
    else
      showLogin();
  }
  function doFocus(){
    setTimeout( function() { $( '.firstinput' ).focus() }, 100 );
  }