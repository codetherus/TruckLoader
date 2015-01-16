	$(document).ready(function()
	{
		//Save the original form state for unload difference checking.
    origState = fleegix.form.toObject(xajax.$('form1'));

  })
  //Call the server using xajax
	function sendPage(opcode)
	{
    if (opcode=='update' || opcode=='delete')
    	origState = fleegix.form.toObject(xajax.$('form1'));//Resave the form state.
		xajax_processEdit(opcode,xajax.getFormValues('form1'));
    return false;
	}
  //Reminder list link target
  function SetupPageRead(id)  
  {  
    fb.end();
    xajax.$('current_record_id').value = id;    
    sendPage('read');    
  }
/*
  window.onbeforeunload=function()
  {
    var endForm = fleegix.formToObject(xajax.$('form1')); //Form state at end.
    var changes = fleegix.form.diff(endForm, origState); //Compare for changes.
    if (changes.count > 0)
      return 'There are Unsaved Changes.';
  }  
*/
  