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

$attr_helper = new Epsilon_Section_Attr_Helper( $fields, 'newsletter', Portum_Repeatable_Sections::get_instance() );

if ( empty( $fields['newsletter_section_unique_id'] ) ) {
	$fields['newsletter_section_unique_id'] = Portum_Helper::generate_section_id( 'newsletter' );
}
$parent_attr    = array(
	'id'    => array( $fields['newsletter_section_unique_id'] ),
	'class' => array( 'section-newsletter', 'section', 'ewf-section', 'ewf-section-' . $fields['newsletter_section_visibility'] ),
);

/**
 * Layout Stuff
 */
$content_class = '';
$header_class  = '';
$row_class     = '';

if ( 'left' == $fields['newsletter_row_title_align'] || 'right' == $fields['newsletter_row_title_align'] ) {
	$content_class = 'col-md-6';
	$header_class  = 'col-md-6';
	if ( 'right' == $fields['newsletter_row_title_align'] ) {
		$row_class = 'row-flow-reverse';
	}
} else {
	$content_class = 'col-md-12';
	$header_class  = 'col-md-12';
	if ( 'bottom' == $fields['newsletter_row_title_align'] ) {
		$row_class = 'row-column-reverse';
	}
}

//end layout stuff

?>

<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>">
	<?php Portum_Helper::generate_inline_css( $fields['newsletter_section_unique_id'], 'newsletter', $fields ); ?>
	<?php echo wp_kses( Epsilon_Helper::generate_pencil( 'Portum_Repeatable_Sections', 'newsletter' ), Epsilon_Helper::allowed_kses_pencil() ); ?>
	<div <?php $attr_helper->generate_attributes( $parent_attr ); ?>>
		<?php $attr_helper->generate_color_overlay(); ?>
		<div class="ewf-section__content">
			<div class="<?php echo esc_attr( Portum_Helper::container_class( 'newsletter', $fields ) ); ?>">

				<div class="row <?php echo esc_attr( $row_class ); ?>">

					<?php if ( ! empty( $fields['newsletter_subtitle'] ) || ! empty( $fields['newsletter_title'] ) ) { ?>
						<div class="<?php echo esc_attr( $header_class ); ?>">
							<div class="ewf-section-text">
								<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['newsletter_subtitle'], $fields['newsletter_title'] ) ); ?>
							</div><!--/.ewf-section-text-->
						</div><!--/.col-md-->
					<?php } // end if _subtitle, _title // ?>

					<?php if ( ! empty( $fields['newsletter_list'] ) ) : ?>
						<div class="<?php echo esc_attr( $content_class ); ?>">
							<form action="<?php echo esc_url( $fields['newsletter_list'] ); ?>" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
								<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="<?php echo esc_html__( 'Your email..', 'portum') ?>">
								<input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="ewf-btn">
							</form>
						</div>
					<?php endif; ?>

				</div><!--/.row-->
			</div><!--/.container class-->
		</div><!--/.ewf-section--content-->
	</div><!--/.attr-helper-->
</section>
