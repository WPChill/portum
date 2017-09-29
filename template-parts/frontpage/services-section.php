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
	'values'   => $fields['services_grouping'],
	'group_by' => 'service_title',
);

$fields['services'] = $frontpage->get_repeater_field( $fields['services_repeater_field'], array(), $grouping );

$attr = '';
if ( ! empty( $fields['services_image'] ) ) {
	$attr .= 'style="background-image:url(' . esc_url( $fields['services_image'] ) . ')"';
}
?>

<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>">
	<div class="section-services section contrast" <?php echo $attr; ?>>
		<div class="container">
			<?php echo wp_kses_post( Portum_Helper::generate_pencil() ); ?>
			<div class="row">
				<div class="col-md-3">
					<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['services_subtitle'], $fields['services_title'] ) ); ?>
				</div>
				<?php if ( ! empty( $fields['services'] ) ) { ?>

					<?php foreach ( $fields['services'] as $service ) { ?>
						<div class="col-md-3 col-xs-6">
							<div class="services-item">
								<a href="#">
									<?php if ( ! empty( $service['service_icon'] ) ) { ?>
										<i class="<?php echo esc_attr( $service['service_icon'] ); ?>" aria-hidden="true"></i>
									<?php } ?>

									<?php if ( ! empty( $service['service_title'] ) ) { ?>
										<span><?php echo esc_html( $service['service_title'] ); ?></span>
									<?php } ?>

									<?php if ( ! empty( $service['service_description'] ) ) { ?>
										<strong><?php echo esc_html( $service['service_description'] ); ?></strong>
									<?php } ?>
								</a>
							</div>
						</div>
					<?php } ?>

				<?php } ?>
			</div>
		</div>
	</div>
</section>
