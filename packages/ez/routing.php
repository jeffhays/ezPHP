<?php
namespace ez\core;
use ez\config as config;
use ez\lib\dBug as dbug;

class route {

	// Default routes
	public static $map = array();

	// Routed classes
	public static $controller;
	public static $model;
	public static $action;

	// Routed paths
	public static $base;
	public static $controller_path;
	public static $model_path;
	public static $view;

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

				// Update static class variables
				self::$controller = $controller;
				self::$model = $model;
				self::$action = $action;

				// Set fully qualified path for each class
				$controller = $base . 'controllers' . DS . $controller . EXT;
				$model = $base . 'models' . DS . $model . EXT;
				$view = $base . 'views' . DS . ($action == config::$index ? self::$controller : $action);
				
				// Update static path variables
				self::$base = $base;
				self::$controller_path = $controller;
				self::$model_path = $model;
				self::$view = $view;
			}
		}
		// Return something cause there's no map
	}	
	
}