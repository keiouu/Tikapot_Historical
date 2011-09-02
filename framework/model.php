<?php
/*
 * Tikapot Model System
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GPL Version 3 license.
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

require_once("model_fields/init.php");

class Model
{
	protected $fields = array(), $errors = array();
	
	// Add a new field
	protected function add_field($name, $type) {
		$this->fields[$name] = $type;
	}
	
	// Get fields
	public function get_fields() {
		return $this->fields;
	}
	
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
		// TODO
	}
	
	// Verifies that the table structure in the database is up-to-date
	public function verify_table() {
		// TODO
	}
	
	// Validates the model
	public function validate() {
		$this->errors = array();
		foreach ($this->get_fields() as $field_name => $field) {
			if (!$field->validate()) {
				$this->errors = array_merge($this->errors, $field->errors);
				return False;
			}
		}
		return True;
	}

	// Provides validation errors
	public function get_errors() {
		return $this->errors;
	}
	
	// Saves the object to the database
	public function save() {
		// TODO
	}
}

?>

