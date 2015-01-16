<?php
/**
 *		Created by Dan Blaisdell's DABL
 *		Do not alter base files, as they will be overwritten.
 *		To alter the objects, alter the extended classes in
 *		the 'models' folder.
 *
 */
abstract class baseLoadHistory extends ApplicationModel {

	/**
	 * Name of the table
	 * @var string
	 */
	protected static $_tableName = 'load_history';

	/**
	 * Cache of objects retrieved from the database
	 * @var LoadHistory[]
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
		'driverid',
		'pickup_date',
		'unload_date',
		'corp_id',
		'source',
		'destination',
		'contract_pdf',
		'notes',
	);

	/**
	 * array of all column types
	 * @var string[]
	 */
	protected static $_columnTypes = array(
		'id' => BaseModel::COLUMN_TYPE_BIGINT,
		'driverid' => BaseModel::COLUMN_TYPE_BIGINT,
		'pickup_date' => BaseModel::COLUMN_TYPE_DATE,
		'unload_date' => BaseModel::COLUMN_TYPE_DATE,
		'corp_id' => BaseModel::COLUMN_TYPE_VARCHAR,
		'source' => BaseModel::COLUMN_TYPE_VARCHAR,
		'destination' => BaseModel::COLUMN_TYPE_VARCHAR,
		'contract_pdf' => BaseModel::COLUMN_TYPE_VARCHAR,
		'notes' => BaseModel::COLUMN_TYPE_LONGVARCHAR,
	);

	/**
	 * `id` BIGINT NOT NULL DEFAULT ''
	 * @var string
	 */
	protected $id;

	/**
	 * `driverid` BIGINT DEFAULT ''
	 * @var string
	 */
	protected $driverid;

	/**
	 * `pickup_date` DATE
	 * @var string
	 */
	protected $pickup_date;

	/**
	 * `unload_date` DATE
	 * @var string
	 */
	protected $unload_date;

	/**
	 * `corp_id` VARCHAR
	 * @var string
	 */
	protected $corp_id;

	/**
	 * `source` VARCHAR
	 * @var string
	 */
	protected $source;

	/**
	 * `destination` VARCHAR
	 * @var string
	 */
	protected $destination;

	/**
	 * `contract_pdf` VARCHAR
	 * @var string
	 */
	protected $contract_pdf;

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
	 * @return LoadHistory
	 */
	function setId($value) {
		return $this->setColumnValue('id', $value, BaseModel::COLUMN_TYPE_BIGINT);
	}

	/**
	 * Gets the value of the driverid field
	 */
	function getDriverid() {
		return $this->driverid;
	}

	/**
	 * Sets the value of the driverid field
	 * @return LoadHistory
	 */
	function setDriverid($value) {
		return $this->setColumnValue('driverid', $value, BaseModel::COLUMN_TYPE_BIGINT);
	}

	/**
	 * Gets the value of the pickup_date field
	 */
	function getPickup_date($format = null) {
		if (null === $this->pickup_date || null === $format) {
			return $this->pickup_date;
		}
		if (0 === strpos($this->pickup_date, '0000-00-00')) {
			return null;
		}
		return date($format, strtotime($this->pickup_date));
	}

	/**
	 * Sets the value of the pickup_date field
	 * @return LoadHistory
	 */
	function setPickup_date($value) {
		return $this->setColumnValue('pickup_date', $value, BaseModel::COLUMN_TYPE_DATE);
	}

	/**
	 * Gets the value of the pickup_date field
	 */
	function getPickupDate($format = null) {
		return $this->getPickup_date($format);
	}

	/**
	 * Sets the value of the pickup_date field
	 * @return LoadHistory
	 */
	function setPickupDate($value) {
		return $this->setPickup_date($value);
	}

	/**
	 * Gets the value of the unload_date field
	 */
	function getUnload_date($format = null) {
		if (null === $this->unload_date || null === $format) {
			return $this->unload_date;
		}
		if (0 === strpos($this->unload_date, '0000-00-00')) {
			return null;
		}
		return date($format, strtotime($this->unload_date));
	}

