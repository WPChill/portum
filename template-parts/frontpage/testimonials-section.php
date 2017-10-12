<?php
/**
 * Template part for displaying a frontpage section
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Portum
 */

$frontpage = Portum_Frontpage::get_instance( 'portum_frontpage_sections' );
$fields    = $frontpage->sections[ $section_id ];
$grouping  = array(
	'values'   => $fields['testimonials_grouping'],
	'group_by' => 'testimonial_title',
);

$fields['testimonials'] = $frontpage->get_repeater_field( $fields['testimonials_repeater_field'], array(), $grouping );

$i = 0;
?>

<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>">
	<div class="section-testimonials section dashed">
		<div class="container">
			<?php echo wp_kses_post( Portum_Helper::generate_pencil() ); ?>
			<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['testimonials_subtitle'], $fields['testimonials_title'] ) ); ?>

			<?php if ( ! empty( $fields['testimonials'] ) ) { ?>
				<div class="row">
					<?php $max_row = ceil( count( $fields['testimonials'] ) / 2 ); ?>
					<?php foreach ( $fields['testimonials'] as $k => $v ) { ?>

						<?php $i ++; ?>
						<div class="col-md-6">
							<div class="testimonial <?php echo 0 === (int) fmod( $i, $max_row ) ? 'hidden-testimonial right' : 'left'; ?>">
								<?php if ( ! empty( $v['testimonial_image'] ) ) { ?>
									<img src="<?php echo esc_url( $v['testimonial_image'] ); ?>" alt="<?php echo esc_attr( $v['testimonial_title'] ); ?>">
								<?php } ?>

								<?php if ( ! empty( $v['testimonial_title'] ) ) { ?>
									<h6><?php echo esc_html( $v['testimonial_title'] ); ?></h6>
								<?php } ?>

								<?php echo wp_kses_post( wpautop( $v['testimonial_text'] ) ); ?>

								<?php if ( ! empty( $v['testimonial_subtitle'] ) ) { ?>
									<a href="#"><?php echo esc_html( $v['testimonial_subtitle'] ); ?></a>
								<?php } ?>
								<span></span>
							</div>
						</div>
						<?php
						if ( 0 === (int) fmod( $i, $max_row ) && count( $fields['testimonials'] ) !== (int) $i ) {
							echo '</div><div class="row">';
						} elseif ( count( $fields['testimonials'] ) === (int) $i ) {
							continue;
						}
						?>

					<?php } ?>
				</div>
			<?php } ?>
		</div>
	</div>
</section>
