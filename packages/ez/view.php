<?php
namespace ez\core;

// Namespace aliases
use ez\config as config;
use ez\app\controller as controller;
use ez\app\model as model;
use ez\lib\dBug as dbug;

/*
 *	View class to render components of the view
 */

class view extends route {
	
	protected static $_variables = array();
	protected static $_controller;
	protected static $_model;
	protected static $_action;
	
	protected static $_controller_path;
	protected static $_model_path;
	protected static $_view_path;
	
	// Set variables from controller to view
	public static function set($name, $value) {
		self::$_variables[$name] = $value;
	}
	
	// Debug loaded files
	public static function debug(){
		$values = array(
			'classes' => array(
				'controller' => self::$_controller,
				'model' => self::$_model,
				'action' => self::$_action
			),
			'paths' => array(
				'controller' => self::$_controller_path,
				'model' => self::$_model_path,
				'view' => self::$_view_path
			)
		);

		dbug::dump($values);
	}

	// Function to render the view based on routes and current URL
  public static function render($noheader=false) {

		// Get base url without params
		$path = preg_replace('/\?(.*)/', '', $_SERVER['REQUEST_URI']);

		// Check for routes from our parent class
		if(is_array(parent::$_map) && count(parent::$_map)){
			foreach(parent::$_map as $url=>$base){

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
				
				// Update static paths
				self::$_controller_path = $controller;
				self::$_model_path = $model;
				self::$_view_path = $view;
				
				// Debug
/* 				self::debug(); */

				// Warn if file doesn't exist				
				if(!file_exists($controller)) die($controller . ' doesnt exist yo');

				// Model
				if(file_exists(LIB . 'defaultmodel.php')) require_once(LIB . 'defaultmodel.php');
				if(file_exists($model)) require_once($model);

				// Controller
				if(file_exists(LIB . 'defaultcontroller.php')) require_once(LIB . 'defaultcontroller.php');
				if(file_exists($controller)) require_once($controller);

				// Call controller before() and action() functions
				controller::before();
				controller::$action();

				// Set variables
				extract(self::$_variables);
				
				// View
				if(is_dir($view)){

					// Header
					if(file_exists($view . DS . 'header' . EXT)){
						include($view . DS . 'header' . EXT);
					} else {
						include($base . 'views' . DS . 'header' . EXT);
					}
					
					// Nav
					if(file_exists($view . DS . 'nav' . EXT)){
						include($view . DS . 'nav' . EXT);
					} else {
						include($base . 'views' . DS . 'nav' . EXT);
					}
					
					// View
					if(file_exists($view . DS . $action . EXT)){
						include($view . DS . $action . EXT);
					} else {
						include($base . 'views' . DS . config::$index . EXT);
					}
					
					// Footer
					if(file_exists($view . DS . 'footer' . EXT)){
						include($view . DS . 'footer' . EXT);
					} else {
						include($base . 'views' . DS . 'footer' . EXT);
					}
					
				} else if(file_exists($view . EXT)){
					// View file instead of folder
					include($view . EXT);
				}
				
				// Call controller after() function
				controller::after();
			}
		}		
		
	}

}