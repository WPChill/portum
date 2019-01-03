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

$fields['clientlist_slider']  = (boolean) json_decode( strtolower( $fields['clientlist_slider'] ) );
$fields['clientlist_slider_autostart']  = (boolean) json_decode( strtolower( $fields['clientlist_slider_autostart'] ) );
$fields['clientlist_slider_infinite']  = (boolean) json_decode( strtolower( $fields['clientlist_slider_infinite'] ) );
$fields['clientlist_slider_pager']  = (boolean) json_decode( strtolower( $fields['clientlist_slider_pager'] ) );
$fields['clientlist_slider_arrows']  = (boolean) json_decode( strtolower( $fields['clientlist_slider_arrows'] ) );

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
);


$span        = 12 / absint( $fields['clientlist_column_group'] );

if ( $fields['clientlist_slider'] ) {
	wp_enqueue_script( 'slick' );
	wp_enqueue_style( 'slick' );
}

/**
 * Layout stuff
 */
$content_class = '';
$header_class  = '';
$row_class     = '';
$item_spacing  = 'ewf-item__spacing-' . ( isset( $fields['clientlist_column_spacing'] ) ? $fields['clientlist_column_spacing'] : '' );

if ( 'left' == $fields['clientlist_row_title_align'] || 'right' == $fields['clientlist_row_title_align'] ) {
	$content_class = 'col-sm-8 ewf-content__wrap';
	$header_class  = 'col-sm-4';
	if ( 'right' == $fields['clientlist_row_title_align'] ) {
		$row_class = 'row-flow-reverse';
	}
} else {
	$content_class = 'col-sm-12 ewf-content__wrap';
	$header_class  = 'col-sm-12';
	if ( 'bottom' == $fields['clientlist_row_title_align'] ) {
		$row_class = 'row-column-reverse';
	}
}
$item_class        = 'col-sm-' . ( 12 / absint( $fields['clientlist_column_group'] ) );
$item_effect_style = ( ! empty( $fields['clientlist_item_style'] ) ? esc_attr( $fields['clientlist_item_style'] ) : 'ewf-item__no-effect' );

/**
 * Item Style
 */
$item_element_class = '';
$item_style         = array();

if ( 'ewf-item__border' != $fields['item_style'] ) {
	$item_element_class = $fields['item_style'];
}else{
	$item_element_class = $fields['item_border_style'];

	if ( ! empty( $fields['item_border_color'] ) ) {
		$item_style[] = 'border-color: ' . esc_attr( $fields['item_border_color'] ) . ';';
	}

	if ( ! empty( $fields['item_border_width'] ) ) {
		$item_style[] = 'border-width: ' . esc_attr( $fields['item_border_width'] ) . 'px;';
	}
}

// end layout stuff

?>
<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>">
	<?php Portum_Helper::generate_inline_css( $section_id, 'clientlist', $fields ); ?>
	<?php echo wp_kses( Portum_Helper::generate_pencil( 'Portum_Repeatable_Sections', 'clientlist' ), Epsilon_Helper::allowed_kses_pencil() ); ?>
	<div <?php $attr_helper->generate_attributes( $parent_attr ); ?>>
		<?php
		$attr_helper->generate_color_overlay();
		?>

		<div class="ewf-section__content">
			<div class="<?php echo esc_attr( Portum_Helper::container_class( 'clientlist', $fields ) ); ?>">
				<div class="row <?php echo esc_attr( $row_class ); ?>">

					<?php if ( ! empty( $fields['clientlist_subtitle'] ) || ! empty( $fields['clientlist_title'] ) ) { ?>
						<div class="<?php echo esc_attr( $header_class ); ?>">
							<div class="ewf-section-text">
								<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['clientlist_subtitle'], $fields['clientlist_title'] ) ); ?>
							</div><!--/.ewf-section--text-->
						</div><!--/.col-->
					<?php } ?>

					<div class="<?php echo esc_attr( $content_class ); ?>">
						<?php if ( $fields['clientlist_slider'] ) { ?>

						<div class="ewf-slider" data-slider-mode-fade="false"
						     data-slider-speed="<?php echo ! empty( $fields['clientlist_slider_speed'] ) ? absint( $fields['clientlist_slider_speed'] ) : '500'; ?>"
						     data-slider-autoplay="<?php echo $fields['clientlist_slider_autostart'] ? 'true' : 'false'; ?>"
						     data-slides-shown="<?php echo $fields['clientlist_slides_shown'] ? esc_attr( $fields['clientlist_slides_shown'] ) : '1'; ?>"
						     data-slides-scrolled="<?php echo $fields['clientlist_slides_scrolled'] ? esc_attr( $fields['clientlist_slides_scrolled'] ) : '1'; ?>"
						     data-slider-loop="<?php echo $fields['clientlist_slider_infinite'] ? 'true' : 'false'; ?>"
						     data-slider-enable-pager="<?php echo $fields['clientlist_slider_pager'] ? 'true' : 'false'; ?>"
						     data-slider-enable-controls="<?php echo $fields['clientlist_slider_arrows'] ? 'true' : 'false'; ?>">

							<ul class="ewf-slider__slides">

								<?php } else { ?>
								<ul class="ewf-partners-list">
									<?php } ?>

									<?php foreach ( $fields['clients'] as $key => $client ) { ?>
										<div class="<?php echo esc_attr( $item_class ); ?>">
											<li class="ewf-partner <?php echo esc_attr( $item_element_class ); ?>" style="<?php echo esc_attr( implode( ';', $item_style ) ); ?>">
												<?php echo wp_kses( Epsilon_Helper::generate_field_repeater_pencil( $key, 'portum_clientlists_section', 'portum_clients' ), Epsilon_Helper::allowed_kses_pencil() ); ?>

												<?php if ( ! empty( $client['client_url'] ) ) { ?>
												<a href="<?php echo $client['client_url']; ?>">
													<?php } ?>

													<img src="<?php echo esc_url( $client['client_logo'] ); ?>" alt="<?php esc_attr( $client['client_title'] ); ?>">

													<?php if ( ! empty( $client['client_url'] ) ) { ?>
												</a>
											<?php } ?>

											</li><!-- end .ewf-partner -->
										</div><!--/.col-sm-->
									<?php } ?>

									<?php if ( $fields['clientlist_slider'] ) { ?>
								</ul><!-- end .ewf-partner-slider__slides -->

								<div class="ewf-slider__pager"></div>
								<div class="ewf-slider__arrows"></div>
						</div><!-- end .ewf-slider -->

						<?php } else { ?>

						</ul><!-- end .ewf-partners-list -->

						<?php } ?>
					</div><!-- content class -->
				</div><!--row class-->
			</div><!-- container class -->
		</div><!--/.ewf-section--content-->
	</div><!--/ generate attr -->
</section>

