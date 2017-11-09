<?php
/**
 * Template part for displaying a frontpage section
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Portum
 */

$img = get_custom_header();
$img = $img->url;

$layout = Portum_Helper::get_layout( 'portum_page_layout' );
?>

<div id="content">
	<!-- /// CONTENT  /////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
	<div id="page-header" <?php echo ( ! empty( $img ) ) ? 'style="background-image:url(' . esc_url( $img ) . '"' : ''; ?>>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h2><?php echo esc_html( get_the_title( absint( get_the_ID() ) ) ); ?></h2>
					<?php
					$display = get_bloginfo( 'description', 'display' );
					if ( ! empty( $display ) ) :
						?>
						<p>
							<span class="text-accent-color"><?php echo wp_kses_post( $display ); /* WPCS: xss ok. */ ?></span>
						</p>
						<?php
					endif;
					?>
				</div><!-- end .col -->
			</div><!-- end .row -->
		</div><!-- end .container -->
	</div><!-- end #page-header -->

	<div class="container">
		<div class="row">
			<?php
			if ( 'left-sidebar' === $layout['type'] && is_active_sidebar( 'sidebar' ) ) {
				?>
				<div class="col-sm-<?php echo esc_attr( $layout['columns']['sidebar']['span'] ); ?>">
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

	<?php
	if ( comments_open( get_the_ID() ) || get_comments_number( get_the_ID() ) ) :
		comments_template();
	endif;
	?>
</div>
