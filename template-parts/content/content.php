<?php
/**
 * Template part for displaying posts.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Portum
 */

$class = 'post--loop';
if ( is_sticky() ) {
	$class .= ' sticky';
}
?>

<div class="row">
	<div class="col-md-12">
		<article id="post-<?php the_ID(); ?>" <?php post_class( $class ); ?>>
	
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="post-thumbnail">
					<a href="<?php echo esc_url( get_the_permalink() ); ?>">
						<?php the_post_thumbnail( 'medium_large' ); ?>
					</a>
				</div>
			<?php endif; ?>

			<div class="post-content-wrap">

				<div class="post-header">
					<h5 class="post-title">
						<a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo esc_html( get_the_title() ); ?></a>
					</h5><!-- end .post-title -->
				</div><!-- .post-header -->

				<div class="post-content">
					<?php the_content( '', false ); ?>
				</div><!-- .post-content -->

				<div class="post-footer">
					<div class="post-meta">
						<?php Portum_Helper::posted_on( 'date' ); ?>
						<?php Portum_Helper::posted_on( 'author' ); ?>
						<?php Portum_Helper::posted_on( 'comments' ); ?>
					</div><!-- .post-meta -->
				</div><!-- .post-footer -->

			</div><!-- .post-content-wrap -->

		</article>
	</div>
</div>
