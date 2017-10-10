<?php
/**
 * Template part for displaying posts.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Portum
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row">
		<div class="<?php echo has_post_thumbnail() && ! is_sticky() ? 'col-md-7' : '' ?> col-sm-12">

			<?php if ( is_sticky() ) { ?>
			<div class="post-thumbnail">
				<?php the_post_thumbnail( 'portum-blog-post-sticky' ); ?>
				<?php } ?>
				<div class="post-header">
					<h4 class="post-title">
						<a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo esc_html( get_the_title() ); ?></a>
						<?php if ( is_sticky() ) { ?>
						<a class="more-link" href="<?php echo esc_url( get_the_permalink() ); ?>"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
						<?php } ?>
					</h4><!-- end .post-title -->
				</div><!-- .post-header -->
				<?php if ( is_sticky() ) { ?>
			</div>
		<?php } ?>

			<div class="post-content">
				<?php the_content(); ?>
			</div><!-- .post-content -->

			<div class="post-footer">
				<div class="post-meta">
					<a class="posted-on" href="#"><?php echo get_the_date(); ?></a>

					<?php Portum_Helper::posted_on( 'author' ); ?>
					<?php Portum_Helper::posted_on( 'comments' ); ?>

				</div><!-- .post-meta -->
			</div><!-- .post-footer -->
		</div>
		<?php if ( has_post_thumbnail() && ! is_sticky() ) { ?>
			<div class="col-md-5 col-sm-12">
				<a href="#" class="post-thumbnail post-thumbnail-preloader">
					<?php the_post_thumbnail( 'portum-blog-post-image' ); ?>
					<div class="preloader">
						<div class="overlay"></div>
					</div>
				</a><!-- end .post-thumbnail -->
			</div><!-- end .col -->
		<?php } ?>
	</div>
</article>
