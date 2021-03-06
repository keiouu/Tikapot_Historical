<?php
/*
 * Tikapot Example App Models
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GNU General Public License version 3.
 * See LICENSE.txt
 */
 
require_once(home_dir . "framework/model.php");
require_once(home_dir . "framework/model_fields/init.php");

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

