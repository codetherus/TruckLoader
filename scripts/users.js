//Javascripts for the users page.
  function setupAutoSuggests(){ 
  {
  /*  
  function setupSearchGrid()  
  {  
    //Load search grid
    jQuery("#flex1").flexigrid(
		{
		url: 'includes/auto_user_search.php',
		dataType: 'json',
		colModel : [
			{display: 'id',            name : 'id',                width : 20,  sortable : true, align: 'center'},
      {display: 'User ID',        name : 'userid',       width : 120, sortable : true, align: 'left'},
      {display: 'User Name',        name : 'user_name',              width : 120, sortable : true, align: 'left'},
      {display: 'Phone',     name : 'phone',   width : 100, sortable : true, align: 'left'},      
      {display: 'Email',   name : 'email',       width : 70,  sortable : true, align: 'left'},
			],
		searchitems : [
      {display: 'User ID',         name : 'userid', isdefault: true},
			{display: 'User Name',        name : 'user_name'},
      {display: 'Phone',    name : 'phone'},
      {display: 'Email', name : 'email'}        
			],
		sortname: "user_name",
		sortorder: "asc",
		usepager: true,
		title: 'User Search',
		useRp: true,
		rp: 15,
		showTableToggleBtn: true,
		width: 750,
		height: "auto"
    }
		);
  }  
  */
  //jquery code.
	jQuery(document).ready(function()
	{
    //setupSearchGrid();  
    //Setup for the global search page
    jQuery("#search_results").slideUp('slow'); 
    jQuery("#search_button").click(function(e){ 
        e.preventDefault(); 
        ajax_search(); 
    }); 
    jQuery("#search_term").keyup(function(e){ 
        e.preventDefault(); 
        ajax_search(); 
    }); 
    jQuery("#user").focus();
      
	})

  //GLobal search functions
  function ajax_search(){ 
    jQuery("#search_results").show(); 
    var search_val=jQuery("#search_term").val(); 
    $.post("find.php", {search_term : search_val}, function(data){
     if (data.length>0){ 
       jQuery("#search_results").html(data); 
     }
     else
      jQuery("#search_results").hide();
   }) 
  } 
  //Sends to the xajax function passing
  //the operation/table and the record id.
  function sendSearchPage(op,id)
  {
    jQuery("#search_results").hide();
    xajax_ProcessSearch(op,id);
  }   
  //End global search functions;
  

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
    jQuery("#user_search_div").show();
  } 
  //hide one of the search grids
  function hideGrid()    
  {
      jQuery("#driver_search_div").hide();      
    else if (n == 2)    
      jQuery("#load_search_div").hide();      
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
  