<?php
/**
 * Portum Theme Framework
 *
 * @package Portum
 * @since   1.0
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Class Portum
 */
class Portum {

	/**
	 * @var bool
	 */
	public $top_bar = false;

	/**
	 * Portum constructor.
	 *
	 * Theme specific actions and filters
	 *
	 * @param array $theme
	 */
	public function __construct( $theme = array() ) {
		$this->theme = $theme;

		$theme = wp_get_theme();
		$arr   = array(
			'theme-name'    => $theme->get( 'Name' ),
			'theme-slug'    => $theme->get( 'TextDomain' ),
			'theme-version' => $theme->get( 'Version' ),
		);

		$this->theme = wp_parse_args( $this->theme, $arr );
		/**
		 * If PHP Version is older than 5.3, we switch back to default theme
		 */
		add_action( 'admin_init', array( $this, 'php_version_check' ) );
		/**
		 * Start theme setup
		 */
		add_action( 'after_setup_theme', array( $this, 'theme_setup' ) );
		/**
		 * Add a notice for the MachoThemes feedback
		 */
		add_action( 'admin_init', array( $this, 'add_feedback_notice' ) );
		/**
		 * Enqueue styles and scripts
		 */
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueues' ) );
		/**
		 * Customizer enqueues & controls
		 */
		add_action( 'customize_register', array( $this, 'customize_register_init' ) );
		/**
		 * Declare content width
		 */
		add_action( 'after_setup_theme', array( $this, 'content_width' ), 10 );
		/**
		 * Init epsilon dashboard
		 */
		add_filter( 'epsilon-dashboard-setup', array( $this, 'epsilon_dashboard' ) );
		add_filter( 'epsilon-onboarding-setup', array( $this, 'epsilon_onboarding' ) );
		/**
		 * Customizer styling
		 */
		add_action( 'wp_enqueue_scripts', array( $this, 'customizer_styles' ), 99 );
		/**
		 * Grab all class methods and initiate automatically
		 */
		$methods = get_class_methods( 'Portum' );
		foreach ( $methods as $method ) {
			if ( false !== strpos( $method, 'init_' ) ) {
				$this->$method();
			}
		}
	}

	/**
	 * Portum instance
	 *
	 * @param array $theme
	 *
	 * @return Portum
	 */
	public static function get_instance( $theme = array() ) {
		static $inst;
		if ( ! $inst ) {
			$inst = new Portum( $theme );
		}

		return $inst;
	}

	/**
	 * Check PHP Version and switch theme
	 */
	public function php_version_check() {
		if ( version_compare( PHP_VERSION, '5.3.0' ) >= 0 ) {
			return true;
		}

		switch_theme( WP_DEFAULT_THEME );

		return false;
	}

	/**
	 * Adds a feedback notice if conditions are met
	 */
	public function add_feedback_notice() {
		if ( get_user_meta( get_current_user_id(), 'notification_feedback', true ) ) {
			return;
		}

		$page_on_front = 'page' == get_option( 'show_on_front' ) ? true : false;
		$id            = absint( get_option( 'page_on_front', 0 ) );

		if ( $page_on_front && 0 !== $id ) {
			$revisions = wp_get_post_revisions( $id );

			if ( count( $revisions ) > 3 ) {
				/**
				 * Revision keys are ID's, and it's not incremental
				 */
				$first = end( $revisions );

				$revision_time = new DateTime( $first->post_modified );
				$today         = new DateTime( 'today' );
				$interval      = $today->diff( $revision_time )->format( '%d' );

				if ( 2 <= absint( $interval ) ) {
					$this->_notify_feedback();
				}
			}
		}
	}

	/**
	 * Notify of feedback
	 */
	private function _notify_feedback() {
		if ( ! class_exists( 'Epsilon_Notifications' ) ) {
			return;
		}
		$html = '<p>';
		$html .= vsprintf( // Translators: 1 is Theme Name, 2 is opening Anchor, 3 is closing.
			__( 'We\'ve been working hard on making %1$s the best one out there. We\'re interested in hearing your thoughts about %1$s and what we could do to make it even better. %2$sSend your feedback our way%3$s.', 'portum' ), array(
			'Portum',
			'<a target="_blank" href="https://bit.ly/feedback-portum">',
			'</a>',
		) );

		$notifications = Epsilon_Notifications::get_instance();
		$notifications->add_notice( array(
			'id'      => 'portum_notification_feedback',
			'type'    => 'notice epsilon-big',
			'message' => $html,
		) );
	}

