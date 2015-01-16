<?php
/**
 *		Created by Dan Blaisdell's DABL
 *		Do not alter base files, as they will be overwritten.
 *		To alter the objects, alter the extended classes in
 *		the 'models' folder.
 *
 */
abstract class basePrivateNotes extends ApplicationModel {

	/**
	 * Name of the table
	 * @var string
	 */
	protected static $_tableName = 'private_notes';

	/**
	 * Cache of objects retrieved from the database
	 * @var PrivateNotes[]
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
		'user',
		'driver',
		'comments',
	);

	/**
	 * array of all column types
	 * @var string[]
	 */
	protected static $_columnTypes = array(
		'id' => BaseModel::COLUMN_TYPE_BIGINT,
		'user' => BaseModel::COLUMN_TYPE_BIGINT,
		'driver' => BaseModel::COLUMN_TYPE_BIGINT,
		'comments' => BaseModel::COLUMN_TYPE_LONGVARCHAR,
	);

	/**
	 * `id` BIGINT NOT NULL DEFAULT ''
	 * @var string
	 */
	protected $id;

	/**
	 * `user` BIGINT DEFAULT ''
	 * @var string
	 */
	protected $user;

	/**
	 * `driver` BIGINT DEFAULT ''
	 * @var string
	 */
	protected $driver;

	/**
	 * `comments` LONGVARCHAR
	 * @var string
	 */
	protected $comments;

	/**
	 * Gets the value of the id field
	 */
	function getId() {
		return $this->id;
	}

	/**
	 * Sets the value of the id field
	 * @return PrivateNotes
	 */
	function setId($value) {
		return $this->setColumnValue('id', $value, BaseModel::COLUMN_TYPE_BIGINT);
	}

	/**
	 * Gets the value of the user field
	 */
	function getUser() {
		return $this->user;
	}

	/**
	 * Sets the value of the user field
	 * @return PrivateNotes
	 */
	function setUser($value) {
		return $this->setColumnValue('user', $value, BaseModel::COLUMN_TYPE_BIGINT);
	}

	/**
	 * Gets the value of the driver field
	 */
	function getDriver() {
		return $this->driver;
	}

	/**
	 * Sets the value of the driver field
	 * @return PrivateNotes
	 */
	function setDriver($value) {
		return $this->setColumnValue('driver', $value, BaseModel::COLUMN_TYPE_BIGINT);
	}

	/**
	 * Gets the value of the comments field
	 */
	function getComments() {
		return $this->comments;
	}

	/**
	 * Sets the value of the comments field
	 * @return PrivateNotes
	 */
	function setComments($value) {
		return $this->setColumnValue('comments', $value, BaseModel::COLUMN_TYPE_LONGVARCHAR);
	}

	/**
	 * @return DABLPDO
	 */
	static function getConnection() {
		return DBManager::getConnection('default_mysqll');
	}

	/**
	 * @return PrivateNotes
	 */
	static function create() {
		return new PrivateNotes();
	}

	/**
	 * Returns String representation of table name
	 * @return string
	 */
	static function getTableName() {
		return PrivateNotes::$_tableName;
	}

	/**
	 * Access to array of column names
	 * @return array
	 */
	static function getColumnNames() {
		return PrivateNotes::$_columnNames;
	}

	/**
	 * Access to array of column types, indexed by column name
	 * @return array
	 */
	static function getColumnTypes() {
		return PrivateNotes::$_columnTypes;
	}

	/**
	 * Get the type of a column
	 * @return array
	 */
	static function getColumnType($column_name) {
		return PrivateNotes::$_columnTypes[$column_name];
	}

	/**
	 * @return bool
	 */
	static function hasColumn($column_name) {
		static $lower_case_columns = null;
		if (null === $lower_case_columns) {
			$lower_case_columns = array_map('strtolower', PrivateNotes::$_columnNames);
		}
		return in_array(strtolower($column_name), $lower_case_columns);
	}

	/**
	 * Access to array of primary keys
	 * @return array
	 */
	static function getPrimaryKeys() {
		return PrivateNotes::$_primaryKeys;
	}

