<?php
namespace ez\app;
use ez\core\user as user;

class controller extends \ez\app\DefaultController {
	
	// Function called before view
	public static function before() {
		// Return true for the actions below to execute
		return true;
	}
	
	// logout action
	public static function logout() {
		user::logout('/');
	}

	// Function called after view
	public static function after() {

	}

}