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
if ( empty( $fields['contact_section_unique_id'] ) ) {
	$fields['contact_section_unique_id'] = Portum_Helper::generate_section_id( 'contact' );
}
$parent_attr = array(
	'id'    => ! empty( $fields['contact_section_unique_id'] ) ? array( $fields['contact_section_unique_id'] ) : array(),
	'class' => array(
		'section-contact',
		'section',
		'ewf-section',
		'ewf-section-' . $fields['contact_section_visibility'],
	),
);

/**
 * Layout Stuff
 */
$content_class = '';
$header_class  = '';
$row_class     = '';

if ( 'left' == $fields['contact_row_title_align'] || 'right' == $fields['contact_row_title_align'] ) {
	$content_class = 'col-md-6';
	$header_class  = 'col-md-6';
	if ( 'right' == $fields['contact_row_title_align'] ) {
		$row_class = 'row-flow-reverse';
	}
} else {
	$content_class = 'col-md-6';
	$header_class  = 'col-md-12';
	if ( 'bottom' == $fields['contact_row_title_align'] ) {
		$row_class = 'row-column-reverse';
	}
}
//end layout stuff
?>
<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>" data-customizer-section-string-id="contact">
	<?php Portum_Helper::generate_inline_css( $fields['contact_section_unique_id'], 'contact', $fields ); ?>
	<?php echo wp_kses( Epsilon_Helper::generate_pencil( 'Portum_Repeatable_Sections', 'contact' ), Epsilon_Helper::allowed_kses_pencil() ); ?>
	<div <?php $attr_helper->generate_attributes( $parent_attr ); ?>>
		<?php $attr_helper->generate_color_overlay(); ?>
		<div class="ewf-section__content">
			<div class="<?php echo esc_attr( Portum_Helper::container_class( 'contact', $fields ) ); ?>">
				<div class="row <?php echo esc_attr( $row_class ); ?>">

					<?php if ( ! empty( $fields['contact_title'] ) || ! empty( $fields['contact_subtitle'] ) ) { ?>
						<div class="<?php echo esc_attr( $header_class ); ?>">
							<div class="ewf-section-text">
								<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['contact_title'], $fields['contact_subtitle'] ) ); ?>
								<?php echo wpautop( wp_kses_post( $fields['contact_text'] ) ); ?>
							</div><!--/.ewf-section-text-->
						</div><!--/header class-->
					<?php }//endif ?>

					<div class="<?php echo esc_attr( $content_class ); ?>">
						<?php if ( ! empty( $fields['contact_form'] ) ) { ?>
							<?php echo do_shortcode( '[contact-form-7 id="' . absint( $fields['contact_form'] ) . '"]' ); ?>
						<?php } ?>
					</div><!--/.content class-->

				</div><!--/.row-->
			</div><!--/.ewf-section__content-->
		</div><!-- generate attr-->
</section>
