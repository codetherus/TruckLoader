<?php
/**
 *		Created by Dan Blaisdell's DABL
 *		Do not alter base files, as they will be overwritten.
 *		To alter the objects, alter the extended classes in
 *		the 'models' folder.
 *
 */
abstract class baseUploadedLoads extends ApplicationModel {

	/**
	 * Name of the table
	 * @var string
	 */
	protected static $_tableName = 'uploaded_loads';

	/**
	 * Cache of objects retrieved from the database
	 * @var UploadedLoads[]
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
		'offer_number',
		'ocity',
		'ost',
		'ozip',
		'dcity',
		'dst',
		'dzip',
		'pickup_start',
		'pickup_end',
		'delivery_start',
		'delivery_end',
		'state',
		'weight',
		'volume',
		'hazmat',
		'over_dim',
		'len',
		'wid',
		'hgt',
		'eqpt',
		'origin',
		'destination',
		'truckstop_id',
	);

	/**
	 * array of all column types
	 * @var string[]
	 */
	protected static $_columnTypes = array(
		'id' => BaseModel::COLUMN_TYPE_BIGINT,
		'offer_number' => BaseModel::COLUMN_TYPE_VARCHAR,
		'ocity' => BaseModel::COLUMN_TYPE_VARCHAR,
		'ost' => BaseModel::COLUMN_TYPE_VARCHAR,
		'ozip' => BaseModel::COLUMN_TYPE_VARCHAR,
		'dcity' => BaseModel::COLUMN_TYPE_VARCHAR,
		'dst' => BaseModel::COLUMN_TYPE_VARCHAR,
		'dzip' => BaseModel::COLUMN_TYPE_VARCHAR,
		'pickup_start' => BaseModel::COLUMN_TYPE_DATE,
		'pickup_end' => BaseModel::COLUMN_TYPE_DATE,
		'delivery_start' => BaseModel::COLUMN_TYPE_DATE,
		'delivery_end' => BaseModel::COLUMN_TYPE_DATE,
		'state' => BaseModel::COLUMN_TYPE_VARCHAR,
		'weight' => BaseModel::COLUMN_TYPE_INTEGER,
		'volume' => BaseModel::COLUMN_TYPE_INTEGER,
		'hazmat' => BaseModel::COLUMN_TYPE_VARCHAR,
		'over_dim' => BaseModel::COLUMN_TYPE_VARCHAR,
		'len' => BaseModel::COLUMN_TYPE_INTEGER,
		'wid' => BaseModel::COLUMN_TYPE_INTEGER,
		'hgt' => BaseModel::COLUMN_TYPE_INTEGER,
		'eqpt' => BaseModel::COLUMN_TYPE_VARCHAR,
		'origin' => BaseModel::COLUMN_TYPE_VARCHAR,
		'destination' => BaseModel::COLUMN_TYPE_VARCHAR,
		'truckstop_id' => BaseModel::COLUMN_TYPE_BIGINT,
	);

	/**
	 * `id` BIGINT NOT NULL DEFAULT ''
	 * @var string
	 */
	protected $id;

	/**
	 * `offer_number` VARCHAR NOT NULL
	 * @var string
	 */
	protected $offer_number;

	/**
	 * `ocity` VARCHAR NOT NULL
	 * @var string
	 */
	protected $ocity;

	/**
	 * `ost` VARCHAR NOT NULL
	 * @var string
	 */
	protected $ost;

	/**
	 * `ozip` VARCHAR NOT NULL
	 * @var string
	 */
	protected $ozip;

	/**
	 * `dcity` VARCHAR NOT NULL
	 * @var string
	 */
	protected $dcity;

	/**
	 * `dst` VARCHAR NOT NULL
	 * @var string
	 */
	protected $dst;

	/**
	 * `dzip` VARCHAR NOT NULL
	 * @var string
	 */
	protected $dzip;

	/**
	 * `pickup_start` DATE NOT NULL
	 * @var string
	 */
	protected $pickup_start;

