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
	public __construct() {
		$variables = get_class_vars(get_class($this));
	}
}

class CharField extends ModelField
{
	
}

class NumericField extends ModelField
{
	
}

?>