	/**
	 * Initiate the epsilon framework
	 */
	public function init_epsilon() {
		new Epsilon_Framework();

		$this->start_typography_controls();
		$this->start_color_schemes();
	}

	/**
	 * Initiate the Hooks in Portum
	 */
	public function init_hooks() {
		new Portum_Hooks();
	}

	/**
	 * Initiate Woocommerce class
	 */
	public function init_woocommerce() {
		new Portum_Woocommerce();
	}

	/**
	 * Initiate the user profiles
	 */
	public function init_user_profile() {
		new Portum_Profile_Fields();
	}

	/**
	 * Loads sidebars and widgets
	 */
	public function init_sidebars() {
		new Portum_Sidebars();
	}

	/**
	 *
	 */
	public function init_nav_menus() {
		new Epsilon_Section_Navigation_Menu( 'portum_frontpage_sections_' );
	}

	/**
	 * Initiate the setting helper
	 */
	public function customize_register_init() {
		new Portum_Customizer();
	}

	/**
	 * Customizer styles ( from repeater )
	 */
	public function customizer_styles() {
		new Epsilon_Section_Styling( 'portum-main', 'portum_frontpage_sections_', Portum_Repeatable_Sections::get_instance() );
	}

	/**
	 * Set color scheme controls
	 */

