<?php
/*
 * Tikapot Example Models
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the Keiouu v1.0 License.
 * See LICENSE.txt
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

