<?php
/**
 * Template part for displaying a frontpage section
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Portum
 */

$extra_pro_fields = array(
	'portfolio_image_show_zoom_icon' => true,
	'portfolio_slider'               => false,
	'portfolio_slider_autostart'     => true,
	'portfolio_slider_infinite'      => true,
	'portfolio_slider_pager'         => true,
	'portfolio_slider_arrows'        => true,
	'portfolio_slider_speed'         => 500,
	'portfolio_slides_shown'         => 6,
	'portfolio_slides_scrolled'      => 1,
);

$frontpage = Epsilon_Page_Generator::get_instance( 'portum_frontpage_sections_' . get_the_ID(), get_the_ID() );
$fields    = wp_parse_args( $frontpage->sections[ $section_id ], $extra_pro_fields );
$grouping  = array(
	'values'   => $fields['portfolio_grouping'],
	'group_by' => 'portfolio_title',
);

$fields['portfolio_items']             = $frontpage->get_repeater_field( $fields['portfolio_repeater_field'], array(), $grouping );
$fields['portfolio_items']             = isset( $fields['portfolio_items'] ) ? $fields['portfolio_items'] : '';
$fields['portfolio_column_spacing']    = isset( $fields['portfolio_column_spacing'] ) ? $fields['portfolio_column_spacing'] : '';
$fields['portfolio_column_group']      = isset( $fields['portfolio_column_group'] ) ? $fields['portfolio_column_group'] : '';
$fields['portfolio_description_below'] = (boolean) json_decode( strtolower( $fields['portfolio_description_below'] ) );
$fields['portfolio_image_lightbox']    = (boolean) json_decode( strtolower( $fields['portfolio_image_lightbox'] ) );
$fields['portfolio_image_show_description']  = (boolean) json_decode( strtolower( $fields['portfolio_image_show_description'] ) );
$fields['portfolio_image_show_zoom_icon']  = (boolean) json_decode( strtolower( $fields['portfolio_image_show_zoom_icon'] ) );
$fields['portfolio_slider']  = (boolean) json_decode( strtolower( $fields['portfolio_slider'] ) );
$fields['portfolio_slider_autostart']  = (boolean) json_decode( strtolower( $fields['portfolio_slider_autostart'] ) );
$fields['portfolio_slider_infinite']  = (boolean) json_decode( strtolower( $fields['portfolio_slider_infinite'] ) );
$fields['portfolio_slider_pager']  = (boolean) json_decode( strtolower( $fields['portfolio_slider_pager'] ) );
$fields['portfolio_slider_arrows']  = (boolean) json_decode( strtolower( $fields['portfolio_slider_arrows'] ) );

$attr_helper = new Epsilon_Section_Attr_Helper( $fields, 'portfolio', Portum_Repeatable_Sections::get_instance() );
if ( empty( $fields['portfolio_section_unique_id'] ) ) {
	$fields['portfolio_section_unique_id'] = Portum_Helper::generate_section_id( 'portfolio' );
}

$parent_attr = array(
	'id'    => ! empty( $fields['portfolio_section_unique_id'] ) ? array( $fields['portfolio_section_unique_id'] ) : array(),
	'class' => array(
		'section-portfolio',
		'section',
		'ewf-section',
		'ewf-section-' . $fields['portfolio_section_visibility'],
	),
);


// only load scripts if we're viewing images in a lightbox
if ( $fields['portfolio_image_lightbox'] ) {
	wp_enqueue_style( 'magnificPopup' );
	wp_enqueue_script( 'magnificPopup' );
}

if ( $fields['portfolio_slider'] ) {
	wp_enqueue_script( 'slick' );
	wp_enqueue_style( 'slick' );
}


/**
 * Layout stuff
 */
$content_class = '';
$header_class  = '';
$row_class     = '';
$item_spacing  = 'ewf-item__spacing-' . ( isset( $fields['portfolio_column_spacing'] ) ? $fields['portfolio_column_spacing'] : '' );

