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

abstract class basePhones extends BaseModel{

	/**
	 * Name of the table
	 */
	protected static $_tableName = "phones";

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
		'contact_type',
		'entityid',
		'entity',
		'entity_type',
		'entity_name'
	);
	protected $id;
	protected $contact_type;
	protected $entityid;
	protected $entity;
	protected $entity_type;
	protected $entity_name;

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

	function getContact_type(){
		return $this->contact_type;
	}
	function setContact_type($theValue){
		if($this->contact_type !== $theValue){
			$this->_modifiedColumns[] = "contact_type";
			$this->contact_type = $theValue;
		}
	}

	function getEntityid(){
		return $this->entityid;
	}
	function setEntityid($theValue){
		if($theValue==="")
			$theValue = null;
		if($theValue!==null)
			$theValue = (int)$theValue;
		if($this->entityid !== $theValue){
			$this->_modifiedColumns[] = "entityid";
			$this->entityid = $theValue;
		}
	}

	function getEntity(){
		return $this->entity;
	}
	function setEntity($theValue){
		if($this->entity !== $theValue){
			$this->_modifiedColumns[] = "entity";
			$this->entity = $theValue;
		}
	}

	function getEntity_type(){
		return $this->entity_type;
	}
	function setEntity_type($theValue){
		if($this->entity_type !== $theValue){
			$this->_modifiedColumns[] = "entity_type";
			$this->entity_type = $theValue;
		}
	}

	function getEntity_name(){
		return $this->entity_name;
	}
	function setEntity_name($theValue){
		if($this->entity_name !== $theValue){
			$this->_modifiedColumns[] = "entity_name";
			$this->entity_name = $theValue;
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
		return Phones::$_tableName;
	}

	/**
	 * Access to array of column names
	 * @return array
	 */
	static function getColumnNames(){
		return Phones::$_columnNames;
	}

	/**
	 * @return bool
	 */
	static function hasColumn($columnName){
		return in_array(strtolower($columnName), array_map('strtolower', Phones::getColumnNames()));
	}

	/**
	 * Access to array of primary keys
	 * @return array
	 */
	static function getPrimaryKeys(){
		return Phones::$_primaryKeys;
	}

	/**
	 * Access to name of primary key
	 * @return array
	 */
	static function getPrimaryKey(){
		return Phones::$_primaryKey;
	}

	/**
	 * Searches the database for a row with the ID(primary key) that matches
	 * the one input.
	 * @return Phones
	 */
	static function retrieveByPK( $thePK ){
		if($thePK===null)return null;
		$PKs = Phones::getPrimaryKeys();
		if(count($PKs)>1)
			throw new Exception("This table has more than one primary key.  Use retrieveByPKs() instead.");
		elseif(count($PKs)==0)
			throw new Exception("This table does not have a primary key.");
		$q = new Query;
		$conn = Phones::getConnection();
		$pkColumn = $conn->quoteIdentifier($PKs[0]);
		$q->add($pkColumn, $thePK);
		$q->setLimit(1);
		return array_shift(Phones::doSelect($q));
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return Phones
	 */
	static function retrieveByPKs( $PK0 ){
		$conn = Phones::getConnection();
		$tableWrapped = $conn->quoteIdentifier(Phones::getTableName());
		if($PK0===null)return null;
		$queryString = "SELECT * FROM $tableWrapped WHERE ".$conn->quoteIdentifier('id')."=".$conn->checkInput($PK0)."";
		$conn->applyLimit($queryString, 0, 1);
		return Phones::fetchSingle($queryString);
	}

	/**
	 * Populates and returns an instance of Phones with the
	 * first result of a query.  If the query returns no results,
	 * returns null.
	 * @return Phones
	 */
	static function fetchSingle($queryString){
		return array_shift(Phones::fetch($queryString));
	}

	/**
	 * Populates and returns an Array of Phones Objects with the
	 * results of a query.  If the query returns no results,
	 * returns an empty Array.
	 * @return array
	 */
	static function fetch($queryString){
		$conn = Phones::getConnection();
		$result = $conn->query($queryString);
		return Phones::fromResult($result);
	}

	/**
	 * Returns an array of Phones Objects from the rows of a PDOStatement(query result)
	 * @return array
	 */
	 static function fromResult(PDOStatement $result){
		$objects = array();
		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			$object = new Phones;
			$object->fromArray($row);
			$object->resetModified();
			$object->setNew(false);
			$objects[] = $object;
		}
		return $objects;
	 }

	/**
	 * Returns an Array of all Phones Objects in the database.
	 * $extra SQL can be appended to the query to limit,sort,group results.
	 * If there are no results, returns an empty Array.
	 * @param $extra String
	 * @return array
	 */
	static function getAll($extra = null){
		$conn = Phones::getConnection();
		$tableWrapped = $conn->quoteIdentifier(Phones::getTableName());
		return Phones::fetch("SELECT * FROM $tableWrapped $extra ");
	}

	/**
	 * @return Int
	 */
	static function doCount(Query $q){
		$conn = Phones::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), Phones::getTableName())===false )
			$q->setTable(Phones::getTableName());
		return $q->doCount($conn);
	}

	/**
	 * @return Int
	 */
	static function doDelete(Query $q){
		$conn = Phones::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), Phones::getTableName())===false )
			$q->setTable(Phones::getTableName());
		return $q->doDelete($conn);
	}

	/**
	 * @return array
	 */
	static function doSelect(Query $q){
		$conn = Phones::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), Phones::getTableName())===false )
			$q->setTable(Phones::getTableName());
		return Phones::fromResult($q->doSelect($conn));
	}

}