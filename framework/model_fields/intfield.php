<?php
/*
 * Tikapot Integer Field
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GPL Version 3 license.
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

require_once("modelfield.php");

class IntField extends ModelField
{
	protected static $db_type = "INT";
	private $max_length = 0, $auto_increment = False;
	
	public function __construct($default = 0, $max_length = 0, $auto_increment = False, $_extra = "") {
			parent::__construct($default, $_extra);
			$this->max_length = $max_length;
			$this->auto_increment = $auto_increment;
	}

	public function validate() {
		if (strlen($this->value) > 0 && !is_int($this->value)) {
			array_push($this->errors, "Value is not a valid integer!");
			return False;
		}
		if ($this->max_length > 0 && strlen(strval($this->value)) > $this->max_length) {
			array_push($this->errors, "Value is longer than max_length");
			return False;
		}
		return True;
	}
	
	public function db_create_query($db, $name) {
		$extra = "";
		if (strlen($extra) > 0)
			$extra = ' ' . $extra;
		if ($db->get_type() != "psql" && $this->max_length > 0)
			$extra .= " (" . $this->max_length . ")";
		if (strlen($this->default_value) > 0)
			$extra .= " DEFAULT '" . $this->default_value . "'";
		if ($db->get_type() == "mysql" && $this->auto_increment)
			$extra .= " AUTO_INCREMENT";
		if (strlen($this->_extra) > 0)
			$extra .= ' ' . $this->_extra;
		return $name . " " . $this::$db_type . $extra;
	}
}

?>
