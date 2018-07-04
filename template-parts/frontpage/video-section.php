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
$video     = Portum_Helper::video_type( $fields['video_id'] );

$attr_helper = new Epsilon_Section_Attr_Helper( $fields, 'video', Portum_Repeatable_Sections::get_instance() );

$parent_attr = array(
	'id'    => ! empty( $fields['video_section_unique_id'] ) ? array( $fields['video_section_unique_id'] ) : array(),
	'class' => array( 'section-video', 'section', 'ewf-section', 'ewf-section-' . $fields['video_section_visibility'] ),
	'style' => array( 'background-image', 'background-position', 'background-size', 'background-repeat' ),
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
							<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['video_subtitle'], $fields['video_title'] ) ); ?>
							<?php echo wpautop( wp_kses_post( $fields['video_text'] ) ); ?>
						</div>

						<div class="col-md-6">
							<div class="video-area auto-resizable-iframe">
								<div data-type="<?php echo esc_attr( $video['video_type'] ); ?>" data-video-id="<?php echo esc_attr( $video['video_id'] ); ?>"></div>
							</div>
						</div>

					<?php } elseif ( 'right' === $fields['video_row_title_align'] ) { ?>

						<div class="col-md-6">
							<div class="video-area auto-resizable-iframe">
								<div data-type="<?php echo esc_attr( $video['video_type'] ); ?>" data-video-id="<?php echo esc_attr( $video['video_id'] ); ?>"></div>
							</div>
						</div>

						<div class="col-md-6">
							<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['video_subtitle'], $fields['video_title'], array( 'bottom' => true ) ) ); ?>
							<?php echo wpautop( wp_kses_post( $fields['video_text'] ) ); ?>
						</div>

					<?php } else { ?>

						<div class="col-md-12">
							<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['video_subtitle'], $fields['video_title'] ) ); ?>
							<?php echo wpautop( wp_kses_post( $fields['video_text'] ) ); ?>

							<?php if ( 'none' !== $video['video_type'] ) { ?>
								<div class="video-area auto-resizable-iframe">
									<div data-type="<?php echo esc_attr( $video['video_type'] ); ?>" data-video-id="<?php echo esc_attr( $video['video_id'] ); ?>"></div>
								</div>
							<?php } ?>

						</div>

					<?php } ?>
				</div>

			</div>
		</div>
	</div>
</section>
