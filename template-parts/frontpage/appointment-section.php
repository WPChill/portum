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

$attr_helper = new Epsilon_Section_Attr_Helper( $fields, 'appointment', Portum_Repeatable_Sections::get_instance() );
$parent_attr = array(
	'id'    => ! empty( $fields['appointment_section_unique_id'] ) ? array( $fields['appointment_section_unique_id'] ) : array(),
	'class' => array(
		'section-appointment',
		'section',
		'ewf-section',
		'ewf-section-' . $fields['appointment_section_visibility'],
	),
	'style' => array( 'background-image', 'background-position', 'background-size', 'background-repeat' ),
);
?>
<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>">
	<?php Portum_Helper::generate_css_color_tabs( $section_id, 'appointment', $fields ); ?>
	<?php echo wp_kses( Portum_Helper::generate_pencil( 'Portum_Repeatable_Sections', 'appointment' ), Epsilon_Helper::allowed_kses_pencil() ); ?>
	<div <?php $attr_helper->generate_attributes( $parent_attr ); ?>>

		<?php
		$attr_helper->generate_color_overlay();
		?>
		<div class="ewf-section__content">
			<div class="<?php echo esc_attr( Portum_Helper::container_class( 'appointment', $fields ) ); ?>">
				<div class="row row-eq-height">
					<?php if ( 'left' === $fields['appointment_row_title_align'] ) { ?>
						<div class="col-sm-5">
							<div class="ewf-section-text">
								<?php if ( ! empty( $fields['appointment_title'] ) ) { ?>
									<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['appointment_title'], $fields['appointment_subtitle'] ) ); ?>
								<?php } ?>

								<?php echo wpautop( wp_kses_post( $fields['appointment_text'] ) ); ?>
							</div><!--/.ewf-section-text-->
						</div><!--/.col-sm-4-->
						<div class="col-sm-7">
							<?php if ( ! empty( $fields['appointment_form'] ) ) { ?>
								<?php echo do_shortcode( '[contact-form-7 id="' . absint( $fields['appointment_form'] ) . '"]' ); ?>
							<?php } ?>
						</div><!--/.col-sm-8-->
					<?php } elseif ( 'right' === $fields['appointment_row_title_align'] ) { ?>
						<div class="col-sm-7">
							<?php if ( ! empty( $fields['appointment_form'] ) ) { ?>
								<?php echo do_shortcode( '[contact-form-7 id="' . absint( $fields['appointment_form'] ) . '"]' ); ?>
							<?php } ?>
						</div><!--/.col-sm-8-->
						<div class="col-sm-5">
							<div class="ewf-section-text">
								<?php if ( ! empty( $fields['appointment_title'] ) ) { ?>
									<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['appointment_title'], $fields['appointment_subtitle'] ) ); ?>
								<?php } ?>

								<?php echo wpautop( wp_kses_post( $fields['appointment_text'] ) ); ?>
							</div><!--/.ewf-section-text-->
						</div><!--/.col-sm-4-->
					<?php } else { ?>
						<div class="col-sm-12">
							<div class="ewf-section-text">
								<?php if ( ! empty( $fields['appointment_title'] ) ) { ?>
									<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['appointment_title'], $fields['appointment_subtitle'] ) ); ?>
								<?php } ?>

								<?php echo wpautop( wp_kses_post( $fields['appointment_text'] ) ); ?>
							</div><!--/.ewf-section-text-->
						</div><!--/.col-sm-4-->
						<div class="col-sm-12">
							<?php if ( ! empty( $fields['appointment_form'] ) ) { ?>
								<?php echo do_shortcode( '[contact-form-7 id="' . absint( $fields['appointment_form'] ) . '"]' ); ?>
							<?php } ?>
						</div><!--/.col-sm-8-->
					<?php } ?>
				</div>
			</div>
		</div>
</section>
