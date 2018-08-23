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

$attr_helper = new Epsilon_Section_Attr_Helper( $fields, 'contact', Portum_Repeatable_Sections::get_instance() );
$parent_attr = array(
	'id'    => ! empty( $fields['contact_section_unique_id'] ) ? array( $fields['contact_section_unique_id'] ) : array(),
	'class' => array(
		'section-contact',
		'section',
		'ewf-section',
		'ewf-section-' . $fields['contact_section_visibility'],
	),
	'style' => array( 'background-image', 'background-position', 'background-size', 'background-repeat' ),
);
?>
<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>">
	<?php Portum_Helper::generate_inline_css( $section_id, 'contact', $fields ); ?>
	<?php echo wp_kses( Portum_Helper::generate_pencil( 'Portum_Repeatable_Sections', 'contact' ), Epsilon_Helper::allowed_kses_pencil() ); ?>
	<div <?php $attr_helper->generate_attributes( $parent_attr ); ?>>

		<?php
		$attr_helper->generate_color_overlay();
		?>
		<div class="ewf-section__content">
			<div class="<?php echo esc_attr( Portum_Helper::container_class( 'contact', $fields ) ); ?>">
				<div class="row row-eq-height">
					<?php if ( 'left' === $fields['contact_row_title_align'] ) { ?>
						<div class="col-sm-5">
							<div class="ewf-section-text">
								<?php if ( ! empty( $fields['contact_title'] ) ) { ?>
									<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['contact_title'], $fields['contact_subtitle'] ) ); ?>
								<?php } ?>

								<?php echo wpautop( wp_kses_post( $fields['contact_text'] ) ); ?>
							</div><!--/.ewf-section-text-->
						</div><!--/.col-sm-4-->
						<div class="col-sm-7">
							<?php if ( ! empty( $fields['contact_form'] ) ) { ?>
								<?php echo do_shortcode( '[contact-form-7 id="' . absint( $fields['contact_form'] ) . '"]' ); ?>
							<?php } ?>
						</div><!--/.col-sm-8-->
					<?php } elseif ( 'right' === $fields['contact_row_title_align'] ) { ?>
						<div class="col-sm-7">
							<?php if ( ! empty( $fields['contact_form'] ) ) { ?>
								<?php echo do_shortcode( '[contact-form-7 id="' . absint( $fields['contact_form'] ) . '"]' ); ?>
							<?php } ?>
						</div><!--/.col-sm-8-->
						<div class="col-sm-5">
							<div class="ewf-section-text">
								<?php if ( ! empty( $fields['contact_title'] ) ) { ?>
									<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['contact_title'], $fields['contact_subtitle'] ) ); ?>
								<?php } ?>

								<?php echo wpautop( wp_kses_post( $fields['contact_text'] ) ); ?>
							</div><!--/.ewf-section-text-->
						</div><!--/.col-sm-4-->
					<?php } else { ?>
						<div class="col-sm-12">
							<div class="ewf-section-text">
								<?php if ( ! empty( $fields['contact_title'] ) ) { ?>
									<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['contact_title'], $fields['contact_subtitle'] ) ); ?>
								<?php } ?>

								<?php echo wpautop( wp_kses_post( $fields['contact_text'] ) ); ?>
							</div><!--/.ewf-section-text-->
						</div><!--/.col-sm-4-->
						<div class="col-sm-12">
							<?php if ( ! empty( $fields['contact_form'] ) ) { ?>
								<?php echo do_shortcode( '[contact-form-7 id="' . absint( $fields['contact_form'] ) . '"]' ); ?>
							<?php } ?>
						</div><!--/.col-sm-8-->
					<?php } ?>
				</div>
			</div>
		</div>
</section>
