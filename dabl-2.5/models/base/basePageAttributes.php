<?php
/**
 *		Created by Dan Blaisdell's DABL
 *		Do not alter base files, as they will be overwritten.
 *		To alter the objects, alter the extended classes in
 *		the 'models' folder.
 *
 */
abstract class basePageAttributes extends ApplicationModel {

	/**
	 * Name of the table
	 * @var string
	 */
	protected static $_tableName = 'page_attributes';

	/**
	 * Cache of objects retrieved from the database
	 * @var PageAttributes[]
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
		'page_name',
		'page_title',
		'menu',
		'search',
	);

	/**
	 * array of all column types
	 * @var string[]
	 */
	protected static $_columnTypes = array(
		'id' => BaseModel::COLUMN_TYPE_BIGINT,
		'page_name' => BaseModel::COLUMN_TYPE_VARCHAR,
		'page_title' => BaseModel::COLUMN_TYPE_VARCHAR,
		'menu' => BaseModel::COLUMN_TYPE_TINYINT,
		'search' => BaseModel::COLUMN_TYPE_TINYINT,
	);

	/**
	 * `id` BIGINT NOT NULL DEFAULT ''
	 * @var string
	 */
	protected $id;

	/**
	 * `page_name` VARCHAR
	 * @var string
	 */
	protected $page_name;

	/**
	 * `page_title` VARCHAR
	 * @var string
	 */
	protected $page_title;

	/**
	 * `menu` TINYINT DEFAULT ''
	 * @var int
	 */
	protected $menu;

	/**
	 * `search` TINYINT DEFAULT ''
	 * @var int
	 */
	protected $search;

	/**
	 * Gets the value of the id field
	 */
	function getId() {
		return $this->id;
	}

	/**
	 * Sets the value of the id field
	 * @return PageAttributes
	 */
	function setId($value) {
		return $this->setColumnValue('id', $value, BaseModel::COLUMN_TYPE_BIGINT);
	}

	/**
	 * Gets the value of the page_name field
	 */
	function getPage_name() {
		return $this->page_name;
	}

