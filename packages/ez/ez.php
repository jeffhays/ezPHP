<?php
namespace ez\core;
use ez\lib\dBug as dbug;

class ez {

	// Alias for dbug::dump()	
	public static function dbug($input){
		dbug::dump($input);
	}
	
}