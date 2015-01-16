<?php
/**
 *		Created by Dan Blaisdell's DABL
 *		Do not alter base files, as they will be overwritten.
 *		To alter the objects, alter the extended classes in
 *		the 'models' folder.
 *
 */
abstract class baseUsers extends ApplicationModel {

	/**
	 * Name of the table
	 * @var string
	 */
	protected static $_tableName = 'users';

	/**
	 * Cache of objects retrieved from the database
	 * @var Users[]
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
		'password',
		'level',
		'list_level',
		'user_name',
		'officeid',
		'phone',
		'fax',
		'email',
		'theme',
		'google_id',
		'google_password',
		'calendar_html',
	);

	/**
	 * array of all column types
	 * @var string[]
	 */
	protected static $_columnTypes = array(
		'id' => BaseModel::COLUMN_TYPE_BIGINT,
		'user' => BaseModel::COLUMN_TYPE_VARCHAR,
		'password' => BaseModel::COLUMN_TYPE_VARCHAR,
		'level' => BaseModel::COLUMN_TYPE_VARCHAR,
		'list_level' => BaseModel::COLUMN_TYPE_VARCHAR,
		'user_name' => BaseModel::COLUMN_TYPE_VARCHAR,
		'officeid' => BaseModel::COLUMN_TYPE_BIGINT,
		'phone' => BaseModel::COLUMN_TYPE_VARCHAR,
		'fax' => BaseModel::COLUMN_TYPE_VARCHAR,
		'email' => BaseModel::COLUMN_TYPE_VARCHAR,
		'theme' => BaseModel::COLUMN_TYPE_VARCHAR,
		'google_id' => BaseModel::COLUMN_TYPE_LONGVARCHAR,
		'google_password' => BaseModel::COLUMN_TYPE_LONGVARCHAR,
		'calendar_html' => BaseModel::COLUMN_TYPE_LONGVARCHAR,
	);

	/**
	 * `id` BIGINT NOT NULL DEFAULT ''
	 * @var string
	 */
	protected $id;

	/**
	 * `user` VARCHAR NOT NULL
	 * @var string
	 */
	protected $user;

	/**
	 * `password` VARCHAR NOT NULL
	 * @var string
	 */
	protected $password;

	/**
	 * `level` VARCHAR
	 * @var string
	 */
	protected $level;

	/**
	 * `list_level` VARCHAR
	 * @var string
	 */
	protected $list_level;

	/**
	 * `user_name` VARCHAR
	 * @var string
	 */
	protected $user_name;

	/**
	 * `officeid` BIGINT DEFAULT ''
	 * @var string
	 */
	protected $officeid;

	/**
	 * `phone` VARCHAR
	 * @var string
	 */
	protected $phone;

	/**
	 * `fax` VARCHAR
	 * @var string
	 */
	protected $fax;

	/**
	 * `email` VARCHAR
	 * @var string
	 */
	protected $email;

	/**
	 * `theme` VARCHAR
	 * @var string
	 */
	protected $theme;

	/**
	 * `google_id` LONGVARCHAR
	 * @var string
	 */
	protected $google_id;

	/**
	 * `google_password` LONGVARCHAR
	 * @var string
	 */
	protected $google_password;

	/**
	 * `calendar_html` LONGVARCHAR
	 * @var string
	 */
	protected $calendar_html;

	/**
	 * Gets the value of the id field
	 */
	function getId() {
		return $this->id;
	}

