<?php
namespace ez\core;
use ez\config as config;

/*
 *	Handles user logins and session data
 */
 
class user {

	// Session array key index
	private static $_key = 'auth';
	private static $_file = false;

  // Start session
	public static function init(){
		if(session_id() == '' || !isset($_SESSION)){
			// Initialize session
		  ini_set('session.cookie_lifetime', config::$cookie_lifetime);
			ini_set('session.gc_maxlifetime', config::$gc_maxlifetime);
			ini_set('session.use_cookies', config::$use_cookies);
			ini_set('session.use_only_cookies', config::$use_only_cookies);
			ini_set('session.use_trans_sid', config::$use_trans_sid);
			session_set_cookie_params(config::$set_cookie_params);
			session_save_path(BASE . config::$session_path);

			// Start the session
			session_start();
			self::$_file = BASE . config::$session_path . DS . 'sess_' . session_id();
		}
	}
  
  // Require login on the page this is called on. Will forward to the $login_url from the config or $url passed if not logged in.
  public static function require_login($url=false){
  	// Set our return URL
  	$_SESSION[self::$_key . '_return_url'] = $_SERVER['REQUEST_URI'];
    // If the user isn't logged in and the current URL isn't the login url, forward them to login page
    if(!isset($_SESSION[self::$_key]) && !strstr($_SERVER['REQUEST_URI'], config::$login_url)){
      header('Location: ' . ($url ? $url : config::$login_url));
      return false;
    }
    // User already logged in
    return true;
  }

	// User login function
	public static function login($values=false){
		if($values){
			// Login successful routine
			if((is_object($values) || is_array($values)) && count($values)){
				// Set $_SESSION variables
				$_SESSION[self::$_key] = $values;
				// Redirect if we know where to go
				if(isset($_SESSION[self::$_key . '_return_url'])) header('Location: ' . $_SESSION[self::$_key . '_return_url']);
				return true;
			}
		}
		return false;
	}

	// User logout function
	public static function logout($redirect=false){
	  // Unset and destroy session
	  session_unset();
		session_destroy();
		// Redirect if applicable
		if($redirect) header("Location: $redirect");
	}

	// Return logged in status
	public static function loggedin(){
		return isset($_SESSION) && isset($_SESSION[self::$_key]) ? true : false;
	}
	
	// Return user value
	public static function val($key){
		if(isset($_SESSION[self::$_key])){
			if(is_object($_SESSION[self::$_key])){
				return $_SESSION[self::$_key]->$key;
			} else {
				return $_SESSION[self::$_key][$key];
			}
		}
		return false;
	}
	
	// Return user values
	public static function values(){
		return isset($_SESSION[self::$_key]) ? $_SESSION[self::$_key] : false;
	}
  
}