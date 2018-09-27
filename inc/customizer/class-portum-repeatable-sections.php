<?php
/**
 * Portum Theme Customizer repeatable sections
 *
 * @package Portum
 * @since   1.0
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Class Portum_Repeatable_Sections
 */
class Portum_Repeatable_Sections {

	/**
	 * Holds the sections
	 *
	 * @var array
	 */
	public $sections = array();

	/**
	 * Portum_Repeatable_Sections constructor.
	 */
	public function __construct() {
		$this->collect_sections();
	}

	/**
	 * Grab an instance of the sections
	 *
	 * @return Portum_Repeatable_Sections
	 */
	public static function get_instance() {
		static $inst;
		if ( ! $inst ) {
			$inst = new Portum_Repeatable_Sections();
		}

		return $inst;
	}

	/**
	 * Create the section array
	 */
	public function collect_sections() {
		$methods = get_class_methods( 'Portum_Repeatable_Sections' );
		foreach ( $methods as $method ) {
			if ( false !== strpos( $method, 'repeatable_' ) ) {
				$section = $this->$method();

				if ( ! empty( $section ) ) {
					$this->sections[ $section['id'] ] = $section;
				}
			}
		}

		$this->sections = apply_filters( 'portum_section_collection', $this->sections );
	}

	/**
	 * Repeatable about section
	 *
	 * @return array
	 */
	private function repeatable_about() {
		require_once dirname( __FILE__ ) . '/settings/repeatable-sections/about.php';

		$section = new Repeatable_Section_About;

		return $section();
	}

	/**
	 * Repeatable advanced slider section
	 *
	 * @return array
	 */
	private function repeatable_advanced_slider() {
		require_once dirname( __FILE__ ) . '/settings/repeatable-sections/advanced-slider.php';

		$section = new Repeatable_Section_Advanced_Slider;

		return $section();
	}

	/**
	 * Repeatable content section
	 *
	 * @return array
	 */
	private function repeatable_content() {
		require_once dirname( __FILE__ ) . '/settings/repeatable-sections/content.php';

		$section = new Repeatable_Section_Content;

		return $section();
	}

	/**
	 * Repeatable instagram section
	 *
	 * @return array
	 */
	private function repeatable_instagram() {
		require_once dirname( __FILE__ ) . '/settings/repeatable-sections/instagram.php';

		$section = new Repeatable_Section_Instagram;

		return $section();
	}

	/**
	 * Repeatable openhours section
	 *
	 * @return array
	 */
	private function repeatable_openhours() {
		require_once dirname( __FILE__ ) . '/settings/repeatable-sections/openhours.php';

		$section = new Repeatable_Section_Openhours;

		return $section();
	}

	/**
	 * Repeatable testimonials section
	 *
	 * @return array
	 */
	private function repeatable_testimonials() {
		require_once dirname( __FILE__ ) . '/settings/repeatable-sections/testimonials.php';

		$section = new Repeatable_Section_Testimonials;

		return $section();
	}

	/**
	 * Repeatable testimonials section
	 *
	 * @return array
	 */
	private function repeatable_accordion() {
		require_once dirname( __FILE__ ) . '/settings/repeatable-sections/accordion.php';

		$section = new Repeatable_Section_Accordion;

		return $section();
	}
}
