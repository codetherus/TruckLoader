<?php
/*
  PHP Database form generator.
  Given a table name in the DB, it
  generates Smarty template for it
  and the php page to use it.
  
  The idea is to generate the html source to
  save a lot of typing and typos.
*/
//Setup the xajax framework.
ob_start();
include_once("xajax/xajax_core/xajax.inc.php");
$xajax = new xajax();
$xajax->configure('javascript URI', 'xajax/');
//Setup the database access tools
include_once('ezsql/mysql/ez_sql_core.php');
include_once('ezsql/mysql/ez_sql_mysql.php');
include('dbsettings.php');
$db = new ezSQL_mysql($dbuser, $dbpassword, $dbdatabase, $dbhost);

//Make a select of the control types we recognize.
function GenControlSelect(){
  $opts = array('text','checkbox','radio','textarea','select','hidden');
  $s = "<select id='controls[]' name='controls[]'>";
  for ($i=0;$i<count($opts);$i++){
    $s .="<option value='$opts[$i]'>$opts[$i]</option>";
  }
  $s .= "</select";
  return $s;  
}
//Setup the form for the user input.
function ShowTable($dta){
  global $db;
  $resp = new xajaxResponse();
  $tbl = $dta['tblname'];
  $labelbreak = $dta['breakafter'];
  $sql = 'select * from '.$tbl.' where 1';
  $res = @$db->query($sql);
  if (!$res){
    $resp->alert('Table not found');
    return $resp;
  }
  $names = array();
  $types = array();
  foreach($db->get_col_info('name') as $name)
    $names[] = $name;
  foreach($db->get_col_info('type') as $type)
    $types[] = $type;
  $s = '<form id="form1">';
  $s .= "<input type='hidden' name='tbl' id='tbl' value='$tbl'>";
  $s .= "<input type='hidden' name='breaks' id='breaks' value='$labelbreak'/>";
  $s .= '<table border=1>';
  $s .='<tr><th>Field Name<th>Data Type<th>Form Label<th>Control Type</tr>';
  $cs = GenControlSelect();
  for ($i=0;$i<count($names);$i++){
    $field = $names[$i];
    $fieldtype = $types[$i];
    
    $s .= "<tr><td><input name='fields[]' value='$field' readonly tabindex='-1' /></td>
           <td><input name='types[]' value='$fieldtype' readonly tabindex='-1' /></td>
           <td><input name='labels[]' value=''/></td><td>$cs</td></tr>";
  }
  $s .= '</table></form>';
  $s .= "<input type='button' value='Generate' onclick=\"xajax_GenerateForm(xajax.getFormValues('form1'))\"/>";  
  $s .= "<br/><br/>";
  $resp->assign('tabledefs','innerHTML',$s);
  return $resp;
}

function FindMaxLabelWidth($fields){
  $maxwidth = 0;
  for ($i=0;$i<count($fields);$i++){
    $thiswidth = strlen($fields[$i]);
    if ($thiswidth > $maxwidth)
      $maxwidth = $thiswidth;
  }
  $maxwidth *= 5;
  return $maxwidth;
}
function GenerateForm($dta){
  $resp = new xajaxResponse();
  extract($dta);
  $fc = 0;
  $labelwidth = FindMaxLabelWidth($fields);
  $labelwidth .= 'px';
  if ($breaks)
    $ta = 'left';
  else
    $ta = 'right';
  $labelstyle="style='display:inline-block;text-align:$ta; width:$labelwidth;'";
  //$resp->alert("Label width: $labelwidth");
  for ($i=0;$i<count($fields);$i++){
    $label = $labels[$i];
    if ($label == '') continue;
    $fc++;
    $field = $fields[$i];
    $fieldtype = $types[$i];
    $controltype = $controls[$i];
    $fv='{$'.$field.'}';
    if ($controltype != 'hidden'){
      $s .= "<label $labelstyle>$label</label>";
      if ($breaks == 'yes')
        $s .= "<br/>";
    }
    $s .= "\n";
    switch($controltype){
      case 'text':
        $s .= "<input type='text' id='$field' name='$field' value=$fv />";
        break;
      case 'checkkbox':
        $s .= "<input type='checkbox' id='$field' name='$field' value=$fv />";
        break;
      case 'radio':
        $s .= "<input type='radio' id='$field' name='$field' value=$fv />";
        break;
      case 'textarea':
        $s .= "<textarea id='$field' name='$field' value='$fv'></textarea>";
        break;
      case 'select':
        $s .= "<select id='$field' name='$field'></select>";  
        break;
      case 'hidden':
        $s .= "<input type='hidden' id='$label' name='$label' value=$fv />\n";
        break;
      default: 
        $s .= "<input type='text' id='$field' name='$field' value=$fv />";   
    }
    if ($controltype != 'hidden')
      $s .= '<br/>'."\n";
  }
  //Save the template
  $fname="smarty/templates/$tbl.template.tpl";
  //$resp->alert("Generated $fc fields");
  //$resp->alert("Template Name: $fname");
  file_put_contents($fname,$s);
  $resp->assign('generatedcode',innerHTML,$s);
  return $resp;
}
//$xajax->configure('debug',true);
$xajax->register(XAJAX_FUNCTION,'GenerateForm');
$xajax->register(XAJAX_FUNCTION,'ShowTable');
$xajax->processRequest();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<?php $xajax->printJavascript(); ?>
</head>
<body>
<form id="formopts">
<label>Table Name:</label>
<input id="tblname" name="tblname"/><label>Break after labels?</label>
<input type="checkbox" id="breakafter" name="breakafter" value="yes"/>
</form>
<input type="button" value="Go" onclick= "xajax_ShowTable(xajax.getFormValues('formopts'))">
<div id="tabledefs"></div>
<div id="generatedcode">
</div>
</body>
</html>