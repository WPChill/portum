<?php
/**
 * Template part for displaying a frontpage section
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Portum
 */

$frontpage           = Epsilon_Page_Generator::get_instance( 'portum_frontpage_sections_' . get_the_ID(), get_the_ID() );
$fields              = $frontpage->sections[ $section_id ];
$grouping            = array(
	'values'   => $fields['piecharts_grouping'],
	'group_by' => 'piechart_title',
);
$fields['piecharts'] = $frontpage->get_repeater_field( $fields['piecharts_repeater_field'], array(), $grouping );

$attr_helper = new Epsilon_Section_Attr_Helper( $fields, 'piecharts', Portum_Repeatable_Sections::get_instance() );

$parent_attr = array(
	'id'    => ! empty( $fields['piecharts_section_unique_id'] ) ? array( $fields['piecharts_section_unique_id'] ) : array(),
	'class' => array(
		'section-piecharts',
		'section',
		'ewf-section',
		'ewf-section-' . $fields['piecharts_section_visibility'],
	),
	'style' => array( 'background-image', 'background-position', 'background-size', 'background-repeat' ),
);

wp_enqueue_script( 'easypiechart' );
$color = get_theme_mod( 'epsilon_accent_color', '#cc263d' );
$span  = 12 / absint( $fields['piecharts_column_group'] );
?>

