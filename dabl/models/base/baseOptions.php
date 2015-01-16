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

abstract class baseOptions extends BaseModel{

	/**
	 * Name of the table
	 */
	protected static $_tableName = "options";

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
		'opt_name',
		'opt_value'
	);
	protected $id;
	protected $opt_name;
	protected $opt_value;

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

	function getOpt_name(){
		return $this->opt_name;
	}
	function setOpt_name($theValue){
		if($this->opt_name !== $theValue){
			$this->_modifiedColumns[] = "opt_name";
			$this->opt_name = $theValue;
		}
	}

	function getOpt_value(){
		return $this->opt_value;
	}
	function setOpt_value($theValue){
		if($this->opt_value !== $theValue){
			$this->_modifiedColumns[] = "opt_value";
			$this->opt_value = $theValue;
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
		return Options::$_tableName;
	}

	/**
	 * Access to array of column names
	 * @return array
	 */
	static function getColumnNames(){
		return Options::$_columnNames;
	}

	/**
	 * @return bool
	 */
	static function hasColumn($columnName){
		return in_array(strtolower($columnName), array_map('strtolower', Options::getColumnNames()));
	}

	/**
	 * Access to array of primary keys
	 * @return array
	 */
	static function getPrimaryKeys(){
		return Options::$_primaryKeys;
	}

	/**
	 * Access to name of primary key
	 * @return array
	 */
	static function getPrimaryKey(){
		return Options::$_primaryKey;
	}

	/**
	 * Searches the database for a row with the ID(primary key) that matches
	 * the one input.
	 * @return Options
	 */
	static function retrieveByPK( $thePK ){
		if($thePK===null)return null;
		$PKs = Options::getPrimaryKeys();
		if(count($PKs)>1)
			throw new Exception("This table has more than one primary key.  Use retrieveByPKs() instead.");
		elseif(count($PKs)==0)
			throw new Exception("This table does not have a primary key.");
		$q = new Query;
		$conn = Options::getConnection();
		$pkColumn = $conn->quoteIdentifier($PKs[0]);
		$q->add($pkColumn, $thePK);
		$q->setLimit(1);
		return array_shift(Options::doSelect($q));
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return Options
	 */
	static function retrieveByPKs( $PK0 ){
		$conn = Options::getConnection();
		$tableWrapped = $conn->quoteIdentifier(Options::getTableName());
		if($PK0===null)return null;
		$queryString = "SELECT * FROM $tableWrapped WHERE ".$conn->quoteIdentifier('id')."=".$conn->checkInput($PK0)."";
		$conn->applyLimit($queryString, 0, 1);
		return Options::fetchSingle($queryString);
	}

	/**
	 * Populates and returns an instance of Options with the
	 * first result of a query.  If the query returns no results,
	 * returns null.
	 * @return Options
	 */
	static function fetchSingle($queryString){
		return array_shift(Options::fetch($queryString));
	}

	/**
	 * Populates and returns an Array of Options Objects with the
	 * results of a query.  If the query returns no results,
	 * returns an empty Array.
	 * @return array
	 */
	static function fetch($queryString){
		$conn = Options::getConnection();
		$result = $conn->query($queryString);
		return Options::fromResult($result);
	}

	/**
	 * Returns an array of Options Objects from the rows of a PDOStatement(query result)
	 * @return array
	 */
	 static function fromResult(PDOStatement $result){
		$objects = array();
		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			$object = new Options;
			$object->fromArray($row);
			$object->resetModified();
			$object->setNew(false);
			$objects[] = $object;
		}
		return $objects;
	 }

	/**
	 * Returns an Array of all Options Objects in the database.
	 * $extra SQL can be appended to the query to limit,sort,group results.
	 * If there are no results, returns an empty Array.
	 * @param $extra String
	 * @return array
	 */
	static function getAll($extra = null){
		$conn = Options::getConnection();
		$tableWrapped = $conn->quoteIdentifier(Options::getTableName());
		return Options::fetch("SELECT * FROM $tableWrapped $extra ");
	}

	/**
	 * @return Int
	 */
	static function doCount(Query $q){
		$conn = Options::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), Options::getTableName())===false )
			$q->setTable(Options::getTableName());
		return $q->doCount($conn);
	}

	/**
	 * @return Int
	 */
	static function doDelete(Query $q){
		$conn = Options::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), Options::getTableName())===false )
			$q->setTable(Options::getTableName());
		return $q->doDelete($conn);
	}

	/**
	 * @return array
	 */
	static function doSelect(Query $q){
		$conn = Options::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), Options::getTableName())===false )
			$q->setTable(Options::getTableName());
		return Options::fromResult($q->doSelect($conn));
	}

}