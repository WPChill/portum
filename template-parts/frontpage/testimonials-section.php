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
	'values'   => $fields['testimonials_grouping'],
	'group_by' => 'testimonial_title',
);

$attr_helper = new Epsilon_Section_Attr_Helper( $fields, 'testimonials', Portum_Repeatable_Sections::get_instance() );

$fields['testimonials'] = $frontpage->get_repeater_field( $fields['testimonials_repeater_field'], array(), $grouping );

$parent_attr = array(
	'id'    => ! empty( $fields['testimonials_section_unique_id'] ) ? array( $fields['testimonials_section_unique_id'] ) : array(),
	'class' => array(
		'section-testimonials',
		'section',
		'ewf-section',
		'ewf-section-' . $fields['testimonials_section_visibility'],
	),
	'style' => array( 'background-image', 'background-position', 'background-size', 'background-repeat' ),
);

$span = 12 / absint( $fields['testimonials_column_group'] );
?>

<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>">
	<?php //Portum_Helper::generate_inline_css( $section_id, 'testimonials', $fields ); ?>
	<?php echo wp_kses( Epsilon_Helper::generate_pencil( 'Portum_Repeatable_Sections', 'testimonials' ), Epsilon_Helper::allowed_kses_pencil() ); ?>
	<div <?php $attr_helper->generate_attributes( $parent_attr ); ?>>
		<?php
		$attr_helper->generate_color_overlay();
		?>

		<div class="ewf-section__content">
			<div class="<?php echo esc_attr( Portum_Helper::container_class( 'testimonials', $fields ) ); ?>">

				<div class="row">
					<div class="ewf-section-text">
						<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['testimonials_subtitle'], $fields['testimonials_title'] ) ); ?>
					</div>
				</div>

				<?php if ( ! empty( $fields['testimonials'] ) ) { ?>
					<div class="row">
						<?php
						foreach ( $fields['testimonials'] as $key => $v ) {
							$bg_color = 'background-color: ' . ( ! empty( $v['testimonial_bg_color'] ) ? esc_attr( $v['testimonial_bg_color'] ) : 'transparent' ) . ';';

							?>

							<div class="col-md-<?php echo esc_attr( $span ); ?>">
								<div class="testimonial ewf-item__no-effect" style="<?php echo esc_attr( $bg_color ); ?>">
									<?php
									echo wp_kses( Epsilon_Helper::generate_field_repeater_pencil( $key, 'portum_testimonials_section', 'portum_testimonials' ), Epsilon_Helper::allowed_kses_pencil() );
									?>


									<?php if ( ! empty( $v['testimonial_image'] ) ) { ?>
										<div class="ewf-testimonial__thumbnail">
											<img src="<?php echo esc_url( $v['testimonial_image'] ); ?>" />
										</div>
									<?php } ?>


									<?php if ( ! empty( $v['testimonial_title'] ) ) { ?>
										<div class="ewf-testimonial__title">
											<div class="ewf-like-h5">
												<?php echo wp_kses_post( $v['testimonial_title'] ); ?>
											</div>
										</div>
									<?php } ?>


									<?php if ( ! empty( $v['testimonial_text'] ) ) { ?>
										<div class="ewf-testimonial__content">
											<?php echo wp_kses_post( wpautop( $v['testimonial_text'] ) ); ?>
										</div>
									<?php } ?>

									<?php if ( ! empty( $v['testimonial_subtitle'] ) ) { ?>
										<div class="ewf-testimonial__by">
											<?php echo wp_kses_post( $v['testimonial_subtitle'] ); ?>
										</div>
									<?php } ?>
								</div>
							</div>

						<?php } ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</section>
