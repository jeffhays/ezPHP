<?php
namespace ez\core;
use ez\config as config;

/*
 *	ez HTML utility class
 */

class html {

	// JS function to include javascript in footer
	public static function js($filename, $echo=true){
		// Echo script tag
		$data = "\t" . '<script src="' . config::js() . $filename . '"></script>' . "\n";
		if($echo) {
			echo $data;
		} else {
			return $data;
		}
	}

	// CSS function to include stylesheets in header
	public static function css($filename, $echo=true){
		// Echo stylesheet link tag
		$data = "\t" . '<link rel="stylesheet" href="' . config::css() . $filename . '">' . "\n";
		if($echo) {
			echo $data;
		} else {
			return $data;
		}
	}
	
	// CSS function to include stylesheets in header
	public static function favicon($filename, $echo=true){
		// Grab icon type from filename
		$type = explode('.', $filename);
		$type = end($type);
		$type = strstr($type, 'png') ? 'image/png' : 'image/x-icon';
		// Echo favicon link tag
		$data = "\t" . '<link rel="icon" href="' . config::img() . $filename . '" type="' . $type . '">' . "\n";
		if($echo) {
			echo $data;
		} else {
			return $data;
		}
	}
	
	// Breadcrumbs function
	public static function breadcrumbs(){
		// Initialize
		$crumbs = '';
		$url = array_filter(explode('/', $_SERVER['REQUEST_URI']), 'strlen');
		if(is_array($url) && count($url)){
			// Initialize crumbs nav
			$crumbs .= '<nav class="breadcrumbs">';
			$bits = false;
			foreach($url as $k => $crumb){
				// Add crumb
				$crumbs .= '<a href="/' . ($bits ? $bits : '') . $crumb . '/">' . $crumb . '</a>';
				$bits .= $crumb . '/';
			}
			$crumbs .= '</nav>';
		}
		// Echo out the crumbs
		echo $crumbs;
	}
	
}