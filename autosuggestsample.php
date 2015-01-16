<?php
ini_set('display_errors', 'On');

/* Always require the xajax.inc.php library file */

require ('xajax.inc.php');

function getCities($sSearch)  {

  /* The array with city names is stored in a separate file */

  require('gemeenten.php');

  $sOut = "";
  $nCount = 0;
  
  foreach($aCities as $sCity)  {
 
/* Cycle through the list of cities. If there's a match
   we add the city to the list of resilts we keep in
   the variable $sOut */
 
    $sPattern = "/^(".strtolower($sSearch).")/"; 
    if(preg_match($sPattern, strtolower($sCity)))  {
    
/* Keep track of the amount of 'hits' in $nCount */    
    
        $nCount++;
       
/* The little bit of javascript makes sire
   we can click the links to set the content of
   the form element. With this we don't have to
   finish typing the whole city name. Easy does it! */
        
        $sOut .= "<li><a href=\"#\" onclick=\"javascript:document.getElementById('search').value='".$sCity."';document.getElementById('citybox').style.display = 'none';\">".$sCity."</a></li>";
        $sLastHit = $sCity;
      }
  }
 
/* If there are too many results we just empty
   the list because we don't want to show hundreds
   of results. The upper limit is set at 31 here */
  
  if($nCount > 31)  {
    $sOut = "";
    }
    
/* instantiate the xajaxResponse object */    
    
    $objResponse = new xajaxResponse();
    
  if(strlen($sOut) > 0)  {
  
/* if $sOut contains data we put it inside
   an <ul> element. Additionally we'll send
   a snippet of javascript to make the HTML element
   with id 'citybox' visible by using the addScript()
   method on the xajaxResponse object */
 
    $sOut = "<ul>".$sOut."</ul>";
    $objResponse->addScript("document.getElementById('citybox').style.display = \"block\"");
  }
  else  {
  
/* No result? In that case we don't want
   to see the 'citybox' HTML element */

    $objResponse->addScript("document.getElementById('citybox').style.display = \"none\"");
  }

/* Only one hit? This means we can 'auto-complete' the form field! */

if($nCount == 1)  {
    $objResponse->addScript("document.getElementById('citybox').style.display = \"none\"");
    $objResponse->addScript("document.getElementById('search').value = \"".$sLastHit."\"");
  }

/* We alter the contents of the 'citybox' HTML
   element. The property 'innerHTML' is the html
   code inside this element. We replace it with
   the result in our $sOut variable */
    
    $objResponse->addAssign("citybox", "innerHTML", $sOut);  
 
/* With the getXML() method on the xajaxResponse object
   we send everything back to the client */
 
    return $objResponse->getXML();
}

/* instantiate anxajax object */

$objAjax = new xajax();

/* register the function getCities on
   the xajax object */

$objAjax->registerFunction('getCities');

/* process the request */

$objAjax->processRequests();

require_once('templates/template_head.php');
?>
<h1>Demo 4: 'live search'</h1>
<p>By typing something in the textfield below, a list of cities is queried on the server. If we get 30 or less 'hits' on the server a list is displayed. The user can click a name in the list to complete the form field or just continue typing until there's only one result left. In that case the textfield is completed automatically.</p>
<p><a href="demonstratie4.phps">View the sourcecode</a></p>
<p><a href="gemeenten.phps">View the file containing the list of cities</a></p>
<p><strong>City:</strong></p>

<!-- With the onkeyup attribute we can monitor keypresses and call the
     backend function getCities through xajax as the user types -->

<input autocomplete="off" type="text" class="textbox" name="search" value="" id="search" onkeyup="xajax_getCities(document.getElementById('search').value);"/><br />
<div id="citybox">&nbsp;</div>
<p id="menulink"><a href="demonstratie.php">&raquo; Back to main page</a></p>
<?php
require_once('templates/template_foot.php');
?>
