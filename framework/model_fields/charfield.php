<?php
/*
 * Tikapot Char Field
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GPL Version 3 license.
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

require_once("modelfield.php");

class CharField extends ModelField
{
	private static $db_type = "varchar";
	private $default_value = "", $max_length = 0;
	public $value = "";

	public function __construct($default = "", $max_length = 0) {
			$this->default_value = $default;
			$this->max_length = $max_length;
	}

	public function validate() {
		if ($this->max_length > 0 && strlen($this->value) > $this->max_length) {
			array_push($this->errors, "Value is longer than max_length");
			return False;
		}
		return True;
	}
}

?>
