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
 * Class Repeatable_Section_Services
 */
class Repeatable_Section_Services extends Repeatable_Section {

	/**
	 * Sets the section id
	 */
	public function set_id() {
		$this->id = 'services';
	}

	/**
	 * Sets section title
	 */
	public function set_title() {
		$this->title = esc_html__( 'Services', 'portum' );
	}

	/**
	 * Description
	 */
	public function set_description() {
		$this->description = esc_html__( 'Services section. It retrieves content from Theme Content / Services', 'portum' );
	}

	/**
	 * Sets section image
	 */
	public function set_image() {
		$this->image = esc_url( get_template_directory_uri() . '/assets/images/sections/ewf-icon-section-services-pt.png' );
	}

	/**
	 * Creates groups
	 */
	public function create_groups() {
		$this->groups = array(
			'regular'    => array(
				'icon'  => 'dashicons dashicons-edit',
				'label' => esc_html__( 'Content', 'epsilon-framework' ),
			),
			'background' => array(
				'icon'  => 'dashicons dashicons-admin-customizer',
				'label' => esc_html__( 'Background', 'epsilon-framework' ),
			),
			'layout'     => array(
				'icon'  => 'dashicons dashicons-align-left',
				'label' => esc_html__( 'Layout', 'epsilon-framework' ),
			),
			'colors'     => array(
				'icon'  => 'dashicons dashicons-admin-appearance',
				'label' => esc_html__( 'Style', 'epsilon-framework' ),
			),
		);
	}

	/**
	 * Creates the section fields
	 */
	public function create_fields() {
		$this->fields = array_merge( $this->layout_fields(), $this->background_fields(), $this->color_fields(), $this->normal_fields() );
	}

	/**
	 * Layout fields
	 *
	 * @return array
	 */
	public function layout_fields() {
		$custom_fields = array(
			'services_row_title_align'           => array(
				'id'          => 'services_row_title_align',
				'type'        => 'select',
				'label'       => esc_html__( 'Section Layout', 'epsilon-framework' ),
				'description' => esc_html__( 'All sections support an alternating layout. The layout changes based on a section\'s title position. Currently available options are: title left / content right -- title center / content center -- title right / content left ', 'epsilon-framework' ),
				'group'       => 'layout',
				'choices'     => array(
					'top'    => esc_html__( 'Top', 'epsilon-framework' ),
					'bottom' => esc_html__( 'Bottom', 'epsilon-framework' ),
					'left'   => esc_html__( 'Left', 'epsilon-framework' ),
					'right'  => esc_html__( 'Right', 'epsilon-framework' ),
				),
				'default'     => '',
			),
			'services_column_stretch'            => array(
				'id'          => 'services_column_stretch',
				'type'        => 'select',
				'label'       => esc_html__( 'Section Width', 'epsilon-framework' ),
				'description' => esc_html__( 'Make the section stretch to full-width. Contained is default. There\'s also the option of boxed center. ', 'epsilon-framework' ),
				'group'       => 'layout',
				'choices'     => array(
					'fullwidth' => esc_html__( 'Fullwidth (100% width)', 'epsilon-framework' ),
					'boxedin'   => esc_html__( 'Contained (1170px width)', 'epsilon-framework' ),
				),
				'default'     => 'boxedin',
			),
			'services_column_group'              => array(
				'id'          => 'pricing_column_group',
				'type'        => 'select',
				'label'       => __( 'Item Group', 'epsilon-framework' ),
				'description' => __( 'Number of items to display at once. Example: 2, 3 or 4 pricing tables. The width of the content will be equally split among the number of elements you select.', 'epsilon-framework' ),
				'group'       => 'layout',
				'default'     => 3,
				'choices'     => array(
					2 => esc_html__( '2 columns', 'epsilon-framework' ),
					3 => esc_html__( '3 columns', 'epsilon-framework' ),
					4 => esc_html__( '4 columns', 'epsilon-framework' ),
				),
			),
			'services_column_spacing'            => array(
				'id'      => 'pricing_column_spacing',
				'type'    => 'select',
				'label'   => esc_html__( 'Item Spacing', 'epsilon-framework' ),
				'group'   => 'layout',
				'choices' => array(
					'lg'   => esc_html__( 'Large (105px)', 'epsilon-framework' ),
					'md'   => esc_html__( 'Medium (75px)', 'epsilon-framework' ),
					'sm'   => esc_html__( 'Small (35px)', 'epsilon-framework' ),
					'none' => esc_html__( 'None (0px)', 'epsilon-framework' ),
				),
				'default' => 'lg',
			),
			'services_column_alignment'          => array(
				'id'          => 'services_column_alignment',
				'type'        => 'select',
				'label'       => esc_html__( 'Horizontal Alignment', 'epsilon-framework' ),
				'description' => esc_html__( 'Center/Left/Right align all of a sections content.', 'epsilon-framework' ),
				'group'       => 'layout',
				'choices'     => array(
					'left'   => esc_html__( 'Left', 'epsilon-framework' ),
					'center' => esc_html__( 'Center', 'epsilon-framework' ),
					'right'  => esc_html__( 'Right', 'epsilon-framework' ),
				),
				'default'     => 'center',
			),
			'services_column_vertical_alignment' => array(
				'id'          => 'services_column_vertical_alignment',
				'type'        => 'select',
				'label'       => esc_html__( 'Vertical Alignment', 'epsilon-framework' ),
				'description' => esc_html__( 'We recommend leaving this to center, but feel free to experiment with the options. Top/Bottom align can be useful when you have a layout of text + image on the same line.', 'epsilon-framework' ),
				'group'       => 'layout',
				'choices'     => array(
					'top'    => esc_html__( 'Top', 'epsilon-framework' ),
					'middle' => esc_html__( 'Middle', 'epsilon-framework' ),
					'bottom' => esc_html__( 'Bottom', 'epsilon-framework' ),
				),
				'default'     => 'middle',
			),
		);

		return array_merge( $this->create_margin_fields(), $this->create_padding_fields(), $custom_fields );

	}

