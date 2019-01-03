<?php
/**
 * Portum Theme Customizer Fields
 *
 * @package Portum
 * @since   1.0
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}


Epsilon_Customizer::add_field( 'portum_typography_global', array(
	'type'          => 'epsilon-typography',
	'transport'     => 'postMessage',
	'section'       => 'portum_typography_section',
	'label'         => esc_html__( 'Global theme font', 'portum' ),
	'description'   => esc_html__( 'The font that will be applied to the entire theme. ', 'portum' ),
	'stylesheet'    => 'portum-main',
	'choices'       => array(
		'font-family',
		'font-weight',
		'font-style',
	),
	'selectors'     => array(
		'body',
	),
	'font_defaults' => array(
		'font-family' => 'default_font',
		'font-size'   => '16',
		'line-height' => '21',
	),
) );


Epsilon_Customizer::add_field( 'portum_typography_navigation', array(
	'type'          => 'epsilon-typography',
	'transport'     => 'postMessage',
	'section'       => 'portum_typography_section',
	'label'         => esc_html__( 'Navigation font', 'portum' ),
	'description'   => esc_html__( 'The font that will be applied to header and footer navigation', 'portum' ),
	'stylesheet'    => 'portum-main',
	'choices'       => array(
		'font-family',
		'font-weight',
		'font-style',
	),
	'selectors'     => array(
		'#menu li a',
		'#footer ul.nav',
	),
	'font_defaults' => array(
		'font-family' => 'default_font',
		'font-weight' => '',
		'font-size'   => '14',
		'line-height' => '21',
	),
) );

Epsilon_Customizer::add_field( 'portum_typography_headline_subtitle', array(
	'type'          => 'epsilon-typography',
	'transport'     => 'postMessage',
	'section'       => 'portum_typography_section',
	'label'         => esc_html__( 'Section title', 'portum' ),
	'stylesheet'    => 'portum-main',
	'choices'       => array(
		'font-family',
		'font-weight',
		'font-style',
		'letter-spacing',
	),
	'selectors'     => array(
		'.headline h3',
	),
	'font_defaults' => array(
		'font-family'    => 'default_font',
		'font-weight'    => '',
		'font-style'     => '',
		'font-size'      => '32',
		'line-height'    => '40',
		'letter-spacing' => '0',
	),
) );

Epsilon_Customizer::add_field( 'portum_typography_headline_title', array(
	'type'          => 'epsilon-typography',
	'transport'     => 'postMessage',
	'section'       => 'portum_typography_section',
	'label'         => esc_html__( 'Section subtitle', 'portum' ),
	'stylesheet'    => 'portum-main',
	'choices'       => array(
		'font-family',
		'font-weight',
		'font-style',
		'letter-spacing',
	),
	'selectors'     => array(
		'.headline span:not(.dashicons)',
	),
	'font_defaults' => array(
		'font-family'    => 'default_font',
		'font-weight'    => 'on',
		'font-style'     => '',
		'font-size'      => '14',
		'line-height'    => '21',
		'letter-spacing' => '0',
	),
) );


/**
 * Blog section options
 */
Epsilon_Customizer::add_field( 'portum_blog_layout', array(
	'type'        => 'select',
	'label'       => esc_html__( 'Blog Layout', 'portum' ),
	'description' => esc_html__( 'Select the layout that will be used for the blog.', 'portum' ),
	'section'     => 'header_image',
	'default'     => 'narrow',
	'choices'     => array(
		'narrow'        => esc_html__( 'narrow, no sidebar', 'portum' ),
		'right-sidebar' => esc_html__( 'right sidebar', 'portum' ),
		'left-sidebar'  => esc_html__( 'left sidebar', 'portum' ),
		'fullwidth'     => esc_html__( 'full width, no sidebar', 'portum' ),
	),
) );

Epsilon_Customizer::add_field( 'portum_show_single_post_categories', array(
	'type'        => 'epsilon-toggle',
	'label'       => esc_html__( 'Post Meta: Categories', 'portum' ),
	'description' => esc_html__( 'This will disable the categories displayed at the beginning of each post.', 'portum' ),
	'section'     => 'header_image',
	'default'     => true,
) );

Epsilon_Customizer::add_field( 'portum_show_single_post_excerpt', array(
	'type'        => 'epsilon-toggle',
	'label'       => esc_html__( 'Post Meta: Excerpt', 'portum' ),
	'description' => esc_html__( 'This will disable the excerpt displayed at the beginning of each post.', 'portum' ),
	'section'     => 'header_image',
	'default'     => true,
) );

Epsilon_Customizer::add_field( 'portum_show_single_post_author', array(
	'type'        => 'epsilon-toggle',
	'label'       => esc_html__( 'Post Meta: Author', 'portum' ),
	'description' => esc_html__( 'This will disable the author being displayed.', 'portum' ),
	'section'     => 'header_image',
	'default'     => true,
) );

Epsilon_Customizer::add_field( 'portum_show_single_post_date', array(
	'type'        => 'epsilon-toggle',
	'label'       => esc_html__( 'Post Meta: Date', 'portum' ),
	'description' => esc_html__( 'This will disable the post date being displayed.', 'portum' ),
	'section'     => 'header_image',
	'default'     => true,
) );

Epsilon_Customizer::add_field( 'portum_show_single_post_comments', array(
	'type'        => 'epsilon-toggle',
	'label'       => esc_html__( 'Post Meta: Comments', 'portum' ),
	'description' => esc_html__( 'This will disable the comments number being displayed at the beginning of each post.', 'portum' ),
	'section'     => 'header_image',
	'default'     => true,
) );

Epsilon_Customizer::add_field( 'portum_show_single_post_tags', array(
	'type'        => 'epsilon-toggle',
	'label'       => esc_html__( 'Post Meta: Tags', 'portum' ),
	'description' => esc_html__( 'This will disable the tags zone at the end of the post.', 'portum' ),
	'section'     => 'header_image',
	'default'     => true,
) );

