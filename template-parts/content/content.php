<?php
/**
 * Template part for displaying posts.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Portum
 */

$class = '';
if ( is_sticky() ) {
	$class = 'sticky';
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $class ); ?>>
	<div class="row">
		<div class="col-md-12">
			<?php if ( is_sticky() || has_post_thumbnail() ) { ?>
			<div class="post-thumbnail">
				<?php
				if ( has_post_thumbnail() ) {
					the_post_thumbnail( 'portum-blog-post-sticky' );
				} else {
					?>
					<a href="<?php echo esc_url( get_the_permalink() ); ?>">
						<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/picture_placeholder.jpg"/>
					</a>
					<?php
				}
				?>
				<?php } ?>
				<div class="post-header">
					<h4 class="post-title">
						<a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo esc_html( get_the_title() ); ?></a>
					</h4><!-- end .post-title -->
				</div><!-- .post-header -->
				<?php if ( is_sticky() ) { ?>
			</div>
		<?php } ?>

			<div class="post-content">
				<?php the_content( '', false ); ?>
			</div><!-- .post-content -->

			<div class="post-footer">
				<div class="post-meta">
					<a class="posted-on" href="#"><?php echo get_the_date(); ?></a>

					<?php Portum_Helper::posted_on( 'author' ); ?>
					<?php Portum_Helper::posted_on( 'comments' ); ?>

				</div><!-- .post-meta -->
			</div><!-- .post-footer -->
		</div>
	</div>
</article>
