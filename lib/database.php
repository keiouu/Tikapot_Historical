<?php
/*
 * Tikapot Database Class
 * v1.0
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GPL Version 3 license.
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

require_once("databases/mysql.php");
require_once("databases/postgres.php");

class NotConnectedException extends Exception { }

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
	
	public abstract function connect();
	public abstract function query($query);
	public abstract function fetch($result);
	public abstract function disconnect();
	
	function __destruct() {
		$this->disconnect();
	}
}

?>