	public function get_color_scheme() {

		return array(
			'epsilon_general_separator' => array(
				'label'     => esc_html__( 'Accent Colors', 'portum' ),
				'section'   => 'colors',
				'separator' => true,
			),

			'epsilon_accent_color' => array(
				'label'       => esc_html__( 'Accent Color #1', 'portum' ),
				'description' => esc_html__( 'Theme main color.', 'portum' ),
				'default'     => '#0385D0',
				'section'     => 'colors',
				'hover-state' => false,
			),

			'epsilon_accent_color_second' => array(
				'label'       => esc_html__( 'Accent Color #2', 'portum' ),
				'description' => esc_html__( 'The second main color.', 'portum' ),
				'default'     => '#A1083A',
				'section'     => 'colors',
				'hover-state' => false,
			),

			'epsilon_text_separator' => array(
				'label'     => esc_html__( 'Typography Colors', 'portum' ),
				'section'   => 'colors',
				'separator' => true,
			),

			'epsilon_title_color' => array(
				'label'       => esc_html__( 'Title Color', 'portum' ),
				'description' => esc_html__( 'The color used for titles.', 'portum' ),
				'default'     => '#404044',
				'section'     => 'colors',
				'hover-state' => false,
			),

			'epsilon_text_color' => array(
				'label'       => esc_html__( 'Text Color', 'portum' ),
				'description' => esc_html__( 'The color used for paragraphs.', 'portum' ),
				'default'     => '#212529',
				'section'     => 'colors',
				'hover-state' => false,
			),

			'epsilon_link_color' => array(
				'label'       => esc_html__( 'Link Color', 'portum' ),
				'description' => esc_html__( 'The color used for links.', 'portum' ),
				'default'     => '#0385d0',
				'section'     => 'colors',
				'hover-state' => false,
			),

			'epsilon_link_hover_color' => array(
				'label'       => esc_html__( 'Link Hover Color', 'portum' ),
				'description' => esc_html__( 'The color used for hovered links.', 'portum' ),
				'default'     => '#a1083a',
				'section'     => 'colors',
				'hover-state' => false,
			),

			'epsilon_link_active_color' => array(
				'label'       => esc_html__( 'Link Active Color', 'portum' ),
				'description' => esc_html__( 'The color used for active links.', 'portum' ),
				'default'     => '#333333',
				'section'     => 'colors',
				'hover-state' => false,
			),

			'epsilon_menu_separator' => array(
				'label'     => esc_html__( 'Navigation Colors', 'portum' ),
				'section'   => 'colors',
				'separator' => true,
			),

			'epsilon_header_background' => array(
				'label'       => esc_html__( 'Header background color', 'portum' ),
				'description' => esc_html__( 'The color used for the header background.', 'portum' ),
				'default'     => '#151C1F',
				'section'     => 'colors',
				'hover-state' => false,
			),

			'epsilon_header_background_sticky' => array(
				'label'       => esc_html__( 'Header Sticky bg. Color', 'portum' ),
				'description' => esc_html__( 'The color used for the header background when it\'s fixes to the top of the browsing window.', 'portum' ),
				'default'     => '#FFFFFF',
				'section'     => 'colors',
				'hover-state' => false,
			),

			'epsilon_header_background_border_bot' => array(
				'label'       => esc_html__( 'Header Border Bottom Color', 'portum' ),
				'description' => esc_html__( 'The color used for the header border bottom', 'portum' ),
				'default'     => 'rgba(255,255,255,.1)',
				'section'     => 'colors',
				'hover-state' => false,
			),

			'epsilon_dropdown_menu_background' => array(
				'label'       => esc_html__( 'Dropdown background', 'portum' ),
				'description' => esc_html__( 'The color used for the menu background.', 'portum' ),
				'default'     => '#A1083A',
				'section'     => 'colors',
				'hover-state' => false,
			),

			'epsilon_dropdown_menu_hover_background' => array(
				'label'       => esc_html__( 'Dropdown Hover background', 'portum' ),
				'description' => esc_html__( 'The color used for the menu hover background.', 'portum' ),
				'default'     => '#940534',
				'section'     => 'colors',
				'hover-state' => false,
			),

			'epsilon_menu_item_color' => array(
				'label'       => esc_html__( 'Menu item color', 'portum' ),
				'description' => esc_html__( 'The color used for the menu item color.', 'portum' ),
				'default'     => '#ebebeb',
				'section'     => 'colors',
				'hover-state' => false,
			),

			'epsilon_menu_item_hover_color' => array(
				'label'       => esc_html__( 'Menu item hover color', 'portum' ),
				'description' => esc_html__( 'The color used for the menu item hover color.', 'portum' ),
				'default'     => '#ffffff',
				'section'     => 'colors',
				'hover-state' => false,
			),

			'epsilon_menu_item_active_color' => array(
				'label'       => esc_html__( 'Menu item active color', 'portum' ),
				'description' => esc_html__( 'The color used for the menu item active color.', 'portum' ),
				'default'     => '#0385D0',
				'section'     => 'colors',
				'hover-state' => false,
			),

			'epsilon_footer_separator' => array(
				'label'     => esc_html__( 'Footer Colors', 'portum' ),
				'section'   => 'colors',
				'separator' => true,
			),

			'epsilon_footer_contact_background' => array(
				'label'       => esc_html__( 'Contact Background Color', 'portum' ),
				'description' => esc_html__( 'The color used for the footer contact background.', 'portum' ),
				'default'     => '#0377bb',
				'section'     => 'colors',
				'hover-state' => false,
			),


			'epsilon_footer_background' => array(
				'label'       => esc_html__( 'Footer Bg. Color', 'portum' ),
				'description' => esc_html__( 'The color used for the footer background.', 'portum' ),
				'default'     => '#192229',
				'section'     => 'colors',
				'hover-state' => false,
			),

			'epsilon_footer_sub_background' => array(
				'label'       => esc_html__( 'Footer Sub Bg. Color', 'portum' ),
				'description' => esc_html__( 'The color used for the footer sub background.', 'portum' ),
				'default'     => '#192229',
				'section'     => 'colors',
				'hover-state' => false,
			),

			'epsilon_footer_title_color' => array(
				'label'       => esc_html__( 'Title Color', 'portum' ),
				'description' => esc_html__( 'The color used for the footer title color.', 'portum' ),
				'default'     => '#ffffff',
				'section'     => 'colors',
				'hover-state' => false,
			),

			'epsilon_footer_text_color' => array(
				'label'       => esc_html__( 'Text Color', 'portum' ),
				'description' => esc_html__( 'The color used for the footer text color.', 'portum' ),
				'default'     => '#a9afb1',
				'section'     => 'colors',
				'hover-state' => false,
			),

			'epsilon_footer_link_color' => array(
				'label'       => esc_html__( 'Link Color', 'portum' ),
				'description' => esc_html__( 'The color used for the footer text color.', 'portum' ),
				'default'     => '#a9afb1',
				'section'     => 'colors',
				'hover-state' => false,
			),

			'epsilon_footer_link_hover_color' => array(
				'label'       => esc_html__( 'Link Hover Color', 'portum' ),
				'description' => esc_html__( 'The color used for the footer text color.', 'portum' ),
				'default'     => '#ffffff',
				'section'     => 'colors',
				'hover-state' => false,
			),

			'epsilon_footer_link_active_color' => array(
				'label'       => esc_html__( 'Link Active Color', 'portum' ),
				'description' => esc_html__( 'The color used for the footer text color.', 'portum' ),
				'default'     => '#a9afb1',
				'section'     => 'colors',
				'hover-state' => false,
			),
		);
	}

