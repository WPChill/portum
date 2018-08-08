<?php
/**
 * Template part for displaying afrontpage section
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Portum
 */

$frontpage = Epsilon_Page_Generator::get_instance( 'portum_frontpage_sections_' . get_the_ID(), get_the_ID() );
$fields    = $frontpage->sections[ $section_id ];
$video     = Portum_Helper::video_type( $fields['video_id'] );

$attr_helper = new Epsilon_Section_Attr_Helper( $fields, 'video', Portum_Repeatable_Sections::get_instance() );

$parent_attr = array(
	'id'    => ! empty( $fields['video_section_unique_id'] ) ? array( $fields['video_section_unique_id'] ) : array(),
	'class' => array( 'section-video', 'section', 'ewf-section', 'ewf-section-' . $fields['video_section_visibility'] ),
	'style' => array( 'background-image', 'background-position', 'background-size', 'background-repeat' ),
);

$plyr_config = array(
	'controls' => isset( $fields['video_show_controls'] ) ? $fields['video_show_controls'] : 1,
	'loop'     => array(
		'active' => isset( $fields['video_auto_loop'] ) ? $fields['video_auto_loop'] : 1,
	),
	'muted'    => isset( $fields['video_mute_mode'] ) ? $fields['video_mute_mode'] : 1,
	'autoplay' => isset( $fields['video_autoplay'] ) ? $fields['video_autoplay'] : 0,
);

wp_enqueue_style( 'plyr' );
wp_enqueue_script( 'plyr' );
?>

<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>">
	<?php echo wp_kses( Portum_Helper::generate_pencil( 'Portum_Repeatable_Sections', 'video' ), Epsilon_Helper::allowed_kses_pencil() ); ?>
	<div <?php $attr_helper->generate_attributes( $parent_attr ); ?>>
		<?php
		$attr_helper->generate_color_overlay();
		?>

		<div class="ewf-section__content">
			<div class="<?php echo esc_attr( Portum_Helper::container_class( 'video', $fields ) ); ?>">

				<div class="row">
					<?php if ( 'left' === $fields['video_row_title_align'] ) { ?>
						<div class="col-md-6">
							<div class="ewf-section-text">
								<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['video_subtitle'], $fields['video_title'] ) ); ?>
								<?php echo wpautop( wp_kses_post( $fields['video_text'] ) ); ?>
							</div>
						</div>

						<?php if ( 'none' !== $video['video_type'] ) { ?>
							<div class="col-md-6">
								<div class="portum-video-area" style="overflow: hidden; max-height: <?php echo $fields['video_max_height'] ? absint( $fields['video_max_height'] ) . 'vh' : '100vh'; ?>">
									<div data-plyr-provider="<?php echo esc_attr( $video['video_type'] ); ?>" data-plyr-embed-id="<?php echo esc_attr( $video['video_id'] ); ?>" data-plyr-config="<?php echo esc_attr( json_encode( $plyr_config ) ); ?>"></div>
								</div>
							</div>
						<?php } ?>

					<?php } elseif ( 'right' === $fields['video_row_title_align'] ) { ?>

						<?php if ( 'none' !== $video['video_type'] ) { ?>
							<div class="col-md-6">
								<div class="portum-video-area" style="overflow: hidden; max-height: <?php echo $fields['video_max_height'] ? absint( $fields['video_max_height'] ) . 'vh' : '100vh'; ?>">
									<div data-plyr-provider="<?php echo esc_attr( $video['video_type'] ); ?>" data-plyr-embed-id="<?php echo esc_attr( $video['video_id'] ); ?>" data-plyr-config="<?php echo esc_attr( json_encode( $plyr_config ) ); ?>"></div>
								</div>
							</div>
						<?php } ?>

						<div class="col-md-6">
							<div class="ewf-section-text">
								<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['video_subtitle'], $fields['video_title'], array( 'bottom' => true ) ) ); ?>
								<?php echo wpautop( wp_kses_post( $fields['video_text'] ) ); ?>
							</div>
						</div>

					<?php } else { ?>

						<div class="col-md-12">
							<div class="ewf-section-text">
								<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['video_subtitle'], $fields['video_title'] ) ); ?>
								<?php echo wpautop( wp_kses_post( $fields['video_text'] ) ); ?>
							</div>

							<?php if ( 'none' !== $video['video_type'] ) { ?>
								<div class="portum-video-area" style="overflow: hidden; max-height: <?php echo $fields['video_max_height'] ? absint( $fields['video_max_height'] ) . 'vh' : '100vh'; ?>">
									<div data-plyr-provider="<?php echo esc_attr( $video['video_type'] ); ?>" data-plyr-embed-id="<?php echo esc_attr( $video['video_id'] ); ?>" data-plyr-config="<?php echo esc_attr( json_encode( $plyr_config ) ); ?>"></div>
								</div>
							<?php } ?>

						</div>

					<?php } ?>
				</div>

			</div>
		</div>
	</div>
</section>
