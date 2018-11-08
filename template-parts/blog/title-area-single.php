<?php
$title_area_class = '';
$title_area_style = '';

if ( has_post_thumbnail() ) :
	$title_area_class = 'title-area--has-bg';
	$title_area_style = 'style="background-image:url(' . esc_url( get_the_post_thumbnail_url() ) . ');"';
elseif ( has_header_image() ) :
	$custom_header    = get_custom_header();
	$title_area_class = 'title-area--has-bg';
	$title_area_style = 'style="background-image:url(' . esc_url( $custom_header->url ) . ');"';
endif;
?>

<?php while ( have_posts() ) : ?>
	<?php the_post(); ?>

	<div class="title-area <?php echo esc_attr( $title_area_class ); ?>" <?php echo $title_area_style; ?>>
		<div class="title-area__overlay"></div>

		<div class="title-area__content container">

			<div class="row">
				<div class="col-md-8 col-md-offset-2">

					<?php if ( get_theme_mod( 'portum_show_single_post_categories', true ) ) : ?>
						<div class="page-cat-links">
							<?php echo wp_kses_post( get_the_category_list( ' ' ) ); ?>
						</div>
					<?php endif; ?>

					<h1 class="page-title">
						<?php echo esc_html( get_the_title() ); ?>
					</h1><!-- end .page-title -->

					<?php if ( get_theme_mod( 'portum_show_single_post_excerpt', true ) && has_excerpt() ) : ?>
						<div class="page-excerpt">
							<?php echo wp_kses_post( get_the_excerpt() ); ?>
						</div>
					<?php endif; ?>

					<div class="page-meta">

						<?php if ( get_theme_mod( 'portum_show_single_post_author', true ) ) : ?>
							<span class="page-meta__author">
								<?php echo get_avatar( get_the_author_meta( 'ID' ), 80 ); ?>
								<a class="post-author" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo get_the_author(); ?></a>
							</span>
						<?php endif; ?>

						<?php if ( get_theme_mod( 'portum_show_single_post_date', true ) ) : ?>
							<span class="page-meta__date">
								<a class="posted-on" href="#"><?php echo get_the_date(); ?></a>
							</span>
						<?php endif; ?>

						<?php if ( get_theme_mod( 'portum_show_single_post_comments', true ) ) : ?>
							<span class="page-meta__comments">
								<a title="<?php echo esc_attr__( 'Comment on Post', 'portum' ); ?>" href="<?php echo esc_url( get_the_permalink( get_the_ID() ) ); ?>#comments">
									<?php esc_html( comments_number( __( 'no comments', 'portum' ), __( 'one comment', 'portum' ), __( '% comments', 'portum' ) ) ); ?>
								</a>
							</span>
						<?php endif; ?>

					</div><!-- end .page-meta -->

				</div>
			</div>
		</div><!-- end .title-area__content -->
	</div><!-- end .title-area -->

<?php endwhile; ?>
