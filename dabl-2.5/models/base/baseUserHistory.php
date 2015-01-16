<?php
/**
 *		Created by Dan Blaisdell's DABL
 *		Do not alter base files, as they will be overwritten.
 *		To alter the objects, alter the extended classes in
 *		the 'models' folder.
 *
 */
abstract class baseUserHistory extends ApplicationModel {

	/**
	 * Name of the table
	 * @var string
	 */
	protected static $_tableName = 'user_history';

	/**
	 * Cache of objects retrieved from the database
	 * @var UserHistory[]
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
		'user1',
		'user2',
		'user3',
		'driver',
	);

	/**
	 * array of all column types
	 * @var string[]
	 */
	protected static $_columnTypes = array(
		'id' => BaseModel::COLUMN_TYPE_BIGINT,
		'user1' => BaseModel::COLUMN_TYPE_VARCHAR,
		'user2' => BaseModel::COLUMN_TYPE_VARCHAR,
		'user3' => BaseModel::COLUMN_TYPE_VARCHAR,
		'driver' => BaseModel::COLUMN_TYPE_VARCHAR,
	);

	/**
	 * `id` BIGINT NOT NULL DEFAULT ''
	 * @var string
	 */
	protected $id;

	/**
	 * `user1` VARCHAR
	 * @var string
	 */
	protected $user1;

	/**
	 * `user2` VARCHAR
	 * @var string
	 */
	protected $user2;

	/**
	 * `user3` VARCHAR
	 * @var string
	 */
	protected $user3;

	/**
	 * `driver` VARCHAR
	 * @var string
	 */
	protected $driver;

	/**
	 * Gets the value of the id field
	 */
	function getId() {
		return $this->id;
	}

	/**
	 * Sets the value of the id field
	 * @return UserHistory
	 */
	function setId($value) {
		return $this->setColumnValue('id', $value, BaseModel::COLUMN_TYPE_BIGINT);
	}

	/**
	 * Gets the value of the user1 field
	 */
	function getUser1() {
		return $this->user1;
	}

