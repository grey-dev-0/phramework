<?php namespace GD\Database;

use PDO;

class Connection{
	public static $driver = null;

	public function __construct(){
		self::$driver = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8', DB_USERNAME, DB_PASSWORD, [PDO::ATTR_PERSISTENT => true]);
	}

	public function disconnect(){
		self::$driver = null;
	}
}