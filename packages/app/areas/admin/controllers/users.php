<?php
namespace ez\app;
use ez\core\ez as ez;
use ez\core\view as view;
use ez\core\user as user;

class controller extends \ez\app\DefaultController {
	
	public static function before(){
		user::require_login();
	}
	
	public static function edit($id){
		view::set('id', $id);
	}
	
	public static function users(){

	}
	
	public static function after(){

	}
	
}