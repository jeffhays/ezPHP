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
	public static function dbug(){
		$values = array(
			'classes' => array(
				'controller' => route::$controller,
				'model' => route::$model,
				'action' => route::$action,
				'method' => route::$method
			),
			'paths' => array(
				'controller' => array(
					route::$controller_path => (file_exists(route::$controller_path) ? 'Exists' : 'Not There')
				),
				'model' => array(
					route::$model_path => (file_exists(route::$model_path) ? 'Exists' : 'Not There')
				),
				'view' => array(
					route::$view => (file_exists(route::$view) ? 'Exists' : 'Not There')
				)
			)
		);

		dbug::dump($values);
	}

	// Function to render the view based on routes and current URL
	public static function render($noheader=false) {

		// Get base url without params
		$path = preg_replace('/\?(.*)/', '', $_SERVER['REQUEST_URI']);

		// Check for routes from our route class
		if(is_array(route::$map) && count(route::$map)){
			
			// Route the URL to the various model/view/controller locations
			route::url();

			// Uncomment this line if you'd like to see what files ez is routing to
			// self::dbug();

			// Warn if controller doesn't exist
			if(!file_exists(route::$controller_path)) die('<h1 class="alert">' . route::$controller_path . ' doesnt exist yo</div>');

			// Model
			if(file_exists(LIB . 'defaultmodel.php')) require_once(LIB . 'defaultmodel.php');
			if(file_exists(route::$model_path)) require_once(route::$model_path);

			// Controller
			if(file_exists(LIB . 'defaultcontroller.php')) require_once(LIB . 'defaultcontroller.php');
			if(file_exists(route::$controller_path)) require_once(route::$controller_path);

			// Call controller's before() function and pass params
			$before = call_user_func_array('ez\app\controller::before', route::$params);
			$action = route::$method;
			
			// Call controller's action function and pass in any parameters in the URL after the action
			if($before) call_user_func_array("ez\app\controller::$action", route::$params);

			// Set variables
			extract(self::$_variables);
			
			// View
			if(is_dir(route::$view)){

				// Header
				if(file_exists(route::$view . DS . 'header' . EXT)){
					include(route::$view . DS . 'header' . EXT);
				} else {
					include(route::$base . 'views' . DS . 'header' . EXT);
				}
				
				// Nav
				if(file_exists(route::$view . DS . 'nav' . EXT)){
					include(route::$view . DS . 'nav' . EXT);
				} else {
					include(route::$base . 'views' . DS . 'nav' . EXT);
				}
				
				// Index
				if(file_exists(route::$view . DS . route::$method . EXT)){
					include(route::$view . DS . route::$method . EXT);
				} else {
					include(route::$base . 'views' . DS . route::$action . DS . config::$index . EXT);
				}
				
				// Footer
				if(file_exists(route::$view . DS . 'footer' . EXT)){
					include(route::$view . DS . 'footer' . EXT);
				} else {
					include(route::$base . 'views' . DS . 'footer' . EXT);
				}
				
			} else if(file_exists(route::$view . EXT)){
				// View file instead of folder
				include(route::$view . EXT);
			}
			
			// Call controller's after() function
			controller::after();
		}
	}		

}