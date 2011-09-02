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
	protected static $db_type = "unknown";
	protected $default_value = "";
	public $value = "", $errors = array();

	public function __construct($default = "") {
			$this->default_value = $default;
			$this->value = $this->default_value;
	}

	public function get_default() {
		return $this->default_value;
	}
	
	public function reset() {
		$this->value = $this->default_value;
	}
	
	public abstract function validate();
	public abstract function db_create($db, $name);
}

?>

