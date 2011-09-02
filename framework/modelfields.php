<?php
/*
 * Tikapot Model Field
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GPL Version 3 license.
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

abstract class ModelField
{
	private static $db_type = "unknown";
	private $default_value = "";
	public $value = "";

	public function __construct($default = "") {
			$this->default_value = $default;
	}

	public function get_default() {
		return $this->default_value;
	}
	
	public function reset() {
		$this->value = $this->default_value;
	}
	
	public abstract function validate();
}

class CharField extends ModelField
{
	private static $db_type = "varchar";
	private $default_value = "", $max_length = 0;
	public $value = "";

	public function __construct($max_length = 0, $default = "") {
			$this->max_length = $max_length;
			$this->default_value = $default;
	}

	public function validate() {
		if ($this->max_length > 0 && strlen($this->value) > $this->max_length)
			return False;
		return True;
	}
}

class NumericField extends ModelField
{
	private static $db_type = "numeric";
	private $default_value = 0.0;
	public $value = 0.0; // __construct could take default

	public function validate() {
		return is_numeric($this->value);
	}
}

?>