	/**
	 * Sets the value of the user1 field
	 * @return UserHistory
	 */
	function setUser1($value) {
		return $this->setColumnValue('user1', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the user2 field
	 */
	function getUser2() {
		return $this->user2;
	}

	/**
	 * Sets the value of the user2 field
	 * @return UserHistory
	 */
	function setUser2($value) {
		return $this->setColumnValue('user2', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the user3 field
	 */
	function getUser3() {
		return $this->user3;
	}

	/**
	 * Sets the value of the user3 field
	 * @return UserHistory
	 */
	function setUser3($value) {
		return $this->setColumnValue('user3', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the driver field
	 */
	function getDriver() {
		return $this->driver;
	}

	/**
	 * Sets the value of the driver field
	 * @return UserHistory
	 */
	function setDriver($value) {
		return $this->setColumnValue('driver', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * @return DABLPDO
	 */
	static function getConnection() {
		return DBManager::getConnection('default_mysqll');
	}

	/**
	 * @return UserHistory
	 */
	static function create() {
		return new UserHistory();
	}

	/**
	 * Returns String representation of table name
	 * @return string
	 */
	static function getTableName() {
		return UserHistory::$_tableName;
	}

	/**
	 * Access to array of column names
	 * @return array
	 */
	static function getColumnNames() {
		return UserHistory::$_columnNames;
	}

	/**
	 * Access to array of column types, indexed by column name
	 * @return array
	 */
	static function getColumnTypes() {
		return UserHistory::$_columnTypes;
	}

	/**
	 * Get the type of a column
	 * @return array
	 */
	static function getColumnType($column_name) {
		return UserHistory::$_columnTypes[$column_name];
	}

	/**
	 * @return bool
	 */
	static function hasColumn($column_name) {
		static $lower_case_columns = null;
		if (null === $lower_case_columns) {
			$lower_case_columns = array_map('strtolower', UserHistory::$_columnNames);
		}
		return in_array(strtolower($column_name), $lower_case_columns);
	}

	/**
	 * Access to array of primary keys
	 * @return array
	 */
	static function getPrimaryKeys() {
		return UserHistory::$_primaryKeys;
	}

	/**
	 * Access to name of primary key
	 * @return array
	 */
	static function getPrimaryKey() {
		return UserHistory::$_primaryKey;
	}

	/**
	 * Returns true if the primary key column for this table is auto-increment
	 * @return bool
	 */
	static function isAutoIncrement() {
		return UserHistory::$_isAutoIncrement;
	}

	/**
	 * Searches the database for a row with the ID(primary key) that matches
	 * the one input.
	 * @return UserHistory
	 */
	static function retrieveByPK($the_pk) {
		return UserHistory::retrieveByPKs($the_pk);
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return UserHistory
	 */
	static function retrieveByPKs($id) {
		if (null === $id) {
			return null;
		}
		$pool_instance = UserHistory::retrieveFromPool($id);
		if (null !== $pool_instance) {
			return $pool_instance;
		}
		$conn = UserHistory::getConnection();
		$q = new Query;
		$q->add('id', $id);
		return array_shift(UserHistory::doSelect($q, true));
	}

	/**
	 * Searches the database for a row with a id	 * value that matches the one provided
	 * @return UserHistory
	 */
	static function retrieveById($value) {
		return UserHistory::retrieveByPK($value);
	}

	/**
	 * Searches the database for a row with a user1	 * value that matches the one provided
	 * @return UserHistory
	 */
	static function retrieveByUser1($value) {
		return UserHistory::retrieveByColumn('user1', $value);
	}

	/**
	 * Searches the database for a row with a user2	 * value that matches the one provided
	 * @return UserHistory
	 */
	static function retrieveByUser2($value) {
		return UserHistory::retrieveByColumn('user2', $value);
	}

	/**
	 * Searches the database for a row with a user3	 * value that matches the one provided
	 * @return UserHistory
	 */
	static function retrieveByUser3($value) {
		return UserHistory::retrieveByColumn('user3', $value);
	}

	/**
	 * Searches the database for a row with a driver	 * value that matches the one provided
	 * @return UserHistory
	 */
	static function retrieveByDriver($value) {
		return UserHistory::retrieveByColumn('driver', $value);
	}

	static function retrieveByColumn($field, $value) {
		$conn = UserHistory::getConnection();
		return array_shift(UserHistory::doSelect(Query::create()->add($field, $value)->setLimit(1)->order('id')));
	}

	/**
	 * Populates and returns an instance of UserHistory with the
	 * first result of a query.  If the query returns no results,
	 * returns null.
	 * @return UserHistory
	 */
	static function fetchSingle($query_string, $write_cache = true) {
		return array_shift(UserHistory::fetch($query_string, $write_cache));
	}

	/**
	 * Populates and returns an array of UserHistory objects with the
	 * results of a query.  If the query returns no results,
	 * returns an empty Array.
	 * @return UserHistory[]
	 */
	static function fetch($query_string, $write_cache = false) {
		$conn = UserHistory::getConnection();
		$result = $conn->query($query_string);
		return UserHistory::fromResult($result, 'UserHistory', $write_cache);
	}

	/**
	 * Returns an array of UserHistory objects from
	 * a PDOStatement(query result).
	 *
	 * @see BaseModel::fromResult
	 */
	static function fromResult(PDOStatement $result, $class = 'UserHistory', $write_cache = false) {
		return baseModel::fromResult($result, $class, $write_cache);
	}

	/**
	 * Casts values of int fields to (int)
	 * @return UserHistory
	 */
	function castInts() {
		$this->id = (null === $this->id) ? null : (int) $this->id;
		return $this;
	}

	/**
	 * Add (or replace) to the instance pool.
	 *
	 * @param UserHistory $object
	 * @return void
	 */
	static function insertIntoPool(UserHistory $object) {
		if (UserHistory::$_instancePoolCount > UserHistory::MAX_INSTANCE_POOL_SIZE) {
			return;
		}

		UserHistory::$_instancePool[implode('-', $object->getPrimaryKeyValues())] = clone $object;
		++UserHistory::$_instancePoolCount;
	}

	/**
	 * Return the cached instance from the pool.
	 *
	 * @param mixed $pk Primary Key
	 * @return UserHistory
	 */
	static function retrieveFromPool($pk) {
		if (null === $pk) {
			return null;
		}
		if (array_key_exists($pk, UserHistory::$_instancePool)) {
			return clone UserHistory::$_instancePool[$pk];
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

		if (array_key_exists($pk, UserHistory::$_instancePool)) {
			unset(UserHistory::$_instancePool[$pk]);
			--UserHistory::$_instancePoolCount;
		}
	}

	/**
	 * Empty the instance pool.
	 *
	 * @return void
	 */
	static function flushPool() {
		UserHistory::$_instancePool = array();
	}

	/**
	 * Returns an array of all UserHistory objects in the database.
	 * $extra SQL can be appended to the query to LIMIT, SORT, and/or GROUP results.
	 * If there are no results, returns an empty Array.
	 * @param $extra string
	 * @return UserHistory[]
	 */
	static function getAll($extra = null, $write_cache = false) {
		$conn = UserHistory::getConnection();
		$table_quoted = $conn->quoteIdentifier(UserHistory::getTableName());
		return UserHistory::fetch("SELECT * FROM $table_quoted $extra ", $write_cache);
	}

	/**
	 * @return int
	 */
	static function doCount(Query $q = null) {
		$q = $q ? clone $q : new Query;
		$conn = UserHistory::getConnection();
		if (!$q->getTable() || UserHistory::getTableName() != $q->getTable()) {
			$q->setTable(UserHistory::getTableName());
		}
		return $q->doCount($conn);
	}

	/**
	 * @param Query $q
	 * @param bool $dump_cache
	 * @return int
	 */
	static function doDelete(Query $q, $dump_cache = true) {
		$conn = UserHistory::getConnection();
		$q = clone $q;
		if (!$q->getTable() || UserHistory::getTableName() != $q->getTable()) {
			$q->setTable(UserHistory::getTableName());
		}
		$result = $q->doDelete($conn);

		if ($dump_cache) {
			UserHistory::$_instancePool = array();
		}

		return $result;
	}

	/**
	 * @param Query $q The Query object that creates the SELECT query string
	 * @param bool $write_cache Whether or not to store results in instance pool
	 * @param array $additional_classes Array of additional classes for fromResult to instantiate as properties
	 * @return UserHistory[]
	 */
	static function doSelect(Query $q = null, $write_cache = false, $additional_classes = null) {
		if (is_array($additional_classes)) {
			array_unshift($additional_classes, 'UserHistory');
			$class = $additional_classes;
		} else {
			$class = 'UserHistory';
		}

		return UserHistory::fromResult(self::doSelectRS($q), $class, $write_cache);
	}

	/**
	 * Executes a select query and returns the PDO result
	 * @return PDOStatement
	 */
	static function doSelectRS(Query $q = null) {
		$q = $q ? clone $q : new Query;
		$conn = UserHistory::getConnection();
		if (!$q->getTable() || UserHistory::getTableName() != $q->getTable()) {
			$q->setTable(UserHistory::getTableName());
		}

		return $q->doSelect($conn);
	}

	/**
	 * @return UserHistory[]
	 */
	static function doSelectJoinAll(Query $q = null, $write_cache = false, $join_type = Query::LEFT_JOIN) {
		$q = $q ? clone $q : new Query;
		$columns = $q->getColumns();
		$classes = array();
		$alias = $q->getAlias();
		$this_table = $alias ? $alias : UserHistory::getTableName();
		if (!$columns) {
			$columns[] = $this_table . '.*';
		}

		$q->setColumns($columns);
		return UserHistory::doSelect($q, $write_cache, $classes);
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
