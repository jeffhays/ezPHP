<?php
namespace ez;

/*
 *	All routing should be handled here
 *
 *	Array key: /base/url/
 *	Array val: /app/areas/path/
 *
 *	example: 'admin' => 'areas/admin'
 */

class routing {
	
	// Routes
	private static $_routes = array(
		'admin/blah/test' => 'areas/admin'
	);
	
	// Return routes
	public static function routes(){
		return self::$_routes;
	}
	
}