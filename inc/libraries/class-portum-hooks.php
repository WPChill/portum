<?php
/**
 * Portum Theme Hooks
 *
 * @package Portum
 * @since   1.0
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Class Portum_Hooks
 */
class Portum_Hooks {
	/**
	 * Portum_Hooks constructor.
	 */
	public function __construct() {
		/**
		 * Custom body classes
		 */
		add_filter( 'body_class', array( $this, 'body_classes' ) );
		/**
		 * Flush the category transient on category edit or post save
		 */
		add_action( 'edit_category', array( $this, 'category_transient_flusher' ) );
		add_action( 'save_post', array( $this, 'category_transient_flusher' ) );
		/**
		 * Add a <span> html tag to the category item
		 */
		// add_filter( 'wp_list_categories', array( $this, 'add_span_to_count' ) );
		// add_filter( 'get_archives_link', array( $this, 'add_span_to_count' ) );
		/**
		 * Fix responsive videos
		 */
		add_filter( 'embed_oembed_html', array( $this, 'fix_responsive_videos' ), 10, 3 );
		add_filter( 'video_embed_html', array( $this, 'fix_responsive_videos' ) );
		/**
		 * Custom Image Sizes available in JS
		 */
		add_filter( 'image_size_names_choose', array( $this, 'custom_image_sizes' ) );
		/**
		 * Override text domain for the framework
		 */
		add_filter( 'override_load_textdomain', array( $this, 'override_load_textdomain' ), 10, 2 );


		// Template hooks
		require_once get_template_directory() . '/inc/template-functions.php';
		add_action( 'portum_header', 'portum_header', 10 );

		// Customizer hooks
		add_action( 'customize_register', array( $this, 'add_button_controls' ), 100 );
		add_action( 'customize_register', array( $this, 'add_icon_controls' ), 100 );
		add_filter( 'portum_section_collection', array( $this, 'enhance_sections' ) );
	}

	/**
	 * Allow multiple textdomains in a theme
	 * https://gist.github.com/justintadlock/7a605c29ae26c80878d0
	 *
	 * @param string $override Text domain used as override.
	 * @param string $domain   Current domain override.
	 *
	 * @return string
	 */
	public function override_load_textdomain( $override, $domain ) {
		if ( 'epsilon-framework' === $domain ) {
			global $l10n;
			if ( isset( $l10n['portum'] ) ) {
				$l10n[ $domain ] = $l10n['portum'];
			}

			$override = true;
		}

		return $override;
	}

	/**
	 * Filter the categories widget to add a <span> element before the count
	 *
	 * @param string $links link html string.
	 *
	 * @return mixed
	 */
	public function add_span_to_count( $links = '' ) {
		$links = str_replace( '</a>&nbsp;(', '</a> <span class="portum-count">', $links );
		$links = str_replace( ')', '</span>', $links );

		return $links;
	}

	/**
	 * Flush out the transients used in categorized blog.
	 */
	public function category_transient_flusher() {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		// Like, beat it. Dig?
		delete_transient( 'portum_categories' );
	}

	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 *
	 * @return array
	 */
	public function body_classes( $classes ) {
		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}

		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

		// Add sticky class to body.
		$header_sticky = get_theme_mod( 'portum_header_sticky', true );
		if ( $header_sticky ) {
			$classes[] = 'sticky-header';
		}

