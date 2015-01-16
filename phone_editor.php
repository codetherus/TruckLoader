<?php
/*
  7/12/2010
  Phone/Contact manager
*/
require_once("commons.php");
require_once("utilityv2.php");
$smarty->assign("pgtitle", "Contact / Phone Management");
$smarty->assign("domenu", 1);
$smarty->assign("dosearch", 1);
//---------------------- Select list generation procedures ---------------
function AddOption(&$s,$val,$disp,$sel=''){
  if ($val == $sel)
    $s .= "<option value='$val' selected>$disp</option>\n";
  else
    $s .= "<option value='$val'>$disp</option>\n";
}  
    

function MakeEntityTypes($type=''){
  $s = "<select id='entity_type' name='entity_type' onchange='xajax_GenerateEntityList(this.value)'>\n";
  AddOption($s,'','');
  AddOption($s,'Agent','Agent',$type);
  AddOption($s,'Broker','Broker',$type);
  AddOption($s,'Driver','Driver',$type);
  $s .= '</select>';
  return $s;
}

function MakeContactTypes($type=''){
  $s = "<select id='contact_type' name='contact_type'>\n";
  AddOption($s,'','');
  AddOPtion($s,'Home','Home',$type);
  AddOPtion($s,'Cell','Cell',$type);
  AddOption($s,'Fax','Fax',$type);
  AddOption($s,'Email','Email',$type);
  AddOption($s,'Other','Other',$type);
  $s .= '</select>';
  return $s;
}
//Get the entity names for the selected type
function GenerateEntityList($dta,$val=''){
  global $db;
  if ($dta == 'Agent')
    $sql = "select id, user_name as vlu from users where level <> 'broker' and user_name <> '' order by user_name";
  else if ($dta == 'Broker')
    $sql = " select id, company as vlu from brokers order by company";
  else
    $sql = "select id, name as vlu from drivers order by name";
  $res = $db->get_results($sql);
  $s = "<select id='entityid' name='entityid'>\n";
  $s .= "<option value=''>&nbsp;</option>";
  foreach ($res as $row)
  {
    $id = $row->id;
    $vlu = $row->vlu;
    $s .= "<option value='$id' ";
    if ($id == $val)
      $s .= "selected";
    $s .= ">$vlu</option>\n";
  }
  $s .= "</select>\n";
  $resp = new xajaxResponse();
  $resp->assign("lentity","innerHTML", $s);
  return $resp;
}
//------------------------ End Select List Procedures --------------------
//Read the agent,driver,broker
function FetchEntity($entityid, $entity_type){
  global $db;
  if ($entity_type == 'Agent')
    $sql = "select user_name as vlu from users";
  else if ($entity_type == 'Broker')
    $sql = "select company as vlu from brokers";
  else
    $sql = "select name as vlu from drivers";
  $sql .= " where id = $entityid";  
  $res = $db->get_row($sql);
  return $res->vlu;
}

