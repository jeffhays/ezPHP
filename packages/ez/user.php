<?php
namespace ez\core;

class user extends auth {
	
	public static $values = false;

	// Require login on current page
	public static function require_login($url=false){
		return auth::require_login($url) ? self::$values : false;
	}
	
	// Login user, start session, and set user object
	public static function login($values=false){
		return auth::login($values) ? true : false;
	}
	
	// Login user end session, and unset user object
	public static function logout($redirect=false){
		// Unset user
		self::$values = false;
		auth::logout($redirect);
		// Redirect
		if($redirect) header("Location: $redirect");
	}
	
	// Return logged in status
	public static function loggedin(){
		return auth::loggedin();
	}
	
	// Get user value
	public static function val($key){
		return auth::val($key);
	}
	
	// Return user values
	public static function values(){
		return auth::values();
	}
	
}