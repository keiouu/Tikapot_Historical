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
	private static $db_type = "numeric";
	private $default_value = 0.0;
	public $value = 0.0; // __construct could take default

	public function validate() {
		return is_numeric($this->value);
	}
}

?>
