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

?>

