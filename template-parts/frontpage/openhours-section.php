<?php
/**
 * Template part for displaying a frontpage section
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package portum
 */
$frontpage           = Epsilon_Page_Generator::get_instance( 'portum_frontpage_sections_' . get_the_ID(), get_the_ID() );
$fields              = $frontpage->sections[ $section_id ];
$grouping            = array(
	'values'   => $fields['openhours_grouping'],
	'group_by' => 'schedule_days',
);
$fields['openhours'] = $frontpage->get_repeater_field( $fields['openhours_repeater_field'], array(), $grouping );

$attr_helper = new Epsilon_Section_Attr_Helper( $fields, 'openhours', Portum_Repeatable_Sections::get_instance() );
$parent_attr = array(
	'id'    => ! empty( $fields['openhours_section_unique_id'] ) ? array( $fields['openhours_section_unique_id'] ) : array(),
	'class' => array(
		'section-openhours',
		'section',
		'ewf-section',
		'ewf-section-' . $fields['openhours_section_visibility'],
	),
	'style' => array( 'background-image', 'background-position', 'background-size', 'background-repeat' ),
);

$button_primary = $fields['openhours_button_primary_label'] . $fields['openhours_button_primary_url'];

?>

<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>">
	<?php Portum_Helper::generate_css_color_tabs( $section_id, 'openhours', $fields ); ?>
	<?php echo wp_kses( Portum_Helper::generate_pencil( 'Portum_Repeatable_Sections', 'openhours' ), Epsilon_Helper::allowed_kses_pencil() ); ?>
	<div <?php $attr_helper->generate_attributes( $parent_attr ); ?>>

		<?php
		$attr_helper->generate_color_overlay();
		?>
		<div class="ewf-section__content">
			<div class="<?php echo esc_attr( Portum_Helper::container_class( 'openhours', $fields ) ); ?>">

				<div class="row row-eq-height">

					<?php if ( 'left' === $fields['openhours_row_title_align'] ) { ?>
						<div class="col-sm-7">
							<div class="open-hours-section-info">
								<div class="ewf-section-text">
									<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['openhours_title'], $fields['openhours_subtitle'], array( 'center' => false ) ) ); ?>
									<?php echo wpautop( wp_kses_post( $fields['openhours_text'] ) ); ?>
								</div>
								<?php if ( $button_primary ) { ?>
									<a class="ewf-btn ewf-btn--huge <?php echo esc_attr( isset( $fields['openhours_button_primary_color'] ) ? $fields['openhours_button_primary_color'] : '' ); ?>" href="<?php echo esc_url( $fields['openhours_button_primary_url'] ); ?>"><?php echo wp_kses_post( $fields['openhours_button_primary_label'] ); ?></a>
								<?php }; ?>
							</div>

						</div><!--/.col-sm-7-->
						<?php if ( ! empty( $fields['openhours'] ) ) { ?>
							<div class="col-sm-5">
								<div class="open-hours" style="background-color: <?php echo esc_attr( $fields['openhours_color'] ); ?>">

									<div class="ewf-like-h4 open-hours__heading"><?php echo wp_kses_post( $fields['openhours_schedule_title'] ); ?></div>

									<?php foreach ( $fields['openhours'] as $key => $schedule ) { ?>
										<div class="open-hours__schedule__container">
											<?php
											echo wp_kses( Epsilon_Helper::generate_field_repeater_pencil( $key, 'portum_schedule_section', 'portum_schedule' ), Epsilon_Helper::allowed_kses_pencil() );
											?>
											<p class="open-hours__schedule_days text-uppercase"><?php echo wp_kses_post( $schedule['schedule_days'] ); ?></p>
											<p class="open_hours__schedule_hours"><?php echo wp_kses_post( $schedule['schedule_hours'] ); ?></p>
										</div>
									<?php } ?>
								</div><!--/.open-hours-->
							</div><!--/.col-sm-5-->
						<?php } ?>
					<?php } elseif ( 'right' === $fields['openhours_row_title_align'] ) { ?>
						<?php if ( ! empty( $fields['openhours'] ) ) { ?>
							<div class="col-sm-5">
								<div class="open-hours" style="background-color: <?php echo esc_attr( $fields['openhours_color'] ); ?>">

									<div class="ewf-like-h4 open-hours__heading"><?php echo wp_kses_post( $fields['openhours_schedule_title'] ); ?></div>

									<?php foreach ( $fields['openhours'] as $key => $schedule ) { ?>
										<div class="open-hours__schedule__container">
											<?php
											echo wp_kses( Epsilon_Helper::generate_field_repeater_pencil( $key, 'portum_schedule_section', 'portum_schedule' ), Epsilon_Helper::allowed_kses_pencil() );
											?>
											<p class="open-hours__schedule_days text-uppercase"><?php echo wp_kses_post( $schedule['schedule_days'] ); ?></p>
											<p class="open_hours__schedule_hours"><?php echo wp_kses_post( $schedule['schedule_hours'] ); ?></p>
										</div>
									<?php } ?>
								</div><!--/.open-hours-->
							</div><!--/.col-sm-5-->
						<?php } ?>
						<div class="col-sm-7">
							<div class="open-hours-section-info">
								<div class="ewf-section-text">
									<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['openhours_title'], $fields['openhours_subtitle'], array( 'center' => false ) ) ); ?>
									<?php echo wpautop( wp_kses_post( $fields['openhours_text'] ) ); ?>
								</div>
								<?php if ( $button_primary ) { ?>
									<a class="ewf-btn ewf-btn--huge <?php echo esc_attr( isset( $fields['openhours_button_primary_color'] ) ? $fields['openhours_button_primary_color'] : '' ); ?>" href="<?php echo esc_url( $fields['openhours_button_primary_url'] ); ?>"><?php echo wp_kses_post( $fields['openhours_button_primary_label'] ); ?></a>
								<?php }; ?>
							</div>

						</div><!--/.col-sm-7-->
					<?php } else { ?>
						<?php if ( ! empty( $fields['openhours'] ) ) { ?>

							<div class="col-sm-12">
								<div class="open-hours" style="background-color: <?php echo esc_attr( $fields['openhours_color'] ); ?>">

									<div class="ewf-like-h4 open-hours__heading"><?php echo wp_kses_post( $fields['openhours_schedule_title'] ); ?></div>

									<?php foreach ( $fields['openhours'] as $key => $schedule ) { ?>
										<div class="open-hours__schedule__container">
											<?php
											echo wp_kses( Epsilon_Helper::generate_field_repeater_pencil( $key, 'portum_schedule_section', 'portum_schedule' ), Epsilon_Helper::allowed_kses_pencil() );
											?>
											<p class="open-hours__schedule_days text-uppercase"><?php echo wp_kses_post( $schedule['schedule_days'] ); ?></p>
											<p class="open_hours__schedule_hours"><?php echo wp_kses_post( $schedule['schedule_hours'] ); ?></p>
										</div>
									<?php } ?>

								</div><!--/.open-hours-->
							</div><!--/.col-sm-12-->
						<?php } ?>

						<div class="col-sm-12">
							<div class="open-hours-section-info">
								<div class="ewf-section-text">
									<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['openhours_title'], $fields['openhours_subtitle'], array( 'center' => false ) ) ); ?>
									<?php echo wpautop( wp_kses_post( $fields['openhours_text'] ) ); ?>
								</div>
								<?php if ( $button_primary ) { ?>
									<a class="ewf-btn ewf-btn--huge <?php echo esc_attr( isset( $fields['openhours_button_primary_color'] ) ? $fields['openhours_button_primary_color'] : '' ); ?>" href="<?php echo esc_url( $fields['openhours_button_primary_url'] ); ?>"><?php echo wp_kses_post( $fields['openhours_button_primary_label'] ); ?></a>
								<?php }; ?>
							</div>

						</div><!--/.col-sm-12-->
					<?php } ?>

				</div><!--/.row-eq-height-->
			</div><!--/.-ewf-section__content-->
</section>
