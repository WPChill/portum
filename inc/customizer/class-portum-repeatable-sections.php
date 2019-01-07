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
		define( 'EPSILON_REPEATABLE_SECTIONS_CLASS', 'Portum_Repeatable_Sections' );
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
	 * Repeatable accordion section
	 *
	 * @return array
	 */
	private function repeatable_accordion() {
		require_once dirname( __FILE__ ) . '/settings/repeatable-sections/accordion.php';

		$section = new Repeatable_Section_Accordion;

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
	 * Repeatable accordion section
	 *
	 * @return array
	 */
	private function repeatable_blog() {
		require_once dirname( __FILE__ ) . '/settings/repeatable-sections/blog.php';

		$section = new Repeatable_Section_Blog;

		return $section();
	}

	/**
	 * Repeatable clientlist section
	 *
	 * @return array
	 */
	private function repeatable_clientlist() {
		require_once dirname( __FILE__ ) . '/settings/repeatable-sections/clientlist.php';

		$section = new Repeatable_Section_Client_List;

		return $section();
	}

	/**
	 * Repeatable contact section
	 *
	 * @return array
	 */
	private function repeatable_contact() {
		require_once dirname( __FILE__ ) . '/settings/repeatable-sections/contact.php';

		$section = new Repeatable_Section_Contact;

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
	 * Repeatable counters section
	 *
	 * @return array
	 */
	private function repeatable_counters() {
		require_once dirname( __FILE__ ) . '/settings/repeatable-sections/counters.php';

		$section = new Repeatable_Section_Counters;

		return $section();
	}

	/**
	 * Repeatable cta section
	 *
	 * @return array
	 */
	private function repeatable_cta() {
		require_once dirname( __FILE__ ) . '/settings/repeatable-sections/cta.php';

		$section = new Repeatable_Section_Call_To_Action;

		return $section();
	}

	/**
	 * Repeatable features section
	 *
	 * @return array
	 */
	private function repeatable_features() {
		require_once dirname( __FILE__ ) . '/settings/repeatable-sections/features.php';

		$section = new Repeatable_Section_Features;

		return $section();
	}

	/**
	 * Repeatable google map section
	 *
	 * @return array
	 */
	private function repeatable_google_map() {
		require_once dirname( __FILE__ ) . '/settings/repeatable-sections/google_map.php';

		$section = new Repeatable_Section_Google_Maps;

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
	 * Repeatable html section
	 *
	 * @return array
	 */
	private function repeatable_html() {

	 	require_once dirname( __FILE__ ) . '/settings/repeatable-sections/html.php';

 		$section = new Repeatable_Section_HTML;

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
	 * Repeatable portfolio section
	 *
	 * @return array
	 */
	private function repeatable_portfolio() {
		require_once dirname( __FILE__ ) . '/settings/repeatable-sections/portfolio.php';

		$section = new Repeatable_Section_Portfolio;

		return $section();
	}

	/**
	 * Repeatable pricing section
	 *
	 * @return array
	 */
	private function repeatable_pricing() {
		require_once dirname( __FILE__ ) . '/settings/repeatable-sections/pricing.php';

		$section = new Repeatable_Section_Pricing;

		return $section();
	}

	/**
	 * Repeatable progress section
	 *
	 * @return array
	 */
	private function repeatable_progress() {
		require_once dirname( __FILE__ ) . '/settings/repeatable-sections/progress.php';

		$section = new Repeatable_Section_Progress;

		return $section();
	}

	/**
	 * Repeatable services section
	 *
	 * @return array
	 */
	private function repeatable_services() {
		require_once dirname( __FILE__ ) . '/settings/repeatable-sections/services.php';

		$section = new Repeatable_Section_Services;

		return $section();
	}

	/**
	 * Repeatable shortcodes section
	 *
	 * @return array
	 */
	private function repeatable_shortcodes() {
		require_once dirname( __FILE__ ) . '/settings/repeatable-sections/shortcodes.php';

		$section = new Repeatable_Section_Shortcodes;

		return $section();
	}

	/**
	 * Repeatable team section
	 *
	 * @return array
	 */
	private function repeatable_team() {
		require_once dirname( __FILE__ ) . '/settings/repeatable-sections/team.php';

		$section = new Repeatable_Section_Team;

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
	 * Repeatable video section
	 *
	 * @return array
	 */
	private function repeatable_video() {
		require_once dirname( __FILE__ ) . '/settings/repeatable-sections/video.php';

		$section = new Repeatable_Section_Video;

		return $section();
	}

	/**
	 * Repeatable product section
	 *
	 * @return array
	 */
	private function repeatable_products() {
		require_once dirname( __FILE__ ) . '/settings/repeatable-sections/products.php';

		$section = new Repeatable_Section_Products;

		return $section();
	}

	/**
	 * Repeatable product section
	 *
	 * @return array
	 */
	private function repeatable_icon_boxes() {
		require_once dirname( __FILE__ ) . '/settings/repeatable-sections/icon.php';

		$section = new Repeatable_Section_Icon_Boxes;

		return $section();
	}

	/**
	 * Repeatable newsletter section
	 *
	 * @return array
	 */
	private function repeatable_newsletter() {
		require_once dirname( __FILE__ ) . '/settings/repeatable-sections/newsletter.php';

		$section = new Repeatable_Section_Newsletter;

		return $section();
	}

}
