<?php
/*
 * Tikapot Auth Module
 * 
 * This file contains models that are essential for
 * the correct operation of tikapot core modules
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GNU General Public License version 3.
 * See LICENSE.txt
 */

global $home_dir;
require_once($home_dir . "framework/model.php");
require_once($home_dir . "framework/model_fields/init.php");

class User extends Model
{	
	public function __construct() {
		parent::__construct();
		$this->add_field("username", new CharField($max_length=20));
		$this->add_field("password", new DateTimeField());
		$this->add_field("email", new DateTimeField());
		$this->add_field("created", new BooleanField());
		$this->add_field("last_login", new BooleanField());
	}
}


?>

