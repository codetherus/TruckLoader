<?php
/**
 *		Created by Dan Blaisdell's DABL
 *		Do not alter base files, as they will be overwritten.
 *		To alter the objects, alter the extended classes in
 *		the 'models' folder.
 *
 */
abstract class baseTruckInbound extends ApplicationModel {

	/**
	 * Name of the table
	 * @var string
	 */
	protected static $_tableName = 'truck_inbound';

	/**
	 * Cache of objects retrieved from the database
	 * @var TruckInbound[]
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
		'agent',
		'unit',
		'truck_number',
		'equipment',
		'driver',
		'cell',
		'origin_city',
		'origin_state',
		'dest_city',
		'dest_state',
		'delivery_month',
		'delivery_day',
		'delivery_date',
		'comments',
		'report_date',
		'telephone',
	);

	/**
	 * array of all column types
	 * @var string[]
	 */
	protected static $_columnTypes = array(
		'id' => BaseModel::COLUMN_TYPE_BIGINT,
		'agent' => BaseModel::COLUMN_TYPE_VARCHAR,
		'unit' => BaseModel::COLUMN_TYPE_VARCHAR,
		'truck_number' => BaseModel::COLUMN_TYPE_VARCHAR,
		'equipment' => BaseModel::COLUMN_TYPE_VARCHAR,
		'driver' => BaseModel::COLUMN_TYPE_VARCHAR,
		'cell' => BaseModel::COLUMN_TYPE_VARCHAR,
		'origin_city' => BaseModel::COLUMN_TYPE_VARCHAR,
		'origin_state' => BaseModel::COLUMN_TYPE_VARCHAR,
		'dest_city' => BaseModel::COLUMN_TYPE_VARCHAR,
		'dest_state' => BaseModel::COLUMN_TYPE_VARCHAR,
		'delivery_month' => BaseModel::COLUMN_TYPE_VARCHAR,
		'delivery_day' => BaseModel::COLUMN_TYPE_VARCHAR,
		'delivery_date' => BaseModel::COLUMN_TYPE_VARCHAR,
		'comments' => BaseModel::COLUMN_TYPE_LONGVARCHAR,
		'report_date' => BaseModel::COLUMN_TYPE_VARCHAR,
		'telephone' => BaseModel::COLUMN_TYPE_VARCHAR,
	);

	/**
	 * `id` BIGINT NOT NULL DEFAULT ''
	 * @var string
	 */
	protected $id;

	/**
	 * `agent` VARCHAR NOT NULL
	 * @var string
	 */
	protected $agent;

	/**
	 * `unit` VARCHAR NOT NULL
	 * @var string
	 */
	protected $unit;

	/**
	 * `truck_number` VARCHAR NOT NULL
	 * @var string
	 */
	protected $truck_number;

	/**
	 * `equipment` VARCHAR NOT NULL
	 * @var string
	 */
	protected $equipment;

	/**
	 * `driver` VARCHAR NOT NULL
	 * @var string
	 */
	protected $driver;

	/**
	 * `cell` VARCHAR NOT NULL
	 * @var string
	 */
	protected $cell;

	/**
	 * `origin_city` VARCHAR NOT NULL
	 * @var string
	 */
	protected $origin_city;

	/**
	 * `origin_state` VARCHAR NOT NULL
	 * @var string
	 */
	protected $origin_state;

	/**
	 * `dest_city` VARCHAR NOT NULL
	 * @var string
	 */
	protected $dest_city;

	/**
	 * `dest_state` VARCHAR NOT NULL
	 * @var string
	 */
	protected $dest_state;

	/**
	 * `delivery_month` VARCHAR NOT NULL
	 * @var string
	 */
	protected $delivery_month;

	/**
	 * `delivery_day` VARCHAR NOT NULL
	 * @var string
	 */
	protected $delivery_day;

	/**
	 * `delivery_date` VARCHAR NOT NULL
	 * @var string
	 */
	protected $delivery_date;

	/**
	 * `comments` LONGVARCHAR NOT NULL
	 * @var string
	 */
	protected $comments;

	/**
	 * `report_date` VARCHAR NOT NULL
	 * @var string
	 */
	protected $report_date;

