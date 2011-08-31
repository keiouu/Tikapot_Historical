<?php
/*
 * Tikapot Model System
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GPL Version 3 license.
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

class Model
{
	protected $fields;
	
	public function __construct() {
		$this->fields = array();
	}
	
	// Add a new field
	protected function add_field($name, $type) {
		$this->fields[$name] = $type;
	}
	
	// Get fields
	public function get_fields() { return $this->fields; }
	
	public function __get($name) {
		if (isset($this->fields[$name]))
			return $this->fields[$name]->value;
		throw new Exception("Invalid model field '$name'.");
	}
	
	public function __set($name, $value) {
		if (isset($this->fields[$name]))
			$this->fields[$name]->value = $value;
		else
			throw new Exception("Invalid model field '$name'.");
	}
	
	// Basically: Is $name a valid field name? (Doesnt say if the field has been set)
    public function __isset($name) {
    	return isset($this->fields[$name]);
    }
	
	// Unsetting a field resets it to default value
    public function __unset($name) {
    	if ($this->__isset($name))
    		$this->fields[$name]->reset();
    }
	
	// Creates the table in the database if needed
	public function create_table() {
	}
	
	// Verifys that the table structure in the database is correct
	public function verify_table() {
	}
	
	// Saves the object to the database
	public function save() {
	}
}

?>

