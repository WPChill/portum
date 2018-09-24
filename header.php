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
$header_class  = '';
$header_layout = get_theme_mod( 'portum_header_layout', 'portum-classic' );
$header_class  = get_theme_mod( 'portum_header_over_content', false ) ? 'header--over-content ' : '';
$header_class  .= get_theme_mod( 'portum_header_shadow', true ) ? '' : 'header--no-shadow ';
$header_sticky = get_theme_mod( 'portum_header_sticky', true );
$header_width  = get_theme_mod( 'portum_header_width', false ) ? 'container-fluid' : 'container';

?>

<body <?php ( $header_sticky ) ? body_class( 'sticky-header' ) : ''; ?>>

<?php if ( 'portum-offcanvas' === $header_layout ) { ?>
	<div id="header" class="portum-offcanvas">
		<div class="<?php echo esc_attr( $header_width ); ?>">
			<div class="row">
				<div class="col-xs-12 col-md-3">
					<?php get_template_part( 'template-parts/misc/logo' ); ?>
				</div>

				<div class="col-xs-12 col-md-9 text-lg-right text-sm-center">
					<button class="portum-toggle-nav">
						<label class="portum-menu-icon" for="portum-menu-btn">
							<span class="portum-navicon"></span>
						</label>
					</button>
				</div>

				<div id="offcanvas">
					<?php get_template_part( 'template-parts/header/menu-offcanvas' ); ?>
				</div>
			</div>
		</div>
	</div>

<?php } elseif ( 'portum-sidebar' === $header_layout ) { ?>
	<div id="header" class="portum-sidebar">
		<?php get_template_part( 'template-parts/misc/logo' ); ?>
		<?php get_template_part( 'template-parts/header/menu-sidebar' ); ?>
	</div><!--#header-->
<?php } elseif ( 'portum-classic' === $header_layout ) { ?>

	<div id="header" class="portum-classic">
		<div class="<?php echo esc_attr( $header_width ); ?>">
			<div class="row">
				<div class="col-xs-12 col-md-3">
					<?php get_template_part( 'template-parts/misc/logo' ); ?>
				</div>

				<div class="col-xs-12 col-md-9">
					<?php get_template_part( 'template-parts/header/menu' ); ?>
				</div>
			</div><!-- end .row -->
		</div><!-- end .container -->
	</div>

<?php } ?>

<div id="wrap">

