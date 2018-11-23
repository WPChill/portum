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

$attr_helper = new Epsilon_Section_Attr_Helper( $fields, 'cta', Portum_Repeatable_Sections::get_instance() );

if ( empty( $fields['cta_section_unique_id'] ) ) {
	$fields['cta_section_unique_id'] = Portum_Helper::generate_section_id( 'cta' );
}

$parent_attr = array(
	'id'    => array( $fields['cta_section_unique_id'] ),
	'class' => array( 'section-cta', 'section', 'ewf-section', 'ewf-section-' . $fields['cta_section_visibility'] ),
);


/**
 * Layout Stuff
 */
$content_class = '';
$header_class  = '';
$row_class     = '';

if ( 'left' == $fields['cta_row_title_align'] || 'right' == $fields['cta_row_title_align'] ) {
	$content_class = 'col-md-6';
	$header_class  = 'col-md-6';
	if ( 'right' == $fields['cta_row_title_align'] ) {
		$row_class = 'row-flow-reverse';
	}
} else {
	$content_class = 'col-md-12';
	$header_class  = 'col-md-12';
	if ( 'bottom' == $fields['cta_row_title_align'] ) {
		$row_class = 'row-column-reverse';
	}
}
//end layout stuff
?>

<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>" data-customizer-section-string-id="cta">
	<?php Portum_Helper::generate_inline_css( $fields['cta_section_unique_id'], 'cta', $fields ); ?>
	<?php echo wp_kses( Epsilon_Helper::generate_pencil( 'Portum_Repeatable_Sections', 'cta' ), Epsilon_Helper::allowed_kses_pencil() ); ?>
	<div <?php $attr_helper->generate_attributes( $parent_attr ); ?>>
		<?php $attr_helper->generate_color_overlay(); ?>
		<div class="ewf-section__content">
			<div class="<?php echo esc_attr( Portum_Helper::container_class( 'cta', $fields ) ); ?>">

				<div class="row <?php echo esc_attr( $row_class ); ?>">

					<?php if ( ! empty( $fields['cta_description'] ) || ! empty( $fields['cta_title'] ) ) { ?>
						<div class="<?php echo esc_attr( $header_class ); ?>">
							<div class="ewf-section-text">
								<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['cta_description'], $fields['cta_title'] ) ); ?>
							</div><!--/.ewf-section--text-->
						</div><!--/ header class-->
					<?php } ?>

					<?php if ( ! empty( $fields[ 'cta_button_primary_label' ] ) || ! empty( $fields[ 'cta_button_secondary_label' ] ) ) { ?>

						<div class="<?php echo esc_attr( $content_class ); ?>">

							<?php Portum_Helper::render_button( $fields, 'cta_button_primary' ); ?>
							<?php Portum_Helper::render_button( $fields, 'cta_button_secondary' ); ?>

						</div><!-- content class -->
					<?php }//endif button check ?>

				</div><!--/.row-->
			</div><!-- container class -->
		</div><!-- ewf-section__content-->
	</div><!-- attr generator-->
</section>
