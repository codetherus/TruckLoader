<?php
/**
 *		Created by Dan Blaisdell's DABL
 *		Do not alter base files, as they will be overwritten.
 *		To alter the objects, alter the extended classes in
 *		the 'models' folder.
 *
 */
abstract class baseLoads extends ApplicationModel {

	/**
	 * Name of the table
	 * @var string
	 */
	protected static $_tableName = 'loads';

	/**
	 * Cache of objects retrieved from the database
	 * @var Loads[]
	 */
	protected static $_instancePool = array();

	protected static $_instancePoolCount = 0;

	/**
	 * Array of all primary keys
	 * @var string[]
	 */
	protected static $_primaryKeys = array(
		'id',
	);

	/**
	 * string name of the primary key column
	 * @var string
	 */
	protected static $_primaryKey = 'id';

	/**
	 * true if primary key is an auto-increment column
	 * @var bool
	 */
	protected static $_isAutoIncrement = true;

	/**
	 * array of all column names
	 * @var string[]
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
		'agent_phone',
		'truckstop_id',
	);

	/**
	 * array of all column types
	 * @var string[]
	 */
	protected static $_columnTypes = array(
		'id' => BaseModel::COLUMN_TYPE_BIGINT,
		'load_number' => BaseModel::COLUMN_TYPE_VARCHAR,
		'driverid' => BaseModel::COLUMN_TYPE_BIGINT,
		'agentid' => BaseModel::COLUMN_TYPE_BIGINT,
		'booking_date' => BaseModel::COLUMN_TYPE_DATE,
		'dispatched' => BaseModel::COLUMN_TYPE_TINYINT,
		'pickup_date' => BaseModel::COLUMN_TYPE_DATE,
		'delivery_date' => BaseModel::COLUMN_TYPE_DATE,
		'pickup_location' => BaseModel::COLUMN_TYPE_VARCHAR,
		'delivery_location' => BaseModel::COLUMN_TYPE_VARCHAR,
		'line_haul' => BaseModel::COLUMN_TYPE_FLOAT,
		'accessorial' => BaseModel::COLUMN_TYPE_FLOAT,
		'gross' => BaseModel::COLUMN_TYPE_FLOAT,
		'brokerageid' => BaseModel::COLUMN_TYPE_VARCHAR,
		'broker_agent' => BaseModel::COLUMN_TYPE_VARCHAR,
		'broker_phone' => BaseModel::COLUMN_TYPE_VARCHAR,
		'addtocontracts' => BaseModel::COLUMN_TYPE_TINYINT,
		'broker_notes' => BaseModel::COLUMN_TYPE_LONGVARCHAR,
		'load_notes' => BaseModel::COLUMN_TYPE_LONGVARCHAR,
		'load_experience' => BaseModel::COLUMN_TYPE_VARCHAR,
		'load_options' => BaseModel::COLUMN_TYPE_LONGVARCHAR,
		'driver_name' => BaseModel::COLUMN_TYPE_VARCHAR,
		'officeid' => BaseModel::COLUMN_TYPE_BIGINT,
		'agent_phone' => BaseModel::COLUMN_TYPE_VARCHAR,
		'truckstop_id' => BaseModel::COLUMN_TYPE_BIGINT,
	);

	/**
	 * `id` BIGINT NOT NULL DEFAULT ''
	 * @var string
	 */
	protected $id;

	/**
	 * `load_number` VARCHAR
	 * @var string
	 */
	protected $load_number;

	/**
	 * `driverid` BIGINT DEFAULT ''
	 * @var string
	 */
	protected $driverid;

	/**
	 * `agentid` BIGINT DEFAULT ''
	 * @var string
	 */
	protected $agentid;

	/**
	 * `booking_date` DATE
	 * @var string
	 */
	protected $booking_date;

	/**
	 * `dispatched` TINYINT DEFAULT ''
	 * @var int
	 */
	protected $dispatched;

	/**
	 * `pickup_date` DATE
	 * @var string
	 */
	protected $pickup_date;

	/**
	 * `delivery_date` DATE
	 * @var string
	 */
	protected $delivery_date;

	/**
	 * `pickup_location` VARCHAR
	 * @var string
	 */
	protected $pickup_location;

