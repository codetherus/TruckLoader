	$(document).ready(function()
	{
    $("#city").autocomplete("includes/auto_cities.php", {
    		width: 260,
    		matchContains: true,
    		selectFirst: false
    	}); 

    $("#city").focus();    
    shortcut.add("Alt+S", function(){$('#search_term').focus()});
	})