Epsilon_Customizer::add_field( 'portum_enable_author_box', array(
	'type'        => 'epsilon-toggle',
	'label'       => esc_html__( 'Author Box', 'portum' ),
	'description' => esc_html__( 'Toggle the display of the author box, at the end of each post.', 'portum' ),
	'section'     => 'header_image',
	'default'     => true,
) );

Epsilon_Customizer::add_field( 'portum_header_layout', array(
	'type'        => 'select',
	'label'       => esc_html__( 'Header Layout', 'portum' ),
	'description' => esc_html__( 'Select the type of header you want to use.', 'portum' ),
	'section'     => 'portum_header_section',
	'default'     => 'portum-classic',
	'choices'     => array(
		'portum-classic'   => esc_html__( 'Classic position', 'portum' ),
		'portum-sidebar'   => esc_html__( 'Fixed left side', 'portum' ),
		'portum-offcanvas' => esc_html__( 'Off Canvas Menu', 'portum' ),
	),
) );

Epsilon_Customizer::add_field( 'portum_header_sticky', array(
	'type'        => 'epsilon-toggle',
	'label'       => esc_html__( 'Sticky Header', 'portum' ),
	'description' => esc_html__( 'This will make the header stick to the top of the page.', 'portum' ),
	'section'     => 'portum_header_section',
	'default'     => true,
) );

Epsilon_Customizer::add_field( 'portum_header_over_content', array(
	'type'        => 'epsilon-toggle',
	'label'       => esc_html__( 'Set header over content', 'portum' ),
	'description' => esc_html__( 'This will set header over slider, using colors you can make the header transparent.', 'portum' ),
	'section'     => 'portum_header_section',
	'default'     => false,
	'condition'   => array( 'portum_header_layout', 'portum-classic' ),
) );

Epsilon_Customizer::add_field( 'portum_header_shadow', array(
	'type'        => 'epsilon-toggle',
	'label'       => esc_html__( 'Header shadow', 'portum' ),
	'description' => esc_html__( 'This will add or remove header shadow.', 'portum' ),
	'section'     => 'portum_header_section',
	'default'     => true,
) );

Epsilon_Customizer::add_field( 'portum_enable_go_top', array(
	'type'        => 'epsilon-toggle',
	'label'       => esc_html__( 'Go to top button', 'portum' ),
	'description' => esc_html__( 'Toggle the display of the go to top button.', 'portum' ),
	'section'     => 'portum_header_section',
	'default'     => true,
) );

Epsilon_Customizer::add_field( 'portum_header_width', array(
	'type'        => 'epsilon-toggle',
	'label'       => esc_html__( 'Fullwidth Header Menu', 'portum' ),
	'description' => esc_html__( 'Toggling this to on will make your header stretch to the full-width of your screen.', 'portum' ),
	'section'     => 'portum_header_section',
	'default'     => false,
) );

/**
 * Footer section options
 */
Epsilon_Customizer::add_field( 'portum_footer_columns', array(
	'type'     => 'epsilon-layouts',
	'section'  => 'portum_footer_section',
	'priority' => 0,
	'layouts'  => array(
		1 => get_template_directory_uri() . '/inc/libraries/epsilon-framework/assets/img/one-column.png',
		2 => get_template_directory_uri() . '/inc/libraries/epsilon-framework/assets/img/two-column.png',
		3 => get_template_directory_uri() . '/inc/libraries/epsilon-framework/assets/img/three-column.png',
		4 => get_template_directory_uri() . '/inc/libraries/epsilon-framework/assets/img/four-column.png',
	),
	'default'  => array(
		'columnsCount' => 4,
		'columns'      => array(
			array(
				'index' => 1,
				'span'  => 3,
			),
			array(
				'index' => 2,
				'span'  => 3,
			),
			array(
				'index' => 3,
				'span'  => 3,
			),
			array(
				'index' => 4,
				'span'  => 3,
			),
		),
	),
	'min_span' => 2,
	'label'    => esc_html__( 'Footer Columns', 'portum' ),
) );

Epsilon_Customizer::add_field( 'portum_footer_width', array(
	'type'        => 'epsilon-toggle',
	'label'       => esc_html__( 'Fullwidth Footer Area', 'portum' ),
	'description' => esc_html__( 'Toggling this to on will make your footer stretch to the full-width of your screen.', 'portum' ),
	'section'     => 'portum_footer_section',
	'default'     => false,
) );
/**
 * Google Api KEY
 */