	/**
	 * `pickup_end` DATE NOT NULL
	 * @var string
	 */
	protected $pickup_end;

	/**
	 * `delivery_start` DATE NOT NULL
	 * @var string
	 */
	protected $delivery_start;

	/**
	 * `delivery_end` DATE NOT NULL
	 * @var string
	 */
	protected $delivery_end;

	/**
	 * `state` VARCHAR NOT NULL
	 * @var string
	 */
	protected $state;

	/**
	 * `weight` INTEGER NOT NULL DEFAULT ''
	 * @var int
	 */
	protected $weight;

	/**
	 * `volume` INTEGER NOT NULL DEFAULT ''
	 * @var int
	 */
	protected $volume;

	/**
	 * `hazmat` VARCHAR NOT NULL
	 * @var string
	 */
	protected $hazmat;

	/**
	 * `over_dim` VARCHAR NOT NULL
	 * @var string
	 */
	protected $over_dim;

	/**
	 * `len` INTEGER NOT NULL DEFAULT ''
	 * @var int
	 */
	protected $len;

	/**
	 * `wid` INTEGER NOT NULL DEFAULT ''
	 * @var int
	 */
	protected $wid;

	/**
	 * `hgt` INTEGER NOT NULL DEFAULT ''
	 * @var int
	 */
	protected $hgt;

	/**
	 * `eqpt` VARCHAR NOT NULL
	 * @var string
	 */
	protected $eqpt;

	/**
	 * `origin` VARCHAR NOT NULL
	 * @var string
	 */
	protected $origin;

	/**
	 * `destination` VARCHAR NOT NULL
	 * @var string
	 */
	protected $destination;

	/**
	 * `truckstop_id` BIGINT NOT NULL DEFAULT ''
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
	 * @return UploadedLoads
	 */
	function setId($value) {
		return $this->setColumnValue('id', $value, BaseModel::COLUMN_TYPE_BIGINT);
	}

	/**
	 * Gets the value of the offer_number field
	 */
	function getOffer_number() {
		return $this->offer_number;
	}

