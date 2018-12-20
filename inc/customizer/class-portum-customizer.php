<?php
/**
 * Portum Theme Customizer settings
 *
 * @package Portum
 * @since   1.0
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Class Portum_Customizer
 */
class Portum_Customizer {

	/**
	 * The basic constructor of the helper
	 * It changes the default panels of the customizer
	 *
	 * Portum_Customizer_Helper constructor.
	 */
	public function __construct() {
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'customizer_enqueue_scripts' ) );
		add_action( 'customize_preview_init', array( $this, 'customize_preview_js' ) );
		/**
		 * Customizer enqueues & controls
		 */
		add_action( 'customize_register', array( $this, 'add_theme_options' ), 99 );
		add_filter( 'epsilon_section_repeater_importable_sections', array( $this, 'add_importable_sections' ) );
		$this->change_default_panels();
	}

	/**
	 * Loads the settings for the panels
	 */
	public function add_theme_options() {
		$path = get_template_directory() . '/inc/customizer/settings';

		require_once $path . '/sections.php';
		require_once $path . '/fields.php';
	}

	/**
	 * Runs on initialization, changes the default panels to the Theme options
	 */
	public function change_default_panels() {
		global $wp_customize;

		/**
		 * Change transports
		 */
		$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
		$wp_customize->get_setting( 'custom_logo' )->transport     = 'refresh';

		/**
		 * Change panels
		 */
		$wp_customize->get_section( 'background_image' )->panel  = 'portum_panel_general';
		$wp_customize->get_section( 'static_front_page' )->panel = 'portum_panel_general';

		/**
		 * Change priorities
		 */
		$wp_customize->get_section( 'header_image' )->priority     = 51;
		$wp_customize->get_control( 'blogdescription' )->priority  = 17;
		$wp_customize->get_control( 'header_textcolor' )->priority = 15;


		/**
		 * Change labels
		 */
		$wp_customize->get_section( 'title_tagline' )->title       = esc_html__( 'Site Logo', 'portum' );
		$wp_customize->get_control( 'custom_logo' )->description   = esc_html__( 'The image logo, if set, will override the text logo. You can not have both at the same time. A tagline can be displayed under the text logo.', 'portum' );
		$wp_customize->get_section( 'header_image' )->title        = esc_html__( 'Blog', 'portum' );
		$wp_customize->get_control( 'page_on_front' )->description = esc_html__( 'If you have front-end sections, those will be displayed instead. Consider adding a "Content Section" if you need to display the page content as well.', 'portum' );


		/**
		 * Add another logo control for the sticky header.
		 */
 		$wp_customize->add_setting( 'portum_logo_sticky' , array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field',
		) );

		$wp_customize->add_control( new WP_Customize_Cropped_Image_Control(
			$wp_customize,
			'portum_logo_sticky',
			array(
				'label'       => __( 'Logo Sticky', 'portum' ),
				'description' => esc_html__( 'The logo that will be displayed when the header is sticky.', 'portum' ),
				'section'     => 'title_tagline',
				'settings'    => 'portum_logo_sticky',
				'priority'    => 8,
				'width'       => '150',
				'height'      => '150',
				'flex_width'  => true,
				'flex_height' => true,
			)
		));

		if ( ! isset( $wp_customize->selective_refresh ) ) {
			return;
		}

		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title',
			'render_callback' => function () {
				bloginfo( 'name' );
			},
		) );

		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => function () {
				bloginfo( 'description' );
			},
		) );
	}

	/**
	 * Our Customizer script
	 *
	 * Dependencies: Customizer Controls script (core)
	 */
	public function customizer_enqueue_scripts() {
		wp_enqueue_script( 'portum-customizer-scripts', get_template_directory_uri() . '/inc/customizer/assets/js/customizer.js', array( 'customize-controls' ) );

		wp_localize_script( 'portum-customizer-scripts', 'portumCustomizer', array(
			'templateDirectory' => esc_url( get_template_directory_uri() ),
			'ajaxNonce'         => wp_create_nonce( 'portum_nonce' ),
			'siteUrl'           => esc_url( get_site_url() ),
			'blogPage'          => esc_url( get_permalink( get_option( 'page_for_posts', false ) ) ),
			'frontPage'         => esc_url( get_permalink( get_option( 'page_on_front', false ) ) ),
		) );
	}

	/**
	 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
	 */
	public function customize_preview_js() {
		wp_enqueue_script( 'portum-previewer', get_template_directory_uri() . '/inc/customizer/assets/js/previewer.js', array( 'customize-preview' ), '211215', true );
	}

	/**
	 * @param $array
	 *
	 * @return array
	 */
	public function add_importable_sections( $array ) {
		$importables = array(
			/**
			 * First importable section
			 */
			'first'  => array(
				'id'       => 'first',
				'thumb'    => 'image link',
				'sections' => array(
					array(
						'cta_title'                => 'Cosmin',
						'cta_description'          => 'Cosmin Description',
						'cta_button_primary_label' => 'Label',
						'type'                     => 'cta',
					),
					array(
						'cta_title'                => 'Cristea',
						'cta_description'          => 'Cristea Description',
						'cta_button_primary_label' => 'Label',
						'type'                     => 'cta',
					),
				),
			),
			'second' => array(
				'id'       => 'second',
				'thumb'    => 'image link',
				'sections' => array(
					array(
						'cta_title'                => 'Cosmin',
						'cta_description'          => 'Cosmin Description',
						'cta_button_primary_label' => 'Label',
						'type'                     => 'cta',
					),
					array(
						'testimonials_title' => 'Cosmin testimonials',
						'type'               => 'testimonials',
					),
				),
			),
		);

		return array_merge( $array, $importables );
	}

	/**
	 * Active Callback for copyright
	 */
	public static function copyright_enabled_callback( $control ) {
		if ( $control->manager->get_setting( 'portum_enable_copyright' )->value() == true ) {
			return true;
		}

		return false;
	}
}
