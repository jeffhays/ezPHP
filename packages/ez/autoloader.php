<?php
namespace ez\core;

/*
 *	This file has been modified from its original version by Jeff Hays to suit the needs of this framework.
 */

/*
 * SplClassLoader implementation that implements the technical interoperability
 * standards for PHP 5.3 namespaces and class names.
 *
 * http://groups.google.com/group/php-standards/web/final-proposal
 *
 *     // Example which loads classes for the Doctrine Common package in the
 *     // Doctrine\Common namespace.
 *     $classLoader = new SplClassLoader('Doctrine\Common', '/path/to/doctrine');
 *     $classLoader->register();
 *
 * @author Jonathan H. Wage <jonwage@gmail.com>
 * @author Roman S. Borschel <roman@code-factory.org>
 * @author Matthew Weier O'Phinney <matthew@zend.com>
 * @author Kris Wallsmith <kris.wallsmith@gmail.com>
 * @author Fabien Potencier <fabien.potencier@symfony-project.org>
 */
class autoloader {

	private static $_file_extension = '.php';
	private static $_namespace;
	private static $_include_path;
	private static $_namespace_separator = '\\';

	private static $_map = array();

	// Add classes to load
	public static function add_classes($classes){
		if(is_array($classes)){
			self::$_map = array_merge(self::$_map, $classes);
			return true;
		}
		return false;
	}

	// Add class to load
	public static function add_class($namespace, $path){
		if($namespace && $path){
			if(!isset(self::$_map[$namespace])){
				self::$_map[$namespace] = $path;
				return true;
			}
		}
		return false;
	}
	
	// Function that takes an array and strips out all files/directories that don't contain the PHP extension from the config
	public static function libfiles($input){
		if(is_array($input) && count($input)){
			foreach($input as $k=>$i){
				if(!strstr($i, EXT)) unset($input[$k]);
			}
			return $input;
		}
		return false;
	}
	
	// Automatically include files from $path containing PHP extension from the config
	public static function libs($path){
		$files = scandir($path);
		$files = self::libfiles($files);
		if(is_array($files) && count($files)){
			foreach($files as $file){
				require_once($path . $file);
			}
			return true;
		}
		return false;
	}

	// Return current classes
	public static function get_classes(){
		return self::$_map;
	}

	/*
	 * Sets the namespace separator used by classes in the namespace of this class loader.
	 *
	 * @param string $sep The separator to use.
	 */
	public static function set_namespace_separator($sep){
		self::$_namespace_separator = $sep;
	}

	/*
	 * Gets the namespace seperator used by classes in the namespace of this class loader.
	 *
	 * @return void
	 */
	public static function get_namespace_separator(){
		return self::$_namespace_separator;
	}

	/*
	 * Sets the base include path for all class files in the namespace of this class loader.
	 *
	 * @param string $includePath
	 */
	public static function set_include_path($path){
		self::$_include_path = $path;
	}

	/*
	 * Gets the base include path for all class files in the namespace of this class loader.
	 *
	 * @return string $includePath
	 */
	public static function get_include_path(){
		return self::$_include_path;
	}

	/*
	 * Sets the file extension of class files in the namespace of this class loader.
	 *
	 * @param string $fileExtension
	 */
	public static function set_file_extension($extension){
		self::$_file_extension = $extension;
	}

	/*
	 * Gets the file extension of class files in the namespace of this class loader.
	 *
	 * @return string $fileExtension
	 */
	public static function get_file_extension(){
		return self::$_file_extension;
	}

	/*
	 * Installs this class loader on the SPL autoload stack.
	 */
	public static function register(){
		spl_autoload_register('ez\core\autoloader::load_class');
	}

	/*
	 * Uninstalls this class loader from the SPL autoloader stack.
	 */
	public static function unregister(){
		spl_autoload_unregister('ez\core\autoloader::load_class');
	}

	/*
	 * Loads the given class or interface.
	 *
	 * @param string $class The name of the class to load.
	 * @return void
	 */
	public static function load_class($class){
		if (null === self::$_namespace || self::$_namespace . self::$_namespace_separator === substr($class, 0, strlen(self::$_namespace . self::$_namespace_separator))) {
			// Initialize namespace, class, and file
			$namespace = $file = '';
			if (false !== ($last_n = strripos($class, self::$_namespace_separator))) {
				$namespace = substr($class, 0, $last_n);
				$class = substr($class, $last_n + 1);
				$file = str_replace(self::$_namespace_separator, DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
			}

			// Check for namespace
			if(!empty($namespace)){

				// Check for map of this namespace
				$newspace = $namespace . self::$_namespace_separator . $class;
				if(isset(self::$_map[$newspace])){

					// We have a map
					$path = self::$_map[$newspace];
					if(file_exists($path)){
						require_once($path);
						return true;
					}
				}
			}
			
			// Check for file
			$file .= str_replace('_', DIRECTORY_SEPARATOR, $class) . self::$_file_extension;

			// Require the file if it exists in our include path
			if(file_exists(self::$_include_path . $file) || file_exists($file)){
				require (self::$_include_path !== null ? self::$_include_path . $file : $file);
			} else {
				echo "Couldn't load the file: <strong>" . self::$_include_path . "$file</strong><br>";
			}
			return false;
		}
	}
}