	/**
	 * Sets the value of the offer_number field
	 * @return UploadedLoads
	 */
	function setOffer_number($value) {
		return $this->setColumnValue('offer_number', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the offer_number field
	 */
	function getOfferNumber() {
		return $this->getOffer_number();
	}

	/**
	 * Sets the value of the offer_number field
	 * @return UploadedLoads
	 */
	function setOfferNumber($value) {
		return $this->setOffer_number($value);
	}

	/**
	 * Gets the value of the ocity field
	 */
	function getOcity() {
		return $this->ocity;
	}

	/**
	 * Sets the value of the ocity field
	 * @return UploadedLoads
	 */
	function setOcity($value) {
		return $this->setColumnValue('ocity', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the ost field
	 */
	function getOst() {
		return $this->ost;
	}

	/**
	 * Sets the value of the ost field
	 * @return UploadedLoads
	 */
	function setOst($value) {
		return $this->setColumnValue('ost', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the ozip field
	 */
	function getOzip() {
		return $this->ozip;
	}

	/**
	 * Sets the value of the ozip field
	 * @return UploadedLoads
	 */
	function setOzip($value) {
		return $this->setColumnValue('ozip', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the dcity field
	 */
	function getDcity() {
		return $this->dcity;
	}

	/**
	 * Sets the value of the dcity field
	 * @return UploadedLoads
	 */
	function setDcity($value) {
		return $this->setColumnValue('dcity', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the dst field
	 */
	function getDst() {
		return $this->dst;
	}

	/**
	 * Sets the value of the dst field
	 * @return UploadedLoads
	 */
	function setDst($value) {
		return $this->setColumnValue('dst', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the dzip field
	 */
	function getDzip() {
		return $this->dzip;
	}

	/**
	 * Sets the value of the dzip field
	 * @return UploadedLoads
	 */
	function setDzip($value) {
		return $this->setColumnValue('dzip', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the pickup_start field
	 */
	function getPickup_start($format = null) {
		if (null === $this->pickup_start || null === $format) {
			return $this->pickup_start;
		}
		if (0 === strpos($this->pickup_start, '0000-00-00')) {
			return null;
		}
		return date($format, strtotime($this->pickup_start));
	}

	/**
	 * Sets the value of the pickup_start field
	 * @return UploadedLoads
	 */
	function setPickup_start($value) {
		return $this->setColumnValue('pickup_start', $value, BaseModel::COLUMN_TYPE_DATE);
	}

	/**
	 * Gets the value of the pickup_start field
	 */
	function getPickupStart($format = null) {
		return $this->getPickup_start($format);
	}

	/**
	 * Sets the value of the pickup_start field
	 * @return UploadedLoads
	 */
	function setPickupStart($value) {
		return $this->setPickup_start($value);
	}

	/**
	 * Gets the value of the pickup_end field
	 */
	function getPickup_end($format = null) {
		if (null === $this->pickup_end || null === $format) {
			return $this->pickup_end;
		}
		if (0 === strpos($this->pickup_end, '0000-00-00')) {
			return null;
		}
		return date($format, strtotime($this->pickup_end));
	}

	/**
	 * Sets the value of the pickup_end field
	 * @return UploadedLoads
	 */
	function setPickup_end($value) {
		return $this->setColumnValue('pickup_end', $value, BaseModel::COLUMN_TYPE_DATE);
	}

	/**
	 * Gets the value of the pickup_end field
	 */
	function getPickupEnd($format = null) {
		return $this->getPickup_end($format);
	}

	/**
	 * Sets the value of the pickup_end field
	 * @return UploadedLoads
	 */
	function setPickupEnd($value) {
		return $this->setPickup_end($value);
	}

	/**
	 * Gets the value of the delivery_start field
	 */
	function getDelivery_start($format = null) {
		if (null === $this->delivery_start || null === $format) {
			return $this->delivery_start;
		}
		if (0 === strpos($this->delivery_start, '0000-00-00')) {
			return null;
		}
		return date($format, strtotime($this->delivery_start));
	}

	/**
	 * Sets the value of the delivery_start field
	 * @return UploadedLoads
	 */
	function setDelivery_start($value) {
		return $this->setColumnValue('delivery_start', $value, BaseModel::COLUMN_TYPE_DATE);
	}

	/**
	 * Gets the value of the delivery_start field
	 */
	function getDeliveryStart($format = null) {
		return $this->getDelivery_start($format);
	}

	/**
	 * Sets the value of the delivery_start field
	 * @return UploadedLoads
	 */
	function setDeliveryStart($value) {
		return $this->setDelivery_start($value);
	}

	/**
	 * Gets the value of the delivery_end field
	 */
	function getDelivery_end($format = null) {
		if (null === $this->delivery_end || null === $format) {
			return $this->delivery_end;
		}
		if (0 === strpos($this->delivery_end, '0000-00-00')) {
			return null;
		}
		return date($format, strtotime($this->delivery_end));
	}

	/**
	 * Sets the value of the delivery_end field
	 * @return UploadedLoads
	 */
	function setDelivery_end($value) {
		return $this->setColumnValue('delivery_end', $value, BaseModel::COLUMN_TYPE_DATE);
	}

	/**
	 * Gets the value of the delivery_end field
	 */
	function getDeliveryEnd($format = null) {
		return $this->getDelivery_end($format);
	}

	/**
	 * Sets the value of the delivery_end field
	 * @return UploadedLoads
	 */
	function setDeliveryEnd($value) {
		return $this->setDelivery_end($value);
	}

	/**
	 * Gets the value of the state field
	 */
	function getState() {
		return $this->state;
	}

	/**
	 * Sets the value of the state field
	 * @return UploadedLoads
	 */
	function setState($value) {
		return $this->setColumnValue('state', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the weight field
	 */
	function getWeight() {
		return $this->weight;
	}

	/**
	 * Sets the value of the weight field
	 * @return UploadedLoads
	 */
	function setWeight($value) {
		return $this->setColumnValue('weight', $value, BaseModel::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Gets the value of the volume field
	 */
	function getVolume() {
		return $this->volume;
	}

	/**
	 * Sets the value of the volume field
	 * @return UploadedLoads
	 */
	function setVolume($value) {
		return $this->setColumnValue('volume', $value, BaseModel::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Gets the value of the hazmat field
	 */
	function getHazmat() {
		return $this->hazmat;
	}

	/**
	 * Sets the value of the hazmat field
	 * @return UploadedLoads
	 */
	function setHazmat($value) {
		return $this->setColumnValue('hazmat', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the over_dim field
	 */
	function getOver_dim() {
		return $this->over_dim;
	}

	/**
	 * Sets the value of the over_dim field
	 * @return UploadedLoads
	 */
	function setOver_dim($value) {
		return $this->setColumnValue('over_dim', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the over_dim field
	 */
	function getOverDim() {
		return $this->getOver_dim();
	}

	/**
	 * Sets the value of the over_dim field
	 * @return UploadedLoads
	 */
	function setOverDim($value) {
		return $this->setOver_dim($value);
	}

	/**
	 * Gets the value of the len field
	 */
	function getLen() {
		return $this->len;
	}

	/**
	 * Sets the value of the len field
	 * @return UploadedLoads
	 */
	function setLen($value) {
		return $this->setColumnValue('len', $value, BaseModel::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Gets the value of the wid field
	 */
	function getWid() {
		return $this->wid;
	}

	/**
	 * Sets the value of the wid field
	 * @return UploadedLoads
	 */
	function setWid($value) {
		return $this->setColumnValue('wid', $value, BaseModel::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Gets the value of the hgt field
	 */
	function getHgt() {
		return $this->hgt;
	}

	/**
	 * Sets the value of the hgt field
	 * @return UploadedLoads
	 */
	function setHgt($value) {
		return $this->setColumnValue('hgt', $value, BaseModel::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Gets the value of the eqpt field
	 */
	function getEqpt() {
		return $this->eqpt;
	}

	/**
	 * Sets the value of the eqpt field
	 * @return UploadedLoads
	 */
	function setEqpt($value) {
		return $this->setColumnValue('eqpt', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the origin field
	 */
	function getOrigin() {
		return $this->origin;
	}

	/**
	 * Sets the value of the origin field
	 * @return UploadedLoads
	 */
	function setOrigin($value) {
		return $this->setColumnValue('origin', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the destination field
	 */
	function getDestination() {
		return $this->destination;
	}

	/**
	 * Sets the value of the destination field
	 * @return UploadedLoads
	 */
	function setDestination($value) {
		return $this->setColumnValue('destination', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the truckstop_id field
	 */
	function getTruckstop_id() {
		return $this->truckstop_id;
	}

	/**
	 * Sets the value of the truckstop_id field
	 * @return UploadedLoads
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
	 * @return UploadedLoads
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
	 * @return UploadedLoads
	 */
	static function create() {
		return new UploadedLoads();
	}

	/**
	 * Returns String representation of table name
	 * @return string
	 */
	static function getTableName() {
		return UploadedLoads::$_tableName;
	}

	/**
	 * Access to array of column names
	 * @return array
	 */
	static function getColumnNames() {
		return UploadedLoads::$_columnNames;
	}

	/**
	 * Access to array of column types, indexed by column name
	 * @return array
	 */
	static function getColumnTypes() {
		return UploadedLoads::$_columnTypes;
	}

	/**
	 * Get the type of a column
	 * @return array
	 */
	static function getColumnType($column_name) {
		return UploadedLoads::$_columnTypes[$column_name];
	}

	/**
	 * @return bool
	 */
	static function hasColumn($column_name) {
		static $lower_case_columns = null;
		if (null === $lower_case_columns) {
			$lower_case_columns = array_map('strtolower', UploadedLoads::$_columnNames);
		}
		return in_array(strtolower($column_name), $lower_case_columns);
	}

	/**
	 * Access to array of primary keys
	 * @return array
	 */
	static function getPrimaryKeys() {
		return UploadedLoads::$_primaryKeys;
	}

	/**
	 * Access to name of primary key
	 * @return array
	 */
	static function getPrimaryKey() {
		return UploadedLoads::$_primaryKey;
	}

	/**
	 * Returns true if the primary key column for this table is auto-increment
	 * @return bool
	 */
	static function isAutoIncrement() {
		return UploadedLoads::$_isAutoIncrement;
	}

	/**
	 * Searches the database for a row with the ID(primary key) that matches
	 * the one input.
	 * @return UploadedLoads
	 */
	static function retrieveByPK($the_pk) {
		return UploadedLoads::retrieveByPKs($the_pk);
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return UploadedLoads
	 */
	static function retrieveByPKs($id) {
		if (null === $id) {
			return null;
		}
		$pool_instance = UploadedLoads::retrieveFromPool($id);
		if (null !== $pool_instance) {
			return $pool_instance;
		}
		$conn = UploadedLoads::getConnection();
		$q = new Query;
		$q->add('id', $id);
		return array_shift(UploadedLoads::doSelect($q, true));
	}

	/**
	 * Searches the database for a row with a id	 * value that matches the one provided
	 * @return UploadedLoads
	 */
	static function retrieveById($value) {
		return UploadedLoads::retrieveByPK($value);
	}

	/**
	 * Searches the database for a row with a offer_number	 * value that matches the one provided
	 * @return UploadedLoads
	 */
	static function retrieveByOfferNumber($value) {
		return UploadedLoads::retrieveByColumn('offer_number', $value);
	}

	/**
	 * Searches the database for a row with a ocity	 * value that matches the one provided
	 * @return UploadedLoads
	 */
	static function retrieveByOcity($value) {
		return UploadedLoads::retrieveByColumn('ocity', $value);
	}

	/**
	 * Searches the database for a row with a ost	 * value that matches the one provided
	 * @return UploadedLoads
	 */
	static function retrieveByOst($value) {
		return UploadedLoads::retrieveByColumn('ost', $value);
	}

	/**
	 * Searches the database for a row with a ozip	 * value that matches the one provided
	 * @return UploadedLoads
	 */
	static function retrieveByOzip($value) {
		return UploadedLoads::retrieveByColumn('ozip', $value);
	}

	/**
	 * Searches the database for a row with a dcity	 * value that matches the one provided
	 * @return UploadedLoads
	 */
	static function retrieveByDcity($value) {
		return UploadedLoads::retrieveByColumn('dcity', $value);
	}

	/**
	 * Searches the database for a row with a dst	 * value that matches the one provided
	 * @return UploadedLoads
	 */
	static function retrieveByDst($value) {
		return UploadedLoads::retrieveByColumn('dst', $value);
	}

	/**
	 * Searches the database for a row with a dzip	 * value that matches the one provided
	 * @return UploadedLoads
	 */
	static function retrieveByDzip($value) {
		return UploadedLoads::retrieveByColumn('dzip', $value);
	}

	/**
	 * Searches the database for a row with a pickup_start	 * value that matches the one provided
	 * @return UploadedLoads
	 */
	static function retrieveByPickupStart($value) {
		return UploadedLoads::retrieveByColumn('pickup_start', $value);
	}

	/**
	 * Searches the database for a row with a pickup_end	 * value that matches the one provided
	 * @return UploadedLoads
	 */
	static function retrieveByPickupEnd($value) {
		return UploadedLoads::retrieveByColumn('pickup_end', $value);
	}

	/**
	 * Searches the database for a row with a delivery_start	 * value that matches the one provided
	 * @return UploadedLoads
	 */
	static function retrieveByDeliveryStart($value) {
		return UploadedLoads::retrieveByColumn('delivery_start', $value);
	}

	/**
	 * Searches the database for a row with a delivery_end	 * value that matches the one provided
	 * @return UploadedLoads
	 */
	static function retrieveByDeliveryEnd($value) {
		return UploadedLoads::retrieveByColumn('delivery_end', $value);
	}

	/**
	 * Searches the database for a row with a state	 * value that matches the one provided
	 * @return UploadedLoads
	 */
	static function retrieveByState($value) {
		return UploadedLoads::retrieveByColumn('state', $value);
	}

	/**
	 * Searches the database for a row with a weight	 * value that matches the one provided
	 * @return UploadedLoads
	 */
	static function retrieveByWeight($value) {
		return UploadedLoads::retrieveByColumn('weight', $value);
	}

	/**
	 * Searches the database for a row with a volume	 * value that matches the one provided
	 * @return UploadedLoads
	 */
	static function retrieveByVolume($value) {
		return UploadedLoads::retrieveByColumn('volume', $value);
	}

	/**
	 * Searches the database for a row with a hazmat	 * value that matches the one provided
	 * @return UploadedLoads
	 */
	static function retrieveByHazmat($value) {
		return UploadedLoads::retrieveByColumn('hazmat', $value);
	}

	/**
	 * Searches the database for a row with a over_dim	 * value that matches the one provided
	 * @return UploadedLoads
	 */
	static function retrieveByOverDim($value) {
		return UploadedLoads::retrieveByColumn('over_dim', $value);
	}

	/**
	 * Searches the database for a row with a len	 * value that matches the one provided
	 * @return UploadedLoads
	 */
	static function retrieveByLen($value) {
		return UploadedLoads::retrieveByColumn('len', $value);
	}

	/**
	 * Searches the database for a row with a wid	 * value that matches the one provided
	 * @return UploadedLoads
	 */
	static function retrieveByWid($value) {
		return UploadedLoads::retrieveByColumn('wid', $value);
	}

	/**
	 * Searches the database for a row with a hgt	 * value that matches the one provided
	 * @return UploadedLoads
	 */
	static function retrieveByHgt($value) {
		return UploadedLoads::retrieveByColumn('hgt', $value);
	}

	/**
	 * Searches the database for a row with a eqpt	 * value that matches the one provided
	 * @return UploadedLoads
	 */
	static function retrieveByEqpt($value) {
		return UploadedLoads::retrieveByColumn('eqpt', $value);
	}

	/**
	 * Searches the database for a row with a origin	 * value that matches the one provided
	 * @return UploadedLoads
	 */
	static function retrieveByOrigin($value) {
		return UploadedLoads::retrieveByColumn('origin', $value);
	}

	/**
	 * Searches the database for a row with a destination	 * value that matches the one provided
	 * @return UploadedLoads
	 */
	static function retrieveByDestination($value) {
		return UploadedLoads::retrieveByColumn('destination', $value);
	}

	/**
	 * Searches the database for a row with a truckstop_id	 * value that matches the one provided
	 * @return UploadedLoads
	 */
	static function retrieveByTruckstopId($value) {
		return UploadedLoads::retrieveByColumn('truckstop_id', $value);
	}

	static function retrieveByColumn($field, $value) {
		$conn = UploadedLoads::getConnection();
		return array_shift(UploadedLoads::doSelect(Query::create()->add($field, $value)->setLimit(1)->order('id')));
	}

	/**
	 * Populates and returns an instance of UploadedLoads with the
	 * first result of a query.  If the query returns no results,
	 * returns null.
	 * @return UploadedLoads
	 */
	static function fetchSingle($query_string, $write_cache = true) {
		return array_shift(UploadedLoads::fetch($query_string, $write_cache));
	}

	/**
	 * Populates and returns an array of UploadedLoads objects with the
	 * results of a query.  If the query returns no results,
	 * returns an empty Array.
	 * @return UploadedLoads[]
	 */
	static function fetch($query_string, $write_cache = false) {
		$conn = UploadedLoads::getConnection();
		$result = $conn->query($query_string);
		return UploadedLoads::fromResult($result, 'UploadedLoads', $write_cache);
	}

	/**
	 * Returns an array of UploadedLoads objects from
	 * a PDOStatement(query result).
	 *
	 * @see BaseModel::fromResult
	 */
	static function fromResult(PDOStatement $result, $class = 'UploadedLoads', $write_cache = false) {
		return baseModel::fromResult($result, $class, $write_cache);
	}

	/**
	 * Casts values of int fields to (int)
	 * @return UploadedLoads
	 */
	function castInts() {
		$this->id = (null === $this->id) ? null : (int) $this->id;
		$this->weight = (null === $this->weight) ? null : (int) $this->weight;
		$this->volume = (null === $this->volume) ? null : (int) $this->volume;
		$this->len = (null === $this->len) ? null : (int) $this->len;
		$this->wid = (null === $this->wid) ? null : (int) $this->wid;
		$this->hgt = (null === $this->hgt) ? null : (int) $this->hgt;
		$this->truckstop_id = (null === $this->truckstop_id) ? null : (int) $this->truckstop_id;
		return $this;
	}

	/**
	 * Add (or replace) to the instance pool.
	 *
	 * @param UploadedLoads $object
	 * @return void
	 */
	static function insertIntoPool(UploadedLoads $object) {
		if (UploadedLoads::$_instancePoolCount > UploadedLoads::MAX_INSTANCE_POOL_SIZE) {
			return;
		}

		UploadedLoads::$_instancePool[implode('-', $object->getPrimaryKeyValues())] = clone $object;
		++UploadedLoads::$_instancePoolCount;
	}

	/**
	 * Return the cached instance from the pool.
	 *
	 * @param mixed $pk Primary Key
	 * @return UploadedLoads
	 */
	static function retrieveFromPool($pk) {
		if (null === $pk) {
			return null;
		}
		if (array_key_exists($pk, UploadedLoads::$_instancePool)) {
			return clone UploadedLoads::$_instancePool[$pk];
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

		if (array_key_exists($pk, UploadedLoads::$_instancePool)) {
			unset(UploadedLoads::$_instancePool[$pk]);
			--UploadedLoads::$_instancePoolCount;
		}
	}

	/**
	 * Empty the instance pool.
	 *
	 * @return void
	 */
	static function flushPool() {
		UploadedLoads::$_instancePool = array();
	}

	/**
	 * Returns an array of all UploadedLoads objects in the database.
	 * $extra SQL can be appended to the query to LIMIT, SORT, and/or GROUP results.
	 * If there are no results, returns an empty Array.
	 * @param $extra string
	 * @return UploadedLoads[]
	 */
	static function getAll($extra = null, $write_cache = false) {
		$conn = UploadedLoads::getConnection();
		$table_quoted = $conn->quoteIdentifier(UploadedLoads::getTableName());
		return UploadedLoads::fetch("SELECT * FROM $table_quoted $extra ", $write_cache);
	}

	/**
	 * @return int
	 */
	static function doCount(Query $q = null) {
		$q = $q ? clone $q : new Query;
		$conn = UploadedLoads::getConnection();
		if (!$q->getTable() || UploadedLoads::getTableName() != $q->getTable()) {
			$q->setTable(UploadedLoads::getTableName());
		}
		return $q->doCount($conn);
	}

	/**
	 * @param Query $q
	 * @param bool $dump_cache
	 * @return int
	 */
	static function doDelete(Query $q, $dump_cache = true) {
		$conn = UploadedLoads::getConnection();
		$q = clone $q;
		if (!$q->getTable() || UploadedLoads::getTableName() != $q->getTable()) {
			$q->setTable(UploadedLoads::getTableName());
		}
		$result = $q->doDelete($conn);

		if ($dump_cache) {
			UploadedLoads::$_instancePool = array();
		}

		return $result;
	}

	/**
	 * @param Query $q The Query object that creates the SELECT query string
	 * @param bool $write_cache Whether or not to store results in instance pool
	 * @param array $additional_classes Array of additional classes for fromResult to instantiate as properties
	 * @return UploadedLoads[]
	 */
	static function doSelect(Query $q = null, $write_cache = false, $additional_classes = null) {
		if (is_array($additional_classes)) {
			array_unshift($additional_classes, 'UploadedLoads');
			$class = $additional_classes;
		} else {
			$class = 'UploadedLoads';
		}

		return UploadedLoads::fromResult(self::doSelectRS($q), $class, $write_cache);
	}

	/**
	 * Executes a select query and returns the PDO result
	 * @return PDOStatement
	 */
	static function doSelectRS(Query $q = null) {
		$q = $q ? clone $q : new Query;
		$conn = UploadedLoads::getConnection();
		if (!$q->getTable() || UploadedLoads::getTableName() != $q->getTable()) {
			$q->setTable(UploadedLoads::getTableName());
		}

		return $q->doSelect($conn);
	}

	/**
	 * @return UploadedLoads[]
	 */
	static function doSelectJoinAll(Query $q = null, $write_cache = false, $join_type = Query::LEFT_JOIN) {
		$q = $q ? clone $q : new Query;
		$columns = $q->getColumns();
		$classes = array();
		$alias = $q->getAlias();
		$this_table = $alias ? $alias : UploadedLoads::getTableName();
		if (!$columns) {
			$columns[] = $this_table . '.*';
		}

		$q->setColumns($columns);
		return UploadedLoads::doSelect($q, $write_cache, $classes);
	}

	/**
	 * Returns true if the column values validate.
	 * @return bool
	 */
	function validate() {
		$this->_validationErrors = array();
		if (null === $this->getoffer_number()) {
			$this->_validationErrors[] = 'offer_number must not be null';
		}
		if (null === $this->getocity()) {
			$this->_validationErrors[] = 'ocity must not be null';
		}
		if (null === $this->getost()) {
			$this->_validationErrors[] = 'ost must not be null';
		}
		if (null === $this->getozip()) {
			$this->_validationErrors[] = 'ozip must not be null';
		}
		if (null === $this->getdcity()) {
			$this->_validationErrors[] = 'dcity must not be null';
		}
		if (null === $this->getdst()) {
			$this->_validationErrors[] = 'dst must not be null';
		}
		if (null === $this->getdzip()) {
			$this->_validationErrors[] = 'dzip must not be null';
		}
		if (null === $this->getpickup_start()) {
			$this->_validationErrors[] = 'pickup_start must not be null';
		}
		if (null === $this->getpickup_end()) {
			$this->_validationErrors[] = 'pickup_end must not be null';
		}
		if (null === $this->getdelivery_start()) {
			$this->_validationErrors[] = 'delivery_start must not be null';
		}
		if (null === $this->getdelivery_end()) {
			$this->_validationErrors[] = 'delivery_end must not be null';
		}
		if (null === $this->getstate()) {
			$this->_validationErrors[] = 'state must not be null';
		}
		if (null === $this->getweight()) {
			$this->_validationErrors[] = 'weight must not be null';
		}
		if (null === $this->getvolume()) {
			$this->_validationErrors[] = 'volume must not be null';
		}
		if (null === $this->gethazmat()) {
			$this->_validationErrors[] = 'hazmat must not be null';
		}
		if (null === $this->getover_dim()) {
			$this->_validationErrors[] = 'over_dim must not be null';
		}
		if (null === $this->getlen()) {
			$this->_validationErrors[] = 'len must not be null';
		}
		if (null === $this->getwid()) {
			$this->_validationErrors[] = 'wid must not be null';
		}
		if (null === $this->gethgt()) {
			$this->_validationErrors[] = 'hgt must not be null';
		}
		if (null === $this->geteqpt()) {
			$this->_validationErrors[] = 'eqpt must not be null';
		}
		if (null === $this->getorigin()) {
			$this->_validationErrors[] = 'origin must not be null';
		}
		if (null === $this->getdestination()) {
			$this->_validationErrors[] = 'destination must not be null';
		}
		if (null === $this->gettruckstop_id()) {
			$this->_validationErrors[] = 'truckstop_id must not be null';
		}
		return 0 === count($this->_validationErrors);
	}

}
