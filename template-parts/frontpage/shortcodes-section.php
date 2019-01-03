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

$class = array(
	'boxedin'     => 'container',
	'boxedcenter' => 'container',
	'fullwidth'   => 'container-fluid',
);

$attr_helper = new Epsilon_Section_Attr_Helper( $fields, 'shortcodes', Portum_Repeatable_Sections::get_instance() );
if ( empty( $fields['shortcodes_section_unique_id'] ) ) {
	$fields['shortcodes_section_unique_id'] = Portum_Helper::generate_section_id( 'shortcodes' );
}

$parent_attr = array(
	'id'    => array( $fields['shortcodes_section_unique_id'] ),
	'class' => array(
		'section-shortcodes',
		'section',
		'ewf-section',
		'ewf-section-' . $fields['shortcodes_section_visibility'],
	),
);

?>

<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>" data-customizer-section-string-id="shortcodes">
	<?php Portum_Helper::generate_inline_css( $fields['shortcodes_section_unique_id'], 'shortcodes', $fields ); ?>
	<?php echo wp_kses( Epsilon_Helper::generate_pencil( 'Portum_Repeatable_Sections', 'shortcodes' ), Epsilon_Helper::allowed_kses_pencil() ); ?>
	<div <?php $attr_helper->generate_attributes( $parent_attr ); ?>>
		<?php $attr_helper->generate_color_overlay(); ?>
		<div class="ewf-section__content">
			<div class="<?php echo esc_attr( Portum_Helper::container_class( 'shortcodes', $fields ) ); ?>">
				<div class="row">

					<?php if ( 'right' === $fields['shortcodes_row_title_align'] ) { ?>
						<div class="col-md-6">
							<?php echo do_shortcode( $fields['shortcodes_field'] ); ?>
						</div>
						<div class="col-md-6">
							<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['shortcodes_subtitle'], $fields['shortcodes_title'], array( 'bottom' => true ) ) ); ?>
							<?php echo wpautop( wp_kses_post( $fields['shortcodes_text'] ) ); ?>
						</div>

					<?php } elseif ( 'left' === $fields['shortcodes_row_title_align'] ) { ?>

						<div class="col-md-6">
							<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['shortcodes_subtitle'], $fields['shortcodes_title'] ) ); ?>
							<?php echo wpautop( wp_kses_post( $fields['shortcodes_text'] ) ); ?>
						</div>
						<div class="col-md-6">
							<?php echo do_shortcode( $fields['shortcodes_field'] ); ?>
						</div>

					<?php } else { ?>

						<div class="col-sm-12">
							<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['shortcodes_subtitle'], $fields['shortcodes_title'] ) ); ?>
							<?php echo wpautop( wp_kses_post( $fields['shortcodes_text'] ) ); ?>
							<?php echo do_shortcode( $fields['shortcodes_field'] ); ?>
						</div>

					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</section>
