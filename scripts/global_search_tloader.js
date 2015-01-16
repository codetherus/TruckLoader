/*
  Global search js code
  Requires jQuery.js
  Add a div for the display:
  <div id="search_results"></div> to the template before the footer include.
  Force the template header to add the search input:
  Add jQuerysmarty->assign("dosearch",1); at the top of the php after the commons include
  7/26/10- using jQuery instead of jQuery to try to make it work with ie.
  This version searches the truck_loader table and will be added to the old pages.
*/
//Sort order
driver_order = 'driver';
driver_dir = 'asc';

//The ready function handles the setup
jQuery(document).ready(function()
{
    //Setup for the global search page
    jQuery("#search_results").slideUp(); 
    jQuery("#search_term").keyup(function(e){ 
        e.preventDefault(); 
        ajax_search();
      });
    //Center the search results.
    wd = (screen.width - 950) / 2;
    wd = wd+'px';
    jQuery("#search_results").attr('marginLeft', wd);
});

  /*
    Run the search php page.
    Expose the display
    Get the search term.
    If the term is empty, hide the display and exit
    Otherwise run the post to the find.oho page.
    When the post completes either display its data
    or hide the display if the data is empty.
  */
  function ajax_search(){ 
    
    var search_val=jQuery("#search_term").val();    

    if (search_val == '')
    { 
      jQuery("#search_results").hide();
      return;
    }    
    //if (search_val.length < 3) return;
    jQuery("#search_results").scrollTo(0,0);
    jQuery("#search_results").show(); 
       
    jQuery.post("find_tloader.php", {search_term : search_val,    
                        driver_sort: driver_order,
                        driver_d: driver_dir},
                        function(data){
                          if (data.length>0){ 
                            jQuery("#search_results").html(data); 
                          }
                          else
                            jQuery("#search_results").hide();
   }) 
  }   

  
  /*
    This function is references by the links in find.php.
    It invokes the utility function ProcessSearch() that
    Handles the session setup and redirect to the proper
    page.
  */
  function sendSearchPage(op,id)
  {
    jQuery("#search_results").hide();
    xajax_ProcessSearch(op,id);
  }   
