<?php
/*
 *	Jeff Hays' ez HMVC framework
 *	Version .1 alpha
 */

// Namespace aliases
use ez\core\autoloader as autoload;
use ez\config as config;

// Define path constants
defined('DS') || define('DS', DIRECTORY_SEPARATOR);
defined('EXT') || define('EXT', '.php');
defined('BASE') || define('BASE', dirname(dirname(__FILE__)) . DS);
defined('CONFIG') || define('CONFIG', BASE . 'config' . DS);
defined('PKG') || define('PKG', BASE . 'packages' . DS);
defined('TMP') || define('TMP', BASE . 'tmp' . DS);
defined('LIB') || define('LIB', PKG . 'lib' . DS);
defined('APP') || define('APP', PKG . 'app' . DS);
defined('CORE') || define('CORE', PKG . 'ez' . DS);
defined('SESS') || define('SESS', TMP . 'sessions' . DS);
defined('LOG') || define('LOG', TMP . 'logs' . DS);

/* require_once(dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php'); */


if(!function_exists('bootstrap_autoloader')){
/*
 *	Bootstrap autoload and startup routine
 */
	function bootstrap_autoloader(){
		// Load our modified autoloader class
		require_once(CORE . 'autoloader.php');
		autoload::set_include_path(PKG);
		
		// Automatically load files in LIB that contain EXT in the filename
		autoload::libs(LIB);
		
		// Load and register configs first for error reporting
		autoload::add_classes(array(
			'ez\config' => CONFIG . 'config.php',
			'ez\routing' => CONFIG . 'routing.php'
		));

		// Dispatch auto loader
		autoload::register();
		
		// Setup reporting
		if(config::$debug){
			error_reporting(config::$error_reporting);
			ini_set('display_errors', 1);
		} else {
			error_reporting(0);
			ini_set('display_errors', 0);
		}
		
		// Setup logging
		ini_set('log_errors', config::$log_errors);
		ini_set('error_log', LOG . config::$error_log);
		
		// Load classes - usage: array(namespace\class => path/to/class.php)
		autoload::add_classes(array(
			'ez\core\session' => CORE . 'session.php',
			'ez\core\auth' => CORE . 'auth.php',
			'ez\core\user' => CORE . 'user.php',
			'ez\core\route' => CORE . 'routing.php',
			'ez\core\db' => CORE . 'db.php',
			'ez\core\ez' => CORE . 'ez.php',
			'ez\core\view' => CORE . 'view.php',
			'ez\core\html' => CORE . 'html.php'
		));
		
		// Dispatch auto loader
		autoload::register();
		
		// Setup global namespace aliases - usage: array(namespace\class => alias)
		alias(array(
			'ez\config' => 'config',
			'ez\routing' => 'routing',
			'ez\core\auth' => 'auth',
			'ez\core\user' => 'user',
			'ez\core\autoloader' => 'autoload',
			'ez\core\db' => 'db',
			'ez\core\ez' => 'ez',
			'ez\core\html' => 'html',
			'ez\core\route' => 'route',
			'ez\core\view' => 'view'
		));

		// Start session if needed
		auth::init();

		// Initialize database connection
		db::init(config::dbhost(), config::dbname(), config::dbuser(), config::dbpass());
		
		// Add routing from config/routing.php
		route::add(routing::routes());

		// Render the view
		view::render();
	}
}

if(!function_exists('alias')){
/*
 *	Alias function to assign function aliases to a class which allows us to globally alias rather than having to use "use namespace\class"
 */
	function alias($array){
		if(is_array($array)){
			foreach($array as $class=>$alias){
				class_alias($class, $alias);
			}
		}
	}
}

bootstrap_autoloader();