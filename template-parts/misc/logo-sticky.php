<?php
/**
 * Template part for displaying the logo for the sticky header
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Portum
 */
?>

<?php

$logo_sticky_id = get_theme_mod( 'portum_logo_sticky' );
if ( ! $logo_sticky_id || ! get_theme_mod( 'portum_header_sticky', false ) ) {
	return;
}

$image = wp_get_attachment_image_src( $logo_sticky_id, 'full' );

$image_alt = get_post_meta( $logo_sticky_id, '_wp_attachment_image_alt', true );
if ( empty( $image_alt ) ) {
	$image_alt = get_bloginfo( 'name', 'display' );
}

$html = sprintf( '<a href="%1$s" class="custom-logo-link--sticky" rel="home" itemprop="url"><img class="custom-logo--sticky" src="%2$s" itemprop="logo" width="%3$s" height="%4$s" alt="%5$s" /></a>', esc_url( home_url( '/' ) ), $image[0], $image[1], $image[2], $image_alt );
echo $html;
