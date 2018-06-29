<?php
/**
 * Template part for displaying contact form in footer.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Portum
 */
?>

<?php
$cform       = intval( get_theme_mod( 'portum_contact_form', 0 ) );
$cform_title = get_theme_mod( 'portum_footer_contact_title', __( 'Learn more about us', 'portum' ) );
?>

<?php if ( defined( 'WPCF7_VERSION' ) && 0 !== $cform ) { ?>

<div class="contact-form">
	<div class="contact-decoration"></div>
	<div class="contact-info fixed">
		<h4>
			<?php
			// Translators: Contact Form Header
			echo esc_html( $cform_title );
			?>
		</h4>
		<a class="ewf-btn ewf-btn--large contact-action contact-submit">
			<?php
			// Translators: Contact button label
			echo esc_html__( 'Contact us', 'portum' );
			?>
		</a>
	</div>
	<div class="contact-form-content">
		<?php echo do_shortcode( '[contact-form-7 id="' . absint( $cform ) . '" title="Contact Form"]' ); ?>
	</div>
</div>

<?php } ?>
