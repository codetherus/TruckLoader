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

abstract class baseReminders extends BaseModel{

	/**
	 * Name of the table
	 */
	protected static $_tableName = "reminders";

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
		'subject',
		'message',
		'frequency',
		'startdate',
		'enddate',
		'lastdate',
		'nextdate',
		'driverid',
		'loadid'
	);
	protected $id;
	protected $userid;
	protected $subject;
	protected $message;
	protected $frequency;
	protected $startdate;
	protected $enddate;
	protected $lastdate;
	protected $nextdate;
	protected $driverid;
	protected $loadid;

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

	function getSubject(){
		return $this->subject;
	}
	function setSubject($theValue){
		if($this->subject !== $theValue){
			$this->_modifiedColumns[] = "subject";
			$this->subject = $theValue;
		}
	}

	function getMessage(){
		return $this->message;
	}
	function setMessage($theValue){
		if($this->message !== $theValue){
			$this->_modifiedColumns[] = "message";
			$this->message = $theValue;
		}
	}

	function getFrequency(){
		return $this->frequency;
	}
	function setFrequency($theValue){
		if($this->frequency !== $theValue){
			$this->_modifiedColumns[] = "frequency";
			$this->frequency = $theValue;
		}
	}

	function getStartdate($format = null){
		if($this->startdate===null || !$format)
			return $this->startdate;
		if(strpos($this->startdate, "0000-00-00")===0)
			return null;
		$dateTime = new DateTime($this->startdate);
		return $dateTime->format($format);
	}
	function setStartdate($theValue){
		if($theValue==="")
			$theValue = null;
		elseif($theValue!==null)
			$theValue = date(Reminders::getConnection()->getTimestampFormatter(), strtotime($theValue));
		if($this->startdate !== $theValue){
			$this->_modifiedColumns[] = "startdate";
			$this->startdate = $theValue;
		}
	}

	function getEnddate($format = null){
		if($this->enddate===null || !$format)
			return $this->enddate;
		if(strpos($this->enddate, "0000-00-00")===0)
			return null;
		$dateTime = new DateTime($this->enddate);
		return $dateTime->format($format);
	}
	function setEnddate($theValue){
		if($theValue==="")
			$theValue = null;
		elseif($theValue!==null)
			$theValue = date(Reminders::getConnection()->getTimestampFormatter(), strtotime($theValue));
		if($this->enddate !== $theValue){
			$this->_modifiedColumns[] = "enddate";
			$this->enddate = $theValue;
		}
	}

	function getLastdate($format = null){
		if($this->lastdate===null || !$format)
			return $this->lastdate;
		if(strpos($this->lastdate, "0000-00-00")===0)
			return null;
		$dateTime = new DateTime($this->lastdate);
		return $dateTime->format($format);
	}
	function setLastdate($theValue){
		if($theValue==="")
			$theValue = null;
		elseif($theValue!==null)
			$theValue = date(Reminders::getConnection()->getTimestampFormatter(), strtotime($theValue));
		if($this->lastdate !== $theValue){
			$this->_modifiedColumns[] = "lastdate";
			$this->lastdate = $theValue;
		}
	}

	function getNextdate($format = null){
		if($this->nextdate===null || !$format)
			return $this->nextdate;
		if(strpos($this->nextdate, "0000-00-00")===0)
			return null;
		$dateTime = new DateTime($this->nextdate);
		return $dateTime->format($format);
	}
	function setNextdate($theValue){
		if($theValue==="")
			$theValue = null;
		elseif($theValue!==null)
			$theValue = date(Reminders::getConnection()->getTimestampFormatter(), strtotime($theValue));
		if($this->nextdate !== $theValue){
			$this->_modifiedColumns[] = "nextdate";
			$this->nextdate = $theValue;
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
		return Reminders::$_tableName;
	}

	/**
	 * Access to array of column names
	 * @return array
	 */
	static function getColumnNames(){
		return Reminders::$_columnNames;
	}

	/**
	 * @return bool
	 */
	static function hasColumn($columnName){
		return in_array(strtolower($columnName), array_map('strtolower', Reminders::getColumnNames()));
	}

	/**
	 * Access to array of primary keys
	 * @return array
	 */
	static function getPrimaryKeys(){
		return Reminders::$_primaryKeys;
	}

	/**
	 * Access to name of primary key
	 * @return array
	 */
	static function getPrimaryKey(){
		return Reminders::$_primaryKey;
	}

	/**
	 * Searches the database for a row with the ID(primary key) that matches
	 * the one input.
	 * @return Reminders
	 */
	static function retrieveByPK( $thePK ){
		if($thePK===null)return null;
		$PKs = Reminders::getPrimaryKeys();
		if(count($PKs)>1)
			throw new Exception("This table has more than one primary key.  Use retrieveByPKs() instead.");
		elseif(count($PKs)==0)
			throw new Exception("This table does not have a primary key.");
		$q = new Query;
		$conn = Reminders::getConnection();
		$pkColumn = $conn->quoteIdentifier($PKs[0]);
		$q->add($pkColumn, $thePK);
		$q->setLimit(1);
		return array_shift(Reminders::doSelect($q));
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return Reminders
	 */
	static function retrieveByPKs( $PK0 ){
		$conn = Reminders::getConnection();
		$tableWrapped = $conn->quoteIdentifier(Reminders::getTableName());
		if($PK0===null)return null;
		$queryString = "SELECT * FROM $tableWrapped WHERE ".$conn->quoteIdentifier('id')."=".$conn->checkInput($PK0)."";
		$conn->applyLimit($queryString, 0, 1);
		return Reminders::fetchSingle($queryString);
	}

	/**
	 * Populates and returns an instance of Reminders with the
	 * first result of a query.  If the query returns no results,
	 * returns null.
	 * @return Reminders
	 */
	static function fetchSingle($queryString){
		return array_shift(Reminders::fetch($queryString));
	}

	/**
	 * Populates and returns an Array of Reminders Objects with the
	 * results of a query.  If the query returns no results,
	 * returns an empty Array.
	 * @return array
	 */
	static function fetch($queryString){
		$conn = Reminders::getConnection();
		$result = $conn->query($queryString);
		return Reminders::fromResult($result);
	}

	/**
	 * Returns an array of Reminders Objects from the rows of a PDOStatement(query result)
	 * @return array
	 */
	 static function fromResult(PDOStatement $result){
		$objects = array();
		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			$object = new Reminders;
			$object->fromArray($row);
			$object->resetModified();
			$object->setNew(false);
			$objects[] = $object;
		}
		return $objects;
	 }

	/**
	 * Returns an Array of all Reminders Objects in the database.
	 * $extra SQL can be appended to the query to limit,sort,group results.
	 * If there are no results, returns an empty Array.
	 * @param $extra String
	 * @return array
	 */
	static function getAll($extra = null){
		$conn = Reminders::getConnection();
		$tableWrapped = $conn->quoteIdentifier(Reminders::getTableName());
		return Reminders::fetch("SELECT * FROM $tableWrapped $extra ");
	}

	/**
	 * @return Int
	 */
	static function doCount(Query $q){
		$conn = Reminders::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), Reminders::getTableName())===false )
			$q->setTable(Reminders::getTableName());
		return $q->doCount($conn);
	}

	/**
	 * @return Int
	 */
	static function doDelete(Query $q){
		$conn = Reminders::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), Reminders::getTableName())===false )
			$q->setTable(Reminders::getTableName());
		return $q->doDelete($conn);
	}

	/**
	 * @return array
	 */
	static function doSelect(Query $q){
		$conn = Reminders::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), Reminders::getTableName())===false )
			$q->setTable(Reminders::getTableName());
		return Reminders::fromResult($q->doSelect($conn));
	}

}