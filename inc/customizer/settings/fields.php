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
Epsilon_Customizer::add_field(
	'portum_enable_go_top',
	array(
		'type'        => 'epsilon-toggle',
		'label'       => esc_html__( 'Go to top button', 'portum' ),
		'description' => esc_html__( 'Toggle the display of the go to top button.', 'portum' ),
		'section'     => 'portum_header_section',
		'default'     => true,
	)
);
/**
 * Layout section options
 */
Epsilon_Customizer::add_field(
	'portum_layout',
	array(
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
	)
);
Epsilon_Customizer::add_field(
	'portum_page_layout',
	array(
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
	)
);
/**
 * Typography section options
 */
Epsilon_Customizer::add_field(
	'portum_typography_headings',
	array(
		'type'          => 'epsilon-typography',
		'transport'     => 'postMessage',
		'label'         => esc_html__( 'Headings', 'portum' ),
		'section'       => 'portum_layout_section',
		'description'   => esc_html__( 'Note: Current typography controls will only be affecting the blog.', 'portum' ),
		'stylesheet'    => 'portum-main',
		'choices'       => array(
			'font-family',
			'font-weight',
			'font-style',
			'letter-spacing',
		),
		'selectors'     => array(
			'.post-title',
			'.post-content h1',
			'.post-content h2',
			'.post-content h3',
			'.post-content h4',
			'.post-content h5',
			'.post-content h6',
		),
		'font_defaults' => array(
			'letter-spacing' => '0',
			'font-family'    => '',
			'font-weight'    => '',
			'font-style'     => '',
		),
	)
);
Epsilon_Customizer::add_field(
	'portum_paragraphs_typography',
	array(
		'type'          => 'epsilon-typography',
		'transport'     => 'postMessage',
		'section'       => 'portum_layout_section',
		'label'         => esc_html__( 'Paragraphs', 'portum' ),
		'description'   => esc_html__( 'Note: Current typography controls will only be affecting the blog.', 'portum' ),
		'stylesheet'    => 'portum-main',
		'choices'       => array(
			'font-family',
			'font-weight',
			'font-style',
		),
		'selectors'     => array(
			'.post-content p',
		),
		'font_defaults' => array(
			'font-family' => '',
			'font-weight' => '',
			'font-style'  => '',
		),
	)
);

/**
 * Blog section options
 */
Epsilon_Customizer::add_field(
	'portum_show_single_post_thumbnail',
	array(
		'type'        => 'epsilon-toggle',
		'label'       => esc_html__( 'Post Meta: Thumbnail in content', 'portum' ),
		'description' => esc_html__( 'This option will disable the post thumbnail from the beginning of the post content.', 'portum' ),
		'section'     => 'header_image',
		'default'     => true,
	)
);

Epsilon_Customizer::add_field(
	'portum_show_single_post_categories',
	array(
		'type'        => 'epsilon-toggle',
		'label'       => esc_html__( 'Post Meta: Categories', 'portum' ),
		'description' => esc_html__( 'This will disable the category section at the beggining of the post.', 'portum' ),
		'section'     => 'header_image',
		'default'     => true,
	)
);


Epsilon_Customizer::add_field(
	'portum_enable_author_box',
	array(
		'type'        => 'epsilon-toggle',
		'label'       => esc_html__( 'Post meta: Author', 'portum' ),
		'description' => esc_html__( 'Toggle the display of the author box, at the left side of the post. Will only display if the author has a description defined.', 'portum' ),
		'section'     => 'header_image',
		'default'     => true,
	)
);

Epsilon_Customizer::add_field(
	'portum_show_single_post_tags',
	array(
		'type'        => 'epsilon-toggle',
		'label'       => esc_html__( 'Post Meta: Tags', 'portum' ),
		'description' => esc_html__( 'This will disable the tags zone at the end of the post.', 'portum' ),
		'section'     => 'header_image',
		'default'     => true,
	)
);

/**
 * Footer section options
 */
