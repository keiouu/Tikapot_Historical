<?php
/*
 * Tikapot
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GNU General Public License version 3.
 * See LICENSE.txt
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

