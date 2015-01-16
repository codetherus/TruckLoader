<?php
/*
  09/29/2010 Tilt Interface for Loads by Jake
  
  This code is used to access the Transport Investments Logistics Tool (TILT)
  web site.
  The site is done in ASPX pages, thus making things a bit messy.
  The interface uses the cURL library to scrape the screens and submit
  requests.
  Most of the pages have a "__VIEWSTATE" hidden variable defined that must
  be included in the submission.
  Another is "__EVENTVALIDATION" but it does not appear on all pages.
*/
require_once("TiltCredentials.php"); //Authorization variables
class TiltInterface{
var $ch = '';               //The curl instance variable
var $curlresult = '';       //Global curl exec result.
var $curlerror = '';        //Global curl error message.
var $viewstate = '';        //Global aspx viewstate value
var $eventvalidation = '';  //Global aspx eventvalidation value.
var $pmsg = '';             //Global post variables
var $ref_url = '';          //THe refering page url

function CheckError($cap=''){
  $this->curlerror = curl_error($this->ch);
  if ($this->curlerror != ''){
    $ernum = curl_errno($this->ch);
    $this->curlerror .= ' Err#: '.$ernum;
    if ($cap != '')
      $this->curlerror = $cap.' '.$this->curlerror;
    return false;
  }
  else
    return true;
}  

/*
  Setup the global curl object
*/
function SetupCurlInstance(){
  $this->ch = curl_init();
  curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);                    //Return the results to a variable
  curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($this->ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)"); 
  curl_setopt($this->ch, CURLOPT_VERBOSE, 1);                           //Want expanded return
  curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($this->ch, CURLOPT_HEADER, 0);
  curl_setopt($this->ch, CURLOPT_COOKIEFILE, 'cookiefile.txt'); 
  curl_setopt($this->ch, CURLOPT_COOKIEJAR, 'cookiefile.txt');
  return $this->CheckError('Setup Error');
}

function Run_CurlQuery($capt=''){
  $this->curlresult = curl_exec($this->ch);
  return $this->CheckError($capt);
}

//Extract the aspx __VIEWSTATE value
function GetViewstate(){
  $i = strpos($this->curlresult,'id="__VIEWSTATE" value="');
  if (!$i) return;
  $i += strlen('id="__VIEWSTATE" value="');
  $j = strpos($this->curlresult,'"',$i+1);
  $this->viewstate= urlencode(trim(substr($this->curlresult,$i,$j-$i)));
/*
  echo '<br>Decoded viewstate:<br>';
  echo base64_decode(urldecode($this->viewstate));
  echo '<br>End decoded viewstate<br>';
*/
  if ($this->viewstate != '')
    $this->pmsg .= "&__VIEWSTATE=".$this->viewstate;
}

//Extract the aspx eventvalidation value
function GetEventValidation(){
  $i = strpos($this->curlresult,'id="__EVENTVALIDATION" value="');
  $i += strlen('id="__EVENTVALIDATION" value="');
  $this->eventvalidation = urlencode(trim(substr($this->curlresult,$i,72)));
  if ($this->eventvalidation != '')
    $this->pmsg .= "&__EVENTVALIDATION=".$this->eventvalidation;
}  
//----------------------- Login functions -------------------
function GetBasePage(){
  global $tiltURL;
  curl_setopt($this->ch,CURLOPT_URL,$tiltURL);
  curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1); 
  $this->curlresult = curl_exec($this->ch);
  return $this->CheckError('Get Base Page');
}

//Connect to the TILT site.
function TILT_Login($userid, $password){
  $this->ref_url = 'Login.aspx';
  if (!$this->ch){
      if (!$this->SetupCurlInstance()){
       return false;
    }
  }
  $this->pmsg="textboxUsername=".$userid."&textboxPassword=".$password;
  $this->pmsg .="&buttonLogin.x=0&buttonLogin.y=0"; //Add the button image xy or it won't work...
  //Get the login page so we can get the viewstate from it.
  if (!$this->GetBasePage())
   return false;
  $this->GetViewstate();
  $this->GetEventValidation();
  curl_setopt($this->ch,CURLOPT_URL,"http://Tilttest.transportinvestments.com/Login.aspx");
  curl_setopt($this->ch, CURLOPT_POST, 1);                              //Set it to run a post transaction
  curl_setopt($this->ch, CURLOPT_POSTFIELDS, $this->pmsg);                    //Put the post message
  curl_setopt($this->ch, CURLOPT_REFERER, $this->ref_url);
  $this->curlresult = curl_exec($this->ch);
  return $this->CheckError('Login Exec error 3');
}  
//------------------------ Search functions -------------------------------------
//Read the order serch page so we can extract what we need...
function GetTiltSearchPage(){
  curl_setopt($this->ch,CURLOPT_URL,"http://Tilttest.transportinvestments.com/OrderSearch.aspx");
  $this->curlresult = curl_exec($this->ch);
  return $this->CheckError('GetTiltSearchPage() ');
  
}
//Trying to mimic their viewstate
function AddSearchFields(){
  include("TILTOrderSearchFields.php");
  $this->pmsg .= urlencode($searchfields);
}

//Run the search.
function RunTiltSearch($loadnum){
  //Login to tilt
  if (!$this->Tilt_Login($tiltUsername,$tiltpassword))
    return false;

  $orderid = 'ctl00_cphMainContent_tbxSearchOrderNumber'; //Order number field id
  $btnid = 'ctl00$cphMainContent$btnSearch';
  $this->pmsg = '';
  //Setup the submit button
  //$this->pmsg = 'ctl00$cphMainContent$btnSearch.x=0&ctl00$cphMainContent$btnSearch.y=0';
  //Construct our viewstate for the order number
  $localviewstate = $orderid.$btnid;
  $localviewstate .= SHA1($localviewstate);
  $localviewstate=(base64_encode($localviewstate));
  $this->pmsg .= '&_VIEWSTATE='.$localviewstate;
  //Setup the submit button
  $this->pmsg .= '&ctl00$cphMainContent$btnSearch.x=0&ctl00$cphMainContent$btnSearch.y=0';
  //Add the order number field...
  $this->pmsg .= '&'.$orderid.'='.$loadnum;
  echo 'Post message:<br>';
  echo $this->pmsg.'<br>';
  curl_setopt($this->ch,CURLOPT_URL,"http://Tilttest.transportinvestments.com/OrderSearch.aspx");
  curl_setopt($this->ch, CURLOPT_POST, 1);                              //Set it to run a post transaction
  curl_setopt($this->ch, CURLOPT_POSTFIELDS, $this->pmsg);                    //Put the post message
  curl_setopt($this->ch, CURLOPT_REFERER, 'OrderSearch.aspx');
  $this->Run_CurlQuery('RunTiltSearch');
  echo 'Tilt Search Result:<br>'.$this->curlresult;
  return $this->CheckError('RunTiltSearch()');  
}

function TiltClose(){
  curl_close($this->ch);
}
} 
?>