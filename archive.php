<?php
/**
 * The main index file
 *
 * @package Portum
 */

get_header();

$layout = Portum_Helper::get_layout( 'portum_blog_layout' );

?>

<div id="content">

	<?php get_template_part( 'template-parts/blog/title-area', 'archive' ); ?>

	<div class="container main-container">

		<div class="row">
			<?php if ( 'left-sidebar' === $layout['type'] && is_active_sidebar( 'sidebar' ) ) : ?>
				<div class="col-sm-<?php echo esc_attr( $layout['columns']['sidebar']['span'] ); ?>">
					<?php dynamic_sidebar( 'sidebar' ); ?>
				</div>
			<?php endif; ?>

			<div class="<?php echo esc_attr( $layout['columns']['content']['class'] ); ?>">

				<div class="row">
					<?php if ( have_posts() ) : ?>
						<?php while ( have_posts() ) : ?>
							<?php the_post(); ?>
							<div class="col-md-4">
								<?php get_template_part( 'template-parts/content/content', get_post_format() ); ?>
							</div>	
						<?php endwhile; ?>
					<?php endif; ?>
				</div>

				<div class="row">
					<div class="col-md-12">
						<?php
						the_posts_pagination(
							array(
								'prev_text' => '<span class="fa fa-angle-left"></span> ' . esc_html__( 'Previous', 'portum' ),
								'next_text' => esc_html__( 'Next', 'portum' ) . ' <span class="fa fa-angle-right"></span>',
							)
						);
						?>
					</div>
				</div>

			</div>

			<?php if ( 'right-sidebar' === $layout['type'] && is_active_sidebar( 'sidebar' ) ) : ?>
				<div class="col-sm-<?php echo esc_attr( $layout['columns']['sidebar']['span'] ); ?>">
					<?php dynamic_sidebar( 'sidebar' ); ?>
				</div>
			<?php endif; ?>

		</div>
	</div>
</div>
<?php get_footer(); ?>