	/**
	 * `delivery_location` VARCHAR
	 * @var string
	 */
	protected $delivery_location;

	/**
	 * `line_haul` FLOAT DEFAULT ''
	 * @var double
	 */
	protected $line_haul;

	/**
	 * `accessorial` FLOAT DEFAULT ''
	 * @var double
	 */
	protected $accessorial;

	/**
	 * `gross` FLOAT DEFAULT ''
	 * @var double
	 */
	protected $gross;

	/**
	 * `brokerageid` VARCHAR
	 * @var string
	 */
	protected $brokerageid;

	/**
	 * `broker_agent` VARCHAR
	 * @var string
	 */
	protected $broker_agent;

	/**
	 * `broker_phone` VARCHAR
	 * @var string
	 */
	protected $broker_phone;

	/**
	 * `addtocontracts` TINYINT DEFAULT ''
	 * @var int
	 */
	protected $addtocontracts;

	/**
	 * `broker_notes` LONGVARCHAR
	 * @var string
	 */
	protected $broker_notes;

	/**
	 * `load_notes` LONGVARCHAR
	 * @var string
	 */
	protected $load_notes;

	/**
	 * `load_experience` VARCHAR
	 * @var string
	 */
	protected $load_experience;

	/**
	 * `load_options` LONGVARCHAR
	 * @var string
	 */
	protected $load_options;

	/**
	 * `driver_name` VARCHAR
	 * @var string
	 */
	protected $driver_name;

	/**
	 * `officeid` BIGINT DEFAULT ''
	 * @var string
	 */
	protected $officeid;

	/**
	 * `agent_phone` VARCHAR
	 * @var string
	 */
	protected $agent_phone;

	/**
	 * `truckstop_id` BIGINT DEFAULT ''
	 * @var string
	 */
	protected $truckstop_id;

	/**
	 * Gets the value of the id field
	 */
	function getId() {
		return $this->id;
	}

	/**
	 * Sets the value of the id field
	 * @return Loads
	 */
	function setId($value) {
		return $this->setColumnValue('id', $value, BaseModel::COLUMN_TYPE_BIGINT);
	}

	/**
	 * Gets the value of the load_number field
	 */
	function getLoad_number() {
		return $this->load_number;
	}

