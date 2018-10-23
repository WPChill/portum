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

$frontpage          = Epsilon_Page_Generator::get_instance( 'portum_frontpage_sections_' . get_the_ID(), get_the_ID() );
$fields             = $frontpage->sections[ $section_id ];
$grouping           = array(
	'values'   => $fields['inconboxes_grouping'],
	'group_by' => 'icon_title',
);
$fields['inconboxes'] = $frontpage->get_repeater_field( 'portum_icons', array(), $grouping );

$attr_helper = new Epsilon_Section_Attr_Helper( $fields, 'inconboxes', Portum_Repeatable_Sections::get_instance() );
if ( empty( $fields['inconboxes_section_unique_id'] ) ) {
	$fields['inconboxes_section_unique_id'] = Portum_Helper::generate_section_id( 'inconboxes' );
}

$parent_attr = array(
	'id'    => array( $fields['inconboxes_section_unique_id'] ),
	'class' => array(
		'section-inconboxes',
		'section',
		'ewf-section',
		'contrast',
	),
	'style' => array( 'background-image', 'background-position', 'background-size', 'background-repeat' ),
);

/**
 * Layout stuff
 */
$content_class = '';
$header_class  = '';
$row_class     = '';
$item_spacing  = 'ewf-item__spacing-' . ( isset( $fields['inconboxes_column_spacing'] ) ? $fields['inconboxes_column_spacing'] : '' );

$item_class        = 'col-sm-' . ( 12 / absint( $fields['inconboxes_column_group'] ) );
$item_effect_style = ( ! empty( $fields['inconboxes_item_style'] ) ? esc_attr( $fields['inconboxes_item_style'] ) : 'ewf-item__no-effect' );

/**
 * Item Style
 */
$item_element_class = 'icon-' . $fields['icon_position'];
$item_style         = array();
// end layout stuff
?>
<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>">
	<?php Portum_Helper::generate_inline_css( $fields['inconboxes_section_unique_id'], 'inconboxes', $fields ); ?>
	<?php echo wp_kses( Epsilon_Helper::generate_pencil( 'Portum_Repeatable_Sections', 'inconboxes' ), Epsilon_Helper::allowed_kses_pencil() ); ?>
	<div <?php $attr_helper->generate_attributes( $parent_attr ); ?>>
		<?php $attr_helper->generate_color_overlay(); ?>
		<div class="upsell-section">
		<div class="ewf-section__content">
			<div class="<?php echo esc_attr( Portum_Helper::container_class( 'inconboxes', $fields ) ); ?>">

				<div class="row">

					<!-- Check if we have values in our field repeater -->
					<?php if ( ! empty( $fields['inconboxes'] ) ) { ?>
					<div class="col-md-12">
						<?php foreach ( $fields['inconboxes'] as $key => $icon ) { ?><?php
							$icon_style = 'color: ' . ( ! empty( $icon['icon_color'] ) ? esc_attr( $icon['icon_color'] ) : 'inherit' ) . ';';
							$icon_style .= 'font-size: ' . ( ! empty( $icon['icon_size'] ) ? esc_attr( $icon['icon_size'] ) : 'inherit' ) . 'px;';
							?>

							<div class="<?php echo esc_attr( $item_class . ' ' . $item_spacing ); ?>">
								<div class="inconboxes-item <?php echo esc_attr( $item_element_class ); ?>" style="<?php echo esc_attr( implode( ';', $item_style ) ); ?>">
									<?php
									echo wp_kses( Epsilon_Helper::generate_field_repeater_pencil( $key, 'portum_inconboxes_section', 'portum_inconboxes' ), Epsilon_Helper::allowed_kses_pencil() );
									?>
									<?php if ( ! empty( $icon['icon'] ) ) { ?>
										<i class="<?php echo esc_attr( $icon['icon'] ); ?>" style="<?php echo esc_attr( $icon_style ); ?>"></i>
									<?php } ?>

									<?php if ( ! empty( $icon['icon_title'] ) ) { ?>
										<div class="ewf-like-h3">
											<?php echo wp_kses_post( $icon['icon_title'] ); ?>
										</div><!--/.ewf-like-h6-->
									<?php } ?>
								</div><!--/.inconboxes-item-->
							</div><!--/.col-sm-->
						<?php }//end foreach ?>
					</div><!--/.col-sm--->
				</div><!--/.row-->
				<?php } ?>
			</div>
		</div>
		</div>
	</div>
</section>
