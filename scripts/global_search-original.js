/*
  Global search js code
  Requires jQuery.js
  Add a div for the display:
  <div id="search_results"></div> to the template before the footer include.
  Force the template header to add the search input:
  Add jQuerysmarty->assign("dosearch",1); at the top of the php after the commons include
  7/26/10- using jQuery instead of $ to try to make it work with ie.
*/
//Sort orders and directions
driver_order = 'name';
driver_dir = 'asc';
user_order = 'user_name';
user_dir = 'asc';
broker_order = 'company';
broker_dir = 'asc';
load_order = 'load_number';
load_dir = 'asc';
minLength = 2; //Controls the #of characters needed to trigger the search.
/*
  Service a <th> click from the display.
  param tbl - table name
  param fld - field name
*/
function setSortOrder(tbl,fld)
{
  //Set the defaults
  driver_order = 'name';
  user_order = 'user_name';
  broker_order = 'company';
  load_order = 'load_number';  

   if (tbl == 'drivers')
   {
     if (driver_dir == 'asc')
      driver_dir = 'desc';
     else     
      driver_dir = 'asc';
     driver_order = fld;          
   }  
   else if (tbl == 'users')
   {
     if (user_dir == 'asc')
      user_dir = 'desc';
     else     
      user_dir = 'asc';
     user_order = fld;     
   } 
   else if (tbl == 'brokers')   
   {
     if (broker_dir == 'asc')
      broker_dir = 'desc';
     else     
      broker_dir = 'asc';
     broker_order == fld;      
   } 
   else if (tbl == 'loads')   
   {
     if (load_dir == 'asc')
      load_dir = 'desc';
     else     
      load_dir = 'asc';
     load_order == fld;      
   } 

   ajax_search(); 
}

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
    Get the search term.
    If the term is empty or shorter than the min characters, 
    hide the display and exit.
    Otherwise run the post to the find.php page.
    When the post completes:
    1. If any data returns, display it.
    2. Just hide the display if no data.
  */
  function ajax_search(){ 
    var search_val=jQuery("#search_term").val();    
    if (search_val == ''|| search_val.length < minLength)
    { 
      jQuery("#search_results").hide();
      return;
    }    
    jQuery.post("find.php", {
                        search_term : search_val,    
                        driver_sort: driver_order,
                        driver_d: driver_dir,                       
                        user_sort: user_order,
                        user_d: user_dir,                        
                        broker_sort: broker_order,
                        broker_d: broker_dir,
                        load_sort: load_order,
                        load_d: load_dir},
                        function(data){
                          if (data.length>0){ 
                            jQuery("#search_results").html(data);                            
                            jQuery("#search_results").show();                             
                            jQuery("#search_results").scrollTo(0,0);  //scroll the display to the top
                          }
                          else
                            jQuery("#search_results").hide();
                        }
                ) 
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
