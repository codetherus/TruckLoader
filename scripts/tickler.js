/*
  JS for the pages that use the tickler overlay
*/
  jQuery(document).ready(function()
	{
    var autoparams = {width:260, autoFill: true, matchContains: true, selectFirst: false};
    //Autosuggest routines
    jQuery("#tdriver").autocomplete("includes/auto_driver_names.php", autoparams);
    jQuery("#tload").autocomplete("includes/auto_loads.php", autoparams);
  });