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

$parent_attr = array(
	'id'    => $fields['services_section_unique_id'] ? array( $fields['services_section_unique_id'] ) : array(),
	'class' => array(
		'section-services',
		'section',
		'ewf-section',
		'contrast',
		'ewf-section-' . $fields['services_section_visibility'],
	),
	'style' => array( 'background-image', 'background-position', 'background-size', 'background-repeat' ),
);

?>

<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>">
	<div <?php $attr_helper->generate_attributes( $parent_attr ); ?>>
		<?php
		$attr_helper->generate_video_overlay();
		$attr_helper->generate_color_overlay();

		$section_item_columns  = 12 / intval( $fields['services_column_group'] );
		$section_items_content = 12 - $section_item_columns;
		?>

		<div class="ewf-section__content">
			<div class="<?php echo esc_attr( Portum_Helper::container_class( 'services', $fields ) ); ?>">

				<?php echo wp_kses( Portum_Helper::generate_pencil( 'Portum_Repeatable_Sections', 'services' ), Epsilon_Helper::allowed_kses_pencil() ); ?>

				<?php if ( 'left' === $fields['services_row_title_align'] ) { ?>
					<div class="row">
						<div class="col-md-<?php echo esc_attr( $section_item_columns ); ?> col-sm-4">
							<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['services_subtitle'], $fields['services_title'] ) ); ?>
							<?php echo wpautop( wp_kses_post( $fields['services_description'] ) ); ?>
						</div>

						<?php if ( ! empty( $fields['services'] ) ) { ?>
							<div class="col-md-<?php echo esc_attr( $section_items_content ); ?> col-sm-8">
								<div class="row">
									<?php foreach ( $fields['services'] as $key => $service ) { ?>
										<div class="col-md-<?php echo esc_attr( $section_item_columns ); ?> col-xs-6">
											<div class="services-item services-item--<?php echo esc_attr( isset( $service['service_type'] ) ? $service['service_type'] : '' ); ?> services-item--<?php echo esc_attr( isset( $service['service_type_color'] ) ? $service['service_type_color'] : '' ); ?><?php echo( $key <= ( intval( $fields['services_column_group'] ) - 1 ) ? ' services-item-first' : null ); ?>">
												<?php if ( ! empty( $service['service_icon'] ) ) { ?>
													<i class="<?php echo esc_attr( $service['service_icon'] ); ?>" aria-hidden="true"></i>
												<?php } ?>

												<?php if ( ! empty( $service['service_title'] ) ) { ?>
													<h5><?php echo esc_html( $service['service_title'] ); ?></h5>
												<?php } ?>

												<?php if ( ! empty( $service['service_description'] ) ) { ?>
													<p><?php echo esc_html( $service['service_description'] ); ?></p>
												<?php } ?>
											</div>
										</div>
									<?php } ?>
								</div>
							</div>
						<?php } ?>
					</div>
				<?php } elseif ( 'right' === $fields['services_row_title_align'] ) { ?>
					<div class="row">
						<?php if ( ! empty( $fields['services'] ) ) { ?>
							<div class="col-md-<?php echo esc_attr( $section_items_content ); ?> col-sm-8">
								<div class="row">
									<?php foreach ( $fields['services'] as $key => $service ) { ?>
										<div class="col-md-<?php echo esc_attr( $section_item_columns ); ?> col-xs-6">
											<div class="services-item services-item--<?php echo esc_attr( isset( $service['service_type'] ) ? $service['service_type'] : '' ); ?> services-item--<?php echo esc_attr( isset( $service['service_type_color'] ) ? $service['service_type_color'] : '' ); ?><?php echo( $key <= ( intval( $fields['services_column_group'] ) - 1 ) ? ' services-item-first' : null ); ?>">
												<?php if ( ! empty( $service['service_icon'] ) ) { ?>
													<i class="<?php echo esc_attr( $service['service_icon'] ); ?>" aria-hidden="true"></i>
												<?php } ?>

												<?php if ( ! empty( $service['service_title'] ) ) { ?>
													<h5><?php echo esc_html( $service['service_title'] ); ?></h5>
												<?php } ?>

												<?php if ( ! empty( $service['service_description'] ) ) { ?>
													<p><?php echo esc_html( $service['service_description'] ); ?></p>
												<?php } ?>
											</div>
										</div>
									<?php } ?>
								</div>
							</div>
						<?php } ?>

						<div class="col-md-<?php echo esc_attr( $section_item_columns ); ?> col-sm-4">
							<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['services_subtitle'], $fields['services_title'], array( 'bottom' => true ) ) ); ?>
							<?php echo wpautop( wp_kses_post( $fields['services_description'] ) ); ?>
						</div>
					</div>
				<?php } else { ?>
					<div class="row">
						<div class="col-md-12">
							<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['services_subtitle'], $fields['services_title'] ) ); ?>
							<?php echo wpautop( wp_kses_post( $fields['services_description'] ) ); ?>
						</div>
					</div>

					<?php if ( ! empty( $fields['services'] ) ) { ?>
						<div class="row">
							<?php foreach ( $fields['services'] as $key => $service ) { ?>

								<div class="col-md-<?php echo esc_attr( $section_item_columns ); ?> col-xs-6">
									<div class="services-item services-item--<?php echo esc_attr( isset( $service['service_type'] ) ? $service['service_type'] : '' ); ?> services-item--<?php echo esc_attr( isset( $service['service_type_color'] ) ? $service['service_type_color'] : '' ); ?><?php echo( $key <= ( intval( $fields['services_column_group'] ) - 1 ) ? ' -services-item-first' : null ); ?>">
										<?php if ( ! empty( $service['service_icon'] ) ) { ?>
											<i class="<?php echo esc_attr( $service['service_icon'] ); ?>" aria-hidden="true"></i>
										<?php } ?>

										<?php if ( ! empty( $service['service_title'] ) ) { ?>
											<h5><?php echo esc_html( $service['service_title'] ); ?></h5>
										<?php } ?>

										<?php if ( ! empty( $service['service_description'] ) ) { ?>
											<p><?php echo esc_html( $service['service_description'] ); ?></p>
										<?php } ?>
									</div>
								</div>
							<?php } ?>
						</div>
					<?php } ?>
				<?php } ?>

			</div>
		</div>
	</div>
</section>
