//Javascript for the brokerspage.
	jQuery(document).ready(function()
	{
    jQuery("#company").focus();    
    shortcut.add("Alt+S", function(){jQuery('#search_term').focus()});
   
 	});

  //Call the server using xajax
	function sendPage(opcode)
	{
    if (opcode=='update' || opcode=='delete')
    	origState = fleegix.form.toObject(xajax.$('form1'));//Resave the form state.
		xajax_processEdit(opcode,xajax.getFormValues('form1'));
    return false;
	}
  
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

  