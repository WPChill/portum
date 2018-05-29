<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Portum
 */

get_header();

$img = get_custom_header();
$img = $img->url;
?>
	<div id="content">
		<div class="custom-header">
			<img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"/>
		</div>

		<div class="container">
			<div class="row">
				<section class="no-results col-sm-12 not-found">
					<header class="page-header">
						<h3 class="page-title"><span><?php esc_html_e( 'Nothing Found', 'portum' ); ?></span></h3>
					</header><!-- .page-header -->

					<div class="page-content">
						<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'portum' ); ?></p>

						<?php get_search_form(); ?>
					</div><!-- .page-content -->
				</section><!-- .no-results -->
			</div>
		</div>
	</div>
<?php
get_footer();
