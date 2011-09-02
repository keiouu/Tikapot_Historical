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

class TestModel extends Model
{
	public function __construct() {
		$this->add_field("test_prop", new CharField("", $max_length=7));
		$this->add_field("other_prop", new NumericField(4.5));
	}
}

class ModelTest extends UnitTestCase {
	function testModelDB() {
		$obj = new TestModel();
		
		$test_field = new CharField("test", $max_length=7);
		$this->assertEqual($test_field->db_create(NULL, "test_field"), "test_field VARCHAR (7) DEFAULT 'test'");
		$test_field = new CharField("test");
		$this->assertEqual($test_field->db_create(NULL, "test_field"), "test_field VARCHAR DEFAULT 'test'");
		$test_field = new CharField();
		$this->assertEqual($test_field->db_create(NULL, "test_field"), "test_field VARCHAR");
		$test_field = new NumericField(1.0, "4,2");
		$this->assertEqual($test_field->db_create(NULL, "test_field"), "test_field NUMERIC (4,2) DEFAULT '1'");
		$test_field = new NumericField(1.0);
		$this->assertEqual($test_field->db_create(NULL, "test_field"), "test_field NUMERIC DEFAULT '1'");
		$test_field = new NumericField();
		$this->assertEqual($test_field->db_create(NULL, "test_field"), "test_field NUMERIC");
		
		// TODO - test DB creation/validation when its coded
	}
	
	function testModels() {
		$obj = new TestModel();

		// Test Defaults
		$this->assertEqual($obj->other_prop, 4.5);

		// Test setting (and getting)
		$obj->test_prop = '5';
		$this->assertEqual($obj->test_prop, '5');
		$obj->test_prop = '3';
		$this->assertEqual($obj->test_prop, '3');
		
		// Test setting an invalid field name
		$failed = False;
		try { $obj->not_a_valid_field = 100; } catch(Exception $e) { $failed = True; }
		$this->assertTrue($failed);
		
		// Test unsetting
		unset($obj->test_prop);
		$fields = $obj->get_fields();
		$this->assertEqual($obj->test_prop, $fields['test_prop']->get_default());
	}
	
	function testModelFields() {
		$obj = new TestModel();

		// Test validation
		$obj->test_prop = '123456789';
		$this->assertFalse($obj->validate());
		$this->assertTrue(count($obj->get_errors()) > 0);
		$obj->test_prop = '1234567';
		$this->assertTrue($obj->validate());
		$this->assertTrue(count($obj->get_errors()) == 0);
		$obj->test_prop = '123456';
		$this->assertTrue($obj->validate());
	}
}

?>

