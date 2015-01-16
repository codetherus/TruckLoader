<?php
/*
  Editor page for Jakes Loads
*/
require_once("commons.php");
$smarty->assign("pgtitle", "Private Notes"); 
$smarty->assign("domenu", 1);
//Build the record for editing
function DisplayNotes()
{
  global $db;
	$driverid = $_SESSION['lastid']; //The target record
	$userid = $_SESSION['userid'];
	$sql = "select * from private_notes where driver = $driverid and user = $userid";
	$res = $db->get_row($sql);
	//return print_r($res,true);
	
	if (!$res)
	{
		$comments = '';
		$_SESSION['note_id'] = -1;
	}
	else
	{
	  $_SESSION['note_id'] = $res->id;//Save for update/delete
    $comments = $res->comments;
	}
	$s = '';
	
	  $s .= "<textarea rows='10' cols='62' id='comments' name='comments' >$comments</textarea>\n";
  return $s;
}
$smarty->assign("editdata",DisplayNotes());

function UpdateNote($dta)
{
  global $db;
  $resp = new xajaxResponse();
  extract($dta);
  $note_id = $_SESSION['note_id'];
  $userid = $_SESSION['userid'];
  $driverid = $_SESSION['lastid'];
  if ($note_id >= 0)
    $sql = "update private_notes set comments = '$comments' where id = $note_id";
  else
  {
    $sql = "insert into private_notes(user, driver, comments) ";
    $sql .= "values($userid, $driverid, '$comments')";
  }
  if (!$db->query($sql))
  { 
    $resp->alert("Note Update/Save Failed.");
  }
  else
    $resp->alert("Note record updated/saved.");
  return $resp;  
}
function DeleteNote($dta)
{
  global $db;
  $resp = new xajaxResponse();
  $note_id = $_SESSION['note_id'];
  if ($note_id < 0)
  {
    $resp->alert("No note to delete...");
    return $resp;
  }
  $sql = "delete from private_notes where id = $note_id";
  if (!$db->query($sql))
    $resp->alert("Note delete failed...");
  else
    $resp->alert("Note deleted...");
  return $resp;
}
  
function processEdit($op, $dta)
{
  $resp = new xajaxResponse();
  if ($op = 'update')
    return UpdateNote($dta);
  else if ($op = 'delete')
    return DeleteNote($dta);
  else
    $resp->alert("Invalid operation code: $op");
  return $resp;
}
//$xajax->configure('debug',true);
$xajax->register(XAJAX_FUNCTION,'processEdit');
$xajax->processRequest();
GenerateSmartyPage();
?>
