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

if ( $fields['portfolio_slider'] ) {
	wp_enqueue_script( 'slick' );
	wp_enqueue_style( 'slick' );
}


/**
 * Layout stuff
 */
$content_class = '';
$header_class  = '';
$row_class     = '';
$item_spacing  = 'ewf-item__spacing-' . ( isset( $fields['portfolio_column_spacing'] ) ? $fields['portfolio_column_spacing'] : '' );

if ( 'left' == $fields['portfolio_row_title_align'] || 'right' == $fields['portfolio_row_title_align'] ) {
	$content_class = 'col-sm-8 ewf-content__wrap';
	$header_class  = 'col-sm-4';
	if ( 'right' == $fields['portfolio_row_title_align'] ) {
		$row_class = 'row-flow-reverse';
	}
} else {
	$content_class = 'col-sm-12 ewf-content__wrap';
	$header_class  = 'col-sm-12';
	if ( 'bottom' == $fields['portfolio_row_title_align'] ) {
		$row_class = 'row-column-reverse';
	}
}
$item_class        = 'col-sm-' . ( 12 / absint( $fields['portfolio_column_group'] ) );
$item_effect_style = ( ! empty( $fields['portfolio_item_style'] ) ? esc_attr( $fields['portfolio_item_style'] ) : 'ewf-item__no-effect' );
// end layout stuff

?>

<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>">
	<?php echo wp_kses( Epsilon_Helper::generate_pencil( 'Portum_Repeatable_Sections', 'portfolio' ), Epsilon_Helper::allowed_kses_pencil() ); ?>
	<div <?php $attr_helper->generate_attributes( $parent_attr ); ?>>
		<?php
		$attr_helper->generate_color_overlay();
		?>

		<div class="ewf-section__content">
			<div class="<?php echo esc_attr( Portum_Helper::container_class( 'portfolio', $fields ) ); ?>">

				<div class="row <?php echo esc_attr( $row_class ); ?>">

					<?php if ( ! empty( $fields['portfolio_title'] ) || ! empty( $fields['portfolio_subtitle'] ) ) { ?>
						<div class="<?php echo esc_attr( $header_class ); ?>">
							<div class="ewf-section-text">
								<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['portfolio_subtitle'], $fields['portfolio_title'] ) ); ?>
							</div><!--/.ewf-section--text-->
						</div><!--/.header class-->
					<?php } ?>

					<div class="<?php echo esc_attr( $content_class ); ?>">
						<?php if ( ! empty( $fields['portfolio_items'] ) ) { ?>
						<?php foreach ( $fields['portfolio_items'] as $key => $item ) { ?>
						<div class="<?php echo esc_attr( $item_class . ' ' . $item_spacing ); ?>">
							<?php if ( $fields['portfolio_description_below'] ) { ?>
							<div class="ewf-portfolio-item ewf-portfolio__has-description-below <?php echo esc_attr( $item_effect_style ); ?>">
								<?php } else { ?>
								<div class="ewf-portfolio-item <?php echo esc_attr( $item_effect_style ); ?>">
									<?php } ?>
									<li>
										<?php
										echo wp_kses( Epsilon_Helper::generate_field_repeater_pencil( $key, 'portum_portfolio_section', 'portum_portfolio' ), Epsilon_Helper::allowed_kses_pencil() );
										?>
										<div class="ewf-portfolio-item__thumbnail">
											<?php if ( ! empty( $item['portfolio_image'] ) ) { ?>
												<img src="<?php echo esc_url( $item['portfolio_image'] ); ?>" alt="" />
											<?php } ?>

											<div class="ewf-portfolio-item__overlay">

												<?php if ( ! $fields['portfolio_description_below'] && $fields['portfolio_image_show_description'] ) { ?>
													<div class="ewf-portfolio-item__details">
														<?php if ( ! empty( $item['portfolio_title'] ) ) { ?>
															<div class="ewf-like-h6">
																<a href="<?php echo esc_url( $item['portfolio_link'] ); ?>"><?php echo wp_kses_post( $item['portfolio_title'] ); ?></a>
															</div><!--/.ewf-like-h6-->
														<?php } ?>

														<div class="ewf-portfolio-item__description">
															<?php echo wp_kses_post( $item['portfolio_description'] ); ?>
														</div><!--/.ewf-portfolio-item__description-->¬
													</div><!-- /.ewf-portfolio-item__details -->
												<?php } ?>

												<?php // the str_replace below is used to remove the image size from the lightbox image; defined by: 'size'    => 'portum-portfolio-image' in fields.php ?>

												<?php if ( $fields['portfolio_image_lightbox'] ) { ?>
													<a class="ewf-portfolio-item__control-zoom magnific-link" href="<?php echo esc_url( str_replace( '-400x450', '', $item['portfolio_image'] ) ); ?>">
														<i class="fa fa-eye"></i>
													</a><!--/.ewf-portfolio-item__control-zoom magnific-link-->
												<?php } else { ?>
													<a class="ewf-portfolio-item__control-zoom" href="<?php echo esc_url( $item['portfolio_link'] ); ?>">
														<i class="fa fa-eye"></i>
													</a><!--/.ewf-portfolio-item__control-zoom-->
												<?php } ?>

											</div><!-- ewf-portfolio-item__overlay -->
										</div><!-- ewf-portfolio-item__thumbnail -->

										<?php if ( $fields['portfolio_description_below'] && ! $fields['portfolio_image_show_description'] ) { ?>
											<div class="ewf-portfolio-item__details">
												<?php if ( ! empty( $item['portfolio_title'] ) ) { ?>
													<div class="ewf-like-h6">
														<a href="<?php echo esc_url( $item['portfolio_link'] ); ?>"><?php echo wp_kses_post( $item['portfolio_title'] ); ?></a>
													</div><!--/.ewf-like-h6-->
												<?php } ?>

												<div class="ewf-portfolio-item__description">
													<?php echo wp_kses_post( $item['portfolio_description'] ); ?>
												</div><!--/.ewf-portfolio-item__description-->
											</div><!-- ewf-portfolio-item__details -->
										<?php } ?>
									</li>
								</div><!-- ewf-portfolio-item -->
							</div><!--/.itemclass item spacing-->
							<?php } ?>
							<?php } ?>
						</div><!--/.content class-->
					</div><!--/.row-->
				</div><!--/.class-attr-->
			</div><!--/.ewf-section__content-->
		</div><!--/.parent-attr-->
</section>
