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
 * Class Repeatable_Section_Features
 */
class Repeatable_Section_Features extends Repeatable_Section {

	/**
	 * Sets the section id
	 */
	public function set_id() {
		$this->id = 'features';
	}

	/**
	 * Sets section title
	 */
	public function set_title() {
		$this->title = esc_html__( 'Features', 'portum' );
	}

	/**
	 * Description
	 */
	public function set_description() {
		$this->description = esc_html__( 'Features section. It retrieves content from Theme Content / features', 'portum' );
	}

	/**
	 * Sets section image
	 */
	public function set_image() {
		$this->image = esc_url( get_template_directory_uri() . '/assets/images/sections/ewf-icon-section-features-pt.jpg' );
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
			'features_column_stretch' => array(
				'id'          => 'features_column_stretch',
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
			'features_background_type'        => array(
				'id'      => 'features_background_type',
				'label'   => esc_html__( 'Background Type', 'epsilon-framework' ),
				'type'    => 'select',
				'choices' => array(
					'bgimage' => __( 'Image', 'epsilon-framework' ),
					'bgcolor' => __( 'Solid Color', 'epsilon-framework' ),
				),
				'group'   => 'background',
			),
			'features_background_color'       => array(
				'id'         => 'features_background_color',
				'label'      => esc_html__( 'Background Color', 'epsilon-framework' ),
				'default'    => '',
				'type'       => 'epsilon-color-picker',
				'mode'       => 'rgba',
				'defaultVal' => '#EEE',
				'group'      => 'background',
				'condition'  => array(
					'features_background_type',
					'bgcolor',
				),
			),
			'features_background_image'       => array(
				'id'          => 'features_background_image',
				'label'       => esc_html__( 'Background Image', 'epsilon-framework' ),
				'description' => esc_html__( 'Use this field to set a background image. Content will overlay on top of the image.', 'epsilon-framework' ),
				'type'        => 'epsilon-image',
				'default'     => '',
				'group'       => 'background',
				'size'        => 'full',
				'sizeArray'   => $sizes,
				'mode'        => 'url',
				'condition'   => array(
					'features_background_type',
					'bgimage',
				),
			),
			'features_background_image_color' => array(
				'id'         => 'features_background_color',
				'label'      => esc_html__( 'Background Image Color Overlay', 'epsilon-framework' ),
				'default'    => '',
				'type'       => 'epsilon-color-picker',
				'mode'       => 'rgba',
				'defaultVal' => '',
				'group'      => 'background',
				'condition'  => array(
					'features_background_type',
					'bgimage',
				),
			),
			'features_background_position'    => array(
				'id'          => 'features_background_position',
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
					'features_background_type',
					'bgimage',
				),
			),
			'features_background_size'        => array(
				'id'          => 'features_background_size',
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
					'features_background_type',
					'bgimage',
				),

			),
			'features_background_repeat'      => array(
				'id'          => 'features_background_repeat',
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
					'features_background_type',
					'bgimage',
				),
			),
			'features_background_parallax'    => array(
				'id'          => 'features_background_parallax',
				'label'       => esc_html__( 'Background Parallax', 'epsilon-framework' ),
				'description' => esc_html__( 'Toggling this to ON will enable the parallax effect. Make sure you have a  background image set before enabling it.', 'epsilon-framework' ),
				'default'     => false,
				'type'        => 'epsilon-toggle',
				'group'       => 'background',
				'condition'   => array(
					'features_background_type',
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
			'features_title_misc_font_color' => array(
				'selectors'     => array(
					'h1',
					'h2',
					'h3',
					'h4',
					'h5',
					'h6',
					'.headline span:not(.dashicons)',
					'.headline h3',
					'.features-item span:not(.dashicons)',
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
			'features_text_misc_font_color'  => array(
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
			'features_title'             => array(
				'label'             => esc_html__( 'Title', 'portum' ),
				'description'       => esc_html__( 'Section title', 'portum' ),
				'type'              => 'text',
				'default'           => wp_kses_post( 'We offer:' ),
				'sanitize_callback' => 'wp_kses_post',
			),
			'features_subtitle'          => array(
				'label'             => esc_html__( 'Subtitle', 'portum' ),
				'description'       => esc_html__( 'Section subtitle', 'portum' ),
				'type'              => 'text',
				'default'           => wp_kses_post( 'features' ),
				'sanitize_callback' => 'wp_kses_post',
			),
			'features_description'       => array(
				'label'             => esc_html__( 'Description', 'portum' ),
				'description'       => esc_html__( 'This works best in conjuction with left and right content layouts. Use it to shortly describe your features.', 'portum' ),
				'type'              => 'textarea',
				'default'           => esc_html__( 'Describe your features.', 'portum' ),
				'sanitize_callback' => 'wp_kses_post',
			),
			'features_image'             => array(
				'label'             => esc_html__( 'Main Image', 'portum' ),
				'description'       => esc_html__( 'This is the image that will be displaye between the icons.', 'portum' ),
				'type'              => 'epsilon-image',
				'sanitize_callback' => 'wp_kses_post',
			),
			'features_section_unique_id' => array(
				'label'             => esc_html__( 'Section ID', 'portum' ),
				'description'       => esc_html__( 'Section Unique ID. Useful if you are looking to target this particular section with CSS / jQuery. Very useful as well for creating the one-page effect with smooth scrolling to section.', 'portum' ),
				'type'              => 'text',
				'sanitize_callback' => 'sanitize_key',
			),
			'features_grouping'          => array(
				'label'       => esc_html__( 'Filter shown features', 'portum' ),
				'description' => esc_html__( 'The items you select in here are the only ones which will be displayed on this page. Think of the information you create in a section similar to a blog post. They are all created in a single place, but filtered by category. If you want to use multiple sections and display different information in each of them, use the filtering. ', 'portum' ),
				'type'        => 'selectize',
				'multiple'    => true,
				'choices'     => Portum_Helper::get_group_values_from_meta( 'portum_features', 'feature_title' ),
				'linking'     => array( 'portum_features', 'feature_title' ),
				'default'     => array( 'all' ),
			),
			'features_navigation'        => array(
				'type'            => 'epsilon-customizer-navigation',
				'opensDoubled'    => true,
				'navigateToId'    => 'portum_features_section',
				'navigateToLabel' => esc_html__( 'Add/Edit features &rarr;', 'portum' ),
			),
			'features_repeater_field'    => array(
				'type'    => 'hidden',
				'default' => 'portum_features',
			),
		);
	}
}
