<?php
/**
* 2012-01-15 Ed Robinson
* Simple accordian mashup using xajax and jQuery
*
* Each accordion tab is made p of 2 div tags.
* The first holds the title and a click event to open
* the second.
* The second div has an id and holds the content of the accordian tab.
*
* The tabs are added by xajax by appending to the "accdiv" div.
*
* The next available div id value is stored in a ssession variable.
*
* 2012-01-27 Modified to add and remove classes from the header divs.
*/
session_start();
/**
* At initial load, create the session
* tab index variable.
*/
if (!isset($_SESSION['tabindex']))
  $_SESSION['tabindex'] = 0;
  
/**
* Xajax setup.
*/  
require_once("./xajax/xajax_core/xajax.inc.php");
$xajax = new xajax();
$xajax->configure('javascript URI','xajax/');
$lorum = "Do your layouts deserve better than Lorem Ipsum? Apply as an art director and team up with the best copywriters at Jung von Matt: www.jvm.com/jobs/lipsum
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sed odio nisl. Nullam nisi eros, dignissim mattis interdum a, tristique ut ante. Etiam mattis tempus est vel rutrum. In malesuada felis id est pulvinar feugiat rhoncus odio pharetra. Integer ultricies lacus sed velit euismod pharetra. Phasellus pretium vehicula odio ut tristique. Aliquam erat volutpat.";

/**
* Return the next tab index.
*/
function getNextIndex(){
  return $_SESSION['tabindex']++;
}
/**
* Called from the client to add a new accordion tab
* @param integer new tab index
*/
function addatab(){
  global $lorum;
  $n = getNextIndex();
  $resp = new xajaxResponse();

  $s = "<div class='tabhead' id='h$n' onclick='collapse();toggle($n)'>Tab $n</div>
        <div class='tabcontent' id='d$n'>$lorum</div>";
  $resp->script('collapse()');
  $resp->append('accdiv','innerHTML',$s);
  return $resp;
}
function usertab($data){
  $n = getNextIndex();
  extract($data);
  $resp = new xajaxResponse();

  $s = "<div class='tabhead' id='h$n' onclick='collapse();toggle($n)'>$title</div>
        <div class='tabcontent' id='d$n'>$text</div>";
  $resp->append('accdiv','innerHTML',$s);
  return $resp;
}  
  

$xajax->register(XAJAX_FUNCTION,'addatab');
$xajax->register(XAJAX_FUNCTION,'usertab');
$xajax->processRequest();

/**
* Called at load time to put some initial tabs.
*/
function puttab($title, $contents=''){
  global $lorum;
  if($contents=='')
    $contents=$lorum;
  $n = getNextIndex();
  $s = "<div class='tabhead' id='h$n' onclick='collapse();toggle($n)'>$title</div>";
  $s .= "<div class='tabcontent' id='d$n'>$contents</div>";
  echo $s; 
}    
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php $xajax->printJavascript(); ?>
<title>accordion thing</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript">
  //Add a tab with xajax
  function addtab(){
    xajax_addatab();
  }

  //Toggle a tab's visibility - onclick handler for header divs
  //Add the yellow background when content is visible.
  function toggle(n){
    header  = '#h'+n; //head div id
    content = '#d'+n; //content div id
    //alert('Header id = ' + header + '   Content id = '+content);//debugging 

    $(content).toggle(); //show or hide the content div

    //Remove the yellow background from the header div if content is hidden
    if ($(content).css("display")== 'none')
      $(header).removeClass('yellowbg');
    else
      $(header).addClass('yellowbg');
  }
  function collapse(){
    $('.tabcontent').hide();               //hide all of the content divs
    $('.tabhead').removeClass('yellowbg'); //remove any yellowbg class ocurrances
  }
  function openall(){
    $('.tabcontent').show(); //Show all of the content divs
    $('.tabhead').addClass('yellowbg'); //Add yellowbg class to all headers.
  }
</script>

<style>
  /* The accordion container */
  #accdiv{
    -moz-border-radius: 5px;
    background-color: blue;
    color:white;
    width: 300px;
    border: 1px solid blue;
    margin: 10px auto;
  }
  /* Tab head divs */  
  .tabhead{
    background-color: blue;
    color:white;
    height: 25px;
    cursor: pointer;
    padding: 2px;
  }
  .tabhead:hover{
    color: green;
  }
  .yellowbg{
    background-color:yellow;
    color: black;
    font-weight: bold;
  }
  /* Tab content divs */
  .tabcontent{
    background-color: blue;
    color:white;
    display: none;
    margin-bottom: 10px;
    padding: 2px;
    border: 1px solid gray;
  }
</style>  
</head>
<body>
<input type="button" onclick="addtab()" value="New Tab"/>
<input type="button" value="Open All" onclick="openall()"/>
<input type="button" value="Close All" onclick="collapse()"/><br/>
<fieldset style="width:30px">
<legend>Add your own</legend>
<form id="form1">
<label>Title</label><br/>
<input id="title" name="title"/>
<textarea id="text" name="text" cols="40" rows="10"></textarea><br/>
<input type="button" value="Add" onclick="xajax_usertab(xajax.getFormValues('form1'))"/>
</form>
</fieldset>
<div id="accdiv">
<?php
  //Make a few initial tabs...
  puttab('Dogs');
  puttab('Cats');
  puttab('Rats');
?>
</div>
</body>
</html>
</div>