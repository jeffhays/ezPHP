<?php
namespace ez\core;
use ez\config as config;

/*
 *	Handles user logins and session data
 */
 
class auth {

	public static $userdata = false;
  
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
	public static function login($redirect=false){
		$redirect = $redirect ? $redirect : config::$loggedin_url;
		// Check for POST
		if(is_array($_POST) && isset($_POST['username']) && isset($_POST['password'])){
			$usercheck = db::i()->select()->from('doit_users')->where('username', '=', $_POST['username'])->andwhere('password', '=', md5($_POST['password']))->row();
			if(is_array($usercheck)){
				// Login successful
				self::$userdata = $usercheck;
				$_SESSION['loggedin'] = true;
				$_SESSION['username'] = $usercheck->username;
				$_SESSION['access'] = $usercheck->type;
				header("Location: $redirect");
			}
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