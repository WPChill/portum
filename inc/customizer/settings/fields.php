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

/**
 * Register customizer fields
 */


/**
 * General section options
 */

/**
 * Layout section options
 */
Epsilon_Customizer::add_field( 'portum_layout', array(
	'type'     => 'epsilon-layouts',
	'section'  => 'portum_layout_section',
	'layouts'  => array(
		1 => get_template_directory_uri() . '/inc/libraries/epsilon-framework/assets/img/one-column.png',
		2 => get_template_directory_uri() . '/inc/libraries/epsilon-framework/assets/img/two-column.png',
	),
	'default'  => array(
		'columnsCount' => 2,
		'columns'      => array(
			1 => array(
				'index' => 1,
				'span'  => 8,
			),
			2 => array(
				'index' => 2,
				'span'  => 4,
			),
		),
	),
	'min_span' => 4,
	'fixed'    => true,
	'label'    => esc_html__( 'Blog Layout', 'portum' ),
) );
Epsilon_Customizer::add_field( 'portum_page_layout', array(
	'type'     => 'epsilon-layouts',
	'section'  => 'portum_layout_section',
	'layouts'  => array(
		1 => get_template_directory_uri() . '/inc/libraries/epsilon-framework/assets/img/one-column.png',
		2 => get_template_directory_uri() . '/inc/libraries/epsilon-framework/assets/img/two-column.png',
	),
	'default'  => array(
		'columnsCount' => 2,
		'columns'      => array(
			1 => array(
				'index' => 1,
				'span'  => 8,
			),
			2 => array(
				'index' => 2,
				'span'  => 4,
			),
		),
	),
	'min_span' => 4,
	'fixed'    => true,
	'label'    => esc_html__( 'Page Layout', 'portum' ),
) );
/**
 * Typography section options
 */
Epsilon_Customizer::add_field( 'portum_typography_global', array(
	'type'          => 'epsilon-typography',
	'transport'     => 'postMessage',
	'section'       => 'portum_typography_section',
	'label'         => esc_html__( 'Global font', 'portum' ),
	'description'   => esc_html__( 'The font that will be applied to the entire document', 'portum' ),
	'stylesheet'    => 'portum-main',
	'choices'       => array(
		'font-family',
		'font-size',
		'line-height',
	),
	'selectors'     => array(
		'body',
	),
	'font_defaults' => array(
		'font-family' => 'default_font',
		'font-size'   => '16',
		'line-height' => '26',
	),
) );

Epsilon_Customizer::add_field( 'portum_typography_headings', array(
	'type'          => 'epsilon-typography',
	'transport'     => 'postMessage',
	'label'         => esc_html__( 'Headings', 'portum' ),
	'section'       => 'portum_typography_section',
	'description'   => esc_html__( 'Note: Current typography controls will only be affecting the blog.', 'portum' ),
	'stylesheet'    => 'portum-main',
	'choices'       => array(
		'font-family',
		'letter-spacing',
	),
	'selectors'     => array(
		'.post-title',
		'h1',
		'h2',
		'h3',
		'h4',
		'h5',
		'h6',
		'.pager-slider li strong',
		'.expertise-item h4 strong',
		'.pricing-item .plan',
		'.item-carousel-blog a',
	),
	'font_defaults' => array(
		'font-family'    => 'default_font',
		'letter-spacing' => '0',
		'font-weight'    => '',
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
	),
	'selectors'     => array(
		'#menu',
		'#footer ul.nav',
	),
	'font_defaults' => array(
		'font-family' => '"Hind", sans-serif',
		'font-weight' => '',
	),
) );

