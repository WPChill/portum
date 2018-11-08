<?php
/**
 * The template for displaying single pages
 *
 * @package Portum
 */

get_header();

$layout = Portum_Helper::get_layout( 'portum_blog_layout' );

?>
<div id="content">

	<?php get_template_part( 'template-parts/blog/title-area', 'single' ); ?>

	<div class="container main-container">

		<div class="row">

			<?php if ( 'left-sidebar' === $layout['type'] && is_active_sidebar( 'sidebar' ) ) : ?>
				<div class="col-sm-<?php echo esc_attr( $layout['columns']['sidebar']['span'] ); ?>">
					<?php dynamic_sidebar( 'sidebar' ); ?>
				</div>
			<?php endif; ?>
			 
			<div class="<?php echo esc_attr( $layout['columns']['content']['class'] ); ?>">
				<?php
				if ( have_posts() ) :
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content/content', 'single' );
					endwhile;
				else :
					get_template_part( 'template-parts/content/content', 'none' );
				endif;

				the_posts_pagination(
					array(
						'prev_text' => '<span class="fa fa-angle-left"></span> ' . esc_html__( 'Previous', 'portum' ),
						'next_text' => esc_html__( 'Next', 'portum' ) . ' <span class="fa fa-angle-right"></span>',
					)
				);
				?>
			</div>

			<?php if ( 'right-sidebar' === $layout['type'] && is_active_sidebar( 'sidebar' ) ) : ?>
				<div class="col-sm-<?php echo esc_attr( $layout['columns']['sidebar']['span'] ); ?>">
					<?php dynamic_sidebar( 'sidebar' ); ?>
				</div>
			<?php endif; ?>

		</div>
	</div>

	<?php if ( comments_open( get_the_ID() ) || get_comments_number( get_the_ID() ) ) : ?>
		<?php comments_template(); ?>
	<?php endif; ?>

</div>
<?php get_footer(); ?>
