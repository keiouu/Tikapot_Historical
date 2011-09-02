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
	protected static $db_type = "varchar";
	private $max_length = 0;
	
	public function __construct($default = "", $max_length = 0) {
			parent::__construct($default);
			$this->max_length = $max_length;
	}
	
	public function db_create_query($db, $name) {
		$extra = "";
		if ($this->max_length > 0)
			$extra .= " (" . $this->max_length . ")";
		if ($this->default_value !== "")
			$extra .= " DEFAULT '" . $this->default_value . "'";
		return $name . " VARCHAR" . $extra;
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
