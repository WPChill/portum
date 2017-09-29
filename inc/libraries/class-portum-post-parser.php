<?php
/**
 * Class that renders repeater blocks readable
 *
 * @package Portum
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Portum_Post_Parser {
	/**
	 * Portum_Post_Parser constructor.
	 *
	 * @param string $option
	 */
	public function __construct( $option = '' ) {

	}

	/**
	 * @return Portum_Post_Parser
	 */
	public static function get_instance() {
		static $inst;
		if ( ! $inst ) {
			$inst = new Portum_Post_Parser();
		}

		return $inst;
	}
}