	/**
	 * Load color scheme controls
	 */
	private function start_color_schemes() {
		$handler = 'portum-style-overrides';

		$args = array(
			'fields' => $this->get_color_scheme(),
			'css'    => Epsilon_Color_Scheme::load_css_overrides( get_template_directory() . '/assets/css/style-overrides.css' ),
		);

		Epsilon_Color_Scheme::get_instance( $handler, $args );
	}

	/**
	 * Loads the typography controls required scripts
	 */
	public function start_typography_controls() {
		/**
		 * Instantiate the Epsilon Typography object
		 */
		$options = array(
			'portum_typography_global',
			'portum_typography_headings',
			'portum_typography_navigation',
			'portum_typography_headline_title',
			'portum_typography_headline_subtitle',
		);

		$handler = 'portum-main';
		Epsilon_Typography::get_instance( $options, $handler );
	}

	/**
	 * Initiate the welcome screen
	 */
	public function init_dashboard() {
		Epsilon_Dashboard::get_instance( array(
			'theme'    => array(
				'download-id' => '212499',
			),
		) );

		$dashboard = Portum_Dashboard_Setup::get_instance();
		$dashboard->add_admin_notice();

		$upsells = get_option( $this->theme['theme-slug'] . '_theme_upsells', false );
		if ( $upsells ) {
			add_filter( 'epsilon_upsell_control_display', '__return_false' );
		}

		$quickie_bar = get_option( $this->theme['theme-slug'] . '_quickie_enabled', false );
		if ( $quickie_bar ) {
			add_filter( 'show_epsilon_quickie_bar', '__return_false' );
		}
	}

	/**
	 * Separate setup from init
	 *
	 * @param array $setup
	 *
	 * @return array
	 */
	public function epsilon_dashboard( $setup = array() ) {
		$dashboard = new Portum_Dashboard_Setup();

		$setup['actions'] = $dashboard->get_actions();
		$setup['tabs']    = $dashboard->get_tabs( $setup );
		$setup['plugins'] = $dashboard->get_plugins();

		$setup['edd'] = $dashboard->get_edd( $setup );

		$tab = get_user_meta( get_current_user_id(), 'epsilon_active_tab', true );

		$setup['activeTab'] = ! empty( $tab ) ? absint( $tab ) : 0;

		return $setup;
	}

	/**
	 * Add steps to onboarding
	 *
	 * @param array $setup
	 *
	 * @return array
	 */
	public function epsilon_onboarding( $setup = array() ) {
		$dashboard = new Portum_Dashboard_Setup();

		$setup['steps']   = $dashboard->get_steps();
		$setup['plugins'] = $dashboard->get_plugins( true );

		return $setup;
	}

