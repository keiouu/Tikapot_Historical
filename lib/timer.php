<?php
/*
 * Tikapot Timer Class
 * v1.0
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GPL Version 3 license.
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
 
class UIDException extends Exception { }

class Timer
{
	private static $uid = 0, $timers = array();
	
	/* Starts a new timer and returns it's UID */
	public static function start() {
		$uid = self::$uid;
		self::$timers[$uid] = microtime(True);
		self::$uid++;
		return $uid;
	}
	
	private static function check_uid($uid) {
		if (!isset(Timer::$timers[$uid])) {
			throw new UIDException("That UID does not exist!");
		}
	}
	
	/* Returns the current time on the timer without ending it */
	public static function ping($uid) {
		Timer::check_uid($uid);
		return microtime(True) - Timer::$timers[$uid];
	}
	
	/* Returns the current time on the timer, ending it */
	public static function end($uid) {
		Timer::check_uid($uid);
		$final_time = microtime(True) - Timer::$timers[$uid];
		unset(Timer::$timers[$uid]);
		return $final_time;
	}
}

?>

