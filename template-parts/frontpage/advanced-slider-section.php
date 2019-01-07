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
$fields['slides'] = $frontpage->get_repeater_field( $fields['slider_repeater_field'], array(), $grouping );

$fields['slider_autostart']  = (boolean) json_decode( strtolower( $fields['slider_autostart'] ) );
$fields['slider_infinite']  = (boolean) json_decode( strtolower( $fields['slider_infinite'] ) );
$fields['slider_pager']  = (boolean) json_decode( strtolower( $fields['slider_pager'] ) );
$fields['slider_controls']  = (boolean) json_decode( strtolower( $fields['slider_controls'] ) );
$fields['slider_slides_shown']  = isset( $fields['slider_slides_shown'] ) ? $fields['slider_slides_shown'] : 1;
$fields['slider_slides_scrolled']  = isset( $fields['slider_slides_scrolled'] ) ? $fields['slider_slides_scrolled'] : 1;
$fields['slider_height']  = isset( $fields['slider_height'] ) ? $fields['slider_height'] : 50;

wp_enqueue_script( 'slick' );
wp_enqueue_style( 'slick' );
?>
<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>">

	<div class="ewf-advanced-slider <?php echo 'ewf-section-' . $fields['advanced-slider_section_visibility']; ?> ewf-slider"
	     data-slider-speed="<?php echo ! empty( $fields['slider_speed'] ) ? absint( $fields['slider_speed'] ) : '500'; ?>"
	     data-slider-autoplay="<?php echo $fields['slider_autostart'] ? 'true' : 'false'; ?>"
	     data-slides-shown="<?php echo esc_attr( $fields['slider_slides_shown'] ); ?>"
	     data-slides-scrolled="<?php echo esc_attr( $fields['slider_slides_scrolled'] ); ?>"
	     data-slider-loop="<?php echo $fields['slider_infinite'] ? 'true' : 'false'; ?>"
	     data-slider-enable-pager="<?php echo $fields['slider_pager'] ? 'true' : 'false'; ?>"
	     data-slider-enable-controls="<?php echo $fields['slider_controls'] ? 'true' : 'false'; ?>">

		<?php echo wp_kses( Portum_Helper::generate_pencil( 'Portum_Repeatable_Sections', 'advanced-slider' ), Epsilon_Helper::allowed_kses_pencil() ); ?>

		<ul class="ewf-slider__slides">
			<?php foreach ( $fields['slides'] as $slide ) { ?>

				<?php
				$style         = array(
					'background-image' => ! empty( $slide['slide_background'] ) ? $slide['slide_background'] : '',
					'height'           => esc_attr( $fields['slider_height'] ) . 'vh;',
				);
				$css           = 'style="';
				$style         = array_filter( $style );
				$style_overlay = array(
					'background-color' => ! empty( $slide['slide_background_color'] ) ? $slide['slide_background_color'] : '',
				);
				$css_overlay   = '';
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
				$css      .= '"';
				$captions = array(
					'ewf-slider-slide__content' => true,
					'ewf-valign--top'           => 'aligntop' === $slide['slide_vertical_alignment'] ? true : false,
					'ewf-valign--middle'        => 'alignmiddle' === $slide['slide_vertical_alignment'] ? true : false,
					'ewf-valign--bottom'        => 'alignbottom' === $slide['slide_vertical_alignment'] ? true : false,
					'ewf-text-align--left'      => 'left' === $slide['slide_alignment'] ? true : false,
					'ewf-text-align--center'    => 'center' === $slide['slide_alignment'] ? true : false,
					'ewf-text-align--right'     => 'right' === $slide['slide_alignment'] ? true : false,
				);
				$captions = array_filter( $captions );

				$slide_width = 'max-width: ' . ( ! empty( $slide['slide_content_width'] ) ? esc_attr( $slide['slide_content_width'] ) : '100' ) . '%;';

				$slide_title_color       = 'color: ' . ( ! empty( $slide['slide_title_color'] ) ? esc_attr( $slide['slide_title_color'] ) : 'initial' ) . ';';
				$slide_title_size        = 'font-size: ' . ( ! empty( $slide['slide_title_size'] ) ? esc_attr( $slide['slide_title_size'] . 'px;' ) : 'initial;' );
				$slide_title_line_height = 'line-height: ' . ( ! empty( $slide['slide_title_size'] ) ? esc_attr( $slide['slide_title_size'] * 1.25 . 'px;' ) : 'initial;' );

				$slide_description_color       = 'color: ' . ( ! empty( $slide['slide_description_color'] ) ? esc_attr( $slide['slide_description_color'] ) : 'initial' ) . ';';
				$slide_description_size        = 'font-size: ' . ( ! empty( $slide['slide_description_size'] ) ? esc_attr( $slide['slide_description_size'] . 'px;' ) : 'initial;' );
				$slide_description_line_height = 'line-height: ' . ( ! empty( $slide['slide_description_size'] ) ? esc_attr( $slide['slide_description_size'] * 1.75 . 'px;' ) : 'initial;' );
				?>
				<li <?php echo $css; ?>>
					<div class="ewf-slider-slide__overlay"<?php echo $css_overlay; ?>></div>

					<div class="<?php echo esc_attr( implode( ' ', array_keys( $captions ) ) ); ?>">
						<div class="ewf-slider-slide__content-wrap" style="<?php echo esc_attr( $slide_width ); ?>">
							<?php
							if ( ! empty( $slide['slide_title'] ) ) {
								echo '<div class="ewf-like-h1" style="margin-bottom: 0; margin-top: 0;' . esc_attr( $slide_title_color . $slide_title_size . $slide_title_line_height ) . '">' . wp_kses_post( $slide['slide_title'] ) . '</div>';
							}

							if ( ! empty( $slide['slide_description'] ) ) {
								echo '<p style="' . esc_attr( $slide_description_color . $slide_description_size . $slide_description_line_height ) . '">' . wp_kses_post( $slide['slide_description'] ) . '</p>';
							}

							Portum_Helper::render_button( $slide, 'slide_cta_primary' );
							Portum_Helper::render_button( $slide, 'slide_cta_secondary' );

							?>
						</div><!-- end .ewf-slider-slide__content -->
					</div>
				</li>
			<?php } ?>
		</ul><!-- end .slides -->

		<div class="ewf-slider__pager ewf-slider__pager--align-center"></div>
		<div class="ewf-slider__arrows"></div>

	</div><!-- end .advanced-slider -->
</section>

