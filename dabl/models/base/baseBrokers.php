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

abstract class baseBrokers extends BaseModel{

	/**
	 * Name of the table
	 */
	protected static $_tableName = "brokers";

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
		'company',
		'address1',
		'address2',
		'city',
		'state',
		'zip',
		'phone',
		'cell',
		'fax',
		'notes'
	);
	protected $id;
	protected $name;
	protected $company;
	protected $address1;
	protected $address2;
	protected $city;
	protected $state;
	protected $zip;
	protected $phone;
	protected $cell;
	protected $fax;
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

	function getName(){
		return $this->name;
	}
	function setName($theValue){
		if($this->name !== $theValue){
			$this->_modifiedColumns[] = "name";
			$this->name = $theValue;
		}
	}

	function getCompany(){
		return $this->company;
	}
	function setCompany($theValue){
		if($this->company !== $theValue){
			$this->_modifiedColumns[] = "company";
			$this->company = $theValue;
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

	function getZip(){
		return $this->zip;
	}
	function setZip($theValue){
		if($this->zip !== $theValue){
			$this->_modifiedColumns[] = "zip";
			$this->zip = $theValue;
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

	function getCell(){
		return $this->cell;
	}
	function setCell($theValue){
		if($this->cell !== $theValue){
			$this->_modifiedColumns[] = "cell";
			$this->cell = $theValue;
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
		return Brokers::$_tableName;
	}

	/**
	 * Access to array of column names
	 * @return array
	 */
	static function getColumnNames(){
		return Brokers::$_columnNames;
	}

	/**
	 * @return bool
	 */
	static function hasColumn($columnName){
		return in_array(strtolower($columnName), array_map('strtolower', Brokers::getColumnNames()));
	}

	/**
	 * Access to array of primary keys
	 * @return array
	 */
	static function getPrimaryKeys(){
		return Brokers::$_primaryKeys;
	}

	/**
	 * Access to name of primary key
	 * @return array
	 */
	static function getPrimaryKey(){
		return Brokers::$_primaryKey;
	}

	/**
	 * Searches the database for a row with the ID(primary key) that matches
	 * the one input.
	 * @return Brokers
	 */
	static function retrieveByPK( $thePK ){
		if($thePK===null)return null;
		$PKs = Brokers::getPrimaryKeys();
		if(count($PKs)>1)
			throw new Exception("This table has more than one primary key.  Use retrieveByPKs() instead.");
		elseif(count($PKs)==0)
			throw new Exception("This table does not have a primary key.");
		$q = new Query;
		$conn = Brokers::getConnection();
		$pkColumn = $conn->quoteIdentifier($PKs[0]);
		$q->add($pkColumn, $thePK);
		$q->setLimit(1);
		return array_shift(Brokers::doSelect($q));
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return Brokers
	 */
	static function retrieveByPKs( $PK0 ){
		$conn = Brokers::getConnection();
		$tableWrapped = $conn->quoteIdentifier(Brokers::getTableName());
		if($PK0===null)return null;
		$queryString = "SELECT * FROM $tableWrapped WHERE ".$conn->quoteIdentifier('id')."=".$conn->checkInput($PK0)."";
		$conn->applyLimit($queryString, 0, 1);
		return Brokers::fetchSingle($queryString);
	}

	/**
	 * Populates and returns an instance of Brokers with the
	 * first result of a query.  If the query returns no results,
	 * returns null.
	 * @return Brokers
	 */
	static function fetchSingle($queryString){
		return array_shift(Brokers::fetch($queryString));
	}

	/**
	 * Populates and returns an Array of Brokers Objects with the
	 * results of a query.  If the query returns no results,
	 * returns an empty Array.
	 * @return array
	 */
	static function fetch($queryString){
		$conn = Brokers::getConnection();
		$result = $conn->query($queryString);
		return Brokers::fromResult($result);
	}

	/**
	 * Returns an array of Brokers Objects from the rows of a PDOStatement(query result)
	 * @return array
	 */
	 static function fromResult(PDOStatement $result){
		$objects = array();
		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			$object = new Brokers;
			$object->fromArray($row);
			$object->resetModified();
			$object->setNew(false);
			$objects[] = $object;
		}
		return $objects;
	 }

	/**
	 * Returns an Array of all Brokers Objects in the database.
	 * $extra SQL can be appended to the query to limit,sort,group results.
	 * If there are no results, returns an empty Array.
	 * @param $extra String
	 * @return array
	 */
	static function getAll($extra = null){
		$conn = Brokers::getConnection();
		$tableWrapped = $conn->quoteIdentifier(Brokers::getTableName());
		return Brokers::fetch("SELECT * FROM $tableWrapped $extra ");
	}

	/**
	 * @return Int
	 */
	static function doCount(Query $q){
		$conn = Brokers::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), Brokers::getTableName())===false )
			$q->setTable(Brokers::getTableName());
		return $q->doCount($conn);
	}

	/**
	 * @return Int
	 */
	static function doDelete(Query $q){
		$conn = Brokers::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), Brokers::getTableName())===false )
			$q->setTable(Brokers::getTableName());
		return $q->doDelete($conn);
	}

	/**
	 * @return array
	 */
	static function doSelect(Query $q){
		$conn = Brokers::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), Brokers::getTableName())===false )
			$q->setTable(Brokers::getTableName());
		return Brokers::fromResult($q->doSelect($conn));
	}

}