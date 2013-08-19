<?php
namespace ez\app;
use ez\core\user as user;

class controller extends \ez\app\DefaultController {
	
	// Function called before view
	public static function before(){
		user::logout('/admin/index');
	}
	
	// logout action
	public static function logout(){
		
	}

	// Function called after view
	public static function after(){

	}

}