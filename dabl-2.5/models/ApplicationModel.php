<?php

abstract class ApplicationModel extends BaseModel {
  /**
    Magic get
  */
  function __get($name){
    return $this->{'get' . $name}();
  }
  /**
   Magic set
  */
  function __set($name, $value){
    $this->{'set'.$name}($value);
  }

}