<?php
/**
 *		Created by Dan Blaisdell's DABL
 *		Do not alter base files, as they will be overwritten.
 *		To alter the objects, alter the extended classes in
 *		the 'models' folder.
 *
 */
abstract class baseCallChecks extends ApplicationModel {

	/**
	 * Name of the table
	 * @var string
	 */
	protected static $_tableName = 'call_checks';

	/**
	 * Cache of objects retrieved from the database
	 * @var CallChecks[]
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
		'loadid',
		'driverid',
		'agentid',
		'time_stamp',
		'notes',
	);

	/**
	 * array of all column types
	 * @var string[]
	 */
	protected static $_columnTypes = array(
		'id' => BaseModel::COLUMN_TYPE_BIGINT,
		'loadid' => BaseModel::COLUMN_TYPE_BIGINT,
		'driverid' => BaseModel::COLUMN_TYPE_BIGINT,
		'agentid' => BaseModel::COLUMN_TYPE_BIGINT,
		'time_stamp' => BaseModel::COLUMN_TYPE_TIMESTAMP,
		'notes' => BaseModel::COLUMN_TYPE_LONGVARCHAR,
	);

	/**
	 * `id` BIGINT NOT NULL DEFAULT ''
	 * @var string
	 */
	protected $id;

	/**
	 * `loadid` BIGINT DEFAULT ''
	 * @var string
	 */
	protected $loadid;

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
	 * `time_stamp` TIMESTAMP
	 * @var string
	 */
	protected $time_stamp;

	/**
	 * `notes` LONGVARCHAR
	 * @var string
	 */
	protected $notes;

	/**
	 * Gets the value of the id field
	 */
	function getId() {
		return $this->id;
	}

	/**
	 * Sets the value of the id field
	 * @return CallChecks
	 */
	function setId($value) {
		return $this->setColumnValue('id', $value, BaseModel::COLUMN_TYPE_BIGINT);
	}

	/**
	 * Gets the value of the loadid field
	 */
	function getLoadid() {
		return $this->loadid;
	}

	/**
	 * Sets the value of the loadid field
	 * @return CallChecks
	 */
	function setLoadid($value) {
		return $this->setColumnValue('loadid', $value, BaseModel::COLUMN_TYPE_BIGINT);
	}

	/**
	 * Gets the value of the driverid field
	 */
	function getDriverid() {
		return $this->driverid;
	}

	/**
	 * Sets the value of the driverid field
	 * @return CallChecks
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
	 * @return CallChecks
	 */
	function setAgentid($value) {
		return $this->setColumnValue('agentid', $value, BaseModel::COLUMN_TYPE_BIGINT);
	}

	/**
	 * Gets the value of the time_stamp field
	 */
	function getTime_stamp($format = null) {
		if (null === $this->time_stamp || null === $format) {
			return $this->time_stamp;
		}
		if (0 === strpos($this->time_stamp, '0000-00-00')) {
			return null;
		}
		return date($format, strtotime($this->time_stamp));
	}

	/**
	 * Sets the value of the time_stamp field
	 * @return CallChecks
	 */
	function setTime_stamp($value) {
		return $this->setColumnValue('time_stamp', $value, BaseModel::COLUMN_TYPE_TIMESTAMP);
	}

	/**
	 * Gets the value of the time_stamp field
	 */
	function getTimeStamp($format = null) {
		return $this->getTime_stamp($format);
	}

	/**
	 * Sets the value of the time_stamp field
	 * @return CallChecks
	 */
	function setTimeStamp($value) {
		return $this->setTime_stamp($value);
	}

	/**
	 * Gets the value of the notes field
	 */
	function getNotes() {
		return $this->notes;
	}

	/**
	 * Sets the value of the notes field
	 * @return CallChecks
	 */
	function setNotes($value) {
		return $this->setColumnValue('notes', $value, BaseModel::COLUMN_TYPE_LONGVARCHAR);
	}

	/**
	 * @return DABLPDO
	 */
	static function getConnection() {
		return DBManager::getConnection('default_mysqll');
	}

	/**
	 * @return CallChecks
	 */
	static function create() {
		return new CallChecks();
	}

	/**
	 * Returns String representation of table name
	 * @return string
	 */
	static function getTableName() {
		return CallChecks::$_tableName;
	}

	/**
	 * Access to array of column names
	 * @return array
	 */
	static function getColumnNames() {
		return CallChecks::$_columnNames;
	}

