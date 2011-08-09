<?php
/*
 * Tikapot Database Class
 * v0.1
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GPL Version 3 license.
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

abstract class Database
{
	protected $_link;
	
	public abstract function connect();
	public abstract function query();
	public abstract function disconnect();
	
	function __destruct() {
		$this->disconnect();
	}
}

?>

