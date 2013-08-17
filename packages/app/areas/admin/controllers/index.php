<?php
namespace ez\app;
use ez\core\view as view;
use ez\core\auth as auth;

class controller extends \ez\app\DefaultController {
	
	public static function before(){
		auth::require_login();
	}
	
	public static function index(){
		view::set('test', 'something');
	}
	
	public static function after(){
		echo 'AFTER FUNCTION CALLED!!!!';
	}
	
}