<?php
/**
 * Template part for displaying single pages.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Portum
 */

if ( isset( $section_id ) ) {
	$frontpage = Epsilon_Page_Generator::get_instance( 'portum_frontpage_sections_' . get_the_ID(), get_the_ID() );
	$fields    = $frontpage->sections[ $section_id ];
}

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row">
		<div class="col-sm-12">

			<div class="post-content">
				<?php
				the_content();
				wp_link_pages(
					array(
						'before'           => '<nav class="nav-links">',
						'after'            => '</nav>',
						'separator'        => '<span class="sep"></span>',
						'next_or_number'   => 'next',
						'nextpagelink'     => __( 'Next page', 'portum' ),
						'previouspagelink' => __( 'Previous page', 'portum' ),
					)
				);
				?>

			</div><!-- .post-content -->

		</div>
	</div>
</article>
