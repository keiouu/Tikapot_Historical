<?php
/*
 * Tikapot MySQL Database Extension Class
 * v1.0
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GPL Version 3 license.
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

require_once("../database.php");

class MySQL extends Database
{
	public function connect() {
		global 	$database_host,
				$database_name,
				$database_username,
				$database_password;
		$this->_link = mysql_connect($database_host, $database_username, $database_password, true);
		$this->_connected = mysql_select_db($database_name, $this->_link);
	}
	
	public function query($query) {
		if (!$this->_connected) {
			throw new NotConnectedException("Error, the database is not connected!");
		}
		return mysql_query($query, $this->_link);
	}
	
	public function fetch($result) {
		if (!$this->_connected) {
			throw new NotConnectedException("Error, the database is not connected!");
		}
		return mysql_fetch_array($result, MYSQL_BOTH);
	}
	
	public function disconnect() {
		if ($this->_connected) {
			$this->_connected = !mysql_close($this->_link);
		}
	}
}

?>

