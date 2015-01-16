<?php
/**
 *		Created by Dan Blaisdell's DABL
 *		Do not alter base files, as they will be overwritten.
 *		To alter the objects, alter the extended classes in
 *		the 'models' folder.
 *
 */
abstract class baseOptions extends ApplicationModel {

	/**
	 * Name of the table
	 * @var string
	 */
	protected static $_tableName = 'options';

	/**
	 * Cache of objects retrieved from the database
	 * @var Options[]
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
		'opt_name',
		'opt_value',
	);

	/**
	 * array of all column types
	 * @var string[]
	 */
	protected static $_columnTypes = array(
		'id' => BaseModel::COLUMN_TYPE_BIGINT,
		'opt_name' => BaseModel::COLUMN_TYPE_VARCHAR,
		'opt_value' => BaseModel::COLUMN_TYPE_VARCHAR,
	);

	/**
	 * `id` BIGINT NOT NULL DEFAULT ''
	 * @var string
	 */
	protected $id;

	/**
	 * `opt_name` VARCHAR
	 * @var string
	 */
	protected $opt_name;

	/**
	 * `opt_value` VARCHAR
	 * @var string
	 */
	protected $opt_value;

	/**
	 * Gets the value of the id field
	 */
	function getId() {
		return $this->id;
	}

	/**
	 * Sets the value of the id field
	 * @return Options
	 */
	function setId($value) {
		return $this->setColumnValue('id', $value, BaseModel::COLUMN_TYPE_BIGINT);
	}

	/**
	 * Gets the value of the opt_name field
	 */
	function getOpt_name() {
		return $this->opt_name;
	}

