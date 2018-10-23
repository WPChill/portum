<?php
/**
 * Template part for displaying a frontpage section
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Portum
 */

if ( ! is_customize_preview() && ! defined( 'EPSILON_FRAMEWORK_PRO_VERSION' ) ) {
	return;
}

$frontpage = Epsilon_Page_Generator::get_instance( 'portum_frontpage_sections_' . get_the_ID(), get_the_ID() );
$fields    = $frontpage->sections[ $section_id ];

$attr_helper = new Epsilon_Section_Attr_Helper( $fields, 'instagram', Portum_Repeatable_Sections::get_instance() );
if ( empty( $fields['instagram_section_unique_id'] ) ) {
	$fields['instagram_section_unique_id'] = Portum_Helper::generate_section_id( 'instagram' );
}

$button_primary = $fields['instagram_button_primary_label'] . $fields['instagram_button_primary_url'];
$parent_attr    = array(
	'id'    => array( $fields['instagram_section_unique_id'] ),
	'class' => array( 'section-instagram', 'section', 'ewf-section', 'ewf-section-' . $fields['instagram_section_visibility'] ),
	'style' => array( 'background-image', 'background-position', 'background-size', 'background-repeat' ),
);
/**
 * Layout Stuff
 */
$content_class = '';
$header_class  = '';
$row_class     = '';

if ( 'left' == $fields['instagram_row_title_align'] || 'right' == $fields['instagram_row_title_align'] ) {
	$content_class = 'col-md-6';
	$header_class  = 'col-md-' . ( $fields['instagram_image'] ? '6' : '12' );
	if ( 'right' == $fields['instagram_row_title_align'] ) {
		$row_class = 'row-flow-reverse';
	}
} else {
	$content_class = 'col-md-12';
	$header_class  = 'col-md-12';
	if ( 'bottom' == $fields['instagram_row_title_align'] ) {
		$row_class = 'row-column-reverse';
	}
}
//end layout stuff
?>
<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>">
	<?php Portum_Helper::generate_inline_css( $fields['instagram_section_unique_id'], 'instagram', $fields ); ?>
	<?php echo Epsilon_Helper::generate_pencil( 'Portum_Repeatable_Sections', 'upsell' ); ?>
	<div <?php $attr_helper->generate_attributes( $parent_attr ); ?>>
		<?php $attr_helper->generate_color_overlay(); ?>
		<div class="upsell-section">
			<div class="ewf-section__content">
				<div class="<?php echo esc_attr( Portum_Helper::container_class( 'instagram', $fields ) ); ?>">

					<div class="row <?php echo esc_attr( $row_class ); ?>">

						<?php if ( ! empty( $fields['instagram_subtitle'] ) || ! empty( $fields['instagram_title'] ) || ! empty( $fields['instagram_text'] ) ) { ?>
							<div class="<?php echo esc_attr( $header_class ); ?>">
								<div class="ewf-section-text">
									<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['instagram_subtitle'], $fields['instagram_title'] ) ); ?>
									<?php echo wpautop( wp_kses_post( $fields['instagram_text'] ) ); ?>
									<?php if ( $button_primary ) { ?>
										<a class="ewf-btn ewf-btn--huge" href="<?php echo esc_url( $fields['instagram_button_primary_url'] ); ?>">
											<?php echo wp_kses_post( $fields['instagram_button_primary_label'] ); ?>
										</a><!--/.ewf-btn-->
									<?php }//endif button_primary ?>
								</div><!--/.ewf-section-text-->
							</div><!--/.col-md-->
						<?php } // end if _subtitle, _title // ?>

						<?php if ( ! empty( $fields['instagram_image'] ) ) { ?>
							<div class="<?php echo esc_attr( $content_class ); ?>">
								<img src="<?php echo esc_url( $fields['instagram_image'] ); ?>" />
							</div><!--/.col-md--6-->
						<?php }//endif !empty ?>

					</div><!--/.row-->
				</div><!--/.container class-->
			</div><!--/.ewf-section--content-->
		</div><!--/.upsell-->
	</div><!--/.attr-helper-->
</section>