Epsilon_Customizer::add_field(
	'portum_footer_columns',
	array(
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
	)
);
/**
 * Google Api KEY
 */
Epsilon_Customizer::add_field(
	'portum_google_api_key',
	array(
		'type'              => 'text',
		'section'           => 'portum_footer_section',
		'sanitize_callback' => 'sanitize_text_field',
		'label'             => esc_html__( 'Google API KEY', 'portum' ),
	)
);

/**
 * Google Address
 */
Epsilon_Customizer::add_field(
	'portum_google_map_address',
	array(
		'type'              => 'text',
		'section'           => 'portum_footer_section',
		'default'           => 'Centrul Vechi, Brasov',
		'sanitize_callback' => 'sanitize_text_field',
		'label'             => esc_html__( 'Google Address', 'portum' ),
	)
);
/**
 * Google Map Zoom
 */
Epsilon_Customizer::add_field(
	'portum_google_map_zoom',
	array(
		'type'    => 'epsilon-slider',
		'section' => 'portum_footer_section',
		'label'   => esc_html__( 'Google Map Zoom', 'portum' ),
		'default' => 17,
		'choices' => array(
			'min'  => 1,
			'max'  => 20,
			'step' => 1,
		),
	)
);

Epsilon_Customizer::add_field(
	'portum_contact_title',
	array(
		'type'              => 'text',
		'section'           => 'portum_footer_section',
		'sanitize_callback' => 'sanitize_text_field',
		'label'             => esc_html__( 'Contact section title', 'portum' ),
	)
);
Epsilon_Customizer::add_field(
	'portum_contact_subtitle',
	array(
		'type'              => 'text',
		'section'           => 'portum_footer_section',
		'sanitize_callback' => 'sanitize_text_field',
		'label'             => esc_html__( 'Contact section subtitle', 'portum' ),
	)
);

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
Epsilon_Customizer::add_field(
	'portum_contact_form',
	array(
		'type'        => 'select',
		'section'     => 'portum_footer_section',
		'label'       => 'Contact Form',
		'description' => 1 === count( $forms ) ? __( 'To use this section you need to create a contact form with CF7', 'portum' ) : null,
		'default'     => 'no-forms',
		'choices'     => $forms,
	)
);
/**
 * Contact boxes
 */
Epsilon_Customizer::add_field(
	'portum_contact_section',
	array(
		'type'         => 'epsilon-repeater',
		'section'      => 'portum_footer_section',
		'save_as_meta' => Epsilon_Content_Backup::get_instance()->setting_page,
		'label'        => esc_html__( 'Contact Columns', 'portum' ),
		'button_label' => esc_html__( 'Add new boxes', 'portum' ),
		'row_label'    => array(
			'type'  => 'field',
			'field' => 'contact_title',
		),
		'fields'       => array(
			'contact_title' => array(
				'label' => esc_html__( 'Title', 'portum' ),
				'type'  => 'text',
			),
			'contact_icon'  => array(
				'label' => esc_html__( 'Icon', 'portum' ),
				'type'  => 'epsilon-icon-picker',
			),
			'contact_text'  => array(
				'label' => esc_html__( 'Text', 'portum' ),
				'type'  => 'epsilon-text-editor',
			),
		),
	)
);

/**
 * Copyright contents
 */
Epsilon_Customizer::add_field(
	'portum_copyright_contents',
	array(
		'type'    => 'epsilon-text-editor',
		'default' => 'Macho Themes © 2017. All rights reserved.',
		'label'   => esc_html__( 'Copyright Text', 'portum' ),
		'section' => 'portum_footer_section',
	)
);
/**
 * Theme Content
 */

/**
 * Testimonials
 */
