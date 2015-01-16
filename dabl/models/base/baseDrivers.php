<?php

/**
 * 	Created by Dan Blaisdell's Database->Object Mapper
 * 		             Based on Propel
 *
 * 		Do not alter base files, as they will be overwritten.
 * 		To alter the objects, alter the extended clases in
 * 		the 'tables' folder.
 *
 */
abstract class baseDrivers extends BaseModel {

  /**
   * Name of the table
   */
  protected static $_tableName = "drivers";
  /**
   * Array of all primary keys
   */
  protected static $_primaryKeys = array(
      "id",
  );
  /**
   * Primary Key
   */
  protected static $_primaryKey = "id";
  /**
   * Array of all column names
   */
  protected static $_columnNames = array(
      'id',
      'agentid',
      'name',
      'driver_alias',
      'unload_date',
      'location',
      'equipment',
      'tlength',
      'ttype',
      'home_town',
      'preferences',
      'truck_no',
      'telephone',
      'comments',
      'home_office',
      'office_numbers',
      'message_voice_mail',
      'canada',
      'no_canada',
      'twic',
      'no_twic',
      'f4ft_tarps',
      'f6ft_tarps',
      'f8ft_tarps',
      'no_tarps',
      'pipe_stakes',
      'load_status',
      'no_pipe_stakes',
      'driving_limitations',
      'load_levelers',
      'no_load_levelers',
      'load_options',
      'loads_completed',
      'upload_comment',
      'email',
      'unload_month',
      'unload_day',
      'status',
      'origin_city',
      'origin_state',
      'destination_city',
      'destination_state',
      'rating',
      'pole_bunks',
      'loadid',
      'canada_limitations',
      'phone_numbers',
      'officeid',
      'dldeliverydate',
      'dldeliverylocation',
      'notes',
      'zones'
  );
  protected $id;
  protected $agentid;
  protected $name;
  protected $driver_alias;
  protected $unload_date;
  protected $location;
  protected $equipment;
  protected $tlength;
  protected $ttype;
  protected $home_town;
  protected $preferences;
  protected $truck_no;
  protected $telephone;
  protected $comments;
  protected $home_office;
  protected $office_numbers;
  protected $message_voice_mail;
  protected $canada;
  protected $no_canada;
  protected $twic;
  protected $no_twic;
  protected $f4ft_tarps;
  protected $f6ft_tarps;
  protected $f8ft_tarps;
  protected $no_tarps;
  protected $pipe_stakes;
  protected $load_status;
  protected $no_pipe_stakes;
  protected $driving_limitations;
  protected $load_levelers;
  protected $no_load_levelers;
  protected $load_options;
  protected $loads_completed;
  protected $upload_comment;
  protected $email;
  protected $unload_month = 0;
  protected $unload_day = 0;
  protected $status = "1";
  protected $origin_city;
  protected $origin_state;
  protected $destination_city;
  protected $destination_state;
  protected $rating;
  protected $pole_bunks;
  protected $loadid;
  protected $canada_limitations;
  protected $phone_numbers;
  protected $officeid;
  protected $dldeliverydate;
  protected $dldeliverylocation;
  protected $notes;
  protected $zones;

  /**
   * Column Accessors and Mutators
   */
  function getId() {
    return $this->id;
  }

  function setId($theValue) {
    if ($theValue === "")
      $theValue = null;
    if ($theValue !== null)
      $theValue = (int) $theValue;
    if ($this->id !== $theValue) {
      $this->_modifiedColumns[] = "id";
      $this->id = $theValue;
    }
  }

  function getAgentid() {
    return $this->agentid;
  }

  function setAgentid($theValue) {
    if ($theValue === "")
      $theValue = null;
    if ($theValue !== null)
      $theValue = (int) $theValue;
    if ($this->agentid !== $theValue) {
      $this->_modifiedColumns[] = "agentid";
      $this->agentid = $theValue;
    }
  }

  function getName() {
    return $this->name;
  }

