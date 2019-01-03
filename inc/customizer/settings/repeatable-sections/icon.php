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
 * Class Repeatable_Section_About
 */
class Repeatable_Section_Icon_Boxes extends Repeatable_Section {

	/**
	 * Sets the section id
	 */
	public function set_id() {
		$this->id = 'iconboxes';
	}

	/**
	 * Sets section title
	 */
	public function set_title() {
		$this->title = esc_html__( 'Icon Boxes', 'portum' );
	}

	/**
	 * Description
	 */
	public function set_description() {
		$this->description = esc_html__( 'Adds an icon section.', 'portum' );
	}

	/**
	 * Sets section image
	 */
	public function set_image() {
		$this->image = esc_url( get_template_directory_uri() . '/assets/images/sections/ewf-icon-section-clients.png' );
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
		);
	}

	/**
	 * Creates the section fields
	 */
	public function create_fields() {
		$this->fields = array_merge( $this->layout_fields(), $this->background_fields(), $this->normal_fields() );
	}

	/**
	 * Layout fields
	 *
	 * @return array
	 */
	public function layout_fields() {
		$custom_fields = array(
			'iconboxes_column_stretch'            => array(
				'id'          => 'iconboxes_column_stretch',
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
			'iconboxes_column_group'              => array(
				'id'          => 'iconboxes_column_group',
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
			'iconboxes_column_spacing'            => array(
				'id'      => 'iconboxes_column_spacing',
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
			'iconboxes_column_alignment'          => array(
				'id'          => 'iconboxes_column_alignment',
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
			'iconboxes_column_vertical_alignment' => array(
				'id'          => 'iconboxes_column_vertical_alignment',
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
			'iconboxes_background_type'        => array(
				'id'      => 'iconboxes_background_type',
				'label'   => esc_html__( 'Background Type', 'epsilon-framework' ),
				'type'    => 'select',
				'choices' => array(
					'bgimage' => __( 'Image', 'epsilon-framework' ),
					'bgcolor' => __( 'Solid Color', 'epsilon-framework' ),
				),
				'group'   => 'background',
			),
			'iconboxes_background_color'       => array(
				'id'         => 'iconboxes_background_color',
				'label'      => esc_html__( 'Background Color', 'epsilon-framework' ),
				'default'    => '',
				'type'       => 'epsilon-color-picker',
				'mode'       => 'rgba',
				'defaultVal' => '#EEE',
				'group'      => 'background',
				'condition'  => array(
					'iconboxes_background_type',
					'bgcolor',
				),
			),
			'iconboxes_background_image'       => array(
				'id'          => 'iconboxes_background_image',
				'label'       => esc_html__( 'Background Image', 'epsilon-framework' ),
				'description' => esc_html__( 'Use this field to set a background image. Content will overlay on top of the image.', 'epsilon-framework' ),
				'type'        => 'epsilon-image',
				'default'     => '',
				'group'       => 'background',
				'size'        => 'full',
				'sizeArray'   => $sizes,
				'mode'        => 'url',
				'condition'   => array(
					'iconboxes_background_type',
					'bgimage',
				),
			),
			'iconboxes_background_image_color' => array(
				'id'         => 'iconboxes_background_color',
				'label'      => esc_html__( 'Background Image Color Overlay', 'epsilon-framework' ),
				'default'    => '',
				'type'       => 'epsilon-color-picker',
				'mode'       => 'rgba',
				'defaultVal' => '',
				'group'      => 'background',
				'condition'  => array(
					'iconboxes_background_type',
					'bgimage',
				),
			),
			'iconboxes_background_position'    => array(
				'id'          => 'iconboxes_background_position',
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
					'iconboxes_background_type',
					'bgimage',
				),
			),
			'iconboxes_background_size'        => array(
				'id'          => 'iconboxes_background_size',
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
					'iconboxes_background_type',
					'bgimage',
				),

			),
			'iconboxes_background_repeat'      => array(
				'id'          => 'iconboxes_background_repeat',
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
					'iconboxes_background_type',
					'bgimage',
				),
			),
			'iconboxes_background_parallax'    => array(
				'id'          => 'iconboxes_background_parallax',
				'label'       => esc_html__( 'Background Parallax', 'epsilon-framework' ),
				'description' => esc_html__( 'Toggling this to ON will enable the parallax effect. Make sure you have a  background image set before enabling it.', 'epsilon-framework' ),
				'default'     => false,
				'type'        => 'epsilon-toggle',
				'group'       => 'background',
				'condition'   => array(
					'iconboxes_background_type',
					'bgimage',
				),
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
			'icon_position'                => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Icon Position', 'epsilon-framework' ),
				'choices' => array(
					'top'   => esc_html__( 'Top', 'epsilon-framework' ),
					'left'  => esc_html__( 'Left', 'epsilon-framework' ),
					'right' => esc_html__( 'Right', 'epsilon-framework' ),
				),
				'default' => 'left',
			),
			'iconboxes_section_unique_id' => array(
				'label'             => esc_html__( 'Section ID', 'portum' ),
				'type'              => 'text',
				'sanitize_callback' => 'sanitize_key',
			),
			'iconboxes_grouping'          => array(
				'label'       => esc_html__( 'Filter shown icon boxes', 'portum' ),
				'description' => esc_html__( 'The items you select in here are the only ones which will be displayed on this page. Think of the information you create in a section similar to a blog post. They are all created in a single place, but filtered by category. If you want to use multiple sections and display different information in each of them, use the filtering. ', 'portum' ),
				'type'        => 'selectize',
				'multiple'    => true,
				'choices'     => Portum_Helper::get_group_values_from_meta( 'portum_icons', 'service_title' ),
				'linking'     => array( 'portum_icons', 'icon_title' ),
				'default'     => array( 'all' ),
			),
			'iconboxes_navigation'        => array(
				'type'            => 'epsilon-customizer-navigation',
				'opensDoubled'    => true,
				'navigateToId'    => 'portum_iconboxes_section',
				'navigateToLabel' => esc_html__( 'Add/Edit Icons &rarr;', 'portum' ),
			),
		);
	}
}
