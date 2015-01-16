<?php
/**
 *		Created by Dan Blaisdell's DABL
 *		Do not alter base files, as they will be overwritten.
 *		To alter the objects, alter the extended classes in
 *		the 'models' folder.
 *
 */
abstract class baseBrokerAgents extends ApplicationModel {

	/**
	 * Name of the table
	 * @var string
	 */
	protected static $_tableName = 'broker_agents';

	/**
	 * Cache of objects retrieved from the database
	 * @var BrokerAgents[]
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
		'brokerid',
		'agent_name',
		'agent_phone',
		'agent_fax',
		'agent_email',
	);

	/**
	 * array of all column types
	 * @var string[]
	 */
	protected static $_columnTypes = array(
		'id' => BaseModel::COLUMN_TYPE_BIGINT,
		'brokerid' => BaseModel::COLUMN_TYPE_BIGINT,
		'agent_name' => BaseModel::COLUMN_TYPE_VARCHAR,
		'agent_phone' => BaseModel::COLUMN_TYPE_VARCHAR,
		'agent_fax' => BaseModel::COLUMN_TYPE_VARCHAR,
		'agent_email' => BaseModel::COLUMN_TYPE_VARCHAR,
	);

	/**
	 * `id` BIGINT NOT NULL DEFAULT ''
	 * @var string
	 */
	protected $id;

	/**
	 * `brokerid` BIGINT DEFAULT ''
	 * @var string
	 */
	protected $brokerid;

	/**
	 * `agent_name` VARCHAR
	 * @var string
	 */
	protected $agent_name;

	/**
	 * `agent_phone` VARCHAR
	 * @var string
	 */
	protected $agent_phone;

	/**
	 * `agent_fax` VARCHAR
	 * @var string
	 */
	protected $agent_fax;

	/**
	 * `agent_email` VARCHAR
	 * @var string
	 */
	protected $agent_email;

	/**
	 * Gets the value of the id field
	 */
	function getId() {
		return $this->id;
	}

	/**
	 * Sets the value of the id field
	 * @return BrokerAgents
	 */
	function setId($value) {
		return $this->setColumnValue('id', $value, BaseModel::COLUMN_TYPE_BIGINT);
	}

	/**
	 * Gets the value of the brokerid field
	 */
	function getBrokerid() {
		return $this->brokerid;
	}

	/**
	 * Sets the value of the brokerid field
	 * @return BrokerAgents
	 */
	function setBrokerid($value) {
		return $this->setColumnValue('brokerid', $value, BaseModel::COLUMN_TYPE_BIGINT);
	}

	/**
	 * Gets the value of the agent_name field
	 */
	function getAgent_name() {
		return $this->agent_name;
	}

