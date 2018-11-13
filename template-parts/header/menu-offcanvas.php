<?php
/**
 * Template part for displaying the menu
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Portum
 */

?>
<div class="offcanvas">
	<div class="offcanvas__content">

		<div class="portum-menu-icon portum-menu-icon--open">
			<div class="portum-navicon"></div>
		</div>
		
		<?php
		wp_nav_menu( array(
			'menu'           => 'primary',
			'theme_location' => 'primary',
			'container'      => '',
			'menu_id'        => 'menu',
			'menu_class'     => 'portum-menu',	
		) );
		?>
	</div>
</div>
