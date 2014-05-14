<?php
namespace ez\core;
use ez\lib\dBug as dbug;

class ez {

	// Timer variables
	private static $_timer_start = false;
	private static $_timer_stop = false;

	// Alias for dbug::dump()	
	public static function dbug($input) {
		dbug::dump($input);
	}
	
	// Time a script or operation
	public static function timer() {
		if(!self::$_timer_start) {
			self::$_timer_start = microtime(true);
		} else {
			self::$_timer_stop = microtime(true);
			$time = self::$_timer_stop - self::$_timer_start;
			self::dbug("Execution time: $time seconds");
		}
	}
	
}