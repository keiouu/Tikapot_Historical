<?php
/*
 * Tikapot Big Integer Field
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GPL Version 3 license.
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

require_once("bigintfield.php");

class PKField extends BigIntField
{
	public function db_create_query($db, $name) {
		$val = parent::db_create_query($db, $name);
		if ($db->get_type() == "mysql")
			$val .= " PRIMARY KEY";
		return $val;
	}
}

?>