	/**
	 * Access to array of column types, indexed by column name
	 * @return array
	 */
	static function getColumnTypes() {
		return CallChecks::$_columnTypes;
	}

	/**
	 * Get the type of a column
	 * @return array
	 */
	static function getColumnType($column_name) {
		return CallChecks::$_columnTypes[$column_name];
	}

	/**
	 * @return bool
	 */
	static function hasColumn($column_name) {
		static $lower_case_columns = null;
		if (null === $lower_case_columns) {
			$lower_case_columns = array_map('strtolower', CallChecks::$_columnNames);
		}
		return in_array(strtolower($column_name), $lower_case_columns);
	}

	/**
	 * Access to array of primary keys
	 * @return array
	 */
	static function getPrimaryKeys() {
		return CallChecks::$_primaryKeys;
	}

	/**
	 * Access to name of primary key
	 * @return array
	 */
	static function getPrimaryKey() {
		return CallChecks::$_primaryKey;
	}

	/**
	 * Returns true if the primary key column for this table is auto-increment
	 * @return bool
	 */
	static function isAutoIncrement() {
		return CallChecks::$_isAutoIncrement;
	}

	/**
	 * Searches the database for a row with the ID(primary key) that matches
	 * the one input.
	 * @return CallChecks
	 */
	static function retrieveByPK($the_pk) {
		return CallChecks::retrieveByPKs($the_pk);
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return CallChecks
	 */
	static function retrieveByPKs($id) {
		if (null === $id) {
			return null;
		}
		$pool_instance = CallChecks::retrieveFromPool($id);
		if (null !== $pool_instance) {
			return $pool_instance;
		}
		$conn = CallChecks::getConnection();
		$q = new Query;
		$q->add('id', $id);
		return array_shift(CallChecks::doSelect($q, true));
	}

	/**
	 * Searches the database for a row with a id	 * value that matches the one provided
	 * @return CallChecks
	 */
	static function retrieveById($value) {
		return CallChecks::retrieveByPK($value);
	}

	/**
	 * Searches the database for a row with a loadid	 * value that matches the one provided
	 * @return CallChecks
	 */
	static function retrieveByLoadid($value) {
		return CallChecks::retrieveByColumn('loadid', $value);
	}

	/**
	 * Searches the database for a row with a driverid	 * value that matches the one provided
	 * @return CallChecks
	 */
	static function retrieveByDriverid($value) {
		return CallChecks::retrieveByColumn('driverid', $value);
	}

	/**
	 * Searches the database for a row with a agentid	 * value that matches the one provided
	 * @return CallChecks
	 */
	static function retrieveByAgentid($value) {
		return CallChecks::retrieveByColumn('agentid', $value);
	}

	/**
	 * Searches the database for a row with a time_stamp	 * value that matches the one provided
	 * @return CallChecks
	 */
	static function retrieveByTimeStamp($value) {
		return CallChecks::retrieveByColumn('time_stamp', $value);
	}

	/**
	 * Searches the database for a row with a notes	 * value that matches the one provided
	 * @return CallChecks
	 */
	static function retrieveByNotes($value) {
		return CallChecks::retrieveByColumn('notes', $value);
	}

	static function retrieveByColumn($field, $value) {
		$conn = CallChecks::getConnection();
		return array_shift(CallChecks::doSelect(Query::create()->add($field, $value)->setLimit(1)->order('id')));
	}

	/**
	 * Populates and returns an instance of CallChecks with the
	 * first result of a query.  If the query returns no results,
	 * returns null.
	 * @return CallChecks
	 */
	static function fetchSingle($query_string, $write_cache = true) {
		return array_shift(CallChecks::fetch($query_string, $write_cache));
	}

	/**
	 * Populates and returns an array of CallChecks objects with the
	 * results of a query.  If the query returns no results,
	 * returns an empty Array.
	 * @return CallChecks[]
	 */
	static function fetch($query_string, $write_cache = false) {
		$conn = CallChecks::getConnection();
		$result = $conn->query($query_string);
		return CallChecks::fromResult($result, 'CallChecks', $write_cache);
	}

	/**
	 * Returns an array of CallChecks objects from
	 * a PDOStatement(query result).
	 *
	 * @see BaseModel::fromResult
	 */
	static function fromResult(PDOStatement $result, $class = 'CallChecks', $write_cache = false) {
		return baseModel::fromResult($result, $class, $write_cache);
	}

	/**
	 * Casts values of int fields to (int)
	 * @return CallChecks
	 */
	function castInts() {
		$this->id = (null === $this->id) ? null : (int) $this->id;
		$this->loadid = (null === $this->loadid) ? null : (int) $this->loadid;
		$this->driverid = (null === $this->driverid) ? null : (int) $this->driverid;
		$this->agentid = (null === $this->agentid) ? null : (int) $this->agentid;
		return $this;
	}

	/**
	 * Add (or replace) to the instance pool.
	 *
	 * @param CallChecks $object
	 * @return void
	 */
	static function insertIntoPool(CallChecks $object) {
		if (CallChecks::$_instancePoolCount > CallChecks::MAX_INSTANCE_POOL_SIZE) {
			return;
		}

		CallChecks::$_instancePool[implode('-', $object->getPrimaryKeyValues())] = clone $object;
		++CallChecks::$_instancePoolCount;
	}

	/**
	 * Return the cached instance from the pool.
	 *
	 * @param mixed $pk Primary Key
	 * @return CallChecks
	 */
	static function retrieveFromPool($pk) {
		if (null === $pk) {
			return null;
		}
		if (array_key_exists($pk, CallChecks::$_instancePool)) {
			return clone CallChecks::$_instancePool[$pk];
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

		if (array_key_exists($pk, CallChecks::$_instancePool)) {
			unset(CallChecks::$_instancePool[$pk]);
			--CallChecks::$_instancePoolCount;
		}
	}

	/**
	 * Empty the instance pool.
	 *
	 * @return void
	 */
	static function flushPool() {
		CallChecks::$_instancePool = array();
	}

	/**
	 * Returns an array of all CallChecks objects in the database.
	 * $extra SQL can be appended to the query to LIMIT, SORT, and/or GROUP results.
	 * If there are no results, returns an empty Array.
	 * @param $extra string
	 * @return CallChecks[]
	 */
	static function getAll($extra = null, $write_cache = false) {
		$conn = CallChecks::getConnection();
		$table_quoted = $conn->quoteIdentifier(CallChecks::getTableName());
		return CallChecks::fetch("SELECT * FROM $table_quoted $extra ", $write_cache);
	}

	/**
	 * @return int
	 */
	static function doCount(Query $q = null) {
		$q = $q ? clone $q : new Query;
		$conn = CallChecks::getConnection();
		if (!$q->getTable() || CallChecks::getTableName() != $q->getTable()) {
			$q->setTable(CallChecks::getTableName());
		}
		return $q->doCount($conn);
	}

	/**
	 * @param Query $q
	 * @param bool $dump_cache
	 * @return int
	 */
	static function doDelete(Query $q, $dump_cache = true) {
		$conn = CallChecks::getConnection();
		$q = clone $q;
		if (!$q->getTable() || CallChecks::getTableName() != $q->getTable()) {
			$q->setTable(CallChecks::getTableName());
		}
		$result = $q->doDelete($conn);

		if ($dump_cache) {
			CallChecks::$_instancePool = array();
		}

		return $result;
	}

	/**
	 * @param Query $q The Query object that creates the SELECT query string
	 * @param bool $write_cache Whether or not to store results in instance pool
	 * @param array $additional_classes Array of additional classes for fromResult to instantiate as properties
	 * @return CallChecks[]
	 */
	static function doSelect(Query $q = null, $write_cache = false, $additional_classes = null) {
		if (is_array($additional_classes)) {
			array_unshift($additional_classes, 'CallChecks');
			$class = $additional_classes;
		} else {
			$class = 'CallChecks';
		}

		return CallChecks::fromResult(self::doSelectRS($q), $class, $write_cache);
	}

	/**
	 * Executes a select query and returns the PDO result
	 * @return PDOStatement
	 */
	static function doSelectRS(Query $q = null) {
		$q = $q ? clone $q : new Query;
		$conn = CallChecks::getConnection();
		if (!$q->getTable() || CallChecks::getTableName() != $q->getTable()) {
			$q->setTable(CallChecks::getTableName());
		}

		return $q->doSelect($conn);
	}

	/**
	 * @return CallChecks[]
	 */
	static function doSelectJoinAll(Query $q = null, $write_cache = false, $join_type = Query::LEFT_JOIN) {
		$q = $q ? clone $q : new Query;
		$columns = $q->getColumns();
		$classes = array();
		$alias = $q->getAlias();
		$this_table = $alias ? $alias : CallChecks::getTableName();
		if (!$columns) {
			$columns[] = $this_table . '.*';
		}

		$q->setColumns($columns);
		return CallChecks::doSelect($q, $write_cache, $classes);
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