	/**
	 * Sets the value of the unload_date field
	 * @return LoadHistory
	 */
	function setUnload_date($value) {
		return $this->setColumnValue('unload_date', $value, BaseModel::COLUMN_TYPE_DATE);
	}

	/**
	 * Gets the value of the unload_date field
	 */
	function getUnloadDate($format = null) {
		return $this->getUnload_date($format);
	}

	/**
	 * Sets the value of the unload_date field
	 * @return LoadHistory
	 */
	function setUnloadDate($value) {
		return $this->setUnload_date($value);
	}

	/**
	 * Gets the value of the corp_id field
	 */
	function getCorp_id() {
		return $this->corp_id;
	}

	/**
	 * Sets the value of the corp_id field
	 * @return LoadHistory
	 */
	function setCorp_id($value) {
		return $this->setColumnValue('corp_id', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the corp_id field
	 */
	function getCorpId() {
		return $this->getCorp_id();
	}

	/**
	 * Sets the value of the corp_id field
	 * @return LoadHistory
	 */
	function setCorpId($value) {
		return $this->setCorp_id($value);
	}

	/**
	 * Gets the value of the source field
	 */
	function getSource() {
		return $this->source;
	}

	/**
	 * Sets the value of the source field
	 * @return LoadHistory
	 */
	function setSource($value) {
		return $this->setColumnValue('source', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the destination field
	 */
	function getDestination() {
		return $this->destination;
	}

	/**
	 * Sets the value of the destination field
	 * @return LoadHistory
	 */
	function setDestination($value) {
		return $this->setColumnValue('destination', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the contract_pdf field
	 */
	function getContract_pdf() {
		return $this->contract_pdf;
	}

	/**
	 * Sets the value of the contract_pdf field
	 * @return LoadHistory
	 */
	function setContract_pdf($value) {
		return $this->setColumnValue('contract_pdf', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the contract_pdf field
	 */
	function getContractPdf() {
		return $this->getContract_pdf();
	}

	/**
	 * Sets the value of the contract_pdf field
	 * @return LoadHistory
	 */
	function setContractPdf($value) {
		return $this->setContract_pdf($value);
	}

	/**
	 * Gets the value of the notes field
	 */
	function getNotes() {
		return $this->notes;
	}

	/**
	 * Sets the value of the notes field
	 * @return LoadHistory
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
	 * @return LoadHistory
	 */
	static function create() {
		return new LoadHistory();
	}

	/**
	 * Returns String representation of table name
	 * @return string
	 */
	static function getTableName() {
		return LoadHistory::$_tableName;
	}

	/**
	 * Access to array of column names
	 * @return array
	 */
	static function getColumnNames() {
		return LoadHistory::$_columnNames;
	}

	/**
	 * Access to array of column types, indexed by column name
	 * @return array
	 */
	static function getColumnTypes() {
		return LoadHistory::$_columnTypes;
	}

	/**
	 * Get the type of a column
	 * @return array
	 */
	static function getColumnType($column_name) {
		return LoadHistory::$_columnTypes[$column_name];
	}

	/**
	 * @return bool
	 */
	static function hasColumn($column_name) {
		static $lower_case_columns = null;
		if (null === $lower_case_columns) {
			$lower_case_columns = array_map('strtolower', LoadHistory::$_columnNames);
		}
		return in_array(strtolower($column_name), $lower_case_columns);
	}

	/**
	 * Access to array of primary keys
	 * @return array
	 */
	static function getPrimaryKeys() {
		return LoadHistory::$_primaryKeys;
	}

	/**
	 * Access to name of primary key
	 * @return array
	 */
	static function getPrimaryKey() {
		return LoadHistory::$_primaryKey;
	}

	/**
	 * Returns true if the primary key column for this table is auto-increment
	 * @return bool
	 */
	static function isAutoIncrement() {
		return LoadHistory::$_isAutoIncrement;
	}

	/**
	 * Searches the database for a row with the ID(primary key) that matches
	 * the one input.
	 * @return LoadHistory
	 */
	static function retrieveByPK($the_pk) {
		return LoadHistory::retrieveByPKs($the_pk);
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return LoadHistory
	 */
	static function retrieveByPKs($id) {
		if (null === $id) {
			return null;
		}
		$pool_instance = LoadHistory::retrieveFromPool($id);
		if (null !== $pool_instance) {
			return $pool_instance;
		}
		$conn = LoadHistory::getConnection();
		$q = new Query;
		$q->add('id', $id);
		return array_shift(LoadHistory::doSelect($q, true));
	}

	/**
	 * Searches the database for a row with a id	 * value that matches the one provided
	 * @return LoadHistory
	 */
	static function retrieveById($value) {
		return LoadHistory::retrieveByPK($value);
	}

	/**
	 * Searches the database for a row with a driverid	 * value that matches the one provided
	 * @return LoadHistory
	 */
	static function retrieveByDriverid($value) {
		return LoadHistory::retrieveByColumn('driverid', $value);
	}

	/**
	 * Searches the database for a row with a pickup_date	 * value that matches the one provided
	 * @return LoadHistory
	 */
	static function retrieveByPickupDate($value) {
		return LoadHistory::retrieveByColumn('pickup_date', $value);
	}

	/**
	 * Searches the database for a row with a unload_date	 * value that matches the one provided
	 * @return LoadHistory
	 */
	static function retrieveByUnloadDate($value) {
		return LoadHistory::retrieveByColumn('unload_date', $value);
	}

	/**
	 * Searches the database for a row with a corp_id	 * value that matches the one provided
	 * @return LoadHistory
	 */
	static function retrieveByCorpId($value) {
		return LoadHistory::retrieveByColumn('corp_id', $value);
	}

	/**
	 * Searches the database for a row with a source	 * value that matches the one provided
	 * @return LoadHistory
	 */
	static function retrieveBySource($value) {
		return LoadHistory::retrieveByColumn('source', $value);
	}

	/**
	 * Searches the database for a row with a destination	 * value that matches the one provided
	 * @return LoadHistory
	 */
	static function retrieveByDestination($value) {
		return LoadHistory::retrieveByColumn('destination', $value);
	}

	/**
	 * Searches the database for a row with a contract_pdf	 * value that matches the one provided
	 * @return LoadHistory
	 */
	static function retrieveByContractPdf($value) {
		return LoadHistory::retrieveByColumn('contract_pdf', $value);
	}

	/**
	 * Searches the database for a row with a notes	 * value that matches the one provided
	 * @return LoadHistory
	 */
	static function retrieveByNotes($value) {
		return LoadHistory::retrieveByColumn('notes', $value);
	}

	static function retrieveByColumn($field, $value) {
		$conn = LoadHistory::getConnection();
		return array_shift(LoadHistory::doSelect(Query::create()->add($field, $value)->setLimit(1)->order('id')));
	}

	/**
	 * Populates and returns an instance of LoadHistory with the
	 * first result of a query.  If the query returns no results,
	 * returns null.
	 * @return LoadHistory
	 */
	static function fetchSingle($query_string, $write_cache = true) {
		return array_shift(LoadHistory::fetch($query_string, $write_cache));
	}

	/**
	 * Populates and returns an array of LoadHistory objects with the
	 * results of a query.  If the query returns no results,
	 * returns an empty Array.
	 * @return LoadHistory[]
	 */
	static function fetch($query_string, $write_cache = false) {
		$conn = LoadHistory::getConnection();
		$result = $conn->query($query_string);
		return LoadHistory::fromResult($result, 'LoadHistory', $write_cache);
	}

	/**
	 * Returns an array of LoadHistory objects from
	 * a PDOStatement(query result).
	 *
	 * @see BaseModel::fromResult
	 */
	static function fromResult(PDOStatement $result, $class = 'LoadHistory', $write_cache = false) {
		return baseModel::fromResult($result, $class, $write_cache);
	}

	/**
	 * Casts values of int fields to (int)
	 * @return LoadHistory
	 */
	function castInts() {
		$this->id = (null === $this->id) ? null : (int) $this->id;
		$this->driverid = (null === $this->driverid) ? null : (int) $this->driverid;
		return $this;
	}

	/**
	 * Add (or replace) to the instance pool.
	 *
	 * @param LoadHistory $object
	 * @return void
	 */
	static function insertIntoPool(LoadHistory $object) {
		if (LoadHistory::$_instancePoolCount > LoadHistory::MAX_INSTANCE_POOL_SIZE) {
			return;
		}

		LoadHistory::$_instancePool[implode('-', $object->getPrimaryKeyValues())] = clone $object;
		++LoadHistory::$_instancePoolCount;
	}

	/**
	 * Return the cached instance from the pool.
	 *
	 * @param mixed $pk Primary Key
	 * @return LoadHistory
	 */
	static function retrieveFromPool($pk) {
		if (null === $pk) {
			return null;
		}
		if (array_key_exists($pk, LoadHistory::$_instancePool)) {
			return clone LoadHistory::$_instancePool[$pk];
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

		if (array_key_exists($pk, LoadHistory::$_instancePool)) {
			unset(LoadHistory::$_instancePool[$pk]);
			--LoadHistory::$_instancePoolCount;
		}
	}

	/**
	 * Empty the instance pool.
	 *
	 * @return void
	 */
	static function flushPool() {
		LoadHistory::$_instancePool = array();
	}

	/**
	 * Returns an array of all LoadHistory objects in the database.
	 * $extra SQL can be appended to the query to LIMIT, SORT, and/or GROUP results.
	 * If there are no results, returns an empty Array.
	 * @param $extra string
	 * @return LoadHistory[]
	 */
	static function getAll($extra = null, $write_cache = false) {
		$conn = LoadHistory::getConnection();
		$table_quoted = $conn->quoteIdentifier(LoadHistory::getTableName());
		return LoadHistory::fetch("SELECT * FROM $table_quoted $extra ", $write_cache);
	}

	/**
	 * @return int
	 */
	static function doCount(Query $q = null) {
		$q = $q ? clone $q : new Query;
		$conn = LoadHistory::getConnection();
		if (!$q->getTable() || LoadHistory::getTableName() != $q->getTable()) {
			$q->setTable(LoadHistory::getTableName());
		}
		return $q->doCount($conn);
	}

	/**
	 * @param Query $q
	 * @param bool $dump_cache
	 * @return int
	 */
	static function doDelete(Query $q, $dump_cache = true) {
		$conn = LoadHistory::getConnection();
		$q = clone $q;
		if (!$q->getTable() || LoadHistory::getTableName() != $q->getTable()) {
			$q->setTable(LoadHistory::getTableName());
		}
		$result = $q->doDelete($conn);

		if ($dump_cache) {
			LoadHistory::$_instancePool = array();
		}

		return $result;
	}

	/**
	 * @param Query $q The Query object that creates the SELECT query string
	 * @param bool $write_cache Whether or not to store results in instance pool
	 * @param array $additional_classes Array of additional classes for fromResult to instantiate as properties
	 * @return LoadHistory[]
	 */
	static function doSelect(Query $q = null, $write_cache = false, $additional_classes = null) {
		if (is_array($additional_classes)) {
			array_unshift($additional_classes, 'LoadHistory');
			$class = $additional_classes;
		} else {
			$class = 'LoadHistory';
		}

		return LoadHistory::fromResult(self::doSelectRS($q), $class, $write_cache);
	}

	/**
	 * Executes a select query and returns the PDO result
	 * @return PDOStatement
	 */
	static function doSelectRS(Query $q = null) {
		$q = $q ? clone $q : new Query;
		$conn = LoadHistory::getConnection();
		if (!$q->getTable() || LoadHistory::getTableName() != $q->getTable()) {
			$q->setTable(LoadHistory::getTableName());
		}

		return $q->doSelect($conn);
	}

	/**
	 * @return LoadHistory[]
	 */
	static function doSelectJoinAll(Query $q = null, $write_cache = false, $join_type = Query::LEFT_JOIN) {
		$q = $q ? clone $q : new Query;
		$columns = $q->getColumns();
		$classes = array();
		$alias = $q->getAlias();
		$this_table = $alias ? $alias : LoadHistory::getTableName();
		if (!$columns) {
			$columns[] = $this_table . '.*';
		}

		$q->setColumns($columns);
		return LoadHistory::doSelect($q, $write_cache, $classes);
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
