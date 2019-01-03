<?php
/**
 * Portum Theme Customizer repeatable section
 *
 * @package Portum
 * @since   1.0
 */



if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once dirname( __FILE__ ) . '/repeatable-section.php';

/**
 * Class Repeatable_Section_Advanced_Slider
 */
class Repeatable_Section_Advanced_Slider extends Repeatable_Section {

	/**
	 * Sets the section id
	 */
	public function set_id() {
		$this->id = 'advanced-slider';
	}

	/**
	 * Sets section title
	 */
	public function set_title() {
		$this->title = esc_html__( 'Advanced Slider', 'portum' );
	}

	/**
	 * Description
	 */
	public function set_description() {
		$this->description = esc_html__( 'A multi-purpose slider section that you can use through-out your website.', 'portum' );
	}

	/**
	 * Sets section image
	 */
	public function set_image() {
		$this->image = esc_url( get_template_directory_uri() . '/assets/images/sections/ewf-icon-section-advanced-slider.png' );
	}

	/**
	 * Creates the section fields
	 */
	public function create_fields() {
		$this->fields = $this->normal_fields();
	}

	/**
	 * Normal fields
	 *
	 * @return array
	 */
	public function normal_fields() {
		return array(
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
			'slider_slides_shown'    => array(
				'label'   => esc_html__( 'Show this many slides', 'portum' ),
				'type'    => 'epsilon-slider',
				'default' => 1,
				'choices' => array(
					'min'  => 1,
					'max'  => 6,
					'step' => 1,
				),
			),
			'slider_slides_scrolled' => array(
				'label'   => esc_html__( 'Slide this many items at once', 'portum' ),
				'type'    => 'epsilon-slider',
				'default' => 1,
				'choices' => array(
					'min'  => 1,
					'max'  => 6,
					'step' => 1,
				),
			),
			'slider_height'          => array(
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
			'slider_speed'           => array(
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

		);
	}
}
