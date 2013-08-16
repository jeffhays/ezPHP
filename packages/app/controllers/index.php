<?php
namespace ez\app;
use ez\core\view as view;

class controller extends \ez\app\DefaultController {
	
	public static function before(){
/* 		parent::dbug(array('test')); */
		
		echo 'BEFORE FUNCTION CALLED!!!!';
	}
	
	public static function index(){
		echo 'INDEX FUNCTION CALLED!!!!!';
	}
	
	public static function after(){
		echo 'AFTER FUNCTION CALLED!!!!';
	}
	
}