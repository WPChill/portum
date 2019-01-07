<?php
/**
 * Template part for displaying a frontpage section
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Portum
 */

$frontpage          = Epsilon_Page_Generator::get_instance( 'portum_frontpage_sections_' . get_the_ID(), get_the_ID() );
$fields             = $frontpage->sections[ $section_id ];
$grouping           = array(
	'values'   => isset( $fields['iconboxes_grouping'] ) ? $fields['iconboxes_grouping'] : 0,
	'group_by' => 'icon_title',
);
$fields['iconboxes'] = $frontpage->get_repeater_field( 'portum_icons', array(), $grouping );

$attr_helper = new Epsilon_Section_Attr_Helper( $fields, 'iconboxes', Portum_Repeatable_Sections::get_instance() );
if ( empty( $fields['iconboxes_section_unique_id'] ) ) {
	$fields['iconboxes_section_unique_id'] = Portum_Helper::generate_section_id( 'iconboxes' );
}

$parent_attr = array(
	'id'    => array( $fields['iconboxes_section_unique_id'] ),
	'class' => array(
		'section-iconboxes',
		'section',
		'ewf-section',
		'contrast',
	),
);


/**
 * Layout stuff
 */
$content_class = '';
$header_class  = '';
$row_class     = '';
$item_spacing  = 'ewf-item__spacing-' . ( isset( $fields['iconboxes_column_spacing'] ) ? $fields['iconboxes_column_spacing'] : '' );

$item_class        = 'col-sm-' . ( 12 / absint( $fields['iconboxes_column_group'] ) );
$item_effect_style = ( ! empty( $fields['iconboxes_item_style'] ) ? esc_attr( $fields['iconboxes_item_style'] ) : 'ewf-item__no-effect' );

/**
 * Item Style
 */
$item_element_class = 'icon-' . $fields['icon_position'];
$item_style         = array();
// end layout stuff
?>

<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>">
	<?php Portum_Helper::generate_inline_css( $fields['iconboxes_section_unique_id'], 'iconboxes', $fields ); ?>
	<?php echo wp_kses( Epsilon_Helper::generate_pencil( 'Portum_Repeatable_Sections', 'iconboxes' ), Epsilon_Helper::allowed_kses_pencil() ); ?>
	<div <?php $attr_helper->generate_attributes( $parent_attr ); ?>>
		<?php $attr_helper->generate_color_overlay(); ?>
		<div class="ewf-section__content">
			<div class="<?php echo esc_attr( Portum_Helper::container_class( 'iconboxes', $fields ) ); ?>">

				<div class="row">
					<?php if ( ! empty( $fields['iconboxes'] ) ) : ?>
						<?php foreach ( $fields['iconboxes'] as $key => $icon ) : ?>
							<div class="<?php echo esc_attr( $item_class . ' ' . $item_spacing ); ?>">
								<div class="iconboxes-item <?php echo esc_attr( $item_element_class ); ?>" style="<?php echo esc_attr( implode( ';', $item_style ) ); ?>">
									<?php echo wp_kses( Epsilon_Helper::generate_field_repeater_pencil( $key, 'portum_iconboxes_section', 'portum_iconboxes' ), Epsilon_Helper::allowed_kses_pencil() ); ?>

									<?php Portum_Helper::render_icon( $icon, 'icon' ); ?>

									<?php if ( ! empty( $icon['icon_title'] ) ) { ?>
										<div class="ewf-like-h6">
											<?php echo wp_kses_post( $icon['icon_title'] ); ?>
										</div><!--/.ewf-like-h6-->
									<?php } ?>
								</div><!--/.iconboxes-item-->
							</div><!--/.col-sm-->
						<?php endforeach; ?>
					<?php endif; ?>
				</div><!--/.row-->
			</div>
		</div>
	</div>
</section>
