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
require_once($home_dir . "framework/timer.php");


class TimerTest extends UnitTestCase {
	function testTimer() {
		$timer = Timer::start();
		$this->assertTrue($timer);
		$pingtime = $timer->ping();
		$this->assertTrue($timer->ping() > 0);
		for ($i=0; $i > 100; $i++){} // Time passes..
		$endtime = $timer->end();
		$this->assertTrue($endtime > $pingtime);
		for ($i=0; $i > 100; $i++){} // Time passes..
		$this->assertEqual($endtime, $timer->ping());
	}
}

?>

