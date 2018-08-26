<?php
/**
 * Template part for displaying the menu
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Portum
 */

?>

<nav>
	<?php
	$header_bg = get_theme_mod( 'portum_header_background', false );
	$class     = ! $header_bg ? 'portum-menu fixed' : 'portum-menu fixed header-background';

	wp_nav_menu( array(
		'menu'           => 'primary',
		'theme_location' => 'primary',
		'container'      => '',
		'menu_id'        => 'menu',
		'menu_class'     => $class,
	) );
	?>
	<!-- /// Mobile Menu Trigger //////// -->
	<button id="mobile-menu-trigger"><i class="fa fa-bars"></i></button><!-- end #mobile-menu-trigger -->
</nav>
