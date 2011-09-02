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
	protected function connect() {
		global 	$database_host,
				$database_name,
				$database_username,
				$database_password;
		$this->_link = pg_connect("host=$database_host user=$database_username password=$database_password dbname=$database_name connect_timeout=5");
		$this->_connected = isset($this->_link);
		if (!$this->_connected)
			throw new NotConnectedException("Error: Could not connect to the database server.");
	}
	
	private function throw_query_exception($e) {
		throw new QueryException($e);
	}
	
	public function query($query, $args=array()) {
		if (!$this->_connected) {
			throw new NotConnectedException("Error: the database is not connected!");
		}
		return pg_query_params($this->_link, $query, $args) or $this->throw_query_exception("Error in query: " + $query);
	}
	
	public function fetch($result) {
		if (!$this->_connected) {
			throw new NotConnectedException("Error: the database is not connected!");
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

