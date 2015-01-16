<?php
/**
 *	Created by Dan Blaisdell's Database->Object Mapper
 *		             Based on Propel
 *
 *		Do not alter base files, as they will be overwritten.
 *		To alter the objects, alter the extended clases in
 *		the 'tables' folder.
 *
 */

abstract class baseUsers extends BaseModel{

	/**
	 * Name of the table
	 */
	protected static $_tableName = "users";

	/**
	 * Array of all primary keys
	 */
	protected static $_primaryKeys = array(
			"id",
	);

	/**
	 * Primary Key
	 */
	 protected static $_primaryKey = "id";

	/**
	 * Array of all column names
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
		'calendar_html'
	);
	protected $id;
	protected $user;
	protected $password;
	protected $level;
	protected $list_level;
	protected $user_name;
	protected $officeid;
	protected $phone;
	protected $fax;
	protected $email;
	protected $theme;
	protected $google_id;
	protected $google_password;
	protected $calendar_html;

	/**
	 * Column Accessors and Mutators
	 */

	function getId(){
		return $this->id;
	}
	function setId($theValue){
		if($theValue==="")
			$theValue = null;
		if($theValue!==null)
			$theValue = (int)$theValue;
		if($this->id !== $theValue){
			$this->_modifiedColumns[] = "id";
			$this->id = $theValue;
		}
	}

	function getUser(){
		return $this->user;
	}
	function setUser($theValue){
		if($theValue===null){
			$theValue = "";
		}
		if($this->user !== $theValue){
			$this->_modifiedColumns[] = "user";
			$this->user = $theValue;
		}
	}

	function getPassword(){
		return $this->password;
	}
	function setPassword($theValue){
		if($theValue===null){
			$theValue = "";
		}
		if($this->password !== $theValue){
			$this->_modifiedColumns[] = "password";
			$this->password = $theValue;
		}
	}

	function getLevel(){
		return $this->level;
	}
	function setLevel($theValue){
		if($this->level !== $theValue){
			$this->_modifiedColumns[] = "level";
			$this->level = $theValue;
		}
	}

	function getList_level(){
		return $this->list_level;
	}
	function setList_level($theValue){
		if($this->list_level !== $theValue){
			$this->_modifiedColumns[] = "list_level";
			$this->list_level = $theValue;
		}
	}

	function getUser_name(){
		return $this->user_name;
	}
	function setUser_name($theValue){
		if($this->user_name !== $theValue){
			$this->_modifiedColumns[] = "user_name";
			$this->user_name = $theValue;
		}
	}

	function getOfficeid(){
		return $this->officeid;
	}
	function setOfficeid($theValue){
		if($theValue==="")
			$theValue = null;
		if($theValue!==null)
			$theValue = (int)$theValue;
		if($this->officeid !== $theValue){
			$this->_modifiedColumns[] = "officeid";
			$this->officeid = $theValue;
		}
	}

	function getPhone(){
		return $this->phone;
	}
	function setPhone($theValue){
		if($this->phone !== $theValue){
			$this->_modifiedColumns[] = "phone";
			$this->phone = $theValue;
		}
	}

	function getFax(){
		return $this->fax;
	}
	function setFax($theValue){
		if($this->fax !== $theValue){
			$this->_modifiedColumns[] = "fax";
			$this->fax = $theValue;
		}
	}

	function getEmail(){
		return $this->email;
	}
	function setEmail($theValue){
		if($this->email !== $theValue){
			$this->_modifiedColumns[] = "email";
			$this->email = $theValue;
		}
	}

	function getTheme(){
		return $this->theme;
	}
	function setTheme($theValue){
		if($this->theme !== $theValue){
			$this->_modifiedColumns[] = "theme";
			$this->theme = $theValue;
		}
	}

	function getGoogle_id(){
		return $this->google_id;
	}
	function setGoogle_id($theValue){
		if($this->google_id !== $theValue){
			$this->_modifiedColumns[] = "google_id";
			$this->google_id = $theValue;
		}
	}

	function getGoogle_password(){
		return $this->google_password;
	}
	function setGoogle_password($theValue){
		if($this->google_password !== $theValue){
			$this->_modifiedColumns[] = "google_password";
			$this->google_password = $theValue;
		}
	}