  function setName($theValue) {
    if ($this->name !== $theValue) {
      $this->_modifiedColumns[] = "name";
      $this->name = $theValue;
    }
  }

  function getDriver_alias() {
    return $this->driver_alias;
  }

  function setDriver_alias($theValue) {
    if ($this->driver_alias !== $theValue) {
      $this->_modifiedColumns[] = "driver_alias";
      $this->driver_alias = $theValue;
    }
  }

  function getUnload_date() {
    return $this->unload_date;
  }

  function setUnload_date($theValue) {
    if ($this->unload_date !== $theValue) {
      $this->_modifiedColumns[] = "unload_date";
      $this->unload_date = $theValue;
    }
  }

  function getLocation() {
    return $this->location;
  }

  function setLocation($theValue) {
    if ($this->location !== $theValue) {
      $this->_modifiedColumns[] = "location";
      $this->location = $theValue;
    }
  }

  function getEquipment() {
    return $this->equipment;
  }

  function setEquipment($theValue) {
    if ($this->equipment !== $theValue) {
      $this->_modifiedColumns[] = "equipment";
      $this->equipment = $theValue;
    }
  }

  function getTlength() {
    return $this->tlength;
  }

  function setTlength($theValue) {
    if ($this->tlength !== $theValue) {
      $this->_modifiedColumns[] = "tlength";
      $this->tlength = $theValue;
    }
  }

  function getTtype() {
    return $this->ttype;
  }

  function setTtype($theValue) {
    if ($this->ttype !== $theValue) {
      $this->_modifiedColumns[] = "ttype";
      $this->ttype = $theValue;
    }
  }

  function getHome_town() {
    return $this->home_town;
  }

  function setHome_town($theValue) {
    if ($this->home_town !== $theValue) {
      $this->_modifiedColumns[] = "home_town";
      $this->home_town = $theValue;
    }
  }

  function getPreferences() {
    return $this->preferences;
  }

  function setPreferences($theValue) {
    if ($this->preferences !== $theValue) {
      $this->_modifiedColumns[] = "preferences";
      $this->preferences = $theValue;
    }
  }

  function getTruck_no() {
    return $this->truck_no;
  }

  function setTruck_no($theValue) {
    if ($this->truck_no !== $theValue) {
      $this->_modifiedColumns[] = "truck_no";
      $this->truck_no = $theValue;
    }
  }

  function getTelephone() {
    return $this->telephone;
  }

  function setTelephone($theValue) {
    if ($this->telephone !== $theValue) {
      $this->_modifiedColumns[] = "telephone";
      $this->telephone = $theValue;
    }
  }

  function getComments() {
    return $this->comments;
  }

  function setComments($theValue) {
    if ($this->comments !== $theValue) {
      $this->_modifiedColumns[] = "comments";
      $this->comments = $theValue;
    }
  }

  function getHome_office() {
    return $this->home_office;
  }

  function setHome_office($theValue) {
    if ($this->home_office !== $theValue) {
      $this->_modifiedColumns[] = "home_office";
      $this->home_office = $theValue;
    }
  }

  function getOffice_numbers() {
    return $this->office_numbers;
  }

  function setOffice_numbers($theValue) {
    if ($this->office_numbers !== $theValue) {
      $this->_modifiedColumns[] = "office_numbers";
      $this->office_numbers = $theValue;
    }
  }

  function getMessage_voice_mail() {
    return $this->message_voice_mail;
  }

  function setMessage_voice_mail($theValue) {
    if ($this->message_voice_mail !== $theValue) {
      $this->_modifiedColumns[] = "message_voice_mail";
      $this->message_voice_mail = $theValue;
    }
  }

  function getCanada() {
    return $this->canada;
  }

  function setCanada($theValue) {
    if ($this->canada !== $theValue) {
      $this->_modifiedColumns[] = "canada";
      $this->canada = $theValue;
    }
  }

  function getNo_canada() {
    return $this->no_canada;
  }

