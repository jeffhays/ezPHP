<?php
namespace ez\app;
use ez\core\auth as auth;
use ez\core\view as view;

class controller extends \ez\app\DefaultController {
	
	// Function called before view
	public static function before(){
		if($_POST){
			auth::login();
			parent::dbug($_POST);
		}
	}
	
	// index action
	public static function login(){
	}

	// Function called after view
	public static function after(){

	}

}