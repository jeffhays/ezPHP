<?php
namespace ez\core;
use ez\config as config;
use ez\core\ez as ez;

/*
 *	ez HTML utility class
 */

class html {

	private static $css_files = array();
	private static $js_files = array();

	// JS function to include javascript in footer
	public static function js($filename, $echo=true) {
		// Echo script tag
		$data = "\t" . '<script src="' . config::js() . $filename . '"></script>' . "\n";
		if($echo) {
			echo $data;
		} else {
			return $data;
		}
	}

	// CSS function to include stylesheets in header
	public static function css($filename, $echo=true) {
		// Echo stylesheet link tag
		$data = "\t" . '<link rel="stylesheet" href="' . config::css() . $filename . '">' . "\n";
		if($echo) {
			echo $data;
		} else {
			return $data;
		}
	}

	// Queue JS file or echo queued files (not finished)
	public static function queue_js($handle=false, $filename=false, $dependencies=false, $footer=true) {
		if($handle) {
			// Queue JS file
			if($dependencies && count(self::$js_files)) {
				// Initialize
				$insert = 0;
				if(!is_array($dependencies)) $dependencies = array($dependencies);
				// Loop through files in queue to get insertion point
				foreach(self::$js_files as $k=>$file) {
					if(count($dependencies) && $file['handle'] == $dependencies[0]) {
						$insert++;
						unset($dependencies[0]);
						ez::dbug(self::$js_files);
					}
				}
				self::$js_files[] = array('handle' => $handle, 'filename' => $filename);
			} else {
				self::$js_files[] = array('handle' => $handle, 'filename' => $filename);
			}
			return self::$js_files;
		} else {
			// Echo queued JS files
		}
	}
	
	// CSS function to include stylesheets in header
	public static function favicon($filename, $echo=true) {
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
	public static function breadcrumbs() {
		// Initialize
		$crumbs = '';
		$url = array_filter(explode('/', $_SERVER['REQUEST_URI']), 'strlen');
		if(is_array($url) && count($url)) {
			// Initialize crumbs nav
			$crumbs .= '<nav class="breadcrumbs">';
			$bits = false;
			foreach($url as $k => $crumb) {
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