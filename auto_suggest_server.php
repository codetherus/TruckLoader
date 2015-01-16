<?php
/*
	Auto suggest server using XAJAX

  1. Query handler for cities  

  Each function takes a searchstring and   
  the id of the target div tag to receive  
  the results.  

  The page must define a js function named  
  <targetid>_handler that takes a single  
  string param. It will hide the result  
  div and populate the tag it is used for  

  The result divs are styles using the   
  asresults class.

*/

/*
  This handles the autosuggest for city, state  
  queries. Initially using the location from 
  the truck_loader table. Will be the supplied   
  cities table in production.  
  param searchstring where clause like string  
  param targetid id of the tag to receive the output.
*/
function SuggestLocation($searchstring, $targetid)
{
  global $db;    
  $resp = new xajaxResponse();
  $sql = "select distinct location from zip_code where location like '$searchstring%'";  
  $res = $db->get_results($sql);
  if (!$res)
  {
    $resp->script("xajax.$('$targetid').style.display='none';");
    return $resp;
  }
  
  $s = '<ul>';  
  foreach($res as $rw)  
  {  
    $loc = $rw->location;    
    
    $handler = "onclick=\"".$targetid."_handler('$loc');\""; //js that handles the list click      
    $s .= "<li><a href='#' $handler>$loc</a></li>";    
  }
  $s .= '</ul>';  
  $resp->assign($targetid,'innerHTML', $s);  
  $resp->script("xajax.$('$targetid').style.display='block';");
  return $resp;  
}
$xajax->register(XAJAX_FUNCTION,'SuggestLocation');
?>