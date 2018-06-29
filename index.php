<?php
/**
 * The main index file
 *
 * @package Portum
 */

get_header();

/**
 * Custom Image handling
 */
$img = get_custom_header();
$img = $img->url;

$layout       = Portum_Helper::get_layout();
$show_welcome = get_theme_mod( 'portum_show_blog_welcome', false );

?>
<div id="content">
	<div class="custom-header">
		<img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"/>
	</div>


	<div class="container">

		<?php

		if ( $show_welcome ) {
			get_template_part( 'template-parts/blog/welcome' );
		}

		?>

		<div class="row">
			<?php
			if ( 'left-sidebar' === $layout['type'] && is_active_sidebar( 'sidebar' ) ) {
				?>
				<div class="col-sm-<?php echo esc_attr( $layout['columns']['content']['span'] ); ?>">
					<!-- /// SIDEBAR CONTENT  /////////////////////////////////////////////////////////////////////////////////// -->
					<?php dynamic_sidebar( 'sidebar' ); ?>
					<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////// -->
				</div>
				<?php
			}
			?>

			<div class="<?php echo ( 1 === $layout['columnsCount'] && ! is_active_sidebar( 'sidebar' ) ) ? 'col-sm-12' : 'col-sm-' . esc_attr( $layout['columns']['content']['span'] ); ?>">
				<!-- /// MAIN CONTENT  ////////////////////////////////////////////////////////////////////////////////////// -->
				<?php
				if ( have_posts() ) :
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content/content', get_post_format() );
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
				<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////// -->
			</div>

			<?php
			if ( 'right-sidebar' === $layout['type'] && is_active_sidebar( 'sidebar' ) ) {
				?>
				<div class="col-sm-<?php echo esc_attr( $layout['columns']['sidebar']['span'] ); ?>">
					<!-- /// SIDEBAR CONTENT  /////////////////////////////////////////////////////////////////////////////////// -->
					<?php dynamic_sidebar( 'sidebar' ); ?>
					<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////// -->
				</div>
				<?php
			}
			?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
