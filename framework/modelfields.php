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
	public $value, $default_value;
	
	public function reset() {
		$this->value = $this->default_value;
	}
}

class CharField extends ModelField
{
	private static $db_type = "varchar";
	public $value = "", $default_value = "";
}

class NumericField extends ModelField
{
	private static $db_type = "numeric";
	public $value = 0.0, $default_value = 0.0; // __construct could take default
}

?>

