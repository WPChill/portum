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
if ( empty( $fields['openhours_section_unique_id'] ) ) {
	$fields['openhours_section_unique_id'] = Portum_Helper::generate_section_id( 'openhours' );
}

$parent_attr = array(
	'id'    => array( $fields['openhours_section_unique_id'] ),
	'class' => array(
		'section-openhours',
		'section',
		'ewf-section',
		'ewf-section-' . $fields['openhours_section_visibility'],
	),
);

$button_primary = $fields['openhours_button_primary_label'] . $fields['openhours_button_primary_url'];


/**
 * Layout stuff
 */
$content_class = '';
$header_class  = '';
$row_class     = '';


if ( 'left' == $fields['openhours_row_title_align'] || 'right' == $fields['openhours_row_title_align'] ) {
	$content_class = 'col-sm-8 ewf-content__wrap';
	$header_class  = 'col-sm-4';
	if ( 'right' == $fields['openhours_row_title_align'] ) {
		$row_class = 'row-flow-reverse';
	}
} else {
	$content_class = 'col-sm-12 ewf-content__wrap';
	$header_class  = 'col-sm-12';
	if ( 'bottom' == $fields['openhours_row_title_align'] ) {
		$row_class = 'row-column-reverse';
	}
}

// end layout stuff
?>

<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>" data-customizer-section-string-id="openhours">
	<?php Portum_Helper::generate_inline_css( $fields['openhours_section_unique_id'], 'openhours', $fields ); ?>
	<?php echo wp_kses( Epsilon_Helper::generate_pencil( 'Portum_Repeatable_Sections', 'openhours' ), Epsilon_Helper::allowed_kses_pencil() ); ?>
	<div <?php $attr_helper->generate_attributes( $parent_attr ); ?>>
		<?php $attr_helper->generate_color_overlay(); ?>
		<div class="ewf-section__content">
			<div class="<?php echo esc_attr( Portum_Helper::container_class( 'openhours', $fields ) ); ?>">

				<div class="row <?php echo esc_attr( $row_class ); ?>">

					<?php if ( ! empty( $fields['openhours_title'] ) || ! empty( $fields['openhours_subtitle'] ) ) { ?>
						<div class="<?php echo esc_attr( $header_class ); ?>">
							<div class="open-hours-section-info">
								<div class="ewf-section-text">
									<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['openhours_title'], $fields['openhours_subtitle'], array( 'center' => false ) ) ); ?>
									<?php echo wpautop( wp_kses_post( $fields['openhours_text'] ) ); ?>
								</div><!--/.ewf-section-text-->

								<?php Portum_Helper::render_button( $fields, 'openhours_button_primary' ); ?>

							</div><!--/.open-hours-section-info-->
						</div><!-- header class -->
					<?php } ?>

					<?php if ( ! empty( $fields['openhours'] ) ) { ?>
						<div class="<?php echo esc_attr( $content_class ); ?>">
							<div class="open-hours" style="background-color: <?php echo esc_attr( $fields['openhours_color'] ); ?>">

								<?php if ( ! empty( $fields['openhours_schedule_title'] ) ) { ?>
									<div class="ewf-like-h4 open-hours__heading">
										<?php echo wp_kses_post( $fields['openhours_schedule_title'] ); ?>
									</div><!--/.ewf-like-h4 open-hours__heading-->
								<?php } ?>

								<?php foreach ( $fields['openhours'] as $key => $schedule ) { ?>
									<div class="open-hours__schedule__container">
										<?php
										echo wp_kses( Epsilon_Helper::generate_field_repeater_pencil( $key, 'portum_schedule_section', 'portum_schedule' ), Epsilon_Helper::allowed_kses_pencil() );
										?>
										<p class="open-hours__schedule_days text-uppercase">
											<?php echo wp_kses_post( $schedule['schedule_days'] ); ?>
										</p><!--/.open-hours__schedule_days text-uppercase-->
										<p class="open_hours__schedule_hours">
											<?php echo wp_kses_post( $schedule['schedule_hours'] ); ?>
										</p><!--/.open_hours__schedule_hours-->
									</div><!--/.open-hours__schedule__container-->
								<?php } ?>
							</div><!--/.open-hours-->
						</div><!--/.col-sm-5-->
					<?php } ?>
				</div><!--/.row-eq-height-->
		</div><!--/.-ewf-section__content-->
	</div>
</section>
