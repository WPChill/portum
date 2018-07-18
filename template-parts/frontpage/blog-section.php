<?php
/**
 * Template part for displaying a frontpage section
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Portum
 */

$frontpage = Epsilon_Page_Generator::get_instance( 'portum_frontpage_sections_' . get_the_ID(), get_the_ID() );
$fields    = $frontpage->sections[ $section_id ];

$args  = array(
	'posts_per_page' => $fields['blog_post_count'],
	'meta_query'     => array(
		array(
			'key' => '_thumbnail_id',
		),
	),
);
$query = new WP_Query( $args );

$attr_helper = new Epsilon_Section_Attr_Helper( $fields, 'blog', Portum_Repeatable_Sections::get_instance() );

$parent_attr = array(
	'id'    => ! empty( $fields['blog_section_unique_id'] ) ? array( $fields['blog_section_unique_id'] ) : array(),
	'class' => array(
		'section-blog',
		'section',
		'ewf-section',
		'ewf-section-' . $fields['blog_section_visibility'],
	),
	'style' => array( 'background-image', 'background-position', 'background-size', 'background-repeat' ),
);
?>

<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>">
	<?php Portum_Helper::generate_css_color_tabs( $section_id, 'blog', $fields ); ?>
	<?php echo wp_kses( Portum_Helper::generate_pencil( 'Portum_Repeatable_Sections', 'blog' ), Epsilon_Helper::allowed_kses_pencil() ); ?>
	<div <?php $attr_helper->generate_attributes( $parent_attr ); ?>>
		<?php
		$attr_helper->generate_color_overlay();
		$attr_helper->generate_video_overlay();
		?>

		<div class="ewf-section__content">

			<div class="<?php echo esc_attr( Portum_Helper::container_class( 'blog', $fields ) ); ?>">

				<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['blog_subtitle'], $fields['blog_title'], array( 'center' => true ) ) ); ?>

				<?php while ( $query->have_posts() ) { ?>

					<?php $query->the_post(); ?>

					<div class="blog-news-item">
						<div class="row">
							<div class="col-md-8 col-sm-6 col-sx-12">
								<div class="post-details">
									<h4>
										<a href="<?php echo esc_url( get_permalink() ); ?>">
											<?php echo the_title(); ?>
										</a>
									</h4>

									<?php echo wpautop( wp_kses_post( wp_trim_words( get_the_content(), 30 ) ) ); ?>

								</div>
							</div>
							<div class="col-md-4 col-sm-6 col-sx-12">
								<div class="featured">
									<?php
									if ( has_post_thumbnail() ) {
										the_post_thumbnail( 'portum-blog-section-image' );
									} else {
										echo '<img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/picture_placeholder.jpg"/>';
									}
									?>
									<div class="overlay"></div>

									<div class="news-category">
										<strong>
											<?php $categories = get_the_category(); ?>
											<a href="<?php echo esc_url( get_category_link( $categories[0] ) ); ?>"><?php echo wp_kses_post( $categories[0]->name ); ?></a>
										</strong>
									</div>

									<div class="news-date">
										<strong><span><?php echo wp_kses_post( get_the_date() ); ?></span></strong>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php }// End while(). ?>
				<?php wp_reset_postdata(); ?>
			</div>
		</div>
	</div>
</section>
