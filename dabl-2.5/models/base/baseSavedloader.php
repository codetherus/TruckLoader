<?php
/**
 *		Created by Dan Blaisdell's DABL
 *		Do not alter base files, as they will be overwritten.
 *		To alter the objects, alter the extended classes in
 *		the 'models' folder.
 *
 */
abstract class baseSavedloader extends ApplicationModel {

	/**
	 * Name of the table
	 * @var string
	 */
	protected static $_tableName = 'savedloader';

	/**
	 * Cache of objects retrieved from the database
	 * @var Savedloader[]
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
		'no_pipe_stakes',
		'driving_limitations',
		'load_levelers',
		'no_load_levelers',
		'load_options',
		'loads_completed',
		'upload_comment',
	);

	/**
	 * array of all column types
	 * @var string[]
	 */
	protected static $_columnTypes = array(
		'id' => BaseModel::COLUMN_TYPE_BIGINT,
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
		'no_pipe_stakes' => BaseModel::COLUMN_TYPE_TINYINT,
		'driving_limitations' => BaseModel::COLUMN_TYPE_LONGVARCHAR,
		'load_levelers' => BaseModel::COLUMN_TYPE_TINYINT,
		'no_load_levelers' => BaseModel::COLUMN_TYPE_TINYINT,
		'load_options' => BaseModel::COLUMN_TYPE_LONGVARCHAR,
		'loads_completed' => BaseModel::COLUMN_TYPE_INTEGER,
		'upload_comment' => BaseModel::COLUMN_TYPE_LONGVARCHAR,
	);

	/**
	 * `id` BIGINT NOT NULL DEFAULT ''
	 * @var string
	 */
	protected $id;

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
	 * Gets the value of the id field
	 */
	function getId() {
		return $this->id;
	}

	/**
	 * Sets the value of the id field
	 * @return Savedloader
	 */
	function setId($value) {
		return $this->setColumnValue('id', $value, BaseModel::COLUMN_TYPE_BIGINT);
	}

	/**
	 * Gets the value of the driver field
	 */
	function getDriver() {
		return $this->driver;
	}

	/**
	 * Sets the value of the driver field
	 * @return Savedloader
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
	 * @return Savedloader
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
	 * @return Savedloader
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
	 * @return Savedloader
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
	 * @return Savedloader
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
	 * @return Savedloader
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
	 * @return Savedloader
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
	 * @return Savedloader
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
	 * @return Savedloader
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
	 * @return Savedloader
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
	 * @return Savedloader
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
	 * @return Savedloader
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
	 * @return Savedloader
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
	 * @return Savedloader
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
	 * @return Savedloader
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
	 * @return Savedloader
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
	 * @return Savedloader
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
	 * @return Savedloader
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
	 * @return Savedloader
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
	 * @return Savedloader
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
	 * @return Savedloader
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
	 * @return Savedloader
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
	 * @return Savedloader
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
	 * @return Savedloader
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
	 * @return Savedloader
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
	 * @return Savedloader
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
	 * @return Savedloader
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
	 * @return Savedloader
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
	 * @return Savedloader
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
	 * @return Savedloader
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
	 * @return Savedloader
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
	 * @return Savedloader
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
	 * @return Savedloader
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
	 * @return Savedloader
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
	 * @return Savedloader
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
	 * @return Savedloader
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
	 * @return Savedloader
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
	 * @return Savedloader
	 */
	function setPipeStakes($value) {
		return $this->setPipe_stakes($value);
	}

	/**
	 * Gets the value of the no_pipe_stakes field
	 */
	function getNo_pipe_stakes() {
		return $this->no_pipe_stakes;
	}

	/**
	 * Sets the value of the no_pipe_stakes field
	 * @return Savedloader
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
	 * @return Savedloader
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
	 * @return Savedloader
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
	 * @return Savedloader
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
	 * @return Savedloader
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
	 * @return Savedloader
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
	 * @return Savedloader
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
	 * @return Savedloader
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
	 * @return Savedloader
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
	 * @return Savedloader
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
	 * @return Savedloader
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
	 * @return Savedloader
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
	 * @return Savedloader
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
	 * @return Savedloader
	 */
	function setUploadComment($value) {
		return $this->setUpload_comment($value);
	}

