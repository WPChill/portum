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
	'values'   => $fields['piecharts_grouping'],
	'group_by' => 'piechart_title',
);

$fields['piecharts'] = $frontpage->get_repeater_field( $fields['piecharts_repeater_field'], array(), $grouping );

$span                = 12 / absint( $fields['piecharts_column_group'] );

$color = get_theme_mod( 'epsilon_accent_color', '#cc263d' );

$attr_helper       = new Epsilon_Section_Attr_Helper( $fields, 'piecharts', Portum_Repeatable_Sections::get_instance() );
$parent_attr       = array(
	'class' => array( 'section-piecharts', 'section', 'ewf-section' ),
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

		<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['piecharts_subtitle'], $fields['piecharts_title'] ) ); ?>

		<div class="<?php echo esc_attr( Portum_Helper::container_class( 'piecharts', $fields ) ); ?>">
			<div class="row">
				<?php foreach ( $fields['piecharts'] as $piechart ) { ?>
					<div class="col-md-<?php echo absint( $span ); ?>">
						<div class="ewf-pie">
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
							<?php if ( ! empty( $piechart['piechart_title'] ) ) { ?>
								<h6 class="ewf-pie__title"><?php echo esc_html( $piechart['piechart_title'] ); ?></h6>
							<?php } ?>

							<?php if ( ! empty( $piechart['piechart_text'] ) ) { ?>
								<p class="ewf-pie__description"><?php echo wp_kses_post( $piechart['piechart_text'] ); ?> </p>
							<?php } ?>

						</div><!-- end .ewf-pie -->
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</section>
