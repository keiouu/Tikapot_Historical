<?php
/*
 * Tikapot Cron Models
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GNU General Public License version 3.
 * See LICENSE.txt
 */
 
require_once(home_dir . "framework/model.php");
require_once(home_dir . "framework/model_fields/init.php");

class CronStore extends Model
{	
	public function __construct() {
		parent::__construct();
		$this->add_field("app_name", new CharField($max_length = 100));
		$this->add_field("last_run", new DateTimeField());
		$this->add_field("locked", new BooleanField());
	}
}

?>

