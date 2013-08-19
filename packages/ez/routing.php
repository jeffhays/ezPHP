<?php
namespace ez\core;
use ez\config as config;
use ez\lib\dBug as dbug;

class route {

	// Default routes
	public static $map = array();

	// Routed classes
	public static $controller = false;
	public static $model = false;
	public static $action;

	// Routed paths
	public static $base = false;
	public static $controller_path = false;
	public static $model_path = false;
	public static $view = false;
	
	// Private variables
	private static $_match = false;

	// Add routes
	public static function add($routes){
		if(is_array($routes)){
			self::$map = array_merge(self::$map, $routes);
			return true;
		}
		return false;
	}

	// Remove routes
	public static function rm($route){
		if(is_array($route) && array_key_exists(self::$map, $route)){
			unset(self::$map[$route]);
			return true;
		}
		return false;
	}

	// Show routes
	public static function show(){
		ez::dbug(self::$map);
	}

	// Route current URL
	public static function url(){

		// Get base url without params
		$path = preg_replace('/\?(.*)/', '', $_SERVER['REQUEST_URI']);

		// Check for routes from our parent class
		if(is_array(self::$map) && count(self::$map)){
			foreach(self::$map as $url=>$base){
				// Remove or add surrounding slashes as needed
				$url = (substr($url, 0, 1) == '/') ? substr($url, 1) : $url;
				$url = (substr($url, 0, 1) == '/') ? substr($url, 1) : $url;
				$base = (substr($base, 0, 1) == DS) ? substr($base, 2) : $base;
				$base = (substr($base, -1) != DS) ? $base . DS: $base;

				// Prepare string for preg_replace
				$url = '/' . preg_replace('/\//', '\\\/', $url) . '\//';
				$path = (substr($path, -1) != '/') ? $path . '/' : $path;
				
				// Check for matches in our routing map
				if(preg_match($url, $path)){
					// We have matches in our routing array
					self::$_match = true;
					$path = preg_replace($url, '', $path);
					$base = $base == '/' ? APP : APP . $base;
					self::$base = $base;
				} else {
					$base = APP;
				}

				// Setup our default controller, model, and view
				$lib = explode('/', $path);
				$lib = array_filter(array_splice($lib, 1), 'strlen');

				// Check for routing match
				if(self::$_match && !self::$controller){
					// Set action
					if(!self::$action) self::$action = isset($lib[0]) ? $lib[0] : config::$index;

					// Update static class variables
					$controller = $model = $view = (isset($lib[0]) && trim($lib[0]) != '/') ? $lib[0] : config::$index;
					self::$controller = $controller;
					self::$model = $model;

					// Update static path variables
					self::$controller_path = $base . 'controllers' . DS . $controller . EXT;
					self::$model_path = $base . 'models' . DS . $model . EXT;
					self::$view = $base . 'views' . DS . self::$action;
				}

/* 				view::dbug(); */
			}
		}

		// No match
		$controller = $model = $view = (isset($lib[0]) && trim($lib[0]) != '/') ? $lib[0] : config::$index;

		if(!self::$_match){
			// Set action
			array_shift($lib);
			if(!self::$action) $action = isset($lib[0]) ? $lib[0] : config::$index;
	
			// Update static class variables
			if(!self::$controller) self::$controller = $controller;
			if(!self::$model) self::$model = $model;
			if(!self::$action) self::$action = $action;
	
			// Set fully qualified path for each class
			$controller = $base . 'controllers' . DS . $controller . EXT;
			$model = $base . 'models' . DS . $model . EXT;
			$view = $base . 'views' . DS;
			$view .= (self::$_match && $path == '/') ? config::$index : self::$controller;
/* 				$view = $base . 'views' . DS . ($action == config::$index ? self::$controller : $action); */
			
			// Update static path variables
			self::$base = $base;
			if(!self::$controller_path) self::$controller_path = $controller;
			if(!self::$model_path) self::$model_path = $model;
			if(!self::$view) self::$view = $view;
		}
		
	}	
	
}