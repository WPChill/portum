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
$grouping  = array(
	'values'   => $fields['pricing_grouping'],
	'group_by' => 'price_box_title',
);
$span      = 12 / absint( $fields['pricing_column_group'] );

$fields['pricing_boxes']          = $frontpage->get_repeater_field( $fields['pricing_repeater_field'], array(), $grouping );
$fields['pricing_column_spacing'] = isset( $fields['pricing_column_spacing'] ) ? $fields['pricing_column_spacing'] : '';
$attr_helper                      = new Epsilon_Section_Attr_Helper( $fields, 'pricing', Portum_Repeatable_Sections::get_instance() );
if ( empty( $fields['pricing_section_unique_id'] ) ) {
	$fields['pricing_section_unique_id'] = Portum_Helper::generate_section_id( 'pricing' );
}

$parent_attr = array(
	'id'    => array( $fields['pricing_section_unique_id'] ),
	'class' => array(
		'section-pricing',
		'section',
		'ewf-section',
		'ewf-section-' . $fields['pricing_section_visibility'],
	),
);

/**
 * Layout stuff
 */
$content_class = '';
$header_class  = '';
$row_class     = '';
$item_spacing  = 'ewf-item__spacing-' . ( isset( $fields['pricing_column_spacing'] ) ? $fields['pricing_column_spacing'] : '' );

if ( 'left' == $fields['pricing_row_title_align'] || 'right' == $fields['pricing_row_title_align'] ) {
	$content_class = 'col-sm-8 ewf-content__wrap';
	$header_class  = 'col-sm-4';
	if ( 'right' == $fields['pricing_row_title_align'] ) {
		$row_class = 'row-flow-reverse';
	}
} else {
	$content_class = 'col-sm-12 ewf-content__wrap';
	$header_class  = 'col-sm-12';
	if ( 'bottom' == $fields['pricing_row_title_align'] ) {
		$row_class = 'row-column-reverse';
	}
}
$item_class = 'col-sm-' . ( 12 / absint( $fields['pricing_column_group'] ) );

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
?>
<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>" data-customizer-section-string-id="pricing">
	<?php Portum_Helper::generate_inline_css( $fields['pricing_section_unique_id'], 'pricing', $fields ); ?>
	<?php echo wp_kses( Epsilon_Helper::generate_pencil( 'Portum_Repeatable_Sections', 'pricing' ), Epsilon_Helper::allowed_kses_pencil() ); ?>
	<div <?php $attr_helper->generate_attributes( $parent_attr ); ?>>
		<?php $attr_helper->generate_color_overlay(); ?>
		<div class="ewf-section__content">
			<div class="<?php echo esc_attr( Portum_Helper::container_class( 'pricing', $fields ) ); ?>">

				<div class="row <?php echo esc_attr( $row_class ); ?>">

					<?php if ( ! empty( $fields['pricing_subtitle'] ) || ! empty( $fields['pricing_title'] ) || ! empty( $fields['pricing_text'] ) ) { ?>
						<div class="<?php echo esc_attr( $header_class ); ?>">
							<div class="ewf-section-text">
								<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['pricing_subtitle'], $fields['pricing_title'] ) ); ?>
								<?php echo wp_kses_post( wpautop( $fields['pricing_text'] ) ); ?>
							</div><!--/.ewf-section--text-->
						</div><!--/.col-->
					<?php } ?>
					<div class="<?php echo esc_attr( $content_class ); ?>">
						<?php
						foreach ( $fields['pricing_boxes'] as $key => $pricing_box ) {

							$bg_color = 'background-color: ' . ( ! empty( $pricing_box['price_box_bg_color'] ) ? esc_attr( $pricing_box['price_box_bg_color'] ) : 'transparent' ) . ';';
							?>

							<div class="<?php echo esc_attr( $item_class . ' ' . $item_spacing ); ?>">


								<div style="<?php echo esc_attr( $bg_color ) . esc_attr( implode( ';', $item_style ) ); ?>" class="ewf-pricing__item-container <?php echo esc_attr( $item_element_class ); ?>">
									<?php if ( true === $pricing_box['price_box_featured'] ) { ?>
										<div class="ewf-pricing__featured">
											<?php echo esc_html__( 'Most Popular', 'portum' ); ?>
										</div><!--/.pricing featured-->
									<?php }//endif true check ?>

									<?php
									echo wp_kses( Epsilon_Helper::generate_field_repeater_pencil( $key, 'portum_pricing_section', 'portum_price_boxes' ), Epsilon_Helper::allowed_kses_pencil() );
									?>

									<?php if ( $pricing_box['price_box_icon_display'] && ! empty( $pricing_box['price_box_icon'] ) ) : ?>
										<?php Portum_Helper::render_icon( $pricing_box, 'price_box_icon' ); ?>
									<?php endif; ?>

									<div class="ewf-pricing__details">
										<div class="ewf-pricing__content">
											<div class="ewf-like-h4"><?php echo wp_kses_post( $pricing_box['price_box_title'] ); ?></div>
											<p><?php echo wp_kses_post( $pricing_box['price_box_text'] ); ?></p>
										</div><!--/.ewf-pricing_-content-->
									</div><!--/.ewf-pricing__details-->

									<?php if ( ! empty( $pricing_box['price_box_amount'] ) ) { ?>
										<div class="ewf-pricing__plan">
											<div class="ewf-like-h4"><?php echo wp_kses_post( $pricing_box['price_box_amount'] ); ?></div>
										</div><!--/.ewf-pricing__plan-->
									<?php }//endif !empty ?>

									<?php if ( ! empty( $pricing_box['price_box_features'] ) ) { ?>
										<?php echo wp_kses_post( $pricing_box['price_box_features'] ); ?>
									<?php }//endif !empty ?>


									<?php if ( ! empty( $pricing_box['price_box_button_label'] ) ) { ?>
										<div class="ewf-pricing__button-wrapper">
											<?php Portum_Helper::render_button( $pricing_box, 'price_box_button' ); ?>
										</div><!--/.ewf-pricing__button-wrapper-->
									<?php }//endif !empty ?>

								</div><!--.ewf-pricing__item-container-->
							</div><!--/.col.item_spacing-->
						<?php }//end foreach ?>
					</div><!--/.content width class -->
				</div><!--/.row-->
			</div><!-- container class -->
		</div><!--/.ewf-section__content-->
	</div><!-- attr helper -->
</section>