	/**
	 * Sets the value of the load_number field
	 * @return Loads
	 */
	function setLoad_number($value) {
		return $this->setColumnValue('load_number', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the load_number field
	 */
	function getLoadNumber() {
		return $this->getLoad_number();
	}

	/**
	 * Sets the value of the load_number field
	 * @return Loads
	 */
	function setLoadNumber($value) {
		return $this->setLoad_number($value);
	}

	/**
	 * Gets the value of the driverid field
	 */
	function getDriverid() {
		return $this->driverid;
	}

	/**
	 * Sets the value of the driverid field
	 * @return Loads
	 */
	function setDriverid($value) {
		return $this->setColumnValue('driverid', $value, BaseModel::COLUMN_TYPE_BIGINT);
	}

	/**
	 * Gets the value of the agentid field
	 */
	function getAgentid() {
		return $this->agentid;
	}

	/**
	 * Sets the value of the agentid field
	 * @return Loads
	 */
	function setAgentid($value) {
		return $this->setColumnValue('agentid', $value, BaseModel::COLUMN_TYPE_BIGINT);
	}

	/**
	 * Gets the value of the booking_date field
	 */
	function getBooking_date($format = null) {
		if (null === $this->booking_date || null === $format) {
			return $this->booking_date;
		}
		if (0 === strpos($this->booking_date, '0000-00-00')) {
			return null;
		}
		return date($format, strtotime($this->booking_date));
	}

	/**
	 * Sets the value of the booking_date field
	 * @return Loads
	 */
	function setBooking_date($value) {
		return $this->setColumnValue('booking_date', $value, BaseModel::COLUMN_TYPE_DATE);
	}

	/**
	 * Gets the value of the booking_date field
	 */
	function getBookingDate($format = null) {
		return $this->getBooking_date($format);
	}

	/**
	 * Sets the value of the booking_date field
	 * @return Loads
	 */
	function setBookingDate($value) {
		return $this->setBooking_date($value);
	}

	/**
	 * Gets the value of the dispatched field
	 */
	function getDispatched() {
		return $this->dispatched;
	}

	/**
	 * Sets the value of the dispatched field
	 * @return Loads
	 */
	function setDispatched($value) {
		return $this->setColumnValue('dispatched', $value, BaseModel::COLUMN_TYPE_TINYINT);
	}

	/**
	 * Gets the value of the pickup_date field
	 */
	function getPickup_date($format = null) {
		if (null === $this->pickup_date || null === $format) {
			return $this->pickup_date;
		}
		if (0 === strpos($this->pickup_date, '0000-00-00')) {
			return null;
		}
		return date($format, strtotime($this->pickup_date));
	}

	/**
	 * Sets the value of the pickup_date field
	 * @return Loads
	 */
	function setPickup_date($value) {
		return $this->setColumnValue('pickup_date', $value, BaseModel::COLUMN_TYPE_DATE);
	}

	/**
	 * Gets the value of the pickup_date field
	 */
	function getPickupDate($format = null) {
		return $this->getPickup_date($format);
	}

	/**
	 * Sets the value of the pickup_date field
	 * @return Loads
	 */
	function setPickupDate($value) {
		return $this->setPickup_date($value);
	}

	/**
	 * Gets the value of the delivery_date field
	 */
	function getDelivery_date($format = null) {
		if (null === $this->delivery_date || null === $format) {
			return $this->delivery_date;
		}
		if (0 === strpos($this->delivery_date, '0000-00-00')) {
			return null;
		}
		return date($format, strtotime($this->delivery_date));
	}

	/**
	 * Sets the value of the delivery_date field
	 * @return Loads
	 */
	function setDelivery_date($value) {
		return $this->setColumnValue('delivery_date', $value, BaseModel::COLUMN_TYPE_DATE);
	}

	/**
	 * Gets the value of the delivery_date field
	 */
	function getDeliveryDate($format = null) {
		return $this->getDelivery_date($format);
	}

	/**
	 * Sets the value of the delivery_date field
	 * @return Loads
	 */
	function setDeliveryDate($value) {
		return $this->setDelivery_date($value);
	}

	/**
	 * Gets the value of the pickup_location field
	 */
	function getPickup_location() {
		return $this->pickup_location;
	}

	/**
	 * Sets the value of the pickup_location field
	 * @return Loads
	 */
	function setPickup_location($value) {
		return $this->setColumnValue('pickup_location', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the pickup_location field
	 */
	function getPickupLocation() {
		return $this->getPickup_location();
	}

	/**
	 * Sets the value of the pickup_location field
	 * @return Loads
	 */
	function setPickupLocation($value) {
		return $this->setPickup_location($value);
	}

	/**
	 * Gets the value of the delivery_location field
	 */
	function getDelivery_location() {
		return $this->delivery_location;
	}

	/**
	 * Sets the value of the delivery_location field
	 * @return Loads
	 */
	function setDelivery_location($value) {
		return $this->setColumnValue('delivery_location', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the delivery_location field
	 */
	function getDeliveryLocation() {
		return $this->getDelivery_location();
	}

	/**
	 * Sets the value of the delivery_location field
	 * @return Loads
	 */
	function setDeliveryLocation($value) {
		return $this->setDelivery_location($value);
	}

	/**
	 * Gets the value of the line_haul field
	 */
	function getLine_haul() {
		return $this->line_haul;
	}

	/**
	 * Sets the value of the line_haul field
	 * @return Loads
	 */
	function setLine_haul($value) {
		return $this->setColumnValue('line_haul', $value, BaseModel::COLUMN_TYPE_FLOAT);
	}

	/**
	 * Gets the value of the line_haul field
	 */
	function getLineHaul() {
		return $this->getLine_haul();
	}

	/**
	 * Sets the value of the line_haul field
	 * @return Loads
	 */
	function setLineHaul($value) {
		return $this->setLine_haul($value);
	}

	/**
	 * Gets the value of the accessorial field
	 */
	function getAccessorial() {
		return $this->accessorial;
	}

	/**
	 * Sets the value of the accessorial field
	 * @return Loads
	 */
	function setAccessorial($value) {
		return $this->setColumnValue('accessorial', $value, BaseModel::COLUMN_TYPE_FLOAT);
	}

	/**
	 * Gets the value of the gross field
	 */
	function getGross() {
		return $this->gross;
	}

	/**
	 * Sets the value of the gross field
	 * @return Loads
	 */
	function setGross($value) {
		return $this->setColumnValue('gross', $value, BaseModel::COLUMN_TYPE_FLOAT);
	}

	/**
	 * Gets the value of the brokerageid field
	 */
	function getBrokerageid() {
		return $this->brokerageid;
	}

	/**
	 * Sets the value of the brokerageid field
	 * @return Loads
	 */
	function setBrokerageid($value) {
		return $this->setColumnValue('brokerageid', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the broker_agent field
	 */
	function getBroker_agent() {
		return $this->broker_agent;
	}

	/**
	 * Sets the value of the broker_agent field
	 * @return Loads
	 */
	function setBroker_agent($value) {
		return $this->setColumnValue('broker_agent', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the broker_agent field
	 */
	function getBrokerAgent() {
		return $this->getBroker_agent();
	}

	/**
	 * Sets the value of the broker_agent field
	 * @return Loads
	 */
	function setBrokerAgent($value) {
		return $this->setBroker_agent($value);
	}

	/**
	 * Gets the value of the broker_phone field
	 */
	function getBroker_phone() {
		return $this->broker_phone;
	}

	/**
	 * Sets the value of the broker_phone field
	 * @return Loads
	 */
	function setBroker_phone($value) {
		return $this->setColumnValue('broker_phone', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the broker_phone field
	 */
	function getBrokerPhone() {
		return $this->getBroker_phone();
	}

	/**
	 * Sets the value of the broker_phone field
	 * @return Loads
	 */
	function setBrokerPhone($value) {
		return $this->setBroker_phone($value);
	}

	/**
	 * Gets the value of the addtocontracts field
	 */
	function getAddtocontracts() {
		return $this->addtocontracts;
	}

	/**
	 * Sets the value of the addtocontracts field
	 * @return Loads
	 */
	function setAddtocontracts($value) {
		return $this->setColumnValue('addtocontracts', $value, BaseModel::COLUMN_TYPE_TINYINT);
	}

	/**
	 * Gets the value of the broker_notes field
	 */
	function getBroker_notes() {
		return $this->broker_notes;
	}

	/**
	 * Sets the value of the broker_notes field
	 * @return Loads
	 */
	function setBroker_notes($value) {
		return $this->setColumnValue('broker_notes', $value, BaseModel::COLUMN_TYPE_LONGVARCHAR);
	}

	/**
	 * Gets the value of the broker_notes field
	 */
	function getBrokerNotes() {
		return $this->getBroker_notes();
	}

	/**
	 * Sets the value of the broker_notes field
	 * @return Loads
	 */
	function setBrokerNotes($value) {
		return $this->setBroker_notes($value);
	}

	/**
	 * Gets the value of the load_notes field
	 */
	function getLoad_notes() {
		return $this->load_notes;
	}

	/**
	 * Sets the value of the load_notes field
	 * @return Loads
	 */
	function setLoad_notes($value) {
		return $this->setColumnValue('load_notes', $value, BaseModel::COLUMN_TYPE_LONGVARCHAR);
	}

	/**
	 * Gets the value of the load_notes field
	 */
	function getLoadNotes() {
		return $this->getLoad_notes();
	}

	/**
	 * Sets the value of the load_notes field
	 * @return Loads
	 */
	function setLoadNotes($value) {
		return $this->setLoad_notes($value);
	}

	/**
	 * Gets the value of the load_experience field
	 */
	function getLoad_experience() {
		return $this->load_experience;
	}

	/**
	 * Sets the value of the load_experience field
	 * @return Loads
	 */
	function setLoad_experience($value) {
		return $this->setColumnValue('load_experience', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the load_experience field
	 */
	function getLoadExperience() {
		return $this->getLoad_experience();
	}

	/**
	 * Sets the value of the load_experience field
	 * @return Loads
	 */
	function setLoadExperience($value) {
		return $this->setLoad_experience($value);
	}

	/**
	 * Gets the value of the load_options field
	 */
	function getLoad_options() {
		return $this->load_options;
	}

	/**
	 * Sets the value of the load_options field
	 * @return Loads
	 */
	function setLoad_options($value) {
		return $this->setColumnValue('load_options', $value, BaseModel::COLUMN_TYPE_LONGVARCHAR);
	}

	/**
	 * Gets the value of the load_options field
	 */
	function getLoadOptions() {
		return $this->getLoad_options();
	}

	/**
	 * Sets the value of the load_options field
	 * @return Loads
	 */
	function setLoadOptions($value) {
		return $this->setLoad_options($value);
	}

	/**
	 * Gets the value of the driver_name field
	 */
	function getDriver_name() {
		return $this->driver_name;
	}

	/**
	 * Sets the value of the driver_name field
	 * @return Loads
	 */
	function setDriver_name($value) {
		return $this->setColumnValue('driver_name', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the driver_name field
	 */
	function getDriverName() {
		return $this->getDriver_name();
	}

	/**
	 * Sets the value of the driver_name field
	 * @return Loads
	 */
	function setDriverName($value) {
		return $this->setDriver_name($value);
	}

	/**
	 * Gets the value of the officeid field
	 */
	function getOfficeid() {
		return $this->officeid;
	}

	/**
	 * Sets the value of the officeid field
	 * @return Loads
	 */
	function setOfficeid($value) {
		return $this->setColumnValue('officeid', $value, BaseModel::COLUMN_TYPE_BIGINT);
	}

	/**
	 * Gets the value of the agent_phone field
	 */
	function getAgent_phone() {
		return $this->agent_phone;
	}

	/**
	 * Sets the value of the agent_phone field
	 * @return Loads
	 */
	function setAgent_phone($value) {
		return $this->setColumnValue('agent_phone', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the agent_phone field
	 */
	function getAgentPhone() {
		return $this->getAgent_phone();
	}

	/**
	 * Sets the value of the agent_phone field
	 * @return Loads
	 */
	function setAgentPhone($value) {
		return $this->setAgent_phone($value);
	}

	/**
	 * Gets the value of the truckstop_id field
	 */
	function getTruckstop_id() {
		return $this->truckstop_id;
	}

	/**
	 * Sets the value of the truckstop_id field
	 * @return Loads
	 */
	function setTruckstop_id($value) {
		return $this->setColumnValue('truckstop_id', $value, BaseModel::COLUMN_TYPE_BIGINT);
	}

	/**
	 * Gets the value of the truckstop_id field
	 */
	function getTruckstopId() {
		return $this->getTruckstop_id();
	}

	/**
	 * Sets the value of the truckstop_id field
	 * @return Loads
	 */
	function setTruckstopId($value) {
		return $this->setTruckstop_id($value);
	}

	/**
	 * @return DABLPDO
	 */
	static function getConnection() {
		return DBManager::getConnection('default_mysqll');
	}

	/**
	 * @return Loads
	 */
	static function create() {
		return new Loads();
	}

	/**
	 * Returns String representation of table name
	 * @return string
	 */
	static function getTableName() {
		return Loads::$_tableName;
	}

	/**
	 * Access to array of column names
	 * @return array
	 */
	static function getColumnNames() {
		return Loads::$_columnNames;
	}

	/**
	 * Access to array of column types, indexed by column name
	 * @return array
	 */
	static function getColumnTypes() {
		return Loads::$_columnTypes;
	}

	/**
	 * Get the type of a column
	 * @return array
	 */
	static function getColumnType($column_name) {
		return Loads::$_columnTypes[$column_name];
	}

	/**
	 * @return bool
	 */
	static function hasColumn($column_name) {
		static $lower_case_columns = null;
		if (null === $lower_case_columns) {
			$lower_case_columns = array_map('strtolower', Loads::$_columnNames);
		}
		return in_array(strtolower($column_name), $lower_case_columns);
	}

	/**
	 * Access to array of primary keys
	 * @return array
	 */
	static function getPrimaryKeys() {
		return Loads::$_primaryKeys;
	}

	/**
	 * Access to name of primary key
	 * @return array
	 */
	static function getPrimaryKey() {
		return Loads::$_primaryKey;
	}

	/**
	 * Returns true if the primary key column for this table is auto-increment
	 * @return bool
	 */
	static function isAutoIncrement() {
		return Loads::$_isAutoIncrement;
	}

	/**
	 * Searches the database for a row with the ID(primary key) that matches
	 * the one input.
	 * @return Loads
	 */
	static function retrieveByPK($the_pk) {
		return Loads::retrieveByPKs($the_pk);
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return Loads
	 */
	static function retrieveByPKs($id) {
		if (null === $id) {
			return null;
		}
		$pool_instance = Loads::retrieveFromPool($id);
		if (null !== $pool_instance) {
			return $pool_instance;
		}
		$conn = Loads::getConnection();
		$q = new Query;
		$q->add('id', $id);
		return array_shift(Loads::doSelect($q, true));
	}

	/**
	 * Searches the database for a row with a id	 * value that matches the one provided
	 * @return Loads
	 */
	static function retrieveById($value) {
		return Loads::retrieveByPK($value);
	}

	/**
	 * Searches the database for a row with a load_number	 * value that matches the one provided
	 * @return Loads
	 */
	static function retrieveByLoadNumber($value) {
		return Loads::retrieveByColumn('load_number', $value);
	}

	/**
	 * Searches the database for a row with a driverid	 * value that matches the one provided
	 * @return Loads
	 */
	static function retrieveByDriverid($value) {
		return Loads::retrieveByColumn('driverid', $value);
	}

	/**
	 * Searches the database for a row with a agentid	 * value that matches the one provided
	 * @return Loads
	 */
	static function retrieveByAgentid($value) {
		return Loads::retrieveByColumn('agentid', $value);
	}

	/**
	 * Searches the database for a row with a booking_date	 * value that matches the one provided
	 * @return Loads
	 */
	static function retrieveByBookingDate($value) {
		return Loads::retrieveByColumn('booking_date', $value);
	}

	/**
	 * Searches the database for a row with a dispatched	 * value that matches the one provided
	 * @return Loads
	 */
	static function retrieveByDispatched($value) {
		return Loads::retrieveByColumn('dispatched', $value);
	}

	/**
	 * Searches the database for a row with a pickup_date	 * value that matches the one provided
	 * @return Loads
	 */
	static function retrieveByPickupDate($value) {
		return Loads::retrieveByColumn('pickup_date', $value);
	}

	/**
	 * Searches the database for a row with a delivery_date	 * value that matches the one provided
	 * @return Loads
	 */
	static function retrieveByDeliveryDate($value) {
		return Loads::retrieveByColumn('delivery_date', $value);
	}

	/**
	 * Searches the database for a row with a pickup_location	 * value that matches the one provided
	 * @return Loads
	 */
	static function retrieveByPickupLocation($value) {
		return Loads::retrieveByColumn('pickup_location', $value);
	}

	/**
	 * Searches the database for a row with a delivery_location	 * value that matches the one provided
	 * @return Loads
	 */
	static function retrieveByDeliveryLocation($value) {
		return Loads::retrieveByColumn('delivery_location', $value);
	}

	/**
	 * Searches the database for a row with a line_haul	 * value that matches the one provided
	 * @return Loads
	 */
	static function retrieveByLineHaul($value) {
		return Loads::retrieveByColumn('line_haul', $value);
	}

	/**
	 * Searches the database for a row with a accessorial	 * value that matches the one provided
	 * @return Loads
	 */
	static function retrieveByAccessorial($value) {
		return Loads::retrieveByColumn('accessorial', $value);
	}

	/**
	 * Searches the database for a row with a gross	 * value that matches the one provided
	 * @return Loads
	 */
	static function retrieveByGross($value) {
		return Loads::retrieveByColumn('gross', $value);
	}

	/**
	 * Searches the database for a row with a brokerageid	 * value that matches the one provided
	 * @return Loads
	 */
	static function retrieveByBrokerageid($value) {
		return Loads::retrieveByColumn('brokerageid', $value);
	}

	/**
	 * Searches the database for a row with a broker_agent	 * value that matches the one provided
	 * @return Loads
	 */
	static function retrieveByBrokerAgent($value) {
		return Loads::retrieveByColumn('broker_agent', $value);
	}

	/**
	 * Searches the database for a row with a broker_phone	 * value that matches the one provided
	 * @return Loads
	 */
	static function retrieveByBrokerPhone($value) {
		return Loads::retrieveByColumn('broker_phone', $value);
	}

	/**
	 * Searches the database for a row with a addtocontracts	 * value that matches the one provided
	 * @return Loads
	 */
	static function retrieveByAddtocontracts($value) {
		return Loads::retrieveByColumn('addtocontracts', $value);
	}

	/**
	 * Searches the database for a row with a broker_notes	 * value that matches the one provided
	 * @return Loads
	 */
	static function retrieveByBrokerNotes($value) {
		return Loads::retrieveByColumn('broker_notes', $value);
	}

	/**
	 * Searches the database for a row with a load_notes	 * value that matches the one provided
	 * @return Loads
	 */
	static function retrieveByLoadNotes($value) {
		return Loads::retrieveByColumn('load_notes', $value);
	}

	/**
	 * Searches the database for a row with a load_experience	 * value that matches the one provided
	 * @return Loads
	 */
	static function retrieveByLoadExperience($value) {
		return Loads::retrieveByColumn('load_experience', $value);
	}

	/**
	 * Searches the database for a row with a load_options	 * value that matches the one provided
	 * @return Loads
	 */
	static function retrieveByLoadOptions($value) {
		return Loads::retrieveByColumn('load_options', $value);
	}

	/**
	 * Searches the database for a row with a driver_name	 * value that matches the one provided
	 * @return Loads
	 */
	static function retrieveByDriverName($value) {
		return Loads::retrieveByColumn('driver_name', $value);
	}

	/**
	 * Searches the database for a row with a officeid	 * value that matches the one provided
	 * @return Loads
	 */
	static function retrieveByOfficeid($value) {
		return Loads::retrieveByColumn('officeid', $value);
	}

	/**
	 * Searches the database for a row with a agent_phone	 * value that matches the one provided
	 * @return Loads
	 */
	static function retrieveByAgentPhone($value) {
		return Loads::retrieveByColumn('agent_phone', $value);
	}

	/**
	 * Searches the database for a row with a truckstop_id	 * value that matches the one provided
	 * @return Loads
	 */
	static function retrieveByTruckstopId($value) {
		return Loads::retrieveByColumn('truckstop_id', $value);
	}

	static function retrieveByColumn($field, $value) {
		$conn = Loads::getConnection();
		return array_shift(Loads::doSelect(Query::create()->add($field, $value)->setLimit(1)->order('id')));
	}

	/**
	 * Populates and returns an instance of Loads with the
	 * first result of a query.  If the query returns no results,
	 * returns null.
	 * @return Loads
	 */
	static function fetchSingle($query_string, $write_cache = true) {
		return array_shift(Loads::fetch($query_string, $write_cache));
	}

	/**
	 * Populates and returns an array of Loads objects with the
	 * results of a query.  If the query returns no results,
	 * returns an empty Array.
	 * @return Loads[]
	 */
	static function fetch($query_string, $write_cache = false) {
		$conn = Loads::getConnection();
		$result = $conn->query($query_string);
		return Loads::fromResult($result, 'Loads', $write_cache);
	}

	/**
	 * Returns an array of Loads objects from
	 * a PDOStatement(query result).
	 *
	 * @see BaseModel::fromResult
	 */
	static function fromResult(PDOStatement $result, $class = 'Loads', $write_cache = false) {
		return baseModel::fromResult($result, $class, $write_cache);
	}

	/**
	 * Casts values of int fields to (int)
	 * @return Loads
	 */
	function castInts() {
		$this->id = (null === $this->id) ? null : (int) $this->id;
		$this->driverid = (null === $this->driverid) ? null : (int) $this->driverid;
		$this->agentid = (null === $this->agentid) ? null : (int) $this->agentid;
		$this->dispatched = (null === $this->dispatched) ? null : (int) $this->dispatched;
		$this->addtocontracts = (null === $this->addtocontracts) ? null : (int) $this->addtocontracts;
		$this->officeid = (null === $this->officeid) ? null : (int) $this->officeid;
		$this->truckstop_id = (null === $this->truckstop_id) ? null : (int) $this->truckstop_id;
		return $this;
	}

	/**
	 * Add (or replace) to the instance pool.
	 *
	 * @param Loads $object
	 * @return void
	 */
	static function insertIntoPool(Loads $object) {
		if (Loads::$_instancePoolCount > Loads::MAX_INSTANCE_POOL_SIZE) {
			return;
		}

		Loads::$_instancePool[implode('-', $object->getPrimaryKeyValues())] = clone $object;
		++Loads::$_instancePoolCount;
	}

	/**
	 * Return the cached instance from the pool.
	 *
	 * @param mixed $pk Primary Key
	 * @return Loads
	 */
	static function retrieveFromPool($pk) {
		if (null === $pk) {
			return null;
		}
		if (array_key_exists($pk, Loads::$_instancePool)) {
			return clone Loads::$_instancePool[$pk];
		}

		return null;
	}

	/**
	 * Remove the object from the instance pool.
	 *
	 * @param mixed $object Object or PK to remove
	 * @return void
	 */
	static function removeFromPool($object) {
		$pk = is_object($object) ? implode('-', $object->getPrimaryKeyValues()) : $object;

		if (array_key_exists($pk, Loads::$_instancePool)) {
			unset(Loads::$_instancePool[$pk]);
			--Loads::$_instancePoolCount;
		}
	}

	/**
	 * Empty the instance pool.
	 *
	 * @return void
	 */
	static function flushPool() {
		Loads::$_instancePool = array();
	}

	/**
	 * Returns an array of all Loads objects in the database.
	 * $extra SQL can be appended to the query to LIMIT, SORT, and/or GROUP results.
	 * If there are no results, returns an empty Array.
	 * @param $extra string
	 * @return Loads[]
	 */
	static function getAll($extra = null, $write_cache = false) {
		$conn = Loads::getConnection();
		$table_quoted = $conn->quoteIdentifier(Loads::getTableName());
		return Loads::fetch("SELECT * FROM $table_quoted $extra ", $write_cache);
	}

	/**
	 * @return int
	 */
	static function doCount(Query $q = null) {
		$q = $q ? clone $q : new Query;
		$conn = Loads::getConnection();
		if (!$q->getTable() || Loads::getTableName() != $q->getTable()) {
			$q->setTable(Loads::getTableName());
		}
		return $q->doCount($conn);
	}

	/**
	 * @param Query $q
	 * @param bool $dump_cache
	 * @return int
	 */
	static function doDelete(Query $q, $dump_cache = true) {
		$conn = Loads::getConnection();
		$q = clone $q;
		if (!$q->getTable() || Loads::getTableName() != $q->getTable()) {
			$q->setTable(Loads::getTableName());
		}
		$result = $q->doDelete($conn);

		if ($dump_cache) {
			Loads::$_instancePool = array();
		}

		return $result;
	}

	/**
	 * @param Query $q The Query object that creates the SELECT query string
	 * @param bool $write_cache Whether or not to store results in instance pool
	 * @param array $additional_classes Array of additional classes for fromResult to instantiate as properties
	 * @return Loads[]
	 */
	static function doSelect(Query $q = null, $write_cache = false, $additional_classes = null) {
		if (is_array($additional_classes)) {
			array_unshift($additional_classes, 'Loads');
			$class = $additional_classes;
		} else {
			$class = 'Loads';
		}

		return Loads::fromResult(self::doSelectRS($q), $class, $write_cache);
	}

	/**
	 * Executes a select query and returns the PDO result
	 * @return PDOStatement
	 */
	static function doSelectRS(Query $q = null) {
		$q = $q ? clone $q : new Query;
		$conn = Loads::getConnection();
		if (!$q->getTable() || Loads::getTableName() != $q->getTable()) {
			$q->setTable(Loads::getTableName());
		}

		return $q->doSelect($conn);
	}

	/**
	 * @return Loads[]
	 */
	static function doSelectJoinAll(Query $q = null, $write_cache = false, $join_type = Query::LEFT_JOIN) {
		$q = $q ? clone $q : new Query;
		$columns = $q->getColumns();
		$classes = array();
		$alias = $q->getAlias();
		$this_table = $alias ? $alias : Loads::getTableName();
		if (!$columns) {
			$columns[] = $this_table . '.*';
		}

		$q->setColumns($columns);
		return Loads::doSelect($q, $write_cache, $classes);
	}

	/**
	 * Returns true if the column values validate.
	 * @return bool
	 */
	function validate() {
		$this->_validationErrors = array();
		return 0 === count($this->_validationErrors);
	}

}