	/**
	 * Sets the value of the id field
	 * @return Users
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
	 * @return Users
	 */
	function setUser($value) {
		return $this->setColumnValue('user', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the password field
	 */
	function getPassword() {
		return $this->password;
	}

	/**
	 * Sets the value of the password field
	 * @return Users
	 */
	function setPassword($value) {
		return $this->setColumnValue('password', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the level field
	 */
	function getLevel() {
		return $this->level;
	}

	/**
	 * Sets the value of the level field
	 * @return Users
	 */
	function setLevel($value) {
		return $this->setColumnValue('level', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the list_level field
	 */
	function getList_level() {
		return $this->list_level;
	}

	/**
	 * Sets the value of the list_level field
	 * @return Users
	 */
	function setList_level($value) {
		return $this->setColumnValue('list_level', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the list_level field
	 */
	function getListLevel() {
		return $this->getList_level();
	}

	/**
	 * Sets the value of the list_level field
	 * @return Users
	 */
	function setListLevel($value) {
		return $this->setList_level($value);
	}

	/**
	 * Gets the value of the user_name field
	 */
	function getUser_name() {
		return $this->user_name;
	}

	/**
	 * Sets the value of the user_name field
	 * @return Users
	 */
	function setUser_name($value) {
		return $this->setColumnValue('user_name', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the user_name field
	 */
	function getUserName() {
		return $this->getUser_name();
	}

	/**
	 * Sets the value of the user_name field
	 * @return Users
	 */
	function setUserName($value) {
		return $this->setUser_name($value);
	}

	/**
	 * Gets the value of the officeid field
	 */
	function getOfficeid() {
		return $this->officeid;
	}

	/**
	 * Sets the value of the officeid field
	 * @return Users
	 */
	function setOfficeid($value) {
		return $this->setColumnValue('officeid', $value, BaseModel::COLUMN_TYPE_BIGINT);
	}

	/**
	 * Gets the value of the phone field
	 */
	function getPhone() {
		return $this->phone;
	}

	/**
	 * Sets the value of the phone field
	 * @return Users
	 */
	function setPhone($value) {
		return $this->setColumnValue('phone', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the fax field
	 */
	function getFax() {
		return $this->fax;
	}

	/**
	 * Sets the value of the fax field
	 * @return Users
	 */
	function setFax($value) {
		return $this->setColumnValue('fax', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the email field
	 */
	function getEmail() {
		return $this->email;
	}

	/**
	 * Sets the value of the email field
	 * @return Users
	 */
	function setEmail($value) {
		return $this->setColumnValue('email', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the theme field
	 */
	function getTheme() {
		return $this->theme;
	}

	/**
	 * Sets the value of the theme field
	 * @return Users
	 */
	function setTheme($value) {
		return $this->setColumnValue('theme', $value, BaseModel::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the google_id field
	 */
	function getGoogle_id() {
		return $this->google_id;
	}

	/**
	 * Sets the value of the google_id field
	 * @return Users
	 */
	function setGoogle_id($value) {
		return $this->setColumnValue('google_id', $value, BaseModel::COLUMN_TYPE_LONGVARCHAR);
	}

	/**
	 * Gets the value of the google_id field
	 */
	function getGoogleId() {
		return $this->getGoogle_id();
	}

	/**
	 * Sets the value of the google_id field
	 * @return Users
	 */
	function setGoogleId($value) {
		return $this->setGoogle_id($value);
	}

	/**
	 * Gets the value of the google_password field
	 */
	function getGoogle_password() {
		return $this->google_password;
	}

	/**
	 * Sets the value of the google_password field
	 * @return Users
	 */
	function setGoogle_password($value) {
		return $this->setColumnValue('google_password', $value, BaseModel::COLUMN_TYPE_LONGVARCHAR);
	}

	/**
	 * Gets the value of the google_password field
	 */
	function getGooglePassword() {
		return $this->getGoogle_password();
	}

	/**
	 * Sets the value of the google_password field
	 * @return Users
	 */
	function setGooglePassword($value) {
		return $this->setGoogle_password($value);
	}

	/**
	 * Gets the value of the calendar_html field
	 */
	function getCalendar_html() {
		return $this->calendar_html;
	}

	/**
	 * Sets the value of the calendar_html field
	 * @return Users
	 */
	function setCalendar_html($value) {
		return $this->setColumnValue('calendar_html', $value, BaseModel::COLUMN_TYPE_LONGVARCHAR);
	}

	/**
	 * Gets the value of the calendar_html field
	 */
	function getCalendarHtml() {
		return $this->getCalendar_html();
	}

	/**
	 * Sets the value of the calendar_html field
	 * @return Users
	 */
	function setCalendarHtml($value) {
		return $this->setCalendar_html($value);
	}

	/**
	 * @return DABLPDO
	 */
	static function getConnection() {
		return DBManager::getConnection('default_mysqll');
	}

	/**
	 * @return Users
	 */
	static function create() {
		return new Users();
	}

	/**
	 * Returns String representation of table name
	 * @return string
	 */
	static function getTableName() {
		return Users::$_tableName;
	}

	/**
	 * Access to array of column names
	 * @return array
	 */
	static function getColumnNames() {
		return Users::$_columnNames;
	}

	/**
	 * Access to array of column types, indexed by column name
	 * @return array
	 */
	static function getColumnTypes() {
		return Users::$_columnTypes;
	}

	/**
	 * Get the type of a column
	 * @return array
	 */
	static function getColumnType($column_name) {
		return Users::$_columnTypes[$column_name];
	}

	/**
	 * @return bool
	 */
	static function hasColumn($column_name) {
		static $lower_case_columns = null;
		if (null === $lower_case_columns) {
			$lower_case_columns = array_map('strtolower', Users::$_columnNames);
		}
		return in_array(strtolower($column_name), $lower_case_columns);
	}

	/**
	 * Access to array of primary keys
	 * @return array
	 */
	static function getPrimaryKeys() {
		return Users::$_primaryKeys;
	}

	/**
	 * Access to name of primary key
	 * @return array
	 */
	static function getPrimaryKey() {
		return Users::$_primaryKey;
	}

	/**
	 * Returns true if the primary key column for this table is auto-increment
	 * @return bool
	 */
	static function isAutoIncrement() {
		return Users::$_isAutoIncrement;
	}

	/**
	 * Searches the database for a row with the ID(primary key) that matches
	 * the one input.
	 * @return Users
	 */
	static function retrieveByPK($the_pk) {
		return Users::retrieveByPKs($the_pk);
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return Users
	 */
	static function retrieveByPKs($id) {
		if (null === $id) {
			return null;
		}
		$pool_instance = Users::retrieveFromPool($id);
		if (null !== $pool_instance) {
			return $pool_instance;
		}
		$conn = Users::getConnection();
		$q = new Query;
		$q->add('id', $id);
		return array_shift(Users::doSelect($q, true));
	}

	/**
	 * Searches the database for a row with a id	 * value that matches the one provided
	 * @return Users
	 */
	static function retrieveById($value) {
		return Users::retrieveByPK($value);
	}

	/**
	 * Searches the database for a row with a user	 * value that matches the one provided
	 * @return Users
	 */
	static function retrieveByUser($value) {
		return Users::retrieveByColumn('user', $value);
	}

	/**
	 * Searches the database for a row with a password	 * value that matches the one provided
	 * @return Users
	 */
	static function retrieveByPassword($value) {
		return Users::retrieveByColumn('password', $value);
	}

	/**
	 * Searches the database for a row with a level	 * value that matches the one provided
	 * @return Users
	 */
	static function retrieveByLevel($value) {
		return Users::retrieveByColumn('level', $value);
	}

	/**
	 * Searches the database for a row with a list_level	 * value that matches the one provided
	 * @return Users
	 */
	static function retrieveByListLevel($value) {
		return Users::retrieveByColumn('list_level', $value);
	}

	/**
	 * Searches the database for a row with a user_name	 * value that matches the one provided
	 * @return Users
	 */
	static function retrieveByUserName($value) {
		return Users::retrieveByColumn('user_name', $value);
	}

	/**
	 * Searches the database for a row with a officeid	 * value that matches the one provided
	 * @return Users
	 */
	static function retrieveByOfficeid($value) {
		return Users::retrieveByColumn('officeid', $value);
	}

	/**
	 * Searches the database for a row with a phone	 * value that matches the one provided
	 * @return Users
	 */
	static function retrieveByPhone($value) {
		return Users::retrieveByColumn('phone', $value);
	}

	/**
	 * Searches the database for a row with a fax	 * value that matches the one provided
	 * @return Users
	 */
	static function retrieveByFax($value) {
		return Users::retrieveByColumn('fax', $value);
	}

	/**
	 * Searches the database for a row with a email	 * value that matches the one provided
	 * @return Users
	 */
	static function retrieveByEmail($value) {
		return Users::retrieveByColumn('email', $value);
	}

	/**
	 * Searches the database for a row with a theme	 * value that matches the one provided
	 * @return Users
	 */
	static function retrieveByTheme($value) {
		return Users::retrieveByColumn('theme', $value);
	}

	/**
	 * Searches the database for a row with a google_id	 * value that matches the one provided
	 * @return Users
	 */
	static function retrieveByGoogleId($value) {
		return Users::retrieveByColumn('google_id', $value);
	}

	/**
	 * Searches the database for a row with a google_password	 * value that matches the one provided
	 * @return Users
	 */
	static function retrieveByGooglePassword($value) {
		return Users::retrieveByColumn('google_password', $value);
	}

	/**
	 * Searches the database for a row with a calendar_html	 * value that matches the one provided
	 * @return Users
	 */
	static function retrieveByCalendarHtml($value) {
		return Users::retrieveByColumn('calendar_html', $value);
	}

	static function retrieveByColumn($field, $value) {
		$conn = Users::getConnection();
		return array_shift(Users::doSelect(Query::create()->add($field, $value)->setLimit(1)->order('id')));
	}

	/**
	 * Populates and returns an instance of Users with the
	 * first result of a query.  If the query returns no results,
	 * returns null.
	 * @return Users
	 */
	static function fetchSingle($query_string, $write_cache = true) {
		return array_shift(Users::fetch($query_string, $write_cache));
	}

	/**
	 * Populates and returns an array of Users objects with the
	 * results of a query.  If the query returns no results,
	 * returns an empty Array.
	 * @return Users[]
	 */
	static function fetch($query_string, $write_cache = false) {
		$conn = Users::getConnection();
		$result = $conn->query($query_string);
		return Users::fromResult($result, 'Users', $write_cache);
	}

	/**
	 * Returns an array of Users objects from
	 * a PDOStatement(query result).
	 *
	 * @see BaseModel::fromResult
	 */
	static function fromResult(PDOStatement $result, $class = 'Users', $write_cache = false) {
		return baseModel::fromResult($result, $class, $write_cache);
	}

	/**
	 * Casts values of int fields to (int)
	 * @return Users
	 */
	function castInts() {
		$this->id = (null === $this->id) ? null : (int) $this->id;
		$this->officeid = (null === $this->officeid) ? null : (int) $this->officeid;
		return $this;
	}

	/**
	 * Add (or replace) to the instance pool.
	 *
	 * @param Users $object
	 * @return void
	 */
	static function insertIntoPool(Users $object) {
		if (Users::$_instancePoolCount > Users::MAX_INSTANCE_POOL_SIZE) {
			return;
		}

		Users::$_instancePool[implode('-', $object->getPrimaryKeyValues())] = clone $object;
		++Users::$_instancePoolCount;
	}

	/**
	 * Return the cached instance from the pool.
	 *
	 * @param mixed $pk Primary Key
	 * @return Users
	 */
	static function retrieveFromPool($pk) {
		if (null === $pk) {
			return null;
		}
		if (array_key_exists($pk, Users::$_instancePool)) {
			return clone Users::$_instancePool[$pk];
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

		if (array_key_exists($pk, Users::$_instancePool)) {
			unset(Users::$_instancePool[$pk]);
			--Users::$_instancePoolCount;
		}
	}

	/**
	 * Empty the instance pool.
	 *
	 * @return void
	 */
	static function flushPool() {
		Users::$_instancePool = array();
	}

	/**
	 * Returns an array of all Users objects in the database.
	 * $extra SQL can be appended to the query to LIMIT, SORT, and/or GROUP results.
	 * If there are no results, returns an empty Array.
	 * @param $extra string
	 * @return Users[]
	 */
	static function getAll($extra = null, $write_cache = false) {
		$conn = Users::getConnection();
		$table_quoted = $conn->quoteIdentifier(Users::getTableName());
		return Users::fetch("SELECT * FROM $table_quoted $extra ", $write_cache);
	}

	/**
	 * @return int
	 */
	static function doCount(Query $q = null) {
		$q = $q ? clone $q : new Query;
		$conn = Users::getConnection();
		if (!$q->getTable() || Users::getTableName() != $q->getTable()) {
			$q->setTable(Users::getTableName());
		}
		return $q->doCount($conn);
	}

	/**
	 * @param Query $q
	 * @param bool $dump_cache
	 * @return int
	 */
	static function doDelete(Query $q, $dump_cache = true) {
		$conn = Users::getConnection();
		$q = clone $q;
		if (!$q->getTable() || Users::getTableName() != $q->getTable()) {
			$q->setTable(Users::getTableName());
		}
		$result = $q->doDelete($conn);

		if ($dump_cache) {
			Users::$_instancePool = array();
		}

		return $result;
	}

	/**
	 * @param Query $q The Query object that creates the SELECT query string
	 * @param bool $write_cache Whether or not to store results in instance pool
	 * @param array $additional_classes Array of additional classes for fromResult to instantiate as properties
	 * @return Users[]
	 */
	static function doSelect(Query $q = null, $write_cache = false, $additional_classes = null) {
		if (is_array($additional_classes)) {
			array_unshift($additional_classes, 'Users');
			$class = $additional_classes;
		} else {
			$class = 'Users';
		}

		return Users::fromResult(self::doSelectRS($q), $class, $write_cache);
	}

	/**
	 * Executes a select query and returns the PDO result
	 * @return PDOStatement
	 */
	static function doSelectRS(Query $q = null) {
		$q = $q ? clone $q : new Query;
		$conn = Users::getConnection();
		if (!$q->getTable() || Users::getTableName() != $q->getTable()) {
			$q->setTable(Users::getTableName());
		}

		return $q->doSelect($conn);
	}

	/**
	 * @return Users[]
	 */
	static function doSelectJoinAll(Query $q = null, $write_cache = false, $join_type = Query::LEFT_JOIN) {
		$q = $q ? clone $q : new Query;
		$columns = $q->getColumns();
		$classes = array();
		$alias = $q->getAlias();
		$this_table = $alias ? $alias : Users::getTableName();
		if (!$columns) {
			$columns[] = $this_table . '.*';
		}

		$q->setColumns($columns);
		return Users::doSelect($q, $write_cache, $classes);
	}

	/**
	 * Returns true if the column values validate.
	 * @return bool
	 */
	function validate() {
		$this->_validationErrors = array();
		if (null === $this->getuser()) {
			$this->_validationErrors[] = 'user must not be null';
		}
		if (null === $this->getpassword()) {
			$this->_validationErrors[] = 'password must not be null';
		}
		return 0 === count($this->_validationErrors);
	}

}
