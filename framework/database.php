<?php
/*
 * Tikapot Database Class
 * v1.0
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GPL Version 3 license.
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

include_once("databases/mysql.php");
include_once("databases/postgres.php");

class NotConnectedException extends Exception { }
class QueryException extends Exception { }

abstract class Database
{
	private static $db;
	protected $_link, $_connected, $_tables;
	
	public static function create() {
		if (Database::$db)
			return Database::$db;

		global $database_type;
		switch ($database_type) {
			case "mysql":
				Database::$db = new MySQL();
				break;
			case "psql":
				Database::$db = new PostgreSQL();
				break;
		}
		if (Database::$db) {
			Database::$db->connect();
			Database::$db->populate_tables();
		}
		return Database::$db;
	}
	
	public function is_connected() { return $this->_connected; }
	public function get_link() { return $this->_link; }
	public function get_tables() { return $this->_tables; }
	
	protected abstract function connect();
	public abstract function query($query, $args=array());
	public abstract function fetch($result);
	public abstract function disconnect();
	public abstract function populate_tables();
	
	function __destruct() {
		$this->disconnect();
	}
}

?>

