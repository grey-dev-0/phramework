<?php namespace GD\Model;

use Iterator;

/**
 * Represents a collection of models
 * @package GD\Model
 * @property array $collection Collection of model objects
 */
class BaseModelCollection implements Iterator{
	private $collection = [];

	/** Model Collection construction */
	public function __construct($modelArray){ $this->collection = $modelArray; }

	/**
	 * Return the current model instance
	 * @return BaseModel the current model object.
	 */
	public function current(){ return current($this->collection); }

	/**
	 * Return the next model instance
	 */
	public function next(){ return next($this->collection); }

	/**
	 * Return the index of the current model instance
	 */
	public function key(){ return key($this->collection); }

	/**
	 * Checks if current model is valid
	 */
	public function valid(){ return (key($this->collection) !== null && key($this->collection) !== false); }

	/**
	 * Rewind the Iterator to the first model
	 */
	public function rewind(){
		reset($this->collection);
		return current($this->collection);
	}

	/**
	 * Returns an array of model objects instead of a collection object containing them.
	 * @return array Array of BaseModel objects
	 */
	public function toArray(){
		$return = [];
		foreach($this->collection as $i => $model)
			foreach($model as $property => $value)
				$return[$i][$property] = $value;
		return $return;
	}

	/**
	 * Returns a JSON string representation of the models collection
	 * @return string JSON string of the collection
	 */
	public function toJson(){
		return json_encode($this->toArray(), JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);
	}
}