  function setNo_canada($theValue) {
    if ($theValue === "")
      $theValue = null;
    if ($theValue !== null)
      $theValue = (int) $theValue;
    if ($this->no_canada !== $theValue) {
      $this->_modifiedColumns[] = "no_canada";
      $this->no_canada = $theValue;
    }
  }

  function getTwic() {
    return $this->twic;
  }

  function setTwic($theValue) {
    if ($this->twic !== $theValue) {
      $this->_modifiedColumns[] = "twic";
      $this->twic = $theValue;
    }
  }

  function getNo_twic() {
    return $this->no_twic;
  }

  function setNo_twic($theValue) {
    if ($theValue === "")
      $theValue = null;
    if ($theValue !== null)
      $theValue = (int) $theValue;
    if ($this->no_twic !== $theValue) {
      $this->_modifiedColumns[] = "no_twic";
      $this->no_twic = $theValue;
    }
  }

  function getF4ft_tarps() {
    return $this->f4ft_tarps;
  }

  function setF4ft_tarps($theValue) {
    if ($theValue === "")
      $theValue = null;
    if ($theValue !== null)
      $theValue = (int) $theValue;
    if ($this->f4ft_tarps !== $theValue) {
      $this->_modifiedColumns[] = "f4ft_tarps";
      $this->f4ft_tarps = $theValue;
    }
  }

  function getF6ft_tarps() {
    return $this->f6ft_tarps;
  }

  function setF6ft_tarps($theValue) {
    if ($theValue === "")
      $theValue = null;
    if ($theValue !== null)
      $theValue = (int) $theValue;
    if ($this->f6ft_tarps !== $theValue) {
      $this->_modifiedColumns[] = "f6ft_tarps";
      $this->f6ft_tarps = $theValue;
    }
  }

  function getF8ft_tarps() {
    return $this->f8ft_tarps;
  }

  function setF8ft_tarps($theValue) {
    if ($theValue === "")
      $theValue = null;
    if ($theValue !== null)
      $theValue = (int) $theValue;
    if ($this->f8ft_tarps !== $theValue) {
      $this->_modifiedColumns[] = "f8ft_tarps";
      $this->f8ft_tarps = $theValue;
    }
  }

  function getNo_tarps() {
    return $this->no_tarps;
  }

  function setNo_tarps($theValue) {
    if ($theValue === "")
      $theValue = null;
    if ($theValue !== null)
      $theValue = (int) $theValue;
    if ($this->no_tarps !== $theValue) {
      $this->_modifiedColumns[] = "no_tarps";
      $this->no_tarps = $theValue;
    }
  }

  function getPipe_stakes() {
    return $this->pipe_stakes;
  }

  function setPipe_stakes($theValue) {
    if ($this->pipe_stakes !== $theValue) {
      $this->_modifiedColumns[] = "pipe_stakes";
      $this->pipe_stakes = $theValue;
    }
  }

  function getLoad_status() {
    return $this->load_status;
  }

  function setLoad_status($theValue) {
    if ($theValue === "")
      $theValue = null;
    if ($theValue !== null)
      $theValue = (int) $theValue;
    if ($this->load_status !== $theValue) {
      $this->_modifiedColumns[] = "load_status";
      $this->load_status = $theValue;
    }
  }

  function getNo_pipe_stakes() {
    return $this->no_pipe_stakes;
  }

  function setNo_pipe_stakes($theValue) {
    if ($theValue === "")
      $theValue = null;
    if ($theValue !== null)
      $theValue = (int) $theValue;
    if ($this->no_pipe_stakes !== $theValue) {
      $this->_modifiedColumns[] = "no_pipe_stakes";
      $this->no_pipe_stakes = $theValue;
    }
  }

  function getDriving_limitations() {
    return $this->driving_limitations;
  }

  function setDriving_limitations($theValue) {
    if ($this->driving_limitations !== $theValue) {
      $this->_modifiedColumns[] = "driving_limitations";
      $this->driving_limitations = $theValue;
    }
  }

  function getLoad_levelers() {
    return $this->load_levelers;
  }

