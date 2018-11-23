<?php
/**
 * Template part for displaying a frontpage section
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Portum
 */

$frontpage          = Epsilon_Page_Generator::get_instance( 'portum_frontpage_sections_' . get_the_ID(), get_the_ID() );
$fields             = $frontpage->sections[ $section_id ];
$grouping           = array(
	'values'   => $fields['services_grouping'],
	'group_by' => 'service_title',
);
$fields['services'] = $frontpage->get_repeater_field( $fields['services_repeater_field'], array(), $grouping );

$attr_helper = new Epsilon_Section_Attr_Helper( $fields, 'services', Portum_Repeatable_Sections::get_instance() );
if ( empty( $fields['services_section_unique_id'] ) ) {
	$fields['services_section_unique_id'] = Portum_Helper::generate_section_id( 'services' );
}

$parent_attr = array(
	'id'    => array( $fields['services_section_unique_id'] ),
	'class' => array(
		'section-services',
		'section',
		'ewf-section',
		'contrast',
		'ewf-section-' . $fields['services_section_visibility'],
	),
);

/**
 * Layout stuff
 */
$content_class = '';
$header_class  = '';
$row_class     = '';
$item_spacing  = 'ewf-item__spacing-' . ( isset( $fields['services_column_spacing'] ) ? $fields['services_column_spacing'] : '' );

if ( 'left' == $fields['services_row_title_align'] || 'right' == $fields['services_row_title_align'] ) {
	$content_class = 'col-sm-8 ewf-content__wrap';
	$header_class  = 'col-sm-4';
	if ( 'right' == $fields['services_row_title_align'] ) {
		$row_class = 'row-flow-reverse';
	}
} else {
	$content_class = 'col-sm-12 ewf-content__wrap';
	$header_class  = 'col-sm-12';
	if ( 'bottom' == $fields['services_row_title_align'] ) {
		$row_class = 'row-column-reverse';
	}
}
$item_class        = 'col-sm-' . ( 12 / absint( $fields['services_column_group'] ) );
$item_effect_style = ( ! empty( $fields['services_item_style'] ) ? esc_attr( $fields['services_item_style'] ) : 'ewf-item__no-effect' );

/**
 * Item Style
 */
$item_element_class = '';
$item_style         = array();

if ( 'ewf-item__border' != $fields['item_style'] ) {
	$item_element_class = $fields['item_style'];
} else {
	$item_element_class = $fields['item_border_style'];

	if ( ! empty( $fields['item_border_color'] ) ) {
		$item_style[] = 'border-color: ' . esc_attr( $fields['item_border_color'] ) . ';';
	}

	if ( ! empty( $fields['item_border_width'] ) ) {
		$item_style[] = 'border-width: ' . esc_attr( $fields['item_border_width'] ) . 'px;';
	}
}
// end layout stuff


if ( ! empty( $fields['services_slider'] ) ) {
	wp_enqueue_script( 'slick' );
	wp_enqueue_style( 'slick' );
}
?>

<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>" data-customizer-section-string-id="services">
	<?php Portum_Helper::generate_inline_css( $fields['services_section_unique_id'], 'services', $fields ); ?>
	<?php echo wp_kses( Epsilon_Helper::generate_pencil( 'Portum_Repeatable_Sections', 'services' ), Epsilon_Helper::allowed_kses_pencil() ); ?>
	<div <?php $attr_helper->generate_attributes( $parent_attr ); ?>>
		<?php $attr_helper->generate_color_overlay(); ?>

		<div class="ewf-section__content">
			<div class="<?php echo esc_attr( Portum_Helper::container_class( 'services', $fields ) ); ?>">

				<div class="row <?php echo esc_attr( $row_class ); ?>">

					<!-- Check if we have a title/subtitle -->
					<?php if ( ! empty( $fields['services_subtitle'] ) || ! empty( $fields['services_title'] ) ) { ?>
						<div class="<?php echo esc_attr( $header_class ); ?>">
							<div class="ewf-section-text">
								<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['services_subtitle'], $fields['services_title'] ) ); ?><?php echo wpautop( wp_kses_post( $fields['services_description'] ) ); ?>
							</div><!--/.ewf-section-text-->
						</div><!--/.col-->
					<?php }//endif  ?>
					<!-- // End Title Check -->

					<!-- Check if we have values in our field repeater -->
					<?php if ( ! empty( $fields['services'] ) ) { ?>
						<div class="<?php echo esc_attr( $content_class ); ?>">

							<?php if ( ! empty( $fields['services_slider'] ) ) { ?>
							<div class="ewf-slider" data-slider-mode-fade="false" data-slider-speed="<?php echo ! empty( $fields['services_slider_speed'] ) ? absint( $fields['services_slider_speed'] ) : '500'; ?>" data-slider-autoplay="<?php echo $fields['services_slider_autostart'] ? 'true' : 'false'; ?>" data-slides-shown="<?php echo $fields['services_slides_shown'] ? esc_attr( $fields['services_slides_shown'] ) : '1'; ?>" data-slides-scrolled="<?php echo $fields['services_slides_scrolled'] ? esc_attr( $fields['services_slides_scrolled'] ) : '1'; ?>" data-slider-loop="<?php echo $fields['services_slider_infinite'] ? 'true' : 'false'; ?>" data-slider-enable-pager="<?php echo $fields['services_slider_pager'] ? 'true' : 'false'; ?>" data-slider-enable-controls="<?php echo $fields['services_slider_controls'] ? 'true' : 'false'; ?>">

								<div class="ewf-slider__slides">
									<?php } ?>

									<?php if ( empty( $fields['services_slider'] ) ) { ?>
									<div class="row">
										<?php } ?>
										<?php foreach ( $fields['services'] as $key => $service ) { ?>

											<?php $item_style[] = 'background-color: ' . ( ! empty( $service['services_bg_color'] ) ? esc_attr( $service['services_bg_color'] ) : '' ); ?>

											<div class="<?php echo esc_attr( $item_class . ' ' . $item_spacing ); ?>">
												<div class="services-item <?php echo esc_attr( $item_element_class ); ?>" style="<?php echo esc_attr( implode( ';', $item_style ) ); ?>">
													<?php
													echo wp_kses( Epsilon_Helper::generate_field_repeater_pencil( $key, 'portum_services_section', 'portum_services' ), Epsilon_Helper::allowed_kses_pencil() );
													?>

													<?php Portum_Helper::render_icon( $service, 'service_icon' ); ?>

													<?php if ( ! empty( $service['service_title'] ) ) { ?>
														<div class="ewf-like-h6">
															<?php echo wp_kses_post( $service['service_title'] ); ?>
														</div><!--/.ewf-like-h6-->
													<?php } ?>

													<?php if ( ! empty( $service['service_description'] ) ) { ?>
														<p><?php echo wp_kses_post( $service['service_description'] ); ?></p>
													<?php } ?>
												</div><!--/.services-item-->
											</div><!--/.col-sm-->

										<?php }//end foreach ?>

										<?php if ( ! empty( $fields['services_slider'] ) ) { ?>
									</div><!--/.ewf-slider__slides-->
									<div class="ewf-slider__pager"></div>
									<div class="ewf-slider__arrows"></div>
								</div><!--/.ewf-slider-->
								<?php }// end if ?>
							</div><!--/.col-sm--->
						</div><!--/.row-->
					<?php } ?>
				</div>
			</div>
		</div>
</section>
