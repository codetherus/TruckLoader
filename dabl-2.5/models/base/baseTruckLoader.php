<?php
/**
 *		Created by Dan Blaisdell's DABL
 *		Do not alter base files, as they will be overwritten.
 *		To alter the objects, alter the extended classes in
 *		the 'models' folder.
 *
 */
abstract class baseTruckLoader extends ApplicationModel {

	/**
	 * Name of the table
	 * @var string
	 */
	protected static $_tableName = 'truck_loader';

	/**
	 * Cache of objects retrieved from the database
	 * @var TruckLoader[]
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
		'userid',
		'driver',
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
		'driver_status',
		'origin_city',
		'origin_state',
		'destination_city',
		'destination_state',
		'rating',
	);

	/**
	 * array of all column types
	 * @var string[]
	 */
	protected static $_columnTypes = array(
		'id' => BaseModel::COLUMN_TYPE_BIGINT,
		'userid' => BaseModel::COLUMN_TYPE_BIGINT,
		'driver' => BaseModel::COLUMN_TYPE_VARCHAR,
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
		'canada' => BaseModel::COLUMN_TYPE_TINYINT,
		'no_canada' => BaseModel::COLUMN_TYPE_TINYINT,
		'twic' => BaseModel::COLUMN_TYPE_TINYINT,
		'no_twic' => BaseModel::COLUMN_TYPE_TINYINT,
		'f4ft_tarps' => BaseModel::COLUMN_TYPE_TINYINT,
		'f6ft_tarps' => BaseModel::COLUMN_TYPE_TINYINT,
		'f8ft_tarps' => BaseModel::COLUMN_TYPE_TINYINT,
		'no_tarps' => BaseModel::COLUMN_TYPE_TINYINT,
		'pipe_stakes' => BaseModel::COLUMN_TYPE_TINYINT,
		'load_status' => BaseModel::COLUMN_TYPE_TINYINT,
		'no_pipe_stakes' => BaseModel::COLUMN_TYPE_TINYINT,
		'driving_limitations' => BaseModel::COLUMN_TYPE_LONGVARCHAR,
		'load_levelers' => BaseModel::COLUMN_TYPE_TINYINT,
		'no_load_levelers' => BaseModel::COLUMN_TYPE_TINYINT,
		'load_options' => BaseModel::COLUMN_TYPE_LONGVARCHAR,
		'loads_completed' => BaseModel::COLUMN_TYPE_INTEGER,
		'upload_comment' => BaseModel::COLUMN_TYPE_LONGVARCHAR,
		'email' => BaseModel::COLUMN_TYPE_VARCHAR,
		'unload_month' => BaseModel::COLUMN_TYPE_TINYINT,
		'unload_day' => BaseModel::COLUMN_TYPE_TINYINT,
		'driver_status' => BaseModel::COLUMN_TYPE_TINYINT,
		'origin_city' => BaseModel::COLUMN_TYPE_VARCHAR,
		'origin_state' => BaseModel::COLUMN_TYPE_VARCHAR,
		'destination_city' => BaseModel::COLUMN_TYPE_VARCHAR,
		'destination_state' => BaseModel::COLUMN_TYPE_VARCHAR,
		'rating' => BaseModel::COLUMN_TYPE_VARCHAR,
	);

	/**
	 * `id` BIGINT NOT NULL DEFAULT ''
	 * @var string
	 */
	protected $id;

	/**
	 * `userid` BIGINT DEFAULT ''
	 * @var string
	 */
	protected $userid;

	/**
	 * `driver` VARCHAR
	 * @var string
	 */
	protected $driver;

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
	 * `canada` TINYINT DEFAULT ''
	 * @var int
	 */
	protected $canada;

	/**
	 * `no_canada` TINYINT DEFAULT ''
	 * @var int
	 */
	protected $no_canada;

