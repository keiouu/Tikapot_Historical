<?php
/*
 * Tikapot Boolean Field
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GNU General Public License version 3.
 * See LICENSE.txt
 */

require_once("modelfield.php");

class BooleanField extends ModelField
{
	protected static $db_type = "boolean";
	
	public function __construct($default = "False") {
		parent::__construct($default);
	}
	
	public function sql_value($db, $val = NULL) {
		$val = ($val == NULL) ? $this->value : $val;
		return ($val) ? "" . $val : "False";
	}

	public function validate() {
		if (strtolower($this->value) != "true" && strtolower($this->value) != "false" && $this->value != "1" && $this->value != "0") {
			array_push($this->errors, "Value is not a valid boolean: " . $this->value);
			return False;
		}
		if (strlen($this->value) <= 0) {
			array_push($this->errors, "Value is not a valid boolean: " . $this->value);
			return False;
		}
		return True;
	}
}

?>

