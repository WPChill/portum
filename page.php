<?php
/**
 * The template for displaying pages
 *
 * @package Portum
 */


get_header();

$img = get_custom_header();
$img = $img->url;
$layout = Portum_Helper::get_layout( 'portum_page_layout' );
?>
	<div id="content">
		<div class="custom-header">
			<div class="item-overlay"></div>
			<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail( 'portum-main-slider' );
			} else {
				?>
				<img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"/>
				<?php
			}
			?>
		</div>

		<div class="container">
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
							get_template_part( 'template-parts/content/content', 'page' );
						endwhile;
					else :
						get_template_part( 'template-parts/content/content', 'none' );
					endif;

					the_posts_pagination(
						array(
							'prev_text' => '<span class="fa fa-angle-left"></span><span class="screen-reader-text">' . esc_html__( 'Previous', 'portum' ) . '</span>',
							'next_text' => '<span class="fa fa-angle-right"></span><span class="screen-reader-text">' . esc_html__( 'Next', 'portum' ) . '</span>',
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
<?php

get_footer();
