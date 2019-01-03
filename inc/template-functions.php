<?php

function portum_header() {

	$header_layout = get_theme_mod( 'portum_header_layout', 'portum-classic' );
	$header_width  = get_theme_mod( 'portum_header_width', false ) ? 'container-fluid' : 'container';
	?>

	<?php if ( 'portum-classic' === $header_layout ) : ?>

		<?php
		$header_class  = 'portum-classic';
		$header_class .= get_theme_mod( 'portum_header_over_content', false ) ? ' header--over-content' : '';
		$header_class .= get_theme_mod( 'portum_header_shadow', true ) ? ' header--no-shadow' : '';
		$header_class .= get_theme_mod( 'portum_logo_sticky', true ) ? ' header--has-sticky-logo' : '';
		?>
		<div id="header" class="<?php echo esc_attr( $header_class ); ?>">
			<div class="<?php echo esc_attr( $header_width ); ?>">
				<div class="row">
					<div class="col-xs-12">
						<?php get_template_part( 'template-parts/misc/logo' ); ?>

						<?php get_template_part( 'template-parts/header/menu' ); ?>
					</div>
				</div><!-- end .row -->
			</div><!-- end .container -->
		</div><!-- #header -->

	<?php elseif ( 'portum-sidebar' === $header_layout ) : ?>

		<div id="header" class="portum-sidebar">
			<?php get_template_part( 'template-parts/misc/logo' ); ?>
			<?php get_template_part( 'template-parts/header/menu-sidebar' ); ?>
		</div><!-- #header -->

	<?php elseif ( 'portum-offcanvas' === $header_layout ) : ?>

		<?php
		$header_class  = 'portum-offcanvas';
		$header_class .= get_theme_mod( 'portum_header_over_content', false ) ? ' header--over-content' : '';
		$header_class .= get_theme_mod( 'portum_header_shadow', true ) ? ' header--no-shadow' : '';
		$header_class .= get_theme_mod( 'portum_logo_sticky', true ) ? ' header--has-sticky-logo' : '';
		?>

		<div id="header" class="<?php echo esc_attr( $header_class ); ?>">
			<div class="<?php echo esc_attr( $header_width ); ?>">
				<div class="row">
					<div class="col-xs-12">
						<?php get_template_part( 'template-parts/misc/logo' ); ?>

						<div class="portum-menu-icon">
							<div class="portum-navicon"></div>
						</div>
					</div>

					<?php get_template_part( 'template-parts/header/menu-offcanvas' ); ?>
				</div>
			</div>
		</div><!-- #header -->

	<?php endif; ?>
<?php

}
