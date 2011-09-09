<?php
/*
 * Tikapot Boolean Field
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GNU General Public License version 3.
 * See LICENSE.txt
 */

require_once("modelfield.php");

class BooleanField extends ModelField
{
	protected static $db_type = "boolean";

	public function validate() {
		return strlen($this->value) > 0 && is_bool($this->value);
	}
}

?>

