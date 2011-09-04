<?php
/*
 * Tikapot Model System
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the Keiouu v1.0 License.
 * See LICENSE.txt
 */

global $home_dir;
require_once($home_dir . "framework/database.php");

class ModelQueryException extends Exception { }

class ModelQuery
{
	private $_model, $_query, $_objects, $_count, $_has_run;
	
	/* $query should conform to the following structure (each line optional):
	 *  (
	 *    WHERE => (COL => Val, COL => (Val, OPER), etc),   Default: =
	 *    ORDER_BY => (COL, (COL, DESC/ASC), etc),          Default: DESC
	 *    ONLY => (COL, COL, etc),
	 *  )
	 *  TODO - more clauses
	 */
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
	
	private function _get_query($start = "") {
		$clauses = "";
		$count = 0;
		$selection = '*';
		foreach ($this->_query as $clause => $criterion) {
			$count = 0;
			foreach ($criterion as $name => $val) {
				if ($clause === "ONLY") {
					if ($count == 0)
						$selection = "($val";
					else
						$selection .= ", $val";
				}
				else {
					if ($count == 0)
						$clauses .= " $clause ";
					if ($count > 1)
						$clauses .= " AND ";
					$clauses .= $name;
					$op = "";
					if ($clause === "WHERE")
						$op = "=";
					if ($clause === "ORDER_BY")
						$op = ", ";
					if (is_array($val)) {
						$op = $val[1];
						$val = $val[0];
					}
					if ($clause === "WHERE")
						$clauses .= $op . $val;
					if ($clause === "ORDER_BY" && $count == 0)
						$clauses .= $val . $op;
					if ($clause === "ORDER_BY" && $count > 0)
						$clauses .= ", " . $val . $op;
					$count++;
				}
			}
			if ($clause === "ONLY")
				$selection .= ")";
		}
		if (strlen($start) == 0) {
			$start = "SELECT $selection FROM";
		}
		return $start . " " . $this->_model->get_table_name() . "$clauses;";
	}
	
	/* Run this query */
	private function _run() {
		// Reset
		$this->_objects = array();
		$this->_count = 0;
		
		// Get objects
		$db = Database::create();
		$query = $db->query($this->_get_query());
		while($result = $db->fetch($query)) {
			array_push($this->_objects, $this->_get_object_from_result($result));
			$this->_count++;
		}
		
		$this->_has_run = True;
	}
	
	/* Returns the number of objects in this query */
	public function count() {
		if ($this->_has_run)
			return $this->_count;
		$db = Database::create();
		$query = $db->query($this->_get_query("SELECT COUNT(*) FROM"));
		$result = $db->fetch($query);
		$this->_count = $result[0];
		return $result[0];
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
	
	/* Orders elements by <col> */
	public function order_by($col) {
		
	}
}

?>

