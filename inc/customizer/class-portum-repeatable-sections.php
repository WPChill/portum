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
	 * Create a repeatable section that renders the page content
	 *
	 * @return array;
	 */
	private function repeatable_content() {
		$arr = array(
			'id'          => 'content',
			'title'       => esc_html__( 'Page Content Section', 'portum' ),
			'description' => esc_html__( 'Section that outputs page content.', 'portum' ),
			'fields'      => array(
				'content_page_id' => array(
					'label'   => esc_html__( 'Page Id', 'portum' ),
					'type'    => 'select',
					'choices' => array(
						'' => __( 'Current Page', 'portum' ),
					),
					'default' => '',
				),
			),
		);

		$args = array(
			'depth'                 => 0,
			'child_of'              => 0,
			'selected'              => 0,
			'echo'                  => 1,
			'name'                  => 'page_id',
			'id'                    => '',
			'class'                 => '',
			'show_option_none'      => '',
			'show_option_no_change' => '',
			'option_none_value'     => '',
			'value_field'           => 'ID',
		);

		$pages = get_pages( $args );

		foreach ( $pages as $page ) {
			$arr['fields']['content_page_id']['choices'][ $page->ID ] = $page->post_title;
		}

		return $arr;
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
			'image'       => esc_url( get_template_directory_uri() . '/assets/images/sections/ewf-icon-section-testimonials-pt.png' ),
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
					'label'    => esc_html__( 'Testimonials to show', 'portum' ),
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
			'image'       => esc_url( get_template_directory_uri() . '/assets/images/sections/ewf-icon-section-hero-pt.png' ),
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
			'id'            => 'services',
			'title'         => esc_html__( 'Services Section', 'portum' ),
			'description'   => esc_html__( 'Services section. It retrieves content from Theme Content / Services', 'portum' ),
			'image'         => esc_url( get_template_directory_uri() . '/assets/images/sections/ewf-icon-section-services-pt.png' ),
			'customization' => array(
				'enabled' => true,
				'styling' => array(
					'background-image',
					'background-position',
					'background-size',
				),
			),
			'fields'        => array(
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
			'image'       => esc_url( get_template_directory_uri() . '/assets/images/sections/ewf-icon-section-about-pt.png' ),
			'fields'      => array(
				'about_title'    => array(
					'label'             => esc_html__( 'Title', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'Learn more about us and how can we help you:', 'portum' ),
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
					'default'           => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris lacinia velit quis sem dignissim porta. Aliquam risus lorem, ornare sed diam at, ultrices vehicula enim. Morbi pharetra ligula nulla, non blandit velit tempor vel.', 'portum' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'about_image'    => array(
					'label'   => esc_html__( 'Image', 'portum' ),
					'type'    => 'epsilon-image',
					'size'    => 'portum-about-image',
					'default' => esc_url( get_template_directory_uri() . '/assets/images/about-img-01.jpg' ),
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
			'image'       => esc_url( get_template_directory_uri() . '/assets/images/sections/ewf-icon-section-portfolio-pt.png' ),
			'fields'      => array(
				'portfolio_title'          => array(
					'label'             => esc_html__( 'Title', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'Check out our latest projects', 'portum' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'portfolio_subtitle'       => array(
					'label'             => esc_html__( 'Subtitle', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'PORTFOLIO', 'portum' ),
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
			'image'       => esc_url( get_template_directory_uri() . '/assets/images/sections/ewf-icon-section-expertise-pt.png' ),
			'fields'      => array(
				'expertise_title'          => array(
					'label'             => esc_html__( 'Title', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'We can take your business to the next level', 'portum' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'expertise_subtitle'       => array(
					'label'             => esc_html__( 'Subtitle', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'OUR EXPERTISE', 'portum' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'expertise_image'          => array(
					'label'   => esc_html__( 'Section Image', 'portum' ),
					'type'    => 'epsilon-image',
					'size'    => 'portum-expertise-image',
					'default' => esc_url( get_template_directory_uri() . '/assets/images/expertise-img-01.jpg' ),
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
			'image'       => esc_url( get_template_directory_uri() . '/assets/images/sections/ewf-icon-section-blog-pt.png' ),
			'fields'      => array(
				'blog_title'      => array(
					'label'             => esc_html__( 'Title', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'Find out the latest news?', 'portum' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'blog_subtitle'   => array(
					'label'             => esc_html__( 'Subtitle', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'BLOG', 'portum' ),
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
			'image'       => esc_url( get_template_directory_uri() . '/assets/images/sections/ewf-icon-section-team-pt.png' ),
			'fields'      => array(
				'team_title'          => array(
					'label'             => esc_html__( 'Title', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'Meet the people behind the scene', 'portum' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'team_subtitle'       => array(
					'label'             => esc_html__( 'Subtitle', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'TEAM', 'portum' ),
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

	/**
	 * Repeatable pricing section
	 *
	 * @return array
	 */
	private function repeatable_pricing() {
		return array(
			'id'          => 'pricing',
			'title'       => esc_html__( 'Pricing Section', 'portum' ),
			'description' => esc_html__( 'Pricing section. It retrieves content from Theme Content / Pricing', 'portum' ),
			'image'       => esc_url( get_template_directory_uri() . '/assets/images/sections/ewf-icon-section-pricing-pt.png' ),
			'fields'      => array(
				'pricing_title'          => array(
					'label'             => esc_html__( 'Title', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'See what packege suits best for you', 'portum' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'pricing_subtitle'       => array(
					'label'             => esc_html__( 'Subtitle', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'PRICING', 'portum' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'pricing_grouping'       => array(
					'label'    => esc_html__( 'Price boxes to show', 'portum' ),
					'type'     => 'selectize',
					'multiple' => true,
					'choices'  => Portum_Helper::get_group_values_from_meta( 'portum_price_boxes', 'price_box_title' ),
					'default'  => array( 'all' ),
				),
				'pricing_navigation'     => array(
					'type'            => 'epsilon-customizer-navigation',
					'opensDoubled'    => true,
					'navigateToId'    => 'portum_pricing_section',
					'navigateToLabel' => esc_html__( 'Add Price Boxes &rarr;', 'portum' ),
				),
				'pricing_repeater_field' => array(
					'type'    => 'hidden',
					'default' => 'portum_price_boxes',
				),
			),
		);
	}

	/**
	 * Repeatable video section
	 *
	 * @return array
	 */
	private function repeatable_video() {
		return array(
			'id'          => 'video',
			'title'       => esc_html__( 'Video Section', 'portum' ),
			'description' => esc_html__( 'Video Section.', 'portum' ),
			'image'       => esc_url( get_template_directory_uri() . '/assets/images/sections/ewf-icon-section-video-pt.png' ),
			'fields'      => array(
				'video_type'    => array(
					'label'   => esc_html__( 'Video Type', 'portum' ),
					'type'    => 'select',
					'choices' => array(
						'youtube' => esc_html__( 'YouTube', 'portum' ),
						'vimeo'   => esc_html__( 'Vimeo', 'portum' ),
					),
					'default' => 'youtube',
				),
				'video_id'      => array(
					'label'   => esc_html__( 'Video Id', 'portum' ),
					'type'    => 'text',
					'default' => 'iNJdPyoqt8U',
				),
				'video_cta'     => array(
					'label'   => esc_html__( 'Call To Action', 'portum' ),
					'type'    => 'epsilon-text-editor',
					'default' => wp_kses_post( __( '<p>Find out the hottest news in <strong>your industry</strong></p>', 'portum' ) ),
				),
				'mailchimp_url' => array(
					'label'             => esc_html__( 'Mailchimp Action URL', 'portum' ),
					'description'       => esc_html__( 'For more information, follow this link', 'portum' ),
					'type'              => 'text',
					'default'           => '',
					'sanitize_callback' => 'esc_url_raw',
				),
			),
		);
	}
}
