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
);
$query = new WP_Query( $args );

$attr_helper = new Epsilon_Section_Attr_Helper( $fields, 'blog', Portum_Repeatable_Sections::get_instance() );
if ( empty( $fields['blog_section_unique_id'] ) ) {
	$fields['blog_section_unique_id'] = Portum_Helper::generate_section_id( 'blog' );
}

$parent_attr = array(
	'id'    => array( $fields['blog_section_unique_id'] ),
	'class' => array(
		'section-blog',
		'section',
		'ewf-section',
		'ewf-section-' . $fields['blog_section_visibility'],
	),
	'style' => array( 'background-image', 'background-position', 'background-size', 'background-repeat' ),
);

if ( 'bgcolor' == $fields['blog_background_type'] ) {
	$parent_attr['style'] = array( 'background-color' );
}
$counter     = 0;

$item_style           = array();
$item_class           = '';
$item_container_class = array();

if ( 'ewf-item__border' != $fields['item_style'] ) {
	$item_class = $fields['item_style'];
}else{
	$item_class = $fields['item_border_style'];

	if ( ! empty( $fields['item_border_color'] ) ) {
		$item_style[] = 'border-color: ' . esc_attr( $fields['item_border_color'] ) . ';';
	}
	
	if ( ! empty( $fields['item_border_width'] ) ) {
		$item_style[] = 'border-width: ' . esc_attr( $fields['item_border_width'] ) . 'px;';
	}
}

$item_container_class[] = 'ewf-item__spacing-' . ( isset( $fields['blog_column_spacing'] ) ? $fields['blog_column_spacing'] : '' );
/**
 * Layout stuff
 */
$content_class = '';
$header_class  = '';
$row_class     = '';

if ( 'left' == $fields['blog_row_title_align'] || 'right' == $fields['blog_row_title_align'] ) {
	$content_class = 'col-sm-8';
	$header_class  = 'col-sm-4';
	if ( 'right' == $fields['blog_row_title_align'] ) {
		$row_class = 'row-flow-reverse';
	}
} else {
	$content_class = 'col-sm-12';
	$header_class  = 'col-sm-12';
	if ( 'bottom' == $fields['blog_row_title_align'] ) {
		$row_class = 'row-column-reverse';
	}
}
$item_container_class[] = 'col-sm-3';
// end layout stuff
?>

