<?php
namespace ez\app;
use ez\core\ez as ez;
use ez\core\db as db;
use ez\core\user as user;
use ez\core\view as view;

class controller extends \ez\app\DefaultController {
	
	// Function called before view
	public static function before() {

	}
	
	// login action
	public static function login() {
		// Login user
		if(is_array($_POST) && isset($_POST['username']) && isset($_POST['password'])) {
			// Example to select a user/pass combo that was posted with the ez_users table using an md5 password
			$user = db::i()->select()->from('ez_users')
										 ->where('username', '=', $_POST['username'])
										 ->andwhere('password', '=', md5($_POST['password']))
										 ->row();
			// Login user
			$user = user::login($user);
		}
	}

	// Function called after view
	public static function after() {

	}

}