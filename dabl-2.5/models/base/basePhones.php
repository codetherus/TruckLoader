<?php
/**
 *		Created by Dan Blaisdell's DABL
 *		Do not alter base files, as they will be overwritten.
 *		To alter the objects, alter the extended classes in
 *		the 'models' folder.
 *
 */
abstract class basePhones extends ApplicationModel {

	/**
	 * Name of the table
	 * @var string
	 */
	protected static $_tableName = 'phones';

	/**
	 * Cache of objects retrieved from the database
	 * @var Phones[]
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
		'contact_type',
		'entityid',
		'entity',
		'entity_type',
		'entity_name',
	);

	/**
	 * array of all column types
	 * @var string[]
	 */
	protected static $_columnTypes = array(
		'id' => BaseModel::COLUMN_TYPE_BIGINT,
		'contact_type' => BaseModel::COLUMN_TYPE_VARCHAR,
		'entityid' => BaseModel::COLUMN_TYPE_BIGINT,
		'entity' => BaseModel::COLUMN_TYPE_VARCHAR,
		'entity_type' => BaseModel::COLUMN_TYPE_VARCHAR,
		'entity_name' => BaseModel::COLUMN_TYPE_VARCHAR,
	);

	/**
	 * `id` BIGINT NOT NULL DEFAULT ''
	 * @var string
	 */
	protected $id;

	/**
	 * `contact_type` VARCHAR
	 * @var string
	 */
	protected $contact_type;

	/**
	 * `entityid` BIGINT DEFAULT ''
	 * @var string
	 */
	protected $entityid;

	/**
	 * `entity` VARCHAR
	 * @var string
	 */
	protected $entity;

	/**
	 * `entity_type` VARCHAR
	 * @var string
	 */
	protected $entity_type;

	/**
	 * `entity_name` VARCHAR
	 * @var string
	 */
	protected $entity_name;

	/**
	 * Gets the value of the id field
	 */
	function getId() {
		return $this->id;
	}

	/**
	 * Sets the value of the id field
	 * @return Phones
	 */
	function setId($value) {
		return $this->setColumnValue('id', $value, BaseModel::COLUMN_TYPE_BIGINT);
	}

	/**
	 * Gets the value of the contact_type field
	 */
	function getContact_type() {
		return $this->contact_type;
	}