	/**
	 * Access to name of primary key
	 * @return array
	 */
	static function getPrimaryKey() {
		return PrivateNotes::$_primaryKey;
	}

	/**
	 * Returns true if the primary key column for this table is auto-increment
	 * @return bool
	 */
	static function isAutoIncrement() {
		return PrivateNotes::$_isAutoIncrement;
	}

	/**
	 * Searches the database for a row with the ID(primary key) that matches
	 * the one input.
	 * @return PrivateNotes
	 */
	static function retrieveByPK($the_pk) {
		return PrivateNotes::retrieveByPKs($the_pk);
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return PrivateNotes
	 */
	static function retrieveByPKs($id) {
		if (null === $id) {
			return null;
		}
		$pool_instance = PrivateNotes::retrieveFromPool($id);
		if (null !== $pool_instance) {
			return $pool_instance;
		}
		$conn = PrivateNotes::getConnection();
		$q = new Query;
		$q->add('id', $id);
		return array_shift(PrivateNotes::doSelect($q, true));
	}

	/**
	 * Searches the database for a row with a id	 * value that matches the one provided
	 * @return PrivateNotes
	 */
	static function retrieveById($value) {
		return PrivateNotes::retrieveByPK($value);
	}

	/**
	 * Searches the database for a row with a user	 * value that matches the one provided
	 * @return PrivateNotes
	 */
	static function retrieveByUser($value) {
		return PrivateNotes::retrieveByColumn('user', $value);
	}

	/**
	 * Searches the database for a row with a driver	 * value that matches the one provided
	 * @return PrivateNotes
	 */
	static function retrieveByDriver($value) {
		return PrivateNotes::retrieveByColumn('driver', $value);
	}

	/**
	 * Searches the database for a row with a comments	 * value that matches the one provided
	 * @return PrivateNotes
	 */
	static function retrieveByComments($value) {
		return PrivateNotes::retrieveByColumn('comments', $value);
	}

	static function retrieveByColumn($field, $value) {
		$conn = PrivateNotes::getConnection();
		return array_shift(PrivateNotes::doSelect(Query::create()->add($field, $value)->setLimit(1)->order('id')));
	}

	/**
	 * Populates and returns an instance of PrivateNotes with the
	 * first result of a query.  If the query returns no results,
	 * returns null.
	 * @return PrivateNotes
	 */
	static function fetchSingle($query_string, $write_cache = true) {
		return array_shift(PrivateNotes::fetch($query_string, $write_cache));
	}

	/**
	 * Populates and returns an array of PrivateNotes objects with the
	 * results of a query.  If the query returns no results,
	 * returns an empty Array.
	 * @return PrivateNotes[]
	 */
	static function fetch($query_string, $write_cache = false) {
		$conn = PrivateNotes::getConnection();
		$result = $conn->query($query_string);
		return PrivateNotes::fromResult($result, 'PrivateNotes', $write_cache);
	}

	/**
	 * Returns an array of PrivateNotes objects from
	 * a PDOStatement(query result).
	 *
	 * @see BaseModel::fromResult
	 */
	static function fromResult(PDOStatement $result, $class = 'PrivateNotes', $write_cache = false) {
		return baseModel::fromResult($result, $class, $write_cache);
	}

	/**
	 * Casts values of int fields to (int)
	 * @return PrivateNotes
	 */
	function castInts() {
		$this->id = (null === $this->id) ? null : (int) $this->id;
		$this->user = (null === $this->user) ? null : (int) $this->user;
		$this->driver = (null === $this->driver) ? null : (int) $this->driver;
		return $this;
	}

	/**
	 * Add (or replace) to the instance pool.
	 *
	 * @param PrivateNotes $object
	 * @return void
	 */
	static function insertIntoPool(PrivateNotes $object) {
		if (PrivateNotes::$_instancePoolCount > PrivateNotes::MAX_INSTANCE_POOL_SIZE) {
			return;
		}

		PrivateNotes::$_instancePool[implode('-', $object->getPrimaryKeyValues())] = clone $object;
		++PrivateNotes::$_instancePoolCount;
	}

	/**
	 * Return the cached instance from the pool.
	 *
	 * @param mixed $pk Primary Key
	 * @return PrivateNotes
	 */
	static function retrieveFromPool($pk) {
		if (null === $pk) {
			return null;
		}
		if (array_key_exists($pk, PrivateNotes::$_instancePool)) {
			return clone PrivateNotes::$_instancePool[$pk];
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

		if (array_key_exists($pk, PrivateNotes::$_instancePool)) {
			unset(PrivateNotes::$_instancePool[$pk]);
			--PrivateNotes::$_instancePoolCount;
		}
	}

	/**
	 * Empty the instance pool.
	 *
	 * @return void
	 */
	static function flushPool() {
		PrivateNotes::$_instancePool = array();
	}

	/**
	 * Returns an array of all PrivateNotes objects in the database.
	 * $extra SQL can be appended to the query to LIMIT, SORT, and/or GROUP results.
	 * If there are no results, returns an empty Array.
	 * @param $extra string
	 * @return PrivateNotes[]
	 */
	static function getAll($extra = null, $write_cache = false) {
		$conn = PrivateNotes::getConnection();
		$table_quoted = $conn->quoteIdentifier(PrivateNotes::getTableName());
		return PrivateNotes::fetch("SELECT * FROM $table_quoted $extra ", $write_cache);
	}

	/**
	 * @return int
	 */
	static function doCount(Query $q = null) {
		$q = $q ? clone $q : new Query;
		$conn = PrivateNotes::getConnection();
		if (!$q->getTable() || PrivateNotes::getTableName() != $q->getTable()) {
			$q->setTable(PrivateNotes::getTableName());
		}
		return $q->doCount($conn);
	}

	/**
	 * @param Query $q
	 * @param bool $dump_cache
	 * @return int
	 */
	static function doDelete(Query $q, $dump_cache = true) {
		$conn = PrivateNotes::getConnection();
		$q = clone $q;
		if (!$q->getTable() || PrivateNotes::getTableName() != $q->getTable()) {
			$q->setTable(PrivateNotes::getTableName());
		}
		$result = $q->doDelete($conn);

		if ($dump_cache) {
			PrivateNotes::$_instancePool = array();
		}

		return $result;
	}

	/**
	 * @param Query $q The Query object that creates the SELECT query string
	 * @param bool $write_cache Whether or not to store results in instance pool
	 * @param array $additional_classes Array of additional classes for fromResult to instantiate as properties
	 * @return PrivateNotes[]
	 */
	static function doSelect(Query $q = null, $write_cache = false, $additional_classes = null) {
		if (is_array($additional_classes)) {
			array_unshift($additional_classes, 'PrivateNotes');
			$class = $additional_classes;
		} else {
			$class = 'PrivateNotes';
		}

		return PrivateNotes::fromResult(self::doSelectRS($q), $class, $write_cache);
	}

	/**
	 * Executes a select query and returns the PDO result
	 * @return PDOStatement
	 */
	static function doSelectRS(Query $q = null) {
		$q = $q ? clone $q : new Query;
		$conn = PrivateNotes::getConnection();
		if (!$q->getTable() || PrivateNotes::getTableName() != $q->getTable()) {
			$q->setTable(PrivateNotes::getTableName());
		}

		return $q->doSelect($conn);
	}

	/**
	 * @return PrivateNotes[]
	 */
	static function doSelectJoinAll(Query $q = null, $write_cache = false, $join_type = Query::LEFT_JOIN) {
		$q = $q ? clone $q : new Query;
		$columns = $q->getColumns();
		$classes = array();
		$alias = $q->getAlias();
		$this_table = $alias ? $alias : PrivateNotes::getTableName();
		if (!$columns) {
			$columns[] = $this_table . '.*';
		}

		$q->setColumns($columns);
		return PrivateNotes::doSelect($q, $write_cache, $classes);
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
