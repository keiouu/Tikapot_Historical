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
		return True; // TODO
	}
}

?>

