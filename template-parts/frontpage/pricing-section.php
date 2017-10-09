<?php
/**
 * Template part for displaying a frontpage section
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Portum
 */

$frontpage = Portum_Frontpage::get_instance( 'portum_frontpage_sections' );
$fields    = $frontpage->sections[ $section_id ];
$grouping  = array(
	'values'   => $fields['pricing_grouping'],
	'group_by' => 'price_box_title',
);

$fields['pricing_boxes'] = $frontpage->get_repeater_field( $fields['pricing_repeater_field'], array(), $grouping );
?>
<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>">
	<div class="section-pricing section">
		<div class="container">
			<?php echo wp_kses_post( Portum_Helper::generate_pencil() ); ?>

			<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['pricing_subtitle'], $fields['pricing_title'] ) ); ?>
			<div class="row">
				<?php foreach ( $fields['pricing_boxes'] as $pricing_box ) { ?>

					<div class="col-md-4">
						<div class="pricing-item">
							<div class="plan">
								<strong>
									<?php echo wp_kses_post( $pricing_box['price_box_price'] ); ?>
								</strong>
							</div>

							<div class="details">
								<h4><?php echo wp_kses_post( $pricing_box['price_box_title'] ); ?></h4>
								<p><?php echo wp_kses_post( $pricing_box['price_box_text'] ); ?></p>
							</div>

							<?php if ( ! empty( $pricing_box['price_box_features'] ) ) { ?>

								<?php echo wp_kses_post( $pricing_box['price_box_features'] ); ?>

							<?php } ?>

							<?php if ( ! empty( $pricing_box['price_box_url'] ) ) { ?>
								<div class="wrapper">
									<a href="<?php echo esc_url( $pricing_box['price_box_url'] ); ?>" class="btn btn-contrast">
										<?php echo empty( $pricing_box['price_box_url_label'] ) ? esc_html__( 'Purchase', 'portum' ) : esc_html( $pricing_box['price_box_url_label'] ); ?>
									</a>
								</div>
							<?php } ?>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</section>
