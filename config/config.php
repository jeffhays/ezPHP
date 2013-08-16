<?php
namespace ez;

/*
 *	All default configs go here
 */

class config {

	// Error reporting
	public static $debug = true;
	public static $debug_messages = E_ALL;
	public static $log = true;
	public static $log_error = 'error.log';
	public static $log_access = 'access.log';
	
	// Site settings
	public static $site_name = 'DoIT!';
	public static $site_title = 'DoIT Engine!';
	public static $site_version = '1';
	
	// Database
	private static $_dbengine = 'mysql';
	private static $_dbhost = 'localhost';
	private static $_dbname = 'doit';
	private static $_dbuser = 'doit';
	private static $_dbpass = 'doitkthxbye!';
	
	public static function dbengine(){
		return self::$_dbengine;
	}

	public static function dbhost(){
		return self::$_dbhost;
	}

	public static function dbname(){
		return self::$_dbname;
	}

	public static function dbuser(){
		return self::$_dbuser;
	}

	public static function dbpass(){
		return self::$_dbpass;
	}

}