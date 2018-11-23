<?php
/**
 * Template part for displaying a frontpage section
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Portum
 */

$frontpage           = Epsilon_Page_Generator::get_instance( 'portum_frontpage_sections_' . get_the_ID(), get_the_ID() );
$fields              = $frontpage->sections[ $section_id ];
$grouping            = array(
	'values'   => $fields['piecharts_grouping'],
	'group_by' => 'piechart_title',
);
$fields['piecharts'] = $frontpage->get_repeater_field( $fields['piecharts_repeater_field'], array(), $grouping );

$attr_helper = new Epsilon_Section_Attr_Helper( $fields, 'piecharts', Portum_Repeatable_Sections::get_instance() );
if ( empty( $fields['piecharts_section_unique_id'] ) ) {
	$fields['piecharts_section_unique_id'] = Portum_Helper::generate_section_id( 'piecharts' );
}

$parent_attr = array(
	'id'    => array( $fields['piecharts_section_unique_id'] ),
	'class' => array(
		'section-piecharts',
		'section',
		'ewf-section',
		'ewf-section-' . $fields['piecharts_section_visibility'],
	),
);


wp_enqueue_script( 'easypiechart' );
$color = get_theme_mod( 'epsilon_accent_color', '#cc263d' );

/**
 * Layout stuff
 */
$content_class = '';
$header_class  = '';
$row_class     = '';
$item_spacing  = 'ewf-item__spacing-' . ( isset( $fields['piecharts_column_spacing'] ) ? $fields['piecharts_column_spacing'] : '' );

if ( 'left' == $fields['piecharts_row_title_align'] || 'right' == $fields['piecharts_row_title_align'] ) {
	$content_class = 'col-sm-8 ewf-content__wrap';
	$header_class  = 'col-sm-4';
	if ( 'right' == $fields['piecharts_row_title_align'] ) {
		$row_class = 'row-flow-reverse';
	}
} else {
	$content_class = 'col-sm-12 ewf-content__wrap';
	$header_class  = 'col-sm-12';
	if ( 'bottom' == $fields['piecharts_row_title_align'] ) {
		$row_class = 'row-column-reverse';
	}
}
$item_class        = 'col-sm-' . ( 12 / absint( $fields['piecharts_column_group'] ) );
$item_effect_style = ( ! empty( $fields['piecharts_item_style'] ) ? esc_attr( $fields['piecharts_item_style'] ) : 'ewf-item__no-effect' );
// end layout stuff
?>

<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>" data-customizer-section-string-id="piecharts">
	<?php Portum_Helper::generate_inline_css( $fields['piecharts_section_unique_id'], 'piecharts', $fields ); ?>
	<?php echo wp_kses( Epsilon_Helper::generate_pencil( 'Portum_Repeatable_Sections', 'piecharts' ), Epsilon_Helper::allowed_kses_pencil() ); ?>
	<div <?php $attr_helper->generate_attributes( $parent_attr ); ?>>
		<?php $attr_helper->generate_color_overlay(); ?>

		<div class="ewf-section__content">
			<div class="<?php echo esc_attr( Portum_Helper::container_class( 'piecharts', $fields ) ); ?>">

				<div class="row <?php echo esc_attr( $row_class ); ?>">

					<?php if ( ! empty( $fields['piecharts_subtitle'] ) || ! empty( $fields['piecharts_title'] ) ) { ?>
						<div class="<?php echo esc_attr( $header_class ); ?>">
							<div class="ewf-section-text">
								<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['piecharts_subtitle'], $fields['piecharts_title'] ) ); ?>
							</div><!--/.ewf-section-text-->
						</div><!--/.header class-->
					<?php } ?>

					<div class="<?php echo esc_attr( $content_class ); ?>">
						<?php foreach ( $fields['piecharts'] as $key => $piechart ) { ?>
							<div class="<?php echo esc_attr( $item_class . ' ' . $item_spacing ); ?>">
								<div class="ewf-pie">
									<?php
									echo wp_kses( Epsilon_Helper::generate_field_repeater_pencil( $key, 'portum_piecharts_section', 'portum_pie_charts' ), Epsilon_Helper::allowed_kses_pencil() );
									?>
									<div class="ewf-pie__chart" data-percent="<?php echo ! empty( $piechart['piechart_value'] ) ? esc_attr( $piechart['piechart_value'] ) : 55; ?>" data-barColor="<?php echo esc_attr( $color ); ?>" data-trackColor="#e1e1e1" data-lineWidth="<?php echo ! empty( $piechart['piechart_bar_width'] ) ? esc_attr( $piechart['piechart_bar_width'] ) : 15; ?>" data-barSize="<?php echo ! empty( $piechart['piechart_size'] ) ? esc_attr( $piechart['piechart_size'] ) : 250; ?>" data-lineCap="square">
										<?php if ( 'icon' === $piechart['piechart_type'] ) { ?>
											<div class="ewf-pie__icon">
												<i class="<?php echo esc_attr( $piechart['piechart_icon'] ); ?>"></i>
											</div>
										<?php } else { ?>
											<div class="ewf-pie__percent">
												<span></span>%
											</div>
										<?php } ?>
									</div>
								</div><!-- end .ewf-pie -->
								<?php if ( ! empty( $piechart['piechart_title'] ) ) { ?>
									<div class="ewf-like-h6 ewf-pie__title"><?php echo wp_kses_post( $piechart['piechart_title'] ); ?></div>
								<?php } ?>
								<?php if ( ! empty( $piechart['piechart_text'] ) ) { ?>
									<p class="ewf-pie__description"><?php echo wp_kses_post( $piechart['piechart_text'] ); ?> </p>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
