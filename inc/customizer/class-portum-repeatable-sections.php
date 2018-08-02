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
			'id'            => 'content',
			'title'         => esc_html__( 'Page Content Section', 'portum' ),
			'description'   => esc_html__( 'Section that outputs page content.', 'portum' ),
			'customization' => array(
				'enabled' => true,
				'layout'  => array(
					'column-stretch'            => array(
						'default' => 'boxedin',
						'choices' => array( 'boxedcenter', 'boxedin', 'fullwidth' ),
					),
					'row-spacing-top'           => array(
						'default' => 'md',
						'choices' => array( 'lg', 'md', 'sm', 'none' ),
					),
					'row-spacing-bottom'        => array(
						'default' => 'md',
						'choices' => array( 'lg', 'md', 'sm', 'none' ),
					),
					'column-alignment'          => array(
						'default' => 'left',
						'choices' => array( 'left', 'center', 'right' ),
					),
					'column-vertical-alignment' => array(
						'default' => 'middle',
						'choices' => array( 'top', 'middle', 'bottom' ),
					),
				),
				'styling' => array(
					'background-color'    => array(
						'default' => false,
					),
					'background-image'    => array(
						'default' => false,
					),
					'background-position' => array(
						'default' => 'center',
					),
					'background-size'     => array(
						'default' => 'initial',
					),
					'background-repeat'   => array(
						'default' => 'repeat',
					),
					'background-parallax' => array(
						'default' => false,
					),
					'background-video'    => array(
						'default' => '',
					),
				),
				'colors'  => array(
					'heading-color' => array(
						'selectors' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', '.headline span' ),
						'default'   => '',
					),
					'text-color'    => array(
						'selectors' => array( 'p' ),
						'default'   => '',
					),
				),
			),
			'fields'        => array(
				'content_page_id'           => array(
					'label'   => esc_html__( 'Page Id', 'portum' ),
					'type'    => 'select',
					'choices' => array(
						'' => __( 'Current Page', 'portum' ),
					),
					'default' => '',
				),
				'content_page_date'         => array(
					'label'   => esc_html__( 'Enable date', 'portum' ),
					'type'    => 'epsilon-toggle',
					'default' => true,
				),
				'content_page_author'       => array(
					'label'   => esc_html__( 'Enable author', 'portum' ),
					'type'    => 'epsilon-toggle',
					'default' => true,
				),
				'content_page_comments'     => array(
					'label'   => esc_html__( 'Enable comments', 'portum' ),
					'type'    => 'epsilon-toggle',
					'default' => true,
				),
				'content_page_categories'   => array(
					'label'   => esc_html__( 'Enable categories', 'portum' ),
					'type'    => 'epsilon-toggle',
					'default' => true,
				),
				'content_section_unique_id' => array(
					'label'             => esc_html__( 'Unique ID', 'portum' ),
					'type'              => 'text',
					'sanitize_callback' => 'sanitize_key',
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
			'id'            => 'testimonials',
			'title'         => esc_html__( 'Testimonials', 'portum' ),
			'description'   => esc_html__( 'A testimonial section. It retrieves content from Theme Content / Testimonials.', 'portum' ),
			'image'         => esc_url( get_template_directory_uri() . '/assets/images/sections/ewf-icon-section-testimonials-pt.png' ),
			'customization' => array(
				'enabled' => true,
				'layout'  => array(
					'row-spacing-top'    => array(
						'default' => 'md',
						'choices' => array( 'lg', 'md', 'sm', 'none' ),
					),
					'row-spacing-bottom' => array(
						'default' => 'md',
						'choices' => array( 'lg', 'md', 'sm', 'none' ),
					),
					'column-group'       => array(
						'default' => 2,
						'choices' => array( 1, 2 ),
					),
				),
				'styling' => array(
					'background-color'    => array(
						'default' => false,
					),
					'background-image'    => array(
						'default' => false,
					),
					'background-position' => array(
						'default' => 'center',
					),
					'background-size'     => array(
						'default' => 'initial',
					),
					'background-repeat'   => array(
						'default' => 'repeat',
					),
					'background-parallax' => array(
						'default' => false,
					),
					'background-video'    => array(
						'default' => '',
					),
				),
				'colors'  => array(
					'heading-color' => array(
						'selectors' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', '.headline span' ),
						'default'   => '',
					),
					'text-color'    => array(
						'selectors' => array( 'p' ),
						'default'   => '',
					),
				),
			),
			'fields'        => array(
				'testimonials_title'             => array(
					'label'             => esc_html__( 'Title', 'portum' ),
					'type'              => 'text',
					'default'           => wp_kses_post( 'Why Choose us?' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'testimonials_subtitle'          => array(
					'label'             => esc_html__( 'Subtitle', 'portum' ),
					'type'              => 'text',
					'default'           => wp_kses_post( 'testimonials' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'testimonials_grouping'          => array(
					'label'       => esc_html__( 'Filter shown testimonials', 'portum' ),
					'description' => esc_html__( 'The items you select in here are the only ones which will be displayed on this page. Think of the information you create in a section similar to a blog post. They are all created in a single place, but filtered by category. If you want to use multiple sections and display different information in each of them, use the filtering. ', 'portum' ),
					'type'        => 'selectize',
					'multiple'    => true,
					'choices'     => Portum_Helper::get_group_values_from_meta( 'portum_testimonials', 'testimonial_title' ),
					'default'     => array( 'all' ),
				),
				'testimonials_navigation'        => array(
					'type'            => 'epsilon-customizer-navigation',
					'opensDoubled'    => true,
					'navigateToId'    => 'portum_testimonials_section',
					'navigateToLabel' => esc_html__( 'Add/Edit Testimonials &rarr;', 'portum' ),
				),
				'testimonials_repeater_field'    => array(
					'type'    => 'hidden',
					'default' => 'portum_testimonials',
				),
				'testimonials_section_unique_id' => array(
					'label'             => esc_html__( 'Section ID', 'portum' ),
					'type'              => 'text',
					'sanitize_callback' => 'sanitize_key',
				),
			),
		);
	}


	/**
	 * Repeatable slider section
	 *
	 * @return array
	 */

	private function repeatable_advanced_slider() {
		$slider = array(
			'id'          => 'advanced-slider',
			'image'       => esc_url( get_template_directory_uri() . '/assets/images/sections/ewf-icon-section-advanced-slider.png' ),
			'title'       => esc_html__( 'Advanced Slider', 'portum' ),
			'description' => esc_html__( 'A multi-purpose slider section that you can use through-out your website.', 'portum' ),
			'fields'      => array(
				'slider_transition'        => array(
					'label'   => esc_html__( 'Transition', 'portum' ),
					'type'    => 'select',
					'default' => 'slide',
					'choices' => array(
						'fade'  => esc_html__( 'Fade', 'portum' ),
						'slide' => esc_html__( 'Slide', 'portum' ),
					),
				),
				'slider_speed'             => array(
					'label'   => esc_html__( 'Speed', 'portum' ),
					'type'    => 'epsilon-slider',
					'default' => 500,
					'choices' => array(
						'min'  => 0,
						'max'  => 2000,
						'step' => 100,
					),
				),
				'slider_autostart'         => array(
					'label'   => esc_html__( 'Autostart', 'portum' ),
					'type'    => 'epsilon-toggle',
					'default' => true,
				),
				'slider_infinite'          => array(
					'label'   => esc_html__( 'Infinite slides', 'portum' ),
					'type'    => 'epsilon-toggle',
					'default' => true,
				),
				'slider_pager'             => array(
					'label'   => esc_html__( 'Pager', 'portum' ),
					'type'    => 'epsilon-toggle',
					'default' => true,
				),
				'slider_controls'          => array(
					'label'   => esc_html__( 'Controls', 'portum' ),
					'type'    => 'epsilon-toggle',
					'default' => true,
				),
				'slider_advanced_grouping' => array(
					'label'       => esc_html__( 'Filter shown slides', 'portum' ),
					'description' => esc_html__( 'The items you select in here are the only ones which will be displayed on this page. Think of the information you create in a section similar to a blog post. They are all created in a single place, but filtered by category. If you want to use multiple sections and display different information in each of them, use the filtering. ', 'portum' ),
					'type'        => 'selectize',
					'multiple'    => true,
					'choices'     => Portum_Helper::get_group_values_from_meta( 'portum_advanced_slides', 'slide_title' ),
					'default'     => array( 'all' ),
				),
				'slider_navigation'        => array(
					'type'            => 'epsilon-customizer-navigation',
					'opensDoubled'    => true,
					'navigateToId'    => 'portum_advanced_slides_section',
					'navigateToLabel' => esc_html__( 'Add/Edit Slides &rarr;', 'portum' ),
				),
				'slider_repeater_field'    => array(
					'type'    => 'hidden',
					'default' => 'portum_advanced_slides',
				),
			),
		);

		return $slider;
	}

	/**
	 * Repeatable slider section
	 *
	 * @return array
	 */
	private function repeatable_slider() {
		return array(
			'id'          => 'slider',
			'title'       => esc_html__( 'Slider', 'portum' ),
			'description' => esc_html__( 'A slider section. It retrieves content from Theme Content / Slides.', 'portum' ),
			'image'       => esc_url( get_template_directory_uri() . '/assets/images/sections/ewf-icon-section-hero-pt.png' ),
			'fields'      => array(
				'slider_pager'             => array(
					'label'   => esc_html__( 'Show Numbered Pager', 'portum' ),
					'type'    => 'epsilon-toggle',
					'default' => true,
				),
				'slider_autoplay'          => array(
					'label'   => esc_html__( 'Slider Autoplay', 'portum' ),
					'type'    => 'epsilon-toggle',
					'default' => true,
				),
				'slider_loop'              => array(
					'label'   => esc_html__( 'Slider Loop', 'portum' ),
					'type'    => 'epsilon-toggle',
					'default' => true,
				),
				'slider_navigation'        => array(
					'type'            => 'epsilon-customizer-navigation',
					'opensDoubled'    => true,
					'navigateToId'    => 'portum_slides_section',
					'navigateToLabel' => esc_html__( 'Add/Edit Slides &rarr;', 'portum' ),
				),
				'slider_grouping'          => array(
					'label'       => esc_html__( 'Filter shown slides', 'portum' ),
					'description' => esc_html__( 'The items you select in here are the only ones which will be displayed on this page. Think of the information you create in a section similar to a blog post. They are all created in a single place, but filtered by category. If you want to use multiple sections and display different information in each of them, use the filtering. ', 'portum' ),
					'type'        => 'selectize',
					'multiple'    => true,
					'choices'     => Portum_Helper::get_group_values_from_meta( 'portum_slides', 'slides_title' ),
					'default'     => array( 'all' ),
				),
				'slider_repeater_field'    => array(
					'type'    => 'hidden',
					'default' => 'portum_slides',
				),
				'slider_section_unique_id' => array(
					'label'             => esc_html__( 'Section ID', 'portum' ),
					'type'              => 'text',
					'sanitize_callback' => 'sanitize_key',
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
			'title'         => esc_html__( 'Services', 'portum' ),
			'description'   => esc_html__( 'Services section. It retrieves content from Theme Content / Services', 'portum' ),
			'image'         => esc_url( get_template_directory_uri() . '/assets/images/sections/ewf-icon-section-services-pt.png' ),
			'customization' => array(
				'enabled' => true,
				'layout'  => array(
					'row-title-align'           => array(
						'default' => 'left',
						'choices' => array( 'left', 'top', 'right' ),
					),
					'column-stretch'            => array(
						'default' => 'boxedin',
						'choices' => array( 'boxedcenter', 'boxedin', 'fullwidth' ),
					),
					'row-spacing-top'           => array(
						'default' => 'md',
						'choices' => array( 'lg', 'md', 'sm', 'none' ),
					),
					'row-spacing-bottom'        => array(
						'default' => 'md',
						'choices' => array( 'lg', 'md', 'sm', 'none' ),
					),
					'column-group'              => array(
						'default' => 3,
						'choices' => array( 2, 3, 4 ),
					),
					'column-alignment'          => array(
						'default' => 'left',
						'choices' => array( 'left', 'center', 'right' ),
					),
					'column-vertical-alignment' => array(
						'default' => 'middle',
						'choices' => array( 'top', 'middle', 'bottom' ),
					),
				),
				'styling' => array(
					'background-color'    => array(
						'default' => false,
					),
					'background-image'    => array(
						'default' => false,
					),
					'background-position' => array(
						'default' => 'center',
					),
					'background-size'     => array(
						'default' => 'initial',
					),
					'background-repeat'   => array(
						'default' => 'repeat',
					),
					'background-parallax' => array(
						'default' => false,
					),
					'background-video'    => array(
						'default' => '',
					),
				),
				'colors'  => array(
					'heading-color' => array(
						'selectors' => array(
							'h1',
							'h2',
							'h3',
							'h4',
							'h5',
							'h6',
							'.headline span:not(.dashicons)',
							'.headline h3',
							'.services-item span:not(.dashicons)',
						),
						'default'   => '',
					),
					'text-color'    => array(
						'selectors' => array( 'p' ),
						'default'   => '',
					),
				),
			),
			'fields'        => array(
				'services_title'             => array(
					'label'             => esc_html__( 'Title', 'portum' ),
					'type'              => 'text',
					'default'           => wp_kses_post( 'We offer:' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'services_subtitle'          => array(
					'label'             => esc_html__( 'Subtitle', 'portum' ),
					'type'              => 'text',
					'default'           => wp_kses_post( 'SERVICES' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'services_description'       => array(
					'label'             => esc_html__( 'Description', 'portum' ),
					'type'              => 'epsilon-text-editor',
					'default'           => esc_html__( 'Add a description text over here', 'portum' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'services_grouping'          => array(
					'label'       => esc_html__( 'Filter shown services', 'portum' ),
					'description' => esc_html__( 'The items you select in here are the only ones which will be displayed on this page. Think of the information you create in a section similar to a blog post. They are all created in a single place, but filtered by category. If you want to use multiple sections and display different information in each of them, use the filtering. ', 'portum' ),
					'type'        => 'selectize',
					'multiple'    => true,
					'choices'     => Portum_Helper::get_group_values_from_meta( 'portum_services', 'service_title' ),
					'default'     => array( 'all' ),
				),
				'services_navigation'        => array(
					'type'            => 'epsilon-customizer-navigation',
					'opensDoubled'    => true,
					'navigateToId'    => 'portum_services_section',
					'navigateToLabel' => esc_html__( 'Add/Edit Services &rarr;', 'portum' ),
				),
				'services_repeater_field'    => array(
					'type'    => 'hidden',
					'default' => 'portum_services',
				),
				'services_section_unique_id' => array(
					'label'             => esc_html__( 'Section ID', 'portum' ),
					'type'              => 'text',
					'sanitize_callback' => 'sanitize_key',
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
			'id'            => 'about',
			'title'         => esc_html__( 'Alt. image & text', 'portum' ),
			'description'   => esc_html__( 'Alternating image & text section.', 'portum' ),
			'image'         => esc_url( get_template_directory_uri() . '/assets/images/sections/ewf-icon-section-about-pt.png' ),
			'customization' => array(
				'enabled' => true,
				'layout'  => array(
					'row-title-align'           => array(
						'default' => 'right',
						'choices' => array( 'left', 'top', 'right' ),
					),
					'column-stretch'            => array(
						'default' => 'boxedin',
						'choices' => array( 'boxedcenter', 'boxedin', 'fullwidth' ),
					),
					'row-spacing-top'           => array(
						'default' => 'md',
						'choices' => array( 'lg', 'md', 'sm', 'none' ),
					),
					'row-spacing-bottom'        => array(
						'default' => 'md',
						'choices' => array( 'lg', 'md', 'sm', 'none' ),
					),
					'column-alignment'          => array(
						'default' => 'left',
						'choices' => array( 'left', 'center', 'right' ),
					),
					'column-vertical-alignment' => array(
						'default' => 'middle',
						'choices' => array( 'top', 'middle', 'bottom' ),
					),
				),
				'styling' => array(
					'background-color'    => array(
						'default' => false,
					),
					'background-image'    => array(
						'default' => false,
					),
					'background-position' => array(
						'default' => 'center',
					),
					'background-size'     => array(
						'default' => 'initial',
					),
					'background-repeat'   => array(
						'default' => 'repeat',
					),
					'background-parallax' => array(
						'default' => false,
					),
					'background-video'    => array(
						'default' => '',
					),
				),
				'colors'  => array(
					'heading-color' => array(
						'selectors' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', '.headline span' ),
						'default'   => '',
					),
					'text-color'    => array(
						'selectors' => array( 'p' ),
						'default'   => '',
					),
				),
			),
			'fields'        => array(
				'about_title'                => array(
					'label'             => esc_html__( 'Title', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'Learn more about us and how can we help you:', 'portum' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'about_subtitle'             => array(
					'label'             => esc_html__( 'Subtitle', 'portum' ),
					'type'              => 'text',
					'default'           => wp_kses_post( 'ABOUT' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'about_text'                 => array(
					'label'             => esc_html__( 'Information', 'portum' ),
					'type'              => 'epsilon-text-editor',
					'default'           => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris lacinia velit quis sem dignissim porta. Aliquam risus lorem, ornare sed diam at, ultrices vehicula enim. Morbi pharetra ligula nulla, non blandit velit tempor vel.', 'portum' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'about_image'                => array(
					'label'   => esc_html__( 'Image', 'portum' ),
					'type'    => 'epsilon-image',
					'size'    => 'original',
					'default' => esc_url( get_template_directory_uri() . '/assets/images/01_about.png' ),
				),
				'about_button_primary_label' => array(
					'label'             => esc_html__( 'Primary button label', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'Primary button', 'portum' ),
					'sanitize_callback' => 'sanitize_textfield',
				),
				'about_button_primary_url'   => array(
					'label'             => esc_html__( 'Primary button URL', 'portum' ),
					'type'              => 'text',
					'default'           => esc_url( 'https://google.com' ),
					'sanitize_callback' => 'esc_url_raw',
				),
				'about_section_unique_id'    => array(
					'label'             => esc_html__( 'Section ID', 'portum' ),
					'type'              => 'text',
					'sanitize_callback' => 'sanitize_key',
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
			'id'            => 'portfolio',
			'title'         => esc_html__( 'Portfolio', 'portum' ),
			'description'   => esc_html__( 'Portfolio section. It retrieves content from Theme Content / Portfolio', 'portum' ),
			'image'         => esc_url( get_template_directory_uri() . '/assets/images/sections/ewf-icon-section-portfolio-pt.png' ),
			'customization' => array(
				'enabled' => true,
				'layout'  => array(
					'column-stretch'     => array(
						'default' => 'boxedin',
						'choices' => array( 'boxedcenter', 'boxedin', 'fullwidth' ),
					),
					'column-group'       => array(
						'default' => 4,
						'choices' => array( 2, 3, 4 ),
					),
					'column-spacing'     => array(
						'default' => 'none',
						'choices' => array( 'none', 'sm', 'md', 'lg' ),
					),
					'row-spacing-top'    => array(
						'default' => 'md',
						'choices' => array( 'lg', 'md', 'sm', 'none' ),
					),
					'row-spacing-bottom' => array(
						'default' => 'none',
						'choices' => array( 'lg', 'md', 'sm', 'none' ),
					),
					'column-alignment'   => array(
						'default' => 'left',
						'choices' => array( 'left', 'center', 'right' ),
					),
					'template-selector'  => array(
						'default' => 'normal',
						'choices' => array(
							array(
								'value' => 'normal',
								'png'   => get_template_directory_uri() . '/assets/images/sections/ewf-icon-section-about-pt.png',
							),
							array(
								'value' => 'isotope',
								'png'   => get_template_directory_uri() . '/assets/images/sections/ewf-icon-section-about-pt.png',
							),
							array(
								'value' => 'masonry',
								'png'   => get_template_directory_uri() . '/assets/images/sections/ewf-icon-section-about-pt.png',
							),
						),
					),
				),
				'styling' => array(
					'background-color'    => array(
						'default' => false,
					),
					'background-image'    => array(
						'default' => false,
					),
					'background-position' => array(
						'default' => 'center',
					),
					'background-size'     => array(
						'default' => 'initial',
					),
					'background-repeat'   => array(
						'default' => 'repeat',
					),
					'background-parallax' => array(
						'default' => false,
					),
				),
				'colors'  => array(
					'heading-color' => array(
						'selectors' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', '.headline span' ),
						'default'   => '',
					),
					'text-color'    => array(
						'selectors' => array( 'p' ),
						'default'   => '',
					),
				),
			),
			'fields'        => array(
				'portfolio_title'             => array(
					'label'             => esc_html__( 'Title', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'Check out our latest projects', 'portum' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'portfolio_subtitle'          => array(
					'label'             => esc_html__( 'Subtitle', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'PORTFOLIO', 'portum' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'portfolio_grouping'          => array(
					'label'       => esc_html__( 'Filter shown portfolio items', 'portum' ),
					'description' => esc_html__( 'The items you select in here are the only ones which will be displayed on this page. Think of the information you create in a section similar to a blog post. They are all created in a single place, but filtered by category. If you want to use multiple sections and display different information in each of them, use the filtering. ', 'portum' ),
					'type'        => 'selectize',
					'multiple'    => true,
					'choices'     => Portum_Helper::get_group_values_from_meta( 'portum_portfolio', 'portfolio_title' ),
					'default'     => array( 'all' ),
				),
				'portfolio_navigation'        => array(
					'type'            => 'epsilon-customizer-navigation',
					'opensDoubled'    => true,
					'navigateToId'    => 'portum_portfolio_section',
					'navigateToLabel' => esc_html__( 'Add/Edit Portfolio Item &rarr;', 'portum' ),
				),
				'portfolio_description_below' => array(
					'label'       => esc_html__( 'Details under thumbnail', 'portum' ),
					'description' => esc_html__( 'Portfolio item description will be under the image', 'portum' ),
					'type'        => 'epsilon-toggle',
					'default'     => false,
				),
				'portfolio_image_lightbox'    => array(
					'label'       => esc_html__( 'Show items in lightbox', 'portum' ),
					'description' => esc_html__( 'Toggling this to ON will display all images in a lightbox', 'portum' ),
					'type'        => 'epsilon-toggle',
					'default'     => true,
				),
				'portfolio_repeater_field'    => array(
					'type'    => 'hidden',
					'default' => 'portum_portfolio',
				),
				'portfolio_section_unique_id' => array(
					'label'             => esc_html__( 'Section ID', 'portum' ),
					'type'              => 'text',
					'sanitize_callback' => 'sanitize_key',
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
			'id'            => 'expertise',
			'title'         => esc_html__( 'Expertise', 'portum' ),
			'description'   => esc_html__( 'Expertise section. It retrieves content from Theme Content / Portfolio', 'portum' ),
			'image'         => esc_url( get_template_directory_uri() . '/assets/images/sections/ewf-icon-section-expertise-pt.png' ),
			'customization' => array(
				'enabled' => true,
				'layout'  => array(
					'row-title-align'           => array(
						'default' => 'left',
						'choices' => array( 'left', 'right' ),
					),
					'column-stretch'            => array(
						'default' => 'boxedin',
						'choices' => array( 'boxedcenter', 'boxedin', 'fullwidth' ),
					),
					'row-spacing-top'           => array(
						'default' => 'md',
						'choices' => array( 'lg', 'md', 'sm', 'none' ),
					),
					'row-spacing-bottom'        => array(
						'default' => 'md',
						'choices' => array( 'lg', 'md', 'sm', 'none' ),
					),
					'column-alignment'          => array(
						'default' => 'left',
						'choices' => array( 'left', 'center', 'right' ),
					),
					'column-vertical-alignment' => array(
						'default' => 'middle',
						'choices' => array( 'top', 'middle', 'bottom' ),
					),
				),
				'styling' => array(
					'background-color'    => array(
						'default' => false,
					),
					'background-image'    => array(
						'default' => false,
					),
					'background-position' => array(
						'default' => 'center',
					),
					'background-size'     => array(
						'default' => 'initial',
					),
					'background-repeat'   => array(
						'default' => 'repeat',
					),
					'background-parallax' => array(
						'default' => false,
					),
					'background-video'    => array(
						'default' => '',
					),
				),
				'colors'  => array(
					'heading-color' => array(
						'selectors' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', '.headline span' ),
						'default'   => '',
					),
					'text-color'    => array(
						'selectors' => array( 'p' ),
						'default'   => '',
					),
				),
			),
			'fields'        => array(
				'expertise_title'             => array(
					'label'             => esc_html__( 'Title', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'We can take your business to the next level', 'portum' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'expertise_subtitle'          => array(
					'label'             => esc_html__( 'Subtitle', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'OUR EXPERTISE', 'portum' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'expertise_image'             => array(
					'label'   => esc_html__( 'Section Image', 'portum' ),
					'type'    => 'epsilon-image',
					'size'    => 'original',
					'default' => esc_url( get_template_directory_uri() . '/assets/images/expertise-img-01.jpg' ),
				),
				'expertise_grouping'          => array(
					'label'       => esc_html__( 'Filter shown items', 'portum' ),
					'description' => esc_html__( 'The items you select in here are the only ones which will be displayed on this page. Think of the information you create in a section similar to a blog post. They are all created in a single place, but filtered by category. If you want to use multiple sections and display different information in each of them, use the filtering. ', 'portum' ),
					'type'        => 'selectize',
					'multiple'    => true,
					'choices'     => Portum_Helper::get_group_values_from_meta( 'portum_expertise', 'expertise_title' ),
					'default'     => array( 'all' ),
				),
				'expertise_navigation'        => array(
					'type'            => 'epsilon-customizer-navigation',
					'opensDoubled'    => true,
					'navigateToId'    => 'portum_expertise_section',
					'navigateToLabel' => esc_html__( 'Add/Edit Expertise &rarr;', 'portum' ),
				),
				'expertise_repeater_field'    => array(
					'type'    => 'hidden',
					'default' => 'portum_expertise',
				),
				'expertise_section_unique_id' => array(
					'label'             => esc_html__( 'Section ID', 'portum' ),
					'type'              => 'text',
					'sanitize_callback' => 'sanitize_key',
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
			'id'            => 'blog',
			'title'         => esc_html__( 'Blog Area', 'portum' ),
			'description'   => esc_html__( 'Blog Area Section', 'portum' ),
			'image'         => esc_url( get_template_directory_uri() . '/assets/images/sections/ewf-icon-section-blog-pt.png' ),
			'customization' => array(
				'enabled' => true,
				'layout'  => array(
					'row-spacing-top'    => array(
						'default' => 'md',
						'choices' => array( 'lg', 'md', 'sm', 'none' ),
					),
					'row-spacing-bottom' => array(
						'default' => 'md',
						'choices' => array( 'lg', 'md', 'sm', 'none' ),
					),
				),
				'styling' => array(
					'background-color'    => array(
						'default' => false,
					),
					'background-image'    => array(
						'default' => false,
					),
					'background-position' => array(
						'default' => 'center',
					),
					'background-size'     => array(
						'default' => 'initial',
					),
					'background-repeat'   => array(
						'default' => 'repeat',
					),
					'background-parallax' => array(
						'default' => false,
					),
					'background-video'    => array(
						'default' => '',
					),
				),
				'colors'  => array(
					'heading-color' => array(
						'selectors' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', '.headline span' ),
						'default'   => '',
					),
					'text-color'    => array(
						'selectors' => array( 'p' ),
						'default'   => '',
					),
				),
			),
			'fields'        => array(
				'blog_title'             => array(
					'label'             => esc_html__( 'Title', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'Find out the latest news?', 'portum' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'blog_subtitle'          => array(
					'label'             => esc_html__( 'Subtitle', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'BLOG', 'portum' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'blog_post_count'        => array(
					'label'       => esc_html__( 'Post Count', 'portum' ),
					'description' => esc_html__( 'Only posts with featured image are loaded', 'portum' ),
					'type'        => 'epsilon-slider',
					'default'     => 3,
					'choices'     => array(
						'min' => 1,
						'max' => 10,
					),
				),
				'blog_section_unique_id' => array(
					'label'             => esc_html__( 'Section ID', 'portum' ),
					'type'              => 'text',
					'sanitize_callback' => 'sanitize_key',
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
			'id'            => 'team',
			'title'         => esc_html__( 'Team', 'portum' ),
			'description'   => esc_html__( 'Team members section. It retrieves content from Theme Content / Portfolio', 'portum' ),
			'image'         => esc_url( get_template_directory_uri() . '/assets/images/sections/ewf-icon-section-team-pt.png' ),
			'customization' => array(
				'enabled' => true,
				'layout'  => array(
					'row-title-align'           => array(
						'default' => 'top',
						'choices' => array( 'left', 'top', 'right' ),
					),
					'row-spacing-top'           => array(
						'default' => 'md',
						'choices' => array( 'lg', 'md', 'sm', 'none' ),
					),
					'row-spacing-bottom'        => array(
						'default' => 'md',
						'choices' => array( 'lg', 'md', 'sm', 'none' ),
					),
					'column-alignment'          => array(
						'default' => 'center',
						'choices' => array( 'left', 'center', 'right' ),
					),
					'column-vertical-alignment' => array(
						'default' => 'middle',
						'choices' => array( 'top', 'middle', 'bottom' ),
					),
				),
				'styling' => array(
					'background-color'    => array(
						'default' => false,
					),
					'background-image'    => array(
						'default' => false,
					),
					'background-position' => array(
						'default' => 'center',
					),
					'background-size'     => array(
						'default' => 'initial',
					),
					'background-repeat'   => array(
						'default' => 'repeat',
					),
					'background-parallax' => array(
						'default' => false,
					),
					'background-video'    => array(
						'default' => '',
					),
				),
				'colors'  => array(
					'heading-color' => array(
						'selectors' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', '.headline span' ),
						'default'   => '',
					),
					'text-color'    => array(
						'selectors' => array( 'p' ),
						'default'   => '',
					),
				),
			),
			'fields'        => array(
				'team_title'             => array(
					'label'             => esc_html__( 'Title', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'Meet the people behind the scene', 'portum' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'team_subtitle'          => array(
					'label'             => esc_html__( 'Subtitle', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'TEAM', 'portum' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'team_grouping'          => array(
					'label'       => esc_html__( 'Filter shown members', 'portum' ),
					'description' => esc_html__( 'The items you select in here are the only ones which will be displayed on this page. Think of the information you create in a section similar to a blog post. They are all created in a single place, but filtered by category. If you want to use multiple sections and display different information in each of them, use the filtering. ', 'portum' ),
					'type'        => 'selectize',
					'multiple'    => true,
					'choices'     => Portum_Helper::get_group_values_from_meta( 'portum_team_members', 'member_title' ),
					'default'     => array( 'all' ),
				),
				'team_navigation'        => array(
					'type'            => 'epsilon-customizer-navigation',
					'opensDoubled'    => true,
					'navigateToId'    => 'portum_team_members_section',
					'navigateToLabel' => esc_html__( 'Add/Edit Members &rarr;', 'portum' ),
				),
				'team_repeater_field'    => array(
					'type'    => 'hidden',
					'default' => 'portum_team_members',
				),
				'team_section_unique_id' => array(
					'label'             => esc_html__( 'Section ID', 'portum' ),
					'type'              => 'text',
					'sanitize_callback' => 'sanitize_key',
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
			'id'            => 'pricing',
			'title'         => esc_html__( 'Pricing', 'portum' ),
			'description'   => esc_html__( 'Pricing section. It retrieves content from Theme Content / Pricing', 'portum' ),
			'image'         => esc_url( get_template_directory_uri() . '/assets/images/sections/ewf-icon-section-pricing-pt.png' ),
			'customization' => array(
				'enabled' => true,
				'layout'  => array(
					'column-stretch'     => array(
						'default' => 'boxedin',
						'choices' => array( 'boxedcenter', 'boxedin', 'fullwidth' ),
					),
					'row-spacing-top'    => array(
						'default' => 'md',
						'choices' => array( 'lg', 'md', 'sm', 'none' ),
					),
					'row-spacing-bottom' => array(
						'default' => 'md',
						'choices' => array( 'lg', 'md', 'sm', 'none' ),
					),
					'column-group'       => array(
						'default' => 3,
						'choices' => array( 2, 3, 4 ),
					),
				),
				'styling' => array(
					'background-color'    => array(
						'default' => false,
					),
					'background-image'    => array(
						'default' => false,
					),
					'background-position' => array(
						'default' => 'center',
					),
					'background-size'     => array(
						'default' => 'initial',
					),
					'background-repeat'   => array(
						'default' => 'repeat',
					),
					'background-parallax' => array(
						'default' => false,
					),
					'background-video'    => array(
						'default' => '',
					),
				),
				'colors'  => array(
					'heading-color' => array(
						'selectors' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', '.headline span' ),
						'default'   => '',
					),
					'text-color'    => array(
						'selectors' => array( 'p' ),
						'default'   => '',
					),
				),
			),
			'fields'        => array(
				'pricing_title'             => array(
					'label'             => esc_html__( 'Title', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'See what package suits best for you', 'portum' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'pricing_subtitle'          => array(
					'label'             => esc_html__( 'Subtitle', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'PRICING', 'portum' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'pricing_grouping'          => array(
					'label'       => esc_html__( 'Filter shown pricing tables', 'portum' ),
					'description' => esc_html__( 'The items you select in here are the only ones which will be displayed on this page. Think of the information you create in a section similar to a blog post. They are all created in a single place, but filtered by category. If you want to use multiple sections and display different information in each of them, use the filtering. ', 'portum' ),
					'type'        => 'selectize',
					'multiple'    => true,
					'choices'     => Portum_Helper::get_group_values_from_meta( 'portum_price_boxes', 'price_box_title' ),
					'default'     => array( 'all' ),
				),
				'pricing_navigation'        => array(
					'type'            => 'epsilon-customizer-navigation',
					'opensDoubled'    => true,
					'navigateToId'    => 'portum_pricing_section',
					'navigateToLabel' => esc_html__( 'Add/Edit Price Boxes &rarr;', 'portum' ),
				),
				'pricing_repeater_field'    => array(
					'type'    => 'hidden',
					'default' => 'portum_price_boxes',
				),
				'pricing_section_unique_id' => array(
					'label'             => esc_html__( 'Section ID', 'portum' ),
					'type'              => 'text',
					'sanitize_callback' => 'sanitize_key',
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
			'id'            => 'video',
			'title'         => esc_html__( 'Video', 'portum' ),
			'description'   => esc_html__( 'A section witch allows you to add a video', 'portum' ),
			'image'         => esc_url( get_template_directory_uri() . '/assets/images/sections/ewf-icon-section-video-pt.png' ),
			'customization' => array(
				'enabled' => true,
				'layout'  => array(
					'row-title-align'           => array(
						'default' => 'top',
						'choices' => array( 'left', 'top', 'right' ),
					),
					'column-stretch'            => array(
						'default' => 'boxedin',
						'choices' => array( 'boxedcenter', 'boxedin', 'fullwidth' ),
					),
					'row-spacing-top'           => array(
						'default' => 'md',
						'choices' => array( 'lg', 'md', 'sm', 'none' ),
					),
					'row-spacing-bottom'        => array(
						'default' => 'md',
						'choices' => array( 'lg', 'md', 'sm', 'none' ),
					),
					'column-alignment'          => array(
						'default' => 'center',
						'choices' => array( 'left', 'center', 'right' ),
					),
					'column-vertical-alignment' => array(
						'default' => 'middle',
						'choices' => array( 'top', 'middle', 'bottom' ),
					),
				),
				'styling' => array(
					'background-color'    => array(
						'default' => false,
					),
					'background-image'    => array(
						'default' => false,
					),
					'background-position' => array(
						'default' => 'center',
					),
					'background-size'     => array(
						'default' => 'initial',
					),
					'background-repeat'   => array(
						'default' => 'repeat',
					),
					'background-parallax' => array(
						'default' => false,
					),
				),
				'colors'  => array(
					'heading-color' => array(
						'selectors' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', '.headline span' ),
						'default'   => '',
					),
					'text-color'    => array(
						'selectors' => array( 'p' ),
						'default'   => '',
					),
				),
			),
			'fields'        => array(
				'video_title'             => array(
					'label'             => esc_html__( 'Title', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'Video section title', 'portum' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'video_subtitle'          => array(
					'label'             => esc_html__( 'Description', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'Video description', 'portum' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'video_id'                => array(
					'label'             => esc_html__( 'Video URL', 'portum' ),
					'description'       => esc_html__( 'Paste the URL of your video ( YouTube or Vimeo )', 'portum' ),
					'type'              => 'text',
					'default'           => 'https://www.youtube.com/watch?v=pjTj-_55WZ8',
					'sanitize_callback' => 'esc_url_raw',
				),
				'video_text'              => array(
					'label'             => esc_html__( 'Information', 'portum' ),
					'type'              => 'epsilon-text-editor',
					'default'           => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris lacinia velit quis sem dignissim porta. Aliquam risus lorem, ornare sed diam at, ultrices vehicula enim. Morbi pharetra ligula nulla, non blandit velit tempor vel.', 'portum' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'video_section_unique_id' => array(
					'label'             => esc_html__( 'Section ID', 'portum' ),
					'type'              => 'text',
					'sanitize_callback' => 'sanitize_key',
				),
			),
		);
	}

	/**
	 * Repeatable shortcodes section
	 *
	 * @return array
	 */
	private function repeatable_shortcodes() {
		return array(
			'id'            => 'shortcodes',
			'title'         => esc_html__( 'Shortcodes', 'portum' ),
			'description'   => esc_html__( 'A section in which you can add your own shortcodes to display in the frontend.', 'portum' ),
			'image'         => esc_url( get_template_directory_uri() . '/assets/images/sections/ewf-icon-section-shortcode-pt.png' ),
			'customization' => array(
				'enabled' => true,
				'layout'  => array(
					'row-title-align'           => array(
						'default' => 'top',
						'choices' => array( 'left', 'top', 'right' ),
					),
					'column-stretch'            => array(
						'default' => 'boxedin',
						'choices' => array( 'boxedcenter', 'boxedin', 'fullwidth' ),
					),
					'row-spacing-top'           => array(
						'default' => 'md',
						'choices' => array( 'lg', 'md', 'sm', 'none' ),
					),
					'row-spacing-bottom'        => array(
						'default' => 'md',
						'choices' => array( 'lg', 'md', 'sm', 'none' ),
					),
					'column-alignment'          => array(
						'default' => 'center',
						'choices' => array( 'left', 'center', 'right' ),
					),
					'column-vertical-alignment' => array(
						'default' => 'middle',
						'choices' => array( 'top', 'middle', 'bottom' ),
					),
				),
				'styling' => array(
					'background-color'    => array(
						'default' => false,
					),
					'background-image'    => array(
						'default' => false,
					),
					'background-position' => array(
						'default' => 'center',
					),
					'background-size'     => array(
						'default' => 'initial',
					),
					'background-repeat'   => array(
						'default' => 'repeat',
					),
					'background-parallax' => array(
						'default' => false,
					),
					'background-video'    => array(
						'default' => '',
					),
				),
				'colors'  => array(
					'heading-color' => array(
						'selectors' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', '.headline span' ),
						'default'   => '',
					),
					'text-color'    => array(
						'selectors' => array( 'p' ),
						'default'   => '',
					),
				),
			),
			'fields'        => array(
				'shortcodes_title'             => array(
					'label'             => esc_html__( 'Title', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'Section title', 'portum' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'shortcodes_subtitle'          => array(
					'label'             => esc_html__( 'Description', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'Section description', 'portum' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'shortcodes_text'              => array(
					'label'             => esc_html__( 'Extra text', 'portum' ),
					'type'              => 'epsilon-text-editor',
					'default'           => null,
					'sanitize_callback' => 'wp_kses_post',
				),
				'shortcodes_field'             => array(
					'label'             => esc_html__( 'Shortcode', 'portum' ),
					'type'              => 'textarea',
					'default'           => '',
					'sanitize_callback' => 'wp_kses_post',
				),
				'shortcodes_section_unique_id' => array(
					'label'             => esc_html__( 'Section ID', 'portum' ),
					'type'              => 'text',
					'sanitize_callback' => 'sanitize_key',
				),
			),
		);
	}

	/**
	 * Contact map and boxes
	 *
	 * @return array
	 */
	private function repeatable_google_map() {
		return array(
			'id'            => 'google_map',
			'title'         => esc_html__( 'Google Maps', 'portum' ),
			'description'   => esc_html__( 'A Google Map section', 'portum' ),
			'image'         => esc_url( get_template_directory_uri() . '/assets/images/sections/ewf-icon-section-map-pt.png' ),
			'customization' => array(
				'enabled' => true,
				'layout'  => array(
					'row-title-align'           => array(
						'default' => 'top',
						'choices' => array( 'left', 'top', 'right' ),
					),
					'column-stretch'            => array(
						'default' => 'boxedin',
						'choices' => array( 'boxedcenter', 'boxedin', 'fullwidth' ),
					),
					'column-group'              => array(
						'default' => 3,
						'choices' => array( 1, 2, 3, 4 ),
					),
					'row-spacing-top'           => array(
						'default' => 'md',
						'choices' => array( 'lg', 'md', 'sm', 'none' ),
					),
					'row-spacing-bottom'        => array(
						'default' => 'md',
						'choices' => array( 'lg', 'md', 'sm', 'none' ),
					),
					'column-alignment'          => array(
						'default' => 'center',
						'choices' => array( 'left', 'center', 'right' ),
					),
					'column-vertical-alignment' => array(
						'default' => 'middle',
						'choices' => array( 'top', 'middle', 'bottom' ),
					),
				),
				'styling' => array(
					'background-color'    => array(
						'default' => false,
					),
					'background-image'    => array(
						'default' => false,
					),
					'background-position' => array(
						'default' => 'center',
					),
					'background-size'     => array(
						'default' => 'initial',
					),
					'background-repeat'   => array(
						'default' => 'repeat',
					),
					'background-parallax' => array(
						'default' => false,
					),
					'background-video'    => array(
						'default' => '',
					),
				),
				'colors'  => array(
					'heading-color' => array(
						'selectors' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', '.headline span' ),
						'default'   => '',
					),
					'text-color'    => array(
						'selectors' => array( 'p' ),
						'default'   => '',
					),
				),
			),
			'fields'        => array(
				'google_map_title'             => array(
					'label'             => esc_html__( 'Title', 'portum' ),
					'description'       => esc_html__( 'Section title. Remove it for a cleaner look.', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'How can we help you?', 'portum' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'google_map_subtitle'          => array(
					'label'             => esc_html__( 'Subtitle', 'portum' ),
					'description'       => esc_html__( 'Section sub-title. Remove it for a cleaner look.', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'CONTACT', 'portum' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'google_map_grouping'          => array(
					'label'       => esc_html__( 'Filter shown content', 'portum' ),
					'description' => esc_html__( 'The items you select in here are the only ones which will be displayed on this page. Think of the information you create in a section similar to a blog post. They are all created in a single place, but filtered by category. If you want to use multiple sections and display different information in each of them, use the filtering functionality to achieve this.  ', 'portum' ),
					'type'        => 'selectize',
					'multiple'    => true,
					'choices'     => Portum_Helper::get_group_values_from_meta( 'portum_contact_section', 'contact_title' ),
					'default'     => array( 'all' ),
				),
				'google_map_address'           => array(
					'label'             => esc_html__( 'Google Maps Street Address', 'portum' ),
					'description'       => esc_html__( 'Only your street address is required to get Google Maps to work. We\'ve built behind the scenes logic that take a physical address and convert it into lat & long coordinates for Google Maps. ', 'portum' ),
					'type'              => 'text',
					'default'           => 'New York City',
					'sanitize_callback' => 'sanitize_text_field',
				),
				'google_map_zoom'              => array(
					'type'        => 'epsilon-slider',
					'label'       => esc_html__( 'Google Maps Zoom Level', 'portum' ),
					'description' => esc_html__( 'Play around with this value until you reach a comfortable level. Increasing the level of the zoom will allow your visitors to get a better view of the surrounding streets', 'portum' ),
					'default'     => 16,
					'choices'     => array(
						'min'  => 1,
						'max'  => 20,
						'step' => 1,
					),
				),
				'google_map_height'            => array(
					'type'        => 'epsilon-slider',
					'label'       => esc_html__( 'Google Maps Height', 'portum' ),
					'description' => esc_html__( 'Play around with this value until you are happy with the map height', 'portum' ),
					'default'     => 450,
					'choices'     => array(
						'min'  => 120,
						'max'  => 850,
						'step' => 10,
					),
				),
				'google_map_api_key'           => array(
					'type'            => 'epsilon-customizer-navigation',
					'navigateToId'    => 'portum_misc_section',
					'navigateToLabel' => esc_html__( 'Add Your API Key &rarr;', 'portum' ),
				),
				'google_map_navigation'        => array(
					'type'            => 'epsilon-customizer-navigation',
					'opensDoubled'    => true,
					'navigateToId'    => 'portum_contact_section',
					'navigateToLabel' => esc_html__( 'Add/Edit Contact Boxes &rarr;', 'portum' ),
				),
				'google_map_repeater_field'    => array(
					'type'    => 'hidden',
					'default' => 'portum_contact_section',
				),
				'google_map_section_unique_id' => array(
					'label'             => esc_html__( 'Section ID', 'portum' ),
					'type'              => 'text',
					'sanitize_callback' => 'sanitize_key',
				),
			),
		);
	}

	/**
	 * Repeatable Counter Section
	 *
	 * @return array
	 */
	private function repeatable_counters() {
		return array(
			'id'            => 'counters',
			'title'         => esc_html__( 'Counters', 'portum' ),
			'description'   => esc_html__( 'A section in which you can add your website counters.', 'portum' ),
			'image'         => esc_url( get_template_directory_uri() . '/assets/images/sections/ewf-icon-section-counter-pt.png' ),
			'customization' => array(
				'enabled' => true,
				'layout'  => array(
					'row-title-align'           => array(
						'default' => 'top',
						'choices' => array( 'left', 'top', 'right' ),
					),
					'column-stretch'            => array(
						'default' => 'boxedin',
						'choices' => array( 'boxedcenter', 'boxedin', 'fullwidth' ),
					),
					'row-spacing-top'           => array(
						'default' => 'md',
						'choices' => array( 'lg', 'md', 'sm', 'none' ),
					),
					'row-spacing-bottom'        => array(
						'default' => 'md',
						'choices' => array( 'lg', 'md', 'sm', 'none' ),
					),
					'column-group'              => array(
						'default' => 4,
						'choices' => array( 2, 3, 4 ),
					),
					'column-alignment'          => array(
						'default' => 'center',
						'choices' => array( 'left', 'center', 'right' ),
					),
					'column-vertical-alignment' => array(
						'default' => 'middle',
						'choices' => array( 'top', 'middle', 'bottom' ),
					),
				),
				'styling' => array(
					'background-color'    => array(
						'default' => false,
					),
					'background-image'    => array(
						'default' => false,
					),
					'background-position' => array(
						'default' => 'center',
					),
					'background-size'     => array(
						'default' => 'initial',
					),
					'background-repeat'   => array(
						'default' => 'repeat',
					),
					'background-parallax' => array(
						'default' => false,
					),
					'background-video'    => array(
						'default' => '',
					),
				),
				'colors'  => array(
					'heading-color' => array(
						'selectors' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', '.headline span' ),
						'default'   => '',
					),
					'text-color'    => array(
						'selectors' => array( 'p' ),
						'default'   => '',
					),
				),
			),
			'fields'        => array(
				'counters_title'             => array(
					'label'             => esc_html__( 'Title', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'Check out our counters!', 'portum' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'counters_subtitle'          => array(
					'label'             => esc_html__( 'Subtitle', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'COUNTERS', 'portum' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'counters_grouping'          => array(
					'label'       => esc_html__( 'Filter shown content', 'portum' ),
					'description' => esc_html__( 'The items you select in here are the only ones which will be displayed on this page. Think of the information you create in a section similar to a blog post. They are all created in a single place, but filtered by category. If you want to use multiple sections and display different information in each of them, use the filtering. ', 'portum' ),
					'type'        => 'selectize',
					'multiple'    => true,
					'choices'     => Portum_Helper::get_group_values_from_meta( 'portum_counter_boxes', 'counter_title' ),
					'default'     => array( 'all' ),
				),
				'counters_navigation'        => array(
					'type'            => 'epsilon-customizer-navigation',
					'opensDoubled'    => true,
					'navigateToId'    => 'portum_counters_section',
					'navigateToLabel' => esc_html__( 'Add/Edit Counter Boxes &rarr;', 'portum' ),
				),
				'counters_repeater_field'    => array(
					'type'    => 'hidden',
					'default' => 'portum_counter_boxes',
				),
				'counters_section_unique_id' => array(
					'label'             => esc_html__( 'Section ID', 'portum' ),
					'type'              => 'text',
					'sanitize_callback' => 'sanitize_key',
				),
			),
		);
	}

	/**
	 * Repeatable progress bars
	 *
	 * @return array
	 */
	private function repeatable_progress() {
		return array(
			'id'            => 'progress',
			'title'         => esc_html__( 'Progress', 'portum' ),
			'description'   => esc_html__( 'A section in which you can add your website counters.', 'portum' ),
			'image'         => esc_url( get_template_directory_uri() . '/assets/images/sections/ewf-icon-section-progress-pt.png' ),
			'customization' => array(
				'enabled' => true,
				'layout'  => array(
					'row-title-align'           => array(
						'default' => 'top',
						'choices' => array( 'left', 'top', 'right' ),
					),
					'column-stretch'            => array(
						'default' => 'boxedin',
						'choices' => array( 'boxedcenter', 'boxedin', 'fullwidth' ),
					),
					'row-spacing-top'           => array(
						'default' => 'md',
						'choices' => array( 'lg', 'md', 'sm', 'none' ),
					),
					'row-spacing-bottom'        => array(
						'default' => 'md',
						'choices' => array( 'lg', 'md', 'sm', 'none' ),
					),
					'column-group'              => array(
						'default' => 4,
						'choices' => array( 2, 3, 4 ),
					),
					'column-alignment'          => array(
						'default' => 'center',
						'choices' => array( 'left', 'center', 'right' ),
					),
					'column-vertical-alignment' => array(
						'default' => 'top',
						'choices' => array( 'top', 'middle', 'bottom' ),
					),
				),
				'styling' => array(
					'background-color'    => array(
						'default' => false,
					),
					'background-image'    => array(
						'default' => false,
					),
					'background-position' => array(
						'default' => 'center',
					),
					'background-size'     => array(
						'default' => 'initial',
					),
					'background-repeat'   => array(
						'default' => 'repeat',
					),
					'background-parallax' => array(
						'default' => false,
					),
					'background-video'    => array(
						'default' => '',
					),
				),
				'colors'  => array(
					'heading-color' => array(
						'selectors' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', '.headline span' ),
						'default'   => '',
					),
					'text-color'    => array(
						'selectors' => array( 'p' ),
						'default'   => '',
					),
				),
			),
			'fields'        => array(
				'progress_bars_title'          => array(
					'label'             => esc_html__( 'Title', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'See our growth', 'portum' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'progress_bars_subtitle'       => array(
					'label'             => esc_html__( 'Subtitle', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'PROGRESS BARS', 'portum' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'progress_bars_grouping'       => array(
					'label'       => esc_html__( 'Filter shown content', 'portum' ),
					'description' => esc_html__( 'Only selected items will be shown in the frontend.', 'portum' ),
					'type'        => 'selectize',
					'multiple'    => true,
					'choices'     => Portum_Helper::get_group_values_from_meta( 'portum_progress_bars', 'progress_bar_title' ),
					'default'     => array( 'all' ),
				),
				'progress_bars_navigation'     => array(
					'type'            => 'epsilon-customizer-navigation',
					'opensDoubled'    => true,
					'navigateToId'    => 'portum_progress_bars_section',
					'navigateToLabel' => esc_html__( 'Add/Edit Progress Bar Boxes &rarr;', 'portum' ),
				),
				'progress_bars_repeater_field' => array(
					'type'    => 'hidden',
					'default' => 'portum_progress_bars',
				),
				'progress_section_unique_id'   => array(
					'label'             => esc_html__( 'Section ID', 'portum' ),
					'type'              => 'text',
					'sanitize_callback' => 'sanitize_key',
				),
			),
		);
	}

	/**
	 * Repeatable progress bars
	 *
	 * @return array
	 */
	private function repeatable_piecharts() {
		return array(
			'id'            => 'piecharts',
			'title'         => esc_html__( 'Piecharts', 'portum' ),
			'description'   => esc_html__( 'A section in which you can add your website counters.', 'portum' ),
			'image'         => esc_url( get_template_directory_uri() . '/assets/images/sections/ewf-icon-section-piechart-pt.png' ),
			'customization' => array(
				'enabled' => true,
				'layout'  => array(
					'row-title-align'           => array(
						'default' => 'top',
						'choices' => array( 'left', 'top', 'right' ),
					),
					'column-stretch'            => array(
						'default' => 'boxedin',
						'choices' => array( 'boxedcenter', 'boxedin', 'fullwidth' ),
					),
					'row-spacing-top'           => array(
						'default' => 'md',
						'choices' => array( 'lg', 'md', 'sm', 'none' ),
					),
					'row-spacing-bottom'        => array(
						'default' => 'md',
						'choices' => array( 'lg', 'md', 'sm', 'none' ),
					),
					'column-group'              => array(
						'default' => 3,
						'choices' => array( 2, 3, 4 ),
					),
					'column-alignment'          => array(
						'default' => 'center',
						'choices' => array( 'left', 'center', 'right' ),
					),
					'column-vertical-alignment' => array(
						'default' => 'top',
						'choices' => array( 'top', 'middle', 'bottom' ),
					),
				),
				'styling' => array(
					'background-color'    => array(
						'default' => false,
					),
					'background-image'    => array(
						'default' => false,
					),
					'background-position' => array(
						'default' => 'center',
					),
					'background-size'     => array(
						'default' => 'initial',
					),
					'background-repeat'   => array(
						'default' => 'repeat',
					),
					'background-parallax' => array(
						'default' => false,
					),
					'background-video'    => array(
						'default' => '',
					),
				),
				'colors'  => array(
					'heading-color' => array(
						'selectors' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', '.headline span' ),
						'default'   => '',
					),
					'text-color'    => array(
						'selectors' => array( 'p' ),
						'default'   => '',
					),
				),
			),
			'fields'        => array(
				'piecharts_title'             => array(
					'label'             => esc_html__( 'Title', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'See our charts', 'portum' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'piecharts_subtitle'          => array(
					'label'             => esc_html__( 'Subtitle', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'PIECHARTS', 'portum' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'piecharts_grouping'          => array(
					'label'       => esc_html__( 'Filter shown content', 'portum' ),
					'description' => esc_html__( 'The items you select in here are the only ones which will be displayed on this page. Think of the information you create in a section similar to a blog post. They are all created in a single place, but filtered by category. If you want to use multiple sections and display different information in each of them, use the filtering. ', 'portum' ),
					'type'        => 'selectize',
					'multiple'    => true,
					'choices'     => Portum_Helper::get_group_values_from_meta( 'portum_pie_charts', 'piechart_title' ),
					'default'     => array( 'all' ),
				),
				'piecharts_navigation'        => array(
					'type'            => 'epsilon-customizer-navigation',
					'opensDoubled'    => true,
					'navigateToId'    => 'portum_piecharts_section',
					'navigateToLabel' => esc_html__( 'Add/Edit Piecharts Boxes &rarr;', 'portum' ),
				),
				'piecharts_repeater_field'    => array(
					'type'    => 'hidden',
					'default' => 'portum_pie_charts',
				),
				'piecharts_section_unique_id' => array(
					'label'             => esc_html__( 'Section ID', 'portum' ),
					'type'              => 'text',
					'sanitize_callback' => 'sanitize_key',
				),
			),
		);
	}

	/**
	 * Repeatable client list
	 *
	 * @return array
	 */
	private function repeatable_clientlist() {
		return array(
			'id'            => 'clientlist',
			'title'         => esc_html__( 'Client List', 'portum' ),
			'description'   => esc_html__( 'A section where you can add logos of your clients', 'portum' ),
			'image'         => esc_url( get_template_directory_uri() . '/assets/images/sections/ewf-icon-section-clients.png' ),
			'customization' => array(
				'enabled' => true,
				'layout'  => array(
					'column-stretch'     => array(
						'default' => 'boxedin',
						'choices' => array( 'boxedcenter', 'boxedin', 'fullwidth' ),
					),
					'row-spacing-top'    => array(
						'default' => 'md',
						'choices' => array( 'lg', 'md', 'sm', 'none' ),
					),
					'row-spacing-bottom' => array(
						'default' => 'md',
						'choices' => array( 'lg', 'md', 'sm', 'none' ),
					),
					'column-alignment'   => array(
						'default' => 'center',
						'choices' => array( 'left', 'center', 'right' ),
					),
				),
				'styling' => array(
					'background-color'    => array(
						'default' => false,
					),
					'background-image'    => array(
						'default' => false,
					),
					'background-position' => array(
						'default' => 'center',
					),
					'background-size'     => array(
						'default' => 'initial',
					),
					'background-repeat'   => array(
						'default' => 'repeat',
					),
					'background-parallax' => array(
						'default' => false,
					),
					'background-video'    => array(
						'default' => '',
					),
				),
				'colors'  => array(
					'heading-color' => array(
						'selectors' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', '.headline span' ),
						'default'   => '',
					),
					'text-color'    => array(
						'selectors' => array( 'p' ),
						'default'   => '',
					),
				),
			),
			'fields'        => array(
				'clientlist_title'             => array(
					'label'             => esc_html__( 'Title', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'See our clients', 'portum' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'clientlist_subtitle'          => array(
					'label'             => esc_html__( 'Subtitle', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'CLIENTS', 'portum' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'clientlist_grouping'          => array(
					'label'       => esc_html__( 'Filter shown clients', 'portum' ),
					'description' => esc_html__( 'The items you select in here are the only ones which will be displayed on this page. Think of the information you create in a section similar to a blog post. They are all created in a single place, but filtered by category. If you want to use multiple sections and display different information in each of them, use the filtering. ', 'portum' ),
					'type'        => 'selectize',
					'multiple'    => true,
					'choices'     => Portum_Helper::get_group_values_from_meta( 'portum_clients', 'client_title' ),
					'default'     => array( 'all' ),
				),
				'clientlist_slider'            => array(
					'label'   => esc_html__( 'Enable slider', 'portum' ),
					'type'    => 'epsilon-toggle',
					'default' => false,
				),
				'clientlist_navigation'        => array(
					'type'            => 'epsilon-customizer-navigation',
					'opensDoubled'    => true,
					'navigateToId'    => 'portum_clientlists_section',
					'navigateToLabel' => esc_html__( 'Add/Edit Client Logos &rarr;', 'portum' ),
				),
				'clientlist_repeater_field'    => array(
					'type'    => 'hidden',
					'default' => 'portum_clients',
				),
				'clientlist_section_unique_id' => array(
					'label'             => esc_html__( 'Section ID', 'portum' ),
					'type'              => 'text',
					'sanitize_callback' => 'sanitize_key',
				),
			),
		);
	}


	/**
	 * Repeatable client list
	 *
	 * @return array
	 */
	private function repeatable_cta() {
		return array(
			'id'            => 'cta',
			'title'         => esc_html__( 'Call To Action', 'portum' ),
			'description'   => esc_html__( 'A simple call to action section', 'portum' ),
			'image'         => esc_url( get_template_directory_uri() . '/assets/images/sections/ewf-icon-section-cta.png' ),
			'customization' => array(
				'enabled' => true,
				'layout'  => array(
					'row-title-align'           => array(
						'default' => 'left',
						'choices' => array( 'left', 'top', 'right' ),
					),
					'column-stretch'            => array(
						'default' => 'boxedin',
						'choices' => array( 'boxedcenter', 'boxedin', 'fullwidth' ),
					),
					'row-spacing-top'           => array(
						'default' => 'md',
						'choices' => array( 'lg', 'md', 'sm', 'none' ),
					),
					'row-spacing-bottom'        => array(
						'default' => 'md',
						'choices' => array( 'lg', 'md', 'sm', 'none' ),
					),
					'column-alignment'          => array(
						'default' => 'left',
						'choices' => array( 'left', 'center', 'right' ),
					),
					'column-vertical-alignment' => array(
						'default' => 'middle',
						'choices' => array( 'top', 'middle', 'bottom' ),
					),
				),
				'styling' => array(
					'background-color'    => array(
						'default' => false,
					),
					'background-image'    => array(
						'default' => false,
					),
					'background-position' => array(
						'default' => 'center',
					),
					'background-size'     => array(
						'default' => 'initial',
					),
					'background-repeat'   => array(
						'default' => 'repeat',
					),
					'background-parallax' => array(
						'default' => false,
					),
					'background-video'    => array(
						'default' => '',
					),
				),
				'colors'  => array(
					'heading-color' => array(
						'selectors' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', '.headline span' ),
						'default'   => '',
					),
					'text-color'    => array(
						'selectors' => array( 'p' ),
						'default'   => '',
					),
				),
			),
			'fields'        => array(
				'cta_title'                  => array(
					'label'             => esc_html__( 'Title', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'Call to action title', 'portum' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'cta_description'            => array(
					'label'             => esc_html__( 'Description', 'portum' ),
					'type'              => 'epsilon-text-editor',
					'default'           => esc_html__( 'Call to action text', 'portum' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'cta_button_primary_label'   => array(
					'label'             => esc_html__( 'Primary button label', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'Primary button', 'portum' ),
					'sanitize_callback' => 'sanitize_textfield',
				),
				'cta_button_primary_color'   => array(
					'label'   => esc_html__( 'Primary button color style', 'portum' ),
					'type'    => 'select',
					'default' => 'ewf-btn--color-default',
					'choices' => array(
						'ewf-btn--color-default' => __( 'White', 'portum' ),
						'ewf-btn--color-accent1' => __( 'Color Accent 1', 'portum' ),
						'ewf-btn--color-accent2' => __( 'Color Accent 2', 'portum' ),
					),
				),
				'cta_button_primary_url'     => array(
					'label'             => esc_html__( 'Primary button URL', 'portum' ),
					'type'              => 'text',
					'default'           => esc_url( 'https://google.com' ),
					'sanitize_callback' => 'esc_url_raw',
				),
				'cta_button_secondary_label' => array(
					'label'             => esc_html__( 'Secondary button label', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'Secondary button', 'portum' ),
					'sanitize_callback' => 'sanitize_textfield',
				),
				'cta_button_secondary_color' => array(
					'label'   => esc_html__( 'Secoondary button color style', 'portum' ),
					'type'    => 'select',
					'default' => 'ewf-btn--color-accent1',
					'choices' => array(
						'ewf-btn--color-default' => __( 'White', 'portum' ),
						'ewf-btn--color-accent1' => __( 'Color Accent 1', 'portum' ),
						'ewf-btn--color-accent2' => __( 'Color Accent 2', 'portum' ),
					),
				),
				'cta_button_secondary_url'   => array(
					'label'             => esc_html__( 'Secondary button URL', 'portum' ),
					'type'              => 'text',
					'default'           => esc_url( 'https://google.com' ),
					'sanitize_callback' => 'esc_url_raw',
				),
				'cta_section_unique_id'      => array(
					'label'             => esc_html__( 'Section ID', 'portum' ),
					'type'              => 'text',
					'sanitize_callback' => 'sanitize_key',
				),
			),
		);
	}

}
