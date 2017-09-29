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

	<div class="contact-info fixed">
		<h4>Learn more about us</h4>
		<button class="btn-contrast btn contact-action contact-submit" type="button">Contact us</button>
	</div>

	<div class="contact-form-content">
		<?php echo do_shortcode( '[contact-form-7 id="89" title="Contact form 1"]' ); ?>
	</div>
</div>