  function setLoad_levelers($theValue) {
    if ($this->load_levelers !== $theValue) {
      $this->_modifiedColumns[] = "load_levelers";
      $this->load_levelers = $theValue;
    }
  }

  function getNo_load_levelers() {
    return $this->no_load_levelers;
  }

  function setNo_load_levelers($theValue) {
    if ($theValue === "")
      $theValue = null;
    if ($theValue !== null)
      $theValue = (int) $theValue;
    if ($this->no_load_levelers !== $theValue) {
      $this->_modifiedColumns[] = "no_load_levelers";
      $this->no_load_levelers = $theValue;
    }
  }

  function getLoad_options() {
    return $this->load_options;
  }

  function setLoad_options($theValue) {
    if ($this->load_options !== $theValue) {
      $this->_modifiedColumns[] = "load_options";
      $this->load_options = $theValue;
    }
  }

  function getLoads_completed() {
    return $this->loads_completed;
  }

  function setLoads_completed($theValue) {
    if ($theValue === "")
      $theValue = null;
    if ($theValue !== null)
      $theValue = (int) $theValue;
    if ($this->loads_completed !== $theValue) {
      $this->_modifiedColumns[] = "loads_completed";
      $this->loads_completed = $theValue;
    }
  }

  function getUpload_comment() {
    return $this->upload_comment;
  }

  function setUpload_comment($theValue) {
    if ($this->upload_comment !== $theValue) {
      $this->_modifiedColumns[] = "upload_comment";
      $this->upload_comment = $theValue;
    }
  }

  function getEmail() {
    return $this->email;
  }

  function setEmail($theValue) {
    if ($this->email !== $theValue) {
      $this->_modifiedColumns[] = "email";
      $this->email = $theValue;
    }
  }

  function getUnload_month() {
    return $this->unload_month;
  }

  function setUnload_month($theValue) {
    if ($theValue === "")
      $theValue = null;
    if ($theValue === null) {
      $theValue = 0;
    }
    if ($theValue !== null)
      $theValue = (int) $theValue;
    if ($this->unload_month !== $theValue) {
      $this->_modifiedColumns[] = "unload_month";
      $this->unload_month = $theValue;
    }
  }

  function getUnload_day() {
    return $this->unload_day;
  }

  function setUnload_day($theValue) {
    if ($theValue === "")
      $theValue = null;
    if ($theValue === null) {
      $theValue = 0;
    }
    if ($theValue !== null)
      $theValue = (int) $theValue;
    if ($this->unload_day !== $theValue) {
      $this->_modifiedColumns[] = "unload_day";
      $this->unload_day = $theValue;
    }
  }

  function getStatus() {
    return $this->status;
  }

  function setStatus($theValue) {
    if ($theValue === null) {
      $pk = $this->getPrimaryKey();
      if ($pk && $this->$pk === null)
        $theValue = 1;
      else {
        $theValue = "";
      }
    }
    if ($this->status !== $theValue) {
      $this->_modifiedColumns[] = "status";
      $this->status = $theValue;
    }
  }

  function getOrigin_city() {
    return $this->origin_city;
  }

  function setOrigin_city($theValue) {
    if ($this->origin_city !== $theValue) {
      $this->_modifiedColumns[] = "origin_city";
      $this->origin_city = $theValue;
    }
  }

  function getOrigin_state() {
    return $this->origin_state;
  }

  function setOrigin_state($theValue) {
    if ($this->origin_state !== $theValue) {
      $this->_modifiedColumns[] = "origin_state";
      $this->origin_state = $theValue;
    }
  }

  function getDestination_city() {
    return $this->destination_city;
  }

  function setDestination_city($theValue) {
    if ($this->destination_city !== $theValue) {
      $this->_modifiedColumns[] = "destination_city";
      $this->destination_city = $theValue;
    }
  }

  function getDestination_state() {
    return $this->destination_state;
  }

  function setDestination_state($theValue) {
    if ($this->destination_state !== $theValue) {
      $this->_modifiedColumns[] = "destination_state";
      $this->destination_state = $theValue;
    }
  }

