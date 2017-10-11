<?php
/**
 * Template part for displaying contact form in footer.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Portum
 */
?>

<div class="contact-form">
	<?php $cform = absint( get_theme_mod( 'portum_contact_form', 0 ) ); ?>

	<?php if ( defined( 'WPCF7_VERSION' ) && 0 !== $cform ) { ?>
		<div class="contact-info fixed">
			<h4>
				<?php
				// Translators: Contact Form Header
				echo esc_html__( 'Learn more about us', 'portum' );
				?>
			</h4>
			<button class="btn-contrast btn contact-action contact-submit" type="button">
				<?php
				// Translators: Contact button label
				echo esc_html__( 'Contact us', 'portum' );
				?>
			</button>
		</div>
		<div class="contact-form-content">
			<?php echo do_shortcode( '[contact-form-7 id="' . absint( $cform ) . '" title="Contact Form"]' ); ?>
		</div>
	<?php } ?>
</div>