<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>">
	<?php Portum_Helper::generate_css_color_tabs( $section_id, 'piecharts', $fields ); ?>
	<?php echo wp_kses( Portum_Helper::generate_pencil( 'Portum_Repeatable_Sections', 'piecharts' ), Epsilon_Helper::allowed_kses_pencil() ); ?>
	<div <?php $attr_helper->generate_attributes( $parent_attr ); ?>>
		<?php
		$attr_helper->generate_color_overlay();
		$attr_helper->generate_video_overlay();

		$section_item_columns  = 12 / intval( $fields['piecharts_column_group'] );
		$section_items_content = 12 - $section_item_columns;
		?>

		<div class="ewf-section__content">
			<div class="<?php echo esc_attr( Portum_Helper::container_class( 'piecharts', $fields ) ); ?>">

				<?php if ( 'left' === $fields['piecharts_row_title_align'] ) { ?>

					<div class="row">

						<div class="col-md-<?php echo esc_attr( $section_item_columns ); ?>">
							<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['piecharts_subtitle'], $fields['piecharts_title'] ) ); ?>
						</div>

						<div class="col-md-<?php echo $section_items_content; ?>">
							<?php foreach ( $fields['piecharts'] as $key => $piechart ) { ?>
								<div class="col-md-<?php echo esc_attr( $section_item_columns ); ?>">
									<div class="ewf-pie">
										<?php
										echo wp_kses( Epsilon_Helper::generate_field_repeater_pencil( $key, 'portum_piecharts_section', 'portum_pie_charts' ), Epsilon_Helper::allowed_kses_pencil() );
										?>
										<div class="ewf-pie__chart" data-percent="<?php echo ! empty( $piechart['piechart_value'] ) ? esc_attr( $piechart['piechart_value'] ) : 55; ?>" data-barColor="<?php echo esc_attr( $color ); ?>" data-trackColor="#e1e1e1" data-lineWidth="<?php echo ! empty( $piechart['piechart_bar_width'] ) ? esc_attr( $piechart['piechart_bar_width'] ) : 15; ?>" data-barSize="<?php echo ! empty( $piechart['piechart_size'] ) ? esc_attr( $piechart['piechart_size'] ) : 250; ?>" data-lineCap="square">
											<?php if ( 'icon' === $piechart['piechart_type'] ) { ?>
												<div class="ewf-pie__icon">
													<i class="<?php echo esc_attr( $piechart['piechart_icon'] ); ?>"></i>
												</div>
											<?php } else { ?>
												<div class="ewf-pie__percent">
													<span></span>%
												</div>
											<?php } ?>
										</div>
										<?php if ( ! empty( $piechart['piechart_title'] ) ) { ?>
											<h6 class="ewf-pie__title"><?php echo wp_kses_post( $piechart['piechart_title'] ); ?></h6>
										<?php } ?>

										<?php if ( ! empty( $piechart['piechart_text'] ) ) { ?>
											<p class="ewf-pie__description"><?php echo wp_kses_post( $piechart['piechart_text'] ); ?> </p>
										<?php } ?>

									</div><!-- end .ewf-pie -->
								</div>
							<?php } ?>
						</div>

					</div>

				<?php } elseif ( 'right' === $fields['piecharts_row_title_align'] ) { ?>

					<div class="row">

						<div class="col-md-<?php echo esc_attr( $section_items_content ); ?>">
							<?php foreach ( $fields['piecharts'] as $key => $piechart ) { ?>
								<div class="col-md-<?php echo esc_attr( $section_item_columns ); ?>">
									<div class="ewf-pie">
										<?php
										echo wp_kses( Epsilon_Helper::generate_field_repeater_pencil( $key, 'portum_piecharts_section', 'portum_pie_charts' ), Epsilon_Helper::allowed_kses_pencil() );
										?>
										<div class="ewf-pie__chart" data-percent="<?php echo ! empty( $piechart['piechart_value'] ) ? esc_attr( $piechart['piechart_value'] ) : 55; ?>" data-barColor="<?php echo esc_attr( $color ); ?>" data-trackColor="#e1e1e1" data-lineWidth="<?php echo ! empty( $piechart['piechart_bar_width'] ) ? esc_attr( $piechart['piechart_bar_width'] ) : 15; ?>" data-barSize="<?php echo ! empty( $piechart['piechart_size'] ) ? esc_attr( $piechart['piechart_size'] ) : 250; ?>" data-lineCap="square">
											<?php if ( 'icon' === $piechart['piechart_type'] ) { ?>
												<div class="ewf-pie__icon">
													<i class="<?php echo esc_attr( $piechart['piechart_icon'] ); ?>"></i>
												</div>
											<?php } else { ?>
												<div class="ewf-pie__percent">
													<span></span>%
												</div>
											<?php } ?>
										</div>
										<?php if ( ! empty( $piechart['piechart_title'] ) ) { ?>
											<h6 class="ewf-pie__title"><?php echo wp_kses_post( $piechart['piechart_title'] ); ?></h6>
										<?php } ?>

										<?php if ( ! empty( $piechart['piechart_text'] ) ) { ?>
											<p class="ewf-pie__description"><?php echo wp_kses_post( $piechart['piechart_text'] ); ?> </p>
										<?php } ?>

									</div><!-- end .ewf-pie -->
								</div>
							<?php } ?>
						</div>

						<div class="col-md-<?php echo esc_attr( $section_item_columns ); ?>">
							<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['piecharts_subtitle'], $fields['piecharts_title'], array( 'bottom' => true ) ) ); ?>
						</div>
					</div>

				<?php } else { ?>

					<div class="row">
						<div class="col-md-12">
							<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['piecharts_subtitle'], $fields['piecharts_title'] ) ); ?>
						</div>
					</div>

					<div class="row">
						<?php foreach ( $fields['piecharts'] as $key => $piechart ) { ?>
							<div class="col-md-<?php echo esc_attr( $section_item_columns ); ?>">
								<div class="ewf-pie">
									<?php
									echo wp_kses( Epsilon_Helper::generate_field_repeater_pencil( $key, 'portum_piecharts_section', 'portum_pie_charts' ), Epsilon_Helper::allowed_kses_pencil() );
									?>
									<div class="ewf-pie__chart" data-percent="<?php echo ! empty( $piechart['piechart_value'] ) ? esc_attr( $piechart['piechart_value'] ) : 55; ?>" data-barColor="<?php echo esc_attr( $color ); ?>" data-trackColor="#e1e1e1" data-lineWidth="<?php echo ! empty( $piechart['piechart_bar_width'] ) ? esc_attr( $piechart['piechart_bar_width'] ) : 15; ?>" data-barSize="<?php echo ! empty( $piechart['piechart_size'] ) ? esc_attr( $piechart['piechart_size'] ) : 250; ?>" data-lineCap="square">
										<?php if ( 'icon' === $piechart['piechart_type'] ) { ?>
											<div class="ewf-pie__icon">
												<i class="<?php echo esc_attr( $piechart['piechart_icon'] ); ?>"></i>
											</div>
										<?php } else { ?>
											<div class="ewf-pie__percent">
												<span></span>%
											</div>
										<?php } ?>
									</div>
									<?php if ( ! empty( $piechart['piechart_title'] ) ) { ?>
										<h6 class="ewf-pie__title"><?php echo wp_kses_post( $piechart['piechart_title'] ); ?></h6>
									<?php } ?>

									<?php if ( ! empty( $piechart['piechart_text'] ) ) { ?>
										<p class="ewf-pie__description"><?php echo wp_kses_post( $piechart['piechart_text'] ); ?> </p>
									<?php } ?>

								</div><!-- end .ewf-pie -->
							</div>
						<?php } ?>
					</div>

				<?php } ?>

			</div>
		</div>

	</div>
</section>
