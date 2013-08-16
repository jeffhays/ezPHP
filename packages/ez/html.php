<?php
namespace ez\core;

/*
 *	Jeff Hays' HTML utility class
 */

class html {

	// JS function to include javascript in footer
	public static function js($filename, $echo=true) {
		$data = '<script src="' . BASE . "/js/$filename\"></script>";
		if($echo) {
			echo $data;
		} else {
			return $data;
		}
	}

	// CSS function to include stylesheets in header
	public static function css($filename, $echo=true) {
		$data = '<link rel="stylesheet" href="' . BASE . "/css/$filename\">";
		if($echo) {
			echo $data;
		} else {
			return $data;
		}
	}
	
}