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

abstract class baseLoadHistory extends BaseModel{

	/**
	 * Name of the table
	 */
	protected static $_tableName = "load_history";

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
		'driverid',
		'pickup_date',
		'unload_date',
		'corp_id',
		'source',
		'destination',
		'contract_pdf',
		'notes'
	);
	protected $id;
	protected $driverid;
	protected $pickup_date;
	protected $unload_date;
	protected $corp_id;
	protected $source;
	protected $destination;
	protected $contract_pdf;
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

	function getPickup_date($format = null){
		if($this->pickup_date===null || !$format)
			return $this->pickup_date;
		if(strpos($this->pickup_date, "0000-00-00")===0)
			return null;
		$dateTime = new DateTime($this->pickup_date);
		return $dateTime->format($format);
	}
	function setPickup_date($theValue){
		if($theValue==="")
			$theValue = null;
		elseif($theValue!==null)
			$theValue = date(LoadHistory::getConnection()->getDateFormatter(), strtotime($theValue));
		if($this->pickup_date !== $theValue){
			$this->_modifiedColumns[] = "pickup_date";
			$this->pickup_date = $theValue;
		}
	}

	function getUnload_date($format = null){
		if($this->unload_date===null || !$format)
			return $this->unload_date;
		if(strpos($this->unload_date, "0000-00-00")===0)
			return null;
		$dateTime = new DateTime($this->unload_date);
		return $dateTime->format($format);
	}
	function setUnload_date($theValue){
		if($theValue==="")
			$theValue = null;
		elseif($theValue!==null)
			$theValue = date(LoadHistory::getConnection()->getDateFormatter(), strtotime($theValue));
		if($this->unload_date !== $theValue){
			$this->_modifiedColumns[] = "unload_date";
			$this->unload_date = $theValue;
		}
	}

	function getCorp_id(){
		return $this->corp_id;
	}
	function setCorp_id($theValue){
		if($this->corp_id !== $theValue){
			$this->_modifiedColumns[] = "corp_id";
			$this->corp_id = $theValue;
		}
	}

	function getSource(){
		return $this->source;
	}
	function setSource($theValue){
		if($this->source !== $theValue){
			$this->_modifiedColumns[] = "source";
			$this->source = $theValue;
		}
	}

	function getDestination(){
		return $this->destination;
	}
	function setDestination($theValue){
		if($this->destination !== $theValue){
			$this->_modifiedColumns[] = "destination";
			$this->destination = $theValue;
		}
	}

	function getContract_pdf(){
		return $this->contract_pdf;
	}
	function setContract_pdf($theValue){
		if($this->contract_pdf !== $theValue){
			$this->_modifiedColumns[] = "contract_pdf";
			$this->contract_pdf = $theValue;
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
		return LoadHistory::$_tableName;
	}

	/**
	 * Access to array of column names
	 * @return array
	 */
	static function getColumnNames(){
		return LoadHistory::$_columnNames;
	}

	/**
	 * @return bool
	 */
	static function hasColumn($columnName){
		return in_array(strtolower($columnName), array_map('strtolower', LoadHistory::getColumnNames()));
	}

	/**
	 * Access to array of primary keys
	 * @return array
	 */
	static function getPrimaryKeys(){
		return LoadHistory::$_primaryKeys;
	}

	/**
	 * Access to name of primary key
	 * @return array
	 */
	static function getPrimaryKey(){
		return LoadHistory::$_primaryKey;
	}

	/**
	 * Searches the database for a row with the ID(primary key) that matches
	 * the one input.
	 * @return LoadHistory
	 */
	static function retrieveByPK( $thePK ){
		if($thePK===null)return null;
		$PKs = LoadHistory::getPrimaryKeys();
		if(count($PKs)>1)
			throw new Exception("This table has more than one primary key.  Use retrieveByPKs() instead.");
		elseif(count($PKs)==0)
			throw new Exception("This table does not have a primary key.");
		$q = new Query;
		$conn = LoadHistory::getConnection();
		$pkColumn = $conn->quoteIdentifier($PKs[0]);
		$q->add($pkColumn, $thePK);
		$q->setLimit(1);
		return array_shift(LoadHistory::doSelect($q));
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return LoadHistory
	 */
	static function retrieveByPKs( $PK0 ){
		$conn = LoadHistory::getConnection();
		$tableWrapped = $conn->quoteIdentifier(LoadHistory::getTableName());
		if($PK0===null)return null;
		$queryString = "SELECT * FROM $tableWrapped WHERE ".$conn->quoteIdentifier('id')."=".$conn->checkInput($PK0)."";
		$conn->applyLimit($queryString, 0, 1);
		return LoadHistory::fetchSingle($queryString);
	}

	/**
	 * Populates and returns an instance of LoadHistory with the
	 * first result of a query.  If the query returns no results,
	 * returns null.
	 * @return LoadHistory
	 */
	static function fetchSingle($queryString){
		return array_shift(LoadHistory::fetch($queryString));
	}

	/**
	 * Populates and returns an Array of LoadHistory Objects with the
	 * results of a query.  If the query returns no results,
	 * returns an empty Array.
	 * @return array
	 */
	static function fetch($queryString){
		$conn = LoadHistory::getConnection();
		$result = $conn->query($queryString);
		return LoadHistory::fromResult($result);
	}

	/**
	 * Returns an array of LoadHistory Objects from the rows of a PDOStatement(query result)
	 * @return array
	 */
	 static function fromResult(PDOStatement $result){
		$objects = array();
		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			$object = new LoadHistory;
			$object->fromArray($row);
			$object->resetModified();
			$object->setNew(false);
			$objects[] = $object;
		}
		return $objects;
	 }

	/**
	 * Returns an Array of all LoadHistory Objects in the database.
	 * $extra SQL can be appended to the query to limit,sort,group results.
	 * If there are no results, returns an empty Array.
	 * @param $extra String
	 * @return array
	 */
	static function getAll($extra = null){
		$conn = LoadHistory::getConnection();
		$tableWrapped = $conn->quoteIdentifier(LoadHistory::getTableName());
		return LoadHistory::fetch("SELECT * FROM $tableWrapped $extra ");
	}

	/**
	 * @return Int
	 */
	static function doCount(Query $q){
		$conn = LoadHistory::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), LoadHistory::getTableName())===false )
			$q->setTable(LoadHistory::getTableName());
		return $q->doCount($conn);
	}

	/**
	 * @return Int
	 */
	static function doDelete(Query $q){
		$conn = LoadHistory::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), LoadHistory::getTableName())===false )
			$q->setTable(LoadHistory::getTableName());
		return $q->doDelete($conn);
	}

	/**
	 * @return array
	 */
	static function doSelect(Query $q){
		$conn = LoadHistory::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), LoadHistory::getTableName())===false )
			$q->setTable(LoadHistory::getTableName());
		return LoadHistory::fromResult($q->doSelect($conn));
	}

}