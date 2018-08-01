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
	'values'   => $fields['portfolio_grouping'],
	'group_by' => 'portfolio_title',
);

$fields['portfolio_items']             = $frontpage->get_repeater_field( $fields['portfolio_repeater_field'], array(), $grouping );
$fields['portfolio_items']             = isset( $fields['portfolio_items'] ) ? $fields['portfolio_items'] : '';
$fields['portfolio_column_spacing']    = isset( $fields['portfolio_column_spacing'] ) ? $fields['portfolio_column_spacing'] : '';
$fields['portfolio_column_group']      = isset( $fields['portfolio_column_group'] ) ? $fields['portfolio_column_group'] : '';
$fields['portfolio_description_below'] = isset( $fields['portfolio_description_below'] ) ? $fields['portfolio_description_below'] : '';

$attr_helper = new Epsilon_Section_Attr_Helper( $fields, 'portfolio', Portum_Repeatable_Sections::get_instance() );
$parent_attr = array(
	'id'    => ! empty( $fields['portfolio_section_unique_id'] ) ? array( $fields['portfolio_section_unique_id'] ) : array(),
	'class' => array(
		'section-portfolio',
		'section',
		'ewf-section',
		'ewf-section-' . $fields['portfolio_section_visibility'],
	),
	'style' => array( 'background-image', 'background-position', 'background-size', 'background-repeat' ),
);

// only load scripts if we're viewing images in a lightbox
if ( $fields['portfolio_image_lightbox'] ) {
	wp_enqueue_style( 'magnificPopup' );
	wp_enqueue_script( 'magnificPopup' );
}
?>

<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>">
	<?php echo wp_kses( Portum_Helper::generate_pencil( 'Portum_Repeatable_Sections', 'portfolio' ), Epsilon_Helper::allowed_kses_pencil() ); ?>
	<div <?php $attr_helper->generate_attributes( $parent_attr ); ?>>
		<?php
		$attr_helper->generate_color_overlay();
		$attr_helper->generate_video_overlay();
		?>

		<div class="ewf-section__content">
			<div class="<?php echo esc_attr( Portum_Helper::container_class( 'portfolio', $fields ) ); ?>">

				<div class="row">
					<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['portfolio_subtitle'], $fields['portfolio_title'] ) ); ?>

					<?php if ( ! empty( $fields['portfolio_items'] ) ) { ?>
						<ul class="ewf-portfolio ewf-portfolio--spacing-<?php echo esc_attr( $fields['portfolio_column_spacing'] ); ?> ewf-portfolio--columns-<?php echo esc_attr( $fields['portfolio_column_group'] ); ?>">

							<?php foreach ( $fields['portfolio_items'] as $key => $item ) { ?>
								<li>
									<div class="ewf-portfolio-item">
										<?php
										echo wp_kses( Epsilon_Helper::generate_field_repeater_pencil( $key, 'portum_portfolio_section', 'portum_portfolio' ), Epsilon_Helper::allowed_kses_pencil() );
										?>
										<div class="ewf-portfolio-item__thumbnail">
											<?php if ( ! empty( $item['portfolio_image'] ) ) { ?>
												<img src="<?php echo esc_url( $item['portfolio_image'] ); ?>" alt="" />
											<?php } ?>

											<div class="ewf-portfolio-item__overlay">

												<?php if ( 'false' === $fields['portfolio_description_below'] || null == $fields['portfolio_description_below'] ) { ?>
													<div class="ewf-portfolio-item__details">
														<?php if ( ! empty( $item['portfolio_title'] ) ) { ?>
															<h5>
																<a href="<?php echo esc_url( $item['portfolio_link'] ); ?>"><?php echo wp_kses_post( $item['portfolio_title'] ); ?></a>
															</h5>
														<?php } ?>

														<?php echo '<div class="ewf-portfolio-item__description">' . wp_kses_post( $item['portfolio_description'] ) . '</div>'; ?>
													</div><!-- ewf-portfolio-item__details -->
												<?php } ?>
												<?php // the str_replace below is used to remove the image size from the lightbox image; defined by: 'size'    => 'portum-portfolio-image' in fields.php ?>

												<?php if ( $fields['portfolio_image_lightbox'] ) { ?>
													<a class="ewf-portfolio-item__control-zoom magnific-link" href="<?php echo esc_url( str_replace( '-400x450', '', $item['portfolio_image'] ) ); ?>">
														<i class="fa fa-eye"></i>
													</a>
												<?php } else { ?>
													<a class="ewf-portfolio-item__control-zoom" href="<?php echo esc_url( $item['portfolio_link'] ); ?>">
														<i class="fa fa-eye"></i>
													</a>
												<?php } ?>

											</div><!-- ewf-portfolio-item__overlay -->

										</div><!-- ewf-portfolio-item__thumbnail -->

										<?php if ( null != $fields['portfolio_description_below'] && 'false' !== $fields['portfolio_description_below'] ) { ?>
											<div class="ewf-portfolio-item__details">
												<?php if ( ! empty( $item['portfolio_title'] ) ) { ?>
													<h5>
														<a href="<?php echo esc_url( $item['portfolio_link'] ); ?>"><?php echo wp_kses_post( $item['portfolio_title'] ); ?></a>
													</h5>
												<?php } ?>

												<?php echo '<div class="ewf-portfolio-item__description">' . wp_kses_post( $item['portfolio_description'] ) . '</div>'; ?>
											</div><!-- ewf-portfolio-item__details -->
										<?php } ?>

									</div><!-- ewf-portfolio-item -->
								</li>
							<?php } ?>

						</ul>
					<?php } ?>
				</div>

			</div>
		</div>
	</div>
</section>
