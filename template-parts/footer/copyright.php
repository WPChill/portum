<?php
/**
 * Template part for displaying the copyright footer
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Portum
 */

if ( get_theme_mod( 'portum_enable_copyright', true ) || has_nav_menu( 'copyright' ) ) : ?>
	<div id="footer-bottom" class="row footer-sub">
		<!-- /// FOOTER-BOTTOM  ////////////////////////////////////////////////////////////////////////////////////////////// -->
		<div class="container">
			<div class="row">
				<?php if ( get_theme_mod( 'portum_enable_copyright', true ) ) : ?>
					<div id="footer-bottom-widget-area-1" class="col-sm-6 ol-xs-12">
						<?php
						// Translators: %s is a link.
						echo sprintf( __( 'Theme by: <a href="%s">Macho Themes</a>. All rights reserved &copy %s.', 'portum'), 'https://www.machothemes.com/', date( 'Y' ) );
						?>
					</div><!-- end .col -->
				<?php endif; ?>

				<div id="footer-bottom-widget-area-2" class="col-sm-6 col-xs-12">
					<?php
					wp_nav_menu( array(
						'menu'           => 'footer',
						'theme_location' => 'footer',
						'container'      => 'ul',
						'menu_class'     => 'nav',
					) );
					?>
				</div><!-- end .col -->
			</div><!-- end .row -->
		</div><!-- end .container -->
		<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
	</div><!-- end #footer-bottom -->
<?php endif; ?>
