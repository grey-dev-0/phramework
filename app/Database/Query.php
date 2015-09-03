<?php namespace GD\Database;

use GD\Model\BaseModelCollection;
use PDO;

class Query{
	private $builder;
	private $select;
	private $from;
	private $where;
	private $orWhere;
	private $connection;
	protected $_class;

	/**
	 * Query object construction.
	 */
	public function __construct(){
		if(is_null(Connection::$driver)) new Connection();
		$this->connection = Connection::$driver;
	}

	/**
	 * Getting corresponding model name from the table name defined in database
	 * @return String model class name
	 */
	private function getBaseModelName(){
		$baseModelName = $this->from;
		if(preg_match('/(ies$)|([^i]es$)|(mice$)/', $baseModelName)){
			$baseModelName = preg_replace('/^ies$/', 'y', $baseModelName);
			$baseModelName = preg_replace('/[^i]es$/', 'is', $baseModelName);
			$baseModelName = preg_replace('/mice$/', 'mouse', $baseModelName);
		} else
			$baseModelName = substr($this->from, 0, strlen($this->from)-1);
		$baseModelName = explode('_', $baseModelName);
		foreach($baseModelName as &$segment)
			$segment = ucfirst($segment);
		$baseModelName = implode('', $baseModelName);
		return $baseModelName;
	}

	/**
	 * Set columns to be selected
	 * @param $columns String list of columns to be loaded
	 * @return Query current instance of the Query class
	 */
	public function select($columns){
		$args = func_get_args();
		$this->select = implode(', ', $args);
		return $this;
	}

	/**
	 * Set basic table from which data is fetched
	 * @param $tableName String the name of the basic table in the FROM clause
	 * @return Query current instance of the Query class
	 */
	public function from($tableName){
		$this->from = $tableName;
		return $this;
	}

	public function fetch(){
		$this->builder = 'SELECT '.$this->select.' FROM '.$this->from;
		$result = $this->connection->query($this->builder)->fetchAll(PDO::FETCH_CLASS, 'GD\Model\\'.((is_null($this->_class))? $this->getBaseModelName() : $this->getBaseModelName()));
		return new BaseModelCollection($result);
	}
}