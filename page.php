<?php
/**
 * The template for displaying pages
 *
 * @package Portum
 */

get_header();

$portum_fp = Epsilon_Page_Generator::get_instance( 'portum_frontpage_sections_' . get_the_ID(), get_the_ID() );

$img = get_custom_header();
$img = $img->url;

$layout = Portum_Helper::get_layout();

if ( ! empty( $portum_fp->sections ) ) :
	$portum_fp->generate_output();
else :
	?>
	<div id="content">
		<div class="custom-header">
			<img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"/>
		</div>


		<div class="container">
			<div class="row">
				<div class="col-md-1"></div>

				<div class="col-md-10">
					<div class="intro-item">

						<h4><?php echo esc_html( get_bloginfo( 'description' ) ); ?></h4>
						<span><?php echo esc_html__( 'Welcome', 'portum' ); ?></span>

					</div>

				</div>
				<div class="col-md-1"></div>
			</div>
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
endif;

get_footer();
