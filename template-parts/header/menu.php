<?php
/**
 * Template part for displaying the menu
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Portum
 */

?>

<input class="portum-menu-btn" type="checkbox" id="portum-menu-btn" />
<div class="portum-menu-icon" for="portum-menu-btn">
	<div class="portum-navicon"></div>
</div>
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
