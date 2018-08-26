<?php
/**
 * File that renders the theme Header
 *
 * @package Portum
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<?php
$header_class  = get_theme_mod( 'portum_header_over_content', false ) ? 'header--over-content ' : '';
$header_class  .= get_theme_mod( 'portum_header_shadow', true ) ? '' : 'header--no-shadow ';
$header_class  .= get_theme_mod( 'portum_header_layout', 'portum-classic' );
$header_sticky = get_theme_mod( 'portum_header_sticky', true );

$header_width = ( get_theme_mod( 'portum_header_width', false ) ? 'container-fluid' : 'container' );

if ( 'portum-sidebar' === get_theme_mod( 'portum_header_layout' ) ) {
	$header_width = 'container-fluid';
}

$logo_container_size = 'col-xs-12 col-md-3';
$menu_container_size = 'col-xs-12 col-md-9';
if ( 'portum-sidebar' === get_theme_mod( 'portum_header_layout' ) ) {
	$logo_container_size = $menu_container_size = 'col-xs-12 text-center';
}

//@todo: rewrite this as it's not ideal

?>

<body <?php ( $header_sticky ) === true ? body_class( 'sticky-header' ) : ''; ?>>
<div id="header" class="<?php echo esc_attr( $header_class ); ?>">
	<div class="<?php echo esc_attr( $header_width ); ?>">
		<div class="row">

			<div class="<?php echo esc_attr( $logo_container_size ); ?>">
				<?php get_template_part( 'template-parts/misc/logo' ); ?>
			</div>
			<div class="<?php echo esc_attr( $menu_container_size ); ?>">
				<?php get_template_part( 'template-parts/header/menu' ); ?>
			</div>
		</div><!-- end .row -->
	</div><!-- end .container -->
</div>
<div id="wrap">