	/**
	 * `twic` TINYINT DEFAULT ''
	 * @var int
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
	 * `pipe_stakes` TINYINT DEFAULT ''
	 * @var int
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
	 * `load_levelers` TINYINT DEFAULT ''
	 * @var int
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
	 * `driver_status` TINYINT NOT NULL DEFAULT 1
	 * @var int
	 */
	protected $driver_status = 1;

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
	 * Gets the value of the id field
	 */
	function getId() {
		return $this->id;
	}

	/**
	 * Sets the value of the id field
	 * @return TruckLoader
	 */
	function setId($value) {
		return $this->setColumnValue('id', $value, BaseModel::COLUMN_TYPE_BIGINT);
	}

	/**
	 * Gets the value of the userid field
	 */
	function getUserid() {
		return $this->userid;
	}

	/**
	 * Sets the value of the userid field
	 * @return TruckLoader
	 */
	function setUserid($value) {
		return $this->setColumnValue('userid', $value, BaseModel::COLUMN_TYPE_BIGINT);
	}

	/**
	 * Gets the value of the driver field
	 */
	function getDriver() {
		return $this->driver;
	}

	/**
	 * Sets the value of the driver field
	 * @return TruckLoader
	 */
	function setDriver($value) {
		return $this->setColumnValue('driver', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the driver_alias field
	 */
	function getDriver_alias() {
		return $this->driver_alias;
	}

	/**
	 * Sets the value of the driver_alias field
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
	 */
	function setCanada($value) {
		return $this->setColumnValue('canada', $value, BaseModel::COLUMN_TYPE_TINYINT);
	}

	/**
	 * Gets the value of the no_canada field
	 */
	function getNo_canada() {
		return $this->no_canada;
	}

	/**
	 * Sets the value of the no_canada field
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
	 */
	function setTwic($value) {
		return $this->setColumnValue('twic', $value, BaseModel::COLUMN_TYPE_TINYINT);
	}

	/**
	 * Gets the value of the no_twic field
	 */
	function getNo_twic() {
		return $this->no_twic;
	}

	/**
	 * Sets the value of the no_twic field
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
	 */
	function setPipe_stakes($value) {
		return $this->setColumnValue('pipe_stakes', $value, BaseModel::COLUMN_TYPE_TINYINT);
	}

	/**
	 * Gets the value of the pipe_stakes field
	 */
	function getPipeStakes() {
		return $this->getPipe_stakes();
	}

	/**
	 * Sets the value of the pipe_stakes field
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
	 */
	function setLoad_levelers($value) {
		return $this->setColumnValue('load_levelers', $value, BaseModel::COLUMN_TYPE_TINYINT);
	}

	/**
	 * Gets the value of the load_levelers field
	 */
	function getLoadLevelers() {
		return $this->getLoad_levelers();
	}

	/**
	 * Sets the value of the load_levelers field
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
	 */
	function setUnloadDay($value) {
		return $this->setUnload_day($value);
	}

	/**
	 * Gets the value of the driver_status field
	 */
	function getDriver_status() {
		return $this->driver_status;
	}

	/**
	 * Sets the value of the driver_status field
	 * @return TruckLoader
	 */
	function setDriver_status($value) {
		return $this->setColumnValue('driver_status', $value, BaseModel::COLUMN_TYPE_TINYINT);
	}

	/**
	 * Gets the value of the driver_status field
	 */
	function getDriverStatus() {
		return $this->getDriver_status();
	}

	/**
	 * Sets the value of the driver_status field
	 * @return TruckLoader
	 */
	function setDriverStatus($value) {
		return $this->setDriver_status($value);
	}

	/**
	 * Gets the value of the origin_city field
	 */
	function getOrigin_city() {
		return $this->origin_city;
	}

	/**
	 * Sets the value of the origin_city field
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
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
	 * @return TruckLoader
	 */
	function setRating($value) {
		return $this->setColumnValue('rating', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * @return DABLPDO
	 */
	static function getConnection() {
		return DBManager::getConnection('default_mysqll');
	}

	/**
	 * @return TruckLoader
	 */
	static function create() {
		return new TruckLoader();
	}

	/**
	 * Returns String representation of table name
	 * @return string
	 */
	static function getTableName() {
		return TruckLoader::$_tableName;
	}

	/**
	 * Access to array of column names
	 * @return array
	 */
	static function getColumnNames() {
		return TruckLoader::$_columnNames;
	}

	/**
	 * Access to array of column types, indexed by column name
	 * @return array
	 */
	static function getColumnTypes() {
		return TruckLoader::$_columnTypes;
	}

	/**
	 * Get the type of a column
	 * @return array
	 */
	static function getColumnType($column_name) {
		return TruckLoader::$_columnTypes[$column_name];
	}

	/**
	 * @return bool
	 */
	static function hasColumn($column_name) {
		static $lower_case_columns = null;
		if (null === $lower_case_columns) {
			$lower_case_columns = array_map('strtolower', TruckLoader::$_columnNames);
		}
		return in_array(strtolower($column_name), $lower_case_columns);
	}

	/**
	 * Access to array of primary keys
	 * @return array
	 */
	static function getPrimaryKeys() {
		return TruckLoader::$_primaryKeys;
	}

	/**
	 * Access to name of primary key
	 * @return array
	 */
	static function getPrimaryKey() {
		return TruckLoader::$_primaryKey;
	}

	/**
	 * Returns true if the primary key column for this table is auto-increment
	 * @return bool
	 */
	static function isAutoIncrement() {
		return TruckLoader::$_isAutoIncrement;
	}

	/**
	 * Searches the database for a row with the ID(primary key) that matches
	 * the one input.
	 * @return TruckLoader
	 */
	static function retrieveByPK($the_pk) {
		return TruckLoader::retrieveByPKs($the_pk);
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return TruckLoader
	 */
	static function retrieveByPKs($id) {
		if (null === $id) {
			return null;
		}
		$pool_instance = TruckLoader::retrieveFromPool($id);
		if (null !== $pool_instance) {
			return $pool_instance;
		}
		$conn = TruckLoader::getConnection();
		$q = new Query;
		$q->add('id', $id);
		return array_shift(TruckLoader::doSelect($q, true));
	}

	/**
	 * Searches the database for a row with a id	 * value that matches the one provided
	 * @return TruckLoader
	 */
	static function retrieveById($value) {
		return TruckLoader::retrieveByPK($value);
	}

	/**
	 * Searches the database for a row with a userid	 * value that matches the one provided
	 * @return TruckLoader
	 */
	static function retrieveByUserid($value) {
		return TruckLoader::retrieveByColumn('userid', $value);
	}

	/**
	 * Searches the database for a row with a driver	 * value that matches the one provided
	 * @return TruckLoader
	 */
	static function retrieveByDriver($value) {
		return TruckLoader::retrieveByColumn('driver', $value);
	}

	/**
	 * Searches the database for a row with a driver_alias	 * value that matches the one provided
	 * @return TruckLoader
	 */
	static function retrieveByDriverAlias($value) {
		return TruckLoader::retrieveByColumn('driver_alias', $value);
	}

	/**
	 * Searches the database for a row with a unload_date	 * value that matches the one provided
	 * @return TruckLoader
	 */
	static function retrieveByUnloadDate($value) {
		return TruckLoader::retrieveByColumn('unload_date', $value);
	}

	/**
	 * Searches the database for a row with a location	 * value that matches the one provided
	 * @return TruckLoader
	 */
	static function retrieveByLocation($value) {
		return TruckLoader::retrieveByColumn('location', $value);
	}

	/**
	 * Searches the database for a row with a equipment	 * value that matches the one provided
	 * @return TruckLoader
	 */
	static function retrieveByEquipment($value) {
		return TruckLoader::retrieveByColumn('equipment', $value);
	}

	/**
	 * Searches the database for a row with a tlength	 * value that matches the one provided
	 * @return TruckLoader
	 */
	static function retrieveByTlength($value) {
		return TruckLoader::retrieveByColumn('tlength', $value);
	}

	/**
	 * Searches the database for a row with a ttype	 * value that matches the one provided
	 * @return TruckLoader
	 */
	static function retrieveByTtype($value) {
		return TruckLoader::retrieveByColumn('ttype', $value);
	}

	/**
	 * Searches the database for a row with a home_town	 * value that matches the one provided
	 * @return TruckLoader
	 */
	static function retrieveByHomeTown($value) {
		return TruckLoader::retrieveByColumn('home_town', $value);
	}

	/**
	 * Searches the database for a row with a preferences	 * value that matches the one provided
	 * @return TruckLoader
	 */
	static function retrieveByPreferences($value) {
		return TruckLoader::retrieveByColumn('preferences', $value);
	}

	/**
	 * Searches the database for a row with a truck_no	 * value that matches the one provided
	 * @return TruckLoader
	 */
	static function retrieveByTruckNo($value) {
		return TruckLoader::retrieveByColumn('truck_no', $value);
	}

	/**
	 * Searches the database for a row with a telephone	 * value that matches the one provided
	 * @return TruckLoader
	 */
	static function retrieveByTelephone($value) {
		return TruckLoader::retrieveByColumn('telephone', $value);
	}

	/**
	 * Searches the database for a row with a comments	 * value that matches the one provided
	 * @return TruckLoader
	 */
	static function retrieveByComments($value) {
		return TruckLoader::retrieveByColumn('comments', $value);
	}

	/**
	 * Searches the database for a row with a home_office	 * value that matches the one provided
	 * @return TruckLoader
	 */
	static function retrieveByHomeOffice($value) {
		return TruckLoader::retrieveByColumn('home_office', $value);
	}

	/**
	 * Searches the database for a row with a office_numbers	 * value that matches the one provided
	 * @return TruckLoader
	 */
	static function retrieveByOfficeNumbers($value) {
		return TruckLoader::retrieveByColumn('office_numbers', $value);
	}

	/**
	 * Searches the database for a row with a message_voice_mail	 * value that matches the one provided
	 * @return TruckLoader
	 */
	static function retrieveByMessageVoiceMail($value) {
		return TruckLoader::retrieveByColumn('message_voice_mail', $value);
	}

	/**
	 * Searches the database for a row with a canada	 * value that matches the one provided
	 * @return TruckLoader
	 */
	static function retrieveByCanada($value) {
		return TruckLoader::retrieveByColumn('canada', $value);
	}

	/**
	 * Searches the database for a row with a no_canada	 * value that matches the one provided
	 * @return TruckLoader
	 */
	static function retrieveByNoCanada($value) {
		return TruckLoader::retrieveByColumn('no_canada', $value);
	}

	/**
	 * Searches the database for a row with a twic	 * value that matches the one provided
	 * @return TruckLoader
	 */
	static function retrieveByTwic($value) {
		return TruckLoader::retrieveByColumn('twic', $value);
	}

	/**
	 * Searches the database for a row with a no_twic	 * value that matches the one provided
	 * @return TruckLoader
	 */
	static function retrieveByNoTwic($value) {
		return TruckLoader::retrieveByColumn('no_twic', $value);
	}

	/**
	 * Searches the database for a row with a f4ft_tarps	 * value that matches the one provided
	 * @return TruckLoader
	 */
	static function retrieveByF4ftTarps($value) {
		return TruckLoader::retrieveByColumn('f4ft_tarps', $value);
	}

	/**
	 * Searches the database for a row with a f6ft_tarps	 * value that matches the one provided
	 * @return TruckLoader
	 */
	static function retrieveByF6ftTarps($value) {
		return TruckLoader::retrieveByColumn('f6ft_tarps', $value);
	}

	/**
	 * Searches the database for a row with a f8ft_tarps	 * value that matches the one provided
	 * @return TruckLoader
	 */
	static function retrieveByF8ftTarps($value) {
		return TruckLoader::retrieveByColumn('f8ft_tarps', $value);
	}

	/**
	 * Searches the database for a row with a no_tarps	 * value that matches the one provided
	 * @return TruckLoader
	 */
	static function retrieveByNoTarps($value) {
		return TruckLoader::retrieveByColumn('no_tarps', $value);
	}

	/**
	 * Searches the database for a row with a pipe_stakes	 * value that matches the one provided
	 * @return TruckLoader
	 */
	static function retrieveByPipeStakes($value) {
		return TruckLoader::retrieveByColumn('pipe_stakes', $value);
	}

	/**
	 * Searches the database for a row with a load_status	 * value that matches the one provided
	 * @return TruckLoader
	 */
	static function retrieveByLoadStatus($value) {
		return TruckLoader::retrieveByColumn('load_status', $value);
	}

	/**
	 * Searches the database for a row with a no_pipe_stakes	 * value that matches the one provided
	 * @return TruckLoader
	 */
	static function retrieveByNoPipeStakes($value) {
		return TruckLoader::retrieveByColumn('no_pipe_stakes', $value);
	}

	/**
	 * Searches the database for a row with a driving_limitations	 * value that matches the one provided
	 * @return TruckLoader
	 */
	static function retrieveByDrivingLimitations($value) {
		return TruckLoader::retrieveByColumn('driving_limitations', $value);
	}

	/**
	 * Searches the database for a row with a load_levelers	 * value that matches the one provided
	 * @return TruckLoader
	 */
	static function retrieveByLoadLevelers($value) {
		return TruckLoader::retrieveByColumn('load_levelers', $value);
	}

	/**
	 * Searches the database for a row with a no_load_levelers	 * value that matches the one provided
	 * @return TruckLoader
	 */
	static function retrieveByNoLoadLevelers($value) {
		return TruckLoader::retrieveByColumn('no_load_levelers', $value);
	}

	/**
	 * Searches the database for a row with a load_options	 * value that matches the one provided
	 * @return TruckLoader
	 */
	static function retrieveByLoadOptions($value) {
		return TruckLoader::retrieveByColumn('load_options', $value);
	}

	/**
	 * Searches the database for a row with a loads_completed	 * value that matches the one provided
	 * @return TruckLoader
	 */
	static function retrieveByLoadsCompleted($value) {
		return TruckLoader::retrieveByColumn('loads_completed', $value);
	}

	/**
	 * Searches the database for a row with a upload_comment	 * value that matches the one provided
	 * @return TruckLoader
	 */
	static function retrieveByUploadComment($value) {
		return TruckLoader::retrieveByColumn('upload_comment', $value);
	}

	/**
	 * Searches the database for a row with a email	 * value that matches the one provided
	 * @return TruckLoader
	 */
	static function retrieveByEmail($value) {
		return TruckLoader::retrieveByColumn('email', $value);
	}

	/**
	 * Searches the database for a row with a unload_month	 * value that matches the one provided
	 * @return TruckLoader
	 */
	static function retrieveByUnloadMonth($value) {
		return TruckLoader::retrieveByColumn('unload_month', $value);
	}

	/**
	 * Searches the database for a row with a unload_day	 * value that matches the one provided
	 * @return TruckLoader
	 */
	static function retrieveByUnloadDay($value) {
		return TruckLoader::retrieveByColumn('unload_day', $value);
	}

	/**
	 * Searches the database for a row with a driver_status	 * value that matches the one provided
	 * @return TruckLoader
	 */
	static function retrieveByDriverStatus($value) {
		return TruckLoader::retrieveByColumn('driver_status', $value);
	}

	/**
	 * Searches the database for a row with a origin_city	 * value that matches the one provided
	 * @return TruckLoader
	 */
	static function retrieveByOriginCity($value) {
		return TruckLoader::retrieveByColumn('origin_city', $value);
	}

	/**
	 * Searches the database for a row with a origin_state	 * value that matches the one provided
	 * @return TruckLoader
	 */
	static function retrieveByOriginState($value) {
		return TruckLoader::retrieveByColumn('origin_state', $value);
	}

	/**
	 * Searches the database for a row with a destination_city	 * value that matches the one provided
	 * @return TruckLoader
	 */
	static function retrieveByDestinationCity($value) {
		return TruckLoader::retrieveByColumn('destination_city', $value);
	}

	/**
	 * Searches the database for a row with a destination_state	 * value that matches the one provided
	 * @return TruckLoader
	 */
	static function retrieveByDestinationState($value) {
		return TruckLoader::retrieveByColumn('destination_state', $value);
	}

	/**
	 * Searches the database for a row with a rating	 * value that matches the one provided
	 * @return TruckLoader
	 */
	static function retrieveByRating($value) {
		return TruckLoader::retrieveByColumn('rating', $value);
	}

	static function retrieveByColumn($field, $value) {
		$conn = TruckLoader::getConnection();
		return array_shift(TruckLoader::doSelect(Query::create()->add($field, $value)->setLimit(1)->order('id')));
	}

	/**
	 * Populates and returns an instance of TruckLoader with the
	 * first result of a query.  If the query returns no results,
	 * returns null.
	 * @return TruckLoader
	 */
	static function fetchSingle($query_string, $write_cache = true) {
		return array_shift(TruckLoader::fetch($query_string, $write_cache));
	}

	/**
	 * Populates and returns an array of TruckLoader objects with the
	 * results of a query.  If the query returns no results,
	 * returns an empty Array.
	 * @return TruckLoader[]
	 */
	static function fetch($query_string, $write_cache = false) {
		$conn = TruckLoader::getConnection();
		$result = $conn->query($query_string);
		return TruckLoader::fromResult($result, 'TruckLoader', $write_cache);
	}

	/**
	 * Returns an array of TruckLoader objects from
	 * a PDOStatement(query result).
	 *
	 * @see BaseModel::fromResult
	 */
	static function fromResult(PDOStatement $result, $class = 'TruckLoader', $write_cache = false) {
		return baseModel::fromResult($result, $class, $write_cache);
	}

	/**
	 * Casts values of int fields to (int)
	 * @return TruckLoader
	 */
	function castInts() {
		$this->id = (null === $this->id) ? null : (int) $this->id;
		$this->userid = (null === $this->userid) ? null : (int) $this->userid;
		$this->canada = (null === $this->canada) ? null : (int) $this->canada;
		$this->no_canada = (null === $this->no_canada) ? null : (int) $this->no_canada;
		$this->twic = (null === $this->twic) ? null : (int) $this->twic;
		$this->no_twic = (null === $this->no_twic) ? null : (int) $this->no_twic;
		$this->f4ft_tarps = (null === $this->f4ft_tarps) ? null : (int) $this->f4ft_tarps;
		$this->f6ft_tarps = (null === $this->f6ft_tarps) ? null : (int) $this->f6ft_tarps;
		$this->f8ft_tarps = (null === $this->f8ft_tarps) ? null : (int) $this->f8ft_tarps;
		$this->no_tarps = (null === $this->no_tarps) ? null : (int) $this->no_tarps;
		$this->pipe_stakes = (null === $this->pipe_stakes) ? null : (int) $this->pipe_stakes;
		$this->load_status = (null === $this->load_status) ? null : (int) $this->load_status;
		$this->no_pipe_stakes = (null === $this->no_pipe_stakes) ? null : (int) $this->no_pipe_stakes;
		$this->load_levelers = (null === $this->load_levelers) ? null : (int) $this->load_levelers;
		$this->no_load_levelers = (null === $this->no_load_levelers) ? null : (int) $this->no_load_levelers;
		$this->loads_completed = (null === $this->loads_completed) ? null : (int) $this->loads_completed;
		$this->unload_month = (null === $this->unload_month) ? null : (int) $this->unload_month;
		$this->unload_day = (null === $this->unload_day) ? null : (int) $this->unload_day;
		$this->driver_status = (null === $this->driver_status) ? null : (int) $this->driver_status;
		return $this;
	}

	/**
	 * Add (or replace) to the instance pool.
	 *
	 * @param TruckLoader $object
	 * @return void
	 */
	static function insertIntoPool(TruckLoader $object) {
		if (TruckLoader::$_instancePoolCount > TruckLoader::MAX_INSTANCE_POOL_SIZE) {
			return;
		}

		TruckLoader::$_instancePool[implode('-', $object->getPrimaryKeyValues())] = clone $object;
		++TruckLoader::$_instancePoolCount;
	}

	/**
	 * Return the cached instance from the pool.
	 *
	 * @param mixed $pk Primary Key
	 * @return TruckLoader
	 */
	static function retrieveFromPool($pk) {
		if (null === $pk) {
			return null;
		}
		if (array_key_exists($pk, TruckLoader::$_instancePool)) {
			return clone TruckLoader::$_instancePool[$pk];
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

		if (array_key_exists($pk, TruckLoader::$_instancePool)) {
			unset(TruckLoader::$_instancePool[$pk]);
			--TruckLoader::$_instancePoolCount;
		}
	}

	/**
	 * Empty the instance pool.
	 *
	 * @return void
	 */
	static function flushPool() {
		TruckLoader::$_instancePool = array();
	}

	/**
	 * Returns an array of all TruckLoader objects in the database.
	 * $extra SQL can be appended to the query to LIMIT, SORT, and/or GROUP results.
	 * If there are no results, returns an empty Array.
	 * @param $extra string
	 * @return TruckLoader[]
	 */
	static function getAll($extra = null, $write_cache = false) {
		$conn = TruckLoader::getConnection();
		$table_quoted = $conn->quoteIdentifier(TruckLoader::getTableName());
		return TruckLoader::fetch("SELECT * FROM $table_quoted $extra ", $write_cache);
	}

	/**
	 * @return int
	 */
	static function doCount(Query $q = null) {
		$q = $q ? clone $q : new Query;
		$conn = TruckLoader::getConnection();
		if (!$q->getTable() || TruckLoader::getTableName() != $q->getTable()) {
			$q->setTable(TruckLoader::getTableName());
		}
		return $q->doCount($conn);
	}

	/**
	 * @param Query $q
	 * @param bool $dump_cache
	 * @return int
	 */
	static function doDelete(Query $q, $dump_cache = true) {
		$conn = TruckLoader::getConnection();
		$q = clone $q;
		if (!$q->getTable() || TruckLoader::getTableName() != $q->getTable()) {
			$q->setTable(TruckLoader::getTableName());
		}
		$result = $q->doDelete($conn);

		if ($dump_cache) {
			TruckLoader::$_instancePool = array();
		}

		return $result;
	}

	/**
	 * @param Query $q The Query object that creates the SELECT query string
	 * @param bool $write_cache Whether or not to store results in instance pool
	 * @param array $additional_classes Array of additional classes for fromResult to instantiate as properties
	 * @return TruckLoader[]
	 */
	static function doSelect(Query $q = null, $write_cache = false, $additional_classes = null) {
		if (is_array($additional_classes)) {
			array_unshift($additional_classes, 'TruckLoader');
			$class = $additional_classes;
		} else {
			$class = 'TruckLoader';
		}

		return TruckLoader::fromResult(self::doSelectRS($q), $class, $write_cache);
	}

	/**
	 * Executes a select query and returns the PDO result
	 * @return PDOStatement
	 */
	static function doSelectRS(Query $q = null) {
		$q = $q ? clone $q : new Query;
		$conn = TruckLoader::getConnection();
		if (!$q->getTable() || TruckLoader::getTableName() != $q->getTable()) {
			$q->setTable(TruckLoader::getTableName());
		}

		return $q->doSelect($conn);
	}

	/**
	 * @return TruckLoader[]
	 */
	static function doSelectJoinAll(Query $q = null, $write_cache = false, $join_type = Query::LEFT_JOIN) {
		$q = $q ? clone $q : new Query;
		$columns = $q->getColumns();
		$classes = array();
		$alias = $q->getAlias();
		$this_table = $alias ? $alias : TruckLoader::getTableName();
		if (!$columns) {
			$columns[] = $this_table . '.*';
		}

		$q->setColumns($columns);
		return TruckLoader::doSelect($q, $write_cache, $classes);
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
