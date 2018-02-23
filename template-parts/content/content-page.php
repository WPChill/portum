<?php
/**
 * Template part for displaying single pages.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Portum
 */

if ( isset( $section_id ) ) {
	$frontpage = Epsilon_Page_Generator::get_instance( 'portum_frontpage_sections_' . get_the_ID(), get_the_ID() );
	$fields    = $frontpage->sections[ $section_id ];
}

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row">
		<div class="col-sm-12">
			<div class="post-header">
				<h4 class="post-title">
					<?php echo esc_html( get_the_title() ); ?>
				</h4><!-- end .post-title -->
			</div><!-- .post-header -->

			<div class="post-content">
				<?php
				the_content();
				wp_link_pages(
					array(
						'before'           => '<nav class="nav-links">',
						'after'            => '</nav>',
						'separator'        => '<span class="sep"></span>',
						'next_or_number'   => 'next',
						'nextpagelink'     => __( 'Next page', 'portum' ),
						'previouspagelink' => __( 'Previous page', 'portum' ),
					)
				);
				?>

			</div><!-- .post-content -->

			<div class="post-footer">
				<div class="post-meta">
					<?php if ( isset( $section_id ) ) { ?>

						<?php if ( $fields['content_page_date'] ) { ?>
							<a class="posted-on" href="#"><?php echo get_the_date(); ?></a>
						<?php } ?>

						<?php
						if ( $fields['content_page_author'] ) {
							Portum_Helper::posted_on( 'author' );
						}
						if ( $fields['content_page_comments'] ) {
							Portum_Helper::posted_on( 'comments' );
						}
						if ( $fields['content_page_categories'] ) {
							Portum_Helper::posted_on( 'category' );
						}
						if ( get_theme_mod( 'portum_show_single_post_tags', true ) ) {
							Portum_Helper::posted_on( 'tags' );
						}
						?>

					<?php } else { ?>
						<a class="posted-on" href="#"><?php echo get_the_date(); ?></a>

						<?php
						Portum_Helper::posted_on( 'author' );
						Portum_Helper::posted_on( 'comments' );
						Portum_Helper::posted_on( 'category' );
						if ( get_theme_mod( 'portum_show_single_post_tags', true ) ) {
							Portum_Helper::posted_on( 'tags' );
						}
						?>

					<?php } ?>
				</div><!-- .post-meta -->
			</div><!-- .post-footer -->
		</div>
	</div>
</article>

<?php the_post_navigation(); ?>
