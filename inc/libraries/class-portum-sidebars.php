<?php
/**
 * Portum Theme Sidebars
 *
 * @package Portum
 * @since   1.0
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Class Portum_Sidebars
 */
class Portum_Sidebars {

	/**
	 * Holds the
	 *
	 * @var array
	 */
	public $sidebars = array();

	/**
	 * Portum_Sidebars constructor.
	 */
	public function __construct() {
		$this->collect_sidebars();
		add_action( 'widgets_init', array( $this, 'set_sidebars' ) );
		add_action( 'widgets_init', array( $this, 'initiate_widgets' ) );
	}

	/**
	 * Registers sidebars
	 */
	public function set_sidebars() {
		foreach ( $this->sidebars as $sidebar ) {
			register_sidebar( $sidebar );
		}
	}

	/**
	 * Add sidebars here
	 */
	private function collect_sidebars() {
		$this->sidebars = array(
			array(
				'id'            => 'sidebar',
				'name'          => __( '[Blog] Sidebar #1', 'portum' ),
				'before_title'  => '<h5 class="widget-title">',
				'after_title'   => '</h5>',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
			),
			array(
				'id'            => 'header-sidebar-1',
				'name'          => __( '[Header] Sidebar #1', 'portum' ),
				'before_title'  => '<h5 class="widget-title">',
				'after_title'   => '</h5>',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
			),

			array(
				'id'            => 'header-sidebar-2',
				'name'          => __( '[Header] Sidebar #2', 'portum' ),
				'before_title'  => '<h5 class="widget-title">',
				'after_title'   => '</h5>',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
			),

			array(
				'id'            => 'header-sidebar-3',
				'name'          => __( '[Header] Sidebar #3', 'portum' ),
				'before_title'  => '<h5 class="widget-title">',
				'after_title'   => '</h5>',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
			),
			array(
				'id'            => 'header-sidebar-4',
				'name'          => __( '[Header] Sidebar #4', 'portum' ),
				'before_title'  => '<h5 class="widget-title">',
				'after_title'   => '</h5>',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
			),
			array(
				'id'            => 'footer-sidebar-1',
				'name'          => __( '[Footer] Sidebar #1', 'portum' ),
				'before_title'  => '<h5 class="widget-title">',
				'after_title'   => '</h5>',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
			),

			array(
				'id'            => 'footer-sidebar-2',
				'name'          => __( '[Footer] Sidebar #2', 'portum' ),
				'before_title'  => '<h5 class="widget-title">',
				'after_title'   => '</h5>',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
			),

			array(
				'id'            => 'footer-sidebar-3',
				'name'          => __( '[Footer] Sidebar #3', 'portum' ),
				'before_title'  => '<h5 class="widget-title">',
				'after_title'   => '</h5>',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
			),
			array(
				'id'            => 'footer-sidebar-4',
				'name'          => __( '[Footer] Sidebar #4', 'portum' ),
				'before_title'  => '<h5 class="widget-title">',
				'after_title'   => '</h5>',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
			),
			array(
				'id'            => 'footer-sidebar-5',
				'name'          => __( '[Footer] Sidebar #5', 'portum' ),
				'before_title'  => '<h5 class="widget-title">',
				'after_title'   => '</h5>',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
			),
			array(
				'id'            => 'footer-sidebar-6',
				'name'          => __( '[Footer] Sidebar #6', 'portum' ),
				'before_title'  => '<h5 class="widget-title">',
				'after_title'   => '</h5>',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
			),
		);
	}

	/**
	 * Initiate widgets
	 */
	public function initiate_widgets() {
		$widgets = array();

		foreach ( $widgets as $widget ) {
			new $widget();
			register_widget( $widget );
		}
	}
}