		return $classes;
	}

	/**
	 * Adds the responsive container to the video embeds
	 *
	 * @param string $html html string.
	 *
	 * @return string
	 */
	public function fix_responsive_videos( $html ) {
		return '<div class="responsive-video-container">' . $html . '</div>';
	}

	/**
	 * Return more image sizes
	 *
	 * @param array $sizes Array of sizes.
	 *
	 * @return array
	 */
	public function custom_image_sizes( $sizes ) {
		$custom_sizes = array(
			'portum-main-slider'          => esc_html__( 'Main Slider', 'portum' ),
			'portum-blog-section-image'   => esc_html__( 'Blog Section Image', 'portum' ),
			'portum-portfolio-image'      => esc_html__( 'Portfolio Image', 'portum' ),
			'portum-team-image'           => esc_html__( 'Team Portrait', 'portum' ),
			'portum-blog-post-image'      => esc_html__( 'Blog Post Image', 'portum' ),
			// 'portum-testimonial-portrait' => esc_html__( 'Testimonial Portrait', 'portum' ),
			//'portum-about-image'          => esc_html__( 'About Image', 'portum' ),
			//'portum-expertise-image'      => esc_html__( 'Expertise Image', 'portum' ),
		);

		return array_merge( $sizes, $custom_sizes );
	}

	/**
	 * Adds controls in the customizer for button size, radius, colors etc.
	 */
	public function add_button_controls( $wp_customize ) {

 		$slide = $wp_customize->get_control( 'portum_advanced_slides' );
		$button_controls = Portum_Helper::generate_button_controls( 'slide_cta_primary', __( 'Primary Button', 'portum' ) );
		$slide->fields = Portum_Helper::array_insert_after( $slide->fields, 'slide_cta_primary_url', $button_controls );
		$button_controls = Portum_Helper::generate_button_controls( 'slide_cta_secondary', __( 'Secondary Button', 'portum' ) );
		$slide->fields = Portum_Helper::array_insert_after( $slide->fields, 'slide_cta_secondary_url', $button_controls );

 	 	$price_box = $wp_customize->get_control( 'portum_price_boxes' );
		$button_controls = Portum_Helper::generate_button_controls( 'price_box_button', __( 'Button', 'portum' ) );
		$price_box->fields = Portum_Helper::array_insert_after( $price_box->fields, 'price_box_button_url', $button_controls );
	}

	/**
	 * Adds controls in the customizer for icon colors, radius, size etc.
	 */
	public function add_icon_controls( $wp_customize ) {

		$counter_box = $wp_customize->get_control( 'portum_counter_boxes' );
		$icon_controls = Portum_Helper::generate_icon_controls( 'counter_icon', __( 'Icon', 'portum' ), array( 'counter_icon_display', true ) );
		$counter_box->fields = Portum_Helper::array_insert_after( $counter_box->fields, 'counter_icon_color', $icon_controls );

 		$feature = $wp_customize->get_control( 'portum_features' );
		$icon_controls = Portum_Helper::generate_icon_controls( 'feature_icon', __( 'Icon', 'portum' ) );
		$feature->fields = Portum_Helper::array_insert_after( $feature->fields, 'feature_icon_color', $icon_controls );

		$price_box = $wp_customize->get_control( 'portum_price_boxes' );
		$icon_controls = Portum_Helper::generate_icon_controls( 'price_box_icon', __( 'Icon', 'portum' ), array( 'price_box_icon_display', true ) );
		$price_box->fields = Portum_Helper::array_insert_after( $price_box->fields, 'price_box_icon_color', $icon_controls );

		$service = $wp_customize->get_control( 'portum_services' );
		$icon_controls = Portum_Helper::generate_icon_controls( 'service_icon', __( 'Icon', 'portum' ) );
		$service->fields = Portum_Helper::array_insert_after( $service->fields, 'service_icon_color', $icon_controls );

		$icon_box = $wp_customize->get_control( 'portum_icons' );
		$icon_controls = Portum_Helper::generate_icon_controls( 'icon', __( 'Icon', 'portum' ) );
		$icon_box->fields = Portum_Helper::array_insert_after( $icon_box->fields, 'icon_color', $icon_controls );
	}

		/**
	 * Enhances sections
	 */
	public function enhance_sections( $sections ) {

		// adds button style controls to appropriate sections.
		$button_controls = Portum_Helper::generate_button_controls( 'about_button_primary', __( 'Primary button', 'portum' ) );
		$sections['about']['fields'] = Portum_Helper::array_insert_after( $sections['about']['fields'], 'about_button_primary_url', $button_controls );

		$button_controls = Portum_Helper::generate_button_controls( 'blog_button', __( 'Button', 'portum' ) );
		$sections['blog']['fields'] = Portum_Helper::array_insert_after( $sections['blog']['fields'], 'blog_button_label', $button_controls );

		$button_controls = Portum_Helper::generate_button_controls( 'cta_button_primary', __( 'Primary button', 'portum' ) );
		$sections['cta']['fields'] = Portum_Helper::array_insert_after( $sections['cta']['fields'], 'cta_button_primary_url', $button_controls );

		$button_controls = Portum_Helper::generate_button_controls( 'cta_button_secondary', __( 'Secondary button', 'portum' ) );
		$sections['cta']['fields'] = Portum_Helper::array_insert_after( $sections['cta']['fields'], 'cta_button_secondary_url', $button_controls );

		$button_controls = Portum_Helper::generate_button_controls( 'instagram_button_primary', __( 'Primary button', 'portum' ) );
		$sections['instagram']['fields'] = Portum_Helper::array_insert_after( $sections['instagram']['fields'], 'instagram_button_primary_url', $button_controls );

		$button_controls = Portum_Helper::generate_button_controls( 'openhours_button_primary', __( 'Button', 'portum' ) );
		$sections['openhours']['fields'] = Portum_Helper::array_insert_after( $sections['openhours']['fields'], 'openhours_button_primary_url', $button_controls );

		return $sections;
	}

}
