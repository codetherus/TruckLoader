<?php
include_once("xajax/xajax_core/xajax.inc.php");
$xajax = new xajax();
$xajax->configure('javascript URI', 'xajax/');
//MySQL classes for database access
include_once('ezsql/mysql/ez_sql_core.php');
include_once('ezsql/mysql/ez_sql_mysql.php');
include('dbsettings.php');
$db = new ezSQL_mysql($dbuser, $dbpassword, $dbdatabase, $dbhost);

  $xajax->registerFunction("auto_complete");
  
  function auto_complete($mask, $target, $list) {
    global $db;
    $objResponse = new xajaxResponse();
    $sql = "select id,driver from truck_loader where driver like '$mask%' limit 20";
    $results = $db->get_results($sql);
    if (!$results)
    {
      $objResponse->assign('search_results','style.display','none');
      return $objResponse;
    }
    $s = '';
    foreach ($results as $result) {
      $d = htmlentities($result->driver,ENT_QUOTES);
      $s .= "<a onclick=\"populate_id('$target','$d');\">$d</a>";
    }
    // Tell our hidden search_results div to show itself.
    $objResponse->assign($list,'style.display','block');
    $objResponse->assign($list,'innerHTML',$s);
    // Research if needed.
    $objResponse->script('do_research();');
    return $objResponse;
  }
  //$xajax->configure('debug',true);
  $xajax->processRequest();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Auto Complete Example</title>
<style>
.hidden_field {
  /* This is important display must be none by default, and postion MUST
     Be absolute.  Otherwise our results cause the page to jump all over  */
  position:absolute;
  display:none;
  color: white;
  background: black;
  border: 1px solid;
}
 
.hidden_field A {
  display:block;
  cursor: pointer;
}
 
.hidden_field A:hover {
  background: silver;
  color: black
}
label{
  display: inline-block;
  width: 200px;
  text-align: right;
}
 
</style>
<?php $xajax->printJavascript(); // output the xajax ?>
<script type="text/javascript">
  // This code can be anywhere on your page.
  search_pending = false;
  research = false;
  // Part of the problem with searching doing an autocomplete
  // is the lag involved.  You don't want 2 requests going at once.
  // This 'gate' allows only 1 query at a time.
  
  function do_search(o) {
    //Another search in progress?
    if (search_pending == true) {
      research = true;
      return;
    } 
    target = o.id; //Id tag value of the target input
    s = xajax.$(target).value;
    if (s == '') return;
    listing = target + '_results'; //Target id of the list of returned values.
    search_pending = true;
    xajax_auto_complete(s,target,listing);
  }
 
  function do_research() {
    search_pending = false;
    if (research) {
      // There was more input since the last search.
      research = false;
      do_search();
    }
  }
  
  //Populate the target input
  function populate_id(id,val)
  {
    xajax.$(id).value = val;
    res = id + '_results';
    xajax.$(res).style.display = 'none';
  }
  //Hide the search results
  function hidelist(o)
  {
    s = o.id;
    s = s + '_results';
    xajax.$(s).style.display = 'none';
  }
</script>
</head>
<body>
<form method="post" id="my_form_id">

<label>Driver Name:</label><input name="search" id="search"  onkeyup="do_search(this);"/>
<div id="search_results" class='hidden_field'></div>
<br/>
<label>Another Driver Name:</label>
<input name="search2" id="search2"  onkeyup="do_search(this);"/>         
<div id="search2_results" class='hidden_field'></div>  
</form>
</body>
</html>
