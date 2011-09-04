<?php
/*
 * Tikapot Model Field
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the Keiouu v1.0 License.
 * See LICENSE.txt
 */

abstract class ModelField
{
	protected static $db_type = "unknown";
	protected $default_value = "";
	public $value = "", $errors = array(), $_extra = "", $hide_from_query = False;

	public function __construct($default = "", $_extra = "") {
			$this->default_value = $default;
			$this->value = $this->default_value;
			$this->_extra = $_extra;
	}

	public function get_default() {
		return $this->default_value;
	}
	
	public function reset() {
		$this->value = $this->default_value;
	}
	
	public abstract function validate();
	public abstract function db_create_query($db, $name, $table_name);
	
	/* This allows subclasses to provide end-of-statement additions such as constraints */
	public function db_post_create_query($db, $name, $table_name) {
		return "";
	}
	
	/* This allows subclasses to provide extra, separate queries on createdb such as sequences. These are put before the create table query. */
	public function db_extra_create_query_pre($db, $name, $table_name) {
		return "";
	}
	
	/* This allows subclasses to provide extra, separate queries on createdb such as sequences. These are put after the create table query. */
	public function db_extra_create_query_post($db, $name, $table_name) {
		return "";
	}
	
	/* This allows subclasses to over-write table insert if desired */
	public function db_insert_query($db) {
		return $this->value;
	}
}

?>

