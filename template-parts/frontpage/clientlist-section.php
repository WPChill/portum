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
	'values'   => $fields['clientlist_grouping'],
	'group_by' => 'client_title',
);

$fields['clients']                   = $frontpage->get_repeater_field( $fields['clientlist_repeater_field'], array(), $grouping );
$attr_helper                         = new Epsilon_Section_Attr_Helper( $fields, 'clientlist', Portum_Repeatable_Sections::get_instance() );
$fields['clientlist_column_spacing'] = isset( $fields['clientlist_column_spacing'] ) ? $fields['clientlist_column_spacing'] : '';

$parent_attr = array(
	'id'    => ! empty( $fields['clientlist_section_unique_id'] ) ? array( $fields['clientlist_section_unique_id'] ) : array(),
	'class' => array(
		'section-clientlist',
		'section',
		'ewf-section',
		'ewf-section-' . $fields['clientlist_section_visibility'],
	),
	'style' => array( 'background-image', 'background-position', 'background-size', 'background-repeat' ),
);
$span        = 12 / absint( $fields['clientlist_column_group'] );

if ( $fields['clientlist_slider'] ) {
	wp_enqueue_script( 'slick' );
	wp_enqueue_style( 'slick' );
}

?>
<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>">
	<?php Portum_Helper::generate_css_color_tabs( $section_id, 'clientlist', $fields ); ?>
	<?php echo wp_kses( Portum_Helper::generate_pencil( 'Portum_Repeatable_Sections', 'clientlist' ), Epsilon_Helper::allowed_kses_pencil() ); ?>
	<div <?php $attr_helper->generate_attributes( $parent_attr ); ?>>
		<?php
		$attr_helper->generate_color_overlay();
		?>

		<div class="ewf-section__content">
			<div class="<?php echo esc_attr( Portum_Helper::container_class( 'clientlist', $fields ) ); ?>">

				<div class="row">
					<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['clientlist_subtitle'], $fields['clientlist_title'] ) ); ?>
				</div>

				<div class="row">
					<div class="col-sm-12">
						<?php if ( $fields['clientlist_slider'] ) { ?>
						<div class="ewf-slider" data-slider-mode-fade="false"
						     data-slider-speed="<?php echo ! empty( $fields['clientlist_slider_speed'] ) ? absint( $fields['clientlist_slider_speed'] ) : '500'; ?>"
						     data-slider-autoplay="<?php echo $fields['clientlist_slider_autostart'] ? 'true' : 'false'; ?>"
						     data-slides-shown="<?php echo $fields['clientlist_slides_shown'] ? esc_attr( $fields['clientlist_slides_shown'] ) : '1'; ?>"
						     data-slides-scrolled="<?php echo $fields['clientlist_slides_scrolled'] ? esc_attr( $fields['clientlist_slides_scrolled'] ) : '1'; ?>"
						     data-slider-loop="<?php echo $fields['clientlist_slider_infinite'] ? 'true' : 'false'; ?>"
						     data-slider-enable-pager="<?php echo $fields['clientlist_slider_pager'] ? 'true' : 'false'; ?>"
						     data-slider-enable-controls="false">

							<ul class="ewf-slider__slides">

								<?php } else { ?>
								<ul class="ewf-partners-list">
									<?php } ?>

									<?php foreach ( $fields['clients'] as $key => $client ) { ?>
										<div class="col-sm-<?php echo esc_attr( $span ); ?> ewf-item__spacing-<?php echo esc_attr( $fields['clientlist_column_spacing'] ); ?>">

											<li>
												<div class="ewf-partner">
													<?php
													echo wp_kses( Epsilon_Helper::generate_field_repeater_pencil( $key, 'portum_clientlists_section', 'portum_clients' ), Epsilon_Helper::allowed_kses_pencil() );
													?>
													<a href="<?php echo ! empty( $client['client_url'] ) ? esc_url( $client['client_url'] ) : '#'; ?>">
														<img src="<?php echo esc_url( $client['client_logo'] ); ?>" alt="<?php esc_attr( $client['client_title'] ); ?>">
													</a>
												</div><!-- end .ewf-partner -->
											</li>
										</div><!--/.col-sm-->
									<?php } ?>

									<?php if ( '1' == $fields['clientlist_slider'] || 'true' === $fields['clientlist_slider'] ) { ?>
								</ul><!-- end .ewf-partner-slider__slides -->

								<div class="ewf-slider__pager"></div>
						</div><!-- end .ewf-slider -->

						<?php } else { ?>

						</ul><!-- end .ewf-partners-list -->

						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

