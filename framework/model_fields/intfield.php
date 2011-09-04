<?php
/*
 * Tikapot Integer Field
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GNU General Public License version 3.
 * See LICENSE.txt
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
			$this->hide_from_query = $auto_increment;
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
	
	protected function sequence_name($db, $name, $table_name) {
		return $table_name."_".$name."_seq";
	}
	
	public function db_create_query($db, $name, $table_name) {
		$extra = "";
		if (strlen($extra) > 0)
			$extra = ' ' . $extra;
		if ($db->get_type() != "psql" && $this->max_length > 0)
			$extra .= " (" . $this->max_length . ")";
		if (!$this->auto_increment && strlen($this->default_value) > 0)
			$extra .= " DEFAULT '" . $this->default_value . "'";
		if ($this->auto_increment) {
			if ($db->get_type() == "mysql")
				$extra .= " AUTO_INCREMENT";
			if ($db->get_type() == "psql")
				$extra .= " DEFAULT nextval('".$this->sequence_name($db, $name, $table_name)."')";
		}
		if (strlen($this->_extra) > 0)
			$extra .= ' ' . $this->_extra;
		return $name . " " . $this::$db_type . $extra;
	}
	
	public function db_extra_create_query_pre($db, $name, $table_name) {
		if ($db->get_type() == "psql" && $this->auto_increment)
			return "CREATE SEQUENCE ".$this->sequence_name($db, $name, $table_name).";";
		return "";
	}
}

?>
