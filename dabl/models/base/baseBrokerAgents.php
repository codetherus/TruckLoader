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

abstract class baseBrokerAgents extends BaseModel{

	/**
	 * Name of the table
	 */
	protected static $_tableName = "broker_agents";

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
		'brokerid',
		'agent_name',
		'agent_phone',
		'agent_fax',
		'agent_email'
	);
	protected $id;
	protected $brokerid;
	protected $agent_name;
	protected $agent_phone;
	protected $agent_fax;
	protected $agent_email;

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

	function getBrokerid(){
		return $this->brokerid;
	}
	function setBrokerid($theValue){
		if($theValue==="")
			$theValue = null;
		if($theValue!==null)
			$theValue = (int)$theValue;
		if($this->brokerid !== $theValue){
			$this->_modifiedColumns[] = "brokerid";
			$this->brokerid = $theValue;
		}
	}

	function getAgent_name(){
		return $this->agent_name;
	}
	function setAgent_name($theValue){
		if($this->agent_name !== $theValue){
			$this->_modifiedColumns[] = "agent_name";
			$this->agent_name = $theValue;
		}
	}

	function getAgent_phone(){
		return $this->agent_phone;
	}
	function setAgent_phone($theValue){
		if($this->agent_phone !== $theValue){
			$this->_modifiedColumns[] = "agent_phone";
			$this->agent_phone = $theValue;
		}
	}

	function getAgent_fax(){
		return $this->agent_fax;
	}
	function setAgent_fax($theValue){
		if($this->agent_fax !== $theValue){
			$this->_modifiedColumns[] = "agent_fax";
			$this->agent_fax = $theValue;
		}
	}

	function getAgent_email(){
		return $this->agent_email;
	}
	function setAgent_email($theValue){
		if($this->agent_email !== $theValue){
			$this->_modifiedColumns[] = "agent_email";
			$this->agent_email = $theValue;
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
		return BrokerAgents::$_tableName;
	}

	/**
	 * Access to array of column names
	 * @return array
	 */
	static function getColumnNames(){
		return BrokerAgents::$_columnNames;
	}

	/**
	 * @return bool
	 */
	static function hasColumn($columnName){
		return in_array(strtolower($columnName), array_map('strtolower', BrokerAgents::getColumnNames()));
	}

	/**
	 * Access to array of primary keys
	 * @return array
	 */
	static function getPrimaryKeys(){
		return BrokerAgents::$_primaryKeys;
	}

	/**
	 * Access to name of primary key
	 * @return array
	 */
	static function getPrimaryKey(){
		return BrokerAgents::$_primaryKey;
	}

	/**
	 * Searches the database for a row with the ID(primary key) that matches
	 * the one input.
	 * @return BrokerAgents
	 */
	static function retrieveByPK( $thePK ){
		if($thePK===null)return null;
		$PKs = BrokerAgents::getPrimaryKeys();
		if(count($PKs)>1)
			throw new Exception("This table has more than one primary key.  Use retrieveByPKs() instead.");
		elseif(count($PKs)==0)
			throw new Exception("This table does not have a primary key.");
		$q = new Query;
		$conn = BrokerAgents::getConnection();
		$pkColumn = $conn->quoteIdentifier($PKs[0]);
		$q->add($pkColumn, $thePK);
		$q->setLimit(1);
		return array_shift(BrokerAgents::doSelect($q));
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return BrokerAgents
	 */
	static function retrieveByPKs( $PK0 ){
		$conn = BrokerAgents::getConnection();
		$tableWrapped = $conn->quoteIdentifier(BrokerAgents::getTableName());
		if($PK0===null)return null;
		$queryString = "SELECT * FROM $tableWrapped WHERE ".$conn->quoteIdentifier('id')."=".$conn->checkInput($PK0)."";
		$conn->applyLimit($queryString, 0, 1);
		return BrokerAgents::fetchSingle($queryString);
	}

	/**
	 * Populates and returns an instance of BrokerAgents with the
	 * first result of a query.  If the query returns no results,
	 * returns null.
	 * @return BrokerAgents
	 */
	static function fetchSingle($queryString){
		return array_shift(BrokerAgents::fetch($queryString));
	}

	/**
	 * Populates and returns an Array of BrokerAgents Objects with the
	 * results of a query.  If the query returns no results,
	 * returns an empty Array.
	 * @return array
	 */
	static function fetch($queryString){
		$conn = BrokerAgents::getConnection();
		$result = $conn->query($queryString);
		return BrokerAgents::fromResult($result);
	}

	/**
	 * Returns an array of BrokerAgents Objects from the rows of a PDOStatement(query result)
	 * @return array
	 */
	 static function fromResult(PDOStatement $result){
		$objects = array();
		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			$object = new BrokerAgents;
			$object->fromArray($row);
			$object->resetModified();
			$object->setNew(false);
			$objects[] = $object;
		}
		return $objects;
	 }

	/**
	 * Returns an Array of all BrokerAgents Objects in the database.
	 * $extra SQL can be appended to the query to limit,sort,group results.
	 * If there are no results, returns an empty Array.
	 * @param $extra String
	 * @return array
	 */
	static function getAll($extra = null){
		$conn = BrokerAgents::getConnection();
		$tableWrapped = $conn->quoteIdentifier(BrokerAgents::getTableName());
		return BrokerAgents::fetch("SELECT * FROM $tableWrapped $extra ");
	}

	/**
	 * @return Int
	 */
	static function doCount(Query $q){
		$conn = BrokerAgents::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), BrokerAgents::getTableName())===false )
			$q->setTable(BrokerAgents::getTableName());
		return $q->doCount($conn);
	}

	/**
	 * @return Int
	 */
	static function doDelete(Query $q){
		$conn = BrokerAgents::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), BrokerAgents::getTableName())===false )
			$q->setTable(BrokerAgents::getTableName());
		return $q->doDelete($conn);
	}

	/**
	 * @return array
	 */
	static function doSelect(Query $q){
		$conn = BrokerAgents::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), BrokerAgents::getTableName())===false )
			$q->setTable(BrokerAgents::getTableName());
		return BrokerAgents::fromResult($q->doSelect($conn));
	}

}