<?php
namespace ez\app;
use ez\core\ez as ez;
use ez\core\view as view;
use ez\core\user as user;

class controller extends \ez\app\DefaultController {
	
	public static function before() {
		user::require_login();
		// Return true for the actions below to execute
		return true;
	}
	
	public static function index() {

	}
	
	public static function after() {

	}
	
}