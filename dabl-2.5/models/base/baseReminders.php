<?php
/**
 *		Created by Dan Blaisdell's DABL
 *		Do not alter base files, as they will be overwritten.
 *		To alter the objects, alter the extended classes in
 *		the 'models' folder.
 *
 */
abstract class baseReminders extends ApplicationModel {

	/**
	 * Name of the table
	 * @var string
	 */
	protected static $_tableName = 'reminders';

	/**
	 * Cache of objects retrieved from the database
	 * @var Reminders[]
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
		'subject',
		'message',
		'frequency',
		'startdate',
		'enddate',
		'lastdate',
		'nextdate',
		'driverid',
		'loadid',
	);

	/**
	 * array of all column types
	 * @var string[]
	 */
	protected static $_columnTypes = array(
		'id' => BaseModel::COLUMN_TYPE_BIGINT,
		'userid' => BaseModel::COLUMN_TYPE_BIGINT,
		'subject' => BaseModel::COLUMN_TYPE_VARCHAR,
		'message' => BaseModel::COLUMN_TYPE_LONGVARCHAR,
		'frequency' => BaseModel::COLUMN_TYPE_VARCHAR,
		'startdate' => BaseModel::COLUMN_TYPE_TIMESTAMP,
		'enddate' => BaseModel::COLUMN_TYPE_TIMESTAMP,
		'lastdate' => BaseModel::COLUMN_TYPE_TIMESTAMP,
		'nextdate' => BaseModel::COLUMN_TYPE_TIMESTAMP,
		'driverid' => BaseModel::COLUMN_TYPE_BIGINT,
		'loadid' => BaseModel::COLUMN_TYPE_BIGINT,
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
	 * `subject` VARCHAR
	 * @var string
	 */
	protected $subject;

	/**
	 * `message` LONGVARCHAR
	 * @var string
	 */
	protected $message;

	/**
	 * `frequency` VARCHAR
	 * @var string
	 */
	protected $frequency;

	/**
	 * `startdate` TIMESTAMP
	 * @var string
	 */
	protected $startdate;

	/**
	 * `enddate` TIMESTAMP
	 * @var string
	 */
	protected $enddate;

	/**
	 * `lastdate` TIMESTAMP
	 * @var string
	 */
	protected $lastdate;

	/**
	 * `nextdate` TIMESTAMP
	 * @var string
	 */
	protected $nextdate;

	/**
	 * `driverid` BIGINT DEFAULT ''
	 * @var string
	 */
	protected $driverid;

	/**
	 * `loadid` BIGINT DEFAULT ''
	 * @var string
	 */
	protected $loadid;

	/**
	 * Gets the value of the id field
	 */
	function getId() {
		return $this->id;
	}

	/**
	 * Sets the value of the id field
	 * @return Reminders
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
	 * @return Reminders
	 */
	function setUserid($value) {
		return $this->setColumnValue('userid', $value, BaseModel::COLUMN_TYPE_BIGINT);
	}

	/**
	 * Gets the value of the subject field
	 */
	function getSubject() {
		return $this->subject;
	}

	/**
	 * Sets the value of the subject field
	 * @return Reminders
	 */
	function setSubject($value) {
		return $this->setColumnValue('subject', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the message field
	 */
	function getMessage() {
		return $this->message;
	}

	/**
	 * Sets the value of the message field
	 * @return Reminders
	 */
	function setMessage($value) {
		return $this->setColumnValue('message', $value, BaseModel::COLUMN_TYPE_LONGVARCHAR);
	}

	/**
	 * Gets the value of the frequency field
	 */
	function getFrequency() {
		return $this->frequency;
	}

	/**
	 * Sets the value of the frequency field
	 * @return Reminders
	 */
	function setFrequency($value) {
		return $this->setColumnValue('frequency', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the startdate field
	 */
	function getStartdate($format = null) {
		if (null === $this->startdate || null === $format) {
			return $this->startdate;
		}
		if (0 === strpos($this->startdate, '0000-00-00')) {
			return null;
		}
		return date($format, strtotime($this->startdate));
	}

	/**
	 * Sets the value of the startdate field
	 * @return Reminders
	 */
	function setStartdate($value) {
		return $this->setColumnValue('startdate', $value, BaseModel::COLUMN_TYPE_TIMESTAMP);
	}

	/**
	 * Gets the value of the enddate field
	 */
	function getEnddate($format = null) {
		if (null === $this->enddate || null === $format) {
			return $this->enddate;
		}
		if (0 === strpos($this->enddate, '0000-00-00')) {
			return null;
		}
		return date($format, strtotime($this->enddate));
	}

	/**
	 * Sets the value of the enddate field
	 * @return Reminders
	 */
	function setEnddate($value) {
		return $this->setColumnValue('enddate', $value, BaseModel::COLUMN_TYPE_TIMESTAMP);
	}

	/**
	 * Gets the value of the lastdate field
	 */
	function getLastdate($format = null) {
		if (null === $this->lastdate || null === $format) {
			return $this->lastdate;
		}
		if (0 === strpos($this->lastdate, '0000-00-00')) {
			return null;
		}
		return date($format, strtotime($this->lastdate));
	}

	/**
	 * Sets the value of the lastdate field
	 * @return Reminders
	 */
	function setLastdate($value) {
		return $this->setColumnValue('lastdate', $value, BaseModel::COLUMN_TYPE_TIMESTAMP);
	}

	/**
	 * Gets the value of the nextdate field
	 */
	function getNextdate($format = null) {
		if (null === $this->nextdate || null === $format) {
			return $this->nextdate;
		}
		if (0 === strpos($this->nextdate, '0000-00-00')) {
			return null;
		}
		return date($format, strtotime($this->nextdate));
	}

	/**
	 * Sets the value of the nextdate field
	 * @return Reminders
	 */
	function setNextdate($value) {
		return $this->setColumnValue('nextdate', $value, BaseModel::COLUMN_TYPE_TIMESTAMP);
	}

	/**
	 * Gets the value of the driverid field
	 */
	function getDriverid() {
		return $this->driverid;
	}

	/**
	 * Sets the value of the driverid field
	 * @return Reminders
	 */
	function setDriverid($value) {
		return $this->setColumnValue('driverid', $value, BaseModel::COLUMN_TYPE_BIGINT);
	}

	/**
	 * Gets the value of the loadid field
	 */
	function getLoadid() {
		return $this->loadid;
	}

	/**
	 * Sets the value of the loadid field
	 * @return Reminders
	 */
	function setLoadid($value) {
		return $this->setColumnValue('loadid', $value, BaseModel::COLUMN_TYPE_BIGINT);
	}

	/**
	 * @return DABLPDO
	 */
	static function getConnection() {
		return DBManager::getConnection('default_mysqll');
	}

	/**
	 * @return Reminders
	 */
	static function create() {
		return new Reminders();
	}

	/**
	 * Returns String representation of table name
	 * @return string
	 */
	static function getTableName() {
		return Reminders::$_tableName;
	}

	/**
	 * Access to array of column names
	 * @return array
	 */
	static function getColumnNames() {
		return Reminders::$_columnNames;
	}

	/**
	 * Access to array of column types, indexed by column name
	 * @return array
	 */
	static function getColumnTypes() {
		return Reminders::$_columnTypes;
	}

	/**
	 * Get the type of a column
	 * @return array
	 */
	static function getColumnType($column_name) {
		return Reminders::$_columnTypes[$column_name];
	}

	/**
	 * @return bool
	 */
	static function hasColumn($column_name) {
		static $lower_case_columns = null;
		if (null === $lower_case_columns) {
			$lower_case_columns = array_map('strtolower', Reminders::$_columnNames);
		}
		return in_array(strtolower($column_name), $lower_case_columns);
	}

	/**
	 * Access to array of primary keys
	 * @return array
	 */
	static function getPrimaryKeys() {
		return Reminders::$_primaryKeys;
	}

	/**
	 * Access to name of primary key
	 * @return array
	 */
	static function getPrimaryKey() {
		return Reminders::$_primaryKey;
	}

	/**
	 * Returns true if the primary key column for this table is auto-increment
	 * @return bool
	 */
	static function isAutoIncrement() {
		return Reminders::$_isAutoIncrement;
	}

	/**
	 * Searches the database for a row with the ID(primary key) that matches
	 * the one input.
	 * @return Reminders
	 */
	static function retrieveByPK($the_pk) {
		return Reminders::retrieveByPKs($the_pk);
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return Reminders
	 */
	static function retrieveByPKs($id) {
		if (null === $id) {
			return null;
		}
		$pool_instance = Reminders::retrieveFromPool($id);
		if (null !== $pool_instance) {
			return $pool_instance;
		}
		$conn = Reminders::getConnection();
		$q = new Query;
		$q->add('id', $id);
		return array_shift(Reminders::doSelect($q, true));
	}

	/**
	 * Searches the database for a row with a id	 * value that matches the one provided
	 * @return Reminders
	 */
	static function retrieveById($value) {
		return Reminders::retrieveByPK($value);
	}

	/**
	 * Searches the database for a row with a userid	 * value that matches the one provided
	 * @return Reminders
	 */
	static function retrieveByUserid($value) {
		return Reminders::retrieveByColumn('userid', $value);
	}

	/**
	 * Searches the database for a row with a subject	 * value that matches the one provided
	 * @return Reminders
	 */
	static function retrieveBySubject($value) {
		return Reminders::retrieveByColumn('subject', $value);
	}

	/**
	 * Searches the database for a row with a message	 * value that matches the one provided
	 * @return Reminders
	 */
	static function retrieveByMessage($value) {
		return Reminders::retrieveByColumn('message', $value);
	}

	/**
	 * Searches the database for a row with a frequency	 * value that matches the one provided
	 * @return Reminders
	 */
	static function retrieveByFrequency($value) {
		return Reminders::retrieveByColumn('frequency', $value);
	}

	/**
	 * Searches the database for a row with a startdate	 * value that matches the one provided
	 * @return Reminders
	 */
	static function retrieveByStartdate($value) {
		return Reminders::retrieveByColumn('startdate', $value);
	}

	/**
	 * Searches the database for a row with a enddate	 * value that matches the one provided
	 * @return Reminders
	 */
	static function retrieveByEnddate($value) {
		return Reminders::retrieveByColumn('enddate', $value);
	}

	/**
	 * Searches the database for a row with a lastdate	 * value that matches the one provided
	 * @return Reminders
	 */
	static function retrieveByLastdate($value) {
		return Reminders::retrieveByColumn('lastdate', $value);
	}

	/**
	 * Searches the database for a row with a nextdate	 * value that matches the one provided
	 * @return Reminders
	 */
	static function retrieveByNextdate($value) {
		return Reminders::retrieveByColumn('nextdate', $value);
	}

	/**
	 * Searches the database for a row with a driverid	 * value that matches the one provided
	 * @return Reminders
	 */
	static function retrieveByDriverid($value) {
		return Reminders::retrieveByColumn('driverid', $value);
	}

	/**
	 * Searches the database for a row with a loadid	 * value that matches the one provided
	 * @return Reminders
	 */
	static function retrieveByLoadid($value) {
		return Reminders::retrieveByColumn('loadid', $value);
	}

	static function retrieveByColumn($field, $value) {
		$conn = Reminders::getConnection();
		return array_shift(Reminders::doSelect(Query::create()->add($field, $value)->setLimit(1)->order('id')));
	}

	/**
	 * Populates and returns an instance of Reminders with the
	 * first result of a query.  If the query returns no results,
	 * returns null.
	 * @return Reminders
	 */
	static function fetchSingle($query_string, $write_cache = true) {
		return array_shift(Reminders::fetch($query_string, $write_cache));
	}

	/**
	 * Populates and returns an array of Reminders objects with the
	 * results of a query.  If the query returns no results,
	 * returns an empty Array.
	 * @return Reminders[]
	 */
	static function fetch($query_string, $write_cache = false) {
		$conn = Reminders::getConnection();
		$result = $conn->query($query_string);
		return Reminders::fromResult($result, 'Reminders', $write_cache);
	}

	/**
	 * Returns an array of Reminders objects from
	 * a PDOStatement(query result).
	 *
	 * @see BaseModel::fromResult
	 */
	static function fromResult(PDOStatement $result, $class = 'Reminders', $write_cache = false) {
		return baseModel::fromResult($result, $class, $write_cache);
	}

	/**
	 * Casts values of int fields to (int)
	 * @return Reminders
	 */
	function castInts() {
		$this->id = (null === $this->id) ? null : (int) $this->id;
		$this->userid = (null === $this->userid) ? null : (int) $this->userid;
		$this->driverid = (null === $this->driverid) ? null : (int) $this->driverid;
		$this->loadid = (null === $this->loadid) ? null : (int) $this->loadid;
		return $this;
	}

	/**
	 * Add (or replace) to the instance pool.
	 *
	 * @param Reminders $object
	 * @return void
	 */
	static function insertIntoPool(Reminders $object) {
		if (Reminders::$_instancePoolCount > Reminders::MAX_INSTANCE_POOL_SIZE) {
			return;
		}

		Reminders::$_instancePool[implode('-', $object->getPrimaryKeyValues())] = clone $object;
		++Reminders::$_instancePoolCount;
	}

	/**
	 * Return the cached instance from the pool.
	 *
	 * @param mixed $pk Primary Key
	 * @return Reminders
	 */
	static function retrieveFromPool($pk) {
		if (null === $pk) {
			return null;
		}
		if (array_key_exists($pk, Reminders::$_instancePool)) {
			return clone Reminders::$_instancePool[$pk];
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

		if (array_key_exists($pk, Reminders::$_instancePool)) {
			unset(Reminders::$_instancePool[$pk]);
			--Reminders::$_instancePoolCount;
		}
	}

	/**
	 * Empty the instance pool.
	 *
	 * @return void
	 */
	static function flushPool() {
		Reminders::$_instancePool = array();
	}

	/**
	 * Returns an array of all Reminders objects in the database.
	 * $extra SQL can be appended to the query to LIMIT, SORT, and/or GROUP results.
	 * If there are no results, returns an empty Array.
	 * @param $extra string
	 * @return Reminders[]
	 */
	static function getAll($extra = null, $write_cache = false) {
		$conn = Reminders::getConnection();
		$table_quoted = $conn->quoteIdentifier(Reminders::getTableName());
		return Reminders::fetch("SELECT * FROM $table_quoted $extra ", $write_cache);
	}

	/**
	 * @return int
	 */
	static function doCount(Query $q = null) {
		$q = $q ? clone $q : new Query;
		$conn = Reminders::getConnection();
		if (!$q->getTable() || Reminders::getTableName() != $q->getTable()) {
			$q->setTable(Reminders::getTableName());
		}
		return $q->doCount($conn);
	}

	/**
	 * @param Query $q
	 * @param bool $dump_cache
	 * @return int
	 */
	static function doDelete(Query $q, $dump_cache = true) {
		$conn = Reminders::getConnection();
		$q = clone $q;
		if (!$q->getTable() || Reminders::getTableName() != $q->getTable()) {
			$q->setTable(Reminders::getTableName());
		}
		$result = $q->doDelete($conn);

		if ($dump_cache) {
			Reminders::$_instancePool = array();
		}

		return $result;
	}

	/**
	 * @param Query $q The Query object that creates the SELECT query string
	 * @param bool $write_cache Whether or not to store results in instance pool
	 * @param array $additional_classes Array of additional classes for fromResult to instantiate as properties
	 * @return Reminders[]
	 */
	static function doSelect(Query $q = null, $write_cache = false, $additional_classes = null) {
		if (is_array($additional_classes)) {
			array_unshift($additional_classes, 'Reminders');
			$class = $additional_classes;
		} else {
			$class = 'Reminders';
		}

		return Reminders::fromResult(self::doSelectRS($q), $class, $write_cache);
	}

	/**
	 * Executes a select query and returns the PDO result
	 * @return PDOStatement
	 */
	static function doSelectRS(Query $q = null) {
		$q = $q ? clone $q : new Query;
		$conn = Reminders::getConnection();
		if (!$q->getTable() || Reminders::getTableName() != $q->getTable()) {
			$q->setTable(Reminders::getTableName());
		}

		return $q->doSelect($conn);
	}

	/**
	 * @return Reminders[]
	 */
	static function doSelectJoinAll(Query $q = null, $write_cache = false, $join_type = Query::LEFT_JOIN) {
		$q = $q ? clone $q : new Query;
		$columns = $q->getColumns();
		$classes = array();
		$alias = $q->getAlias();
		$this_table = $alias ? $alias : Reminders::getTableName();
		if (!$columns) {
			$columns[] = $this_table . '.*';
		}

		$q->setColumns($columns);
		return Reminders::doSelect($q, $write_cache, $classes);
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
