<?php
/***********************************************************************
* name  AnyWhereInDB
* author Nafis Ahmad 
* This project is to find out a part of string from anywhere in database
* version 1.0  this more easy to code version 
* package sample
* 7/23/10 - Altered to run on loadsbyjake.com from the global search JS
*************************************************************************/
  include("dbsettings.php"); //Database auth information
  $current_table = ''; //Global for table link construction
  $server = $svr;
  $dbuser = $usr;
  $dbpass = $pwd;
  $dbname = $dbs; 
  $current_table = ''; //Global to carry the table name;  
  $strings = ''; //Global to carry the content back.
  //Field name to display name arrays. If not included, they aren't shown' 
  $fieldnames = array('id','name','company','address1','address2','city','state','zip','phone','cell','fax','notes',  
                      'tlength','ttype','home_town','preferences','truck_no','comments','canada','twic','pipe_stakes',                      
                      'driving_limitations','load_levelers','load_options','email','status','rating','pole_bunks',                      
                      'canada_limitations','load_number','booking_date','pickup_date','delivery_date','pickup_location',                      
                      'delivery_location','load_notes','load_experience','shortname','contact_type','entity','entity_type',                      
                      'entity_name','user','level','user_name','theme');                      
  $mapnames = array('Rec. Num','Name','Company','Address1','Address2','City','State','Zip','Phone','Cell','Fax','Notes',  
                    'Length','Type','Home<br>Town','Preferences','Truck. Num','Comments','Canada','TWIC','Pipe<br>Stakes',                    
                    'Driving<br>Limitations','Load<br>Levelers','Load<br>Options','Email','Status','Rating','Pole<br>Bunks',                    
                    'Canada<br>Limitations','Load<br>Num','Booking<br>Date','Pickup<br>Date','Delivery<br>Date','Pickup<br>Location',                    
                    'Delivery<br>Location','Load<br>Notes','Load<br>Experience','Short<br>Name','Contact<br>Type','Entity',                    
                    'Entity<br>Type','Entity<br>Name','User Id','Level','User<br>Name','Theme');
	
	function fetch_array($res)
	// @method    fetch_array
	// taking the mySQL $resource id and fetch and return the result array
	// @param   string| MySQL resouser 
	// @return  array 
  //For loadsbyjake, select a specific set of tables. 
	{
	  $data = array();
  	while ($row = mysql_fetch_assoc($res)) 
		{
			$data[] = $row;
		}
		return $data;
	} //@endof  function fetch_array

	
	function table_arrange($array)
	// @method  table_arrange
	// taking the mySQL the result array and return html Table in a string. showing the search content in a diffrent css class.
	// @param  array 
	// @post_data  search_text
	// @return  string | html table 
	{
		global $current_table;
 	  global $strings;

		$table_data = '';
		
		$max =0; //  max lenth of a row
		
		$max_i =0; //  number of the row which is maximum max lenth of a row
		
		$search_text = $_POST["search_term"];
		
		for($i=0;$i<sizeof($array);$i++)
		{
			//table row 
			$table_data .= '<tr class='.(($i&1)?'"odd_row"':'"even_row"') .' >';
			//
			$j=0;
			
			foreach($array[$i] as $key => $data) 
			{
				if ($key == 'password') continue; //Protect the user passwords...
        if ('' == NameToDisplay($key)) continue;
        //Create a link on the id fields
        if ($key == 'id')
          $data = "<a href='#' onclick=\"sendSearchPage('$current_table','$data')\">$data</a>";
        else
				  //a class around the search text 
				  $data = preg_replace("|($search_text)|Ui" , "<span class=\"search_text\">$1</span>" , htmlspecialchars($data));
				$table_data .= '<td>'. $data .' &nbsp;</td>';
				
				$j++;
			}
			
			if($max<$j)
			{
				$max = $j;
				$max_i = $i;
			}
			$table_data .= '</tr>'."\n";
		}
		unset($data);
		// @endof html table
		
		//populating the table head
		
		// @varname $data_a
		// taking the highest sized array and printing the key name.
		$data_a = $array[$max_i];
		
		
		$table_head =  '<tr>';
			foreach($data_a as $key => $value) 
			{
				$table_head .= '<th class="keys">'. $key.'</td>';
			}
				
		$table_head .= '</tr>'."\n";
		//@endof populating the table head
		
		// printing the table data
		$strings .= '<table border="1">'.$table_head.$table_data."</table>";
	}//@endof  function table_arrange
	


  //Get the display name of the passed field name.  
  //Returns the empty string if not there.
  function NameToDisplay($fld)
  {  
    global $fieldnames, $mapnames;
    for($i=0;$i<count($fieldnames);$i++)    
    {    
      if ($fieldnames[$i] == $fld)      
        return $mapnames[$i];        
    }    
    return '';
  }  
  
  //Database setup
	$link = @mysql_connect($server, $dbuser, $dbpass);
	if (!$link) {  session_destroy(); header("Refresh:0;url=http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?error_message=Username OR password Missmatch');}
	if(!@mysql_select_db($dbname, $link)){ session_destroy(); header("Refresh:0;url=http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?error_message=Database Not found');};

  if (!isset($_POST['search_term']))
    $search_text = 'al';  
  else
  {		
    $search_text = $_POST['search_term'];
    if ($search_text == '')    
      $search_text = 'al';  
  }
  $result_in_tables = 0;
  //table count in the database
  //$sql= 'show tables';
  //$res = mysql_query($sql);
  //get all table information in row tables
  $tables = array('brokers','drivers','loads','phones','users');	
  for($i=0;$i<sizeof($tables);$i++)
  //  for each table of the db seaching text
  {
	  //$skip_tables = 'zip_code, call_checks, load_history, pdf_store, private_notes, savedloader,
    //                truck_inbound_v2, truck_inbound_v2, truck_loader, truck_loader_v2, user_history';      
  	global $current_table;
    $current_table = $tables[$i];
    //if (false !== @strpos($skip_tables, $current_table)) continue; 
    //querry bliding of each table
		$sql = 'select * from '.$current_table;
		$res = mysql_query($sql);
		
		if(mysql_affected_rows()>0)
		//Buliding search Querry, search
		{
			//taking the table data type information
			$sql = 'desc '.$tables[$i]['Tables_in_'.$dbname]; 
			$res = mysql_query($sql);
			$collum = fetch_array($res);
			
			$search_sql = 'select * from '.$current_table.' where ';
			$no_varchar_field = 0;
			
			for($j=0;$j<sizeof($collum);$j++)
			// only finding each row information
			{
					//Is this a field of interest?
          $fld = $collum[$j]['Field'];
          $mapped = NameToDisplay($fld);          
          if ($mapped != '')
					{
						//echo $collum[$j]->Field .'<br />';
						if($no_varchar_field!=0){$search_sql .= ' or ' ;}
						$search_sql .= '`'.$collum[$j]['Field'] .'` like "%'.$search_text.'%" ';			
						$no_varchar_field++;
					} // endof type selection part of query bulidingtype selection part	
					
			}//@endof for |buliding search query
			
			if($no_varchar_field>0)
			// only main searching part showing the data
			{
				$res = mysql_query($search_sql);
				$search_result = fetch_array($res);
				if(sizeof($search_result))
				// found search data showing it! 
				{
					$result_in_tables++;
					$strings .= '<div class="table_name">&nbsp;&nbsp; ' 
						 . $tables[$i]['Tables_in_'.$dbname]
						 .' &nbsp;&nbsp;</div> 
						  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						  <div class="wrapper" id="'.$tables[$i]['Tables_in_'.$dbname].'_wrapper">';
					table_arrange($search_result);
					$strings .= '</div><br/>';
				}// @endof showing found search  
				
			}//@endof  main searching 
		}//@endof  querry building and searching 

  }
 
	mysql_close($link);
  if ($strings == '')
    echo '';
  else 
    echo $strings;
?>

