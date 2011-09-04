<?php
/*
 * Tikapot Model System
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GPL Version 3 license.
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

global $home_dir;
require_once($home_dir . "framework/database.php");

class ModelQueryException extends Exception { }

class ModelQuery
{
	public function __construct($table, $query) {
	}
	
	/* Returns the number of objects in this query */
	public function count() {
		return 0;
	}
	
	/* Returns the nth object in this query */
	public function get($n) {
	}
	
	/* Returns all objects in this query optionally starting at the nth element */
	public function all($n = 0) {
	}
}

?>

