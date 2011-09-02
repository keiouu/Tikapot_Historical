<?php
/*
 * Tikapot Big Integer Field
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GPL Version 3 license.
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

require_once("intfield.php");

class BigIntField extends IntField
{
	protected static $db_type = "BIGINT";
}

?>

