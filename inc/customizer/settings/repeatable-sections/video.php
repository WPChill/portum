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
 * Class Repeatable_Section_Video
 */
class Repeatable_Section_Video extends Repeatable_Section {

	/**
	 * Sets the section id
	 */
	public function set_id() {
		$this->id = 'video';
	}

	/**
	 * Sets section title
	 */
	public function set_title() {
		$this->title = esc_html__( 'Video', 'portum' );
	}

	/**
	 * Description
	 */
	public function set_description() {
		$this->description = esc_html__( 'A section witch allows you to add a video', 'portum' );
	}

	/**
	 * Sets section image
	 */
	public function set_image() {
		$this->image = esc_url( get_template_directory_uri() . '/assets/images/sections/ewf-icon-section-video-pt.png' );
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
			'video_row_title_align'           => array(
				'id'          => 'video_row_title_align',
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
			'video_column_stretch'            => array(
				'id'          => 'video_column_stretch',
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
			'video_column_alignment'          => array(
				'id'          => 'video_column_alignment',
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
			'video_column_vertical_alignment' => array(
				'id'          => 'video_column_vertical_alignment',
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
			'video_background_type'        => array(
				'id'      => 'video_background_type',
				'label'   => esc_html__( 'Background Type', 'epsilon-framework' ),
				'type'    => 'select',
				'choices' => array(
					'bgimage' => __( 'Image', 'epsilon-framework' ),
					'bgcolor' => __( 'Solid Color', 'epsilon-framework' ),
				),
				'group'   => 'background',
			),
			'video_background_color'       => array(
				'id'         => 'video_background_color',
				'label'      => esc_html__( 'Background Color', 'epsilon-framework' ),
				'default'    => '',
				'type'       => 'epsilon-color-picker',
				'mode'       => 'rgba',
				'defaultVal' => '#EEE',
				'group'      => 'background',
				'condition'  => array(
					'video_background_type',
					'bgcolor',
				),
			),
			'video_background_image'       => array(
				'id'          => 'video_background_image',
				'label'       => esc_html__( 'Background Image', 'epsilon-framework' ),
				'description' => esc_html__( 'Use this field to set a background image. Content will overlay on top of the image.', 'epsilon-framework' ),
				'type'        => 'epsilon-image',
				'default'     => '',
				'group'       => 'background',
				'size'        => 'full',
				'sizeArray'   => $sizes,
				'mode'        => 'url',
				'condition'   => array(
					'video_background_type',
					'bgimage',
				),
			),
			'video_background_image_color' => array(
				'id'         => 'video_background_color',
				'label'      => esc_html__( 'Background Image Color Overlay', 'epsilon-framework' ),
				'default'    => '',
				'type'       => 'epsilon-color-picker',
				'mode'       => 'rgba',
				'defaultVal' => '',
				'group'      => 'background',
				'condition'  => array(
					'video_background_type',
					'bgimage',
				),
			),
			'video_background_position'    => array(
				'id'          => 'video_background_position',
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
					'video_background_type',
					'bgimage',
				),
			),
			'video_background_size'        => array(
				'id'          => 'video_background_size',
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
					'video_background_type',
					'bgimage',
				),

			),
			'video_background_repeat'      => array(
				'id'          => 'video_background_repeat',
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
					'video_background_type',
					'bgimage',
				),
			),
			'video_background_parallax'    => array(
				'id'          => 'video_background_parallax',
				'label'       => esc_html__( 'Background Parallax', 'epsilon-framework' ),
				'description' => esc_html__( 'Toggling this to ON will enable the parallax effect. Make sure you have a  background image set before enabling it.', 'epsilon-framework' ),
				'default'     => false,
				'type'        => 'epsilon-toggle',
				'group'       => 'background',
				'condition'   => array(
					'video_background_type',
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
			'video_title_misc_font_color' => array(
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
			'video_text_misc_font_color'  => array(
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
		);
	}
}
