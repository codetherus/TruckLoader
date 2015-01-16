<?php
/**
 *	Created by Dan Blaisdell's Database->Object Mapper
 *		             Based on Propel
 *
 *		Do not alter base files, as they will be overwritten.
 *		To alter the objects, alter the extended clases in
 *		the 'tables' folder.
 *
 */

abstract class baseLoads extends BaseModel{

	/**
	 * Name of the table
	 */
	protected static $_tableName = "loads";

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
		'load_number',
		'driverid',
		'agentid',
		'booking_date',
		'dispatched',
		'pickup_date',
		'delivery_date',
		'pickup_location',
		'delivery_location',
		'line_haul',
		'accessorial',
		'gross',
		'brokerageid',
		'broker_agent',
		'broker_phone',
		'addtocontracts',
		'broker_notes',
		'load_notes',
		'load_experience',
		'load_options',
		'driver_name',
		'officeid',
		'agent_phone'
	);
	protected $id;
	protected $load_number;
	protected $driverid;
	protected $agentid;
	protected $booking_date;
	protected $dispatched;
	protected $pickup_date;
	protected $delivery_date;
	protected $pickup_location;
	protected $delivery_location;
	protected $line_haul;
	protected $accessorial;
	protected $gross;
	protected $brokerageid;
	protected $broker_agent;
	protected $broker_phone;
	protected $addtocontracts;
	protected $broker_notes;
	protected $load_notes;
	protected $load_experience;
	protected $load_options;
	protected $driver_name;
	protected $officeid;
	protected $agent_phone;

	/**
	 * Column Accessors and Mutators
	 */

	function getId(){
		return $this->id;
	}
	function setId($theValue){
		if($theValue==="")
			$theValue = null;
		if($theValue!==null)
			$theValue = (int)$theValue;
		if($this->id !== $theValue){
			$this->_modifiedColumns[] = "id";
			$this->id = $theValue;
		}
	}

	function getLoad_number(){
		return $this->load_number;
	}
	function setLoad_number($theValue){
		if($this->load_number !== $theValue){
			$this->_modifiedColumns[] = "load_number";
			$this->load_number = $theValue;
		}
	}

	function getDriverid(){
		return $this->driverid;
	}
	function setDriverid($theValue){
		if($theValue==="")
			$theValue = null;
		if($theValue!==null)
			$theValue = (int)$theValue;
		if($this->driverid !== $theValue){
			$this->_modifiedColumns[] = "driverid";
			$this->driverid = $theValue;
		}
	}

	function getAgentid(){
		return $this->agentid;
	}
	function setAgentid($theValue){
		if($theValue==="")
			$theValue = null;
		if($theValue!==null)
			$theValue = (int)$theValue;
		if($this->agentid !== $theValue){
			$this->_modifiedColumns[] = "agentid";
			$this->agentid = $theValue;
		}
	}

	function getBooking_date($format = null){
		if($this->booking_date===null || !$format)
			return $this->booking_date;
		if(strpos($this->booking_date, "0000-00-00")===0)
			return null;
		$dateTime = new DateTime($this->booking_date);
		return $dateTime->format($format);
	}
	function setBooking_date($theValue){
		if($theValue==="")
			$theValue = null;
		elseif($theValue!==null)
			$theValue = date(Loads::getConnection()->getDateFormatter(), strtotime($theValue));
		if($this->booking_date !== $theValue){
			$this->_modifiedColumns[] = "booking_date";
			$this->booking_date = $theValue;
		}
	}

	function getDispatched(){
		return $this->dispatched;
	}
	function setDispatched($theValue){
		if($theValue==="")
			$theValue = null;
		if($theValue!==null)
			$theValue = (int)$theValue;
		if($this->dispatched !== $theValue){
			$this->_modifiedColumns[] = "dispatched";
			$this->dispatched = $theValue;
		}
	}

	function getPickup_date($format = null){
		if($this->pickup_date===null || !$format)
			return $this->pickup_date;
		if(strpos($this->pickup_date, "0000-00-00")===0)
			return null;
		$dateTime = new DateTime($this->pickup_date);
		return $dateTime->format($format);
	}
	function setPickup_date($theValue){
		if($theValue==="")
			$theValue = null;
		elseif($theValue!==null)
			$theValue = date(Loads::getConnection()->getDateFormatter(), strtotime($theValue));
		if($this->pickup_date !== $theValue){
			$this->_modifiedColumns[] = "pickup_date";
			$this->pickup_date = $theValue;
		}
	}

	function getDelivery_date($format = null){
		if($this->delivery_date===null || !$format)
			return $this->delivery_date;
		if(strpos($this->delivery_date, "0000-00-00")===0)
			return null;
		$dateTime = new DateTime($this->delivery_date);
		return $dateTime->format($format);
	}
	function setDelivery_date($theValue){
		if($theValue==="")
			$theValue = null;
		elseif($theValue!==null)
			$theValue = date(Loads::getConnection()->getDateFormatter(), strtotime($theValue));
		if($this->delivery_date !== $theValue){
			$this->_modifiedColumns[] = "delivery_date";
			$this->delivery_date = $theValue;
		}
	}

	function getPickup_location(){
		return $this->pickup_location;
	}
	function setPickup_location($theValue){
		if($this->pickup_location !== $theValue){
			$this->_modifiedColumns[] = "pickup_location";
			$this->pickup_location = $theValue;
		}
	}

	function getDelivery_location(){
		return $this->delivery_location;
	}
	function setDelivery_location($theValue){
		if($this->delivery_location !== $theValue){
			$this->_modifiedColumns[] = "delivery_location";
			$this->delivery_location = $theValue;
		}
	}

	function getLine_haul(){
		return $this->line_haul;
	}
	function setLine_haul($theValue){
		if($theValue==="")
			$theValue = null;
		if($this->line_haul !== $theValue){
			$this->_modifiedColumns[] = "line_haul";
			$this->line_haul = $theValue;
		}
	}

	function getAccessorial(){
		return $this->accessorial;
	}
	function setAccessorial($theValue){
		if($theValue==="")
			$theValue = null;
		if($this->accessorial !== $theValue){
			$this->_modifiedColumns[] = "accessorial";
			$this->accessorial = $theValue;
		}
	}

	function getGross(){
		return $this->gross;
	}
	function setGross($theValue){
		if($theValue==="")
			$theValue = null;
		if($this->gross !== $theValue){
			$this->_modifiedColumns[] = "gross";
			$this->gross = $theValue;
		}
	}

	function getBrokerageid(){
		return $this->brokerageid;
	}
	function setBrokerageid($theValue){
		if($this->brokerageid !== $theValue){
			$this->_modifiedColumns[] = "brokerageid";
			$this->brokerageid = $theValue;
		}
	}

	function getBroker_agent(){
		return $this->broker_agent;
	}
	function setBroker_agent($theValue){
		if($this->broker_agent !== $theValue){
			$this->_modifiedColumns[] = "broker_agent";
			$this->broker_agent = $theValue;
		}
	}

	function getBroker_phone(){
		return $this->broker_phone;
	}
	function setBroker_phone($theValue){
		if($this->broker_phone !== $theValue){
			$this->_modifiedColumns[] = "broker_phone";
			$this->broker_phone = $theValue;
		}
	}

	function getAddtocontracts(){
		return $this->addtocontracts;
	}
	function setAddtocontracts($theValue){
		if($theValue==="")
			$theValue = null;
		if($theValue!==null)
			$theValue = (int)$theValue;
		if($this->addtocontracts !== $theValue){
			$this->_modifiedColumns[] = "addtocontracts";
			$this->addtocontracts = $theValue;
		}
	}

	function getBroker_notes(){
		return $this->broker_notes;
	}
	function setBroker_notes($theValue){
		if($this->broker_notes !== $theValue){
			$this->_modifiedColumns[] = "broker_notes";
			$this->broker_notes = $theValue;
		}
	}

	function getLoad_notes(){
		return $this->load_notes;
	}
	function setLoad_notes($theValue){
		if($this->load_notes !== $theValue){
			$this->_modifiedColumns[] = "load_notes";
			$this->load_notes = $theValue;
		}
	}

	function getLoad_experience(){
		return $this->load_experience;
	}
	function setLoad_experience($theValue){
		if($this->load_experience !== $theValue){
			$this->_modifiedColumns[] = "load_experience";
			$this->load_experience = $theValue;
		}
	}

	function getLoad_options(){
		return $this->load_options;
	}
	function setLoad_options($theValue){
		if($this->load_options !== $theValue){
			$this->_modifiedColumns[] = "load_options";
			$this->load_options = $theValue;
		}
	}

	function getDriver_name(){
		return $this->driver_name;
	}
	function setDriver_name($theValue){
		if($this->driver_name !== $theValue){
			$this->_modifiedColumns[] = "driver_name";
			$this->driver_name = $theValue;
		}
	}

	function getOfficeid(){
		return $this->officeid;
	}
	function setOfficeid($theValue){
		if($theValue==="")
			$theValue = null;
		if($theValue!==null)
			$theValue = (int)$theValue;
		if($this->officeid !== $theValue){
			$this->_modifiedColumns[] = "officeid";
			$this->officeid = $theValue;
		}
	}

	function getAgent_phone(){
		return $this->agent_phone;
	}
	function setAgent_phone($theValue){
		if($this->agent_phone !== $theValue){
			$this->_modifiedColumns[] = "agent_phone";
			$this->agent_phone = $theValue;
		}
	}


	/**
	 * @return DABLPDO
	 */
	static function getConnection(){
		return DBManager::getConnection("my_connection_name");
	}

	/**
	 * Returns String representation of table name
	 * @return String
	 */
	static function getTableName(){
		return Loads::$_tableName;
	}

	/**
	 * Access to array of column names
	 * @return array
	 */
	static function getColumnNames(){
		return Loads::$_columnNames;
	}

	/**
	 * @return bool
	 */
	static function hasColumn($columnName){
		return in_array(strtolower($columnName), array_map('strtolower', Loads::getColumnNames()));
	}

	/**
	 * Access to array of primary keys
	 * @return array
	 */
	static function getPrimaryKeys(){
		return Loads::$_primaryKeys;
	}

	/**
	 * Access to name of primary key
	 * @return array
	 */
	static function getPrimaryKey(){
		return Loads::$_primaryKey;
	}

	/**
	 * Searches the database for a row with the ID(primary key) that matches
	 * the one input.
	 * @return Loads
	 */
	static function retrieveByPK( $thePK ){
		if($thePK===null)return null;
		$PKs = Loads::getPrimaryKeys();
		if(count($PKs)>1)
			throw new Exception("This table has more than one primary key.  Use retrieveByPKs() instead.");
		elseif(count($PKs)==0)
			throw new Exception("This table does not have a primary key.");
		$q = new Query;
		$conn = Loads::getConnection();
		$pkColumn = $conn->quoteIdentifier($PKs[0]);
		$q->add($pkColumn, $thePK);
		$q->setLimit(1);
		return array_shift(Loads::doSelect($q));
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return Loads
	 */
	static function retrieveByPKs( $PK0 ){
		$conn = Loads::getConnection();
		$tableWrapped = $conn->quoteIdentifier(Loads::getTableName());
		if($PK0===null)return null;
		$queryString = "SELECT * FROM $tableWrapped WHERE ".$conn->quoteIdentifier('id')."=".$conn->checkInput($PK0)."";
		$conn->applyLimit($queryString, 0, 1);
		return Loads::fetchSingle($queryString);
	}

	/**
	 * Populates and returns an instance of Loads with the
	 * first result of a query.  If the query returns no results,
	 * returns null.
	 * @return Loads
	 */
	static function fetchSingle($queryString){
		return array_shift(Loads::fetch($queryString));
	}

	/**
	 * Populates and returns an Array of Loads Objects with the
	 * results of a query.  If the query returns no results,
	 * returns an empty Array.
	 * @return array
	 */
	static function fetch($queryString){
		$conn = Loads::getConnection();
		$result = $conn->query($queryString);
		return Loads::fromResult($result);
	}

	/**
	 * Returns an array of Loads Objects from the rows of a PDOStatement(query result)
	 * @return array
	 */
	 static function fromResult(PDOStatement $result){
		$objects = array();
		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			$object = new Loads;
			$object->fromArray($row);
			$object->resetModified();
			$object->setNew(false);
			$objects[] = $object;
		}
		return $objects;
	 }

	/**
	 * Returns an Array of all Loads Objects in the database.
	 * $extra SQL can be appended to the query to limit,sort,group results.
	 * If there are no results, returns an empty Array.
	 * @param $extra String
	 * @return array
	 */
	static function getAll($extra = null){
		$conn = Loads::getConnection();
		$tableWrapped = $conn->quoteIdentifier(Loads::getTableName());
		return Loads::fetch("SELECT * FROM $tableWrapped $extra ");
	}

	/**
	 * @return Int
	 */
	static function doCount(Query $q){
		$conn = Loads::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), Loads::getTableName())===false )
			$q->setTable(Loads::getTableName());
		return $q->doCount($conn);
	}

	/**
	 * @return Int
	 */
	static function doDelete(Query $q){
		$conn = Loads::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), Loads::getTableName())===false )
			$q->setTable(Loads::getTableName());
		return $q->doDelete($conn);
	}

	/**
	 * @return array
	 */
	static function doSelect(Query $q){
		$conn = Loads::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), Loads::getTableName())===false )
			$q->setTable(Loads::getTableName());
		return Loads::fromResult($q->doSelect($conn));
	}

}