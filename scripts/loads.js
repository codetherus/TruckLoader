//Javascripts for the loads page.
  function setupAutoSuggests()  
  {  
    //Autosuggest routines
    var autoparams = {width: 260, matchContains: true, selectFirst: false};
    jQuery("#driver_name").autocomplete("includes/auto_driver_names.php", autoparams);
    jQuery("#pickup_location").autocomplete("includes/auto_cities.php", autoparams);
    jQuery("#delivery_location").autocomplete("includes/auto_cities.php", autoparams);
    jQuery("#home_office").autocomplete("includes/auto_cities.php", autoparams);
    jQuery("#home_town").autocomplete("includes/auto_cities.php", autoparams);
    jQuery("#load_number").autocomplete("includes/auto_loads.php", autoparams);
    jQuery("#brokerageid").autocomplete("includes/auto_brokers.php", autoparams);    
    jQuery("#broker_agent").autocomplete("includes/auto_broker_agents.php",autoparams);
   }  

  //jquery code.
	jQuery(document).ready(function()
	{
    setupAutoSuggests();    
        
    jQuery("#load_number").focus();    
    //Hot key definitions
    shortcut.add("Alt+L", function(){sendPage('displaybyname');})  
    shortcut.add("Alt+D", function(){sendPage('swappages');})    
    shortcut.add("Alt+H", function(){sendPage('loadhistory');})    
    shortcut.add("Alt+B", function(){window.open("broker_editor.php", "_blank", "");})    
    shortcut.add("Alt+S", function(){jQuery('#search_term').focus()});

    //See if there is a page swap call pending.
    xajax_CheckPageSwap(); 
		//Save the original form state for unload.
    var origState = fleegix.form.toObject(xajax.$('form1'));
	})
  
  //Call the server using xajax
	function sendPage(opcode)
	{
    if (opcode=='update' || opcode=='delete')
    	origState = fleegix.form.toObject(xajax.$('form1'));//Resave the form state.
		xajax_processEdit(opcode,xajax.getFormValues('form1'));
    return false;
	}
  function readDriver()
  {
    if (xajax.$('driver').value != '')
      sendPage('readdriver');
  }
  
  //unhide search grid
  function showGrid()  
  {    
    jQuery("#load_search_div").show();              
  } 
  //hide the search grid
  function hideGrid()    
  {
    jQuery("#load_search_div").hide();      
  } 

  function doLoadDisplay(d)  
  {  
    hideGrid(2);    
    xajax.$('ldid').value = d;    
    sendPage('display');    
  } 
  

  //Gross calc for load display
  function compute_gross()
  {
    var acc = xajax.$('accessorial').value;
    var lin = xajax.$('line_haul').value;
    var gross = parseFloat(acc) + parseFloat(lin);
    if (!isNaN(gross))  
      xajax.$('gross').value = parseFloat(acc) + parseFloat(lin);
    else
      xajax.$('gross').value = '';
  }


  window.onbeforeunload=function()
  {
    var endForm = fleegix.formToObject(xajax.$('form1')); //Form state at end.
    var changes = fleegix.form.diff(endForm, origState); //Compare for changes.
    if (changes.count > 0)
      return 'There are Unsaved Changes.';
  }
  //Agent info overlay functios
  
  //Hide it
  function hideAgentOverlay(){
    jQuery("#brokeragentoverlay").hide();
  }
  
  //Show it
  function showAgentOverlay(){
    jQuery("#brokeragentoverlay").show();
    sendPage('initbrokeragent');
  }
  
  //Process with xajax
  function processAgent(){
		xajax_processEdit('processagent',xajax.getFormValues('form4'));
    return false;
  }
  
  //Fetch the agent's phone number
  function getAgentInfo(){
    var agentname = jQuery("#broker_agent").val();
    var brokername = jQuery("#brokerageid").val();
    xajax_BrokerAgentInfo(agentname,brokername);
  }    
  //Brokerage maintenance handler
  function handleBrokerOverlay(op){
    if (op == 'show')
      jQuery("#brokereditoroverlay").show();
    else if (op == 'hide')
      jQuery("#brokereditoroverlay").hide();
    else if (op == 'read')
      xajax_processEdit('readbroker',xajax.getFormValues('formbrokeroverlay'));
    else {
      jQuery("#brokereditoroverlay").hide();
      xajax_processEdit('processbroker',xajax.getFormValues('formbrokeroverlay'));
    }
  }
     