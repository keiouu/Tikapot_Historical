<?php
/*
 * Tikapot PostgreSQL Database Extension Class
 * v1.0
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GPL Version 3 license.
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

global $home_dir;
require_once($home_dir . "framework/database.php");

class PostgreSQL extends Database
{
	public function connect() {
		global 	$database_host,
				$database_name,
				$database_username,
				$database_password;
		$this->_link = pg_connect("host=$database_host user=$database_username password=$database_password dbname=$database_name connect_timeout=5");
		$this->_connected = isset($this->_link);
	}
	
	public function query($query) {
		if (!$this->_connected) {
			throw new NotConnectedException("Error, the database is not connected!");
		}
		return pg_query($this->_link, $query);
	}
	
	public function fetch($result) {
		if (!$this->_connected) {
			throw new NotConnectedException("Error, the database is not connected!");
		}
		return pg_fetch_array($result, NULL, PGSQL_BOTH);
	}
	
	public function disconnect() {
		if ($this->_connected) {
			$this->_connected = !pg_close($this->_link);
		}
	}
}

?>