/*
this does a lookup and displays a floatbox list of matches.
A single match just does a read.
  
*/
function Lookup($dta){
  global $db;
  $resp= new xajaxResponse();
  extract($dta);
  //Setup the where clause using the passed params.
  $where = '';
  if ($contact_type != '')
    $where = "contact_type = '$contact_type'";
  if ($entity_type != '')
  {
    if ($where == '')
      $where = "entity_type = '$entity_type'";
    else
      $where .= " and entity_type = '$entity_type'";
  }
  if ($entityid != '')
  {
    if ($where == '')
      $where = "entityid = '$entityid'";
    else
      $where .= " and entityid = '$entityid'";
  }
  if ($where != '')
    $where = "where ".$where." ";
  
  $sql = "select * from phones $where order by entity_name,entity_type,contact_type";
//  $resp->alert($sql);
//  return $resp;
  $res = $db->get_results($sql);
  //Check for 0 or 1 results
  if ($db->num_rows < 1)
    return xajaxAlert("No Records found","");
  if ($db->num_rows == 1)
  {
    $id = $res[0]->id;
    return Read($id);
  }

  // n> 1 users. Build a floatbox table
  $s = "<center><br/><br/><table border='1' style='color: black'>\n";
  $s .= "<tr><th>Entity Type<th>Entity<th>Contact Type<th>Value</tr>";
  foreach($res as $rw)
  {
    $entityvalue = $rw->entity_name;
    
    $s .= "<tr><td><a href='#' onclick=\"fb.end();xajax_Process($rw->id,'read')\">$rw->entity_type</a></td>";
    $s .= "<td>$entityvalue<td>$rw->contact_type<td>$rw->entity</tr>\n";
  }
  $s .= "</table></center\n";
  return GenFloatbox($s);
}
/*
  Read record by id. Called from the browser
  find display created by Lookup() function.
*/
function Read($dta){
  global $db;
  $resp= new xajaxResponse();
  $sql = "select * from phones where id = $dta";
  $res = $db->get_row($sql);
  if ($db->num_rows == 0)
  {
    $resp->alert("No matching user found. SQL: $sql");
    return $resp;
  }
  $resp->assign("current_record_id","value",$res->id);
  $resp->assign("lcontact_type","innerHTML",MakeContactTypes($res->contact_type));
  $resp->assign("lentity_type","innerHTML",MakeEntityTypes($res->entity_type));
  $resp-> assign("entity","value",$res->entity);
  $resp->loadCommands(GenerateEntityList($res->entity_type,$res->entityid));
  return $resp;
}

function Insert($dta){
  global $db;
  $resp= new xajaxResponse();
  extract($dta);
  if ($entityid == '')
    $entityid = 0;
  $entity_name = FetchEntity($entityid, $entity_type);
  $sql = "insert into phones (contact_type,entityid,entity,entity_type,entity_name) ";
  $sql .= "values('$contact_type',$entityid,'$entity','$entity_type','$entity_name')";
  QueryLog($sql);
  $db->query($sql);
  if ($db->rows_affected == 0)
  {  
    $resp->assign("current_record_id","value", "");
    $resp->alert("Record insert failed $sql");
  }
  else
  {
    $resp->assign("current_record_id","value", $db->insert_id);
    $resp->alert("Contact inserted.");
  }
  return $resp;
}
function Update($dta){
  global $db;  
//  return ShowData($dta);
  $resp= new xajaxResponse();  
  $id = $dta['current_record_id'];
  if ($id == '')
    return xajaxAlert("No record id value available. Must read before update.");
  if ($dta['entity'] == '')
    return xajaxAlert("PLease provide the number value.");
  extract($dta);
  $sql = "update phones set entity='$entity' where id = $id";
  $db->query($sql);
  if($db->rows_affected == -1)
    return xajaxAlert("Failed to update the contact record. SQL: $sql");
  else
    return xajaxAlert("Record Updated.");
  return $resp;
}
function Delete($dta){
  global $db;
  $resp= new xajaxResponse();
  $id = $dta['current_record_id'];
  if ($id == '')
  {
    $resp->alert("No record id value available. Must read befpre delete.");
    return $resp;
  }
  $sql = "delete from phones where id = $id";
  $db->query($sql);
  if ($db->rows_affected == 0)
    $resp->alert("Failed to delete the contact record.");
  else
    $resp->alert("Record Deleted.");
  return $resp;
}

/*
  Edit operations dispatcher
  Params:
  $dta - Form data
  $op  - Operation code
*/
function Process($dta,$op){
  switch($op){
  case "find":
    return Lookup($dta);
    break;
  case "read":
    return Read($dta);
    break;
  case "insert":
    return Insert($dta);
    break;
  case "update":
    return Update($dta);
    break;
  case "delete":
    return Delete($dta);
  default:
    return xajaxAlert("Invalid operation code submitted: $op");
  }
}

//$xajax->configure('debug',true);
$xajax->register(XAJAX_FUNCTION,"Process");
$xajax->register(XAJAX_FUNCTION,"GenerateEntityList");
$xajax->processRequest();
$smarty->assign("entity_type", MakeEntityTypes());
$smarty->assign("contact_type", MakeContactTypes());
GenerateSmartyPage();
?>