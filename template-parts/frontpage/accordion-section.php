<?php
/**
 * Template part for displaying a frontpage section
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package portum
 */
$frontpage           = Epsilon_Page_Generator::get_instance( 'portum_frontpage_sections_' . get_the_ID(), get_the_ID() );
$fields              = $frontpage->sections[ $section_id ];
$grouping            = array(
	'values'   => $fields['accordion_grouping'],
	'group_by' => 'accordion_title',
);
$fields['accordion'] = $frontpage->get_repeater_field( $fields['accordion_repeater_field'], array(), $grouping );

$attr_helper = new Epsilon_Section_Attr_Helper( $fields, 'accordion', Portum_Repeatable_Sections::get_instance() );
if ( empty( $fields['accordion_section_unique_id'] ) ) {
	$fields['accordion_section_unique_id'] = Portum_Helper::generate_section_id( 'accordion' );
}

$parent_attr = array(
	'id'    => array( $fields['accordion_section_unique_id'] ),
	'class' => array(
		'section-accordion',
		'section',
		'ewf-section',
		'ewf-section-' . $fields['accordion_section_visibility'],
	),
);

$content_class = '';
$header_class  = '';
$row_class     = '';
$counter       = 1;


if ( 'left' == $fields['accordion_row_title_align'] || 'right' == $fields['accordion_row_title_align'] ) {
	$content_class = 'col-sm-8';
	$header_class  = 'col-sm-4';
	if ( 'right' == $fields['accordion_row_title_align'] ) {
		$row_class = 'row-flow-reverse';
	}
} else {
	$content_class = 'col-md-12';
	$header_class  = 'col-md-12';
	if ( 'bottom' == $fields['accordion_row_title_align'] ) {
		$row_class = 'row-column-reverse';
	}
}

$item_class = 'col-sm-' . 12 / intval( $fields['accordion_column_group'] );


?>

<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>" data-customizer-section-string-id="accordion">
	<?php Portum_Helper::generate_inline_css( $fields['accordion_section_unique_id'], 'accordion', $fields ); ?>
	<?php echo wp_kses( Epsilon_Helper::generate_pencil( 'Portum_Repeatable_Sections', 'accordion' ), Epsilon_Helper::allowed_kses_pencil() ); ?>
	<div <?php $attr_helper->generate_attributes( $parent_attr ); ?>>
		<?php $attr_helper->generate_color_overlay(); ?>
		<div class="ewf-section__content">
			<div class="<?php echo esc_attr( Portum_Helper::container_class( 'accordion', $fields ) ); ?>">
				<div class="row <?php echo esc_attr( $row_class ); ?>">

					<?php if ( ! empty( $fields['accordion_title'] ) || ! empty( $fields['accordion_subtitle'] ) ) { ?>
						<div class="<?php echo esc_attr( $header_class ); ?>">
							<div class="ewf-section-text">
								<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['accordion_title'], $fields['accordion_subtitle'] ) ); ?>
								<?php echo wpautop( wp_kses_post( $fields['accordion_text'] ) ); ?>
							</div><!--/.ewf-section--text-->
						</div><!--/.col-->
					<?php }//endif ?>

					<?php if ( ! empty( $fields['accordion'] ) ) { ?>
						<div class="accordion <?php echo esc_attr( $content_class ); ?>">
							<?php foreach ( $fields['accordion'] as $key => $accordion ) { ?>
								<div class="accordion-item__container <?php echo esc_attr( $item_class ); ?>">
									<?php
									echo wp_kses( Epsilon_Helper::generate_field_repeater_pencil( $key, 'portum_accordion_section', 'portum_accordion' ), Epsilon_Helper::allowed_kses_pencil() );
									?>
									<div class="accordion-item-toggle">
										<?php echo esc_html( $accordion['accordion_title'] ); ?>
									</div><!--/.accordion-item-toggle-->
									<div class="accordion-item-content <?php echo esc_attr( true === $accordion['accordion_opened'] ) ? 'accordion-item-opened' : ''; ?>">
										<?php echo wpautop( wp_kses_post( $accordion['accordion_text'] ) ); ?>
									</div><!--/.accordion-item-content-->
								</div><!--/.accordion-item-container-->
							<?php } //endforeach ?>
						</div><!--/.accordion-->
					<?php } // endif ?>
				</div><!--/.row-->
			</div><!--/.container class-->
		</div><!--/.ewf-section__content-->
</section>
