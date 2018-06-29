<?php
/**
 * Template part for displaying the logo
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Portum
 */

?>
<div class="col-xs-8 col-sm-9 col-md-2">
	<!-- /// Logo ////////  -->
	<div id="logo">
		<?php
		if ( function_exists( 'the_custom_logo' ) ) {
			if ( has_custom_logo() ) {
				Epsilon_Helper::get_image_with_custom_dimensions( 'portum_logo_dimensions' );
			}else{
				$html = sprintf( '<a href="%1$s" class="custom-logo-link" rel="home" itemprop="url">%2$s</a>',
					esc_url( home_url( '/' ) ),
					get_bloginfo( 'name', 'display' )
				);

				echo $html;
			}
		}
		?>
	</div><!-- end #logo -->
</div><!-- end .col -->