Epsilon_Customizer::add_field( 'portum_typography_headline_title', array(
	'type'          => 'epsilon-typography',
	'transport'     => 'postMessage',
	'section'       => 'portum_typography_section',
	'label'         => esc_html__( 'Headline title', 'portum' ),
	'stylesheet'    => 'portum-main',
	'choices'       => array(
		'font-family',
		'font-weight',
		'font-style',
		'font-size',
		'line-height',
		'letter-spacing',
	),
	'selectors'     => array(
		'.headline span',
	),
	'font_defaults' => array(
		'font-family'    => 'default_font',
		'font-weight'    => 'on',
		'font-style'     => '',
		'font-size'      => '16',
		'line-height'    => '22',
		'letter-spacing' => '1',
	),
) );

Epsilon_Customizer::add_field( 'portum_typography_headline_subtitle', array(
	'type'          => 'epsilon-typography',
	'transport'     => 'postMessage',
	'section'       => 'portum_typography_section',
	'label'         => esc_html__( 'Headline subtitle', 'portum' ),
	'stylesheet'    => 'portum-main',
	'choices'       => array(
		'font-family',
		'font-weight',
		'font-style',
		'font-size',
		'line-height',
		'letter-spacing',
	),
	'selectors'     => array(
		'.headline h3',
	),
	'font_defaults' => array(
		'font-family'    => 'default_font',
		'font-weight'    => '',
		'font-style'     => '',
		'font-size'      => '30',
		'line-height'    => '28',
		'letter-spacing' => '0',
	),
) );

/**
 * Blog section options
 */
Epsilon_Customizer::add_field( 'portum_show_single_post_thumbnail', array(
	'type'        => 'epsilon-toggle',
	'label'       => esc_html__( 'Post Meta: Thumbnail in content', 'portum' ),
	'description' => esc_html__( 'This option will disable the post thumbnail from the beginning of the post content.', 'portum' ),
	'section'     => 'header_image',
	'default'     => true,
) );

Epsilon_Customizer::add_field( 'portum_show_single_post_categories', array(
	'type'        => 'epsilon-toggle',
	'label'       => esc_html__( 'Post Meta: Categories', 'portum' ),
	'description' => esc_html__( 'This will disable the category section at the beggining of the post.', 'portum' ),
	'section'     => 'header_image',
	'default'     => true,
) );