	/**
	 * @return DABLPDO
	 */
	static function getConnection() {
		return DBManager::getConnection('default_mysqll');
	}

	/**
	 * @return Savedloader
	 */
	static function create() {
		return new Savedloader();
	}

	/**
	 * Returns String representation of table name
	 * @return string
	 */
	static function getTableName() {
		return Savedloader::$_tableName;
	}

	/**
	 * Access to array of column names
	 * @return array
	 */
	static function getColumnNames() {
		return Savedloader::$_columnNames;
	}

	/**
	 * Access to array of column types, indexed by column name
	 * @return array
	 */
	static function getColumnTypes() {
		return Savedloader::$_columnTypes;
	}

	/**
	 * Get the type of a column
	 * @return array
	 */
	static function getColumnType($column_name) {
		return Savedloader::$_columnTypes[$column_name];
	}

	/**
	 * @return bool
	 */
	static function hasColumn($column_name) {
		static $lower_case_columns = null;
		if (null === $lower_case_columns) {
			$lower_case_columns = array_map('strtolower', Savedloader::$_columnNames);
		}
		return in_array(strtolower($column_name), $lower_case_columns);
	}

	/**
	 * Access to array of primary keys
	 * @return array
	 */
	static function getPrimaryKeys() {
		return Savedloader::$_primaryKeys;
	}

	/**
	 * Access to name of primary key
	 * @return array
	 */
	static function getPrimaryKey() {
		return Savedloader::$_primaryKey;
	}

	/**
	 * Returns true if the primary key column for this table is auto-increment
	 * @return bool
	 */
	static function isAutoIncrement() {
		return Savedloader::$_isAutoIncrement;
	}

