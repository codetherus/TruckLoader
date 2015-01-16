<?php
/**
 *		Created by Dan Blaisdell's DABL
 *		Do not alter base files, as they will be overwritten.
 *		To alter the objects, alter the extended classes in
 *		the 'models' folder.
 *
 */
abstract class baseUploadsEquipmentMap extends ApplicationModel {

	/**
	 * Name of the table
	 * @var string
	 */
	protected static $_tableName = 'uploads_equipment_map';

	/**
	 * Cache of objects retrieved from the database
	 * @var UploadsEquipmentMap[]
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
		'spreadsheet_code',
		'truckstop_code',
		'dat_code',
	);

	/**
	 * array of all column types
	 * @var string[]
	 */
	protected static $_columnTypes = array(
		'id' => BaseModel::COLUMN_TYPE_BIGINT,
		'spreadsheet_code' => BaseModel::COLUMN_TYPE_VARCHAR,
		'truckstop_code' => BaseModel::COLUMN_TYPE_VARCHAR,
		'dat_code' => BaseModel::COLUMN_TYPE_VARCHAR,
	);

	/**
	 * `id` BIGINT NOT NULL DEFAULT ''
	 * @var string
	 */
	protected $id;

	/**
	 * `spreadsheet_code` VARCHAR NOT NULL
	 * @var string
	 */
	protected $spreadsheet_code;

	/**
	 * `truckstop_code` VARCHAR NOT NULL
	 * @var string
	 */
	protected $truckstop_code;

	/**
	 * `dat_code` VARCHAR NOT NULL
	 * @var string
	 */
	protected $dat_code;

	/**
	 * Gets the value of the id field
	 */
	function getId() {
		return $this->id;
	}

	/**
	 * Sets the value of the id field
	 * @return UploadsEquipmentMap
	 */
	function setId($value) {
		return $this->setColumnValue('id', $value, BaseModel::COLUMN_TYPE_BIGINT);
	}

	/**
	 * Gets the value of the spreadsheet_code field
	 */
	function getSpreadsheet_code() {
		return $this->spreadsheet_code;
	}

