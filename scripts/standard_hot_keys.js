	$(document).ready(function()
	{
    //Hot key definitions
    shortcut.add("Alt+L", function(){window.open("loads.php");})  
    shortcut.add("Alt+D", function(){window.open("drivers.php");})    
    shortcut.add("Alt+B", function(){window.open("broker_editor.php", "_blank", "");})    
    shortcut.add("Alt+T", function(){window.open("todays_loadsV2.php", "_blank", "");})        
    shortcut.add("Alt+T", function(){window.open("radius_searchv2.php", "_blank", "");})    
    shortcut.add("Alt+S", function(){$('#search_term').focus()});
	})