	/**
	 * Sets the value of the agent_name field
	 * @return BrokerAgents
	 */
	function setAgent_name($value) {
		return $this->setColumnValue('agent_name', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the agent_name field
	 */
	function getAgentName() {
		return $this->getAgent_name();
	}

	/**
	 * Sets the value of the agent_name field
	 * @return BrokerAgents
	 */
	function setAgentName($value) {
		return $this->setAgent_name($value);
	}

	/**
	 * Gets the value of the agent_phone field
	 */
	function getAgent_phone() {
		return $this->agent_phone;
	}

	/**
	 * Sets the value of the agent_phone field
	 * @return BrokerAgents
	 */
	function setAgent_phone($value) {
		return $this->setColumnValue('agent_phone', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the agent_phone field
	 */
	function getAgentPhone() {
		return $this->getAgent_phone();
	}

	/**
	 * Sets the value of the agent_phone field
	 * @return BrokerAgents
	 */
	function setAgentPhone($value) {
		return $this->setAgent_phone($value);
	}

	/**
	 * Gets the value of the agent_fax field
	 */
	function getAgent_fax() {
		return $this->agent_fax;
	}

	/**
	 * Sets the value of the agent_fax field
	 * @return BrokerAgents
	 */
	function setAgent_fax($value) {
		return $this->setColumnValue('agent_fax', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the agent_fax field
	 */
	function getAgentFax() {
		return $this->getAgent_fax();
	}

	/**
	 * Sets the value of the agent_fax field
	 * @return BrokerAgents
	 */
	function setAgentFax($value) {
		return $this->setAgent_fax($value);
	}

	/**
	 * Gets the value of the agent_email field
	 */
	function getAgent_email() {
		return $this->agent_email;
	}

	/**
	 * Sets the value of the agent_email field
	 * @return BrokerAgents
	 */
	function setAgent_email($value) {
		return $this->setColumnValue('agent_email', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the agent_email field
	 */
	function getAgentEmail() {
		return $this->getAgent_email();
	}

	/**
	 * Sets the value of the agent_email field
	 * @return BrokerAgents
	 */
	function setAgentEmail($value) {
		return $this->setAgent_email($value);
	}

	/**
	 * @return DABLPDO
	 */
	static function getConnection() {
		return DBManager::getConnection('default_mysqll');
	}

	/**
	 * @return BrokerAgents
	 */
	static function create() {
		return new BrokerAgents();
	}

	/**
	 * Returns String representation of table name
	 * @return string
	 */
	static function getTableName() {
		return BrokerAgents::$_tableName;
	}

	/**
	 * Access to array of column names
	 * @return array
	 */
	static function getColumnNames() {
		return BrokerAgents::$_columnNames;
	}

	/**
	 * Access to array of column types, indexed by column name
	 * @return array
	 */
	static function getColumnTypes() {
		return BrokerAgents::$_columnTypes;
	}

	/**
	 * Get the type of a column
	 * @return array
	 */
	static function getColumnType($column_name) {
		return BrokerAgents::$_columnTypes[$column_name];
	}

	/**
	 * @return bool
	 */
	static function hasColumn($column_name) {
		static $lower_case_columns = null;
		if (null === $lower_case_columns) {
			$lower_case_columns = array_map('strtolower', BrokerAgents::$_columnNames);
		}
		return in_array(strtolower($column_name), $lower_case_columns);
	}

	/**
	 * Access to array of primary keys
	 * @return array
	 */
	static function getPrimaryKeys() {
		return BrokerAgents::$_primaryKeys;
	}

	/**
	 * Access to name of primary key
	 * @return array
	 */
	static function getPrimaryKey() {
		return BrokerAgents::$_primaryKey;
	}

	/**
	 * Returns true if the primary key column for this table is auto-increment
	 * @return bool
	 */
	static function isAutoIncrement() {
		return BrokerAgents::$_isAutoIncrement;
	}

	/**
	 * Searches the database for a row with the ID(primary key) that matches
	 * the one input.
	 * @return BrokerAgents
	 */
	static function retrieveByPK($the_pk) {
		return BrokerAgents::retrieveByPKs($the_pk);
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return BrokerAgents
	 */
	static function retrieveByPKs($id) {
		if (null === $id) {
			return null;
		}
		$pool_instance = BrokerAgents::retrieveFromPool($id);
		if (null !== $pool_instance) {
			return $pool_instance;
		}
		$conn = BrokerAgents::getConnection();
		$q = new Query;
		$q->add('id', $id);
		return array_shift(BrokerAgents::doSelect($q, true));
	}

	/**
	 * Searches the database for a row with a id	 * value that matches the one provided
	 * @return BrokerAgents
	 */
	static function retrieveById($value) {
		return BrokerAgents::retrieveByPK($value);
	}

	/**
	 * Searches the database for a row with a brokerid	 * value that matches the one provided
	 * @return BrokerAgents
	 */
	static function retrieveByBrokerid($value) {
		return BrokerAgents::retrieveByColumn('brokerid', $value);
	}

	/**
	 * Searches the database for a row with a agent_name	 * value that matches the one provided
	 * @return BrokerAgents
	 */
	static function retrieveByAgentName($value) {
		return BrokerAgents::retrieveByColumn('agent_name', $value);
	}

	/**
	 * Searches the database for a row with a agent_phone	 * value that matches the one provided
	 * @return BrokerAgents
	 */
	static function retrieveByAgentPhone($value) {
		return BrokerAgents::retrieveByColumn('agent_phone', $value);
	}

	/**
	 * Searches the database for a row with a agent_fax	 * value that matches the one provided
	 * @return BrokerAgents
	 */
	static function retrieveByAgentFax($value) {
		return BrokerAgents::retrieveByColumn('agent_fax', $value);
	}

	/**
	 * Searches the database for a row with a agent_email	 * value that matches the one provided
	 * @return BrokerAgents
	 */
	static function retrieveByAgentEmail($value) {
		return BrokerAgents::retrieveByColumn('agent_email', $value);
	}

	static function retrieveByColumn($field, $value) {
		$conn = BrokerAgents::getConnection();
		return array_shift(BrokerAgents::doSelect(Query::create()->add($field, $value)->setLimit(1)->order('id')));
	}

	/**
	 * Populates and returns an instance of BrokerAgents with the
	 * first result of a query.  If the query returns no results,
	 * returns null.
	 * @return BrokerAgents
	 */
	static function fetchSingle($query_string, $write_cache = true) {
		return array_shift(BrokerAgents::fetch($query_string, $write_cache));
	}

	/**
	 * Populates and returns an array of BrokerAgents objects with the
	 * results of a query.  If the query returns no results,
	 * returns an empty Array.
	 * @return BrokerAgents[]
	 */
	static function fetch($query_string, $write_cache = false) {
		$conn = BrokerAgents::getConnection();
		$result = $conn->query($query_string);
		return BrokerAgents::fromResult($result, 'BrokerAgents', $write_cache);
	}

	/**
	 * Returns an array of BrokerAgents objects from
	 * a PDOStatement(query result).
	 *
	 * @see BaseModel::fromResult
	 */
	static function fromResult(PDOStatement $result, $class = 'BrokerAgents', $write_cache = false) {
		return baseModel::fromResult($result, $class, $write_cache);
	}

	/**
	 * Casts values of int fields to (int)
	 * @return BrokerAgents
	 */
	function castInts() {
		$this->id = (null === $this->id) ? null : (int) $this->id;
		$this->brokerid = (null === $this->brokerid) ? null : (int) $this->brokerid;
		return $this;
	}

	/**
	 * Add (or replace) to the instance pool.
	 *
	 * @param BrokerAgents $object
	 * @return void
	 */
	static function insertIntoPool(BrokerAgents $object) {
		if (BrokerAgents::$_instancePoolCount > BrokerAgents::MAX_INSTANCE_POOL_SIZE) {
			return;
		}

		BrokerAgents::$_instancePool[implode('-', $object->getPrimaryKeyValues())] = clone $object;
		++BrokerAgents::$_instancePoolCount;
	}

	/**
	 * Return the cached instance from the pool.
	 *
	 * @param mixed $pk Primary Key
	 * @return BrokerAgents
	 */
	static function retrieveFromPool($pk) {
		if (null === $pk) {
			return null;
		}
		if (array_key_exists($pk, BrokerAgents::$_instancePool)) {
			return clone BrokerAgents::$_instancePool[$pk];
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

		if (array_key_exists($pk, BrokerAgents::$_instancePool)) {
			unset(BrokerAgents::$_instancePool[$pk]);
			--BrokerAgents::$_instancePoolCount;
		}
	}

	/**
	 * Empty the instance pool.
	 *
	 * @return void
	 */
	static function flushPool() {
		BrokerAgents::$_instancePool = array();
	}

	/**
	 * Returns an array of all BrokerAgents objects in the database.
	 * $extra SQL can be appended to the query to LIMIT, SORT, and/or GROUP results.
	 * If there are no results, returns an empty Array.
	 * @param $extra string
	 * @return BrokerAgents[]
	 */
	static function getAll($extra = null, $write_cache = false) {
		$conn = BrokerAgents::getConnection();
		$table_quoted = $conn->quoteIdentifier(BrokerAgents::getTableName());
		return BrokerAgents::fetch("SELECT * FROM $table_quoted $extra ", $write_cache);
	}

	/**
	 * @return int
	 */
	static function doCount(Query $q = null) {
		$q = $q ? clone $q : new Query;
		$conn = BrokerAgents::getConnection();
		if (!$q->getTable() || BrokerAgents::getTableName() != $q->getTable()) {
			$q->setTable(BrokerAgents::getTableName());
		}
		return $q->doCount($conn);
	}

	/**
	 * @param Query $q
	 * @param bool $dump_cache
	 * @return int
	 */
	static function doDelete(Query $q, $dump_cache = true) {
		$conn = BrokerAgents::getConnection();
		$q = clone $q;
		if (!$q->getTable() || BrokerAgents::getTableName() != $q->getTable()) {
			$q->setTable(BrokerAgents::getTableName());
		}
		$result = $q->doDelete($conn);

		if ($dump_cache) {
			BrokerAgents::$_instancePool = array();
		}

		return $result;
	}

	/**
	 * @param Query $q The Query object that creates the SELECT query string
	 * @param bool $write_cache Whether or not to store results in instance pool
	 * @param array $additional_classes Array of additional classes for fromResult to instantiate as properties
	 * @return BrokerAgents[]
	 */
	static function doSelect(Query $q = null, $write_cache = false, $additional_classes = null) {
		if (is_array($additional_classes)) {
			array_unshift($additional_classes, 'BrokerAgents');
			$class = $additional_classes;
		} else {
			$class = 'BrokerAgents';
		}

		return BrokerAgents::fromResult(self::doSelectRS($q), $class, $write_cache);
	}

	/**
	 * Executes a select query and returns the PDO result
	 * @return PDOStatement
	 */
	static function doSelectRS(Query $q = null) {
		$q = $q ? clone $q : new Query;
		$conn = BrokerAgents::getConnection();
		if (!$q->getTable() || BrokerAgents::getTableName() != $q->getTable()) {
			$q->setTable(BrokerAgents::getTableName());
		}

		return $q->doSelect($conn);
	}

	/**
	 * @return BrokerAgents[]
	 */
	static function doSelectJoinAll(Query $q = null, $write_cache = false, $join_type = Query::LEFT_JOIN) {
		$q = $q ? clone $q : new Query;
		$columns = $q->getColumns();
		$classes = array();
		$alias = $q->getAlias();
		$this_table = $alias ? $alias : BrokerAgents::getTableName();
		if (!$columns) {
			$columns[] = $this_table . '.*';
		}

		$q->setColumns($columns);
		return BrokerAgents::doSelect($q, $write_cache, $classes);
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
