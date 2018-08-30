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
	<input class="portum-menu-btn" type="checkbox" id="portum-menu-btn" />
	<label class="portum-menu-icon" for="portum-menu-btn">
		<span class="portum-navicon"></span>
	</label>
	<?php
	wp_nav_menu( array(
		'menu'           => 'primary',
		'theme_location' => 'primary',
		'container'      => '',
		'menu_id'        => 'menu',
	) );
	?>
</nav>
