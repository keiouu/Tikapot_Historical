<?php
/*
 * Tikapot Session Class
 * v1.0
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GPL Version 3 license.
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

class Session
{
	public $id;

	function __construct() {
		session_start();
		$this->id = session_id();
	}
}

?>