	/**
	 * Styling fields
	 *
	 * @return array
	 */
	public function background_fields() {
		$sizes = Epsilon_Helper::get_image_sizes();

		return array(
			'services_background_type'        => array(
				'id'      => 'services_background_type',
				'label'   => esc_html__( 'Background Type', 'epsilon-framework' ),
				'type'    => 'select',
				'choices' => array(
					'bgimage' => __( 'Image', 'epsilon-framework' ),
					'bgcolor' => __( 'Solid Color', 'epsilon-framework' ),
				),
				'group'   => 'background',
			),
			'services_background_color'       => array(
				'id'         => 'services_background_color',
				'label'      => esc_html__( 'Background Color', 'epsilon-framework' ),
				'default'    => '',
				'type'       => 'epsilon-color-picker',
				'mode'       => 'rgba',
				'defaultVal' => '#EEE',
				'group'      => 'background',
				'condition'  => array(
					'services_background_type',
					'bgcolor',
				),
			),
			'services_background_image'       => array(
				'id'          => 'services_background_image',
				'label'       => esc_html__( 'Background Image', 'epsilon-framework' ),
				'description' => esc_html__( 'Use this field to set a background image. Content will overlay on top of the image.', 'epsilon-framework' ),
				'type'        => 'epsilon-image',
				'default'     => '',
				'group'       => 'background',
				'size'        => 'full',
				'sizeArray'   => $sizes,
				'mode'        => 'url',
				'condition'   => array(
					'services_background_type',
					'bgimage',
				),
			),
			'services_background_image_color' => array(
				'id'         => 'services_background_color',
				'label'      => esc_html__( 'Background Image Color Overlay', 'epsilon-framework' ),
				'default'    => '',
				'type'       => 'epsilon-color-picker',
				'mode'       => 'rgba',
				'defaultVal' => '',
				'group'      => 'background',
				'condition'  => array(
					'services_background_type',
					'bgimage',
				),
			),
			'services_background_position'    => array(
				'id'          => 'services_background_position',
				'label'       => esc_html__( 'Background Position', 'epsilon-framework' ),
				'description' => esc_html__( 'We recommend using Center. Experiment with the options to see what works best for you.', 'epsilon-framework' ),
				'default'     => 'center',
				'type'        => 'select',
				'group'       => 'background',
				'choices'     => array(
					'topleft'     => __( 'Top Left', 'epsilon-framework' ),
					'top'         => __( 'Top', 'epsilon-framework' ),
					'topright'    => __( 'Top Right', 'epsilon-framework' ),
					'left'        => __( 'Left', 'epsilon-framework' ),
					'center'      => __( 'Center', 'epsilon-framework' ),
					'right'       => __( 'Right', 'epsilon-framework' ),
					'bottomleft'  => __( 'Bottom Left', 'epsilon-framework' ),
					'bottom'      => __( 'Bottom', 'epsilon-framework' ),
					'bottomright' => __( 'Bottom Right', 'epsilon-framework' ),
				),
				'condition'   => array(
					'services_background_type',
					'bgimage',
				),
			),
			'services_background_size'        => array(
				'id'          => 'services_background_size',
				'label'       => esc_html__( 'Background Stretch', 'epsilon-framework' ),
				'description' => esc_html__( 'We usually recommend using cover as a default option.', 'epsilon-framework' ),
				'default'     => 'cover',
				'type'        => 'select',
				'group'       => 'background',
				'choices'     => array(
					'cover'   => __( 'Cover', 'epsilon-framework' ),
					'contain' => __( 'Contain', 'epsilon-framework' ),
					'initial' => __( 'Initial', 'epsilon-framework' ),
				),
				'condition'   => array(
					'services_background_type',
					'bgimage',
				),

			),
			'services_background_repeat'      => array(
				'id'          => 'services_background_repeat',
				'label'       => esc_html__( 'Background Repeat', 'epsilon-framework' ),
				'description' => esc_html__( 'Set to background-repeat if you are using patterns. For parallax, we recommend setting to no-repeat.', 'epsilon-framework' ),
				'default'     => 'no-repeat',
				'type'        => 'select',
				'group'       => 'background',
				'choices'     => array(
					'no-repeat' => __( 'No Repeat', 'epsilon-framework' ),
					'repeat'    => __( 'Repeat', 'epsilon-framework' ),
					'repeat-y'  => __( 'Repeat Y', 'epsilon-framework' ),
					'repeat-x'  => __( 'Repeat X', 'epsilon-framework' ),
				),
				'condition'   => array(
					'services_background_type',
					'bgimage',
				),
			),
			'services_background_parallax'    => array(
				'id'          => 'services_background_parallax',
				'label'       => esc_html__( 'Background Parallax', 'epsilon-framework' ),
				'description' => esc_html__( 'Toggling this to ON will enable the parallax effect. Make sure you have a  background image set before enabling it.', 'epsilon-framework' ),
				'default'     => false,
				'type'        => 'epsilon-toggle',
				'group'       => 'background',
				'condition'   => array(
					'services_background_type',
					'bgimage',
				),
			),

		);
	}

