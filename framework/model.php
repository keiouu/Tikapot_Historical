<?php
/*
 * Tikapot Model System
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GPL Version 3 license.
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

global $home_dir;
require_once($home_dir . "framework/database.php");
require_once("model_fields/init.php");

abstract class Model
{
	private $from_db = False;
	protected $fields = array(), $errors = array(), $table_name = "";
	
	public function __construct() {
		$this->table_name = $this->get_table_name();
		$this->add_field("id", new PKField(0, $max_length=22, True));
	}
	
	// Add a new field
	protected function add_field($name, $type) {
		$this->fields[$name] = $type;
	}
	
	public function get_table_name() {
		if ($this->table_name === "")
			$this->table_name = strtolower(get_class($this));
		return $this->table_name;
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
	
	// Returns the query to create the table in the database
	public function db_create_query($db) {
		$table_name = $this->get_table_name();
		$SQL = "CREATE TABLE " . $table_name . " (";
		$i = 0;
		foreach ($this->get_fields() as $name => $field) {
			if ($i > 0) $SQL .= ", ";
			$SQL .= $field->db_create_query($db, $name);
			$i++;
		}
		$SQL .= ");";
		return $SQL;
	}
	
	// Creates the table in the database if needed
	// Returns True on success, even if it didnt have to do anything
	public function create_table() {
		$db = Database::create();
		if (!in_array($this->get_table_name(), $db->get_tables()))
			return $db->query($this->db_create_query($db));
		return True;
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
	
	// Insert the object to the database
	public function insert_query($db) {
		$keys = "";
		$values = "";
		foreach ($this->get_fields() as $field_name => $field) {
			if (strlen($keys) > 0) {
				$keys .= ", ";
				$values .= ", ";
			}
			$keys .= $field_name;
			$val = $field->db_insert_query($db);
			if (strlen($val) <= 0)
				$val = "''";
			$values .= $val;
		}
		return "INSERT INTO " . $this->get_table_name() . " (" . $keys . ") VALUES (" . $values . ");";
	}
	
	// Insert the object to the database
	public function update_query($db) {
		// TODO
	}
	
	// Saves the object to the database
	public function save() {
		$this->create_table();
		$db = Database::create();
		$query = "";
		if (!$this->from_db)
			$query = $this->insert_query($db);
		else
			$query = $this->update_query($db);
		return $db->query($query);
	}
}

?>