Epsilon_Customizer::add_field(
	'portum_testimonials',
	array(
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
				'default' => '',
			),
			'testimonial_subtitle' => array(
				'label'   => esc_html__( 'Position', 'portum' ),
				'type'    => 'text',
				'default' => '',
			),
			'testimonial_text'     => array(
				'label'   => esc_html__( 'Text', 'portum' ),
				'type'    => 'epsilon-text-editor',
				'default' => '',
			),
			'testimonial_image'    => array(
				'label'   => esc_html__( 'Portrait', 'portum' ),
				'type'    => 'epsilon-image',
				'size'    => 'portum-testimonial-portrait',
				'default' => '',
			),
		),
	)
);
/**
 * Slides
 */
Epsilon_Customizer::add_field(
	'portum_slides',
	array(
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
				'default'           => '',
			),
			'slides_description' => array(
				'label'   => esc_html__( 'Description', 'portum' ),
				'type'    => 'epsilon-text-editor',
				'default' => '',
			),
			'slides_image'       => array(
				'label'   => esc_html__( 'Portrait', 'portum' ),
				'type'    => 'epsilon-image',
				'size'    => 'portum-main-slider',
				'default' => '',
			),
		),
	)
);
/**
 * Services
 */
Epsilon_Customizer::add_field(
	'portum_services',
	array(
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
				'default'           => '',
			),
			'service_description' => array(
				'label'             => esc_html__( 'Description', 'portum' ),
				'type'              => 'text',
				'sanitize_callback' => 'wp_kses_post',
				'default'           => '',
			),
			'service_icon'        => array(
				'label'   => esc_html__( 'Icon', 'portum' ),
				'type'    => 'epsilon-icon-picker',
				'default' => 'fa fa-users',
			),
		),
	)
);
/**
 * Portfolio Items
 */
Epsilon_Customizer::add_field(
	'portum_portfolio',
	array(
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
				'default'           => '',
			),
			'portfolio_description' => array(
				'label'   => esc_html__( 'Description', 'portum' ),
				'type'    => 'epsilon-text-editor',
				'default' => '',
			),
			'portfolio_image'       => array(
				'label'   => esc_html__( 'Image', 'portum' ),
				'type'    => 'epsilon-image',
				'size'    => 'portum-portfolio-image',
				'default' => '',
			),
			'portfolio_image_url'   => array(
				'label'             => esc_html__( 'Image URL', 'portum' ),
				'type'              => 'url',
				'sanitize_callback' => 'esc_url_raw',
				'default'           => '',
			),
		),
	)
);
/**
 * Expertise
 */
Epsilon_Customizer::add_field(
	'portum_expertise',
	array(
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
			'expertise_title'       => array(
				'label'             => esc_html__( 'Title', 'portum' ),
				'type'              => 'text',
				'sanitize_callback' => 'wp_kses_post',
				'default'           => '',
			),
			'expertise_description' => array(
				'label'   => esc_html__( 'Description', 'portum' ),
				'type'    => 'epsilon-text-editor',
				'default' => '',
			),
		),
	)
);
/**
 * Team Members
 */
Epsilon_Customizer::add_field(
	'portum_team_members',
	array(
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
				'default'           => '',
				'sanitize_callback' => 'wp_kses_post',
			),
			'member_text'             => array(
				'label'   => esc_html__( 'Text', 'portum' ),
				'type'    => 'epsilon-text-editor',
				'default' => '',
			),
			'member_image'            => array(
				'label'   => esc_html__( 'Portrait', 'portum' ),
				'type'    => 'epsilon-image',
				'size'    => 'portum-team-image',
				'default' => '',
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
	)
);
/**
 * Team Members
 */
