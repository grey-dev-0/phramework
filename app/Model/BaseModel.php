<?php namespace GD\Model;

use GD\Database\Query;

class BaseModel extends Query{
	protected $table;
	protected $attributes;
	protected $primaryKey;

	public function __construct(){
		$class = get_class($this);
		$this->table = explode('\\', $class);
		$this->_class = $class;
		$this->table = lcfirst(end($this->table));
		preg_match('/[A-Z]/', $this->table, $caps);
		$replaceCount = 1;
		foreach($caps as $cap)
			$this->table = str_replace($cap, '_'.strtolower($cap), $this->table, $replaceCount);
		if(preg_match('/([^aiou]y$)|(is$)|(mouse$)/', $this->table)){
			$this->table = preg_replace('/y$/', 'ies', $this->table);
			$this->table = preg_replace('/is$/', 'es', $this->table);
			$this->table = preg_replace('/mouse$/', 'mice', $this->table);
		} else
			$this->table = $this->table.'s';
	}

	public function __set($name, $value){
		$this->attributes[$name] = $value;
		$this->$name = $value;
	}

	/**
	 * Getting the name of the table as defined in database
	 * @return String table name as defined in database
	 */
	public function getTable(){ return $this->table; }


}