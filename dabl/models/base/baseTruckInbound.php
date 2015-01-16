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

abstract class baseTruckInbound extends BaseModel{

	/**
	 * Name of the table
	 */
	protected static $_tableName = "truck_inbound";

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
		'agent',
		'unit',
		'truck_number',
		'equipment',
		'driver',
		'cell',
		'origin_city',
		'origin_state',
		'dest_city',
		'dest_state',
		'delivery_month',
		'delivery_day',
		'delivery_date',
		'comments',
		'report_date',
		'telephone'
	);
	protected $id;
	protected $agent;
	protected $unit;
	protected $truck_number;
	protected $equipment;
	protected $driver;
	protected $cell;
	protected $origin_city;
	protected $origin_state;
	protected $dest_city;
	protected $dest_state;
	protected $delivery_month;
	protected $delivery_day;
	protected $delivery_date;
	protected $comments;
	protected $report_date;
	protected $telephone;

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

	function getAgent(){
		return $this->agent;
	}
	function setAgent($theValue){
		if($theValue===null){
			$theValue = "";
		}
		if($this->agent !== $theValue){
			$this->_modifiedColumns[] = "agent";
			$this->agent = $theValue;
		}
	}

	function getUnit(){
		return $this->unit;
	}
	function setUnit($theValue){
		if($theValue===null){
			$theValue = "";
		}
		if($this->unit !== $theValue){
			$this->_modifiedColumns[] = "unit";
			$this->unit = $theValue;
		}
	}

	function getTruck_number(){
		return $this->truck_number;
	}
	function setTruck_number($theValue){
		if($theValue===null){
			$theValue = "";
		}
		if($this->truck_number !== $theValue){
			$this->_modifiedColumns[] = "truck_number";
			$this->truck_number = $theValue;
		}
	}

	function getEquipment(){
		return $this->equipment;
	}
	function setEquipment($theValue){
		if($theValue===null){
			$theValue = "";
		}
		if($this->equipment !== $theValue){
			$this->_modifiedColumns[] = "equipment";
			$this->equipment = $theValue;
		}
	}

	function getDriver(){
		return $this->driver;
	}
	function setDriver($theValue){
		if($theValue===null){
			$theValue = "";
		}
		if($this->driver !== $theValue){
			$this->_modifiedColumns[] = "driver";
			$this->driver = $theValue;
		}
	}

	function getCell(){
		return $this->cell;
	}
	function setCell($theValue){
		if($theValue===null){
			$theValue = "";
		}
		if($this->cell !== $theValue){
			$this->_modifiedColumns[] = "cell";
			$this->cell = $theValue;
		}
	}

	function getOrigin_city(){
		return $this->origin_city;
	}
	function setOrigin_city($theValue){
		if($theValue===null){
			$theValue = "";
		}
		if($this->origin_city !== $theValue){
			$this->_modifiedColumns[] = "origin_city";
			$this->origin_city = $theValue;
		}
	}

	function getOrigin_state(){
		return $this->origin_state;
	}
	function setOrigin_state($theValue){
		if($theValue===null){
			$theValue = "";
		}
		if($this->origin_state !== $theValue){
			$this->_modifiedColumns[] = "origin_state";
			$this->origin_state = $theValue;
		}
	}

	function getDest_city(){
		return $this->dest_city;
	}
	function setDest_city($theValue){
		if($theValue===null){
			$theValue = "";
		}
		if($this->dest_city !== $theValue){
			$this->_modifiedColumns[] = "dest_city";
			$this->dest_city = $theValue;
		}
	}

	function getDest_state(){
		return $this->dest_state;
	}
	function setDest_state($theValue){
		if($theValue===null){
			$theValue = "";
		}
		if($this->dest_state !== $theValue){
			$this->_modifiedColumns[] = "dest_state";
			$this->dest_state = $theValue;
		}
	}

	function getDelivery_month(){
		return $this->delivery_month;
	}
	function setDelivery_month($theValue){
		if($theValue===null){
			$theValue = "";
		}
		if($this->delivery_month !== $theValue){
			$this->_modifiedColumns[] = "delivery_month";
			$this->delivery_month = $theValue;
		}
	}

	function getDelivery_day(){
		return $this->delivery_day;
	}
	function setDelivery_day($theValue){
		if($theValue===null){
			$theValue = "";
		}
		if($this->delivery_day !== $theValue){
			$this->_modifiedColumns[] = "delivery_day";
			$this->delivery_day = $theValue;
		}
	}

	function getDelivery_date(){
		return $this->delivery_date;
	}
	function setDelivery_date($theValue){
		if($theValue===null){
			$theValue = "";
		}
		if($this->delivery_date !== $theValue){
			$this->_modifiedColumns[] = "delivery_date";
			$this->delivery_date = $theValue;
		}
	}

	function getComments(){
		return $this->comments;
	}
	function setComments($theValue){
		if($theValue===null){
			$theValue = "";
		}
		if($this->comments !== $theValue){
			$this->_modifiedColumns[] = "comments";
			$this->comments = $theValue;
		}
	}

	function getReport_date(){
		return $this->report_date;
	}
	function setReport_date($theValue){
		if($theValue===null){
			$theValue = "";
		}
		if($this->report_date !== $theValue){
			$this->_modifiedColumns[] = "report_date";
			$this->report_date = $theValue;
		}
	}

	function getTelephone(){
		return $this->telephone;
	}
	function setTelephone($theValue){
		if($this->telephone !== $theValue){
			$this->_modifiedColumns[] = "telephone";
			$this->telephone = $theValue;
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
		return TruckInbound::$_tableName;
	}

	/**
	 * Access to array of column names
	 * @return array
	 */
	static function getColumnNames(){
		return TruckInbound::$_columnNames;
	}

	/**
	 * @return bool
	 */
	static function hasColumn($columnName){
		return in_array(strtolower($columnName), array_map('strtolower', TruckInbound::getColumnNames()));
	}

	/**
	 * Access to array of primary keys
	 * @return array
	 */
	static function getPrimaryKeys(){
		return TruckInbound::$_primaryKeys;
	}

	/**
	 * Access to name of primary key
	 * @return array
	 */
	static function getPrimaryKey(){
		return TruckInbound::$_primaryKey;
	}

	/**
	 * Searches the database for a row with the ID(primary key) that matches
	 * the one input.
	 * @return TruckInbound
	 */
	static function retrieveByPK( $thePK ){
		if($thePK===null)return null;
		$PKs = TruckInbound::getPrimaryKeys();
		if(count($PKs)>1)
			throw new Exception("This table has more than one primary key.  Use retrieveByPKs() instead.");
		elseif(count($PKs)==0)
			throw new Exception("This table does not have a primary key.");
		$q = new Query;
		$conn = TruckInbound::getConnection();
		$pkColumn = $conn->quoteIdentifier($PKs[0]);
		$q->add($pkColumn, $thePK);
		$q->setLimit(1);
		return array_shift(TruckInbound::doSelect($q));
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return TruckInbound
	 */
	static function retrieveByPKs( $PK0 ){
		$conn = TruckInbound::getConnection();
		$tableWrapped = $conn->quoteIdentifier(TruckInbound::getTableName());
		if($PK0===null)return null;
		$queryString = "SELECT * FROM $tableWrapped WHERE ".$conn->quoteIdentifier('id')."=".$conn->checkInput($PK0)."";
		$conn->applyLimit($queryString, 0, 1);
		return TruckInbound::fetchSingle($queryString);
	}

	/**
	 * Populates and returns an instance of TruckInbound with the
	 * first result of a query.  If the query returns no results,
	 * returns null.
	 * @return TruckInbound
	 */
	static function fetchSingle($queryString){
		return array_shift(TruckInbound::fetch($queryString));
	}

	/**
	 * Populates and returns an Array of TruckInbound Objects with the
	 * results of a query.  If the query returns no results,
	 * returns an empty Array.
	 * @return array
	 */
	static function fetch($queryString){
		$conn = TruckInbound::getConnection();
		$result = $conn->query($queryString);
		return TruckInbound::fromResult($result);
	}

	/**
	 * Returns an array of TruckInbound Objects from the rows of a PDOStatement(query result)
	 * @return array
	 */
	 static function fromResult(PDOStatement $result){
		$objects = array();
		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			$object = new TruckInbound;
			$object->fromArray($row);
			$object->resetModified();
			$object->setNew(false);
			$objects[] = $object;
		}
		return $objects;
	 }

	/**
	 * Returns an Array of all TruckInbound Objects in the database.
	 * $extra SQL can be appended to the query to limit,sort,group results.
	 * If there are no results, returns an empty Array.
	 * @param $extra String
	 * @return array
	 */
	static function getAll($extra = null){
		$conn = TruckInbound::getConnection();
		$tableWrapped = $conn->quoteIdentifier(TruckInbound::getTableName());
		return TruckInbound::fetch("SELECT * FROM $tableWrapped $extra ");
	}

	/**
	 * @return Int
	 */
	static function doCount(Query $q){
		$conn = TruckInbound::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), TruckInbound::getTableName())===false )
			$q->setTable(TruckInbound::getTableName());
		return $q->doCount($conn);
	}

	/**
	 * @return Int
	 */
	static function doDelete(Query $q){
		$conn = TruckInbound::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), TruckInbound::getTableName())===false )
			$q->setTable(TruckInbound::getTableName());
		return $q->doDelete($conn);
	}

	/**
	 * @return array
	 */
	static function doSelect(Query $q){
		$conn = TruckInbound::getConnection();
		$q = clone $q;
		if(!$q->getTable() || strrpos($q->getTable(), TruckInbound::getTableName())===false )
			$q->setTable(TruckInbound::getTableName());
		return TruckInbound::fromResult($q->doSelect($conn));
	}

}