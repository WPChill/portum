<?php
/**
 * Template part for displaying the menu
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Portum
 */

?>
<div class="col-xs-4 col-sm-3 col-md-10">
	<nav>
		<?php
		$header_bg = get_theme_mod( 'portum_header_background', false );
		$class     = ! $header_bg ? 'sf-menu fixed' : 'sf-menu fixed header-background';

		wp_nav_menu(
			array(
				'menu'           => 'primary',
				'theme_location' => 'primary',
				'container'      => '',
				'menu_id'        => 'menu',
				'menu_class'     => $class,
				'fallback_cb'    => 'Portum_Navwalker::fallback',
				'walker'         => new Portum_Navwalker(),
			)
		);
		?>
		<!-- /// Mobile Menu Trigger //////// -->
		<a href="#" id="mobile-menu-trigger"> <i class="fa fa-bars"></i> </a><!-- end #mobile-menu-trigger -->
	</nav>
</div>
