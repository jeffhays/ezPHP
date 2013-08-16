<?php
namespace ez\app;

// Namespace aliases
use ez\app\model as model;
use ez\core\view as view;
use ez\core\db as db;
use ez\lib\dBug as dbug;

class DefaultController {

	protected $_controller;
	protected $_action;
	protected $_template;

	// Alias to view::set()
	public static function set($key, $val){
		return view::set($key, $val);
	}
			
	// Alias to dbug::dump()
	public static function dbug($val){
		return dbug::dump($val);
	}
			
}