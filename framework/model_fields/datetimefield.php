<?php
/*
 * Tikapot DateTime Field
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GNU General Public License version 3.
 * See LICENSE.txt
 */

require_once("modelfield.php");
require_once("datefield.php");

class DateTimeField extends DateField
{
	protected static $db_type = "timestamp";
	
	public function validate() {
		$regex = "[0-9]{1,4}-[0-9]{1,2}-[0-9]{1,2} [0-9]{1,2}:[0-9]{1,2}:[0-9]{1,2}"; // Very basic regex
		$valid = preg_match($regex, $this->value);
		if (!$valid)
			throw new FieldValidationException("Error: Date is not in the format: YYYY-MM-DD HH:MM:SS");
		return True;
	}
}

?>