	function getCalendar_html(){
		return $this->calendar_html;
	}
	function setCalendar_html($theValue){
		if($this->calendar_html !== $theValue){
			$this->_modifiedColumns[] = "calendar_html";
			$this->calendar_html = $theValue;
		}
	}


	/**
	 * @return DABLPDO
	 */
	static function getConnection(){
		return DBManager::getConnection("my_connection_name");
	}

	/**
	 * Returns String representation of table name
	 * @return String
	 */
	static function getTableName(){
		return Users::$_tableName;
	}

	/**
	 * Access to array of column names
	 * @return array
	 */
	static function getColumnNames(){
		return Users::$_columnNames;
	}

	/**
	 * @return bool
	 */
	static function hasColumn($columnName){
		return in_array(strtolower($columnName), array_map('strtolower', Users::getColumnNames()));
	}

	/**
	 * Access to array of primary keys
	 * @return array
	 */
	static function getPrimaryKeys(){
		return Users::$_primaryKeys;
	}

	/**
	 * Access to name of primary key
	 * @return array
	 */
	static function getPrimaryKey(){
		return Users::$_primaryKey;
	}

	/**
	 * Searches the database for a row with the ID(primary key) that matches
	 * the one input.
	 * @return Users
	 */
	static function retrieveByPK( $thePK ){
		if($thePK===null)return null;
		$PKs = Users::getPrimaryKeys();
		if(count($PKs)>1)
			throw new Exception("This table has more than one primary key.  Use retrieveByPKs() instead.");
		elseif(count($PKs)==0)
			throw new Exception("This table does not have a primary key.");
		$q = new Query;
		$conn = Users::getConnection();
		$pkColumn = $conn->quoteIdentifier($PKs[0]);
		$q->add($pkColumn, $thePK);
		$q->setLimit(1);
		return array_shift(Users::doSelect($q));
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return Users
	 */
	static function retrieveByPKs( $PK0 ){
		$conn = Users::getConnection();
		$tableWrapped = $conn->quoteIdentifier(Users::getTableName());
		if($PK0===null)return null;
		$queryString = "SELECT * FROM $tableWrapped WHERE ".$conn->quoteIdentifier('id')."=".$conn->checkInput($PK0)."";
		$conn->applyLimit($queryString, 0, 1);
		return Users::fetchSingle($queryString);
	}

	/**
	 * Populates and returns an instance of Users with the
	 * first result of a query.  If the query returns no results,
	 * returns null.
	 * @return Users
	 */
	static function fetchSingle($queryString){
		return array_shift(Users::fetch($queryString));
	}

	/**
	 * Populates and returns an Array of Users Objects with the
	 * results of a query.  If the query returns no results,
	 * returns an empty Array.
	 * @return array
	 */
	static function fetch($queryString){
		$conn = Users::getConnection();
		$result = $conn->query($queryString);
		return Users::fromResult($result);
	}

	/**
	 * Returns an array of Users Objects from the rows of a PDOStatement(query result)
	 * @return array
	 */
	 static function fromResult(PDOStatement $result){
		$objects = array();
		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			$object = new Users;
			$object->fromArray($row);
			$object->resetModified();
			$object->setNew(false);
			$objects[] = $object;
		}
		return $objects;
	 }

	/**
	 * Returns an Array of all Users Objects in the database.
	 * $extra SQL can be appended to the query to limit,sort,group results.
	 * If there are no results, returns an empty Array.
	 * @param $extra String
	 * @return array
	 */
	static function getAll($extra = null){
		$conn = Users::getConnection();
		$tableWrapped = $conn->quoteIdentifier(Users::getTableName());
		return Users::fetch("SELECT * FROM $tableWrapped $extra ");
	}

	/**
	 * @return Int
	 */
	static function doCount(Query $q){
		$conn = Users::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), Users::getTableName())===false )
			$q->setTable(Users::getTableName());
		return $q->doCount($conn);
	}

	/**
	 * @return Int
	 */
	static function doDelete(Query $q){
		$conn = Users::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), Users::getTableName())===false )
			$q->setTable(Users::getTableName());
		return $q->doDelete($conn);
	}

	/**
	 * @return array
	 */
	static function doSelect(Query $q){
		$conn = Users::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), Users::getTableName())===false )
			$q->setTable(Users::getTableName());
		return Users::fromResult($q->doSelect($conn));
	}

}