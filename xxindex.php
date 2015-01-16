<?php

/*
  6/21/2011
  This is the new loadsbyjake.com home page.
  It provides links to our loads and trucks as well
  as user login, contacts, quotes and about pages.

  The browser requests a page - see LoadPage() - and
  the page is returned either as a Smarty template or
  as html generated in the code.

  The static pages are stored as html pages and fetched by Smarty.
  The available trucks and loads tables are displayed by the code.

  The template for this page is homepage.tpl in the Smarty
  template dir.

  When the page loads it resets the session so a login becomes necessary.
 */
require_once("commons.php");
require_once("utilityV2.php");
//-------------------User login processing----------------------
//Clear the session variables
$_SESSION = array();              //Clear the session array.
$_SESSION['loggedin'] = false;    //Needs to sign in

function login($dta) {
  global $db;
  $resp = new xajaxResponse();
  extract($dta);
  if ($user == '' || $password == '') {
    return xajaxAlert("Invalid user id and/or password.<br/> Please try again.");
  }
  //Cleanup
  $user = quote_smart($user);
  $password = quote_smart($password);

  $sql = "select * from users where user = '$user' and password = '$password'";
  $res = $db->get_row($sql);
  if (!$res) {
    return xajaxAlert("Invalid user id and/or password.<br/>Please try again.");
  }

  //Setup the session vars and go to the search page.
  $_SESSION['loggedin'] = true;
  $_SESSION['user'] = $user;
  $_SESSION['userid'] = $res->id;
  $_SESSION['level'] = $res->level;
  $_SESSION['theme'] = $res->theme;
  $_SESSION['officeid'] = $res->officeid;
  $_SESSION['google_user'] = $res->google_user;
  $_SESSION['googlepassword'] = $res->google_password;
  $resp->redirect("searchv2.php");
  return $resp;
}

$xajax->register(XAJAX_FUNCTION, "login");

//--------------------- Quote Processing --------------------------
//Check the required inputs.
function validateInputs($dta) {
  $s = '';
  extract($dta);
  if ($contactname == '')
    $s .= "Contact Name<br/>";
  if ($phone == '')
    $s .= "Phone<br/>";
  if ($company == '')
    $s .= "Company<br/>";
  if ($commodity == '')
    $s .= "Commodity<br/>";
  if ($weight == '')
    $s .= "Weight<br/>";
  if ($origin == '')
    $s .= "Origin<br/>";
  if ($destination == '')
    $s .= "Destination<br/>";
  if ($loadtype == '')
    $s .= "Type<br/>";
  if ($s != '')
    $s = "Please provide the following:<br/>" . $s;
  return $s;
}

//Validate the input and do the email
function sendQuoteRequest($dta) {
  $resp = new xajaxResponse();

  //Validate the required inputs.
  $s = validateInputs($dta);
  if ($s != '') {
    return xajaxAlert($s);
    return $resp;
  }
  extract($dta);
  //$to="edrobinsonjr@gmail.com"; //Testing
  $to = "jake@loadsbyjake.com"; //Recipient address
  $subject = "Load Quote Request";
  $s = "Contact Name: $contactname\n";
  $s .= "Phone: $phone\n";
  $s .= "Email: $email\n";
  $s .= "Company: $company\n";
  $s .= "Commodity: $commodity\n";
  $s .= "Weight: $weight\n";
  $s .= "Origin: $origin\n";
  $s .= "Destination: $destination\n";
  $s .= "Load Type: $loadtype\n";
  if (is_array($lengths)) {
    $s .= "Lengths: ";
    foreach ($lengths as $len)
      $s .= $len . ', ';
    $s .= "\n";
  }
  if ($comments != '')
    $s .= "Comments: $comments\n";
  $res = mail($to, $subject, $s);
  if (!$res)
    return xajaxAlert("Problem sending the email. Please call us.");
  else
    return xajaxAlert("Your request has been sent<br/>Thanks  you for your inquiry");
}

$xajax->register(XAJAX_FUNCTION, "sendQuoteRequest");

//----------------------Contact Request----------------------------
function ProcessContactRequest($dta) {
  $resp = new xajaxResponse();
  extract($dta);
  $to = "jake@loadsbyjake.com"; //Recipient address
  $subject = "Contact Request";
  $s = "Contact Name: $name\n";
  $s .= "Phone: $phone\n";
  $s .= "Email: $email\n";
  if ($comments != '')
    $s .= "Comments: $comments\n";
  $res = @mail($to, $subject, $s);
  if (!$res)
    return xajaxAlert("Problem sending the email. Please call us.");
  else
    return xajaxAlert("Your request has been sent<br/>Thanks  you for your inquiry");
}

$xajax->register(XAJAX_FUNCTION, "ProcessContactRequest");

//----------------------Truck list processing------------------------
function ErrMsg($s) {
  $resp = new xajaxResponse();
  $resp->alert($s);
  return $resp;
}

function MakeDayList() {
  $date = new DateTime();  //today
  $date->modify('-2 day'); //2 days ago
  $from = "'" . $date->format('Y-m-d') . "'";
  $date->modify('4 day'); //2 days hence
  $to = "'" . $date->format('Y-m-d') . "'";
  $uld = "delivery_date between $from and $to";
  return $uld;
}

