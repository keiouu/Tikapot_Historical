<?php
/*
 * Tikapot Example Models
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GPL Version 3 license.
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

require("../../lib/model.php");
require("../../lib/modelfields.php");

class ExampleModel extends Model
{
	private $_first_name = new CharField();
	private $_last_name = new CharField();
	private $_age = new NumericField();
}

?>

