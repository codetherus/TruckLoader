<?php
/**
 *		Created by Dan Blaisdell's DABL
 *		Do not alter base files, as they will be overwritten.
 *		To alter the objects, alter the extended classes in
 *		the 'models' folder.
 *
 */
abstract class baseBrokers extends ApplicationModel {

	/**
	 * Name of the table
	 * @var string
	 */
	protected static $_tableName = 'brokers';

	/**
	 * Cache of objects retrieved from the database
	 * @var Brokers[]
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
		'company',
		'address1',
		'address2',
		'city',
		'state',
		'zip',
		'phone',
		'cell',
		'fax',
		'notes',
	);

	/**
	 * array of all column types
	 * @var string[]
	 */
	protected static $_columnTypes = array(
		'id' => BaseModel::COLUMN_TYPE_BIGINT,
		'name' => BaseModel::COLUMN_TYPE_VARCHAR,
		'company' => BaseModel::COLUMN_TYPE_VARCHAR,
		'address1' => BaseModel::COLUMN_TYPE_VARCHAR,
		'address2' => BaseModel::COLUMN_TYPE_VARCHAR,
		'city' => BaseModel::COLUMN_TYPE_VARCHAR,
		'state' => BaseModel::COLUMN_TYPE_VARCHAR,
		'zip' => BaseModel::COLUMN_TYPE_VARCHAR,
		'phone' => BaseModel::COLUMN_TYPE_VARCHAR,
		'cell' => BaseModel::COLUMN_TYPE_VARCHAR,
		'fax' => BaseModel::COLUMN_TYPE_VARCHAR,
		'notes' => BaseModel::COLUMN_TYPE_LONGVARCHAR,
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
	 * `company` VARCHAR
	 * @var string
	 */
	protected $company;

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
	 * `zip` VARCHAR
	 * @var string
	 */
	protected $zip;

	/**
	 * `phone` VARCHAR
	 * @var string
	 */
	protected $phone;

	/**
	 * `cell` VARCHAR
	 * @var string
	 */
	protected $cell;

	/**
	 * `fax` VARCHAR
	 * @var string
	 */
	protected $fax;

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
	 * @return Brokers
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
	 * @return Brokers
	 */
	function setName($value) {
		return $this->setColumnValue('name', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the company field
	 */
	function getCompany() {
		return $this->company;
	}

	/**
	 * Sets the value of the company field
	 * @return Brokers
	 */
	function setCompany($value) {
		return $this->setColumnValue('company', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the address1 field
	 */
	function getAddress1() {
		return $this->address1;
	}

	/**
	 * Sets the value of the address1 field
	 * @return Brokers
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
	 * @return Brokers
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
	 * @return Brokers
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
	 * @return Brokers
	 */
	function setState($value) {
		return $this->setColumnValue('state', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the zip field
	 */
	function getZip() {
		return $this->zip;
	}

	/**
	 * Sets the value of the zip field
	 * @return Brokers
	 */
	function setZip($value) {
		return $this->setColumnValue('zip', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the phone field
	 */
	function getPhone() {
		return $this->phone;
	}

	/**
	 * Sets the value of the phone field
	 * @return Brokers
	 */
	function setPhone($value) {
		return $this->setColumnValue('phone', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the cell field
	 */
	function getCell() {
		return $this->cell;
	}

	/**
	 * Sets the value of the cell field
	 * @return Brokers
	 */
	function setCell($value) {
		return $this->setColumnValue('cell', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the fax field
	 */
	function getFax() {
		return $this->fax;
	}

	/**
	 * Sets the value of the fax field
	 * @return Brokers
	 */
	function setFax($value) {
		return $this->setColumnValue('fax', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the notes field
	 */
	function getNotes() {
		return $this->notes;
	}

	/**
	 * Sets the value of the notes field
	 * @return Brokers
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
	 * @return Brokers
	 */
	static function create() {
		return new Brokers();
	}

	/**
	 * Returns String representation of table name
	 * @return string
	 */
	static function getTableName() {
		return Brokers::$_tableName;
	}

	/**
	 * Access to array of column names
	 * @return array
	 */
	static function getColumnNames() {
		return Brokers::$_columnNames;
	}

	/**
	 * Access to array of column types, indexed by column name
	 * @return array
	 */
	static function getColumnTypes() {
		return Brokers::$_columnTypes;
	}

	/**
	 * Get the type of a column
	 * @return array
	 */
	static function getColumnType($column_name) {
		return Brokers::$_columnTypes[$column_name];
	}

	/**
	 * @return bool
	 */
	static function hasColumn($column_name) {
		static $lower_case_columns = null;
		if (null === $lower_case_columns) {
			$lower_case_columns = array_map('strtolower', Brokers::$_columnNames);
		}
		return in_array(strtolower($column_name), $lower_case_columns);
	}

	/**
	 * Access to array of primary keys
	 * @return array
	 */
	static function getPrimaryKeys() {
		return Brokers::$_primaryKeys;
	}

	/**
	 * Access to name of primary key
	 * @return array
	 */
	static function getPrimaryKey() {
		return Brokers::$_primaryKey;
	}

	/**
	 * Returns true if the primary key column for this table is auto-increment
	 * @return bool
	 */
	static function isAutoIncrement() {
		return Brokers::$_isAutoIncrement;
	}

	/**
	 * Searches the database for a row with the ID(primary key) that matches
	 * the one input.
	 * @return Brokers
	 */
	static function retrieveByPK($the_pk) {
		return Brokers::retrieveByPKs($the_pk);
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return Brokers
	 */
	static function retrieveByPKs($id) {
		if (null === $id) {
			return null;
		}
		$pool_instance = Brokers::retrieveFromPool($id);
		if (null !== $pool_instance) {
			return $pool_instance;
		}
		$conn = Brokers::getConnection();
		$q = new Query;
		$q->add('id', $id);
		return array_shift(Brokers::doSelect($q, true));
	}

	/**
	 * Searches the database for a row with a id	 * value that matches the one provided
	 * @return Brokers
	 */
	static function retrieveById($value) {
		return Brokers::retrieveByPK($value);
	}

	/**
	 * Searches the database for a row with a name	 * value that matches the one provided
	 * @return Brokers
	 */
	static function retrieveByName($value) {
		return Brokers::retrieveByColumn('name', $value);
	}

	/**
	 * Searches the database for a row with a company	 * value that matches the one provided
	 * @return Brokers
	 */
	static function retrieveByCompany($value) {
		return Brokers::retrieveByColumn('company', $value);
	}

	/**
	 * Searches the database for a row with a address1	 * value that matches the one provided
	 * @return Brokers
	 */
	static function retrieveByAddress1($value) {
		return Brokers::retrieveByColumn('address1', $value);
	}

	/**
	 * Searches the database for a row with a address2	 * value that matches the one provided
	 * @return Brokers
	 */
	static function retrieveByAddress2($value) {
		return Brokers::retrieveByColumn('address2', $value);
	}

	/**
	 * Searches the database for a row with a city	 * value that matches the one provided
	 * @return Brokers
	 */
	static function retrieveByCity($value) {
		return Brokers::retrieveByColumn('city', $value);
	}

	/**
	 * Searches the database for a row with a state	 * value that matches the one provided
	 * @return Brokers
	 */
	static function retrieveByState($value) {
		return Brokers::retrieveByColumn('state', $value);
	}

	/**
	 * Searches the database for a row with a zip	 * value that matches the one provided
	 * @return Brokers
	 */
	static function retrieveByZip($value) {
		return Brokers::retrieveByColumn('zip', $value);
	}

	/**
	 * Searches the database for a row with a phone	 * value that matches the one provided
	 * @return Brokers
	 */
	static function retrieveByPhone($value) {
		return Brokers::retrieveByColumn('phone', $value);
	}

	/**
	 * Searches the database for a row with a cell	 * value that matches the one provided
	 * @return Brokers
	 */
	static function retrieveByCell($value) {
		return Brokers::retrieveByColumn('cell', $value);
	}

	/**
	 * Searches the database for a row with a fax	 * value that matches the one provided
	 * @return Brokers
	 */
	static function retrieveByFax($value) {
		return Brokers::retrieveByColumn('fax', $value);
	}

	/**
	 * Searches the database for a row with a notes	 * value that matches the one provided
	 * @return Brokers
	 */
	static function retrieveByNotes($value) {
		return Brokers::retrieveByColumn('notes', $value);
	}

	static function retrieveByColumn($field, $value) {
		$conn = Brokers::getConnection();
		return array_shift(Brokers::doSelect(Query::create()->add($field, $value)->setLimit(1)->order('id')));
	}

	/**
	 * Populates and returns an instance of Brokers with the
	 * first result of a query.  If the query returns no results,
	 * returns null.
	 * @return Brokers
	 */
	static function fetchSingle($query_string, $write_cache = true) {
		return array_shift(Brokers::fetch($query_string, $write_cache));
	}

	/**
	 * Populates and returns an array of Brokers objects with the
	 * results of a query.  If the query returns no results,
	 * returns an empty Array.
	 * @return Brokers[]
	 */
	static function fetch($query_string, $write_cache = false) {
		$conn = Brokers::getConnection();
		$result = $conn->query($query_string);
		return Brokers::fromResult($result, 'Brokers', $write_cache);
	}

	/**
	 * Returns an array of Brokers objects from
	 * a PDOStatement(query result).
	 *
	 * @see BaseModel::fromResult
	 */
	static function fromResult(PDOStatement $result, $class = 'Brokers', $write_cache = false) {
		return baseModel::fromResult($result, $class, $write_cache);
	}

	/**
	 * Casts values of int fields to (int)
	 * @return Brokers
	 */
	function castInts() {
		$this->id = (null === $this->id) ? null : (int) $this->id;
		return $this;
	}

	/**
	 * Add (or replace) to the instance pool.
	 *
	 * @param Brokers $object
	 * @return void
	 */
	static function insertIntoPool(Brokers $object) {
		if (Brokers::$_instancePoolCount > Brokers::MAX_INSTANCE_POOL_SIZE) {
			return;
		}

		Brokers::$_instancePool[implode('-', $object->getPrimaryKeyValues())] = clone $object;
		++Brokers::$_instancePoolCount;
	}

	/**
	 * Return the cached instance from the pool.
	 *
	 * @param mixed $pk Primary Key
	 * @return Brokers
	 */
	static function retrieveFromPool($pk) {
		if (null === $pk) {
			return null;
		}
		if (array_key_exists($pk, Brokers::$_instancePool)) {
			return clone Brokers::$_instancePool[$pk];
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

		if (array_key_exists($pk, Brokers::$_instancePool)) {
			unset(Brokers::$_instancePool[$pk]);
			--Brokers::$_instancePoolCount;
		}
	}

	/**
	 * Empty the instance pool.
	 *
	 * @return void
	 */
	static function flushPool() {
		Brokers::$_instancePool = array();
	}

	/**
	 * Returns an array of all Brokers objects in the database.
	 * $extra SQL can be appended to the query to LIMIT, SORT, and/or GROUP results.
	 * If there are no results, returns an empty Array.
	 * @param $extra string
	 * @return Brokers[]
	 */
	static function getAll($extra = null, $write_cache = false) {
		$conn = Brokers::getConnection();
		$table_quoted = $conn->quoteIdentifier(Brokers::getTableName());
		return Brokers::fetch("SELECT * FROM $table_quoted $extra ", $write_cache);
	}

	/**
	 * @return int
	 */
	static function doCount(Query $q = null) {
		$q = $q ? clone $q : new Query;
		$conn = Brokers::getConnection();
		if (!$q->getTable() || Brokers::getTableName() != $q->getTable()) {
			$q->setTable(Brokers::getTableName());
		}
		return $q->doCount($conn);
	}

	/**
	 * @param Query $q
	 * @param bool $dump_cache
	 * @return int
	 */
	static function doDelete(Query $q, $dump_cache = true) {
		$conn = Brokers::getConnection();
		$q = clone $q;
		if (!$q->getTable() || Brokers::getTableName() != $q->getTable()) {
			$q->setTable(Brokers::getTableName());
		}
		$result = $q->doDelete($conn);

		if ($dump_cache) {
			Brokers::$_instancePool = array();
		}

		return $result;
	}

	/**
	 * @param Query $q The Query object that creates the SELECT query string
	 * @param bool $write_cache Whether or not to store results in instance pool
	 * @param array $additional_classes Array of additional classes for fromResult to instantiate as properties
	 * @return Brokers[]
	 */
	static function doSelect(Query $q = null, $write_cache = false, $additional_classes = null) {
		if (is_array($additional_classes)) {
			array_unshift($additional_classes, 'Brokers');
			$class = $additional_classes;
		} else {
			$class = 'Brokers';
		}

		return Brokers::fromResult(self::doSelectRS($q), $class, $write_cache);
	}

	/**
	 * Executes a select query and returns the PDO result
	 * @return PDOStatement
	 */
	static function doSelectRS(Query $q = null) {
		$q = $q ? clone $q : new Query;
		$conn = Brokers::getConnection();
		if (!$q->getTable() || Brokers::getTableName() != $q->getTable()) {
			$q->setTable(Brokers::getTableName());
		}

		return $q->doSelect($conn);
	}

	/**
	 * @return Brokers[]
	 */
	static function doSelectJoinAll(Query $q = null, $write_cache = false, $join_type = Query::LEFT_JOIN) {
		$q = $q ? clone $q : new Query;
		$columns = $q->getColumns();
		$classes = array();
		$alias = $q->getAlias();
		$this_table = $alias ? $alias : Brokers::getTableName();
		if (!$columns) {
			$columns[] = $this_table . '.*';
		}

		$q->setColumns($columns);
		return Brokers::doSelect($q, $write_cache, $classes);
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
