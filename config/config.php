<?php
namespace ez;

/*
 *	All default configs go here
 */

class config {

	// Error reporting
	public static $debug = true;
	public static $error_reporting = E_ALL;
	public static $log_errors = true;
	public static $error_log = 'error.log';
	public static $access_log = 'access.log';
	
	// Site settings
	public static $site_title = 'ez PHP Framework | A simple HMVC framework with routing for dummies';
	public static $site_name = 'ez PHP Framework';
	public static $site_url = 'http://localhost/';
	public static $site_version = '1';
	
	// Paths
	public static $site_css = '/css/';
	public static $site_js = '/js/';
	public static $site_img = '/img/';
	
	// Template settings
	public static $index = 'index';
	
	// Database
	private static $_dbengine = 'mysql';
	private static $_dbhost = 'localhost';
	private static $_dbname = 'doit';
	private static $_dbuser = 'doit';
	private static $_dbpass = 'doitkthxbye!';


	// Site settings functions
	public static function title(){
		return self::$site_title;
	}
	public static function name(){
		return self::$site_name;
	}
	public static function url(){
		return self::$site_url;
	}
	public static function css(){
		return self::$site_css;
	}
	public static function js(){
		return self::$site_js;
	}
	public static function img(){
		return self::$site_img;
	}
	public static function version(){
		return self::$site_version;
	}

	// Database functions
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