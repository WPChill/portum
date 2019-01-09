<?php
/**
 * Portum Dashboard
 *
 * @package Portum
 * @since   1.0
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

class Portum_Dashboard_Setup {

	/**
	 * Theme array
	 *
	 * @var array
	 */
	public $theme = array();
	/**
	 * Notice layout
	 *
	 * @var string
	 */
	private $notice = '';

	/**
	 * Portum_Dashboard_Setup constructor.
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
	}

	/**
	 * @param array $theme
	 *
	 * @return Portum_Dashboard_Setup
	 */
	public static function get_instance( $theme = array() ) {
		static $inst;
		if ( ! $inst ) {
			$inst = new Portum_Dashboard_Setup( $theme );
		}

		return $inst;
	}

	/**
	 * Adds an admin notice in the backend
	 *
	 * If the Epsilon Notification class does not exist, we stop
	 */
	public function add_admin_notice() {
		if ( ! class_exists( 'Epsilon_Notifications' ) ) {
			return;
		}

		if ( ! empty( $_GET ) && isset( $_GET['page'] ) && 'epsilon-onboarding' === $_GET['page'] ) {
			return;
		}

		if ( ! is_super_admin() ) {
			return;
		}

		$used_onboarding = get_theme_mod( $this->theme['theme-slug'] . '_used_onboarding', false );
		if ( $used_onboarding ) {
			return;
		}

		$imported_demo = Portum_Notify_System::check_installed_data();
		if ( $imported_demo ) {
			return;
		}

		if ( empty( $this->notice ) ) {
			$this->notice .= '<img src="' . esc_url( get_template_directory_uri() ) . '/inc/libraries/epsilon-theme-dashboard/assets/images/machothemes-logo.png" class="epsilon-author-logo" />';


			/* Translators: Notice Title */
			$this->notice .= '<h1>' . sprintf( esc_html__( 'Welcome to %1$s', 'portum' ), $this->theme['theme-name'] ) . '</h1>';
			$this->notice .= '<p>';
			$this->notice .= sprintf( /* Translators: Notice */
				esc_html__( 'Welcome! Thank you for choosing %3$s! To fully take advantage of the best our theme can offer please make sure you visit our %1$swelcome page%2$s.', 'portum' ), '<a href="' . esc_url( admin_url( 'themes.php?page=' . $this->theme['theme-slug'] . '-dashboard' ) ) . '">', '</a>', $this->theme['theme-name'] );
			$this->notice .= '</p>';
			/* Translators: Notice URL */
			$this->notice .= '<p><a href="' . esc_url( admin_url( '?page=epsilon-onboarding' ) ) . '" class="button button-primary button-hero" style="text-decoration: none;"> ' . sprintf( esc_html__( 'Get started with %1$s', 'portum' ), $this->theme['theme-name'] ) . '</a></p>';
		}
		$notifications = Epsilon_Notifications::get_instance();
		$notifications->add_notice( array(
			'id'      => 'notification_testing',
			'type'    => 'notice epsilon-big epsilon-framework-notice--dark',
			'message' => $this->notice,
		) );
	}

	/**
	 * Edd params
	 *
	 * @return array
	 */
	public function get_edd( $setup = array() ) {
		$options = get_option( $setup['theme']['theme-slug'] . '_license_object', array() );
		$options = wp_parse_args( $options, array(
			'expires'       => false,
			'licenseStatus' => false,
		) );

		return array(
			'license'       => trim( get_option( $setup['theme']['theme-slug'] . '_license_key', false ) ),
			'licenseOption' => $setup['theme']['theme-slug'] . '_license_key',
			'downloadId'    => '221300',
			'expires'       => $options['expires'],
			'status'        => $options['licenseStatus'],
		);
	}

	/**
	 * Onboarding steps
	 *
	 * @return array
	 */
	public function get_steps() {
		return array(
			array(
				'id'       => 'landing',
				'title'    => __( 'Welcome to Portum', 'portum' ),
				'content'  => array(
					'paragraphs' => array(
						__( ' This wizard will set up your theme, install plugins and import demo content. It is optional & should take less than a minute.', 'portum' ),
					),
				),
				'progress' => __( 'Getting Started', 'portum' ),
				'buttons'  => array(
					'next' => array(
						'action' => 'next',
						'label'  => __( 'Let\'s get started <span class="dashicons dashicons-arrow-right-alt2"></span>', 'portum' ),
					),
				),
			),
			array(
				'id'       => 'plugins',
				'title'    => __( 'Install Recommended Plugins', 'portum' ),
				'content'  => array(
					'paragraphs' => array(
						__( 'Portum integrates tightly with a few plugins that we recommend installing to get the full theme experience, as we\'ve intended it to be. This is an optional step, but we recommend installing them as we think these hand-picked plugins work really nice with Portum and help enhance the overall experience.', 'portum' ),
					),
				),
				'progress' => __( 'Plugins', 'portum' ),
				'buttons'  => array(
					'next' => array(
						'action' => 'next',
						'label'  => __( 'Next <span class="dashicons dashicons-arrow-right-alt2"></span>', 'portum' ),
					),
				),
			),
			array(
				'id'       => 'demos',
				'title'    => __( 'Import Demo Content', 'portum' ),
				'content'  => array(
					'paragraphs' => array(
						wp_kses_post( __( 'We\'ve made it easy for you to get up and running in a jiffy. Just pick any of the theme demos below, click on Select, Import and you\'ll be ready in no time. Feel free to skip this step if you\'d like to create the content yourself.', 'portum' ) ),
						wp_kses_post( __( '<em>Note: This is the easiest way to see what goes where. After you\'ve finished the import, you can edit the content using the built-in Customizer, available under Appearance -> Customize.</em>', 'portum' ) ),
					),
				),
				'progress' => __( 'Demos', 'portum' ),
				'demos'    => get_template_directory() . '/inc/customizer/demo/demo.json',
				'buttons'  => array(
					'next' => array(
						'action' => 'next',
						'label'  => __( 'Next <span class="dashicons dashicons-arrow-right-alt2"></span>', 'portum' ),
					),
				),
			),
			array(
				'id'       => 'enjoy',
				'title'    => __( 'Almost ready', 'portum' ),
				'content'  => array(
					'paragraphs' => array(
						__( 'Your new theme has been all set up. Enjoy your new theme by <a href="https://machothemes.com">Macho Themes</a>.', 'portum' ),
					),
				),
				'progress' => __( 'Finished', 'portum' ),
				'buttons'  => array(
					'next' => array(
						'action' => 'customizer',
						'label'  => __( 'Finish', 'portum' ),
					),
				),
			),
		);
	}

	/**
	 * @param bool $integrated
	 *
	 * @return array
	 */
	public function get_plugins( $integrated = false ) {
		$arr = array(
			'contact-form-7'          => array(
				'integration' => true,
				'recommended' => false,
			),

			'modula-best-grid-gallery' => array(
				'integration' => false,
				'recommended' => true,
			),
			'simple-author-box'        => array(
				'integration' => false,
				'recommended' => true,
			),
			'optimole-wp'              => array(
				'integration' => false,
				'recommended' => true,
			),
		);

		if ( ! $integrated ) {
			unset( $arr['contact-form-7'] );
		}

		return $arr;
	}

	/**
	 * Dashboard actions
	 */
	public function get_actions() {
		if ( is_customize_preview() ) {
			return $this->_customizer_actions();
		}

		return array(
			array(
				'id'          => 'portum-import-data',
				'title'       => esc_html__( 'Add sample content', 'portum' ),
				'description' => esc_html__( 'Clicking the button below will add content/sections/settings and recommended plugins to your WordPress installation. Click advanced to customize the import process in the dedicated tab.', 'portum' ),
				'check'       => Portum_Notify_System::check_installed_data(),
				'state'       => false,
				'actions'     => array(
					array(
						'label'   => esc_html__( 'Advanced', 'portum' ),
						'type'    => 'change-page',
						'handler' => 'epsilon-demo',
					),
				),
			),
			array(
				'id'          => 'portum-check-cf7',
				'title'       => Portum_Notify_System::plugin_verifier( 'contact-form-7', 'title', 'Contact Form 7', 'verify_cf7' ),
				'description' => Portum_Notify_System::plugin_verifier( 'contact-form-7', 'description', 'Contact Form 7', 'verify_cf7' ),
				'plugin_slug' => 'contact-form-7',
				'state'       => false,
				'check'       => defined( 'WPCF7_VERSION' ),
				'actions'     => array(
					array(
						'label'   => Portum_Notify_System::plugin_verifier( 'contact-form-7', 'installed', 'Contact Form 7', 'verify_cf7' ) ? __( 'Activate Plugin', 'portum' ) : __( 'Install Plugin', 'portum' ),
						'type'    => 'handle-plugin',
						'handler' => Portum_Notify_System::plugin_verifier( 'contact-form-7', 'installed', 'Contact Form 7', 'verify_cf7' ),
					),
				),
			),
		);
	}

	/**
	 * Render customizer actions
	 */
	private function _customizer_actions() {
		return array(
			array(
				'id'          => 'portum-import-data',
				'title'       => esc_html__( 'Add sample content', 'portum' ),
				'description' => esc_html__( 'Clicking the button below will add content/sections/settings and recommended plugins to your WordPress installation. Click advanced to customize the import process in the dedicated tab.', 'portum' ),
				'check'       => Portum_Notify_System::check_installed_data(),
				'help'        => '<a class="button button-primary" id="" href="' . esc_url( admin_url( sprintf( 'themes.php?page=%1$s-dashboard', 'portum' ) ) ) . '">' . __( 'Import Demo Content', 'portum' ) . '</a>',
			),
			array(
				'id'          => 'portum-check-cf7',
				'title'       => Portum_Notify_System::plugin_verifier( 'contact-form-7', 'title', 'Contact Form 7', 'verify_cf7' ),
				'description' => Portum_Notify_System::plugin_verifier( 'contact-form-7', 'description', 'Contact Form 7', 'verify_cf7' ),
				'plugin_slug' => 'contact-form-7',
				'check'       => defined( 'WPCF7_VERSION' ),
			),
		);
	}

	/**
	 * Welcome Screen tabs
	 *
	 * @param $setup array
	 *
	 * @return array
	 */
	public function get_tabs( $setup = array() ) {
		$theme = wp_get_theme();

		return array(
			array(
				'id'      => 'epsilon-getting-started',
				'title'   => esc_html__( 'Getting Started', 'portum' ),
				'hidden'  => false,
				'type'    => 'info',
				'content' => array(
					array(
						'title'     => esc_html__( 'Recommended actions', 'portum' ),
						'paragraph' => esc_html__( 'We compiled a list of steps for you, to take make sure the experience you will have using one of our products is very easy to follow.', 'portum' ),
						'action'    => '<a href="' . esc_url( admin_url() . '?page=epsilon-onboarding' ) . '" class="button button-primary">' . __( 'Launch wizard', 'portum' ) . '</a>',
					),
					array(
						'title'     => esc_html__( 'Check our documentation', 'portum' ),
						'paragraph' => esc_html__( 'Even if you are a long-time WordPress user, we still believe you should give our documentation a very quick Read.', 'portum' ),
						'action'    => '<a target="_blank" href="http://docs.machothemes.com">' . __( 'Full documentation', 'portum' ) . '</a>',
					),
					array(
						'title'     => esc_html__( 'Customize everything', 'portum' ),
						'paragraph' => esc_html__( 'Using the WordPress Customizer you can easily customize every aspect of the theme.', 'portum' ),
						'action'    => '<a target="_blank" href="' . esc_url( admin_url() . 'customize.php' ) . '" class="button button-primary">' . esc_html__( 'Go to Customizer', 'portum' ) . '</a>',
					),

				),
			),
			array(
				'id'      => 'epsilon-demo',
				'title'   => esc_html__( 'Demo Content', 'portum' ),
				'type'    => 'demos',
				'hidden'  => false,
				'content' => array(
					'title'          => esc_html__( 'Install your demo content', 'portum' ),
					'titleAlternate' => esc_html__( 'Demo content already installed', 'portum' ),
					'paragraph'      => esc_html__( 'Since Portum is a versatile theme we provided a few sample demo styles for you, please choose one from the following pages so you will have to work as little as you should. Click on the style and press next!', 'portum' ),
					'check'          => Portum_Notify_System::check_installed_data(),
					'demos'          => get_template_directory() . '/inc/customizer/demo/demo.json',
				),
			),
			array(
				'id'      => 'epsilon-actions',
				'title'   => esc_html__( 'Actions', 'portum' ),
				'type'    => 'actions',
				'hidden'  => $this->theme['theme-slug'] . '_recommended_actions',
				'content' => $this->get_actions(),
			),
			array(
				'id'     => 'epsilon-plugins',
				'title'  => esc_html__( 'Recommended Plugins', 'portum' ),
				'hidden' => $this->theme['theme-slug'] . '_recommended_plugins',
				'type'   => 'plugins',
			)
		);
	}
}
