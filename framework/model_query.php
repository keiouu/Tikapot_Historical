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

class ModelQueryException extends Exception { }

class ModelQuery
{
	private $_model, $_query, $_objects, $_count, $_has_run;
	
	/* For now this only supports the WHERE clauses */
	public function __construct($model, $query) {
		$this->_has_run = False;
		$this->_model = $model;
		$this->_query = $query;
	}
	
	/* Allows for lazy evaluation */
	private function _ensure_run() {
		if (!$this->_has_run)
			$this->_run();
	}
	
	private function _get_object_from_result($result) {
		$reflector = new ReflectionClass(get_class($this->_model));
		$obj = $reflector->newInstance();
		$obj->load_query_values($result);
		return $obj;
	}
	
	/* Run this query */
	private function _run() {
		// Reset
		$this->_objects = array();
		$this->_count = 0;
		
		// Build clauses
		// TODO - implement more clauses
		$clauses = "";
		$count = 0;
		foreach ($this->_query as $name => $val) {
			if ($count == 0)
				$clauses .= " WHERE ";
			if ($count > 1)
				$clauses .= " AND ";
			$clauses .= $name . "='" . $val . "'";
			$count++;
		}
		
		// Get objects
		$db = Database::create();
		$query = $db->query("SELECT * FROM " . $this->_model->get_table_name() . "$clauses;");
		while($result = $db->fetch($query)) {
			array_push($this->_objects, $this->_get_object_from_result($result));
			$this->_count++;
		}
		
		$this->_has_run = True;
	}
	
	/* Returns the number of objects in this query */
	public function count() {
		$this->_ensure_run();
		return $this->_count;
	}
	
	/* Returns the nth object in this query */
	public function get($n) {
		$this->_ensure_run();
		
		if ($this->count() < $n || $n < 0)
			throw new ModelQueryException("Error in get(): $n is not a valid element in this query!");
		return $this->_objects[$n];
	}
	
	/* Returns all objects in this query optionally starting at the nth element */
	public function all($n = 0) {
		$this->_ensure_run();
		
		if ($n == 0)
			return $this->_objects;
		$objects = array();
		for ($i = $n; $i < count($this->_objects); ++$i)
			array_push($objects, $this->_objects[$i]);
		return $objects;
	}
}

?>

