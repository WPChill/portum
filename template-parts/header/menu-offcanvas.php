<?php
/**
 * Template part for displaying the menu
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Portum
 */

?>
<div id="portum-site-wrapper" class="portum-closed-nav text-center">
	<div id="portum-site-canvas">
		<div id="portum-site-menu">
			<nav>
				<?php
				wp_nav_menu( array(
					'menu'           => 'primary',
					'theme_location' => 'primary',
					'container'      => '',
					'menu_id'        => 'menu',

				) );
				?>
			</nav>
		</div><!--/#site-menu-->
	</div>
</div>
