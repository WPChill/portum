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

$defaults = array(
	'demo_field'                     => '',
	'demo_heading_color'             => '',
	'demo_text_color'                => '',
	'demo_column_alignment'          => '',
	'demo_column_vertical_alignment' => '',
	'demo_column_stretch'            => '',
	'demo_column_spacing'            => '',
	'demo_column_group'              => '',
	'demo_row_spacing_top'           => '',
	'demo_row_spacing_bottom'        => '',
	'demo_row_title_align'           => '',
	'demo_background_color'          => '',
	'demo_background_color_opacity'  => '',
	'demo_background_image'          => '',
	'demo_background_position'       => '',
	'demo_background_repeat'         => '',
	'demo_background_size'           => '',
	'demo_background_parallax'       => '',
	'demo_background_video'          => '',
);

$fields = wp_parse_args( $fields, $defaults );
?>

<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>">
	<div class="container">
		<div class="row">
			<div class="col-md-2">

			</div>
			<div class="col-md-8">
				<h3>Colors</h3>
				<dl>
					<dt>Heading colors</dt>
					<dd><?php echo $fields['demo_heading_color']; ?></dd>
					<dt>Text colors</dt>
					<dd><?php echo $fields['demo_text_color']; ?></dd>
				</dl>
				<h3>Layout</h3>
				<dl>
					<dt>Column alignment</dt>
					<dd><?php echo $fields['demo_column_alignment']; ?></dd>
					<dt>Column vertical alignment</dt>
					<dd><?php echo $fields['demo_column_vertical_alignment']; ?></dd>
					<dt>Column stretch</dt>
					<dd><?php echo $fields['demo_column_stretch']; ?></dd>
					<dt>Column spacing</dt>
					<dd><?php echo $fields['demo_column_spacing']; ?></dd>
					<dt>Column group</dt>
					<dd><?php echo $fields['demo_column_group']; ?></dd>
					<dt>Section spacing top</dt>
					<dd><?php echo $fields['demo_row_spacing_top']; ?></dd>
					<dt>Section spacing bottom</dt>
					<dd><?php echo $fields['demo_row_spacing_bottom']; ?></dd>
					<dt>Section title align</dt>
					<dd><?php echo $fields['demo_row_title_align']; ?></dd>
				</dl>
				<h3>Styling</h3>
				<dl>
					<dt>Background color</dt>
					<dd><?php echo $fields['demo_background_color']; ?></dd>
					<dt>Background color opacity</dt>
					<dd><?php echo $fields['demo_background_color_opacity']; ?></dd>
					<dt>Background image</dt>
					<dd><?php echo $fields['demo_background_image']; ?></dd>
					<dt>Background position</dt>
					<dd><?php echo $fields['demo_background_position']; ?></dd>
					<dt>Background repeat</dt>
					<dd><?php echo $fields['demo_background_repeat']; ?></dd>
					<dt>Background size</dt>
					<dd><?php echo $fields['demo_background_size']; ?></dd>
					<dt>Background parallax</dt>
					<dd><?php echo $fields['demo_background_parallax']; ?></dd>
					<dt>Background video</dt>
					<dd><?php echo $fields['demo_background_video']; ?></dd>
				</dl>
			</div>
			<div class="col-md-2">

			</div>
		</div>
	</div>
</section>
