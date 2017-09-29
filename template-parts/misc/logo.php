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
				the_custom_logo();
			}
		}
		?>
	</div><!-- end #logo -->
</div><!-- end .col -->

