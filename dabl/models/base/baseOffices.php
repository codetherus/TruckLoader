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

abstract class baseOffices extends BaseModel{

	/**
	 * Name of the table
	 */
	protected static $_tableName = "offices";

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
		'name',
		'address1',
		'address2',
		'city',
		'state',
		'shortname'
	);
	protected $id;
	protected $name;
	protected $address1;
	protected $address2;
	protected $city;
	protected $state;
	protected $shortname;

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

	function getName(){
		return $this->name;
	}
	function setName($theValue){
		if($this->name !== $theValue){
			$this->_modifiedColumns[] = "name";
			$this->name = $theValue;
		}
	}

	function getAddress1(){
		return $this->address1;
	}
	function setAddress1($theValue){
		if($this->address1 !== $theValue){
			$this->_modifiedColumns[] = "address1";
			$this->address1 = $theValue;
		}
	}

	function getAddress2(){
		return $this->address2;
	}
	function setAddress2($theValue){
		if($this->address2 !== $theValue){
			$this->_modifiedColumns[] = "address2";
			$this->address2 = $theValue;
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

	function getState(){
		return $this->state;
	}
	function setState($theValue){
		if($this->state !== $theValue){
			$this->_modifiedColumns[] = "state";
			$this->state = $theValue;
		}
	}

	function getShortname(){
		return $this->shortname;
	}
	function setShortname($theValue){
		if($this->shortname !== $theValue){
			$this->_modifiedColumns[] = "shortname";
			$this->shortname = $theValue;
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
		return Offices::$_tableName;
	}

	/**
	 * Access to array of column names
	 * @return array
	 */
	static function getColumnNames(){
		return Offices::$_columnNames;
	}

	/**
	 * @return bool
	 */
	static function hasColumn($columnName){
		return in_array(strtolower($columnName), array_map('strtolower', Offices::getColumnNames()));
	}

	/**
	 * Access to array of primary keys
	 * @return array
	 */
	static function getPrimaryKeys(){
		return Offices::$_primaryKeys;
	}

	/**
	 * Access to name of primary key
	 * @return array
	 */
	static function getPrimaryKey(){
		return Offices::$_primaryKey;
	}

	/**
	 * Searches the database for a row with the ID(primary key) that matches
	 * the one input.
	 * @return Offices
	 */
	static function retrieveByPK( $thePK ){
		if($thePK===null)return null;
		$PKs = Offices::getPrimaryKeys();
		if(count($PKs)>1)
			throw new Exception("This table has more than one primary key.  Use retrieveByPKs() instead.");
		elseif(count($PKs)==0)
			throw new Exception("This table does not have a primary key.");
		$q = new Query;
		$conn = Offices::getConnection();
		$pkColumn = $conn->quoteIdentifier($PKs[0]);
		$q->add($pkColumn, $thePK);
		$q->setLimit(1);
		return array_shift(Offices::doSelect($q));
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return Offices
	 */
	static function retrieveByPKs( $PK0 ){
		$conn = Offices::getConnection();
		$tableWrapped = $conn->quoteIdentifier(Offices::getTableName());
		if($PK0===null)return null;
		$queryString = "SELECT * FROM $tableWrapped WHERE ".$conn->quoteIdentifier('id')."=".$conn->checkInput($PK0)."";
		$conn->applyLimit($queryString, 0, 1);
		return Offices::fetchSingle($queryString);
	}

	/**
	 * Populates and returns an instance of Offices with the
	 * first result of a query.  If the query returns no results,
	 * returns null.
	 * @return Offices
	 */
	static function fetchSingle($queryString){
		return array_shift(Offices::fetch($queryString));
	}

	/**
	 * Populates and returns an Array of Offices Objects with the
	 * results of a query.  If the query returns no results,
	 * returns an empty Array.
	 * @return array
	 */
	static function fetch($queryString){
		$conn = Offices::getConnection();
		$result = $conn->query($queryString);
		return Offices::fromResult($result);
	}

	/**
	 * Returns an array of Offices Objects from the rows of a PDOStatement(query result)
	 * @return array
	 */
	 static function fromResult(PDOStatement $result){
		$objects = array();
		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			$object = new Offices;
			$object->fromArray($row);
			$object->resetModified();
			$object->setNew(false);
			$objects[] = $object;
		}
		return $objects;
	 }

	/**
	 * Returns an Array of all Offices Objects in the database.
	 * $extra SQL can be appended to the query to limit,sort,group results.
	 * If there are no results, returns an empty Array.
	 * @param $extra String
	 * @return array
	 */
	static function getAll($extra = null){
		$conn = Offices::getConnection();
		$tableWrapped = $conn->quoteIdentifier(Offices::getTableName());
		return Offices::fetch("SELECT * FROM $tableWrapped $extra ");
	}

	/**
	 * @return Int
	 */
	static function doCount(Query $q){
		$conn = Offices::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), Offices::getTableName())===false )
			$q->setTable(Offices::getTableName());
		return $q->doCount($conn);
	}

	/**
	 * @return Int
	 */
	static function doDelete(Query $q){
		$conn = Offices::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), Offices::getTableName())===false )
			$q->setTable(Offices::getTableName());
		return $q->doDelete($conn);
	}

	/**
	 * @return array
	 */
	static function doSelect(Query $q){
		$conn = Offices::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), Offices::getTableName())===false )
			$q->setTable(Offices::getTableName());
		return Offices::fromResult($q->doSelect($conn));
	}

}