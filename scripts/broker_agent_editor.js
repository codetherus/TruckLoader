//Javascript for the brokerspage.
	jQuery(document).ready(function()
	{
    jQuery("#agent_name").focus();    
    shortcut.add("Alt+S", function(){jQuery('#search_term').focus()});
    //See if we have been swapped in
    xajax_CheckPageSwap();  
 	});


    //Send the form and op code to the server.
	function sendPage(op)
	{
		fb.end();
		xajax_Process(xajax.getFormValues('form1'),op);
		return false;
	}
  
  function resetDisplay()
  {
  }

  