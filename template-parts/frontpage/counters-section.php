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
	'values'   => $fields['counters_grouping'],
	'group_by' => 'counter_title',
);
$fields['counters'] = $frontpage->get_repeater_field( $fields['counters_repeater_field'], array(), $grouping );

$attr_helper = new Epsilon_Section_Attr_Helper( $fields, 'counters', Portum_Repeatable_Sections::get_instance() );

$parent_attr = array(
	'id'    => ! empty( $fields['counters_section_unique_id'] ) ? array( $fields['counters_section_unique_id'] ) : array(),
	'class' => array(
		'section-counters',
		'section',
		'ewf-section',
		'ewf-section-' . $fields['counters_section_visibility'],
	),
	'style' => array( 'background-image', 'background-position', 'background-size', 'background-repeat' ),
);

wp_enqueue_script( 'odometer' );
?>

<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>">
	<?php Portum_Helper::generate_css_color_tabs( $section_id, 'counters', $fields ); ?>
	<?php echo wp_kses( Portum_Helper::generate_pencil( 'Portum_Repeatable_Sections', 'counters' ), Epsilon_Helper::allowed_kses_pencil() ); ?>
	<div <?php $attr_helper->generate_attributes( $parent_attr ); ?>>
		<?php
		$attr_helper->generate_color_overlay();
		$attr_helper->generate_video_overlay();

		$span = 12 / absint( $fields['counters_column_group'] );

		$section_item_columns  = 12 / intval( $fields['counters_column_group'] );
		$section_items_content = 12 - $section_item_columns;
		?>

		<div class="ewf-section__content">
			<div class="<?php echo esc_attr( Portum_Helper::container_class( 'counters', $fields ) ); ?>">
				<?php if ( 'left' === $fields['counters_row_title_align'] ) { ?>
					<div class="row">
						<div class="col-md-<?php echo esc_attr( $section_item_columns ); ?> col-sm-4">
							<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['counters_subtitle'], $fields['counters_title'] ) ); ?>
						</div>
						<div class="col-md-<?php echo esc_attr( $section_items_content ); ?> col-sm-8">
							<div class="row">
								<?php foreach ( $fields['counters'] as $key => $counter ) { ?>

									<?php
									$class = 'ewf-counter__standard';
									if ( 'odometer' === $counter['counter_type'] ) {
										$class = 'ewf-counter__odometer odometer';
									}
									?>

									<div class="col-md-<?php echo esc_attr( $section_item_columns ); ?> col-xs-6">
										<div class="ewf-counter">
											<?php
											echo wp_kses( Epsilon_Helper::generate_field_repeater_pencil( $key, 'portum_counters_section', 'portum_counter_boxes' ), Epsilon_Helper::allowed_kses_pencil() );
											?>
											<?php if ( ! empty( $counter['counter_icon'] ) && $counter['counter_icon_display'] ) { ?>
												<div class="ewf-counter__icon">
													<i class="<?php echo esc_attr( $counter['counter_icon'] ); ?>"></i>
												</div>
											<?php } ?>

											<div class="ewf-counter__content">
												<span class="<?php echo esc_attr( $class ); ?>" data-value="<?php echo ! empty( $counter['counter_number'] ) ? esc_attr( $counter['counter_number'] ) : 720; ?>" data-speed="2000"></span>
												<?php if ( ! empty( $counter['counter_symbol'] ) ) { ?>
													<span class="ewf-counter__symbol"><?php echo wp_kses_post( $counter['counter_symbol'] ); ?></span>
												<?php } ?>
												<?php if ( ! empty( $counter['counter_title'] ) ) { ?>
													<h6 class="ewf-counter__title"><?php echo wp_kses_post( $counter['counter_title'] ); ?></h6>
												<?php } ?>
											</div>

										</div><!-- end .ewf-counter -->
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
				<?php } elseif ( 'right' === $fields['counters_row_title_align'] ) { ?>

					<div class="row">
						<div class="col-md-<?php echo esc_attr( $section_items_content ); ?> col-sm-8">
							<div class="row">
								<?php foreach ( $fields['counters'] as $key => $counter ) { ?>

									<?php
									$class = 'ewf-counter__standard';
									if ( 'odometer' === $counter['counter_type'] ) {
										$class = 'ewf-counter__odometer odometer';
									}
									?>

									<div class="col-md-<?php echo esc_attr( $section_item_columns ); ?> col-xs-6">
										<div class="ewf-counter">
											<?php
											echo wp_kses( Epsilon_Helper::generate_field_repeater_pencil( $key, 'portum_counters_section', 'portum_counter_boxes' ), Epsilon_Helper::allowed_kses_pencil() );
											?>
											<?php if ( ! empty( $counter['counter_icon'] ) && $counter['counter_icon_display'] ) { ?>
												<div class="ewf-counter__icon">
													<i class="<?php echo esc_attr( $counter['counter_icon'] ); ?>"></i>
												</div>
											<?php } ?>

											<div class="ewf-counter__content">
												<span class="<?php echo esc_attr( $class ); ?>" data-value="<?php echo ! empty( $counter['counter_number'] ) ? esc_attr( $counter['counter_number'] ) : 720; ?>" data-speed="2000"></span>
												<?php if ( ! empty( $counter['counter_symbol'] ) ) { ?>
													<span class="ewf-counter__symbol"><?php echo wp_kses_post( $counter['counter_symbol'] ); ?></span>
												<?php } ?>
												<?php if ( ! empty( $counter['counter_title'] ) ) { ?>
													<h6 class="ewf-counter__title"><?php echo wp_kses_post( $counter['counter_title'] ); ?></h6>
												<?php } ?>
											</div>

										</div><!-- end .ewf-counter -->
									</div>

								<?php } ?>
							</div>
						</div>

						<div class="col-md-<?php echo esc_attr( $section_item_columns ); ?> col-sm-4">
							<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['counters_subtitle'], $fields['counters_title'], array( 'bottom' => true ) ) ); ?>
						</div>
					</div>

				<?php } else { ?>

					<div class="row">
						<div class="col-md-12">
							<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['counters_subtitle'], $fields['counters_title'] ) ); ?>
						</div>
					</div>

					<div class="row">
						<?php foreach ( $fields['counters'] as $key => $counter ) { ?>

							<?php
							$class = 'ewf-counter__standard';
							if ( 'odometer' === $counter['counter_type'] ) {
								$class = 'ewf-counter__odometer odometer';
							}
							?>

							<div class="col-md-<?php echo esc_attr( $section_item_columns ); ?> col-xs-6">
								<div class="ewf-counter">

									<?php
									echo wp_kses( Epsilon_Helper::generate_field_repeater_pencil( $key, 'portum_counters_section', 'portum_counter_boxes' ), Epsilon_Helper::allowed_kses_pencil() );
									?>
									<?php if ( ! empty( $counter['counter_icon'] ) && $counter['counter_icon_display'] ) { ?>
										<div class="ewf-counter__icon">
											<i class="<?php echo esc_attr( $counter['counter_icon'] ); ?>"></i>
										</div>
									<?php } ?>

									<div class="ewf-counter__content">
										<span class="<?php echo esc_attr( $class ); ?>" data-value="<?php echo ! empty( $counter['counter_number'] ) ? esc_attr( $counter['counter_number'] ) : 720; ?>" data-speed="2000"></span>
										<?php if ( ! empty( $counter['counter_symbol'] ) ) { ?>
											<span class="ewf-counter__symbol"><?php echo wp_kses_post( $counter['counter_symbol'] ); ?></span>
										<?php } ?>
										<?php if ( ! empty( $counter['counter_title'] ) ) { ?>
											<h6 class="ewf-counter__title"><?php echo wp_kses_post( $counter['counter_title'] ); ?></h6>
										<?php } ?>
									</div>

								</div><!-- end .ewf-counter -->
							</div>

						<?php } ?>
					</div>

				<?php } ?>

			</div>
		</div>
	</div>
</section>
