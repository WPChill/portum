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
					<?php if ( have_posts() ) : ?>
						<?php echo esc_html__( 'Search results: ', 'portum' ) . stripslashes( strip_tags( get_search_query() ) ); ?>
					<?php else : ?>
						<?php echo esc_html__( 'Sorry. Nothing Found.', 'portum' ); ?>
					<?php endif; ?>
				</h1><!-- end .page-title -->

				<?php if ( ! have_posts() ) : ?>
					<div class="page-excerpt">
						<?php echo esc_html__( 'Nothing matched your search terms. Please try again with some different keywords.', 'portum' ); ?>
					</div>
				<?php endif; ?>
	
			</div>
		</div>
	</div><!-- end .title-area__content -->
</div><!-- end .title-area -->
