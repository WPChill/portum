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
$grouping  = array(
	'values'   => $fields['testimonials_grouping'],
	'group_by' => 'testimonial_title',
);

$attr_helper = new Epsilon_Section_Attr_Helper( $fields, 'testimonials', Portum_Repeatable_Sections::get_instance() );

$fields['testimonials'] = $frontpage->get_repeater_field( $fields['testimonials_repeater_field'], array(), $grouping );

$parent_attr = array(
	'id'    => ! empty( $fields['testimonials_section_unique_id'] ) ? array( $fields['testimonials_section_unique_id'] ) : array(),
	'class' => array(
		'section-testimonials',
		'section',
		'ewf-section',
		'ewf-section-' . $fields['testimonials_section_visibility'],
	),
	'style' => array( 'background-image', 'background-position', 'background-size', 'background-repeat' ),
);

$i    = 0;
$span = 12 / absint( $fields['testimonials_column_group'] );
$items_count = 0;
$items_class = null;
?>

<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>">
	<?php Portum_Helper::generate_css_color_tabs( $section_id, 'testimonials', $fields ); ?>
	<?php echo wp_kses( Portum_Helper::generate_pencil( 'Portum_Repeatable_Sections', 'testimonials' ), Epsilon_Helper::allowed_kses_pencil() ); ?>
	<div <?php $attr_helper->generate_attributes( $parent_attr ); ?>>
		<?php
		$attr_helper->generate_color_overlay();
		$attr_helper->generate_video_overlay();
		?>

		<div class="ewf-section__content">
			<div class="<?php echo esc_attr( Portum_Helper::container_class( 'testimonials', $fields ) ); ?>">

				<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['testimonials_subtitle'], $fields['testimonials_title'], array( 'center' => true ) ) ); ?>

				<?php if ( ! empty( $fields['testimonials'] ) ) { ?>
					<div class="row">
						<?php foreach ( $fields['testimonials'] as $key => $v ) { ?>

							<?php $i++; ?>

							<div class="col-md-<?php echo esc_attr( $span ); ?>">
								<div class="testimonial<?php echo ( 1 & $i ) ? ' left' : ' right'; ?>">
									<?php
									echo wp_kses( Epsilon_Helper::generate_field_repeater_pencil( $key, 'portum_testimonials_section', 'portum_testimonials' ), Epsilon_Helper::allowed_kses_pencil() );
									?>
									<?php if ( ! empty( $v['testimonial_image'] ) ) { ?>
										<img src="<?php echo esc_url( $v['testimonial_image'] ); ?>" alt="<?php echo esc_attr( $v['testimonial_title'] ); ?>">
									<?php } ?>

									<?php if ( ! empty( $v['testimonial_title'] ) ) { ?>
										<h6><?php echo wp_kses_post( $v['testimonial_title'] ); ?></h6>
									<?php } ?>

									<?php echo wp_kses_post( wpautop( $v['testimonial_text'] ) ); ?>

									<?php if ( ! empty( $v['testimonial_subtitle'] ) ) { ?>
										<a href="#"><?php echo wp_kses_post( $v['testimonial_subtitle'] ); ?></a>
									<?php } ?>
								</div>
							</div>

						<?php } ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</section>
