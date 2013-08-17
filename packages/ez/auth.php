<?php
namespace ez\core;
use ez\config as config;

/*
 *	Handles user logins and session data
 */
 
class auth {

  // Start session
	public static function init(){
		if(!isset($_SESSION) || !is_array($_SESSION)){
		  ini_set('session.cookie_lifetime', config::$cookie_lifetime);
			ini_set('session.gc_maxlifetime', config::$gc_maxlifetime);
			ini_set('session.use_cookies', config::$use_cookies);
			ini_set('session.use_only_cookies', config::$use_only_cookies);
			ini_set('session.use_trans_sid', config::$use_trans_sid);
			session_set_cookie_params(7776000);
			session_save_path(config::$session_path);
	    session_start();
		}
	}
  
  // Require login on the page this is called on. Will forward to the $login_url from the config if not logged in.
  public static function require_login(){
    // If the user isn't logged in and the current URL isn't the login url, forward them to login page
    if(!isset($_SESSION['loggedin']) && !strstr($_SERVER['REQUEST_URI'], config::$login_url)){
      header('Location: ' . config::$login_url);
      exit;
    }
  }

	// User login function
	public static function login($user=false, $values=false, $redirect=false){
		if((!isset($_SESSION) || !is_array($_SESSION)) && $user && $values){
			// Setup redirect URL
			$redirect = $redirect ? $redirect : config::$loggedin_url;
			// Loop through $values to setup $_SESSION variables
			// Login successful routine
			$_SESSION['loggedin'] = true;
			$_SESSION['username'] = $usercheck->username;
			$_SESSION['access'] = $usercheck->type;
			// Forward to $loggedin_url from config
			header("Location: $redirect");
		}
	}

	// User logout function
	public static function logout($redirect=false){
		$redirect = $redirect ? $redirect : config::$login_url;
		if(is_array($_SESSION)){
		  // Destory session
		  session_unset();
			session_destroy();
		}
		header("Location: $redirect");
		exit;
	}

  
}