<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>">
	<?php Portum_Helper::generate_inline_css( $fields['blog_section_unique_id'], 'blog', $fields ); ?>
	<?php echo wp_kses( Epsilon_Helper::generate_pencil( 'Portum_Repeatable_Sections', 'blog' ), Epsilon_Helper::allowed_kses_pencil() ); ?>
	<div <?php $attr_helper->generate_attributes( $parent_attr ); ?>>
		<?php $attr_helper->generate_color_overlay(); ?>

		<div class="ewf-section__content ewf-text-align--center">

			<div class="<?php echo esc_attr( Portum_Helper::container_class( 'blog', $fields ) ); ?>">

				<div class="row <?php echo esc_attr( $row_class ); ?>">

					<?php if ( ! empty( $fields['blog_subtitle'] ) || ! empty( $fields['blog_title'] ) ) { ?>
						<div class="<?php echo esc_attr( $header_class ); ?>">
							<div class="ewf-section-text">
								<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['blog_subtitle'], $fields['blog_title'] ) ); ?>
							</div><!--/.ewf-section-text-->
						</div><!--/.header class column -->
					<?php } ?>

					<div class="<?php echo esc_attr( $content_class ); ?>">
						<?php while ( $query->have_posts() ) { ?>
							<?php $counter++; ?>
							<?php $query->the_post(); ?>

							<div class="<?php echo esc_attr( implode( ' ', $item_container_class ) ); ?>">
								<div class="ewf-blog <?php echo esc_attr( $item_class ); ?>" style="<?php echo esc_attr( implode( ';', $item_style ) ); ?>">
									<?php if ( $fields['blog_show_thumbnail'] ) { ?>
										<div class="ewf-blog__featured-image">
											<?php
											if ( has_post_thumbnail() ) {
												the_post_thumbnail( 'portum-blog-section-image' );
											}
											?>
										</div><!--/.ewf-blog__featured-image-->
									<?php }//endif ?>

									<div class="ewf-blog__container">

										<div class="ewf-blog__meta">
											<?php if ( $fields['blog_show_date'] ) { ?>
												<span class="ewf-blog__news-date"><i class="fa fa-calendar"></i>
										<a href="<?php echo get_the_permalink(); ?>">
										<?php echo wp_kses_post( get_the_date() ); ?>
										</a>
									</span><!--/.news-date-->
											<?php }//endif ?>

											<?php if ( $fields['blog_show_author'] ) { ?>
												<span class="ewf-blog__author"><i class="fa fa-user"></i>
													<?php echo get_the_author_link(); ?>
												</span><!--/.news-date-->
											<?php }//endif ?>

											<?php if ( $fields['blog_show_comments'] ) { ?>
												<span class="ewf-blog__comments">
										<a href="<?php comments_link(); ?>"><i class="fa fa-comments"></i>
											<?php echo wp_kses_post( get_comments_number( '0', '1', '%' ) ); ?>
										</a>
									</span><!--/.news-date-->
											<?php }//endif ?>
										</div><!--/.ewf-blog--meta-->

										<div class="ewf-like-h5">
											<a href="<?php echo esc_url( get_permalink() ); ?>">
												<?php echo the_title(); ?>
											</a>
										</div><!--/.ewf-like-heading-->

										<?php if ( $fields['blog_post_word_count'] > 0 ) { ?>
											<div class="ewf-blog__content">
												<?php echo wp_trim_words( get_the_content(), absint( $fields['blog_post_word_count'] ) ); ?>
											</div>
										<?php } ?>

									</div><!--/.ewf-blog__content-->
								</div><!--/.ewf-blog-->
							</div><!--/.col-->

						<?php }// End while(). ?>
					</div><!--/.content class-->
					<?php if ( $fields['blog_show_read_more'] ) { ?>
						<?php
						$button_size             = ! empty( $fields['blog_button_size'] ) ? esc_attr( $fields['blog_button_size'] ) : 'ewf-btn--huge';
						$button_label            = ! empty( $fields['blog_button_label'] ) ? esc_attr( $fields['blog_button_label'] ) : __( 'Read More', 'portum' );
						$button_background_color = 'background-color: ' . ( ! empty( $fields['blog_button_background_color'] ) ? esc_attr( $fields['blog_button_background_color'] ) : 'initial' ) . ';';
						$button_text_color       = 'color: ' . ( ! empty( $fields['blog_button_text_color'] ) ? esc_attr( $fields['blog_button_text_color'] ) : 'initial' ) . ';';
						$button_border_radius    = 'border-radius: ' . ( ! empty( $fields['blog_button_radius'] ) ? esc_attr( $fields['blog_button_radius'] ) : '0' ) . 'px;';
						$button_border_color     = 'border-color: ' . ( ! empty( $fields['blog_button_border_color'] ) ? esc_attr( $fields['blog_button_border_color'] ) : 'initial' ) . ';';

						$style = $button_background_color . $button_border_color . $button_border_radius . $button_text_color;
						?>

						<div class="text-center col-sm-12">
							<a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>" style="<?php echo esc_attr( $style ); ?>" class="ewf-btn <?php echo esc_attr( $button_size ); ?>"><?php echo esc_html( $button_label ); ?></a>
						</div><!--/.col-->

					<?php } ?>
					<?php wp_reset_postdata(); ?>
				</div><!--/.row-->
			</div><!--/. container class -->
		</div><!--/.ewf-section-content-->
	</div><!--/. attr helper-->
</section>
