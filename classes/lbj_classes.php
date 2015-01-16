<?php
/**
* 5:27 PM 12/7/2011
* Loads by Jake basic entity class definitions
*/

/**
* Base class
*/
class lbj_base{

}

/**
* Define the transport vehicle
*/
class truck{
  protected $number;        //Truck number
  protected $type;          //Truck type code
  protected $length;        //Length in feet
  protected $width;         //Width in inches
  protected $weight;        //Weight in pounds
  protected $driver_id;     //Database driver's id value
  
  function __set($fld, $vlu){
    $this->fld = $vlu;
  }
  function __get($fld){
    if (isset($this->fld))
      return $this->fld;
    else
      return $null;
}

/**
* Define a single load
*/
class load{
  protected $number;
  protected $source;
  protected $destination;
  protected $pickup_date;
  protected $delivery_date;
  protected $driver_id;
  
  function __set($fld, $vlu){
    $this->$fld = $vlu;
  }
  function __get($fld){
    if (isset($this->$fld))
      return $this->fld;
    else
      return $null;
  
}

/**
* Define the application user
*/
class user{
  protected $name;
  protected $user_id;
  protected $password;
  protected $office;
  protected $level;
  
  function __set($fld, $vlu){
    $this->fld = $vlu;
  }
  function __get($fld){
    if (isset($fld))
      return $fld;
    else
      return $null;
  
}

/**
* Define the truck driver/owner
*/
class driver{
  protected $name;
  protected $home_town;
  protected $twic;
  protected $canada;
  protected $truck_id
  
  function __set($fld, $vlu){
    $this->fld = $vlu;
  }
  function __get($fld){
    if (isset($fld))
      return $fld;
    else
      return $null;
}
  