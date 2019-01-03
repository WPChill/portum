<?php
/**
 * Template part for displaying afrontpage section
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Portum
 */

$frontpage   = Epsilon_Page_Generator::get_instance( 'portum_frontpage_sections_' . get_the_ID(), get_the_ID() );
$fields      = $frontpage->sections[ $section_id ];
$video       = Portum_Helper::video_type( $fields['video_id'] );
$row_class   = '';
$attr_helper = new Epsilon_Section_Attr_Helper( $fields, 'video', Portum_Repeatable_Sections::get_instance() );
if ( empty( $fields['video_section_unique_id'] ) ) {
	$fields['video_section_unique_id'] = Portum_Helper::generate_section_id( 'video' );
}

$parent_attr = array(
	'id'    => array( $fields['video_section_unique_id'] ),
	'class' => array( 'section-video', 'section', 'ewf-section', 'ewf-section-' . $fields['video_section_visibility'] ),
);

$fields['video_show_controls']  = (boolean) json_decode( strtolower( $fields['video_show_controls'] ) );
$fields['video_auto_loop']  = (boolean) json_decode( strtolower( $fields['video_auto_loop'] ) );
$fields['video_mute_mode']  = (boolean) json_decode( strtolower( $fields['video_mute_mode'] ) );
$fields['video_autoplay']  = (boolean) json_decode( strtolower( $fields['video_autoplay'] ) );


$plyr_config = array(
	'controls' => $fields['video_show_controls'] ? array(
		'play-large',
		'play',
		'progress',
		'current-time',
		'mute',
		'volume',
		'captions',
		'settings',
		'pip',
		'airplay',
		'fullscreen',
	) : array(),
	'loop'     => array(
		'active' => $fields['video_auto_loop'],
	),
	'muted'    => $fields['video_mute_mode'],
	'autoplay' => $fields['video_autoplay'],
);

wp_enqueue_style( 'plyr' );
wp_enqueue_script( 'plyr' );

if ( 'left' == $fields['video_row_title_align'] || 'right' == $fields['video_row_title_align'] ) {
	$content_class = 'col-md-6';
	$header_class  = 'col-md-6';
	if ( 'right' == $fields['video_row_title_align'] ) {
		$row_class = 'row-flow-reverse';
	}
} else {
	$content_class = 'col-md-12';
	$header_class  = 'col-md-12';
	if ( 'bottom' == $fields['video_row_title_align'] ) {
		$row_class = 'row-column-reverse';
	}
}
?>

<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>">
	<?php Portum_Helper::generate_inline_css( $fields['video_section_unique_id'], 'video', $fields ); ?>
	<?php echo wp_kses( Epsilon_Helper::generate_pencil( 'Portum_Repeatable_Sections', 'video' ), Epsilon_Helper::allowed_kses_pencil() ); ?>
	<div <?php $attr_helper->generate_attributes( $parent_attr ); ?>>
		<?php
		$attr_helper->generate_color_overlay();
		?>
		<div class="ewf-section__content">
			<div class="<?php echo esc_attr( Portum_Helper::container_class( 'video', $fields ) ); ?>">

				<div class="row <?php echo esc_attr( $row_class ); ?>">
					<?php if ( ! empty( $fields['video_subtitle'] ) || ! empty( $fields['video-title'] ) ) { ?>
						<div class="<?php echo esc_attr( $header_class ); ?>">
							<div class="ewf-section-text">
								<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['video_subtitle'], $fields['video_title'] ) ); ?><?php echo wpautop( wp_kses_post( $fields['video_text'] ) ); ?>
							</div><!--/.ewf-section--text-->
						</div><!--/.col-->
					<?php } ?>

					<?php if ( 'none' !== $video['video_type'] ) { ?>
						<div class="<?php echo esc_attr( $header_class ); ?>">
							<div class="portum-video-area" style="overflow: hidden; max-height: <?php echo ! empty( $fields['video_max_height'] ) ? absint( $fields['video_max_height'] ) . 'vh' : '100vh'; ?>">
								<div data-plyr-provider="<?php echo esc_attr( $video['video_type'] ); ?>" data-plyr-embed-id="<?php echo esc_attr( $video['video_id'] ); ?>" data-plyr-config="<?php echo esc_attr( json_encode( $plyr_config ) ); ?>"></div>
							</div><!--/.portum-video-area-->
						</div><!--/.col--->
					<?php }//end if ?>

				</div><!--/.row-->
			</div><!--/.container-class-->
		</div><!--/.ewf-section__content-->
	</div><!--/.generate-attribute-->
</section><!--/.video-section-->
