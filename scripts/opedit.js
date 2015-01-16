/*
  JS routines for the edit page.
*/ 
	var ischanged=false;

	function sendPage(opcode)
	{
    if (opcode=='update' || opcode=='delete')
    	ischanged = false;
		xajax_callUser('opedit','processEdit','opedit',opcode,xajax.getFormValues('form1'));
    return false;
	}
	function show_notes()
	{
	 open("private_notes.php","_self");
	
	}
	function show_load_history()
	{
		open("load_history.php","_self");
	}		
	window.onbeforeunload=function(evt)
	{
		if (!evt) evt = window.event;
		if (ischanged)
			evt.returnValue="There are unsaved changes...";
	}
window.onkeydown=function(e)
	{
    var keynum
    var notachar
    if(window.event) // IE
    {
    keynum = e.keyCode
    }
    else if(e.which) // Netscape/Firefox/Opera
    {
    keynum = e.which
    }
   // alert(keynum);
    if (
      (e.keynum != 32) && // not spacebar
      (e.keynum != 8) &&  // not backspace
      (e.keynum != 46) && // not delete
      ((e.keynum < 48) || (e.keyCode > 90)) // non-character
    ) 
      notachar =  true;
    else
      notachar = false;
    if (notachar == false)
		  ischanged=true;
	}

	$(document).ready(function()
	{
		$("#driver").focus();
	})
	