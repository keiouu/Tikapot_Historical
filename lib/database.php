<?php
/*
 * Tikapot Database Class
 * v0.1
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GPL Version 3 license.
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

class Database
{
	protected $_link;
	
	public function connect() {
	}
	
	public function disconnect() {
	}
	
	function __destruct() {
		$this->disconnect();
	}
}

?>