	/**
	 * Sets the value of the opt_name field
	 * @return Options
	 */
	function setOpt_name($value) {
		return $this->setColumnValue('opt_name', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the opt_name field
	 */
	function getOptName() {
		return $this->getOpt_name();
	}

	/**
	 * Sets the value of the opt_name field
	 * @return Options
	 */
	function setOptName($value) {
		return $this->setOpt_name($value);
	}

	/**
	 * Gets the value of the opt_value field
	 */
	function getOpt_value() {
		return $this->opt_value;
	}

	/**
	 * Sets the value of the opt_value field
	 * @return Options
	 */
	function setOpt_value($value) {
		return $this->setColumnValue('opt_value', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the opt_value field
	 */
	function getOptValue() {
		return $this->getOpt_value();
	}

	/**
	 * Sets the value of the opt_value field
	 * @return Options
	 */
	function setOptValue($value) {
		return $this->setOpt_value($value);
	}

	/**
	 * @return DABLPDO
	 */
	static function getConnection() {
		return DBManager::getConnection('default_mysqll');
	}

	/**
	 * @return Options
	 */
	static function create() {
		return new Options();
	}

	/**
	 * Returns String representation of table name
	 * @return string
	 */
	static function getTableName() {
		return Options::$_tableName;
	}

	/**
	 * Access to array of column names
	 * @return array
	 */
	static function getColumnNames() {
		return Options::$_columnNames;
	}

	/**
	 * Access to array of column types, indexed by column name
	 * @return array
	 */
	static function getColumnTypes() {
		return Options::$_columnTypes;
	}

	/**
	 * Get the type of a column
	 * @return array
	 */
	static function getColumnType($column_name) {
		return Options::$_columnTypes[$column_name];
	}

	/**
	 * @return bool
	 */
	static function hasColumn($column_name) {
		static $lower_case_columns = null;
		if (null === $lower_case_columns) {
			$lower_case_columns = array_map('strtolower', Options::$_columnNames);
		}
		return in_array(strtolower($column_name), $lower_case_columns);
	}

	/**
	 * Access to array of primary keys
	 * @return array
	 */
	static function getPrimaryKeys() {
		return Options::$_primaryKeys;
	}

	/**
	 * Access to name of primary key
	 * @return array
	 */
	static function getPrimaryKey() {
		return Options::$_primaryKey;
	}

	/**
	 * Returns true if the primary key column for this table is auto-increment
	 * @return bool
	 */
	static function isAutoIncrement() {
		return Options::$_isAutoIncrement;
	}

	/**
	 * Searches the database for a row with the ID(primary key) that matches
	 * the one input.
	 * @return Options
	 */
	static function retrieveByPK($the_pk) {
		return Options::retrieveByPKs($the_pk);
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return Options
	 */
	static function retrieveByPKs($id) {
		if (null === $id) {
			return null;
		}
		$pool_instance = Options::retrieveFromPool($id);
		if (null !== $pool_instance) {
			return $pool_instance;
		}
		$conn = Options::getConnection();
		$q = new Query;
		$q->add('id', $id);
		return array_shift(Options::doSelect($q, true));
	}

	/**
	 * Searches the database for a row with a id	 * value that matches the one provided
	 * @return Options
	 */
	static function retrieveById($value) {
		return Options::retrieveByPK($value);
	}

	/**
	 * Searches the database for a row with a opt_name	 * value that matches the one provided
	 * @return Options
	 */
	static function retrieveByOptName($value) {
		return Options::retrieveByColumn('opt_name', $value);
	}

	/**
	 * Searches the database for a row with a opt_value	 * value that matches the one provided
	 * @return Options
	 */
	static function retrieveByOptValue($value) {
		return Options::retrieveByColumn('opt_value', $value);
	}

	static function retrieveByColumn($field, $value) {
		$conn = Options::getConnection();
		return array_shift(Options::doSelect(Query::create()->add($field, $value)->setLimit(1)->order('id')));
	}

	/**
	 * Populates and returns an instance of Options with the
	 * first result of a query.  If the query returns no results,
	 * returns null.
	 * @return Options
	 */
	static function fetchSingle($query_string, $write_cache = true) {
		return array_shift(Options::fetch($query_string, $write_cache));
	}

	/**
	 * Populates and returns an array of Options objects with the
	 * results of a query.  If the query returns no results,
	 * returns an empty Array.
	 * @return Options[]
	 */
	static function fetch($query_string, $write_cache = false) {
		$conn = Options::getConnection();
		$result = $conn->query($query_string);
		return Options::fromResult($result, 'Options', $write_cache);
	}

	/**
	 * Returns an array of Options objects from
	 * a PDOStatement(query result).
	 *
	 * @see BaseModel::fromResult
	 */
	static function fromResult(PDOStatement $result, $class = 'Options', $write_cache = false) {
		return baseModel::fromResult($result, $class, $write_cache);
	}

	/**
	 * Casts values of int fields to (int)
	 * @return Options
	 */
	function castInts() {
		$this->id = (null === $this->id) ? null : (int) $this->id;
		return $this;
	}

	/**
	 * Add (or replace) to the instance pool.
	 *
	 * @param Options $object
	 * @return void
	 */
	static function insertIntoPool(Options $object) {
		if (Options::$_instancePoolCount > Options::MAX_INSTANCE_POOL_SIZE) {
			return;
		}

		Options::$_instancePool[implode('-', $object->getPrimaryKeyValues())] = clone $object;
		++Options::$_instancePoolCount;
	}

	/**
	 * Return the cached instance from the pool.
	 *
	 * @param mixed $pk Primary Key
	 * @return Options
	 */
	static function retrieveFromPool($pk) {
		if (null === $pk) {
			return null;
		}
		if (array_key_exists($pk, Options::$_instancePool)) {
			return clone Options::$_instancePool[$pk];
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

		if (array_key_exists($pk, Options::$_instancePool)) {
			unset(Options::$_instancePool[$pk]);
			--Options::$_instancePoolCount;
		}
	}

	/**
	 * Empty the instance pool.
	 *
	 * @return void
	 */
	static function flushPool() {
		Options::$_instancePool = array();
	}

	/**
	 * Returns an array of all Options objects in the database.
	 * $extra SQL can be appended to the query to LIMIT, SORT, and/or GROUP results.
	 * If there are no results, returns an empty Array.
	 * @param $extra string
	 * @return Options[]
	 */
	static function getAll($extra = null, $write_cache = false) {
		$conn = Options::getConnection();
		$table_quoted = $conn->quoteIdentifier(Options::getTableName());
		return Options::fetch("SELECT * FROM $table_quoted $extra ", $write_cache);
	}

	/**
	 * @return int
	 */
	static function doCount(Query $q = null) {
		$q = $q ? clone $q : new Query;
		$conn = Options::getConnection();
		if (!$q->getTable() || Options::getTableName() != $q->getTable()) {
			$q->setTable(Options::getTableName());
		}
		return $q->doCount($conn);
	}

	/**
	 * @param Query $q
	 * @param bool $dump_cache
	 * @return int
	 */
	static function doDelete(Query $q, $dump_cache = true) {
		$conn = Options::getConnection();
		$q = clone $q;
		if (!$q->getTable() || Options::getTableName() != $q->getTable()) {
			$q->setTable(Options::getTableName());
		}
		$result = $q->doDelete($conn);

		if ($dump_cache) {
			Options::$_instancePool = array();
		}

		return $result;
	}

	/**
	 * @param Query $q The Query object that creates the SELECT query string
	 * @param bool $write_cache Whether or not to store results in instance pool
	 * @param array $additional_classes Array of additional classes for fromResult to instantiate as properties
	 * @return Options[]
	 */
	static function doSelect(Query $q = null, $write_cache = false, $additional_classes = null) {
		if (is_array($additional_classes)) {
			array_unshift($additional_classes, 'Options');
			$class = $additional_classes;
		} else {
			$class = 'Options';
		}

		return Options::fromResult(self::doSelectRS($q), $class, $write_cache);
	}

	/**
	 * Executes a select query and returns the PDO result
	 * @return PDOStatement
	 */
	static function doSelectRS(Query $q = null) {
		$q = $q ? clone $q : new Query;
		$conn = Options::getConnection();
		if (!$q->getTable() || Options::getTableName() != $q->getTable()) {
			$q->setTable(Options::getTableName());
		}

		return $q->doSelect($conn);
	}

	/**
	 * @return Options[]
	 */
	static function doSelectJoinAll(Query $q = null, $write_cache = false, $join_type = Query::LEFT_JOIN) {
		$q = $q ? clone $q : new Query;
		$columns = $q->getColumns();
		$classes = array();
		$alias = $q->getAlias();
		$this_table = $alias ? $alias : Options::getTableName();
		if (!$columns) {
			$columns[] = $this_table . '.*';
		}

		$q->setColumns($columns);
		return Options::doSelect($q, $write_cache, $classes);
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
