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

abstract class baseQueintraStyles extends BaseModel{

	/**
	 * Name of the table
	 */
	protected static $_tableName = "queintra_styles";

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
		'style',
		'ip_address'
	);
	protected $id;
	protected $style;
	protected $ip_address;

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

	function getStyle(){
		return $this->style;
	}
	function setStyle($theValue){
		if($this->style !== $theValue){
			$this->_modifiedColumns[] = "style";
			$this->style = $theValue;
		}
	}

	function getIp_address(){
		return $this->ip_address;
	}
	function setIp_address($theValue){
		if($this->ip_address !== $theValue){
			$this->_modifiedColumns[] = "ip_address";
			$this->ip_address = $theValue;
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
		return QueintraStyles::$_tableName;
	}

	/**
	 * Access to array of column names
	 * @return array
	 */
	static function getColumnNames(){
		return QueintraStyles::$_columnNames;
	}

	/**
	 * @return bool
	 */
	static function hasColumn($columnName){
		return in_array(strtolower($columnName), array_map('strtolower', QueintraStyles::getColumnNames()));
	}

	/**
	 * Access to array of primary keys
	 * @return array
	 */
	static function getPrimaryKeys(){
		return QueintraStyles::$_primaryKeys;
	}

	/**
	 * Access to name of primary key
	 * @return array
	 */
	static function getPrimaryKey(){
		return QueintraStyles::$_primaryKey;
	}

	/**
	 * Searches the database for a row with the ID(primary key) that matches
	 * the one input.
	 * @return QueintraStyles
	 */
	static function retrieveByPK( $thePK ){
		if($thePK===null)return null;
		$PKs = QueintraStyles::getPrimaryKeys();
		if(count($PKs)>1)
			throw new Exception("This table has more than one primary key.  Use retrieveByPKs() instead.");
		elseif(count($PKs)==0)
			throw new Exception("This table does not have a primary key.");
		$q = new Query;
		$conn = QueintraStyles::getConnection();
		$pkColumn = $conn->quoteIdentifier($PKs[0]);
		$q->add($pkColumn, $thePK);
		$q->setLimit(1);
		return array_shift(QueintraStyles::doSelect($q));
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return QueintraStyles
	 */
	static function retrieveByPKs( $PK0 ){
		$conn = QueintraStyles::getConnection();
		$tableWrapped = $conn->quoteIdentifier(QueintraStyles::getTableName());
		if($PK0===null)return null;
		$queryString = "SELECT * FROM $tableWrapped WHERE ".$conn->quoteIdentifier('id')."=".$conn->checkInput($PK0)."";
		$conn->applyLimit($queryString, 0, 1);
		return QueintraStyles::fetchSingle($queryString);
	}

	/**
	 * Populates and returns an instance of QueintraStyles with the
	 * first result of a query.  If the query returns no results,
	 * returns null.
	 * @return QueintraStyles
	 */
	static function fetchSingle($queryString){
		return array_shift(QueintraStyles::fetch($queryString));
	}

	/**
	 * Populates and returns an Array of QueintraStyles Objects with the
	 * results of a query.  If the query returns no results,
	 * returns an empty Array.
	 * @return array
	 */
	static function fetch($queryString){
		$conn = QueintraStyles::getConnection();
		$result = $conn->query($queryString);
		return QueintraStyles::fromResult($result);
	}

	/**
	 * Returns an array of QueintraStyles Objects from the rows of a PDOStatement(query result)
	 * @return array
	 */
	 static function fromResult(PDOStatement $result){
		$objects = array();
		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			$object = new QueintraStyles;
			$object->fromArray($row);
			$object->resetModified();
			$object->setNew(false);
			$objects[] = $object;
		}
		return $objects;
	 }

	/**
	 * Returns an Array of all QueintraStyles Objects in the database.
	 * $extra SQL can be appended to the query to limit,sort,group results.
	 * If there are no results, returns an empty Array.
	 * @param $extra String
	 * @return array
	 */
	static function getAll($extra = null){
		$conn = QueintraStyles::getConnection();
		$tableWrapped = $conn->quoteIdentifier(QueintraStyles::getTableName());
		return QueintraStyles::fetch("SELECT * FROM $tableWrapped $extra ");
	}

	/**
	 * @return Int
	 */
	static function doCount(Query $q){
		$conn = QueintraStyles::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), QueintraStyles::getTableName())===false )
			$q->setTable(QueintraStyles::getTableName());
		return $q->doCount($conn);
	}

	/**
	 * @return Int
	 */
	static function doDelete(Query $q){
		$conn = QueintraStyles::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), QueintraStyles::getTableName())===false )
			$q->setTable(QueintraStyles::getTableName());
		return $q->doDelete($conn);
	}

	/**
	 * @return array
	 */
	static function doSelect(Query $q){
		$conn = QueintraStyles::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), QueintraStyles::getTableName())===false )
			$q->setTable(QueintraStyles::getTableName());
		return QueintraStyles::fromResult($q->doSelect($conn));
	}

}