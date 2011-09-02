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
require_once($home_dir . "framework/database.php");


class DatabaseTest extends UnitTestCase {
	function testDatabase() {
		$db = Database::create();
		$this->assertTrue($db->is_connected());
		$this->assertTrue($db->query("DROP TABLE IF EXISTS tests;"));
		$this->assertTrue($db->query("CREATE TABLE tests (test CHAR(20));"));
		$this->assertTrue($db->query("INSERT INTO tests VALUES ('hello :D');"));
		$this->assertTrue($db->query("SELECT * FROM tests;"));
		$this->assertTrue($db->query("DROP TABLE IF EXISTS tests;"));
	}
}

?>

