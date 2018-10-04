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
?>
<style>
	.upsell-section::before {
		position: absolute;
		top: 15px;
		left: 15px;
		width: 300px;
		content: 'Only in Pro';
		color: #fff;
		background-color: red;
		text-align: center;
	}
</style>

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

$button_primary = $fields['about_button_primary_label'] . $fields['about_button_primary_url'];
$parent_attr    = array(
	'id'    => ! empty( $fields['about_section_unique_id'] ) ? array( $fields['about_section_unique_id'] ) : array(),
	'class' => array( 'section-about', 'section', 'ewf-section', 'ewf-section-' . $fields['about_section_visibility'] ),
	'style' => array( 'background-image', 'background-position', 'background-size', 'background-repeat' ),
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
<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>">
	<?php //Portum_Helper::generate_inline_css( $section_id, 'about', $fields ); ?>
	<?php echo Epsilon_Helper::generate_pencil( 'Portum_Repeatable_Sections', 'upsell' ); ?>
	<div <?php $attr_helper->generate_attributes( $parent_attr ); ?>>
		<?php $attr_helper->generate_color_overlay(); ?>
		<div class="upsell-section" style="position:relative">
			<div class="ewf-section__content">
				<div class="<?php echo esc_attr( Portum_Helper::container_class( 'about', $fields ) ); ?>">

					<div class="row <?php echo esc_attr( $row_class ); ?>">

						<?php if ( ! empty( $fields['about_subtitle'] ) || ! empty( $fields['about_title'] ) || ! empty( $fields['about_text'] ) ) { ?>
							<div class="<?php echo esc_attr( $header_class ); ?>">
								<div class="ewf-section-text">
									<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['about_subtitle'], $fields['about_title'] ) ); ?>
									<?php echo wpautop( wp_kses_post( $fields['about_text'] ) ); ?>
									<?php if ( $button_primary ) { ?>
										<a class="ewf-btn ewf-btn--huge" href="<?php echo esc_url( $fields['about_button_primary_url'] ); ?>">
											<?php echo wp_kses_post( $fields['about_button_primary_label'] ); ?>
										</a><!--/.ewf-btn-->
									<?php }//endif button_primary ?>
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
		</div><!--/.upsell-->
	</div><!--/.attr-helper-->
</section>
