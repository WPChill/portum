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
$header_layout = get_theme_mod( 'portum_header_layout', 'portum-classic' );
$header_class  = '';

if ( 'portum-classic' === $header_layout ) {
	$header_class = get_theme_mod( 'portum_header_over_content', false ) ? 'header--over-content ' : '';

	$header_sticky = get_theme_mod( 'portum_header_sticky', true );
}

$header_width = ( get_theme_mod( 'portum_header_width', false ) ? 'container-fluid' : 'container' );
$header_class .= get_theme_mod( 'portum_header_shadow', true ) ? '' : 'header--no-shadow ';
if ( 'portum-offcanvas' !== $header_layout ) {
	$header_class .= $header_layout;
}
$logo_container_size = 'col-xs-12 col-md-3';
$menu_container_size = 'col-xs-12 col-md-9 text-right';

if ( 'portum-sidebar' === $header_layout ) {
	$logo_container_size = $menu_container_size = 'col-xs-12';
} elseif ( 'portum-offcanvas' === $header_layout ) {
	$logo_container_size = 'col-xs-12 col-md-9';
	$menu_container_size = 'col-xs-12 col-md-3';
}


?>

<body <?php ( true === ( $header_sticky ) && 'portum-sidebar' !== $header_layout ) ? body_class( 'sticky-header' ) : ''; ?>>

<?php if ( 'portum-offcanvas' === $header_layout ) { ?>
	<div id="offcanvas" class="portum-offcanvas">
		<?php get_template_part( 'template-parts/header/menu-offcanvas' ); ?>
	</div>
<?php } ?>

<div id="header" class="<?php echo esc_attr( $header_class ); ?>">
	<div class="<?php echo esc_attr( $header_width ); ?>">
		<div class="row">

			<div class="<?php echo esc_attr( $logo_container_size ); ?>">
				<?php get_template_part( 'template-parts/misc/logo' ); ?>
			</div>
			<div class="<?php echo esc_attr( $menu_container_size ); ?>">
				<?php
				if ( 'portum-sidebar' === $header_layout ) {
					get_template_part( 'template-parts/header/menu-sidebar' );
				} elseif ( 'portum-classic' === $header_layout ) {
					get_template_part( 'template-parts/header/menu' );
				} elseif ( 'portum-offcanvas' === $header_layout ) { ?>
					<button class="portum-toggle-nav">
						<i class="fa fa-bars"></i><?php echo esc_html__( 'Toggle nav', 'portum' ); ?>
					</button>
				<?php } ?>
			</div>
		</div><!-- end .row -->
	</div><!-- end .container -->
</div>
<div id="wrap">

