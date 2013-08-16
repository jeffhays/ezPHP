<?php
namespace ez\app;
use ez\core\db as db;

class model extends \ez\app\DefaultModel {
	
	public static function categories(){
		return db::i()->select()->from('doit_categories')->asobject();
	}
	
}