	/**
	 * Searches the database for a row with the ID(primary key) that matches
	 * the one input.
	 * @return Savedloader
	 */
	static function retrieveByPK($the_pk) {
		return Savedloader::retrieveByPKs($the_pk);
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return Savedloader
	 */
	static function retrieveByPKs($id) {
		if (null === $id) {
			return null;
		}
		$pool_instance = Savedloader::retrieveFromPool($id);
		if (null !== $pool_instance) {
			return $pool_instance;
		}
		$conn = Savedloader::getConnection();
		$q = new Query;
		$q->add('id', $id);
		return array_shift(Savedloader::doSelect($q, true));
	}

	/**
	 * Searches the database for a row with a id	 * value that matches the one provided
	 * @return Savedloader
	 */
	static function retrieveById($value) {
		return Savedloader::retrieveByPK($value);
	}

	/**
	 * Searches the database for a row with a driver	 * value that matches the one provided
	 * @return Savedloader
	 */
	static function retrieveByDriver($value) {
		return Savedloader::retrieveByColumn('driver', $value);
	}

	/**
	 * Searches the database for a row with a driver_alias	 * value that matches the one provided
	 * @return Savedloader
	 */
	static function retrieveByDriverAlias($value) {
		return Savedloader::retrieveByColumn('driver_alias', $value);
	}

	/**
	 * Searches the database for a row with a unload_date	 * value that matches the one provided
	 * @return Savedloader
	 */
	static function retrieveByUnloadDate($value) {
		return Savedloader::retrieveByColumn('unload_date', $value);
	}

	/**
	 * Searches the database for a row with a location	 * value that matches the one provided
	 * @return Savedloader
	 */
	static function retrieveByLocation($value) {
		return Savedloader::retrieveByColumn('location', $value);
	}

	/**
	 * Searches the database for a row with a equipment	 * value that matches the one provided
	 * @return Savedloader
	 */
	static function retrieveByEquipment($value) {
		return Savedloader::retrieveByColumn('equipment', $value);
	}

	/**
	 * Searches the database for a row with a tlength	 * value that matches the one provided
	 * @return Savedloader
	 */
	static function retrieveByTlength($value) {
		return Savedloader::retrieveByColumn('tlength', $value);
	}

	/**
	 * Searches the database for a row with a ttype	 * value that matches the one provided
	 * @return Savedloader
	 */
	static function retrieveByTtype($value) {
		return Savedloader::retrieveByColumn('ttype', $value);
	}

	/**
	 * Searches the database for a row with a home_town	 * value that matches the one provided
	 * @return Savedloader
	 */
	static function retrieveByHomeTown($value) {
		return Savedloader::retrieveByColumn('home_town', $value);
	}

	/**
	 * Searches the database for a row with a preferences	 * value that matches the one provided
	 * @return Savedloader
	 */
	static function retrieveByPreferences($value) {
		return Savedloader::retrieveByColumn('preferences', $value);
	}

	/**
	 * Searches the database for a row with a truck_no	 * value that matches the one provided
	 * @return Savedloader
	 */
	static function retrieveByTruckNo($value) {
		return Savedloader::retrieveByColumn('truck_no', $value);
	}

	/**
	 * Searches the database for a row with a telephone	 * value that matches the one provided
	 * @return Savedloader
	 */
	static function retrieveByTelephone($value) {
		return Savedloader::retrieveByColumn('telephone', $value);
	}

	/**
	 * Searches the database for a row with a comments	 * value that matches the one provided
	 * @return Savedloader
	 */
	static function retrieveByComments($value) {
		return Savedloader::retrieveByColumn('comments', $value);
	}

	/**
	 * Searches the database for a row with a home_office	 * value that matches the one provided
	 * @return Savedloader
	 */
	static function retrieveByHomeOffice($value) {
		return Savedloader::retrieveByColumn('home_office', $value);
	}

	/**
	 * Searches the database for a row with a office_numbers	 * value that matches the one provided
	 * @return Savedloader
	 */
	static function retrieveByOfficeNumbers($value) {
		return Savedloader::retrieveByColumn('office_numbers', $value);
	}

	/**
	 * Searches the database for a row with a message_voice_mail	 * value that matches the one provided
	 * @return Savedloader
	 */
	static function retrieveByMessageVoiceMail($value) {
		return Savedloader::retrieveByColumn('message_voice_mail', $value);
	}

	/**
	 * Searches the database for a row with a canada	 * value that matches the one provided
	 * @return Savedloader
	 */
	static function retrieveByCanada($value) {
		return Savedloader::retrieveByColumn('canada', $value);
	}

	/**
	 * Searches the database for a row with a no_canada	 * value that matches the one provided
	 * @return Savedloader
	 */
	static function retrieveByNoCanada($value) {
		return Savedloader::retrieveByColumn('no_canada', $value);
	}

	/**
	 * Searches the database for a row with a twic	 * value that matches the one provided
	 * @return Savedloader
	 */
	static function retrieveByTwic($value) {
		return Savedloader::retrieveByColumn('twic', $value);
	}

	/**
	 * Searches the database for a row with a no_twic	 * value that matches the one provided
	 * @return Savedloader
	 */
	static function retrieveByNoTwic($value) {
		return Savedloader::retrieveByColumn('no_twic', $value);
	}

	/**
	 * Searches the database for a row with a f4ft_tarps	 * value that matches the one provided
	 * @return Savedloader
	 */
	static function retrieveByF4ftTarps($value) {
		return Savedloader::retrieveByColumn('f4ft_tarps', $value);
	}

	/**
	 * Searches the database for a row with a f6ft_tarps	 * value that matches the one provided
	 * @return Savedloader
	 */
	static function retrieveByF6ftTarps($value) {
		return Savedloader::retrieveByColumn('f6ft_tarps', $value);
	}

	/**
	 * Searches the database for a row with a f8ft_tarps	 * value that matches the one provided
	 * @return Savedloader
	 */
	static function retrieveByF8ftTarps($value) {
		return Savedloader::retrieveByColumn('f8ft_tarps', $value);
	}

	/**
	 * Searches the database for a row with a no_tarps	 * value that matches the one provided
	 * @return Savedloader
	 */
	static function retrieveByNoTarps($value) {
		return Savedloader::retrieveByColumn('no_tarps', $value);
	}

	/**
	 * Searches the database for a row with a pipe_stakes	 * value that matches the one provided
	 * @return Savedloader
	 */
	static function retrieveByPipeStakes($value) {
		return Savedloader::retrieveByColumn('pipe_stakes', $value);
	}

	/**
	 * Searches the database for a row with a no_pipe_stakes	 * value that matches the one provided
	 * @return Savedloader
	 */
	static function retrieveByNoPipeStakes($value) {
		return Savedloader::retrieveByColumn('no_pipe_stakes', $value);
	}

	/**
	 * Searches the database for a row with a driving_limitations	 * value that matches the one provided
	 * @return Savedloader
	 */
	static function retrieveByDrivingLimitations($value) {
		return Savedloader::retrieveByColumn('driving_limitations', $value);
	}

	/**
	 * Searches the database for a row with a load_levelers	 * value that matches the one provided
	 * @return Savedloader
	 */
	static function retrieveByLoadLevelers($value) {
		return Savedloader::retrieveByColumn('load_levelers', $value);
	}

	/**
	 * Searches the database for a row with a no_load_levelers	 * value that matches the one provided
	 * @return Savedloader
	 */
	static function retrieveByNoLoadLevelers($value) {
		return Savedloader::retrieveByColumn('no_load_levelers', $value);
	}

	/**
	 * Searches the database for a row with a load_options	 * value that matches the one provided
	 * @return Savedloader
	 */
	static function retrieveByLoadOptions($value) {
		return Savedloader::retrieveByColumn('load_options', $value);
	}

	/**
	 * Searches the database for a row with a loads_completed	 * value that matches the one provided
	 * @return Savedloader
	 */
	static function retrieveByLoadsCompleted($value) {
		return Savedloader::retrieveByColumn('loads_completed', $value);
	}

	/**
	 * Searches the database for a row with a upload_comment	 * value that matches the one provided
	 * @return Savedloader
	 */
	static function retrieveByUploadComment($value) {
		return Savedloader::retrieveByColumn('upload_comment', $value);
	}

	static function retrieveByColumn($field, $value) {
		$conn = Savedloader::getConnection();
		return array_shift(Savedloader::doSelect(Query::create()->add($field, $value)->setLimit(1)->order('id')));
	}

	/**
	 * Populates and returns an instance of Savedloader with the
	 * first result of a query.  If the query returns no results,
	 * returns null.
	 * @return Savedloader
	 */
	static function fetchSingle($query_string, $write_cache = true) {
		return array_shift(Savedloader::fetch($query_string, $write_cache));
	}

	/**
	 * Populates and returns an array of Savedloader objects with the
	 * results of a query.  If the query returns no results,
	 * returns an empty Array.
	 * @return Savedloader[]
	 */
	static function fetch($query_string, $write_cache = false) {
		$conn = Savedloader::getConnection();
		$result = $conn->query($query_string);
		return Savedloader::fromResult($result, 'Savedloader', $write_cache);
	}

	/**
	 * Returns an array of Savedloader objects from
	 * a PDOStatement(query result).
	 *
	 * @see BaseModel::fromResult
	 */
	static function fromResult(PDOStatement $result, $class = 'Savedloader', $write_cache = false) {
		return baseModel::fromResult($result, $class, $write_cache);
	}

	/**
	 * Casts values of int fields to (int)
	 * @return Savedloader
	 */
	function castInts() {
		$this->id = (null === $this->id) ? null : (int) $this->id;
		$this->canada = (null === $this->canada) ? null : (int) $this->canada;
		$this->no_canada = (null === $this->no_canada) ? null : (int) $this->no_canada;
		$this->twic = (null === $this->twic) ? null : (int) $this->twic;
		$this->no_twic = (null === $this->no_twic) ? null : (int) $this->no_twic;
		$this->f4ft_tarps = (null === $this->f4ft_tarps) ? null : (int) $this->f4ft_tarps;
		$this->f6ft_tarps = (null === $this->f6ft_tarps) ? null : (int) $this->f6ft_tarps;
		$this->f8ft_tarps = (null === $this->f8ft_tarps) ? null : (int) $this->f8ft_tarps;
		$this->no_tarps = (null === $this->no_tarps) ? null : (int) $this->no_tarps;
		$this->pipe_stakes = (null === $this->pipe_stakes) ? null : (int) $this->pipe_stakes;
		$this->no_pipe_stakes = (null === $this->no_pipe_stakes) ? null : (int) $this->no_pipe_stakes;
		$this->load_levelers = (null === $this->load_levelers) ? null : (int) $this->load_levelers;
		$this->no_load_levelers = (null === $this->no_load_levelers) ? null : (int) $this->no_load_levelers;
		$this->loads_completed = (null === $this->loads_completed) ? null : (int) $this->loads_completed;
		return $this;
	}

	/**
	 * Add (or replace) to the instance pool.
	 *
	 * @param Savedloader $object
	 * @return void
	 */
	static function insertIntoPool(Savedloader $object) {
		if (Savedloader::$_instancePoolCount > Savedloader::MAX_INSTANCE_POOL_SIZE) {
			return;
		}

		Savedloader::$_instancePool[implode('-', $object->getPrimaryKeyValues())] = clone $object;
		++Savedloader::$_instancePoolCount;
	}

	/**
	 * Return the cached instance from the pool.
	 *
	 * @param mixed $pk Primary Key
	 * @return Savedloader
	 */
	static function retrieveFromPool($pk) {
		if (null === $pk) {
			return null;
		}
		if (array_key_exists($pk, Savedloader::$_instancePool)) {
			return clone Savedloader::$_instancePool[$pk];
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

		if (array_key_exists($pk, Savedloader::$_instancePool)) {
			unset(Savedloader::$_instancePool[$pk]);
			--Savedloader::$_instancePoolCount;
		}
	}

	/**
	 * Empty the instance pool.
	 *
	 * @return void
	 */
	static function flushPool() {
		Savedloader::$_instancePool = array();
	}

	/**
	 * Returns an array of all Savedloader objects in the database.
	 * $extra SQL can be appended to the query to LIMIT, SORT, and/or GROUP results.
	 * If there are no results, returns an empty Array.
	 * @param $extra string
	 * @return Savedloader[]
	 */
	static function getAll($extra = null, $write_cache = false) {
		$conn = Savedloader::getConnection();
		$table_quoted = $conn->quoteIdentifier(Savedloader::getTableName());
		return Savedloader::fetch("SELECT * FROM $table_quoted $extra ", $write_cache);
	}

	/**
	 * @return int
	 */
	static function doCount(Query $q = null) {
		$q = $q ? clone $q : new Query;
		$conn = Savedloader::getConnection();
		if (!$q->getTable() || Savedloader::getTableName() != $q->getTable()) {
			$q->setTable(Savedloader::getTableName());
		}
		return $q->doCount($conn);
	}

	/**
	 * @param Query $q
	 * @param bool $dump_cache
	 * @return int
	 */
	static function doDelete(Query $q, $dump_cache = true) {
		$conn = Savedloader::getConnection();
		$q = clone $q;
		if (!$q->getTable() || Savedloader::getTableName() != $q->getTable()) {
			$q->setTable(Savedloader::getTableName());
		}
		$result = $q->doDelete($conn);

		if ($dump_cache) {
			Savedloader::$_instancePool = array();
		}

		return $result;
	}

	/**
	 * @param Query $q The Query object that creates the SELECT query string
	 * @param bool $write_cache Whether or not to store results in instance pool
	 * @param array $additional_classes Array of additional classes for fromResult to instantiate as properties
	 * @return Savedloader[]
	 */
	static function doSelect(Query $q = null, $write_cache = false, $additional_classes = null) {
		if (is_array($additional_classes)) {
			array_unshift($additional_classes, 'Savedloader');
			$class = $additional_classes;
		} else {
			$class = 'Savedloader';
		}

		return Savedloader::fromResult(self::doSelectRS($q), $class, $write_cache);
	}

	/**
	 * Executes a select query and returns the PDO result
	 * @return PDOStatement
	 */
	static function doSelectRS(Query $q = null) {
		$q = $q ? clone $q : new Query;
		$conn = Savedloader::getConnection();
		if (!$q->getTable() || Savedloader::getTableName() != $q->getTable()) {
			$q->setTable(Savedloader::getTableName());
		}

		return $q->doSelect($conn);
	}

	/**
	 * @return Savedloader[]
	 */
	static function doSelectJoinAll(Query $q = null, $write_cache = false, $join_type = Query::LEFT_JOIN) {
		$q = $q ? clone $q : new Query;
		$columns = $q->getColumns();
		$classes = array();
		$alias = $q->getAlias();
		$this_table = $alias ? $alias : Savedloader::getTableName();
		if (!$columns) {
			$columns[] = $this_table . '.*';
		}

		$q->setColumns($columns);
		return Savedloader::doSelect($q, $write_cache, $classes);
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
