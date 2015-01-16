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

abstract class baseDriverNotes extends BaseModel{

	/**
	 * Name of the table
	 */
	protected static $_tableName = "driver_notes";

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
		'userid',
		'driverid',
		'date_time',
		'note'
	);
	protected $id;
	protected $userid;
	protected $driverid;
	protected $date_time;
	protected $note;

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

	function getUserid(){
		return $this->userid;
	}
	function setUserid($theValue){
		if($theValue==="")
			$theValue = null;
		if($theValue!==null)
			$theValue = (int)$theValue;
		if($this->userid !== $theValue){
			$this->_modifiedColumns[] = "userid";
			$this->userid = $theValue;
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

	function getDate_time($format = null){
		if($this->date_time===null || !$format)
			return $this->date_time;
		if(strpos($this->date_time, "0000-00-00")===0)
			return null;
		$dateTime = new DateTime($this->date_time);
		return $dateTime->format($format);
	}
	function setDate_time($theValue){
		if($theValue==="")
			$theValue = null;
		elseif($theValue!==null)
			$theValue = date(DriverNotes::getConnection()->getTimestampFormatter(), strtotime($theValue));
		if($this->date_time !== $theValue){
			$this->_modifiedColumns[] = "date_time";
			$this->date_time = $theValue;
		}
	}

	function getNote(){
		return $this->note;
	}
	function setNote($theValue){
		if($this->note !== $theValue){
			$this->_modifiedColumns[] = "note";
			$this->note = $theValue;
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
		return DriverNotes::$_tableName;
	}

	/**
	 * Access to array of column names
	 * @return array
	 */
	static function getColumnNames(){
		return DriverNotes::$_columnNames;
	}

	/**
	 * @return bool
	 */
	static function hasColumn($columnName){
		return in_array(strtolower($columnName), array_map('strtolower', DriverNotes::getColumnNames()));
	}

	/**
	 * Access to array of primary keys
	 * @return array
	 */
	static function getPrimaryKeys(){
		return DriverNotes::$_primaryKeys;
	}

	/**
	 * Access to name of primary key
	 * @return array
	 */
	static function getPrimaryKey(){
		return DriverNotes::$_primaryKey;
	}

	/**
	 * Searches the database for a row with the ID(primary key) that matches
	 * the one input.
	 * @return DriverNotes
	 */
	static function retrieveByPK( $thePK ){
		if($thePK===null)return null;
		$PKs = DriverNotes::getPrimaryKeys();
		if(count($PKs)>1)
			throw new Exception("This table has more than one primary key.  Use retrieveByPKs() instead.");
		elseif(count($PKs)==0)
			throw new Exception("This table does not have a primary key.");
		$q = new Query;
		$conn = DriverNotes::getConnection();
		$pkColumn = $conn->quoteIdentifier($PKs[0]);
		$q->add($pkColumn, $thePK);
		$q->setLimit(1);
		return array_shift(DriverNotes::doSelect($q));
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return DriverNotes
	 */
	static function retrieveByPKs( $PK0 ){
		$conn = DriverNotes::getConnection();
		$tableWrapped = $conn->quoteIdentifier(DriverNotes::getTableName());
		if($PK0===null)return null;
		$queryString = "SELECT * FROM $tableWrapped WHERE ".$conn->quoteIdentifier('id')."=".$conn->checkInput($PK0)."";
		$conn->applyLimit($queryString, 0, 1);
		return DriverNotes::fetchSingle($queryString);
	}

	/**
	 * Populates and returns an instance of DriverNotes with the
	 * first result of a query.  If the query returns no results,
	 * returns null.
	 * @return DriverNotes
	 */
	static function fetchSingle($queryString){
		return array_shift(DriverNotes::fetch($queryString));
	}

	/**
	 * Populates and returns an Array of DriverNotes Objects with the
	 * results of a query.  If the query returns no results,
	 * returns an empty Array.
	 * @return array
	 */
	static function fetch($queryString){
		$conn = DriverNotes::getConnection();
		$result = $conn->query($queryString);
		return DriverNotes::fromResult($result);
	}

	/**
	 * Returns an array of DriverNotes Objects from the rows of a PDOStatement(query result)
	 * @return array
	 */
	 static function fromResult(PDOStatement $result){
		$objects = array();
		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			$object = new DriverNotes;
			$object->fromArray($row);
			$object->resetModified();
			$object->setNew(false);
			$objects[] = $object;
		}
		return $objects;
	 }

	/**
	 * Returns an Array of all DriverNotes Objects in the database.
	 * $extra SQL can be appended to the query to limit,sort,group results.
	 * If there are no results, returns an empty Array.
	 * @param $extra String
	 * @return array
	 */
	static function getAll($extra = null){
		$conn = DriverNotes::getConnection();
		$tableWrapped = $conn->quoteIdentifier(DriverNotes::getTableName());
		return DriverNotes::fetch("SELECT * FROM $tableWrapped $extra ");
	}

	/**
	 * @return Int
	 */
	static function doCount(Query $q){
		$conn = DriverNotes::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), DriverNotes::getTableName())===false )
			$q->setTable(DriverNotes::getTableName());
		return $q->doCount($conn);
	}

	/**
	 * @return Int
	 */
	static function doDelete(Query $q){
		$conn = DriverNotes::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), DriverNotes::getTableName())===false )
			$q->setTable(DriverNotes::getTableName());
		return $q->doDelete($conn);
	}

	/**
	 * @return array
	 */
	static function doSelect(Query $q){
		$conn = DriverNotes::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), DriverNotes::getTableName())===false )
			$q->setTable(DriverNotes::getTableName());
		return DriverNotes::fromResult($q->doSelect($conn));
	}

}