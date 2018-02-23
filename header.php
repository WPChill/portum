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
<body <?php body_class( 'sticky-header' ); ?>>
<div id="wrap">
	<?php get_template_part( 'template-parts/header/topbar' ); ?>
	<div id="header" <?php echo Portum::get_instance()->top_bar ? 'class="has-top-bar"' : ''; ?>>
		<!-- /// HEADER  //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
		<div class="container">
			<div class="row">
				<?php
				get_template_part( 'template-parts/misc/logo' );
				get_template_part( 'template-parts/header/menu' );
				?>
			</div><!-- end .row -->
		</div><!-- end .container -->
		<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
	</div>
