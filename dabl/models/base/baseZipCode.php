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

abstract class baseZipCode extends BaseModel{

	/**
	 * Name of the table
	 */
	protected static $_tableName = "zip_code";

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
		'zip_code',
		'city',
		'county',
		'state_name',
		'state_prefix',
		'area_code',
		'time_zone',
		'lat',
		'lon',
		'location'
	);
	protected $id;
	protected $zip_code;
	protected $city;
	protected $county;
	protected $state_name;
	protected $state_prefix;
	protected $area_code;
	protected $time_zone;
	protected $lat;
	protected $lon;
	protected $location;

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

	function getZip_code(){
		return $this->zip_code;
	}
	function setZip_code($theValue){
		if($theValue===null){
			$theValue = "";
		}
		if($this->zip_code !== $theValue){
			$this->_modifiedColumns[] = "zip_code";
			$this->zip_code = $theValue;
		}
	}

	function getCity(){
		return $this->city;
	}
	function setCity($theValue){
		if($this->city !== $theValue){
			$this->_modifiedColumns[] = "city";
			$this->city = $theValue;
		}
	}

	function getCounty(){
		return $this->county;
	}
	function setCounty($theValue){
		if($this->county !== $theValue){
			$this->_modifiedColumns[] = "county";
			$this->county = $theValue;
		}
	}

	function getState_name(){
		return $this->state_name;
	}
	function setState_name($theValue){
		if($this->state_name !== $theValue){
			$this->_modifiedColumns[] = "state_name";
			$this->state_name = $theValue;
		}
	}

	function getState_prefix(){
		return $this->state_prefix;
	}
	function setState_prefix($theValue){
		if($this->state_prefix !== $theValue){
			$this->_modifiedColumns[] = "state_prefix";
			$this->state_prefix = $theValue;
		}
	}

	function getArea_code(){
		return $this->area_code;
	}
	function setArea_code($theValue){
		if($this->area_code !== $theValue){
			$this->_modifiedColumns[] = "area_code";
			$this->area_code = $theValue;
		}
	}

	function getTime_zone(){
		return $this->time_zone;
	}
	function setTime_zone($theValue){
		if($this->time_zone !== $theValue){
			$this->_modifiedColumns[] = "time_zone";
			$this->time_zone = $theValue;
		}
	}

	function getLat(){
		return $this->lat;
	}
	function setLat($theValue){
		if($theValue==="")
			$theValue = null;
		if($theValue===null){
			$theValue = 0;
		}
		if($this->lat !== $theValue){
			$this->_modifiedColumns[] = "lat";
			$this->lat = $theValue;
		}
	}

	function getLon(){
		return $this->lon;
	}
	function setLon($theValue){
		if($theValue==="")
			$theValue = null;
		if($theValue===null){
			$theValue = 0;
		}
		if($this->lon !== $theValue){
			$this->_modifiedColumns[] = "lon";
			$this->lon = $theValue;
		}
	}

	function getLocation(){
		return $this->location;
	}
	function setLocation($theValue){
		if($this->location !== $theValue){
			$this->_modifiedColumns[] = "location";
			$this->location = $theValue;
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
		return ZipCode::$_tableName;
	}

	/**
	 * Access to array of column names
	 * @return array
	 */
	static function getColumnNames(){
		return ZipCode::$_columnNames;
	}

	/**
	 * @return bool
	 */
	static function hasColumn($columnName){
		return in_array(strtolower($columnName), array_map('strtolower', ZipCode::getColumnNames()));
	}

	/**
	 * Access to array of primary keys
	 * @return array
	 */
	static function getPrimaryKeys(){
		return ZipCode::$_primaryKeys;
	}

	/**
	 * Access to name of primary key
	 * @return array
	 */
	static function getPrimaryKey(){
		return ZipCode::$_primaryKey;
	}

	/**
	 * Searches the database for a row with the ID(primary key) that matches
	 * the one input.
	 * @return ZipCode
	 */
	static function retrieveByPK( $thePK ){
		if($thePK===null)return null;
		$PKs = ZipCode::getPrimaryKeys();
		if(count($PKs)>1)
			throw new Exception("This table has more than one primary key.  Use retrieveByPKs() instead.");
		elseif(count($PKs)==0)
			throw new Exception("This table does not have a primary key.");
		$q = new Query;
		$conn = ZipCode::getConnection();
		$pkColumn = $conn->quoteIdentifier($PKs[0]);
		$q->add($pkColumn, $thePK);
		$q->setLimit(1);
		return array_shift(ZipCode::doSelect($q));
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return ZipCode
	 */
	static function retrieveByPKs( $PK0 ){
		$conn = ZipCode::getConnection();
		$tableWrapped = $conn->quoteIdentifier(ZipCode::getTableName());
		if($PK0===null)return null;
		$queryString = "SELECT * FROM $tableWrapped WHERE ".$conn->quoteIdentifier('id')."=".$conn->checkInput($PK0)."";
		$conn->applyLimit($queryString, 0, 1);
		return ZipCode::fetchSingle($queryString);
	}

	/**
	 * Populates and returns an instance of ZipCode with the
	 * first result of a query.  If the query returns no results,
	 * returns null.
	 * @return ZipCode
	 */
	static function fetchSingle($queryString){
		return array_shift(ZipCode::fetch($queryString));
	}

	/**
	 * Populates and returns an Array of ZipCode Objects with the
	 * results of a query.  If the query returns no results,
	 * returns an empty Array.
	 * @return array
	 */
	static function fetch($queryString){
		$conn = ZipCode::getConnection();
		$result = $conn->query($queryString);
		return ZipCode::fromResult($result);
	}

	/**
	 * Returns an array of ZipCode Objects from the rows of a PDOStatement(query result)
	 * @return array
	 */
	 static function fromResult(PDOStatement $result){
		$objects = array();
		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			$object = new ZipCode;
			$object->fromArray($row);
			$object->resetModified();
			$object->setNew(false);
			$objects[] = $object;
		}
		return $objects;
	 }

	/**
	 * Returns an Array of all ZipCode Objects in the database.
	 * $extra SQL can be appended to the query to limit,sort,group results.
	 * If there are no results, returns an empty Array.
	 * @param $extra String
	 * @return array
	 */
	static function getAll($extra = null){
		$conn = ZipCode::getConnection();
		$tableWrapped = $conn->quoteIdentifier(ZipCode::getTableName());
		return ZipCode::fetch("SELECT * FROM $tableWrapped $extra ");
	}

	/**
	 * @return Int
	 */
	static function doCount(Query $q){
		$conn = ZipCode::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), ZipCode::getTableName())===false )
			$q->setTable(ZipCode::getTableName());
		return $q->doCount($conn);
	}

	/**
	 * @return Int
	 */
	static function doDelete(Query $q){
		$conn = ZipCode::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), ZipCode::getTableName())===false )
			$q->setTable(ZipCode::getTableName());
		return $q->doDelete($conn);
	}

	/**
	 * @return array
	 */
	static function doSelect(Query $q){
		$conn = ZipCode::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), ZipCode::getTableName())===false )
			$q->setTable(ZipCode::getTableName());
		return ZipCode::fromResult($q->doSelect($conn));
	}

}