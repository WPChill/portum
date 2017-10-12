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
	 * Repeatable testimonials section
	 *
	 * @return array
	 */
	private function repeatable_testimonials() {
		return array(
			'id'          => 'testimonials',
			'title'       => esc_html__( 'Testimonials Section', 'portum' ),
			'description' => esc_html__( 'A testimonial section. It retrieves content from Theme Content / Testimonials.', 'portum' ),
			'fields'      => array(
				'testimonials_title'          => array(
					'label'             => esc_html__( 'Title', 'portum' ),
					'type'              => 'epsilon-text-editor',
					'default'           => wp_kses_post( 'Why Choose us?' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'testimonials_subtitle'       => array(
					'label'             => esc_html__( 'Subtitle', 'portum' ),
					'type'              => 'text',
					'default'           => wp_kses_post( 'testimonials' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'testimonials_grouping'       => array(
					'label'    => esc_html__( 'Testimonials to show', 'medzone' ),
					'type'     => 'selectize',
					'multiple' => true,
					'choices'  => Portum_Helper::get_group_values_from_meta( 'portum_testimonials', 'testimonial_title' ),
					'default'  => array( 'all' ),
				),
				'testimonials_navigation'     => array(
					'type'            => 'epsilon-customizer-navigation',
					'opensDoubled'    => true,
					'navigateToId'    => 'portum_testimonials_section',
					'navigateToLabel' => esc_html__( 'Add Testimonials &rarr;', 'portum' ),
				),
				'testimonials_repeater_field' => array(
					'type'    => 'hidden',
					'default' => 'portum_testimonials',
				),
			),
		);
	}

	/**
	 * Repeatable slider section
	 *
	 * @return array
	 */
	private function repeatable_slider() {
		return array(
			'id'          => 'slider',
			'title'       => esc_html__( 'Slider Section', 'portum' ),
			'description' => esc_html__( 'A slider section. It retrieves content from Theme Content / Slides.', 'portum' ),
			'fields'      => array(
				'slider_navigation'     => array(
					'type'            => 'epsilon-customizer-navigation',
					'opensDoubled'    => true,
					'navigateToId'    => 'portum_slides_section',
					'navigateToLabel' => esc_html__( 'Add Slides &rarr;', 'portum' ),
				),
				'slider_repeater_field' => array(
					'type'    => 'hidden',
					'default' => 'portum_slides',
				),
			),
		);
	}

	/**
	 * Repeatable services section
	 *
	 * @return array
	 */
	private function repeatable_services() {
		return array(
			'id'          => 'services',
			'title'       => esc_html__( 'Services Section', 'portum' ),
			'description' => esc_html__( 'Services section. It retrieves content from Theme Content / Services', 'portum' ),
			'fields'      => array(
				'services_title'          => array(
					'label'             => esc_html__( 'Title', 'portum' ),
					'type'              => 'text',
					'default'           => wp_kses_post( 'We offer:' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'services_subtitle'       => array(
					'label'             => esc_html__( 'Subtitle', 'portum' ),
					'type'              => 'text',
					'default'           => wp_kses_post( 'SERVICES' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'services_image'          => array(
					'label' => esc_html__( 'Background Image', 'portum' ),
					'type'  => 'epsilon-image',
				),
				'services_grouping'       => array(
					'label'    => esc_html__( 'Services Item To Show', 'portum' ),
					'type'     => 'selectize',
					'multiple' => true,
					'choices'  => Portum_Helper::get_group_values_from_meta( 'portum_services', 'service_title' ),
					'default'  => array( 'all' ),
				),
				'services_navigation'     => array(
					'type'            => 'epsilon-customizer-navigation',
					'opensDoubled'    => true,
					'navigateToId'    => 'portum_services_section',
					'navigateToLabel' => esc_html__( 'Add Services &rarr;', 'portum' ),
				),
				'services_repeater_field' => array(
					'type'    => 'hidden',
					'default' => 'portum_services',
				),
			),
		);
	}

	/**
	 * Repeatable about section
	 *
	 * @return array
	 */
	private function repeatable_about() {
		return array(
			'id'          => 'about',
			'title'       => esc_html__( 'About Section', 'portum' ),
			'description' => esc_html__( 'About section. It retrieves content from Theme Content / Services', 'portum' ),
			'fields'      => array(
				'about_title'    => array(
					'label'             => esc_html__( 'Title', 'portum' ),
					'type'              => 'text',
					'default'           => wp_kses_post( 'Learn more about us and how can we help you:' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'about_subtitle' => array(
					'label'             => esc_html__( 'Subtitle', 'portum' ),
					'type'              => 'text',
					'default'           => wp_kses_post( 'ABOUT' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'about_text'     => array(
					'label'             => esc_html__( 'Information', 'portum' ),
					'type'              => 'epsilon-text-editor',
					'default'           => '',
					'sanitize_callback' => 'wp_kses_post',
				),
				'about_image'    => array(
					'label' => esc_html__( 'Image', 'portum' ),
					'type'  => 'epsilon-image',
					'size'  => 'portum-about-image',
				),
			),
		);
	}

	/**
	 * Repeatable portfolio section
	 *
	 * @return array
	 */
	private function repeatable_portfolio() {
		return array(
			'id'          => 'portfolio',
			'title'       => esc_html__( 'Portfolio Section', 'portum' ),
			'description' => esc_html__( 'Portfolio section. It retrieves content from Theme Content / Portfolio', 'portum' ),
			'fields'      => array(
				'portfolio_title'          => array(
					'label'             => esc_html__( 'Title', 'portum' ),
					'type'              => 'text',
					'default'           => wp_kses_post( 'Check out our latest projects' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'portfolio_subtitle'       => array(
					'label'             => esc_html__( 'Subtitle', 'portum' ),
					'type'              => 'text',
					'default'           => wp_kses_post( 'PORTFOLIO' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'portfolio_grouping'       => array(
					'label'    => esc_html__( 'Portfolio Items to show', 'portum' ),
					'type'     => 'selectize',
					'multiple' => true,
					'choices'  => Portum_Helper::get_group_values_from_meta( 'portum_portfolio', 'portfolio_title' ),
					'default'  => array( 'all' ),
				),
				'portfolio_navigation'     => array(
					'type'            => 'epsilon-customizer-navigation',
					'opensDoubled'    => true,
					'navigateToId'    => 'portum_portfolio_section',
					'navigateToLabel' => esc_html__( 'Add Portfolio Item &rarr;', 'portum' ),
				),
				'portfolio_repeater_field' => array(
					'type'    => 'hidden',
					'default' => 'portum_portfolio',
				),
			),
		);
	}

	/**
	 * Repeatable expertise section
	 *
	 * @return array
	 */
	private function repeatable_expertise() {
		return array(
			'id'          => 'expertise',
			'title'       => esc_html__( 'Expertise Section', 'portum' ),
			'description' => esc_html__( 'Expertise section. It retrieves content from Theme Content / Portfolio', 'portum' ),
			'fields'      => array(
				'expertise_title'          => array(
					'label'             => esc_html__( 'Title', 'portum' ),
					'type'              => 'text',
					'default'           => wp_kses_post( 'We can take your business to the next level' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'expertise_subtitle'       => array(
					'label'             => esc_html__( 'Subtitle', 'portum' ),
					'type'              => 'text',
					'default'           => wp_kses_post( 'OUR EXPERTISE' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'expertise_image'          => array(
					'label' => esc_html__( 'Section Image', 'portum' ),
					'type'  => 'epsilon-image',
					'size'  => 'portum-expertise-image',
				),
				'expertise_grouping'       => array(
					'label'    => esc_html__( 'Expertise to show', 'portum' ),
					'type'     => 'selectize',
					'multiple' => true,
					'choices'  => Portum_Helper::get_group_values_from_meta( 'portum_expertise', 'expertise_title' ),
					'default'  => array( 'all' ),
				),
				'expertise_navigation'     => array(
					'type'            => 'epsilon-customizer-navigation',
					'opensDoubled'    => true,
					'navigateToId'    => 'portum_expertise_section',
					'navigateToLabel' => esc_html__( 'Add Expertise &rarr;', 'portum' ),
				),
				'expertise_repeater_field' => array(
					'type'    => 'hidden',
					'default' => 'portum_expertise',
				),
			),
		);
	}

	/**
	 * Repeatable map section
	 *
	 * @return array
	 */
	private function repeatable_blog() {
		return array(
			'id'          => 'blog',
			'title'       => esc_html__( 'Blog Area', 'portum' ),
			'description' => esc_html__( 'Blog Area Section', 'portum' ),
			'fields'      => array(
				'blog_title'      => array(
					'label'             => esc_html__( 'Title', 'portum' ),
					'type'              => 'text',
					'default'           => wp_kses_post( 'Find out the latest news?' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'blog_subtitle'   => array(
					'label'             => esc_html__( 'Subtitle', 'portum' ),
					'type'              => 'text',
					'default'           => wp_kses_post( 'BLOG' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'blog_post_count' => array(
					'label'   => esc_html__( 'Post Count', 'portum' ),
					'type'    => 'epsilon-slider',
					'default' => 3,
					'choices' => array(
						'min' => 1,
						'max' => 10,
					),
				),
			),
		);
	}

	/**
	 * Repeatable expertise section
	 *
	 * @return array
	 */
	private function repeatable_team() {
		return array(
			'id'          => 'team',
			'title'       => esc_html__( 'Team Section', 'portum' ),
			'description' => esc_html__( 'Team members section. It retrieves content from Theme Content / Portfolio', 'portum' ),
			'fields'      => array(
				'team_title'          => array(
					'label'             => esc_html__( 'Title', 'portum' ),
					'type'              => 'text',
					'default'           => wp_kses_post( 'Meet the people behind the scene' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'team_subtitle'       => array(
					'label'             => esc_html__( 'Subtitle', 'portum' ),
					'type'              => 'text',
					'default'           => wp_kses_post( 'TEAM' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'team_grouping'       => array(
					'label'    => esc_html__( 'Members to show', 'portum' ),
					'type'     => 'selectize',
					'multiple' => true,
					'choices'  => Portum_Helper::get_group_values_from_meta( 'portum_team_members', 'member_title' ),
					'default'  => array( 'all' ),
				),
				'team_navigation'     => array(
					'type'            => 'epsilon-customizer-navigation',
					'opensDoubled'    => true,
					'navigateToId'    => 'portum_team_members_section',
					'navigateToLabel' => esc_html__( 'Add Members &rarr;', 'portum' ),
				),
				'team_repeater_field' => array(
					'type'    => 'hidden',
					'default' => 'portum_team_members',
				),
			),
		);
	}
}
