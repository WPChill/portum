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
$attr_helper = new Epsilon_Section_Attr_Helper( $fields, 'html', Portum_Repeatable_Sections::get_instance() );

if ( empty( $fields['html_section_unique_id'] ) ) {
	$fields['html_section_unique_id'] = Portum_Helper::generate_section_id( 'html' );
}
$parent_attr    = array(
	'id'    => array( $fields['html_section_unique_id'] ),
	'class' => array( 'section-html', 'section', 'ewf-section', 'ewf-section-' . $fields['html_section_visibility'] ),
);

/**
 * Layout Stuff
 */
$content_class = '';
$header_class  = 'col-md-12';
$row_class     = '';

if ( 'left' == $fields['html_row_title_align'] || 'right' == $fields['html_row_title_align'] ) {
	if ( 'right' == $fields['html_row_title_align'] ) {
		$row_class = 'row-flow-reverse';
	}
} else {
	if ( 'bottom' == $fields['html_row_title_align'] ) {
		$row_class = 'row-column-reverse';
	}
}

//end layout stuff
?>
<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>" data-customizer-section-string-id="html">
	<?php Portum_Helper::generate_inline_css( $fields['html_section_unique_id'], 'html', $fields ); ?>
	<?php echo wp_kses( Epsilon_Helper::generate_pencil( 'Portum_Repeatable_Sections', 'html' ), Epsilon_Helper::allowed_kses_pencil() ); ?>
	<div <?php $attr_helper->generate_attributes( $parent_attr ); ?>>
		<?php $attr_helper->generate_color_overlay(); ?>
		<div class="ewf-section__content">
			<div class="<?php echo esc_attr( Portum_Helper::container_class( 'html', $fields ) ); ?>">

				<div class="row <?php echo esc_attr( $row_class ); ?>">

					<?php if ( ! empty( $fields['html_subtitle'] ) || ! empty( $fields['html_title'] ) || ! empty( $fields['html_code'] ) ) { ?>
						<div class="<?php echo esc_attr( $header_class ); ?>">
							<div class="ewf-section-text">
								<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['html_subtitle'], $fields['html_title'] ) ); ?>
								<?php echo wp_kses_post( $fields['html_code'] ); ?>
								<style><?php echo wp_kses_post( preg_replace('/\s+/', '', $fields['html_code_css'])); ?></style>
							</div><!--/.ewf-section-text-->
						</div><!--/.col-md-->
					<?php } // end if _subtitle, _title // ?>

				</div><!--/.row-->
			</div><!--/.container class-->
		</div><!--/.ewf-section--content-->
	</div><!--/.attr-helper-->
</section>
