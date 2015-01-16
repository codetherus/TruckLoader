<?php
/**
 *		Created by Dan Blaisdell's DABL
 *		Do not alter base files, as they will be overwritten.
 *		To alter the objects, alter the extended classes in
 *		the 'models' folder.
 *
 */
abstract class baseOffices extends ApplicationModel {

	/**
	 * Name of the table
	 * @var string
	 */
	protected static $_tableName = 'offices';

	/**
	 * Cache of objects retrieved from the database
	 * @var Offices[]
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
		'name',
		'address1',
		'address2',
		'city',
		'state',
		'shortname',
	);

	/**
	 * array of all column types
	 * @var string[]
	 */
	protected static $_columnTypes = array(
		'id' => BaseModel::COLUMN_TYPE_BIGINT,
		'name' => BaseModel::COLUMN_TYPE_VARCHAR,
		'address1' => BaseModel::COLUMN_TYPE_VARCHAR,
		'address2' => BaseModel::COLUMN_TYPE_VARCHAR,
		'city' => BaseModel::COLUMN_TYPE_VARCHAR,
		'state' => BaseModel::COLUMN_TYPE_VARCHAR,
		'shortname' => BaseModel::COLUMN_TYPE_VARCHAR,
	);

	/**
	 * `id` BIGINT NOT NULL DEFAULT ''
	 * @var string
	 */
	protected $id;

	/**
	 * `name` VARCHAR
	 * @var string
	 */
	protected $name;

	/**
	 * `address1` VARCHAR
	 * @var string
	 */
	protected $address1;

	/**
	 * `address2` VARCHAR
	 * @var string
	 */
	protected $address2;

	/**
	 * `city` VARCHAR
	 * @var string
	 */
	protected $city;

	/**
	 * `state` VARCHAR
	 * @var string
	 */
	protected $state;

	/**
	 * `shortname` VARCHAR
	 * @var string
	 */
	protected $shortname;

	/**
	 * Gets the value of the id field
	 */
	function getId() {
		return $this->id;
	}

	/**
	 * Sets the value of the id field
	 * @return Offices
	 */
	function setId($value) {
		return $this->setColumnValue('id', $value, BaseModel::COLUMN_TYPE_BIGINT);
	}

	/**
	 * Gets the value of the name field
	 */
	function getName() {
		return $this->name;
	}

