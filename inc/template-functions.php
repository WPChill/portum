<?php

function portum_classic_header(){
	$header_class  = 'portum-classic';
	$header_class  .= get_theme_mod( 'portum_header_over_content', false ) ? ' header--over-content' : '';
	$header_class  .= get_theme_mod( 'portum_header_shadow', true ) ? ' header--no-shadow' : '' ;
	?>
	<div id="header" class="<?php echo esc_attr( $header_class ) ?>">
		<div class="container">
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
<?php

}
