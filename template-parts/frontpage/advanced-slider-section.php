<?php
/**
 * Template part for displaying a page section
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Portum
 */

$frontpage = Epsilon_Page_Generator::get_instance( 'portum_frontpage_sections_' . get_the_ID(), get_the_ID() );
$fields    = $frontpage->sections[ $section_id ];
$grouping  = array(
	'values'   => $fields['slider_advanced_grouping'],
	'group_by' => 'slide_title',
);

$arr = array(
	'slider_autostart',
	'slider_infinite',
	'slider_pager',
	'slider_controls',
);
if ( is_customize_preview() ) {
	foreach ( $arr as $k ) {
		if ( is_bool( $fields[ $k ] ) ) {
			continue;
		}
		$fields[ $k ] = is_string( $fields[ $k ] ) && 'true' === $fields[ $k ] ? true : false;
	}
}
$fields['slides'] = $frontpage->get_repeater_field( $fields['slider_repeater_field'], array(), $grouping );

wp_enqueue_script( 'slick' );
wp_enqueue_style( 'slick' );
?>
<div data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>">



	<div class="<?php echo 'ewf-section-' . $fields['advanced-slider_section_visibility']; ?> ewf-slider"
		data-slider-mode-fade="<?php echo 'fade' === $fields['slider_transition'] ? 'true' : 'false'; ?>"
		data-slider-speed="<?php echo ! empty( $fields['slider_speed'] ) ? absint( $fields['slider_speed'] ) : '500'; ?>"
		data-slider-autoplay="<?php echo $fields['slider_autostart'] ? 'true' : 'false'; ?>"
		data-slider-loop="<?php echo $fields['slider_infinite'] ? 'true' : 'false'; ?>"
		data-slider-enable-pager="<?php echo $fields['slider_pager'] ? 'true' : 'false'; ?>"
		data-slider-enable-controls="<?php echo $fields['slider_controls'] ? 'true' : 'false'; ?>">

		<?php echo wp_kses( Portum_Helper::generate_pencil( 'Portum_Repeatable_Sections', 'advanced-slider' ), Epsilon_Helper::allowed_kses_pencil() ); ?>

		<ul class="ewf-slider__slides">
			<?php foreach ( $fields['slides'] as $slide ) { ?>

				<?php
				$style = array(
					'background-image' => ! empty( $slide['slide_background'] ) ? $slide['slide_background'] : '',
				);

				$css   = 'style="';
				$style = array_filter( $style );


				$style_overlay = array(
					'background-color' => ! empty( $slide['slide_background_color'] ) ? $slide['slide_background_color'] : '',
				);

				$css_overlay = '';
				if ( ! empty( $slide['slide_background_color'] ) ) {
					$css_overlay = ' style="background-color:' . esc_attr( $slide['slide_background_color'] ) . '" ';
				}

				foreach ( $style as $k => $v ) {
					if ( 'background-image' === $k ) {
						$css .= esc_attr( $k ) . ':url(' . esc_url( $v ) . ');';
					} else {
						$css .= esc_attr( $k ) . ':' . esc_attr( $v ) . ';';
					}
				}
				$css .= '"';

				$captions = array(
					'ewf-slider-slide__content' => true,
					'ewf-slider-slide__content--valign-top' => 'aligntop' === $slide['slide_vertical_alignment'] ? true : false,
					'ewf-slider-slide__content--valign-middle' => 'alignmiddle' === $slide['slide_vertical_alignment'] ? true : false,
					'ewf-slider-slide__content--valign-bottom' => 'alignbottom' === $slide['slide_vertical_alignment'] ? true : false,
					'ewf-slider-slide__content--align-left' => 'left' === $slide['slide_alignment'] ? true : false,
					'ewf-slider-slide__content--align-center' => 'center' === $slide['slide_alignment'] ? true : false,
					'ewf-slider-slide__content--align-right' => 'right' === $slide['slide_alignment'] ? true : false,
				);
				$captions = array_filter( $captions );

				?>
				<li <?php echo $css; ?>>
					<div class="ewf-slider-slide__overlay"<?php echo $css_overlay; ?>></div>

					<div class="<?php echo esc_attr( implode( ' ', array_keys( $captions ) ) ); ?>">
						<div class="ewf-slider-slide__content-wrap">
							<?php
							if ( ! empty( $slide['slide_title'] ) ) {
								echo '<h1 data-animation="' . esc_attr( $slide['slide_title_animation'] ) . '" data-delay="0">' . wpautop( wp_kses_post( $slide['slide_title'] ) ) . '</h1>';
							}

							if ( ! empty( $slide['slide_description'] ) ) {
								echo '<h6 data-animation="' . esc_attr( $slide['slide_description_animation'] ) . '" data-delay="0.2s">' . wpautop( wp_kses_post( $slide['slide_description'] ) ) . '</h6>';
							}


							if ( ! empty( $slide['slide_cta_primary_label'] ) ) {
								echo '<a class="ewf-btn ewf-btn--huge" href="' . esc_attr( $slide['slide_cta_primary_url'] ) . '" data-animation="' . esc_attr( $slide['slide_cta_primary_animation'] ) . '" data-delay="0.3s">' . wp_kses_post( $slide['slide_cta_primary_label'] ) . '</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
							}

							if ( ! empty( $slide['slide_cta_secondary_label'] ) ) {
								echo '<a class="ewf-btn ewf-btn--huge ewf-btn--secondary" href="' . esc_attr( $slide['slide_cta_secondary_url'] ) . '" data-animation="' . esc_attr( $slide['slide_cta_secondary_animation'] ) . '" data-delay="0.4s">' . wp_kses_post( $slide['slide_cta_secondary_label'] ) . '</a>';
							}
							?>
						</div><!-- end .ewf-slider-slide__content -->
					</div>
				</li>
			<?php } ?>
		</ul><!-- end .slides -->

		<div class="ewf-slider__pager ewf-slider__pager--align-center"></div>
		<div class="ewf-slider__arrows"></div>

	</div><!-- end .advanced-slider -->
</div>