	/**
	 * Colors fields
	 *
	 * @return array
	 */
	public function color_fields() {
		return array(
			'services_title_misc_font_color' => array(
				'selectors'     => array(
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
				'css-attribute' => 'color',
				'default'       => '',
				'label'         => __( 'Section Title Color', 'epsilon-framework' ),
				'description'   => '',
				'type'          => 'epsilon-color-picker',
				'mode'          => 'rgba',
				'defaultVal'    => '',
				'group'         => 'colors',
			),
			'services_text_misc_font_color'  => array(
				'selectors'     => array( 'p' ),
				'css-attribute' => 'color',
				'default'       => '',
				'label'         => __( 'Section Paragraph Color', 'epsilon-framework' ),
				'description'   => '',
				'type'          => 'epsilon-color-picker',
				'mode'          => 'rgba',
				'defaultVal'    => '',
				'group'         => 'colors',
			),
		);
	}

	/**
	 * Normal fields
	 *
	 * @return array
	 */
	public function normal_fields() {
		return array(
			'services_title'             => array(
				'label'             => esc_html__( 'Title', 'portum' ),
				'description'       => esc_html__( 'Section title', 'portum' ),
				'type'              => 'text',
				'default'           => wp_kses_post( 'We offer:' ),
				'sanitize_callback' => 'wp_kses_post',
			),
			'services_subtitle'          => array(
				'label'             => esc_html__( 'Subtitle', 'portum' ),
				'description'       => esc_html__( 'Section subtitle', 'portum' ),
				'type'              => 'text',
				'default'           => wp_kses_post( 'SERVICES' ),
				'sanitize_callback' => 'wp_kses_post',
			),
			'services_description'       => array(
				'label'             => esc_html__( 'Description', 'portum' ),
				'description'       => esc_html__( 'This works best in conjuction with left and right content layouts. Use it to shortly describe your services.', 'portum' ),
				'type'              => 'textarea',
				'default'           => esc_html__( 'Describe your services.', 'portum' ),
				'sanitize_callback' => 'wp_kses_post',
			),
			'item_style'                 => array(
				'label'   => esc_html__( 'Item Style', 'portum' ),
				'type'    => 'select',
				'default' => 'ewf-item__no-effect',
				'choices' => array(
					'ewf-item__no-effect'     => esc_html__( 'No effect', 'portum' ),
					'ewf-item__border'        => esc_html__( 'Border Effect', 'portum' ),
					'ewf-item__shadow-effect' => esc_html__( 'Shadow Effect', 'portum' ),
				),
			),
			'item_border_style'          => array(
				'label'     => esc_html__( 'Item Border Style', 'portum' ),
				'type'      => 'select',
				'default'   => 'ewf-item__simple-border-effect',
				'choices'   => array(
					'ewf-item__border-dashed-effect' => esc_html__( 'Dashed Border Effect', 'portum' ),
					'ewf-item__simple-border-effect' => esc_html__( 'Simple Border Effect', 'portum' ),
				),
				'condition' => array(
					'item_style',
					'ewf-item__border',
				),
			),
			'item_border_color'          => array(
				'label'     => esc_html__( 'Item Border Color Picker', 'portum' ),
				'type'      => 'epsilon-color-picker',
				'default'   => '',
				'mode'      => 'rgba',
				'condition' => array(
					'item_style',
					'ewf-item__border',
				),
			),
			'item_border_width'          => array(
				'label'     => esc_html__( 'Item Border Width', 'portum' ),
				'type'      => 'epsilon-slider',
				'default'   => 1,
				'choices'   => array(
					'min' => 1,
					'max' => 10,
				),
				'condition' => array(
					'item_style',
					'ewf-item__border',
				),
			),
			'services_slider'           => array(
				'label'    => esc_html__( 'Turn into a carousel', 'portum' ),
				'type'     => 'epsilon-toggle',
				'default'  => false,
				'priority' => 9,
			),
			'services_slider_autostart' => array(
				'label'     => esc_html__( 'Autostart', 'portum' ),
				'type'      => 'epsilon-toggle',
				'default'   => true,
				'condition' => array( 'services_slider', true ),
			),
			'services_slider_infinite'  => array(
				'label'     => esc_html__( 'Infinite slides', 'portum' ),
				'type'      => 'epsilon-toggle',
				'default'   => true,
				'condition' => array( 'services_slider', true ),
			),
			'services_slider_pager'     => array(
				'label'     => esc_html__( 'Navigation Dots', 'portum' ),
				'type'      => 'epsilon-toggle',
				'default'   => true,
				'condition' => array( 'services_slider', true ),
			),
			'services_slider_controls'  => array(
				'label'     => esc_html__( 'Navigation Arrows', 'portum' ),
				'type'      => 'epsilon-toggle',
				'default'   => false,
				'condition' => array( 'services_slider', true ),
			),
			'services_slider_speed'     => array(
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
			'services_slides_shown'     => array(
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
			'services_slides_scrolled'  => array(
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
		);
	}
}
