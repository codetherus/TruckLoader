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

abstract class baseDriverZones extends BaseModel{

	/**
	 * Name of the table
	 */
	protected static $_tableName = "driver_zones";

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
		'zones'
	);
	protected $id;
	protected $driverid;
	protected $zones;

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

	function getZones(){
		return $this->zones;
	}
	function setZones($theValue){
		if($this->zones !== $theValue){
			$this->_modifiedColumns[] = "zones";
			$this->zones = $theValue;
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
		return DriverZones::$_tableName;
	}

	/**
	 * Access to array of column names
	 * @return array
	 */
	static function getColumnNames(){
		return DriverZones::$_columnNames;
	}

	/**
	 * @return bool
	 */
	static function hasColumn($columnName){
		return in_array(strtolower($columnName), array_map('strtolower', DriverZones::getColumnNames()));
	}

	/**
	 * Access to array of primary keys
	 * @return array
	 */
	static function getPrimaryKeys(){
		return DriverZones::$_primaryKeys;
	}

	/**
	 * Access to name of primary key
	 * @return array
	 */
	static function getPrimaryKey(){
		return DriverZones::$_primaryKey;
	}

	/**
	 * Searches the database for a row with the ID(primary key) that matches
	 * the one input.
	 * @return DriverZones
	 */
	static function retrieveByPK( $thePK ){
		if($thePK===null)return null;
		$PKs = DriverZones::getPrimaryKeys();
		if(count($PKs)>1)
			throw new Exception("This table has more than one primary key.  Use retrieveByPKs() instead.");
		elseif(count($PKs)==0)
			throw new Exception("This table does not have a primary key.");
		$q = new Query;
		$conn = DriverZones::getConnection();
		$pkColumn = $conn->quoteIdentifier($PKs[0]);
		$q->add($pkColumn, $thePK);
		$q->setLimit(1);
		return array_shift(DriverZones::doSelect($q));
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return DriverZones
	 */
	static function retrieveByPKs( $PK0 ){
		$conn = DriverZones::getConnection();
		$tableWrapped = $conn->quoteIdentifier(DriverZones::getTableName());
		if($PK0===null)return null;
		$queryString = "SELECT * FROM $tableWrapped WHERE ".$conn->quoteIdentifier('id')."=".$conn->checkInput($PK0)."";
		$conn->applyLimit($queryString, 0, 1);
		return DriverZones::fetchSingle($queryString);
	}

	/**
	 * Populates and returns an instance of DriverZones with the
	 * first result of a query.  If the query returns no results,
	 * returns null.
	 * @return DriverZones
	 */
	static function fetchSingle($queryString){
		return array_shift(DriverZones::fetch($queryString));
	}

	/**
	 * Populates and returns an Array of DriverZones Objects with the
	 * results of a query.  If the query returns no results,
	 * returns an empty Array.
	 * @return array
	 */
	static function fetch($queryString){
		$conn = DriverZones::getConnection();
		$result = $conn->query($queryString);
		return DriverZones::fromResult($result);
	}

	/**
	 * Returns an array of DriverZones Objects from the rows of a PDOStatement(query result)
	 * @return array
	 */
	 static function fromResult(PDOStatement $result){
		$objects = array();
		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			$object = new DriverZones;
			$object->fromArray($row);
			$object->resetModified();
			$object->setNew(false);
			$objects[] = $object;
		}
		return $objects;
	 }

	/**
	 * Returns an Array of all DriverZones Objects in the database.
	 * $extra SQL can be appended to the query to limit,sort,group results.
	 * If there are no results, returns an empty Array.
	 * @param $extra String
	 * @return array
	 */
	static function getAll($extra = null){
		$conn = DriverZones::getConnection();
		$tableWrapped = $conn->quoteIdentifier(DriverZones::getTableName());
		return DriverZones::fetch("SELECT * FROM $tableWrapped $extra ");
	}

	/**
	 * @return Int
	 */
	static function doCount(Query $q){
		$conn = DriverZones::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), DriverZones::getTableName())===false )
			$q->setTable(DriverZones::getTableName());
		return $q->doCount($conn);
	}

	/**
	 * @return Int
	 */
	static function doDelete(Query $q){
		$conn = DriverZones::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), DriverZones::getTableName())===false )
			$q->setTable(DriverZones::getTableName());
		return $q->doDelete($conn);
	}

	/**
	 * @return array
	 */
	static function doSelect(Query $q){
		$conn = DriverZones::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), DriverZones::getTableName())===false )
			$q->setTable(DriverZones::getTableName());
		return DriverZones::fromResult($q->doSelect($conn));
	}

}