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

$attr_helper = new Epsilon_Section_Attr_Helper( $fields, 'instagram', Portum_Repeatable_Sections::get_instance() );
if ( empty( $fields['instagram_section_unique_id'] ) ) {
	$fields['instagram_section_unique_id'] = Portum_Helper::generate_section_id( 'instagram' );
}

$parent_attr    = array(
	'id'    => array( $fields['instagram_section_unique_id'] ),
	'class' => array( 'section-instagram', 'section', 'ewf-section', 'ewf-section-' . $fields['instagram_section_visibility'] ),
);

/**
 * Layout Stuff
 */
$content_class = '';
$header_class  = '';
$row_class     = '';

if ( 'left' == $fields['instagram_row_title_align'] || 'right' == $fields['instagram_row_title_align'] ) {
	$content_class = 'col-md-6';
	$header_class  = 'col-md-' . ( $fields['instagram_image'] ? '6' : '12' );
	if ( 'right' == $fields['instagram_row_title_align'] ) {
		$row_class = 'row-flow-reverse';
	}
} else {
	$content_class = 'col-md-12';
	$header_class  = 'col-md-12';
	if ( 'bottom' == $fields['instagram_row_title_align'] ) {
		$row_class = 'row-column-reverse';
	}
}
//end layout stuff
?>
<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>">
	<?php Portum_Helper::generate_inline_css( $fields['instagram_section_unique_id'], 'instagram', $fields ); ?>
	<?php echo wp_kses( Portum_Helper::generate_pencil( 'Portum_Repeatable_Sections', 'instagram' ), Epsilon_Helper::allowed_kses_pencil() ); ?>
	<div <?php $attr_helper->generate_attributes( $parent_attr ); ?>>
		<?php $attr_helper->generate_color_overlay(); ?>
		<div class="ewf-section__content">
			<div class="<?php echo esc_attr( Portum_Helper::container_class( 'instagram', $fields ) ); ?>">
				<div class="row <?php echo esc_attr( $row_class ); ?>">

					<?php if ( ! empty( $fields['instagram_subtitle'] ) || ! empty( $fields['instagram_title'] ) || ! empty( $fields['instagram_text'] ) ) { ?>
						<div class="<?php echo esc_attr( $header_class ); ?>">
							<div class="ewf-section-text">
								<?php echo wp_kses_post( Portum_Helper::generate_section_title( $fields['instagram_subtitle'], $fields['instagram_title'] ) ); ?>
								<?php echo wpautop( wp_kses_post( $fields['instagram_text'] ) ); ?>
								<?php Portum_Helper::render_button( $fields, 'instagram_button_primary' ); ?>
							</div><!--/.ewf-section-text-->
						</div><!--/.col-md-->
					<?php } // end if _subtitle, _title // ?>

				</div><!--/.row-->
			</div><!--/.container class-->
		</div><!--/.ewf-section--content-->

		<?php
		$data = get_transient( 'portum_instagram_' . $fields['instagram_access_token'] );
		if( $data === false ) {
			$response = wp_remote_get( "https://api.instagram.com/v1/users/self/media/recent/?access_token={$fields['instagram_access_token']}&count=6" );
			$data = json_decode( $response['body'] );
		}
		$photos = $data->data;
		?>

		<?php if ( $photos ) : ?>
			<div class="container-fluid section-instagram__images">
				<div class="row">
					<?php foreach ( $photos as $photo ) : ?>
						<?php $image_url = $photo->images->standard_resolution->url; ?>
						<div class="col-md-2 col-sm-3 col-xs-4 ewf-item__spacing-none">
							<a href="<?php echo esc_url( $photo->link ); ?>" rel="nofollow" target="_blank" style="background-image:url(<?php echo esc_url( $image_url ); ?>);"></a>
						</div>
					<?php endforeach; ?>
				</div><!--/.row-->
			</div><!--/.container-fluid-->
			<?php set_transient( 'portum_instagram_' . $fields['instagram_access_token'], $data, 12 * HOUR_IN_SECONDS ); ?>
		<?php endif; ?>

	</div><!--/.attr-helper-->
</section>