if ( 'left' == $fields['portfolio_row_title_align'] || 'right' == $fields['portfolio_row_title_align'] ) {
	$content_class = 'col-sm-8 ewf-content__wrap';
	$header_class  = 'col-sm-4';
	if ( 'right' == $fields['portfolio_row_title_align'] ) {
		$row_class = 'row-flow-reverse';
	}
} else {
	$content_class = 'col-sm-12 ewf-content__wrap';
	$header_class  = 'col-sm-12';
	if ( 'bottom' == $fields['portfolio_row_title_align'] ) {
		$row_class = 'row-column-reverse';
	}
}
$item_class        = 'col-sm-' . ( 12 / absint( $fields['portfolio_column_group'] ) );
if ( $fields['portfolio_slider'] ) {
	$item_class    = 'col-sm-12';
}

/**
 * Item Style
 */
$item_element_class = '';
$item_style         = array();

if ( 'ewf-item__border' != $fields['item_style'] ) {
	$item_element_class = $fields['item_style'];
}else{
	$item_element_class = $fields['item_border_style'];

	if ( ! empty( $fields['item_border_color'] ) ) {
		$item_style[] = 'border-color: ' . esc_attr( $fields['item_border_color'] ) . ';';
	}

	if ( ! empty( $fields['item_border_width'] ) ) {
		$item_style[] = 'border-width: ' . esc_attr( $fields['item_border_width'] ) . 'px;';
	}
}
// end layout stuff

?>

