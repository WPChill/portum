<?php
/**
 * Portum Theme Customizer Panels & Sections
 *
 * @package Portum
 * @since   1.0
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Register customizer panels
 */
$panels = array(
	/**
	 * General panel
	 */
	array(
		'id'   => 'portum_panel_general',
		'args' => array(
			'priority'       => 24,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => esc_html__( 'General options', 'portum' ),
		),
	),
	/**
	 * Content Panel
	 */
	array(
		'id'   => 'portum_panel_content',
		'args' => array(
			'priority'       => 27,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'type'           => 'epsilon-panel-regular',
			'title'          => esc_html__( 'Epsilon Editor', 'portum' ),
			'hidden'         => true,
		),
	),
	/**
	 * Color panel
	 */
	array(
		'id'   => 'portum_panel_colors',
		'args' => array(
			'priority'       => 29,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => esc_html__( 'Colors', 'portum' ),
		),
	),
	/**
	 * Customization panel
	 */
	array(
		'id'   => 'portum_panel_customization',
		'args' => array(
			'priority'       => 28,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => esc_html__( 'Customization', 'portum' ),
		),
	),


	/**
	 * Content panel
	 */
	array(
		'id'   => 'portum_panel_section_content',
		'args' => array(
			'priority'       => 9999,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'type'           => 'epsilon-panel-regular',
			'title'          => esc_html__( 'Front Page Content', 'portum' ),
			'panel'          => 'portum_panel_content',
			'hidden'         => true,
		),
	),
);

/**
 * Register sections
 */