  function getRating() {
    return $this->rating;
  }

  function setRating($theValue) {
    if ($this->rating !== $theValue) {
      $this->_modifiedColumns[] = "rating";
      $this->rating = $theValue;
    }
  }

  function getPole_bunks() {
    return $this->pole_bunks;
  }

  function setPole_bunks($theValue) {
    if ($this->pole_bunks !== $theValue) {
      $this->_modifiedColumns[] = "pole_bunks";
      $this->pole_bunks = $theValue;
    }
  }

  function getLoadid() {
    return $this->loadid;
  }

  function setLoadid($theValue) {
    if ($theValue === "")
      $theValue = null;
    if ($theValue !== null)
      $theValue = (int) $theValue;
    if ($this->loadid !== $theValue) {
      $this->_modifiedColumns[] = "loadid";
      $this->loadid = $theValue;
    }
  }

  function getCanada_limitations() {
    return $this->canada_limitations;
  }

  function setCanada_limitations($theValue) {
    if ($this->canada_limitations !== $theValue) {
      $this->_modifiedColumns[] = "canada_limitations";
      $this->canada_limitations = $theValue;
    }
  }

  function getPhone_numbers() {
    return $this->phone_numbers;
  }

  function setPhone_numbers($theValue) {
    if ($this->phone_numbers !== $theValue) {
      $this->_modifiedColumns[] = "phone_numbers";
      $this->phone_numbers = $theValue;
    }
  }

  function getOfficeid() {
    return $this->officeid;
  }

  function setOfficeid($theValue) {
    if ($theValue === "")
      $theValue = null;
    if ($theValue !== null)
      $theValue = (int) $theValue;
    if ($this->officeid !== $theValue) {
      $this->_modifiedColumns[] = "officeid";
      $this->officeid = $theValue;
    }
  }

  function getDldeliverydate($format = null) {
    if ($this->dldeliverydate === null || !$format)
      return $this->dldeliverydate;
    if (strpos($this->dldeliverydate, "0000-00-00") === 0)
      return null;
    $dateTime = new DateTime($this->dldeliverydate);
    return $dateTime->format($format);
  }

  function setDldeliverydate($theValue) {
    if ($theValue === "")
      $theValue = null;
    elseif ($theValue !== null)
      $theValue = date(Drivers::getConnection()->getDateFormatter(), strtotime($theValue));
    if ($this->dldeliverydate !== $theValue) {
      $this->_modifiedColumns[] = "dldeliverydate";
      $this->dldeliverydate = $theValue;
    }
  }

  function getDldeliverylocation() {
    return $this->dldeliverylocation;
  }

  function setDldeliverylocation($theValue) {
    if ($theValue === null) {
      $theValue = "";
    }
    if ($this->dldeliverylocation !== $theValue) {
      $this->_modifiedColumns[] = "dldeliverylocation";
      $this->dldeliverylocation = $theValue;
    }
  }

  function getNotes() {
    return $this->notes;
  }

  function setNotes($theValue) {
    if ($this->notes !== $theValue) {
      $this->_modifiedColumns[] = "notes";
      $this->notes = $theValue;
    }
  }

  function getZones() {
    return $this->zones;
  }

  function setZones($theValue) {
    if ($this->zones !== $theValue) {
      $this->_modifiedColumns[] = "zones";
      $this->zones = $theValue;
    }
  }

  /**
   * @return DABLPDO
   */
  static function getConnection() {
    return DBManager::getConnection("my_connection_name");
  }

  /**
   * Returns String representation of table name
   * @return String
   */
  static function getTableName() {
    return Drivers::$_tableName;
  }

  /**
   * Access to array of column names
   * @return array
   */
  static function getColumnNames() {
    return Drivers::$_columnNames;
  }

  /**
   * @return bool
   */
  static function hasColumn($columnName) {
    return in_array(strtolower($columnName), array_map('strtolower', Drivers::getColumnNames()));
  }

