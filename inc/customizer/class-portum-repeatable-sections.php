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
						'choices' => array( 'fullwidth', 'boxedin' ),
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

				),
				'colors'  => array(
					'heading-color' => array(
						'selectors' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' ),
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
	 * Render OpenHours section
	 *
	 * @return array
	 */
	private function repeatable_openhours() {
		return array(
			'id'            => 'openhours',
			'title'         => esc_html__( 'Open Hours Section', 'portum' ),
			'description'   => esc_html__( 'Your hospital schedule.', 'portum' ),
			'image'         => get_template_directory_uri() . '/assets/images/sections/ewf-icon-section-openhours.png',
			'customization' => array(
				'enabled' => true,
				'layout'  => array(
					'row-title-align'           => array(
						'default' => 'left',
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
					'column-stretch'            => array(
						'default' => 'boxedin',
						'choices' => array( 'fullwidth', 'boxedin' ),
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
						'default' => 'cover',
					),
					'background-repeat'   => array(
						'default' => 'np-repeat',
					),
					'background-parallax' => array(
						'default' => false,
					),

				),
				'colors'  => array(
					'heading-color' => array(
						'selectors' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' ),
						'default'   => '',
					),
					'text-color'    => array(
						'selectors' => array( 'p' ),
						'default'   => '',
					),
				),
			),
			'fields'        => array(
				'openhours_title'                => array(
					'label'             => esc_html__( 'Title', 'portum' ),
					'type'              => 'text',
					'default'           => wp_kses_post( 'Top notch experience' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'openhours_subtitle'             => array(
					'label'             => esc_html__( 'Subtitle', 'portum' ),
					'type'              => 'text',
					'default'           => wp_kses_post( 'We make it better' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'openhours_schedule_title'       => array(
					'label'             => esc_html__( 'Schedule Title', 'portum' ),
					'type'              => 'text',
					'default'           => wp_kses_post( 'Opening Hours' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'openhours_text'                 => array(
					'label'   => esc_html__( 'Description', 'portum' ),
					'type'    => 'textarea',
					'default' => wp_kses_post( 'Our specialist make sure you get the best care there is' ),
				),
				'openhours_color'                => array(
					'label'   => esc_html__( 'Open Hours Background Color', 'portum' ),
					'type'    => 'epsilon-color-picker',
					'default' => 'rgba(250,250,250,.1)',
				),
				'openhours_button_primary_label' => array(
					'label'             => esc_html__( 'Button label', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'CTA button', 'portum' ),
					'sanitize_callback' => 'sanitize_textfield',
				),
				'openhours_button_primary_color' => array(
					'label'      => esc_html__( 'Button color style', 'portum' ),
					'descriptin' => esc_html__( 'Color accent 1, 2 & Text color are the corresponding HEX color codes from Customization -> Colors.', 'portum' ),
					'type'       => 'select',
					'default'    => 'ewf-btn--color-accent3',
					'choices'    => array(
						'ewf-btn--color-default' => __( 'Text Color as background + White', 'portum' ),
						'ewf-btn--color-accent1' => __( 'Color Accent 1 as background + Text Color', 'portum' ),
						'ewf-btn--color-accent3' => __( 'Color Accent 1 as background + White', 'portum' ),
						'ewf-btn--color-accent2' => __( 'Color Accent 2 as background + Text Color', 'portum' ),
						'ewf-btn--color-accent4' => __( 'Color Accent 2 as background + White', 'portum' ),
					),
				),
				'openhours_button_primary_url'   => array(
					'label'             => esc_html__( 'Primary button URL', 'portum' ),
					'type'              => 'text',
					'default'           => esc_url( 'https://google.com' ),
					'sanitize_callback' => 'esc_url_raw',
				),
				'openhours_grouping'             => array(
					'label'       => esc_html__( 'Filter shown open hours schedule', 'portum' ),
					'description' => esc_html__( 'The items you select in here are the only ones which will be displayed on this page. Think of the information you create in a section similar to a blog post. They are all created in a single place, but filtered by category. If you want to use multiple sections and display different information in each of them, use the filtering. ', 'portum' ),
					'type'        => 'selectize',
					'multiple'    => true,
					'choices'     => Portum_Helper::get_group_values_from_meta( 'portum_schedule', 'schedule_days' ),
					'default'     => array( 'all' ),
				),
				'openhours_navigation'           => array(
					'type'            => 'epsilon-customizer-navigation',
					'opensDoubled'    => true,
					'navigateToId'    => 'portum_schedule_section',
					'navigateToLabel' => esc_html__( 'Add/edit schedule hours &rarr;', 'portum' ),
				),
				'openhours_section_unique_id'    => array(
					'label'             => esc_html__( 'Section ID', 'portum' ),
					'type'              => 'text',
					'sanitize_callback' => 'sanitize_key',
				),
				'openhours_repeater_field'       => array(
					'type'    => 'hidden',
					'default' => 'portum_schedule',
				),
			),
		);
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
					'column-stretch'            => array(
						'default' => 'boxedin',
						'choices' => array( 'fullwidth', 'boxedin' ),
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
						'default' => 2,
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

				),
				'colors'  => array(
					'heading-color' => array(
						'selectors' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' ),
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
				'testimonials_section_unique_id' => array(
					'label'             => esc_html__( 'Section ID', 'portum' ),
					'type'              => 'text',
					'sanitize_callback' => 'sanitize_key',
				),
				'testimonials_grouping'          => array(
					'label'       => esc_html__( 'Filter shown testimonials', 'portum' ),
					'description' => esc_html__( 'The items you select in here are the only ones which will be displayed on this page. Think of the information you create in a section similar to a blog post. They are all created in a single place, but filtered by category. If you want to use multiple sections and display different information in each of them, use the filtering. ', 'portum' ),
					'type'        => 'selectize',
					'multiple'    => true,
					'choices'     => Portum_Helper::get_group_values_from_meta( 'portum_testimonials', 'testimonial_title' ),
					'linking'     => array( 'portum_testimonials', 'testimonial_title' ),
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
				'slider_autostart'         => array(
					'label'       => esc_html__( 'Autostart', 'portum' ),
					'description' => esc_html__( 'Automatically start slider after page has finished loading.', 'portum' ),
					'type'        => 'epsilon-toggle',
					'default'     => true,
				),
				'slider_infinite'          => array(
					'label'       => esc_html__( 'Loop Slides', 'portum' ),
					'description' => esc_html__( 'When the slider reaches the last slide, it will automatically start again from the first one.', 'portum' ),
					'type'        => 'epsilon-toggle',
					'default'     => true,
				),
				'slider_pager'             => array(
					'label'       => esc_html__( 'Navigation Dots', 'portum' ),
					'description' => esc_html__( 'Show slider navigation dots', 'portum' ),
					'type'        => 'epsilon-toggle',
					'default'     => true,
				),
				'slider_controls'          => array(
					'label'       => esc_html__( 'Navigation Arrows', 'portum' ),
					'description' => esc_html__( 'Show prev/next arrows', 'portum' ),
					'type'        => 'epsilon-toggle',
					'default'     => true,
				),
				'slider_slides_shown'      => array(
					'label'   => esc_html__( 'Show this many slides', 'portum' ),
					'type'    => 'epsilon-slider',
					'default' => 1,
					'choices' => array(
						'min'  => 1,
						'max'  => 6,
						'step' => 1,
					),
				),
				'slider_slides_scrolled'   => array(
					'label'   => esc_html__( 'Slide this many items at once', 'portum' ),
					'type'    => 'epsilon-slider',
					'default' => 1,
					'choices' => array(
						'min'  => 1,
						'max'  => 6,
						'step' => 1,
					),
				),
				'slider_height'            => array(
					'label'       => esc_html__( 'Slider Vertical Height', 'portum' ),
					'description' => esc_html__( 'Value is in %. Where 50, actually means 50% of the entire height of the screen.', 'portum' ),
					'type'        => 'epsilon-slider',
					'default'     => 50,
					'choices'     => array(
						'min'  => 30,
						'max'  => 100,
						'step' => 5,
					),
				),
				'slider_speed'             => array(
					'label'       => esc_html__( 'Time Between Slides', 'portum' ),
					'description' => esc_html__( 'The higher the value, the slower the next slide will show.', 'portum' ),
					'type'        => 'epsilon-slider',
					'default'     => 500,
					'choices'     => array(
						'min'  => 300,
						'max'  => 2000,
						'step' => 100,
					),
				),
				'slider_advanced_grouping' => array(
					'label'       => esc_html__( 'Filter shown slides', 'portum' ),
					'description' => esc_html__( 'The items you select in here are the only ones which will be displayed on this page. Think of the information you create in a section similar to a blog post. They are all created in a single place, but filtered by category. If you want to use multiple sections and display different information in each of them, use the filtering. ', 'portum' ),
					'type'        => 'selectize',
					'multiple'    => true,
					'choices'     => Portum_Helper::get_group_values_from_meta( 'portum_advanced_slides', 'slide_title' ),
					'linking'     => array( 'portum_advanced_slides', 'slide_title' ),
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
						'choices' => array( 'fullwidth', 'boxedin' ),
					),
					'column-spacing'            => array(
						'default' => 'lg',
						'choices' => array( 'none', 'sm', 'md', 'lg' ),
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
				'services_item_style'              => array(
					'label'   => esc_html__( 'Style', 'portum' ),
					'type'    => 'select',
					'default' => 'ewf-item__no-effect',
					'choices' => array(
						'ewf-item__no-effect'            => esc_html__( 'No effect', 'portum' ),
						'ewf-item__border-dashed-effect' => esc_html__( 'Border Dashed Effect', 'portum' ),
						'ewf-item__shadow-effect'        => esc_html__( 'Bottom Shadow Effect', 'portum' ),
						'ewf-item__simple-border-effect' => esc_html__( 'Simple Border Effect', 'portum' ),
						'ewf-item__dash-of-color'        => esc_html__( 'Dash of Color Effect', 'portum' ),
					),
				),
				'services_item_style_color_picker' => array(
					'label'     => esc_html__( 'Item Style Color Picker', 'portum' ),
					'type'      => 'epsilon-color-picker',
					'default'   => '',
					'mode'      => 'hex',
					'condition' => array(
						'item_style',
						'ewf-item__border-dashed-effect',
					),
				),
				'services_title'                   => array(
					'label'             => esc_html__( 'Title', 'portum' ),
					'description'       => esc_html__( 'Section title', 'portum' ),
					'type'              => 'text',
					'default'           => wp_kses_post( 'We offer:' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'services_subtitle'                => array(
					'label'             => esc_html__( 'Subtitle', 'portum' ),
					'description'       => esc_html__( 'Section subtitle', 'portum' ),
					'type'              => 'text',
					'default'           => wp_kses_post( 'SERVICES' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'services_description'             => array(
					'label'             => esc_html__( 'Description', 'portum' ),
					'description'       => esc_html__( 'This works best in conjuction with left and right content layouts. Use it to shortly describe your services.', 'portum' ),
					'type'              => 'textarea',
					'default'           => esc_html__( 'Describe your services.', 'portum' ),
					'sanitize_callback' => 'wp_kses_post',
				),

				'services_slider'            => array(
					'label'   => esc_html__( 'Turn into a carousel', 'portum' ),
					'type'    => 'epsilon-toggle',
					'default' => false,
				),
				'services_slider_autostart'  => array(
					'label'     => esc_html__( 'Autostart', 'portum' ),
					'type'      => 'epsilon-toggle',
					'default'   => true,
					'condition' => array( 'services_slider', true ),
				),
				'services_slider_infinite'   => array(
					'label'     => esc_html__( 'Infinite slides', 'portum' ),
					'type'      => 'epsilon-toggle',
					'default'   => true,
					'condition' => array( 'services_slider', true ),
				),
				'services_slider_pager'      => array(
					'label'     => esc_html__( 'Navigation Dots', 'portum' ),
					'type'      => 'epsilon-toggle',
					'default'   => true,
					'condition' => array( 'services_slider', true ),
				),
				'services_slider_controls'   => array(
					'label'     => esc_html__( 'Navigation Arrows', 'portum' ),
					'type'      => 'epsilon-toggle',
					'default'   => false,
					'condition' => array( 'services_slider', true ),
				),
				'services_slider_speed'      => array(
					'label'       => esc_html__( 'Speed', 'portum' ),
					'description' => esc_html__( 'Carousel speed', 'portum' ),
					'type'        => 'epsilon-slider',
					'default'     => 500,
					'choices'     => array(
						'min'  => 300,
						'max'  => 2000,
						'step' => 100,
					),
					'condition'   => array( 'services_slider', true ),
				),
				'services_slides_shown'      => array(
					'label'       => esc_html__( 'No. of slides to show', 'portum' ),
					'description' => esc_html__( 'Total number of items to show at a time. ', 'portum' ),
					'type'        => 'epsilon-slider',
					'default'     => 6,
					'choices'     => array(
						'min'  => 1,
						'max'  => 12,
						'step' => 1,
					),
					'condition'   => array( 'services_slider', true ),
				),
				'services_slides_scrolled'   => array(
					'label'       => esc_html__( 'No. of slides to scroll ', 'portum' ),
					'description' => esc_html__( 'Number of items to scroll at a time. For hero sliders, this is kept at 1 slide at a time.', 'portum' ),
					'type'        => 'epsilon-slider',
					'default'     => 1,
					'choices'     => array(
						'min'  => 1,
						'max'  => 6,
						'step' => 1,
					),
					'condition'   => array( 'services_slider', true ),
				),
				'services_section_unique_id' => array(
					'label'             => esc_html__( 'Section ID', 'portum' ),
					'description'       => esc_html__( 'Section Unique ID. Useful if you are looking to target this particular section with CSS / jQuery. Very useful as well for creating the one-page effect with smooth scrolling to section.', 'portum' ),
					'type'              => 'text',
					'sanitize_callback' => 'sanitize_key',
				),
				'services_grouping'          => array(
					'label'       => esc_html__( 'Filter shown services', 'portum' ),
					'description' => esc_html__( 'The items you select in here are the only ones which will be displayed on this page. Think of the information you create in a section similar to a blog post. They are all created in a single place, but filtered by category. If you want to use multiple sections and display different information in each of them, use the filtering. ', 'portum' ),
					'type'        => 'selectize',
					'multiple'    => true,
					'choices'     => Portum_Helper::get_group_values_from_meta( 'portum_services', 'service_title' ),
					'linking'     => array( 'portum_services', 'service_title' ),
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
			'title'         => esc_html__( 'Image + text', 'portum' ),
			'description'   => esc_html__( 'Image & text section.', 'portum' ),
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
						'choices' => array( 'fullwidth', 'boxedin' ),
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

				),
				'colors'  => array(
					'heading-color' => array(
						'selectors' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' ),
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
					'type'              => 'textarea',
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
				'about_button_primary_color' => array(
					'label'      => esc_html__( 'Button color style', 'portum' ),
					'descriptin' => esc_html__( 'Color accent 1, 2 & Text color are the corresponding HEX color codes from Customization -> Colors.', 'portum' ),
					'type'       => 'select',
					'default'    => 'ewf-btn--color-default',
					'choices'    => array(
						'ewf-btn--color-default' => __( 'Text Color as background + White', 'portum' ),
						'ewf-btn--color-accent1' => __( 'Color Accent 1 as background + Text Color', 'portum' ),
						'ewf-btn--color-accent3' => __( 'Color Accent 1 as background + White', 'portum' ),
						'ewf-btn--color-accent2' => __( 'Color Accent 2 as background + Text Color', 'portum' ),
						'ewf-btn--color-accent4' => __( 'Color Accent 2 as background + White', 'portum' ),
					),
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
	 * Repeatable accordion section
	 *
	 * @return array
	 */
	private function repeatable_accordion() {
		return array(
			'id'            => 'accordion',
			'title'         => esc_html__( 'F.A.Q. Section', 'portum' ),
			'description'   => esc_html__( 'General information about your practices. It retrieves content from Theme Content / General information section.', 'portum' ),
			'image'         => get_template_directory_uri() . '/assets/images/sections/ewf-icon-section-faq.png',
			'customization' => array(
				'enabled' => true,
				'layout'  => array(
					'row-title-align'           => array(
						'default' => 'left',
						'choices' => array( 'left', 'top', 'right' ),
					),
					'column-stretch'            => array(
						'default' => 'boxedin',
						'choices' => array( 'fullwidth', 'boxedin' ),
					),
					'column-group'              => array(
						'default' => 1,
						'choices' => array( 1, 2 ),
					),
					'row-spacing-top'           => array(
						'default' => 'sm',
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

				),
				'colors'  => array(
					'heading-color' => array(
						'selectors' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' ),
						'default'   => '',
					),
					'text-color'    => array(
						'selectors' => array( 'p' ),
						'default'   => '',
					),
				),
			),
			'fields'        => array(
				'accordion_title'             => array(
					'label'             => esc_html__( 'Title', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'Why Choose us?', 'portum' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'accordion_subtitle'          => array(
					'label'             => esc_html__( 'Subtitle', 'portum' ),
					'type'              => 'text',
					'sanitize_callback' => 'wp_kses_post',
					'default'           => esc_html__( 'We are a great agency', 'portum' ),
				),
				'accordion_text'              => array(
					'label'             => esc_html__( 'Description', 'portum' ),
					'type'              => 'textarea',
					'sanitize_callback' => 'wp_kses_post',
					'default'           => esc_html__( 'Section description text goes here.', 'portum' ),
				),
				'accordion_section_unique_id' => array(
					'label'             => esc_html__( 'Section ID', 'portum' ),
					'type'              => 'text',
					'sanitize_callback' => 'sanitize_key',
				),
				'accordion_grouping'          => array(
					'label'       => esc_html__( 'Filter shown FAQ items', 'portum' ),
					'description' => esc_html__( 'The items you select in here are the only ones which will be displayed on this page. Think of the information you create in a section similar to a blog post. They are all created in a single place, but filtered by category. If you want to use multiple sections and display different information in each of them, use the filtering. ', 'portum' ),
					'type'        => 'selectize',
					'multiple'    => true,
					'choices'     => Portum_Helper::get_group_values_from_meta( 'portum_accordion', 'info_title' ),
					'linking'     => array( 'portum_accordion', 'info_title' ),
					'default'     => array( 'all' ),
				),
				'accordion_navigation'        => array(
					'type'            => 'epsilon-customizer-navigation',
					'opensDoubled'    => true,
					'navigateToId'    => 'portum_accordion_section',
					'navigateToLabel' => esc_html__( 'Add/Edit FAQ &rarr;', 'portum' ),
				),
				'accordion_repeater_field'    => array(
					'type'    => 'hidden',
					'default' => 'portum_accordion',
				),
			),
		);
	}


	/**
	 * Create appointment section
	 *
	 * @return array
	 */
	private function repeatable_appointment() {
		$arr = array(
			'id'            => 'contact',
			'title'         => esc_html__( 'Contact Section', 'portum' ),
			'description'   => esc_html__( 'Contact form section. You need to have a working Contact Form 7 form created.', 'portum' ),
			'integration'   => array(
				'status' => true,
				'plugin' => 'contact-form-7',
				'check'  => defined( 'WPCF7_VERSION' ),
			),
			'image'         => get_template_directory_uri() . '/assets/images/sections/ewf-icon-section-appointments.png',
			'customization' => array(
				'enabled' => true,
				'layout'  => array(
					'row-title-align'           => array(
						'default' => 'left',
						'choices' => array( 'left', 'top', 'right' ),
					),
					'column-stretch'            => array(
						'default' => 'boxedin',
						'choices' => array( 'fullwidth', 'boxedin' ),
					),
					'row-spacing-top'           => array(
						'default' => 'sm',
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
						'default' => 'cover',
					),
					'background-repeat'   => array(
						'default' => 'no-repeat',
					),
					'background-parallax' => array(
						'default' => false,
					),

				),
				'colors'  => array(
					'heading-color' => array(
						'selectors' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' ),
						'default'   => '',
					),
					'text-color'    => array(
						'selectors' => array( 'p' ),
						'default'   => '',
					),
				),
			),
			'fields'        => array(
				'contact_title'    => array(
					'label'             => esc_html__( 'Title', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'Get a quote', 'portum' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'contact_subtitle' => array(
					'label'             => esc_html__( 'Subtitle', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'Schedule a call', 'portum' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'contact_text'     => array(
					'label'   => esc_html__( 'Description', 'portum' ),
					'type'    => 'textarea',
					'default' => esc_html__( 'Now it is easy and fast and you can book a consult within minutes!', 'portum' ),
				),
				'contact_form'     => array(
					'label'       => esc_html__( 'Contact form', 'portum' ),
					'description' => esc_html__( 'You need to make sure you have a Contact Form7 form created for this section to work properly.', 'portum' ),
					'type'        => 'select',
					'choices'     => array(
						'' => __( 'Select a Contact7 form', 'portum' ),
					),
					'default'     => '',
				),
			),
		);

		if ( defined( 'WPCF7_VERSION' ) ) {
			/**
			 * Get cforms, populated contact_form
			 */
			$args = array(
				'post_type' => 'wpcf7_contact_form',
			);

			$posts = new WP_Query( $args );
			wp_reset_postdata();
			if ( $posts->have_posts() ) {
				while ( $posts->have_posts() ) {
					$posts->the_post();

					$arr['fields']['contact_form']['choices'][ get_the_ID() ] = get_the_title();
				}
			}
			wp_reset_query();
		}

		return $arr;
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
			'image'         => esc_url( get_template_directory_uri() . '/assets/images/sections/ewf-icon-section-portfolio-pt.png' ),
			'customization' => array(
				'enabled' => true,
				'layout'  => array(
					'row-title-align'           => array(
						'default' => 'top',
						'choices' => array( 'left', 'top', 'right' ),
					),
					'column-stretch'            => array(
						'default' => 'boxedin',
						'choices' => array( 'fullwidth', 'boxedin' ),
					),
					'row-spacing-top'           => array(
						'default' => 'md',
						'choices' => array( 'lg', 'md', 'sm', 'none' ),
					),
					'row-spacing-bottom'        => array(
						'default' => 'md',
						'choices' => array( 'lg', 'md', 'sm', 'none' ),
					),
					'column-spacing'            => array(
						'default' => 'lg',
						'choices' => array( 'none', 'sm', 'md', 'lg' ),
					),
					'column-group'              => array(
						'default' => 3,
						'choices' => array( 2, 3, 4 ),
					),
					'column-alignment'          => array(
						'default' => 'center',
					),
					'column-vertical-alignment' => array(
						'default' => 'middle',
					),
					'template-selector'         => array(
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
						'selectors' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' ),
						'default'   => '',
					),
					'text-color'    => array(
						'selectors' => array( 'p' ),
						'default'   => '',
					),
				),
			),
			'fields'        => array(
				'portfolio_title'                  => array(
					'label'             => esc_html__( 'Title', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'Check out our latest projects', 'portum' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'portfolio_subtitle'               => array(
					'label'             => esc_html__( 'Subtitle', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'PORTFOLIO', 'portum' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'portfolio_description_below'      => array(
					'label'       => esc_html__( 'Details under thumbnail', 'portum' ),
					'description' => esc_html__( 'Portfolio item description will be under the image', 'portum' ),
					'type'        => 'epsilon-toggle',
					'default'     => false,
				),
				'portfolio_image_lightbox'         => array(
					'label'       => esc_html__( 'Show items in lightbox', 'portum' ),
					'description' => esc_html__( 'Toggling this to ON will display all images in a lightbox', 'portum' ),
					'type'        => 'epsilon-toggle',
					'default'     => true,
				),
				'portfolio_image_show_description' => array(
					'label'       => esc_html__( 'Show item description on hover', 'portum' ),
					'description' => esc_html__( 'Toggling this to ON will display the project description on hover.', 'portum' ),
					'type'        => 'epsilon-toggle',
					'default'     => true,
					'condition'   => array( 'portfolio_description_below', false ),
				),
				'portfolio_image_show_zoom_icon'   => array(
					'label'       => esc_html__( 'Show zoom icon on hover', 'portum' ),
					'description' => esc_html__( 'Toggling this to ON will display the zoom icon on hover.', 'portum' ),
					'type'        => 'epsilon-toggle',
					'default'     => true,
				),
				'portfolio_slider'                 => array(
					'label'   => esc_html__( 'Turn into a carousel', 'portum' ),
					'type'    => 'epsilon-toggle',
					'default' => false,
				),
				'portfolio_slider_autostart'       => array(
					'label'     => esc_html__( 'Autostart', 'portum' ),
					'type'      => 'epsilon-toggle',
					'default'   => true,
					'condition' => array( 'portfolio_slider', true ),
				),
				'portfolio_slider_infinite'        => array(
					'label'     => esc_html__( 'Infinite slides', 'portum' ),
					'type'      => 'epsilon-toggle',
					'default'   => true,
					'condition' => array( 'portfolio_slider', true ),
				),
				'portfolio_slider_pager'           => array(
					'label'     => esc_html__( 'Navigation Dots', 'portum' ),
					'type'      => 'epsilon-toggle',
					'default'   => true,
					'condition' => array( 'portfolio_slider', true ),
				),
				'portfolio_slider_arrows'          => array(
					'label'     => esc_html__( 'Navigation Arrows', 'portum' ),
					'type'      => 'epsilon-toggle',
					'default'   => true,
					'condition' => array( 'portfolio_slider', true ),
				),
				'portfolio_slider_speed'           => array(
					'label'       => esc_html__( 'Speed', 'portum' ),
					'description' => esc_html__( 'Carousel speed', 'portum' ),
					'type'        => 'epsilon-slider',
					'default'     => 500,
					'choices'     => array(
						'min'  => 300,
						'max'  => 2000,
						'step' => 100,
					),
					'condition'   => array( 'portfolio_slider', true ),
				),
				'portfolio_slides_shown'           => array(
					'label'       => esc_html__( 'No. of slides to show', 'portum' ),
					'description' => esc_html__( 'Total number of items to show at a time. ', 'portum' ),
					'type'        => 'epsilon-slider',
					'default'     => 6,
					'choices'     => array(
						'min'  => 1,
						'max'  => 12,
						'step' => 1,
					),
					'condition'   => array( 'portfolio_slider', true ),
				),
				'portfolio_slides_scrolled'        => array(
					'label'       => esc_html__( 'No. of slides to scroll ', 'portum' ),
					'description' => esc_html__( 'Number of items to scroll at a time. For hero sliders, this is kept at 1 slide at a time.', 'portum' ),
					'type'        => 'epsilon-slider',
					'default'     => 1,
					'choices'     => array(
						'min'  => 1,
						'max'  => 6,
						'step' => 1,
					),
					'condition'   => array( 'portfolio_slider', true ),
				),
				'portfolio_repeater_field'         => array(
					'type'    => 'hidden',
					'default' => 'portum_portfolio',
				),
				'portfolio_section_unique_id'      => array(
					'label'             => esc_html__( 'Section ID', 'portum' ),
					'type'              => 'text',
					'sanitize_callback' => 'sanitize_key',
				),
				'portfolio_grouping'               => array(
					'label'       => esc_html__( 'Filter shown portfolio items', 'portum' ),
					'description' => esc_html__( 'The items you select in here are the only ones which will be displayed on this page. Think of the information you create in a section similar to a blog post. They are all created in a single place, but filtered by category. If you want to use multiple sections and display different information in each of them, use the filtering. ', 'portum' ),
					'type'        => 'selectize',
					'multiple'    => true,
					'choices'     => Portum_Helper::get_group_values_from_meta( 'portum_portfolio', 'portfolio_title' ),
					'linking'     => array( 'portum_portfolio', 'portfolio_title' ),
					'default'     => array( 'all' ),
				),
				'portfolio_navigation'             => array(
					'type'            => 'epsilon-customizer-navigation',
					'opensDoubled'    => true,
					'navigateToId'    => 'portum_portfolio_section',
					'navigateToLabel' => esc_html__( 'Add/Edit Portfolio Item &rarr;', 'portum' ),
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
			'title'         => esc_html__( 'Blog Posts', 'portum' ),
			'description'   => esc_html__( 'Blog Posts Section', 'portum' ),
			'image'         => esc_url( get_template_directory_uri() . '/assets/images/sections/ewf-icon-section-blog-pt.png' ),
			'customization' => array(
				'enabled' => true,
				'layout'  => array(
					'row-title-align'    => array(
						'default' => 'top',
					),
					'column-stretch'     => array(
						'default' => 'boxedin',
						'choices' => array( 'fullwidth', 'boxedin' ),
					),
					'column-spacing'     => array(
						'default' => 'lg',
						'choices' => array( 'none', 'sm', 'md', 'lg' ),
					),
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

				),
				'colors'  => array(
					'heading-color' => array(
						'selectors' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' ),
						'default'   => '',
					),
					'text-color'    => array(
						'selectors' => array( 'p' ),
						'default'   => '',
					),
				),
			),
			'fields'        => array(
				'item_style'                   => array(
					'label'   => esc_html__( 'Style', 'portum' ),
					'type'    => 'select',
					'default' => 'ewf-item__no-effect',
					'choices' => array(
						'ewf-item__no-effect'            => esc_html__( 'No effect', 'portum' ),
						'ewf-item__border-dashed-effect' => esc_html__( 'Border Dashed Effect', 'portum' ),
						'ewf-item__shadow-effect'        => esc_html__( 'Bottom Shadow Effect', 'portum' ),
						'ewf-item__simple-border-effect' => esc_html__( 'Simple Border Effect', 'portum' ),
					),
				),
				'item_style_color_picker'      => array(
					'label'     => esc_html__( 'Item Style Color Picker', 'portum' ),
					'type'      => 'epsilon-color-picker',
					'default'   => '',
					'mode'      => 'hex',
					'condition' => array(
						'item_style',
						'ewf-item__border-dashed-effect',
					),
				),
				'blog_title'                   => array(
					'label'             => esc_html__( 'Title', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'Find out the latest news?', 'portum' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'blog_subtitle'                => array(
					'label'             => esc_html__( 'Subtitle', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'BLOG', 'portum' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'blog_post_count'              => array(
					'label'       => esc_html__( 'Post Count', 'portum' ),
					'description' => esc_html__( 'Only posts with featured image are loaded', 'portum' ),
					'type'        => 'epsilon-slider',
					'default'     => 3,
					'choices'     => array(
						'min' => 1,
						'max' => 10,
					),
				),
				'blog_post_word_count'         => array(
					'label'       => esc_html__( 'Post Excerpt Word Count', 'portum' ),
					'description' => esc_html__( 'You can control the word count of the post excerpt from here. ', 'portum' ),
					'type'        => 'epsilon-slider',
					'default'     => 30,
					'choices'     => array(
						'min'  => 0,
						'max'  => 150,
						'step' => 5,
					),
				),
				'blog_show_date'               => array(
					'label'   => esc_html__( 'Show Post Date Meta', 'portum' ),
					'type'    => 'epsilon-toggle',
					'default' => true,
				),
				'blog_show_author'             => array(
					'label'   => esc_html__( 'Show Post Author Meta', 'portum' ),
					'type'    => 'epsilon-toggle',
					'default' => true,
				),
				'blog_show_comments'           => array(
					'label'   => esc_html__( 'Show Post Comments Meta', 'portum' ),
					'type'    => 'epsilon-toggle',
					'default' => true,
				),
				'blog_show_thumbnail'          => array(
					'label'   => esc_html__( 'Show Post Thumbnail Meta', 'portum' ),
					'type'    => 'epsilon-toggle',
					'default' => true,
				),
				'blog_show_read_more'          => array(
					'label'   => esc_html__( 'Show Read More Button', 'portum' ),
					'type'    => 'epsilon-toggle',
					'default' => true,
				),
				'blog_button_label'            => array(
					'label'             => esc_html__( 'Read More Label', 'portum' ),
					'type'              => 'text',
					'default'           => '',
					'sanitize_callback' => 'wp_kses_post',
					'condition'         => array( 'blog_show_read_more', true ),
				),
				'blog_button_size'             => array(
					'label'     => esc_html__( 'Primary Button Size', 'portum' ),
					'type'      => 'select',
					'default'   => 'ewf-btn--huge',
					'choices'   => array(
						'ewf-btn--huge'   => __( 'Huge', 'portum' ),
						'ewf-btn--medium' => __( 'Medium', 'portum' ),
						'ewf-btn--small'  => __( 'Small', 'portum' ),
					),
					'condition' => array( 'blog_show_read_more', true ),
				),
				'blog_button_radius'           => array(
					'label'     => esc_html__( 'Read More Button Radius', 'portum' ),
					'type'      => 'epsilon-slider',
					'default'   => 0,
					'choices'   => array(
						'min'  => 0,
						'max'  => 50,
						'step' => 5,
					),
					'condition' => array( 'blog_show_read_more', true ),
				),
				'blog_button_background_color' => array(
					'label'             => esc_html__( 'Read More Button Bg. Color', 'portum' ),
					'type'              => 'epsilon-color-picker',
					'default'           => '#000',
					'sanitize_callback' => 'wp_kses_post',
					'condition'         => array( 'blog_show_read_more', true ),
				),
				'blog_button_text_color'       => array(
					'label'             => esc_html__( 'Read More Button Text Color', 'portum' ),
					'type'              => 'epsilon-color-picker',
					'default'           => '#FFF',
					'sanitize_callback' => 'wp_kses_post',
					'condition'         => array( 'blog_show_read_more', true ),
				),
				'blog_button_border_color'     => array(
					'label'             => esc_html__( 'Read More Button Border Color', 'portum' ),
					'type'              => 'epsilon-color-picker',
					'default'           => '#EEE',
					'sanitize_callback' => 'wp_kses_post',
					'condition'         => array( 'blog_show_read_more', true ),
				),
				'blog_section_unique_id'       => array(
					'label'             => esc_html__( 'Section ID', 'portum' ),
					'type'              => 'text',
					'sanitize_callback' => 'sanitize_key',
					'condition'         => array( 'blog_show_read_more', true ),
				),
			),
		);
	}

	/**
	 * Repeatable team section
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
					'column-stretch'            => array(
						'default' => 'boxedin',
						'choices' => array( 'fullwidth', 'boxedin' ),
					),
					'column-group'              => array(
						'default' => 4,
						'choices' => array( 2, 3, 4, 6 ),
					),
					'column-spacing'            => array(
						'default' => 'lg',
						'choices' => array( 'none', 'sm', 'md', 'lg' ),
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
						'selectors' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' ),
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
				'team_repeater_field'    => array(
					'type'    => 'hidden',
					'default' => 'portum_team_members',
				),
				'team_section_unique_id' => array(
					'label'             => esc_html__( 'Section ID', 'portum' ),
					'type'              => 'text',
					'sanitize_callback' => 'sanitize_key',
				),
				'team_grouping'          => array(
					'label'       => esc_html__( 'Filter shown members', 'portum' ),
					'description' => esc_html__( 'The items you select in here are the only ones which will be displayed on this page. Think of the information you create in a section similar to a blog post. They are all created in a single place, but filtered by category. If you want to use multiple sections and display different information in each of them, use the filtering. ', 'portum' ),
					'type'        => 'selectize',
					'multiple'    => true,
					'choices'     => Portum_Helper::get_group_values_from_meta( 'portum_team_members', 'member_title' ),
					'linking'     => array( 'portum_team_members', 'member_title' ),
					'default'     => array( 'all' ),
				),
				'team_navigation'        => array(
					'type'            => 'epsilon-customizer-navigation',
					'opensDoubled'    => true,
					'navigateToId'    => 'portum_team_members_section',
					'navigateToLabel' => esc_html__( 'Add/Edit Members &rarr;', 'portum' ),
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
					'row-title-align'           => array(
						'default' => 'top',
					),
					'column-stretch'            => array(
						'default' => 'boxedin',
						'choices' => array( 'fullwidth', 'boxedin' ),
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
					'column-spacing'            => array(
						'default' => 'lg',
						'choices' => array( 'none', 'sm', 'md', 'lg' ),
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
						'selectors' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' ),
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
				'pricing_text'              => array(
					'label'             => esc_html__( 'Description', 'portum' ),
					'description'       => esc_html__( 'Describe your pricing packages here', 'portum' ),
					'type'              => 'textarea',
					'default'           => '',
					'sanitize_callback' => 'wp_kses_post',
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
				'pricing_grouping'          => array(
					'label'       => esc_html__( 'Filter shown pricing tables', 'portum' ),
					'description' => esc_html__( 'The items you select in here are the only ones which will be displayed on this page. Think of the information you create in a section similar to a blog post. They are all created in a single place, but filtered by category. If you want to use multiple sections and display different information in each of them, use the filtering. ', 'portum' ),
					'type'        => 'selectize',
					'multiple'    => true,
					'choices'     => Portum_Helper::get_group_values_from_meta( 'portum_price_boxes', 'price_box_title' ),
					'linking'     => array( 'portum_price_boxes', 'price_box_title' ),
					'default'     => array( 'all' ),
				),
				'pricing_navigation'        => array(
					'type'            => 'epsilon-customizer-navigation',
					'opensDoubled'    => true,
					'navigateToId'    => 'portum_pricing_section',
					'navigateToLabel' => esc_html__( 'Add/Edit Price Boxes &rarr;', 'portum' ),
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
						'default' => 'fullwidth',
						'choices' => array( 'fullwidth', 'boxedin' ),
					),
					'row-spacing-top'           => array(
						'default' => 'none',
						'choices' => array( 'lg', 'md', 'sm', 'none' ),
					),
					'row-spacing-bottom'        => array(
						'default' => 'none',
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
						'selectors' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' ),
						'default'   => '',
					),
					'text-color'    => array(
						'selectors' => array( 'p' ),
						'default'   => '',
					),
				),
			),
			'fields'        => array(
				'video_id'                => array(
					'label'             => esc_html__( 'Video URL', 'portum' ),
					'description'       => esc_html__( 'Paste the URL of your video ( YouTube or Vimeo )', 'portum' ),
					'type'              => 'text',
					'default'           => 'https://vimeo.com/104779334',
					'sanitize_callback' => 'esc_url_raw',
				),
				'video_show_controls'     => array(
					'label'       => esc_html__( 'Show video controls', 'portum' ),
					'description' => esc_html__( 'Turning this to ON will show video controls like: play, pause, stop, etc.', 'portum' ),
					'type'        => 'epsilon-toggle',
					'default'     => false,
				),
				'video_auto_loop'         => array(
					'label'       => esc_html__( 'Video loop', 'portum' ),
					'description' => esc_html__( 'Turning this to ON will make your video run on repeat mode. Goes great with muted videos that you want looped.', 'portum' ),
					'type'        => 'epsilon-toggle',
					'default'     => true,
				),
				'video_mute_mode'         => array(
					'label'       => esc_html__( 'Video muted', 'portum' ),
					'description' => esc_html__( 'Turning this to ON will make your video run muted aka with no sound. This works great for videos you want looped.', 'portum' ),
					'type'        => 'epsilon-toggle',
					'default'     => true,
				),
				'video_autoplay'          => array(
					'label'       => esc_html__( 'Video Autoplay', 'portum' ),
					'description' => esc_html__( 'Turning this to ON will make your video autoplay.', 'portum' ),
					'type'        => 'epsilon-toggle',
					'default'     => true,
				),
				'video_max_height'        => array(
					'label'       => esc_html__( 'Max Video Section Height', 'portum' ),
					'description' => esc_html__( 'Very useful when displaying videos in full-width mode. Height is in %', 'portum' ),
					'type'        => 'epsilon-slider',
					'default'     => 500,
					'choices'     => array(
						'min'  => 10,
						'max'  => 100,
						'step' => 5,
					),
				),
				'video_title'             => array(
					'label'             => esc_html__( 'Title', 'portum' ),
					'type'              => 'text',
					'default'           => '',
					'sanitize_callback' => 'wp_kses_post',
				),
				'video_subtitle'          => array(
					'label'             => esc_html__( 'Description', 'portum' ),
					'type'              => 'text',
					'default'           => '',
					'sanitize_callback' => 'wp_kses_post',
				),
				'video_text'              => array(
					'label'             => esc_html__( 'Information', 'portum' ),
					'type'              => 'textarea',
					'default'           => '',
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
						'choices' => array( 'fullwidth', 'boxedin' ),
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
					'background-type'     => array(
						'choices' => array(
							'solid',
							'image',
							//'video'
						),
						'default' => 'solid',
					),
					'background-color'    => array(
						'default'   => false,
						'condition' => array( 'background-type', 'solid' ),
					),
					'background-image'    => array(
						'default'   => false,
						'condition' => array( 'background-type', 'image' ),
					),
					'background-position' => array(
						'default'   => 'center',
						'condition' => array( 'background-type', 'image' ),
					),
					'background-size'     => array(
						'default'   => 'initial',
						'condition' => array( 'background-type', 'image' ),
					),
					'background-repeat'   => array(
						'default'   => 'repeat',
						'condition' => array( 'background-type', 'image' ),
					),
					'background-parallax' => array(
						'default'   => false,
						'condition' => array( 'background-type', 'image' ),
					),

				),
				'colors'  => array(
					'heading-color' => array(
						'selectors' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' ),
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
					'type'              => 'textarea',
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
						'choices' => array( 'fullwidth', 'boxedin' ),
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

				),
				'colors'  => array(
					'heading-color' => array(
						'selectors' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' ),
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
				'google_map_grouping'          => array(
					'label'       => esc_html__( 'Filter shown content', 'portum' ),
					'description' => esc_html__( 'The items you select in here are the only ones which will be displayed on this page. Think of the information you create in a section similar to a blog post. They are all created in a single place, but filtered by category. If you want to use multiple sections and display different information in each of them, use the filtering functionality to achieve this.  ', 'portum' ),
					'type'        => 'selectize',
					'multiple'    => true,
					'choices'     => Portum_Helper::get_group_values_from_meta( 'portum_contact_section', 'contact_title' ),
					'linking'     => array( 'portum_contact_section', 'contact_title' ),
					'default'     => array( 'all' ),
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
						'choices' => array( 'fullwidth', 'boxedin' ),
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

				),
				'colors'  => array(
					'heading-color' => array(
						'selectors' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' ),
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
					'description'       => esc_html__( 'Section title', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'Check out our counters!', 'portum' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'counters_subtitle'          => array(
					'label'             => esc_html__( 'Subtitle', 'portum' ),
					'description'       => esc_html__( 'Section subtitle', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'COUNTERS', 'portum' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'counters_section_unique_id' => array(
					'label'             => esc_html__( 'Section ID', 'portum' ),
					'description'       => esc_html__( 'Section Unique ID. Useful if you are looking to target this particular section with CSS / jQuery. Very useful as well for creating the one-page effect with smooth scrolling to section.', 'portum' ),
					'type'              => 'text',
					'sanitize_callback' => 'sanitize_key',
				),
				'counters_grouping'          => array(
					'label'       => esc_html__( 'Filter shown content', 'portum' ),
					'description' => esc_html__( 'The items you select in here are the only ones which will be displayed on this page. Think of the information you create in a section similar to a blog post. They are all created in a single place, but filtered by category. If you want to use multiple sections and display different information in each of them, use the filtering. ', 'portum' ),
					'type'        => 'selectize',
					'multiple'    => true,
					'choices'     => Portum_Helper::get_group_values_from_meta( 'portum_counter_boxes', 'counter_title' ),
					'linking'     => array( 'portum_counter_boxes', 'counter_title' ),
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
						'choices' => array( 'fullwidth', 'boxedin' ),
					),
					'column-spacing'            => array(
						'default' => 'lg',
						'choices' => array( 'none', 'sm', 'md', 'lg' ),
					),
					'column-group'              => array(
						'default' => 4,
						'choices' => array( 2, 3, 4 ),
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

				),
				'colors'  => array(
					'heading-color' => array(
						'selectors' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' ),
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
				'progress_section_unique_id'   => array(
					'label'             => esc_html__( 'Section ID', 'portum' ),
					'type'              => 'text',
					'sanitize_callback' => 'sanitize_key',
				),
				'progress_bars_grouping'       => array(
					'label'       => esc_html__( 'Filter shown content', 'portum' ),
					'description' => esc_html__( 'Only selected items will be shown in the frontend.', 'portum' ),
					'type'        => 'selectize',
					'multiple'    => true,
					'choices'     => Portum_Helper::get_group_values_from_meta( 'portum_progress_bars', 'progress_bar_title' ),
					'linking'     => array( 'portum_progress_bars', 'progress_bar_title' ),
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
						'choices' => array( 'fullwidth', 'boxedin' ),
					),
					'row-spacing-top'           => array(
						'default' => 'md',
						'choices' => array( 'lg', 'md', 'sm', 'none' ),
					),
					'row-spacing-bottom'        => array(
						'default' => 'md',
						'choices' => array( 'lg', 'md', 'sm', 'none' ),
					),
					'column-spacing'            => array(
						'default' => 'md',
						'choices' => array( 'none', 'sm', 'md', 'lg' ),
					),
					'column-group'              => array(
						'default' => 4,
						'choices' => array( 2, 3, 4 ),
					),
					'column-alignment'          => array(
						'default' => 'center',
					),
					'column-vertical-alignment' => array(
						'default' => 'middle',
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
						'selectors' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' ),
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
					'linking'     => array( 'portum_pie_charts', 'piechart_title' ),
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
					'row-title-align'           => array(
						'default' => 'top',
						'choices' => array( 'left', 'top', 'right' ),
					),
					'column-stretch'            => array(
						'default' => 'boxedin',
						'choices' => array( 'fullwidth', 'boxedin' ),
					),
					'column-spacing'            => array(
						'default' => 'none',
						'choices' => array( 'none', 'sm', 'md', 'lg' ),
					),
					'column-group'              => array(
						'default' => 6,
						'choices' => array( 2, 3, 4, 6 ),
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
						'default' => 'center',
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
						'selectors' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' ),
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
				'clientlist_slider'            => array(
					'label'   => esc_html__( 'Turn into a carousel', 'portum' ),
					'type'    => 'epsilon-toggle',
					'default' => false,
				),
				'clientlist_slider_autostart'  => array(
					'label'     => esc_html__( 'Autostart', 'portum' ),
					'type'      => 'epsilon-toggle',
					'default'   => true,
					'condition' => array( 'clientlist_slider', true ),
				),
				'clientlist_slider_infinite'   => array(
					'label'     => esc_html__( 'Infinite slides', 'portum' ),
					'type'      => 'epsilon-toggle',
					'default'   => true,
					'condition' => array( 'clientlist_slider', true ),
				),
				'clientlist_slider_pager'      => array(
					'label'     => esc_html__( 'Navigation Dots', 'portum' ),
					'type'      => 'epsilon-toggle',
					'default'   => true,
					'condition' => array( 'clientlist_slider', true ),
				),
				'clientlist_slider_arrows'     => array(
					'label'     => esc_html__( 'Navigation Arrows', 'portum' ),
					'type'      => 'epsilon-toggle',
					'default'   => true,
					'condition' => array( 'clientlist_slider', true ),
				),
				'clientlist_slider_speed'      => array(
					'label'       => esc_html__( 'Speed', 'portum' ),
					'description' => esc_html__( 'Carousel speed', 'portum' ),
					'type'        => 'epsilon-slider',
					'default'     => 500,
					'choices'     => array(
						'min'  => 300,
						'max'  => 2000,
						'step' => 100,
					),
					'condition'   => array( 'clientlist_slider', true ),
				),
				'clientlist_slides_shown'      => array(
					'label'       => esc_html__( 'No. of slides to show', 'portum' ),
					'description' => esc_html__( 'Total number of items to show at a time. ', 'portum' ),
					'type'        => 'epsilon-slider',
					'default'     => 6,
					'choices'     => array(
						'min'  => 1,
						'max'  => 12,
						'step' => 1,
					),
					'condition'   => array( 'clientlist_slider', true ),
				),
				'clientlist_slides_scrolled'   => array(
					'label'       => esc_html__( 'No. of slides to scroll ', 'portum' ),
					'description' => esc_html__( 'Number of items to scroll at a time. For hero sliders, this is kept at 1 slide at a time.', 'portum' ),
					'type'        => 'epsilon-slider',
					'default'     => 1,
					'choices'     => array(
						'min'  => 1,
						'max'  => 6,
						'step' => 1,
					),
					'condition'   => array( 'clientlist_slider', true ),
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
				'clientlist_grouping'          => array(
					'label'       => esc_html__( 'Filter shown clients', 'portum' ),
					'description' => esc_html__( 'The items you select in here are the only ones which will be displayed on this page. Think of the information you create in a section similar to a blog post. They are all created in a single place, but filtered by category. If you want to use multiple sections and display different information in each of them, use the filtering. ', 'portum' ),
					'type'        => 'selectize',
					'multiple'    => true,
					'choices'     => Portum_Helper::get_group_values_from_meta( 'portum_clients', 'client_title' ),
					'linking'     => array( 'portum_clients', 'client_title' ),
					'default'     => array( 'all' ),
				),
				'clientlist_navigation'        => array(
					'type'            => 'epsilon-customizer-navigation',
					'opensDoubled'    => true,
					'navigateToId'    => 'portum_clientlists_section',
					'navigateToLabel' => esc_html__( 'Add/Edit Client Logos &rarr;', 'portum' ),
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
						'choices' => array( 'fullwidth', 'boxedin' ),
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

				),
				'colors'  => array(
					'heading-color' => array(
						'selectors' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' ),
						'default'   => '',
					),
					'text-color'    => array(
						'selectors' => array( 'p' ),
						'default'   => '',
					),
				),
			),
			'fields'        => array(
				'cta_title'                             => array(
					'label'             => esc_html__( 'Title', 'portum' ),
					'description'       => esc_html__( 'Section title', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'Big, bold statement here.', 'portum' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'cta_description'                       => array(
					'label'             => esc_html__( 'Description', 'portum' ),
					'description'       => esc_html__( 'Use this to emphasize your Call To Action message.', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'Small text about your CTA here.', 'portum' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'cta_button_1_enable'                   => array(
					'label'   => esc_html__( 'Enable CTA button 1' ),
					'type'    => 'epsilon-toggle',
					'default' => true,
				),
				'cta_button_2_enable'                   => array(
					'label'   => esc_html__( 'Enable CTA button 2' ),
					'type'    => 'epsilon-toggle',
					'default' => true,
				),
				'cta_button_primary_label'              => array(
					'label'             => esc_html__( 'Primary button label', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'Buy Now', 'portum' ),
					'sanitize_callback' => 'sanitize_textfield',
					'condition'         => array( 'cta_button_1_enable', true ),
				),
				'cta_button_primary_url'                => array(
					'label'             => esc_html__( 'Primary button URL', 'portum' ),
					'type'              => 'text',
					'default'           => esc_url( 'https://google.com' ),
					'sanitize_callback' => 'esc_url_raw',
					'condition'         => array( 'cta_button_1_enable', true ),
				),
				'cta_primary_btn_size'                  => array(
					'label'     => esc_html__( 'Primary Button Size', 'portum' ),
					'type'      => 'select',
					'default'   => 'ewf-btn--huge',
					'choices'   => array(
						'ewf-btn--huge'   => __( 'Huge', 'portum' ),
						'ewf-btn--medium' => __( 'Medium', 'portum' ),
						'ewf-btn--small'  => __( 'Small', 'portum' ),
					),
					'condition' => array( 'cta_button_1_enable', true ),
				),
				'cta_primary_btn_radius'                => array(
					'label'     => esc_html__( 'Primary Button Radius', 'portum' ),
					'type'      => 'epsilon-slider',
					'default'   => 0,
					'choices'   => array(
						'min'  => 0,
						'max'  => 50,
						'step' => 5,
					),
					'condition' => array( 'cta_button_1_enable', true ),
				),
				'cta_primary_button_background_color'   => array(
					'label'             => esc_html__( 'Primary Button Bg. Color', 'portum' ),
					'type'              => 'epsilon-color-picker',
					'default'           => '#000',
					'sanitize_callback' => 'wp_kses_post',
					'condition'         => array( 'cta_button_1_enable', true ),
				),
				'cta_primary_button_text_color'         => array(
					'label'             => esc_html__( 'Primary Button Text Color', 'portum' ),
					'type'              => 'epsilon-color-picker',
					'default'           => '#FFF',
					'sanitize_callback' => 'wp_kses_post',
					'condition'         => array( 'cta_button_1_enable', true ),
				),
				'cta_primary_button_border_color'       => array(
					'label'             => esc_html__( 'Primary Button Border Color', 'portum' ),
					'type'              => 'epsilon-color-picker',
					'default'           => '#EEE',
					'sanitize_callback' => 'wp_kses_post',
					'condition'         => array( 'cta_button_1_enable', true ),
				),
				'cta_button_secondary_label'            => array(
					'label'             => esc_html__( 'Secondary button label', 'portum' ),
					'type'              => 'text',
					'default'           => esc_html__( 'Secondary button', 'portum' ),
					'sanitize_callback' => 'sanitize_textfield',
					'condition'         => array( 'cta_button_2_enable', true ),
				),
				'cta_button_secondary_url'              => array(
					'label'             => esc_html__( 'Secondary button URL', 'portum' ),
					'type'              => 'text',
					'default'           => esc_url( 'https://google.com' ),
					'sanitize_callback' => 'esc_url_raw',
					'condition'         => array( 'cta_button_2_enable', true ),
				),
				'cta_secondary_btn_size'                => array(
					'label'     => esc_html__( 'Secondary Button Size', 'portum' ),
					'type'      => 'select',
					'default'   => 'ewf-btn--huge',
					'choices'   => array(
						'ewf-btn--huge'   => __( 'Huge', 'portum' ),
						'ewf-btn--medium' => __( 'Medium', 'portum' ),
						'ewf-btn--small'  => __( 'Small', 'portum' ),
					),
					'condition' => array( 'cta_button_2_enable', true ),
				),
				'cta_secondary_btn_radius'              => array(
					'label'     => esc_html__( 'Secondary Button Radius', 'portum' ),
					'type'      => 'epsilon-slider',
					'default'   => 0,
					'choices'   => array(
						'min'  => 0,
						'max'  => 50,
						'step' => 5,
					),
					'condition' => array( 'cta_button_2_enable', true ),
				),
				'cta_secondary_button_background_color' => array(
					'label'             => esc_html__( 'Secondary Button Bg. Color', 'portum' ),
					'type'              => 'epsilon-color-picker',
					'default'           => '#000',
					'sanitize_callback' => 'wp_kses_post',
					'condition'         => array( 'cta_button_2_enable', true ),
				),
				'cta_secondary_button_text_color'       => array(
					'label'             => esc_html__( 'Secondary Button Text Color', 'portum' ),
					'type'              => 'epsilon-color-picker',
					'default'           => '#FFF',
					'sanitize_callback' => 'wp_kses_post',
					'condition'         => array( 'cta_button_2_enable', true ),
				),
				'cta_secondary_button_border_color'     => array(
					'label'             => esc_html__( 'Secondary Button Border Color', 'portum' ),
					'type'              => 'epsilon-color-picker',
					'default'           => '#EEE',
					'sanitize_callback' => 'wp_kses_post',
					'condition'         => array( 'cta_button_2_enable', true ),
				),
				'cta_section_unique_id'                 => array(
					'label'             => esc_html__( 'Unique Section ID', 'portum' ),
					'description'       => esc_html__( 'Section Unique ID. Useful if you are looking to target this particular section with CSS / jQuery. Very useful as well for creating the one-page effect with smooth scrolling to section.', 'portum' ),
					'type'              => 'text',
					'sanitize_callback' => 'sanitize_key',
				),
			),
		);
	}
}
