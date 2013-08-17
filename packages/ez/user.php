<?php
namespace ez\core;

class user extends auth {
	
	public static $id;
	public static $user;
	public static $name;
	public static $level;

	// Function aliases
	public static function require_login(){
		parent::require_login();
	}
	public static function login(){
		parent::login();
	}
	public static function logout(){
		parent::logout();
	}
	
}