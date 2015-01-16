/*
  JS routines for the edit page.
  //5/6/10  - using fleegix.js framework functions
              for change detection.
*/ 

  var origState; //Original form state for change detection.

	function sendPage(opcode)
	{
    if (opcode=='update' || opcode=='delete')
    	origState = fleegix.form.toObject(xajax.$('form1'));//Resave the form state.
		xajax_processEdit(opcode,xajax.getFormValues('form1'));
    return false;
	}
  //Obtain a password and OK to delete a record
  //4/11/10 - Use the jQuery custom dialogs.
  function confirmDelete()
  {
    jPrompt("Enter the password and\n click OK to delete this driver.",
            "",
            "Confirm Driver Delete",
            function(pwd)
            {
              if (pwd != null && pwd != '')
              {
                xajax.$('dprd').value = pwd;
                sendPage('delete');
              }
            });
  }
  
	function show_notes()
	{
	 open("private_notes.php","_self");
	
	}
	function show_load_history()
	{
		open("load_history.php","_self");
	}		

  window.onbeforeunload=function()
  {
    var endForm = xajax.$('form1'); //Form state at end.
    var changes = fleegix.form.diff(endForm, origState); //Compare for changes.
    if (changes.count > 0)
      return 'There are Unsaved Changes.';
  }
  /*
	$(document).ready(function()
	{
		//Save the original fom state for unload.
    origState = fleegix.form.toObject(xajax.$('form1'));
    $("#driver").focus();
	})
  */
	