function TruckList() {
  global $db;
  $resp = new xajaxResponse();
  $sql = "select loads.*, drivers.* from loads,drivers where loads.driverid = drivers.id and loads.id = drivers.loadid ";
  $sql .= "and drivers.status = 'Active' and " . MakeDayList() . " order by delivery_date";
  $res = $db->get_results($sql);
  if (!$res) {
    return xajaxAlert("No trucks available right now. Please try again later.");
  }
  $s = '';
  $s .= "<table id='flex' border='1'cellpadding='5'cellspacing='4' border-collapse: collapse;  style=' margin: 0 auto;'>\n";
  $s .= "<Caption><b>Driver Availability List<br>For more information contact us at (208) 845-0853</b></caption>\n";
  $s .= "<tr><th>Email<th align='left'>Equipment<th align='left'>Unload Location<th>Unload Date</tr>\n";
  $email = "<a href='mailto:jake@loadsbyjake.com'>Email Us</a>";

  foreach ($res as $rw) {
    $driver = strtoupper($rw->name);
    if ($driver == '')
      continue;
    $loadnum = $rw->load_number;
    //filter out old loads by id      
    if (substr($loadnum, 0, 3) == 'Sep' || substr($loadnum, 0, 3) == 'Oct')
      continue;

    $location = strtoupper($rw->delivery_location);
    if ($location == '')
      continue;
    $unloaddate = $rw->delivery_date;
    $tlength = $rw->tlength;
    $ttype = $rw->ttype;
    $equip = '';
    if ($ttype != 'Dont Know') {
      if ($tlength != '')
        $equip = $tlength . "ft ";
      $equip .= $ttype;
    }
    else
      $equip = "Unknown";

    $subject = "Inquiry about $equip driven by $driver arriving in $location on $unloaddate (Your Load #: $loadnum)";
    $email = "<a href='mailto:jake@loadsbyjake.com?subject=$subject'>Email Us</a>";

    $s .= "<tr><td>$email<td align='left'>$equip<td align='left'>$location<td align='left'>$unloaddate</tr>\n";
  }
  $s .= "</table>\n";
  $resp->assign('header2', 'innerHTML', 'Available Trucks');
  $resp->assign('rightcolumn', 'innerHTML', $s);
  return $resp;
}

//-----------------Available loads processing ---------------------------
//Translate military truck type codes
function TranslateEquipment($eqpt) {
  global $db;
  $sql = "select * from uploads_equipment_map where spreadsheet_code = '$eqpt'";
  $res = $db->get_row($sql);
  if (!$res)
    return false;
  else
    return $res->dat_code;
}

function LoadList() {
  global $db;
  $sql = "select * from uploaded_loads where eqpt <> 'AV3' order by ost, ocity";
  $res = $db->get_results($sql);
  if (!$res)
    return xajaxAlert("No loads available at this time.\nPlease try again later.");
  $s = '<div style="padding-left: 25px;">';
  $s .= "<table border='1' style='font-weight: bold; border-collapse: collapse; border-color: gray; margin: 0 auto;'>";
  $s .= "<Caption><b>Load Availability List<br>For more information contact us at (208) 845-0853</b></caption>\n";
  $s .= "<tr><th>Email<th>Origin<th>Pickup Date<th>Destination<th>Delivery Date<th>Weight<th>Length<th>Width
           <th>Height<th>Trailer<th>Notes</tr>";
  foreach ($res as $rw) {
    $origin = $rw->ocity . ', ' . $rw->ost;
    $pickupdate = $rw->pickup_start;
    $destination = $rw->dcity . ', ' . $rw->dst;
    $deliverydate = $rw->delivery_start;
    $weight = $rw->weight;
    $equip = TranslateEquipment($rw->eqpt);
    if ($equip == '')
      continue;
    $len = ceil($rw->len / 12);
    $wid = ceil($rw->wid / 12);
    $hgt = ceil($rw->hgt / 12);
    $notes = '';
    if ($rw->hazmat != '')
      $notes .= 'Hazmat ';
    if ($rw->over_dim != '')
      $notes .= 'Over Dim';


    $subject = "Inquiry about load" . $rw->offer_number;
    $email = "<a href='mailto:jake@loadsbyjake.com?subject=$subject'>Email Us</a>";

    $s .= "<tr><td>$email<td>$origin<td>$pickupdate<td>$destination<td>$deliverydate<td>$weight
               <td>$len<td>$wid<td>$hgt<td>$equip<td>$notes</tr>";
    $s .= "\n";
  }
  $s .= "</table></div>\n";
  $resp = new xajaxResponse();
  $resp->assign('header2', 'innerHTML', 'Available Loads');
  $resp->assign('rightcolumn', 'innerHTML', $s);
  return $resp;
}

//--------------------- Display a page from the pages folder-------------------
//Display a simple text/html page from the pages folder
function DisplayPage($pgname, $ttl) {
  global $smarty;
  $resp = new xajaxResponse();
  /*    $fname = "pages/$pgname" . ".html";
    if (!file_exists($fname))
    return ErrMsg("The file $fname does not exist.");
    $s = file_get_contents($fname);
   */
  $s = $smarty->fetch($pgname . '.html');
  $resp->assign("rightcolumn", "innerHTML", $s);
  $resp->assign("header2", "innerHTML", $ttl);
  $resp->script("doFocus()");
  return $resp;
}

//-----------------Registered page selection/loader processing-----------------
function LoadPage($pid) {
  switch ($pid) {
    case 0:
      return DisplayPage('home', 'Home');
      break;
    case 1:
      return TruckList();
      break;
    case 2:
      return LoadList();
      break;
    case 3:
      return DisplayPage('about', 'About Us');
      break;
    case 4:
      return DisplayPage('contact', 'Contact Us');
      break;
    case 5:
      return DisplayPage('getquote', 'Get a Quote');
    default:
      $resp = new xajaxResponse();
      $resp->alert("Invalid load command: $pid");
      return $resp;
  }
}

$xajax->register(XAJAX_FUNCTION, 'LoadPage');
$xajax->processRequest();
GenerateSmartyPage('homepage.tpl');
?>