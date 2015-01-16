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

abstract class basePrivateNotes extends BaseModel{

	/**
	 * Name of the table
	 */
	protected static $_tableName = "private_notes";

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
		'driver',
		'comments'
	);
	protected $id;
	protected $user;
	protected $driver;
	protected $comments;

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
		if($theValue==="")
			$theValue = null;
		if($theValue!==null)
			$theValue = (int)$theValue;
		if($this->user !== $theValue){
			$this->_modifiedColumns[] = "user";
			$this->user = $theValue;
		}
	}

	function getDriver(){
		return $this->driver;
	}
	function setDriver($theValue){
		if($theValue==="")
			$theValue = null;
		if($theValue!==null)
			$theValue = (int)$theValue;
		if($this->driver !== $theValue){
			$this->_modifiedColumns[] = "driver";
			$this->driver = $theValue;
		}
	}

	function getComments(){
		return $this->comments;
	}
	function setComments($theValue){
		if($this->comments !== $theValue){
			$this->_modifiedColumns[] = "comments";
			$this->comments = $theValue;
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
		return PrivateNotes::$_tableName;
	}

	/**
	 * Access to array of column names
	 * @return array
	 */
	static function getColumnNames(){
		return PrivateNotes::$_columnNames;
	}

	/**
	 * @return bool
	 */
	static function hasColumn($columnName){
		return in_array(strtolower($columnName), array_map('strtolower', PrivateNotes::getColumnNames()));
	}

	/**
	 * Access to array of primary keys
	 * @return array
	 */
	static function getPrimaryKeys(){
		return PrivateNotes::$_primaryKeys;
	}

	/**
	 * Access to name of primary key
	 * @return array
	 */
	static function getPrimaryKey(){
		return PrivateNotes::$_primaryKey;
	}

	/**
	 * Searches the database for a row with the ID(primary key) that matches
	 * the one input.
	 * @return PrivateNotes
	 */
	static function retrieveByPK( $thePK ){
		if($thePK===null)return null;
		$PKs = PrivateNotes::getPrimaryKeys();
		if(count($PKs)>1)
			throw new Exception("This table has more than one primary key.  Use retrieveByPKs() instead.");
		elseif(count($PKs)==0)
			throw new Exception("This table does not have a primary key.");
		$q = new Query;
		$conn = PrivateNotes::getConnection();
		$pkColumn = $conn->quoteIdentifier($PKs[0]);
		$q->add($pkColumn, $thePK);
		$q->setLimit(1);
		return array_shift(PrivateNotes::doSelect($q));
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return PrivateNotes
	 */
	static function retrieveByPKs( $PK0 ){
		$conn = PrivateNotes::getConnection();
		$tableWrapped = $conn->quoteIdentifier(PrivateNotes::getTableName());
		if($PK0===null)return null;
		$queryString = "SELECT * FROM $tableWrapped WHERE ".$conn->quoteIdentifier('id')."=".$conn->checkInput($PK0)."";
		$conn->applyLimit($queryString, 0, 1);
		return PrivateNotes::fetchSingle($queryString);
	}

	/**
	 * Populates and returns an instance of PrivateNotes with the
	 * first result of a query.  If the query returns no results,
	 * returns null.
	 * @return PrivateNotes
	 */
	static function fetchSingle($queryString){
		return array_shift(PrivateNotes::fetch($queryString));
	}

	/**
	 * Populates and returns an Array of PrivateNotes Objects with the
	 * results of a query.  If the query returns no results,
	 * returns an empty Array.
	 * @return array
	 */
	static function fetch($queryString){
		$conn = PrivateNotes::getConnection();
		$result = $conn->query($queryString);
		return PrivateNotes::fromResult($result);
	}

	/**
	 * Returns an array of PrivateNotes Objects from the rows of a PDOStatement(query result)
	 * @return array
	 */
	 static function fromResult(PDOStatement $result){
		$objects = array();
		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			$object = new PrivateNotes;
			$object->fromArray($row);
			$object->resetModified();
			$object->setNew(false);
			$objects[] = $object;
		}
		return $objects;
	 }

	/**
	 * Returns an Array of all PrivateNotes Objects in the database.
	 * $extra SQL can be appended to the query to limit,sort,group results.
	 * If there are no results, returns an empty Array.
	 * @param $extra String
	 * @return array
	 */
	static function getAll($extra = null){
		$conn = PrivateNotes::getConnection();
		$tableWrapped = $conn->quoteIdentifier(PrivateNotes::getTableName());
		return PrivateNotes::fetch("SELECT * FROM $tableWrapped $extra ");
	}

	/**
	 * @return Int
	 */
	static function doCount(Query $q){
		$conn = PrivateNotes::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), PrivateNotes::getTableName())===false )
			$q->setTable(PrivateNotes::getTableName());
		return $q->doCount($conn);
	}

	/**
	 * @return Int
	 */
	static function doDelete(Query $q){
		$conn = PrivateNotes::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), PrivateNotes::getTableName())===false )
			$q->setTable(PrivateNotes::getTableName());
		return $q->doDelete($conn);
	}

	/**
	 * @return array
	 */
	static function doSelect(Query $q){
		$conn = PrivateNotes::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), PrivateNotes::getTableName())===false )
			$q->setTable(PrivateNotes::getTableName());
		return PrivateNotes::fromResult($q->doSelect($conn));
	}

}