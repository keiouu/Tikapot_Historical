<?php
/*
 * Tikapot Foreign Key Field
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GNU General Public License version 3.
 * See LICENSE.txt
 */
 
// Left TODO - save foreign ID's

global $home_dir;
require_once("modelfield.php");
require_once($home_dir . "framework/utils.php");

class FKValidationException extends Exception { }

class FKField extends ModelField
{
	protected static $db_type = "varchar"; // Beacuse the FK could be any type :(
	private $_class, $_fid;
	
	public function __construct($model) {
		parent::__construct();
		$this->_class = Null;
		$this->_fid = "";
		$this->update($model);
	}
	
	private function grab_object($class) {
		if ($this->_fid != "")
			$this->_class = call_user_func(array($class, 'get'), array("pk" => $this->_fid));
		else
			$this->_class = new $class();
	}
	
	private function update($model) {
		/*
		 * Class is in the format: appname.modelName
		 * We must scan app paths for the app, then import models.py.
		 * Hopefully, modelName willl then exist
		 */
		list($app, $n, $class) = partition($model, '.');
		if (!class_exists($class)) {
			global $app_paths, $home_dir;
			foreach ($app_paths as $app_path) {
				$path = $home_dir . $app_path . '/' . $app . "/models.php";
				if (is_file($path)) {
					include($path);
					break;
				}
			}
		}
		if (class_exists($class))
			return $this->grab_object($class);
		throw new FKValidationException("Error: '" . $model . "' was not found!");
	}
	
	public function __get($name) {
		if (isset($this->_class->$name))
			return $this->_class->$name;
	}
	
	public function __set($name, $value) {
		if (isset($this->_class->$name))
			$this->_class->$name = $value;
	}
	
	public function __call($name, $args) {
		if(method_exists($this->_class, $name))
			call_user_func_array(array($this->_class, $name), $args);
	}
	
	public function __isset($name) {
		return isset($this->_class->$name);
	}
	
	public function __unset($name) {
		unset($this->_class->$name);
	}
	
	public function validate() {
		return $this->_class != Null;
	}
}

?>