$sections = array(

	/**
	 * feedback section
	 */
	array(
		'id'   => 'portum_feedback_section',
		'args' => array(
			'type'        => 'epsilon-section-pro',
			'title'       => esc_html__( 'Help make Portum better', 'sparkling' ),
			'button_text' => esc_html__( 'Send Feedback', 'sparkling' ),
			'button_url'  => esc_url_raw( 'http://bit.ly/feedback-portum' ),
			'priority'    => 0,
		),
	),

	/**
	 * Recommended actions section
	 */
	array(
		'id'   => 'portum_recomended_section',
		'args' => array(
			'type'                         => 'epsilon-section-recommended-actions',
			'title'                        => esc_html__( 'Recomended Actions', 'portum' ),
			'social_text'                  => esc_html__( 'Macho Themes is also social', 'portum' ),
			'plugin_text'                  => esc_html__( 'Recomended Plugins', 'portum' ),
			'actions'                      => Portum_Dashboard_Setup::get_instance()->get_actions(),
			'plugins'                      => Portum_Dashboard_Setup::get_instance()->get_plugins(),
			'theme_specific_option'        => Portum_Dashboard_Setup::get_instance()->theme['theme-slug'] . '_actions_left',
			'theme_specific_plugin_option' => Portum_Dashboard_Setup::get_instance()->theme['theme-slug'] . '_plugins_left',
			'facebook'                     => 'https://www.facebook.com/machothemes',
			'twitter'                      => 'https://twitter.com/MachoThemez',
			'wp_review'                    => false,
			'priority'                     => 0,
		),
	),



	/**
	 * General section
	 */
	array(
		'id'   => 'portum_header_section',
		'args' => array(
			'title'    => esc_html__( 'Header', 'portum' ),
			'panel'    => 'portum_panel_general',
			'priority' => 1,
		),
	),
	array(
		'id'   => 'portum_typography_section',
		'args' => array(
			'title'    => esc_html__( 'Typography', 'portum' ),
			'panel'    => 'portum_panel_customization',
			'priority' => 2,
		),
	),
	array(
		'id'   => 'portum_layout_section',
		'args' => array(
			'title'    => esc_html__( 'Layout', 'portum' ),
			'panel'    => 'portum_panel_customization',
			'priority' => 3,
		),
	),

	array(
		'id'   => 'portum_footer_section',
		'args' => array(
			'title'    => esc_html__( 'Footer', 'portum' ),
			'panel'    => 'portum_panel_general',
			'priority' => 50,
		),
	),
	array(
		'id'   => 'portum_misc_section',
		'args' => array(
			'title'    => esc_html__( 'API Keys', 'portum' ),
			'panel'    => 'portum_panel_general',
			'priority' => 60,
		),
	),
	/**
	 * Repeatable sections container
	 */
	array(
		'id'   => 'portum_repeatable_section',
		'args' => array(
			'title'       => esc_html__( 'Epsilon Editor', 'portum' ),
			'description' => esc_html__( 'You can rearrange the sections below using drag & drop', 'portum' ),
			'priority'    => 0,
			//'panel'       => 'portum_panel_content',
		),
	),

	/**
	 * Theme Content Sections
	 */
	array(
		'id'   => 'portum_contact_section',
		'args' => array(
			'title'    => esc_html__( 'Contact Information', 'portum' ),
			'panel'    => 'portum_panel_section_content',
			'priority' => 0,
			'type'     => 'epsilon-section-doubled',
		),
	),
	array(
		'id'   => 'portum_counters_section',
		'args' => array(
			'title'    => esc_html__( 'Counter Section', 'portum' ),
			'panel'    => 'portum_panel_section_content',
			'priority' => 1,
			'type'     => 'epsilon-section-doubled',
		),
	),
	array(
		'id'   => 'portum_testimonials_section',
		'args' => array(
			'title'    => esc_html__( 'Testimonials', 'portum' ),
			'panel'    => 'portum_panel_section_content',
			'priority' => 2,
			'type'     => 'epsilon-section-doubled',
		),
	),
	array(
		'id'   => 'portum_slides_section',
		'args' => array(
			'title'    => esc_html__( 'Slides', 'portum' ),
			'panel'    => 'portum_panel_section_content',
			'priority' => 3,
			'type'     => 'epsilon-section-doubled',
		),
	),
	array(
		'id'   => 'portum_advanced_slides_section',
		'args' => array(
			'title'    => esc_html__( 'Slides', 'portum' ),
			'panel'    => 'portum_panel_section_content',
			'priority' => 7,
			'type'     => 'epsilon-section-doubled',
		),
	),
	array(
		'id'   => 'portum_services_section',
		'args' => array(
			'title'    => esc_html__( 'Services', 'portum' ),
			'panel'    => 'portum_panel_section_content',
			'priority' => 4,
			'type'     => 'epsilon-section-doubled',
		),
	),
	array(
		'id'   => 'portum_portfolio_section',
		'args' => array(
			'title'    => esc_html__( 'Portfolio', 'portum' ),
			'panel'    => 'portum_panel_section_content',
			'priority' => 5,
			'type'     => 'epsilon-section-doubled',
		),
	),
	array(
		'id'   => 'portum_expertise_section',
		'args' => array(
			'title'    => esc_html__( 'Expertise', 'portum' ),
			'panel'    => 'portum_panel_section_content',
			'priority' => 6,
			'type'     => 'epsilon-section-doubled',
		),
	),
	array(
		'id'   => 'portum_team_members_section',
		'args' => array(
			'title'    => esc_html__( 'Team Members', 'portum' ),
			'panel'    => 'portum_panel_section_content',
			'priority' => 7,
			'type'     => 'epsilon-section-doubled',
		),
	),
	array(
		'id'   => 'portum_pricing_section',
		'args' => array(
			'title'    => esc_html__( 'Price Boxes', 'portum' ),
			'panel'    => 'portum_panel_section_content',
			'priority' => 8,
			'type'     => 'epsilon-section-doubled',
		),
	),
	array(
		'id'   => 'portum_progress_bars_section',
		'args' => array(
			'title'    => esc_html__( 'Progress Bars Section', 'portum' ),
			'panel'    => 'portum_panel_section_content',
			'priority' => 9,
			'type'     => 'epsilon-section-doubled',
		),
	),
	array(
		'id'   => 'portum_piecharts_section',
		'args' => array(
			'title'    => esc_html__( 'Pie Charts Section', 'portum' ),
			'panel'    => 'portum_panel_section_content',
			'priority' => 10,
			'type'     => 'epsilon-section-doubled',
		),
	),
	array(
		'id'   => 'portum_clientlists_section',
		'args' => array(
			'title'    => esc_html__( 'Client Logos Section', 'portum' ),
			'panel'    => 'portum_panel_section_content',
			'priority' => 11,
			'type'     => 'epsilon-section-doubled',
		),
	),
);

$visible_recommended = get_option( 'portum_recommended_actions', false );
if ( $visible_recommended ) {
	unset( $sections[0] );
}

$collection = array(
	'panel'   => $panels,
	'section' => $sections,
);

Epsilon_Customizer::add_multiple( $collection );
