<?php
/*
 * Tikapot Example Models
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GPL Version 3 license.
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
 
global $home_dir;
require($home_dir . "framework/model.php");
require($home_dir . "framework/modelfields.php");

class ExampleModel extends Model
{	
	public function __construct() {
		parent::__construct();
		$this->add_field("first_name", new CharField());
		$this->add_field("last_name", new CharField());
		$this->add_field("age", new NumericField());
	}
}

?>

