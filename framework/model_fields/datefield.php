<?php
/*
 * Tikapot Date Field
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GNU General Public License version 3.
 * See LICENSE.txt
 */

require_once("modelfield.php");

class DateField extends ModelField
{
	protected static $db_type = "date";
	private $auto_now_add = False, $auto_now = False;
	
	public function __construct($default = "", $auto_now_add = False, $auto_now = False, $_extra = "") {
			parent::__construct($default, $_extra);
			$this->auto_now_add = $auto_now_add;
			$this->auto_now = $auto_now;
	}
	
	public function validate() {
		$regex = "[0-9]{1,4}-[0-9]{1,2}-[0-9]{1,2}"; // Very basic regex
		$valid = preg_match($regex, $this->value);
		if (!$valid)
			throw new FieldValidationException("Error: Date is not in the format: YYYY-MM-DD");
		return True;
	}
}

?>

