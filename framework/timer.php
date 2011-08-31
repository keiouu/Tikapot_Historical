<?php
/*
 * Tikapot Timer Class
 * v1.0
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GPL Version 3 license.
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

class Timer
{
	private static $current_uid = 0;
	private $uid = 0, $start_time = 0, $end_time = 0;
	
	private function __construct() {
		$this->uid = self::$current_uid;
		$this->start_time = microtime(True);
		self::$current_uid++;
	}
	
	/* Starts a new timer and returns it */
	public static function start() {
		return new Timer();
	}
	
	/* Returns the current time on the timer without ending it */
	public function ping() {
		if ($this->end_time > 0) return $this->end_time;
		return microtime(True) - $this->start_time;
	}
	
	/* Returns the current time on the timer, ending it casuing future calls to ping() to return the time at the point of the end() call. */
	public function end() {
		$this->end_time = $this->ping();
		return $this->end_time;
	}
}

?>