Epsilon_Customizer::add_field(
	'portum_price_boxes',
	array(
		'type'         => 'epsilon-repeater',
		'section'      => 'portum_pricing_section',
		'save_as_meta' => Epsilon_Content_Backup::get_instance()->setting_page,
		'label'        => esc_html__( 'Price Boxes', 'portum' ),
		'button_label' => esc_html__( 'Add new price box', 'portum' ),
		'row_label'    => array(
			'type'  => 'field',
			'field' => 'member_title',
		),
		'fields'       => array(
			'price_box_title'    => array(
				'label'             => esc_html__( 'Name', 'portum' ),
				'type'              => 'text',
				'default'           => '',
				'sanitize_callback' => 'wp_kses_post',
			),
			'price_box_text'     => array(
				'label'             => esc_html__( 'Text', 'portum' ),
				'type'              => 'text',
				'default'           => '',
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
				'default'           => '',
				'sanitize_callback' => 'wp_kses_post',
			),
			'price_box_features' => array(
				'label'             => esc_html__( 'Features', 'portum' ),
				'type'              => 'epsilon-text-editor',
				'default'           => '<ul><li><span>10GB</span> Disk Space</li><li><span>Free</span> DDoS Protection</li><li><span>Free</span> Daily Backups</li><li>Managed Hosting</li></ul>',
				'sanitize_callback' => 'wp_kses_post',
			),
		),
	)
);

/**
 * Repeatable sections
 */
Epsilon_Customizer::add_field(
	'portum_frontpage_sections',
	array(
		'type'                => 'epsilon-section-repeater',
		'label'               => esc_html__( 'Sections', 'portum' ),
		'section'             => 'portum_repeatable_section',
		'selective_refresh'   => true,
		'page_builder'        => true,
		'repeatable_sections' => Portum_Repeatable_Sections::get_instance()->sections,
		'transport'           => 'postMessage',
	)
);
/**
 * Color Schemes
 */
Epsilon_Customizer::add_field(
	'portum_color_scheme',
	array(
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
					'epsilon_accent_color'        => '#cc263d',
					'epsilon_accent_color_second' => '#364d7c',
					'epsilon_text_color'          => '#777777',
					'epsilon_title_color'         => '#1a171c',
					'epsilon_link_color'          => '#d1d5de',
					'epsilon_footer_background'   => '#18304c',
					'epsilon_footer_text_color'   => '#13b0a5',
				),
			),
			array(
				'id'     => 'yellow',
				'name'   => 'Yellow',
				'colors' => array(
					'epsilon_accent_color'        => '#f3950f',
					'epsilon_accent_color_second' => '#364d7c',
					'epsilon_text_color'          => '#777777',
					'epsilon_title_color'         => '#1a171c',
					'epsilon_link_color'          => '#d1d5de',
					'epsilon_footer_background'   => '#18304c',
					'epsilon_footer_text_color'   => '#13b0a5',
				),
			),
			array(
				'id'     => 'green',
				'name'   => 'Green',
				'colors' => array(
					'epsilon_accent_color'        => '#097d3d',
					'epsilon_accent_color_second' => '#364d7c',
					'epsilon_text_color'          => '#777777',
					'epsilon_title_color'         => '#1a171c',
					'epsilon_link_color'          => '#d1d5de',
					'epsilon_footer_background'   => '#18304c',
					'epsilon_footer_text_color'   => '#13b0a5',
				),
			),
			array(
				'id'     => 'blue',
				'name'   => 'Blue',
				'colors' => array(
					'epsilon_accent_color'        => '#298dd2',
					'epsilon_accent_color_second' => '#364d7c',
					'epsilon_text_color'          => '#777777',
					'epsilon_title_color'         => '#1a171c',
					'epsilon_link_color'          => '#d1d5de',
					'epsilon_footer_background'   => '#18304c',
					'epsilon_footer_text_color'   => '#13b0a5',
				),
			),
			array(
				'id'     => 'magenta',
				'name'   => 'Magenta',
				'colors' => array(
					'epsilon_accent_color'        => '#ae1062',
					'epsilon_accent_color_second' => '#364d7c',
					'epsilon_text_color'          => '#777777',
					'epsilon_title_color'         => '#1a171c',
					'epsilon_link_color'          => '#d1d5de',
					'epsilon_footer_background'   => '#18304c',
					'epsilon_footer_text_color'   => '#13b0a5',
				),
			),
		),
	)
);
