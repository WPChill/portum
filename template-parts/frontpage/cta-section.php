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
$parent_attr = array(
	'id'    => ! empty( $fields['cta_section_unique_id'] ) ? array( $fields['cta_section_unique_id'] ) : array(),
	'class' => array( 'section-cta', 'section', 'ewf-section', 'ewf-section-' . $fields['cta_section_visibility'] ),
	'style' => array( 'background-image', 'background-position', 'background-size', 'background-repeat' ),
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

<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>">
	<?php //Portum_Helper::generate_inline_css( $section_id, 'cta', $fields ); ?>
	<?php echo wp_kses( Epsilon_Helper::generate_pencil( 'Portum_Repeatable_Sections', 'cta' ), Epsilon_Helper::allowed_kses_pencil() ); ?>
	<div <?php $attr_helper->generate_attributes( $parent_attr ); ?>>

		<?php
		$attr_helper->generate_color_overlay();

		$button_primary   = $fields['cta_button_1_enable'];
		$button_secondary = $fields['cta_button_2_enable'];

		$btn_1_css = 'background-color: ' . ( ! empty( $fields['cta_primary_button_background_color'] ) ? esc_attr( $fields['cta_primary_button_background_color'] ) : 'inherit' ) . ';';
		$btn_1_css .= 'color: ' . ( ! empty( $fields['cta_primary_button_text_color'] ) ? esc_attr( $fields['cta_primary_button_text_color'] ) : 'inherit' ) . ';';
		$btn_1_css .= 'border-color: ' . ( ! empty( $fields['cta_primary_button_border_color'] ) ? esc_attr( $fields['cta_primary_button_border_color'] ) : 'inherit' ) . ';';
		$btn_1_css .= 'border-radius: ' . ( ! empty( $fields['cta_primary_btn_radius'] ) ? esc_attr( $fields['cta_primary_btn_radius'] ) : '0' ) . 'px;';


		$btn_1_size = ! empty( $fields['cta_primary_btn_size'] ) ? esc_attr( $fields['cta_primary_btn_size'] ) : 'ewf-btn--huge';

		$btn_2_css = 'background-color: ' . ( ! empty( $fields['cta_secondary_button_background_color'] ) ? esc_attr( $fields['cta_secondary_button_background_color'] ) : 'inherit' ) . ';';
		$btn_2_css .= 'color: ' . ( ! empty( $fields['cta_secondary_button_text_color'] ) ? esc_attr( $fields['cta_secondary_button_text_color'] ) : 'inherit' ) . ';';
		$btn_2_css .= 'border-color: ' . ( ! empty( $fields['cta_secondary_button_border_color'] ) ? esc_attr( $fields['cta_secondary_button_border_color'] ) : 'inherit' ) . ';';
		$btn_2_css .= 'border-radius: ' . ( ! empty( $fields['cta_secondary_btn_radius'] ) ? esc_attr( $fields['cta_secondary_btn_radius'] ) : '0' ) . 'px;';

		$btn_2_size = ! empty( $fields['cta_secondary_btn_size'] ) ? esc_attr( $fields['cta_secondary_btn_size'] ) : 'ewf-btn--huge';


		?>
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


					<?php if ( ! empty( $button_primary ) || ! empty( $button_secondary ) ) { ?>

						<div class="<?php echo esc_attr( $content_class ); ?>">

							<?php
							if ( ! empty( $button_primary ) ) {
								echo '<a class="ewf-btn ' . esc_attr( $btn_1_size ) . '" style="' . esc_attr( $btn_1_css ) . '" href="' . esc_attr( $fields['cta_button_primary_url'] ) . '">' . wp_kses_post( $fields['cta_button_primary_label'] ) . '</a>';
							}
							?>

							<?php
							if ( ! empty( $button_secondary ) ) {
								echo '<a class="ewf-btn ' . esc_attr( $btn_2_size ) . '" style="' . esc_attr( $btn_2_css ) . '" href="' . esc_attr( $fields['cta_button_secondary_url'] ) . '">' . wp_kses_post( $fields['cta_button_secondary_label'] ) . '</a>';
							}
							?>
						</div><!-- content class -->
					<?php }//endif button check ?>

				</div><!--/.row-->
			</div><!-- container class -->
		</div><!-- ewf-section__content-->
	</div><!-- attr generator-->
</section>
