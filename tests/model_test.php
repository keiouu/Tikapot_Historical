<?php
/*
 * Tikapot
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GPL Version 3 license.
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
 
global $home_dir;
require_once($home_dir . "lib/simpletest/autorun.php");
require_once($home_dir . "framework/model.php");
require_once($home_dir . "framework/modelfields.php");

class TestModel extends Model
{	
	public function __construct() {
		$this->add_field("test_prop", new CharField());
		$this->add_field("other_prop", new NumericField());
	}
}

class ModelTest extends UnitTestCase {
	function testModelDB() {
		// TODO - test DB creation/validation when its coded
	}
	
	function testModels() {
		$obj = new TestModel();
		$obj->test_prop = 5;
		$this->assertEqual($obj->test_prop, 5);
		$obj->test_prop = 3;
		$this->assertEqual($obj->test_prop, 3);
		
		$failed = False;
		try { $obj->not_a_valid_field = 100; } catch(Exception $e) { $failed = True; }
		$this->assertTrue($failed);
		
		unset($obj->test_prop);
		$fields = $obj->get_fields();
		$this->assertEqual($obj->test_prop, $fields['test_prop']->default_value);
	}
	
	function testModelFields() {
		// TODO - test field validation when its coded
	}
}

?>

