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
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => esc_html__( 'Homepage Options', 'portum' ),
		),
	),

	/**
	 * Color panel
	 */
	array(
		'id'   => 'portum_panel_colors',
		'args' => array(
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => esc_html__( 'Colors', 'portum' ),
			'priority'       => 6,
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
			'title'       => esc_html__( 'Suggest a feature', 'portum' ),
			'button_text' => esc_html__( 'Send Feedback', 'portum' ),
			'button_url'  => esc_url_raw( 'http://bit.ly/feedback-portum' ),
			'priority'    => 0,
		),
	),


	/**
	 * General section
	 */
	array(
		'id'   => 'portum_header_section',
		'args' => array(
			'title'    => esc_html__( 'Header', 'portum' ),
			'priority' => 3,
		),
	),
	array(
		'id'   => 'portum_footer_section',
		'args' => array(
			'title'    => esc_html__( 'Footer', 'portum' ),
			'priority' => 4,
		),
	),
	array(
		'id'   => 'portum_typography_section',
		'args' => array(
			'title'    => esc_html__( 'Typography', 'portum' ),
			'priority' => 5,
		),
	),

	array(
		'id'   => 'portum_misc_section',
		'args' => array(
			'title' => esc_html__( 'Integrations', 'portum' ),
			'panel' => 'portum_panel_general',
			'type'  => 'outer',
		),
	),
	/**
	 * Repeatable sections container
	 */
	array(
		'id'   => 'portum_repeatable_section',
		'args' => array(
			'title'    => esc_html__( 'Epsilon Page Builder', 'portum' ),
			'priority' => 0,
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
		'id'   => 'portum_schedule_section',
		'args' => array(
			'title'    => esc_html__( 'Schedule', 'portum' ),
			'panel'    => 'portum_panel_section_content',
			'priority' => 11,
			'type'     => 'epsilon-section-doubled',
		),
	),
	array(
		'id'   => 'portum_accordion_section',
		'args' => array(
			'title'    => esc_html__( 'Accordion / FAQ', 'portum' ),
			'panel'    => 'portum_panel_section_content',
			'priority' => 12,
			'type'     => 'epsilon-section-doubled',
		),
	),
	array(
		'id'   => 'portum_clientlists_section',
		'args' => array(
			'title'    => esc_html__( 'Client Logos Section', 'portum' ),
			'panel'    => 'portum_panel_section_content',
			'priority' => 13,
			'type'     => 'epsilon-section-doubled',
		),
	),
	array(
		'id'   => 'portum_features_section',
		'args' => array(
			'title'    => esc_html__( 'Features', 'portum' ),
			'panel'    => 'portum_panel_section_content',
			'priority' => 14,
			'type'     => 'epsilon-section-doubled',
		),
	),
	array(
		'id'   => 'portum_iconboxes_section',
		'args' => array(
			'title'    => esc_html__( 'Icons', 'portum' ),
			'panel'    => 'portum_panel_section_content',
			'priority' => 15,
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
