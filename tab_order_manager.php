<?php
/*
  Custom tab order manager.
  Users want to be able to specify a tab order on certain pages on the site.
  We will store their definitions in a db table and load the order using
  Smarty tags in the template files.
*/
require_once("commons.php");
require_once("utility.php");
$smarty->assign("pgtitle", "Tab Order Manager");
$smarty->assign("domenu", 1);
/*
  Create a select giving the pages the users can customize.
*/
function MakePageListSelect()
{
  $s = "<select id='thepage' name='thepage'>\n";
  $s .= "<option value='Edit'>Driver Editor</option>\n";
  $s .= "<option value='new_load'>New Driver</option>\n";
  $s .= "</select>\n";
  return $s;
}

function UpdateDefs($dta)
{
  global $db;
  $resp = new xajaxResponse();
  $resp->alert(print_r($dta,true));
  extract($dta);
  return $resp;
}

function DeleteDefs($dta)  
{
  global $db;
  $resp = new xajaxResponse();
  extract($dta);
  return $resp;
}
//Extract the text from a label tag.
function ExtractLabel($s)
{
  $i = strpos($s,'<label');
  if ($i !== false)
  {
    $i = strpos($s,'>'); //Close after <label>.
    $i++; //First position of text.
    $j = strpos($s,'<',$i); //Open after the label text.
    return substr($s,$i,$j-$i); //The text;
  }
}

//Pull the id value from the line.
//Param is the string to scan
//The id value may be single or double quoted.
function ExtractID($s)
{
  $i = strpos($s,'id="'); //Look for double quoted id value
  if($i === false)
  {
    $i = strpos($s,"id='"); //Look for single quoted id value
    if ($i === false)
      return false; //Bail if still not found
    else
      $separator = "'";
  }
  else
   $separator = '"';
  $i += 4; //point after the id= string 
  $j = strpos($s,$separator, $i);
  //if ($j === false) return false;
  return substr($s,$i,$j-$i);
}
    
/*
  Read a template and create a table of
  its tabbable elements for display.
  Called when DisplayDefs finds nothing defined.
*/
function MakeNewPageDisplay($page)
{
  //Read the template file.
  $pg = "smarty/templates/$page".".tpl";
  $template = file($pg);
  if (!$template) return false;
  $fieldcount = 1;
  $label = '';  
  $s = "<table border='1'>\n";
  $s .= "<tr><th>Label</th><th>Id</th><th>Type</th><th>Tab Order</th></tr>\n";
  foreach($template as $line)
  {
    //Check for a label in this line. Will carry on 'til next label found.
    if (strpos($line,'<label') !== false)
      $label = ExtractLabel($line);
    //Check for a settable control.
    $control = '';
    if (strpos($line,'<textarea') !== false)
      $control = 'textarea';
    else if (strpos($line,'radio') !== false)
      $control = 'radio';
    else if (strpos($line,'checkbox') !== false)
      $control = 'checkbox';
    else if (strpos($line,'<input') !== false)
      $control = 'input';

    if ($control == '') continue;
    $id = ExtractId($line);
    if ($id === false) continue;
    $s .= "<tr><td>$label</td><td><input name='ids[]' 
                                   value='$id' readonly style='border: none;color: white; background-color:black' tabindex=-1>
           </td><td>$control</td><td><input name='to[]' size='1' value='$fieldcount'</td></tr>\n";
    $fieldcount++;
  }
  $s .= "</table>\n";
  return $s;
}
/*
  Display the current definitions for the specified page.
  Will read the database for the office nad use any existiing records.
  If none are defined, read the template and display all of the controls
  that we can set the order on.
*/
function DisplayDefs($dta)  
{
  global $db;
  $resp = new xajaxResponse();
  extract($dta);
  $s = MakeNewPageDisplay($thepage);
  if (!$s)
    $resp->alert("Unable to read the page template. Please Call For Help...");
  else
    $resp->assign("tabset","innerHTML", $s);
  return $resp;
}


/*
  Operation dispatcher function.
  $op is the op code from the browser - maps to a function.
  $dta if the data from the browser.
*/
function Dispatch($op, $dta)
{
  if ($op == 'update')
    return UpdateDefs($dta);
  else if ($op == 'delete')
    return DeleteDefs($dta);
  else if ($op == 'read')
    return DisplayDefs($dta);
  else
  {
    $resp = new xajaxResponse();
    $resp->alert("Invalid op code: $op");
    return $resp;
  }
}
$smarty->assign("pagelist",MakePageListSelect());
//$xajax->configure('debug',true);
$xajax->register(XAJAX_FUNCTION,"Dispatch");
$xajax->processRequest();
GenerateSmartyPage();
?>