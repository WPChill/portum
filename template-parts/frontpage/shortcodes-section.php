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

$bg = $fields['shortcodes_background_color'];
?>

<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>">
	<div class="shortcodes-section" <?php echo ! empty( $bg ) ? 'style="background-color:' . esc_attr( $bg ) . '"' : ''; ?>>
		<div class="<?php echo esc_attr( $class[ $fields['shortcodes_column_stretch'] ] ); ?>">
			<div class="row">
				<?php if ( 'boxedcenter' === $fields['shortcodes_column_stretch'] ): ?>
					<div class="col-sm-1"></div>
				<?php endif; ?>

				<div class="<?php echo 'boxedcenter' === $fields['shortcodes_column_stretch'] ? 'col-sm-10' : 'col-sm-12'; ?>">
					<?php echo do_shortcode( $fields['shortcode_field'] ); ?>
				</div>

				<?php if ( 'boxedcenter' === $fields['shortcodes_column_stretch'] ): ?>
					<div class="col-sm-1"></div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
