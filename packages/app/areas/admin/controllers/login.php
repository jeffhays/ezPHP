<?php
namespace ez\app;
use ez\core\view as view;

class controller extends \ez\app\DefaultController {
	
	public static function before(){

	}
	
	public static function index(){
		if($_POST){
			parent::dbug($_POST);
		}
	}

	public static function after(){

	}

}