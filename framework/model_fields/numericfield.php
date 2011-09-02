<?php
/*
 * Tikapot Numeric Field
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GPL Version 3 license.
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

require_once("modelfield.php");

class NumericField extends ModelField
{
	protected static $db_type = "NUMERIC";
	private $precision = 0;
	
	public function __construct($default = "", $precision = "", $_extra = "") {
			parent::__construct($default, $_extra);
			$this->precision = $precision;
	}

	public function validate() {
		if (strlen($this->precision) > 0) {
			$parts = split(',', $this->precision);
			if (count($parts) < 2 || !preg_match('/^\d+$/', $parts[0]) || !preg_match('/^\d+$/', $parts[1])) {
				array_push($this->errors, "Precision must be valid: n,n");
				return False;
			}
		}
		if (strlen($this->value) > 0 && !is_numeric($this->value)) {
			array_push($this->errors, "Value is not numeric!");
			return False;
		}
		return True;
	}
	
	public function db_create_query($db, $name, $table_name) {
		$extra = "";
		if (strlen($extra) > 0)
			$extra = ' ' . $extra;
		if ($this->precision !== "")
			$extra .= " (" . $this->precision . ")";
		if (strlen($this->default_value) > 0)
			$extra .= " DEFAULT '" . $this->default_value . "'";
		if (strlen($this->_extra) > 0)
			$extra .= ' ' . $this->_extra;
		return $name . " " . $this::$db_type . $extra;
	}
}

?>