Epsilon_Customizer::add_field( 'portum_google_api_key', array(
	'type'              => 'text',
	'section'           => 'portum_misc_section',
	'sanitize_callback' => 'sanitize_text_field',
	'label'             => esc_html__( 'Google API KEY', 'portum' ),
	/* Translators: Explanation re. Google Maps API Key billing requirements */
	'description'       => sprintf( __( 'You need to make sure you have enabled billing on your Google account, otherwise your Google Maps API Key will not work.
	This is a recent change Google introduced and not related to the theme itself. Please use <a href="%s" target="_blank">this link to get your API key</a>', 'portum' ), esc_url( 'https://developers.google.com/maps/documentation/javascript/get-api-key' ) ),
) );


/**
 * Contact boxes
 */
Epsilon_Customizer::add_field( 'portum_contact_section', array(
	'type'              => 'epsilon-repeater',
	'section'           => 'portum_contact_section',
	'save_as_meta'      => Epsilon_Content_Backup::get_instance()->setting_page,
	'label'             => esc_html__( 'Contact Columns', 'portum' ),
	'button_label'      => esc_html__( 'Add new boxes', 'portum' ),
	'selective_refresh' => true,
	'transport'         => 'postMessage',
	'row_label'         => array(
		'type'  => 'field',
		'field' => 'contact_title',
	),
	'fields'            => array(
		'contact_title' => array(
			'label'   => esc_html__( 'Title', 'portum' ),
			'type'    => 'text',
			'default' => esc_html__( 'Headquarters', 'portum' ),
		),
		'contact_icon'  => array(
			'label'   => esc_html__( 'Icon', 'portum' ),
			'type'    => 'epsilon-icon-picker',
			'default' => 'fa fa-map',
			'groups'  => array( 'general' ),
		),
		'contact_text'  => array(
			'label'   => esc_html__( 'Text', 'portum' ),
			'type'    => 'textarea',
			'default' => esc_html__( '176 Westmore Mondaile Street Victorian 887 NYC', 'portum' ),
		),
	),
) );


/**
 * Theme Content
 */


/**
 * Accordion General Information
 */
Epsilon_Customizer::add_field( 'portum_accordion', array(
	'type'              => 'epsilon-repeater',
	'section'           => 'portum_accordion_section',
	'save_as_meta'      => Epsilon_Content_Backup::get_instance()->setting_page,
	'label'             => esc_html__( 'General Information', 'portum' ),
	'button_label'      => esc_html__( 'Add/edit new entries', 'portum' ),
	'selective_refresh' => true,
	'transport'         => 'postMessage',
	'row_label'         => array(
		'type'  => 'field',
		'field' => 'accordion_title',
	),
	'fields'            => array(
		'accordion_title'  => array(
			'label'   => esc_html__( 'FAQ Title', 'portum' ),
			'default' => esc_html__( 'FAQ Title', 'portum' ),
			'type'    => 'text',
		),
		'accordion_text'   => array(
			'label'   => esc_html__( 'FAQ Text', 'portum' ),
			'default' => esc_html__( 'FAQ Text Content goes here', 'portum' ),
			'type'    => 'textarea',
		),
		'accordion_opened' => array(
			'label'   => esc_html__( 'Opened by default', 'portum' ),
			'type'    => 'epsilon-toggle',
			'default' => false,
		),
	),
) );

/**
 * Schedule
 */
Epsilon_Customizer::add_field( 'portum_schedule', array(
	'type'              => 'epsilon-repeater',
	'section'           => 'portum_schedule_section',
	'save_as_meta'      => Epsilon_Content_Backup::get_instance()->setting_page,
	'label'             => esc_html__( 'Schedule', 'portum' ),
	'button_label'      => esc_html__( 'Add new entries', 'portum' ),
	'selective_refresh' => true,
	'transport'         => 'postMessage',
	'row_label'         => array(
		'type'  => 'field',
		'field' => 'schedule_days',
	),
	'fields'            => array(
		'schedule_days'  => array(
			'label'             => esc_html__( 'Days', 'portum' ),
			'description'       => esc_html__( 'e.g. Monday - Thursday', 'portum' ),
			'type'              => 'text',
			'sanitize_callback' => 'wp_kses_post',
			'default'           => esc_html__( 'Monday - Thursday', 'portum' ),
		),
		'schedule_hours' => array(
			'label'             => esc_html__( 'Hours', 'portum' ),
			'description'       => esc_html__( 'e.g. 9:30 am – 8:30 pm', 'portum' ),
			'type'              => 'text',
			'sanitize_callback' => 'wp_kses_post',
			'default'           => esc_html__( '9:30 am – 8:30 pm', 'portum' ),
		),
	),
) );

/**
 * Testimonials
 */
Epsilon_Customizer::add_field( 'portum_testimonials', array(
	'type'              => 'epsilon-repeater',
	'section'           => 'portum_testimonials_section',
	'save_as_meta'      => Epsilon_Content_Backup::get_instance()->setting_page,
	'selective_refresh' => true,
	'transport'         => 'postMessage',
	'label'             => esc_html__( 'Testimonials', 'portum' ),
	'button_label'      => esc_html__( 'Add new entries', 'portum' ),
	'row_label'         => array(
		'type'  => 'field',
		'field' => 'testimonial_title',
	),
	'fields'            => array(
		'testimonial_bg_color' => array(
			'label'   => esc_html__( 'Testimonial Background Color', 'portum' ),
			'type'    => 'epsilon-color-picker',
			'default' => '',
		),
		'testimonial_title'    => array(
			'label'   => esc_html__( 'Title', 'portum' ),
			'type'    => 'text',
			'default' => 'Michael Cross',
		),
		'testimonial_subtitle' => array(
			'label'   => esc_html__( 'Given by', 'portum' ),
			'type'    => 'text',
			'default' => 'Michael - CEO @ Hampybrewry',
		),
		'testimonial_text'     => array(
			'label'   => esc_html__( 'Text', 'portum' ),
			'type'    => 'textarea',
			'default' => '"Maecenas nec maximus magna. Nullam nec metus ullamcorper, scelerisque nulla vel, amus at fermentum ligula Maecenas nec maximus magna. Nullam nec metus ullamcorper, scelerisque nulla vel, amus at fermentum ligula"',
		),
		'testimonial_image'    => array(
			'label'   => esc_html__( 'Portrait', 'portum' ),
			'type'    => 'epsilon-image',
			'size'    => 'medium',
			'default' => esc_url( get_template_directory_uri() . '/assets/images/07_testimonials_01.png' ),
		),
	),
) );

/**
 * Services
 */
Epsilon_Customizer::add_field( 'portum_services', array(
	'type'              => 'epsilon-repeater',
	'section'           => 'portum_services_section',
	'save_as_meta'      => Epsilon_Content_Backup::get_instance()->setting_page,
	'label'             => esc_html__( 'Services', 'portum' ),
	'button_label'      => esc_html__( 'Add new service', 'portum' ),
	'selective_refresh' => true,
	'transport'         => 'postMessage',
	'row_label'         => array(
		'type'  => 'field',
		'field' => 'service_title',
	),
	'fields'            => array(
		'services_bg_color'   => array(
			'label'   => esc_html__( 'Services Background Color', 'portum' ),
			'type'    => 'epsilon-color-picker',
			'default' => '',
		),
		'service_title'       => array(
			'label'             => esc_html__( 'Title', 'portum' ),
			'type'              => 'text',
			'sanitize_callback' => 'wp_kses_post',
			'default'           => 'Business',
		),
		'service_description' => array(
			'label'             => esc_html__( 'Description', 'portum' ),
			'type'              => 'text',
			'sanitize_callback' => 'wp_kses_post',
			'default'           => 'Consultance',
		),
		'service_icon'        => array(
			'label'   => esc_html__( 'Icon', 'portum' ),
			'type'    => 'epsilon-icon-picker',
			'default' => 'fa fa-500px',
			'groups'  => array( 'general' ),
		),
		'service_icon_color'  => array(
			'label'   => esc_html__( 'Icon Color', 'portum' ),
			'type'    => 'epsilon-color-picker',
			'default' => '#FFF',
		),

	),
) );

/**
 * Icons
 */
Epsilon_Customizer::add_field( 'portum_icons', array(
	'type'              => 'epsilon-repeater',
	'section'           => 'portum_iconboxes_section',
	'save_as_meta'      => Epsilon_Content_Backup::get_instance()->setting_page,
	'label'             => esc_html__( 'Icons', 'portum' ),
	'button_label'      => esc_html__( 'Add new icon', 'portum' ),
	'selective_refresh' => true,
	'transport'         => 'postMessage',
	'row_label'         => array(
		'type'  => 'field',
		'field' => 'icon_title',
	),
	'fields'            => array(
		'icon_title' => array(
			'label'             => esc_html__( 'Title', 'portum' ),
			'type'              => 'text',
			'sanitize_callback' => 'wp_kses_post',
			'default'           => 'Business',
		),
		'icon'       => array(
			'label'   => esc_html__( 'Icon', 'portum' ),
			'type'    => 'epsilon-icon-picker',
			'default' => 'fa fa-500px',
			'groups'  => array( 'general' ),
		),
		'icon_color' => array(
			'label'   => esc_html__( 'Icon Color', 'portum' ),
			'type'    => 'epsilon-color-picker',
			'default' => '#FFF',
		),
	),
) );

/**
 * features
 */
Epsilon_Customizer::add_field( 'portum_features', array(
	'type'              => 'epsilon-repeater',
	'section'           => 'portum_features_section',
	'save_as_meta'      => Epsilon_Content_Backup::get_instance()->setting_page,
	'label'             => esc_html__( 'Features', 'portum' ),
	'button_label'      => esc_html__( 'Add new feature', 'portum' ),
	'selective_refresh' => true,
	'transport'         => 'postMessage',
	'row_label'         => array(
		'type'  => 'field',
		'field' => 'feature_title',
	),
	'fields'            => array(
		'features_bg_color'   => array(
			'label'   => esc_html__( 'Background Color', 'portum' ),
			'type'    => 'epsilon-color-picker',
			'default' => '',
		),
		'feature_title'       => array(
			'label'             => esc_html__( 'Title', 'portum' ),
			'type'              => 'text',
			'sanitize_callback' => 'wp_kses_post',
			'default'           => 'Business',
		),
		'feature_description' => array(
			'label'             => esc_html__( 'Description', 'portum' ),
			'type'              => 'text',
			'sanitize_callback' => 'wp_kses_post',
			'default'           => 'Consultance',
		),
		'feature_icon'        => array(
			'label'   => esc_html__( 'Icon', 'portum' ),
			'type'    => 'epsilon-icon-picker',
			'default' => 'fa fa-500px',
			'groups'  => array( 'general' ),
		),
		'feature_icon_color'  => array(
			'label'   => esc_html__( 'Icon Color', 'portum' ),
			'type'    => 'epsilon-color-picker',
			'default' => '#FFF',
		),
	),
) );

/**
 * Portfolio Items
 */
Epsilon_Customizer::add_field( 'portum_portfolio', array(
	'type'              => 'epsilon-repeater',
	'section'           => 'portum_portfolio_section',
	'save_as_meta'      => Epsilon_Content_Backup::get_instance()->setting_page,
	'label'             => esc_html__( 'Portfolio Items', 'portum' ),
	'button_label'      => esc_html__( 'Add new items', 'portum' ),
	'selective_refresh' => true,
	'transport'         => 'postMessage',
	'row_label'         => array(
		'type'  => 'field',
		'field' => 'portfolio_title',
	),
	'fields'            => array(
		'portfolio_title'       => array(
			'label'             => esc_html__( 'Title', 'portum' ),
			'type'              => 'text',
			'sanitize_callback' => 'wp_kses_post',
			'default'           => esc_html__( 'Project Title', 'portum' ),
		),
		'portfolio_description' => array(
			'label'   => esc_html__( 'Description', 'portum' ),
			'type'    => 'textarea',
			'default' => esc_html__( 'Nullam nec metus ullamcorper, scelerisque null', 'portum' ),
		),
		'portfolio_image'       => array(
			'label'   => esc_html__( 'Image', 'portum' ),
			'type'    => 'epsilon-image',
			'size'    => 'portum-portfolio-image',
			'default' => esc_url( get_template_directory_uri() . '/assets/images/clean/pink-2569355_640-400x426.jpg' ),
		),
		'portfolio_link'        => array(
			'label'             => esc_html__( 'Portfolio Item URL', 'portum' ),
			'type'              => 'url',
			'sanitize_callback' => 'esc_url_raw',
			'default'           => '#',
		),
	),
) );

/**
 * Counter boxes
 */
Epsilon_Customizer::add_field( 'portum_counter_boxes', array(
	'type'              => 'epsilon-repeater',
	'section'           => 'portum_counters_section',
	'save_as_meta'      => Epsilon_Content_Backup::get_instance()->setting_page,
	'label'             => esc_html__( 'Counter Items', 'portum' ),
	'button_label'      => esc_html__( 'Add new items', 'portum' ),
	'selective_refresh' => true,
	'transport'         => 'postMessage',
	'row_label'         => array(
		'type'  => 'field',
		'field' => 'counter_title',
	),
	'fields'            => array(
		'counter_title'        => array(
			'label'             => esc_html__( 'Title', 'portum' ),
			'type'              => 'text',
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => 'Satisfied Clients',
		),
		'counter_number'       => array(
			'label'             => esc_html__( 'Number', 'portum' ),
			'type'              => 'text',
			'sanitize_callback' => 'absint',
			'default'           => 720,
		),
		'counter_symbol'       => array(
			'label'             => esc_html__( 'Symbol', 'portum' ),
			'type'              => 'text',
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => '',
		),
		'counter_type'         => array(
			'label'   => esc_html__( 'Counter type', 'portum' ),
			'type'    => 'select',
			'default' => 'normal',
			'choices' => array(
				'normal'   => __( 'Normal', 'portum' ),
				'odometer' => __( 'Odometer', 'portum' ),
			),
		),
		'counter_icon_display' => array(
			'label'   => esc_html__( 'Display icon?', 'portum' ),
			'type'    => 'epsilon-toggle',
			'default' => false,
		),
		'counter_icon'         => array(
			'label'     => esc_html__( 'Icon', 'portum' ),
			'type'      => 'epsilon-icon-picker',
			'default'   => 'fa fa-hdd-o',
			'groups'    => array( 'general' ),
			'condition' => array( 'counter_icon_display', true ),
		),
		'counter_icon_color'   => array(
			'label'     => esc_html__( 'Icon Color', 'portum' ),
			'type'      => 'epsilon-color-picker',
			'default'   => '#FFF',
			'condition' => array( 'counter_icon_display', true ),
		),
	),
) );
/**
 * Progress bars
 */
Epsilon_Customizer::add_field( 'portum_progress_bars', array(
	'type'              => 'epsilon-repeater',
	'section'           => 'portum_progress_bars_section',
	'save_as_meta'      => Epsilon_Content_Backup::get_instance()->setting_page,
	'label'             => esc_html__( 'Progress Bars', 'portum' ),
	'button_label'      => esc_html__( 'Add new items', 'portum' ),
	'selective_refresh' => true,
	'transport'         => 'postMessage',
	'row_label'         => array(
		'type'  => 'field',
		'field' => 'progress_bar_title',
	),
	'fields'            => array(
		'progress_bar_type'  => array(
			'label'   => esc_html__( 'Type', 'portum' ),
			'type'    => 'select',
			'default' => 'normal',
			'choices' => array(
				'normal'    => esc_html__( 'Normal', 'portum' ),
				'alternate' => esc_html__( 'Alternate', 'portum' ),
			),
		),
		'progress_bar_title' => array(
			'label'             => esc_html__( 'Title', 'portum' ),
			'type'              => 'text',
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => 'Satisfaction',
		),
		'progress_bar_value' => array(
			'label'   => esc_html__( 'Percentage', 'portum' ),
			'type'    => 'epsilon-slider',
			'default' => 50,
			'choices' => array(
				'min'  => 5,
				'max'  => 100,
				'step' => 1,
			),
		),
	),
) );
/**
 * Pie charts bars
 */
Epsilon_Customizer::add_field( 'portum_pie_charts', array(
	'type'              => 'epsilon-repeater',
	'section'           => 'portum_piecharts_section',
	'save_as_meta'      => Epsilon_Content_Backup::get_instance()->setting_page,
	'label'             => esc_html__( 'Pie Charts', 'portum' ),
	'button_label'      => esc_html__( 'Add new items', 'portum' ),
	'selective_refresh' => true,
	'transport'         => 'postMessage',
	'row_label'         => array(
		'type'  => 'field',
		'field' => 'piechart_title',
	),
	'fields'            => array(
		'piechart_title'     => array(
			'label'             => esc_html__( 'Title', 'portum' ),
			'type'              => 'text',
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => 'Satisfaction',
		),
		'piechart_text'      => array(
			'label'   => esc_html__( 'Text', 'portum' ),
			'type'    => 'textarea',
			'default' => esc_html__( 'Nullam nec metus ullamcorper, scelerisque null', 'portum' ),
		),
		'piechart_value'     => array(
			'label'             => esc_html__( 'Value', 'portum' ),
			'type'              => 'text',
			'sanitize_callback' => 'absint',
			'default'           => 55,
		),
		'piechart_size'      => array(
			'label'       => esc_html__( 'Size', 'portum' ),
			'description' => esc_html__( 'In pixels', 'portum' ),
			'type'        => 'epsilon-slider',
			'default'     => 200,
			'choices'     => array(
				'min'  => 100,
				'max'  => 250,
				'step' => 10,
			),
		),
		'piechart_bar_width' => array(
			'label'       => esc_html__( 'Width', 'portum' ),
			'description' => esc_html__( 'In pixels', 'portum' ),
			'type'        => 'epsilon-slider',
			'default'     => 15,
			'choices'     => array(
				'min'  => 5,
				'max'  => 35,
				'step' => 5,
			),
		),
		'piechart_type'      => array(
			'label'   => esc_html__( 'Type', 'portum' ),
			'type'    => 'select',
			'default' => 'percentage',
			'choices' => array(
				'percentage' => esc_html__( 'Percentage', 'portum' ),
				'icon'       => esc_html__( 'icon', 'portum' ),
			),
		),
		'piechart_icon'      => array(
			'label'   => esc_html__( 'Icon', 'portum' ),
			'type'    => 'epsilon-icon-picker',
			'default' => 'fa fa-hdd-o',
			'groups'  => array( 'general' ),
		),
	),
) );
/**
 * Client logos
 */
Epsilon_Customizer::add_field( 'portum_clients', array(
	'type'              => 'epsilon-repeater',
	'section'           => 'portum_clientlists_section',
	'save_as_meta'      => Epsilon_Content_Backup::get_instance()->setting_page,
	'label'             => esc_html__( 'Client Logos', 'portum' ),
	'button_label'      => esc_html__( 'Add new items', 'portum' ),
	'selective_refresh' => true,
	'transport'         => 'postMessage',
	'row_label'         => array(
		'type'  => 'field',
		'field' => 'client_title',
	),
	'fields'            => array(
		'client_title' => array(
			'label'             => esc_html__( 'Title', 'portum' ),
			'type'              => 'text',
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => 'Client',
		),
		'client_logo'  => array(
			'label'   => esc_html__( 'Title', 'portum' ),
			'type'    => 'epsilon-image',
			'default' => esc_url( get_template_directory_uri() . '/assets/images/client-logo.png' ),
		),
		'client_url'   => array(
			'label'             => esc_html__( 'Client Link', 'portum' ),
			'type'              => 'text',
			'sanitize_callback' => 'esc_url_raw',
			'default'           => '#',
		),
	),
) );
/**
 * Team Members
 */
Epsilon_Customizer::add_field( 'portum_team_members', array(
	'type'              => 'epsilon-repeater',
	'section'           => 'portum_team_members_section',
	'save_as_meta'      => Epsilon_Content_Backup::get_instance()->setting_page,
	'label'             => esc_html__( 'Team Members', 'portum' ),
	'button_label'      => esc_html__( 'Add new member', 'portum' ),
	'selective_refresh' => true,
	'transport'         => 'postMessage',
	'row_label'         => array(
		'type'  => 'field',
		'field' => 'member_title',
	),
	'fields'            => array(
		'member_title'            => array(
			'label'             => esc_html__( 'Name', 'portum' ),
			'type'              => 'text',
			'default'           => __( 'James Austin', 'portum' ),
			'sanitize_callback' => 'wp_kses_post',
		),
		'member_text'             => array(
			'label'   => esc_html__( 'Text', 'portum' ),
			'type'    => 'textarea',
			'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris lacinia velit quis sem dignissim porta.', 'portum' ),
		),
		'member_image'            => array(
			'label'   => esc_html__( 'Portrait', 'portum' ),
			'type'    => 'epsilon-image',
			'size'    => 'portum-team-image',
			'default' => esc_url( get_template_directory_uri() . '/assets/images/07_team_01.jpg' ),
		),
		'member_social_facebook'  => array(
			'label'   => esc_html__( 'Facebook', 'portum' ),
			'type'    => 'url',
			'default' => 'https://facebook.com',
		),
		'member_social_twitter'   => array(
			'label'   => esc_html__( 'Twitter', 'portum' ),
			'type'    => 'url',
			'default' => 'https://twitter.com',
		),
		'member_social_pinterest' => array(
			'label'   => esc_html__( 'Pinterest', 'portum' ),
			'type'    => 'url',
			'default' => 'https://pinterest.com',
		),
		'member_social_linkedin'  => array(
			'label'   => esc_html__( 'LinkedIn', 'portum' ),
			'type'    => 'url',
			'default' => 'https://linkedin.com',
		),
	),
) );
/**
 * Price boxes
 */
Epsilon_Customizer::add_field( 'portum_price_boxes', array(
	'type'              => 'epsilon-repeater',
	'section'           => 'portum_pricing_section',
	'save_as_meta'      => Epsilon_Content_Backup::get_instance()->setting_page,
	'label'             => esc_html__( 'Price Boxes', 'portum' ),
	'button_label'      => esc_html__( 'Add new price box', 'portum' ),
	'selective_refresh' => true,
	'transport'         => 'postMessage',
	'row_label'         => array(
		'type'  => 'field',
		'field' => 'price_box_title',
	),
	'fields'            => array(
		'price_box_featured'     => array(
			'type'    => 'epsilon-toggle',
			'label'   => esc_html__( 'Featured State', 'portum' ),
			'default' => false,
		),
		'price_box_icon_display' => array(
			'type'    => 'epsilon-toggle',
			'label'   => esc_html__( 'Pricing Table Icon Display', 'portum' ),
			'default' => false,
		),
		'price_box_icon'         => array(
			'label'     => esc_html__( 'Icon', 'portum' ),
			'type'      => 'epsilon-icon-picker',
			'default'   => 'fa fa-building',
			'groups'    => array( 'general' ),
			'condition' => array( 'price_box_icon_display', true ),
		),
		'price_box_icon_color'   => array(
			'label'     => esc_html__( 'Icon Color', 'portum' ),
			'type'      => 'epsilon-color-picker',
			'default'   => 'blue',
			'condition' => array( 'price_box_icon_display', true ),
		),
		'price_box_title'        => array(
			'label'             => esc_html__( 'Pricing Table Name', 'portum' ),
			'type'              => 'text',
			'default'           => esc_html__( 'Standard', 'portum' ),
			'sanitize_callback' => 'wp_kses_post',
		),
		'price_box_text'         => array(
			'label'             => esc_html__( 'Pricing Table Description', 'portum' ),
			'type'              => 'text',
			'default'           => esc_html__( 'Get started now! You have the base!', 'portum' ),
			'sanitize_callback' => 'wp_kses_post',
		),
		'price_box_amount'       => array(
			'label'   => esc_html__( 'Pricing Table Amount', 'portum' ),
			'type'    => 'text',
			'default' => '$59 / mo',
		),
		'price_box_features'     => array(
			'label'             => esc_html__( 'Features', 'portum' ),
			'type'              => 'textarea',
			'default'           => '<ul><li><span>10GB</span> Disk Space</li><li><span>Free</span> DDoS Protection</li><li><span>Free</span> Daily Backups</li><li>Managed Hosting</li></ul>',
			'sanitize_callback' => 'wp_kses_post',
		),
		'price_box_button_label' => array(
			'label'             => esc_html__( 'Button Text', 'portum' ),
			'type'              => 'text',
			'default'           => __( 'Purchase', 'portum' ),
			'sanitize_callback' => 'wp_kses_post',
		),
		'price_box_button_url'   => array(
			'label'             => esc_html__( 'Button URL', 'portum' ),
			'type'              => 'text',
			'default'           => '#',
			'sanitize_callback' => 'wp_kses_post',
		),
	),
) );

Epsilon_Customizer::add_field( 'portum_advanced_slides', array(
	'type'              => 'epsilon-repeater',
	'section'           => 'portum_advanced_slides_section',
	'save_as_meta'      => Epsilon_Content_Backup::get_instance()->setting_page,
	'label'             => esc_html__( 'Slides', 'portum' ),
	'button_label'      => esc_html__( 'Add new slides', 'portum' ),
	'selective_refresh' => true,
	'transport'         => 'postMessage',
	'row_label'         => array(
		'type'  => 'field',
		'field' => 'slide_title',
	),
	'fields'            => array(
		'slide_title'               => array(
			'label'             => esc_html__( 'Slide title', 'portum' ),
			'description'       => esc_html__( 'Slide title. Use it to add an eye-catching Call To Action.', 'portum' ),
			'type'              => 'text',
			'sanitize_callback' => 'wp_kses_post',
			'default'           => esc_html__( 'From zero to hero along with you.', 'portum' ),
		),
		'slide_title_color'         => array(
			'label'             => esc_html__( 'Slide Title Color', 'portum' ),
			'type'              => 'epsilon-color-picker',
			'default'           => '#FFF',
			'sanitize_callback' => 'wp_kses_post',
		),
		'slide_title_size'          => array(
			'label'   => esc_html__( 'Slide Title Font Size', 'portum' ),
			'type'    => 'epsilon-slider',
			'default' => 16,
			'choices' => array(
				'min'  => 1,
				'max'  => 126,
				'step' => 1,
			),
		),
		'slide_description'         => array(
			'label'             => esc_html__( 'Slide description', 'portum' ),
			'description'       => esc_html__( 'Slide description. Use it to accompany to your Call To Action message.', 'portum' ),
			'type'              => 'textarea',
			'sanitize_callback' => 'wp_kses_post',
			'default'           => esc_html__( 'We believe there\'s no other theme like Portum.', 'portum' ),
		),
		'slide_description_size'    => array(
			'label'   => esc_html__( 'Slide Description Font Size', 'portum' ),
			'type'    => 'epsilon-slider',
			'default' => 16,
			'choices' => array(
				'min'  => 1,
				'max'  => 36,
				'step' => 1,
			),
		),
		'slide_description_color'   => array(
			'label'             => esc_html__( 'Slide Description Color', 'portum' ),
			'type'              => 'epsilon-color-picker',
			'default'           => '#FFF',
			'sanitize_callback' => 'wp_kses_post',
		),
		'slide_content_width'       => array(
			'label'       => esc_html__( 'Slide Content Width', 'portum' ),
			'description' => esc_html__( 'Value increments in %. Minimum is 25%.', 'portum' ),
			'type'        => 'epsilon-slider',
			'default'     => 100,
			'choices'     => array(
				'min'  => 25,
				'max'  => 100,
				'step' => 5,
			),
		),
		'slide_alignment'           => array(
			'type'      => 'epsilon-button-group',
			'label'     => __( 'Slide Content Horizontal Alignment', 'epsilon-framework' ),
			'group'     => 'layout',
			'groupType' => 'three',
			'choices'   => array(
				'left'   => array(
					'icon'  => 'dashicons-editor-alignleft',
					'value' => 'left',
				),
				'center' => array(
					'icon'  => 'dashicons-editor-aligncenter',
					'value' => 'center',
				),
				'right'  => array(
					'icon'  => 'dashicons-editor-alignright',
					'value' => 'right',
				),
			),
			'default'   => 'center',
		),
		'slide_vertical_alignment'  => array(
			'type'      => 'epsilon-button-group',
			'label'     => __( 'Slide Content Vertical Alignment', 'epsilon-framework' ),
			'group'     => 'layout',
			'groupType' => 'three',
			'choices'   => array(
				'top'    => array(
					'value' => 'alignbottom',
					'png'   => get_template_directory_uri() . '/inc/libraries/epsilon-framework/assets/img/epsilon-section-alignbottom.png',
				),
				'middle' => array(
					'value' => 'alignmiddle',
					'png'   => get_template_directory_uri() . '/inc/libraries/epsilon-framework/assets/img/epsilon-section-alignmiddle.png',
				),
				'bottom' => array(
					'value' => 'aligntop',
					'png'   => get_template_directory_uri() . '/inc/libraries/epsilon-framework/assets/img/epsilon-section-aligntop.png',
				),
			),
			'default'   => 'alignmiddle',
		),
		'slide_background_color'    => array(
			'label'      => esc_html__( 'Slide Overlay Color', 'portum' ),
			'type'       => 'epsilon-color-picker',
			'mode'       => 'rgba',
			'defaultVal' => '#f9f9fa',
			'default'    => 'rgba(0,0,0,.1)',
		),
		'slide_background'          => array(
			'label' => esc_html__( 'Background image', 'portum' ),
			'type'  => 'epsilon-image',
			'size'  => 'portum-main-slider',
		),
		'slide_cta_primary_label'   => array(
			'label'             => esc_html__( 'Primary Button Text', 'portum' ),
			'type'              => 'text',
			'default'           => '',
			'sanitize_callback' => 'wp_kses_post',
		),
		'slide_cta_primary_url'     => array(
			'label'             => esc_html__( 'Primary Button URL', 'portum' ),
			'type'              => 'text',
			'default'           => '#',
			'sanitize_callback' => 'wp_kses_post',
		),
		'slide_cta_secondary_label' => array(
			'label'             => esc_html__( 'Secondary Button Text', 'portum' ),
			'type'              => 'text',
			'default'           => '',
			'sanitize_callback' => 'wp_kses_post',
		),
		'slide_cta_secondary_url'   => array(
			'label'             => esc_html__( 'Secondary Button URL', 'portum' ),
			'type'              => 'text',
			'default'           => '#',
			'sanitize_callback' => 'wp_kses_post',
		),
	),
) );

/**
 * Section builder page changer ( acts as a menu )
 */
Epsilon_Customizer::add_field( 'portum_page_changer', array(
	'type'                => 'epsilon-page-changer',
	'label'               => esc_html__( 'Available pages', 'portum' ),
	'section'             => 'portum_repeatable_section',
	'priority'            => 0,
	'repeatable_sections' => Portum_Repeatable_Sections::get_instance()->sections,
	'page_builder_id'     => 'portum_frontpage_sections',
) );


/**
 * Repeatable sections
 */
Epsilon_Customizer::add_field( 'portum_frontpage_sections', array(
	'type'                => 'epsilon-section-repeater',
	'label'               => esc_html__( 'Sections', 'portum' ),
	'section'             => 'portum_repeatable_section',
	'page_builder'        => true,
	'selective_refresh'   => true,
	'transport'           => 'postMessage',
	'repeatable_sections' => Portum_Repeatable_Sections::get_instance()->sections,
) );

/**
 * Color Schemes
 */
Epsilon_Customizer::add_field( 'portum_color_scheme', array(
	'label'       => esc_html__( 'Color scheme', 'portum' ),
	'description' => esc_html__( 'Select a color scheme', 'portum' ),
	'type'        => 'epsilon-color-scheme',
	'priority'    => 0,
	'default'     => 'primary',
	'section'     => 'colors',
	'transport'   => 'postMessage',
	'choices'     => array(
		array(
			'id'     => 'primary',
			'name'   => 'Primary',
			'colors' => array(
				// 'epsilon_general_separator'         		=> '',
				'epsilon_accent_color'                   => '#0385d0',
				'epsilon_accent_color_second'            => '#a1083a',

				// 'epsilon_text_separator'            		=> '',
				'epsilon_title_color'                    => '#1a171c',
				'epsilon_text_color'                     => '#777777',
				'epsilon_link_color'                     => '#0385d0',
				'epsilon_link_hover_color'               => '#a1083a',
				'epsilon_link_active_color'              => '#333333',

				// 'epsilon_menu_separator'            		=> '',
				'epsilon_header_background'              => '#151c1f',
				'epsilon_header_background_sticky'       => 'rgba(255,255,255,.3)',
				'epsilon_header_background_border_bot'   => 'rgba(255,255,255,.1)',
				'epsilon_dropdown_menu_background'       => '#a1083a',
				'epsilon_dropdown_menu_hover_background' => '#940534',
				'epsilon_menu_item_color'                => '#ebebeb',
				'epsilon_menu_item_hover_color'          => '#ffffff',
				'epsilon_menu_item_active_color'         => '#0385d0',

				// 'epsilon_footer_separator'         			=> '',
				'epsilon_footer_contact_background'      => '#0377bb',
				'epsilon_footer_sub_background'          => '#000',
				'epsilon_footer_background'              => '#192229',
				'epsilon_footer_title_color'             => '#ffffff',
				'epsilon_footer_text_color'              => '#a9afb1',
				'epsilon_footer_link_color'              => '#a9afb1',
				'epsilon_footer_link_hover_color'        => '#ffffff',
				'epsilon_footer_link_active_color'       => '#a9afb1',
			),
		),
		array(
			'id'     => 'yellow',
			'name'   => 'Yellow',
			'colors' => array(
				// 'epsilon_general_separator'         		=> '',
				'epsilon_accent_color'                   => '#FFC000',
				'epsilon_accent_color_second'            => '#3E4346',

				// 'epsilon_text_separator'            		=> '',
				'epsilon_title_color'                    => '#3E4346',
				'epsilon_text_color'                     => '#777777',
				'epsilon_link_color'                     => '#3e4346',
				'epsilon_link_hover_color'               => '#ffc000',
				'epsilon_link_active_color'              => '#3e4346',

				// 'epsilon_menu_separator'            		=> '',
				'epsilon_header_background'              => '#ffffff',
				'epsilon_header_background_sticky'       => 'rgba(255,255,255,.3)',
				'epsilon_header_background_border_bot'   => 'rgba(255,255,255,.1)',
				'epsilon_dropdown_menu_background'       => '#ffffff',
				'epsilon_dropdown_menu_hover_background' => '#ffc000',
				'epsilon_menu_item_color'                => '#3e4346',
				'epsilon_menu_item_hover_color'          => '#ffc000',
				'epsilon_menu_item_active_color'         => '#ffc000',

				// 'epsilon_footer_separator'         			=> '',
				'epsilon_footer_contact_background'      => '#ffc000',
				'epsilon_footer_background'              => '#3e4346',
				'epsilon_footer_sub_background'          => '#000',
				'epsilon_footer_title_color'             => '#ffffff',
				'epsilon_footer_text_color'              => '#a9afb1',
				'epsilon_footer_link_color'              => '#a9afb1',
				'epsilon_footer_link_hover_color'        => '#ffffff',
				'epsilon_footer_link_active_color'       => '#a9afb1',
			),
		),
		array(
			'id'     => 'material',
			'name'   => 'Material Design',
			'colors' => array(
				// 'epsilon_general_separator'         		=> '',
				'epsilon_accent_color'                   => '#ff3366',
				'epsilon_accent_color_second'            => '#ff3366',

				// 'epsilon_text_separator'            		=> '',
				'epsilon_title_color'                    => '#3E4346',
				'epsilon_text_color'                     => '#777777',
				'epsilon_link_color'                     => '#3e4346',
				'epsilon_link_hover_color'               => 'rgba(232, 9, 65, 1)',
				'epsilon_link_active_color'              => '#3e4346',

				// 'epsilon_menu_separator'            		=> '',
				'epsilon_header_background'              => 'rgba(255,255,255,0)',
				'epsilon_header_background_sticky'       => 'rgba(0,0,0,.9)',
				'epsilon_header_background_border_bot'   => 'rgba(255,255,255,.1)',
				'epsilon_dropdown_menu_background'       => '#333333',
				'epsilon_dropdown_menu_hover_background' => '#ff3366',
				'epsilon_menu_item_color'                => '#FFFFFF',
				'epsilon_menu_item_hover_color'          => '#FFF',
				'epsilon_menu_item_active_color'         => '#ff3366',

				// 'epsilon_footer_separator'         			=> '',
				'epsilon_footer_contact_background'      => '#333333',
				'epsilon_footer_background'              => '#000000',
				'epsilon_footer_sub_background'          => '#000',
				'epsilon_footer_title_color'             => '#ffffff',
				'epsilon_footer_text_color'              => '#a9afb1',
				'epsilon_footer_link_color'              => '#a9afb1',
				'epsilon_footer_link_hover_color'        => '#ffffff',
				'epsilon_footer_link_active_color'       => '#a9afb1',
			),
		),
	),
) );
