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

abstract class baseCallChecks extends BaseModel{

	/**
	 * Name of the table
	 */
	protected static $_tableName = "call_checks";

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
		'loadid',
		'driverid',
		'agentid',
		'time_stamp',
		'notes'
	);
	protected $id;
	protected $loadid;
	protected $driverid;
	protected $agentid;
	protected $time_stamp;
	protected $notes;

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

	function getLoadid(){
		return $this->loadid;
	}
	function setLoadid($theValue){
		if($theValue==="")
			$theValue = null;
		if($theValue!==null)
			$theValue = (int)$theValue;
		if($this->loadid !== $theValue){
			$this->_modifiedColumns[] = "loadid";
			$this->loadid = $theValue;
		}
	}

	function getDriverid(){
		return $this->driverid;
	}
	function setDriverid($theValue){
		if($theValue==="")
			$theValue = null;
		if($theValue!==null)
			$theValue = (int)$theValue;
		if($this->driverid !== $theValue){
			$this->_modifiedColumns[] = "driverid";
			$this->driverid = $theValue;
		}
	}

	function getAgentid(){
		return $this->agentid;
	}
	function setAgentid($theValue){
		if($theValue==="")
			$theValue = null;
		if($theValue!==null)
			$theValue = (int)$theValue;
		if($this->agentid !== $theValue){
			$this->_modifiedColumns[] = "agentid";
			$this->agentid = $theValue;
		}
	}

	function getTime_stamp($format = null){
		if($this->time_stamp===null || !$format)
			return $this->time_stamp;
		if(strpos($this->time_stamp, "0000-00-00")===0)
			return null;
		$dateTime = new DateTime($this->time_stamp);
		return $dateTime->format($format);
	}
	function setTime_stamp($theValue){
		if($theValue==="")
			$theValue = null;
		elseif($theValue!==null)
			$theValue = date(CallChecks::getConnection()->getTimestampFormatter(), strtotime($theValue));
		if($this->time_stamp !== $theValue){
			$this->_modifiedColumns[] = "time_stamp";
			$this->time_stamp = $theValue;
		}
	}

	function getNotes(){
		return $this->notes;
	}
	function setNotes($theValue){
		if($this->notes !== $theValue){
			$this->_modifiedColumns[] = "notes";
			$this->notes = $theValue;
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
		return CallChecks::$_tableName;
	}

	/**
	 * Access to array of column names
	 * @return array
	 */
	static function getColumnNames(){
		return CallChecks::$_columnNames;
	}

	/**
	 * @return bool
	 */
	static function hasColumn($columnName){
		return in_array(strtolower($columnName), array_map('strtolower', CallChecks::getColumnNames()));
	}

	/**
	 * Access to array of primary keys
	 * @return array
	 */
	static function getPrimaryKeys(){
		return CallChecks::$_primaryKeys;
	}

	/**
	 * Access to name of primary key
	 * @return array
	 */
	static function getPrimaryKey(){
		return CallChecks::$_primaryKey;
	}

	/**
	 * Searches the database for a row with the ID(primary key) that matches
	 * the one input.
	 * @return CallChecks
	 */
	static function retrieveByPK( $thePK ){
		if($thePK===null)return null;
		$PKs = CallChecks::getPrimaryKeys();
		if(count($PKs)>1)
			throw new Exception("This table has more than one primary key.  Use retrieveByPKs() instead.");
		elseif(count($PKs)==0)
			throw new Exception("This table does not have a primary key.");
		$q = new Query;
		$conn = CallChecks::getConnection();
		$pkColumn = $conn->quoteIdentifier($PKs[0]);
		$q->add($pkColumn, $thePK);
		$q->setLimit(1);
		return array_shift(CallChecks::doSelect($q));
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return CallChecks
	 */
	static function retrieveByPKs( $PK0 ){
		$conn = CallChecks::getConnection();
		$tableWrapped = $conn->quoteIdentifier(CallChecks::getTableName());
		if($PK0===null)return null;
		$queryString = "SELECT * FROM $tableWrapped WHERE ".$conn->quoteIdentifier('id')."=".$conn->checkInput($PK0)."";
		$conn->applyLimit($queryString, 0, 1);
		return CallChecks::fetchSingle($queryString);
	}

	/**
	 * Populates and returns an instance of CallChecks with the
	 * first result of a query.  If the query returns no results,
	 * returns null.
	 * @return CallChecks
	 */
	static function fetchSingle($queryString){
		return array_shift(CallChecks::fetch($queryString));
	}

	/**
	 * Populates and returns an Array of CallChecks Objects with the
	 * results of a query.  If the query returns no results,
	 * returns an empty Array.
	 * @return array
	 */
	static function fetch($queryString){
		$conn = CallChecks::getConnection();
		$result = $conn->query($queryString);
		return CallChecks::fromResult($result);
	}

	/**
	 * Returns an array of CallChecks Objects from the rows of a PDOStatement(query result)
	 * @return array
	 */
	 static function fromResult(PDOStatement $result){
		$objects = array();
		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			$object = new CallChecks;
			$object->fromArray($row);
			$object->resetModified();
			$object->setNew(false);
			$objects[] = $object;
		}
		return $objects;
	 }

	/**
	 * Returns an Array of all CallChecks Objects in the database.
	 * $extra SQL can be appended to the query to limit,sort,group results.
	 * If there are no results, returns an empty Array.
	 * @param $extra String
	 * @return array
	 */
	static function getAll($extra = null){
		$conn = CallChecks::getConnection();
		$tableWrapped = $conn->quoteIdentifier(CallChecks::getTableName());
		return CallChecks::fetch("SELECT * FROM $tableWrapped $extra ");
	}

	/**
	 * @return Int
	 */
	static function doCount(Query $q){
		$conn = CallChecks::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), CallChecks::getTableName())===false )
			$q->setTable(CallChecks::getTableName());
		return $q->doCount($conn);
	}

	/**
	 * @return Int
	 */
	static function doDelete(Query $q){
		$conn = CallChecks::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), CallChecks::getTableName())===false )
			$q->setTable(CallChecks::getTableName());
		return $q->doDelete($conn);
	}

	/**
	 * @return array
	 */
	static function doSelect(Query $q){
		$conn = CallChecks::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), CallChecks::getTableName())===false )
			$q->setTable(CallChecks::getTableName());
		return CallChecks::fromResult($q->doSelect($conn));
	}

}