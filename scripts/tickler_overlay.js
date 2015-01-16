/*
  Tickler overlay javascript
*/
  jQuery(document).ready(function()
	{
    var autoparams = {width:260, autoFill: true, matchContains: true, selectFirst: false};
    //Autosuggest routines
    jQuery("#tdriver").autocomplete("includes/auto_driver_names.php", autoparams);
    jQuery("#tload").autocomplete("includes/auto_loads.php", autoparams);
    shortcut.add("Alt+T", function(){showReminders()});
  });

  //Display the overlay and populate the
  //driver name and load number
  function showReminders(){
    var pgname = window.location.pathname;
    var pgname = pgname.substring(pgname.lastIndexOf('/') + 1);
    if (pgname == 'drivers.php'){
      jQuery("#tdriver").val(jQuery("#name").val());
      jQuery("#tload").val(jQuery("#load_number").val());
    }
    else {
      jQuery("#tdriver").val(jQuery("#driver_name").val());
      jQuery("#tload").val(jQuery("#load_number").val());
     }
    jQuery("#remindersoverlay").show(); 
  }   
  
  
  function hideReminders(){
    jQuery("#remindersoverlay").hide();
  } 
  //Send the overlay for processing.
  //op is what's to be done.
  function sendReminderPage(op){
    //xajax.$('rmsgtext').value = xajax.$('remessage').value;
    xajax_ProcessReminder(op, xajax.getFormValues('formreminders'));
  }
  //Reminder list link target
  function SetupPageRead(id)  
  {  
    fb.end();
    xajax.$('current_record_id').value = id;    
    sendReminderPage('read');    
  }
   
  function readEvent(id){
    fb.end();
    jQuery('#eventid').val(id);
    xajax_EventDisplay(xajax.getFormValues('formreminders'));
    return false;    
  }
  function deleteEvent(id){
    fb.end();
    jQuery('#eventid').val(id);
    xajax_EventDelete(xajax.getFormValues('formreminders'));
    return false;    
  }
