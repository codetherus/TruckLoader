<?php
/**
 *		Created by Dan Blaisdell's DABL
 *		Do not alter base files, as they will be overwritten.
 *		To alter the objects, alter the extended classes in
 *		the 'models' folder.
 *
 */
abstract class baseDrivers extends ApplicationModel {

	/**
	 * Name of the table
	 * @var string
	 */
	protected static $_tableName = 'drivers';

	/**
	 * Cache of objects retrieved from the database
	 * @var Drivers[]
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
		'zones',
	);

	/**
	 * array of all column types
	 * @var string[]
	 */
	protected static $_columnTypes = array(
		'id' => BaseModel::COLUMN_TYPE_BIGINT,
		'agentid' => BaseModel::COLUMN_TYPE_BIGINT,
		'name' => BaseModel::COLUMN_TYPE_VARCHAR,
		'driver_alias' => BaseModel::COLUMN_TYPE_VARCHAR,
		'unload_date' => BaseModel::COLUMN_TYPE_VARCHAR,
		'location' => BaseModel::COLUMN_TYPE_VARCHAR,
		'equipment' => BaseModel::COLUMN_TYPE_LONGVARCHAR,
		'tlength' => BaseModel::COLUMN_TYPE_VARCHAR,
		'ttype' => BaseModel::COLUMN_TYPE_VARCHAR,
		'home_town' => BaseModel::COLUMN_TYPE_VARCHAR,
		'preferences' => BaseModel::COLUMN_TYPE_LONGVARCHAR,
		'truck_no' => BaseModel::COLUMN_TYPE_VARCHAR,
		'telephone' => BaseModel::COLUMN_TYPE_VARCHAR,
		'comments' => BaseModel::COLUMN_TYPE_LONGVARCHAR,
		'home_office' => BaseModel::COLUMN_TYPE_VARCHAR,
		'office_numbers' => BaseModel::COLUMN_TYPE_LONGVARCHAR,
		'message_voice_mail' => BaseModel::COLUMN_TYPE_VARCHAR,
		'canada' => BaseModel::COLUMN_TYPE_VARCHAR,
		'no_canada' => BaseModel::COLUMN_TYPE_TINYINT,
		'twic' => BaseModel::COLUMN_TYPE_VARCHAR,
		'no_twic' => BaseModel::COLUMN_TYPE_TINYINT,
		'f4ft_tarps' => BaseModel::COLUMN_TYPE_TINYINT,
		'f6ft_tarps' => BaseModel::COLUMN_TYPE_TINYINT,
		'f8ft_tarps' => BaseModel::COLUMN_TYPE_TINYINT,
		'no_tarps' => BaseModel::COLUMN_TYPE_TINYINT,
		'pipe_stakes' => BaseModel::COLUMN_TYPE_VARCHAR,
		'load_status' => BaseModel::COLUMN_TYPE_TINYINT,
		'no_pipe_stakes' => BaseModel::COLUMN_TYPE_TINYINT,
		'driving_limitations' => BaseModel::COLUMN_TYPE_LONGVARCHAR,
		'load_levelers' => BaseModel::COLUMN_TYPE_VARCHAR,
		'no_load_levelers' => BaseModel::COLUMN_TYPE_TINYINT,
		'load_options' => BaseModel::COLUMN_TYPE_LONGVARCHAR,
		'loads_completed' => BaseModel::COLUMN_TYPE_INTEGER,
		'upload_comment' => BaseModel::COLUMN_TYPE_LONGVARCHAR,
		'email' => BaseModel::COLUMN_TYPE_VARCHAR,
		'unload_month' => BaseModel::COLUMN_TYPE_TINYINT,
		'unload_day' => BaseModel::COLUMN_TYPE_TINYINT,
		'status' => BaseModel::COLUMN_TYPE_VARCHAR,
		'origin_city' => BaseModel::COLUMN_TYPE_VARCHAR,
		'origin_state' => BaseModel::COLUMN_TYPE_VARCHAR,
		'destination_city' => BaseModel::COLUMN_TYPE_VARCHAR,
		'destination_state' => BaseModel::COLUMN_TYPE_VARCHAR,
		'rating' => BaseModel::COLUMN_TYPE_VARCHAR,
		'pole_bunks' => BaseModel::COLUMN_TYPE_VARCHAR,
		'loadid' => BaseModel::COLUMN_TYPE_BIGINT,
		'canada_limitations' => BaseModel::COLUMN_TYPE_LONGVARCHAR,
		'phone_numbers' => BaseModel::COLUMN_TYPE_LONGVARCHAR,
		'officeid' => BaseModel::COLUMN_TYPE_BIGINT,
		'dldeliverydate' => BaseModel::COLUMN_TYPE_DATE,
		'dldeliverylocation' => BaseModel::COLUMN_TYPE_VARCHAR,
		'notes' => BaseModel::COLUMN_TYPE_LONGVARCHAR,
		'zones' => BaseModel::COLUMN_TYPE_LONGVARCHAR,
	);

	/**
	 * `id` BIGINT NOT NULL DEFAULT ''
	 * @var string
	 */
	protected $id;

	/**
	 * `agentid` BIGINT DEFAULT ''
	 * @var string
	 */
	protected $agentid;

	/**
	 * `name` VARCHAR
	 * @var string
	 */
	protected $name;

	/**
	 * `driver_alias` VARCHAR
	 * @var string
	 */
	protected $driver_alias;

	/**
	 * `unload_date` VARCHAR
	 * @var string
	 */
	protected $unload_date;

	/**
	 * `location` VARCHAR
	 * @var string
	 */
	protected $location;

	/**
	 * `equipment` LONGVARCHAR
	 * @var string
	 */
	protected $equipment;

	/**
	 * `tlength` VARCHAR
	 * @var string
	 */
	protected $tlength;

	/**
	 * `ttype` VARCHAR
	 * @var string
	 */
	protected $ttype;

	/**
	 * `home_town` VARCHAR
	 * @var string
	 */
	protected $home_town;

	/**
	 * `preferences` LONGVARCHAR
	 * @var string
	 */
	protected $preferences;

	/**
	 * `truck_no` VARCHAR
	 * @var string
	 */
	protected $truck_no;

	/**
	 * `telephone` VARCHAR
	 * @var string
	 */
	protected $telephone;

	/**
	 * `comments` LONGVARCHAR
	 * @var string
	 */
	protected $comments;

	/**
	 * `home_office` VARCHAR
	 * @var string
	 */
	protected $home_office;

	/**
	 * `office_numbers` LONGVARCHAR
	 * @var string
	 */
	protected $office_numbers;

	/**
	 * `message_voice_mail` VARCHAR
	 * @var string
	 */
	protected $message_voice_mail;

