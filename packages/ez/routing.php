<?php
namespace ez\core;

class route {

	// Default routes
	public static $_map = array();

	// Add routes
	public static function add($routes){
		if(is_array($routes)){
			self::$_map = array_merge(self::$_map, $routes);
			return true;
		}
		return false;
	}

	// Remove routes
	public static function remove($route){
		if(is_array($route) && array_key_exists(self::$_map, $route)){
			unset(self::$_map[$route]);
			return true;
		}
		return false;
	}

	// Show routes
	public static function show(){
		echo '<hr>Routes:<hr><pre>';
		print_r(self::$_map);
		echo '</pre><hr>';
		return true;
	}
	
	// Take inbound $url, preg_replace it, then return base path to appropriate controller/view/model
	public static function route_url($url){
		foreach($routing as $pattern => $result){
			if(preg_match($pattern, $url)) {
				return preg_replace($pattern, $result, $url);
			}
		}
		return $url;
	}
	
}