	/**
	 * Register Scripts and Styles for the theme
	 */
	public function enqueues() {
		$theme = wp_get_theme();
		/**
		 * Register scripts
		 */
		wp_register_style( 'font-awesome', get_template_directory_uri() . '/assets/vendors/font-awesome/font-awesome.css' );
		wp_register_style( 'ion-icons', get_template_directory_uri() . '/assets/vendors/ionicons/ion.css' );
		wp_register_style( 'plyr', get_template_directory_uri() . '/assets/vendors/plyr/plyr.css' );
		wp_register_style( 'slick', get_template_directory_uri() . '/assets/vendors/slick/slick.css' );
		wp_register_style( 'magnificPopup', get_template_directory_uri() . '/assets/vendors/magnific-popup/magnific-popup.css' );
		wp_register_script( 'viewport', get_template_directory_uri() . '/assets/vendors/viewport/viewport.js', array( 'jquery' ), $theme['Version'], true );
		wp_register_script( 'plyr', get_template_directory_uri() . '/assets/vendors/plyr/plyr.js', array( 'jquery' ), $theme['Version'], true );
		wp_register_script( 'slick', get_template_directory_uri() . '/assets/vendors/slick/slick.js', array(), $theme['Version'], true );
		wp_register_script( 'odometer', get_template_directory_uri() . '/assets/vendors/odometer/odometer.min.js', array(), $theme['Version'], true );
		wp_register_script( 'easypiechart', get_template_directory_uri() . '/assets/vendors/easypiechart/jquery.easypiechart.min.js', array(), $theme['Version'], true );

		wp_register_script( 'magnificPopup', get_template_directory_uri() . '/assets/vendors/magnific-popup/jquery.magnific-popup.min.js', array(), $theme['Version'], true );
		wp_register_script( 'portum-object', get_template_directory_uri() . '/assets/js/portum.js', array( 'jquery' ), $theme['Version'], true );
		$string = '';
		$api    = get_theme_mod( 'portum_google_api_key', false );
		if ( ! empty( $api ) ) {
			$string = '?key=' . $api;
		}

		wp_register_script( 'googlemaps', '//maps.googleapis.com/maps/api/js' . $string, array(), $theme['Version'], true );

		/**
		 * Google fonts
		 */
		wp_enqueue_style( 'portum-google-fonts', '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,700i|Poppins:300,400,500,600,700|Hind:300,400,500,600', array(), $theme['Version'], 'all' );

		/**
		 * Load stylesheet
		 */
		wp_enqueue_style( 'portum', get_stylesheet_uri() );
		wp_enqueue_style( 'portum-main', get_template_directory_uri() . '/assets/css/style-portum.css', array(
			'font-awesome',
			'ion-icons',
			'portum',
		), $theme['Version'] );

		wp_enqueue_style( 'portum-style-overrides', get_template_directory_uri() . '/assets/css/overrides.css' );

		/**
		 * Load scripts
		 */
		wp_enqueue_script( 'portum-main', get_template_directory_uri() . '/assets/js/main.js', array(
			'jquery',
			'viewport',
			'plyr',
			'portum-object',
		), $theme['Version'], true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}

	/**
	 * Portum Theme Setup
	 */
	public function theme_setup() {
		/**
		 * Load theme text-domain
		 */
		load_theme_textdomain( 'portum', get_template_directory() . '/languages' );
		/**
		 * Load framework text-domain
		 */
		load_textdomain( 'epsilon-framework', '' );
		/**
		 * Load menus
		 */
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Navigation', 'portum' ),
			'footer'  => esc_html__( 'Footer Navigation', 'portum' ),
		) );

		/**
		 * Theme supports
		 */
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'custom-logo', array(
			'flex-width'  => true,
			'flex-height' => true,
		) );
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'quote',
			'link',
			'gallery',
			'video',
			'status',
			'audio',
			'chat',
		) );
		add_theme_support( 'custom-header', array(
			'width'              => 1920,
			'default-image'      => get_template_directory_uri() . '/assets/images/00_header_01.jpg',
			'height'             => 600,
			'flex-height'        => true,
			'flex-width'         => true,
			'default-text-color' => '#232323',
			'header-text'        => false,
			'uploads'            => true,
			'video'              => false,
		) );

		/**
		 * Image sizes
		 */
		add_image_size( 'portum-blog-section-image', 350, 350, true );
		add_image_size( 'portum-blog-post-image', 520, 345, true );
		add_image_size( 'portum-blog-post-sticky', 850, 460, true );
		add_image_size( 'portum-main-slider', 1600, 600, true );
		add_image_size( 'portum-portfolio-image', 400, 450, true );
		add_image_size( 'portum-team-image', 275, 275, true );
	}

	/**
	 * Content width
	 */
	public function content_width() {
		if ( ! isset( $GLOBALS['content_width'] ) ) {
			$GLOBALS['content_width'] = 600;
		}
	}
}
