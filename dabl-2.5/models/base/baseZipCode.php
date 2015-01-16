<?php
/**
 *		Created by Dan Blaisdell's DABL
 *		Do not alter base files, as they will be overwritten.
 *		To alter the objects, alter the extended classes in
 *		the 'models' folder.
 *
 */
abstract class baseZipCode extends ApplicationModel {

	/**
	 * Name of the table
	 * @var string
	 */
	protected static $_tableName = 'zip_code';

	/**
	 * Cache of objects retrieved from the database
	 * @var ZipCode[]
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
		'zip_code',
		'city',
		'county',
		'state_name',
		'state_prefix',
		'area_code',
		'time_zone',
		'lat',
		'lon',
		'location',
	);

	/**
	 * array of all column types
	 * @var string[]
	 */
	protected static $_columnTypes = array(
		'id' => BaseModel::COLUMN_TYPE_INTEGER,
		'zip_code' => BaseModel::COLUMN_TYPE_VARCHAR,
		'city' => BaseModel::COLUMN_TYPE_VARCHAR,
		'county' => BaseModel::COLUMN_TYPE_VARCHAR,
		'state_name' => BaseModel::COLUMN_TYPE_VARCHAR,
		'state_prefix' => BaseModel::COLUMN_TYPE_VARCHAR,
		'area_code' => BaseModel::COLUMN_TYPE_VARCHAR,
		'time_zone' => BaseModel::COLUMN_TYPE_VARCHAR,
		'lat' => BaseModel::COLUMN_TYPE_FLOAT,
		'lon' => BaseModel::COLUMN_TYPE_FLOAT,
		'location' => BaseModel::COLUMN_TYPE_VARCHAR,
	);

	/**
	 * `id` INTEGER NOT NULL DEFAULT ''
	 * @var int
	 */
	protected $id;

	/**
	 * `zip_code` VARCHAR NOT NULL
	 * @var string
	 */
	protected $zip_code;

	/**
	 * `city` VARCHAR
	 * @var string
	 */
	protected $city;

	/**
	 * `county` VARCHAR
	 * @var string
	 */
	protected $county;

	/**
	 * `state_name` VARCHAR
	 * @var string
	 */
	protected $state_name;

	/**
	 * `state_prefix` VARCHAR
	 * @var string
	 */
	protected $state_prefix;

	/**
	 * `area_code` VARCHAR
	 * @var string
	 */
	protected $area_code;

	/**
	 * `time_zone` VARCHAR
	 * @var string
	 */
	protected $time_zone;

	/**
	 * `lat` FLOAT NOT NULL DEFAULT ''
	 * @var double
	 */
	protected $lat;

	/**
	 * `lon` FLOAT NOT NULL DEFAULT ''
	 * @var double
	 */
	protected $lon;

	/**
	 * `location` VARCHAR
	 * @var string
	 */
	protected $location;

	/**
	 * Gets the value of the id field
	 */
	function getId() {
		return $this->id;
	}