Epsilon_Customizer::add_field( 'portum_enable_author_box', array(
	'type'        => 'epsilon-toggle',
	'label'       => esc_html__( 'Post meta: Author', 'portum' ),
	'description' => esc_html__( 'Toggle the display of the author box, at the left side of the post. Will only display if the author has a description defined.', 'portum' ),
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

Epsilon_Customizer::add_field( 'portum_show_blog_welcome', array(
	'type'        => 'epsilon-toggle',
	'label'       => esc_html__( 'Blog welcome message', 'portum' ),
	'description' => esc_html__( 'This will disable the welcome section from blog header', 'portum' ),
	'section'     => 'header_image',
	'default'     => false,
) );

/**
 * Header section options
 *
 * @todo still needs support
 */
/*
Epsilon_Customizer::add_field(
	'portum_header_top_bar',
	array(
		'type'     => 'epsilon-toggle',
		'label'    => esc_html__( 'Enable header top bar', 'portum' ),
		'section'  => 'portum_header_section',
		'default'  => true,
		'priority' => 0,
	)
);

Epsilon_Customizer::add_field(
	'portum_header_columns',
	array(
		'type'            => 'epsilon-layouts',
		'section'         => 'portum_header_section',
		'priority'        => 1,
		'layouts'         => array(
			1 => get_template_directory_uri() . '/inc/libraries/epsilon-framework/assets/img/one-column.png',
			2 => get_template_directory_uri() . '/inc/libraries/epsilon-framework/assets/img/two-column.png',
			3 => get_template_directory_uri() . '/inc/libraries/epsilon-framework/assets/img/three-column.png',
			4 => get_template_directory_uri() . '/inc/libraries/epsilon-framework/assets/img/four-column.png',
		),
		'default'         => array(
			'columnsCount' => 2,
			'columns'      => array(
				array(
					'index' => 1,
					'span'  => 6,
				),
				array(
					'index' => 2,
					'span'  => 6,
				),
			),
		),
		'min_span'        => 2,
		'label'           => esc_html__( 'Top Bar Columns', 'portum' ),
		'active_callback' => array( 'Portum_Customizer', 'header_top_bar_enabled_callback' ),
	)
);
*/

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
/**
 * Google Api KEY
 */
Epsilon_Customizer::add_field( 'portum_google_api_key', array(
	'type'              => 'text',
	'section'           => 'portum_misc_section',
	'sanitize_callback' => 'sanitize_text_field',
	'label'             => esc_html__( 'Google API KEY', 'portum' ),
	'description'       => sprintf( __( 'You need to make sure you have enabled billing on your Google account, otherwise your Google Maps API Key will not work. 
	This is a recent change Google introduced and not related to the theme itself. Please use <a href="%s" target="_blank">this link to get your API key</a>', 'portum' ), esc_url( 'https://developers.google.com/maps/documentation/javascript/get-api-key' ) ),
) );

//Translators: Contact forms not found label
$forms[0] = esc_html__( '-- No Contact Forms --', 'portum' );
if ( defined( 'WPCF7_VERSION' ) ) {
	$args = array(
		'post_type' => 'wpcf7_contact_form',
	);

	$posts = new WP_Query( $args );
	wp_reset_postdata();
	if ( $posts->have_posts() ) {
		//Translators: Select contact form label
		$forms[0] = esc_html__( '-- Select a Contact Form --', 'portum' );

		while ( $posts->have_posts() ) {
			$posts->the_post();
			$forms[ get_the_ID() ] = get_the_title();
		}
	}
}

/**
 * Contact Form
 */
Epsilon_Customizer::add_field( 'portum_contact_form', array(
	'type'        => 'select',
	'section'     => 'portum_footer_section',
	'label'       => 'Contact Form',
	'description' => 1 === count( $forms ) ? __( 'To use this section you need to create a contact form with Contact Form 7', 'portum' ) : null,
	'default'     => 'no-forms',
	'choices'     => $forms,
) );

/**
 * Contact form title
 */
Epsilon_Customizer::add_field( 'portum_footer_contact_title', array(
	'type'              => 'epsilon-text-editor',
	'section'           => 'portum_footer_section',
	'sanitize_callback' => 'sanitize_text_field',
	'default'           => __( 'Learn more about us', 'portum' ),
	'label'             => esc_html__( 'Contact form CTA', 'portum' ),
) );

/**
 * Contact boxes
 */
Epsilon_Customizer::add_field( 'portum_contact_section', array(
	'type'         => 'epsilon-repeater',
	'section'      => 'portum_contact_section',
	'save_as_meta' => Epsilon_Content_Backup::get_instance()->setting_page,
	'label'        => esc_html__( 'Contact Columns', 'portum' ),
	'button_label' => esc_html__( 'Add new boxes', 'portum' ),
	'row_label'    => array(
		'type'  => 'field',
		'field' => 'contact_title',
	),
	'fields'       => array(
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
			'type'    => 'epsilon-text-editor',
			'default' => esc_html__( '176 Westmore Mondaile Street Victorian 887 NYC', 'portum' ),
		),
	),
) );

/**
 * Copyright contents
 */
Epsilon_Customizer::add_field( 'portum_copyright_contents', array(
	'type'    => 'epsilon-text-editor',
	'default' => 'Macho Themes © 2017. All rights reserved.',
	'label'   => esc_html__( 'Copyright Text', 'portum' ),
	'section' => 'portum_footer_section',
) );
/**
 * Theme Content
 */

/**
 * Testimonials
 */
Epsilon_Customizer::add_field( 'portum_testimonials', array(
	'type'         => 'epsilon-repeater',
	'section'      => 'portum_testimonials_section',
	'save_as_meta' => Epsilon_Content_Backup::get_instance()->setting_page,
	'label'        => esc_html__( 'Testimonials', 'portum' ),
	'button_label' => esc_html__( 'Add new entries', 'portum' ),
	'row_label'    => array(
		'type'  => 'field',
		'field' => 'testimonial_title',
	),
	'fields'       => array(
		'testimonial_title'    => array(
			'label'   => esc_html__( 'Title', 'portum' ),
			'type'    => 'text',
			'default' => 'Michael Cross',
		),
		'testimonial_subtitle' => array(
			'label'   => esc_html__( 'Position', 'portum' ),
			'type'    => 'text',
			'default' => 'CEO @ Hampybrewry',
		),
		'testimonial_text'     => array(
			'label'   => esc_html__( 'Text', 'portum' ),
			'type'    => 'epsilon-text-editor',
			'default' => '"Maecenas nec maximus magna. Nullam nec metus ullamcorper, scelerisque nulla vel, amus at fermentum ligula Maecenas nec maximus magna. Nullam nec metus ullamcorper, scelerisque nulla vel, amus at fermentum ligula"',
		),
		'testimonial_image'    => array(
			'label'   => esc_html__( 'Portrait', 'portum' ),
			'type'    => 'epsilon-image',
			'size'    => 'medium',
			'default' => esc_url( get_template_directory_uri() . '/assets/images/testimonial-img-01.jpg' ),
		),
	),
) );
/**
 * Slides
 */
Epsilon_Customizer::add_field( 'portum_slides', array(
	'type'         => 'epsilon-repeater',
	'section'      => 'portum_slides_section',
	'save_as_meta' => Epsilon_Content_Backup::get_instance()->setting_page,
	'label'        => esc_html__( 'Slides', 'portum' ),
	'button_label' => esc_html__( 'Add new slides', 'portum' ),
	'row_label'    => array(
		'type'  => 'field',
		'field' => 'slides_title',
	),
	'fields'       => array(
		'slides_title'       => array(
			'label'             => esc_html__( 'Title', 'portum' ),
			'type'              => 'text',
			'sanitize_callback' => 'wp_kses_post',
			'default'           => 'Growing your business',
		),
		'slides_description' => array(
			'label'   => esc_html__( 'Description', 'portum' ),
			'type'    => 'epsilon-text-editor',
			'default' => 'FROM ZERO TO HERO ALONG WITH YOU',
		),
		'slides_image'       => array(
			'label'   => esc_html__( 'Portrait', 'portum' ),
			'type'    => 'epsilon-image',
			'size'    => 'portum-main-slider',
			'default' => esc_url( get_template_directory_uri() . '/assets/images/slider-img-01.jpg' ),
		),
	),
) );
/**
 * Services
 */
Epsilon_Customizer::add_field( 'portum_services', array(
	'type'         => 'epsilon-repeater',
	'section'      => 'portum_services_section',
	'save_as_meta' => Epsilon_Content_Backup::get_instance()->setting_page,
	'label'        => esc_html__( 'Services', 'portum' ),
	'button_label' => esc_html__( 'Add new service', 'portum' ),
	'row_label'    => array(
		'type'  => 'field',
		'field' => 'service_title',
	),
	'fields'       => array(
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
		'service_type'        => array(
			'label'   => esc_html__( 'Display style', 'portum' ),
			'type'    => 'select',
			'default' => 'no-border',
			'choices' => array(
				'no-border'     => __( 'No Border', 'portum' ),
				'border-square' => __( 'Square Border', 'portum' ),
				'border-round'  => __( 'Round Border', 'portum' ),
				'filled-square' => __( 'Filled Square', 'portum' ),
				'filled-round'  => __( 'Filled Round', 'portum' ),
			),
		),
		'service_type_color'  => array(
			'label'   => esc_html__( 'Color style', 'portum' ),
			'type'    => 'select',
			'default' => 'color-default',
			'choices' => array(
				'color-default' => __( 'White', 'portum' ),
				'color-accent1' => __( 'Color Accent 1', 'portum' ),
				'color-accent2' => __( 'Color Accent 2', 'portum' ),
			),
		),
	),
) );
/**
 * Portfolio Items
 */
Epsilon_Customizer::add_field( 'portum_portfolio', array(
	'type'         => 'epsilon-repeater',
	'section'      => 'portum_portfolio_section',
	'save_as_meta' => Epsilon_Content_Backup::get_instance()->setting_page,
	'label'        => esc_html__( 'Portfolio Items', 'portum' ),
	'button_label' => esc_html__( 'Add new items', 'portum' ),
	'row_label'    => array(
		'type'  => 'field',
		'field' => 'portfolio_title',
	),
	'fields'       => array(
		'portfolio_title'       => array(
			'label'             => esc_html__( 'Title', 'portum' ),
			'type'              => 'text',
			'sanitize_callback' => 'wp_kses_post',
			'default'           => esc_html__( 'Project Title', 'portum' ),
		),
		'portfolio_description' => array(
			'label'   => esc_html__( 'Description', 'portum' ),
			'type'    => 'epsilon-text-editor',
			'default' => esc_html__( 'Nullam nec metus ullamcorper, scelerisque null', 'portum' ),
		),
		'portfolio_image'       => array(
			'label'   => esc_html__( 'Image', 'portum' ),
			'type'    => 'epsilon-image',
			'size'    => 'portum-portfolio-image',
			'default' => esc_url( get_template_directory_uri() . '/assets/images/03_projects_01.jpg' ),
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
 * Expertise
 */
Epsilon_Customizer::add_field( 'portum_expertise', array(
	'type'         => 'epsilon-repeater',
	'section'      => 'portum_expertise_section',
	'save_as_meta' => Epsilon_Content_Backup::get_instance()->setting_page,
	'label'        => esc_html__( 'Expertise Items', 'portum' ),
	'button_label' => esc_html__( 'Add new items', 'portum' ),
	'row_label'    => array(
		'type'  => 'field',
		'field' => 'expertise_title',
	),
	'fields'       => array(
		'expertise_number'      => array(
			'label'             => esc_html__( 'Number', 'portum' ),
			'type'              => 'text',
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => '01',
		),
		'expertise_title'       => array(
			'label'             => esc_html__( 'Title', 'portum' ),
			'type'              => 'text',
			'sanitize_callback' => 'wp_kses_post',
			'default'           => esc_html__( 'We can improve your business', 'portum' ),
		),
		'expertise_description' => array(
			'label'   => esc_html__( 'Description', 'portum' ),
			'type'    => 'epsilon-text-editor',
			'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris lacinia velit quis sem dignissim porta.', 'portum' ),
		),
	),
) );
/**
 * Counter boxes
 */
Epsilon_Customizer::add_field( 'portum_counter_boxes', array(
	'type'         => 'epsilon-repeater',
	'section'      => 'portum_counters_section',
	'save_as_meta' => Epsilon_Content_Backup::get_instance()->setting_page,
	'label'        => esc_html__( 'Counter Items', 'portum' ),
	'button_label' => esc_html__( 'Add new items', 'portum' ),
	'row_label'    => array(
		'type'  => 'field',
		'field' => 'counter_title',
	),
	'fields'       => array(
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
		'counter_icon'         => array(
			'label'   => esc_html__( 'Icon', 'portum' ),
			'type'    => 'epsilon-icon-picker',
			'default' => 'fa fa-hdd-o',
			'groups'  => array( 'general' ),
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
			'default' => true,
		),
	),
) );
/**
 * Progress bars
 */
Epsilon_Customizer::add_field( 'portum_progress_bars', array(
	'type'         => 'epsilon-repeater',
	'section'      => 'portum_progress_bars_section',
	'save_as_meta' => Epsilon_Content_Backup::get_instance()->setting_page,
	'label'        => esc_html__( 'Progress Bars', 'portum' ),
	'button_label' => esc_html__( 'Add new items', 'portum' ),
	'row_label'    => array(
		'type'  => 'field',
		'field' => 'progress_bar_title',
	),
	'fields'       => array(
		'progress_bar_title' => array(
			'label'             => esc_html__( 'Title', 'portum' ),
			'type'              => 'text',
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => 'Satisfaction',
		),
		'progress_bar_value' => array(
			'label'             => esc_html__( 'Number', 'portum' ),
			'type'              => 'text',
			'sanitize_callback' => 'absint',
			'default'           => 55,
		),
		'progress_bar_type'  => array(
			'label'   => esc_html__( 'Type', 'portum' ),
			'type'    => 'select',
			'default' => 'normal',
			'choices' => array(
				'normal'    => esc_html__( 'Normal', 'portum' ),
				'alternate' => esc_html__( 'Alternate', 'portum' ),
			),
		),
	),
) );
/**
 * Pie charts bars
 */
Epsilon_Customizer::add_field( 'portum_pie_charts', array(
	'type'         => 'epsilon-repeater',
	'section'      => 'portum_piecharts_section',
	'save_as_meta' => Epsilon_Content_Backup::get_instance()->setting_page,
	'label'        => esc_html__( 'Pie Charts', 'portum' ),
	'button_label' => esc_html__( 'Add new items', 'portum' ),
	'row_label'    => array(
		'type'  => 'field',
		'field' => 'piechart_title',
	),
	'fields'       => array(
		'piechart_title'     => array(
			'label'             => esc_html__( 'Title', 'portum' ),
			'type'              => 'text',
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => 'Satisfaction',
		),
		'piechart_text'      => array(
			'label'   => esc_html__( 'Text', 'portum' ),
			'type'    => 'epsilon-text-editor',
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
	'type'         => 'epsilon-repeater',
	'section'      => 'portum_clientlists_section',
	'save_as_meta' => Epsilon_Content_Backup::get_instance()->setting_page,
	'label'        => esc_html__( 'Client Logos', 'portum' ),
	'button_label' => esc_html__( 'Add new items', 'portum' ),
	'row_label'    => array(
		'type'  => 'field',
		'field' => 'client_title',
	),
	'fields'       => array(
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
	'type'         => 'epsilon-repeater',
	'section'      => 'portum_team_members_section',
	'save_as_meta' => Epsilon_Content_Backup::get_instance()->setting_page,
	'label'        => esc_html__( 'Team Members', 'portum' ),
	'button_label' => esc_html__( 'Add new member', 'portum' ),
	'row_label'    => array(
		'type'  => 'field',
		'field' => 'member_title',
	),
	'fields'       => array(
		'member_title'            => array(
			'label'             => esc_html__( 'Name', 'portum' ),
			'type'              => 'text',
			'default'           => __( 'James Austin', 'portum' ),
			'sanitize_callback' => 'wp_kses_post',
		),
		'member_text'             => array(
			'label'   => esc_html__( 'Text', 'portum' ),
			'type'    => 'epsilon-text-editor',
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
	'type'         => 'epsilon-repeater',
	'section'      => 'portum_pricing_section',
	'save_as_meta' => Epsilon_Content_Backup::get_instance()->setting_page,
	'label'        => esc_html__( 'Price Boxes', 'portum' ),
	'button_label' => esc_html__( 'Add new price box', 'portum' ),
	'row_label'    => array(
		'type'  => 'field',
		'field' => 'price_box_title',
	),
	'fields'       => array(
		'price_box_title'    => array(
			'label'             => esc_html__( 'Name', 'portum' ),
			'type'              => 'text',
			'default'           => esc_html__( 'Standard', 'portum' ),
			'sanitize_callback' => 'wp_kses_post',
		),
		'price_box_text'     => array(
			'label'             => esc_html__( 'Text', 'portum' ),
			'type'              => 'text',
			'default'           => esc_html__( 'Get started now! You have the base!', 'portum' ),
			'sanitize_callback' => 'wp_kses_post',
		),
		'price_box_currency' => array(
			'label'   => esc_html__( 'Currency', 'portum' ),
			'type'    => 'text',
			'default' => '$',
		),
		'price_box_price'    => array(
			'label'   => esc_html__( 'Price', 'portum' ),
			'type'    => 'text',
			'default' => '59',
		),
		'price_box_period'   => array(
			'label'   => esc_html__( 'Period', 'portum' ),
			'type'    => 'text',
			'default' => 'mo',
		),
		'price_box_url'      => array(
			'label'             => esc_html__( 'Button URL', 'portum' ),
			'type'              => 'text',
			'default'           => '#',
			'sanitize_callback' => 'wp_kses_post',
		),
		'price_box_features' => array(
			'label'             => esc_html__( 'Features', 'portum' ),
			'type'              => 'epsilon-text-editor',
			'default'           => '<ul><li><span>10GB</span> Disk Space</li><li><span>Free</span> DDoS Protection</li><li><span>Free</span> Daily Backups</li><li>Managed Hosting</li></ul>',
			'sanitize_callback' => 'wp_kses_post',
		),
		'price_box_featured' => array(
			'type'    => 'epsilon-toggle',
			'label'   => esc_html__( 'Featured state', 'portum' ),
			'default' => false,
		),
	),
) );

Epsilon_Customizer::add_field( 'portum_advanced_slides', array(
	'type'         => 'epsilon-repeater',
	'section'      => 'portum_advanced_slides_section',
	'save_as_meta' => Epsilon_Content_Backup::get_instance()->setting_page,
	'label'        => esc_html__( 'Slides', 'portum' ),
	'button_label' => esc_html__( 'Add new slides', 'portum' ),
	'row_label'    => array(
		'type'  => 'field',
		'field' => 'slide_title',
	),
	'fields'       => array(
		'slide_title'                   => array(
			'label'             => esc_html__( 'Slide title', 'portum' ),
			'type'              => 'text',
			'sanitize_callback' => 'wp_kses_post',
			'default'           => esc_html__( 'Best Medical Care you can get for you and your family.', 'portum' ),
		),
		'slide_title_animation'         => array(
			'label'   => esc_html__( 'Slide title animation', 'portum' ),
			'type'    => 'select',
			'default' => 'fadeInDown',
			'choices' => array(
				'fadeIn'      => __( 'Fade In', 'portum' ),
				'fadeInUp'    => __( 'Fade In Up', 'portum' ),
				'fadeInDown'  => __( 'Fade In Down', 'portum' ),
				'fadeInLeft'  => __( 'Fade In Left', 'portum' ),
				'fadeInRight' => __( 'Fade In Right', 'portum' ),
			),
		),
		'slide_description'             => array(
			'label'             => esc_html__( 'Slide description', 'portum' ),
			'type'              => 'text',
			'sanitize_callback' => 'wp_kses_post',
			'default'           => esc_html__( 'More than 3000 specialists are here for you', 'portum' ),
		),
		'slide_description_animation'   => array(
			'label'   => esc_html__( 'Slide description animation', 'portum' ),
			'type'    => 'select',
			'default' => 'fadeInDown',
			'choices' => array(
				'fadeIn'      => __( 'Fade In', 'portum' ),
				'fadeInUp'    => __( 'Fade In Up', 'portum' ),
				'fadeInDown'  => __( 'Fade In Down', 'portum' ),
				'fadeInLeft'  => __( 'Fade In Left', 'portum' ),
				'fadeInRight' => __( 'Fade In Right', 'portum' ),
			),
		),
		'slide_background_color'        => array(
			'label'      => esc_html__( 'Slide Overlay Color', 'portum' ),
			'type'       => 'epsilon-color-picker',
			'mode'       => 'rgba',
			'defaultVal' => '#f9f9fa',
			'default'    => 'rgba(0,0,0,.1)',
		),
		'slide_background'              => array(
			'label' => esc_html__( 'Background image', 'portum' ),
			'type'  => 'epsilon-image',
			'size'  => 'portum-main-slider',
		),
		'slide_cta_primary_label'       => array(
			'label'             => esc_html__( 'Primary Button Text', 'portum' ),
			'type'              => 'text',
			'default'           => '',
			'sanitize_callback' => 'wp_kses_post',
		),
		'slide_cta_primary_url'         => array(
			'label'             => esc_html__( 'Primary Button URL', 'portum' ),
			'type'              => 'text',
			'default'           => '#',
			'sanitize_callback' => 'wp_kses_post',
		),
		'slide_cta_primary_animation'   => array(
			'label'   => esc_html__( 'Slide primary button animation', 'portum' ),
			'type'    => 'select',
			'default' => 'fadeInDown',
			'choices' => array(
				'fadeIn'      => __( 'Fade In', 'portum' ),
				'fadeInUp'    => __( 'Fade In Up', 'portum' ),
				'fadeInDown'  => __( 'Fade In Down', 'portum' ),
				'fadeInLeft'  => __( 'Fade In Left', 'portum' ),
				'fadeInRight' => __( 'Fade In Right', 'portum' ),
			),
		),
		'slide_cta_secondary_label'     => array(
			'label'             => esc_html__( 'Secondary Button Text', 'portum' ),
			'type'              => 'text',
			'default'           => '',
			'sanitize_callback' => 'wp_kses_post',
		),
		'slide_cta_secondary_url'       => array(
			'label'             => esc_html__( 'Secondary Button URL', 'portum' ),
			'type'              => 'text',
			'default'           => '#',
			'sanitize_callback' => 'wp_kses_post',
		),
		'slide_cta_secondary_animation' => array(
			'label'   => esc_html__( 'Slide secondary button animation', 'portum' ),
			'type'    => 'select',
			'default' => 'fadeInDown',
			'choices' => array(
				'fadeIn'      => __( 'Fade In', 'portum' ),
				'fadeInUp'    => __( 'Fade In Up', 'portum' ),
				'fadeInDown'  => __( 'Fade In Down', 'portum' ),
				'fadeInLeft'  => __( 'Fade In Left', 'portum' ),
				'fadeInRight' => __( 'Fade In Right', 'portum' ),
			),
		),
		'slide_alignment'               => array(
			'type'      => 'epsilon-button-group',
			'label'     => __( 'Alignment', 'epsilon-framework' ),
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
		'slide_vertical_alignment'      => array(
			'type'      => 'epsilon-button-group',
			'label'     => __( 'Vertical Alignment', 'epsilon-framework' ),
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
	),
) );

/**
 * Section builder page changer ( acts as a menu )
 */
Epsilon_Customizer::add_field( 'portum_page_changer', array(
	'type'     => 'epsilon-page-changer',
	'label'    => esc_html__( 'Available pages', 'portum' ),
	'section'  => 'portum_repeatable_section',
	'priority' => 0,
) );

Epsilon_Customizer::add_field( 'portum_logo_dimensions', array(
	'type'           => 'epsilon-image-dimensions',
	'label'          => esc_html__( 'Logo Dimensions', 'portum' ),
	'linked_control' => 'custom_logo',
	'section'        => 'title_tagline',
	'priority'       => 1,
) );

/**
 * Repeatable sections
 */
Epsilon_Customizer::add_field( 'portum_frontpage_sections', array(
	'type'                => 'epsilon-section-repeater',
	'label'               => esc_html__( 'Sections', 'portum' ),
	'section'             => 'portum_repeatable_section',
	'page_builder'        => true,
	//		'selective_refresh'   => true,
	//		'transport'           => 'postMessage',
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
