<?php
namespace ez;

/*	
 *	All default configs go here
 */

class config {

	// Site settings
	public static $site_title = 'ezPHP Framework | A simple HMVC framework with easy routing';
	public static $site_description = "The ezPHP Framework is a very lightweight, open source, object-oriented HMVC framework written in PHP using namespaces. Easy routing, simple syntax, failovers, and aliases galore make this framework a breeze for novice or advanced developers.";
	public static $site_name = 'ezPHP Framework';
	public static $site_url = 'http://localhost/';
	public static $site_version = '.1 alpha';
	
	// Paths
	public static $site_css = '/css/';
	public static $site_js = '/js/';
	public static $site_img = '/img/';
	
	// Template settings
	public static $index = 'index';
	public static $login_url = '/admin/login';
	public static $loggedin_url = '/';
	
	// Database
	private static $_dbengine = 'mysql';
	private static $_dbhost = 'localhost';
	private static $_dbname = 'ez';
	private static $_dbuser = 'ez';
	private static $_dbpass = 'ez';

	// Error reporting
	public static $debug = true;
	public static $error_reporting = E_ALL;
	public static $log_errors = true;
	public static $error_log = 'error.log';
	public static $access_log = 'access.log';
	
	// Session settings
	public static $session_path = 'tmp/sessions';
	public static $cookie_lifetime = '7776000';
	public static $set_cookie_params = '7776000';
	public static $gc_maxlifetime = '7776000';
	public static $use_cookies = 'on';
	public static $use_only_cookies = 'on';
	public static $use_trans_sid = 'off';
	
	// Site settings functions
	public static function title(){
		return self::$site_title;
	}
	public static function description(){
		return self::$site_description;
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