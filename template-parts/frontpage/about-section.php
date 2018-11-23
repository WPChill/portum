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
$attr_helper = new Epsilon_Section_Attr_Helper( $fields, 'about', Portum_Repeatable_Sections::get_instance() );

if ( empty( $fields['about_section_unique_id'] ) ) {
	$fields['about_section_unique_id'] = Portum_Helper::generate_section_id( 'about' );
}
$parent_attr    = array(
	'id'    => array( $fields['about_section_unique_id'] ),
	'class' => array( 'section-about', 'section', 'ewf-section', 'ewf-section-' . $fields['about_section_visibility'] ),
);

/**
 * Layout Stuff
 */
$content_class = '';
$header_class  = '';
$row_class     = '';

if ( 'left' == $fields['about_row_title_align'] || 'right' == $fields['about_row_title_align'] ) {
	$content_class = 'col-md-6';
	$header_class  = 'col-md-' . ( $fields['about_image'] ? '6' : '12' );
	if ( 'right' == $fields['about_row_title_align'] ) {
		$row_class = 'row-flow-reverse';
	}
} else {
	$content_class = 'col-md-12';
	$header_class  = 'col-md-12';
	if ( 'bottom' == $fields['about_row_title_align'] ) {
		$row_class = 'row-column-reverse';
	}
}

//end layout stuff
?>
<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>" data-customizer-section-string-id="about">
	<?php Portum_Helper::generate_inline_css( $fields['about_section_unique_id'], 'about', $fields ); ?>
	<?php echo wp_kses( Epsilon_Helper::generate_pencil( 'Portum_Repeatable_Sections', 'about' ), Epsilon_Helper::allowed_kses_pencil() ); ?>
	<div <?php $attr_helper->generate_attributes( $parent_attr ); ?>>
		<?php $attr_helper->generate_color_overlay(); ?>
		<div class="ewf-section__content">
			<div class="<?php echo esc_attr( Portum_Helper::container_class( 'about', $fields ) ); ?>">

				<div class="row <?php echo esc_attr( $row_class ); ?>">

					<?php if ( ! empty( $fields['about_subtitle'] ) || ! empty( $fields['about_title'] ) || ! empty( $fields['about_text'] ) ) { ?>
						<div class="<?php echo esc_attr( $header_class ); ?>">
							<div class="ewf-section-text">
								<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['about_subtitle'], $fields['about_title'] ) ); ?>
								<?php echo wpautop( wp_kses_post( $fields['about_text'] ) ); ?>
								<?php Portum_Helper::render_button( $fields, 'about_button_primary' ); ?>
							</div><!--/.ewf-section-text-->
						</div><!--/.col-md-->
					<?php } // end if _subtitle, _title // ?>

					<?php if ( ! empty( $fields['about_image'] ) ) { ?>
						<div class="<?php echo esc_attr( $content_class ); ?>">
							<img src="<?php echo esc_url( $fields['about_image'] ); ?>" />
						</div><!--/.col-md--6-->
					<?php }//endif !empty ?>

				</div><!--/.row-->
			</div><!--/.container class-->
		</div><!--/.ewf-section--content-->
	</div><!--/.attr-helper-->
</section>
