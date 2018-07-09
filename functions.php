<?php
/**
 * Portum functions and definitions
 *
 * @link    https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Portum
 * @since   1.0
 */

/**
 * Load Autoloader
 */
require_once 'inc/class-portum-autoloader.php';
/**
 * Instantiate it
 */
$portum = Portum::get_instance();

/*
 * @todo: turn this into a plugin
$debug_tags = array();
add_action( 'all', function ( $tag ) {
	global $debug_tags;
	if ( in_array( $tag, $debug_tags ) ) {
		return;
	}
	echo "<pre style='padding-left: 20%;'>" . $tag . "</pre>";
	$debug_tags[] = $tag;
} );
*/