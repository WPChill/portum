<?php
/**
 * Template part for displaying a frontpage section
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Portum
 */

$frontpage               = Epsilon_Page_Generator::get_instance( 'portum_frontpage_sections_' . get_the_ID(), get_the_ID() );
$fields                  = $frontpage->sections[ $section_id ];
$grouping                = array(
	'values'   => $fields['progress_bars_grouping'],
	'group_by' => 'progress_bar_title',
);
$fields['progress_bars'] = $frontpage->get_repeater_field( $fields['progress_bars_repeater_field'], array(), $grouping );

$attr_helper = new Epsilon_Section_Attr_Helper( $fields, 'progress', Portum_Repeatable_Sections::get_instance() );
if ( empty( $fields['progress_section_unique_id'] ) ) {
	$fields['progress_section_unique_id'] = Portum_Helper::generate_section_id( 'progress' );
}

$parent_attr = array(
	'id'    => array( $fields['progress_section_unique_id'] ),
	'class' => array(
		'section-progress',
		'section',
		'ewf-section',
		'ewf-section-' . $fields['progress_section_visibility'],
	),
);

/**
 * Layout stuff
 */
$content_class = '';
$header_class  = '';
$row_class     = '';
$item_spacing  = 'ewf-item__spacing-' . ( isset( $fields['progress_column_spacing'] ) ? $fields['progress_column_spacing'] : '' );

if ( 'left' == $fields['progress_row_title_align'] || 'right' == $fields['progress_row_title_align'] ) {
	$content_class = 'col-sm-8 ewf-content__wrap';
	$header_class  = 'col-sm-4';
	if ( 'right' == $fields['progress_row_title_align'] ) {
		$row_class = 'row-flow-reverse';
	}
} else {
	$content_class = 'col-sm-12 ewf-content__wrap';
	$header_class  = 'col-sm-12';
	if ( 'bottom' == $fields['progress_row_title_align'] ) {
		$row_class = 'row-column-reverse';
	}
}
$item_class        = 'col-sm-' . ( 12 / absint( $fields['progress_column_group'] ) );
$item_effect_style = ( ! empty( $fields['progress_item_style'] ) ? esc_attr( $fields['progress_item_style'] ) : 'ewf-item__no-effect' );
// end layout stuff
?>

<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>" data-customizer-section-string-id="progress">
	<?php Portum_Helper::generate_inline_css( $fields['progress_section_unique_id'], 'progress', $fields ); ?>
	<?php echo wp_kses( Epsilon_Helper::generate_pencil( 'Portum_Repeatable_Sections', 'progress' ), Epsilon_Helper::allowed_kses_pencil() ); ?>
	<div <?php $attr_helper->generate_attributes( $parent_attr ); ?>>
		<?php $attr_helper->generate_color_overlay(); ?>

		<div class="ewf-section__content">
			<div class="<?php echo esc_attr( Portum_Helper::container_class( 'progress', $fields ) ); ?>">

				<div class="row <?php echo esc_attr( $row_class ); ?>">

					<?php if ( ! empty( $fields['progress_bars_subtitle'] ) || ! empty( $fields['progress_bars_title'] ) ) { ?>
						<div class="<?php echo esc_attr( $header_class ); ?>">
							<div class="ewf-section-text">
								<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['progress_bars_subtitle'], $fields['progress_bars_title'] ) ); ?>
							</div>
						</div>
					<?php }//endif !empty ?>

					<div class="<?php echo esc_attr( $content_class ); ?> ">
						<?php foreach ( $fields['progress_bars'] as $key => $progress ) { ?>
							<div class="<?php echo esc_attr( $item_class . ' ' . $item_spacing ); ?>">
								<div class="ewf-progress <?php echo 'alternate' === $progress['progress_bar_type'] ? 'ewf-progress--alternative-modern' : ''; ?>">
									<?php
									echo wp_kses( Epsilon_Helper::generate_field_repeater_pencil( $key, 'portum_progress_bars_section', 'portum_progress_bars' ), Epsilon_Helper::allowed_kses_pencil() );
									?>
									<div class="ewf-like-h6 ewf-progress__title">
										<?php
										if ( ! empty( $progress['progress_bar_title'] ) ) {
											?>
											<?php echo wp_kses_post( $progress['progress_bar_title'] ); ?>

											<?php if ( ! empty( $progress['progress_bar_value'] ) ) { ?>
												<span><?php echo $progress['progress_bar_value']; ?>%</span>
											<?php } ?>

										<?php } ?>
									</div><!-- end .ewf-progress__title -->

									<div class="ewf-progress__bar">
										<div class="ewf-progress__bar-liniar-wrap">
											<div class="ewf-progress__bar-liniar" data-value="<?php echo ! empty( $progress['progress_bar_value'] ) ? esc_attr( $progress['progress_bar_value'] ) : 85; ?>"></div>
										</div><!-- ewf-progress__bar-liniar-wrap-->
									</div><!-- end .ewf-progress__bar -->

								</div><!-- end .ewf-progress -->
							</div><!-- col -->
						<?php }//end foreach ?>
					</div><!-- content class -->
				</div><!--/.row-->
			</div><!-- container class-->
		</div><!--/.ewf=section__content-->
	</div><!-- attr helper class -->
</section>
