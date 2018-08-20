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

$parent_attr      = array(
	'id'    => ! empty( $fields['blog_section_unique_id'] ) ? array( $fields['blog_section_unique_id'] ) : array(),
	'class' => array(
		'section-blog',
		'section',
		'ewf-section',
		'ewf-section-' . $fields['blog_section_visibility'],
	),
	'style' => array( 'background-image', 'background-position', 'background-size', 'background-repeat' ),
);
$counter          = 0;
$span             = 12 / absint( $fields['blog_post_count'] );
$item_style       = ( ! empty( $fields['item_style'] ) ? esc_attr( $fields['item_style'] ) : '' );
$item_style_color = 'border-color: ' . ( ! empty( $fields['item_style_color_picker'] ) ? esc_attr( $fields['item_style_color_picker'] ) : '' ) . ';'
?>

<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>">
	<?php Portum_Helper::generate_css_color_tabs( $section_id, 'blog', $fields ); ?>
	<?php echo wp_kses( Portum_Helper::generate_pencil( 'Portum_Repeatable_Sections', 'blog' ), Epsilon_Helper::allowed_kses_pencil() ); ?>
	<div <?php $attr_helper->generate_attributes( $parent_attr ); ?>>
		<?php
		$attr_helper->generate_color_overlay();
		?>

		<div class="ewf-section__content">

			<div class="<?php echo esc_attr( Portum_Helper::container_class( 'blog', $fields ) ); ?>">

				<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['blog_subtitle'], $fields['blog_title'], array( 'center' => true ) ) ); ?>
				<div class="row row-eq-height">
					<?php while ( $query->have_posts() ) { ?>
					<?php $counter++; ?>
					<?php $query->the_post(); ?>

					<div class="col-sm-<?php echo esc_attr( $span ); ?>">
						<div class="ewf-blog <?php echo esc_attr( $item_style ); ?>" style="<?php echo esc_attr( $item_style_color ); ?>">
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
										<a href="<?php echo get_the_author_link(); ?>">
										<?php echo wp_kses_post( get_the_author() ); ?>
										</a>
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
					<?php if ( 0 === $counter % ( 12 / $span ) ) { ?>
				</div><!--/.row-->
				<div class="row row-eq-height">
					<?php } ?>
					<?php }// End while(). ?>
				</div><!--/.row-->

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

					<div class="row">
						<div class="text-center col-md-12">
							<a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>" style="<?php echo esc_attr( $style ); ?>" class="ewf-btn <?php echo esc_attr( $button_size ); ?>"><?php echo esc_html( $button_label ); ?></a>
						</div><!--/.col-->
					</div><!--/.row-->
				<?php } ?>
				<?php wp_reset_postdata(); ?>
			</div>
		</div>
	</div>
</section>
