<?php
namespace ez\app;
use ez\core\auth as auth;
use ez\core\view as view;

class controller extends \ez\app\DefaultController {
	
	// Function called before view
	public static function before(){

	}
	
	// index action
	public static function index(){
		if($_POST){
			parent::dbug($_POST);
/* 			auth::login(); */
		}
	}

	// Function called after view
	public static function after(){

	}

}