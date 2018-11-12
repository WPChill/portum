<?php
/**
 * Template part for displaying the menu
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Portum
 */

?>

<?php
wp_nav_menu( array(
	'menu'           => 'primary',
	'theme_location' => 'primary',
	'container'      => '',
	'menu_id'        => 'menu',
	'menu_class'     => 'portum-menu',
) );
?>