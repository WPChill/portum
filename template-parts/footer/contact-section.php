<?php
/**
 * Template part for displaying contact section before the footer
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Portum
 */

$frontpage = Epsilon_Page_Generator::get_instance();
?>

<?php $api = get_theme_mod( 'portum_google_api_key', '' ); ?>

<section class="section-contact section <?php echo empty( $api ) ? 'no-map' : ''; ?>">
	<?php if ( ! empty( $api ) ) : ?>
		<div class="contact-overlay"></div>
		<div class="contact-map" id="contact-map" data-zoom="<?php echo esc_attr( get_theme_mod( 'portum_google_map_zoom', 17 ) ); ?>" data-address="<?php echo esc_attr( get_theme_mod( 'portum_google_map_address', 'Centrul Vechi, Brasov' ) ); ?>"></div>
	<?php endif; ?>

	<div class="container">
		<div class="contact-details">
			<?php echo wp_kses_post( Portum_Helper::generate_section_title( get_theme_mod( 'portum_contact_subtitle', esc_html__( 'CONTACT', 'portum' ) ), get_theme_mod( 'portum_contact_title', esc_html__( 'How can we help you?', 'portum' ) ) ) ); ?>

			<div class="wrapper fixed">
				<?php
				$contact_fields = $frontpage->get_repeater_field( 'portum_contact_section', array() );
				if ( ! empty( $contact_fields ) ) {
					?>
					<div class="row">
						<?php foreach ( $contact_fields as $field ) { ?>
							<div class="col-md-4 col-sx-12">
								<div class="contact-details-item">
									<h5>
										<i class="fa <?php echo esc_attr( $field['contact_icon'] ); ?>" aria-hidden="true"></i>
										<?php echo esc_html( $field['contact_title'] ); ?>
									</h5>
									<?php echo wpautop( wp_kses_post( $field['contact_text'] ) ); ?>
								</div>
							</div>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
			<div class="contact-decoration"></div>
		</div>
	</div>
</section>
