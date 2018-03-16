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

$class = array(
	'boxedin'     => 'container',
	'boxedcenter' => 'container',
	'fullwidth'   => 'container-fluid',
);

$attr_helper       = new Epsilon_Section_Attr_Helper( $fields, 'shortcodes', Portum_Repeatable_Sections::get_instance() );
$parent_attr       = array(
	'class' => array( 'section-shortcodes', 'section', 'ewf-section' ),
	'style' => array( 'background-image', 'background-position', 'background-size', 'background-repeat' ),
);

?>

<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>">
	<div <?php $attr_helper->generate_attributes( $parent_attr ); ?>>
		<?php echo wp_kses( Portum_Helper::generate_pencil( 'Portum_Repeatable_Sections', 'shortcodes' ), Epsilon_Helper::allowed_kses_pencil() ); ?>

		<?php
		$attr_helper->generate_video_overlay();
		$attr_helper->generate_color_overlay();
		?>
		<div class="<?php echo esc_attr( Portum_Helper::container_class( 'shortcodes', $fields ) ); ?>">
			<div class="row">
				<div class="col-sm-12">
					<?php echo do_shortcode( $fields['shortcode_field'] ); ?>
				</div>
			</div>
		</div>
	</div>
</section>
