//Javascript for the users page.
	$(document).ready(function()
	{
    $("#user").focus();
    shortcut.add("Alt+S", function(){$('#search_term').focus()});
    $("#user").focus();    
    xajax_CheckPageSwap(); 
 	});

  //Call the server using xajax
	function sendPage(opcode)
	{
    if (opcode=='update' || opcode=='delete')
    	origState = fleegix.form.toObject(xajax.$('form1'));//Resave the form state.
		xajax_processEdit(opcode,xajax.getFormValues('form1'));
    return false;
	}
  
  //unhide one of the search grids
  function showGrid()  
  {    
  } 
  //hide one of the search grids
  function hideGrid()    
  {
  } 

  function doLoadDisplay(d)  
  {  
    hideGrid(2);    
    xajax.$('ldid').value = d;    
    sendPage('display');    
  } 
  
  window.onbeforeunload=function()
  {
    var endForm = fleegix.formToObject(xajax.$('form1')); //Form state at end.
    var changes = fleegix.form.diff(endForm, origState); //Compare for changes.
    if (changes.count > 0)
      return 'There are Unsaved Changes.';
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
    xajax.$('user').value='';
    xajax.$('password').value = '';
    xajax.$('level').selectedIndex = 0; 
    xajax.$('list_level').selectedIndex = 0;    
		xajax.$('user_name').value = '';
  }

  