	/**
	 * `canada` VARCHAR
	 * @var string
	 */
	protected $canada;

	/**
	 * `no_canada` TINYINT DEFAULT ''
	 * @var int
	 */
	protected $no_canada;

	/**
	 * `twic` VARCHAR
	 * @var string
	 */
	protected $twic;

	/**
	 * `no_twic` TINYINT DEFAULT ''
	 * @var int
	 */
	protected $no_twic;

	/**
	 * `f4ft_tarps` TINYINT DEFAULT ''
	 * @var int
	 */
	protected $f4ft_tarps;

	/**
	 * `f6ft_tarps` TINYINT DEFAULT ''
	 * @var int
	 */
	protected $f6ft_tarps;

	/**
	 * `f8ft_tarps` TINYINT DEFAULT ''
	 * @var int
	 */
	protected $f8ft_tarps;

	/**
	 * `no_tarps` TINYINT DEFAULT ''
	 * @var int
	 */
	protected $no_tarps;

	/**
	 * `pipe_stakes` VARCHAR
	 * @var string
	 */
	protected $pipe_stakes;

	/**
	 * `load_status` TINYINT DEFAULT ''
	 * @var int
	 */
	protected $load_status;

	/**
	 * `no_pipe_stakes` TINYINT DEFAULT ''
	 * @var int
	 */
	protected $no_pipe_stakes;

	/**
	 * `driving_limitations` LONGVARCHAR
	 * @var string
	 */
	protected $driving_limitations;

	/**
	 * `load_levelers` VARCHAR
	 * @var string
	 */
	protected $load_levelers;

	/**
	 * `no_load_levelers` TINYINT DEFAULT ''
	 * @var int
	 */
	protected $no_load_levelers;

	/**
	 * `load_options` LONGVARCHAR
	 * @var string
	 */
	protected $load_options;

	/**
	 * `loads_completed` INTEGER DEFAULT ''
	 * @var int
	 */
	protected $loads_completed;

	/**
	 * `upload_comment` LONGVARCHAR
	 * @var string
	 */
	protected $upload_comment;

	/**
	 * `email` VARCHAR
	 * @var string
	 */
	protected $email;

	/**
	 * `unload_month` TINYINT NOT NULL DEFAULT 0
	 * @var int
	 */
	protected $unload_month = 0;

	/**
	 * `unload_day` TINYINT NOT NULL DEFAULT 0
	 * @var int
	 */
	protected $unload_day = 0;

	/**
	 * `status` VARCHAR NOT NULL DEFAULT 1
	 * @var string
	 */
	protected $status = '1';

	/**
	 * `origin_city` VARCHAR
	 * @var string
	 */
	protected $origin_city;

	/**
	 * `origin_state` VARCHAR
	 * @var string
	 */
	protected $origin_state;

	/**
	 * `destination_city` VARCHAR
	 * @var string
	 */
	protected $destination_city;

	/**
	 * `destination_state` VARCHAR
	 * @var string
	 */
	protected $destination_state;

	/**
	 * `rating` VARCHAR
	 * @var string
	 */
	protected $rating;

	/**
	 * `pole_bunks` VARCHAR
	 * @var string
	 */
	protected $pole_bunks;

	/**
	 * `loadid` BIGINT DEFAULT ''
	 * @var string
	 */
	protected $loadid;

	/**
	 * `canada_limitations` LONGVARCHAR
	 * @var string
	 */
	protected $canada_limitations;

	/**
	 * `phone_numbers` LONGVARCHAR
	 * @var string
	 */
	protected $phone_numbers;

	/**
	 * `officeid` BIGINT DEFAULT ''
	 * @var string
	 */
	protected $officeid;

	/**
	 * `dldeliverydate` DATE
	 * @var string
	 */
	protected $dldeliverydate;

	/**
	 * `dldeliverylocation` VARCHAR NOT NULL
	 * @var string
	 */
	protected $dldeliverylocation;

	/**
	 * `notes` LONGVARCHAR
	 * @var string
	 */
	protected $notes;

	/**
	 * `zones` LONGVARCHAR
	 * @var string
	 */
	protected $zones;

	/**
	 * Gets the value of the id field
	 */
	function getId() {
		return $this->id;
	}

	/**
	 * Sets the value of the id field
	 * @return Drivers
	 */
	function setId($value) {
		return $this->setColumnValue('id', $value, BaseModel::COLUMN_TYPE_BIGINT);
	}

	/**
	 * Gets the value of the agentid field
	 */
	function getAgentid() {
		return $this->agentid;
	}

	/**
	 * Sets the value of the agentid field
	 * @return Drivers
	 */
	function setAgentid($value) {
		return $this->setColumnValue('agentid', $value, BaseModel::COLUMN_TYPE_BIGINT);
	}

	/**
	 * Gets the value of the name field
	 */
	function getName() {
		return $this->name;
	}