	/**
	 * Sets the value of the spreadsheet_code field
	 * @return UploadsEquipmentMap
	 */
	function setSpreadsheet_code($value) {
		return $this->setColumnValue('spreadsheet_code', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the spreadsheet_code field
	 */
	function getSpreadsheetCode() {
		return $this->getSpreadsheet_code();
	}

	/**
	 * Sets the value of the spreadsheet_code field
	 * @return UploadsEquipmentMap
	 */
	function setSpreadsheetCode($value) {
		return $this->setSpreadsheet_code($value);
	}

	/**
	 * Gets the value of the truckstop_code field
	 */
	function getTruckstop_code() {
		return $this->truckstop_code;
	}

	/**
	 * Sets the value of the truckstop_code field
	 * @return UploadsEquipmentMap
	 */
	function setTruckstop_code($value) {
		return $this->setColumnValue('truckstop_code', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the truckstop_code field
	 */
	function getTruckstopCode() {
		return $this->getTruckstop_code();
	}

	/**
	 * Sets the value of the truckstop_code field
	 * @return UploadsEquipmentMap
	 */
	function setTruckstopCode($value) {
		return $this->setTruckstop_code($value);
	}

	/**
	 * Gets the value of the dat_code field
	 */
	function getDat_code() {
		return $this->dat_code;
	}

	/**
	 * Sets the value of the dat_code field
	 * @return UploadsEquipmentMap
	 */
	function setDat_code($value) {
		return $this->setColumnValue('dat_code', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the dat_code field
	 */
	function getDatCode() {
		return $this->getDat_code();
	}

	/**
	 * Sets the value of the dat_code field
	 * @return UploadsEquipmentMap
	 */
	function setDatCode($value) {
		return $this->setDat_code($value);
	}

	/**
	 * @return DABLPDO
	 */
	static function getConnection() {
		return DBManager::getConnection('default_mysqll');
	}

	/**
	 * @return UploadsEquipmentMap
	 */
	static function create() {
		return new UploadsEquipmentMap();
	}

	/**
	 * Returns String representation of table name
	 * @return string
	 */
	static function getTableName() {
		return UploadsEquipmentMap::$_tableName;
	}

	/**
	 * Access to array of column names
	 * @return array
	 */
	static function getColumnNames() {
		return UploadsEquipmentMap::$_columnNames;
	}

	/**
	 * Access to array of column types, indexed by column name
	 * @return array
	 */
	static function getColumnTypes() {
		return UploadsEquipmentMap::$_columnTypes;
	}

	/**
	 * Get the type of a column
	 * @return array
	 */
	static function getColumnType($column_name) {
		return UploadsEquipmentMap::$_columnTypes[$column_name];
	}

	/**
	 * @return bool
	 */
	static function hasColumn($column_name) {
		static $lower_case_columns = null;
		if (null === $lower_case_columns) {
			$lower_case_columns = array_map('strtolower', UploadsEquipmentMap::$_columnNames);
		}
		return in_array(strtolower($column_name), $lower_case_columns);
	}

	/**
	 * Access to array of primary keys
	 * @return array
	 */
	static function getPrimaryKeys() {
		return UploadsEquipmentMap::$_primaryKeys;
	}

	/**
	 * Access to name of primary key
	 * @return array
	 */
	static function getPrimaryKey() {
		return UploadsEquipmentMap::$_primaryKey;
	}

	/**
	 * Returns true if the primary key column for this table is auto-increment
	 * @return bool
	 */
	static function isAutoIncrement() {
		return UploadsEquipmentMap::$_isAutoIncrement;
	}

	/**
	 * Searches the database for a row with the ID(primary key) that matches
	 * the one input.
	 * @return UploadsEquipmentMap
	 */
	static function retrieveByPK($the_pk) {
		return UploadsEquipmentMap::retrieveByPKs($the_pk);
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return UploadsEquipmentMap
	 */
	static function retrieveByPKs($id) {
		if (null === $id) {
			return null;
		}
		$pool_instance = UploadsEquipmentMap::retrieveFromPool($id);
		if (null !== $pool_instance) {
			return $pool_instance;
		}
		$conn = UploadsEquipmentMap::getConnection();
		$q = new Query;
		$q->add('id', $id);
		return array_shift(UploadsEquipmentMap::doSelect($q, true));
	}

	/**
	 * Searches the database for a row with a id	 * value that matches the one provided
	 * @return UploadsEquipmentMap
	 */
	static function retrieveById($value) {
		return UploadsEquipmentMap::retrieveByPK($value);
	}

	/**
	 * Searches the database for a row with a spreadsheet_code	 * value that matches the one provided
	 * @return UploadsEquipmentMap
	 */
	static function retrieveBySpreadsheetCode($value) {
		return UploadsEquipmentMap::retrieveByColumn('spreadsheet_code', $value);
	}

	/**
	 * Searches the database for a row with a truckstop_code	 * value that matches the one provided
	 * @return UploadsEquipmentMap
	 */
	static function retrieveByTruckstopCode($value) {
		return UploadsEquipmentMap::retrieveByColumn('truckstop_code', $value);
	}

	/**
	 * Searches the database for a row with a dat_code	 * value that matches the one provided
	 * @return UploadsEquipmentMap
	 */
	static function retrieveByDatCode($value) {
		return UploadsEquipmentMap::retrieveByColumn('dat_code', $value);
	}

	static function retrieveByColumn($field, $value) {
		$conn = UploadsEquipmentMap::getConnection();
		return array_shift(UploadsEquipmentMap::doSelect(Query::create()->add($field, $value)->setLimit(1)->order('id')));
	}

	/**
	 * Populates and returns an instance of UploadsEquipmentMap with the
	 * first result of a query.  If the query returns no results,
	 * returns null.
	 * @return UploadsEquipmentMap
	 */
	static function fetchSingle($query_string, $write_cache = true) {
		return array_shift(UploadsEquipmentMap::fetch($query_string, $write_cache));
	}

	/**
	 * Populates and returns an array of UploadsEquipmentMap objects with the
	 * results of a query.  If the query returns no results,
	 * returns an empty Array.
	 * @return UploadsEquipmentMap[]
	 */
	static function fetch($query_string, $write_cache = false) {
		$conn = UploadsEquipmentMap::getConnection();
		$result = $conn->query($query_string);
		return UploadsEquipmentMap::fromResult($result, 'UploadsEquipmentMap', $write_cache);
	}

	/**
	 * Returns an array of UploadsEquipmentMap objects from
	 * a PDOStatement(query result).
	 *
	 * @see BaseModel::fromResult
	 */
	static function fromResult(PDOStatement $result, $class = 'UploadsEquipmentMap', $write_cache = false) {
		return baseModel::fromResult($result, $class, $write_cache);
	}

	/**
	 * Casts values of int fields to (int)
	 * @return UploadsEquipmentMap
	 */
	function castInts() {
		$this->id = (null === $this->id) ? null : (int) $this->id;
		return $this;
	}

	/**
	 * Add (or replace) to the instance pool.
	 *
	 * @param UploadsEquipmentMap $object
	 * @return void
	 */
	static function insertIntoPool(UploadsEquipmentMap $object) {
		if (UploadsEquipmentMap::$_instancePoolCount > UploadsEquipmentMap::MAX_INSTANCE_POOL_SIZE) {
			return;
		}

		UploadsEquipmentMap::$_instancePool[implode('-', $object->getPrimaryKeyValues())] = clone $object;
		++UploadsEquipmentMap::$_instancePoolCount;
	}

	/**
	 * Return the cached instance from the pool.
	 *
	 * @param mixed $pk Primary Key
	 * @return UploadsEquipmentMap
	 */
	static function retrieveFromPool($pk) {
		if (null === $pk) {
			return null;
		}
		if (array_key_exists($pk, UploadsEquipmentMap::$_instancePool)) {
			return clone UploadsEquipmentMap::$_instancePool[$pk];
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

		if (array_key_exists($pk, UploadsEquipmentMap::$_instancePool)) {
			unset(UploadsEquipmentMap::$_instancePool[$pk]);
			--UploadsEquipmentMap::$_instancePoolCount;
		}
	}

	/**
	 * Empty the instance pool.
	 *
	 * @return void
	 */
	static function flushPool() {
		UploadsEquipmentMap::$_instancePool = array();
	}

	/**
	 * Returns an array of all UploadsEquipmentMap objects in the database.
	 * $extra SQL can be appended to the query to LIMIT, SORT, and/or GROUP results.
	 * If there are no results, returns an empty Array.
	 * @param $extra string
	 * @return UploadsEquipmentMap[]
	 */
	static function getAll($extra = null, $write_cache = false) {
		$conn = UploadsEquipmentMap::getConnection();
		$table_quoted = $conn->quoteIdentifier(UploadsEquipmentMap::getTableName());
		return UploadsEquipmentMap::fetch("SELECT * FROM $table_quoted $extra ", $write_cache);
	}

	/**
	 * @return int
	 */
	static function doCount(Query $q = null) {
		$q = $q ? clone $q : new Query;
		$conn = UploadsEquipmentMap::getConnection();
		if (!$q->getTable() || UploadsEquipmentMap::getTableName() != $q->getTable()) {
			$q->setTable(UploadsEquipmentMap::getTableName());
		}
		return $q->doCount($conn);
	}

	/**
	 * @param Query $q
	 * @param bool $dump_cache
	 * @return int
	 */
	static function doDelete(Query $q, $dump_cache = true) {
		$conn = UploadsEquipmentMap::getConnection();
		$q = clone $q;
		if (!$q->getTable() || UploadsEquipmentMap::getTableName() != $q->getTable()) {
			$q->setTable(UploadsEquipmentMap::getTableName());
		}
		$result = $q->doDelete($conn);

		if ($dump_cache) {
			UploadsEquipmentMap::$_instancePool = array();
		}

		return $result;
	}

	/**
	 * @param Query $q The Query object that creates the SELECT query string
	 * @param bool $write_cache Whether or not to store results in instance pool
	 * @param array $additional_classes Array of additional classes for fromResult to instantiate as properties
	 * @return UploadsEquipmentMap[]
	 */
	static function doSelect(Query $q = null, $write_cache = false, $additional_classes = null) {
		if (is_array($additional_classes)) {
			array_unshift($additional_classes, 'UploadsEquipmentMap');
			$class = $additional_classes;
		} else {
			$class = 'UploadsEquipmentMap';
		}

		return UploadsEquipmentMap::fromResult(self::doSelectRS($q), $class, $write_cache);
	}

	/**
	 * Executes a select query and returns the PDO result
	 * @return PDOStatement
	 */
	static function doSelectRS(Query $q = null) {
		$q = $q ? clone $q : new Query;
		$conn = UploadsEquipmentMap::getConnection();
		if (!$q->getTable() || UploadsEquipmentMap::getTableName() != $q->getTable()) {
			$q->setTable(UploadsEquipmentMap::getTableName());
		}

		return $q->doSelect($conn);
	}

	/**
	 * @return UploadsEquipmentMap[]
	 */
	static function doSelectJoinAll(Query $q = null, $write_cache = false, $join_type = Query::LEFT_JOIN) {
		$q = $q ? clone $q : new Query;
		$columns = $q->getColumns();
		$classes = array();
		$alias = $q->getAlias();
		$this_table = $alias ? $alias : UploadsEquipmentMap::getTableName();
		if (!$columns) {
			$columns[] = $this_table . '.*';
		}

		$q->setColumns($columns);
		return UploadsEquipmentMap::doSelect($q, $write_cache, $classes);
	}

	/**
	 * Returns true if the column values validate.
	 * @return bool
	 */
	function validate() {
		$this->_validationErrors = array();
		if (null === $this->getspreadsheet_code()) {
			$this->_validationErrors[] = 'spreadsheet_code must not be null';
		}
		if (null === $this->gettruckstop_code()) {
			$this->_validationErrors[] = 'truckstop_code must not be null';
		}
		if (null === $this->getdat_code()) {
			$this->_validationErrors[] = 'dat_code must not be null';
		}
		return 0 === count($this->_validationErrors);
	}

}
