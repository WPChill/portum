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

$fields['pricing_boxes'] = $frontpage->get_repeater_field( $fields['pricing_repeater_field'], array(), $grouping );
?>
<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>">
	<div class="section-pricing section">
		<div class="container">
			<?php echo wp_kses_post( Portum_Helper::generate_pencil() ); ?>

			<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['pricing_subtitle'], $fields['pricing_title'] ) ); ?>
			<div class="row">
				<?php foreach ( $fields['pricing_boxes'] as $pricing_box ) { ?>

					<div class="col-md-<?php echo absint( $span ); ?>">
						<div class="pricing-item">
							<div class="plan">
								<strong>
									<?php if ( ! empty( $pricing_box['price_box_currency'] ) ) { ?>
										<sup><?php echo esc_html( $pricing_box['price_box_currency'] ); ?></sup>
									<?php } ?>

									<?php
									if ( ! empty( $pricing_box['price_box_price'] ) ) {
										echo esc_html( $pricing_box['price_box_price'] );
									}
									?>

									<?php if ( ! empty( $pricing_box['price_box_period'] ) ) { ?>
										<sub>/<?php echo esc_html( $pricing_box['price_box_period'] ); ?></sub>
									<?php } ?>
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
									<a href="<?php echo esc_url( $pricing_box['price_box_url'] ); ?>" class="btn">
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
