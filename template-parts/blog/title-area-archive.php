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
					<?php if ( is_category() ) : ?>
						<?php printf( esc_html__( 'Category Archives', 'portum' ), single_cat_title( '', false ) ); ?>
					<?php elseif ( is_author() ) : ?>
						<?php printf( esc_html__( 'Author Archives: %s', 'portum' ), get_the_author() ); ?>
					<?php elseif ( is_tag() ) : ?>
						<?php printf( esc_html__( 'Tag Archives', 'portum' ) ); ?>
					<?php else: ?>
						<?php echo esc_html__( 'Archives ', 'portum' ); ?>
					<?php endif; ?>  
				</h1><!-- end .page-title -->

				<div class="page-excerpt">
					<?php if ( is_category() ) : ?>
						<?php printf( esc_html__( 'Posts in %s category.', 'portum' ), single_cat_title( '', false ) ); ?>
					<?php elseif ( is_author() ) : ?>
						<?php echo esc_html( the_author_meta( 'description' ) ); ?>
					<?php elseif ( is_tag() ) : ?>
						<?php printf( esc_html__( 'Posts with %s tag.', 'portum' ), single_tag_title( '',false ) ); ?>
					<?php endif; ?>  
				</div>

			</div>
		</div>
	</div><!-- end .title-area__content -->
</div><!-- end .title-area -->

