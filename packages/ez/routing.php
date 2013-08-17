<?php
namespace ez\core;
use ez\lib\dBug as dbug;

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
		dbug::dump(self::$_map);
	}

	public static function url(){

		// Get base url without params
		$path = preg_replace('/\?(.*)/', '', $_SERVER['REQUEST_URI']);

		// Check for routes from our parent class
		if(is_array(self::$_map) && count(self::$_map)){
			foreach(self::$_map as $url=>$base){

				// Remove or add surrounding slashes as needed
				$url = (substr($url, 0, 1) == '/') ? substr($url, 1) : $url;
				$url = (substr($url, 0, 1) == '/') ? substr($url, 1) : $url;
				$base = (substr($base, 0, 1) == DS) ? substr($base, 2) : $base;
				$base = (substr($base, -1) != DS) ? $base . DS: $base;
		
				// Prepare string for preg_replace
				$url = '/' . preg_replace('/\//', '\\\/', $url) . '\//';
				
				// Check for matches in our routing map
				if(preg_match($url, $path)){
					// We have matches in our routing array
					$path = preg_replace($url, '', $path);
					$base = APP . $base;
		/* 					echo "$url ---> $base ---> $path<br>"; */
				} else {
					$base = APP;
				}
				
		/* 				echo "$url ===> $base ===> $path<br>"; */
		
				// Setup our default controller, model, and view
				$lib = explode('/', $path);
				$lib = array_filter(array_splice($lib, 1), 'strlen');
				$controller = $model = $view = isset($lib[0]) ? $lib[0] : config::$index;
				array_shift($lib);
				$action = isset($lib[0]) ? $lib[0] : config::$index;
		
				// Update static files
				self::$_controller = $controller;
				self::$_model = $model;
				self::$_action = $action;

				// Set fully qualified path for each class
				$controller = $base . 'controllers' . DS . $controller . EXT;
				$model = $base . 'models' . DS . $model . EXT;
				$view = $base . 'views' . DS . ($action == config::$index ? self::$_controller : $action);
				
				return array($controller, $model, $view);
			}
		}
		// Return something cause there's no map
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