	/**
	 * Sets the value of the id field
	 * @return ZipCode
	 */
	function setId($value) {
		return $this->setColumnValue('id', $value, BaseModel::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Gets the value of the zip_code field
	 */
	function getZip_code() {
		return $this->zip_code;
	}

	/**
	 * Sets the value of the zip_code field
	 * @return ZipCode
	 */
	function setZip_code($value) {
		return $this->setColumnValue('zip_code', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the zip_code field
	 */
	function getZipCode() {
		return $this->getZip_code();
	}

	/**
	 * Sets the value of the zip_code field
	 * @return ZipCode
	 */
	function setZipCode($value) {
		return $this->setZip_code($value);
	}

	/**
	 * Gets the value of the city field
	 */
	function getCity() {
		return $this->city;
	}

	/**
	 * Sets the value of the city field
	 * @return ZipCode
	 */
	function setCity($value) {
		return $this->setColumnValue('city', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the county field
	 */
	function getCounty() {
		return $this->county;
	}

	/**
	 * Sets the value of the county field
	 * @return ZipCode
	 */
	function setCounty($value) {
		return $this->setColumnValue('county', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the state_name field
	 */
	function getState_name() {
		return $this->state_name;
	}

	/**
	 * Sets the value of the state_name field
	 * @return ZipCode
	 */
	function setState_name($value) {
		return $this->setColumnValue('state_name', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the state_name field
	 */
	function getStateName() {
		return $this->getState_name();
	}

	/**
	 * Sets the value of the state_name field
	 * @return ZipCode
	 */
	function setStateName($value) {
		return $this->setState_name($value);
	}

	/**
	 * Gets the value of the state_prefix field
	 */
	function getState_prefix() {
		return $this->state_prefix;
	}

	/**
	 * Sets the value of the state_prefix field
	 * @return ZipCode
	 */
	function setState_prefix($value) {
		return $this->setColumnValue('state_prefix', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the state_prefix field
	 */
	function getStatePrefix() {
		return $this->getState_prefix();
	}

	/**
	 * Sets the value of the state_prefix field
	 * @return ZipCode
	 */
	function setStatePrefix($value) {
		return $this->setState_prefix($value);
	}

	/**
	 * Gets the value of the area_code field
	 */
	function getArea_code() {
		return $this->area_code;
	}

	/**
	 * Sets the value of the area_code field
	 * @return ZipCode
	 */
	function setArea_code($value) {
		return $this->setColumnValue('area_code', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the area_code field
	 */
	function getAreaCode() {
		return $this->getArea_code();
	}

	/**
	 * Sets the value of the area_code field
	 * @return ZipCode
	 */
	function setAreaCode($value) {
		return $this->setArea_code($value);
	}

	/**
	 * Gets the value of the time_zone field
	 */
	function getTime_zone() {
		return $this->time_zone;
	}

	/**
	 * Sets the value of the time_zone field
	 * @return ZipCode
	 */
	function setTime_zone($value) {
		return $this->setColumnValue('time_zone', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the time_zone field
	 */
	function getTimeZone() {
		return $this->getTime_zone();
	}

	/**
	 * Sets the value of the time_zone field
	 * @return ZipCode
	 */
	function setTimeZone($value) {
		return $this->setTime_zone($value);
	}

	/**
	 * Gets the value of the lat field
	 */
	function getLat() {
		return $this->lat;
	}

	/**
	 * Sets the value of the lat field
	 * @return ZipCode
	 */
	function setLat($value) {
		return $this->setColumnValue('lat', $value, BaseModel::COLUMN_TYPE_FLOAT);
	}

	/**
	 * Gets the value of the lon field
	 */
	function getLon() {
		return $this->lon;
	}

	/**
	 * Sets the value of the lon field
	 * @return ZipCode
	 */
	function setLon($value) {
		return $this->setColumnValue('lon', $value, BaseModel::COLUMN_TYPE_FLOAT);
	}

	/**
	 * Gets the value of the location field
	 */
	function getLocation() {
		return $this->location;
	}

	/**
	 * Sets the value of the location field
	 * @return ZipCode
	 */
	function setLocation($value) {
		return $this->setColumnValue('location', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * @return DABLPDO
	 */
	static function getConnection() {
		return DBManager::getConnection('default_mysqll');
	}

	/**
	 * @return ZipCode
	 */
	static function create() {
		return new ZipCode();
	}

	/**
	 * Returns String representation of table name
	 * @return string
	 */
	static function getTableName() {
		return ZipCode::$_tableName;
	}

	/**
	 * Access to array of column names
	 * @return array
	 */
	static function getColumnNames() {
		return ZipCode::$_columnNames;
	}

	/**
	 * Access to array of column types, indexed by column name
	 * @return array
	 */
	static function getColumnTypes() {
		return ZipCode::$_columnTypes;
	}

	/**
	 * Get the type of a column
	 * @return array
	 */
	static function getColumnType($column_name) {
		return ZipCode::$_columnTypes[$column_name];
	}

	/**
	 * @return bool
	 */
	static function hasColumn($column_name) {
		static $lower_case_columns = null;
		if (null === $lower_case_columns) {
			$lower_case_columns = array_map('strtolower', ZipCode::$_columnNames);
		}
		return in_array(strtolower($column_name), $lower_case_columns);
	}

	/**
	 * Access to array of primary keys
	 * @return array
	 */
	static function getPrimaryKeys() {
		return ZipCode::$_primaryKeys;
	}

	/**
	 * Access to name of primary key
	 * @return array
	 */
	static function getPrimaryKey() {
		return ZipCode::$_primaryKey;
	}

	/**
	 * Returns true if the primary key column for this table is auto-increment
	 * @return bool
	 */
	static function isAutoIncrement() {
		return ZipCode::$_isAutoIncrement;
	}

	/**
	 * Searches the database for a row with the ID(primary key) that matches
	 * the one input.
	 * @return ZipCode
	 */
	static function retrieveByPK($the_pk) {
		return ZipCode::retrieveByPKs($the_pk);
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return ZipCode
	 */
	static function retrieveByPKs($id) {
		if (null === $id) {
			return null;
		}
		$pool_instance = ZipCode::retrieveFromPool($id);
		if (null !== $pool_instance) {
			return $pool_instance;
		}
		$conn = ZipCode::getConnection();
		$q = new Query;
		$q->add('id', $id);
		return array_shift(ZipCode::doSelect($q, true));
	}

	/**
	 * Searches the database for a row with a id	 * value that matches the one provided
	 * @return ZipCode
	 */
	static function retrieveById($value) {
		return ZipCode::retrieveByPK($value);
	}

	/**
	 * Searches the database for a row with a zip_code	 * value that matches the one provided
	 * @return ZipCode
	 */
	static function retrieveByZipCode($value) {
		return ZipCode::retrieveByColumn('zip_code', $value);
	}

	/**
	 * Searches the database for a row with a city	 * value that matches the one provided
	 * @return ZipCode
	 */
	static function retrieveByCity($value) {
		return ZipCode::retrieveByColumn('city', $value);
	}

	/**
	 * Searches the database for a row with a county	 * value that matches the one provided
	 * @return ZipCode
	 */
	static function retrieveByCounty($value) {
		return ZipCode::retrieveByColumn('county', $value);
	}

	/**
	 * Searches the database for a row with a state_name	 * value that matches the one provided
	 * @return ZipCode
	 */
	static function retrieveByStateName($value) {
		return ZipCode::retrieveByColumn('state_name', $value);
	}

	/**
	 * Searches the database for a row with a state_prefix	 * value that matches the one provided
	 * @return ZipCode
	 */
	static function retrieveByStatePrefix($value) {
		return ZipCode::retrieveByColumn('state_prefix', $value);
	}

	/**
	 * Searches the database for a row with a area_code	 * value that matches the one provided
	 * @return ZipCode
	 */
	static function retrieveByAreaCode($value) {
		return ZipCode::retrieveByColumn('area_code', $value);
	}

	/**
	 * Searches the database for a row with a time_zone	 * value that matches the one provided
	 * @return ZipCode
	 */
	static function retrieveByTimeZone($value) {
		return ZipCode::retrieveByColumn('time_zone', $value);
	}

	/**
	 * Searches the database for a row with a lat	 * value that matches the one provided
	 * @return ZipCode
	 */
	static function retrieveByLat($value) {
		return ZipCode::retrieveByColumn('lat', $value);
	}

	/**
	 * Searches the database for a row with a lon	 * value that matches the one provided
	 * @return ZipCode
	 */
	static function retrieveByLon($value) {
		return ZipCode::retrieveByColumn('lon', $value);
	}

	/**
	 * Searches the database for a row with a location	 * value that matches the one provided
	 * @return ZipCode
	 */
	static function retrieveByLocation($value) {
		return ZipCode::retrieveByColumn('location', $value);
	}

	static function retrieveByColumn($field, $value) {
		$conn = ZipCode::getConnection();
		return array_shift(ZipCode::doSelect(Query::create()->add($field, $value)->setLimit(1)->order('id')));
	}

	/**
	 * Populates and returns an instance of ZipCode with the
	 * first result of a query.  If the query returns no results,
	 * returns null.
	 * @return ZipCode
	 */
	static function fetchSingle($query_string, $write_cache = true) {
		return array_shift(ZipCode::fetch($query_string, $write_cache));
	}

	/**
	 * Populates and returns an array of ZipCode objects with the
	 * results of a query.  If the query returns no results,
	 * returns an empty Array.
	 * @return ZipCode[]
	 */
	static function fetch($query_string, $write_cache = false) {
		$conn = ZipCode::getConnection();
		$result = $conn->query($query_string);
		return ZipCode::fromResult($result, 'ZipCode', $write_cache);
	}

	/**
	 * Returns an array of ZipCode objects from
	 * a PDOStatement(query result).
	 *
	 * @see BaseModel::fromResult
	 */
	static function fromResult(PDOStatement $result, $class = 'ZipCode', $write_cache = false) {
		return baseModel::fromResult($result, $class, $write_cache);
	}

	/**
	 * Casts values of int fields to (int)
	 * @return ZipCode
	 */
	function castInts() {
		$this->id = (null === $this->id) ? null : (int) $this->id;
		return $this;
	}

	/**
	 * Add (or replace) to the instance pool.
	 *
	 * @param ZipCode $object
	 * @return void
	 */
	static function insertIntoPool(ZipCode $object) {
		if (ZipCode::$_instancePoolCount > ZipCode::MAX_INSTANCE_POOL_SIZE) {
			return;
		}

		ZipCode::$_instancePool[implode('-', $object->getPrimaryKeyValues())] = clone $object;
		++ZipCode::$_instancePoolCount;
	}

	/**
	 * Return the cached instance from the pool.
	 *
	 * @param mixed $pk Primary Key
	 * @return ZipCode
	 */
	static function retrieveFromPool($pk) {
		if (null === $pk) {
			return null;
		}
		if (array_key_exists($pk, ZipCode::$_instancePool)) {
			return clone ZipCode::$_instancePool[$pk];
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

		if (array_key_exists($pk, ZipCode::$_instancePool)) {
			unset(ZipCode::$_instancePool[$pk]);
			--ZipCode::$_instancePoolCount;
		}
	}

	/**
	 * Empty the instance pool.
	 *
	 * @return void
	 */
	static function flushPool() {
		ZipCode::$_instancePool = array();
	}

	/**
	 * Returns an array of all ZipCode objects in the database.
	 * $extra SQL can be appended to the query to LIMIT, SORT, and/or GROUP results.
	 * If there are no results, returns an empty Array.
	 * @param $extra string
	 * @return ZipCode[]
	 */
	static function getAll($extra = null, $write_cache = false) {
		$conn = ZipCode::getConnection();
		$table_quoted = $conn->quoteIdentifier(ZipCode::getTableName());
		return ZipCode::fetch("SELECT * FROM $table_quoted $extra ", $write_cache);
	}

	/**
	 * @return int
	 */
	static function doCount(Query $q = null) {
		$q = $q ? clone $q : new Query;
		$conn = ZipCode::getConnection();
		if (!$q->getTable() || ZipCode::getTableName() != $q->getTable()) {
			$q->setTable(ZipCode::getTableName());
		}
		return $q->doCount($conn);
	}

	/**
	 * @param Query $q
	 * @param bool $dump_cache
	 * @return int
	 */
	static function doDelete(Query $q, $dump_cache = true) {
		$conn = ZipCode::getConnection();
		$q = clone $q;
		if (!$q->getTable() || ZipCode::getTableName() != $q->getTable()) {
			$q->setTable(ZipCode::getTableName());
		}
		$result = $q->doDelete($conn);

		if ($dump_cache) {
			ZipCode::$_instancePool = array();
		}

		return $result;
	}

	/**
	 * @param Query $q The Query object that creates the SELECT query string
	 * @param bool $write_cache Whether or not to store results in instance pool
	 * @param array $additional_classes Array of additional classes for fromResult to instantiate as properties
	 * @return ZipCode[]
	 */
	static function doSelect(Query $q = null, $write_cache = false, $additional_classes = null) {
		if (is_array($additional_classes)) {
			array_unshift($additional_classes, 'ZipCode');
			$class = $additional_classes;
		} else {
			$class = 'ZipCode';
		}

		return ZipCode::fromResult(self::doSelectRS($q), $class, $write_cache);
	}

	/**
	 * Executes a select query and returns the PDO result
	 * @return PDOStatement
	 */
	static function doSelectRS(Query $q = null) {
		$q = $q ? clone $q : new Query;
		$conn = ZipCode::getConnection();
		if (!$q->getTable() || ZipCode::getTableName() != $q->getTable()) {
			$q->setTable(ZipCode::getTableName());
		}

		return $q->doSelect($conn);
	}

	/**
	 * @return ZipCode[]
	 */
	static function doSelectJoinAll(Query $q = null, $write_cache = false, $join_type = Query::LEFT_JOIN) {
		$q = $q ? clone $q : new Query;
		$columns = $q->getColumns();
		$classes = array();
		$alias = $q->getAlias();
		$this_table = $alias ? $alias : ZipCode::getTableName();
		if (!$columns) {
			$columns[] = $this_table . '.*';
		}

		$q->setColumns($columns);
		return ZipCode::doSelect($q, $write_cache, $classes);
	}

	/**
	 * Returns true if the column values validate.
	 * @return bool
	 */
	function validate() {
		$this->_validationErrors = array();
		if (null === $this->getzip_code()) {
			$this->_validationErrors[] = 'zip_code must not be null';
		}
		if (null === $this->getlat()) {
			$this->_validationErrors[] = 'lat must not be null';
		}
		if (null === $this->getlon()) {
			$this->_validationErrors[] = 'lon must not be null';
		}
		return 0 === count($this->_validationErrors);
	}

}
