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
	protected static $db_type = "numeric";
	private $precision = 0;
	
	public function __construct($default = "", $precision = "") {
			parent::__construct($default);
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
		if (!is_numeric($this->value)) {
			array_push($this->errors, "Value is not numeric!");
			return False;
		}
		return True;
	}
	
	public function db_create($db, $name) {
		$extra = "";
		if ($this->precision !== "")
			$extra .= " (" . $this->precision . ")";
		if ($this->default_value !== "")
			$extra .= " DEFAULT '" . $this->default_value . "'";
		return $name . " NUMERIC" . $extra;
	}
}

?>