	/**
	 * Sets the value of the name field
	 * @return Offices
	 */
	function setName($value) {
		return $this->setColumnValue('name', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the address1 field
	 */
	function getAddress1() {
		return $this->address1;
	}

	/**
	 * Sets the value of the address1 field
	 * @return Offices
	 */
	function setAddress1($value) {
		return $this->setColumnValue('address1', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the address2 field
	 */
	function getAddress2() {
		return $this->address2;
	}

	/**
	 * Sets the value of the address2 field
	 * @return Offices
	 */
	function setAddress2($value) {
		return $this->setColumnValue('address2', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the city field
	 */
	function getCity() {
		return $this->city;
	}

	/**
	 * Sets the value of the city field
	 * @return Offices
	 */
	function setCity($value) {
		return $this->setColumnValue('city', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the state field
	 */
	function getState() {
		return $this->state;
	}

	/**
	 * Sets the value of the state field
	 * @return Offices
	 */
	function setState($value) {
		return $this->setColumnValue('state', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the shortname field
	 */
	function getShortname() {
		return $this->shortname;
	}

	/**
	 * Sets the value of the shortname field
	 * @return Offices
	 */
	function setShortname($value) {
		return $this->setColumnValue('shortname', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * @return DABLPDO
	 */
	static function getConnection() {
		return DBManager::getConnection('default_mysqll');
	}

	/**
	 * @return Offices
	 */
	static function create() {
		return new Offices();
	}

	/**
	 * Returns String representation of table name
	 * @return string
	 */
	static function getTableName() {
		return Offices::$_tableName;
	}

	/**
	 * Access to array of column names
	 * @return array
	 */
	static function getColumnNames() {
		return Offices::$_columnNames;
	}

	/**
	 * Access to array of column types, indexed by column name
	 * @return array
	 */
	static function getColumnTypes() {
		return Offices::$_columnTypes;
	}

	/**
	 * Get the type of a column
	 * @return array
	 */
	static function getColumnType($column_name) {
		return Offices::$_columnTypes[$column_name];
	}

	/**
	 * @return bool
	 */
	static function hasColumn($column_name) {
		static $lower_case_columns = null;
		if (null === $lower_case_columns) {
			$lower_case_columns = array_map('strtolower', Offices::$_columnNames);
		}
		return in_array(strtolower($column_name), $lower_case_columns);
	}

	/**
	 * Access to array of primary keys
	 * @return array
	 */
	static function getPrimaryKeys() {
		return Offices::$_primaryKeys;
	}

	/**
	 * Access to name of primary key
	 * @return array
	 */
	static function getPrimaryKey() {
		return Offices::$_primaryKey;
	}

	/**
	 * Returns true if the primary key column for this table is auto-increment
	 * @return bool
	 */
	static function isAutoIncrement() {
		return Offices::$_isAutoIncrement;
	}

	/**
	 * Searches the database for a row with the ID(primary key) that matches
	 * the one input.
	 * @return Offices
	 */
	static function retrieveByPK($the_pk) {
		return Offices::retrieveByPKs($the_pk);
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return Offices
	 */
	static function retrieveByPKs($id) {
		if (null === $id) {
			return null;
		}
		$pool_instance = Offices::retrieveFromPool($id);
		if (null !== $pool_instance) {
			return $pool_instance;
		}
		$conn = Offices::getConnection();
		$q = new Query;
		$q->add('id', $id);
		return array_shift(Offices::doSelect($q, true));
	}

	/**
	 * Searches the database for a row with a id	 * value that matches the one provided
	 * @return Offices
	 */
	static function retrieveById($value) {
		return Offices::retrieveByPK($value);
	}

	/**
	 * Searches the database for a row with a name	 * value that matches the one provided
	 * @return Offices
	 */
	static function retrieveByName($value) {
		return Offices::retrieveByColumn('name', $value);
	}

	/**
	 * Searches the database for a row with a address1	 * value that matches the one provided
	 * @return Offices
	 */
	static function retrieveByAddress1($value) {
		return Offices::retrieveByColumn('address1', $value);
	}

	/**
	 * Searches the database for a row with a address2	 * value that matches the one provided
	 * @return Offices
	 */
	static function retrieveByAddress2($value) {
		return Offices::retrieveByColumn('address2', $value);
	}

	/**
	 * Searches the database for a row with a city	 * value that matches the one provided
	 * @return Offices
	 */
	static function retrieveByCity($value) {
		return Offices::retrieveByColumn('city', $value);
	}

	/**
	 * Searches the database for a row with a state	 * value that matches the one provided
	 * @return Offices
	 */
	static function retrieveByState($value) {
		return Offices::retrieveByColumn('state', $value);
	}

	/**
	 * Searches the database for a row with a shortname	 * value that matches the one provided
	 * @return Offices
	 */
	static function retrieveByShortname($value) {
		return Offices::retrieveByColumn('shortname', $value);
	}

	static function retrieveByColumn($field, $value) {
		$conn = Offices::getConnection();
		return array_shift(Offices::doSelect(Query::create()->add($field, $value)->setLimit(1)->order('id')));
	}

	/**
	 * Populates and returns an instance of Offices with the
	 * first result of a query.  If the query returns no results,
	 * returns null.
	 * @return Offices
	 */
	static function fetchSingle($query_string, $write_cache = true) {
		return array_shift(Offices::fetch($query_string, $write_cache));
	}

	/**
	 * Populates and returns an array of Offices objects with the
	 * results of a query.  If the query returns no results,
	 * returns an empty Array.
	 * @return Offices[]
	 */
	static function fetch($query_string, $write_cache = false) {
		$conn = Offices::getConnection();
		$result = $conn->query($query_string);
		return Offices::fromResult($result, 'Offices', $write_cache);
	}

	/**
	 * Returns an array of Offices objects from
	 * a PDOStatement(query result).
	 *
	 * @see BaseModel::fromResult
	 */
	static function fromResult(PDOStatement $result, $class = 'Offices', $write_cache = false) {
		return baseModel::fromResult($result, $class, $write_cache);
	}

	/**
	 * Casts values of int fields to (int)
	 * @return Offices
	 */
	function castInts() {
		$this->id = (null === $this->id) ? null : (int) $this->id;
		return $this;
	}

	/**
	 * Add (or replace) to the instance pool.
	 *
	 * @param Offices $object
	 * @return void
	 */
	static function insertIntoPool(Offices $object) {
		if (Offices::$_instancePoolCount > Offices::MAX_INSTANCE_POOL_SIZE) {
			return;
		}

		Offices::$_instancePool[implode('-', $object->getPrimaryKeyValues())] = clone $object;
		++Offices::$_instancePoolCount;
	}

	/**
	 * Return the cached instance from the pool.
	 *
	 * @param mixed $pk Primary Key
	 * @return Offices
	 */
	static function retrieveFromPool($pk) {
		if (null === $pk) {
			return null;
		}
		if (array_key_exists($pk, Offices::$_instancePool)) {
			return clone Offices::$_instancePool[$pk];
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

		if (array_key_exists($pk, Offices::$_instancePool)) {
			unset(Offices::$_instancePool[$pk]);
			--Offices::$_instancePoolCount;
		}
	}

	/**
	 * Empty the instance pool.
	 *
	 * @return void
	 */
	static function flushPool() {
		Offices::$_instancePool = array();
	}

	/**
	 * Returns an array of all Offices objects in the database.
	 * $extra SQL can be appended to the query to LIMIT, SORT, and/or GROUP results.
	 * If there are no results, returns an empty Array.
	 * @param $extra string
	 * @return Offices[]
	 */
	static function getAll($extra = null, $write_cache = false) {
		$conn = Offices::getConnection();
		$table_quoted = $conn->quoteIdentifier(Offices::getTableName());
		return Offices::fetch("SELECT * FROM $table_quoted $extra ", $write_cache);
	}

	/**
	 * @return int
	 */
	static function doCount(Query $q = null) {
		$q = $q ? clone $q : new Query;
		$conn = Offices::getConnection();
		if (!$q->getTable() || Offices::getTableName() != $q->getTable()) {
			$q->setTable(Offices::getTableName());
		}
		return $q->doCount($conn);
	}

	/**
	 * @param Query $q
	 * @param bool $dump_cache
	 * @return int
	 */
	static function doDelete(Query $q, $dump_cache = true) {
		$conn = Offices::getConnection();
		$q = clone $q;
		if (!$q->getTable() || Offices::getTableName() != $q->getTable()) {
			$q->setTable(Offices::getTableName());
		}
		$result = $q->doDelete($conn);

		if ($dump_cache) {
			Offices::$_instancePool = array();
		}

		return $result;
	}

	/**
	 * @param Query $q The Query object that creates the SELECT query string
	 * @param bool $write_cache Whether or not to store results in instance pool
	 * @param array $additional_classes Array of additional classes for fromResult to instantiate as properties
	 * @return Offices[]
	 */
	static function doSelect(Query $q = null, $write_cache = false, $additional_classes = null) {
		if (is_array($additional_classes)) {
			array_unshift($additional_classes, 'Offices');
			$class = $additional_classes;
		} else {
			$class = 'Offices';
		}

		return Offices::fromResult(self::doSelectRS($q), $class, $write_cache);
	}

	/**
	 * Executes a select query and returns the PDO result
	 * @return PDOStatement
	 */
	static function doSelectRS(Query $q = null) {
		$q = $q ? clone $q : new Query;
		$conn = Offices::getConnection();
		if (!$q->getTable() || Offices::getTableName() != $q->getTable()) {
			$q->setTable(Offices::getTableName());
		}

		return $q->doSelect($conn);
	}

	/**
	 * @return Offices[]
	 */
	static function doSelectJoinAll(Query $q = null, $write_cache = false, $join_type = Query::LEFT_JOIN) {
		$q = $q ? clone $q : new Query;
		$columns = $q->getColumns();
		$classes = array();
		$alias = $q->getAlias();
		$this_table = $alias ? $alias : Offices::getTableName();
		if (!$columns) {
			$columns[] = $this_table . '.*';
		}

		$q->setColumns($columns);
		return Offices::doSelect($q, $write_cache, $classes);
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
