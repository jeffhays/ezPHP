<?php
namespace ez\core;
use ez\lib\dBug as dbug;

class ez {
	
	public static function breadcrumbs(){
		$url = explode('/', $_SERVER['REQUEST_URI']);
		dbug::dump($url);
		die();
	}
	
}