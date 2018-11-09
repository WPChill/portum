<?php
$title_area_class = '';
$title_area_style = '';

if ( has_header_image() ) :
	$custom_header    = get_custom_header();
	$title_area_class = 'title-area--has-bg';
	$title_area_style = 'style="background-image:url(' . esc_url( $custom_header->url ) . ');"';
endif;

?>

<div class="title-area <?php echo esc_attr( $title_area_class ); ?>" <?php echo $title_area_style; ?>>
	<div class="title-area__overlay"></div>

	<div class="title-area__content container">

		<div class="row">
			<div class="col-md-8 col-md-offset-2">

				<h1 class="page-title">
					<?php if ( 'posts' === get_option( 'show_on_front' ) ) : ?>
						<?php echo esc_html( 'Blog', 'portum' ); ?>
					<?php else : ?>
						<?php echo esc_html( single_post_title() ); ?>
					<?php endif; ?>	
				</h1><!-- end .page-title -->

			</div>
		</div>
	</div><!-- end .title-area__content -->
</div><!-- end .title-area -->
