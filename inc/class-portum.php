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
	 * Portum constructor.
	 *
	 * Theme specific actions and filters
	 */
	public function __construct() {
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
		$html .=
			vsprintf(
				// Translators: 1 is Theme Name, 2 is opening Anchor, 3 is closing.
				__( 'We\'ve been working hard on making %1$s the best one out there. We\'re interested in hearing your thoughts about %1$s and what we could do to make it even better. %2$sSend your feedback our way%3$s. <br/> <br/> <strong>Note: A 10%% discount coupon will be emailed to you after form submission. Please use a valid email address.</strong>', 'portum' ),
				array(
					'Portum',
					'<a target="_blank" href="https://bit.ly/portum-feedback">',
					'</a>',
				)
			);

		$notifications = Epsilon_Notifications::get_instance();
		$notifications->add_notice(
			array(
				'id'      => 'notification_feedback',
				'type'    => 'notice epsilon-big',
				'message' => $html,
			)
		);
	}

	/**
	 * Initiate the epsilon framework
	 */
	public function init_epsilon() {
		new Epsilon_Framework();

		$this->start_typography_controls();
	}

	/**
	 * Initiate the Hooks in Portum
	 */
	public function init_hooks() {
		new Portum_Hooks();
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
	 * Initiate the setting helper
	 */
	public function customize_register_init() {
		new Portum_Customizer();
	}

	/**
	 * Loads the typography controls required scripts
	 */
	public function start_typography_controls() {
		/**
		 * Instantiate the Epsilon Typography object
		 */
		$options = array(
			'portum_typography_headings',
			'portum_paragraphs_typography',
		);

		$handler = 'portum-main';
		Epsilon_Typography::get_instance( $options, $handler );
	}


	/**
	 * Initiate the welcome screen
	 */
	public function init_welcome_screen() {
		// Welcome screen.
		if ( is_admin() ) {
			$plugins = array(
				'kiwi-social-share'        => array(
					'recommended' => true,
				),
				'modula-best-grid-gallery' => array(
					'recommended' => true,
				),
			);

			$importer = Epsilon_Import_Data::get_instance();

			/**
			 *
			 * id - unique id; required
			 * title
			 * description
			 * check - check for plugins (if installed)
			 * plugin_slug - the plugin's slug (used for installing the plugin)
			 */
			$actions = array(
				array(
					'id'          => 'portum-import-data',
					'title'       => esc_html__( 'Add sample content', 'portum' ),
					'description' => esc_html__( 'Clicking the button below will add content/sections/settings and recommended plugins to your WordPress installation. Click advanced to customize the import process.', 'portum' ),
					'help'        => array( Epsilon_Import_Data::get_instance(), 'generate_import_data_container' ),
					'check'       => Portum_Notify_System::check_installed_data(),
				),
				array(
					'id'          => 'portum-check-cf7',
					'title'       => Portum_Notify_System::plugin_verifier( 'contact-form-7', 'title', 'Contact Form 7', 'verify_cf7' ),
					'description' => Portum_Notify_System::plugin_verifier( 'contact-form-7', 'description', 'Contact Form 7', 'verify_cf7' ),
					'plugin_slug' => 'contact-form-7',
					'check'       => defined( 'WPCF7_VERSION' ),
				),
			);

			if ( is_customize_preview() ) {
				$url                = 'themes.php?page=%1$s-welcome&tab=%2$s';
				$actions[0]['help'] = '<a class="button button-primary" id="" href="' . esc_url( admin_url( sprintf( $url, 'portum', 'recommended-actions' ) ) ) . '">' . __( 'Import Demo Content', 'portum' ) . '</a>';
			}

			Epsilon_Welcome_Screen::get_instance(
				$config = array(
					'theme-name' => 'Portum',
					'theme-slug' => 'portum',
					'actions'    => $actions,
					'plugins'    => $plugins,
				)
			);

			$config['sections_exclude'] = array( 'features' );

			Epsilon_Welcome_Screen::get_instance( $config );

		}// End if().
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
		wp_register_style( 'owl-carousel', get_template_directory_uri() . '/assets/vendors/owl.slider/owl.carousel.css' );
		wp_register_style( 'plyr', get_template_directory_uri() . '/assets/vendors/plyr/plyr.css' );
		wp_register_style( 'slick', get_template_directory_uri() . '/assets/vendors/slick/slick.css' );
		wp_register_style( 'magnificPopup', get_template_directory_uri() . '/assets/vendors/magnific-popup/magnific-popup.css' );
		wp_register_script( 'waypoints', get_template_directory_uri() . '/assets/vendors/waypoints/waypoints.js', array( 'jquery' ), $theme['Version'], true );
		wp_register_script( 'viewport', get_template_directory_uri() . '/assets/vendors/viewport/viewport.js', array( 'jquery' ), $theme['Version'], true );
		wp_register_script( 'superfish-hoverIntent', get_template_directory_uri() . '/assets/vendors/superfish/hoverIntent.min.js', array(), $theme['Version'], true );
		wp_register_script( 'superfish', get_template_directory_uri() . '/assets/vendors/superfish/superfish.min.js', array(), $theme['Version'], true );
		wp_register_script( 'plyr', get_template_directory_uri() . '/assets/vendors/plyr/plyr.js', array( 'jquery' ), $theme['Version'], true );
		wp_register_script( 'owl-carousel', get_template_directory_uri() . '/assets/vendors/owl.slider/owl.carousel.min.js', array( 'jquery' ), $theme['Version'], true );
		wp_register_script( 'slick', get_template_directory_uri() . '/assets/vendors/slick/slick.js', array(), $theme['Version'], true );
		wp_register_script( 'stickem', get_template_directory_uri() . '/assets/vendors/stickem/jquery.stickem.js', array(), $theme['Version'], true );
		wp_register_script( 'offscreen', get_template_directory_uri() . '/assets/vendors/offscreen/offscreen.min.js', array(), $theme['Version'], true );
		wp_register_script( 'magnificPopup', get_template_directory_uri() . '/assets/vendors/magnific-popup/jquery.magnific-popup.min.js', array(), $theme['Version'], true );
		wp_register_script( 'portum-object', get_template_directory_uri() . '/assets/js/portum.js', array(), $theme['Version'], true );
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
		wp_enqueue_style(
			'portum-main',
			get_template_directory_uri() . '/assets/css/style-portum.css',
			array(
				'font-awesome',
				'owl-carousel',
				'plyr',
				'slick',
				'magnificPopup',
				'portum',
			),
			$theme['Version']
		);

		wp_enqueue_style( 'portum-style-overrides', get_template_directory_uri() . '/assets/css/overrides.css' );

		/**
		 * Load scripts
		 */
		wp_enqueue_script(
			'portum-main',
			get_template_directory_uri() . '/assets/js/main.js',
			array(
				'jquery',
				'offscreen',
				'owl-carousel',
				'waypoints',
				'superfish-hoverIntent',
				'superfish',
				'stickem',
				'slick',
				'offscreen',
				'plyr',
				'viewport',
				'googlemaps',
				'magnificPopup',
				'portum-object',
			),
			$theme['Version'],
			true
		);

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
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary Navigation', 'portum' ),
				'footer'  => esc_html__( 'Footer Navigation', 'portum' ),
			)
		);

		/**
		 * Theme supports
		 */
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support(
			'custom-logo',
			array(
				'height'     => 35,
				'width'      => 130,
				'flex-width' => true,
			)
		);
		add_theme_support(
			'post-formats',
			array(
				'aside',
				'image',
				'quote',
				'link',
				'gallery',
				'video',
				'status',
				'audio',
				'chat',
			)
		);
		add_theme_support(
			'custom-header',
			array(
				'width'              => 1920,
				'default-image'      => get_template_directory_uri() . '/assets/images/blog-main-img-01.jpg',
				'height'             => 855,
				'flex-height'        => true,
				'flex-width'         => true,
				'default-text-color' => '#232323',
				'header-text'        => true,
				'uploads'            => true,
				'video'              => false,
			)
		);

		/**
		 * Image sizes
		 */
		add_image_size( 'portum-blog-section-image', 345, 240, true );
		add_image_size( 'portum-blog-post-image', 520, 345, true );
		add_image_size( 'portum-blog-post-sticky', 850, 460, true );
		add_image_size( 'portum-main-slider', 1600, 600, true );
		add_image_size( 'portum-testimonial-portrait', 160, 160, true );
		add_image_size( 'portum-expertise-image', 650, 420, true );
		add_image_size( 'portum-about-image', 750, 460, true );
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
