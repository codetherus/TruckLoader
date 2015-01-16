  
  //Add the driver contact info the the main form hidden
  //elements so we can add them with the new driver.
  function CopyContactInfo(){
    jQuery("#h_driverphone").val(jQuery("#driverphone").val());
    jQuery("#h_drivercell").val(jQuery("#drivercell").val());
    jQuery("#h_driverfax").val(jQuery("#driverfax").val());
    jQuery("#h_driveremail").val(jQuery("#driveremail").val());
  }


  //Call the server using xajax
	function sendPage(opcode)
	{
    if (opcode=='update' || opcode=='delete'){
    var origState = fleegix.form.toObject(xajax.$('form1'));//Resave the form state.
		}
    if (opcode == 'insert')
      CopyContactInfo();
    xajax_processEdit(opcode,xajax.getFormValues('form1'));
    return false;
	}
  function readDriver()
  {
    if (xajax.$('name').value !== ''){
      sendPage('readdriver');
    }
  }  
  
  //unhide one of the search grids
  function showGrid(n){    
      if ( n == 1) //drivers
      {
        jQuery("#driver_search_div").show();
      }
      else //loads
      {
        jQuery("#load_search_div").show();              
      }
  } 
  //hide one of the search grids
  function hideGrid(n)    
  {
    if (n == 1)
    {
      jQuery("#driver_search_div").hide();      
    }
  } 

  function doDisplay(d)  
  {  
    hideGrid(1);    
    xajax.$('name').value = d;    
    sendPage('readdriver');    
  } 
  

  //Gross calc for load display
  function compute_gross()
  {
    var acc = xajax.$('accessorial').value;
    var lin = xajax.$('line_haul').value;
    var gross = parseFloat(acc) + parseFloat(lin);
    if (!isNaN(gross)) 
    { 
      xajax.$('gross').value = parseFloat(acc) + parseFloat(lin);
    }
    else
    {
      xajax.$('gross').value = '';
    }
  }


  window.onbeforeunload=function()
  {
    var endForm = fleegix.formToObject(xajax.$('form1')); //Form state at end.
    var changes = fleegix.form.diff(endForm, origState); //Compare for changes.
    if (changes.count > 0)
    {
      return 'There are Unsaved Changes.';
    }
  }; 

  //See if the user changed the load number
  //If so, ask for confirmation to create a new load.
  function CheckLoadStatus()
  {
    xajax.$('load_status').value = 'nochange';
    if (xajax.$('load_number').value != xajax.$('h_load_number').value)
    {
      var r = confirm('You changed the load number.\nCreate a new load?\nIf yes click OK else Cancel');
      if (r == true){
        xajax.$('load_status').value = 'makenew';
      }
    }
    sendPage('update');
  }
  function hideContacts()
  {
    jQuery("#drivercontacts").hide();
  }
  function showEmail(){
    jQuery("#drivermail").show();
    jQuery("#emessage").resizable('destroy');
    xajax_SetupEmail(jQuery("#current_driver_id").val());
  }  
  function hideEmail(){
    jQuery("#drivermail").hide();
  }
  
  function send_email(){
    hideEmail();
    xajax.$('emaildriverid').value = xajax.$('current_driver_id').value;
    xajax.$('emailtext').value = xajax.$('emessage').innerHTML;
    xajax_SendEmail(xajax.getFormValues('form3'));
  }
  function process_contacts(op)
  {
    var rid = jQuery("#current_driver_id").val();
    xajax_ProcessContacts(op,rid,xajax.getFormValues('form2'));
    hideContacts();
  }
  function showContacts()
  {
    var rid = jQuery("#current_driver_id").val();
    jQuery("#drivercontacts").show();
    xajax_ProcessContacts('read',rid,xajax.getFormValues('form2'));
    jQuery("#driverphone").focus();
  }
  //Timestamp the notes
  //Called by the click event on the notes box label.
  function addTimestamp(){
    d = new Date();
    //Form the timestamp and user id string.
    ts = d.toDateString();
    ts += ' ' + jQuery("#username").val();
    //Get the current note contents.
    cont = jQuery("#notes").val();
    //If  empty just add the timestamp.
    //If not add a new line and the timestamp;
    if (cont == '')
      cont += ts;
    else
      cont += '\r'+ ts;
    //Restore the notes content.
    jQuery("#notes").val(cont);
  }

  jQuery(document).ready(function()
	{
/*
    var autoparams = {width:260, autoFill: true, matchContains: true, selectFirst: false};
    //Autosuggest routines
    jQuery("#name").autocomplete("includes/auto_driver_names.php", autoparams);
    jQuery("#pickup_location").autocomplete("includes/auto_cities.php", autoparams);
    jQuery("#delivery_location").autocomplete("includes/auto_cities.php", autoparams);
    jQuery("#home_office").autocomplete("includes/auto_cities.php", autoparams);
    jQuery("#home_town").autocomplete("includes/auto_cities.php", autoparams);
    jQuery("#dldeliverylocation").autocomplete("includes/auto_cities.php", autoparams);
    

    //Hot keys
    shortcut.add("Alt+D", function(){readDriver();});        
    shortcut.add("Alt+Q", function(){readDriver();});    
    shortcut.add("Alt+L", function(){sendPage('swappages');});
    shortcut.add("Alt+Delete", function(){sendPage('deletedriver');});
    shortcut.add("Alt+C", function(){window.open("phone_editor.php", "_blank", "");}); 
    shortcut.add("Alt+S", function(){jQuery('#search_term').focus();});
    shortcut.add("Alt+B", function(){window.open("broker_editor.php", "_blank", "");});
    shortcut.add("Alt+M", function(){showEmail()});
    //See if we have been swapped in
    xajax_CheckPageSwap();  
    xajax_GetCalendarList();
		//Save the original form state for unload difference checking.
    var origState = fleegix.form.toObject(xajax.$('form1'));
    jQuery("#name").focus();    
    //jQuery("#drivermail").dialog({autoOpen:false});
*/
    jQuery("div#tabs").tabs();
});    
 


  
  
  