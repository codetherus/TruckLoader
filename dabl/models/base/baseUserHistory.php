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

abstract class baseUserHistory extends BaseModel{

	/**
	 * Name of the table
	 */
	protected static $_tableName = "user_history";

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
		'user1',
		'user2',
		'user3',
		'driver'
	);
	protected $id;
	protected $user1;
	protected $user2;
	protected $user3;
	protected $driver;

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

	function getUser1(){
		return $this->user1;
	}
	function setUser1($theValue){
		if($this->user1 !== $theValue){
			$this->_modifiedColumns[] = "user1";
			$this->user1 = $theValue;
		}
	}

	function getUser2(){
		return $this->user2;
	}
	function setUser2($theValue){
		if($this->user2 !== $theValue){
			$this->_modifiedColumns[] = "user2";
			$this->user2 = $theValue;
		}
	}

	function getUser3(){
		return $this->user3;
	}
	function setUser3($theValue){
		if($this->user3 !== $theValue){
			$this->_modifiedColumns[] = "user3";
			$this->user3 = $theValue;
		}
	}

	function getDriver(){
		return $this->driver;
	}
	function setDriver($theValue){
		if($this->driver !== $theValue){
			$this->_modifiedColumns[] = "driver";
			$this->driver = $theValue;
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
		return UserHistory::$_tableName;
	}

	/**
	 * Access to array of column names
	 * @return array
	 */
	static function getColumnNames(){
		return UserHistory::$_columnNames;
	}

	/**
	 * @return bool
	 */
	static function hasColumn($columnName){
		return in_array(strtolower($columnName), array_map('strtolower', UserHistory::getColumnNames()));
	}

	/**
	 * Access to array of primary keys
	 * @return array
	 */
	static function getPrimaryKeys(){
		return UserHistory::$_primaryKeys;
	}

	/**
	 * Access to name of primary key
	 * @return array
	 */
	static function getPrimaryKey(){
		return UserHistory::$_primaryKey;
	}

	/**
	 * Searches the database for a row with the ID(primary key) that matches
	 * the one input.
	 * @return UserHistory
	 */
	static function retrieveByPK( $thePK ){
		if($thePK===null)return null;
		$PKs = UserHistory::getPrimaryKeys();
		if(count($PKs)>1)
			throw new Exception("This table has more than one primary key.  Use retrieveByPKs() instead.");
		elseif(count($PKs)==0)
			throw new Exception("This table does not have a primary key.");
		$q = new Query;
		$conn = UserHistory::getConnection();
		$pkColumn = $conn->quoteIdentifier($PKs[0]);
		$q->add($pkColumn, $thePK);
		$q->setLimit(1);
		return array_shift(UserHistory::doSelect($q));
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return UserHistory
	 */
	static function retrieveByPKs( $PK0 ){
		$conn = UserHistory::getConnection();
		$tableWrapped = $conn->quoteIdentifier(UserHistory::getTableName());
		if($PK0===null)return null;
		$queryString = "SELECT * FROM $tableWrapped WHERE ".$conn->quoteIdentifier('id')."=".$conn->checkInput($PK0)."";
		$conn->applyLimit($queryString, 0, 1);
		return UserHistory::fetchSingle($queryString);
	}

	/**
	 * Populates and returns an instance of UserHistory with the
	 * first result of a query.  If the query returns no results,
	 * returns null.
	 * @return UserHistory
	 */
	static function fetchSingle($queryString){
		return array_shift(UserHistory::fetch($queryString));
	}

	/**
	 * Populates and returns an Array of UserHistory Objects with the
	 * results of a query.  If the query returns no results,
	 * returns an empty Array.
	 * @return array
	 */
	static function fetch($queryString){
		$conn = UserHistory::getConnection();
		$result = $conn->query($queryString);
		return UserHistory::fromResult($result);
	}

	/**
	 * Returns an array of UserHistory Objects from the rows of a PDOStatement(query result)
	 * @return array
	 */
	 static function fromResult(PDOStatement $result){
		$objects = array();
		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			$object = new UserHistory;
			$object->fromArray($row);
			$object->resetModified();
			$object->setNew(false);
			$objects[] = $object;
		}
		return $objects;
	 }

	/**
	 * Returns an Array of all UserHistory Objects in the database.
	 * $extra SQL can be appended to the query to limit,sort,group results.
	 * If there are no results, returns an empty Array.
	 * @param $extra String
	 * @return array
	 */
	static function getAll($extra = null){
		$conn = UserHistory::getConnection();
		$tableWrapped = $conn->quoteIdentifier(UserHistory::getTableName());
		return UserHistory::fetch("SELECT * FROM $tableWrapped $extra ");
	}

	/**
	 * @return Int
	 */
	static function doCount(Query $q){
		$conn = UserHistory::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), UserHistory::getTableName())===false )
			$q->setTable(UserHistory::getTableName());
		return $q->doCount($conn);
	}

	/**
	 * @return Int
	 */
	static function doDelete(Query $q){
		$conn = UserHistory::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), UserHistory::getTableName())===false )
			$q->setTable(UserHistory::getTableName());
		return $q->doDelete($conn);
	}

	/**
	 * @return array
	 */
	static function doSelect(Query $q){
		$conn = UserHistory::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), UserHistory::getTableName())===false )
			$q->setTable(UserHistory::getTableName());
		return UserHistory::fromResult($q->doSelect($conn));
	}

}