	/**
	 * `telephone` VARCHAR
	 * @var string
	 */
	protected $telephone;

	/**
	 * Gets the value of the id field
	 */
	function getId() {
		return $this->id;
	}

	/**
	 * Sets the value of the id field
	 * @return TruckInbound
	 */
	function setId($value) {
		return $this->setColumnValue('id', $value, BaseModel::COLUMN_TYPE_BIGINT);
	}

	/**
	 * Gets the value of the agent field
	 */
	function getAgent() {
		return $this->agent;
	}

	/**
	 * Sets the value of the agent field
	 * @return TruckInbound
	 */
	function setAgent($value) {
		return $this->setColumnValue('agent', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the unit field
	 */
	function getUnit() {
		return $this->unit;
	}

	/**
	 * Sets the value of the unit field
	 * @return TruckInbound
	 */
	function setUnit($value) {
		return $this->setColumnValue('unit', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the truck_number field
	 */
	function getTruck_number() {
		return $this->truck_number;
	}

	/**
	 * Sets the value of the truck_number field
	 * @return TruckInbound
	 */
	function setTruck_number($value) {
		return $this->setColumnValue('truck_number', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the truck_number field
	 */
	function getTruckNumber() {
		return $this->getTruck_number();
	}

	/**
	 * Sets the value of the truck_number field
	 * @return TruckInbound
	 */
	function setTruckNumber($value) {
		return $this->setTruck_number($value);
	}

	/**
	 * Gets the value of the equipment field
	 */
	function getEquipment() {
		return $this->equipment;
	}

	/**
	 * Sets the value of the equipment field
	 * @return TruckInbound
	 */
	function setEquipment($value) {
		return $this->setColumnValue('equipment', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the driver field
	 */
	function getDriver() {
		return $this->driver;
	}

	/**
	 * Sets the value of the driver field
	 * @return TruckInbound
	 */
	function setDriver($value) {
		return $this->setColumnValue('driver', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the cell field
	 */
	function getCell() {
		return $this->cell;
	}

	/**
	 * Sets the value of the cell field
	 * @return TruckInbound
	 */
	function setCell($value) {
		return $this->setColumnValue('cell', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the origin_city field
	 */
	function getOrigin_city() {
		return $this->origin_city;
	}

	/**
	 * Sets the value of the origin_city field
	 * @return TruckInbound
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
	 * @return TruckInbound
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
	 * @return TruckInbound
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
	 * @return TruckInbound
	 */
	function setOriginState($value) {
		return $this->setOrigin_state($value);
	}

	/**
	 * Gets the value of the dest_city field
	 */
	function getDest_city() {
		return $this->dest_city;
	}

	/**
	 * Sets the value of the dest_city field
	 * @return TruckInbound
	 */
	function setDest_city($value) {
		return $this->setColumnValue('dest_city', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the dest_city field
	 */
	function getDestCity() {
		return $this->getDest_city();
	}

	/**
	 * Sets the value of the dest_city field
	 * @return TruckInbound
	 */
	function setDestCity($value) {
		return $this->setDest_city($value);
	}

	/**
	 * Gets the value of the dest_state field
	 */
	function getDest_state() {
		return $this->dest_state;
	}

	/**
	 * Sets the value of the dest_state field
	 * @return TruckInbound
	 */
	function setDest_state($value) {
		return $this->setColumnValue('dest_state', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the dest_state field
	 */
	function getDestState() {
		return $this->getDest_state();
	}

	/**
	 * Sets the value of the dest_state field
	 * @return TruckInbound
	 */
	function setDestState($value) {
		return $this->setDest_state($value);
	}

	/**
	 * Gets the value of the delivery_month field
	 */
	function getDelivery_month() {
		return $this->delivery_month;
	}

	/**
	 * Sets the value of the delivery_month field
	 * @return TruckInbound
	 */
	function setDelivery_month($value) {
		return $this->setColumnValue('delivery_month', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the delivery_month field
	 */
	function getDeliveryMonth() {
		return $this->getDelivery_month();
	}

	/**
	 * Sets the value of the delivery_month field
	 * @return TruckInbound
	 */
	function setDeliveryMonth($value) {
		return $this->setDelivery_month($value);
	}

	/**
	 * Gets the value of the delivery_day field
	 */
	function getDelivery_day() {
		return $this->delivery_day;
	}

	/**
	 * Sets the value of the delivery_day field
	 * @return TruckInbound
	 */
	function setDelivery_day($value) {
		return $this->setColumnValue('delivery_day', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the delivery_day field
	 */
	function getDeliveryDay() {
		return $this->getDelivery_day();
	}

	/**
	 * Sets the value of the delivery_day field
	 * @return TruckInbound
	 */
	function setDeliveryDay($value) {
		return $this->setDelivery_day($value);
	}

	/**
	 * Gets the value of the delivery_date field
	 */
	function getDelivery_date() {
		return $this->delivery_date;
	}

	/**
	 * Sets the value of the delivery_date field
	 * @return TruckInbound
	 */
	function setDelivery_date($value) {
		return $this->setColumnValue('delivery_date', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the delivery_date field
	 */
	function getDeliveryDate() {
		return $this->getDelivery_date();
	}

	/**
	 * Sets the value of the delivery_date field
	 * @return TruckInbound
	 */
	function setDeliveryDate($value) {
		return $this->setDelivery_date($value);
	}

	/**
	 * Gets the value of the comments field
	 */
	function getComments() {
		return $this->comments;
	}

	/**
	 * Sets the value of the comments field
	 * @return TruckInbound
	 */
	function setComments($value) {
		return $this->setColumnValue('comments', $value, BaseModel::COLUMN_TYPE_LONGVARCHAR);
	}

	/**
	 * Gets the value of the report_date field
	 */
	function getReport_date() {
		return $this->report_date;
	}

	/**
	 * Sets the value of the report_date field
	 * @return TruckInbound
	 */
	function setReport_date($value) {
		return $this->setColumnValue('report_date', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the report_date field
	 */
	function getReportDate() {
		return $this->getReport_date();
	}

	/**
	 * Sets the value of the report_date field
	 * @return TruckInbound
	 */
	function setReportDate($value) {
		return $this->setReport_date($value);
	}

	/**
	 * Gets the value of the telephone field
	 */
	function getTelephone() {
		return $this->telephone;
	}

	/**
	 * Sets the value of the telephone field
	 * @return TruckInbound
	 */
	function setTelephone($value) {
		return $this->setColumnValue('telephone', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * @return DABLPDO
	 */
	static function getConnection() {
		return DBManager::getConnection('default_mysqll');
	}

	/**
	 * @return TruckInbound
	 */
	static function create() {
		return new TruckInbound();
	}

	/**
	 * Returns String representation of table name
	 * @return string
	 */
	static function getTableName() {
		return TruckInbound::$_tableName;
	}

	/**
	 * Access to array of column names
	 * @return array
	 */
	static function getColumnNames() {
		return TruckInbound::$_columnNames;
	}

	/**
	 * Access to array of column types, indexed by column name
	 * @return array
	 */
	static function getColumnTypes() {
		return TruckInbound::$_columnTypes;
	}

	/**
	 * Get the type of a column
	 * @return array
	 */
	static function getColumnType($column_name) {
		return TruckInbound::$_columnTypes[$column_name];
	}

	/**
	 * @return bool
	 */
	static function hasColumn($column_name) {
		static $lower_case_columns = null;
		if (null === $lower_case_columns) {
			$lower_case_columns = array_map('strtolower', TruckInbound::$_columnNames);
		}
		return in_array(strtolower($column_name), $lower_case_columns);
	}

	/**
	 * Access to array of primary keys
	 * @return array
	 */
	static function getPrimaryKeys() {
		return TruckInbound::$_primaryKeys;
	}

	/**
	 * Access to name of primary key
	 * @return array
	 */
	static function getPrimaryKey() {
		return TruckInbound::$_primaryKey;
	}

	/**
	 * Returns true if the primary key column for this table is auto-increment
	 * @return bool
	 */
	static function isAutoIncrement() {
		return TruckInbound::$_isAutoIncrement;
	}

	/**
	 * Searches the database for a row with the ID(primary key) that matches
	 * the one input.
	 * @return TruckInbound
	 */
	static function retrieveByPK($the_pk) {
		return TruckInbound::retrieveByPKs($the_pk);
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return TruckInbound
	 */
	static function retrieveByPKs($id) {
		if (null === $id) {
			return null;
		}
		$pool_instance = TruckInbound::retrieveFromPool($id);
		if (null !== $pool_instance) {
			return $pool_instance;
		}
		$conn = TruckInbound::getConnection();
		$q = new Query;
		$q->add('id', $id);
		return array_shift(TruckInbound::doSelect($q, true));
	}

	/**
	 * Searches the database for a row with a id	 * value that matches the one provided
	 * @return TruckInbound
	 */
	static function retrieveById($value) {
		return TruckInbound::retrieveByPK($value);
	}

	/**
	 * Searches the database for a row with a agent	 * value that matches the one provided
	 * @return TruckInbound
	 */
	static function retrieveByAgent($value) {
		return TruckInbound::retrieveByColumn('agent', $value);
	}

	/**
	 * Searches the database for a row with a unit	 * value that matches the one provided
	 * @return TruckInbound
	 */
	static function retrieveByUnit($value) {
		return TruckInbound::retrieveByColumn('unit', $value);
	}

	/**
	 * Searches the database for a row with a truck_number	 * value that matches the one provided
	 * @return TruckInbound
	 */
	static function retrieveByTruckNumber($value) {
		return TruckInbound::retrieveByColumn('truck_number', $value);
	}

	/**
	 * Searches the database for a row with a equipment	 * value that matches the one provided
	 * @return TruckInbound
	 */
	static function retrieveByEquipment($value) {
		return TruckInbound::retrieveByColumn('equipment', $value);
	}

	/**
	 * Searches the database for a row with a driver	 * value that matches the one provided
	 * @return TruckInbound
	 */
	static function retrieveByDriver($value) {
		return TruckInbound::retrieveByColumn('driver', $value);
	}

	/**
	 * Searches the database for a row with a cell	 * value that matches the one provided
	 * @return TruckInbound
	 */
	static function retrieveByCell($value) {
		return TruckInbound::retrieveByColumn('cell', $value);
	}

	/**
	 * Searches the database for a row with a origin_city	 * value that matches the one provided
	 * @return TruckInbound
	 */
	static function retrieveByOriginCity($value) {
		return TruckInbound::retrieveByColumn('origin_city', $value);
	}

	/**
	 * Searches the database for a row with a origin_state	 * value that matches the one provided
	 * @return TruckInbound
	 */
	static function retrieveByOriginState($value) {
		return TruckInbound::retrieveByColumn('origin_state', $value);
	}

	/**
	 * Searches the database for a row with a dest_city	 * value that matches the one provided
	 * @return TruckInbound
	 */
	static function retrieveByDestCity($value) {
		return TruckInbound::retrieveByColumn('dest_city', $value);
	}

	/**
	 * Searches the database for a row with a dest_state	 * value that matches the one provided
	 * @return TruckInbound
	 */
	static function retrieveByDestState($value) {
		return TruckInbound::retrieveByColumn('dest_state', $value);
	}

	/**
	 * Searches the database for a row with a delivery_month	 * value that matches the one provided
	 * @return TruckInbound
	 */
	static function retrieveByDeliveryMonth($value) {
		return TruckInbound::retrieveByColumn('delivery_month', $value);
	}

	/**
	 * Searches the database for a row with a delivery_day	 * value that matches the one provided
	 * @return TruckInbound
	 */
	static function retrieveByDeliveryDay($value) {
		return TruckInbound::retrieveByColumn('delivery_day', $value);
	}

	/**
	 * Searches the database for a row with a delivery_date	 * value that matches the one provided
	 * @return TruckInbound
	 */
	static function retrieveByDeliveryDate($value) {
		return TruckInbound::retrieveByColumn('delivery_date', $value);
	}

	/**
	 * Searches the database for a row with a comments	 * value that matches the one provided
	 * @return TruckInbound
	 */
	static function retrieveByComments($value) {
		return TruckInbound::retrieveByColumn('comments', $value);
	}

	/**
	 * Searches the database for a row with a report_date	 * value that matches the one provided
	 * @return TruckInbound
	 */
	static function retrieveByReportDate($value) {
		return TruckInbound::retrieveByColumn('report_date', $value);
	}

	/**
	 * Searches the database for a row with a telephone	 * value that matches the one provided
	 * @return TruckInbound
	 */
	static function retrieveByTelephone($value) {
		return TruckInbound::retrieveByColumn('telephone', $value);
	}

	static function retrieveByColumn($field, $value) {
		$conn = TruckInbound::getConnection();
		return array_shift(TruckInbound::doSelect(Query::create()->add($field, $value)->setLimit(1)->order('id')));
	}

	/**
	 * Populates and returns an instance of TruckInbound with the
	 * first result of a query.  If the query returns no results,
	 * returns null.
	 * @return TruckInbound
	 */
	static function fetchSingle($query_string, $write_cache = true) {
		return array_shift(TruckInbound::fetch($query_string, $write_cache));
	}

	/**
	 * Populates and returns an array of TruckInbound objects with the
	 * results of a query.  If the query returns no results,
	 * returns an empty Array.
	 * @return TruckInbound[]
	 */
	static function fetch($query_string, $write_cache = false) {
		$conn = TruckInbound::getConnection();
		$result = $conn->query($query_string);
		return TruckInbound::fromResult($result, 'TruckInbound', $write_cache);
	}

	/**
	 * Returns an array of TruckInbound objects from
	 * a PDOStatement(query result).
	 *
	 * @see BaseModel::fromResult
	 */
	static function fromResult(PDOStatement $result, $class = 'TruckInbound', $write_cache = false) {
		return baseModel::fromResult($result, $class, $write_cache);
	}

	/**
	 * Casts values of int fields to (int)
	 * @return TruckInbound
	 */
	function castInts() {
		$this->id = (null === $this->id) ? null : (int) $this->id;
		return $this;
	}

	/**
	 * Add (or replace) to the instance pool.
	 *
	 * @param TruckInbound $object
	 * @return void
	 */
	static function insertIntoPool(TruckInbound $object) {
		if (TruckInbound::$_instancePoolCount > TruckInbound::MAX_INSTANCE_POOL_SIZE) {
			return;
		}

		TruckInbound::$_instancePool[implode('-', $object->getPrimaryKeyValues())] = clone $object;
		++TruckInbound::$_instancePoolCount;
	}

	/**
	 * Return the cached instance from the pool.
	 *
	 * @param mixed $pk Primary Key
	 * @return TruckInbound
	 */
	static function retrieveFromPool($pk) {
		if (null === $pk) {
			return null;
		}
		if (array_key_exists($pk, TruckInbound::$_instancePool)) {
			return clone TruckInbound::$_instancePool[$pk];
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

		if (array_key_exists($pk, TruckInbound::$_instancePool)) {
			unset(TruckInbound::$_instancePool[$pk]);
			--TruckInbound::$_instancePoolCount;
		}
	}

	/**
	 * Empty the instance pool.
	 *
	 * @return void
	 */
	static function flushPool() {
		TruckInbound::$_instancePool = array();
	}

	/**
	 * Returns an array of all TruckInbound objects in the database.
	 * $extra SQL can be appended to the query to LIMIT, SORT, and/or GROUP results.
	 * If there are no results, returns an empty Array.
	 * @param $extra string
	 * @return TruckInbound[]
	 */
	static function getAll($extra = null, $write_cache = false) {
		$conn = TruckInbound::getConnection();
		$table_quoted = $conn->quoteIdentifier(TruckInbound::getTableName());
		return TruckInbound::fetch("SELECT * FROM $table_quoted $extra ", $write_cache);
	}

	/**
	 * @return int
	 */
	static function doCount(Query $q = null) {
		$q = $q ? clone $q : new Query;
		$conn = TruckInbound::getConnection();
		if (!$q->getTable() || TruckInbound::getTableName() != $q->getTable()) {
			$q->setTable(TruckInbound::getTableName());
		}
		return $q->doCount($conn);
	}

	/**
	 * @param Query $q
	 * @param bool $dump_cache
	 * @return int
	 */
	static function doDelete(Query $q, $dump_cache = true) {
		$conn = TruckInbound::getConnection();
		$q = clone $q;
		if (!$q->getTable() || TruckInbound::getTableName() != $q->getTable()) {
			$q->setTable(TruckInbound::getTableName());
		}
		$result = $q->doDelete($conn);

		if ($dump_cache) {
			TruckInbound::$_instancePool = array();
		}

		return $result;
	}

	/**
	 * @param Query $q The Query object that creates the SELECT query string
	 * @param bool $write_cache Whether or not to store results in instance pool
	 * @param array $additional_classes Array of additional classes for fromResult to instantiate as properties
	 * @return TruckInbound[]
	 */
	static function doSelect(Query $q = null, $write_cache = false, $additional_classes = null) {
		if (is_array($additional_classes)) {
			array_unshift($additional_classes, 'TruckInbound');
			$class = $additional_classes;
		} else {
			$class = 'TruckInbound';
		}

		return TruckInbound::fromResult(self::doSelectRS($q), $class, $write_cache);
	}

	/**
	 * Executes a select query and returns the PDO result
	 * @return PDOStatement
	 */
	static function doSelectRS(Query $q = null) {
		$q = $q ? clone $q : new Query;
		$conn = TruckInbound::getConnection();
		if (!$q->getTable() || TruckInbound::getTableName() != $q->getTable()) {
			$q->setTable(TruckInbound::getTableName());
		}

		return $q->doSelect($conn);
	}

	/**
	 * @return TruckInbound[]
	 */
	static function doSelectJoinAll(Query $q = null, $write_cache = false, $join_type = Query::LEFT_JOIN) {
		$q = $q ? clone $q : new Query;
		$columns = $q->getColumns();
		$classes = array();
		$alias = $q->getAlias();
		$this_table = $alias ? $alias : TruckInbound::getTableName();
		if (!$columns) {
			$columns[] = $this_table . '.*';
		}

		$q->setColumns($columns);
		return TruckInbound::doSelect($q, $write_cache, $classes);
	}

	/**
	 * Returns true if the column values validate.
	 * @return bool
	 */
	function validate() {
		$this->_validationErrors = array();
		if (null === $this->getagent()) {
			$this->_validationErrors[] = 'agent must not be null';
		}
		if (null === $this->getunit()) {
			$this->_validationErrors[] = 'unit must not be null';
		}
		if (null === $this->gettruck_number()) {
			$this->_validationErrors[] = 'truck_number must not be null';
		}
		if (null === $this->getequipment()) {
			$this->_validationErrors[] = 'equipment must not be null';
		}
		if (null === $this->getdriver()) {
			$this->_validationErrors[] = 'driver must not be null';
		}
		if (null === $this->getcell()) {
			$this->_validationErrors[] = 'cell must not be null';
		}
		if (null === $this->getorigin_city()) {
			$this->_validationErrors[] = 'origin_city must not be null';
		}
		if (null === $this->getorigin_state()) {
			$this->_validationErrors[] = 'origin_state must not be null';
		}
		if (null === $this->getdest_city()) {
			$this->_validationErrors[] = 'dest_city must not be null';
		}
		if (null === $this->getdest_state()) {
			$this->_validationErrors[] = 'dest_state must not be null';
		}
		if (null === $this->getdelivery_month()) {
			$this->_validationErrors[] = 'delivery_month must not be null';
		}
		if (null === $this->getdelivery_day()) {
			$this->_validationErrors[] = 'delivery_day must not be null';
		}
		if (null === $this->getdelivery_date()) {
			$this->_validationErrors[] = 'delivery_date must not be null';
		}
		if (null === $this->getcomments()) {
			$this->_validationErrors[] = 'comments must not be null';
		}
		if (null === $this->getreport_date()) {
			$this->_validationErrors[] = 'report_date must not be null';
		}
		return 0 === count($this->_validationErrors);
	}

}
