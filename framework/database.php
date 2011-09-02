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
	protected $_link, $_connected;
	
	public static function create() {
		global $database_type;
		$db = NULL;
		switch ($database_type) {
			case "mysql":
				$db = new MySQL();
				break;
			case "psql":
				$db = new PostgreSQL();
				break;
		}
		if ($db) {
			$db->connect();
		}
		return $db;
	}
	
	public function is_connected() { return $this->_connected; }
	public function get_link() { return $this->_link; }
	
	protected abstract function connect();
	public abstract function query($query, $args=array());
	public abstract function fetch($result);
	public abstract function disconnect();
	
	function __destruct() {
		$this->disconnect();
	}
}

?>

