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

abstract class basePdfStore extends BaseModel{

	/**
	 * Name of the table
	 */
	protected static $_tableName = "pdf_store";

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
		'title',
		'image'
	);
	protected $id;
	protected $title;
	protected $image;

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

	function getTitle(){
		return $this->title;
	}
	function setTitle($theValue){
		if($this->title !== $theValue){
			$this->_modifiedColumns[] = "title";
			$this->title = $theValue;
		}
	}

	function getImage(){
		return $this->image;
	}
	function setImage($theValue){
		if($this->image !== $theValue){
			$this->_modifiedColumns[] = "image";
			$this->image = $theValue;
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
		return PdfStore::$_tableName;
	}

	/**
	 * Access to array of column names
	 * @return array
	 */
	static function getColumnNames(){
		return PdfStore::$_columnNames;
	}

	/**
	 * @return bool
	 */
	static function hasColumn($columnName){
		return in_array(strtolower($columnName), array_map('strtolower', PdfStore::getColumnNames()));
	}

	/**
	 * Access to array of primary keys
	 * @return array
	 */
	static function getPrimaryKeys(){
		return PdfStore::$_primaryKeys;
	}

	/**
	 * Access to name of primary key
	 * @return array
	 */
	static function getPrimaryKey(){
		return PdfStore::$_primaryKey;
	}

	/**
	 * Searches the database for a row with the ID(primary key) that matches
	 * the one input.
	 * @return PdfStore
	 */
	static function retrieveByPK( $thePK ){
		if($thePK===null)return null;
		$PKs = PdfStore::getPrimaryKeys();
		if(count($PKs)>1)
			throw new Exception("This table has more than one primary key.  Use retrieveByPKs() instead.");
		elseif(count($PKs)==0)
			throw new Exception("This table does not have a primary key.");
		$q = new Query;
		$conn = PdfStore::getConnection();
		$pkColumn = $conn->quoteIdentifier($PKs[0]);
		$q->add($pkColumn, $thePK);
		$q->setLimit(1);
		return array_shift(PdfStore::doSelect($q));
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return PdfStore
	 */
	static function retrieveByPKs( $PK0 ){
		$conn = PdfStore::getConnection();
		$tableWrapped = $conn->quoteIdentifier(PdfStore::getTableName());
		if($PK0===null)return null;
		$queryString = "SELECT * FROM $tableWrapped WHERE ".$conn->quoteIdentifier('id')."=".$conn->checkInput($PK0)."";
		$conn->applyLimit($queryString, 0, 1);
		return PdfStore::fetchSingle($queryString);
	}

	/**
	 * Populates and returns an instance of PdfStore with the
	 * first result of a query.  If the query returns no results,
	 * returns null.
	 * @return PdfStore
	 */
	static function fetchSingle($queryString){
		return array_shift(PdfStore::fetch($queryString));
	}

	/**
	 * Populates and returns an Array of PdfStore Objects with the
	 * results of a query.  If the query returns no results,
	 * returns an empty Array.
	 * @return array
	 */
	static function fetch($queryString){
		$conn = PdfStore::getConnection();
		$result = $conn->query($queryString);
		return PdfStore::fromResult($result);
	}

	/**
	 * Returns an array of PdfStore Objects from the rows of a PDOStatement(query result)
	 * @return array
	 */
	 static function fromResult(PDOStatement $result){
		$objects = array();
		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			$object = new PdfStore;
			$object->fromArray($row);
			$object->resetModified();
			$object->setNew(false);
			$objects[] = $object;
		}
		return $objects;
	 }

	/**
	 * Returns an Array of all PdfStore Objects in the database.
	 * $extra SQL can be appended to the query to limit,sort,group results.
	 * If there are no results, returns an empty Array.
	 * @param $extra String
	 * @return array
	 */
	static function getAll($extra = null){
		$conn = PdfStore::getConnection();
		$tableWrapped = $conn->quoteIdentifier(PdfStore::getTableName());
		return PdfStore::fetch("SELECT * FROM $tableWrapped $extra ");
	}

	/**
	 * @return Int
	 */
	static function doCount(Query $q){
		$conn = PdfStore::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), PdfStore::getTableName())===false )
			$q->setTable(PdfStore::getTableName());
		return $q->doCount($conn);
	}

	/**
	 * @return Int
	 */
	static function doDelete(Query $q){
		$conn = PdfStore::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), PdfStore::getTableName())===false )
			$q->setTable(PdfStore::getTableName());
		return $q->doDelete($conn);
	}

	/**
	 * @return array
	 */
	static function doSelect(Query $q){
		$conn = PdfStore::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), PdfStore::getTableName())===false )
			$q->setTable(PdfStore::getTableName());
		return PdfStore::fromResult($q->doSelect($conn));
	}

}