	/**
	 * Sets the value of the contact_type field
	 * @return Phones
	 */
	function setContact_type($value) {
		return $this->setColumnValue('contact_type', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the contact_type field
	 */
	function getContactType() {
		return $this->getContact_type();
	}

	/**
	 * Sets the value of the contact_type field
	 * @return Phones
	 */
	function setContactType($value) {
		return $this->setContact_type($value);
	}

	/**
	 * Gets the value of the entityid field
	 */
	function getEntityid() {
		return $this->entityid;
	}

	/**
	 * Sets the value of the entityid field
	 * @return Phones
	 */
	function setEntityid($value) {
		return $this->setColumnValue('entityid', $value, BaseModel::COLUMN_TYPE_BIGINT);
	}

	/**
	 * Gets the value of the entity field
	 */
	function getEntity() {
		return $this->entity;
	}

	/**
	 * Sets the value of the entity field
	 * @return Phones
	 */
	function setEntity($value) {
		return $this->setColumnValue('entity', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the entity_type field
	 */
	function getEntity_type() {
		return $this->entity_type;
	}

	/**
	 * Sets the value of the entity_type field
	 * @return Phones
	 */
	function setEntity_type($value) {
		return $this->setColumnValue('entity_type', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the entity_type field
	 */
	function getEntityType() {
		return $this->getEntity_type();
	}

	/**
	 * Sets the value of the entity_type field
	 * @return Phones
	 */
	function setEntityType($value) {
		return $this->setEntity_type($value);
	}

	/**
	 * Gets the value of the entity_name field
	 */
	function getEntity_name() {
		return $this->entity_name;
	}

	/**
	 * Sets the value of the entity_name field
	 * @return Phones
	 */
	function setEntity_name($value) {
		return $this->setColumnValue('entity_name', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the entity_name field
	 */
	function getEntityName() {
		return $this->getEntity_name();
	}

	/**
	 * Sets the value of the entity_name field
	 * @return Phones
	 */
	function setEntityName($value) {
		return $this->setEntity_name($value);
	}

	/**
	 * @return DABLPDO
	 */
	static function getConnection() {
		return DBManager::getConnection('default_mysqll');
	}

	/**
	 * @return Phones
	 */
	static function create() {
		return new Phones();
	}

	/**
	 * Returns String representation of table name
	 * @return string
	 */
	static function getTableName() {
		return Phones::$_tableName;
	}

	/**
	 * Access to array of column names
	 * @return array
	 */
	static function getColumnNames() {
		return Phones::$_columnNames;
	}

	/**
	 * Access to array of column types, indexed by column name
	 * @return array
	 */
	static function getColumnTypes() {
		return Phones::$_columnTypes;
	}

	/**
	 * Get the type of a column
	 * @return array
	 */
	static function getColumnType($column_name) {
		return Phones::$_columnTypes[$column_name];
	}

	/**
	 * @return bool
	 */
	static function hasColumn($column_name) {
		static $lower_case_columns = null;
		if (null === $lower_case_columns) {
			$lower_case_columns = array_map('strtolower', Phones::$_columnNames);
		}
		return in_array(strtolower($column_name), $lower_case_columns);
	}

	/**
	 * Access to array of primary keys
	 * @return array
	 */
	static function getPrimaryKeys() {
		return Phones::$_primaryKeys;
	}

	/**
	 * Access to name of primary key
	 * @return array
	 */
	static function getPrimaryKey() {
		return Phones::$_primaryKey;
	}

	/**
	 * Returns true if the primary key column for this table is auto-increment
	 * @return bool
	 */
	static function isAutoIncrement() {
		return Phones::$_isAutoIncrement;
	}

	/**
	 * Searches the database for a row with the ID(primary key) that matches
	 * the one input.
	 * @return Phones
	 */
	static function retrieveByPK($the_pk) {
		return Phones::retrieveByPKs($the_pk);
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return Phones
	 */
	static function retrieveByPKs($id) {
		if (null === $id) {
			return null;
		}
		$pool_instance = Phones::retrieveFromPool($id);
		if (null !== $pool_instance) {
			return $pool_instance;
		}
		$conn = Phones::getConnection();
		$q = new Query;
		$q->add('id', $id);
		return array_shift(Phones::doSelect($q, true));
	}

	/**
	 * Searches the database for a row with a id	 * value that matches the one provided
	 * @return Phones
	 */
	static function retrieveById($value) {
		return Phones::retrieveByPK($value);
	}

	/**
	 * Searches the database for a row with a contact_type	 * value that matches the one provided
	 * @return Phones
	 */
	static function retrieveByContactType($value) {
		return Phones::retrieveByColumn('contact_type', $value);
	}

	/**
	 * Searches the database for a row with a entityid	 * value that matches the one provided
	 * @return Phones
	 */
	static function retrieveByEntityid($value) {
		return Phones::retrieveByColumn('entityid', $value);
	}

	/**
	 * Searches the database for a row with a entity	 * value that matches the one provided
	 * @return Phones
	 */
	static function retrieveByEntity($value) {
		return Phones::retrieveByColumn('entity', $value);
	}

	/**
	 * Searches the database for a row with a entity_type	 * value that matches the one provided
	 * @return Phones
	 */
	static function retrieveByEntityType($value) {
		return Phones::retrieveByColumn('entity_type', $value);
	}

	/**
	 * Searches the database for a row with a entity_name	 * value that matches the one provided
	 * @return Phones
	 */
	static function retrieveByEntityName($value) {
		return Phones::retrieveByColumn('entity_name', $value);
	}

	static function retrieveByColumn($field, $value) {
		$conn = Phones::getConnection();
		return array_shift(Phones::doSelect(Query::create()->add($field, $value)->setLimit(1)->order('id')));
	}

	/**
	 * Populates and returns an instance of Phones with the
	 * first result of a query.  If the query returns no results,
	 * returns null.
	 * @return Phones
	 */
	static function fetchSingle($query_string, $write_cache = true) {
		return array_shift(Phones::fetch($query_string, $write_cache));
	}

	/**
	 * Populates and returns an array of Phones objects with the
	 * results of a query.  If the query returns no results,
	 * returns an empty Array.
	 * @return Phones[]
	 */
	static function fetch($query_string, $write_cache = false) {
		$conn = Phones::getConnection();
		$result = $conn->query($query_string);
		return Phones::fromResult($result, 'Phones', $write_cache);
	}

	/**
	 * Returns an array of Phones objects from
	 * a PDOStatement(query result).
	 *
	 * @see BaseModel::fromResult
	 */
	static function fromResult(PDOStatement $result, $class = 'Phones', $write_cache = false) {
		return baseModel::fromResult($result, $class, $write_cache);
	}

	/**
	 * Casts values of int fields to (int)
	 * @return Phones
	 */
	function castInts() {
		$this->id = (null === $this->id) ? null : (int) $this->id;
		$this->entityid = (null === $this->entityid) ? null : (int) $this->entityid;
		return $this;
	}

	/**
	 * Add (or replace) to the instance pool.
	 *
	 * @param Phones $object
	 * @return void
	 */
	static function insertIntoPool(Phones $object) {
		if (Phones::$_instancePoolCount > Phones::MAX_INSTANCE_POOL_SIZE) {
			return;
		}

		Phones::$_instancePool[implode('-', $object->getPrimaryKeyValues())] = clone $object;
		++Phones::$_instancePoolCount;
	}

	/**
	 * Return the cached instance from the pool.
	 *
	 * @param mixed $pk Primary Key
	 * @return Phones
	 */
	static function retrieveFromPool($pk) {
		if (null === $pk) {
			return null;
		}
		if (array_key_exists($pk, Phones::$_instancePool)) {
			return clone Phones::$_instancePool[$pk];
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

		if (array_key_exists($pk, Phones::$_instancePool)) {
			unset(Phones::$_instancePool[$pk]);
			--Phones::$_instancePoolCount;
		}
	}

	/**
	 * Empty the instance pool.
	 *
	 * @return void
	 */
	static function flushPool() {
		Phones::$_instancePool = array();
	}

	/**
	 * Returns an array of all Phones objects in the database.
	 * $extra SQL can be appended to the query to LIMIT, SORT, and/or GROUP results.
	 * If there are no results, returns an empty Array.
	 * @param $extra string
	 * @return Phones[]
	 */
	static function getAll($extra = null, $write_cache = false) {
		$conn = Phones::getConnection();
		$table_quoted = $conn->quoteIdentifier(Phones::getTableName());
		return Phones::fetch("SELECT * FROM $table_quoted $extra ", $write_cache);
	}

	/**
	 * @return int
	 */
	static function doCount(Query $q = null) {
		$q = $q ? clone $q : new Query;
		$conn = Phones::getConnection();
		if (!$q->getTable() || Phones::getTableName() != $q->getTable()) {
			$q->setTable(Phones::getTableName());
		}
		return $q->doCount($conn);
	}

	/**
	 * @param Query $q
	 * @param bool $dump_cache
	 * @return int
	 */
	static function doDelete(Query $q, $dump_cache = true) {
		$conn = Phones::getConnection();
		$q = clone $q;
		if (!$q->getTable() || Phones::getTableName() != $q->getTable()) {
			$q->setTable(Phones::getTableName());
		}
		$result = $q->doDelete($conn);

		if ($dump_cache) {
			Phones::$_instancePool = array();
		}

		return $result;
	}

	/**
	 * @param Query $q The Query object that creates the SELECT query string
	 * @param bool $write_cache Whether or not to store results in instance pool
	 * @param array $additional_classes Array of additional classes for fromResult to instantiate as properties
	 * @return Phones[]
	 */
	static function doSelect(Query $q = null, $write_cache = false, $additional_classes = null) {
		if (is_array($additional_classes)) {
			array_unshift($additional_classes, 'Phones');
			$class = $additional_classes;
		} else {
			$class = 'Phones';
		}

		return Phones::fromResult(self::doSelectRS($q), $class, $write_cache);
	}

	/**
	 * Executes a select query and returns the PDO result
	 * @return PDOStatement
	 */
	static function doSelectRS(Query $q = null) {
		$q = $q ? clone $q : new Query;
		$conn = Phones::getConnection();
		if (!$q->getTable() || Phones::getTableName() != $q->getTable()) {
			$q->setTable(Phones::getTableName());
		}

		return $q->doSelect($conn);
	}

	/**
	 * @return Phones[]
	 */
	static function doSelectJoinAll(Query $q = null, $write_cache = false, $join_type = Query::LEFT_JOIN) {
		$q = $q ? clone $q : new Query;
		$columns = $q->getColumns();
		$classes = array();
		$alias = $q->getAlias();
		$this_table = $alias ? $alias : Phones::getTableName();
		if (!$columns) {
			$columns[] = $this_table . '.*';
		}

		$q->setColumns($columns);
		return Phones::doSelect($q, $write_cache, $classes);
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