	/**
	 * Sets the value of the page_name field
	 * @return PageAttributes
	 */
	function setPage_name($value) {
		return $this->setColumnValue('page_name', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the page_name field
	 */
	function getPageName() {
		return $this->getPage_name();
	}

	/**
	 * Sets the value of the page_name field
	 * @return PageAttributes
	 */
	function setPageName($value) {
		return $this->setPage_name($value);
	}

	/**
	 * Gets the value of the page_title field
	 */
	function getPage_title() {
		return $this->page_title;
	}

	/**
	 * Sets the value of the page_title field
	 * @return PageAttributes
	 */
	function setPage_title($value) {
		return $this->setColumnValue('page_title', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the page_title field
	 */
	function getPageTitle() {
		return $this->getPage_title();
	}

	/**
	 * Sets the value of the page_title field
	 * @return PageAttributes
	 */
	function setPageTitle($value) {
		return $this->setPage_title($value);
	}

	/**
	 * Gets the value of the menu field
	 */
	function getMenu() {
		return $this->menu;
	}

	/**
	 * Sets the value of the menu field
	 * @return PageAttributes
	 */
	function setMenu($value) {
		return $this->setColumnValue('menu', $value, BaseModel::COLUMN_TYPE_TINYINT);
	}

	/**
	 * Gets the value of the search field
	 */
	function getSearch() {
		return $this->search;
	}

	/**
	 * Sets the value of the search field
	 * @return PageAttributes
	 */
	function setSearch($value) {
		return $this->setColumnValue('search', $value, BaseModel::COLUMN_TYPE_TINYINT);
	}

	/**
	 * @return DABLPDO
	 */
	static function getConnection() {
		return DBManager::getConnection('default_mysqll');
	}

	/**
	 * @return PageAttributes
	 */
	static function create() {
		return new PageAttributes();
	}

	/**
	 * Returns String representation of table name
	 * @return string
	 */
	static function getTableName() {
		return PageAttributes::$_tableName;
	}

	/**
	 * Access to array of column names
	 * @return array
	 */
	static function getColumnNames() {
		return PageAttributes::$_columnNames;
	}

	/**
	 * Access to array of column types, indexed by column name
	 * @return array
	 */
	static function getColumnTypes() {
		return PageAttributes::$_columnTypes;
	}

	/**
	 * Get the type of a column
	 * @return array
	 */
	static function getColumnType($column_name) {
		return PageAttributes::$_columnTypes[$column_name];
	}

	/**
	 * @return bool
	 */
	static function hasColumn($column_name) {
		static $lower_case_columns = null;
		if (null === $lower_case_columns) {
			$lower_case_columns = array_map('strtolower', PageAttributes::$_columnNames);
		}
		return in_array(strtolower($column_name), $lower_case_columns);
	}

	/**
	 * Access to array of primary keys
	 * @return array
	 */
	static function getPrimaryKeys() {
		return PageAttributes::$_primaryKeys;
	}

	/**
	 * Access to name of primary key
	 * @return array
	 */
	static function getPrimaryKey() {
		return PageAttributes::$_primaryKey;
	}

	/**
	 * Returns true if the primary key column for this table is auto-increment
	 * @return bool
	 */
	static function isAutoIncrement() {
		return PageAttributes::$_isAutoIncrement;
	}

	/**
	 * Searches the database for a row with the ID(primary key) that matches
	 * the one input.
	 * @return PageAttributes
	 */
	static function retrieveByPK($the_pk) {
		return PageAttributes::retrieveByPKs($the_pk);
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return PageAttributes
	 */
	static function retrieveByPKs($id) {
		if (null === $id) {
			return null;
		}
		$pool_instance = PageAttributes::retrieveFromPool($id);
		if (null !== $pool_instance) {
			return $pool_instance;
		}
		$conn = PageAttributes::getConnection();
		$q = new Query;
		$q->add('id', $id);
		return array_shift(PageAttributes::doSelect($q, true));
	}

	/**
	 * Searches the database for a row with a id	 * value that matches the one provided
	 * @return PageAttributes
	 */
	static function retrieveById($value) {
		return PageAttributes::retrieveByPK($value);
	}

	/**
	 * Searches the database for a row with a page_name	 * value that matches the one provided
	 * @return PageAttributes
	 */
	static function retrieveByPageName($value) {
		return PageAttributes::retrieveByColumn('page_name', $value);
	}

	/**
	 * Searches the database for a row with a page_title	 * value that matches the one provided
	 * @return PageAttributes
	 */
	static function retrieveByPageTitle($value) {
		return PageAttributes::retrieveByColumn('page_title', $value);
	}

	/**
	 * Searches the database for a row with a menu	 * value that matches the one provided
	 * @return PageAttributes
	 */
	static function retrieveByMenu($value) {
		return PageAttributes::retrieveByColumn('menu', $value);
	}

	/**
	 * Searches the database for a row with a search	 * value that matches the one provided
	 * @return PageAttributes
	 */
	static function retrieveBySearch($value) {
		return PageAttributes::retrieveByColumn('search', $value);
	}

	static function retrieveByColumn($field, $value) {
		$conn = PageAttributes::getConnection();
		return array_shift(PageAttributes::doSelect(Query::create()->add($field, $value)->setLimit(1)->order('id')));
	}

	/**
	 * Populates and returns an instance of PageAttributes with the
	 * first result of a query.  If the query returns no results,
	 * returns null.
	 * @return PageAttributes
	 */
	static function fetchSingle($query_string, $write_cache = true) {
		return array_shift(PageAttributes::fetch($query_string, $write_cache));
	}

	/**
	 * Populates and returns an array of PageAttributes objects with the
	 * results of a query.  If the query returns no results,
	 * returns an empty Array.
	 * @return PageAttributes[]
	 */
	static function fetch($query_string, $write_cache = false) {
		$conn = PageAttributes::getConnection();
		$result = $conn->query($query_string);
		return PageAttributes::fromResult($result, 'PageAttributes', $write_cache);
	}

	/**
	 * Returns an array of PageAttributes objects from
	 * a PDOStatement(query result).
	 *
	 * @see BaseModel::fromResult
	 */
	static function fromResult(PDOStatement $result, $class = 'PageAttributes', $write_cache = false) {
		return baseModel::fromResult($result, $class, $write_cache);
	}

	/**
	 * Casts values of int fields to (int)
	 * @return PageAttributes
	 */
	function castInts() {
		$this->id = (null === $this->id) ? null : (int) $this->id;
		$this->menu = (null === $this->menu) ? null : (int) $this->menu;
		$this->search = (null === $this->search) ? null : (int) $this->search;
		return $this;
	}

	/**
	 * Add (or replace) to the instance pool.
	 *
	 * @param PageAttributes $object
	 * @return void
	 */
	static function insertIntoPool(PageAttributes $object) {
		if (PageAttributes::$_instancePoolCount > PageAttributes::MAX_INSTANCE_POOL_SIZE) {
			return;
		}

		PageAttributes::$_instancePool[implode('-', $object->getPrimaryKeyValues())] = clone $object;
		++PageAttributes::$_instancePoolCount;
	}

	/**
	 * Return the cached instance from the pool.
	 *
	 * @param mixed $pk Primary Key
	 * @return PageAttributes
	 */
	static function retrieveFromPool($pk) {
		if (null === $pk) {
			return null;
		}
		if (array_key_exists($pk, PageAttributes::$_instancePool)) {
			return clone PageAttributes::$_instancePool[$pk];
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

		if (array_key_exists($pk, PageAttributes::$_instancePool)) {
			unset(PageAttributes::$_instancePool[$pk]);
			--PageAttributes::$_instancePoolCount;
		}
	}

	/**
	 * Empty the instance pool.
	 *
	 * @return void
	 */
	static function flushPool() {
		PageAttributes::$_instancePool = array();
	}

	/**
	 * Returns an array of all PageAttributes objects in the database.
	 * $extra SQL can be appended to the query to LIMIT, SORT, and/or GROUP results.
	 * If there are no results, returns an empty Array.
	 * @param $extra string
	 * @return PageAttributes[]
	 */
	static function getAll($extra = null, $write_cache = false) {
		$conn = PageAttributes::getConnection();
		$table_quoted = $conn->quoteIdentifier(PageAttributes::getTableName());
		return PageAttributes::fetch("SELECT * FROM $table_quoted $extra ", $write_cache);
	}

	/**
	 * @return int
	 */
	static function doCount(Query $q = null) {
		$q = $q ? clone $q : new Query;
		$conn = PageAttributes::getConnection();
		if (!$q->getTable() || PageAttributes::getTableName() != $q->getTable()) {
			$q->setTable(PageAttributes::getTableName());
		}
		return $q->doCount($conn);
	}

	/**
	 * @param Query $q
	 * @param bool $dump_cache
	 * @return int
	 */
	static function doDelete(Query $q, $dump_cache = true) {
		$conn = PageAttributes::getConnection();
		$q = clone $q;
		if (!$q->getTable() || PageAttributes::getTableName() != $q->getTable()) {
			$q->setTable(PageAttributes::getTableName());
		}
		$result = $q->doDelete($conn);

		if ($dump_cache) {
			PageAttributes::$_instancePool = array();
		}

		return $result;
	}

	/**
	 * @param Query $q The Query object that creates the SELECT query string
	 * @param bool $write_cache Whether or not to store results in instance pool
	 * @param array $additional_classes Array of additional classes for fromResult to instantiate as properties
	 * @return PageAttributes[]
	 */
	static function doSelect(Query $q = null, $write_cache = false, $additional_classes = null) {
		if (is_array($additional_classes)) {
			array_unshift($additional_classes, 'PageAttributes');
			$class = $additional_classes;
		} else {
			$class = 'PageAttributes';
		}

		return PageAttributes::fromResult(self::doSelectRS($q), $class, $write_cache);
	}

	/**
	 * Executes a select query and returns the PDO result
	 * @return PDOStatement
	 */
	static function doSelectRS(Query $q = null) {
		$q = $q ? clone $q : new Query;
		$conn = PageAttributes::getConnection();
		if (!$q->getTable() || PageAttributes::getTableName() != $q->getTable()) {
			$q->setTable(PageAttributes::getTableName());
		}

		return $q->doSelect($conn);
	}

	/**
	 * @return PageAttributes[]
	 */
	static function doSelectJoinAll(Query $q = null, $write_cache = false, $join_type = Query::LEFT_JOIN) {
		$q = $q ? clone $q : new Query;
		$columns = $q->getColumns();
		$classes = array();
		$alias = $q->getAlias();
		$this_table = $alias ? $alias : PageAttributes::getTableName();
		if (!$columns) {
			$columns[] = $this_table . '.*';
		}

		$q->setColumns($columns);
		return PageAttributes::doSelect($q, $write_cache, $classes);
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
