<?php
namespace ez\core;

class route {

	// Default routes
	private static $_map = array();

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

	// Load libraries
	public static function load(){
		// Get base url without params
		$path = preg_replace('/\?(.*)/', '', $_SERVER['REQUEST_URI']);
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
					echo "$url ---> $base ---> $path<br>";
				} else {
					$base = APP;
				}
				
				echo "$url ===> $base ===> $path<br>";

				// Setup our default controller, model, and view
				$lib = explode('/', $path);
				$lib = array_filter(array_splice($lib, 1), 'strlen');
				$controller = $model = $view = isset($lib[0]) ? $lib[0] : 'index';
				array_shift($lib);
				$action = isset($lib[0]) ? $lib[0] : 'index';

				echo '<hr>';
				echo "controller: {$base}controllers" . DS . "{$controller}.php<br>";
				echo "model: {$base}models" . DS . "{$model}.php<br>";
				echo "view: {$base}{$view}" . DS . "{$action}.php<br>";
				echo '<hr>';
				
				// Set fully-qualified path for each class
				$controller = $base . 'controllers' . DS . $controller . '.php';
				$model = $base . 'models' . DS . $model . '.php';
				$view = $base . $view . DS . $action . '.php';

				if(!file_exists($controller)) die($controller . ' doesnt exist yo');

				// Controller
				if(file_exists($controller)) require_once($controller);
				// Model
				if(file_exists($model)) require_once($model);
				// View
				if(file_exists($view)) require_once($view);
				
/*
				if(is_array($lib) && count($lib)){
					foreach($lib as $part){
						if(!$controller){
							$controller = $part;
						}
					}
				}
*/
/*
				$controller = $model = $view = $lib[0];
				$action = $lib[1];
				$vars = $lib[2] 
*/
				
				
				// Load libraries
				//autoload::add_class('ez\core\controller', APP . $base . 'config.php');
			}
		}
	}
	
}