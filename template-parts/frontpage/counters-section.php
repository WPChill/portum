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
	'values'   => $fields['counters_grouping'],
	'group_by' => 'counter_title',
);

$fields['counters'] = $frontpage->get_repeater_field( $fields['counters_repeater_field'], array(), $grouping );

$span        = 12 / absint( $fields['counters_column_group'] );
$attr_helper = new Epsilon_Section_Attr_Helper( $fields, 'counters', Portum_Repeatable_Sections::get_instance() );
$parent_attr = array(
	'class' => array( 'section-counters', 'section', 'ewf-section' ),
	'style' => array( 'background-image', 'background-position', 'background-size', 'background-repeat' ),
);

?>

<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>">
	<div <?php $attr_helper->generate_attributes( $parent_attr ); ?>>
		<?php
		$attr_helper->generate_video_overlay();
		$attr_helper->generate_color_overlay();
		?>
		<div class="container">
			<?php echo wp_kses_post( Portum_Helper::generate_pencil() ); ?>
		</div>

		<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['counters_subtitle'], $fields['counters_title'] ) ); ?>

		<div class="<?php echo esc_attr( Portum_Helper::container_class( 'counters', $fields ) ); ?>">
			<div class="row">
				<?php foreach ( $fields['counters'] as $counter ) { ?>

					<?php
					$class = 'ewf-counter__standard';
					if ( 'odometer' === $counter['counter_type'] ) {
						$class = 'ewf-counter__odometer odometer';
					}
					?>

					<div class="col-md-<?php echo absint( $span ); ?>">
						<div class="ewf-counter">

							<?php if ( ! empty( $counter['counter_icon'] ) && $counter['counter_icon_display'] ) { ?>
								<div class="ewf-counter__icon">
									<i class="<?php echo esc_attr( $counter['counter_icon'] ); ?>"></i>
								</div>
							<?php } ?>

							<div class="ewf-counter__content">
								<span class="<?php echo esc_attr( $class ); ?>" data-value="<?php echo ! empty( $counter['counter_number'] ) ? esc_attr( $counter['counter_number'] ) : 720; ?>" data-speed="2000"></span>
								<?php if ( ! empty( $counter['counter_symbol'] ) ) { ?>
									<span class="ewf-counter__symbol"><?php echo esc_html( $counter['counter_symbol'] ) ?></span>
								<?php } ?>
								<?php if ( ! empty( $counter['counter_title'] ) ) { ?>
									<h6 class="ewf-counter__title"><?php echo esc_html( $counter['counter_title'] ) ?></h6>
								<?php } ?>
							</div>

						</div><!-- end .ewf-counter -->
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</section>
