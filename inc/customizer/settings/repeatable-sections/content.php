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
class Repeatable_Section_Content extends Repeatable_Section {

	/**
	 * Sets the section id
	 */
	public function set_id() {
		$this->id = 'content';
	}

	/**
	 * Sets section title
	 */
	public function set_title() {
		$this->title = esc_html__( 'Page Content Section', 'portum' );
	}

	/**
	 * Description
	 */
	public function set_description() {
		$this->description = esc_html__( 'Section that outputs page content.', 'portum' );
	}

	/**
	 * Sets section image
	 */
	public function set_image() {
		$this->image = esc_url( get_template_directory_uri() . '/assets/images/sections/ewf-icon-section-content-pt.jpg' );
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
			'content_column_stretch'            => array(
				'id'          => 'content_column_stretch',
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
			'content_column_alignment'          => array(
				'id'          => 'content_column_alignment',
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
			'content_column_vertical_alignment' => array(
				'id'          => 'content_column_vertical_alignment',
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
			'content_background_type'        => array(
				'id'      => 'content_background_type',
				'label'   => esc_html__( 'Background Type', 'epsilon-framework' ),
				'type'    => 'select',
				'choices' => array(
					'bgimage' => __( 'Image', 'epsilon-framework' ),
					'bgcolor' => __( 'Solid Color', 'epsilon-framework' ),
				),
				'group'   => 'background',
			),
			'content_background_color'       => array(
				'id'         => 'content_background_color',
				'label'      => esc_html__( 'Background Color', 'epsilon-framework' ),
				'default'    => '',
				'type'       => 'epsilon-color-picker',
				'mode'       => 'rgba',
				'defaultVal' => '#EEE',
				'group'      => 'background',
				'condition'  => array(
					'content_background_type',
					'bgcolor',
				),
			),
			'content_background_image'       => array(
				'id'          => 'content_background_image',
				'label'       => esc_html__( 'Background Image', 'epsilon-framework' ),
				'description' => esc_html__( 'Use this field to set a background image. Content will overlay on top of the image.', 'epsilon-framework' ),
				'type'        => 'epsilon-image',
				'default'     => '',
				'group'       => 'background',
				'size'        => 'full',
				'sizeArray'   => $sizes,
				'mode'        => 'url',
				'condition'   => array(
					'content_background_type',
					'bgimage',
				),
			),
			'content_background_image_color' => array(
				'id'         => 'content_background_color',
				'label'      => esc_html__( 'Background Image Color Overlay', 'epsilon-framework' ),
				'default'    => '',
				'type'       => 'epsilon-color-picker',
				'mode'       => 'rgba',
				'defaultVal' => '',
				'group'      => 'background',
				'condition'  => array(
					'content_background_type',
					'bgimage',
				),
			),
			'content_background_position'    => array(
				'id'          => 'content_background_position',
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
					'content_background_type',
					'bgimage',
				),
			),
			'content_background_size'        => array(
				'id'          => 'content_background_size',
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
					'content_background_type',
					'bgimage',
				),

			),
			'content_background_repeat'      => array(
				'id'          => 'content_background_repeat',
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
					'content_background_type',
					'bgimage',
				),
			),
			'content_background_parallax'    => array(
				'id'          => 'content_background_parallax',
				'label'       => esc_html__( 'Background Parallax', 'epsilon-framework' ),
				'description' => esc_html__( 'Toggling this to ON will enable the parallax effect. Make sure you have a  background image set before enabling it.', 'epsilon-framework' ),
				'default'     => false,
				'type'        => 'epsilon-toggle',
				'group'       => 'background',
				'condition'   => array(
					'content_background_type',
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
			'content_title_misc_font_color' => array(
				'selectors'     => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', '.headline span' ),
				'css-attribute' => 'color',
				'default'       => '',
				'label'         => __( 'Section Title Color', 'epsilon-framework' ),
				'description'   => '',
				'type'          => 'epsilon-color-picker',
				'mode'          => 'rgba',
				'defaultVal'    => '',
				'group'         => 'colors',
			),
			'content_text_misc_font_color'  => array(
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
			'content_page_id'           => array(
				'label'   => esc_html__( 'Page Id', 'portum' ),
				'type'    => 'select',
				'choices' => $this->get_pages(),
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
		);
	}

	/**
	 * Helper Function to get all pages
	 *
	 * @return array
	 */
	private function get_pages() {

		$choices = array(
			'' => __( 'Current Page', 'portum' ),
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
			$choices[ $page->ID ] = $page->post_title;
		}

		return $choices;

	}
}
