<?php
/*
 * Tikapot Model System
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GNU General Public License version 3.
 * See LICENSE.txt
 */

global $home_dir;
require_once($home_dir . "framework/database.php");
require_once($home_dir . "framework/model_query.php");
require_once($home_dir . "framework/model_fields/init.php");

abstract class Model
{
	private $from_db = False;
	protected $fields = array(), $errors = array(), $table_name = "";
	
	public function __construct() {
		$this->table_name = $this->get_table_name();
		$this->add_field("id", new PKField(0, $max_length = 22, True));
		// TODO: validation check: only one pk field
		// TODO: validation check: ensure pk field is first field
	}
	
	/* Allows custom primary keys */
	protected function _pk() { return "id"; }
	
	/* Load field values from query result */
	public function load_query_values($result) {
		foreach ($this->fields as $name => $field)
			if (isset($result[$name]))
				$field->value = $result[$name];
	}
	
	// Allows access to stored models
	// Returns a modelquery object containing the elements
	// $query should be in the following format: (COL => Val, COL => (OPER => Val), etc)
	public static function find($query) {
		return new ModelQuery($this, array("WHERE" => $query));
	}
	
	// Allows access to stored models
	// Returns a single object
	// Errors if multiple objects are found or no objects are found
	public static function get($id = 0) {
		$results = self::find(array("id" => $id));
		if ($results->count() == 0)
			throw new ModelQueryException("No objects matching query exist");
		if ($results->count() > 1)
			throw new ModelQueryException("Multiple objects matching query exist in get()");
		return $results->get(0);
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
		if ($name == "pk")
			return $this->fields[$this->_pk()]->value;
		if (isset($this->fields[$name]))
			return $this->fields[$name]->value;
		throw new Exception("Invalid model field '$name'.");
	}
	
	public function __set($name, $value) {
		if ($name == "pk")
			$this->fields[$this->_pk()]->value = $value;
		else if (isset($this->fields[$name]))
			$this->fields[$name]->value = $value;
		else
			throw new Exception("Invalid model field '$name'.");
	}
	
	// Basically: Is $name a valid field name? (Doesnt say if the field has been set)
	public function __isset($name) {
		if ($name == "pk")
			return True;
		return isset($this->fields[$name]);
	}
	
	// Unsetting a field resets it to default value
	public function __unset($name) {
		if ($name == "pk")
			return;
		if ($this->__isset($name))
			$this->fields[$name]->reset();
	}
	
	// Returns the query to create the table in the database
	public function db_create_query($db) {
		$table_name = $this->get_table_name();
		$post_scripts = "";
		$SQL = "CREATE TABLE " . $table_name . " (";
		$i = 0;
		foreach ($this->get_fields() as $name => $field) {
			if ($i > 0) $SQL .= ", ";
			$SQL .= $field->db_create_query($db, $name, $table_name);
			$i++;
			$post_query = $field->db_post_create_query($db, $name, $table_name);
			if (strlen($post_scripts) > 0 && strlen($post_query) > 0)
				$post_scripts .= ", ";
			if (strlen($post_query) > 0)
				$post_scripts .= $post_query;
		}
		if (strlen($post_scripts) > 0)
			$SQL .= ", " . $post_scripts;
		$SQL .= ");";
		
		return $SQL;
	}
	
	public function db_create_extra_queries_pre($db, $table_name) {
		$extra_scripts = array();
		foreach ($this->get_fields() as $name => $field) {
			$query = $field->db_extra_create_query_pre($db, $name, $table_name);
			if (strlen($query) > 0)
				array_push($extra_scripts, $query);
		}
		return $extra_scripts;
	}
	
	public function db_create_extra_queries_post($db, $table_name) {
		$extra_scripts = array();
		foreach ($this->get_fields() as $name => $field) {
			$query = $field->db_extra_create_query_post($db, $name, $table_name);
			if (strlen($query) > 0)
				array_push($extra_scripts, $query);
		}
		return $extra_scripts;
	}
	
	// Creates the table in the database if needed
	// Returns True on success, even if it didnt have to do anything
	public function create_table() {
		$db = Database::create();
		$table_name = $this->get_table_name();
		if (!in_array($this->get_table_name(), $db->get_tables())) {
			foreach($this->db_create_extra_queries_pre($db, $table_name) as $query)
				$db->query($query);
			$res = $db->query($this->db_create_query($db));
			foreach($this->db_create_extra_queries_post($db, $table_name) as $query)
				$db->query($query);
			return $res;
		}
		return True;
	}
	
	// Verifies that the table structure in the database is up-to-date
	public function verify_table() {
		// TODO: complete
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
			if ($field->hide_from_query)
				continue;
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
		$extra = "";
		if ($db->get_type() == "psql")
			$extra = " RETURNING id";
		return "INSERT INTO " . $this->get_table_name() . " (" . $keys . ") VALUES (" . $values . ")" . $extra . ";";
	}
	
	// Insert the object to the database
	public function update_query($db) {
		// TODO: complete
	}
	
	// Saves the object to the database, returns ID
	public function save() {
		if (!$this->validate())
			return False;
		$this->create_table();
		$db = Database::create();
		$query = "";
		if (!$this->from_db) {
			$query = $db->query($this->insert_query($db));
			$id = 0;
			if ($db->get_type() == "psql") {
				$row = $db->fetch($query);
				$id = $row[0];
			}
			if ($db->get_type() == "mysql")
				$id = mysql_insert_id();
			$this->pk() = $id;
			$this->from_db = True;
		}
		else {
			$query = $db->query($this->update_query($db));
		}
		return $this->pk();
	}
}

?>