<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>">
	<?php Portum_Helper::generate_inline_css( $fields['portfolio_section_unique_id'], 'portfolio', $fields ); ?>
	<?php echo wp_kses( Portum_Helper::generate_pencil( 'Portum_Repeatable_Sections', 'portfolio' ), Epsilon_Helper::allowed_kses_pencil() ); ?>
	<div <?php $attr_helper->generate_attributes( $parent_attr ); ?>>
		<?php
		$attr_helper->generate_color_overlay();
		?>

		<div class="ewf-section__content">
			<div class="<?php echo esc_attr( Portum_Helper::container_class( 'portfolio', $fields ) ); ?>">

				<div class="row <?php echo esc_attr( $row_class ); ?>">

					<?php if ( ! empty( $fields['portfolio_title'] ) || ! empty( $fields['portfolio_subtitle'] ) ) { ?>
						<div class="<?php echo esc_attr( $header_class ); ?>">
							<div class="ewf-section-text">
								<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['portfolio_subtitle'], $fields['portfolio_title'] ) ); ?>
							</div><!--/.ewf-section--text-->
						</div><!--/.header class-->
					<?php } ?>

					<div class="<?php echo esc_attr( $content_class ); ?>">
						<?php if ( ! empty( $fields['portfolio_items'] ) ) { ?>

							<?php if ( $fields['portfolio_slider'] ) { ?>

								<div class="ewf-slider"
								data-slider-speed="<?php echo ! empty( $fields['portfolio_slider_speed'] ) ? absint( $fields['portfolio_slider_speed'] ) : '500'; ?>"
								data-slider-autoplay="<?php echo $fields['portfolio_slider_autostart'] ? 'true' : 'false'; ?>"
								data-slides-shown="<?php echo $fields['portfolio_slides_shown'] ? esc_attr( $fields['portfolio_slides_shown'] ) : '1'; ?>"
								data-slides-scrolled="<?php echo $fields['portfolio_slides_scrolled'] ? esc_attr( $fields['portfolio_slides_scrolled'] ) : '1'; ?>"
								data-slider-loop="<?php echo $fields['portfolio_slider_infinite'] ? 'true' : 'false'; ?>"
								data-slider-enable-pager="<?php echo $fields['portfolio_slider_pager'] ? 'true' : 'false'; ?>"
								data-slider-enable-controls="<?php echo $fields['portfolio_slider_arrows'] ? 'true' : 'false'; ?>">

								<div class="ewf-slider__slides">
							<?php } ?>

							<?php foreach ( $fields['portfolio_items'] as $key => $item ) { ?>
							<div class="<?php echo esc_attr( $item_class . ' ' . $item_spacing ); ?>">
							<?php if ( $fields['portfolio_description_below'] ) { ?>
							<div class="ewf-portfolio-item ewf-portfolio__has-description-below <?php echo esc_attr( $item_element_class ); ?>" style="<?php echo esc_attr( implode( ';', $item_style ) ); ?>">
							<?php } else { ?>
								<div class="ewf-portfolio-item <?php echo esc_attr( $item_element_class ); ?>" style="<?php echo esc_attr( implode( ';', $item_style ) ); ?>">
							<?php } ?>
									<?php
									echo wp_kses( Epsilon_Helper::generate_field_repeater_pencil( $key, 'portum_portfolio_section', 'portum_portfolio' ), Epsilon_Helper::allowed_kses_pencil() );
									?>
									<div class="ewf-portfolio-item__thumbnail">
										<?php if ( ! empty( $item['portfolio_image'] ) ) { ?>
											<img src="<?php echo esc_url( $item['portfolio_image'] ); ?>" alt="" />
										<?php } ?>

										<div class="ewf-portfolio-item__overlay">

											<?php if ( ! $fields['portfolio_description_below'] ) { ?>
												<div class="ewf-portfolio-item__details">
													<?php if ( ! empty( $item['portfolio_title'] ) ) { ?>
														<div class="ewf-like-h6">
															<a href="<?php echo esc_url( $item['portfolio_link'] ); ?>"><?php echo wp_kses_post( $item['portfolio_title'] ); ?></a>
														</div><!--/.ewf-like-h6-->
													<?php } ?>
													<?php if ( $fields['portfolio_image_show_description'] && ! empty( $item['portfolio_description'] ) ): ?>
														<div class="ewf-portfolio-item__description">
															<?php echo wp_kses_post( $item['portfolio_description'] ); ?>
														</div><!--/.ewf-portfolio-item__description-->
													<?php endif ?>

												</div><!-- /.ewf-portfolio-item__details -->
											<?php } ?>

											<?php // the str_replace below is used to remove the image size from the lightbox image; defined by: 'size'    => 'portum-portfolio-image' in fields.php ?>

											<?php if ( $fields['portfolio_image_lightbox'] ) { ?>
												<a class="ewf-portfolio-item__control-zoom magnific-link" href="<?php echo esc_url( str_replace( '-400x450', '', $item['portfolio_image'] ) ); ?>">
													<?php if ( $fields['portfolio_image_show_zoom_icon'] ) { ?>
														<i class="fa fa-eye"></i>
													<?php } ?>
												</a><!--/.ewf-portfolio-item__control-zoom magnific-link-->
											<?php } else { ?>
												<a class="ewf-portfolio-item__control-zoom" href="<?php echo esc_url( $item['portfolio_link'] ); ?>">
													<?php if ( $fields['portfolio_image_show_zoom_icon'] ) { ?>
														<i class="fa fa-eye"></i>
													<?php } ?>
												</a><!--/.ewf-portfolio-item__control-zoom-->
											<?php } ?>

										</div><!-- ewf-portfolio-item__overlay -->

									</div><!-- ewf-portfolio-item__thumbnail -->

									<?php if ( $fields['portfolio_description_below'] ) { ?>
										<div class="ewf-portfolio-item__details">
											<?php if ( ! empty( $item['portfolio_title'] ) ) { ?>
												<div class="ewf-like-h6">
													<a href="<?php echo esc_url( $item['portfolio_link'] ); ?>"><?php echo wp_kses_post( $item['portfolio_title'] ); ?></a>
												</div><!--/.ewf-like-h6-->
											<?php } ?>

											<div class="ewf-portfolio-item__description">
												<?php echo wp_kses_post( $item['portfolio_description'] ); ?>
											</div><!--/.ewf-portfolio-item__description-->
										</div><!-- ewf-portfolio-item__details -->
									<?php } ?>
								</div><!-- ewf-portfolio-item -->
							</div><!--/.itemclass item spacing-->
						<?php } ?>
							<?php if ( $fields['portfolio_slider'] ) { ?>
								</div>
								<div class="ewf-slider__pager"></div>
								<div class="ewf-slider__arrows"></div>
								</div><!--/.ewf-slider-->
							<?php } ?>
						<?php } ?>
					</div><!--/.content class-->
				</div><!--/.row-->
			</div><!--/.class-attr-->
		</div><!--/.ewf-section__content-->
	</div><!--/.parent-attr-->
</section>