	/**
	 * Sets the value of the name field
	 * @return Drivers
	 */
	function setName($value) {
		return $this->setColumnValue('name', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the driver_alias field
	 */
	function getDriver_alias() {
		return $this->driver_alias;
	}

	/**
	 * Sets the value of the driver_alias field
	 * @return Drivers
	 */
	function setDriver_alias($value) {
		return $this->setColumnValue('driver_alias', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the driver_alias field
	 */
	function getDriverAlias() {
		return $this->getDriver_alias();
	}

	/**
	 * Sets the value of the driver_alias field
	 * @return Drivers
	 */
	function setDriverAlias($value) {
		return $this->setDriver_alias($value);
	}

	/**
	 * Gets the value of the unload_date field
	 */
	function getUnload_date() {
		return $this->unload_date;
	}

	/**
	 * Sets the value of the unload_date field
	 * @return Drivers
	 */
	function setUnload_date($value) {
		return $this->setColumnValue('unload_date', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the unload_date field
	 */
	function getUnloadDate() {
		return $this->getUnload_date();
	}

	/**
	 * Sets the value of the unload_date field
	 * @return Drivers
	 */
	function setUnloadDate($value) {
		return $this->setUnload_date($value);
	}

	/**
	 * Gets the value of the location field
	 */
	function getLocation() {
		return $this->location;
	}

	/**
	 * Sets the value of the location field
	 * @return Drivers
	 */
	function setLocation($value) {
		return $this->setColumnValue('location', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the equipment field
	 */
	function getEquipment() {
		return $this->equipment;
	}

	/**
	 * Sets the value of the equipment field
	 * @return Drivers
	 */
	function setEquipment($value) {
		return $this->setColumnValue('equipment', $value, BaseModel::COLUMN_TYPE_LONGVARCHAR);
	}

	/**
	 * Gets the value of the tlength field
	 */
	function getTlength() {
		return $this->tlength;
	}

	/**
	 * Sets the value of the tlength field
	 * @return Drivers
	 */
	function setTlength($value) {
		return $this->setColumnValue('tlength', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the ttype field
	 */
	function getTtype() {
		return $this->ttype;
	}

	/**
	 * Sets the value of the ttype field
	 * @return Drivers
	 */
	function setTtype($value) {
		return $this->setColumnValue('ttype', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the home_town field
	 */
	function getHome_town() {
		return $this->home_town;
	}

	/**
	 * Sets the value of the home_town field
	 * @return Drivers
	 */
	function setHome_town($value) {
		return $this->setColumnValue('home_town', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the home_town field
	 */
	function getHomeTown() {
		return $this->getHome_town();
	}

	/**
	 * Sets the value of the home_town field
	 * @return Drivers
	 */
	function setHomeTown($value) {
		return $this->setHome_town($value);
	}

	/**
	 * Gets the value of the preferences field
	 */
	function getPreferences() {
		return $this->preferences;
	}

	/**
	 * Sets the value of the preferences field
	 * @return Drivers
	 */
	function setPreferences($value) {
		return $this->setColumnValue('preferences', $value, BaseModel::COLUMN_TYPE_LONGVARCHAR);
	}

	/**
	 * Gets the value of the truck_no field
	 */
	function getTruck_no() {
		return $this->truck_no;
	}

	/**
	 * Sets the value of the truck_no field
	 * @return Drivers
	 */
	function setTruck_no($value) {
		return $this->setColumnValue('truck_no', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the truck_no field
	 */
	function getTruckNo() {
		return $this->getTruck_no();
	}

	/**
	 * Sets the value of the truck_no field
	 * @return Drivers
	 */
	function setTruckNo($value) {
		return $this->setTruck_no($value);
	}

	/**
	 * Gets the value of the telephone field
	 */
	function getTelephone() {
		return $this->telephone;
	}

	/**
	 * Sets the value of the telephone field
	 * @return Drivers
	 */
	function setTelephone($value) {
		return $this->setColumnValue('telephone', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the comments field
	 */
	function getComments() {
		return $this->comments;
	}

	/**
	 * Sets the value of the comments field
	 * @return Drivers
	 */
	function setComments($value) {
		return $this->setColumnValue('comments', $value, BaseModel::COLUMN_TYPE_LONGVARCHAR);
	}

	/**
	 * Gets the value of the home_office field
	 */
	function getHome_office() {
		return $this->home_office;
	}

	/**
	 * Sets the value of the home_office field
	 * @return Drivers
	 */
	function setHome_office($value) {
		return $this->setColumnValue('home_office', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the home_office field
	 */
	function getHomeOffice() {
		return $this->getHome_office();
	}

	/**
	 * Sets the value of the home_office field
	 * @return Drivers
	 */
	function setHomeOffice($value) {
		return $this->setHome_office($value);
	}

	/**
	 * Gets the value of the office_numbers field
	 */
	function getOffice_numbers() {
		return $this->office_numbers;
	}

	/**
	 * Sets the value of the office_numbers field
	 * @return Drivers
	 */
	function setOffice_numbers($value) {
		return $this->setColumnValue('office_numbers', $value, BaseModel::COLUMN_TYPE_LONGVARCHAR);
	}

	/**
	 * Gets the value of the office_numbers field
	 */
	function getOfficeNumbers() {
		return $this->getOffice_numbers();
	}

	/**
	 * Sets the value of the office_numbers field
	 * @return Drivers
	 */
	function setOfficeNumbers($value) {
		return $this->setOffice_numbers($value);
	}

	/**
	 * Gets the value of the message_voice_mail field
	 */
	function getMessage_voice_mail() {
		return $this->message_voice_mail;
	}

	/**
	 * Sets the value of the message_voice_mail field
	 * @return Drivers
	 */
	function setMessage_voice_mail($value) {
		return $this->setColumnValue('message_voice_mail', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the message_voice_mail field
	 */
	function getMessageVoiceMail() {
		return $this->getMessage_voice_mail();
	}

	/**
	 * Sets the value of the message_voice_mail field
	 * @return Drivers
	 */
	function setMessageVoiceMail($value) {
		return $this->setMessage_voice_mail($value);
	}

	/**
	 * Gets the value of the canada field
	 */
	function getCanada() {
		return $this->canada;
	}

	/**
	 * Sets the value of the canada field
	 * @return Drivers
	 */
	function setCanada($value) {
		return $this->setColumnValue('canada', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the no_canada field
	 */
	function getNo_canada() {
		return $this->no_canada;
	}

	/**
	 * Sets the value of the no_canada field
	 * @return Drivers
	 */
	function setNo_canada($value) {
		return $this->setColumnValue('no_canada', $value, BaseModel::COLUMN_TYPE_TINYINT);
	}

	/**
	 * Gets the value of the no_canada field
	 */
	function getNoCanada() {
		return $this->getNo_canada();
	}

	/**
	 * Sets the value of the no_canada field
	 * @return Drivers
	 */
	function setNoCanada($value) {
		return $this->setNo_canada($value);
	}

	/**
	 * Gets the value of the twic field
	 */
	function getTwic() {
		return $this->twic;
	}

	/**
	 * Sets the value of the twic field
	 * @return Drivers
	 */
	function setTwic($value) {
		return $this->setColumnValue('twic', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the no_twic field
	 */
	function getNo_twic() {
		return $this->no_twic;
	}

	/**
	 * Sets the value of the no_twic field
	 * @return Drivers
	 */
	function setNo_twic($value) {
		return $this->setColumnValue('no_twic', $value, BaseModel::COLUMN_TYPE_TINYINT);
	}

	/**
	 * Gets the value of the no_twic field
	 */
	function getNoTwic() {
		return $this->getNo_twic();
	}

	/**
	 * Sets the value of the no_twic field
	 * @return Drivers
	 */
	function setNoTwic($value) {
		return $this->setNo_twic($value);
	}

	/**
	 * Gets the value of the f4ft_tarps field
	 */
	function getF4ft_tarps() {
		return $this->f4ft_tarps;
	}

	/**
	 * Sets the value of the f4ft_tarps field
	 * @return Drivers
	 */
	function setF4ft_tarps($value) {
		return $this->setColumnValue('f4ft_tarps', $value, BaseModel::COLUMN_TYPE_TINYINT);
	}

	/**
	 * Gets the value of the f4ft_tarps field
	 */
	function getF4ftTarps() {
		return $this->getF4ft_tarps();
	}

	/**
	 * Sets the value of the f4ft_tarps field
	 * @return Drivers
	 */
	function setF4ftTarps($value) {
		return $this->setF4ft_tarps($value);
	}

	/**
	 * Gets the value of the f6ft_tarps field
	 */
	function getF6ft_tarps() {
		return $this->f6ft_tarps;
	}

	/**
	 * Sets the value of the f6ft_tarps field
	 * @return Drivers
	 */
	function setF6ft_tarps($value) {
		return $this->setColumnValue('f6ft_tarps', $value, BaseModel::COLUMN_TYPE_TINYINT);
	}

	/**
	 * Gets the value of the f6ft_tarps field
	 */
	function getF6ftTarps() {
		return $this->getF6ft_tarps();
	}

	/**
	 * Sets the value of the f6ft_tarps field
	 * @return Drivers
	 */
	function setF6ftTarps($value) {
		return $this->setF6ft_tarps($value);
	}

	/**
	 * Gets the value of the f8ft_tarps field
	 */
	function getF8ft_tarps() {
		return $this->f8ft_tarps;
	}

	/**
	 * Sets the value of the f8ft_tarps field
	 * @return Drivers
	 */
	function setF8ft_tarps($value) {
		return $this->setColumnValue('f8ft_tarps', $value, BaseModel::COLUMN_TYPE_TINYINT);
	}

	/**
	 * Gets the value of the f8ft_tarps field
	 */
	function getF8ftTarps() {
		return $this->getF8ft_tarps();
	}

	/**
	 * Sets the value of the f8ft_tarps field
	 * @return Drivers
	 */
	function setF8ftTarps($value) {
		return $this->setF8ft_tarps($value);
	}

	/**
	 * Gets the value of the no_tarps field
	 */
	function getNo_tarps() {
		return $this->no_tarps;
	}

	/**
	 * Sets the value of the no_tarps field
	 * @return Drivers
	 */
	function setNo_tarps($value) {
		return $this->setColumnValue('no_tarps', $value, BaseModel::COLUMN_TYPE_TINYINT);
	}

	/**
	 * Gets the value of the no_tarps field
	 */
	function getNoTarps() {
		return $this->getNo_tarps();
	}

	/**
	 * Sets the value of the no_tarps field
	 * @return Drivers
	 */
	function setNoTarps($value) {
		return $this->setNo_tarps($value);
	}

	/**
	 * Gets the value of the pipe_stakes field
	 */
	function getPipe_stakes() {
		return $this->pipe_stakes;
	}

	/**
	 * Sets the value of the pipe_stakes field
	 * @return Drivers
	 */
	function setPipe_stakes($value) {
		return $this->setColumnValue('pipe_stakes', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the pipe_stakes field
	 */
	function getPipeStakes() {
		return $this->getPipe_stakes();
	}

	/**
	 * Sets the value of the pipe_stakes field
	 * @return Drivers
	 */
	function setPipeStakes($value) {
		return $this->setPipe_stakes($value);
	}

	/**
	 * Gets the value of the load_status field
	 */
	function getLoad_status() {
		return $this->load_status;
	}

	/**
	 * Sets the value of the load_status field
	 * @return Drivers
	 */
	function setLoad_status($value) {
		return $this->setColumnValue('load_status', $value, BaseModel::COLUMN_TYPE_TINYINT);
	}

	/**
	 * Gets the value of the load_status field
	 */
	function getLoadStatus() {
		return $this->getLoad_status();
	}

	/**
	 * Sets the value of the load_status field
	 * @return Drivers
	 */
	function setLoadStatus($value) {
		return $this->setLoad_status($value);
	}

	/**
	 * Gets the value of the no_pipe_stakes field
	 */
	function getNo_pipe_stakes() {
		return $this->no_pipe_stakes;
	}

	/**
	 * Sets the value of the no_pipe_stakes field
	 * @return Drivers
	 */
	function setNo_pipe_stakes($value) {
		return $this->setColumnValue('no_pipe_stakes', $value, BaseModel::COLUMN_TYPE_TINYINT);
	}

	/**
	 * Gets the value of the no_pipe_stakes field
	 */
	function getNoPipeStakes() {
		return $this->getNo_pipe_stakes();
	}

	/**
	 * Sets the value of the no_pipe_stakes field
	 * @return Drivers
	 */
	function setNoPipeStakes($value) {
		return $this->setNo_pipe_stakes($value);
	}

	/**
	 * Gets the value of the driving_limitations field
	 */
	function getDriving_limitations() {
		return $this->driving_limitations;
	}

	/**
	 * Sets the value of the driving_limitations field
	 * @return Drivers
	 */
	function setDriving_limitations($value) {
		return $this->setColumnValue('driving_limitations', $value, BaseModel::COLUMN_TYPE_LONGVARCHAR);
	}

	/**
	 * Gets the value of the driving_limitations field
	 */
	function getDrivingLimitations() {
		return $this->getDriving_limitations();
	}

	/**
	 * Sets the value of the driving_limitations field
	 * @return Drivers
	 */
	function setDrivingLimitations($value) {
		return $this->setDriving_limitations($value);
	}

	/**
	 * Gets the value of the load_levelers field
	 */
	function getLoad_levelers() {
		return $this->load_levelers;
	}

	/**
	 * Sets the value of the load_levelers field
	 * @return Drivers
	 */
	function setLoad_levelers($value) {
		return $this->setColumnValue('load_levelers', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the load_levelers field
	 */
	function getLoadLevelers() {
		return $this->getLoad_levelers();
	}

	/**
	 * Sets the value of the load_levelers field
	 * @return Drivers
	 */
	function setLoadLevelers($value) {
		return $this->setLoad_levelers($value);
	}

	/**
	 * Gets the value of the no_load_levelers field
	 */
	function getNo_load_levelers() {
		return $this->no_load_levelers;
	}

	/**
	 * Sets the value of the no_load_levelers field
	 * @return Drivers
	 */
	function setNo_load_levelers($value) {
		return $this->setColumnValue('no_load_levelers', $value, BaseModel::COLUMN_TYPE_TINYINT);
	}

	/**
	 * Gets the value of the no_load_levelers field
	 */
	function getNoLoadLevelers() {
		return $this->getNo_load_levelers();
	}

	/**
	 * Sets the value of the no_load_levelers field
	 * @return Drivers
	 */
	function setNoLoadLevelers($value) {
		return $this->setNo_load_levelers($value);
	}

	/**
	 * Gets the value of the load_options field
	 */
	function getLoad_options() {
		return $this->load_options;
	}

	/**
	 * Sets the value of the load_options field
	 * @return Drivers
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
	 * @return Drivers
	 */
	function setLoadOptions($value) {
		return $this->setLoad_options($value);
	}

	/**
	 * Gets the value of the loads_completed field
	 */
	function getLoads_completed() {
		return $this->loads_completed;
	}

	/**
	 * Sets the value of the loads_completed field
	 * @return Drivers
	 */
	function setLoads_completed($value) {
		return $this->setColumnValue('loads_completed', $value, BaseModel::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Gets the value of the loads_completed field
	 */
	function getLoadsCompleted() {
		return $this->getLoads_completed();
	}

	/**
	 * Sets the value of the loads_completed field
	 * @return Drivers
	 */
	function setLoadsCompleted($value) {
		return $this->setLoads_completed($value);
	}

	/**
	 * Gets the value of the upload_comment field
	 */
	function getUpload_comment() {
		return $this->upload_comment;
	}

	/**
	 * Sets the value of the upload_comment field
	 * @return Drivers
	 */
	function setUpload_comment($value) {
		return $this->setColumnValue('upload_comment', $value, BaseModel::COLUMN_TYPE_LONGVARCHAR);
	}

	/**
	 * Gets the value of the upload_comment field
	 */
	function getUploadComment() {
		return $this->getUpload_comment();
	}

	/**
	 * Sets the value of the upload_comment field
	 * @return Drivers
	 */
	function setUploadComment($value) {
		return $this->setUpload_comment($value);
	}

	/**
	 * Gets the value of the email field
	 */
	function getEmail() {
		return $this->email;
	}

	/**
	 * Sets the value of the email field
	 * @return Drivers
	 */
	function setEmail($value) {
		return $this->setColumnValue('email', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the unload_month field
	 */
	function getUnload_month() {
		return $this->unload_month;
	}

	/**
	 * Sets the value of the unload_month field
	 * @return Drivers
	 */
	function setUnload_month($value) {
		return $this->setColumnValue('unload_month', $value, BaseModel::COLUMN_TYPE_TINYINT);
	}

	/**
	 * Gets the value of the unload_month field
	 */
	function getUnloadMonth() {
		return $this->getUnload_month();
	}

	/**
	 * Sets the value of the unload_month field
	 * @return Drivers
	 */
	function setUnloadMonth($value) {
		return $this->setUnload_month($value);
	}

	/**
	 * Gets the value of the unload_day field
	 */
	function getUnload_day() {
		return $this->unload_day;
	}

	/**
	 * Sets the value of the unload_day field
	 * @return Drivers
	 */
	function setUnload_day($value) {
		return $this->setColumnValue('unload_day', $value, BaseModel::COLUMN_TYPE_TINYINT);
	}

	/**
	 * Gets the value of the unload_day field
	 */
	function getUnloadDay() {
		return $this->getUnload_day();
	}

	/**
	 * Sets the value of the unload_day field
	 * @return Drivers
	 */
	function setUnloadDay($value) {
		return $this->setUnload_day($value);
	}

	/**
	 * Gets the value of the status field
	 */
	function getStatus() {
		return $this->status;
	}

	/**
	 * Sets the value of the status field
	 * @return Drivers
	 */
	function setStatus($value) {
		return $this->setColumnValue('status', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the origin_city field
	 */
	function getOrigin_city() {
		return $this->origin_city;
	}

	/**
	 * Sets the value of the origin_city field
	 * @return Drivers
	 */
	function setOrigin_city($value) {
		return $this->setColumnValue('origin_city', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the origin_city field
	 */
	function getOriginCity() {
		return $this->getOrigin_city();
	}

	/**
	 * Sets the value of the origin_city field
	 * @return Drivers
	 */
	function setOriginCity($value) {
		return $this->setOrigin_city($value);
	}

	/**
	 * Gets the value of the origin_state field
	 */
	function getOrigin_state() {
		return $this->origin_state;
	}

	/**
	 * Sets the value of the origin_state field
	 * @return Drivers
	 */
	function setOrigin_state($value) {
		return $this->setColumnValue('origin_state', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the origin_state field
	 */
	function getOriginState() {
		return $this->getOrigin_state();
	}

	/**
	 * Sets the value of the origin_state field
	 * @return Drivers
	 */
	function setOriginState($value) {
		return $this->setOrigin_state($value);
	}

	/**
	 * Gets the value of the destination_city field
	 */
	function getDestination_city() {
		return $this->destination_city;
	}

	/**
	 * Sets the value of the destination_city field
	 * @return Drivers
	 */
	function setDestination_city($value) {
		return $this->setColumnValue('destination_city', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the destination_city field
	 */
	function getDestinationCity() {
		return $this->getDestination_city();
	}

	/**
	 * Sets the value of the destination_city field
	 * @return Drivers
	 */
	function setDestinationCity($value) {
		return $this->setDestination_city($value);
	}

	/**
	 * Gets the value of the destination_state field
	 */
	function getDestination_state() {
		return $this->destination_state;
	}

	/**
	 * Sets the value of the destination_state field
	 * @return Drivers
	 */
	function setDestination_state($value) {
		return $this->setColumnValue('destination_state', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the destination_state field
	 */
	function getDestinationState() {
		return $this->getDestination_state();
	}

	/**
	 * Sets the value of the destination_state field
	 * @return Drivers
	 */
	function setDestinationState($value) {
		return $this->setDestination_state($value);
	}

	/**
	 * Gets the value of the rating field
	 */
	function getRating() {
		return $this->rating;
	}

	/**
	 * Sets the value of the rating field
	 * @return Drivers
	 */
	function setRating($value) {
		return $this->setColumnValue('rating', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the pole_bunks field
	 */
	function getPole_bunks() {
		return $this->pole_bunks;
	}

	/**
	 * Sets the value of the pole_bunks field
	 * @return Drivers
	 */
	function setPole_bunks($value) {
		return $this->setColumnValue('pole_bunks', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the pole_bunks field
	 */
	function getPoleBunks() {
		return $this->getPole_bunks();
	}

	/**
	 * Sets the value of the pole_bunks field
	 * @return Drivers
	 */
	function setPoleBunks($value) {
		return $this->setPole_bunks($value);
	}

	/**
	 * Gets the value of the loadid field
	 */
	function getLoadid() {
		return $this->loadid;
	}

	/**
	 * Sets the value of the loadid field
	 * @return Drivers
	 */
	function setLoadid($value) {
		return $this->setColumnValue('loadid', $value, BaseModel::COLUMN_TYPE_BIGINT);
	}

	/**
	 * Gets the value of the canada_limitations field
	 */
	function getCanada_limitations() {
		return $this->canada_limitations;
	}

	/**
	 * Sets the value of the canada_limitations field
	 * @return Drivers
	 */
	function setCanada_limitations($value) {
		return $this->setColumnValue('canada_limitations', $value, BaseModel::COLUMN_TYPE_LONGVARCHAR);
	}

	/**
	 * Gets the value of the canada_limitations field
	 */
	function getCanadaLimitations() {
		return $this->getCanada_limitations();
	}

	/**
	 * Sets the value of the canada_limitations field
	 * @return Drivers
	 */
	function setCanadaLimitations($value) {
		return $this->setCanada_limitations($value);
	}

	/**
	 * Gets the value of the phone_numbers field
	 */
	function getPhone_numbers() {
		return $this->phone_numbers;
	}

	/**
	 * Sets the value of the phone_numbers field
	 * @return Drivers
	 */
	function setPhone_numbers($value) {
		return $this->setColumnValue('phone_numbers', $value, BaseModel::COLUMN_TYPE_LONGVARCHAR);
	}

	/**
	 * Gets the value of the phone_numbers field
	 */
	function getPhoneNumbers() {
		return $this->getPhone_numbers();
	}

	/**
	 * Sets the value of the phone_numbers field
	 * @return Drivers
	 */
	function setPhoneNumbers($value) {
		return $this->setPhone_numbers($value);
	}

	/**
	 * Gets the value of the officeid field
	 */
	function getOfficeid() {
		return $this->officeid;
	}

	/**
	 * Sets the value of the officeid field
	 * @return Drivers
	 */
	function setOfficeid($value) {
		return $this->setColumnValue('officeid', $value, BaseModel::COLUMN_TYPE_BIGINT);
	}

	/**
	 * Gets the value of the dldeliverydate field
	 */
	function getDldeliverydate($format = null) {
		if (null === $this->dldeliverydate || null === $format) {
			return $this->dldeliverydate;
		}
		if (0 === strpos($this->dldeliverydate, '0000-00-00')) {
			return null;
		}
		return date($format, strtotime($this->dldeliverydate));
	}

	/**
	 * Sets the value of the dldeliverydate field
	 * @return Drivers
	 */
	function setDldeliverydate($value) {
		return $this->setColumnValue('dldeliverydate', $value, BaseModel::COLUMN_TYPE_DATE);
	}

	/**
	 * Gets the value of the dldeliverylocation field
	 */
	function getDldeliverylocation() {
		return $this->dldeliverylocation;
	}

	/**
	 * Sets the value of the dldeliverylocation field
	 * @return Drivers
	 */
	function setDldeliverylocation($value) {
		return $this->setColumnValue('dldeliverylocation', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the notes field
	 */
	function getNotes() {
		return $this->notes;
	}

	/**
	 * Sets the value of the notes field
	 * @return Drivers
	 */
	function setNotes($value) {
		return $this->setColumnValue('notes', $value, BaseModel::COLUMN_TYPE_LONGVARCHAR);
	}

	/**
	 * Gets the value of the zones field
	 */
	function getZones() {
		return $this->zones;
	}

	/**
	 * Sets the value of the zones field
	 * @return Drivers
	 */
	function setZones($value) {
		return $this->setColumnValue('zones', $value, BaseModel::COLUMN_TYPE_LONGVARCHAR);
	}

	/**
	 * @return DABLPDO
	 */
	static function getConnection() {
		return DBManager::getConnection('default_mysqll');
	}

	/**
	 * @return Drivers
	 */
	static function create() {
		return new Drivers();
	}

	/**
	 * Returns String representation of table name
	 * @return string
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
	 * Access to array of column types, indexed by column name
	 * @return array
	 */
	static function getColumnTypes() {
		return Drivers::$_columnTypes;
	}

	/**
	 * Get the type of a column
	 * @return array
	 */
	static function getColumnType($column_name) {
		return Drivers::$_columnTypes[$column_name];
	}

	/**
	 * @return bool
	 */
	static function hasColumn($column_name) {
		static $lower_case_columns = null;
		if (null === $lower_case_columns) {
			$lower_case_columns = array_map('strtolower', Drivers::$_columnNames);
		}
		return in_array(strtolower($column_name), $lower_case_columns);
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
	 * Returns true if the primary key column for this table is auto-increment
	 * @return bool
	 */
	static function isAutoIncrement() {
		return Drivers::$_isAutoIncrement;
	}

	/**
	 * Searches the database for a row with the ID(primary key) that matches
	 * the one input.
	 * @return Drivers
	 */
	static function retrieveByPK($the_pk) {
		return Drivers::retrieveByPKs($the_pk);
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return Drivers
	 */
	static function retrieveByPKs($id) {
		if (null === $id) {
			return null;
		}
		$pool_instance = Drivers::retrieveFromPool($id);
		if (null !== $pool_instance) {
			return $pool_instance;
		}
		$conn = Drivers::getConnection();
		$q = new Query;
		$q->add('id', $id);
		return array_shift(Drivers::doSelect($q, true));
	}

	/**
	 * Searches the database for a row with a id	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveById($value) {
		return Drivers::retrieveByPK($value);
	}

	/**
	 * Searches the database for a row with a agentid	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByAgentid($value) {
		return Drivers::retrieveByColumn('agentid', $value);
	}

	/**
	 * Searches the database for a row with a name	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByName($value) {
		return Drivers::retrieveByColumn('name', $value);
	}

	/**
	 * Searches the database for a row with a driver_alias	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByDriverAlias($value) {
		return Drivers::retrieveByColumn('driver_alias', $value);
	}

	/**
	 * Searches the database for a row with a unload_date	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByUnloadDate($value) {
		return Drivers::retrieveByColumn('unload_date', $value);
	}

	/**
	 * Searches the database for a row with a location	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByLocation($value) {
		return Drivers::retrieveByColumn('location', $value);
	}

	/**
	 * Searches the database for a row with a equipment	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByEquipment($value) {
		return Drivers::retrieveByColumn('equipment', $value);
	}

	/**
	 * Searches the database for a row with a tlength	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByTlength($value) {
		return Drivers::retrieveByColumn('tlength', $value);
	}

	/**
	 * Searches the database for a row with a ttype	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByTtype($value) {
		return Drivers::retrieveByColumn('ttype', $value);
	}

	/**
	 * Searches the database for a row with a home_town	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByHomeTown($value) {
		return Drivers::retrieveByColumn('home_town', $value);
	}

	/**
	 * Searches the database for a row with a preferences	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByPreferences($value) {
		return Drivers::retrieveByColumn('preferences', $value);
	}

	/**
	 * Searches the database for a row with a truck_no	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByTruckNo($value) {
		return Drivers::retrieveByColumn('truck_no', $value);
	}

	/**
	 * Searches the database for a row with a telephone	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByTelephone($value) {
		return Drivers::retrieveByColumn('telephone', $value);
	}

	/**
	 * Searches the database for a row with a comments	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByComments($value) {
		return Drivers::retrieveByColumn('comments', $value);
	}

	/**
	 * Searches the database for a row with a home_office	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByHomeOffice($value) {
		return Drivers::retrieveByColumn('home_office', $value);
	}

	/**
	 * Searches the database for a row with a office_numbers	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByOfficeNumbers($value) {
		return Drivers::retrieveByColumn('office_numbers', $value);
	}

	/**
	 * Searches the database for a row with a message_voice_mail	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByMessageVoiceMail($value) {
		return Drivers::retrieveByColumn('message_voice_mail', $value);
	}

	/**
	 * Searches the database for a row with a canada	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByCanada($value) {
		return Drivers::retrieveByColumn('canada', $value);
	}

	/**
	 * Searches the database for a row with a no_canada	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByNoCanada($value) {
		return Drivers::retrieveByColumn('no_canada', $value);
	}

	/**
	 * Searches the database for a row with a twic	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByTwic($value) {
		return Drivers::retrieveByColumn('twic', $value);
	}

	/**
	 * Searches the database for a row with a no_twic	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByNoTwic($value) {
		return Drivers::retrieveByColumn('no_twic', $value);
	}

	/**
	 * Searches the database for a row with a f4ft_tarps	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByF4ftTarps($value) {
		return Drivers::retrieveByColumn('f4ft_tarps', $value);
	}

	/**
	 * Searches the database for a row with a f6ft_tarps	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByF6ftTarps($value) {
		return Drivers::retrieveByColumn('f6ft_tarps', $value);
	}

	/**
	 * Searches the database for a row with a f8ft_tarps	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByF8ftTarps($value) {
		return Drivers::retrieveByColumn('f8ft_tarps', $value);
	}

	/**
	 * Searches the database for a row with a no_tarps	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByNoTarps($value) {
		return Drivers::retrieveByColumn('no_tarps', $value);
	}

	/**
	 * Searches the database for a row with a pipe_stakes	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByPipeStakes($value) {
		return Drivers::retrieveByColumn('pipe_stakes', $value);
	}

	/**
	 * Searches the database for a row with a load_status	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByLoadStatus($value) {
		return Drivers::retrieveByColumn('load_status', $value);
	}

	/**
	 * Searches the database for a row with a no_pipe_stakes	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByNoPipeStakes($value) {
		return Drivers::retrieveByColumn('no_pipe_stakes', $value);
	}

	/**
	 * Searches the database for a row with a driving_limitations	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByDrivingLimitations($value) {
		return Drivers::retrieveByColumn('driving_limitations', $value);
	}

	/**
	 * Searches the database for a row with a load_levelers	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByLoadLevelers($value) {
		return Drivers::retrieveByColumn('load_levelers', $value);
	}

	/**
	 * Searches the database for a row with a no_load_levelers	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByNoLoadLevelers($value) {
		return Drivers::retrieveByColumn('no_load_levelers', $value);
	}

	/**
	 * Searches the database for a row with a load_options	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByLoadOptions($value) {
		return Drivers::retrieveByColumn('load_options', $value);
	}

	/**
	 * Searches the database for a row with a loads_completed	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByLoadsCompleted($value) {
		return Drivers::retrieveByColumn('loads_completed', $value);
	}

	/**
	 * Searches the database for a row with a upload_comment	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByUploadComment($value) {
		return Drivers::retrieveByColumn('upload_comment', $value);
	}

	/**
	 * Searches the database for a row with a email	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByEmail($value) {
		return Drivers::retrieveByColumn('email', $value);
	}

	/**
	 * Searches the database for a row with a unload_month	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByUnloadMonth($value) {
		return Drivers::retrieveByColumn('unload_month', $value);
	}

	/**
	 * Searches the database for a row with a unload_day	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByUnloadDay($value) {
		return Drivers::retrieveByColumn('unload_day', $value);
	}

	/**
	 * Searches the database for a row with a status	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByStatus($value) {
		return Drivers::retrieveByColumn('status', $value);
	}

	/**
	 * Searches the database for a row with a origin_city	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByOriginCity($value) {
		return Drivers::retrieveByColumn('origin_city', $value);
	}

	/**
	 * Searches the database for a row with a origin_state	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByOriginState($value) {
		return Drivers::retrieveByColumn('origin_state', $value);
	}

	/**
	 * Searches the database for a row with a destination_city	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByDestinationCity($value) {
		return Drivers::retrieveByColumn('destination_city', $value);
	}

	/**
	 * Searches the database for a row with a destination_state	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByDestinationState($value) {
		return Drivers::retrieveByColumn('destination_state', $value);
	}

	/**
	 * Searches the database for a row with a rating	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByRating($value) {
		return Drivers::retrieveByColumn('rating', $value);
	}

	/**
	 * Searches the database for a row with a pole_bunks	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByPoleBunks($value) {
		return Drivers::retrieveByColumn('pole_bunks', $value);
	}

	/**
	 * Searches the database for a row with a loadid	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByLoadid($value) {
		return Drivers::retrieveByColumn('loadid', $value);
	}

	/**
	 * Searches the database for a row with a canada_limitations	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByCanadaLimitations($value) {
		return Drivers::retrieveByColumn('canada_limitations', $value);
	}

	/**
	 * Searches the database for a row with a phone_numbers	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByPhoneNumbers($value) {
		return Drivers::retrieveByColumn('phone_numbers', $value);
	}

	/**
	 * Searches the database for a row with a officeid	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByOfficeid($value) {
		return Drivers::retrieveByColumn('officeid', $value);
	}

	/**
	 * Searches the database for a row with a dldeliverydate	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByDldeliverydate($value) {
		return Drivers::retrieveByColumn('dldeliverydate', $value);
	}

	/**
	 * Searches the database for a row with a dldeliverylocation	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByDldeliverylocation($value) {
		return Drivers::retrieveByColumn('dldeliverylocation', $value);
	}

	/**
	 * Searches the database for a row with a notes	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByNotes($value) {
		return Drivers::retrieveByColumn('notes', $value);
	}

	/**
	 * Searches the database for a row with a zones	 * value that matches the one provided
	 * @return Drivers
	 */
	static function retrieveByZones($value) {
		return Drivers::retrieveByColumn('zones', $value);
	}

	static function retrieveByColumn($field, $value) {
		$conn = Drivers::getConnection();
		return array_shift(Drivers::doSelect(Query::create()->add($field, $value)->setLimit(1)->order('id')));
	}

	/**
	 * Populates and returns an instance of Drivers with the
	 * first result of a query.  If the query returns no results,
	 * returns null.
	 * @return Drivers
	 */
	static function fetchSingle($query_string, $write_cache = true) {
		return array_shift(Drivers::fetch($query_string, $write_cache));
	}

	/**
	 * Populates and returns an array of Drivers objects with the
	 * results of a query.  If the query returns no results,
	 * returns an empty Array.
	 * @return Drivers[]
	 */
	static function fetch($query_string, $write_cache = false) {
		$conn = Drivers::getConnection();
		$result = $conn->query($query_string);
		return Drivers::fromResult($result, 'Drivers', $write_cache);
	}

	/**
	 * Returns an array of Drivers objects from
	 * a PDOStatement(query result).
	 *
	 * @see BaseModel::fromResult
	 */
	static function fromResult(PDOStatement $result, $class = 'Drivers', $write_cache = false) {
		return baseModel::fromResult($result, $class, $write_cache);
	}

	/**
	 * Casts values of int fields to (int)
	 * @return Drivers
	 */
	function castInts() {
		$this->id = (null === $this->id) ? null : (int) $this->id;
		$this->agentid = (null === $this->agentid) ? null : (int) $this->agentid;
		$this->no_canada = (null === $this->no_canada) ? null : (int) $this->no_canada;
		$this->no_twic = (null === $this->no_twic) ? null : (int) $this->no_twic;
		$this->f4ft_tarps = (null === $this->f4ft_tarps) ? null : (int) $this->f4ft_tarps;
		$this->f6ft_tarps = (null === $this->f6ft_tarps) ? null : (int) $this->f6ft_tarps;
		$this->f8ft_tarps = (null === $this->f8ft_tarps) ? null : (int) $this->f8ft_tarps;
		$this->no_tarps = (null === $this->no_tarps) ? null : (int) $this->no_tarps;
		$this->load_status = (null === $this->load_status) ? null : (int) $this->load_status;
		$this->no_pipe_stakes = (null === $this->no_pipe_stakes) ? null : (int) $this->no_pipe_stakes;
		$this->no_load_levelers = (null === $this->no_load_levelers) ? null : (int) $this->no_load_levelers;
		$this->loads_completed = (null === $this->loads_completed) ? null : (int) $this->loads_completed;
		$this->unload_month = (null === $this->unload_month) ? null : (int) $this->unload_month;
		$this->unload_day = (null === $this->unload_day) ? null : (int) $this->unload_day;
		$this->loadid = (null === $this->loadid) ? null : (int) $this->loadid;
		$this->officeid = (null === $this->officeid) ? null : (int) $this->officeid;
		return $this;
	}

	/**
	 * Add (or replace) to the instance pool.
	 *
	 * @param Drivers $object
	 * @return void
	 */
	static function insertIntoPool(Drivers $object) {
		if (Drivers::$_instancePoolCount > Drivers::MAX_INSTANCE_POOL_SIZE) {
			return;
		}

		Drivers::$_instancePool[implode('-', $object->getPrimaryKeyValues())] = clone $object;
		++Drivers::$_instancePoolCount;
	}

	/**
	 * Return the cached instance from the pool.
	 *
	 * @param mixed $pk Primary Key
	 * @return Drivers
	 */
	static function retrieveFromPool($pk) {
		if (null === $pk) {
			return null;
		}
		if (array_key_exists($pk, Drivers::$_instancePool)) {
			return clone Drivers::$_instancePool[$pk];
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

		if (array_key_exists($pk, Drivers::$_instancePool)) {
			unset(Drivers::$_instancePool[$pk]);
			--Drivers::$_instancePoolCount;
		}
	}

	/**
	 * Empty the instance pool.
	 *
	 * @return void
	 */
	static function flushPool() {
		Drivers::$_instancePool = array();
	}

	/**
	 * Returns an array of all Drivers objects in the database.
	 * $extra SQL can be appended to the query to LIMIT, SORT, and/or GROUP results.
	 * If there are no results, returns an empty Array.
	 * @param $extra string
	 * @return Drivers[]
	 */
	static function getAll($extra = null, $write_cache = false) {
		$conn = Drivers::getConnection();
		$table_quoted = $conn->quoteIdentifier(Drivers::getTableName());
		return Drivers::fetch("SELECT * FROM $table_quoted $extra ", $write_cache);
	}

	/**
	 * @return int
	 */
	static function doCount(Query $q = null) {
		$q = $q ? clone $q : new Query;
		$conn = Drivers::getConnection();
		if (!$q->getTable() || Drivers::getTableName() != $q->getTable()) {
			$q->setTable(Drivers::getTableName());
		}
		return $q->doCount($conn);
	}

	/**
	 * @param Query $q
	 * @param bool $dump_cache
	 * @return int
	 */
	static function doDelete(Query $q, $dump_cache = true) {
		$conn = Drivers::getConnection();
		$q = clone $q;
		if (!$q->getTable() || Drivers::getTableName() != $q->getTable()) {
			$q->setTable(Drivers::getTableName());
		}
		$result = $q->doDelete($conn);

		if ($dump_cache) {
			Drivers::$_instancePool = array();
		}

		return $result;
	}

	/**
	 * @param Query $q The Query object that creates the SELECT query string
	 * @param bool $write_cache Whether or not to store results in instance pool
	 * @param array $additional_classes Array of additional classes for fromResult to instantiate as properties
	 * @return Drivers[]
	 */
	static function doSelect(Query $q = null, $write_cache = false, $additional_classes = null) {
		if (is_array($additional_classes)) {
			array_unshift($additional_classes, 'Drivers');
			$class = $additional_classes;
		} else {
			$class = 'Drivers';
		}

		return Drivers::fromResult(self::doSelectRS($q), $class, $write_cache);
	}

	/**
	 * Executes a select query and returns the PDO result
	 * @return PDOStatement
	 */
	static function doSelectRS(Query $q = null) {
		$q = $q ? clone $q : new Query;
		$conn = Drivers::getConnection();
		if (!$q->getTable() || Drivers::getTableName() != $q->getTable()) {
			$q->setTable(Drivers::getTableName());
		}

		return $q->doSelect($conn);
	}

	/**
	 * @return Drivers[]
	 */
	static function doSelectJoinAll(Query $q = null, $write_cache = false, $join_type = Query::LEFT_JOIN) {
		$q = $q ? clone $q : new Query;
		$columns = $q->getColumns();
		$classes = array();
		$alias = $q->getAlias();
		$this_table = $alias ? $alias : Drivers::getTableName();
		if (!$columns) {
			$columns[] = $this_table . '.*';
		}

		$q->setColumns($columns);
		return Drivers::doSelect($q, $write_cache, $classes);
	}

	/**
	 * Returns true if the column values validate.
	 * @return bool
	 */
	function validate() {
		$this->_validationErrors = array();
		if (null === $this->getdldeliverylocation()) {
			$this->_validationErrors[] = 'dldeliverylocation must not be null';
		}
		return 0 === count($this->_validationErrors);
	}

}
