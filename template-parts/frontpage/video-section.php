<?php
/**
 * Template part for displaying a frontpage section
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Portum
 */

$frontpage = Portum_Frontpage::get_instance( 'portum_frontpage_sections' );
$fields    = $frontpage->sections[ $section_id ];
?>

<section data-customizer-section-id="portum_repeatable_section" data-section="<?php echo esc_attr( $section_id ); ?>">
	<div class="section-video section">
		<div class="video-area auto-resizable-iframe">
			<div data-type="<?php echo esc_attr( $fields['video_type'] ); ?>" data-video-id="<?php echo esc_attr( $fields['video_id'] ); ?>"></div>
		</div>
		<div class="info-area">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<?php echo wpautop( wp_kses_post( $fields['video_cta'] ) ); ?>
					</div>
					<div class="col-md-6">
						<div class="newsletter">
							<?php
							if ( function_exists( 'mailchimpSF_signup_form' ) ) {
								$api = mailchimpSF_get_api();
								if ( $api ) {
									mailchimpSF_signup_form();
								}
							}; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
