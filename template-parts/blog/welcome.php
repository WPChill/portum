<?php
/**
 * Template part for displaying blog welcome.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Portum
 */
?> 

<div class="row">
	<div class="col-md-1"></div>

	<div class="col-md-10">
		<div class="intro-item">

			<h4><?php echo esc_html( get_bloginfo( 'description' ) ); ?></h4>
			<span><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>

		</div>

	</div>
	<div class="col-md-1"></div>
</div>
