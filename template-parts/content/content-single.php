<?php
/**
 * Template part for displaying single posts.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Portum
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

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
			<?php Portum_Helper::posted_on( 'tags' ); ?>
		</div><!-- .post-meta -->
	</div><!-- .post-footer -->

</article>

<?php get_template_part( 'template-parts/misc/author-bio' ); ?>

<?php the_post_navigation(); ?>
