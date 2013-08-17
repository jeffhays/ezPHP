<?php
namespace ez;

/*
 *	All routing should be handled here
 *
 *	Array key: /base/url/
 *	Array val: /app/path/
 *
 *	example: 'admin' => 'areas/admin'
 */

class routing {
	
	// Routes
	private static $_routes = array(
		'/admin' => 'areas/admin',
		'/crumbs' => 'index',
	);
	
	// Return routes
	public static function routes(){
		return self::$_routes;
	}
	
}