  /**
   * Access to array of primary keys
   * @return array
   */
  static function getPrimaryKeys() {
    return Drivers::$_primaryKeys;
  }

  /**
   * Access to name of primary key
   * @return array
   */
  static function getPrimaryKey() {
    return Drivers::$_primaryKey;
  }

  /**
   * Searches the database for a row with the ID(primary key) that matches
   * the one input.
   * @return Drivers
   */
  static function retrieveByPK($thePK) {
    if ($thePK === null)
      return null;
    $PKs = Drivers::getPrimaryKeys();
    if (count($PKs) > 1)
      throw new Exception("This table has more than one primary key.  Use retrieveByPKs() instead.");
    elseif (count($PKs) == 0)
      throw new Exception("This table does not have a primary key.");
    $q = new Query;
    $conn = Drivers::getConnection();
    $pkColumn = $conn->quoteIdentifier($PKs[0]);
    $q->add($pkColumn, $thePK);
    $q->setLimit(1);
    return array_shift(Drivers::doSelect($q));
  }

  /**
   * Searches the database for a row with the primary keys that match
   * the ones input.
   * @return Drivers
   */
  static function retrieveByPKs($PK0) {
    $conn = Drivers::getConnection();
    $tableWrapped = $conn->quoteIdentifier(Drivers::getTableName());
    if ($PK0 === null)
      return null;
    $queryString = "SELECT * FROM $tableWrapped WHERE " . $conn->quoteIdentifier('id') . "=" . $conn->checkInput($PK0) . "";
    $conn->applyLimit($queryString, 0, 1);
    return Drivers::fetchSingle($queryString);
  }

  /**
   * Populates and returns an instance of Drivers with the
   * first result of a query.  If the query returns no results,
   * returns null.
   * @return Drivers
   */
  static function fetchSingle($queryString) {
    return array_shift(Drivers::fetch($queryString));
  }

  /**
   * Populates and returns an Array of Drivers Objects with the
   * results of a query.  If the query returns no results,
   * returns an empty Array.
   * @return array
   */
  static function fetch($queryString) {
    $conn = Drivers::getConnection();
    $result = $conn->query($queryString);
    return Drivers::fromResult($result);
  }

  /**
   * Returns an array of Drivers Objects from the rows of a PDOStatement(query result)
   * @return array
   */
  static function fromResult(PDOStatement $result) {
    $objects = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      $object = new Drivers;
      $object->fromArray($row);
      $object->resetModified();
      $object->setNew(false);
      $objects[] = $object;
    }
    return $objects;
  }

  /**
   * Returns an Array of all Drivers Objects in the database.
   * $extra SQL can be appended to the query to limit,sort,group results.
   * If there are no results, returns an empty Array.
   * @param $extra String
   * @return array
   */
  static function getAll($extra = null) {
    $conn = Drivers::getConnection();
    $tableWrapped = $conn->quoteIdentifier(Drivers::getTableName());
    return Drivers::fetch("SELECT * FROM $tableWrapped $extra ");
  }

  /**
   * @return Int
   */
  static function doCount(Query $q) {
    $conn = Drivers::getConnection();
    $q = clone $q;
    if (!$q->getTable() || strrpos($q->getTable(), Drivers::getTableName()) === false)
      $q->setTable(Drivers::getTableName());
    return $q->doCount($conn);
  }

  /**
   * @return Int
   */
  static function doDelete(Query $q) {
    $conn = Drivers::getConnection();
    $q = clone $q;
    if (!$q->getTable() || strrpos($q->getTable(), Drivers::getTableName()) === false)
      $q->setTable(Drivers::getTableName());
    return $q->doDelete($conn);
  }

  /**
   * @return array
   */
  static function doSelect(Query $q) {
    $conn = Drivers::getConnection();
    $q = clone $q;
    if (!$q->getTable() || strrpos($q->getTable(), Drivers::getTableName()) === false)
      $q->setTable(Drivers::getTableName());
    return Drivers::fromResult($q->doSelect($conn));
  }

}