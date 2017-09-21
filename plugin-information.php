<?php
/*
* Plugin Name: Name of the plugin 
* Plugin URI: http://piwebsolution.com/
* Description: Description of the plugin
* Version: 1.0.0
* Author: Mr. Rajesh M. Singh
* Author URI: http://100dollarswebsites.com/
* License: GPL3
* License URI: http://www.gnu.org/licenses/gpl.html
* Donate link: http://www.piwebsolution.com/
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}
